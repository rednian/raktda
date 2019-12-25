@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
<style>
  .fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title { color: #fff; }
  .fc-unthemed .fc-event .fc-time, .fc-unthemed .fc-event-dot .fc-time { color: #fff; }
   .widget-toolbar{ cursor: pointer; }
</style>
@stop
@section('content')
   <section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
      <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
         <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ is_null($user->government_id) ? __('Employee Information') : __('User Information') }}</h3>
         </div>
         <div class="kt-portlet__head-toolbar">
          <a href="{{ URL::signedRoute('user_management.index') . ( is_null($user->government_id) ? '#employee_management' : '#government_management' ) }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
             <i class="la la-arrow-left"></i>
             {{ __('BACK TO LIST') }}
          </a>
       </div>
      </div>
      <div class="kt-portlet__body kt-padding-t-0">
         <ul id="main-tab" class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
            <li class="nav-item">
               <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">{{ __('Personal Details') }}</a>
            </li>
            @if(is_null($user->government_id))
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#work_schedule" role="tab">{{ __('Weekly Work Schedule') }}</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#leave" role="tab">{{ __('Time Off') }}</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-toggle="tab" href="#appointments" role="tab">{{ __('Appointments') }}</a>
            </li>
            @endif
         </ul>
         <div class="tab-content">
            <div class="tab-pane active" id="personal" role="tabpanel">
              
              <form method="POST" id="formAddUser" action="{{ route('user_management.update_user', $user->user_id) }}">
              @csrf
              @method('patch')

              <section class="row">
                 <div class="col-12">
                    <button id="btnSaveChangesUserInfo" type="button" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('SAVE CHANGES') }}</button>
                 </div>
              </section>
              
              <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="inspection-settings">
              <div class="card">
                <div class="card-header" id="inspection-settings-heading">
                  <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#inspection-settings-details" aria-expanded="true" aria-controls="inspection-settings-details">
                    <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Personal Information') }}</h6>
                  </div>
                 </div>
                 <div id="inspection-settings-details" class="collapse show" aria-labelledby="inspection-settings-heading" data-parent="#inspection-settings">
                  <div class="card-body">
                    
                    <section class="row kt-margin-t-10">
                              <div class="col-sm-6">
                                  <div class="form-group form-group-sm">
                                      <label for="example-search-input" class="kt-font-dark">{{ __('Name') }}
                                          <span class="text-danger">*</span>
                                      </label>
                                      <input value="{{ $user->NameEn }}" type="text" name="NameEn" required class="form-control form-control-sm">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group form-group-sm">
                                      <label for="example-search-input" class="kt-font-dark">{{ __('Name (AR)') }}
                                        <span class="text-danger">*</span>
                                      </label>
                                      <input dir="rtl" value="{{ $user->NameAr }}" type="text" name="NameAr" required class="form-control form-control-sm">
                                  </div>
                              </div>
                          </section>

                          <section class="row kt-margin-t-10">
                              @if(!is_null($user->government_id))
                              <div class="col-sm-6">
                                  <div class="form-group form-group-sm">
                                      <label for="example-search-input" class="kt-font-dark">{{ __('Department') }}
                                          <span class="text-danger">*</span>
                                      </label>
                                      <select required name="government_id" class="form-control form-control-sm">
                                        <option value=""></option>
                                        @foreach(App\Government::orderBy('government_name_en')->get() as $dep)
                                        <option {{ $dep->government_id == $user->government_id ? 'selected' : ''}} value="{{ $dep->government_id }}">{{ Auth::user()->LanguageId == 1 ? $dep->government_name_en : $dep->government_name_ar }}</option>
                                        @endforeach
                                      </select>
                                  </div>
                              </div>
                              @endif
                              <div class="col-sm-6">
                                  <div class="form-group form-group-sm">
                                      <label for="example-search-input" class="kt-font-dark">{{ __('Designation') }}
                                        <span class="text-danger">*</span>
                                      </label>
                                      <input value="{{ $user->designation }}" type="text" name="designation" class="form-control form-control-sm">
                                  </div>
                              </div>
                          </section>

                          <section class="row kt-margin-t-10">
                              <div class="col-sm-6">
                                  <div class="form-group form-group-sm">
                                      <label for="example-search-input" class="kt-font-dark">{{ __('Email Address') }}
                                          <span class="text-danger">*</span>
                                      </label>
                                      <input value="{{ $user->email }}" type="text" name="email" class="form-control form-control-sm">
                                  </div>
                              </div>
                              <div class="col-sm-6">
                                  <div class="form-group form-group-sm">
                                      <label for="example-search-input" class="kt-font-dark">{{ __('Mobile Number') }}
                                        <span class="text-danger">*</span>
                                      </label>
                                      <input value="{{ $user->mobile_number }}" type="text" name="mobile_number" class="form-control form-control-sm">
                                  </div>
                              </div>
                          </section>

                  </div>
                 </div>
              </div>
             </section>

             <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="event-settings">
              <div class="card">
                <div class="card-header" id="event-settings-heading">
                  <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#event-settings-details" aria-expanded="true" aria-controls="event-settings-details">
                    <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Account Settings') }}</h6>
                  </div>
                 </div>
                 <div id="event-settings-details" class="collapse show" aria-labelledby="event-settings-heading" data-parent="#event-settings">
                  <div class="card-body">
                    <section class="row kt-margin-t-10">
                        <div class="col-sm-6">
                          <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
                            <label>
                              <input type="checkbox" value="1" {{ $user->IsActive == 1 ? 'checked' : '' }} name="IsActive"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;">{{ __('Account Is Active') }}</b>
                              <span></span>
                            </label>
                          </span>
                        </div>
                    </section>
                    <section class="row kt-margin-t-10">
                        @if(is_null($user->government_id))
                        <div class="col-sm-6">
                          <div class="form-group form-group-sm">
                              <label for="example-search-input" class="kt-font-dark">{{ __('User Role') }}
                                  <span class="text-danger">*</span>
                              </label>
                              <select name="role_id" class="form-control form-control-sm">
                                <option value=""></option>
                                @foreach(App\Roles::where('type', 0)->get() as $role)
                                <option {{ $user->roles()->first()->role_id == $role->role_id ? 'selected' : '' }} value="{{ $role->role_id }}">{{ Auth::user()->LanguageId == 1 ? ucwords($role->NameEn) : $role->NameAr }}</option>
                                @endforeach
                              </select>
                          </div>
                        </div>
                        @else
                        <input type="hidden" value="6" name="role_id">
                        @endif

                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="example-search-input" class="kt-font-dark">{{ __('Username') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input value="{{ $user->username }}" type="text" name="username" required class="form-control form-control-sm">
                            </div>
                        </div> 
                    </section>
                    <section class="row kt-margin-t-20">
                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label class="kt-checkbox kt-checkbox--default kt-font-dark">
                                  <input name="change_password" value="1" type="checkbox"> {{ __('Change Password') }}
                                  <span></span>
                                </label>
                            </div>
                        </div>
                    </section>
                    <section class="row">
                      <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="example-search-input" class="kt-font-dark">{{ __('New Password') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input disabled value="" id="password" type="password" name="password" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group form-group-sm">
                                <label for="example-search-input" class="kt-font-dark">{{ __('Confirm Password') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <input disabled value="" id="confirm_password" type="password" name="confirm_password" class="form-control form-control-sm">
                            </div>
                        </div>
                    </section>


                  </div>
                 </div>
              </div>
             </section>
             <input type="hidden" name="admin_password">
             </form>

            </div>
            <div class="tab-pane" id="work_schedule" role="tabpanel">

              @if(!is_null($user->workschedule))
              <section class="row kt-margin-t-10">
                  <div class="col-6">
                    <div class="form-group form-group-sm kt-margin-b-0">
                        <select name="schedule" id="schedule" class="form-control form-control-sm">
                          <optgroup label="System Schedules">
                            @foreach(App\ScheduleType::all() as $type)
                            <option data-type="system" {{ is_null($user->workschedule->is_custom) && $user->workschedule->schedule_type_id == $type->schedule_type_id ? 'selected' : '' }} value="{{ $type->schedule_type_id }}">{{ Auth::user()->LanguageId == 1 ? $type->schedule_type_name : $type->schedule_type_name_ar }} {{ is_null($user->workschedule->is_custom) && $user->workschedule->schedule_type_id == $type->schedule_type_id ? '(Active)' : '' }}</option>
                            @endforeach
                          </optgroup>
                          @if($user->customSchedules()->count() > 0)
                          <optgroup label="Custom Schedules">
                            @foreach($user->customSchedules as $custom)
                            <option data-type="custom" {{ !is_null($user->workschedule->is_custom) && $user->workschedule->emp_custom_id == $custom->emp_custom_id ? 'selected' : '' }} value="{{ $custom->emp_custom_id }}">{{ Auth::user()->LanguageId == 1 ? $custom->emp_custom_name : $custom->emp_custom_name_ar }} {{ !is_null($user->workschedule->is_custom) && $user->workschedule->emp_custom_id == $custom->emp_custom_id ? '(Active)' : '' }}</option>
                            @endforeach
                          </optgroup>
                          @endif
                        </select>
                    </div>
                    <small class="kt-font-bolder">( Select schedule type above to see schedules )</small>
                  </div>
                 <div class="col-6">
                    {{-- <a href="{{ route('requirements.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('New Requirement') }}</a> --}}
                    <a href="{{ URL::signedRoute('user_management.schedule.create', ['user' => $user->user_id]) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('ADD CUSTOM SCHEDULE') }}</a>
                 </div>
              </section>
              @else

              <div class="alert alert-outline-danger fade show" role="alert">
                 <div class="alert-icon"><i class="flaticon-warning"></i></div>
                 <div class="alert-text">
                    {{ __('Employee has no set schedule. Please select schedule.') }}
                 </div>
                 <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                 </div>
              </div>
              
              <section class="row kt-margin-t-10">
                  <div class="col-6">
                    <div class="form-group form-group-sm kt-margin-b-0">
                        <select name="schedule" id="schedule" class="form-control form-control-sm">
                          <optgroup label="System Schedules">
                            @foreach(App\ScheduleType::all() as $type)
                            <option {{ App\ScheduleType::where('is_active')->first()->schedule_type_id == $type->schedule_type_id ? 'selected' : '' }} data-type="system" value="{{ $type->schedule_type_id }}">{{ Auth::user()->LanguageId == 1 ? $type->schedule_type_name : $type->schedule_type_name_ar }}</option>
                            @endforeach
                          </optgroup>
                          @if($user->customSchedules()->count() > 0)
                          <optgroup label="Custom Schedules">
                            @foreach($user->customSchedules as $custom)
                            <option data-type="custom" value="{{ $custom->emp_custom_id }}">{{ Auth::user()->LanguageId == 1 ? $custom->emp_custom_name : $custom->emp_custom_name_ar }}</option>
                            @endforeach
                          </optgroup>
                          @endif
                        </select>
                    </div>
                    <small class="kt-font-bolder">( Select schedule type above to see schedules )</small>
                  </div>
                 <div class="col-6">
                    {{-- <a href="{{ route('requirements.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('New Requirement') }}</a> --}}
                    <a href="{{ URL::signedRoute('user_management.schedule.create', ['user' => $user->user_id]) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('ADD CUSTOM SCHEDULE') }}</a>
                 </div>
              </section>
              
              @endif

              <section class="row kt-margin-t-10">
                  <div class="col-12" id="showScheduleContainer">
                      
                  </div>
              </section>
              
            </div>
            <div class="tab-pane" id="leave" role="tabpanel">
              <section class="row">
                 <div class="col-12">
                    {{-- <a href="{{ route('requirements.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('New Requirement') }}</a> --}}
                    <a href="{{ URL::signedRoute('user_management.leave.add', ['user' => $user->user_id]) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('NEW TIME OFF') }}</a>
                 </div>
              </section>
              <section class="row">
                  <div class="col-12">
                    <div id="leave_calendar"></div>
                  </div>
              </section>
              
            </div>
            <div class="tab-pane" id="appointments" role="tabpanel">
               <section class="row">
                 <div class="col-12">
                    <a href="{{ route('event_type.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('NEW EVENT TYPE') }}</a>
                 </div>
              </section>
              
            </div>
         </div>
      </div>
   </section>
@stop
@section('script')
  {{-- <script src="{{ asset('assets/vendors/general/fullcalendar/fullcalendar.min.js') }}"></script> --}}
  <script>
  
    var changePassword = 0;
    var changeStatus = 0;

    $(document).ready(function () {

          var calendarEl = document.getElementById('leave_calendar');

          var calendar = new FullCalendar.Calendar(calendarEl, {
              plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
              isRTL: KTUtil.isRTL(),
              header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'listWeek,timeGridWeek,dayGridMonth',
              },
              @if(Auth::user()->LanguageId != 1)
              locale: 'ar',
              @endif
              height: 'auto',
              allDaySlot: true,
              contentHeight: 450,
              aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
              nowIndicator: true,
              views: {
                  dayGridMonth: { buttonText: '{{ __('Month') }}' },
                  timeGridWeek: { buttonText: '{{ __('Week') }}' },
                  timeGridDay: { buttonText: '{{ __('Day') }}' },
                  listWeek: { buttonText: '{{ __('Week List') }}' }
              },
              defaultView: 'listWeek',
              editable: false,
              eventLimit: true, // allow "more" link when too many events
              navLinks: true,
              events: {
                  url: '{{ URL::signedRoute('user_management.leave.get', ['user' => $user->user_id]) }}',
                  textColor : '#ffffff',
              },
              eventRender: function(info) {
                  var element = $(info.el);
                  if (info.event.extendedProps && info.event.extendedProps.description) {
                      if (element.hasClass('fc-day-grid-event')) {
                          element.data('content', info.event.extendedProps.description);
                          element.data('placement', 'top');
                          KTApp.initPopover(element);
                      } else if (element.hasClass('fc-time-grid-event')) {
                          element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                      } else if (element.find('.fc-list-item-title').lenght !== 0) {
                          element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                      }
                  }
              }
          });
          calendar.render();

        @if(!is_null($user->workschedule))
        @php
        $type = $user->workschedule->is_custom ? 'custom' : 'system';
        $id = is_null($user->workschedule->is_custom) ? $user->workschedule->schedule_type_id : $user->workschedule->emp_custom_id;
        @endphp
        getSchedules('{{ $type }}', {{ $id }});
        @else
        //SELECT THE DEFAULT SCHEDULE FROM SETTINGS
        getSchedules('system', {{ App\ScheduleType::where('is_active')->first()->schedule_type_id }});
        @endif

        

        var hash = window.location.hash;

        if(hash){
          $('ul.nav.nav-tabs#main-tab a[href="' + hash + '"]').tab('show');
        }

        $('#main-tab.nav.nav-tabs a').click(function (e) {
          var scrollmem = $('body').scrollTop();
          window.location.hash = this.hash;
          $('html,body').scrollTop(scrollmem);
        });
         
        //ON SHOWING THE TAB
      $('#main-tab.nav.nav-tabs a').on('shown.bs.tab', function (event) {

          // var current_tab = $(event.target).attr('href');
          // if(current_tab == '#personal'){
          //   //loadpersonals();
          // }
          // if(current_tab == '#work_schedule'){
          //   ///loadRequirements()
          // }
          // if(current_tab == '#leave'){
          //   //loadEventRequirements()
          // }
          // if(current_tab == '#appointments'){
          //   //loadEventType();
          // }
      });

      //ON CLOSING THE TAB
      $('#main-tab.nav.nav-tabs a[data-toggle="tab"]').on('hidden.bs.tab', function (e) {
      
      var prevTab = $(e.target).attr('href');
          if(prevTab == '#personal'){
            //tblpersonal.destroy();
          }

          if(prevTab == '#work_schedule'){
            //tblRequirement.destroy();
          }

          if(prevTab == '#leave'){
            //tblEventRequirement.destroy();
          }

          if(prevTab == '#appointments'){
            //tblEventTypes.destroy();
          }
    });

    $(document).on('change','input[type=checkbox]', function(){
        if($(this).is(':checked')){
          $(this).parents('.input-group').find('input[type=text]').addClass('is-valid').removeClass('is-invalid');
          $(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
        }
        else{
          $(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
          $(this).parents('label').removeClass('kt-checkbox--success').addClass('kt-checkbox--default');
        }
      });

    //FORM SETTINGS
    $('form#formAddUser').validate();
    $(document).on('click', '#btnSaveChangesUserInfo', function(){
      
      if(changePassword == 1 || changeStatus == 1){
          bootbox.prompt({ 
            title: "Current User Identity Verification<br><small>Enter your password.</small>",
            inputType: "password",
            callback: function(result){ 
                if(result){
                  $('form#formAddUser input[name=admin_password]').val(result);
                  $('form#formAddUser').trigger('submit');
                }
            }
        });
      }else{
          bootbox.confirm('Are you sure you want to save all changes?', function(result){
            if(result){
              $('form#formAddUser input[name=admin_password]').val();
              $('form#formAddUser').trigger('submit');
            }
          });
      }
      
    });

    $(document).on('change','input[name=IsActive][type=checkbox]', function(){
      var stat = $(this).is(':checked') ? 1 : 0;

      if({{ $user->IsActive }} != stat){
        changeStatus = 1;
      }else{
        changeStatus  = 0;
      }
    });

    $(document).on('change','input[name=change_password][type=checkbox]', function(){
        if($(this).is(':checked')){

          changePassword = 1;

          $('input[name=password]').removeAttr('disabled');
          $('form#formAddUser input[name=password]').rules( "add", {
              required: true
          });
          $('form#formAddUser input[name=password]').rules( "add", {
              equalTo: '#confirm_password'
          });

          $('input[name=confirm_password]').removeAttr('disabled');
          $('form#formAddUser input[name=confirm_password]').rules( "add", {
              required: true
          });
          $('form#formAddUser input[name=confirm_password]').rules( "add", {
              equalTo: '#password'
          });
        }
        else{

          changePassword = 0;

          $('input[name=password]').val('');
          $('input[name=confirm_password]').val('');

          $('input[name=password]').attr('disabled', true);
          $('input[name=confirm_password]').attr('disabled', true);

          $('form#formAddUser input[name=password]').rules( "remove", "required");
          $('form#formAddUser input[name=password]').rules( "remove", "equalTo");
          $('form#formAddUser input[name=confirm_password]').rules( "remove", "required");
          $('form#formAddUser input[name=confirm_password]').rules( "remove", "equalTo");
        }
      });

    //SHOW SCHEDULES
    $(document).on('change', 'select#schedule', function(){
        var type = $('option:selected', this).data('type');
        getSchedules(type, $(this).val());
    });

    //SET SCHEDULE TO ACTIVE
    $(document).on('change', 'input[type=checkbox].set_active', function(){
      var url = $(this).data('url');
      $('#formSetActiveScheduleType').attr('action', url);

      if($(this).is(':checked')){
        bootbox.confirm('{{ __('Are you sure you want to proceed?') }}', function(result){
          if(result){
            $('#formSetActiveScheduleType').trigger('submit');
          }
        });
      }
    });

    //SCHEDULE TYPE SCRIPTS
    $(document).on('click', '.btn-delete-schedule', function(){
      var url = $(this).data('url');
      $('#formDeleteScheduleType').attr('action', url);

      bootbox.confirm('{{ __('Are you sure you want to delete schedule type?') }}', function(result){
        if(result){
          $('#formDeleteScheduleType').trigger('submit');
        }
      });
    });

  });

 function getSchedules(type, id){
    $.ajax({
        url: '{{ route('user_management.get_schedule') }}',
        data: { user_id : {{ $user->user_id }}, type: type, id: id },
        type: 'GET',
        dataType: 'html',
        beforeSend: function(){
        },
        success: function(data){
          $('#showScheduleContainer').html(data);
        },
        error: function(){
        }
    });
 }
   
</script>
@stop