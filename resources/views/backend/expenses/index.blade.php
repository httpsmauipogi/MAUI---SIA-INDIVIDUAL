@extends('layouts.backend')

@section('title', 'Expenses')
@section('page-title', 'Expenses')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">This Month</p>
                <h4 class="mt-1 mb-0 fw-medium text-danger">{{ number_format($totalThisMonth, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3 mb-3">
        <div class="card">
            <div class="card-body">
                <p class="text-muted text-uppercase mb-0 fw-normal fs-13">All Time</p>
                <h4 class="mt-1 mb-0 fw-medium">{{ number_format($totalAllTime, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <form method="GET" action="{{ route('admin.expenses.index') }}" class="d-flex flex-wrap gap-2">
                        <select name="category" class="form-select" style="max-width: 180px;">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" {{ request('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                        <input type="date" name="from" value="{{ request('from') }}" class="form-control" style="max-width: 160px;">
                        <input type="date" name="to" value="{{ request('to') }}" class="form-control" style="max-width: 160px;">
                        <button type="submit" class="btn btn-outline-secondary"><i class="las la-filter"></i></button>
                        @if (request()->hasAny(['category', 'from', 'to']))
                            <a href="{{ route('admin.expenses.index') }}" class="btn btn-light">Clear</a>
                        @endif
                    </form>
                    <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary">
                        <i class="las la-plus me-1"></i> Add Expense
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-centered mb-0">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Paid To</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->expense_date->format('d M, Y') }}</td>
                                    <td><span class="badge bg-secondary-subtle text-secondary">{{ $expense->category }}</span></td>
                                    <td>{{ $expense->description }}</td>
                                    <td>{{ $expense->paid_to ?? '-' }}</td>
                                    <td class="text-end fw-medium">{{ number_format($expense->amount, 2) }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.expenses.edit', $expense) }}" class="btn btn-sm btn-soft-primary me-1"><i class="las la-edit"></i></a>
                                        <form action="{{ route('admin.expenses.destroy', $expense) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this expense record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-soft-danger"><i class="las la-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">No expenses recorded yet. <a href="{{ route('admin.expenses.create') }}">Add the first one</a>.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--end table-responsive-->

                <div class="mt-3">
                    {{ $expenses->links() }}
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->

@endsection
