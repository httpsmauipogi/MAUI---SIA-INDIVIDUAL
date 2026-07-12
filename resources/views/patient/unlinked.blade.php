@extends('layouts.patient')

@section('title', 'My Dashboard')
@section('page-title', 'My Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body text-center py-5">
                <p class="text-muted mb-0">We couldn't find a matching patient record for your account yet. Please contact the hospital front desk to link your account, or visit us for your first appointment.</p>
            </div>
        </div>
    </div>
</div>
@endsection
