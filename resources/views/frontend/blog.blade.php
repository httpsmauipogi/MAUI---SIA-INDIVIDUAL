@extends('layouts.frontend')

@section('title', 'Blog - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'blog', 'crumb' => 'Our Blogs & Latest News', 'default' => 'Our Blogs & Latest News'])




			<!-- BLOG PAGE CONTENT
			============================================= -->
			<div id="blog-page" class="wide-100 blog-page-section division">
				<div class="container">
				 	<div class="row">


				 		<!-- BLOG POSTS HOLDER -->
				 		<div class="col-lg-8">
				 			<div class="posts-holder pr-30">


				 				<!-- Managed from Admin > Page Content > Blog > Blog Posts -->
				 				@foreach ($blogCards as $card)
				 				<div class="blog-post">

						 			<!-- BLOG POST IMAGE -->
						 			<div class="blog-post-img">
										<img class="img-fluid" src="{{ $card->image_path ? asset('storage/' . $card->image_path) : asset('frontend/images/blog/post-4-img.jpg') }}" alt="blog-post-image" />
									</div>

					 				<!-- BLOG POST TITLE -->
									<div class="blog-post-txt">

										<!-- Post Title -->
										<h5 class="h5-xl steelblue-color"><a href="{{ $card->link_url ?: route('frontend.blog-single') }}">{{ $card->title }}</a></h5>

										<!-- Post Data -->
										@if ($card->subtitle)
										<span>{{ $card->subtitle }}</span>
										@endif

										<!-- Post Text -->
										<p>{{ $card->description }}</p>

									</div>

								</div>	<!-- END BLOG POST -->
								@endforeach


								<!-- BLOG PAGE PAGINATION -->
								<div class="blog-page-pagination b-top">
									<nav aria-label="Page navigation">
										<ul class="pagination justify-content-center primary-theme">
	    									<li class="page-item disabled"><a class="page-link" href="#" tabindex="-1"><i class="fas fa-long-arrow-alt-left"></i></a></li>
										    <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
										    <li class="page-item"><a class="page-link" href="#">2</a> </li>
										    <li class="page-item"><a class="page-link" href="#">3</a></li>
										    <li class="page-item next-page"><a class="page-link" href="#"><i class="fas fa-long-arrow-alt-right"></i></a></li>
	 									</ul>	
	 								</nav>					
								</div>



				 			</div>
				 		</div>	 <!-- END BLOG POSTS HOLDER -->



				 		<!-- SIDEBAR -->
						<aside id="sidebar" class="col-lg-4">


							<!-- SEARCH FIELD --> 
							<div id="search-field" class="sidebar-div mb-50">								
								<div class="input-group mb-3">
								  	<input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-field">
								 	<div class="input-group-append">
								    	<button class="btn" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
								 	</div>
								</div>
							</div>


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


							<!-- BLOG CATEGORIES --> 
							<div class="blog-categories sidebar-div mb-50">
									
								<!-- Title -->
								<h5 class="h5-sm steelblue-color">Categories</h5>

								<ul class="blog-category-list clearfix">
									<li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Elderly Care</a> <span>(5)</span></li>
									<li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Lifestyle</a> <span>(13)</span></li>
									<li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Medical</a> <span>(6)</span></li>
									<li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Treatment </a> <span>(8)</span></li>
									<li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Pharma</a> <span>(12)</span></li>
								</ul>

							</div>


							<!-- POPULAR POSTS -->
							<div class="popular-posts sidebar-div mb-50">
									
								<!-- Title -->
								<h5 class="h5-sm steelblue-color">Popular Posts</h5>

								<ul class="popular-posts">
								
									<!-- Popular post #1 -->
									<li class="clearfix d-flex align-items-center">

										<!-- Image -->
										<img class="img-fluid" src="{{ asset('frontend/images/blog/latest-post-1.jpg') }}" alt="blog-post-preview" />

										<!-- Text -->
										<div class="post-summary">
											<a href="{{ route('frontend.blog-single') }}">Etiam sapien accumsan molestie ante empor ...</a>
											<p>43 Comments</p>
										</div>

									</li>
									
									<!-- Popular post #2 -->
									<li class="clearfix d-flex align-items-center">

										<!-- Image -->
										<img class="img-fluid" src="{{ asset('frontend/images/blog/latest-post-2.jpg') }}" alt="blog-post-preview" />

										<!-- Text -->
										<div class="post-summary">
											<a href="{{ route('frontend.blog-single') }}">Blandit tempor sapien ipsum, porta justo ...</a>
											<p>38 Comments</p>
										</div>

									</li>
									
									<!-- Popular post #3 -->
									<li class="clearfix d-flex align-items-center">

										<!-- Image -->
										<img class="img-fluid" src="{{ asset('frontend/images/blog/latest-post-3.jpg') }}" alt="blog-post-preview" />

										<!-- Text -->
										<div class="post-summary">
											<a href="{{ route('frontend.blog-single') }}">Cursus risus laoreet turpis auctor varius ...</a>
											<p>29 Comments</p>
										</div>

									</li>
								</ul>

							</div>


							<!-- TAGS CLOUD -->
							<div class="tags-cloud sidebar-div mb-50">
									
								<!-- Title -->
								<h5 class="h5-sm steelblue-color">Tags Cloud</h5>

								<span class="badge"><a href="#">Effective Treatment</a></span>
								<span class="badge"><a href="#">Molecular Biology</a></span> 	
								<span class="badge"><a href="#">Diagnostic</a></span> 									
								<span class="badge"><a href="#">Pediatrics</a></span> 
								<span class="badge"><a href="#">Lifestyle</a></span>
								<span class="badge"><a href="#">Pharma</a></span>									  								 
								<span class="badge"><a href="#">Medicine</a></span> 
								<span class="badge"><a href="#">Research</a></span> 								
							</div>


							<!-- SIDEBAR TIMETABLE -->
							<div class="sidebar-timetable sidebar-div mb-50">

								<!-- Title -->
								<h5 class="h5-md mb-20 steelblue-color">Doctors Timetable</h5>

								<!-- Text -->
								<p class="p-sm">Porta semper lacus cursus, feugiat primis ultrice ligula risus auctor at
								   tempus feugiat dolor lacinia cursus nulla vitae massa
								</p>

								<!-- Button -->
								<a href="{{ route('frontend.about') }}" class="btn btn-blue blue-hover mt-10">View Timetable</a>

							</div>	<!-- END SIDEBAR TIMETABLE -->


							<!-- IMAGE WIDGET -->						
							<div class="image-widget sidebar-div">
								<a href="#">
									<img class="img-fluid" src="{{ asset('frontend/images/blog/image-widget.jpg') }}" alt="image-widget" />
								</a>																		
							</div>


						</aside>	<!-- END SIDEBAR -->

				 		
				 	</div>	<!-- End row -->	
				 </div>	 <!-- End container -->
			</div>	<!-- END BLOG PAGE CONTENT -->




			<!-- FOOTER-1
			============================================= -->
@endsection
