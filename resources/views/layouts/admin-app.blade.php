<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
<title>RAK TDA</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
WebFont.load({
    google: { "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"] },
    active: function() { sessionStorage.fonts = true; } 
});
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/all.css') }}">
<link href="{{ asset('/assets/vendors/custom/file-icons/css/style.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
@yield('style')
<link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="{{ asset('/assets/media/logos/favicon.ico') }}" />
</head>
<body
class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
<div class="kt-header-mobile__logo">
    <a href="demo1/index.html">
        <img alt="Logo" src="{{ asset('/assets/media/logos/logo-light.png') }}" />
    </a>
</div>
<div class="kt-header-mobile__toolbar">
    <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
    <button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
    <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
</div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        @include('layouts.sidebar-admin')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        @include('layouts.admin-header')
        {{ !is_array($breadcrumb) ? Breadcrumbs::render($breadcrumb) : Breadcrumbs::render($breadcrumb[0], $breadcrumb[1]) }}
        <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
</div>
</div>
@include('layouts.admin-panel')
<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
<script>
$(document).ready(function(){
    @if (Session::has('message'))
    $.notify({
        title: '{{Session::get('message')[2]}}',
        message: '{{Session::get('message')[1]}}',
    },{
        type:'{{Session::get('message')[0]}}',
        animate: {
            enter: 'animated zoomIn',
            exit: 'animated zoomOut'
        },
    });
    @endif
});
</script>
@yield('script')
</body>
</html>
