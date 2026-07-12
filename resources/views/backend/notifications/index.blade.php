@extends('layouts.backend')

@section('title', 'Notifications')
@section('page-title', 'Notifications')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">All Notifications</h5>
                    @if ($notifications->where('read_at', null)->count() > 0)
                        <form method="POST" action="{{ route('admin.notifications.read-all') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Mark all as read</button>
                        </form>
                    @endif
                </div>

                <div class="list-group list-group-flush">
                    @forelse ($notifications as $notification)
                        <div class="list-group-item d-flex align-items-start gap-3 {{ $notification->read_at ? '' : 'bg-primary-subtle bg-opacity-25' }}">
                            <div class="flex-shrink-0 bg-{{ $notification->data['level'] ?? 'primary' }}-subtle text-{{ $notification->data['level'] ?? 'primary' }} thumb-md rounded-circle d-flex align-items-center justify-content-center">
                                <i class="{{ $notification->data['icon'] ?? 'iconoir-bell' }} fs-4"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-medium">{{ $notification->data['title'] ?? 'Notification' }}</h6>
                                <p class="mb-1 text-muted">{{ $notification->data['message'] ?? '' }}</p>
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="flex-shrink-0 d-flex gap-1">
                                @if (! $notification->read_at && ($notification->data['url'] ?? null))
                                    <form method="POST" action="{{ route('admin.notifications.read', $notification->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-soft-primary">Open</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.notifications.destroy', $notification->id) }}" onsubmit="return confirm('Remove this notification?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5">
                            <i class="iconoir-bell-off fs-1 d-block mb-2"></i>
                            You're all caught up. No notifications yet.
                        </div>
                    @endforelse
                </div>

                <div class="mt-3">
                    {{ $notifications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
