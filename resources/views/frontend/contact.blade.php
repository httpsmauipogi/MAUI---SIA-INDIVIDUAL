@extends('layouts.frontend')

@section('title', 'Contact Us - Healix HMS')

@section('content')




			<!-- GOOGLE MAP
			============================================= -->
			<div id="gmap" class="gmap"></div>




			<!-- CONTACTS-1
			============================================= -->
			<section id="contacts-1" class="wide-60 contacts-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">	

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Have a Question? Get In Touch</h3>	

							<!-- Text -->
							<p>Have a question? Want to book an appointment for yourself or your children? Give us a call
							   or send an email to contact the Healix HMS.
							</p>
								
						</div>
					</div>

						
					<div class="row">	


		 				<!-- CONTACTS INFO -->
		 				<div class="col-md-5 col-lg-4">

		 					<!-- Managed from Admin > Page Content > Contact > Contact Info Boxes -->
		 					@foreach ($infoBoxCards as $card)
		 					<div class="contact-box mb-40">
								<h5 class="h5-sm steelblue-color">{{ $card->title }}</h5>
								{!! nl2br(e($card->description)) !!}
		 					</div>
							@endforeach

						</div>	<!-- END CONTACTS INFO -->


						<!-- CONTACT FORM -->	
				 		<div class="col-md-7 col-lg-8">
				 			<div class="form-holder mb-40">
				 			<form name="contactForm" class="row healix-contact-form" method="POST" action="{{ route('frontend.contact.store') }}">
				 				@csrf

				 				@if (session('contact_status'))
										<div class="col-lg-12">
											<div class="alert alert-success text-start" role="alert">
												{{ session('contact_status') }}
											</div>
										</div>
									@endif
				                                            
					                <!-- Contact Form Input -->
					                <div id="input-name" class="col-md-12 col-lg-6">
					                	<input type="text" name="name" class="form-control name @error('name') is-invalid @enderror" placeholder="Enter Your Name*" value="{{ old('name') }}" required> 
					                	@error('name') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
					                </div>
					                        
					                <div id="input-email" class="col-md-12 col-lg-6">
					                	<input type="email" name="email" class="form-control email @error('email') is-invalid @enderror" placeholder="Enter Your Email*" value="{{ old('email') }}" required> 
					                	@error('email') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
					                </div>

					                <div id="input-phone" class="col-md-12 col-lg-6">
					                	<input type="tel" name="phone" class="form-control phone @error('phone') is-invalid @enderror" placeholder="Enter Your Phone Number*" value="{{ old('phone') }}"> 
					                	@error('phone') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
					                </div>	

					                <!-- Form Select -->
					                <div id="input-patient" class="col-md-12 col-lg-6 input-patient">
					                    <select id="inlineFormCustomSelect3" name="patient" class="custom-select patient">
					                        <option value="">Have You Visited Us Before?*</option>
												<option>New Patient</option>
												<option>Returning Patient</option>
												<option>Other</option>
					                    </select>
					                </div>

					                <div id="input-subject" class="col-lg-12">
					                	<input type="text" name="subject" class="form-control subject @error('subject') is-invalid @enderror" placeholder="Subject*" value="{{ old('subject') }}"> 
					                	@error('subject') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
					                </div>					                          
					                        
					                <div id="input-message" class="col-lg-12 input-message">
					                	<textarea class="form-control message @error('message') is-invalid @enderror" name="message" rows="6" placeholder="Your Message ..." required>{{ old('message') }}</textarea>
					                	@error('message') <div class="text-danger text-start fs-13 mt-1">{{ $message }}</div> @enderror
					                </div> 
					                                            
					                <!-- Contact Form Button -->
					                <div class="col-lg-12 mt-15 form-btn">  
					                	<button type="submit" class="btn btn-blue blue-hover submit">Send Your Message</button> 
					                </div>
					                                                              
					                </form> 


				 			</div>	
				 		</div> 	<!-- END CONTACT FORM -->	


				 	</div>	<!-- End row -->			  
 

				</div>	   <!-- End container -->		
			</section>	<!-- END CONTACTS-1 -->




			<!-- FOOTER-1
			============================================= -->
@endsection
