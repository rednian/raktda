@extends('layouts.admin.admin-app')
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body kt-padding-t-5" style="position: relative">
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 " role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('New Request Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#processing-permit">{{ __('Processing Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#active-permit">{{ __('Active Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#archive-permit">{{ __('Archive Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#active-artist">{{ __('Active Artists') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#blocked-artist">{{ __('Blocked Artists') }}</a></li>
				 </ul>
      
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="new-request" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
									@include('admin.artist_permit.includes.new_request')
							 @else
									@empty()
										 No New Request Permit
									@endempty
							 @endif
						</div>
						<div class="tab-pane fade" id="processing-permit" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @if(\App\Permit::whereIn('permit_status', ['approved-unpaid', 'modification request', 'processing', 'need approval'])->count() > 0)
									@include('admin.artist_permit.includes.processing')
							 @else
									@empty()
										 No on Proccess permit
									@endempty
							 @endif
						</div>
						<div class="tab-pane fade" id="active-permit" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @if(\App\Permit::whereIn('permit_status', ['active'])->count() > 0)
									@include('admin.artist_permit.includes.approved')
							 @else
									@empty()
										 No Active permit
									@endempty
							 @endif
						</div>
						<div class="tab-pane fade" id="archive-permit" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @if(\App\Permit::whereIn('permit_status', ['rejected', 'expired'])->count() > 0)
									@include('admin.artist_permit.includes.archive')
							 @else
									@empty()
										 No Expired or Rejected permit
									@endempty
							 @endif
						</div>
						<div class="tab-pane fade" id="active-artist" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							 @if(\App\Artist::where('artist_status', 'active')->count() > 0)
									@include('admin.artist_permit.includes.active-artist')
							 @else
									@empty()
										 Active artist is empty
									@endempty
							 @endif
						</div>
						<div class="tab-pane fade" id="blocked-artist" role="tabpanel">
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

     window.artistPermit = {};
     var active_artist_table;
     var filter = {
       today: null,
       action_needed: null,
       getAction: function () { return this.action_needed; },
       getToday: function () { return this.today; }
     };

       var hash = window.location.hash;

     $(document).ready(function () {

        newRequest();
         hash && $('ul.nav a[href="' + hash + '"]').tab('show');
         $('.nav-tabs a').click(function (e) {
             $(this).tab('show');
             var scrollmem = $('body').scrollTop();
             window.location.hash = this.hash;
             $('html,body').scrollTop(scrollmem);
           });

       $('.nav-tabs a').on('shown.bs.tab', function (event) {
         var current_tab = $(event.target).attr('href');

         if (current_tab == '#processing-permit' && !$.fn.dataTable.isDataTable('table#artist-permit-processing')) { processingTable(); }
         if (current_tab == '#active-permit' && !$.fn.dataTable.isDataTable('table#artist-permit-approved')) { approvedTable(); }
         if (current_tab == '#archive-permit' && !$.fn.dataTable.isDataTable('table#artist-permit-rejected')) { rejectedTable(); }
         if (current_tab == '#active-artist' && !$.fn.dataTable.isDataTable('table#active-artist')) { activeArtistTable(); }
         if (current_tab == '#blocked-artist' && !$.fn.dataTable.isDataTable('table#block-artist')) { blockArtistTable(); }
       });

     });

      function blockArtistTable() {

          $('button#unblock-artist-button').click(function () {

                  var rows_selected = block_artist_table.column(0).checkboxes.selected();

              artist_id=[]
              $.each(rows_selected, function(index, rowId) {
                  artist_id.push(rowId);
              })
              if(artist_id.length>0){
                  $.ajax({
                      type: 'post',
                      url: " {{route('admin.checked_list')}}",
                      data: {id:artist_id},
                      success: function (data) {
                          var html=$('#unblock_checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>')
                          $.each(data, function(key,val) {
                              var value=key+1;
                              $(html).append( '<tr><td>'+value+'</td><td>' +val.firstname_en + ' '+  val.lastname_en + '</td><td>'+val.person_code+'</td></tr>' );
                          });
                      }
                  });

              }

                  if (rows_selected.length > 0) {
                      $('#block_artist_number').html(rows_selected.length+'  Artist Seleted').css({'color':'green'})

                      $('#block-artist-alert').addClass('d-none');
                      $('#block-artist-modal').modal('show');

                      $('#unblock_artist').click('submit', function(e) {
                          e.preventDefault();
                          artist_id=[]
                          $.each(rows_selected, function(index, rowId) {
                              artist_id.push(rowId);
                          })

                          var remarks=$('#unblock_comment').val();
                          if(artist_id.length>0){
                              $.ajax({
                                  type: 'post',
                                  url: " {{route('admin.artist_unblock')}}",
                                  data: {id:artist_id,remarks},
                                  success: function (data) {
                                      $("#delete-ajax-alert").show(500).css({ 'background-color': '#fff2f2','color': 'red','padding': '9px','border-radius': '7px','text-align': 'center'});
                                      setTimeout(function() { $("#delete-ajax-alert").hide();
                                          $('#block-artist-modal').modal('hide');
                                      },2000);
                                      $('table#block-artist').DataTable().ajax.reload(null, false);
                                      ;
                                  }
                              });
                          }
                      })
                  } else {
                      $('#active-artist-alert').removeClass('d-none');
                  }
          });


        block_artist_table=  $('table#block-artist').DataTable({
            ajax: {
               url: '{{ route('admin.artist.datatable') }}',
               data: function (d) {
                  d.artist_status = 'blocked';
               }
            },
            columnDefs: [
               {targets: [0, 4, 5, 6], className: 'no-wrap'},
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

            columns : [
               {data: 'artist_id'},
               {data: 'person_code'},
               {data: 'name'},
               {data: 'profession'},
               {data: 'nationality'},
               {data: 'mobile_number'},
               {data: 'active_permit'},
            ],
            createdRow: function (row, data, index) {
            }
         });
      }
      function activeArtistTable() {

         active_artist_table = $('table#active-artist').DataTable({
          dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
               {data: 'active_permit'},
            ],
            createdRow: function (row, data, index) {
               $('#active-artist-modal').on('shown.bs.modal', function () {
               });

               $(row).click(function () {
									location.href = '{{url('/permit/artist/')}}/'+data.artist_id+'?tab='+hash;
            });

              }
         });


         $('div.toolbar-active').html('<button type="button" id="btn-active-action" class="btn btn-warning btn-sm kt-font-transform-u">Block Artist</button>');
         $('div.toolbar-active-1').html($('#active-profession-container'));
         $('div.toolbar-active-2').html($('#active-nationality-container'));

         $('button#btn-active-action').click(function () {
              var rows_selected = active_artist_table.column(0).checkboxes.selected();
             artist_id=[]
             $.each(rows_selected, function(index, rowId) {
                 artist_id.push(rowId);
             })
             if(artist_id.length>0){
                 $.ajax({
                     type: 'post',
                     url: " {{route('admin.checked_list')}}",
                     data: {id:artist_id},
                     success: function (data) {
                       var html=$('#checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>')
                         $.each(data, function(key,val) {
                            var value=key+1;
                             $(html).append( '<tr><td>'+value+'</td><td>' +val.firstname_en + ' '+  val.lastname_en + '</td><td>'+val.person_code+'</td></tr>' );
                         });
                     }
                 });

             }
               if (rows_selected.length > 0) {
               $('#active-artist-alert').addClass('d-none');
               $('#active-artist-modal').modal('show');

                   $('#block_artist').click('submit', function(e) {
                           e.preventDefault();
                            artist_id=[]
                           $.each(rows_selected, function(index, rowId) {
                               artist_id.push(rowId);
                           })
                              if(artist_id.length>0){

                                var remarks=$('#comment').val();
                                  $.ajax({
                                      type: 'post',
                                      url: " {{route('admin.artist_block')}}",
                                      data: {id:artist_id,remarks},
                                      success: function (data) {
                                                  $("#ajax-alert").show(500).css({ 'background-color': '#fff2f2','color': 'red','padding': '9px','border-radius': '7px','text-align': 'center'});
                                                  setTimeout(function() { $("#ajax-alert").hide();
                                                  $('#active-artist-modal').modal('hide');
                                                   },2000);
                                                  $('table#active-artist').DataTable().ajax.reload(null, false);
                                          ;
                                      }
                                  });

                              }
                       })
            } else {
               $('#active-artist-alert').removeClass('d-none');
            }
         });
      }


      function approvedTable() {
         $('table#artist-permit-approved').DataTable({
            ajax: {
               url: '{{ route('admin.artist_permit.datatable')}}',
               data: function (d) {
                  d.status = ['active'];
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
               {data: 'request_type'},
               {data: 'action'},
            ],

            createdRow: function (row, data, index) {
              $(row).click(function () {
                 location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#active-permit';
              });
            }
         });
      }

      function processingTable() {
         $('table#artist-permit-processing').DataTable({
          dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
               url: '{{ route('admin.artist_permit.datatable') }}',
               data: function (d) {
                  d.status = ['approved-unpaid', 'modification request', 'processing', 'need approval'];
               }
            },
            columnDefs: [
               {targets: [0, 4, 5], className: 'no-wrap'},
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
                  location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#processing-permit';
               });
            }
         });
      }

   

     function rejectedTable() {
       $('table#artist-permit-rejected').DataTable({
         ajax: {
           url: '{{ route('admin.artist_permit.datatable') }}',
           data: function (d) {
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
           {data: 'request_type'},
           {data: 'permit_status'},
         ],

         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/artist_permit') }}/' + data.permit_id+'?tab=#archive-permit';
           });
         }
       });
     }
        
    var new_selected_date = [];

     function newRequest() {

       var start = moment().subtract(29, 'days');
       var end = moment();

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
        new_selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
        artistPermit.draw();
       });

       $('#new-btn-reset').click(function(){
          $('input[name=today]').removeAttr('checked');
       });

   


       artistPermit = $('table#artist-permit').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.artist_permit.datatable') }}',
          data: function (d) {
             var status = $('select#new-permit-status').val();
             d.request_type = $('select#new-request-type').val();
             d.status = status != null ? [status] : ['new', 'modified'];
             d.date = $('#new-applied-date').val()  ? new_selected_date : null; 
           }
         },
         columnDefs: [
           {targets: [0, 2, 4, 5], className: 'no-wrap'},
           // {targets: 5, sortable: false}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'artist_number'},
           {data: 'applied_date'},
           {data: 'request_type'},
           {data: 'permit_status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
           });
         },
       });

       
       artistPermit.page.len($('#new-length-change').val());
       $('#new-length-change').change(function(){
         artistPermit.page.len( $(this).val() ).draw();
       });


       var search = $.fn.dataTable.util.throttle(function(v){
        artistPermit.search(v).draw();
       }, 500);

       $('input#search-new-request').keyup(function(){
          search($(this).val());
       });


     }
	 </script>

@endsection
