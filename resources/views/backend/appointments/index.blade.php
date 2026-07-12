@extends('layouts.backend')

@section('title', 'Appointments')
@section('page-title', 'Appointments')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.appointments.index') }}" class="d-flex flex-wrap gap-2">
                        <input type="date" name="date" value="{{ request('date') }}" class="form-control" style="max-width: 180px;">
                        <select name="status" class="form-select" style="max-width: 160px;">
                            <option value="">All Status</option>
                            @foreach (['Scheduled', 'Completed', 'Cancelled'] as $option)
                                <option value="{{ $option }}" {{ request('status') === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-filter"></i> Filter</button>
                        @if (request()->hasAny(['date', 'status']))
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> New Appointment
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Appointment No</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->appointment_no }}</td>
                                    <td>{{ $appointment->patient->name ?? 'N/A' }}</td>
                                    <td>Dr. {{ $appointment->doctor->name ?? 'N/A' }}</td>
                                    <td>{{ $appointment->appointment_date->format('d M, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
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
                                        <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Cancel and delete this appointment?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No appointments found. <a href="{{ route('admin.appointments.create') }}">Book the first appointment</a>.</td>
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
