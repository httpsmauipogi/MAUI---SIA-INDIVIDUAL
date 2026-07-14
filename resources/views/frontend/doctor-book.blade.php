@extends('layouts.frontend')

@section('title', 'Book Appointment with Dr. ' . $doctor->name . ' - Healix HMS')

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
								    	<li class="breadcrumb-item"><a href="{{ route('frontend.doctors') }}">Doctors</a></li>
								    	<li class="breadcrumb-item"><a href="{{ route('frontend.doctor.show', $doctor) }}">Dr. {{ $doctor->name }}</a></li>
								    	<li class="breadcrumb-item active" aria-current="page">Book Appointment</li>
								  	</ol>
								</nav>
								<h4 class="h4-sm steelblue-color">Book Appointment with Dr. {{ $doctor->name }}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>	<!-- END BREADCRUMB -->

			<!-- BOOKING FORM
			============================================= -->
			<div class="wide-60 division">
				<div class="container">
					<div class="row justify-content-center">

						<!-- Doctor Summary -->
						<div class="col-lg-4 mb-40 mb-lg-0">
							<div class="text-center mb-30">
								<img class="img-fluid rounded" src="{{ $doctor->photoUrl() }}" alt="Dr. {{ $doctor->name }}">
							</div>
							<h5 class="steelblue-color">Dr. {{ $doctor->name }}</h5>
							<p class="grey-color mb-1">{{ $doctor->specialization }}</p>
							@if ($doctor->consultation_fee)
								<p class="mb-1"><strong>Consultation Fee:</strong> {{ $doctor->consultation_fee }}</p>
							@endif
							@if ($doctor->branch)
								<p class="mb-1"><strong>Location:</strong> {{ $doctor->branch }}
									@if ($doctor->floor) &middot; Floor {{ $doctor->floor }} @endif
									@if ($doctor->room_no) &middot; Room {{ $doctor->room_no }} @endif
								</p>
							@endif

							@if ($doctor->schedules->isNotEmpty())
								<div class="mt-20">
									<p class="fw-medium mb-10">Weekly Schedule</p>
									<ul class="list-unstyled">
										@foreach ($doctor->schedules as $slot)
											<li class="mb-5"><i class="fas fa-clock blue-color me-2"></i>{{ $slot->day_of_week }}: {{ $slot->formattedTime() }}</li>
										@endforeach
									</ul>
								</div>
							@endif
						</div><!--end col-->

						<!-- Booking Form -->
						<div class="col-lg-7">
							<div class="form-holder">

								@if ($errors->any())
									<div class="alert alert-danger">
										<ul class="mb-0">
											@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
											@endforeach
										</ul>
									</div>
								@endif

								<form method="POST" action="{{ route('frontend.doctor.book.store', $doctor) }}" class="row contact-form">
									@csrf

									<div class="col-md-6">
										<input type="date" name="appointment_date" class="form-control" min="{{ now()->format('Y-m-d') }}" value="{{ old('appointment_date') }}" required>
									</div>
									<div class="col-md-6">
										<select name="gender" class="custom-select" required>
											<option value="">Select Gender*</option>
											<option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
											<option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
											<option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
										</select>
									</div>
									<div class="col-md-12">
										<input type="text" name="name" class="form-control" placeholder="Enter Your Name*" value="{{ old('name') }}" required>
									</div>
									<div class="col-md-6">
										<input type="email" name="email" class="form-control" placeholder="Enter Your Email*" value="{{ old('email') }}" required>
									</div>
									<div class="col-md-6">
										<input type="tel" name="phone" class="form-control" placeholder="Enter Your Phone Number*" value="{{ old('phone') }}" required>
									</div>
									<div class="col-12">
										<textarea class="form-control" name="message" rows="4" placeholder="Reason for visit (optional)">{{ old('message') }}</textarea>
									</div>

									<div class="col-lg-12 form-btn">
										<button type="submit" class="btn btn-blue blue-hover submit">Confirm Booking</button>
									</div>
								</form>

							</div>
						</div><!--end col-->

					</div><!--end row-->
				</div><!--end container-->
			</div>

@endsection
