@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
@stop
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
          <div class="col-md-12">
                     <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 " role="tablist" id="artist-permit-nav">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">New Event Requests</a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#processing-permit">Processing Events</a></li>
                        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#active-permit">Active Events</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#archive-permit">Archive Events</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#event-calendar">All Events Calendar</a></li>
                     </ul>
                      {{-- <input type="text" class="form-control form-control-sm" style="position: absolute; top: 0"> --}}
          </div>
        </section>
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="new-request" role="tabpanel">
               @include('admin.artist_permit.includes.summary')
							 <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
									<label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
									<select onchange="newEventTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="new-permit-status">
										 <option value="new">New</option>
										 <option value="amend">Amend</option>
									</select>
									<label for="inlineFormInputName2" class="kt-margin-5"></label>
									<select onchange="newEventTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="new-applicant-type">
										 <option value="1">Private</option>
										 <option value="3">Government</option>
										 <option value="2">Individual</option>
									</select>
									<label for="inlineFormInputName2"></label>
									<input type="text" id="new-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15" placeholder="Start date of permit" autocomplete="off">
                  <label for=""></label>
                  
                  <div class="form-group row form-group-xs" style="margin-left: 5.5%">
                    <div class="col-md-12 kt-padding-l-20">
                    </div>
                </section>

                <table class="table table-hover table-borderless table- border table-striped" id="new-event-request">
                    <thead>
                        <tr>
                            <th>REFERENCE NO.</th>
                            <th>ESTABLISHMENT</th>
                            <th>PERMIT OWNER</th>
                            <th>EVENT NAME</th>
                            <th>APPLIED DATE</th>
                            <th>APPLICANT TYPE</th>
                            {{-- <th>PERMIT START</th> --}}
                            <th>STATUS</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="processing-permit" role="tabpanel">
                @include('admin.artist_permit.includes.summary')
                <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
                    <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span
                            class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
                    <select onchange="eventProcessingTable.draw();" multiple="multiple"
                        class=" mb-2 mr-sm-2 kt-margin-l-15" id="processing-permit-status">
                        <option value="approved-unpaid">Approved-unpaid</option>
                        <option value="processing">Processing</option>
                    </select>
                    <label for="inlineFormInputName2" class="kt-margin-5"></label>
                    <select onchange="eventProcessingTable.draw();" multiple="multiple"
                        class=" mb-2 mr-sm-2 kt-margin-l-15" id="processing-applicant-type">
                        <option value="1">Private</option>
                        <option value="3">Government</option>
                        <option value="2">Individual</option>
                    </select>
                    <label for="inlineFormInputName2"></label>
                    <input type="text" id="processing-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-5"
                        placeholder="Start date of permit" autocomplete="off">
                </section>
                <table class="table table-head-noborder table-borderless table-striped border"
                    id="new-event-processing">
                    <thead>
                        <tr>
                            <th>REFERENCE NO.</th>
                            <th>ESTABLISHMENT</th>
                            <th>PERMIT OWNER</th>
                            <th>EVENT NAME</th>
                            <th>APPLIED DATE</th>
                            <th>APPLICANT TYPE</th>
                            {{-- <th>PERMIT START</th> --}}
                            <th>STATUS</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="active-permit" role="tabpanel">
                @include('admin.artist_permit.includes.summary')

                <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
                    <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span
                            class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
                    {{-- <select onchange="eventProcessingTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="active-permit-status">
                     <option value="new">New</option>
                     <option value="amend">Amend</option>
                  </select> --}}
                    <label for="inlineFormInputName2" class="kt-margin-5"></label>
                    <select onchange="eventProcessingTable.draw();" multiple="multiple"
                        class=" mb-2 mr-sm-2 kt-margin-l-15" id="active-applicant-type">
                        <option value="1">Private</option>
                        <option value="3">Government</option>
                        <option value="2">Individual</option>
                    </select>
                    <label for="inlineFormInputName2"></label>
                    <input type="text" id="new-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15"
                        placeholder="Start date of permit" autocomplete="off">
                </section>

                <table class="table table-head-noborder table-borderless border table-striped" id="new-event-active">
                    <thead>
                        <tr>
                            <th>REFERENCE NO.</th>
                            <th>ESTABLISHMENT</th>
                            <th>PERMIT OWNER</th>
                            <th>EVENT NAME</th>
                            <th>PERMIT START</th>
                            <th>APPLICANT TYPE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="archive-permit" role="tabpanel">
                @include('admin.artist_permit.includes.summary')
                <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
                    <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span
                            class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
                    <select onchange="eventArchiveTable.draw();" multiple="multiple"
                        class=" mb-2 mr-sm-2 kt-margin-l-15" id="archive-permit-status">
                        <option value="expired">Expired</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    <label for="inlineFormInputName2" class="kt-margin-5"></label>
                    <select onchange="eventArchiveTable.draw();" multiple="multiple"
                        class=" mb-2 mr-sm-2 kt-margin-l-15" id="archive-applicant-type">
                        <option value="1">Private</option>
                        <option value="3">Government</option>
                        <option value="2">Individual</option>
                    </select>
                    <label for="inlineFormInputName2"></label>
                    <input type="text" id="new-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15"
                        placeholder="Start date of permit" autocomplete="off">
                </section>
                <table class="table table-head-noborder table-borderless border" id="new-event-archive">
                    <thead>
                        <tr>
                            <th>REFERENCE NO.</th>
                            <th>ESTABLISHMENT</th>
                            <th>PERMIT OWNER</th>
                            <th>EVENT NAME</th>
                            {{-- <th>APPLIED DATE</th> --}}
                            <th>APPLICANT TYPE</th>
                            <th>PERMIT STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="event-calendar" role="tabpanel">
                <section id="event-calendar"></section>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')

