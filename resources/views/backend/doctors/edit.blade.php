@extends('layouts.backend')

@section('title', 'Edit Doctor')
@section('page-title', 'Edit Doctor')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.doctors.update', $doctor) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="user_id">Link to Login Account <span class="text-muted">(optional)</span></label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                                <option value="">Not linked</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ (string) old('user_id', $doctor->user_id) === (string) $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            <small class="text-muted">Linking lets this doctor log in and see their own patients under "My Patients".</small>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="photo">Photo</label>
                            @if ($doctor->photo)
                                <div class="mb-2"><img src="{{ $doctor->photoUrl() }}" alt="{{ $doctor->name }}" height="70" class="rounded"></div>
                            @endif
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                            @error('photo') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            <small class="text-muted">Leave blank to keep the current photo.</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $doctor->name) }}">
                            @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="specialization">Specialization</label>
                            <input type="text" class="form-control @error('specialization') is-invalid @enderror" id="specialization" name="specialization" value="{{ old('specialization', $doctor->specialization) }}">
                            @error('specialization') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="qualification">Qualification</label>
                            <input type="text" class="form-control @error('qualification') is-invalid @enderror" id="qualification" name="qualification" value="{{ old('qualification', $doctor->qualification) }}">
                            @error('qualification') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="experience_years">Experience (Years)</label>
                            <input type="number" min="0" class="form-control @error('experience_years') is-invalid @enderror" id="experience_years" name="experience_years" value="{{ old('experience_years', $doctor->experience_years) }}">
                            @error('experience_years') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $doctor->phone) }}">
                            @error('phone') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $doctor->email) }}">
                            @error('email') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="consultation_fee">Consultation Fee</label>
                            <input type="text" class="form-control @error('consultation_fee') is-invalid @enderror" id="consultation_fee" name="consultation_fee" value="{{ old('consultation_fee', $doctor->consultation_fee) }}">
                            @error('consultation_fee') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                @foreach (['Active', 'On Leave', 'Inactive'] as $option)
                                    <option value="{{ $option }}" {{ old('status', $doctor->status) === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="branch_id">Branch</label>
                            <select class="form-control @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id">
                                <option value="">-- Select Branch --</option>
                                @foreach ($branches as $id => $branchName)
                                    <option value="{{ $id }}" {{ (string) old('branch_id', $doctor->branch_id) === (string) $id ? 'selected' : '' }}>{{ $branchName }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="floor">Floor</label>
                            <input type="text" class="form-control @error('floor') is-invalid @enderror" id="floor" name="floor" value="{{ old('floor', $doctor->floor) }}" placeholder="e.g. 3rd Floor">
                            @error('floor') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="room_no">Room No</label>
                            <input type="text" class="form-control @error('room_no') is-invalid @enderror" id="room_no" name="room_no" value="{{ old('room_no', $doctor->room_no) }}" placeholder="e.g. 304">
                            @error('room_no') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Doctor</button>
                        <a href="{{ route('admin.doctors.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Weekly Schedule</h5>

                @forelse ($doctor->schedules as $slot)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <p class="mb-0 fw-medium">{{ $slot->day_of_week }}</p>
                            <small class="text-muted">{{ $slot->formattedTime() }}</small>
                        </div>
                        <form action="{{ route('admin.doctors.schedules.destroy', [$doctor, $slot]) }}" method="POST" onsubmit="return confirm('Remove this schedule slot?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted">No schedule slots added yet. Patients won't see a timetable on the website until you add some below.</p>
                @endforelse

                <form action="{{ route('admin.doctors.schedules.store', $doctor) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label" for="day_of_week">Day</label>
                        <select class="form-select" id="day_of_week" name="day_of_week" required>
                            @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label class="form-label" for="start_time">Start</label>
                            <input type="time" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="col-6 mb-2">
                            <label class="form-label" for="end_time">End</label>
                            <input type="time" class="form-control" id="end_time" name="end_time" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-soft-primary w-100 mt-2">Add Slot</button>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
