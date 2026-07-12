@extends('layouts.backend')

@section('title', 'Edit Duty Log')
@section('page-title', 'Edit Duty Log')

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.duty-logs.update', $dutyLog) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label" for="user_id">Staff Member</label>
                        <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                            @foreach ($staff as $member)
                                <option value="{{ $member->id }}" {{ (string) old('user_id', $dutyLog->user_id) === (string) $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->roles->first()->name ?? 'No role' }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="location">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location', $dutyLog->location) }}">
                        @error('location') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="task">Task</label>
                        <input type="text" class="form-control @error('task') is-invalid @enderror" id="task" name="task" value="{{ old('task', $dutyLog->task) }}">
                        @error('task') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="started_at">Start Time</label>
                        <input type="datetime-local" class="form-control @error('started_at') is-invalid @enderror" id="started_at" name="started_at" value="{{ old('started_at', $dutyLog->started_at->format('Y-m-d\TH:i')) }}">
                        @error('started_at') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            @foreach (['Ongoing', 'Completed'] as $option)
                                <option value="{{ $option }}" {{ old('status', $dutyLog->status) === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes', $dutyLog->notes) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.duty-logs.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
