@extends('layouts.backend')

@section('title', 'Doctors')
@section('page-title', 'Doctors')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.doctors.index') }}" class="d-flex" style="max-width: 320px;">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, ID or specialty">
                        <button type="submit" class="btn btn-outline-secondary ms-2"><i class="las la-search"></i></button>
                    </form>
                    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Doctor
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Doctor ID</th>
                                <th>Name</th>
                                <th>Specialization</th>
                                <th>Branch</th>
                                <th>Phone</th>
                                <th>Experience</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($doctors as $doctor)
                                <tr>
                                    <td>{{ $doctor->doctor_id }}</td>
                                    <td>Dr. {{ $doctor->name }}</td>
                                    <td>{{ $doctor->specialization }}</td>
                                    <td>{{ $doctor->branch?->name ?? '-' }}</td>
                                    <td>{{ $doctor->phone ?? '-' }}</td>
                                    <td>{{ $doctor->experience_years ? $doctor->experience_years . ' yrs' : '-' }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($doctor->status) {
                                                'Active' => 'bg-success-subtle text-success',
                                                'On Leave' => 'bg-warning-subtle text-warning',
                                                default => 'bg-danger-subtle text-danger',
                                            };
                                        @endphp
                                        <span class="badge {{ $statusClass }}">{{ $doctor->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.doctors.show', $doctor) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this doctor record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No doctors found. <a href="{{ route('admin.doctors.create') }}">Add the first doctor</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $doctors->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
