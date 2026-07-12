@extends('layouts.backend')

@section('title', 'Edit Bed')
@section('page-title', 'Edit Bed')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.beds.update', $bed) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="bed_number">Bed Number</label>
                        <input type="text" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number" name="bed_number" value="{{ old('bed_number', $bed->bed_number) }}">
                        @error('bed_number') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="ward">Ward</label>
                        <input type="text" class="form-control @error('ward') is-invalid @enderror" id="ward" name="ward" value="{{ old('ward', $bed->ward) }}">
                        @error('ward') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="floor">Floor</label>
                        <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor', $bed->floor) }}">
                        @error('floor') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            @foreach (['Available', 'Occupied', 'Maintenance'] as $option)
                                <option value="{{ $option }}" {{ old('status', $bed->status) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        <small class="text-muted">Changing away from "Occupied" will automatically clear the assigned patient. Use the availability board to assign/discharge patients directly.</small>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Bed</button>
                        <a href="{{ route('admin.beds.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
