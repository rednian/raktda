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
         </div>
         <div class="kt-portlet__body kt-padding-t-0">
            <div id="calendar"></div>
         </div>
    </section>
@stop
@section('script')
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
        defaultView: 'resourceTimelineWeek',
        header: {
          left: 'today prev,next',
          center: 'title',
          right: 'resourceTimelineDay,resourceTimelineWeek'
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
        resources: {!!json_encode($resources) !!},
        events: {!!json_encode($appointments) !!},
        height: 'parent',
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
                else{
                    element.data('content', info.event.extendedProps.description);
                    element.data('placement', 'top');
                    KTApp.initPopover(element);
                }
            }
        }
      });

      calendar.render();
   </script>
@stop