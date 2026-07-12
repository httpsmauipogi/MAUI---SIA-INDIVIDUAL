@extends('layouts.backend')

@section('title', 'Staff Profile')
@section('page-title', 'Staff Profile')

@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <img src="{{ $user->avatar_url }}" class="rounded-circle mb-3" width="110" height="110" style="object-fit:cover;">
                <h5 class="mb-0">{{ $user->name }}</h5>
                <p class="text-muted mb-2">{{ $user->designation ?? 'Staff' }}{{ $user->department ? ' · ' . $user->department : '' }}</p>
                @foreach ($user->roles as $role)
                    <span class="badge bg-primary-subtle text-primary">{{ $role->name }}</span>
                @endforeach
                @if ($user->status === 'Active')
                    <span class="badge bg-success-subtle text-success">Active</span>
                @else
                    <span class="badge bg-danger-subtle text-danger">Inactive</span>
                @endif

                <div class="d-flex justify-content-center gap-2 mt-3">
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-primary"><i class="las la-edit me-1"></i>Edit Profile</a>
                    @if ($user->id !== auth()->id())
                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-warning">
                                {{ $user->status === 'Active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Contact</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="las la-envelope me-2 text-muted"></i>{{ $user->email }}</li>
                    <li class="mb-2"><i class="las la-phone me-2 text-muted"></i>{{ $user->phone ?? '—' }}</li>
                    <li><i class="las la-map-marker me-2 text-muted"></i>{{ $user->address ?? '—' }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Employment Details</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Employee ID</small>
                        <span class="fw-medium">{{ $user->employee_id ?? '—' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Designation</small>
                        <span class="fw-medium">{{ $user->designation ?? '—' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Department</small>
                        <span class="fw-medium">{{ $user->department ?? '—' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Joining Date</small>
                        <span class="fw-medium">{{ optional($user->joining_date)->format('d M, Y') ?? '—' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Status</small>
                        <span class="fw-medium">{{ $user->status }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Personal Details</h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Gender</small>
                        <span class="fw-medium">{{ $user->gender ?? '—' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Date of Birth</small>
                        <span class="fw-medium">{{ optional($user->date_of_birth)->format('d M, Y') ?? '—' }}</span>
                    </div>
                    <div class="col-md-4 mb-3">
                        <small class="text-muted d-block">Blood Group</small>
                        <span class="fw-medium">{{ $user->blood_group ?? '—' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
