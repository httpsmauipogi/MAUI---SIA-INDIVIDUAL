@extends('layouts.auth')

@section('title', 'Register')
@section('auth-title', 'Create an account')
@section('auth-subtitle', 'Enter your details to create your account today.')

@section('content')
    <form class="my-4" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group mb-2">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name" autofocus>
            @error('name')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group mb-2">
            <label class="form-label" for="useremail">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="useremail" name="email" value="{{ old('email') }}" placeholder="Enter email">
            @error('email')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group mb-2">
            <label class="form-label" for="userpassword">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="userpassword" placeholder="Enter password">
            @error('password')
                <span class="invalid-feedback d-block">{{ $message }}</span>
            @enderror
        </div><!--end form-group-->

        <div class="form-group mb-2">
            <label class="form-label" for="Confirmpassword">Confirm Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="Confirmpassword" placeholder="Enter confirm password">
        </div><!--end form-group-->

        <div class="form-group mb-0 row">
            <div class="col-12">
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="submit">Register <i class="fas fa-sign-in-alt ms-1"></i></button>
                </div>
            </div><!--end col-->
        </div> <!--end form-group-->
    </form><!--end form-->
    <div class="text-center">
        <p class="text-muted">Already have an account ?  <a href="{{ route('login') }}" class="text-primary ms-2">Log in</a></p>
    </div>
@endsection
