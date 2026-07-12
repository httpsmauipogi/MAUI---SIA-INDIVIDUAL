@extends('layouts.backend')

@section('title', 'Prescriptions')
@section('page-title', 'Prescriptions')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.prescriptions.index') }}" class="d-flex" style="max-width: 320px;">
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by Rx no. or patient">
                        <button type="submit" class="btn btn-outline-secondary ms-2"><i class="las la-search"></i></button>
                    </form>
                    <a href="{{ route('admin.prescriptions.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> New Prescription
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Rx No</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Medicines</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $prescription->prescription_no }}</td>
                                    <td>{{ $prescription->patient->name ?? 'N/A' }}</td>
                                    <td>Dr. {{ $prescription->doctor->name ?? 'N/A' }}</td>
                                    <td>{{ $prescription->prescription_date->format('d M, Y') }}</td>
                                    <td>{{ count($prescription->medicines ?? []) }} item(s)</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.prescriptions.show', $prescription) }}" class="btn btn-sm btn-soft-info me-1"><i class="las la-eye"></i></a>
                                        <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.prescriptions.destroy', $prescription) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this prescription?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No prescriptions found. <a href="{{ route('admin.prescriptions.create') }}">Create the first one</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $prescriptions->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
