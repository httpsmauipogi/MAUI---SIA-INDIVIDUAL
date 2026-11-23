@extends('layouts.frontend')

@section('title', 'About Us - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'about', 'crumb' => 'About Us', 'default' => 'About Us'])




			<!-- INFO-4
			============================================= -->
			<section id="info-4" class="wide-100 info-section division">
				<div class="container">


					<!-- TOP ROW -->
					<div class="top-row mb-80">
						<div class="row d-flex align-items-center">


						<!-- Managed from Admin > Page Content > About Us > Welcome Block -->
						<!-- INFO IMAGE -->
						<div class="col-lg-6">
							<div class="info-4-img text-center wow fadeInUp" data-wow-delay="0.6s">
								<img class="img-fluid" src="{{ $welcomeCard->image_path ? storage_url($welcomeCard->image_path) : asset('frontend/images/chief_doctor_700x800.jpg') }}" alt="info-image">
							</div>
						</div>


						<!-- INFO TEXT -->	
						<div class="col-lg-6">
							<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

								<!-- Section ID -->	
					 			<span class="section-id blue-color">{{ $welcomeCard->subtitle }}</span>

								<!-- Title -->
								<h3 class="h3-md steelblue-color">{{ $welcomeCard->title }}</h3>

								<!-- Text -->
								<div>{!! nl2br(e($welcomeCard->description)) !!}</div>

								<!-- Singnature -->
								<div class="singnature mt-35">

									<!-- Text -->
									<p class="p-small mb-15">{{ $welcomeCard->link_text }}</p>

									<!-- Singnature Image -->
									<img class="img-fluid" src="{{ asset('frontend/images/signature.png') }}" width="200" height="34" alt="signature-image" />	

								</div>

							</div>
						</div>	<!-- END TEXT BLOCK -->	

						
						</div>    <!-- End row -->
					</div>	<!-- END TOP ROW -->


					<!-- BOTTOM ROW -->
					<div class="bottom-row">
						<div class="row d-flex align-items-center">


							<!-- Managed from Admin > Page Content > About Us > Quality Care -->
							<!-- INFO TEXT -->	
							<div class="col-lg-6">
								<div class="txt-block pc-30 wow fadeInUp" data-wow-delay="0.4s">

									<!-- Section ID -->	
					 				<span class="section-id blue-color">{{ $qualityCareCard->subtitle }}</span>

									<!-- Title -->
									<h3 class="h3-md steelblue-color">{{ $qualityCareCard->title }}</h3>

									<!-- Text -->
									<p class="mb-30">{{ $qualityCareCard->description }}</p>

									<!-- Options List -->
									<div class="row">

										<div class="col-xl-6">
											@foreach ($qualityCarePoints->slice(0, 3) as $point)
											<div class="box-list">
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">{{ $point->title }}</p>
											</div>
											@endforeach
										</div>

										<div class="col-xl-6">
											@foreach ($qualityCarePoints->slice(3, 3) as $point)
											<div class="box-list">
												<div class="box-list-icon blue-color"><i class="fas fa-angle-double-right"></i></div>
												<p class="p-sm">{{ $point->title }}</p>
											</div>
											@endforeach
										</div>

									</div>	<!-- End Options List -->

								</div>
							</div>	<!-- END INFO TEXT -->	


							<!-- INFO IMAGE -->
							<div class="col-lg-6">
								<div class="info-4-img text-center wow fadeInUp" data-wow-delay="0.6s">
									<img class="img-fluid" src="{{ $qualityCareCard->image_path ? storage_url($qualityCareCard->image_path) : asset('frontend/images/emergency_help_700x800.jpg') }}" alt="info-image">
								</div>
							</div>

						
						</div>    <!-- End row -->
					</div>	<!-- END BOTTOM ROW -->


				</div>	   <!-- End container -->
			</section>	<!-- END INFO-4 -->




			<!-- STATISTIC-1
			============================================= -->
			<div id="statistic-1" class="bg-scroll statistic-section division">
				<div class="container white-color">
					<div class="row">


						<!-- Managed from Admin > Page Content > About Us > Statistics -->
						@foreach ($aboutStatCards as $card)
						<div class="col-md-6 col-lg-3">
							<div class="statistic-block icon-lg wow fadeInUp" data-wow-delay="{{ 0.4 + ($loop->index * 0.2) }}s">
								<span class="{{ $card->icon ?: 'flaticon-137-doctor' }}"></span>
								<h5 class="statistic-number"><span class="count-element">{{ $card->title }}</span></h5>
								<p class="txt-400">{{ $card->subtitle }}</p>
							</div>
						</div>
						@endforeach

					</div>  <!-- End row -->
				</div>	 <!-- End container -->		
			</div>	 <!-- END STATISTIC-1 -->




			<!-- VIDEO-2
			============================================= -->
			<section id="video-2" class="wide-60 video-section division">
			 	<div class="container">
			 		<div class="row d-flex align-items-center">


			 			<!-- VIDEO LINK -->
			 			<div class="col-lg-6">
			 				<div class="video-preview mb-40 text-center wow fadeInUp" data-wow-delay="0.6s">

				 				<!-- Change the link HERE!!! -->						
								<a class="video-popup1" href="https://www.youtube.com/embed/SZEflIVnhH8">

									<!-- Play Icon --> 							
									<div class="video-btn play-icon-blue">	
										<div class="video-block-wrapper">
											<i class="fas fa-play"></i>
										</div>
									</div>

									<!-- Preview -->	
									<img class="img-fluid" src="{{ asset('frontend/images/medical-technology.jpg') }}" alt="Doctor using medical technology" />

								</a>

					 		</div>
			 			</div>	<!-- END VIDEO LINK -->


			 			<!-- VIDEO TEXT -->
			 			<div class="col-lg-6">
			 				<div class="txt-block pc-30 mb-40 wow fadeInUp" data-wow-delay="0.4s">

			 					<!-- Section ID -->	
					 			<span class="section-id blue-color">Modern Medicine</span>

			 					<!-- Title -->	
			 					<h3 class="h3-md steelblue-color">Better Technologies for Better Healthcare</h3>

			 					<!-- CONTENT BOX #1 -->
								<div class="box-list m-top-15">							
									<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
									<p>Nemo ipsam egestas volute turpis dolores ut aliquam quaerat sodales sapien undo pretium
									   purus feugiat dolor impedit
									</p>							
								</div>

								<!-- CONTENT BOX #2 -->
								<div class="box-list">	
									<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
									<p>Gravida quis vehicula magna luctus tempor quisque vel laoreet turpis urna augue, 
									   viverra a augue eget dictum
									</p>				
								</div>

								<!-- CONTENT BOX #3 -->
								<div class="box-list">	
									<div class="box-list-icon"><i class="fas fa-genderless"></i></div>
									<p>Nemo ipsam egestas volute turpis dolores ut aliquam quaerat sodales sapien undo pretium
									   purus feugiat dolor impedit
									</p>				
								</div>

			 				</div>
			 			</div>


			 		</div>	    <!-- End row -->
			 	</div>	    <!-- End container -->
			</section>	 <!-- END VIDEO-2 -->




			<!-- SERVICES-7
			============================================= -->
			<section id="services-7" class="bg-lightgrey wide-70 servicess-section division">
				<div class="container">
					<div class="row">


						<!-- SERVICE BOXES -->	
						<div class="col-lg-8">
							<div class="row">


								<!-- Managed from Admin > Page Content > About Us > Feature Boxes -->
								@foreach ($featureBoxCards as $card)
			 					<div class="col-md-6">
			 						<div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="{{ $loop->even ? '0.6s' : '0.4s' }}">
			 							<a href="{{ $card->link_url ?: route('frontend.services') }}">
				 							<span class="{{ $card->icon ?: 'flaticon-137-doctor' }} blue-color"></span>
											<div class="sbox-7-txt">
												<h5 class="h5-sm steelblue-color">{{ $card->title }}</h5>
												@if ($card->description)
												<p class="p-sm">{{ $card->description }}</p>
												@endif
											</div>
										</a>
			 						</div>
			 					</div>	<!-- END SERVICE BOX -->
								@endforeach

			 					
	 						</div>
						</div>	<!-- END SERVICE BOXES -->	


						<!-- INFO TABLE -->
						<div class="col-lg-4">
							<div class="services-7-table blue-table mb-30 wow fadeInUp" data-wow-delay="0.6s">

								<!-- Managed from Admin > Page Content > About Us > Opening Hours -->
								<h4 class="h4-xs">{{ $openingHoursCard->title ?: 'Opening Hours:' }}</h4>

								@if ($openingHoursCard->description)
								<p class="p-sm">{{ $openingHoursCard->description }}</p>
								@endif

								<!-- Table -->
								<table class="table">
									<tbody>
										@foreach ($aboutOpeningHours as $row)
									    <tr class="{{ $loop->last ? 'last-tr' : '' }}">
									      	<td>{{ $row->title }}</td>
									      	<td> - </td>
									      	<td class="text-right">{{ $row->subtitle }}</td>
									    </tr>
										@endforeach
									  </tbody>
								</table>

								@if ($openingHoursCard->link_text)
								<h5 class="h5-sm">{{ $openingHoursCard->link_text }}</h5>
								@endif

								@if ($openingHoursCard->link_url)
								<p class="p-sm">{{ $openingHoursCard->link_url }}</p>
								@endif

							</div>	
						</div>	<!-- END INFO TABLE -->

						
					</div>    <!-- End row -->
				</div>	   <!-- End container -->
			</section>	<!-- END SERVICES-7 -->




			<!-- BANNER-5
			============================================= -->
			<section id="banner-5" class="pt-100 banner-section division">
				<div class="container">


					<!-- Managed from Admin > Page Content > About Us > Closing Banner -->
					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		
							<h3 class="h3-md steelblue-color">{{ $closingBannerCard->title }}</h3>	
							<p>{{ $closingBannerCard->description }}</p>
						</div> 
					</div>


					<!-- BANNER IMAGE -->
					<div class="row">
						<div class="col-lg-10 offset-lg-1">
							<div class="banner-5-img wow fadeInUp" data-wow-delay="0.4s">
								<img class="img-fluid" src="{{ $closingBannerCard->image_path ? storage_url($closingBannerCard->image_path) : asset('frontend/images/image-07.png') }}" alt="banner-image" />
							</div>
						</div>
					</div>


				</div>	   <!-- End container -->	
			</section>	<!-- END BANNER-5 -->




			<!-- FOOTER-1
			============================================= -->
@endsection
