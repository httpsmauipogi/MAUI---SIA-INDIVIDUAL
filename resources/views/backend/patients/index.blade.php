@extends('layouts.backend')

@section('title', 'Patients')
@section('page-title', 'Patients')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.patients.index') }}" class="d-flex" style="max-width: 320px;">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, ID or phone">
                        <button type="submit" class="btn btn-outline-secondary ms-2"><i class="las la-search"></i></button>
                    </form>
                    <a href="{{ route('admin.patients.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Patient
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Patient ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Blood Group</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->patient_id }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->gender }}</td>
                                    <td>{{ $patient->phone ?? '-' }}</td>
                                    <td>{{ $patient->blood_group ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $patient->status === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                            {{ $patient->status }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.patients.show', $patient) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.patients.edit', $patient) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.patients.destroy', $patient) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this patient record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No patients found. <a href="{{ route('admin.patients.create') }}">Add the first patient</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $patients->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
