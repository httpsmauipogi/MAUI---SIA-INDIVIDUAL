@extends('layouts.frontend')

@section('title', 'Our Departments - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'departments', 'crumb' => 'Our Departments', 'default' => 'Our Departments'])




			<!-- ABOUT-5
			============================================= -->
			<section id="about-5" class="pt-100 about-section division">
				<div class="container">
					<div class="row d-flex align-items-center">


						<!-- IMAGE BLOCK -->
						<div class="col-lg-6">
							<div class="about-img text-center wow fadeInUp" data-wow-delay="0.6s">
								<img class="img-fluid" src="{{ asset('frontend/images/image-03.png') }}" alt="about-image">
							</div>
						</div>


						<!-- TEXT BLOCK -->	
						<div class="col-lg-6">
							<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

								<!-- Section ID -->	
					 			<span class="section-id blue-color">Welcome to Healix HMS</span>

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




			<!-- SERVICES-7
			============================================= -->
			<section id="services-7" class="bg-lightgrey wide-70 servicess-section division">
				<div class="container">
					<div class="row">


						<!-- SERVICE BOXES -->	
						<div class="col-lg-8">
							<div class="row">


								<!-- Managed from Admin > Page Content > Departments > Department Cards -->
								@foreach ($departmentCards as $card)
								<div class="col-md-6">
									<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="{{ $loop->even ? '0.6s' : '0.4s' }}">
										<a href="{{ $card->link_url ?: route('frontend.services') }}">

											<!-- Icon -->
											<span class="{{ $card->icon ?: 'flaticon-083-stethoscope' }} blue-color"></span>

											<!-- Text -->
											<div class="sbox-7-txt">

												<!-- Title -->
												<h5 class="h5-sm steelblue-color">{{ $card->title }}</h5>

												<!-- Text -->
												@if ($card->description)
													<p class="p-sm">{{ $card->description }}</p>
												@endif

											</div>

										</a>
									</div>
								</div>
								@endforeach

			 					
	 						</div>
						</div>	<!-- END SERVICE BOXES -->	


						<!-- INFO TABLE -->
						<div class="col-lg-4">
							<div class="services-7-table blue-table mb-30 wow fadeInUp" data-wow-delay="0.6s">

								<!-- Title -->
								<h4 class="h4-xs">Opening Hours:</h4>

								<!-- Text -->
								<p class="p-sm">Porta semper lacus cursus and feugiat primis ultrice ligula risus auctor
								   tempus feugiat and dolor lacinia cursus
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
								<h5 class="h5-sm">Need a personal health plan?</h5>

								<!-- Text -->
								<p class="p-sm">Porta semper lacus cursus, and feugiat primis ultrice ligula at risus auctor</p>

							</div>	
						</div>	<!-- END INFO TABLE -->

						
					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END SERVICES-7 -->




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
