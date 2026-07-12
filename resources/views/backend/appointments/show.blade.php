@extends('layouts.backend')

@section('title', 'Appointment Details')
@section('page-title', 'Appointment Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $appointment->appointment_no }}</h4>
                        <p class="text-muted mb-0">{{ $appointment->appointment_date->format('d M, Y') }} at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                    </div>
                    @php
                        $statusClass = match ($appointment->status) {
                            'Scheduled' => 'bg-info-subtle text-info',
                            'Completed' => 'bg-success-subtle text-success',
                            default => 'bg-danger-subtle text-danger',
                        };
                    @endphp
                    <span class="badge {{ $statusClass }} fs-13">{{ $appointment->status }}</span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Patient</p>
                        <p class="fw-medium">
                            <a href="{{ route('admin.patients.show', $appointment->patient) }}">{{ $appointment->patient->name ?? 'N/A' }}</a>
                            ({{ $appointment->patient->patient_id ?? '-' }})
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Doctor</p>
                        <p class="fw-medium">
                            <a href="{{ route('admin.doctors.show', $appointment->doctor) }}">Dr. {{ $appointment->doctor->name ?? 'N/A' }}</a>
                            &middot; {{ $appointment->doctor->specialization ?? '-' }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Reason for Visit</p>
                        <p class="fw-medium">{{ $appointment->reason ?? '-' }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="text-muted mb-1">Notes</p>
                        <p class="fw-medium">{{ $appointment->notes ?? '-' }}</p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
