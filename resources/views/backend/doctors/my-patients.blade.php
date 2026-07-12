@extends('layouts.backend')

@section('title', 'My Patients')
@section('page-title', 'My Patients')

@section('content')

@if (! $doctor)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <p class="text-muted mb-0">Your login account isn't linked to a Doctor profile yet. Ask a Super Admin or Hospital Admin to link your account from Doctors → Edit.</p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Today's Patients &middot; {{ now()->format('d M, Y') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($todayAppointments as $appointment)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                        <td>{{ $appointment->patient->name ?? 'N/A' }} <small class="text-muted">({{ $appointment->patient->patient_id ?? '' }})</small></td>
                                        <td>{{ $appointment->reason ?? '-' }}</td>
                                        <td>
                                            @php
                                                $statusClass = match ($appointment->status) {
                                                    'Scheduled' => 'bg-info-subtle text-info',
                                                    'Completed' => 'bg-success-subtle text-success',
                                                    default => 'bg-danger-subtle text-danger',
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $appointment->status }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('admin.patients.show', $appointment->patient) }}" class="btn btn-sm btn-soft-info me-1">View Patient</a>
                                            <a href="{{ route('admin.prescriptions.create') }}" class="btn btn-sm btn-soft-primary">Write Rx</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">No patients scheduled for you today.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--end table-responsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Upcoming Appointments</h5>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($upcomingAppointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->appointment_date->format('d M, Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                                        <td>{{ $appointment->reason ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">No upcoming appointments.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--end table-responsive-->
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    </div><!--end row-->
@endif

@endsection
