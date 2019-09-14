<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>RAK TDA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--begin::Page Vendors Styles(used by this page) -->
    <link href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/custom/datatables/datatables.bundle.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css')  }}" rel="stylesheet"
        type="text/css" />

    <!--end::Page Vendors Styles -->

    <!--begin:: Global Optional Vendors -->
    <link href="{{ asset('assets/vendors/general/tether/dist/css/tether.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/select2/dist/css/select2.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ asset('assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/nouislider/distribute/nouislider.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/dropzone/dist/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/summernote/dist/summernote.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/animate.css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/toastr/build/toastr.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/morris.js/morris.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/sweetalert2/dist/sweetalert2.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Styles(used by all pages) -->

    <link href="{{ asset('assets/css/demo1/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!--end::Global Theme Styles -->

    <!--begin::Layout Skins(used by all pages) -->
    <link href="{{ asset('assets/css/demo1/skins/header/base/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/demo1/skins/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/demo1/skins/brand/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/demo1/skins/aside/dark.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{asset('./assets/css/demo1/pages/general/wizard/wizard-3.css')}}" rel="stylesheet" type="text/css" />


    <link href="{{ asset('assets/css/main2.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->

    <link rel="apple-touch-icon" type="image/png" href="{{ asset('assets/img/apple-touch-icon.png')}}" />
    <link rel="icon" type="image/png" href="{{ url('/img/favicon-64x64.png') }}" />
    <link rel="icon" type="image/png" href="{{ url('/img/favicon-32x32.png') }}" />
</head>

<body
    class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

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
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="./">
                <img alt="Logo" src="{{url('/img/logo2-en.svg') }}" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i
                    class="flaticon-more"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @include('layouts.sidebar')
            @include('layouts.header')
            <div class="kt-content kt-grid__item kt-grid__item--fluid" id="content">
                @yield('content')
            </div>
            @include('layouts.footer')
        </div>
    </div>

    <!-- end:: Page -->


    </div>
    </div>
    </div>
    <!--begin:: Global Mandatory Vendors -->
    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
		colors: {
			state: {
				brand: "#2c77f4",
				light: "#ffffff",
				dark: "#282a3c",
				primary: "#5867dd",
				success: "#34bfa3",
				info: "#36a3f7",
				warning: "#ffb822",
				danger: "#fd3995"
			},
			base: {
				label: ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
				shape: ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
			}
		}
	};
    </script>

    <!-- end::Global Config -->

    <!--begin:: Global Mandatory Vendors -->
    <script src="{{ asset('./assets/vendors/general/jquery/dist/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/js-cookie/src/js.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/moment/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/sticky-js/dist/sticky.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/wnumb/wNumb.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/jquery-form/dist/jquery.form.min.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/block-ui/jquery.blockUI.js')}}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/bootstrap-datepicker.init.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js')}}"
        type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/bootstrap-timepicker.init.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js')}}"
        type="text/javascript">
    </script>
    <script
        src="{{ asset('./assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/bootstrap-switch.init.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/select2/dist/js/select2.full.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/typeahead.js/dist/typeahead.bundle.js')}}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/handlebars/dist/handlebars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js')}}"
        type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js')}}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/nouislider/distribute/nouislider.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/owl.carousel/dist/owl.carousel.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/autosize/dist/autosize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/clipboard/dist/clipboard.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/dropzone/dist/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/summernote/dist/summernote.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/markdown/lib/markdown.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/bootstrap-markdown.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/bootstrap-notify.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/jquery-validation/dist/jquery.validate.js') }}"
        type="text/javascript"></script>

    <script src="{{ asset('./assets/vendors/general/jquery-validation/dist/additional-methods.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/jquery-validation.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/toastr/build/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/raphael/raphael.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/morris.js/morris.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/chart.js/dist/Chart.bundle.js') }}" type="text/javascript">
    </script>
    <script
        src="{{ asset('./assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/waypoints/lib/jquery.waypoints.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/counterup/jquery.counterup.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/es6-promise-polyfill/promise.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/sweetalert2/dist/sweetalert2.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/custom/js/vendors/sweetalert2.init.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/jquery.repeater/src/lib.js') }}" type="text/javascript"></script>
    <script src="{{ asset('./assets/vendors/general/jquery.repeater/src/jquery.input.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/jquery.repeater/src/repeater.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('./assets/vendors/general/dompurify/dist/purify.js') }}" type="text/javascript"></script>

    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset('./assets/vendors/custom/fullcalendar/fullcalendar.bundle.js') }}" type="text/javascript">
    </script>

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ asset('./assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>

    <!--end::Global Theme Bundle -->

    <!--begin::Page Scripts(used by this page) -->

    <script src="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

    <!--end::Page Scripts -->

    <script src="{{ asset('./assets/js/main.js') }}" type="text/javascript"></script>

    <script>
        $(document).ready(function(){

        $('.select2').select2({dropdownAutoWidth:true});

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

        $(document).bind("ajaxSend", function(){
            // $.LoadingOverlay("show", {
            //     image: "{{ asset('images/loading.gif') }}",
            //     size: 10
            // });
        }).bind("ajaxSuccess", function(event, request, settings, data){
            // $.LoadingOverlay("hide");
            if(data.hasOwnProperty('message')){
                $.notify({
                    title: data.message[2],
                    message: data.message[1],
                },{
                    type: data.message[0],
                    animate: {
                        enter: 'animated zoomIn',
                        exit: 'animated zoomOut'
                    },
                });
            }
        }).bind("ajaxError", function(event, request, settings, data){
            $.notify({
                title: 'Somethings wrong!',
                message: data,
            },{
                type: 'error',
                animate: {
                    enter: 'animated zoomIn',
                    exit: 'animated zoomOut'
                },
            });
            // $.LoadingOverlay("hide");
            // new PNotify({
            //     title: 'Error',
            //     text: data,
            //     type: 'error'
            // });
        });


        $.extend( true, $.fn.dataTable.defaults, {
            deferRender: true,
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: {
                global: false
            },
            pagingType: 'full_numbers',
            language: {
                infoFiltered: '',
                lengthMenu: "Show _MENU_",
                processing: '<span class="fa fa-spinner fa-spin fa-3x text-info"></span>',
            paginate: {
                    previous: '<i class="fa fa-chevron-left"></i>',
                    next: '<i class="fa fa-chevron-right"></i>',
                }
            },
            });

        });

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


    @yield('script')
</body>

</html>
