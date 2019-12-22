@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
<style>
  .fc-unthemed .fc-event .fc-title,
  .fc-unthemed .fc-event-dot .fc-title {
    color: #fff;
  }

  .fc-unthemed .fc-event .fc-time,
  .fc-unthemed .fc-event-dot .fc-time {
    color: #fff;
  }

  .widget-toolbar {
    cursor: pointer;
  }
</style>
@stop
@section('content')
<section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
  <div class="kt-portlet__body">
    
    <section class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger"
          role="tablist" id="artist-permit-nav">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request"
              data-target="#new-request">{{ __('Need Approval') }}</a></li>
          
        </ul>
      </div>
    </section>
    <div class="tab-content">
      <div class="tab-pane show fade active" id="new-request" role="tabpanel">
        <section class="form-row">
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
                      aria-label="Text input with checkbox" placeholder="{{ __('APPLIED DATE') }}"
                      id="new-applied-date">
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                      <span><i class="la la-calendar"></i></span>
                    </span>
                  </div>
                </div>
              </div>
              <div class="col-3">
                <select name="" id="new-applicant-type"
                  class="form-control-sm form-control custom-select custom-select-sm " onchange="newEventTable.draw()">
                  <option selected disabled>{{ __('APPLICATION TYPE') }}</option>
                  <option value="private">{{ __('Private') }}</option>
                  <option value="government">{{ __('Government') }}</option>
                  <option value="individual">{{ __('Individual') }}</option>
                </select>
              </div>
              <div class="col-3">
                <select name="" id="new-permit-status"
                  class=" form-control form-control-sm custom-select-sm custom-select" onchange="newEventTable.draw()">
                  <option disabled selected>{{ __('STATUS') }}</option>
                  <option value="new">{{ __('New') }}</option>
                  <option value="amended">{{ __('Amended') }}</option>
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
        <table class="table table-hover table-borderless table- border table-striped" id="new-event-request">
          <thead>
            <tr>
              <th>{{ __('REFERENCE NO.') }}</th>
              <th>{{ __('ESTABLISHMENT NAME') }}</th>
              <th>{{ __('PERMIT OWNER') }}</th>
              <th>{{ __('EVENT NAME') }}</th>
              <th>{{ __('APPLICATION TYPE') }}</th>
              <th>{{ __('APPLIED DATE') }}</th>
              <th>{{ __('STATUS') }}</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</section>
{{-- cancel modal --}}
<div class="modal fade" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form name="cancel_form">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cancel Event <span id="event-title"></span> <small>This will
              cancel the event & notify the client</small></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="user_type" value="admin">
            <input type="hidden" name="type" value="0">
            <input type="hidden" name="action" value="cancelled">
            <label for="message-text" class="form-control-label">Remarks<span class="text-danger">*</span></label>
            <textarea name="comment" maxlength="255" required rows="4" class="form-control" id="message-text"
              placeholder="write your reason for cancelling..."></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm kt-font-transform-u" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning btn-sm kt-font-transform-u">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

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
     
       newEvent();
       setInterval(function(){ newEvent();},100000);

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
      });
     });

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
             d.status =  ['need approval'];
             d.type = $('select#new-applicant-type').val();
             d.date = $('#new-applied-date').val()  ? selected_date : null;
             d.approval = 1;
             @if(Auth::user()->roles()->first()->role_id == 6)
             d.gov = 1;
             @endif
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
           {data: 'created_at'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id;
           });
         },
          initComplete: function(setting, json){
            $('#new-count').html(json.new_count);
            $('#pending-count').html(json.pending_count);
            $('#cancelled-count-count').html(json.cancelled_count);
           $('[data-toggle="tooltip"]').tooltip();
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