<script type="text/javascript">
    var newEventTable = {};
     var artistPermit = {};
     var eventProcessingTable= {};
     var eventArchiveTable = {};
     var eventActiveTable = {};
     var filter = {
       today: null,
       action_needed: null,
       getAction: function () {
         return this.action_needed;
       },
       getToday: function () {
         return this.today;
       }
     };
     $(document).ready(function () {

       $('[data-switch=true]').bootstrapSwitch();

       newEvent();
       calendar();

       var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-tabs a').click(function (e) {
          $(this).tab('show');
          var scrollmem = $('body').scrollTop();
          window.location.hash = this.hash;
          $('html,body').scrollTop(scrollmem);
        });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var current_tab = $(e.target).text();
        console.log(current_tab);
        if('Processing Events' == current_tab  && !$.fn.dataTable.isDataTable('table#new-event-processing')){ processing(); }
        if('Active Events' == current_tab  && !$.fn.dataTable.isDataTable('table#new-event-active')){ active(); }
        if('Archive Events' == current_tab  && !$.fn.dataTable.isDataTable('table#new-event-archive')){ archive(); }
      });



     });

     function calendar(){
      var todayDate = moment().startOf('day');
          var YM = todayDate.format('YYYY-MM');
          var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
          var TODAY = todayDate.format('YYYY-MM-DD');
          var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

          var calendarEl = document.getElementById('event-calendar');
          var calendar = new FullCalendar.Calendar(calendarEl, {
              plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],

              isRTL: KTUtil.isRTL(),
              header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'listWeek,listDay,dayGridMonth,timeGridWeek',
              },

              height: 800,
              contentHeight: 780,
              aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

              nowIndicator: true,
              // now: TODAY + 'T09:25:00', // just for demo

              views: {
                  dayGridMonth: { buttonText: 'Month' },
                  timeGridWeek: { buttonText: 'Week' },
                  timeGridDay: { buttonText: 'Day' },
                  listDay: { buttonText: 'Day List' },
                  listWeek: { buttonText: 'Week List' }
              },

              defaultView: 'listWeek',
              // defaultDate: TODAY,

              editable: true,
              eventLimit: true, // allow "more" link when too many events
              navLinks: true,
              events: '{{ route('admin.event.calendar') }}',
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
     }

     function archive() {
      $('select#archive-permit-status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Event Status',
        autoWidth: true,
        width: '24%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

      $('select#archive-applicant-type').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Applicant Type',
        autoWidth: true,
        width: '37%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

     eventArchiveTable = $('table#new-event-archive').DataTable({
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {

          var status = $('select#processing-permit-status').val();
          var type = $('select#processing-applicant-type').val();

          d.status = status.length > 0 ? status : ['expired', 'rejected'];
          d.type =  type.length > 0 ? type : null;

          }
        },
        columnDefs: [
          {targets: '_all', className: 'no-wrap'}
        ],
        columns: [
          {data: 'reference_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          {data: 'type'},
          // {data: 'start'},
          {data: 'status'},
          {data: 'action'},
        ],
        createdRow: function (row, data, index) {
          $('.btn-download', row).click(function(e) { e.stopPropagation(); });
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=archive-permit';
          });
        }
      });
     }

     function active() {
      $('select#active-applicant-type').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Applicant Type',
        autoWidth: true,
        width: '37%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

      eventActiveTable = $('table#new-event-active').DataTable({
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            var status = $('select#processing-permit-status').val();
            var type = $('select#processing-applicant-type').val();

            // d.status = status.length > 0 ? status : ['approved-unpaid', 'unprocessed'];
            d.status = ['active'];
            d.type =  type.length > 0 ? type : null;
          }
        },
        columnDefs: [
          {targets: '_all', className: 'no-wrap'}
        ],
        columns: [
          {data: 'reference_number'},
          // {data: 'permit_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          {data: 'start'},
          {data: 'type'},
          {data: 'action'},
        ],
        createdRow: function (row, data, index) {
          $('.btn-download', row).click(function(e){e.stopPropagation();});
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=active-permit';
          });
        }
      });
     }

     function processing() {
      $('select#processing-permit-status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Event Status',
        autoWidth: true,
        width: '21%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

      $('select#processing-applicant-type').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Applicant Type',
        autoWidth: true,
        width: '37%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });
      eventProcessingTable = $('table#new-event-processing').DataTable({
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            var status = $('select#processing-permit-status').val();
            var type = $('select#processing-applicant-type').val();

            d.status = status.length > 0 ? status : ['approved-unpaid', 'processing', 'need approval', 'need modification'];
            d.type =  type.length > 0 ? type : null;
          }
        },
        columnDefs: [
          {targets: '_all', className: 'no-wrap'}
        ],
        columns: [
          {data: 'reference_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          {data: 'created_at'},
          {data: 'type'},
          // {data: 'start'},
          {data: 'status'}
        ],
        createdRow: function (row, data, index) {
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=processing-permit';
          });
        }
      });
     }

     function newEvent() {
       newEventTable = $('table#new-event-request').DataTable({
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {
            var status = $('select#new-permit-status').val();
            var type = $('select#new-applicant-type').val();

             d.status = status.length > 0 ? status : ['new', 'amended'];
             d.type =  type.length > 0 ? type : null;

           }
         },
         columnDefs: [
           {targets: '_all', className: 'no-wrap'}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'establishment_name'},
           {data: 'owner'},
           {data: 'event_name'},
           {data: 'created_at'},
           {data: 'type'},
           // {data: 'start'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id + '/application';
           });
         }
       });

       $('select#new-permit-status').select2({
         minimumResultsForSearch: Infinity,
         placeholder: 'Event Status',
         autoWidth: true,
         width: '21%',
         // closeOnSelect: false,
         allowClear: true,
         tags: true
       });

       $('select#new-applicant-type').select2({
         minimumResultsForSearch: Infinity,
         placeholder: 'Applicant Type',
         autoWidth: true,
         width: '37%',
         // closeOnSelect: false,
         allowClear: true,
         tags: true
       });
     }
</script>
@endsection
