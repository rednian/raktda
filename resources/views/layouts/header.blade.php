<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

    <div></div>

    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--danger">
                    <i class="flaticon2-bell-alarm-symbol"></i>
                    {{-- <span class="kt-pulse__ring"></span> --}}
                </span>
                <span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--danger"></span>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--fit-x kt-head--fit-b" style="padding-top:10px!important">
                        <h3 class="kt-head__title">
                            {{__('Notifications')}} &nbsp; <span
                                class="btn btn-label-primary btn-sm btn-bold btn-font-sm"><a
                                    href="{{ URL::signedRoute('company.notifications') }}">{{__('See All')}}</a></span>
                        </h3>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true"
                                data-height="300" data-mobile-height="200">
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                @foreach(Auth::user()->unreadNotifications as $notification)
                                <a href="javascript:void(0)" data-id="{{ $notification->id }}"
                                    data-url="{{ $notification->data['url'] }}"
                                    class="kt-notification__item notification-item">
                                    <div class="kt-notification__item-icon"> <i class="flaticon2-bell-2"></i> </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title"> {{ __($notification->data['title']) }}
                                        </div>
                                        <div class="kt-notification__item-time">
                                            {{ humanDate($notification->created_at) }}</div>
                                    </div>
                                </a>
                                @endforeach
                                @else
                                <p class="text-center kt-padding-15">
                                    {{__("Relax, you're doing well. Notification is empty.")}}
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                    <a href="{{ URL::signedRoute('company.account', ['company'=>Auth::user()->company->company_id]) }}"
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
                            class="btn btn-secondary btn-elevate btn-hover-warning">{{__('Sign out')}}</a>
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