@extends('layouts.backend')

@section('title', 'Edit Admission')
@section('page-title', 'Edit Admission')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.admissions.update', $admission) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="doctor_id">Attending Doctor</label>
                            <select class="form-select @error('doctor_id') is-invalid @enderror" id="doctor_id" name="doctor_id">
                                <option value="">None</option>
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ (string) old('doctor_id', $admission->doctor_id) === (string) $doctor->id ? 'selected' : '' }}>
                                        Dr. {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('doctor_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="expected_discharge_date">Expected Discharge Date</label>
                            <input type="date" class="form-control @error('expected_discharge_date') is-invalid @enderror" id="expected_discharge_date" name="expected_discharge_date" value="{{ old('expected_discharge_date', optional($admission->expected_discharge_date)->format('Y-m-d')) }}">
                            @error('expected_discharge_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="reason">Reason for Admission</label>
                            <input type="text" class="form-control @error('reason') is-invalid @enderror" id="reason" name="reason" value="{{ old('reason', $admission->reason) }}">
                            @error('reason') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="diagnosis">Diagnosis</label>
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="4">{{ old('diagnosis', $admission->diagnosis) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.admissions.show', $admission) }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
