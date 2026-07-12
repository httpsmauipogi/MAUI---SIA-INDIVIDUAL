@extends('layouts.backend')

@section('title', $labOrder->order_no)
@section('page-title', 'Lab Order Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $labOrder->order_no }}</h4>
                        <p class="text-muted mb-0">Ordered: {{ $labOrder->ordered_date->format('d M, Y') }}</p>
                    </div>
                    @php
                        $statusClass = match ($labOrder->status) {
                            'Completed' => 'bg-success-subtle text-success',
                            'Cancelled' => 'bg-danger-subtle text-danger',
                            'Pending' => 'bg-secondary-subtle text-secondary',
                            default => 'bg-info-subtle text-info',
                        };
                    @endphp
                    <span class="badge {{ $statusClass }} fs-13">{{ $labOrder->status }}</span>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Patient</p>
                        <p class="fw-medium"><a href="{{ route('admin.patients.show', $labOrder->patient) }}">{{ $labOrder->patient->name ?? 'N/A' }}</a></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Referring Doctor</p>
                        <p class="fw-medium">{{ $labOrder->doctor ? 'Dr. ' . $labOrder->doctor->name : '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Test</p>
                        <p class="fw-medium">{{ $labOrder->labTest->name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Price</p>
                        <p class="fw-medium">{{ number_format($labOrder->price, 2) }}</p>
                    </div>
                    @if ($labOrder->sample_collected_at)
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mb-1">Sample Collected</p>
                            <p class="fw-medium">{{ $labOrder->sample_collected_at->format('d M, Y h:i A') }}</p>
                        </div>
                    @endif
                    @if ($labOrder->result_date)
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mb-1">Result Date</p>
                            <p class="fw-medium">{{ $labOrder->result_date->format('d M, Y h:i A') }}</p>
                        </div>
                    @endif
                </div>

                @if ($labOrder->result_notes)
                    <div class="mb-4">
                        <p class="text-muted mb-1">Result Notes</p>
                        <p style="white-space: pre-line;">{{ $labOrder->result_notes }}</p>
                    </div>
                @endif

                @if ($labOrder->result_file)
                    <div class="mb-4">
                        <a href="{{ asset('storage/' . $labOrder->result_file) }}" target="_blank" class="btn btn-outline-secondary">
                            <i class="las la-file-download"></i> View Result File
                        </a>
                    </div>
                @endif

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.lab-orders.edit', $labOrder) }}" class="btn btn-primary">Update Status / Result</a>
                    <a href="{{ route('admin.lab-orders.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
