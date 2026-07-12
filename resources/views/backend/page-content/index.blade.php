@extends('layouts.backend')

@section('title', 'Page Content')
@section('page-title', 'Page Content')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="las la-info-circle me-1"></i> Manage the banner text/image and repeatable cards for each frontend page. Changes go live immediately on the public website.
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Page</th>
                                <th>Card Groups</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $key => $page)
                                <tr>
                                    <td>
                                        <strong>{{ $page['label'] }}</strong>
                                        @if (! empty($page['note']))
                                            <div class="text-muted fs-13">{{ $page['note'] }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        @forelse ($page['groups'] as $groupLabel)
                                            <span class="badge bg-light text-dark border me-1">{{ $groupLabel }}</span>
                                        @empty
                                            <span class="text-muted fs-13">Banner only</span>
                                        @endforelse
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route($page['route']) }}" target="_blank" class="btn btn-sm btn-light border me-1">
                                            <i class="las la-external-link-alt"></i> View Live
                                        </a>
                                        <a href="{{ route('admin.page-content.edit', $key) }}" class="btn btn-sm btn-primary">
                                            <i class="las la-edit"></i> Manage
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
