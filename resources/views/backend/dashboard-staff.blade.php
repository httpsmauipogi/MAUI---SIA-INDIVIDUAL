@extends('layouts.backend')

@section('title', 'My Duty')
@section('page-title', 'My Duty')

@section('content')

<div class="row">
    <div class="col-lg-7 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Current Task</h5>

                @if ($currentDuty)
                    <div class="d-flex align-items-start">
                        <div class="d-flex justify-content-center align-items-center thumb-md bg-primary-subtle text-primary rounded-circle me-3">
                            <i class="las la-tasks fs-20"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1">{{ $currentDuty->task }}</h5>
                            <p class="text-muted mb-1"><i class="las la-map-marker fs-16 align-middle"></i> {{ $currentDuty->location }}</p>
                            <p class="text-muted mb-3 fs-13">Started {{ $currentDuty->started_at->diffForHumans() }}</p>
                            <form action="{{ route('admin.duty-logs.complete', $currentDuty) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Mark as Completed</button>
                            </form>
                        </div>
                    </div>
                @else
                    <p class="text-muted mb-0">You have no active task right now. Your supervisor will assign one, or a Ward duty can be logged for you from the Staff Duty Board.</p>
                @endif
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->

    <div class="col-lg-5 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">Completed Today</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ $completedTodayCount }}</h4>
                <a href="{{ route('admin.duty-logs.index') }}" class="btn btn-sm btn-soft-primary mt-3">View Full Duty Board</a>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">My Recent History</h5>
                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Task</th>
                                <th>Started</th>
                                <th>Ended</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentDuties as $log)
                                <tr>
                                    <td>{{ $log->location }}</td>
                                    <td>{{ $log->task }}</td>
                                    <td>{{ $log->started_at->format('d M, h:i A') }}</td>
                                    <td>{{ $log->ended_at?->format('d M, h:i A') ?? '-' }}</td>
                                    <td>
                                        <span class="badge {{ $log->status === 'Completed' ? 'bg-success-subtle text-success' : 'bg-info-subtle text-info' }}">{{ $log->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No duty history yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
