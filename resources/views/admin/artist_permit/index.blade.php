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
               @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
                  		 @include('admin.artist_permit.includes.new_request')
                  @else
                  @empty()
                     No New Request Permit as of Today <span class="kt-font-bold">{{ date('d-M-Y h:m a') }}</span>
                  @endempty
               @endif
					
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_2" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
                  @if(\App\Permit::whereIn('permit_status', ['approved-unpaid', 'modification request'])->count() > 0)
                      @include('admin.artist_permit.includes.processing')
                      @else
                  @empty()
                     No on Proccess permit
                  @endempty
               @endif
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_3" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
                 @if(\App\Permit::whereIn('permit_status', ['active'])->count() > 0)
                      @include('admin.artist_permit.includes.approved')
                      @else
                  @empty()
                     No Active permit
                  @endempty
               @endif
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_4" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
                  @if(\App\Permit::whereIn('permit_status', ['rejected', 'expired'])->count() > 0)
                    @include('admin.artist_permit.includes.archive')
                      @else
                  @empty()
                     No Expired or Rejected permit
                  @endempty
               @endif
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_5" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
               @if(\App\Artist::where('artist_status', 'active')->count() > 0)
							    @include('admin.artist_permit.includes.active-artist')
                  @else
                  @empty()
                     Active artist is empty
                  @endempty
               @endif
						</div>
						<div class="tab-pane fade" id="kt_tabs_1_6" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
                  @if(\App\Artist::where('artist_status', 'blocked')->count() > 0)
							   @include('admin.artist_permit.includes.block-artist')
                  @else
                   @empty()
                        Blocked artist is empty
                     @endempty
               @endif
						</div>
				 </div>
			</div>
	 </section>
@endsection
@section('script')
	 <script type="text/javascript">
      var artistPermit = {};
        var active_artist_table;
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
            if (current_tab == 'Processing Permits' && !$.fn.dataTable.isDataTable('table#artist-permit-processing')) { processingTable(); }
            if (current_tab == 'Active Permits' && !$.fn.dataTable.isDataTable('table#artist-permit-approved') ) { approvedTable();}
            if (current_tab == 'Archive Permits' && !$.fn.dataTable.isDataTable('table#artist-permit-rejected') ) { rejectedTable();}
            if (current_tab == 'Active Artists' && !$.fn.dataTable.isDataTable('table#active-artist')) {  activeArtistTable(); }
            if (current_tab == 'Blocked Artists' && !$.fn.dataTable.isDataTable('table#block-artist')) {  blockArtistTable(); }
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
         active_artist_table = $('table#active-artist').DataTable({
            dom: '<"toolbar-active pull-left"><"toolbar-active-1 pull-left"><"toolbar-active-2 pull-left">frt<"pull-left"i>p',
            ajax: {
               url: '{{ route('admin.artist.datatable') }}',
               data: function (d) {
                  d.artist_status = 'active';
                  d.profession_id = $('select[name=profession_id]').val();
                  d.country_id = $('select[name=country_id]').val();
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
        
         $('div.toolbar-active').html('<button type="button" id="btn-active-action" class="btn btn-warning kt-font-transform-u">Block Artist</button>');
         $('div.toolbar-active-1').html($('#active-profession-container'));
         $('div.toolbar-active-2').html($('#active-nationality-container'));
         
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