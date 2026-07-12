@extends('layouts.frontend')

@section('title', 'Meet The Doctors - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'doctors', 'crumb' => 'Meet the Doctors', 'default' => 'Meet the Doctors'])




			<!-- DOCTORS-3
			============================================= -->
			<section id="doctors-3" class="bg-lightgrey wide-60 doctors-section division">
				<div class="container">
					<div class="row">


						@forelse ($doctors as $doctor)
							<div class="col-md-6 col-lg-4">
								<div class="doctor-2">	

									<!-- Doctor Photo -->
									<div class="hover-overlay"> 
										<img class="img-fluid" src="{{ asset('frontend/images/doctor-' . ((($loop->index) % 6) + 1) . '.jpg') }}" alt="{{ $doctor->name }}">	
									</div>										
																
									<!-- Doctor Meta -->		
									<div class="doctor-meta">

										<h5 class="h5-xs blue-color">Dr. {{ $doctor->name }}</h5>
										<span>{{ $doctor->specialization }}</span>

										<!-- Button -->
										<a class="btn btn-sm btn-blue blue-hover mt-15" href="{{ route('frontend.doctor.show', $doctor) }}" title="">View More Info</a>

									</div>	

								</div>								
							</div>
						@empty
							<div class="col-12 text-center py-5">
								<p class="text-muted">Our doctor profiles will be listed here shortly. Please check back soon.</p>
							</div>
						@endforelse


					</div>	    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END DOCTORS-3 -->




			<!-- STATISTIC-1
			============================================= -->
			<div id="statistic-1" class="bg-scroll statistic-section division">
				<div class="container white-color">
					<div class="row">


						<!-- STATISTIC BLOCK #1 -->
						<div class="col-md-6 col-lg-3">						
							<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.4s">

								<!-- Icon  -->
								<span class="flaticon-062-cardiogram-3"></span>

								<!-- Text -->
								<h5 class="statistic-number">9,<span class="count-element">632</span></h5>
								<p class="txt-400">Happy Patients</p>																			
													
							</div>								
						</div>


						<!-- STATISTIC BLOCK #2 -->
						<div class="col-md-6 col-lg-3">								
							<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.6s">

								<!-- Icon  -->
								<span class="flaticon-137-doctor"></span>

								<!-- Text -->
								<h5 class="statistic-number"><span class="count-element">178</span></h5>	
								<p class="txt-400">Qualified Doctors</p>										
																		
							</div>							
						</div>


						<!-- STATISTIC BLOCK #3 -->
						<div class="col-md-6 col-lg-3">					
							<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="0.8s">	

								<!-- Icon  -->
								<span class="flaticon-065-hospital-bed"></span>

								<!-- Text -->
								<h5 class="statistic-number"><span class="count-element">864</span></h5>
								<p class="txt-400">Clinic Rooms</p>									

							</div>						
						</div>
					

						<!-- STATISTIC BLOCK #4 -->
						<div class="col-md-6 col-lg-3">						
							<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="1s">	

								<!-- Icon  -->
								<span class="flaticon-040-placeholder"></span>

								<!-- Text -->	
								<h5 class="statistic-number"><span class="count-element">473</span></h5>
								<p class="txt-400">Local Partners</p>				
								
							</div>						
						</div>


					</div>  <!-- End row -->
				</div>	 <!-- End container -->		
			</div>	 <!-- END STATISTIC-1 -->




			<!-- TESTIMONIALS-2
			============================================= -->
			<section id="reviews-2" class="bg-lightgrey wide-100 reviews-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">What Our Patients Say</h3>	

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
