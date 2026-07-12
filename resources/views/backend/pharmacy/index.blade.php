@extends('layouts.backend')

@section('title', 'Pharmacy')
@section('page-title', 'Pharmacy')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Medicines</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $counts['total'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Low Stock</p>
                <h4 class="mt-1 mb-0 fw-medium text-warning">{{ $counts['lowStock'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Out of Stock</p>
                <h4 class="mt-1 mb-0 fw-medium text-danger">{{ $counts['outOfStock'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Expiring Soon (30d)</p>
                <h4 class="mt-1 mb-0 fw-medium text-info">{{ $counts['expiringSoon'] }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.pharmacy.index') }}" class="d-flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search medicine" style="max-width: 220px;">
                        <select name="filter" class="form-select" style="max-width: 170px;">
                            <option value="">All Medicines</option>
                            <option value="low_stock" {{ request('filter') === 'low_stock' ? 'selected' : '' }}>Low Stock</option>
                            <option value="expiring" {{ request('filter') === 'expiring' ? 'selected' : '' }}>Expiring Soon</option>
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-filter"></i> Filter</button>
                        @if (request()->hasAny(['search', 'filter']))
                            <a href="{{ route('admin.pharmacy.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('admin.pharmacy.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Medicine
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Unit Price</th>
                                <th>Expiry</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($medicines as $medicine)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.pharmacy.show', $medicine) }}">{{ $medicine->name }}</a>
                                        @if ($medicine->generic_name)
                                            <br><small class="text-muted">{{ $medicine->generic_name }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $medicine->category ?? '-' }}</td>
                                    <td>
                                        {{ $medicine->stock_quantity }} {{ $medicine->unit }}
                                        @if ($medicine->isLowStock())
                                            <span class="badge bg-warning-subtle text-warning ms-1">Low</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($medicine->unit_price, 2) }}</td>
                                    <td>
                                        {{ optional($medicine->expiry_date)->format('d M, Y') ?? '-' }}
                                        @if ($medicine->isExpiringSoon())
                                            <span class="badge bg-info-subtle text-info ms-1">Soon</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge {{ $medicine->status === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ $medicine->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.pharmacy.show', $medicine) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.pharmacy.edit', $medicine) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.pharmacy.destroy', $medicine) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this medicine?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No medicines in inventory yet. <a href="{{ route('admin.pharmacy.create') }}">Add the first one</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $medicines->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
