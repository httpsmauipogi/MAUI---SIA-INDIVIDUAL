<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Bed;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function index(Request $request)
    {
        $admissions = Admission::query()
            ->with(['patient', 'doctor', 'bed'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->search, function ($q, $search) {
                $q->where('admission_no', 'like', "%{$search}%")
                    ->orWhereHas('patient', fn ($p) => $p->where('name', 'like', "%{$search}%"));
            })
            ->latest('admission_date')
            ->paginate(10)
            ->withQueryString();

        $counts = [
            'admitted' => Admission::where('status', 'Admitted')->count(),
            'dischargedToday' => Admission::where('status', 'Discharged')->whereDate('discharge_date', today())->count(),
            'availableBeds' => Bed::where('status', 'Available')->count(),
        ];

        return view('backend.admissions.index', compact('admissions', 'counts'));
    }

    public function create(Request $request)
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::where('status', 'Active')->orderBy('name')->get();
        $beds = Bed::where('status', 'Available')->orderBy('ward')->orderBy('bed_number')->get();
        $selectedBedId = $request->integer('bed_id') ?: null;

        return view('backend.admissions.create', compact('patients', 'doctors', 'beds', 'selectedBedId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:doctors,id'],
            'bed_id' => ['required', 'exists:beds,id'],
            'admission_date' => ['required', 'date'],
            'expected_discharge_date' => ['nullable', 'date', 'after_or_equal:admission_date'],
            'reason' => ['required', 'string', 'max:255'],
            'diagnosis' => ['nullable', 'string'],
        ]);

        $bed = Bed::findOrFail($validated['bed_id']);
        if ($bed->status !== 'Available') {
            return back()->withInput()->with('status', 'That bed is no longer available. Please choose another.');
        }

        $validated['status'] = 'Admitted';
        $validated['admitted_by'] = auth()->id();

        $admission = Admission::create($validated);

        $bed->update([
            'status' => 'Occupied',
            'patient_id' => $validated['patient_id'],
            'occupied_at' => $validated['admission_date'],
        ]);

        \App\Services\NotifyService::roles(
            ['Super Admin', 'Hospital Admin', 'Nurse'],
            'Patient admitted',
            $admission->patient->name . ' admitted to bed ' . $bed->bed_number . ' (' . $bed->ward . ')',
            route('admin.admissions.show', $admission),
            'iconoir-hospital-circle',
            'warning'
        );

        return redirect()->route('admin.admissions.show', $admission)->with('status', 'Patient admitted successfully.');
    }

    public function show(Admission $admission)
    {
        $admission->load(['patient', 'doctor', 'bed', 'admittedBy']);

        return view('backend.admissions.show', compact('admission'));
    }

    public function edit(Admission $admission)
    {
        $doctors = Doctor::where('status', 'Active')->orderBy('name')->get();

        return view('backend.admissions.edit', compact('admission', 'doctors'));
    }

    public function update(Request $request, Admission $admission)
    {
        $validated = $request->validate([
            'doctor_id' => ['nullable', 'exists:doctors,id'],
            'expected_discharge_date' => ['nullable', 'date'],
            'reason' => ['required', 'string', 'max:255'],
            'diagnosis' => ['nullable', 'string'],
        ]);

        $admission->update($validated);

        return redirect()->route('admin.admissions.show', $admission)->with('status', 'Admission updated successfully.');
    }

    public function discharge(Request $request, Admission $admission)
    {
        if ($admission->status === 'Discharged') {
            return back()->with('status', 'This patient has already been discharged.');
        }

        $validated = $request->validate([
            'discharge_notes' => ['nullable', 'string'],
        ]);

        $admission->update([
            'status' => 'Discharged',
            'discharge_date' => now(),
            'discharge_notes' => $validated['discharge_notes'] ?? null,
        ]);

        $admission->bed->update([
            'status' => 'Available',
            'patient_id' => null,
            'occupied_at' => null,
        ]);

        return redirect()->route('admin.admissions.show', $admission)->with('status', 'Patient discharged. Bed is now available.');
    }
}
