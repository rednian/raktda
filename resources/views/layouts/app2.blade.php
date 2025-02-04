<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if(Auth::check())
    dir="{{ Auth::user()->LanguageId != 1 ?  'rtl' : null }}" @endif>

<head>
    <meta charset="UTF-8">
    <title>{{config('app.name')}} | @yield('title')</title>
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
    @if (Auth::check())
    @if (Auth::user()->LanguageId == 1)
    <link href="{{ asset('/css/custom-vendor.css') }}" rel="stylesheet" type="text/css" />
    @else
    <link href="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.rtl.min.css') }}" rel="stylesheet"
        type="text/css" />
    @endif
    @endif


    <link href="{{ asset('/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendors/custom/flag-icon-css-master/css/flag-icon.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.theme.default.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css" />

    @if (Auth::check())
    @if (Auth::user()->LanguageId == 1)
    <style type="text/css">
        #kt_aside {
            box-shadow: 4px 0 5px -2px #888;
        }
    </style>
    <link href="{{ asset('/css/mandatory.css') }}" rel="stylesheet" type="text/css" />
    @else
    <link href="{{ asset('/css/mandatory-arabic.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #kt_aside {
            box-shadow: 4px 0 5px 4px #888 !important;
        }
    </style>
    @endif
    @else
    <link href="{{ asset('/css/mandatory.css') }}" rel="stylesheet" type="text/css" />
    @endif

    <link href="{{asset('./assets/css/wizard-3.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/css/companyCustom.css') }}" rel="stylesheet" type="text/css" />
    @yield('style')
    <!--end::Layout Skins -->

    <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
    <link rel='icon' type='image/png' href="{{ asset('/img/favicon-64x64.png') }}">
    <link rel='icon' type='image/png' href="{{ asset('assets/img/favicon-32x32.png') }}">
</head>

