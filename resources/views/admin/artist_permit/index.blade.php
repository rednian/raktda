@extends('layouts.admin.admin-app')
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body kt-padding-t-5" style="position: relative">
				 <ul class="nav nav-tabs kt-margin-t-15 " role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">New Request Permits</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_2">Processing Permits</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_3">Active Permits</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4">Archive Permits</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tabs_1_5">Active Artists</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tabs_1_6">Blocked Artists</a></li>
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="kt_tabs_1_1" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @include('admin.artist_permit.includes.new_request')
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_2" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @include('admin.artist_permit.includes.processing')
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_3" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @include('admin.artist_permit.includes.approved')
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_4" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @include('admin.artist_permit.includes.archive')
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_5" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @include('admin.artist_permit.includes.active-artist')
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_6" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @include('admin.artist_permit.includes.block-artist')
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
         newRequest();
         $('.nav-tabs a').on('shown.bs.tab', function (event) {
            var current_tab = $(event.target).text();
            if (current_tab == 'Processing Permits') {
               processingTable();
            }
            if (current_tab == 'Active Permits') {
               approvedTable();
            }
            if (current_tab == 'Archive Permits') {
               rejectedTable();
            }
            if (current_tab == 'Active Artists') {
               activeArtistTable();
            }
            if (current_tab == 'Blocked Artists') {
               blockArtistTable();
            }
            var y = $(event.relatedTarget).text();  // previous tab
         });
      });

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
            dom: '<"toolbar-active pull-left">frt<"pull-left"i>p',
            ajax: {
               url: '{{ route('admin.artist.datatable') }}',
               data: function (d) {
                  d.artist_status = 'active';
               }
            },
            columnDefs: [
               {targets: [0, 1, 4, 5, 6], className: 'no-wrap'},
               {
                  targets: 1,
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
            },
         });
         $('#active-artist-toolbar').find('button').click(function () {
            var rows_selected = active_artist_table.column(0).checkboxes.selected();
            
            
            if (rows_selected.length > 0) {
               $('#active-artist-alert').addClass('d-none');
               $('#active-artist-modal').modal('show');
               
            } else {
               $('#active-artist-alert').removeClass('d-none');
            }
         });
         $('div.toolbar-active').html($('#active-artist-toolbar'));
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
               {targets: '_all', className: 'no-wrap'},
               {targets: 5, sortable: false},
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
                  d.status = ['rejected', 'expired'];
               }
            },
            columnDefs: [
               {targets: '_all', className: 'no-wrap'},
               {targets: 5, sortable: false}
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
                  d.status = ['new', 'modified', 'unprocessed'];
               }
            },
            columnDefs: [
               {targets: [0, 2, 4, 5], className: 'no-wrap'},
               {targets: 5, sortable: false}
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