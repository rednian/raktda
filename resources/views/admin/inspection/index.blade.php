@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
<style>
  .fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title { color: #fff; }
  .fc-unthemed .fc-event .fc-time, .fc-unthemed .fc-event-dot .fc-time { color: #fff; }
   .widget-toolbar{ cursor: pointer; }
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/timeline/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/resource-timeline/main.css') }}">
@stop
@section('content')

    <section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
         <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
             <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Inspection Appointments') }}</h3>
             </div>
             <div class="kt-portlet__head-toolbar">
                <div class="btn-group btn-group-sm" role="group" aria-label="First group">
                  <a href="{{ URL::signedRoute('inspection.index', ['v' => 'l']) }}" class="btn {{ $view == 'l' || is_null($view) ? 'btn-info' : 'btn-outline-secondary' }}"><i class="la la-list-ol"></i> List View</a>
                  <a href="{{ URL::signedRoute('inspection.index', ['v' => 'c']) }}" class="btn {{ $view == 'c' ? 'btn-info' : 'btn-outline-secondary' }}"><i class="la la-calendar"></i> Calendar View</a>
                </div>
                
            </div>
         </div>
         <div class="kt-portlet__body kt-padding-t-0">
            
            {{-- SUMMARY  --}}
            <section class="row kt-margin-t-20">
              <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                  <div class="kt-widget24 kt-widget24--solid">
                    <div class="kt-widget24__details">
                      <div class="kt-widget24__info">
                        <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('New') }}</a>
                        <small class="kt-widget24__desc">{{ __('All Request') }}</small>
                      </div>
                      <span id="new-count" class="kt-widget24__stats kt-font-default"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                  <div class="kt-widget24 kt-widget24--solid">
                    <div class="kt-widget24__details">
                      <div class="kt-widget24__info">
                        <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Confirmed') }}</a>
                        <small class="kt-widget24__desc">{{ __('All Request') }}</small>
                      </div>
                      <span id="confirmed-count" class="kt-widget24__stats kt-font-default"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                  <div class="kt-widget24 kt-widget24--solid">
                    <div class="kt-widget24__details">
                      <div class="kt-widget24__info">
                        <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Processing') }}</a>
                        <small class="kt-widget24__desc">{{ __('All Request') }}</small>
                      </div>
                      <span id="processing-count" class="kt-widget24__stats kt-font-default"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                  <div class="kt-widget24 kt-widget24--solid">
                    <div class="kt-widget24__details">
                      <div class="kt-widget24__info">
                        <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Done') }}</a>
                        <small class="kt-widget24__desc">{{ __('Last 30 days') }}</small>
                      </div>
                      <span id="done-count" class="kt-widget24__stats kt-font-default"></span>
                    </div>
                  </div>
                </div>
              </div>
            </section>

            @if($view == 'l' || is_null($view))
            {{-- FILTER --}}
            <section class="form-row kt-margin-t-20">
              <div class="col-1">
                <div>
                  <select name="length_change" id="new-length-change"
                    class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
                    <option value='10'>10</option>
                    <option value='25'>25</option>
                    <option value='50'>50</option>
                    <option value='75'>75</option>
                    <option value='100'>100</option>
                  </select>
                </div>
              </div>
              <div class="col-8">
                <form class="form-row">
                  <div class="col-4">
                    <div class="input-group input-group-sm">
                      <div class="kt-input-icon kt-input-icon--right">
                        <input autocomplete="off" type="text" class="form-control form-control-sm"
                          aria-label="Text input with checkbox" placeholder="{{ __('SELECT DATE') }}"
                          id="inspection-date">
                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                          <span><i class="la la-calendar"></i></span>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="col-3">
                    <select name="" id="inspection-status"
                      class="form-control-sm form-control custom-select custom-select-sm " onchange="inspectionTable.draw()">
                      <option selected disabled>{{ __('STATUS') }}</option>
                      <option value="new">{{ __('New') }}</option>
                      <option value="confirmed">{{ __('Confirmed') }}</option>
                      <option value="processing">{{ __('Processing') }}</option>
                      <option value="done">{{ __('Done') }}</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <select name="" id="inspection-type"
                      class=" form-control form-control-sm custom-select-sm custom-select" onchange="inspectionTable.draw()">
                      <option disabled selected>{{ __('TYPE') }}</option>
                      <option value="event">{{ __('Event') }}</option>
                      <option value="classification">{{ __('Classification') }}</option>
                    </select>
                  </div>
                  <div class="col-2">
                    <button type="button" class="btn btn-sm btn-secondary" id="new-btn-reset">{{ __('RESET') }}</button>
                  </div>
                </form>
              </div>
              <div class="col-md-3">
                <div class="form-group form-group-sm">
                  <div class="kt-input-icon kt-input-icon--right">
                    <input autocomplete="off" type="search" class="form-control form-control-sm"
                      placeholder="{{ __('Search') }}..." id="search-new-request">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                      <span><i class="la la-search"></i></span>
                    </span>
                  </div>
                </div>
              </div>
            </section>

            <table class="table table-hover table-borderless table- border table-striped" id="inspectionTable">
              <thead>
                <tr>
                  <th>{{ __('REF NO.') }}</th>
                  <th>{{ __('TYPE') }}</th><!-- EVENT OR CLASSIFICATION-->
                  <th>{{ __('ESTABLISHMENT NAME') }}</th>
                  <th>{{ __('OWNER') }}</th>
                  @if(!Auth::user()->roles()->whereIn('roles.role_id', [4])->exists())
                  <th>{{ __('INSPECTORS') }}</th>
                  @endif
                  <th>{{ __('SCHEDULE') }}</th>
                  <th>{{ __('STATUS') }}</th>
                </tr>
              </thead>
            </table>
            @endif

            @if($view == 'c')
            <div id="calendar" class="kt-margin-t-20"></div>
            @endif

         </div>
    </section>
