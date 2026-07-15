@php
    $branch = $branch ?? null;
@endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="name">Branch Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $branch->name ?? '') }}" placeholder="e.g. Healix HMS - Dhanmondi">
        @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="code">Branch Code <span class="text-muted">(optional)</span></label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $branch->code ?? '') }}" placeholder="e.g. DHM-01">
        @error('code') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="city">City</label>
        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $branch->city ?? '') }}">
        @error('city') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="manager_name">Branch Manager <span class="text-muted">(optional)</span></label>
        <input type="text" class="form-control @error('manager_name') is-invalid @enderror" id="manager_name" name="manager_name" value="{{ old('manager_name', $branch->manager_name ?? '') }}">
        @error('manager_name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="phone">Phone</label>
        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $branch->phone ?? '') }}">
        @error('phone') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label" for="email">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $branch->email ?? '') }}">
        @error('email') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    <div class="col-12 mb-3">
        <label class="form-label" for="address">Address</label>
        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address', $branch->address ?? '') }}</textarea>
        @error('address') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>

    @if ($branch)
    <div class="col-md-6 mb-3">
        <label class="form-label" for="status">Status</label>
        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
            <option value="Active" {{ old('status', $branch->status ?? 'Active') === 'Active' ? 'selected' : '' }}>Active</option>
            <option value="Inactive" {{ old('status', $branch->status ?? '') === 'Inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
    </div>
    @else
        <input type="hidden" name="status" value="Active">
    @endif

    <div class="col-md-6 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_main" name="is_main" value="1" {{ old('is_main', $branch->is_main ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_main">
                Set as main / head office branch
            </label>
        </div>
    </div>
</div>
