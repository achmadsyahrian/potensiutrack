<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta19
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<meta http-equiv="X-UA-Compatible" content="ie=edge" />
	<title>{{ Auth::guest() ? 'Login |' : '' }} {{ config('app.name') }}</title>
	<link rel="icon" type="image/png" href="{{ asset('image/Logopotensiutama.png') }}" sizes="32x32" />
	<!-- CSS files -->
	<link href="{{ asset('dist/css/tabler.min.css?1684106062') }}" rel="stylesheet" />
	<link href="{{ asset('dist/css/tabler-flags.min.css?1684106062') }}" rel="stylesheet" />
	<link href="{{ asset('dist/css/tabler-payments.min.css?1684106062') }}" rel="stylesheet" />
	<link href="{{ asset('dist/css/tabler-vendors.min.css?1684106062') }}" rel="stylesheet" />
	<link href="{{ asset('dist/css/demo.min.css?1684106062') }}" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
	<style>
		@import url('https://rsms.me/inter/inter.css');

		:root {
			--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
		}

		body {
			font-feature-settings: "cv03", "cv04", "cv11";
		}
	</style>
</head>

<body>
	<script src="{{ asset('dist/js/demo-theme.min.js?1684106062') }}"></script>
	<div class="page">
		<!-- Navbar -->
		@auth
		@include('inc.header')
		@endauth

		<div class="page-wrapper">
			{{-- Content --}}
			@yield('content')
			@auth
			@include('inc.footer')
			@endauth
		</div>
	</div>
	<!-- Libs JS -->
	@include('inc.script')
</body>

</html>