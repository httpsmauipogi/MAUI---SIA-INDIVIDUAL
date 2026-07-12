@extends('layouts.backend')

@section('title', $medicine->name)
@section('page-title', 'Medicine Details')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $medicine->name }}</h4>
                        <p class="text-muted mb-0">{{ $medicine->generic_name ?? '' }}</p>
                    </div>
                    <span class="badge {{ $medicine->status === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} fs-13">{{ $medicine->status }}</span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Current Stock</p>
                        <p class="fw-medium fs-18 {{ $medicine->isLowStock() ? 'text-warning' : '' }}">{{ $medicine->stock_quantity }} {{ $medicine->unit }}(s)</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Unit Price</p>
                        <p class="fw-medium">{{ number_format($medicine->unit_price, 2) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Category</p>
                        <p class="fw-medium">{{ $medicine->category ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Manufacturer</p>
                        <p class="fw-medium">{{ $medicine->manufacturer ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Expiry Date</p>
                        <p class="fw-medium">{{ optional($medicine->expiry_date)->format('d M, Y') ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Reorder Level</p>
                        <p class="fw-medium">{{ $medicine->reorder_level }} {{ $medicine->unit }}(s)</p>
                    </div>
                </div>

                <a href="{{ route('admin.pharmacy.edit', $medicine) }}" class="btn btn-light">Edit Details</a>
            </div><!--end card-body-->
        </div><!--end card-->

        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Stock History</h5>
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Patient</th>
                                <th>By</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d M, h:i A') }}</td>
                                    <td>
                                        <span class="badge {{ $log->type === 'Restock' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ $log->type }}</span>
                                    </td>
                                    <td>{{ $log->quantity > 0 ? '+' : '' }}{{ $log->quantity }}</td>
                                    <td>{{ $log->patient->name ?? '-' }}</td>
                                    <td>{{ $log->user->name ?? '-' }}</td>
                                    <td>{{ $log->notes ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No stock movements recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->
                <div class="mt-3">
                    {{ $logs->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Restock</h5>
                <form action="{{ route('admin.pharmacy.restock', $medicine) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="restock_quantity">Quantity Received</label>
                        <input type="number" min="1" class="form-control" id="restock_quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="restock_notes">Notes</label>
                        <input type="text" class="form-control" id="restock_notes" name="notes" placeholder="e.g. Supplier invoice #123">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Add Stock</button>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->

        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Dispense</h5>
                @if ($medicine->stock_quantity < 1)
                    <p class="text-muted mb-0">No stock available to dispense.</p>
                @else
                    <form action="{{ route('admin.pharmacy.dispense', $medicine) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="dispense_quantity">Quantity</label>
                            <input type="number" min="1" max="{{ $medicine->stock_quantity }}" class="form-control" id="dispense_quantity" name="quantity" required>
                            <small class="text-muted">Available: {{ $medicine->stock_quantity }} {{ $medicine->unit }}(s)</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="dispense_patient">Patient <span class="text-muted">(optional)</span></label>
                            <select class="form-select" id="dispense_patient" name="patient_id">
                                <option value="">Not linked to a patient</option>
                                @foreach (\App\Models\Patient::orderBy('name')->get() as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }} ({{ $patient->patient_id }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="dispense_notes">Notes</label>
                            <input type="text" class="form-control" id="dispense_notes" name="notes">
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Dispense</button>
                    </form>
                @endif
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
