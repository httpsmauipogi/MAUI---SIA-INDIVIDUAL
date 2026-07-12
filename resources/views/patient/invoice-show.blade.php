@extends('layouts.patient')

@section('title', 'Invoice ' . $invoice->invoice_no)
@section('page-title', 'Invoice Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $invoice->invoice_no }}</h4>
                        <p class="text-muted mb-0">Issued: {{ $invoice->invoice_date->format('d M, Y') }}</p>
                        @if ($invoice->due_date)
                            <p class="text-muted mb-0">Due: {{ $invoice->due_date->format('d M, Y') }}</p>
                        @endif
                    </div>
                    @php
                        $statusClass = match ($invoice->status) {
                            'Paid' => 'bg-success-subtle text-success',
                            'Partial' => 'bg-warning-subtle text-warning',
                            default => 'bg-danger-subtle text-danger',
                        };
                    @endphp
                    <span class="badge {{ $statusClass }} fs-13">{{ $invoice->status }}</span>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->items as $item)
                                <tr>
                                    <td>{{ $item['description'] }}</td>
                                    <td class="text-end">{{ rtrim(rtrim(number_format($item['quantity'], 2), '0'), '.') }}</td>
                                    <td class="text-end">{{ number_format($item['unit_price'], 2) }}</td>
                                    <td class="text-end">{{ number_format($item['quantity'] * $item['unit_price'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="row justify-content-end mt-3">
                    <div class="col-md-5">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal</span>
                            <span>{{ number_format($invoice->subtotal, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Discount</span>
                            <span>-{{ number_format($invoice->discount, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-16 mb-2">
                            <span>Total</span>
                            <span>{{ number_format($invoice->total, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Paid</span>
                            <span class="text-success">{{ number_format($invoice->paid_amount, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Due</span>
                            <span class="{{ $invoice->due_amount > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($invoice->due_amount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 d-print-none">
                    <a href="{{ route('patient.invoices') }}" class="btn btn-light">Back to List</a>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.print()">Print</button>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
