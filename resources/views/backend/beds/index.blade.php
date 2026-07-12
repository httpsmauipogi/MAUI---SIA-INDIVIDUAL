@extends('layouts.backend')

@section('title', 'Bed Availability')
@section('page-title', 'Bed Availability')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Total Beds</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $counts['total'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Available</p>
                <h4 class="mt-1 mb-0 fw-medium text-success">{{ $counts['available'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Occupied</p>
                <h4 class="mt-1 mb-0 fw-medium text-danger">{{ $counts['occupied'] }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Under Maintenance</p>
                <h4 class="mt-1 mb-0 fw-medium text-warning">{{ $counts['maintenance'] }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.beds.index') }}" class="d-flex flex-wrap gap-2">
                        <select name="ward" class="form-select" style="max-width: 180px;">
                            <option value="">All Wards</option>
                            @foreach ($wards as $ward)
                                <option value="{{ $ward }}" {{ request('ward') === $ward ? 'selected' : '' }}>{{ $ward }}</option>
                            @endforeach
                        </select>
                        <select name="status" class="form-select" style="max-width: 170px;">
                            <option value="">All Status</option>
                            @foreach (['Available', 'Occupied', 'Maintenance'] as $option)
                                <option value="{{ $option }}" {{ request('status') === $option ? 'selected' : '' }}>{{ $option }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-filter"></i> Filter</button>
                        @if (request()->hasAny(['ward', 'status']))
                            <a href="{{ route('admin.beds.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('admin.beds.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Bed
                    </a>
                </div>

                <div class="row">
                    @forelse ($beds as $bed)
                        @php
                            $cardClass = match ($bed->status) {
                                'Available' => 'border-success',
                                'Occupied' => 'border-danger',
                                default => 'border-warning',
                            };
                            $badgeClass = match ($bed->status) {
                                'Available' => 'bg-success-subtle text-success',
                                'Occupied' => 'bg-danger-subtle text-danger',
                                default => 'bg-warning-subtle text-warning',
                            };
                        @endphp
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-3">
                            <div class="card {{ $cardClass }}" style="border-width: 2px;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="mb-0">{{ $bed->bed_number }}</h5>
                                        <span class="badge {{ $badgeClass }}">{{ $bed->status }}</span>
                                    </div>
                                    <p class="text-muted mb-1 fs-13">{{ $bed->ward }} {{ $bed->floor ? '· Floor ' . $bed->floor : '' }}</p>

                                    @if ($bed->status === 'Occupied' && $bed->patient)
                                        <p class="mb-2">
                                            <a href="{{ route('admin.patients.show', $bed->patient) }}">{{ $bed->patient->name }}</a>
                                            <br><small class="text-muted">Since {{ $bed->occupied_at?->format('d M, h:i A') }}</small>
                                        </p>
                                        <form action="{{ route('admin.beds.discharge', $bed) }}" method="POST" onsubmit="return confirm('Discharge patient and free this bed?');">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-soft-success w-100">Discharge</button>
                                        </form>
                                    @elseif ($bed->status === 'Available')
                                        <form action="{{ route('admin.beds.assign', $bed) }}" method="POST" class="d-flex gap-1">
                                            @csrf
                                            <select name="patient_id" class="form-select form-select-sm" required>
                                                <option value="">Assign patient...</option>
                                                @foreach (\App\Models\Patient::where('status', 'Active')->orderBy('name')->get() as $patient)
                                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-soft-primary">Go</button>
                                        </form>
                                    @endif

                                    <div class="d-flex gap-1 mt-2">
                                        <a href="{{ route('admin.beds.edit', $bed) }}" class="btn btn-sm btn-soft-secondary flex-grow-1">Edit</a>
                                        <form action="{{ route('admin.beds.destroy', $bed) }}" method="POST" onsubmit="return confirm('Remove this bed?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </div>
                                </div><!--end card-body-->
                            </div><!--end card-->
                        </div><!--end col-->
                    @empty
                        <div class="col-12 text-center text-muted py-4">
                            No beds set up yet. <a href="{{ route('admin.beds.create') }}">Add the first bed</a>.
                        </div>
                    @endforelse
                </div><!--end row-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
