@extends('layouts.patient')

@section('title', 'My Prescriptions')
@section('page-title', 'My Prescriptions')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Rx No</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Diagnosis</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $prescription->prescription_no }}</td>
                                    <td>{{ $prescription->prescription_date->format('d M, Y') }}</td>
                                    <td>Dr. {{ $prescription->doctor->name ?? 'N/A' }}</td>
                                    <td>{{ $prescription->diagnosis ?? '-' }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('patient.prescriptions.show', $prescription) }}" class="btn btn-sm btn-soft-info">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No prescriptions on file yet.</td>
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
