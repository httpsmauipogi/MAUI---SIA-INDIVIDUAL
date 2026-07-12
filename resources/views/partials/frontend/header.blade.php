			<header id="header" class="header">


				<!-- MOBILE HEADER -->
			    <div class="wsmobileheader clearfix">
			    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
			    	<span class="smllogo">
			    		@if (site_setting('logo_path'))
			    			<img src="{{ asset('storage/' . site_setting('logo_path')) }}" width="180" height="40" alt="{{ site_setting('site_name', 'Healix HMS') }}"/>
			    		@else
			    			<img src="{{ asset('frontend/images/logo-grey.png') }}" width="180" height="40" alt="mobile-logo"/>
			    		@endif
			    	</span>
			    	<a href="tel:{{ site_setting('phone', '123456789') }}" class="callusbtn"><i class="fas fa-phone"></i></a>
			 	</div>


			 	<!-- HEADER STRIP -->
			 	<div class="headtoppart bg-steelblue clearfix">
			    	<div class="headerwp clearfix">

			    		<!-- Address -->
			     		<div class="headertopleft">			     			
			        		<div class="address clearfix"><span><i class="fas fa-map-marker-alt"></i>{{ site_setting('address', '121 King St, Melbourne, VIC 3000') }} </span> <a href="tel:{{ site_setting('phone', '123456789') }}" class="callusbtn"><i class="fas fa-phone"></i>{{ site_setting('phone', '(800)-569-7890') }}</a>
			            	</div>
			     		</div>

			     		<!-- Social Links -->
					    <div class="headertopright">
					    	@auth
					    		<a class="googleicon" title="My Account" href="{{ auth()->user()->hasRole('Patient') ? route('patient.dashboard') : route('admin.dashboard') }}"><i class="fas fa-user"></i> <span class="mobiletext02">My Account</span></a>
					    	@else
					    		<a class="googleicon" title="Patient Portal" href="{{ route('login') }}"><i class="fas fa-user"></i> <span class="mobiletext02">Patient Login</span></a>
					    	@endauth
					    	@if (site_setting('facebook_url'))<a class="facebookicon" title="Facebook" href="{{ site_setting('facebook_url') }}" target="_blank"><i class="fab fa-facebook-f"></i> <span class="mobiletext02">Facebook</span></a>@endif
					    	@if (site_setting('twitter_url'))<a class="twittericon" title="Twitter" href="{{ site_setting('twitter_url') }}" target="_blank"><i class="fab fa-twitter"></i> <span class="mobiletext02">Twitter</span></a>@endif
					    	@if (site_setting('instagram_url'))<a class="googleicon" title="Instagram" href="{{ site_setting('instagram_url') }}" target="_blank"><i class="fab fa-instagram"></i> <span class="mobiletext02">Instagram</span></a>@endif
					        @if (site_setting('linkedin_url'))<a class="linkedinicon" title="Linkedin" href="{{ site_setting('linkedin_url') }}" target="_blank"><i class="fab fa-linkedin-in"></i> <span class="mobiletext02">Linkedin</span></a>@endif
					      	</div>

					    </div>
				  	</div>	<!-- END HEADER STRIP -->


			  	<!-- NAVIGATION MENU -->
			  	<div class="wsmainfull menu clearfix">
    				<div class="wsmainwp clearfix">

    					<!-- LOGO IMAGE -->
    					<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80 pixels) -->
    					<div class="desktoplogo">
    						<a href="{{ route('frontend.home') }}">
    							@if (site_setting('logo_path'))
    								<img src="{{ asset('storage/' . site_setting('logo_path')) }}" width="180" height="40" alt="{{ site_setting('site_name', 'Healix HMS') }}">
    							@else
    								<img src="{{ asset('frontend/images/logo-grey.png') }}" width="180" height="40" alt="header-logo">
    							@endif
    						</a>
    					</div>

    					<!-- MAIN MENU -->
      					<nav class="wsmenu clearfix">
        					<ul class="wsmenu-list">


						<!-- DROPDOWN MENU -->
						<li aria-haspopup="true"><a href="{{ route('frontend.home') }}">Home</a></li>	<!-- END DROPDOWN MENU -->


						<!-- PAGES -->
						<li aria-haspopup="true"><a href="#">Pages <span class="wsarrow"></span></a>
							<div class="wsmegamenu clearfix">
								<div class="container">
									<div class="row">

										<!-- MEGAMENU LINKS -->
										<ul class="col-lg-3 col-md-12 col-xs-12 link-list">
											<li class="title">About:</li>
											<li><a href="{{ route('frontend.about') }}">About Us</a></li>
											<li><a href="{{ route('frontend.who-we-are') }}">Who We Are</a></li>
											<li><a href="{{ route('frontend.services') }}">Our Services</a></li>
										</ul>

										<!-- MEGAMENU LINKS -->
										<ul class="col-lg-3 col-md-12 col-xs-12 link-list">
											<li class="title">Medical:</li>
											<li><a href="{{ route('frontend.departments') }}">Our Departments</a></li>
											<li><a href="{{ route('frontend.doctors') }}">Meet the Doctors</a></li>
											<li><a href="{{ route('frontend.timetable') }}">Doctors Timetable</a></li>
										</ul>

										<!-- MEGAMENU LINKS -->
										<ul class="col-lg-3 col-md-12 col-xs-12 link-list">
											<li class="title">Patient:</li>
											<li><a href="{{ route('frontend.appointment') }}">Make an Appointment</a></li>
											<li><a href="{{ route('patient.register') }}">Patient Registration</a></li>
											<li><a href="{{ route('frontend.faqs') }}">FAQs</a></li>
											<li><a href="{{ route('frontend.terms') }}">Terms of Use</a></li>
										</ul>

										<!-- MEGAMENU LINKS -->
										<ul class="col-lg-3 col-md-12 col-xs-12 link-list">
											<li class="title">More:</li>
											<li><a href="{{ route('frontend.gallery') }}">Our Gallery</a></li>
											<li><a href="{{ route('frontend.blog') }}">Blog</a></li>
											<li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
										</ul>

									</div>  <!-- End row -->
								</div>  <!-- End container -->
							</div>  <!-- End wsmegamenu -->
						</li>	<!-- END PAGES -->


					          	<!-- HALF MENU -->
					          	<li aria-haspopup="true"><a href="#">Half Menu <span class="wsarrow"></span></a>
					            	<div class="wsmegamenu clearfix halfmenu">
					              		<div class="container-fluid">
					                		<div class="row">

					                			<!-- Links -->
							                	<ul class="col-lg-6 col-md-12 col-xs-12 link-list">
							                    	<li class="title">For Patients:</li>
								                    <li><a href="#">Meet The Doctors</a></li>							                    
								                    <li><a href="#">Patient Info Sheets</a></li>
								                    <li><a href="#">Online Patients Portal</a></li>
								                    <li><a href="#">Patients Testimonials</a></li>
								                    <li><a href="#">Blog & Latest News</a></li>								                    
							                  	</ul>

							                  	<!-- Links -->
								                <ul class="col-lg-6 col-md-12 col-xs-12 link-list">
								                    <li class="title">Quick Links:</li>
								                    <li><a href="#">Terms & Privacy Policy</a></li>
								                    <li><a href="#">Donor Privacy Policy</a></li>
								                    <li><a href="#">Workers Compensation</a></li>
								                    <li><a href="#">Insurance Information</a></li>
								                    <li><a href="#">After Hours Care</a></li>
								                </ul>

					                		</div>
					              		</div>
					            	</div>
					          	</li>	<!-- END HALF MENU -->


					          	<!-- MEGAMENU -->
					          	<li aria-haspopup="true"><a href="#">Mega Menu <span class="wsarrow"></span></a>
            						<div class="wsmegamenu clearfix">
             							<div class="container">
               								<div class="row">


               									<!-- MEGAMENU QUICK LINKS -->
               									<ul class="col-lg-3 col-md-12 col-xs-12 link-list">
								                    <li class="title">Quick Links:</li>
								                    <li><a href="#">For Referring Doctors</a></li>
								                    <li><a href="#">Terms & Privacy Policy</a></li>
								                    <li><a href="#">Donor Privacy Policy</a></li>								                    
								                    <li><a href="#">Patient Info Sheets</a></li>
								                    <li><a href="#">Online Patients Portal</a></li>
								                    <li><a href="#">Insurance Information</a></li>
								                    <li><a href="#">Patients Testimonials</a></li>
								                </ul>


								                <!-- MEGAMENU FEATURED NEWS -->
								                <div class="col-lg-5 col-md-12 col-xs-12">

								                	<!-- Title -->
								                    <h3 class="title">Featured News:</h3>

								                    <!-- Image -->
								                    <div class="fluid-width-video-wrapper"><img src="{{ asset('frontend/images/blog/featured-news.jpg') }}" alt="featured-news" /></div>

								                    <!-- Text -->
								                    <h5 class="h5-xs"><a href="#">5 Benefits of integrative medicine</a></h5>
								                    <p class="wsmwnutxt">Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
								                       tempus feugiat dolor impedit magna purus at pretium gravida donec
								                    </p>

								                </div>	<!-- END MEGAMENU FEATURED NEWS -->


								                <!-- MEGAMENU LATEST NEWS -->
								                <div class="col-lg-4 col-md-12 col-xs-12">

								                	<!-- Title -->
                    								<h3 class="title">Latest News:</h3>

                    								<!-- Latest News -->
                    								<ul class="latest-news">
									
														<!-- Post #1 -->
														<li class="clearfix d-flex align-items-center">

															<!-- Image -->
															<img class="img-fluid" src="{{ asset('frontend/images/blog/latest-post-1.jpg') }}" alt="blog-post-preview" />

															<!-- Text -->
															<div class="post-summary">
																<a href="{{ route('frontend.blog-single') }}">Etiam sapien risus ante auctor tempus accumsan an empor ...</a>
																<p>43 Comments</p>
															</div>

														</li>
														
														<!-- Post #2 -->
														<li class="clearfix d-flex align-items-center">

															<!-- Image -->
															<img class="img-fluid" src="{{ asset('frontend/images/blog/latest-post-2.jpg') }}" alt="blog-post-preview" />

															<!-- Text -->
															<div class="post-summary">
																<a href="{{ route('frontend.blog-single') }}">Blandit tempor a sapien ipsum, porta risus auctor justo ...</a>
																<p>38 Comments</p>
															</div>

														</li>
														
														<!-- Post #3 -->
														<li class="clearfix d-flex align-items-center">

															<!-- Image -->
															<img class="img-fluid" src="{{ asset('frontend/images/blog/latest-post-3.jpg') }}" alt="blog-post-preview" />

															<!-- Text -->
															<div class="post-summary">
																<a href="{{ route('frontend.blog-single') }}">Cursus risus auctor tempus risus laoreet turpis auctor varius ...</a>
																<p>29 Comments</p>
															</div>

														</li>
													</ul>
                    							</div>	<!-- END MEGAMENU LATEST NEWS -->

								                
							                </div>  <!-- End row -->	
							            </div>  <!-- End container -->	
							        </div>  <!-- End wsmegamenu -->	
							    </li>	<!-- END MEGAMENU -->

							    
							    <!-- SIMPLE NAVIGATION LINK -->
							    <li class="nl-simple" aria-haspopup="true"><a href="#">Simple Link</a></li>

							    <!-- NAVIGATION MENU BUTTON -->
							    <li class="nl-simple header-btn" aria-haspopup="true"><a href="{{ route('frontend.appointment') }}">Make an Appointment</a></li>


        					</ul>
        				</nav>	<!-- END MAIN MENU -->

    				</div>
    			</div>	<!-- END NAVIGATION MENU -->


			</header>	<!-- END HEADER -->
