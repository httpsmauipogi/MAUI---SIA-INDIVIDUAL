@extends('layouts.backend')

@section('title', 'Order Lab Test')
@section('page-title', 'Order Lab Test')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.lab-orders.store') }}">
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
                            <label class="form-label" for="doctor_id">Referring Doctor <span class="text-muted">(optional)</span></label>
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
                            <label class="form-label" for="lab_test_id">Test</label>
                            <select class="form-select @error('lab_test_id') is-invalid @enderror" id="lab_test_id" name="lab_test_id">
                                <option value="">Select test</option>
                                @foreach ($labTests as $test)
                                    <option value="{{ $test->id }}" {{ (string) old('lab_test_id') === (string) $test->id ? 'selected' : '' }}>
                                        {{ $test->name }} ({{ number_format($test->price, 2) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('lab_test_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            @if ($labTests->isEmpty())
                                <small class="text-muted">No active tests in the catalog. <a href="{{ route('admin.lab-tests.create') }}">Add one first</a>.</small>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="ordered_date">Ordered Date</label>
                            <input type="date" class="form-control @error('ordered_date') is-invalid @enderror" id="ordered_date" name="ordered_date" value="{{ old('ordered_date', now()->format('Y-m-d')) }}">
                            @error('ordered_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Create Order</button>
                        <a href="{{ route('admin.lab-orders.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
