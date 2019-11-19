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
<section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
    <div class="kt-portlet__body">
      <section class="row">
        <div class="col-4">
          <div class="kt-section kt-section--space-sm widget-toolbar">
            <div class="kt-widget24 kt-widget24--solid">
              <div class="kt-widget24__details">
                <div class="kt-widget24__info">
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('New Request') }}</a>
                  <small class="kt-widget24__desc">{{ __('All') }}</small>
                </div>
                <span class="kt-widget24__stats kt-font-default">{{ $new_request }}</span>
              </div>
              <!-- <div class="progress progress--sm">
                <div class="progress-bar kt-bg-default" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="kt-section kt-section--space-sm widget-toolbar">
            <div class="kt-widget24 kt-widget24--solid">
              <div class="kt-widget24__details">
                <div class="kt-widget24__info">
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Pending Request') }}</a>
                  <small class="kt-widget24__desc">{{ __('All Customer Request') }}</small>
                </div>
                <span class="kt-widget24__stats kt-font-default">{{ $pending_request }}</span>
              </div>
              <!-- <div class="progress progress--sm">
                <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
              </div> -->
            </div>
          </div>
        </div>
        <div class="col-4">
          <div class="kt-section kt-section--space-sm ">
            <div class="kt-widget24 kt-widget24--solid">
              <div class="kt-widget24__details">
                <div class="kt-widget24__info">
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Action Taken') }}</a>
                  <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
                </div>
                <span class="kt-widget24__stats kt-font-default">{{ $active_request }}</span>
              </div>
              <!-- <div class="progress progress--sm">
                <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
              </div> -->
            </div>
          </div>
        </div>
      </section>
        <section class="row">
          <div class="col-md-12">
             <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 " role="tablist" id="artist-permit-nav">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('New Event Requests') }}</a></li>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#pending-request" data-target="#pending-request">{{ __('Pending Requests') }}</a></li>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#processing-permit">{{ __('Processing Events') }}</a></li>
                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#active-permit">{{ __('Active Events') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#archive-permit">{{ __('Archive Events') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#calendar">{{ __('All Events Calendar') }}</a></li>
             </ul>
          </div>
        </section>
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="new-request" role="tabpanel">
               <section class="form-row">
                <div class="col-1">
                  <div>
                    <select name="length_change" id="new-length-change" class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
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
                              <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="{{ __('APPLIED DATE') }}" id="new-applied-date" >
                              <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                <span><i class="la la-calendar"></i></span>
                              </span>
                            </div>
                      </div>
                    </div>
                    <div class="col-3">
                      <select name="" id="new-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="newEventTable.draw()" >
                        <option selected disabled >APPLICANT TYPE</option>
                        <option value="1">Private</option>
                        <option value="3">Government</option>
                        <option value="2">Individual</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <select  name="" id="new-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="newEventTable.draw()">
                        <option disabled selected>STATUS</option>
                        <option value="new">New</option>
                        <option value="amended">Amended</option>
                      </select>
                    </div>
                    <div class="col-1">
                      <button type="button" class="btn btn-sm btn-secondary" id="new-btn-reset">RESET</button>
                    </div>
                  </form>
                </div>
                <div class="col-md-3">
                  <div class="form-group form-group-sm">
                    <div class="kt-input-icon kt-input-icon--right">
                      <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="Search..." id="search-new-request">
                      <span class="kt-input-icon__icon kt-input-icon__icon--right">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
                  </div>
                </div>
               </section>
                <table class="table table-hover table-borderless table- border table-striped" id="new-event-request">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PERMIT OWNER') }}</th>
                            <th>{{ __('EVENT NAME') }}</th>
                            <th>{{ __('APPLIED DATE') }}</th>
                            <th>{{ __('APPLICANT TYPE') }}</th>
                            {{-- <th>PERMIT START</th> --}}
                            <th>{{ __('STATUS') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane show fade" id="pending-request" role="tabpanel">
               <section class="form-row">
                <div class="col-1">
                  <div>
                    <select name="length_change" id="pending-length-change" class="form-control-sm form-control custom-select custom-select-sm">
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
                              <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="APPLIED DATE" id="pending-applied-date" >
                              <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                <span><i class="la la-calendar"></i></span>
                              </span>
                            </div>
                      </div>
                    </div>
                    <div class="col-3">
                      <select name="" id="pending-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="newEventTable.draw()" >
                        <option selected disabled >APPLICANT TYPE</option>
                        <option value="1">Private</option>
                        <option value="3">Government</option>
                        <option value="2">Individual</option>
                      </select>
                    </div>
                    <div class="col-3">
                      <select  name="" id="pending-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="newEventTable.draw()">
                        <option disabled selected>STATUS</option>
                        <option value="new">New</option>
                        <option value="amended">Amended</option>
                      </select>
                    </div>
                    <div class="col-1">
                      <button type="button" class="btn btn-sm btn-secondary" id="pending-btn-reset">RESET</button>
                    </div>
                  </form>
                </div>
                <div class="col-md-3">
                  <div class="form-group form-group-sm">
                    <div class="kt-input-icon kt-input-icon--right">
                      <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="Search..." id="search-pending-request">
                      <span class="kt-input-icon__icon kt-input-icon__icon--right">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
                  </div>
                </div>
               </section>
                <table class="table table-hover table-borderless table- border table-striped" id="pending-event-request">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PERMIT OWNER') }}</th>
                            <th>{{ __('EVENT NAME') }}</th>
                            <th>{{ __('APPLIED DATE') }}</th>
                            <th>{{ __('APPLICANT TYPE') }}</th>
                            {{-- <th>PERMIT START</th> --}}
                            <th>{{ __('STATUS') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="processing-permit" role="tabpanel">
                <section class="form-row">
                 <div class="col-1">
                   <div>
                     <select name="length_change" id="processing-length-change" class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
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
                               <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="APPLIED DATE" id="processing-applied-date" >
                               <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                 <span><i class="la la-calendar"></i></span>
                               </span>
                             </div>
                       </div>
                     </div>
                     <div class="col-3">
                       <select name="" id="processing-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="eventProcessingTable.draw()" >
                         <option selected disabled >APPLICANT TYPE</option>
                         <option value="1">Private</option>
                         <option value="3">Government</option>
                         <option value="2">Individual</option>
                       </select>
                     </div>
                     <div class="col-3">
                       <select  name="" id="processing-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="eventProcessingTable.draw()">
                         <option disabled selected>STATUS</option>
                         <option value="processing">processing</option>
                         <option value="approved-unpaid">Approved-unpaid</option>
                         <option value="need-approval">Need Approval</option>
                       </select>
                     </div>
                     <div class="col-1">
                       <button type="button" class="btn btn-sm btn-secondary" id="processing-btn-reset">RESET</button>
                     </div>
                   </form>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group form-group-sm">
                     <div class="kt-input-icon kt-input-icon--right">
                       <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="Search..." id="search-processing-request">
                       <span class="kt-input-icon__icon kt-input-icon__icon--right">
                         <span><i class="la la-search"></i></span>
                       </span>
                     </div>
                   </div>
                 </div>
                </section>
                <table class="table table-head-noborder table-borderless table-striped border"
                    id="new-event-processing">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PERMIT OWNER') }}</th>
                            <th>{{ __('EVENT NAME') }}</th>
                            <th>{{ __('APPLIED DATE') }}</th>
                            <th>{{ __('APPLICANT TYPE') }}</th>
                            {{-- <th>PERMIT START</th> --}}
                            <th>{{ __('STATUS') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="active-permit" role="tabpanel">
                <section class="form-row">
                 <div class="col-1">
                   <div>
                     <select name="length_change" id="active-length-change" class="form-control-sm form-control custom-select custom-select-sm">
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
                               <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="PERMIT DURATION DATE" id="active-applied-date" >
                               <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                 <span><i class="la la-calendar"></i></span>
                               </span>
                             </div>
                       </div>
                     </div>
                     <div class="col-3">
                       <select name="" id="active-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="eventActiveTable.draw()" >
                         <option selected disabled >APPLICANT TYPE</option>
                         <option value="1">Private</option>
                         <option value="3">Government</option>
                         <option value="2">Individual</option>
                       </select>
                     </div>
                     {{-- <div class="col-3">
                       <select  name="" id="active-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="eventActiveTable.draw()">
                         <option disabled selected>STATUS</option>
                         <option value="active">active</option>
                         <option value="amended">Amended</option>
                       </select>
                     </div> --}}
                     <div class="col-4">
                       <button type="button" class="btn btn-sm btn-secondary" id="active-btn-reset">RESET</button>
                     </div>
                   </form>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group form-group-sm">
                     <div class="kt-input-icon kt-input-icon--right">
                       <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="Search..." id="search-active-request">
                       <span class="kt-input-icon__icon kt-input-icon__icon--right">
                         <span><i class="la la-search"></i></span>
                       </span>
                     </div>
                   </div>
                 </div>
                </section>
                <table class="table table-head-noborder table-sm table-borderless border table-striped" id="new-event-active">
                    <thead>
                        <tr>
                            <!-- <th></th> -->
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PERMIT OWNER') }}</th>
                            <th>{{ __('EVENT NAME') }}</th>
                            <!-- <th>{{ __('PERMIT START') }}</th> -->
                            <th>{{ __('APPLICANT TYPE') }}</th>
                            <th>{{ __('SHOW TO ALL') }}</th>
                            <th>{{ __('WEBSITE') }}</th>
                            <th>{{ __('ACTION') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="archive-permit" role="tabpanel">
                <section class="form-row">
                 <div class="col-1">
                   <div>
                     <select name="length_change" id="archive-length-change" class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
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
                     {{-- <div class="col-4">
                         <div class="input-group input-group-sm">
                             <div class="kt-input-icon kt-input-icon--right">
                               <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="APPLIED DATE" id="archive-applied-date" >
                               <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                 <span><i class="la la-calendar"></i></span>
                               </span>
                             </div>
                       </div>
                     </div> --}}
                     <div class="col-3">
                       <select name="" id="archive-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="eventArchiveTable.draw()" >
                         <option selected disabled >APPLICANT TYPE</option>
                         <option value="1">Private</option>
                         <option value="3">Government</option>
                         <option value="2">Individual</option>
                       </select>
                     </div>
                     <div class="col-3">
                       <select  name="" id="archive-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="eventArchiveTable.draw()">
                         <option disabled selected>STATUS</option>
                         <option value="expired">Expired</option>
                         <option value="rejected">Rejected</option>
                       </select>
                     </div>
                     <div class="col-1">
                       <button type="button" class="btn btn-sm btn-secondary" id="archive-btn-reset">RESET</button>
                     </div>
                   </form>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group form-group-sm">
                     <div class="kt-input-icon kt-input-icon--right">
                       <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="Search..." id="search-archive-request">
                       <span class="kt-input-icon__icon kt-input-icon__icon--right">
                         <span><i class="la la-search"></i></span>
                       </span>
                     </div>
                   </div>
                 </div>
                </section>
                <table class="table table-head-noborder table-hover table-sm table-striped table-borderless border" id="new-event-archive">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PERMIT OWNER') }}</th>
                            <th>{{ __('EVENT NAME') }}</th>
                            {{-- <th>APPLIED DATE</th> --}}
                            <th>{{ __('APPLICANT TYPE') }}</th>
                            <th>{{ __('STATUS') }}</th>
                            <th>{{ __('ACTION') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="calendar" role="tabpanel">
              <section class="row">
                <div class="col-md-3">
                   <section class="accordion accordion-solid accordion-toggle-plus" id="accordion-address">
                      <div class="card">
                         <div class="card-header" id="heading-address">
                            <div class="card-title kt-padding-b-5 kt-padding-t-10" data-toggle="collapse" data-target="#collapse-address"
                                 aria-expanded="true" aria-controls="collapse-address">
                               <h6 class="kt-font-bold kt-font-transform-u kt-font-dark">Event type legend</h6>
                            </div>
                         </div>
                         <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
                            <div class="card-body" style="padding: 1px;">
                              <table class="table table-borderless ">
                                <tbody>
                                  @if (!empty($types))
                                  @foreach ($types as $type)
                                    <tr>
                                      <td>
                                        <span style="padding: 5px ; border-radius: 2px; color: #fff; background-color: {!! $type->color !!}">
                                        {{  Auth::user()->LanguageId == 1 ? ucfirst(substr($type->name_en, 0, 31)): ucfirst($type->name_ar)  }}</td>
                                        </span>
                                    </tr>
                                  @endforeach
                                  @endif
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </section>
                </div>
                <div class="col-md-9">
                    <section id="event-calendar"></section>
                </div>
              </section>
            </div>
        </div>
    </div>
</section>

@endsection
@section('script')

<script type="text/javascript">
    var newEventTable = {};
    var pendingEventTable = {};
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
      
      $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function(){ $('.nav-tabs a[href="#new-request"]').tab('show');  });
      $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function(){ $('.nav-tabs a[href="#pending-request"]').tab('show'); });

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
        var current_tab = $(e.target).attr('href');

        if('#pending-request' == current_tab ){ pendingEvent(); }
        if('#processing-permit' == current_tab ){ processing(); }
        if('#active-permit' == current_tab ){ active(); }
        if('#archive-permit' == current_tab){ archive(); }
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
              height: 'auto',
              allDaySlot: true,
              contentHeight: 450,
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
              defaultView: 'dayGridMonth',
              // defaultDate: TODAY,
              editable: true,
              eventLimit: true, // allow "more" link when too many events
              navLinks: true,
              events: {
                url: '{{ route('admin.event.calendar') }}',
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
     }

     function archive() {
     eventArchiveTable = $('table#new-event-archive').DataTable({
      dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            d.type = $('select#archive-applicant-type').val();
            var status = $('select#archive-permit-status').val();      
            d.status = status != null ? [status] : ['expired', 'rejected'];
          }
        },
        columnDefs: [
          {targets: [0,4,5,6], className: 'no-wrap'}
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

     //clear fillte button
     $('#archive-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); eventArchiveTable.draw();});
     //custom pagelength
     eventArchiveTable.page.len($('#archive-length-change').val());
     $('#archive-length-change').change(function(){ eventArchiveTable.page.len( $(this).val() ).draw(); });
     //custom search
     var search = $.fn.dataTable.util.throttle(function(v){ eventArchiveTable.search(v).draw(); });
     $('input#search-archive-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });

     }

     function active() {
      var start = moment().subtract(29, 'days');
      var end = moment();
      var new_selected_date = null;

      $('input#active-applied-date').daterangepicker({
        autoUpdateInput: false,
        buttonClasses: 'btn',
        applyClass: 'btn-warning btn-sm btn-elevate',
        cancelClass: 'btn-secondary btn-sm btn-elevate',
        startDate: start,
        endDate: end,
        // maxDate: new Date,
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, function (start, end, label) {
        $('input#active-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
      }).on('apply.daterangepicker', function(e, d){
       new_selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
       eventActiveTable.draw();
      });


      eventActiveTable = $('table#new-event-active').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            d.type = $('select#active-applicant-type').val();
            d.status = ['active'];
          }
        },
        columnDefs: [
        //   {
        //     targets: [0], className: 'no-wrap', 
        //     checkboxes:{
        //       'selectRow': true
        //   }
        // },
          {targets: [5,6], className: 'no-wrap'}
        ],
        // select: { 'style': 'multi' },
        columns: [
          // {data: 'event_id'},
          {data: 'reference_number'},
          // {data: 'permit_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          // {data: 'start'},
          {data: 'type'},
          {data: 'show'},
          {data: 'website'},
          {data: 'action'},
        ],
        createdRow: function (row, data, index) {
          $('display-all', row).change(function(e){
            var event = $(this);
            e.stopPropagation();
            bootbox.confirm('Are you sure you want to show the <span class="text-success">'+event.attr('name')+'</span> event to all the client\'s calendar?', function(result){
              if(result){
                // $.ajax({
                //   url: '{{ url('/event') }}/'+data.event_id+'/show-all',
                // });
              }
            });
          });

          $('td .website', row).change(function(e){
            e.stopPropagation();
            alert();
          });

          $('.btn-download', row).click(function(e){e.stopPropagation();});
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=active-permit';
          });
        }
      });

    
      
      //clear fillte button
      $('#active-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); eventActiveTable.draw();});
      //custom pagelength
      eventActiveTable.page.len($('#active-length-change').val());
      $('#active-length-change').change(function(){ eventActiveTable.page.len( $(this).val() ).draw(); });
      //custom search
      var search = $.fn.dataTable.util.throttle(function(v){ eventActiveTable.search(v).draw(); });
      $('input#search-active-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });

     }

     function processing() {
      var start = moment().subtract(29, 'days');
      var end = moment();
      var new_selected_date = null;
      
      $('input#processing-applied-date').daterangepicker({
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
        $('input#processing-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
      }).on('apply.daterangepicker', function(e, d){
        new_selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
        eventProcessingTable.draw();
      });


      eventProcessingTable = $('table#new-event-processing').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            var status = $('select#processing-permit-status').val();            
             d.status = status != null ? [status] : ['approved-unpaid', 'processing', 'need approval', 'need modification'];
             d.type = $('select#processing-applicant-type').val();
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

      //clear fillte button
       $('#processing-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); eventProcessingTable.draw();});
      //custom pagelength
      eventProcessingTable.page.len($('#processing-length-change').val());
      $('#processing-length-change').change(function(){ eventProcessingTable.page.len( $(this).val() ).draw(); });
      //custom search
      
      var search = $.fn.dataTable.util.throttle(function(v){ eventProcessingTable.search(v).draw(); });
      $('input#search-processing-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });
     }

     function pendingEvent() {
      var start = moment().subtract(29, 'days');
      var end = moment();
      var selected_date = null;

      $('input#pending-applied-date').daterangepicker({
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
        $('input#pending-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
      }).on('apply.daterangepicker', function(e, d){
       selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
       pendingEventTable.draw();
      });

       pendingEventTable = $('table#pending-event-request').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {

            // var status = $('select#new-permit-status').val();            
             d.status = ['amended'];
             d.type = $('select#pending-applicant-type').val();
             d.date = $('#pending-applied-date').val()  ? selected_date : null; 
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

       //clear fillte button
        $('#pending-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); pendingEventTable.draw();});
       //custom pagelength
       pendingEventTable.page.len($('#pending-length-change').val());
       $('#pending-length-change').change(function(){ pendingEventTable.page.len( $(this).val() ).draw(); });
       //custom search
       
       var search = $.fn.dataTable.util.throttle(function(v){ pendingEventTable.search(v).draw(); });
       $('input#search-pending-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });
     }


     function newEvent() {
      var start = moment().subtract(29, 'days');
      var end = moment();
      var selected_date = null;

      $('input#new-applied-date').daterangepicker({
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
        $('input#new-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
      }).on('apply.daterangepicker', function(e, d){
       selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
       newEventTable.draw();
      });

       newEventTable = $('table#new-event-request').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {

            var status = $('select#new-permit-status').val();            
             d.status =  ['new'];
             d.type = $('select#new-applicant-type').val();
             d.date = $('#new-applied-date').val()  ? selected_date : null; 
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

       //clear fillte button
        $('#new-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); newEventTable.draw();});
       //custom pagelength
       newEventTable.page.len($('#new-length-change').val());
       $('#new-length-change').change(function(){ newEventTable.page.len( $(this).val() ).draw(); });
       //custom search
       
       var search = $.fn.dataTable.util.throttle(function(v){ newEventTable.search(v).draw(); });
       $('input#search-new-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });
     }
</script>
@endsection
