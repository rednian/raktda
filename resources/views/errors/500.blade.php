
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>RAKTDA | 500 Error</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link href="{{ asset('/assets/css/demo1/pages/error/error-6.css')  }}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('/assets/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
	<link rel='icon' type='image/png' href="{{ asset('/img/favicon-64x64.png') }}">
	<link rel='icon' type='image/png' href="{{ asset('/img/favicon-32x32.png') }}">
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6" style="background-image: url({{ asset('/assets/media//error/bg6.jpg') }});">
		<div class="kt-error_container">
			<div class="kt-error_subtitle kt-font-light">
				<h1>Oops...</h1>
			</div>
			<p class="kt-error_description kt-font-light">
				Looks like something went wrong.<br>
				We're working on it
			</p>
		</div>
	</div>
</div>
</body>
</html>