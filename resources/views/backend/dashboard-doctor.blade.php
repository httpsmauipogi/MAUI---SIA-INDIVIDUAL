@extends('layouts.backend')

@section('title', 'Doctor Dashboard')
@section('page-title', 'My Dashboard')

@section('content')

@if (! $doctor)
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <p class="text-muted mb-0">Your login isn't linked to a Doctor profile yet. Ask a Super Admin or Hospital Admin to link your account from Doctors → Edit.</p>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Today's Patients</p>
                    <h4 class="mt-1 mb-0 fw-medium">{{ $todayAppointments->count() }}</h4>
                </div>
            </div>
        </div>
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
                    <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Status</p>
                    <h4 class="mt-1 mb-0 fw-medium">{{ $doctor->status }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Today's Patients &middot; {{ now()->format('d M, Y') }}</h5>
                        <a href="{{ route('admin.my-patients') }}" class="btn btn-sm btn-soft-primary">View Full List</a>
                    </div>
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
                                        <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
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
                                            <a href="{{ route('admin.patients.show', $appointment->patient) }}" class="btn btn-sm btn-soft-info">View</a>
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
@endif

@endsection
