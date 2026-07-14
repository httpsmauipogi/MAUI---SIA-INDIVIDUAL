@extends('layouts.backend')

@section('title', 'IPD Admissions')
@section('page-title', 'IPD Admissions')

@section('content')

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Currently Admitted</p>
                <h4 class="mt-1 mb-0 fw-medium text-warning">{{ $counts['admitted'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Discharged Today</p>
                <h4 class="mt-1 mb-0 fw-medium text-success">{{ $counts['dischargedToday'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Beds Available</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $counts['availableBeds'] }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.admissions.index') }}" class="d-flex flex-wrap gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search admission no. or patient" style="max-width: 240px;">
                        <select name="status" class="form-select" style="max-width: 160px;">
                            <option value="">All Status</option>
                            <option value="Admitted" {{ request('status') === 'Admitted' ? 'selected' : '' }}>Admitted</option>
                            <option value="Discharged" {{ request('status') === 'Discharged' ? 'selected' : '' }}>Discharged</option>
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-filter"></i></button>
                        @if (request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.admissions.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    @if ($counts['availableBeds'] > 0)
                        <a href="{{ route('admin.admissions.create') }}" class="btn btn-primary">
                            <i class="las la-plus me-1"></i> Admit Patient
                        </a>
                    @else
                        <span class="text-muted">No beds available right now</span>
                    @endif
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Admission No</th>
                                <th>Patient</th>
                                <th>Bed</th>
                                <th>Doctor</th>
                                <th>Admitted On</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($admissions as $admission)
                                <tr>
                                    <td>{{ $admission->admission_no }}</td>
                                    <td>{{ $admission->patient->name ?? 'N/A' }}</td>
                                    <td>{{ $admission->bed->bed_number ?? '-' }} ({{ $admission->bed->ward ?? '-' }})</td>
                                    <td>{{ $admission->doctor ? 'Dr. ' . $admission->doctor->name : '-' }}</td>
                                    <td>{{ $admission->admission_date->format('d M, Y') }}</td>
                                    <td>
                                        <span class="badge {{ $admission->status === 'Admitted' ? 'bg-warning-subtle text-warning' : 'bg-success-subtle text-success' }}">{{ $admission->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.admissions.show', $admission) }}" class="btn btn-sm btn-soft-info"><i class="las la-eye"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">No admissions recorded yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $admissions->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
