@extends('layouts.frontend')

@section('title', 'Who We Are - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'who-we-are', 'crumb' => 'Who We Are', 'default' => 'Who We Are'])




			<!-- INFO-1
			============================================= -->
			<section id="info-1" class="wide-60 info-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-lg-6">
							<div class="info-1-img text-center mb-40 wow fadeInUp" data-wow-delay="0.6s">
								<img class="img-fluid" src="{{ asset('frontend/images/flat-lay-health-still-life-arrangement-with-copy-space.jpg') }}" alt="info-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
						<div class="col-lg-6">
							<div class="txt-block pc-30 mb-40 wow fadeInUp" data-wow-delay="0.4s">

								<!-- Section ID -->	
					 			<span class="section-id blue-color">Welcome to Healix HMS</span>

								<!-- Title -->
								<h3 class="h3-md steelblue-color">Clinic with Innovative Approach to Treatment</h3>

								<!-- Text -->
								<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
								   porta justo integer odio velna vitae auctor integer congue magna at pretium 
								   purus pretium ligula rutrum itae laoreet augue posuere and curae integer 
								   congue leo metus mollis primis and mauris
								</p>

								<!-- Options List -->
								<div class="row">

									<div class="col-xl-6">

										<!-- Option #1 -->
										<div class="box-list m-top-15">							
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
										</div>

										<!-- Option #2 -->
										<div class="box-list">	
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">Magna luctus tempor</p>				
										</div>

										<!-- Option #3 -->
										<div class="box-list">	
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
										</div>

									</div>

									<div class="col-xl-6">

										<!-- Option #4 -->
										<div class="box-list">	
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
										</div>

										<!-- Option #5 -->
										<div class="box-list m-top-15">							
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
										</div>

										<!-- Option #6 -->
										<div class="box-list">	
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">An enim nullam tempor</p>				
										</div>

									</div>

								</div>	<!-- End Options List -->

							</div>
						</div>	<!-- END TEXT BLOCK -->	

						
					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END INFO-1 -->




			<!-- SERVICES-3
			============================================= -->
			<section id="services-3" class="bg-lightgrey wide-100 services-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Total Health Care Solutions</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
										
						</div> 
					</div>
				
					
					<!-- SERVICES CONTENT -->
					<div class="row">
						<div class="col-md-12">					
							<div class="owl-carousel owl-theme services-holder">

						
								<!-- SERVICE BOX #1 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-083-stethoscope"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">Pediatrics</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #2 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-047-head"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">Neurology</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #3 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-015-blood-donation-1"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">Haematology</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #4 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-048-lungs"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">X-Ray Diagnostic</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #5 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-060-cardiogram-4"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">Cardiology</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #6 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-031-scanner"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">MRI Diagnostic</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #7 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-076-microscope"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">Laboratory Services</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>


								<!-- SERVICE BOX #8 -->
								<div class="sbox-3 icon-sm">

									<!-- Icon -->
									<div class="sbox-3-icon">
										<span class="flaticon-068-ambulance-3"></span>
									</div>
										
									<!-- Title -->
									<h5 class="h5-xs steelblue-color">Emergency Help</h5>

									<!-- Text -->
									<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
									   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
									</p>
																																						
								</div>

							
							</div>
						</div>									
					</div>	<!-- END SERVICES CONTENT --> 
							
						
				</div>	   <!-- End container -->
			</section>	 <!-- END SERVICES-3 -->




			<!-- ABOUT-5
			============================================= -->
			<section id="about-5" class="pt-100 about-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-lg-6">
							<div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
										<img class="img-fluid" src="{{ asset('frontend/images/medical_complex_700x700.jpg') }}" alt="about-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
						<div class="col-lg-6">
							<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

								<!-- Section ID -->	
					 			<span class="section-id blue-color">Best Practices</span>

								<!-- Title -->
								<h3 class="h3-md steelblue-color">Complete Medical Solutions in One Place</h3>

								<!-- Text -->
								<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat
								   dolor lacinia cubilia curae integer congue leo metus, eu mollislorem primis in orci integer
								   metus mollis faucibus. An enim nullam tempor sapien gravida donec pretium and ipsum porta
								   justo integer at velna vitae auctor integer congue
								</p>

								<!-- Singnature -->
								<div class="singnature mt-35">

									<!-- Text -->
									<p class="p-small mb-15">Randon Pexon, Head of Clinic</p>

									<!-- Singnature Image -->
									<!-- Recommended sizes for Retina Ready displays is 400x68px; -->
									<img class="img-fluid" src="{{ asset('frontend/images/signature.png') }}" width="200" height="34" alt="signature-image" />	

								</div>

							</div>
						</div>	<!-- END TEXT BLOCK -->	

						
					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END ABOUT-5 -->




			<!-- INFO-9
			============================================= -->
			<section id="info-9" class="bg-blue info-section division">


				<!-- TEXT BLOCK -->		
				<div class="container">
					<div class="row d-flex align-items-center">	
						<div class="col-lg-6">
							<div class="info-9-table white-color wow fadeInUp" data-wow-delay="0.4s">

								<!-- Title -->
								<h4 class="h4-xs">Opening Hours:</h4>

								<!-- Text -->
								<p>Porta semper lacus cursus and feugiat primis ultrice ligula risus auctor tempus feugiat
								   and dolor lacinia cursus turpis dolores ut aliquam a quaerat sodales sapien pretium
								</p>

								<!-- Table -->
								<table class="table">
									<tbody>
									     <tr>
									      	<td>Mon – Fri</td>
									      	<td> - </td>
									      	<td class="text-right">8:00 AM - 8:00 PM</td>
									    </tr>
									    <tr>
									      	<td>Saturday</td>
									      	<td>-</td>
									      	<td class="text-right">10:00 AM - 6:00 PM</td>
									    </tr>
									    <tr class="last-tr">
									      	<td>Sunday</td>
									      	<td>-</td>
									      	<td class="text-right">10:00 AM - 4:00 PM</td>
									   	 </tr>
									  </tbody>
								</table>

								<!-- Title -->
								<h5 class="h5-sm">Need a personal health plan?</h5>

								<!-- Text -->
								<p>Porta semper lacus cursus, and feugiat primis ultrice ligula at risus auctor vehicula magna
								   luctus tempor quisque undo laoreet turpis urna augue, viverra a augue eget
								</p>

							</div>	
						</div>	
					</div>	  <!-- End row -->
				</div>	   <!-- END TEXT BLOCK -->	


				<!-- INFO-9 IMAGE -->
				<div class="info-9-img bg-fixed text-center"></div>


			</section>	<!-- END INFO-9 -->




			<!-- TABS-1
			============================================= -->
			<section id="tabs-1" class="wide-100 tabs-section division">
				<div class="container">	
				 	<div class="row">
				 		<div class="col-md-12">
				 			

				 			<!-- TABS NAVIGATION -->
							<div id="tabs-nav" class="list-group text-center">
							    <ul class="nav nav-pills" id="pills-tab" role="tablist">

							    	<!-- TAB-1 LINK -->
								  	<li class="nav-item icon-xs">
								    	<a class="nav-link active" id="tab1-list" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
								    		<span class="flaticon-083-stethoscope"></span> Pediatrics
								    	</a>
								  	</li>

								  	<!-- TAB-2 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab2-list" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
									       <span class="flaticon-005-blood-donation-3"></span> Hematology
									    </a>
									</li>

									<!-- TAB-3 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab3-list" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">
									       <span class="flaticon-031-scanner"></span> MRI
									    </a>
									</li>

									<!-- TAB-4 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab4-list" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">
									       <span class="flaticon-048-lungs"></span> X-Ray Diagnostics
									    </a>
									</li>

								</ul>

							</div>	<!-- END TABS NAVIGATION -->


							<!-- TABS CONTENT -->
							<div class="tab-content" id="pills-tabContent">


								<!-- TAB-1 CONTENT -->
								<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1-list">
									<div class="row d-flex align-items-center">


										<!-- TAB-1 IMAGE -->
										<div class="col-lg-6">
											<div class="tab-img">
												<img class="img-fluid" src="{{ asset('frontend/images/pediatrics_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-1 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">Pediatrics</h3>

												<!-- Text -->
												<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
												   porta justo integer odio velna vitae auctor integer congue magna at pretium 
												   purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
												   egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
												   magna suscipit
												</p>

												<!-- Options List -->
												<div class="row">

													<div class="col-xl-6">

														<!-- Option #1 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
														</div>

														<!-- Option #2 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor</p>				
														</div>

														<!-- Option  #3 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
														</div>

													</div>

													<div class="col-xl-6">

														<!-- Option #4 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
														</div>

														<!-- Option #5 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
														</div>

														<!-- Option #6 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor</p>				
														</div>

													</div>

												</div>	<!-- End Options List -->

												<!-- Button -->
												<a href="{{ route('frontend.services') }}" class="btn btn-blue blue-hover mt-30">View More Details</a>

											</div>	
										</div>	<!-- END TAB-1 TEXT -->


									</div>
								</div>	<!-- END TAB-1 CONTENT -->


								<!-- TAB-2 CONTENT -->
								<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2-list">
									<div class="row d-flex align-items-center">


										<!-- TAB-2 IMAGE -->
										<div class="col-lg-6">
											<div class="tab-imgs">
												<img class="img-fluid" src="{{ asset('frontend/images/hematology_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-2 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">Hematology</h3>

												<!-- Text -->
												<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
												   porta justo integer odio velna vitae auctor integer congue magna at pretium 
												   purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
												   egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
												   magna suscipit
												</p>

												<!-- Options List -->
												<div class="row">

													<div class="col-xl-6">

														<!-- Option #1 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
														</div>

														<!-- Option #2 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor</p>				
														</div>

														<!-- Option #3 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
														</div>

													</div>

													<div class="col-xl-6">

														<!-- Option #4 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
														</div>

														<!-- Option #5 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
														</div>

														<!-- Option #6 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor</p>				
														</div>

													</div>

												</div>	<!-- End Options List -->

												<!-- Button -->
												<a href="{{ route('frontend.services') }}" class="btn btn-blue blue-hover mt-30">View More Details</a>

											</div>	
										</div>	<!-- END TAB-2 TEXT -->

										
									</div>
								</div>	<!-- END TAB-2 CONTENT -->


								<!-- TAB-3 CONTENT -->
								<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab3-list">
									<div class="row d-flex align-items-center">


										<!-- TAB-3 IMAGE -->
										<div class="col-lg-6">
											<div class="tab-img">
												<img class="img-fluid" src="{{ asset('frontend/images/mri_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-3 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">MRI Diagnostic</h3>

												<!-- Text -->
												<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
												   porta justo integer odio velna vitae auctor integer congue magna at pretium 
												   purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
												   egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
												   magna suscipit
												</p>

												<!-- Options List -->
												<div class="row">

													<div class="col-xl-6">

														<!-- Option #1 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
														</div>

														<!-- Option #2 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor</p>				
														</div>

														<!-- Option #3 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
														</div>

													</div>

													<div class="col-xl-6">

														<!-- Option #4 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
														</div>

														<!-- Option #5 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
														</div>

														<!-- Option #6 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor</p>				
														</div>

													</div>

												</div>	<!-- End Options List -->

												<!-- Button -->
												<a href="{{ route('frontend.services') }}" class="btn btn-blue blue-hover mt-30">View More Details</a>

											</div>	
										</div>	<!-- END TAB-3 TEXT -->

										
									</div>
								</div>	<!-- END TAB-3 CONTENT -->


								<!-- TAB-4 CONTENT -->
								<div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab4-list">
									<div class="row d-flex align-items-center">


										<!-- TAB-4 IMAGE -->
										<div class="col-lg-6">
											<div class="tab-img">
												<img class="img-fluid" src="{{ asset('frontend/images/x-ray_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-4 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">X-Ray Diagnostic</h3>

												<!-- Text -->
												<p class="mb-30">An enim nullam tempor sapien gravida donec enim ipsum blandit
												   porta justo integer odio velna vitae auctor integer congue magna at pretium 
												   purus pretium ligula rutrum itae laoreet augue in cubilia laoreet an augue 
												   egestas ipsum vitae emo ligula vitae arcu mollis blandit ultrice ligula egestas 
												   magna suscipit
												</p>

												<!-- Options List -->
												<div class="row">

													<div class="col-xl-6">

														<!-- Option #1 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute and turpis dolores quaerat</p>							
														</div>

														<!-- Option #2 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor</p>				
														</div>

														<!-- Option #3 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor at pretium purus blandit</p>				
														</div>

													</div>

													<div class="col-xl-6">

														<!-- Option #4 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Magna luctus tempor blandit a vitae suscipit mollis</p>				
														</div>

														<!-- Option #5 -->
														<div class="box-list m-top-15">							
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">Nemo ipsam egestas volute turpis dolores quaerat</p>							
														</div>

														<!-- Option #6 -->
														<div class="box-list">	
															<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
															<p class="p-sm">An enim nullam tempor</p>				
														</div>

													</div>

												</div>	<!-- End Options List -->

												<!-- Button -->
												<a href="{{ route('frontend.services') }}" class="btn btn-blue blue-hover mt-30">View More Details</a>

											</div>	
										</div>	<!-- END TAB-4 TEXT -->

										
									</div>
								</div>	<!-- END TAB-4 CONTENT -->


							</div>	<!-- END TABS CONTENT -->


			 			</div>	
				 	</div>     <!-- End row -->	
				</div>     <!-- End container -->	
			</section>	<!-- END TABS-1 -->



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




			<!-- DOCTORS-1
			============================================= -->
			<section id="doctors-1" class="wide-40 doctors-section division">
				<div class="container">


			 		<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Our Medical Specialists</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
										
						</div> 
					</div>	 <!-- END SECTION TITLE -->	


					<div class="row">


						<!-- DOCTOR #1 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">								
														
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="{{ asset('frontend/images/doctor-1.jpg') }}" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="{{ route('frontend.doctors') }}" title="">View More Info</a>
									</div> 

								</div>	

								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Jonathan Barnes D.M.</h5>
									<span class="blue-color">Chief Medical Officer</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>								
						</div>	<!-- END DOCTOR #1 -->
						
						
						<!-- DOCTOR #2 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">	
																						
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="{{ asset('frontend/images/doctor-2.jpg') }}" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="{{ route('frontend.doctors') }}" title="">View More Info</a>
									</div>

								</div>	

								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Hannah Harper D.M.</h5>
									<span class="blue-color">Anesthesiologist</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>					
						</div>	<!-- END DOCTOR #2 -->
						
						
						<!-- DOCTOR #3 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">	
																						
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="{{ asset('frontend/images/doctor-3.jpg') }}" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="{{ route('frontend.doctors') }}" title="">View More Info</a>
									</div>

								</div>		
								
								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Matthew Anderson D.M.</h5>
									<span class="blue-color">Cardiology</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>			
						</div>	<!-- END DOCTOR #3 -->
											
						
						<!-- DOCTOR #4 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">	
																					
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="{{ asset('frontend/images/doctor-4.jpg') }}" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="{{ route('frontend.doctors') }}" title="">View More Info</a>
									</div>

								</div>		
								
								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Megan Coleman D.M.</h5>
									<span class="blue-color">Neurosurgeon</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>			
						</div>	<!-- END DOCTOR #4 -->


					</div>	    <!-- End row -->


					<!-- ALL DOCTORS BUTTON -->		
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="all-doctors mb-40">
								<a href="{{ route('frontend.doctors') }}" class="btn btn-blue blue-hover">Meet All Doctors</a>
							</div>
						</div>
					</div>


				</div>	   <!-- End container -->
			</section>	<!-- END DOCTORS-1 -->




			<!-- FOOTER-1
			============================================= -->
@endsection
