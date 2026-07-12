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




			<!-- PRICING-2 PAGE CONTENT
			============================================= -->
			<div id="pricing-2-page" class="wide-60 blog-page-section division">
				<div class="container">
				 	<div class="row">


				 		<!-- PRICING-2 HOLDER -->
				 		<div class="col-lg-8">
				 			<div class="txt-block pr-30">
				 				
								<!-- Title -->
								<h3 class="h3-md steelblue-color">Patient Pricing Information</h3>

								<!-- Text -->
								<p class="mb-50">Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor 
								   tempus feugiat dolor lacinia cubilia curae integer congue leo metus, primis in orci integer
								   metus mollis faucibus enim. Nemo ipsam egestas volute turpis dolores ut aliquam quaerat
								   sodales sapien undo pretium purus feugiat dolor impedit magna purus pretium gravida donec
								   ligula massa gravida donec pretium 
								</p>

				 				<!-- Plan Title  -->
								<h5 class="h5-md steelblue-color">Regular Diagnostic and Health Care Services</h5>

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
										      	<td>From <span>$1325.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">2</th>
										      	<td>Magnetic Resonance Imaging</td>
										      	<td>From <span>$1435.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">3</th>
										      	<td>Computer Tomography</td>
										      	<td>From <span>$1315.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">4</th>
										      	<td>Laboratory Tests</td>
										      	<td>From <span>$890.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">5</th>
										      	<td>Ultrasound Imaging</td>
										      	<td>From <span>$985.00</span></td>
										    </tr>
										    <tr class="last-tr">
										      	<th scope="row">6</th>
										      	<td>Pregnancy Care Service</td>
										      	<td>From <span>$1130.00</span></td>
										    </tr>
										</tbody>
									</table>
								</div>


								<!-- Plan Title  -->
								<h5 class="h5-md steelblue-color">Emergency Department Charges</h5>

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
										      	<td>From <span>$1340.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">2</th>
										      	<td>Parathyroid Scan</td>
										      	<td>From <span>$765.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">3</th>
										      	<td>Echocardiography</td>
										      	<td>From <span>$1075.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">4</th>
										      	<td>Full Blood Picture</td>
										      	<td>From <span>$950.00</span></td>
										    </tr>
										    <tr>
										      	<th scope="row">5</th>
										      	<td>CT & Ultrasound Diagnostic</td>
										      	<td>From <span>$885.00</span></td>
										    </tr>
										    <tr class="last-tr">
										      	<th scope="row">6</th>
										      	<td>MRI & X-Ray</td>
										      	<td>From <span>$1050.00</span></td>
										    </tr>
										</tbody>
									</table>
								</div>


				 			</div>
				 		</div>	<!-- END PRICING-2 HOLDER -->


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
			</div>	<!-- END PRICING-2 PAGE CONTENT -->




			<!-- PRICING-1
			============================================= -->
			<section id="pricing-1" class="bg-lightgrey wide-60 pricing-section division">
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
			</section>	<!-- END PRICING-1 -->




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
