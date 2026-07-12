@extends('layouts.patient')

@section('title', 'My Invoices')
@section('page-title', 'My Invoices')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Due</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->invoice_no }}</td>
                                    <td>{{ $invoice->invoice_date->format('d M, Y') }}</td>
                                    <td>{{ number_format($invoice->total, 2) }}</td>
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
                                        <a href="{{ route('patient.invoices.show', $invoice) }}" class="btn btn-sm btn-soft-info">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No invoices on file yet.</td>
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
