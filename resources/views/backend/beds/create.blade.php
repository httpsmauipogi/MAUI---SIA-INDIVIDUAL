@extends('layouts.backend')

@section('title', 'Add Bed')
@section('page-title', 'Add Bed')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.beds.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="bed_number">Bed Number</label>
                        <input type="text" class="form-control @error('bed_number') is-invalid @enderror" id="bed_number" name="bed_number" value="{{ old('bed_number') }}" placeholder="e.g. A-101">
                        @error('bed_number') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="ward">Ward</label>
                        <input type="text" class="form-control @error('ward') is-invalid @enderror" id="ward" name="ward" value="{{ old('ward') }}" placeholder="e.g. General Ward, ICU, Cabin">
                        @error('ward') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="floor">Floor <span class="text-muted">(optional)</span></label>
                        <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor') }}">
                        @error('floor') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Bed</button>
                        <a href="{{ route('admin.beds.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
