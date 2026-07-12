@extends('layouts.backend')

@section('title', 'Update Lab Order')
@section('page-title', 'Update Lab Order')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h5 class="mb-1">{{ $labOrder->order_no }}</h5>
                    <p class="text-muted mb-0">{{ $labOrder->patient->name ?? 'N/A' }} &middot; {{ $labOrder->labTest->name ?? 'N/A' }}</p>
                </div>

                <form method="POST" action="{{ route('admin.lab-orders.update', $labOrder) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            @foreach (['Pending', 'Sample Collected', 'Processing', 'Completed', 'Cancelled'] as $option)
                                <option value="{{ $option }}" {{ old('status', $labOrder->status) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="result_notes">Result Notes</label>
                        <textarea class="form-control @error('result_notes') is-invalid @enderror" id="result_notes" name="result_notes" rows="5">{{ old('result_notes', $labOrder->result_notes) }}</textarea>
                        @error('result_notes') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="result_file">Result File <span class="text-muted">(optional, PDF/image)</span></label>
                        <input type="file" class="form-control @error('result_file') is-invalid @enderror" id="result_file" name="result_file">
                        @error('result_file') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        @if ($labOrder->result_file)
                            <small class="text-muted d-block mt-1">Current file: <a href="{{ asset('storage/' . $labOrder->result_file) }}" target="_blank">View uploaded file</a></small>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('admin.lab-orders.show', $labOrder) }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
