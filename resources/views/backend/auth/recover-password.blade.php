@extends('layouts.auth')

@section('title', 'Recover Password')
@section('auth-title', 'Reset Password')
@section('auth-subtitle', 'Enter your email and instructions will be sent to you!')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="my-4" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group mb-2">
            <label class="form-label" for="userEmail">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="userEmail" name="email" value="{{ old('email') }}" placeholder="Enter email address" autofocus>
            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group mb-0 row">
            <div class="col-12">
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="submit">Reset <i class="fas fa-sign-in-alt ms-1"></i></button>
                </div>
            </div><!--end col-->
        </div> <!--end form-group-->
    </form><!--end form-->
    <div class="text-center  mb-2">
        <p class="text-muted">Remember it ?  <a href="{{ route('login') }}" class="text-primary ms-2">Sign in here</a></p>
    </div>
@endsection
