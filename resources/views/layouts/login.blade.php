<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
<title>Metronic | Login Page 5</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="Login page example">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!--begin::Fonts -->
<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
<script>
    WebFont.load({
        google: {
            "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
        },
        // active: function() {
        //     sessionStorage.fonts = true;
        // }
    });
</script>

<!--end::Fonts -->

<!--begin::Page Custom Styles(used by this page) -->
<link href="{{ asset('/assets/css/demo1/pages/general/login/login-5.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('/assets/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/assets/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="{{ asset('/assets/media/logos/favicon.ico') }}" />
</head>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
<div class="kt-grid kt-grid--ver kt-grid--root">
<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v5 kt-login--signin" id="kt_login">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile" style="background-image: url({{ asset('/assets/media/bg/bg-3.jpg') }});">
        <div class="kt-login__left">
            <div class="kt-login__wrapper">
                <div class="kt-login__content">
                    <a class="kt-login__logo" href="#">
                        <img src="{{ asset('/assets/media/logos/logo-5.png') }}">
                    </a>
                    <h3 class="kt-login__title">JOIN OUR GREAT COMMUNITY</h3>
                    <span class="kt-login__desc">
                        The ultimate Bootstrap & Angular 6 admin theme framework for next generation web apps.
                    </span>
                    <div class="kt-login__actions">
                        <button type="button" id="kt_login_signup" class="btn btn-outline-brand btn-pill">Get An Account</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-login__divider">
            <div></div>
        </div>
        <div class="kt-login__right">
            <div class="kt-login__wrapper">
                <div class="kt-login__signin">
                    <div class="kt-login__head">
                        <h3 class="kt-login__title">Login To Your Account</h3>
                    </div>
                    <div class="kt-login__form">
                        @yield('content')
                    </div>
                </div>
                {{-- <div class="kt-login__forgot">
                    <div class="kt-login__head">
                        <h3 class="kt-login__title">Forgotten Password ?</h3>
                        <div class="kt-login__desc">Enter your email to reset your password:</div>
                    </div>
                    <div class="kt-login__form">
                        <form class="kt-form" action="">
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
                                <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>
</div>
<script>
var KTAppOptions = {
"colors": {
    "state": {
        "brand": "#5d78ff",
        "dark": "#282a3c",
        "light": "#ffffff",
        "primary": "#5867dd",
        "success": "#34bfa3",
        "info": "#36a3f7",
        "warning": "#ffb822",
        "danger": "#fd3995"
    },
    "base": {
        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
    }
}
};
</script>
<script src="{{ asset('/assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>
<script src="{{ asset('/assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('/assets/js/demo1/pages/login/login-general.js') }}" type="text/javascript"></script> --}}
</body>
</html>