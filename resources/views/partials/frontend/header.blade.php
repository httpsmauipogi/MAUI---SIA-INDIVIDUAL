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

							<!-- HOME -->
							<li aria-haspopup="true"><a href="{{ route('frontend.home') }}">Home</a></li>

							<!-- ABOUT -->
							<li aria-haspopup="true"><a href="#">About <span class="wsarrow"></span></a>
								<ul class="sub-menu">
									<li><a href="{{ route('frontend.about') }}">About Us</a></li>
									<li><a href="{{ route('frontend.who-we-are') }}">Who We Are</a></li>
									<li><a href="{{ route('frontend.services') }}">Our Services</a></li>
								</ul>
							</li>	<!-- END ABOUT -->

							<!-- DEPARTMENTS -->
							<li aria-haspopup="true"><a href="{{ route('frontend.departments') }}">Departments</a></li>

							<!-- DOCTORS -->
							<li aria-haspopup="true"><a href="#">Doctors <span class="wsarrow"></span></a>
								<ul class="sub-menu">
									<li><a href="{{ route('frontend.doctors') }}">Meet the Doctors</a></li>
									<li><a href="{{ route('frontend.timetable') }}">Doctors Timetable</a></li>
								</ul>
							</li>	<!-- END DOCTORS -->

							<!-- PATIENTS -->
							<li aria-haspopup="true"><a href="#">Patients <span class="wsarrow"></span></a>
								<ul class="sub-menu">
									<li><a href="{{ route('frontend.appointment') }}">Book an Appointment</a></li>
									<li><a href="{{ route('patient.register') }}">Patient Registration</a></li>
									<li><a href="{{ route('frontend.faqs') }}">FAQs</a></li>
									<li><a href="{{ route('frontend.terms') }}">Terms of Use</a></li>
								</ul>
							</li>	<!-- END PATIENTS -->

							<!-- GALLERY -->
							<li aria-haspopup="true"><a href="{{ route('frontend.gallery') }}">Gallery</a></li>

							<!-- BLOG -->
							<li aria-haspopup="true"><a href="{{ route('frontend.blog') }}">Blog</a></li>

							<!-- CONTACT -->
							<li aria-haspopup="true"><a href="{{ route('frontend.contact') }}">Contact</a></li>

							<!-- NAVIGATION MENU BUTTON -->
							<li class="nl-simple header-btn" aria-haspopup="true"><a href="{{ route('frontend.appointment') }}">Book Appointment</a></li>

        					</ul>
        				</nav>	<!-- END MAIN MENU -->

    				</div>
    			</div>	<!-- END NAVIGATION MENU -->


			</header>	<!-- END HEADER -->
