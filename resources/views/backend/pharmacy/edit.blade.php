@extends('layouts.backend')

@section('title', 'Edit Medicine')
@section('page-title', 'Edit Medicine')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.pharmacy.update', $medicine) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Medicine Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $medicine->name) }}">
                            @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="generic_name">Generic Name</label>
                            <input type="text" class="form-control @error('generic_name') is-invalid @enderror" id="generic_name" name="generic_name" value="{{ old('generic_name', $medicine->generic_name) }}">
                            @error('generic_name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="category">Category</label>
                            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $medicine->category) }}">
                            @error('category') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="unit">Unit</label>
                            <select class="form-select @error('unit') is-invalid @enderror" id="unit" name="unit">
                                @foreach (['Tablet', 'Capsule', 'Syrup', 'Injection', 'Bottle', 'Tube', 'Box'] as $option)
                                    <option value="{{ $option }}" {{ old('unit', $medicine->unit) === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('unit') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="manufacturer">Manufacturer</label>
                            <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" id="manufacturer" name="manufacturer" value="{{ old('manufacturer', $medicine->manufacturer) }}">
                            @error('manufacturer') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="expiry_date">Expiry Date</label>
                            <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', optional($medicine->expiry_date)->format('Y-m-d')) }}">
                            @error('expiry_date') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="stock_quantity">Stock Quantity</label>
                            <input type="number" min="0" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $medicine->stock_quantity) }}">
                            @error('stock_quantity') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            <small class="text-muted">To adjust stock with a logged reason, use Restock/Dispense on the medicine's detail page instead.</small>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="reorder_level">Reorder Level</label>
                            <input type="number" min="0" class="form-control @error('reorder_level') is-invalid @enderror" id="reorder_level" name="reorder_level" value="{{ old('reorder_level', $medicine->reorder_level) }}">
                            @error('reorder_level') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="unit_price">Unit Price</label>
                            <input type="number" step="0.01" min="0" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" value="{{ old('unit_price', $medicine->unit_price) }}">
                            @error('unit_price') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                @foreach (['Active', 'Discontinued'] as $option)
                                    <option value="{{ $option }}" {{ old('status', $medicine->status) === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                            @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Medicine</button>
                        <a href="{{ route('admin.pharmacy.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
</div><!--end row-->
@endsection
