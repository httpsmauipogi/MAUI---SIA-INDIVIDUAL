@extends('layouts.backend')

@section('title', $page['label'] . ' - Page Content')
@section('page-title', $page['label'])

@section('content')

<div class="row">
    <div class="col-12">
        <a href="{{ route('admin.page-content.index') }}" class="btn btn-sm btn-light border mb-3">
            <i class="las la-arrow-left"></i> Back to all pages
        </a>
        <a href="{{ route($page['route']) }}" target="_blank" class="btn btn-sm btn-light border mb-3">
            <i class="las la-external-link-alt"></i> View Live
        </a>
    </div>
</div>

@if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Could not save - please fix the following:</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- BANNER -->
<div class="card">
    <div class="card-header"><h5 class="card-title mb-0">Banner / Hero Text</h5></div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.page-content.banner.update', $pageKey) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle) }}">
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="3" class="form-control">{{ old('description', $banner->description) }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="image" accept="image/*" class="form-control">
                    @if ($banner->image_path)
                        <div class="mt-2"><img src="{{ storage_url($banner->image_path) }}" alt="Current banner" height="60"></div>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Banner</button>
        </form>
    </div>
</div>

<!-- CARD GROUPS -->
@foreach ($cardGroups as $groupKey => $group)
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $group['label'] }}</h5>
        </div>
        <div class="card-body">

            @if ($group['cards']->isEmpty())
                <p class="text-muted">No cards yet - add the first one below.</p>
            @else
                <div class="table-responsive mb-4">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th style="width:70px;">Order</th>
                                <th style="width:70px;">Image</th>
                                <th>Title / Content</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($group['cards'] as $card)
                                <tr>
                                    <td>
                                        <form method="POST" action="{{ route('admin.page-content.cards.move', $card) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="direction" value="up">
                                            <button type="submit" class="btn btn-sm btn-light border"><i class="las la-arrow-up"></i></button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.page-content.cards.move', $card) }}" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="direction" value="down">
                                            <button type="submit" class="btn btn-sm btn-light border"><i class="las la-arrow-down"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                        @if ($card->image_path)
                                            <img src="{{ storage_url($card->image_path) }}" alt="" height="40">
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $card->title }}</strong>
                                        @if ($card->subtitle)
                                            <div class="text-muted fs-13">{{ $card->subtitle }}</div>
                                        @endif
                                        @if ($card->description)
                                            <div class="fs-13">{{ \Illuminate\Support\Str::limit($card->description, 100) }}</div>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-light border" data-bs-toggle="collapse" data-bs-target="#edit-card-{{ $card->id }}">
                                            <i class="las la-edit"></i> Edit
                                        </button>
                                        <form method="POST" action="{{ route('admin.page-content.cards.destroy', $card) }}" class="d-inline" onsubmit="return confirm('Delete this card?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="las la-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                <tr class="collapse" id="edit-card-{{ $card->id }}">
                                    <td colspan="4">
                                        <form method="POST" action="{{ route('admin.page-content.cards.update', $card) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <label class="form-label">Icon (e.g. la-heartbeat)</label>
                                                    <input type="text" name="icon" class="form-control" value="{{ $card->icon }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Title</label>
                                                    <input type="text" name="title" class="form-control" value="{{ $card->title }}">
                                                </div>
                                                <div class="col-md-5 mb-2">
                                                    <label class="form-label">Subtitle</label>
                                                    <input type="text" name="subtitle" class="form-control" value="{{ $card->subtitle }}">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" rows="2" class="form-control">{{ $card->description }}</textarea>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Link Text</label>
                                                    <input type="text" name="link_text" class="form-control" value="{{ $card->link_text }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Link URL</label>
                                                    <input type="text" name="link_url" class="form-control" value="{{ $card->link_url }}">
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label class="form-label">Replace Image</label>
                                                    <input type="file" name="image" accept="image/*" class="form-control">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- ADD NEW CARD -->
            <button type="button" class="btn btn-sm btn-outline-primary mb-3" data-bs-toggle="collapse" data-bs-target="#add-card-{{ $groupKey }}">
                <i class="las la-plus"></i> Add Card
            </button>
            <div class="collapse {{ $errors->any() && old('group_key') === $groupKey ? 'show' : '' }}" id="add-card-{{ $groupKey }}">
                <form method="POST" action="{{ route('admin.page-content.cards.store', $pageKey) }}" enctype="multipart/form-data" class="border rounded p-3 mb-2">
                    @csrf
                    <input type="hidden" name="group_key" value="{{ $groupKey }}">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Icon (e.g. la-heartbeat)</label>
                            <input type="text" name="icon" class="form-control" value="{{ old('icon') }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        </div>
                        <div class="col-md-5 mb-2">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="2" class="form-control">{{ old('description') }}</textarea>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Link Text</label>
                            <input type="text" name="link_text" class="form-control" value="{{ old('link_text') }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Link URL</label>
                            <input type="text" name="link_url" class="form-control" value="{{ old('link_url') }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Image (max 4MB - jpg/png/webp)</label>
                            <input type="file" name="image" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Add Card</button>
                </form>
            </div>

        </div>
    </div>
@endforeach

@endsection
