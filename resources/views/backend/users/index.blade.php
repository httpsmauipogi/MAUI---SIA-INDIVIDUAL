@extends('layouts.backend')

@section('title', 'Staff')
@section('page-title', 'Staff')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name, email, ID" style="max-width: 220px;">
                        <select name="role" class="form-select" style="max-width: 180px;" onchange="this.form.submit()">
                            <option value="">All roles</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <select name="status" class="form-select" style="max-width: 150px;" onchange="this.form.submit()">
                            <option value="">All status</option>
                            <option value="Active" {{ request('status') === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ request('status') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-search"></i></button>
                    </form>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Staff
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Staff</th>
                                <th>Contact</th>
                                <th>Role</th>
                                <th>Designation</th>
                                <th>Branch</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.users.show', $user) }}" class="d-flex align-items-center text-body text-decoration-none">
                                            <img src="{{ $user->avatar_url }}" class="rounded-circle me-2" width="36" height="36" style="object-fit:cover;">
                                            <div>
                                                <div class="fw-medium">{{ $user->name }}</div>
                                                <small class="text-muted">{{ $user->employee_id ?? '—' }}</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <div>{{ $user->email }}</div>
                                        <small class="text-muted">{{ $user->phone ?? '—' }}</small>
                                    </td>
                                    <td>
                                        @forelse ($user->roles as $role)
                                            <span class="badge bg-primary-subtle text-primary">{{ $role->name }}</span>
                                        @empty
                                            <span class="badge bg-secondary-subtle text-secondary">No role</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $user->designation ?? '—' }}</td>
                                    <td>{{ $user->branch?->name ?? '—' }}</td>
                                    <td>
                                        @if ($user->status === 'Active')
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at->format('d M, Y') }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-soft-secondary me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-soft-warning me-1" title="Toggle status">
                                                    <i class="las la-power-off"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this staff member?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No staff members found. <a href="{{ route('admin.users.create') }}">Add the first one</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
