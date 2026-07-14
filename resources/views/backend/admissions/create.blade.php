@extends('layouts.backend')

@section('title', 'Admit Patient')
@section('page-title', 'Admit Patient')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.admissions.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="patient_id">Patient</label>
                            <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id">
                                <option value="">Select patient</option>
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ (string) old('patient_id') === (string) $patient->id ? 'selected' : '' }}>
                                        {{ $patient->name }} ({{ $patient->patient_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('patient_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="doctor_id">Attending Doctor <span class="text-muted">(optional)</span></label>
                            <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id">
                                <option value="">None</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ (string) old('doctor_id') === (string) $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="bed_id">Bed</label>
                            <select class="form-select @error('bed_id') is-invalid @enderror" id="bed_id" name="bed_id">
                                <option value="">Select an available bed</option>
                                @foreach ($beds as $bed)
                                    <option value="{{ $bed->id }}" {{ (string) old('bed_id', $selectedBedId) === (string) $bed->id ? 'selected' : '' }}>
                                        {{ $bed->bed_number }} - {{ $bed->ward }} {{ $bed->floor ? '(Floor ' . $bed->floor . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bed_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            @if ($beds->isEmpty())
                                <small class="text-danger">No beds are currently available. <a href="{{ route('admin.beds.create') }}">Add a bed</a> or free one up first.</small>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="admission_date">Admission Date &amp; Time</label>
                            <input type="datetime-local" class="form-control @error('admission_date') is-invalid @enderror" id="admission_date" name="admission_date" value="{{ old('admission_date', now()->format('Y-m-d\TH:i')) }}">
                            @error('admission_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="expected_discharge_date">Expected Discharge Date <span class="text-muted">(optional)</span></label>
                            <input type="date" class="form-control @error('expected_discharge_date') is-invalid @enderror" id="expected_discharge_date" name="expected_discharge_date" value="{{ old('expected_discharge_date') }}">
                            @error('expected_discharge_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="reason">Reason for Admission</label>
                            <input type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" value="{{ old('reason') }}" placeholder="e.g. Post-surgery observation">
                            @error('reason') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="diagnosis">Diagnosis <span class="text-muted">(optional)</span></label>
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3">{{ old('diagnosis') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary" {{ $beds->isEmpty() ? 'disabled' : '' }}>Admit Patient</button>
                        <a href="{{ route('admin.admissions.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