@stop
@section('script')

    @if($view == 'c')
    <script src="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/timeline/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/resource-common/main.js') }}"></script>
    <script src="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/resource-timeline/main.js') }}"></script>
   <script>
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
        @if(Auth::user()->LanguageId != 1)
        locale: 'ar',
        @endif
        plugins: [ 'resourceTimeline' ],
        defaultView: 'resourceTimelineDay',
        header: {
          left: 'today prev,next',
          center: 'title',
          right: 'resourceTimelineDay,resourceTimelineWeek,resourceTimelineMonth'
        },
        minTime: '09:00:00',
        maxTime: '18:00:00',
        slotDuration : '00:30:00',
        resourceColumns: [
          {
            labelText: 'Inspectors',
            field: 'title'
          }
        ],
        views: {
          resourceTimelineDay: {
            buttonText: 'Day'
          },
          resourceTimelineWeek : {
            type: 'resourceTimeline',
            duration: { days: 4},
            slotDuration : '00:30:00',
            buttonText: 'Week'
          },
          resourceTimelineMonth: {
            type: 'resourceTimeline',
            duration: { weeks: 5 },
            slotDuration : '00:60:00',
            buttonText: 'Month'
          },
        },
        resources: {!!json_encode($resources) !!},
        events: {
          url: '{{ URL::signedRoute('inspection.get_schedules') }}',
          @if(Auth::user()->roles()->whereIn('roles.role_id', [4])->exists())
          extraParams: {
            user_id: {{ Auth::user()->user_id}},
          },
          @endif
          textColor : '#ffffff',
        },
      });

      calendar.render();
   </script>
   @endif
    
    @if($view == 'l' || is_null($view))
   <script>
      var inspectionTable = {};
      var selected_date;
      var start = moment().subtract(29, 'days');
      var end = moment();

      $(document).ready(function(){
        $('input#inspection-date').daterangepicker({
        autoUpdateInput: false,
        buttonClasses: 'btn',
        applyClass: 'btn-warning btn-sm btn-elevate',
        cancelClass: 'btn-secondary btn-sm btn-elevate',
        startDate: start,
        endDate: end,
        maxDate: new Date,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, function (start, end, label) {
        $('input#inspection-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
      }).on('apply.daterangepicker', function(e, d){
       selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
       inspectionTable.draw();

       console.log(selected_date);
      });

      inspectionTable = $('table#inspectionTable').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
         ajax: {
           url: '{{ route('inspection.get_schedules_datatable') }}',
           data: function (d) {

              d.status =  $('select#inspection-status').val();
              d.type = $('select#inspection-type').val();
              d.date = $('#inspection-date').val()  ? selected_date : null;
              @if(Auth::user()->roles()->whereIn('roles.role_id', [4])->exists())
              d.user_id = {{ Auth::user()->user_id }};
              @endif
           }
         },
         columnDefs: [
           {targets: '_all', className: 'no-wrap'}
         ],
         columns: [
           {data: 'ref_no'},
           {data: 'type'},
           {data: 'company'},
           {data: 'owner'},
           @if(!Auth::user()->roles()->whereIn('roles.role_id', [4])->exists())
           {data: 'inspectors'},
           @endif
           {data: 'schedule'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
            $(row).click(function(){
                location.href = data.view_url;
            });
         },
          initComplete: function(setting, json){
           //  $('#new-count').html(json.new_count);
           //  $('#pending-count').html(json.pending_count);
           //  $('#cancelled-count-count').html(json.cancelled_count);
           // $('[data-toggle="tooltip"]').tooltip();
        }
       });


      $('#new-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); inspectionTable.draw();});
      
      inspectionTable.page.len($('#new-length-change').val());
      $('#new-length-change').change(function(){ 
        console.log($(this).val());
        inspectionTable.page.len( $(this).val() ).draw(); 
      });
       //custom search

       var search = $.fn.dataTable.util.throttle(function(v){ inspectionTable.search(v).draw(); });
       $('input#search-new-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });

     });

    </script>
    @endif
@stop