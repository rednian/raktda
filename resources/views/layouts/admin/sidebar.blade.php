<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
   <!-- begin:: Aside -->
   <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
       <div class="kt-aside__brand-logo center-block">
           <a href="{{ route('admin.dashboard') }}">
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
       <div id="kt_aside_menu"class="kt-aside-menu "data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" >

           <ul class="kt-menu__nav ">
               @if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists())
               <li class="kt-menu__item {{ Request::is('dashboard*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('Dashboard') }}</span>
                   </a>
               </li>
               {{-- <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text ">{{ __('Business Name') }}</span>
                   </a>
               </li> --}}
               {{-- <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('Business License') }}</span>
                   </a>
               </li> --}}
               <li class="kt-menu__item {{ Request::is('company_registration*') ? 'kt-menu__item--active': '' }} {{ Request::is('company_registration*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ URL::signedRoute('admin.company.index') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('Establishment') }}</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link kt-hide">
                       <span class="kt-menu__link-text">{{ __('Classification') }}</span>
                   </a>
               </li>
               @endif
               <li class="kt-menu__item {{ Request::is('artist_permit*') ? 'kt-menu__item--active': '' }} {{ Request::is('permit*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ URL::signedRoute('admin.artist_permit.index') }}" class="kt-menu__link">
                       <span class="kt-menu__link-text">{{ __('Artist Permit') }}</span>
                   </a>
               </li>
               <li class="kt-menu__item {{ Request::is('event*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ URL::signedRoute('admin.event.index') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('Event Permit') }}</span>
                   </a>
               </li>

               @if(Auth::user()->roles()->whereIn('roles.role_id', [1,3,4])->exists())
               <li class="kt-menu__item kt-hide {{ Request::is('inspection*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ URL::signedRoute('inspection.index') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('Inspection') }}</span>
                   </a>
               </li>
               @endif

               @if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists())
               <li class="kt-menu__item {{ Request::is('artist_reports*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ route('admin.artist_permit_reports.reports') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('Reports') }}</span>
                   </a>
               </li>
               <li class="kt-menu__item {{ Request::is('user_management*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ URL::signedRoute('user_management.index') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">{{ __('User Management') }}</span>

                   </a>
               </li>
               <li class="kt-menu__item {{ Request::is('settings*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ URL::signedRoute('admin.setting.index') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text kt-font-transform-u">{{ __('System Settings') }}</span>
                   </a>
               </li>
               @endif
           </ul>
       </div>
   </div>
   <!-- end:: Aside Menu -->
</div>
