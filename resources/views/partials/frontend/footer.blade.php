			<footer id="footer-1" class="bg-image wide-40 footer division">
				<div class="container">

					<!-- FOOTER CONTENT -->
					<div class="row">	

						<!-- FOOTER INFO -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-info mb-40">

								<!-- Footer Logo -->
								<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80  pixels) -->
				@if (site_setting('logo_path'))
					<img src="{{ asset('storage/' . site_setting('logo_path')) }}" width="180" height="40" alt="{{ site_setting('site_name', 'Healix HMS') }}">
				@else
					<img src="{{ asset('frontend/images/footer-logo-white.png') }}" width="180" height="40" alt="footer-logo">
				@endif

								<!-- Text -->	
				<p class="p-sm mt-20">{{ site_setting('footer_about', 'Providing compassionate, modern healthcare with a patient-first approach.') }}

				</p>

								<!-- Social Icons -->
								<div class="footer-socials-links mt-20">
									<ul class="foo-socials text-center clearfix">

						@if (site_setting('facebook_url'))<li><a href="{{ site_setting('facebook_url') }}" target="_blank" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li>@endif
						@if (site_setting('twitter_url'))<li><a href="{{ site_setting('twitter_url') }}" target="_blank" class="ico-twitter"><i class="fab fa-twitter"></i></a></li>@endif
						@if (site_setting('instagram_url'))<li><a href="{{ site_setting('instagram_url') }}" target="_blank" class="ico-instagram"><i class="fab fa-instagram"></i></a></li>@endif
						@if (site_setting('linkedin_url'))<li><a href="{{ site_setting('linkedin_url') }}" target="_blank" class="ico-linkedin"><i class="fab fa-linkedin-in"></i></a></li>@endif
						@if (site_setting('youtube_url'))<li><a href="{{ site_setting('youtube_url') }}" target="_blank" class="ico-youtube"><i class="fab fa-youtube"></i></a></li>@endif

								</div>	
							
							</div>		
						</div>

						<!-- FOOTER CONTACTS -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-box mb-40">
							
								<!-- Title -->
								<h5 class="h5-xs">Our Location</h5>

								<!-- Address -->
				<p>{{ site_setting('address', '121 King Street, Melbourne, Victoria 3000') }}</p>

								
								<!-- Email -->
				<p class="foo-email mt-20">E: <a href="mailto:{{ site_setting('email', 'hello@healixhms.com') }}">{{ site_setting('email', 'hello@healixhms.com') }}</a></p>

								<!-- Phone -->
				<p>P: {{ site_setting('phone', '+12 9 8765 4321') }}</p>

							</div>
						</div>

						<!-- FOOTER WORKING HOURS -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-box mb-40">
							
								<!-- Title -->
								<h5 class="h5-xs">Working Time</h5>

								<!-- Working Hours -->
								<p class="p-sm">Mon - Wed - <span>9:00 AM - 7:00 PM</span></p>
								<p class="p-sm">Thursday - <span>9:00 AM - 6:30 PM</span></p>
								<p class="p-sm">Friday - <span>9:00 AM - 6:00 PM</span></p>
								<p class="p-sm">Sat - Sun - <span>Closed</span></p>										

							</div>
						</div>

						<!-- FOOTER PHONE NUMBER -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-box mb-40">
												
								<!-- Title -->
								<h5 class="h5-xs">Emergency Cases</h5>

								<!-- Footer List -->
								<h5 class="h5-xl blue-color">1-800-123-4560</h5>

								<!-- Text -->	
								<p class="p-sm mt-15">Aliquam orci nullam undo tempor sapien gravida donec enim ipsum porta
								   justo velna aucto magna
								</p> 																												

							</div>
						</div>	

					</div>	  <!-- END FOOTER CONTENT -->

					<!-- FOOTER COPYRIGHT -->
					<div class="bottom-footer">
						<div class="row">
							<div class="col-md-12">
							<p class="footer-copyright">&copy; <script>document.write(new Date().getFullYear())</script> <span>{{ site_setting('site_name', 'Healix HMS') }}</span>. {{ site_setting('copyright_text') ? '' : 'All Rights Reserved' }}{{ site_setting('copyright_text') }}</p>
							</div>
						</div>
					</div>

				</div>	   <!-- End container -->										
			</footer>	<!-- END FOOTER-1 -->
