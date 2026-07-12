@extends('layouts.backend')

@section('title', 'Doctor Details')
@section('page-title', 'Doctor Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">Dr. {{ $doctor->name }}</h4>
                        <p class="text-muted mb-0">{{ $doctor->doctor_id }} &middot; {{ $doctor->specialization }}</p>
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
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.doctors.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
