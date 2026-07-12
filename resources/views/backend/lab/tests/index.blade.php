@extends('layouts.backend')

@section('title', 'Lab Test Catalog')
@section('page-title', 'Lab Test Catalog')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div class="d-flex flex-wrap gap-2">
                        <form method="GET" action="{{ route('admin.lab-tests.index') }}" class="d-flex">
                            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search test name">
                            <button type="submit" class="btn btn-outline-secondary ms-2"><i class="las la-search"></i></button>
                        </form>
                        <a href="{{ route('admin.lab-orders.index') }}" class="btn btn-outline-secondary">View Test Orders</a>
                    </div>
                    <a href="{{ route('admin.lab-tests.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Test
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Test Name</th>
                                <th>Category</th>
                                <th>Sample Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($labTests as $test)
                                <tr>
                                    <td>{{ $test->name }}</td>
                                    <td>{{ $test->category ?? '-' }}</td>
                                    <td>{{ $test->sample_type ?? '-' }}</td>
                                    <td>{{ number_format($test->price, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $test->status === 'Active' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">{{ $test->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.lab-tests.edit', $test) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.lab-tests.destroy', $test) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this test?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No lab tests in the catalog yet. <a href="{{ route('admin.lab-tests.create') }}">Add the first one</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $labTests->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
