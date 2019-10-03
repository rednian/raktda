@extends('layouts.admin.admin-app')
@section('style')
	 <link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
@stop
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body kt-padding-t-5" style="position: relative">
				 <ul class="nav nav-tabs kt-margin-t-15 " role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">New Event Requests</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_2">Processing Events</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_3">Active Events</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4">Archive Event</a></li>
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="kt_tabs_1_1" role="tabpanel">
							 <table class="table table-head-noborder table-borderless table-striped" id="new-event-request">
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
						<div class="tab-pane fade" id="kt_tabs_1_2" role="tabpanel">
						
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_3" role="tabpanel">
						
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_4" role="tabpanel">
						
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
         $('.nav-tabs a').on('shown.bs.tab', function (event) {
           
            var current_tab = $(event.target).text();
            // if (current_tab == 'New Event Requests'){   }
            
         });
      });
      
      function newEvent() {
         
         $('table#new-event-request').DataTable({
            ajax: {
               url: '{{ route('admin.event.datatable') }}',
               data: function(d){ d.status = ['new'];  }
            },
            columnDefs:[
               { targets: [0, 3, 4, 5], className: 'no-wrap'}
            ],
            columns: [
               { data: 'reference_number' },
               { data: 'company_name' },
               { data: 'event_name' },
               { data: 'created_at' },
               { data: 'start_date' },
               { data: 'status' }
            ],
            createdRow: function(row, data, index){
               $(row).click(function () { location.href = '{{ url('/event') }}/'+data.event_id+'/application'; });
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

      function activeArtistTable() {
         var active_artist_table = $('table#active-artist').DataTable({
            dom: '<"toolbar-active pull-left"><"toolbar-active-1 pull-left">frt<"pull-left"i>p',
            ajax: {
               url: '{{ route('admin.artist.datatable') }}',
               data: function (d) {
                  d.artist_status = 'active';
               }
            },
            columnDefs: [
               {targets: [0, 1, 4, 5, 6], className: 'no-wrap'},
               {
                  targets:0,
                  orderable: false,
                  checkboxes: {
                     selectRow: true
                  }
               }
            ],
            select: {
               style: 'multi'
            },

            order: [[1, 'asc']],
            columns: [
               {data: 'artist_id'},
               {data: 'person_code'},
               {data: 'name'},
               {data: 'profession'},
               {data: 'nationality'},
               {data: 'mobile_number'},
               {data: 'active_permit'}
            ],
            createdRow: function (row, data, index) {
               $('#active-artist-modal').on('shown.bs.modal', function () {
                  // console.log(123);
               });
               
               $(row).click(function () {
									location.href = '{{ url('/permit/artist/') }}/'+data.artist_id;
               });
            }
         });
        
         $('div.toolbar-active').html('<button type="button" id="btn-active-action" class="btn btn-warning btn-sm kt-font-transform-u">Block Artist</button>');
    
         
         $('button#btn-active-action').click(function () {
              var rows_selected = active_artist_table.column(0).checkboxes.selected();
               if (rows_selected.length > 0) {
               $('#active-artist-alert').addClass('d-none');
               $('#active-artist-modal').modal('show');
               
            } else {
               $('#active-artist-alert').removeClass('d-none');
            }
         });
         
        
      }

      function approvedTable() {
         $('table#artist-permit-approved').DataTable({
            ajax: {
               url: '{{ route('admin.artist_permit.datatable') }}',
               data: function (d) {
                  // d.request_type = $('select[name=request_type][data-type=new_request]').val();
                  // d.permit_status = $('select[name=permit_status][data-type=new_request]').val();
                  // d.permit_status = $('input[name=permit_start]').val();
                  // d.issued_date = filter.getAction();
                  // d.today = filter.getToday();
                  d.status = ['active', 'expired'];
               }
            },
            columnDefs: [
               {targets: '_all', className: 'no-wrap'},
               {targets: 5, sortable: false},
            ],
            columns: [
               {data: 'reference_number'},
               {data: 'permit_number'},
               {data: 'company_name'},
               {data: 'applied_date'},
               {data: 'artist_number'},
               // { data: 'company_type'},
               {data: 'request_type'},
               {data: 'permit_status'},
            ],

            createdRow: function (row, data, index) {
               $(row).click(function () {
                  location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
               });
            }
         });
      }

      function processingTable() {
         $('table#artist-permit-processing').DataTable({
            ajax: {
               url: '{{ route('admin.artist_permit.datatable') }}',
               data: function (d) {
                  d.status = ['approved-unpaid', 'modification request'];
               }
            },
            columnDefs: [
               {targets: [0, 4, 5], className: 'no-wrap'},
               // {targets: , sortable: false},
            ],
            columns: [
               {data: 'reference_number'},
               {data: 'company_name'},
               {data: 'applied_date'},
               {data: 'artist_number'},
               // { data: 'company_type'},
               {data: 'request_type'},
               {data: 'permit_status'},
            ],

            createdRow: function (row, data, index) {
               $(row).click(function () {
                  location.href = '{{ url('/artist_permit') }}/' + data.permit_id;
               });
            }
         });
      }

      function rejectedTable() {
         $('table#artist-permit-rejected').DataTable({
            ajax: {
               url: '{{ route('admin.artist_permit.datatable') }}',
               data: function (d) {
                  // d.request_type = $('select[name=request_type][data-type=new_request]').val();
                  // d.permit_status = $('select[name=permit_status][data-type=new_request]').val();
                  // d.permit_status = $('input[name=permit_start]').val();
                  // d.issued_date = filter.getAction();
                  // d.today = filter.getToday();
                  d.status = ['rejected', 'expired', 'cancelled'];
               }
            },
            columnDefs: [
               {targets: '_all', className: 'no-wrap'},
               {targets: [5], sortable: false}
            ],
            columns: [
               {data: 'reference_number'},
               {data: 'company_name'},
               {data: 'applied_date'},
               {data: 'artist_number'},
               // { data: 'company_type'},
               {data: 'request_type'},
               {data: 'permit_status'},
            ],

            createdRow: function (row, data, index) {
               $(row).click(function () {
                  location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
               });
            }
         });
      }

      function newRequest() {
         var start = moment().subtract(29, 'days');
         var end = moment();

         $('input[name=permit_start]').daterangepicker({
            autoUpdateInput: false,
            buttonClasses: 'btn',
            applyClass: 'btn-warning btn-sm btn-elevate',
            cancelClass: 'btn-secondary btn-sm btn-elevate',
            startDate: start,
            endDate: end,
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
         }, function (start, end, label) {
            $('input[name=permit_start].form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
         });

         $('input[type=checkbox][data-type=new_request][name=today]').click(function () {
            filter.today = $(this).is(':checked') ? $(this).val() : null;
         });

         $('input[type=checkbox][data-type=new_request][name=issued_date]').click(function () {
            filter.action_needed = $(this).is(':checked') ? $(this).val() : null;
         });

         var new_request_form = $('form#new-request-frm');
         new_request_form.submit(function (e) {
            e.preventDefault();
            artistPermit.ajax.reload(null, false);
         });

         new_request_form.find('button[type=reset]').click(function () {
            filter.today = null;
            filter.action_needed = null;
            new_request_form[0].reset();
            artistPermit.ajax.reload(null, false);
         });

         artistPermit = $('table#artist-permit').DataTable({
            ajax: {
               url: '{{ route('admin.artist_permit.datatable') }}',
               data: function (d) {
                  d.request_type = $('select[name=request_type][data-type=new_request]').val();
                  d.permit_status = $('select[name=permit_status][data-type=new_request]').val();
                  // d.permit_status = $('input[name=permit_start]').val();
                  // d.issued_date = filter.getAction();
                  // d.today = filter.getToday();
                  d.status = ['new', 'modified', 'unprocessed', 'processing'];
               }
            },
            columnDefs: [
               {targets: [0, 2, 4, 5], className: 'no-wrap'},
               // {targets: 5, sortable: false}
            ],
            columns: [
               {data: 'reference_number'},
               {data: 'company_name'},
               {data: 'applied_date'},
               {data: 'artist_number'},
               {data: 'request_type'},
               {data: 'permit_status'}
            ],
            createdRow: function (row, data, index) {
               $(row).click(function () {
                  location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
               });
            }
         });
      }
	 </script>
@endsection