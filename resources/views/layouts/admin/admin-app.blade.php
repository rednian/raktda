<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ Auth::user()->LanguageId != 1 ?  'rtl': null }}">
<head>
  <meta charset="utf-8" />
  <title>RAK TDA | {{ ucfirst($page_title)  }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
  <script>
    WebFont.load({
            google: { "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"] },
            active: function() { sessionStorage.fonts = true; }
        });
  </script>
  @if (Auth::user()->LanguageId == 1)
    <link href="{{ asset('/css/custom-vendor.css') }}" rel="stylesheet" type="text/css" />
  @else
    <link href="{{ asset('/assets/vendors/custom/datatables/datatables.bundle.rtl.min.css') }}" rel="stylesheet" type="text/css" />
  @endif
   <link href="{{ asset('/css/vendor.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendors/custom/flag-icon-css-master/css/flag-icon.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/general/socicon/css/socicon.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.theme.default.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/vendors/flaticon/flaticon.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/custom/vendors/flaticon2/flaticon.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/assets/vendors/general/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />


  @if (Auth::user()->LanguageId == 1)
  <style type="text/css">
    #kt_aside{ box-shadow: 4px 0 5px -2px #888; }
  </style>
    <link href="{{ asset('/css/mandatory.css') }}" rel="stylesheet" type="text/css" />
  @else
  <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/droid-arabic-kufi" type="text/css"/>
  <style>
        *{
        font-family: 'DroidArabicKufiRegular', -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-weight: normal;
        font-style: normal;
    }

    h1, h2, h3, h4, h5, h6, .kt-font-bold, strong, th, .widget24__title{
        font-family: 'DroidArabicKufiBold', -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
        font-weight: bold !important;
        /* font-size: 1rem !important; */
    }
    td{
        font-weight: normal;
        font-size: 1rem;
    }
  </style>
    <link href="{{ asset('/css/mandatory-arabic.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
      #kt_aside{ box-shadow: 4px 0 5px 4px #888 !important; }
      .dataTable th, .dataTable td{
        width: 100% !important;
    }
    </style>
  @endif
  <link href="{{ asset('/css/custom.css') }}" rel="stylesheet" type="text/css" />
  @if(Auth::user()->LanguageId != 1)
  <style>
      .kt-wizard-v3
    .kt-wizard-v3__wrapper
    .kt-form
    .kt-form__actions
    [data-ktwizard-type="action-next"] {
    margin: auto 0 auto !important;
}

.kt-wizard-v3
    .kt-wizard-v3__wrapper
    .kt-form
    .kt-form__actions
    [data-ktwizard-type="action-prev"] {
    margin-right: 0 !important;
}
  </style>
  @endif
  @yield('style')
  <link rel='apple-touch-icon' type='image/png' href="{{ asset('/img/apple-touch-icon.png') }}">
  <link rel='icon' type='image/png' href="{{ asset('/img/favicon-64x64.png') }}">
  <link rel='icon' type='image/png' href="{{ asset('/img/favicon-32x32.png') }}">
</head>
<body class="kt-page--loading-enabled kt-page--loading  kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed" >
<!-- begin:: Page -->
<!-- begin::Page loader -->
<div class="kt-page-loader kt-page-loader--base">
  <div class="blockui">
    <span>{{ __('Please wait...') }}</span>
    <span><div class="kt-spinner kt-spinner--danger"></div></span>
  </div>
</div>
<!-- end::Page Loader -->
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile kt-header-mobile--fixed " >
  <div class="kt-header-mobile__logo">
    <a href="{{ route('admin.dashboard') }}">
      @if (Auth::user()->LanguageId == 1)
        <img alt="Logo" src="{{ asset('/img/logo-en.svg') }}"/>
      @else
        <img alt="Logo" src="{{ asset('/img/logo-ar.svg') }}"/>
      @endif
    </a>
  </div>
  <div class="kt-header-mobile__toolbar">
    <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
    <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
  </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
  <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
    @include('layouts.admin.sidebar')
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
      @include('layouts.admin.topbar')
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
    </div>
  </div>
</div>
<!-- end:: Page -->
<script src="{{ asset('/js/mandatory.js') }}"></script>
<script src="{{ asset('/js/plugins.js') }}"></script>
<script src="{{ asset('/assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/custom-pages.js') }}"></script>
<script src="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.js') }}"></script>
<script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script>
{{-- <script src="{{ asset('/assets/vendors/custom/datatables/dataTables.colVis.js') }}"></script> --}}
<script type="text/javascript">
function blockPage(){
    KTApp.blockPage({
        overlayColor: '#000000',
        type: 'v2',
        state: 'success',
        message: 'Please wait...'
    });
}

