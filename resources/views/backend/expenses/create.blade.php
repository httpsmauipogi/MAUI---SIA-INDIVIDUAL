@extends('layouts.backend')

@section('title', 'Add Expense')
@section('page-title', 'Add Expense')

@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.expenses.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category">
                                <option value="">Select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}" {{ old('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @error('category') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="expense_date">Date</label>
                            <input type="date" class="form-control @error('expense_date') is-invalid @enderror" id="expense_date" name="expense_date" value="{{ old('expense_date', now()->format('Y-m-d')) }}">
                            @error('expense_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="description">Description</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" placeholder="e.g. Monthly electricity bill">
                            @error('description') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="amount">Amount</label>
                            <input type="number" step="0.01" min="0" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}">
                            @error('amount') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="paid_to">Paid To <span class="text-muted">(optional)</span></label>
                            <input type="text" class="form-control @error('paid_to') is-invalid @enderror" id="paid_to" name="paid_to" value="{{ old('paid_to') }}" placeholder="e.g. Vendor / supplier name">
                            @error('paid_to') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label" for="notes">Notes <span class="text-muted">(optional)</span></label>
                            <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                        </div>

                        @if (! $isBranchRestricted)
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="branch_id">Branch</label>
                            <select class="form-control @error('branch_id') is-invalid @enderror" id="branch_id" name="branch_id">
                                <option value="">-- Select Branch --</option>
                                @foreach (\App\Models\Branch::where('status', 'Active')->orderBy('name')->pluck('name', 'id') as $id => $branchName)
                                    <option value="{{ $id }}" {{ (string) old('branch_id') === (string) $id ? 'selected' : '' }}>{{ $branchName }}</option>
                                @endforeach
                            </select>
                            @error('branch_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Expense</button>
                        <a href="{{ route('admin.expenses.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
