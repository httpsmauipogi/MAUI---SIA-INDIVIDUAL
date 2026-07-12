@extends('layouts.frontend')

@section('title', 'FAQs - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'faqs', 'crumb' => 'FAQs', 'default' => 'FAQs'])




			<!-- FAQs PAGE
			============================================= -->
			<section id="faqs-page" class="wide-80 faqs-section division">
				<div class="container">
					<div class="row">


						<!-- QUESTIONS HOLDER -->
				 		<div class="col-lg-8">
				 			<div class="questions-holder pr-30">

				 				<!-- Title -->
				 				<h3 class="h3-md steelblue-color">Frequently Asked Questions</h3>

				 				<!-- Text -->
								<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor tempus feugiat
								   dolor lacinia cubilia curae integer congue leo metus, primis in orci integer metus mollis 
								   faucibus enim. Nemo ipsam egestas volute turpis dolores ut aliquam quaerat sodales sapien
								   undo pretium purus feugiat dolor impedit magna purus pretium gravida donec ligula massa 
								   gravida donec pretium 
								</p>


								<!-- QUESTIONS ACCORDION -->	
								<!-- QUESTIONS ACCORDION - Managed from Admin > Page Content > FAQs > FAQ Items -->
								<div id="accordion" role="tablist">

									@foreach ($faqCards as $card)
									<!-- ACCORDION CARD -->
				 					<div class="card">

				 						<!-- Card Title -->
									    <div class="card-header" role="tab" id="heading-{{ $card->id }}">
									      	<h5 class="h5-xs">
									       		<a class="{{ $loop->first ? '' : 'collapsed' }}" data-toggle="collapse" href="#collapse-{{ $card->id }}" role="button" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse-{{ $card->id }}">
									         		{{ $card->title }}
									        	</a>
									    	 </h5>
									    </div>

									    <!-- Card Content -->
									    <div id="collapse-{{ $card->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" role="tabpanel" aria-labelledby="heading-{{ $card->id }}" data-parent="#accordion">
									     	<div class="card-body">

												<!-- Text -->
												<p>{{ $card->description }}</p>

									     	</div>
									   	</div>

									</div>	<!-- END ACCORDION CARD -->
									@endforeach

								</div>	<!-- END QUESTIONS ACCORDION -->	


				 			</div>
				 		</div>   <!--END QUESTIONS HOLDER -->


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


							<!-- SIDEBAR TIMETABLE -->
							<div class="sidebar-timetable sidebar-div mb-50">

								<!-- Title -->
								<h5 class="h5-md mb-20">Doctors Timetable</h5>

								<!-- Text -->
								<p class="p-sm">Porta semper lacus cursus, feugiat primis ultrice ligula risus auctor at
								   tempus feugiat dolor lacinia cursus nulla vitae massa
								</p>

								<!-- Button -->
								<a href="{{ route('frontend.about') }}" class="btn btn-blue blue-hover mt-10">View Timetable</a>

							</div>	<!-- END SIDEBAR TABLE -->


						</aside>   <!-- END SIDEBAR -->
						

					</div>     <!-- End row -->		
				</div>	    <!-- End container -->
			</section>	 <!-- END FAQs PAGE -->

	


			<!-- FOOTER-1
			============================================= -->
@endsection
