@extends('layouts.frontend')

@section('title', 'Appointment Confirmed - Healix HMS')

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
								    	<li class="breadcrumb-item active" aria-current="page">Appointment Confirmed</li>
								  	</ol>
								</nav>
								<h4 class="h4-sm steelblue-color">Appointment Confirmed</h4>
							</div>
						</div>
					</div>
				</div>
			</div>	<!-- END BREADCRUMB -->

			<!-- CONFIRMATION
			============================================= -->
			<div class="wide-60 division">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-7">

							<div class="text-center mb-40">
								<i class="fas fa-check-circle" style="font-size: 64px; color: #28a745;"></i>
								<h4 class="steelblue-color mt-20">Thank you, {{ $appointment->patient->name }}!</h4>
								<p class="grey-color">Your appointment request has been received. Please arrive 15 minutes early with this serial number.</p>
							</div>

							<div class="p-4" style="border: 2px dashed #3454d1; border-radius: 10px;">

								<div class="text-center mb-30">
									<p class="grey-color mb-1 text-uppercase">Your Serial Number</p>
									<h1 class="steelblue-color mb-0" style="font-size: 56px;">{{ $appointment->serial_number ?? '-' }}</h1>
									<p class="grey-color">for {{ $appointment->appointment_date->format('l, d M Y') }}</p>
								</div>

								<table class="table table-borderless mb-0">
									<tbody>
										<tr>
											<td class="grey-color">Doctor</td>
											<td class="text-end fw-medium">Dr. {{ $appointment->doctor->name ?? 'N/A' }}</td>
										</tr>
										<tr>
											<td class="grey-color">Specialization</td>
											<td class="text-end fw-medium">{{ $appointment->doctor->specialization ?? '-' }}</td>
										</tr>
										@if ($appointment->doctor?->branch)
											<tr>
												<td class="grey-color">Branch</td>
												<td class="text-end fw-medium">{{ $appointment->doctor->branch }}</td>
											</tr>
										@endif
										@if ($appointment->doctor?->floor)
											<tr>
												<td class="grey-color">Floor</td>
												<td class="text-end fw-medium">{{ $appointment->doctor->floor }}</td>
											</tr>
										@endif
										@if ($appointment->doctor?->room_no)
											<tr>
												<td class="grey-color">Room No</td>
												<td class="text-end fw-medium">{{ $appointment->doctor->room_no }}</td>
											</tr>
										@endif
										<tr>
											<td class="grey-color">Appointment Date</td>
											<td class="text-end fw-medium">{{ $appointment->appointment_date->format('d M, Y') }}</td>
										</tr>
										<tr>
											<td class="grey-color">Scheduled Time</td>
											<td class="text-end fw-medium">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
										</tr>
										@if ($appointment->doctor?->consultation_fee)
											<tr>
												<td class="grey-color">Consultation Fee</td>
												<td class="text-end fw-medium">{{ $appointment->doctor->consultation_fee }}</td>
											</tr>
										@endif
										<tr>
											<td class="grey-color">Appointment No</td>
											<td class="text-end fw-medium">{{ $appointment->appointment_no }}</td>
										</tr>
									</tbody>
								</table>

							</div>

							<div class="text-center mt-40">
								<a href="{{ route('frontend.home') }}" class="btn btn-blue blue-hover">Back to Home</a>
								<button type="button" class="btn btn-tra-grey grey-hover" onclick="window.print()">Print</button>
							</div>

						</div><!--end col-->
					</div><!--end row-->
				</div><!--end container-->
			</div>

@endsection
