<div id="kt_header" class="kt-header kt-grid__item kt-header--fixed ">
    <div></div>
    <!-- begin:: Header Topbar -->
    <div class="kt-header__topbar">
        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="true">
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--danger">
                    <i class="flaticon2-bell-alarm-symbol"></i>
                    <span class="kt-pulse__ring"></span>
                </span>
                <span class="kt-badge kt-badge--dot kt-badge--notify kt-badge--sm kt-badge--danger"></span>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-light kt-head--fit-x kt-head--fit-b">
                        <h3 class="kt-head__title">
                            User Notifications &nbsp; <span class="btn btn-label-primary btn-sm btn-bold btn-font-sm">1
                                new</span>
                        </h3>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                            <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-scroll="true"
                                data-height="300" data-mobile-height="200">
                                <a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon"> <i
                                            class="flaticon2-pie-chart kt-font-success"></i> </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title"> AlHamra Forth Hotel and Beach Resort
                                        </div>
                                        <div class="kt-notification__item-time"> 3 days ago </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end: Notifications -->
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
        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    @php

                    $name = ucwords(Auth::user()->NameEn);
                    $first_name = explode(' ', $name);
                    $first_name = $first_name[0];
                    $first_letter = substr($first_name, 0, 1);
                    @endphp

                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span> <span
                        class="kt-header__topbar-username kt-hidden-mobile">{{ ucwords($first_name) }}</span>
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ ucwords($first_letter) }}</span>
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
                    <div class="kt-user-card__name">{{ $name }}</div>
                    <div class="kt-user-card__badge"> <span class="btn btn-label-success btn-sm btn-bold btn-font-md">1
                            Notifications</span> </div>
                </div>
                <!--end: Head -->
                <!--begin: Navigation -->
                <div class="kt-notification">
                    <a href="javascript:void(0)" class="kt-notification__item">
                        <div class="kt-notification__item-icon"> <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details">
                            <div class="kt-notification__item-title kt-font-bold"> My Profile </div>
                            <div class="kt-notification__item-time"> Account settings and more </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="btn btn-brand btn-elevate btn-sm">Sign Out</a>
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
