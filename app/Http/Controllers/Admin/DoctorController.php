<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::query()
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('doctor_id', 'like', "%{$search}%")
                    ->orWhere('specialization', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backend.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $users = $this->availableDoctorUsers();
        $branches = $this->selectableBranches();

        return view('backend.doctors.create', compact('users', 'branches'));
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);
        $validated['status'] = 'Active';
        $validated['branch_id'] = $this->currentBranchId() ?? $validated['branch_id'] ?? null;

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        Doctor::create($validated);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor added successfully.');
    }

    public function show(Doctor $doctor)
    {
        $this->authorizeBranchAccess($doctor);

        $doctor->load('schedules');

        return view('backend.doctors.show', compact('doctor'));
    }

    public function edit(Doctor $doctor)
    {
        $this->authorizeBranchAccess($doctor);

        $users = $this->availableDoctorUsers($doctor);
        $doctor->load('schedules');
        $branches = $this->selectableBranches();

        return view('backend.doctors.edit', compact('doctor', 'users', 'branches'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $this->authorizeBranchAccess($doctor);

        $validated = $this->validated($request);
        $validated['status'] = $request->input('status', $doctor->status);

        // Branch-restricted admins can't move a doctor to a different branch.
        if ($this->currentBranchId()) {
            $validated['branch_id'] = $doctor->branch_id;
        }

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('doctors', 'public');
        }

        $doctor->update($validated);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        $this->authorizeBranchAccess($doctor);

        $doctor->delete();

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor deleted successfully.');
    }

    public function addSchedule(Request $request, Doctor $doctor)
    {
        $this->authorizeBranchAccess($doctor);

        $validated = $request->validate([
            'day_of_week' => ['required', 'in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
        ]);

        $doctor->schedules()->create($validated);

        return back()->with('status', 'Schedule slot added.');
    }

    public function deleteSchedule(Doctor $doctor, DoctorSchedule $schedule)
    {
        $this->authorizeBranchAccess($doctor);

        abort_unless($schedule->doctor_id === $doctor->id, 404);

        $schedule->delete();

        return back()->with('status', 'Schedule slot removed.');
    }

    /**
     * "My Patients" - shows the logged-in doctor exactly which patients
     * they are seeing, today and upcoming, based on their linked Doctor profile.
     */
    public function myPatients(Request $request)
    {
        $doctor = Doctor::where('user_id', auth()->id())->first();

        if (! $doctor) {
            return view('backend.doctors.my-patients', ['doctor' => null, 'todayAppointments' => collect(), 'upcomingAppointments' => collect()]);
        }

        $todayAppointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->whereDate('appointment_date', today())
            ->orderBy('appointment_time')
            ->get();

        $upcomingAppointments = Appointment::with('patient')
            ->where('doctor_id', $doctor->id)
            ->where('appointment_date', '>', today())
            ->where('status', 'Scheduled')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->limit(20)
            ->get();

        return view('backend.doctors.my-patients', compact('doctor', 'todayAppointments', 'upcomingAppointments'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'user_id' => ['nullable', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'specialization' => ['required', 'string', 'max:255'],
            'qualification' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0'],
            'consultation_fee' => ['nullable', 'string', 'max:50'],
            'branch_id' => ['nullable', 'exists:branches,id'],
            'floor' => ['nullable', 'string', 'max:50'],
            'room_no' => ['nullable', 'string', 'max:50'],
        ]);
    }

    /**
     * Branches a doctor can be assigned to: only the admin's own branch if
     * they're branch-restricted, otherwise every active branch.
     */
    private function selectableBranches()
    {
        $query = Branch::where('status', 'Active')->orderBy('name');

        if ($branchId = $this->currentBranchId()) {
            $query->where('id', $branchId);
        }

        return $query->pluck('name', 'id');
    }

    private function authorizeBranchAccess(Doctor $doctor): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $doctor->branch_id !== $branchId, 403, 'This doctor belongs to a different branch.');
    }

    /**
     * Users with the "Doctor" role that aren't already linked to a doctor profile
     * (plus the currently-linked user when editing, so it stays selectable).
     */
    private function availableDoctorUsers(?Doctor $editingDoctor = null)
    {
        $linkedIds = Doctor::whereNotNull('user_id')
            ->when($editingDoctor, fn ($q) => $q->where('id', '!=', $editingDoctor->id))
            ->pluck('user_id');

        return User::whereHas('roles', fn ($q) => $q->where('name', 'Doctor'))
            ->whereNotIn('id', $linkedIds)
            ->orderBy('name')
            ->get();
    }
}
