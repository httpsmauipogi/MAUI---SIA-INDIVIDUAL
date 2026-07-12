@extends('layouts.backend')

@section('title', 'Patient Details')
@section('page-title', 'Patient Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $patient->name }}</h4>
                        <p class="text-muted mb-0">Patient ID: {{ $patient->patient_id }}</p>
                    </div>
                    <span class="badge {{ $patient->status === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} fs-13">
                        {{ $patient->status }}
                    </span>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Gender</p>
                        <p class="fw-medium">{{ $patient->gender }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Date of Birth</p>
                        <p class="fw-medium">{{ optional($patient->date_of_birth)->format('d M, Y') ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Blood Group</p>
                        <p class="fw-medium">{{ $patient->blood_group ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Phone</p>
                        <p class="fw-medium">{{ $patient->phone ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Email</p>
                        <p class="fw-medium">{{ $patient->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Guardian</p>
                        <p class="fw-medium">{{ $patient->guardian_name ?? '-' }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <p class="text-muted mb-1">Address</p>
                        <p class="fw-medium">{{ $patient->address ?? '-' }}</p>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.patients.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
