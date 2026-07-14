@extends('layouts.backend')

@section('title', 'Doctor Details')
@section('page-title', 'Doctor Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ $doctor->photoUrl() }}" alt="{{ $doctor->name }}" class="rounded-circle" width="64" height="64" style="object-fit: cover;">
                        <div>
                            <h4 class="mb-1">Dr. {{ $doctor->name }}</h4>
                            <p class="text-muted mb-0">{{ $doctor->doctor_id }} &middot; {{ $doctor->specialization }}</p>
                        </div>
                    </div>
                    @php
                        $statusClass = match ($doctor->status) {
                            'Active' => 'bg-success-subtle text-success',
                            'On Leave' => 'bg-warning-subtle text-warning',
                            default => 'bg-danger-subtle text-danger',
                        };
                    @endphp
                    <span class="badge {{ $statusClass }} fs-13">{{ $doctor->status }}</span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Qualification</p>
                        <p class="fw-medium">{{ $doctor->qualification ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Experience</p>
                        <p class="fw-medium">{{ $doctor->experience_years ? $doctor->experience_years . ' years' : '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Phone</p>
                        <p class="fw-medium">{{ $doctor->phone ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Email</p>
                        <p class="fw-medium">{{ $doctor->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Consultation Fee</p>
                        <p class="fw-medium">{{ $doctor->consultation_fee ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Location</p>
                        <p class="fw-medium">
                            {{ $doctor->branch ?? '-' }}
                            @if ($doctor->floor) &middot; Floor {{ $doctor->floor }} @endif
                            @if ($doctor->room_no) &middot; Room {{ $doctor->room_no }} @endif
                        </p>
                    </div>
                </div>

                <p class="text-muted mb-1">Weekly Schedule</p>
                @if ($doctor->schedules->isEmpty())
                    <p class="fw-medium text-muted">No schedule slots set yet.</p>
                @else
                    <div class="table-responsive mb-3">
                        <table class="table table-sm table-centered mb-0">
                            <thead>
                                <tr><th>Day</th><th>Time</th></tr>
                            </thead>
                            <tbody>
                                @foreach ($doctor->schedules as $slot)
                                    <tr><td>{{ $slot->day_of_week }}</td><td>{{ $slot->formattedTime() }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
