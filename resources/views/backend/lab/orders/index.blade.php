@extends('layouts.backend')

@section('title', 'Lab Test Orders')
@section('page-title', 'Lab Test Orders')

@section('content')

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Pending</p>
                <h4 class="mt-1 mb-0 fw-medium text-warning">{{ $counts['pending'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">In Progress</p>
                <h4 class="mt-1 mb-0 fw-medium text-info">{{ $counts['processing'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Completed Today</p>
                <h4 class="mt-1 mb-0 fw-medium text-success">{{ $counts['completedToday'] }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.lab-orders.index') }}" class="d-flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search order no. or patient" style="max-width: 240px;">
                        <select name="status" class="form-select" style="max-width: 170px;">
                            <option value="">All Status</option>
                            @foreach (['Pending', 'Sample Collected', 'Processing', 'Completed', 'Cancelled'] as $option)
                                <option value="{{ $option }}" {{ request('status') === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-filter"></i></button>
                        @if (request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.lab-orders.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.lab-tests.index') }}" class="btn btn-outline-secondary">Test Catalog</a>
                        <a href="{{ route('admin.lab-orders.create') }}" class="btn btn-primary">
                            <i class="las la-plus me-1"></i> Order Test
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Patient</th>
                                <th>Test</th>
                                <th>Ordered Date</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->patient->name ?? 'N/A' }}</td>
                                    <td>{{ $order->labTest->name ?? 'N/A' }}</td>
                                    <td>{{ $order->ordered_date->format('d M, Y') }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($order->status) {
                                                'Completed' => 'bg-success-subtle text-success',
                                                'Cancelled' => 'bg-danger-subtle text-danger',
                                                'Pending' => 'bg-secondary-subtle text-secondary',
                                                default => 'bg-info-subtle text-info',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $order->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.lab-orders.show', $order) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <form action="{{ route('admin.lab-orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this lab order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No lab orders yet. <a href="{{ route('admin.lab-orders.create') }}">Order the first test</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $orders->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
