<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $patients = Patient::query()
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('patient_id', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backend.patients.index', compact('patients'));
    }

    public function create()
    {
        $branches = $this->selectableBranchesForPatient();

        return view('backend.patients.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'date_of_birth' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'address' => ['nullable', 'string'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'branch_id' => [$this->isBranchRestricted() ? 'nullable' : 'required', 'exists:branches,id'],
        ]);

        $validated['status'] = 'Active';
        $validated['branch_id'] = $this->currentBranchId() ?? $validated['branch_id'];

        Patient::create($validated);

        return redirect()->route('admin.patients.index')->with('status', 'Patient added successfully.');
    }

    public function show(Patient $patient)
    {
        $this->authorizeBranchAccess($patient);

        return view('backend.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        $this->authorizeBranchAccess($patient);

        $branches = $this->selectableBranchesForPatient();

        return view('backend.patients.edit', compact('patient', 'branches'));
    }

    public function update(Request $request, Patient $patient)
    {
        $this->authorizeBranchAccess($patient);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:Male,Female,Other'],
            'date_of_birth' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'blood_group' => ['nullable', 'string', 'max:5'],
            'address' => ['nullable', 'string'],
            'guardian_name' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:Active,Inactive'],
            'branch_id' => ['nullable', 'exists:branches,id'],
        ]);

        // Branch-restricted admins can't move a patient to a different branch.
        if ($this->isBranchRestricted()) {
            $validated['branch_id'] = $patient->branch_id;
        }

        $patient->update($validated);

        return redirect()->route('admin.patients.index')->with('status', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $this->authorizeBranchAccess($patient);

        $patient->delete();

        return redirect()->route('admin.patients.index')->with('status', 'Patient deleted successfully.');
    }

    private function selectableBranchesForPatient()
    {
        $query = Branch::where('status', 'Active')->orderBy('name');

        if ($branchId = $this->currentBranchId()) {
            $query->where('id', $branchId);
        }

        return $query->pluck('name', 'id');
    }

    /**
     * Blocks a branch-restricted user (e.g. Branch Admin) from viewing or
     * modifying a patient that belongs to a different branch, even if they
     * type the URL directly.
     */
    private function authorizeBranchAccess(Patient $patient): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $patient->branch_id !== $branchId, 403, 'This patient belongs to a different branch.');
    }
}
