@extends('layouts.frontend')

@section('title', 'Patient Registration - Healix HMS')

@section('content')

			<!-- BREADCRUMB
			============================================= -->
			<div id="breadcrumb" class="division">
				<div class="container">
					<div class="row">						
						<div class="col">
							<div class=" breadcrumb-holder">
								<nav aria-label="breadcrumb">
								  	<ol class="breadcrumb">
								    	<li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
								    	<li class="breadcrumb-item active" aria-current="page">Patient Registration</li>
								  	</ol>
								</nav>
								<h4 class="h4-sm steelblue-color">Create Your Patient Account</h4>
							</div>
						</div>
					</div>
				</div>
			</div>	<!-- END BREADCRUMB -->

			<!-- REGISTRATION FORM
			============================================= -->
			<div class="wide-60 division">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-7">
							<div class="form-holder">

								<p class="mb-30">Register for a free patient account to book appointments online and keep track of your prescriptions and invoices in one place.</p>

								@if ($errors->any())
									<div class="alert alert-danger">
										<ul class="mb-0">
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif

								<form method="POST" action="{{ route('patient.register.store') }}" class="row patient-register-form">
									@csrf

									<div class="col-md-6">
										<input type="text" name="name" class="form-control" placeholder="Full Name*" value="{{ old('name') }}" required>
									</div>
									<div class="col-md-6">
										<input type="email" name="email" class="form-control" placeholder="Email*" value="{{ old('email') }}" required>
									</div>
									<div class="col-md-6">
										<input type="tel" name="phone" class="form-control" placeholder="Phone Number*" value="{{ old('phone') }}" required>
									</div>
									<div class="col-md-6">
										<select name="gender" class="custom-select" required>
											<option value="">Select Gender*</option>
											<option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
											<option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
											<option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
										</select>
									</div>
									<div class="col-md-6">
										<input type="date" name="date_of_birth" class="form-control" placeholder="Date of Birth" value="{{ old('date_of_birth') }}">
									</div>
									<div class="col-md-6"></div>
									<div class="col-md-6">
										<input type="password" name="password" class="form-control" placeholder="Password*" required>
									</div>
									<div class="col-md-6">
										<input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password*" required>
									</div>

									<div class="col-lg-12 form-btn">
										<button type="submit" class="btn btn-blue blue-hover submit">Create Account</button>
									</div>
								</form>

								<p class="mt-20">Already have an account? <a href="{{ route('login') }}">Log in here</a>.</p>

							</div>
						</div>
					</div>
				</div>
			</div>

@endsection
