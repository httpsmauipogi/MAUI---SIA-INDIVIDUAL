@extends('layouts.backend')

@section('title', $admission->admission_no)
@section('page-title', 'Admission Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $admission->admission_no }}</h4>
                        <p class="text-muted mb-0">Admitted: {{ $admission->admission_date->format('d M, Y h:i A') }}</p>
                    </div>
                    <span class="badge {{ $admission->status === 'Admitted' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' }} fs-13">{{ $admission->status }}</span>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Patient</p>
                        <p class="fw-medium"><a href="{{ route('admin.patients.show', $admission->patient) }}">{{ $admission->patient->name ?? 'N/A' }}</a></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Attending Doctor</p>
                        <p class="fw-medium">{{ $admission->doctor ? 'Dr. ' . $admission->doctor->name : '-' }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Bed</p>
                        <p class="fw-medium">{{ $admission->bed->bed_number ?? '-' }} &middot; {{ $admission->bed->ward ?? '-' }}
                            @if ($admission->bed?->floor) (Floor {{ $admission->bed->floor }}) @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <p class="text-muted mb-1">Length of Stay</p>
                        <p class="fw-medium">{{ $admission->lengthOfStay() }} day(s)</p>
                    </div>
                    @if ($admission->expected_discharge_date)
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mb-1">Expected Discharge</p>
                            <p class="fw-medium">{{ $admission->expected_discharge_date->format('d M, Y') }}</p>
                        </div>
                    @endif
                    @if ($admission->discharge_date)
                        <div class="col-md-6 mb-3">
                            <p class="text-muted mb-1">Actual Discharge</p>
                            <p class="fw-medium">{{ $admission->discharge_date->format('d M, Y h:i A') }}</p>
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <p class="text-muted mb-1">Reason for Admission</p>
                    <p class="fw-medium">{{ $admission->reason }}</p>
                </div>

                @if ($admission->diagnosis)
                    <div class="mb-4">
                        <p class="text-muted mb-1">Diagnosis</p>
                        <p style="white-space: pre-line;">{{ $admission->diagnosis }}</p>
                    </div>
                @endif

                @if ($admission->discharge_notes)
                    <div class="mb-4">
                        <p class="text-muted mb-1">Discharge Notes</p>
                        <p style="white-space: pre-line;">{{ $admission->discharge_notes }}</p>
                    </div>
                @endif

                <div class="d-flex gap-2">
                    @if ($admission->status === 'Admitted')
                        <a href="{{ route('admin.admissions.edit', $admission) }}" class="btn btn-primary">Edit</a>
                    @endif
                    <a href="{{ route('admin.admissions.index') }}" class="btn btn-light">Back to List</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    @if ($admission->status === 'Admitted')
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Discharge Patient</h5>
                    <form action="{{ route('admin.admissions.discharge', $admission) }}" method="POST" onsubmit="return confirm('Discharge this patient and free bed {{ $admission->bed->bed_number ?? '' }}?');">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="discharge_notes">Discharge Notes <span class="text-muted">(optional)</span></label>
                            <textarea class="form-control" id="discharge_notes" name="discharge_notes" rows="4" placeholder="Condition at discharge, follow-up instructions..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Discharge Patient</button>
                    </form>
                </div><!--end card-body-->
            </div><!--end card-->
        </div><!--end col-->
    @endif
</div><!--end row-->
@endsection