<body
    class="kt-page--loading-enabled kt-page--loading  kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed">
    <!-- begin:: Page -->

    <!-- begin::Page loader -->
    <div class="kt-page-loader kt-page-loader--base">
        <div class="blockui">
            <span>{{__('Please wait...')}}</span>
            <span>
                <div class="kt-spinner kt-spinner--danger"></div>
            </span>
        </div>
    </div>
    <!-- end::Page Loader -->
    <!-- begin:: Header Mobile -->
    @if (Auth::check())
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
    @endif

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            @if(Auth::check()) @include('layouts.sidebar') @endif
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
                @if(Auth::check()) @include('layouts.header') @endif
                <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                        <!-- begin:: Content -->
                        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

                            <!--Begin::App-->
                            <div class="kt-grid kt-grid--desktop kt-grid--ver kt-grid--ver-desktop kt-app">

                                <!--Begin:: App Aside Mobile Toggle-->
                                <button class="kt-app__aside-close" id="kt_user_profile_aside_close">
                                    <i class="la la-close"></i>
                                </button>

                                <!--End:: App Aside Mobile Toggle-->

                                <!--Begin:: App Aside-->
                                <section class="row">
                                    <div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">
                                        <div class="kt-portlet">
                                            <div class="kt-portlet__head  kt-portlet__head--noborder">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                    </h3>
                                                </div>
                                                
                                            </div>
                                            <div class="kt-portlet__body kt-portlet__body--fit-y">

                                                <!--begin::Widget -->
                                                <div class="kt-widget kt-widget--user-profile-1">
                                                    <div class="kt-widget__head">
                                                        <div class="kt-widget__media">
                                                            <img src="./assets/media/users/100_1.jpg" alt="image">
                                                        </div>
                                                        <div class="kt-widget__content ">
                                                            <div class="kt-widget__section ">
                                                                <span class="kt-widget__username">{{$company->contact->name}}</span>
                                                                <span class="kt-widget__subtitle">{{$company->contact->designation}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__body">
                                                        <div class="kt-widget__content">
                                                            <div class="kt-widget__info">
                                                                <span class="kt-widget__label">Company Email:</span>
                                                                <a href="#" class="kt-widget__data">{{$company->company_email}}</a>
                                                            </div>
                                                            <div class="kt-widget__info">
                                                                <span class="kt-widget__label">Phone:</span>
                                                                <a href="#" class="kt-widget__data">44(76)34254578</a>
                                                            </div>
                                                            <div class="kt-widget__info">
                                                                <span class="kt-widget__label">Location:</span>
                                                                <span class="kt-widget__data">Melbourne</span>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget__items">
                                                            <a href="demo1/custom/apps/user/profile-1/overview.html" class="kt-widget__item kt-widget__item--active">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <polygon id="Bound" points="0 0 24 0 24 24 0 24"></polygon>
                                                                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" id="Shape" fill="#000000" fill-rule="nonzero"></path>
                                                                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" id="Path" fill="#000000" opacity="0.3"></path>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Profile Overview
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <a href="demo1/custom/apps/user/profile-1/personal-information.html" class="kt-widget__item ">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Personal Information
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <a href="demo1/custom/apps/user/profile-1/account-information.html" class="kt-widget__item ">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                                <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                                                <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Account Information
                                                                    </span>
                                                                    
                                                            </span></a>
                                                            <a href="demo1/custom/apps/user/profile-1/change-password.html" class="kt-widget__item ">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                                <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" id="Path-50" fill="#000000" opacity="0.3"></path>
                                                                                <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" id="Mask" fill="#000000" opacity="0.3"></path>
                                                                                <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" id="Mask-Copy" fill="#000000" opacity="0.3"></path>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Change Passwort
                                                                    </span>
                                                                </span>
                                                                <span class="kt-badge kt-badge--unified-danger kt-badge--sm kt-badge--rounded kt-badge--bolder">5</span>
                                                            </a>
                                                            <a href="demo1/custom/apps/user/profile-1/email-settings.html" class="kt-widget__item ">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                                <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                                                <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" id="Combined-Shape" fill="#000000"></path>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Email settings
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <a href="#" class="kt-widget__item" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Coming soon...">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                                <rect id="Rectangle-7-Copy" fill="#000000" x="2" y="5" width="19" height="4" rx="1"></rect>
                                                                                <rect id="Rectangle-7-Copy-4" fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"></rect>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Saved Credit Cards
                                                                    </span>
                                                                </span>
                                                            </a>
                                                            <a href="#" class="kt-widget__item" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Coming soon...">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon>
                                                                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                                                                <rect id="Rectangle" fill="#000000" x="6" y="11" width="9" height="2" rx="1"></rect>
                                                                                <rect id="Rectangle-Copy" fill="#000000" x="6" y="15" width="5" height="2" rx="1"></rect>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span href="#" class="kt-widget__desc">Tax information</span>
                                                                </span>
                                                                <span class="kt-badge kt-badge--unified-brand kt-badge--inline kt-badge--bolder">new</span>
                                                            </a>
                                                            <a href="#" class="kt-widget__item" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Coming soon...">
                                                                <span class="kt-widget__section">
                                                                    <span class="kt-widget__icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                                <rect id="Rectangle-20" fill="#000000" x="4" y="5" width="16" height="3" rx="1.5"></rect>
                                                                                <path d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L12.5,10 C13.3284271,10 14,10.6715729 14,11.5 C14,12.3284271 13.3284271,13 12.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                                                                            </g>
                                                                        </svg> </span>
                                                                    <span class="kt-widget__desc">
                                                                        Statements
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--end::Widget -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
                                        <div class="kt-portlet ">
                                            <div class="kt-portlet__head">
                                                <div class="kt-portlet__head-label">
                                                    <h3 class="kt-portlet__head-title">
                                                        Order Statistics
                                                    </h3>
                                                </div>
                                                <div class="kt-portlet__head-toolbar">
                                                    <a href="#" class="btn btn-label-brand btn-bold btn-sm dropdown-toggle" data-toggle="dropdown">
                                                        Export
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">

                                                        <!--begin::Nav-->
                                                        <ul class="kt-nav">
                                                            <li class="kt-nav__head">
                                                                Export Options
                                                                <span data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more...">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--brand kt-svg-icon--md1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                                                                            <circle id="Oval-5" fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                                                            <rect id="Rectangle-9" fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                                                                            <rect id="Rectangle-9-Copy" fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                                                                        </g>
                                                                    </svg> </span>
                                                            </li>
                                                            <li class="kt-nav__separator"></li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-drop"></i>
                                                                    <span class="kt-nav__link-text">Activity</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                                                    <span class="kt-nav__link-text">FAQ</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-link"></i>
                                                                    <span class="kt-nav__link-text">Settings</span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__item">
                                                                <a href="#" class="kt-nav__link">
                                                                    <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                                                    <span class="kt-nav__link-text">Support</span>
                                                                    <span class="kt-nav__link-badge">
                                                                        <span class="kt-badge kt-badge--success kt-badge--rounded">5</span>
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="kt-nav__separator"></li>
                                                            <li class="kt-nav__foot">
                                                                <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                                                <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="" data-original-title="Click to learn more...">Learn more</a>
                                                            </li>
                                                        </ul>

                                                        <!--end::Nav-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body kt-portlet__body--fluid">
                                                <div class="kt-widget12">
                                                    <div class="kt-widget12__content">
                                                        <div class="kt-widget12__item">
                                                            <div class="kt-widget12__info">
                                                                <span class="kt-widget12__desc">Annual Taxes EMS</span>
                                                                <span class="kt-widget12__value">$400,000</span>
                                                            </div>
                                                            <div class="kt-widget12__info">
                                                                <span class="kt-widget12__desc">Finance Review Date</span>
                                                                <span class="kt-widget12__value">July 24,2019</span>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget12__item">
                                                            <div class="kt-widget12__info">
                                                                <span class="kt-widget12__desc">Avarage Revenue</span>
                                                                <span class="kt-widget12__value">$60M</span>
                                                            </div>
                                                            <div class="kt-widget12__info">
                                                                <span class="kt-widget12__desc">Revenue Margin</span>
                                                                <div class="kt-widget12__progress">
                                                                    <div class="progress kt-progress--sm">
                                                                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 40%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                    </div>
                                                                    <span class="kt-widget12__stat">
                                                                        40%
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget12__chart" style="height:250px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                                        <canvas id="kt_chart_order_statistics" style="display: block; width: 702px; height: 250px;" width="702" height="250" class="chartjs-render-monitor"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!--End:: App Aside-->

                                <!--Begin:: App Content-->
                                

                                <!--End:: App Content-->
                            </div>

                            <!--End::App-->
                        </div>

                        <!-- end:: Content -->
                    </div>
                
        </div>
    </div>
    </div>
    @if (Auth::check())
    <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">

    <input type="hidden" id="getLangid" value="{{getLangId()}}">
    @endif

    <script src="{{ asset('/js/mandatory.js') }}"></script>
    <script src="{{ asset('/js/plugins.js') }}"></script>
    <script src="{{ asset('/assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/custom-pages.js') }}"></script>
    <script src="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/vendors/custom/fileupload/js/plugins/piexif.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/vendors/custom/fileupload/js/plugins/sortable.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/vendors/custom/fileupload/js/fileinput.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/vendors/custom/fileupload/themes/fas/theme.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/vendors/custom/fileupload/themes/explorer-fas/theme.js') }}">
    </script>
    {{-- <script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('/js/company/custom.js') }}" type="text/javascript"></script>
    <!--end::Page Vendors -->

</body>
@yield('script')
<script type="text/javascript">
    $(document).ready(function(){


        @if (Auth::check())
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
        @endif
    });

    $('.card-title').addClass('kt-padding-t-10').addClass('kt-padding-b-5');

    if($('.ajax-file-upload-error').length){
        setTimeout($('.ajax-file-upload-error').hide(), 2000);
    }
</script>
<!-- end::Body -->

</html>
