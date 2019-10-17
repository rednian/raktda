<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Auth::user()->LanguageId != 1 ?  'rtl': null }}">
<head>
  <meta charset="utf-8" />
  <title>RAK TDA | {{ ucwords($page_title) }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
            google: { "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"] },
            active: function() { sessionStorage.fonts = true; }
        });
  </script>
  @if (Auth::user()->LanguageId == 1)
    <link href="{{ asset('/css/custom-vendor.css') }}" rel="stylesheet" type="text/css" />
  @else
    <link href="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.rtl.min.css') }}" rel="stylesheet" type="text/css" />
  @endif
   <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendors/custom/flag-icon-css-master/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  
  @if (Auth::user()->LanguageId == 1)
    <link href="{{ asset('/css/mandatory.css') }}" rel="stylesheet" type="text/css" />
  @else
    <link href="{{ asset('/css/mandatory-arabic.css') }}" rel="stylesheet" type="text/css" />
  @endif
  <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css" />
  @yield('style')
  <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
  <link rel='icon' type='image/png' href="{{ asset('/img/favicon-64x64.png') }}">
  <link rel='icon' type='image/png' href="{{ asset('/img/favicon-32x32.png') }}">
</head>
<body class="kt-page--loading-enabled kt-page--loading  kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed" >
<!-- begin:: Page -->
<!-- begin::Page loader -->
<div class="kt-page-loader kt-page-loader--base">
  <div class="blockui">
    <span>Please wait...</span>
    <span><div class="kt-spinner kt-spinner--danger"></div></span>
  </div>
</div>
<!-- end::Page Loader -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed " >
  <div class="kt-header-mobile__logo">
    <a href="{{ route('admin.dashboard') }}">
      @if (Auth::user()->LanguageId == 1)
        <img alt="Logo" src="{{ asset('/img/logo-en.svg') }}"/>
      @else
        <img alt="Logo" src="{{ asset('/img/logo-ar.svg') }}"/>
      @endif
    </a>
  </div>
  <div class="kt-header-mobile__toolbar">
    <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
    <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
  </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
    @include('layouts.admin.sidebar')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
      @include('layouts.admin.topbar')
      <div class="kt-content kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content -->
        <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
          <section class="row">
            <div class="col">
              @yield('content')
            </div>
          </section>
        </div>
        <!-- end:: Content -->
      </div>
    </div>
  </div>
</div>
<!-- end:: Page -->
<script src="{{ asset('/js/mandatory.js') }}"></script>
<script src="{{ asset('/js/plugins.js') }}"></script>
<script src="{{ asset('/assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/custom-pages.js') }}"></script>
<script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script>
</body>
@yield('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('span[data-lang=en]').click(function(){
      getLang(1);
    });
    $('span[data-lang=ar]').click(function(){
      getLang(2);
    });
    function getLang(lang){
      $.ajax({
        url: '{{ route('admin.language') }}',
        data: {lang: lang},
        type: 'post'
      }).done(function(response){
        if(response.success) location.reload();
      });
    }
  });
</script>
<!-- end::Body -->
</html>
