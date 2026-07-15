@extends('layouts.backend')

@section('title', 'Hospitals / Branches')
@section('page-title', 'Hospitals / Branches')

@section('content')

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row mb-3">
    <div class="col-12 d-flex justify-content-end">
        <a href="{{ route('admin.branches.create') }}" class="btn btn-primary">
            <i class="las la-plus"></i> Add Branch
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>City</th>
                                <th>Contact</th>
                                <th>Manager</th>
                                <th>Doctors</th>
                                <th>Staff</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($branches as $branch)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.branches.show', $branch) }}"><strong>{{ $branch->name }}</strong></a>
                                        @if ($branch->is_main)
                                            <span class="badge bg-primary ms-1">Main</span>
                                        @endif
                                        @if ($branch->code)
                                            <div class="text-muted fs-13">{{ $branch->code }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $branch->city ?? '-' }}</td>
                                    <td>
                                        @if ($branch->phone)<div>{{ $branch->phone }}</div>@endif
                                        @if ($branch->email)<div class="text-muted fs-13">{{ $branch->email }}</div>@endif
                                    </td>
                                    <td>{{ $branch->manager_name ?? '-' }}</td>
                                    <td>{{ $branch->doctors_count }}</td>
                                    <td>{{ $branch->staff_count }}</td>
                                    <td>
                                        <span class="badge {{ $branch->status === 'Active' ? 'bg-success' : 'bg-secondary' }}">{{ $branch->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.branches.edit', $branch) }}" class="btn btn-sm btn-light border"><i class="las la-edit"></i></a>
                                        <form method="POST" action="{{ route('admin.branches.destroy', $branch) }}" class="d-inline" onsubmit="return confirm('Delete this branch?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="las la-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">No branches added yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
