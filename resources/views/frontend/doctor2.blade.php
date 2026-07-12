@extends('layouts.frontend')

@section('title', 'Doctor's Profile - Healix HMS')

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
								    	<li class="breadcrumb-item"><a href="{{ route('frontend.doctors') }}">Our Doctors</a></li>
								    	<li class="breadcrumb-item active" aria-current="page">Doctor Page</li>
								  	</ol>
								</nav>

								<!-- Title -->
								<h4 class="h4-sm steelblue-color">Doctor Profile</h4>

							</div>
						</div>
					</div>  <!-- End row -->	
				</div>	<!-- End container -->		
			</div>	<!-- END BREADCRUMB -->	




			<!-- DOCTOR-2 DETAILS -->
			<section id="doctor-2-details" class="wide-70 doctor-details-section division">	
				<div class="container">
					<div class="row">


						<!-- DOCTOR PHOTO -->
						<div class="col-md-5 col-xl-5">
			 				<div class="doctor-photo mb-30 text-center">

			 					<!-- Photo -->	
			 					<img class="img-fluid" src="{{ asset('frontend/images/doctor-5.jpg') }}" alt="doctor-foto">

			 					<!-- Text -->	
						   		<p class="mt-30">Etiam sapien sem magna at vitae pulvinar congue augue egestas pretium neque
						   		   id viverra suscipit egestas magna porta ratione, mollis risus lectus porta rutrum arcu aenean
						   		</p>

			 					<!-- Doctor Contacts -->	
			 					<div class="doctor-contacts">
				 					<h4 class="h4-xs"><i class="fas fa-mobile-alt"></i> 1-(800)-569-7890</h4>
									<h4 class="h4-xs blue-color"><i class="fas fa-envelope-open-text"></i> 
										<a href="mailto:yourdomain@mail.com" class="blue-color">hello@yourdomain.com</a>
									</h4>
								</div>

			 					<!-- Button -->
								<a href="{{ route('frontend.appointment') }}" class="btn btn-md btn-blue blue-hover">Book an Appointment</a>

								<!-- Button -->
								<a href="{{ route('frontend.timetable') }}" class="btn btn-md btn-tra-grey grey-hover">View Timetable</a>

			 				</div>
			 			</div>	<!-- END DOCTOR PHOTO -->


			 			<!-- DOCTOR'S BIO -->
						<div class="col-md-6 col-xl-6 offset-xl-1">
							<div class="doctor-bio">

								<!-- Name -->	
			 					<h2 class="h2-sm blue-color">Dr. Robert Peterson</h2>
			 					<h5 class="h5-lg blue-color">Neurologist / Epilepsy Specialist / Cardiologist</h5>

			 					<!-- Text -->	
						   		<p>Etiam sapien sem magna at vitae pulvinar congue augue egestas pretium neque id viverra
						   		   suscipit egestas magna porta ratione, mollis risus lectus porta rutrum arcu aenean
						   		   primis in augue luctus neque purus ipsum neque dolor primis suscipit in magna dignissim,
						   		   porttitor hendrerit diam
						   		</p>

						   		<!-- Text -->  
								<p>In at mauris vel nisl convallis porta at vitae dui. Nam lacus ligula, vulputate molestie 
								   bibendum quis, aliquet elementum massa. Vestibulum ut sagittis odio. Ac massa lorem. Fusce eu
								   cursus est. Fusce non nulla vitae massa placerat vulputate vel a purus. Aliqum  mullam blandit
								   tempor sapien
								</p>	

						   		<!-- Title -->	
								<h5 class="h5-md blue-color">Education + Trainings</h5>

						   		<!-- Text -->
								<p>Aliqum  mullam blandit tempor sapien gravida donec ipsum, at porta justo. Velna vitae
								   auctor congue magna nihil impedit ligula risus. Mauris donec ociis et magnis sapien etiam
								   sapien sem sagittis congue tempor gravida
								</p>

								<!-- Option #1 -->
								<div class="box-list m-top-15">							
									<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
									<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
								</div>

								<!-- Option #2 -->
								<div class="box-list">	
									<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
									<p class="p-sm">Magna luctus tempor augue vitae laoreet augue in cubilia risus auctor tempus
									   dolor felis lacinia risus auctor id viverra dolor
									 </p>				
								</div>

								<!-- Option #3 -->
								<div class="box-list">	
									<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
									<p class="p-sm">Ligula risus auctor tempus dolor feugiat, felis lacinia risus interdum auctor 
									   id viverra dolor iaculis luctus 
									</p>				
								</div>	

								<!-- Option #3 -->
								<div class="box-list">	
									<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
									<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
								</div>	

								<!-- CERTIFICATES -->	
								<div class="certificates">

									<!-- Title -->	
									<h5 class="h5-md blue-color">Diplomas and Certificates</h5>

									<!-- Certificate Preview -->
									<div class="row">

										<!-- Certificate Image -->
										<div class="col-sm-6 col-lg-4">
											<div class="certificate-image">
												<a class="image-link" href="{{ asset('frontend/images/certificate-1.png') }}" title="">
													<img class="img-fluid" src="{{ asset('frontend/images/certificate-1.png') }}" alt="certificate-image" />
												</a>
											</div>
										</div>
															
										<!-- Certificate Image -->
										<div class="col-sm-6 col-lg-4">
											<div class="certificate-image">
												<a class="image-link" href="{{ asset('frontend/images/certificate-2.png') }}" title="">
													<img class="img-fluid" src="{{ asset('frontend/images/certificate-2.png') }}" alt="certificate-image" />
												</a>
											</div>
										</div>
															
										<!-- Certificate Image -->
										<div class="col-sm-6 col-lg-4">
											<div class="certificate-image">
												<a class="image-link" href="{{ asset('frontend/images/certificate-3.png') }}" title="">
													<img class="img-fluid" src="{{ asset('frontend/images/certificate-3.png') }}" alt="certificate-image" />
												</a>
											</div>
										</div>
															
										<!-- Certificate Image -->
										<div class="col-sm-6 col-lg-4">
											<div class="certificate-image">
												<a class="image-link" href="{{ asset('frontend/images/certificate-4.png') }}" title="">
													<img class="img-fluid" src="{{ asset('frontend/images/certificate-4.png') }}" alt="certificate-image" />
												</a>
											</div>
										</div>
															
										<!-- Certificate Image -->
										<div class="col-sm-6 col-lg-4">
											<div class="certificate-image">
												<a class="image-link" href="{{ asset('frontend/images/certificate-5.png') }}" title="">
													<img class="img-fluid" src="{{ asset('frontend/images/certificate-5.png') }}" alt="certificate-image" />
												</a>
											</div>
										</div>
										
									</div>
								</div>	<!-- END CERTIFICATES -->	

							</div>
						</div>	<!-- END DOCTOR BIO -->


					</div>   <!-- End row -->	
				</div>	  <!-- End container -->
			</section> <!-- END  DOCTOR-2 DETAILS -->




			<!-- TESTIMONIALS-2
			============================================= -->
			<section id="reviews-2" class="bg-lightgrey wide-100 reviews-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">What Patients Say About Robert</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
										
						</div> 
					</div>	 <!-- END SECTION TITLE -->
				
					
					<!-- TESTIMONIALS CONTENT -->
					<div class="row">
						<div class="col-md-12">					
							<div class="owl-carousel owl-theme reviews-holder">

						
								<!-- TESTIMONIAL #1 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>	

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-1.jpg') }}" alt="testimonial-avatar">
										</div>
																
										<!-- Testimonial Text -->
										<p>Etiam sapien sem at sagittis congue an augue massa varius egestas a suscipit
										   magna undo tempus aliquet porta vitae
										</p>	

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Scott Boxer</h5>	
											<span>Programmer</span>	
										</div>							
																
									</div>						
								</div>	<!--END  TESTIMONIAL #1 -->
						
						
								<!-- TESTIMONIAL #2 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>	

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-2.jpg') }}" alt="testimonial-avatar">
										</div>
																
										<!-- Testimonial Text -->
										<p>Mauris donec ociis magnisa a sapien etiam sapien congue augue egestas et ultrice
										   vitae purus diam integer congue magna ligula egestas
										</p>										

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Penelopa Peterson</h5>	
											<span>Project Manager</span>	
										</div>

									</div>						
								</div>	<!-- END TESTIMONIAL #2 -->
						
						
								<!-- TESTIMONIAL #3 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>	

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-3.jpg') }}" alt="testimonial-avatar">
										</div>
																
										<!-- Testimonial Text -->
										<p>At sagittis congue augue an egestas magna ipsum vitae purus ipsum primis undo cubilia
										   laoreet augue	   
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">M.Scanlon</h5>	
											<span>Photographer</span>	
										</div>

									</div>						
								</div>	<!-- END TESTIMONIAL #3 -->


								<!-- TESTIMONIAL #4 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-4.jpg') }}" alt="testimonial-avatar">
										</div>	
																
										<!-- Testimonial Text -->
										<p>Mauris donec ociis magnis sapien etiam sapien congue augue pretium ligula 
										   a lectus aenean magna mauris
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Jeremy Kruse</h5>	
											<span>Graphic Designer</span>	
										</div>
					
									</div>						
								</div>	<!-- END TESTIMONIAL #4 -->
								
								
								<!-- TESTIMONIAL #5 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>	

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-5.jpg') }}" alt="testimonial-avatar">
										</div>
																
										<!-- Testimonial Text -->
										<p>An augue in cubilia laoreet magna suscipit egestas magna ipsum at purus ipsum
										   primis in augue ulta ligula egestas
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Evelyn Martinez</h5>	
											<span>Senior UX/UI Designer</span>	
										</div>						
																
									</div>						
								</div>	<!-- END TESTIMONIAL #5 -->
								
								
								<!-- TESTIMONIAL #6 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-6.jpg') }}" alt="testimonial-avatar">
										</div>	
																
										<!-- Testimonial Text -->
										<p>An augue cubilia laoreet undo magna at risus suscipit egestas magna an ipsum ligula
										   vitae and purus ipsum primis
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Dan Hodges</h5>	
											<span>Internet Surfer</span>	
										</div>

									</div>						
								</div>	<!-- END TESTIMONIAL #6 -->
								
								
								<!-- TESTIMONIAL #7 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>	

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-7.jpg') }}" alt="testimonial-avatar">
										</div>
																
										<!-- Testimonial Text -->
										<p>Augue egestas volutpat egestas augue in cubilia laoreet magna suscipit luctus
										   and dolor blandit vitae
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Isabel M.</h5>	
											<span>SEO Manager</span>	
										</div>

									</div>						
								</div>	<!-- END TESTIMONIAL #7 -->


								<!-- TESTIMONIAL #8 -->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>	

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-8.jpg') }}" alt="testimonial-avatar">
										</div>
																
										<!-- Testimonial Text -->
										<p>Augue egestas volutpat egestas augue in cubilia laoreet magna suscipit luctus
										   and dolor blandit vitae
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Alex Ross</h5>	
											<span>Patient</span>	
										</div>							
																
									</div>						
								</div>	<!-- END TESTIMONIAL #8 -->


								<!-- TESTIMONIAL #9-->
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ asset('frontend/images/review-author-9.jpg') }}" alt="testimonial-avatar">
										</div>	
																
										<!-- Testimonial Text -->
										<p>Augue egestas volutpat egestas augue in cubilia laoreet magna suscipit luctus
										   magna dolor neque vitae 								   
										</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">Alisa Milano</h5>	
											<span>Housewife</span>	
										</div>
						
									</div>						
								</div>	<!-- END TESTIMONIAL #9 -->

							
							</div>
						</div>									
					</div>	<!-- END TESTIMONIALS CONTENT --> 
							
						
				</div>	   <!-- End container -->
			</section>	 <!-- END TESTIMONIALS-2 -->


	

			<!-- FOOTER-1
			============================================= -->
@endsection
