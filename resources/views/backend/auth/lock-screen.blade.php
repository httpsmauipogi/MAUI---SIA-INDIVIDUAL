@extends('layouts.auth')

@section('title', 'Lock Screen')
@section('auth-title', 'Enter Password')
@section('auth-subtitle', 'Enter your password to unlock the screen!')

@section('content')
    <form class="my-4" method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="email" value="{{ auth()->user()->email ?? old('email') }}">
        <div class="form-group mb-2">
            <label class="form-label" for="userpassword">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
            @error('password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group mb-0 row">
            <div class="col-12">
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="submit">Unlock <i class="fas fa-sign-in-alt ms-1"></i></button>
                </div>
            </div><!--end col-->
        </div> <!--end form-group-->
    </form><!--end form-->
    <div class="text-center  mb-2">
        <p class="text-muted">Not you? return  <a href="{{ route('login') }}" class="text-primary ms-2">Sign in here</a></p>
    </div>
@endsection
