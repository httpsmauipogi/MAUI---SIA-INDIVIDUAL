@extends('layouts.backend')

@section('title', 'Assign Duty')
@section('page-title', 'Assign Duty')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.duty-logs.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label" for="user_id">Staff Member</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            <option value="">Select staff</option>
                            @foreach ($staff as $member)
                                <option value="{{ $member->id }}" {{ (string) old('user_id') === (string) $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->roles->first()->name ?? 'No role' }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        @if ($staff->isEmpty())
                            <small class="text-muted">No Nurse/Ward Boy/Cleaner staff accounts found. <a href="{{ route('admin.users.create') }}">Add staff first</a>.</small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" placeholder="e.g. Ward A, ICU, Reception">
                        @error('location') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="task">Task</label>
                        <input type="text" class="form-control @error('task') is-invalid @enderror" id="task" name="task" value="{{ old('task') }}" placeholder="e.g. Patient vitals check, Room cleaning">
                        @error('task') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="started_at">Start Time</label>
                        <input type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" id="started_at" name="started_at" value="{{ old('started_at', now()->format('Y-m-d\TH:i')) }}">
                        @error('started_at') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="notes">Notes <span class="text-muted">(optional)</span></label>
                        <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Assign Duty</button>
                        <a href="{{ route('admin.duty-logs.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
