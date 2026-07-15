<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AppointmentConfirmationMail;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Services\NotifyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $appointments = Appointment::query()
            ->with(['patient', 'doctor'])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->when($request->date, fn ($query, $date) => $query->whereDate('appointment_date', $date))
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('backend.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();
        $doctors = Doctor::where('status', 'Active')->tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'reason' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->guardSameBranch($validated['patient_id'], $validated['doctor_id']);

        $validated['status'] = 'Scheduled';

        $appointment = Appointment::createWithSerial($validated);

        NotifyService::roles(
            ['Super Admin', 'Hospital Admin', 'Receptionist'],
            'New appointment booked',
            $appointment->patient->name . ' scheduled with Dr. ' . $appointment->doctor->name . ' on ' . $appointment->appointment_date,
            route('admin.appointments.show', $appointment),
            'iconoir-calendar-plus',
            'primary',
            auth()->id()
        );

        if ($appointment->patient->email) {
            try {
                Mail::to($appointment->patient->email)
                    ->send(new AppointmentConfirmationMail($appointment->load('doctor', 'patient')));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()->route('admin.appointments.index')->with('status', 'Appointment booked successfully.');
    }

    public function show(Appointment $appointment)
    {
        $this->authorizeBranchAccess($appointment);

        $appointment->load(['patient', 'doctor']);

        return view('backend.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $this->authorizeBranchAccess($appointment);

        $patients = Patient::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();
        $doctors = Doctor::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorizeBranchAccess($appointment);

        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required'],
            'reason' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Scheduled,Completed,Cancelled'],
            'notes' => ['nullable', 'string'],
        ]);

        $this->guardSameBranch($validated['patient_id'], $validated['doctor_id']);

        $doctorOrDateChanged = $appointment->doctor_id != $validated['doctor_id']
            || $appointment->appointment_date->format('Y-m-d') !== $validated['appointment_date'];

        if ($doctorOrDateChanged) {
            $validated['serial_number'] = Appointment::nextSerialFor($validated['doctor_id'], $validated['appointment_date']);
        }

        $appointment->update($validated);

        return redirect()->route('admin.appointments.index')->with('status', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorizeBranchAccess($appointment);

        $appointment->delete();

        return redirect()->route('admin.appointments.index')->with('status', 'Appointment deleted successfully.');
    }

    private function authorizeBranchAccess(Appointment $appointment): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $appointment->patient?->branch_id !== $branchId, 403, 'This appointment belongs to a different branch.');
    }

    /**
     * Prevents booking a patient from one branch with a doctor from another.
     */
    private function guardSameBranch(int $patientId, int $doctorId): void
    {
        $patient = Patient::find($patientId);
        $doctor = Doctor::find($doctorId);

        abort_if(
            $patient && $doctor && $patient->branch_id && $doctor->branch_id && $patient->branch_id !== $doctor->branch_id,
            422,
            'The selected patient and doctor belong to different branches.'
        );

        if ($branchId = $this->currentBranchId()) {
            abort_if($patient?->branch_id !== $branchId || $doctor?->branch_id !== $branchId, 403, 'You can only book within your own branch.');
        }
    }
}
