@extends('layouts.patient')

@section('title', 'My Appointments')
@section('page-title', 'My Appointments')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Appointment History</h5>
                    <a href="{{ route('frontend.appointment') }}" class="btn btn-sm btn-primary">Book New Appointment</a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Appointment No</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Doctor</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_no }}</td>
                                    <td>{{ $appointment->appointment_date->format('d M, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                    <td>Dr. {{ $appointment->doctor->name ?? 'N/A' }}</td>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">You have no appointments yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $appointments->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
