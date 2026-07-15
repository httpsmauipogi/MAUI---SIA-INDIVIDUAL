@extends('layouts.backend')

@section('title', 'Add Branch')
@section('page-title', 'Add Branch')

@section('content')
<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.branches.store') }}">
                    @csrf

                    @include('backend.branches._form', ['branch' => null])

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Branch</button>
                        <a href="{{ route('admin.branches.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
