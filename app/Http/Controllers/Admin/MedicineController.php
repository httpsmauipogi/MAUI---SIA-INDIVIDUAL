<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\MedicineStockLog;
use App\Models\Patient;
use App\Services\NotifyService;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $medicines = Medicine::query()
            ->tap(fn ($q) => $this->scopeToBranch($q))
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('generic_name', 'like', "%{$search}%");
            })
            ->when($request->filter === 'low_stock', fn ($q) => $q->whereColumn('stock_quantity', '<=', 'reorder_level'))
            ->when($request->filter === 'expiring', fn ($q) => $q->whereNotNull('expiry_date')->where('expiry_date', '<=', now()->addDays(30)))
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $base = fn () => Medicine::query()->tap(fn ($q) => $this->scopeToBranch($q));

        $counts = [
            'total' => $base()->count(),
            'lowStock' => $base()->whereColumn('stock_quantity', '<=', 'reorder_level')->count(),
            'expiringSoon' => $base()->whereNotNull('expiry_date')->where('expiry_date', '<=', now()->addDays(30))->count(),
            'outOfStock' => $base()->where('stock_quantity', 0)->count(),
        ];

        return view('backend.pharmacy.index', compact('medicines', 'counts'));
    }

    public function create()
    {
        $isBranchRestricted = $this->isBranchRestricted();

        return view('backend.pharmacy.create', compact('isBranchRestricted'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateMedicine($request);
        $validated['status'] = 'Active';
        $validated['branch_id'] = $this->currentBranchId() ?? $validated['branch_id'] ?? null;

        Medicine::create($validated);

        return redirect()->route('admin.pharmacy.index')->with('status', 'Medicine added successfully.');
    }

    public function show(Medicine $medicine)
    {
        $this->authorizeBranchAccess($medicine);

        $logs = $medicine->stockLogs()->with(['patient', 'user'])->latest()->paginate(15);

        return view('backend.pharmacy.show', compact('medicine', 'logs'));
    }

    public function edit(Medicine $medicine)
    {
        $this->authorizeBranchAccess($medicine);

        return view('backend.pharmacy.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $this->authorizeBranchAccess($medicine);

        $validated = $this->validateMedicine($request);
        $validated['status'] = $request->input('status', 'Active');

        if ($this->isBranchRestricted()) {
            $validated['branch_id'] = $medicine->branch_id;
        }

        $medicine->update($validated);

        return redirect()->route('admin.pharmacy.index')->with('status', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $this->authorizeBranchAccess($medicine);

        $medicine->delete();

        return redirect()->route('admin.pharmacy.index')->with('status', 'Medicine removed successfully.');
    }

    public function restock(Request $request, Medicine $medicine)
    {
        $this->authorizeBranchAccess($medicine);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        $medicine->increment('stock_quantity', $validated['quantity']);

        MedicineStockLog::create([
            'medicine_id' => $medicine->id,
            'type' => 'Restock',
            'quantity' => $validated['quantity'],
            'user_id' => auth()->id(),
            'notes' => $validated['notes'] ?? null,
        ]);

        return back()->with('status', 'Stock updated: +' . $validated['quantity'] . ' ' . $medicine->unit . '(s).');
    }

    public function dispense(Request $request, Medicine $medicine)
    {
        $this->authorizeBranchAccess($medicine);

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $medicine->stock_quantity],
            'patient_id' => ['nullable', 'exists:patients,id'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);

        if (! empty($validated['patient_id']) && ($branchId = $this->currentBranchId())) {
            $patient = Patient::find($validated['patient_id']);
            abort_if($patient?->branch_id !== $branchId, 403, 'That patient belongs to a different branch.');
        }

        $medicine->decrement('stock_quantity', $validated['quantity']);

        MedicineStockLog::create([
            'medicine_id' => $medicine->id,
            'type' => 'Dispense',
            'quantity' => -$validated['quantity'],
            'patient_id' => $validated['patient_id'] ?? null,
            'user_id' => auth()->id(),
            'notes' => $validated['notes'] ?? null,
        ]);

        $medicine->refresh();
        if ($medicine->stock_quantity <= $medicine->reorder_level) {
            NotifyService::roles(
                ['Super Admin', 'Hospital Admin', 'Pharmacist'],
                'Low stock alert',
                $medicine->name . ' has dropped to ' . $medicine->stock_quantity . ' ' . $medicine->unit . '(s), at or below reorder level.',
                route('admin.pharmacy.show', $medicine),
                'iconoir-warning-triangle',
                'warning',
                auth()->id()
            );
        }

        return back()->with('status', 'Dispensed ' . $validated['quantity'] . ' ' . $medicine->unit . '(s).');
    }

    private function validateMedicine(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'generic_name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'unit' => ['required', 'string', 'max:50'],
            'manufacturer' => ['nullable', 'string', 'max:255'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'reorder_level' => ['required', 'integer', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'expiry_date' => ['nullable', 'date'],
            'branch_id' => ['nullable', 'exists:branches,id'],
        ]);
    }

    private function authorizeBranchAccess(Medicine $medicine): void
    {
        $branchId = $this->currentBranchId();

        abort_if($branchId && $medicine->branch_id !== $branchId, 403, 'This medicine belongs to a different branch.');
    }
}
