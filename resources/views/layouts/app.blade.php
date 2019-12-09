<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Auth::user()->LanguageId != 1 ?  'rtl': null }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'RAK TDA')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: { "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"] },
            active: function() { sessionStorage.fonts = true; }
        });
    </script>
    <!--begin::Page Vendors Styles(used by this page) -->
    @if (Auth::user()->LanguageId == 1)
    <link href="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.min.css') }}" rel="stylesheet"
        type="text/css" />
    @else
    <link href="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.rtl.min.css') }}" rel="stylesheet"
        type="text/css" />
    @endif
    <link href="{{ asset('/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />

    <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/custom/flag-icon-css-master/css/flag-icon.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css" />



    {{-- <link href="{{ asset('/assets/vendors/global/vendors.bundle.css') }}" rel="stylesheet" type="text/css" /> --}}
    @if (Auth::user()->LanguageId == 1)
    <link href="{{ asset('/assets/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .kt-aside {
            box-shadow: 4px 0 5px -2px #888;
        }
    </style>
    @else
    <link href="{{ asset('/assets/css/demo1/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .kt-aside {
            box-shadow: 4px 0 5px 4px #888 !important;
        }
    </style>
    @endif


    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    @if (Auth::user()->LanguageId == 1)
    {{-- eng --}}
    <link href="{{ asset('/assets/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    @else
    <link href="{{ asset('/assets/css/demo1/skins/header/base/light.rtl.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/css/demo1/skins/header/menu/light.rtl.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/css/demo1/skins/brand/dark.rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/css/demo1/skins/aside/dark.rtl.min.css') }}" rel="stylesheet" type="text/css" />
    @endif

    {{-- <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css" /> --}}

    <link href="{{asset('./assets/css/wizard-3.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/css/companyCustom.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <!--end::Layout Skins -->

    <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
    <link rel='icon' type='image/png' href="{{ asset('/img/favicon-64x64.png') }}">
    <link rel='icon' type='image/png' href="{{ asset('assets/img/favicon-32x32.png') }}">
</head>

<body
    class="kt-page--loading-enabled kt-page--loading kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-page--loading">
    <!-- begin:: Page -->

    <!-- begin::Page loader -->
    <div class="kt-page-loader kt-page-loader--base">
        <div class="blockui">
            <span>Please wait...</span>
            <span>
                <div class="kt-spinner kt-spinner--danger"></div>
            </span>
        </div>
    </div>
    <!-- end::Page Loader -->
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="#">
                @if (Auth::user()->LanguageId == 1)
                <img alt="Logo" src="{{ asset('/img/logo-en.svg') }}" />
                @else
                <img alt="Logo" src="{{ asset('/img/logo-ar.svg') }}" />
                @endif
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left"
                id="kt_aside_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @include('layouts.sidebar')
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                @include('layouts.header')
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
                {{-- @include('layouts.admin.footer') --}}
            </div>
        </div>
    </div>
    <!-- end:: Page -->
    <!--[html-partial:include:{"file":"partials\/_offcanvas-quick-actions.html"}]/-->
    <!--[html-partial:include:{"file":"partials\/_layout-scrolltop.html"}]/-->
    <!--[html-partial:include:{"file":"partials\/_layout-toolbar.html"}]/-->
    <!--[html-partial:include:{"file":"partials\/_layout-demo-panel.html"}]/-->
    <!--[html-partial:include:{"file":"partials\/_layout-chat.html"}]/-->

    <script>

    </script>
    <!-- end::Global Config -->
    <!--begin:: Global Mandatory Vendors -->
    <script src="{{ asset('assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>
    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <script src="{{ asset('/assets/vendors/general/jquery-form/dist/jquery.form.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/block-ui/jquery.blockUI.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js') }}"
        type="text/javascript"></script>
    <script
        src="{{ asset('/assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/js/vendors/bootstrap-switch.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/select2/dist/js/select2.full.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/typeahead.js/dist/typeahead.bundle.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/handlebars/dist/handlebars.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/js/vendors/bootstrap-markdown.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/js/vendors/bootstrap-notify.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/jquery-validation/dist/jquery.validate.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/jquery-validation/dist/additional-methods.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript"></script>
    <script
        src="{{ asset('/assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/assets/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

    <!--begin::Global Theme Bundle(used by all pages) -->
    {{-- <script src="{{ asset('/assets/vendors/global/vendors.bundle.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('/assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Page Vendors(used by this page) -->

    <script src="{{ asset('/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/custom/fancybox-master/dist/jquery.fancybox.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('/assets/vendors/custom/bootbox/bootbox.all.min.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('/js/company/custom.js') }}" type="text/javascript"></script>
    <!--end::Page Vendors -->

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
            //
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