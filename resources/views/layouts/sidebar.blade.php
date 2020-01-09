<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo center-block">
            <a href="{{ route('company.dashboard') }}">
                @if (Auth::user()->LanguageId == 1)
                <img class="img img-responsive" alt="Logo" src="{{ asset('/img/logo-en.svg') }}" />
                @else
                <img class="img img-responsive" alt="Logo" src="{{ asset('/img/logo-ar.svg') }}" />
                @endif
            </a>
        </div>
    </div>

    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item kt-menu__item">
                    <a href="#" class="kt-menu__link">
                        <span class="kt-menu__link-text">{{ __('Dashboard')}}</span>
                    </a>
                </li>
                {{-- <li class="kt-menu__item">
                    <a href="javascript:void(0)" class="kt-menu__link ">
                        <span class="kt-menu__link-text">{{ __('Business License')}}</span>
                </a>
                </li> --}}
                {{-- <li class="kt-menu__item">
                    <a href="javascript:void(0)" class="kt-menu__link ">
                        <span class="kt-menu__link-text">{{__('Business Name')}}</span>
                </a>
                </li> --}}
                {{-- <li class="kt-menu__item">
                    <a href="javascript:void(0)" class="kt-menu__link ">
                        <span class="kt-menu__link-text">{{__('Classification')}}</span>
                </a>
                </li>
                <li class="kt-menu__item">
                    <a href="javascript:void(0)" class="kt-menu__link ">
                        <span class="kt-menu__link-text">{{__('Inspection')}}</span>
                    </a>
                </li> --}}

                <li
                    class="kt-menu__item {{ (\Request::is('company/artist/*') || \Request::is('company/artist'))  ? 'kt-menu__item--active' : ''}}">

                    <a href="{{URL::signedRoute('artist.index')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text">{{__('Artist Permit')}}</span>
                    </a>
                </li>
                <li
                    class="kt-menu__item {{ (\Request::is('company/event/*') || \Request::is('company/event')) ? 'kt-menu__item--active' : ''}}">
                    <a href="{{URL::signedRoute('event.index')}}" class="kt-menu__link ">

                        <span class="kt-menu__link-text">{{__('Event Permit')}}</span>
                    </a>
                </li>
                <li class="kt-menu__item {{ \Request::is('company/reports') ? 'kt-menu__item--active' : ''}}">
                    <a href="{{route('company.reports')}}" class="kt-menu__link ">
                        <span class="kt-menu__link-text">{{__('Reports')}}</span>
                    </a>
                </li>
                {{-- <li class="kt-menu__item {{\Request::is('company/settings/*') ? 'kt-menu__item--active' : '' }}">
                <a href="javascript:void(0)" class="kt-menu__link ">
                    <span class="kt-menu__link-text">{{__('Profile')}}</span>
                </a>
                </li> --}}

            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>