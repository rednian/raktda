<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <div></div>

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: Notifications -->


        <!--begin: Language bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--langs">
            <div id="lang" class="kt-header__topbar-wrapper" data-offset="10px,0px">
                <span class="kt-header__topbar-icon {{ Auth::user()->LanguageId == 1 ? 'd-none' : '' }}  "
                    data-lang="en">
                    <span class="flag-icon flag-icon-gb"></span>
                </span>
                <span class="kt-header__topbar-icon {{ Auth::user()->LanguageId != 1 ? 'd-none' : '' }} "
                    data-lang="ar">
                    <span class="flag-icon flag-icon-ae"></span>
                </span>
            </div>
        </div>
        <!--end: Language bar -->

        <!--begin: User Bar -->
        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    @php
                    if (Auth::user()->type == 1) {
                        $company_name = getLangId() == 1 ? Auth::user()->company->name_en : Auth::user()->company->name_ar;
                    }
                    else{
                        $company_name = null;
                    }

                    $name = Auth::user()->NameEn;
                    $first_name = explode(' ', Auth::user()->NameEn);
                    $name_ar = Auth::user()->NameAr ;
                    $first_name = $first_name[0];
                    $first_letter = substr($first_name, 0, 1);
                    @endphp

                    <span class="kt-header__topbar-welcome kt-hidden-mobile">{{__('Hi')}}</span> <span
                        class="kt-header__topbar-username kt-hidden-mobile">{{ getLangId() == 1 ? ucwords($first_name) :  $name_ar }}</span>
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ ucwords($first_letter) }}
                    </span>
                </div>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                <!--begin: Head -->
                <div class="kt-user-card kt-user-card--skin-light kt-notification-item-padding-x">
                    <div class="kt-user-card__avatar">
                        <span
                            class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ ucwords($first_letter) }}</span>
                    </div>
                    <div style="display: flex; flex-direction: column;">
                        <div class="kt-user-card__name">{{ getLangId() == 1 ? ucwords($name) : $name_ar }}</div>

                        <div id="header--company">{{ $company_name }}</div>
                    </div>
                    {{-- <div class="kt-user-card__badge"> <span class="btn btn-label-primary btn-sm btn-bold btn-font-md">1
                            Notifications</span> </div> --}}
                </div>

                <!--end: Head -->
                <!--begin: Navigation -->
                <div class="kt-notification">
                    @if (Auth::user()->type == 1)
                     <a href="{{ URL::signedRoute('company.edit', ['company'=>Auth::user()->company->company_id]) }}"
                         class="kt-notification__item">
                         <div class="kt-notification__item-icon"> <i class="flaticon2-calendar-3 kt-font-success"></i>
                         </div>
                         <div class="kt-notification__item-details">
                             <div class="kt-notification__item-title kt-font-bold"> {{__('Account Settings')}} </div>
                             {{-- <div class="kt-notification__item-time"> Account settings and more </div> --}}
                         </div>
                     </a>   
                    @endif
                    
                    <div class="kt-notification__custom kt-space-between pull-right">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="btn btn-secondary btn-elevate btn-hover-warning">{{__('Sign Out')}}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf
                        </form>
                    </div>
                </div>
                <!--end: Navigation -->
            </div>
        </div>
        <!--end: User Bar -->
    </div>
    <!-- end:: Header Topbar -->
</div>