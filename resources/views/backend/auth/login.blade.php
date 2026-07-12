@extends('layouts.auth')

@section('title', 'Login')
@section('auth-title', "Let's Get Started")
@section('auth-subtitle', 'Sign in to continue to Healix HMS.')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form class="my-4" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-2">
            <label class="form-label" for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email" autofocus>
            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group">
            <label class="form-label" for="userpassword">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
            @error('password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group row mt-3">
            <div class="col-sm-6">
                <div class="form-check form-switch form-switch-success">
                    <input class="form-check-input" type="checkbox" id="customSwitchSuccess" name="remember">
                    <label class="form-check-label" for="customSwitchSuccess">Remember me</label>
                </div>
            </div><!--end col-->
            <div class="col-sm-6 text-end">
                <a href="{{ route('password.request') }}" class="text-muted font-13"><i class="dripicons-lock"></i> Forgot password?</a>
            </div><!--end col-->
        </div><!--end form-group-->

        <div class="form-group mb-0 row">
            <div class="col-12">
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="submit">Log In <i class="fas fa-sign-in-alt ms-1"></i></button>
                </div>
            </div><!--end col-->
        </div> <!--end form-group-->
    </form><!--end form-->
    <div class="text-center  mb-2">
        <p class="text-muted">Don't have an account ?  <a href="{{ route('patient.register') }}" class="text-primary ms-2">Register as Patient</a></p>
    </div>
@endsection
