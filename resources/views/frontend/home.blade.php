@extends('layouts.frontend')

@section('title', 'Healix HMS - Home')

@section('content')




			<!-- HERO-10
			============================================= -->	
			<section id="hero-10" class="hero-section division">


				<!-- SLIDER (managed from Admin > Page Content > Home > Hero Slider) -->
				<div class="slider blue-nav">
			    	<ul class="slides">

					@forelse ($heroSlides as $slide)
					<li>
						<!-- Background Image -->
						<img src="{{ $slide->image_path ? storage_url($slide->image_path) : asset('frontend/images/flat-lay-health-still-life-arrangement-with-copy-space.jpg') }}" alt="slide-background">

						<!-- Image Caption -->
						<div class="caption d-flex align-items-center left-align">
							<div class="container">
								<div class="row">
									<div class="col-sm-9 col-md-7 col-lg-6 offset-sm-3 offset-md-5 offset-lg-6">
										<div class="caption-txt">

											<!-- Title -->
											<h2 class="steelblue-color">{{ $slide->title }}</h2>

											<!-- Text -->
											@if ($slide->description)
												<p class="p-md">{{ $slide->description }}</p>
											@endif

											<!-- Button -->
											@if ($slide->link_text)
												<a href="{{ $slide->link_url ?: '#' }}" class="btn btn-blue tra-black-hover">{{ $slide->link_text }}</a>
											@endif

										</div>
									</div>
								</div>  <!-- End row -->
							</div>  <!-- End container -->
						</div>	<!-- End Image Caption -->
					</li>
					@empty
					<!-- Fallback slide shown only until slides are added from Admin > Page Content > Home -->
					<li>
						<img src="{{ asset('frontend/images/flat-lay-health-still-life-arrangement-with-copy-space.jpg') }}" alt="slide-background">
						<div class="caption d-flex align-items-center left-align">
							<div class="container">
								<div class="row">
									<div class="col-sm-9 col-md-7 col-lg-6 offset-sm-3 offset-md-5 offset-lg-6">
										<div class="caption-txt">
											<h2 class="steelblue-color">{{ site_setting('hero_title', 'Bring world into focus') }}</h2>
											<p class="p-md">{{ site_setting('hero_description', 'Feugiat primis ligula risus auctor egestas augue mauri viverra tortor in iaculis placerat eugiat mauris ipsum at viverra tortor and gravida purus pretium auctor lorem primis mollis') }}</p>
											<a href="{{ route('frontend.who-we-are') }}" class="btn btn-blue tra-black-hover">Get More Info</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					@endforelse

				    </ul>
			  	</div>	<!-- END SLIDER -->


			</section>	<!-- END HERO-10 -->




			<!-- ABOUT-3
			============================================= -->
			<section id="about-3" class="about-section division">
				<div class="container">
					<div class="abox-3-holder">
						<div class="row d-flex align-items-center">


							<!-- Managed from Admin > Page Content > Home > About Boxes -->
							@foreach ($aboutBoxCards as $card)
							<div class="col-lg-4">
								<div class="abox-3 {{ $loop->last ? '' : 'b-right' }} wow fadeInUp" data-wow-delay="{{ 0.4 + ($loop->index * 0.2) }}s">

									<!-- Small Title -->
									@if ($card->subtitle)
									<p class="blue-color">{{ $card->subtitle }}</p>
									@endif

									<!-- Title -->
									<h5 class="h5-xs steelblue-color">{{ $card->title }}</h5>

									<!-- Text -->
									@if ($card->description)
									<p>{{ $card->description }}</p>
									@endif

								</div>
							</div>
							@endforeach

						</div>    <!-- End row -->
					</div>	   <!-- End container -->
				</div>	
			</section>	<!-- END ABOUT-3 -->




			<!-- ABOUT-6
			============================================= -->
			<section id="about-6" class="pt-100 about-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- Managed from Admin > Page Content > Home > Welcome Block -->
						<div class="col-lg-6">
							<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

								<!-- Section ID -->	
					 			<span class="section-id blue-color">{{ $welcomeCard->subtitle }}</span>

								<!-- Title -->
								<h3 class="h3-md steelblue-color">{{ $welcomeCard->title }}</h3>

								<!-- Text -->
								<p>{{ $welcomeCard->description }}</p>

								<!-- Singnature -->
								<div class="singnature mt-35">

									<!-- Signature shown as text (the old 400x70 signature image looked like a placeholder) -->
									<p class="p-small mb-15">{{ $welcomeCard->link_text }}</p>
									<p class="signature-text">Healix HMS</p>

								</div>

							</div>
						</div>	<!-- END TEXT BLOCK -->	


						<!-- IMAGE BLOCK -->
						<div class="col-lg-6">
							<div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
								<img class="img-fluid" src="{{ $welcomeCard->image_path ? storage_url($welcomeCard->image_path) : asset('frontend/images/chief_doctor_700x800.jpg') }}" alt="about-image">
							</div>
						</div>

						
					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END ABOUT-6 -->




			<!-- STATISTIC-1
			============================================= -->
			<div id="statistic-1" class="bg-scroll statistic-section division">
				<div class="container white-color">
					<div class="row">


						<!-- Managed from Admin > Page Content > Home > Statistics. Title field = the number (digits only), Subtitle = label -->
						@foreach ($statCards as $card)
						<div class="col-md-6 col-lg-3">
							<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="{{ 0.4 + ($loop->index * 0.2) }}s">

								<!-- Icon  -->
								<span class="{{ $card->icon ?: 'flaticon-137-doctor' }}"></span>

								<!-- Text -->
								<h5 class="statistic-number"><span class="count-element">{{ $card->title }}</span></h5>
								<p class="txt-400">{{ $card->subtitle }}</p>

							</div>
						</div>
						@endforeach

					</div>  <!-- End row -->
				</div>	 <!-- End container -->		
			</div>	 <!-- END STATISTIC-1 -->




			<!-- SERVICES-4
			============================================= -->
			<section id="services-4" class="wide-60 services-section division">
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Our Core Optometry Services</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
										
						</div> 
					</div>


			 		<div class="row">

						<!-- Managed from Admin > Page Content > Home > Service Highlights -->
						@php
							// Distinct medical images for the fallback cards (used until images are set in Admin).
							$serviceFallbacks = [
								'frontend/images/medical_complex_700x700.jpg',
								'frontend/images/cardiology_700x700.jpg',
								'frontend/images/mri_700x700.jpg',
								'frontend/images/pediatrics_700x700.jpg',
							];
						@endphp
						@foreach ($homeServiceCards as $card)
						<div class="col-md-6 col-lg-3">
							<div class="sbox-4 wow fadeInUp" data-wow-delay="{{ 0.4 + ($loop->index * 0.2) }}s">

								<!-- Image -->
								<img class="img-fluid" src="{{ $card->image_path ? storage_url($card->image_path) : asset($serviceFallbacks[$loop->index % count($serviceFallbacks)]) }}" alt="content-image" />

								<!-- Text -->
								<div class="sbox-4-txt">
									<h5 class="h5-md steelblue-color"><a href="{{ $card->link_url ?: route('frontend.services') }}">{{ $card->title }}</a></h5>
									@if ($card->description)
										<p>{{ $card->description }}</p>
									@endif
								</div>

							</div>
						</div>
						@endforeach

			 		</div>	   <!-- End row -->		
			 	</div>	   <!-- End container -->		
			</section>	<!-- END SERVICES-4 -->




			<!-- INFO-2
			============================================= -->
			<section id="info-2" class="bg-lightgrey wide-60 info-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- Managed from Admin > Page Content > Home > Why Choose Us -->
						<div class="col-lg-6">
							<div class="txt-block pc-30 mb-40 wow fadeInUp" data-wow-delay="0.4s">

								<!-- Section ID -->	
					 			<span class="section-id blue-color">{{ $whyChooseUsCard->subtitle }}</span>

								<!-- Title -->
								<h3 class="h3-md steelblue-color">{{ $whyChooseUsCard->title }}</h3>

								<!-- Text -->
								<p class="mb-30">{{ $whyChooseUsCard->description }}</p>

								<!-- Options List -->
								<div class="row">

									<div class="col-xl-6">
										@foreach ($whyChooseUsPoints->slice(0, 3) as $point)
										<div class="box-list {{ $loop->first ? 'm-top-15' : '' }}">
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">{{ $point->title }}</p>
										</div>
										@endforeach
									</div>

									<div class="col-xl-6">
										@foreach ($whyChooseUsPoints->slice(3, 3) as $point)
										<div class="box-list {{ $loop->first ? 'm-top-15' : '' }}">
											<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
											<p class="p-sm">{{ $point->title }}</p>
										</div>
										@endforeach
									</div>

								</div>	<!-- End Options List -->
								
							</div>
						</div>	<!-- END TEXT BLOCK -->	


						<!-- IMAGE BLOCK -->
						<div class="col-lg-6">
							<div class="info-2-img wow fadeInUp" data-wow-delay="0.6s">
								<img class="img-fluid" src="{{ $whyChooseUsCard->image_path ? storage_url($whyChooseUsCard->image_path) : asset('frontend/images/medical_complex_700x700.jpg') }}" alt="info-image">
							</div>
						</div>

						
					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END INFO-2 -->		




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


						@forelse ($featuredDoctors as $doctor)
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">										
																	
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="{{ $doctor->photoUrl() }}" alt="Dr. {{ $doctor->name }}">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="{{ route('frontend.doctor.show', $doctor) }}" title="">View More Info</a>
									</div> 

								</div>	

								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Dr. {{ $doctor->name }}</h5>
									<span class="blue-color">{{ $doctor->specialization }}</span>

									<p class="p-sm grey-color">{{ $doctor->qualification ?? 'Experienced healthcare professional dedicated to patient care.' }}
									</p>

								</div>	

							</div>								
						</div>
						@empty
						<div class="col-12 text-center">
							<p class="grey-color">Our doctor profiles will appear here shortly.</p>
						</div>
						@endforelse


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

								<!-- Table - Managed from Admin > Page Content > Home > Opening Hours -->
								<table class="table">
									<tbody>
										@foreach ($openingHours as $row)
									    <tr class="{{ $loop->last ? 'last-tr' : '' }}">
									      	<td>{{ $row->title }}</td>
									      	<td> - </td>
									      	<td class="text-right">{{ $row->subtitle }}</td>
									    </tr>
										@endforeach
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
								    		Eye Examination
								    	</a>
								  	</li>

								  	<!-- TAB-2 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab2-list" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
									       Laser Eye Correction
									    </a>
									</li>

									<!-- TAB-3 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab3-list" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">
									       Contact Lenses
									    </a>
									</li>

									<!-- TAB-4 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab4-list" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">
									       Kids Diagnostic
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
												<img class="img-fluid" src="{{ asset('frontend/images/eye_exam_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-1 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">Eye Examination</h3>

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
														<div class="box-list">							
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
														<div class="box-list">							
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
												<img class="img-fluid" src="{{ asset('frontend/images/eye_correct_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-2 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">Laser Eye Correction</h3>

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
														<div class="box-list">							
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
														<div class="box-list">							
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
												<img class="img-fluid" src="{{ asset('frontend/images/contact_lenses_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-3 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">Contact Lenses</h3>

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
														<div class="box-list">							
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
														<div class="box-list">							
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
												<img class="img-fluid" src="{{ asset('frontend/images/kids_eye_correct_700x700.jpg') }}" alt="tab-image" />
											</div>
										</div>


										<!-- TAB-4 TEXT -->
										<div class="col-lg-6">
											<div class="txt-block pc-30">

												<!-- Title -->
												<h3 class="h3-md steelblue-color">Kids Diagnostic</h3>

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
														<div class="box-list">							
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
														<div class="box-list">							
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

						
								<!-- Managed from Admin > Page Content > Home > Testimonials -->
								@foreach ($testimonialCards as $card)
								<div class="review-2">
									<div class="review-txt text-center">

										<!-- Quote -->
										<div class="quote"><img src="{{ asset('frontend/images/quote.png') }}" alt="quote-img" /></div>

										<!-- Author Avatar -->
										<div class="testimonial-avatar">
											<img src="{{ $card->image_path ? storage_url($card->image_path) : asset('frontend/images/review-author-1.jpg') }}" alt="testimonial-avatar">
										</div>

										<!-- Testimonial Text -->
										<p>{{ $card->description }}</p>

										<!-- Testimonial Author -->
										<div class="review-author">
											<h5 class="h5-sm">{{ $card->title }}</h5>
											<span>{{ $card->subtitle }}</span>
										</div>

									</div>
								</div>	<!-- END TESTIMONIAL -->
								@endforeach

							
							</div>
						</div>									
					</div>	<!-- END TESTIMONIALS CONTENT --> 
							
						
				</div>	   <!-- End container -->
			</section>	 <!-- END TESTIMONIALS-2 -->




			<!-- BLOG-1
			============================================= -->
			<section id="blog-1" class="wide-60 blog-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">	

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Our Stories, Tips & Latest News</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
								
						</div>
					</div>


			 		<!-- BLOG POSTS HOLDER -->
				 	<div class="row">


				 		<!-- Reuses the same posts managed at Admin > Page Content > Blog > Blog Posts -->
				 		@foreach ($homeBlogCards as $card)
				 		<div class="col-lg-4">
				 			<div class="blog-post wow fadeInUp" data-wow-delay="{{ 0.4 + ($loop->index * 0.2) }}s">

				 				<!-- BLOG POST IMAGE -->
					 			<div class="blog-post-img">
									<img class="img-fluid" src="{{ $card->image_path ? storage_url($card->image_path) : asset('frontend/images/blog/post-1-img.jpg') }}" alt="blog-post-image" />	
								</div>

				 				<!-- BLOG POST TITLE -->
								<div class="blog-post-txt">

									<!-- Post Title -->
									<h5 class="h5-sm steelblue-color"><a href="{{ $card->link_url ?: route('frontend.blog-single') }}">{{ $card->title }}</a></h5>

									<!-- Post Data -->
									@if ($card->subtitle)
									<span>{{ $card->subtitle }}</span>
									@endif

									<!-- Post Text -->
									<p>{{ $card->description }}</p>

								</div>

							</div>
				 		</div>	<!-- END BLOG POST -->
				 		@endforeach


					</div>	<!-- END BLOG POSTS HOLDER -->


				</div>	   <!-- End container -->		
			</section>	<!-- END BLOG-1 -->




			<!-- BANNER-2
			============================================= -->
			<section id="banner-2" class="pt-50 banner-section division">
				<div class="bg-scroll bg-inner bg-image division">
					<div class="container white-color">
						<div class="row d-flex align-items-center">


							<!-- Managed from Admin > Page Content > Home > CTA Banner -->
							<!-- CALL TO ACTION IMAGE -->
							<div class="col-lg-5">
								<div class="banner-2-img">
									<img class="img-fluid" src="{{ $ctaCard->image_path ? storage_url($ctaCard->image_path) : asset('frontend/images/image-05.png') }}" alt="banner-image" />	
								</div>
							</div>


							<!-- BANNER TEXT -->
							<div class="col-lg-6 offset-lg-1">
								<div class="banner-txt pc-30 wow fadeInUp" data-wow-delay="0.4s">

									<!-- Section ID -->	
					 				<span class="section-id id-color">{{ $ctaCard->subtitle }}</span>

									<!-- Title  -->
									<h3 class="h3-lg">{{ $ctaCard->title }}</h3>

									<!-- Text -->
									<p>{{ $ctaCard->description }}</p>

								    <!-- Button -->
									<a href="{{ $ctaCard->link_url ?: route('frontend.doctors') }}" class="btn btn-tra-white blue-hover">{{ $ctaCard->link_text ?: 'View Our Doctors' }}</a>

								</div>
							</div>	<!-- END BANNER TEXT -->


						</div>	  <!-- End row -->
					</div>	   <!-- End container -->
				</div>		<!-- End Inner Background -->		
			</section>	<!-- END BANNER-2 -->




			<!-- FOOTER-3
			============================================= -->

@endsection
