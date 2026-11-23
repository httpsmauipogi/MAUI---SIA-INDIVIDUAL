<!DOCTYPE html>
<!-- Healix HMS - Medical & Medical Health Landing Page Template design by Jthemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">




	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="author" content="{{ site_setting('site_name', 'Healix HMS') }}"/>	
		<meta name="description" content="{{ site_setting('site_name', 'Healix HMS') }} - {{ site_setting('tagline', 'Hospital & Clinic Management System') }}"/>
		<meta name="keywords" content="Responsive, HTML5 Template, Jthemes, One Page, Landing, Medical, Health, Healthcare, Doctor, Clinic, Care, Hospital">	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  		<!-- SITE TITLE -->
		<title>@yield('title', site_setting('site_name', 'Healix HMS') . ' - ' . site_setting('tagline', 'Hospital & Clinic Management System'))</title>
				
		<!-- FAVICON AND TOUCH ICONS  -->
		<link rel="shortcut icon" href="{{ site_setting('favicon_path') ? storage_url(site_setting('favicon_path')) : asset('frontend/images/favicon.ico') }}" type="image/x-icon">
		<link rel="icon" href="{{ site_setting('favicon_path') ? storage_url(site_setting('favicon_path')) : asset('frontend/images/favicon.ico') }}" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('frontend/images/apple-touch-icon-152x152.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('frontend/images/apple-touch-icon-120x120.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/images/apple-touch-icon-76x76.png') }}">
		<link rel="apple-touch-icon" href="{{ asset('frontend/images/apple-touch-icon.png') }}">

		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet"> 	
		<link href="https://fonts.googleapis.com/css?family=Lato:400,700,900" rel="stylesheet"> 

		<!-- BOOTSTRAP CSS -->
		<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
				
		<!-- FONT ICONS -->
		<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet" crossorigin="anonymous">		
		<link href="{{ asset('frontend/css/flaticon.css') }}" rel="stylesheet">

		<!-- PLUGINS STYLESHEET -->
		<link href="{{ asset('frontend/css/menu.css') }}" rel="stylesheet">	
		<link id="effect" href="{{ asset('frontend/css/dropdown-effects/fade-down.css') }}" media="all" rel="stylesheet">
		<link href="{{ asset('frontend/css/magnific-popup.css') }}" rel="stylesheet">	
		<link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/owl.theme.default.min.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('frontend/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
				
		<!-- TEMPLATE CSS -->
		<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
		
		<!-- RESPONSIVE CSS -->
		<link href="{{ asset('frontend/css/responsive.css') }}" rel="stylesheet"> 
	
	</head>

	<body>


		<!-- PRELOADER SPINNER
		============================================= -->	
		<div id="loader-wrapper">
			<div id="loader"><div class="loader-inner"></div></div>
		</div>


		<!-- PAGE CONTENT
		============================================= -->	
		<div id="page" class="page">

			@include('partials.frontend.header')

			@yield('content')

			@include('partials.frontend.footer')

		</div>	<!-- END PAGE CONTENT -->


		<!-- EXTERNAL SCRIPTS
		============================================= -->	
		<script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
		<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>	
		<script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.easing.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.appear.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>	
		<script src="{{ asset('frontend/js/menu.js') }}"></script>
		<script src="{{ asset('frontend/js/sticky.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.scrollto.js') }}"></script>
		<script src="{{ asset('frontend/js/materialize.js') }}"></script>	
		<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>	
		<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
		<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
		<script src="{{ asset('frontend/js/hero-form.js') }}"></script>
		<script src="{{ asset('frontend/js/contact-form.js') }}"></script>
		<script src="{{ asset('frontend/js/comment-form.js') }}"></script>
		<script src="{{ asset('frontend/js/appointment-form.js') }}"></script>
		<script src="{{ asset('frontend/js/jquery.datetimepicker.full.js') }}"></script>		
		<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>	
		<script src="{{ asset('frontend/js/jquery.ajaxchimp.min.js') }}"></script>
		<script src="{{ asset('frontend/js/wow.js') }}"></script>	
	
		<!-- Custom Script -->		
		<script src="{{ asset('frontend/js/custom.js') }}"></script>

		<script> 
			new WOW().init();
		</script>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
		<!-- [if lt IE 9]>
			<script src="{{ asset('frontend/js/html5shiv.js') }}" type="text/javascript"></script>
			<script src="{{ asset('frontend/js/respond.min.js') }}" type="text/javascript"></script>
		<![endif] -->

		<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->	
		<!--
		<script>
			window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
			ga('create', 'UA-XXXXX-Y', 'auto');
			ga('send', 'pageview');
		</script>
		<script async src='https://www.google-analytics.com/analytics.js'></script>
		-->
		<!-- End Google Analytics -->

		@stack('scripts')

	</body>
</html>
