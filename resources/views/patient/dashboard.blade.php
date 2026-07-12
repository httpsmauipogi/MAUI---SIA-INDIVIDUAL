@extends('layouts.patient')

@section('title', 'My Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

<div class="row">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-1">Welcome back, {{ $patient->name }}</h5>
                <p class="text-muted mb-0">Patient ID: {{ $patient->patient_id }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Upcoming Appointments</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $upcomingAppointments->count() }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Prescriptions</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $recentPrescriptionsCount }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Outstanding Balance</p>
                <h4 class="mt-1 mb-0 fw-medium {{ $dueInvoicesTotal > 0 ? 'text-danger' : 'text-success' }}">{{ number_format($dueInvoicesTotal, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Upcoming Appointments</h5>
                    <a href="{{ route('frontend.appointment') }}" class="btn btn-sm btn-primary">Book New Appointment</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Doctor</th>
                                <th>Reason</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($upcomingAppointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_date->format('d M, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                    <td>Dr. {{ $appointment->doctor->name ?? 'N/A' }}</td>
                                    <td>{{ $appointment->reason ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">No upcoming appointments. <a href="{{ route('frontend.appointment') }}">Book one now</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
