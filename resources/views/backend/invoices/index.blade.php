@extends('layouts.backend')

@section('title', 'Invoices')
@section('page-title', 'Invoices')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.invoices.index') }}" class="d-flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search invoice no. or patient" style="max-width: 240px;">
                        <select name="status" class="form-select" style="max-width: 160px;">
                            <option value="">All Status</option>
                            @foreach (['Unpaid', 'Partial', 'Paid'] as $option)
                                <option value="{{ $option }}" {{ request('status') === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-search"></i></button>
                        @if (request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.invoices.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> New Invoice
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->patient->name ?? 'N/A' }}</td>
                                    <td>{{ $invoice->invoice_date->format('d M, Y') }}</td>
                                    <td>{{ number_format($invoice->total, 2) }}</td>
                                    <td>{{ number_format($invoice->paid_amount, 2) }}</td>
                                    <td>{{ number_format($invoice->due_amount, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($invoice->status) {
                                                'Paid' => 'bg-success-subtle text-success',
                                                'Partial' => 'bg-warning-subtle text-warning',
                                                default => 'bg-danger-subtle text-danger',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $invoice->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.invoices.show', $invoice) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.invoices.edit', $invoice) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.invoices.destroy', $invoice) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this invoice?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No invoices found. <a href="{{ route('admin.invoices.create') }}">Create the first invoice</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $invoices->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
