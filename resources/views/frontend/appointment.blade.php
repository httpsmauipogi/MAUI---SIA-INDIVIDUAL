@extends('layouts.frontend')

@section('title', 'Make an Appointment - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'appointment', 'crumb' => 'Appointment', 'default' => 'Appointment'])




			<!-- APPOINTMENT PAGE
			============================================= -->
			<div id="appointment-page" class="wide-60 appointment-page-section division">
				<div class="container">
				 	<div class="row">


				 		<!-- SERVICE DETAILS -->
				 		<div class="col-lg-8">
				 			<div class="txt-block pr-30">

				 				<!-- Title -->
								<h3 class="h3-md steelblue-color">Book an Appointment</h3>

								<!-- Text -->
								<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat
								   dolor lacinia cubilia curae integer congue leo metus, primis in orci integer metus mollis
								   faucibus enim. Nemo ipsam egestas volute turpis dolores ut aliquam quaerat sodales sapien
								   undo pretium purus feugiat dolor impedit magna purus pretium gravida donec ligula massa 
								   gravida donec pretium 
								</p>

								<!-- APPOINTMENT FORM -->
								<div id="appointment-form-holder" class="text-center">

									@if (session('appointment_status'))
										<div class="alert alert-success text-start" role="alert">
											{{ session('appointment_status') }}
										</div>
									@endif

									@guest
										<div class="alert alert-light text-start border" role="alert">
											<i class="las la-info-circle"></i> Have an account? <a href="{{ route('login') }}">Log in</a> to track this appointment, or <a href="{{ route('patient.register') }}">create a free patient account</a> to keep all your visits, prescriptions and invoices in one place.
										</div>
									@endguest

									<form name="appointmentform" class="row healix-appointment-form" method="POST" action="{{ route('frontend.appointment.store') }}">
										@csrf

										<!-- Form Select -->
						                <div id="input-department" class="col-md-12 input-department">
						                    <select id="inlineFormCustomSelect1" name="department" class="custom-select department">
						                        <option value="">Select Department</option>  
						                      	<option>Pediatrics Department</option>
						                      	<option>Neurology Department</option>
						                      	<option>Haematology Department</option>
						                      	<option>X-Ray Diagnostic Department</option>
						                      	<option>Cardiology Department</option>
						                      	<option>MRI Department</option>
						                      	<option>Laboratory Services</option>
						                      	<option>Other</option>
						                    </select>
						                </div>

						                <!-- Form Select -->
						                <div id="input-doctor" class="col-md-12 input-doctor">
						                    <select id="inlineFormCustomSelect2" name="doctor_id" class="custom-select doctor @error('doctor_id') is-invalid @enderror" required>
						                        <option value="">Select Doctor</option>
						                      	@forelse ($doctors as $doctor)
						                      		<option value="{{ $doctor->id }}" {{ (string) old('doctor_id') === (string) $doctor->id ? 'selected' : '' }}>
						                      			Dr. {{ $doctor->name }} - {{ $doctor->specialization }}
						                      		</option>
						                      	@empty
						                      		<option value="" disabled>No doctors available right now</option>
						                      	@endforelse
						                    </select>
						                    @error('doctor_id') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
						                </div>

						                 <!-- Form Select -->
						                <div id="input-patient" class="col-md-12 input-patient">
						                    <select id="inlineFormCustomSelect3" name="patient_type" class="custom-select patient">
						                        <option value="">Have You Visited Us Before?*</option>
													<option>New Patient</option>
													<option>Returning Patient</option>
													<option>Other</option>
						                    </select>
						                </div>

						                <!-- Gender Select -->
						                <div id="input-gender" class="col-md-12">
						                    <select id="inlineFormCustomSelect4" name="gender" class="custom-select @error('gender') is-invalid @enderror" required>
						                        <option value="">Select Gender*</option>
						                        <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
						                        <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
						                        <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
						                    </select>
						                    @error('gender') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
						                </div>

						                <!-- Contact Form Input -->
						                <div id="input-date" class="col-lg-12">
						                	<input type="date" name="appointment_date" class="form-control date @error('appointment_date') is-invalid @enderror" placeholder="Appointment Date" value="{{ old('appointment_date') }}" min="{{ now()->format('Y-m-d') }}" required> 
						                	@error('appointment_date') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
						                </div>
					                                            
						                <!-- Contact Form Input -->
						                <div id="input-name" class="col-lg-12">
						                	<input type="text" name="name" class="form-control name @error('name') is-invalid @enderror" placeholder="Enter Your Name*" value="{{ old('name') }}" required> 
						                	@error('name') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
						                </div>
						                        
						                <div id="input-email" class="col-lg-12">
						                	<input type="email" name="email" class="form-control email @error('email') is-invalid @enderror" placeholder="Enter Your Email*" value="{{ old('email') }}" required> 
						                	@error('email') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
						                </div>

						                <div id="input-phone" class="col-lg-12">
						                	<input type="tel" name="phone" class="form-control phone @error('phone') is-invalid @enderror" placeholder="Enter Your Phone Number*" value="{{ old('phone') }}" required> 
						                	@error('phone') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
						                </div>						                          
						                        
						                <div id="input-message" class="col-lg-12 input-message">
						                	<textarea class="form-control message" name="message" rows="6" placeholder="Your Message ...">{{ old('message') }}</textarea>
						                </div> 
						                                            
						                <!-- Contact Form Button -->
						                <div class="col-lg-12 form-btn">  
						                	<button type="submit" class="btn btn-blue blue-hover submit">Request an Appointment</button> 
						                </div>
						                                                              
						                </form> 


								</div>	<!-- END APPOINTMENT FORM -->

								<!-- Text -->
								<p class="p-sm grey-color mb-30">* Porta semper lacus cursus, feugiat primis ultrice in ligula risus
								   auctor tempus feugiat dolor lacinia cubilia curae integer congue leo metus, primis in orci 
								   integer metus mollis faucibus enim. Nemo ipsam egestas volute turpis dolores ut aliquam quaerat
								   sodales sapien undo pretium purus
								</p>
								
				 				
				 			</div>
				 		</div>	<!-- END SERVICE DETAILS -->


				 		<!-- SIDEBAR -->
						<aside id="sidebar" class="col-lg-4">


							<!-- TEXT WIDGET -->						
							<div id="txt-widget" class="sidebar-div mb-50">
										
								<!-- Title -->
								<h5 class="h5-sm steelblue-color">The Heart Of Clinic</h5>

								<!-- Head of Clinic -->
								<div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
								
									<!-- Avatar -->
									<div class="txt-widget-avatar">
										<img src="{{ asset('frontend/images/head-of-clinic.jpg') }}" alt="testimonial-avatar">
									</div>

									<!-- Data -->
									<div class="txt-widget-data">
										<h5 class="h5-md steelblue-color">Dr. Jonathan Barnes</h5>	
										<span>Chief Medical Officer, Founder</span>	
										<p class="blue-color">1-800-1234-567</p>	
									</div>

								</div>	<!-- End Head of Clinic -->	
								
								<!-- Text -->
								<p class="p-sm">An enim nullam tempor sapien at gravida donec pretium ipsum porta justo
								   integer at odiovelna vitae auctor integer congue magna purus
								</p>

								<!-- Button -->
								<a href="{{ route('frontend.about') }}" class="btn btn-blue blue-hover">Learn More</a>
																		
							</div>	<!-- END TEXT WIDGET -->

								
							<!-- SIDEBAR TABLE -->
							<div class="sidebar-table blue-table sidebar-div mb-50">

								<!-- Title -->
								<h5 class="h5-md">Working Time</h5>

								<!-- Text -->
								<p class="p-sm">Porta semper lacus cursus, feugiat primis ultrice ligula risus auctor at
								   tempus feugiat dolor lacinia cursus nulla vitae massa
								</p>

								<!-- Table -->
								<table class="table">
									<tbody>
									    <tr>
									      	<td>Mon – Wed</td>
									      	<td> - </td>
									      	<td class="text-right">9:00 AM - 7:00 PM</td>
									    </tr>
									    <tr>
									      	<td>Thursday</td>
									      	<td> - </td>
									      	<td class="text-right">9:00 AM - 6:30 PM</td>
									    </tr>
									     <tr>
									      	<td>Friday</td>
									      	<td> - </td>
									      	<td class="text-right">9:00 AM - 6:00 PM</td>
									    </tr>
									    <tr class="last-tr">
									      	<td>Sun - Sun</td>
									      	<td>-</td>
									      	<td class="text-right">CLOSED</td>
									   	 </tr>
									  </tbody>
								</table>

								<!-- Title -->
								<h5 class="h5-xs">Need a personal health plan?</h5>

								<!-- Text -->
								<p class="p-sm">Porta semper lacus cursus, and feugiat primis ultrice ligula at risus auctor</p>

							</div>	<!-- END SIDEBAR TABLE -->


						</aside>   <!-- END SIDEBAR -->


					</div>	<!-- End row -->	
				</div>	 <!-- End container -->
			</div>	<!-- END APPOINTMENT PAGE -->

	


			<!-- FOOTER-1
			============================================= -->
@endsection
