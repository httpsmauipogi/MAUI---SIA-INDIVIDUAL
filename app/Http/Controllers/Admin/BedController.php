<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\Patient;
use Illuminate\Http\Request;

class BedController extends Controller
{
    public function index(Request $request)
    {
        $beds = Bed::query()
            ->with(['patient', 'activeAdmission'])
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->when($request->ward, fn ($q, $ward) => $q->where('ward', $ward))
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->orderBy('ward')
            ->orderBy('bed_number')
            ->get();

        $wards = Bed::tap(fn ($q) => $this->scopeToBranch($q))->select('ward')->distinct()->orderBy('ward')->pluck('ward');

        $baseCount = fn () => Bed::query()->tap(fn ($q) => $this->scopeToBranch($q));

        $counts = [
            'total' => $baseCount()->count(),
            'available' => $baseCount()->where('status', 'Available')->count(),
            'occupied' => $baseCount()->where('status', 'Occupied')->count(),
            'maintenance' => $baseCount()->where('status', 'Maintenance')->count(),
        ];

        // Patients selectable for bed assignment - same branch only.
        $patients = Patient::query()->tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();

        return view('backend.beds.index', compact('beds', 'wards', 'counts', 'patients'));
    }

    public function create()
    {
        return view('backend.beds.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bed_number' => ['required', 'string', 'max:50', 'unique:beds,bed_number'],
            'ward' => ['required', 'string', 'max:100'],
            'floor' => ['nullable', 'string', 'max:50'],
        ]);

        $validated['status'] = 'Available';
        $validated['branch_id'] = $this->currentBranchId();

        Bed::create($validated);

        return redirect()->route('admin.beds.index')->with('status', 'Bed added successfully.');
    }

    public function edit(Bed $bed)
    {
        $this->authorizeBranchAccess($bed);

        return view('backend.beds.edit', compact('bed'));
    }

    public function update(Request $request, Bed $bed)
    {
        $this->authorizeBranchAccess($bed);

        $validated = $request->validate([
            'bed_number' => ['required', 'string', 'max:50', 'unique:beds,bed_number,' . $bed->id],
            'ward' => ['required', 'string', 'max:100'],
            'floor' => ['nullable', 'string', 'max:50'],
            'status' => ['required', 'in:Available,Occupied,Maintenance'],
        ]);

        if ($validated['status'] !== 'Occupied') {
            $validated['patient_id'] = null;
            $validated['occupied_at'] = null;
        }

        $bed->update($validated);

        return redirect()->route('admin.beds.index')->with('status', 'Bed updated successfully.');
    }

    public function destroy(Bed $bed)
    {
        $this->authorizeBranchAccess($bed);

        $bed->delete();

        return redirect()->route('admin.beds.index')->with('status', 'Bed removed successfully.');
    }

    public function assign(Request $request, Bed $bed)
    {
        $this->authorizeBranchAccess($bed);

        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
        ]);

        $patient = Patient::findOrFail($validated['patient_id']);

        // A branch-restricted admin can't assign a bed to another branch's patient.
        if (($branchId = $this->currentBranchId()) && $patient->branch_id !== $branchId) {
            abort(403, 'This patient belongs to a different branch.');
        }

        $bed->update([
            'patient_id' => $validated['patient_id'],
            'status' => 'Occupied',
            'occupied_at' => now(),
        ]);

        return back()->with('status', 'Bed ' . $bed->bed_number . ' assigned to ' . $patient->name . '.');
    }

    public function discharge(Bed $bed)
    {
        $this->authorizeBranchAccess($bed);

        $bed->update([
            'patient_id' => null,
            'status' => 'Available',
            'occupied_at' => null,
        ]);

        return back()->with('status', 'Bed ' . $bed->bed_number . ' is now available.');
    }

    private function authorizeBranchAccess(Bed $bed): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $bed->branch_id !== $branchId, 403, 'This bed belongs to a different branch.');
    }
}
