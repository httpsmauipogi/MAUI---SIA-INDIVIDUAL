@extends('layouts.backend')

@section('title', 'Message Details')
@section('page-title', 'Message Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h4 class="mb-1">{{ $message->subject ?? '(No subject)' }}</h4>
                        <p class="text-muted mb-0">From {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
                        <p class="text-muted mb-0">{{ $message->created_at->format('d M, Y h:i A') }}</p>
                    </div>
                </div>

                @if ($message->phone)
                    <div class="mb-3">
                        <p class="text-muted mb-1">Phone</p>
                        <p class="fw-medium">{{ $message->phone }}</p>
                    </div>
                @endif

                <div class="mb-4">
                    <p class="text-muted mb-1">Message</p>
                    <p style="white-space: pre-line;">{{ $message->message }}</p>
                </div>

                <div class="d-flex gap-2">
                    <a href="mailto:{{ $message->email }}" class="btn btn-primary">Reply by Email</a>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-light">Back to Inbox</a>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
