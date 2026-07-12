@extends('layouts.frontend')

@section('title', 'Dr. ' . $doctor->name . ' - Healix HMS')

@section('content')

			<!-- BREADCRUMB
			============================================= -->
			<div id="breadcrumb" class="division">
				<div class="container">
					<div class="row">						
						<div class="col">
							<div class=" breadcrumb-holder">

								<!-- Breadcrumb Nav -->
								<nav aria-label="breadcrumb">
								  	<ol class="breadcrumb">
								    	<li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
								    	<li class="breadcrumb-item"><a href="{{ route('frontend.doctors') }}">Doctors</a></li>
								    	<li class="breadcrumb-item active" aria-current="page">Dr. {{ $doctor->name }}</li>
								  	</ol>
								</nav>

								<!-- Title -->
								<h4 class="h4-sm steelblue-color">Dr. {{ $doctor->name }}</h4>

							</div>
						</div>
					</div>  <!-- End row -->	
				</div>	<!-- End container -->		
			</div>	<!-- END BREADCRUMB -->	


			<!-- DOCTOR PROFILE
			============================================= -->
			<div class="wide-60 doctor-profile-section division">
				<div class="container">
					<div class="row d-flex align-items-start">

						<!-- Doctor Photo -->
						<div class="col-lg-4 mb-40 mb-lg-0">
							<div class="hover-overlay">
								<img class="img-fluid rounded" src="{{ asset('frontend/images/doctor-' . (($doctor->id % 6) + 1) . '.jpg') }}" alt="Dr. {{ $doctor->name }}">
							</div>
						</div><!--end col-->

						<!-- Doctor Meta -->
						<div class="col-lg-8 pl-40">
							<h4 class="h4-xs blue-color">Dr. {{ $doctor->name }}</h4>
							<span class="fw-medium">{{ $doctor->specialization }}</span>

							<ul class="doctor-info-list mt-30">
								@if ($doctor->qualification)
									<li class="mb-10"><i class="fas fa-graduation-cap blue-color me-2"></i> {{ $doctor->qualification }}</li>
								@endif
								@if ($doctor->experience_years)
									<li class="mb-10"><i class="fas fa-briefcase-medical blue-color me-2"></i> {{ $doctor->experience_years }} years of experience</li>
								@endif
								@if ($doctor->consultation_fee)
									<li class="mb-10"><i class="fas fa-hand-holding-medical blue-color me-2"></i> Consultation Fee: {{ $doctor->consultation_fee }}</li>
								@endif
								@if ($doctor->phone)
									<li class="mb-10"><i class="fas fa-mobile-alt blue-color me-2"></i> {{ $doctor->phone }}</li>
								@endif
								@if ($doctor->email)
									<li class="mb-10"><i class="fas fa-envelope-open-text blue-color me-2"></i> {{ $doctor->email }}</li>
								@endif
							</ul>

							<a href="{{ route('frontend.appointment') }}" class="btn btn-blue blue-hover mt-15">Book an Appointment</a>
						</div><!--end col-->

					</div><!--end row-->
				</div><!--end container-->
			</div><!-- END DOCTOR PROFILE -->

@endsection
