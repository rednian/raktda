<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
<div class="kt-aside kt-aside--fixed kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
   <!-- begin:: Aside -->
   <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
       <div class="kt-aside__brand-logo center-block">
           <a href="{{ route('admin.dashboard') }}">
            @if (Auth::user()->LanguageId == 1)
               <img class="img img-responsive" alt="Logo" src="{{ asset('/img/logo-en.svg') }}" />
               @else
               <img class="img img-responsive" alt="Logo" src="{{ asset('/img/logo-en.svg') }}" />
            @endif
              
           </a>
       </div>
   </div>

   <!-- end:: Aside -->
   <!-- begin:: Aside Menu -->
   <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
       <div id="kt_aside_menu"class="kt-aside-menu "data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500" >
           <ul class="kt-menu__nav ">
               <li class="kt-menu__item {{ Request::is('dashboard*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ route('admin.dashboard') }}" class="kt-menu__link ">
                       <span class="kt-menu__link-text">DASHBOARD</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">BUSINESS NAME</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">BUSINESS LICENSE</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">CLASSIFICATION</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">INSPECTION</span>
                   </a>
               </li>

               <li class="kt-menu__item {{ Request::is('artist_permit*') ? 'kt-menu__item--active': '' }}">
                   <a href="{{ route('admin.artist_permit.index') }}" class="kt-menu__link">
                       <span class="kt-menu__link-text">ARTIST PERMIT</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">EVENT PERMIT</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">REPORTS</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="javascript:void(0)" class="kt-menu__link ">
                       <span class="kt-menu__link-text">USER MANAGEMENT</span>
                   </a>
               </li>
               <li class="kt-menu__item">
                   <a href="?page=index" class="kt-menu__link ">
                       <span class="kt-menu__link-text">SETTINGS</span>
                   </a>
               </li>
           </ul>
       </div>
   </div>
   <!-- end:: Aside Menu -->
</div>