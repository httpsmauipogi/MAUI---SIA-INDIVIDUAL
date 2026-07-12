@extends('layouts.backend')

@section('title', 'Staff Duty Board')
@section('page-title', 'Staff Duty Board')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div>
                        <h5 class="mb-0">Currently On Duty</h5>
                        <p class="text-muted mb-0 fs-13">Live view of who is doing what, and where, right now.</p>
                    </div>
                    <a href="{{ route('admin.duty-logs.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Assign Duty
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Staff</th>
                                <th>Role</th>
                                <th>Location</th>
                                <th>Task</th>
                                <th>Since</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ongoing as $log)
                                <tr>
                                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-primary-subtle text-primary">{{ $log->role_at_time ?? '-' }}</span></td>
                                    <td>{{ $log->location }}</td>
                                    <td>{{ $log->task }}</td>
                                    <td>
                                        {{ $log->started_at->format('h:i A') }}
                                        <br><small class="text-muted">{{ $log->started_at->diffForHumans() }}</small>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.duty-logs.edit', $log) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.duty-logs.complete', $log) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-soft-success">Mark Done</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No one is on an active duty right now. <a href="{{ route('admin.duty-logs.create') }}">Assign a task</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3">Completed Today</h5>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Staff</th>
                                <th>Role</th>
                                <th>Location</th>
                                <th>Task</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($completedToday as $log)
                                <tr>
                                    <td>{{ $log->user->name ?? 'N/A' }}</td>
                                    <td>{{ $log->role_at_time ?? '-' }}</td>
                                    <td>{{ $log->location }}</td>
                                    <td>{{ $log->task }}</td>
                                    <td>{{ $log->started_at->diffForHumans($log->ended_at, true) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No completed duties logged today yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $completedToday->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
