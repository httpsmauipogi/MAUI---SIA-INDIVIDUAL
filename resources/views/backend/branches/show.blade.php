@extends('layouts.backend')

@section('title', $branch->name)
@section('page-title', $branch->name)

@section('content')

<div class="row mb-3">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.branches.index') }}" class="btn btn-sm btn-light border">
            <i class="las la-arrow-left"></i> Back to Branches
        </a>
        <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-sm btn-primary">
            <i class="las la-edit"></i> Edit Branch
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $branch->name }}
                    @if ($branch->is_main)
                        <span class="badge bg-primary">Main</span>
                    @endif
                </h5>
                <p class="mb-1"><strong>Status:</strong> <span class="badge {{ $branch->status === 'Active' ? 'bg-success' : 'bg-secondary' }}">{{ $branch->status }}</span></p>
                @if ($branch->code)<p class="mb-1"><strong>Code:</strong> {{ $branch->code }}</p>@endif
                @if ($branch->city)<p class="mb-1"><strong>City:</strong> {{ $branch->city }}</p>@endif
                @if ($branch->manager_name)<p class="mb-1"><strong>Manager:</strong> {{ $branch->manager_name }}</p>@endif
                @if ($branch->phone)<p class="mb-1"><strong>Phone:</strong> {{ $branch->phone }}</p>@endif
                @if ($branch->email)<p class="mb-1"><strong>Email:</strong> {{ $branch->email }}</p>@endif
                @if ($branch->address)<p class="mb-0"><strong>Address:</strong><br>{{ $branch->address }}</p>@endif
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Branch Admin (Head)</h5></div>
            <div class="card-body">
                @forelse ($branch->admins as $admin)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div>
                            <strong>{{ $admin->name }}</strong>
                            <div class="text-muted fs-13">{{ $admin->email }}</div>
                        </div>
                        <a href="{{ route('admin.users.edit', $admin) }}" class="btn btn-sm btn-light border">Manage</a>
                    </div>
                @empty
                    <p class="text-muted mb-2">No admin head assigned to this branch yet.</p>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-primary">
                        <i class="las la-user-plus"></i> Add Branch Admin
                    </a>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Doctors at this Branch ({{ $branch->doctors->count() }})</h5></div>
            <div class="card-body">
                @forelse ($branch->doctors as $doctor)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $doctor->name }}</span>
                        <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-light border">View</a>
                    </div>
                @empty
                    <p class="text-muted mb-0">No doctors assigned to this branch yet.</p>
                @endforelse
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Staff at this Branch ({{ $branch->staff->count() }})</h5></div>
            <div class="card-body">
                @forelse ($branch->staff as $member)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $member->name }} <span class="text-muted fs-13">({{ $member->getRoleNames()->first() }})</span></span>
                    </div>
                @empty
                    <p class="text-muted mb-0">No staff assigned to this branch yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
