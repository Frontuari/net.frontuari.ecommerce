<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	{{-- TODO: Titulo web  --}}
	<title> @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="Shortcut Icon" href="/assets/img/favicon.ico" type="image/x-icon" />	
	<link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
	<!--<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}?ver=1.0.8">-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.min.css') }}?ver=1.0.8">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bree-font.css') }}">
	<!--<link rel="stylesheet" type="text/css" href="{{ asset('css/new-styles.css') }}?ver=2.0.4">-->

	<!-- Global site tag (gtag.js) - Google Analytics -->
	{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-171491944-1"></script> --}}
	<script>
	  var url_base = "{{ str_replace('http:','https:',url('/')) }}";
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-171491944-1');
	</script>



	<!-- Actualizar Pixel de Facebook -->

	<!-- Facebook Pixel Code -->
	
	<script>
		
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '306422670423398');
	fbq('track', 'PageView');
	</script>
	
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=306422670423398&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->
	
	<style>.cls-1{fill:#ccc;}</style>
	<script>
		var min_range, max_range;
	</script>
	@yield('css')
</head>

<body>

<main id="app">
	<header-menu :userlogged="{{ json_encode($_SESSION['usuario'] ?? '') }}"></header-menu>
