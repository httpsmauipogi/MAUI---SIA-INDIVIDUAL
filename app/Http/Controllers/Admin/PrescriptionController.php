<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $prescriptions = Prescription::query()
            ->with(['patient', 'doctor'])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->when($request->search, function ($query, $search) {
                $query->where('prescription_no', 'like', "%{$search}%")
                    ->orWhereHas('patient', fn ($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->latest('prescription_date')
            ->paginate(10)
            ->withQueryString();

        return view('backend.prescriptions.index', compact('prescriptions'));
    }

    public function create()
    {
        $patients = Patient::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();
        $doctors = Doctor::where('status', 'Active')->tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.prescriptions.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePrescription($request);
        $this->guardSameBranch($validated['patient_id'], $validated['doctor_id']);

        $prescription = Prescription::create($validated);

        return redirect()->route('admin.prescriptions.show', $prescription)->with('status', 'Prescription created successfully.');
    }

    public function show(Prescription $prescription)
    {
        $this->authorizeBranchAccess($prescription);

        $prescription->load('patient', 'doctor', 'appointment');

        return view('backend.prescriptions.show', compact('prescription'));
    }

    public function edit(Prescription $prescription)
    {
        $this->authorizeBranchAccess($prescription);

        $patients = Patient::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();
        $doctors = Doctor::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.prescriptions.edit', compact('prescription', 'patients', 'doctors'));
    }

    public function update(Request $request, Prescription $prescription)
    {
        $this->authorizeBranchAccess($prescription);

        $validated = $this->validatePrescription($request);
        $this->guardSameBranch($validated['patient_id'], $validated['doctor_id']);

        $prescription->update($validated);

        return redirect()->route('admin.prescriptions.show', $prescription)->with('status', 'Prescription updated successfully.');
    }

    public function destroy(Prescription $prescription)
    {
        $this->authorizeBranchAccess($prescription);

        $prescription->delete();

        return redirect()->route('admin.prescriptions.index')->with('status', 'Prescription deleted successfully.');
    }

    private function validatePrescription(Request $request): array
    {
        return $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'prescription_date' => ['required', 'date'],
            'diagnosis' => ['nullable', 'string'],
            'advice' => ['nullable', 'string'],
            'follow_up_date' => ['nullable', 'date', 'after_or_equal:prescription_date'],
            'medicines' => ['required', 'array', 'min:1'],
            'medicines.*.name' => ['required', 'string', 'max:255'],
            'medicines.*.dosage' => ['nullable', 'string', 'max:100'],
            'medicines.*.frequency' => ['nullable', 'string', 'max:100'],
            'medicines.*.duration' => ['nullable', 'string', 'max:100'],
            'medicines.*.instructions' => ['nullable', 'string', 'max:255'],
        ]);
    }

    private function authorizeBranchAccess(Prescription $prescription): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $prescription->patient?->branch_id !== $branchId, 403, 'This prescription belongs to a different branch.');
    }

    private function guardSameBranch(int $patientId, int $doctorId): void
    {
        if ($branchId = $this->currentBranchId()) {
            $patient = Patient::find($patientId);
            $doctor = Doctor::find($doctorId);
            abort_if($patient?->branch_id !== $branchId || $doctor?->branch_id !== $branchId, 403, 'You can only write prescriptions within your own branch.');
        }
    }
}
