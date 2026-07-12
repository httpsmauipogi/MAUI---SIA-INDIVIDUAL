@extends('layouts.backend')

@section('title', 'Prescription ' . $prescription->prescription_no)
@section('page-title', 'Prescription Details')

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
                    <div>
                        <h4 class="mb-1">Dr. {{ $prescription->doctor->name ?? 'N/A' }}</h4>
                        <p class="text-muted mb-0">{{ $prescription->doctor->specialization ?? '' }} &middot; {{ $prescription->doctor->qualification ?? '' }}</p>
                    </div>
                    <div class="text-end">
                        <h5 class="mb-1">{{ $prescription->prescription_no }}</h5>
                        <p class="text-muted mb-0">{{ $prescription->prescription_date->format('d M, Y') }}</p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <p class="text-muted mb-1">Patient</p>
                        <p class="fw-medium mb-0">
                            <a href="{{ route('admin.patients.show', $prescription->patient) }}">{{ $prescription->patient->name ?? 'N/A' }}</a>
                        </p>
                        <p class="text-muted mb-0">
                            {{ $prescription->patient->patient_id ?? '' }}
                            @if ($prescription->patient?->gender) &middot; {{ $prescription->patient->gender }} @endif
                            @if ($prescription->patient?->date_of_birth) &middot; {{ $prescription->patient->date_of_birth->age }} yrs @endif
                        </p>
                    </div>
                    @if ($prescription->follow_up_date)
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Follow-up Date</p>
                            <p class="fw-medium">{{ $prescription->follow_up_date->format('d M, Y') }}</p>
                        </div>
                    @endif
                </div>

                @if ($prescription->diagnosis)
                    <div class="mb-4">
                        <p class="text-muted mb-1">Diagnosis</p>
                        <p class="fw-medium">{{ $prescription->diagnosis }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <h5 class="mb-3">℞ Medicines</h5>
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>Medicine</th>
                                    <th>Dosage</th>
                                    <th>Frequency</th>
                                    <th>Duration</th>
                                    <th>Instructions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prescription->medicines as $medicine)
                                    <tr>
                                        <td class="fw-medium">{{ $medicine['name'] }}</td>
                                        <td>{{ $medicine['dosage'] ?? '-' }}</td>
                                        <td>{{ $medicine['frequency'] ?? '-' }}</td>
                                        <td>{{ $medicine['duration'] ?? '-' }}</td>
                                        <td>{{ $medicine['instructions'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!--end table-responsive-->
                </div>

                @if ($prescription->advice)
                    <div class="mb-4">
                        <p class="text-muted mb-1">Advice</p>
                        <p>{{ $prescription->advice }}</p>
                    </div>
                @endif

                <div class="d-flex gap-2 mt-4 d-print-none">
                    <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-light">Back to List</a>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.print()">Print</button>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
