@extends('layouts.backend')

@section('title', 'Add Staff')
@section('page-title', 'Add Staff')

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                    @csrf

                    <h5 class="card-title mb-3">Profile Photo</h5>
                    <div class="row mb-4">
                        <div class="col-md-3 text-center">
                            <img id="avatar-preview" src="https://ui-avatars.com/api/?name=New+Staff&background=e9ecef&color=6c757d" class="rounded-circle mb-2" width="90" height="90" style="object-fit:cover;">
                        </div>
                        <div class="col-md-9 d-flex align-items-center">
                            <div class="w-100">
                                <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" accept="image/*" onchange="document.getElementById('avatar-preview').src = URL.createObjectURL(this.files[0])">
                                <small class="text-muted">Optional. JPG/PNG up to 2MB.</small>
                                @error('avatar') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <h5 class="card-title mb-3">Account Details</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Full Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                            @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="role">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                                <option value="">Select role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                            @error('email') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <h5 class="card-title mb-3 mt-2">Employment Details</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="designation">Designation</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation') }}" placeholder="e.g. Senior Nurse">
                            @error('designation') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="department">Department</label>
                            <input type="text" class="form-control @error('department') is-invalid @enderror" id="department" name="department" value="{{ old('department') }}" placeholder="e.g. Cardiology">
                            @error('department') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="branch_id">Branch</label>
                            <select class="form-control @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id">
                                <option value="">-- Select Branch --</option>
                                @foreach ($branches as $id => $branchName)
                                    <option value="{{ $id }}" {{ (string) old('branch_id') === (string) $id ? 'selected' : '' }}>{{ $branchName }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="joining_date">Joining Date</label>
                            <input type="date" class="form-control @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ old('joining_date') }}">
                            @error('joining_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="Active" {{ old('status', 'Active') === 'Active' ? 'selected' : '' }}>Active</option>
                                <option value="Inactive" {{ old('status') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <h5 class="card-title mb-3 mt-2">Personal Details</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="gender">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                <option value="">Select</option>
                                <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="date_of_birth">Date of Birth</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="blood_group">Blood Group</label>
                            <input type="text" class="form-control @error('blood_group') is-invalid @enderror" id="blood_group" name="blood_group" value="{{ old('blood_group') }}" placeholder="e.g. O+">
                            @error('blood_group') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="address">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2">{{ old('address') }}</textarea>
                            @error('address') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Staff Member</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
