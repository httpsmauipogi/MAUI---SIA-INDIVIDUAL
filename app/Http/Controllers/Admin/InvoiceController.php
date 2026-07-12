<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::query()
            ->with('patient')
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->when($request->search, function ($query, $search) {
                $query->where('invoice_no', 'like', "%{$search}%")
                    ->orWhereHas('patient', fn ($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->latest('invoice_date')
            ->paginate(10)
            ->withQueryString();

        return view('backend.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();

        return view('backend.invoices.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateInvoice($request);

        $invoice = Invoice::create($validated);
        $invoice->refreshStatus();

        return redirect()->route('admin.invoices.show', $invoice)->with('status', 'Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('patient', 'appointment');

        return view('backend.invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $patients = Patient::orderBy('name')->get();

        return view('backend.invoices.edit', compact('invoice', 'patients'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $validated = $this->validateInvoice($request);

        $invoice->update($validated);
        $invoice->refreshStatus();

        return redirect()->route('admin.invoices.show', $invoice)->with('status', 'Invoice updated successfully.');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('status', 'Invoice deleted successfully.');
    }

    public function recordPayment(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'amount' => ['required', 'numeric', 'min:0.01', 'max:' . $invoice->due_amount],
        ]);

        $invoice->increment('paid_amount', $validated['amount']);
        $invoice->refresh()->refreshStatus();

        return back()->with('status', 'Payment recorded successfully.');
    }

    private function validateInvoice(Request $request): array
    {
        $validated = $request->validate([
            'patient_id' => ['required', 'exists:patients,id'],
            'appointment_id' => ['nullable', 'exists:appointments,id'],
            'invoice_date' => ['required', 'date'],
            'due_date' => ['nullable', 'date', 'after_or_equal:invoice_date'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        $subtotal = collect($validated['items'])->sum(
            fn ($item) => (float) $item['quantity'] * (float) $item['unit_price']
        );

        $discount = (float) ($validated['discount'] ?? 0);

        $validated['subtotal'] = $subtotal;
        $validated['discount'] = $discount;
        $validated['total'] = max($subtotal - $discount, 0);

        return $validated;
    }
}
