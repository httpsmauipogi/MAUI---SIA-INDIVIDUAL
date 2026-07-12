@extends('layouts.backend')

@section('title', 'New Invoice')
@section('page-title', 'New Invoice')

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.invoices.store') }}" id="invoice-form">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="patient_id">Patient</label>
                            <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id">
                                <option value="">Select patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ (string) old('patient_id') === (string) $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->patient_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="invoice_date">Invoice Date</label>
                            <input type="date" class="form-control @error('invoice_date') is-invalid @enderror" id="invoice_date" name="invoice_date" value="{{ old('invoice_date', now()->format('Y-m-d')) }}">
                            @error('invoice_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="due_date">Due Date</label>
                            <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date') }}">
                            @error('due_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Invoice Items</h5>

                    <div class="table-responsive">
                        <table class="table" id="items-table">
                            <thead>
                                <tr>
                                    <th style="min-width: 220px;">Description</th>
                                    <th style="width: 110px;">Qty</th>
                                    <th style="width: 150px;">Unit Price</th>
                                    <th style="width: 150px;">Amount</th>
                                    <th style="width: 40px;"></th>
                                </tr>
                            </thead>
                            <tbody id="items-body">
                                @php $oldItems = old('items', [['description' => '', 'quantity' => 1, 'unit_price' => '']]); @endphp
                                @foreach ($oldItems as $i => $item)
                                    <tr class="item-row">
                                        <td><input type="text" name="items[{{ $i }}][description]" class="form-control" value="{{ $item['description'] ?? '' }}" placeholder="e.g. Consultation fee"></td>
                                        <td><input type="number" step="0.01" min="0.01" name="items[{{ $i }}][quantity]" class="form-control item-qty" value="{{ $item['quantity'] ?? 1 }}"></td>
                                        <td><input type="number" step="0.01" min="0" name="items[{{ $i }}][unit_price]" class="form-control item-price" value="{{ $item['unit_price'] ?? '' }}"></td>
                                        <td><span class="item-amount">0.00</span></td>
                                        <td><button type="button" class="btn btn-sm btn-soft-danger remove-row"><i class="las la-times"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @error('items') <span class="text-danger d-block mb-2">{{ $message }}</span> @enderror

                    <button type="button" class="btn btn-sm btn-soft-primary mb-3" id="add-row"><i class="las la-plus"></i> Add Item</button>

                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal</span>
                                <span id="subtotal-display">0.00</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="text-muted mb-0" for="discount">Discount</label>
                                <input type="number" step="0.01" min="0" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount', 0) }}" style="max-width: 140px;">
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-16">
                                <span>Total</span>
                                <span id="total-display">0.00</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 mt-3">
                        <label class="form-label" for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Create Invoice</button>
                        <a href="{{ route('admin.invoices.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection

@push('scripts')
<script>
    (function () {
        const itemsBody = document.getElementById('items-body');
        const addRowBtn = document.getElementById('add-row');
        const discountInput = document.getElementById('discount');
        let rowIndex = document.querySelectorAll('.item-row').length;

        function rowTemplate(index) {
            const tr = document.createElement('tr');
            tr.className = 'item-row';
            tr.innerHTML = `
                <td><input type="text" name="items[${index}][description]" class="form-control" placeholder="e.g. Consultation fee"></td>
                <td><input type="number" step="0.01" min="0.01" name="items[${index}][quantity]" class="form-control item-qty" value="1"></td>
                <td><input type="number" step="0.01" min="0" name="items[${index}][unit_price]" class="form-control item-price" value=""></td>
                <td><span class="item-amount">0.00</span></td>
                <td><button type="button" class="btn btn-sm btn-soft-danger remove-row"><i class="las la-times"></i></button></td>
            `;
            return tr;
        }

        function recalculate() {
            let subtotal = 0;
            document.querySelectorAll('.item-row').forEach(function (row) {
                const qty = parseFloat(row.querySelector('.item-qty')?.value) || 0;
                const price = parseFloat(row.querySelector('.item-price')?.value) || 0;
                const amount = qty * price;
                row.querySelector('.item-amount').textContent = amount.toFixed(2);
                subtotal += amount;
            });
            const discount = parseFloat(discountInput.value) || 0;
            const total = Math.max(subtotal - discount, 0);
            document.getElementById('subtotal-display').textContent = subtotal.toFixed(2);
            document.getElementById('total-display').textContent = total.toFixed(2);
        }

        addRowBtn.addEventListener('click', function () {
            itemsBody.appendChild(rowTemplate(rowIndex));
            rowIndex++;
        });

        itemsBody.addEventListener('click', function (e) {
            const btn = e.target.closest('.remove-row');
            if (!btn) return;
            if (document.querySelectorAll('.item-row').length > 1) {
                btn.closest('.item-row').remove();
                recalculate();
            }
        });

        document.addEventListener('input', function (e) {
            if (e.target.closest('.item-row') || e.target === discountInput) {
                recalculate();
            }
        });

        recalculate();
    })();
</script>
@endpush
