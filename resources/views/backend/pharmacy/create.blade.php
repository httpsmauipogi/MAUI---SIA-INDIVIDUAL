@extends('layouts.backend')

@section('title', 'Add Medicine')
@section('page-title', 'Add Medicine')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pharmacy.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Medicine Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Napa 500mg">
                            @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="generic_name">Generic Name</label>
                            <input type="text" class="form-control @error('generic_name') is-invalid @enderror" id="generic_name" name="generic_name" value="{{ old('generic_name') }}" placeholder="e.g. Paracetamol">
                            @error('generic_name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}" placeholder="e.g. Analgesic, Antibiotic">
                            @error('category') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="unit">Unit</label>
                            <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit">
                                @foreach (['Tablet', 'Capsule', 'Syrup', 'Injection', 'Bottle', 'Tube', 'Box'] as $option)
                                    <option value="{{ $option }}" {{ old('unit') === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('unit') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="manufacturer">Manufacturer</label>
                            <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old('manufacturer') }}">
                            @error('manufacturer') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="expiry_date">Expiry Date</label>
                            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                            @error('expiry_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="stock_quantity">Opening Stock</label>
                            <input type="number" min="0" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', 0) }}">
                            @error('stock_quantity') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="reorder_level">Reorder Level</label>
                            <input type="number" min="0" class="form-control @error('reorder_level') is-invalid @enderror" id="reorder_level" name="reorder_level" value="{{ old('reorder_level', 10) }}">
                            @error('reorder_level') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            <small class="text-muted">Alert when stock falls to/below this.</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="unit_price">Unit Price</label>
                            <input type="number" step="0.01" min="0" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price') }}">
                            @error('unit_price') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        @if (! $isBranchRestricted)
                        <div class="col-md-4 mb-3">
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
                        <button type="submit" class="btn btn-primary">Save Medicine</button>
                        <a href="{{ route('admin.pharmacy.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