function unblockPage(){
    KTApp.unblockPage();
}
  $(document).ready(function(){

          //only arabic, numbers and space allowed in arabic with dir=rtl
          $('input[dir=rtl], textarea[dir=rtl]').keypress(function(e){
            var arabicAlphabet = /[\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufc3f]|[\ufe70-\ufefc]|[0-9\s]/g;
             var key = String.fromCharCode(e.which);
             return arabicAlphabet.test(key) ? true : false;
        });


        //english, numbers and special character allowed
        $('input[dir=ltr], textarea[dir=ltr]').keypress(function(e){
            var alphanumeric = /[\w\d\-\.\?\!\&\%\#\*\()]|[\s]/g;
             var key = String.fromCharCode(e.which);
             return alphanumeric.test(key) ? true : false;
        });

        //REFRESH NOTIFICATIONS EVERY MINUTE
    var notif = setInterval(refreshNotification, 60000);
    //REAL TIME NOTIFICATIONS APPEND TO NOTIFICATION PANE
    window.Echo.private(`App.User.{{ Auth::user()->user_id }}`)
            .notification((notification) => {
                console.log(notification);
                addNotification(notification);
            });

    // window.Echo.private(`App.User.{{ Auth::user()->user_id }}`).notification(function(notification){
    //     console.log(notification);
    //     addNotification(notification);
    // });
    //FUNCTION TO PUT THE NOTIFICATION TO PANE
    function addNotification(data){
        var html = '<a href="' + data.url + '" class="kt-notification__item">\
                        <div class="kt-notification__item-icon"> <i\
                                class="flaticon2-bell-2"></i> </div>\
                        <div class="kt-notification__item-details">\
                            <div class="kt-notification__item-title"> ' + data.title + '\
                            </div>\
                            <div class="kt-notification__item-time">2 seconds ago</div>\
                        </div>\
                    </a>';
        $('#topbar_notifications_notifications .kt-notification').prepend(html);
    }
    //FUNCTION TO UPDATE THE NOTIFICATION
    function refreshNotification(){
      $.ajax({
        url: '{{ route('getnotifications') }}',
        dataType: 'html',
        type: 'GET',
        success: function(notification){
          $('#topbar_notifications_notifications .kt-notification').html(notification);
        }
      });
    }
    //MARK AS READ NOTIFICATION ON CLICK
    $(document).on('click', '.kt-notification__item.notification-item', function(){
        toRead($(this).data('id'), $(this).data('url'));
    });


    // $('form').validate({
    //   submitHandler: function(){
    //     KTApp.block('body', {
    //         overlayColor: '#000000',
    //         type: 'v2',
    //         state: 'success',
    //         message: 'Please wait...'
    //     });
    //   }
    // });


    //   // setTimeout(function() {
    //   //     KTApp.unblock('#kt_blockui_1_content');
    //   // }, 2000);

    // });


    @if (Session::has('message'))
      @if(Session::get('message')[0] == 'success')
      $.notify({
          title: '{{Session::get('message')[2]}}',
          message: '{{Session::get('message')[1]}}',
      },{
          type:'success',
          animate: {
              enter: 'animated zoomIn',
              exit: 'animated zoomOut'
          },
      });
      @else
      $.notify({
          title: '{{Session::get('message')[2]}}',
          message: '{{Session::get('message')[1]}}',
      },{
          type:'danger',
          animate: {
              enter: 'animated zoomIn',
              exit: 'animated zoomOut'
          },
      });
      @endif
    @endif

    $('span[data-lang=en]').click(function () { getLang(1); });
    $('span[data-lang=ar]').click(function () { getLang(2); });




    @if(Auth::user()->LanguageId != 1)
    // JQUERY VALIDATOR LOCALIZATION AR
    $.extend( $.validator.messages, {
      required: "هذا الحقل إلزامي",
      remote: "يرجى تصحيح هذا الحقل للمتابعة",
      email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
      url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
      date: "رجاء إدخال تاريخ صحيح",
      dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
      number: "رجاء إدخال عدد بطريقة صحيحة",
      digits: "رجاء إدخال أرقام فقط",
      creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
      equalTo: "رجاء إدخال نفس القيمة",
      extension: "رجاء إدخال ملف بامتداد موافق عليه",
      maxlength: $.validator.format( "الحد الأقصى لعدد الحروف هو {0}" ),
      minlength: $.validator.format( "الحد الأدنى لعدد الحروف هو {0}" ),
      rangelength: $.validator.format( "عدد الحروف يجب أن يكون بين {0} و {1}" ),
      range: $.validator.format( "رجاء إدخال عدد قيمته بين {0} و {1}" ),
      max: $.validator.format( "رجاء إدخال عدد أقل من أو يساوي {0}" ),
      min: $.validator.format( "رجاء إدخال عدد أكبر من أو يساوي {0}" )
    });
          //DATATABLE
    $.extend( true, $.fn.dataTable.defaults, {
          language:{
            searchPlaceholder: '{{ __('Search') }}',
            info: 'رض _START_ إلى _END_ للـــ _TOTAL_',
            infoEmpty: 'رض _START_ إلى _END_ للـــ _TOTAL_',
            infoFiltered: '',
            emptyTable: 'لا يوجد بيانات في الجدول',
            zeroRecords: 'لا يوجد بيانات في الجدول',
          }
      });

    //BOOTBOX
    bootbox.setDefaults({
      locale: "ar",
    });

    @endif


  });


  function getLang(lang){
    $.ajax({
      url: '{{ route('admin.language') }}',
      data: {lang: lang},
      type: 'post',
    }).done(function(response){
      if(response.success) location.reload();
    });
  }

  function toRead(id, url){
    $.ajax({
      url: '{{ route('admin.notifications.update_read') }}',
      data: { id: id },
      type: 'GET',
      dataType: 'JSON',

      success: function(data){
        location.href = url;
      },
      error: function(){
        alert('error');
      }
    });
  }
</script>
@yield('script')
</body>
</html>
