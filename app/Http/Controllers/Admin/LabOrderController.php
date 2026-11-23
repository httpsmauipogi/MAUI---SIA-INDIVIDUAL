<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\LabOrder;
use App\Models\LabTest;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LabOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = LabOrder::query()
            ->with(['patient', 'labTest'])
            ->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'))
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->search, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('order_no', 'like', "%{$search}%")
                        ->orWhereHas('patient', fn ($p) => $p->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest('ordered_date')
            ->paginate(10)
            ->withQueryString();

        $orderBase = fn () => LabOrder::query()->tap(fn ($q) => $this->scopeToBranchVia($q, 'patient'));

        $counts = [
            'pending' => $orderBase()->where('status', 'Pending')->count(),
            'processing' => $orderBase()->whereIn('status', ['Sample Collected', 'Processing'])->count(),
            'completedToday' => $orderBase()->where('status', 'Completed')->whereDate('result_date', today())->count(),
        ];

        return view('backend.lab.orders.index', compact('orders', 'counts'));
    }

    public function create()
    {
        $patients = Patient::tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();
        $doctors = Doctor::where('status', 'Active')->tap(fn ($q) => $this->scopeToBranch($q))->orderBy('name')->get();
        $labTests = LabTest::where('status', 'Active')->orderBy('name')->get();

        return view('backend.lab.orders.create', compact('patients', 'doctors', 'labTests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'doctor_id' => ['nullable', 'exists:doctors,id'],
            'lab_test_id' => ['required', 'exists:lab_tests,id'],
            'ordered_date' => ['required', 'date'],
        ]);

        if ($branchId = $this->currentBranchId()) {
            $patient = Patient::find($validated['patient_id']);
            abort_if($patient?->branch_id !== $branchId, 403, 'You can only order tests for patients in your own branch.');
        }

        $labTest = LabTest::findOrFail($validated['lab_test_id']);
        $validated['price'] = $labTest->price;
        $validated['status'] = 'Pending';

        $order = LabOrder::create($validated);

        return redirect()->route('admin.lab-orders.show', $order)->with('status', 'Lab test ordered successfully.');
    }

    public function show(LabOrder $labOrder)
    {
        $this->authorizeBranchAccess($labOrder);

        $labOrder->load(['patient', 'doctor', 'labTest']);

        return view('backend.lab.orders.show', compact('labOrder'));
    }

    public function edit(LabOrder $labOrder)
    {
        $this->authorizeBranchAccess($labOrder);

        return view('backend.lab.orders.edit', compact('labOrder'));
    }

    public function update(Request $request, LabOrder $labOrder)
    {
        $this->authorizeBranchAccess($labOrder);

        $validated = $request->validate([
            'status' => ['required', 'in:Pending,Sample Collected,Processing,Completed,Cancelled'],
            'result_notes' => ['nullable', 'string'],
            'result_file' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ]);

        if ($validated['status'] === 'Sample Collected' && $labOrder->status !== 'Sample Collected') {
            $validated['sample_collected_at'] = now();
        }

        if ($validated['status'] === 'Completed' && $labOrder->status !== 'Completed') {
            $validated['result_date'] = now();
        }

        if ($request->hasFile('result_file')) {
            $file = $request->file('result_file');
            $validated['result_file'] = $file->storeAs(
                'lab-results',
                Str::random(40).'.'.$file->extension(),
                'public'
            );
        }

        $labOrder->update($validated);

        return redirect()->route('admin.lab-orders.show', $labOrder)->with('status', 'Lab order updated successfully.');
    }

    public function destroy(LabOrder $labOrder)
    {
        $this->authorizeBranchAccess($labOrder);

        $labOrder->delete();

        return redirect()->route('admin.lab-orders.index')->with('status', 'Lab order removed successfully.');
    }

    private function authorizeBranchAccess(LabOrder $labOrder): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $labOrder->patient?->branch_id !== $branchId, 403, 'This lab order belongs to a different branch.');
    }
}
