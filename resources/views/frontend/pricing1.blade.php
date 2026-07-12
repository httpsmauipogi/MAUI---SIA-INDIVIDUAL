@extends('layouts.frontend')

@section('title', 'Pricing Packages - Healix HMS')

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
								    	<li class="breadcrumb-item active" aria-current="page">Our Pricing</li>
								  	</ol>
								</nav>

								<!-- Title -->
								<h4 class="h4-sm steelblue-color">Our Pricing</h4>

							</div>
						</div>
					</div>  <!-- End row -->	
				</div>	<!-- End container -->		
			</div>	<!-- END BREADCRUMB -->	




			<!-- PRICING-1
			============================================= -->
			<section id="pricing-1" class="wide-60 pricing-section division">
				<div class="container">	


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">	

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Best Quality Medical Treatment</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
								
						</div>
					</div>

					
					<!-- PRICING TABLES -->	
					<div class="row pricing-row">


						<!-- PRICING TABLE #1 -->
						<div class="col-lg-4">
							<div class="pricing-table icon-xl">	

								<!-- Icon -->
								<span class="flaticon-104-blood-sample blue-color"></span>	

								<!-- Title -->
								<h5 class="h5-lg">Blood Test</h5>	
		
								<!-- Plan Price  -->
								<div class="pricing-plan">									
									<sup class="steelblue-color">$</sup>								
									<span class="price steelblue-color">45</span>
									<p class="p-md">monthly</p>
								</div>	
																							
								<!-- Pricing Plan Features  -->
								<ul class="features">
									<li>Medical Specialties</li>
									<li>Medical Consultation</li>																	
									<li>Investigations</li>
									<li>Medical Treatments</li>							
								</ul>

								<!-- Pricing Table Button  -->
								<a href="#" class="btn btn-md btn-tra-black blue-hover">Select Plan</a>
												
							</div>
						</div>	<!-- END PRICING TABLE #1 -->


						<!-- PRICING TABLE #2 -->
						<div class="col-lg-4">
							<div class="pricing-table icon-xl">

								<!-- Icon -->
								<span class="flaticon-072-hospital-5 blue-color"></span>

								<!-- Title -->
								<h5 class="h5-lg">Medical Care</h5>			
											
								<!-- Plan Price  -->
								<div class="pricing-plan">							
									<sup class="steelblue-color">$</sup>								
									<span class="price steelblue-color">350</span>
									<p class="p-md">monthly</p>
								</div>	
																							
								<!-- Pricing Plan Features  -->
								<ul class="features">
									<li>Medical Specialties</li>
									<li>Medical Consultation</li>																	
									<li>Investigations</li>
									<li>Medical Treatments</li>								
								</ul>

								<!-- Pricing Table Button  -->
								<a href="#" class="btn btn-md btn-blue blue-hover">Select Plan</a>
												
							</div>
						</div>	<!-- END PRICING TABLE #1 -->


						<!-- PRICING TABLE #3 -->
						<div class="col-lg-4">
							<div class="pricing-table icon-xl">	

								<!-- Icon -->
								<span class="flaticon-143-teeth blue-color"></span>		

								<!-- Title -->
								<h5 class="h5-lg">Dental Care</h5>

								<!-- Plan Price  -->
								<div class="pricing-plan">								
									<sup class="steelblue-color">$</sup>								
									<span class="price steelblue-color">235</span>
									<p class="p-md">monthly</p>
								</div>	
																							
								<!-- Pricing Plan Features  -->
								<ul class="features">
									<li>Medical Specialties</li>
									<li>Medical Consultation</li>																	
									<li>Investigations</li>
									<li>Medical Treatments</li>								
								</ul>

								<!-- Pricing Table Button  -->
								<a href="#" class="btn btn-md btn-tra-black blue-hover">Select Plan</a>
												
							</div>
						</div>	<!-- END PRICING TABLE #3 -->
						

					</div>	<!-- END PRICING TABLES -->	


				</div>    <!-- End container -->		
			</section>	<!-- END PRICING-1 -->




			<!-- PRICING-2
			============================================= -->
			<section id="pricing-2" class="pb-60 pricing-section division">
				<div class="container">	
					<div class="row pricing-row">


						<!-- PRICING TABLE #1 -->
						<div class="col-lg-6">

							<!-- Plan Title  -->
							<h5 class="h5-md steelblue-color">Treatments</h5>

							<div class="pricing-table mb-40">								
								<table class="table table-hover">
									<thead>
									    <tr>
									      	<th scope="col">#</th>
									      	<th scope="col">Service</th>
									      	<th scope="col">Price</th>
									    </tr>
									</thead>
									<tbody>
									    <tr>
									      	<th scope="row">1</th>
									     	<td>X-Ray</td>
									      	<td>From <span>$325.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">2</th>
									      	<td>Magnetic Resonance Imaging</td>
									      	<td>From <span>$435.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">3</th>
									      	<td>Computer Tomography</td>
									      	<td>From <span>$315.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">4</th>
									      	<td>Laboratory Tests</td>
									      	<td>From <span>$90.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">5</th>
									      	<td>Ultrasound Imaging</td>
									      	<td>From <span>$285.00</span></td>
									    </tr>
									    <tr class="last-tr">
									      	<th scope="row">6</th>
									      	<td>Pregnancy Care Service</td>
									      	<td>From <span>$530.00</span></td>
									    </tr>
									</tbody>
								</table>
							</div>
						</div>	<!-- END PRICING TABLE #1 -->


						<!-- PRICING TABLE #2 -->
						<div class="col-lg-6">

							<!-- Plan Title  -->
							<h5 class="h5-md steelblue-color">Investigations</h5>

							<div class="pricing-table mb-40">	
								<table class="table table-hover">
									<thead>
									    <tr>
									      	<th scope="col">#</th>
									      	<th scope="col">Service</th>
									      	<th scope="col">Price</th>
									    </tr>
									</thead>
									<tbody>
									    <tr>
									      	<th scope="row">1</th>
									     	<td>Bronchoscopy</td>
									      	<td>From <span>$340.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">2</th>
									      	<td>Parathyroid Scan</td>
									      	<td>From <span>$65.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">3</th>
									      	<td>Echocardiography</td>
									      	<td>From <span>$175.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">4</th>
									      	<td>Full Blood Picture</td>
									      	<td>From <span>$250.00</span></td>
									    </tr>
									    <tr>
									      	<th scope="row">5</th>
									      	<td>CT & Ultrasound Diagnostic</td>
									      	<td>From <span>$285.00</span></td>
									    </tr>
									    <tr class="last-tr">
									      	<th scope="row">6</th>
									      	<td>MRI & X-Ray</td>
									      	<td>From <span>$450.00</span></td>
									    </tr>
									</tbody>
								</table>
							</div>
						</div>	<!-- END PRICING TABLE #2 -->

	
					</div>	<!-- End row -->


					<!-- ALL PRICING TABLES BUTTON -->
					<div class="row">
						<div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2 text-center">							
							<div class="all-pricing-btn mb-40">

								<!-- Price Notice -->
								<p><span>Note!</span> Feugiat eros, ac tincidunt ligula massa in faucibus orci luctus et
								   ultrices posuere cubilia and curae integer congue leo metus mollis primis and mauris 
								   lectus laoreet tempor
								</p>

							</div>
						</div>
					</div>


				</div>    <!-- End container -->		
			</section>	<!-- END PRICING-2 -->




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




			<!-- BANNER-5
			============================================= -->
			<section id="banner-5" class="pt-100 banner-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Certified and Experienced Doctors</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
										
						</div> 
					</div>


					<!-- BANNER IMAGE -->
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<div class="banner-5-img wow fadeInUp" data-wow-delay="0.4s">
								<img class="img-fluid" src="{{ asset('frontend/images/image-07.png') }}" alt="banner-image" />
							</div>
						</div>
					</div>


				</div>	   <!-- End container -->	
			</section>	<!-- END BANNER-5 -->




			<!-- FOOTER-1
			============================================= -->
@endsection
