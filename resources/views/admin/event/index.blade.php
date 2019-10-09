@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
@stop
@section('content')
<section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
    <div class="kt-portlet__body kt-padding-t-5">
        <ul class="nav nav-tabs kt-margin-t-15 " role="tablist" id="artist-permit-nav">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#kt_tabs_1_1"
                    data-target="#kt_tabs_1_1">New Event Requests</a></li>
            <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_2">Processing Events</a></li>
            <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_3">Active Events</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4">Archive Event</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show fade active" id="kt_tabs_1_1" role="tabpanel">
                <div class="accordion accordion-solid accordion-toggle-plus kt-margin-b-15" id="accordionExample6">
                    <div class="card">
                        <div class="card-header" id="headingOne6">
                            <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse"
                                data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                <h6 class="kt-font-dark kt-font-transform-u"><i class="fa fa-filter"></i> Filters</h6>
                            </div>
                        </div>
                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                            data-parent="#accordionExample6">
                            <div class="card-body  kt-padding-10 border kt-margin-t-5">
                                <section class="row">
                                    <div class="col-2 col-xs-12">
                                        <div class="form-group form-group-xs">
                                            <div class="kt-checkbox-inline kt-margin-t-20 kt-padding-t-10">
                                                <label class="kt-checkbox kt-checkbox--dark">
                                                    <input type="checkbox" name="today" data-type="new_request">
                                                    Submitted Today
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 col-xs-12">
                                        <div class="form-group form-group-xs">
                                            <label>Applied Date</label>
                                            <input type="text" class=" form-control form-control-sm" autocomplete="off"
                                                name="permit_start">
                                        </div>
                                    </div>
                                    <div class="col-2 col-xs-12">
                                        <div class="form-group form-group-xs">
                                            <label>Permit Status</label>
                                            <select class="form-control form-control-sm custom-select custom-select-sm">
                                                <option selected disabled>All Status</option>
                                                <option value="new">New</option>
                                                <option value="amend">Amend</option>
                                                <option value="unprocessed">Unprocessed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2 col-xs-12">
                                        <div class="form-group form-group-xs">
                                            <label>Applicant Type</label>
                                            <select class="form-control form-control-sm custom-select-sm custom-select">
                                                <option selected disabled>All Type</option>
                                                <option value="amend">Individual</option>
                                                <option value="new">Company</option>
                                                <option value="renew">Government</option>
                                            </select>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-head-noborder table-borderless table-striped" id="new-event-request">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reference No.</th>
                            <th>Event Name</th>
                            <th>Person Applied</th>
                            <th>Applied Date</th>
                            <th>Applicant Type</th>
                            <th>Start On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="kt_tabs_1_2" role="tabpanel">
                <table class="table table-head-noborder table-borderless table-striped" id="new-event-processing">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reference No.</th>
                            <th>Establishment</th>
                            <th>Event Name</th>
                            <th>Applied Date</th>
                            <th>Start On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="kt_tabs_1_3" role="tabpanel">
                <table class="table table-head-noborder table-borderless table-striped" id="new-event-active">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reference No.</th>
                            <th>Establishment</th>
                            <th>Event Name</th>
                            <th>Applied Date</th>
                            <th>Start On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="kt_tabs_1_4" role="tabpanel">
                <table class="table table-head-noborder table-borderless table-striped" id="new-event-archive">
                    <thead class="thead-dark">
                        <tr>
                            <th>Reference No.</th>
                            <th>Establishment</th>
                            <th>Event Name</th>
                            <th>Applied Date</th>
                            <th>Start On</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    var artistPermit = {};
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
       newEvent();
       processing();
       active();
       archive();
       $('.nav-tabs a').on('shown.bs.tab', function (event) {
         var current_tab = $(event.target).text();
         if (current_tab == 'New Event Requests') {
         }

       });
     });

     function archive() {
       $('table#new-event-archive').DataTable({
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {
             d.status = ['rejected', 'cancelled', 'expired'];
           }
         },
         columnDefs: [
           {targets: [0, 3, 4, 5], className: 'no-wrap'}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'event_name'},
           {data: 'created_at'},
           {data: 'start_date'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id + '/application';
           });
         }
       });
     }

     function active() {
       $('table#new-event-active').DataTable({
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {
             d.status = ['active'];
           }
         },
         columnDefs: [
           {targets: [0, 3, 4, 5], className: 'no-wrap'}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'event_name'},
           {data: 'created_at'},
           {data: 'start_date'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id + '/application';
           });
         }
       });
     }

     function processing() {
       $('table#new-event-processing').DataTable({
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {
             d.status = ['processing', 'approved-unpaid'];
           }
         },
         columnDefs: [
           {targets: [0, 3, 4, 5], className: 'no-wrap'}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'event_name'},
           {data: 'created_at'},
           {data: 'start_date'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id + '/application';
           });
         }
       });
     }

     function newEvent() {
       $('table#new-event-request').DataTable({
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {
             d.status = ['new'];
           }
         },
         columnDefs: [
           {targets: [0, 3, 4, 5], className: 'no-wrap'}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'event_name'},
           {data: 'created_at'},
           {data: 'start_`'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id + '/application';
           });
         }
       });
     }

     function blockArtistTable() {
       $('table#block-artist').DataTable({
         ajax: {
           url: '{{ route('admin.artist.datatable') }}',
           data: function (d) {
             d.artist_status = 'blocked';
           }
         },
         columnDefs: [
           {targets: [0, 4, 5, 6], className: 'no-wrap'}
         ],
         columns: [
           {data: 'person_code'},
           {data: 'name'},
           {data: 'profession'},
           {data: 'nationality'},
           {data: 'mobile_number'},
           {data: 'active_permit'},
           {
             render: function (data, type, full, meta) {
               var classname = full.artist_status == 'Active' ? 'success' : 'danger';
               return '<span class="kt-badge kt-badge--' + classname + ' kt-badge--inline">' + full.artist_status + '</span>';
             }
           }
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/permit/artist/') }}/' + data.artist_id;
           });
         }
       });
     }

</script>
@endsection
