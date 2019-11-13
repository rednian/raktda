@extends('layouts.admin.admin-app')
@section('style')
<style>
  .widget-toolbar{ cursor: pointer; }
</style>
{{-- <style>
  .twitter-typeahead {
    display: inline !important;
}

.typeahead-content {
    box-shadow: 0 1px 2px rgba(0,0,0,.26);
    background-color: #fff;
    cursor: pointer;
    margin-top: -15px;
    min-width: 100px;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    position: absolute;
    white-space: nowrap;
    z-index: 1001;
    will-change: width,height;
}

.typeahead-highlight {
    font-weight: 900;
}

.typeahead-suggestion {
    padding: 5px 0px 10px 10px;
}

.typeahead-suggestion:hover {
    background-color: #42A5F5;
    color: #FFF;
}

.typeahead-notfound {
    cursor:not-allowed;
    padding: 5px 0px 10px 10px;
}
</style> --}}
@endsection
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body">
        <section class="row kt-padding-b-20">
          <div class="col-4">
            <div class="kt-section kt-section--space-sm widget-toolbar">
              <div class="kt-widget24 kt-widget24--solid">
                <div class="kt-widget24__details">
                  <div class="kt-widget24__info">
                    <span class="kt-widget24__title" title="Click to edit">{{ __('New Request') }}</span>
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
                    <span class="kt-widget24__title" title="Click to edit">{{ __('Pending Request') }}</span>
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
            <div class="kt-section kt-section--space-sm">
              <div class="kt-widget24 kt-widget24--solid">
                <div class="kt-widget24__details">
                  <div class="kt-widget24__info">
                    <span class="kt-widget24__title" title="Click to edit">{{ __('Action Taken') }}</span>
                    <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
                  </div>
                  <span class="kt-widget24__stats kt-font-default">{{ $active_permit }}</span>
                </div>
                <!-- <div class="progress progress--sm">
                  <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
              </div>
            </div>
          </div>
        </section>
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('New Request Permits') }}</a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending-request" data-target="#pending-request">{{ __('Pending Request Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#processing-permit">{{ __('Processing Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#active-permit">{{ __('Active Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#archive-permit">{{ __('Archive Permits') }}</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#active-artist">{{ __('Artist List') }}</a></li>
						{{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#blocked-artist">{{ __('Blocked Artists') }}</a></li> --}}
				 </ul>
          <div class="form-row d-none" style="position: absolute; right: -80px; top: 23px; width: 30%">
            <div class="col-12">
                <div class="input-group input-group-sm">
                    <div class="kt-input-icon kt-input-icon--right" id="search-application">
                      <input name="value" autocomplete="off" type="text" class="form-control form-control-sm typeahead" aria-label="Text input with checkbox" placeholder="Search application or artist ...">
                      <span class="kt-input-icon__icon kt-input-icon__icon--right">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
              </div>
            </div>
          </div>
        
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="new-request" role="tabpanel">
									@include('admin.artist_permit.includes.new_request')
							{{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
							 @else
									@empty()
										 No New Request Permit
									@endempty
							 @endif --}}
						</div>
            <div class="tab-pane show fade" id="pending-request" role="tabpanel">
               {{-- @include('admin.artist_permit.includes.summary') --}}
                  @include('admin.artist_permit.includes.pending-permit')
              {{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
               @else
                  @empty()
                     No New Request Permit
                  @endempty
               @endif --}}
            </div>
						<div class="tab-pane fade" id="processing-permit" role="tabpanel">
							 {{-- @include('admin.artist_permit.includes.summary') --}}
									@include('admin.artist_permit.includes.processing')
							{{--  @if(\App\Permit::whereIn('permit_status', ['approved-unpaid', 'modification request', 'processing', 'need approval'])->count() > 0)
							 @else
									@empty()
										 No on Proccess permit
									@endempty
							 @endif --}}
						</div>
						<div class="tab-pane fade" id="active-permit" role="tabpanel">
							 {{-- @include('admin.artist_permit.includes.summary') --}}
									@include('admin.artist_permit.includes.approved')
							{{--  @if(\App\Permit::whereIn('permit_status', ['active'])->count() > 0)
							 @else
									@empty()
										 No Active permit
									@endempty
							 @endif --}}
						</div>
						<div class="tab-pane fade" id="archive-permit" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
									@include('admin.artist_permit.includes.archive')
							{{--  @if(\App\Permit::whereIn('permit_status', ['rejected', 'expired'])->count() > 0)
							 @else
									@empty()
										 No Expired or Rejected permit
									@endempty
							 @endif --}}
						</div>
						<div class="tab-pane fade" id="active-artist" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
									@include('admin.artist_permit.includes.active-artist')
							{{--  @if(\App\Artist::where('artist_status', 'active')->count() > 0)
							 @else
									@empty()
										 Active artist is empty
									@endempty
							 @endif --}}
						</div>
						<div class="tab-pane fade kt-hide" id="blocked-artist" role="tabpanel">
							 @include('admin.artist_permit.includes.summary')
							@include('admin.artist_permit.includes.block-artist')
							 {{-- @if(\App\Artist::where('artist_status', 'blocked')->count() > 0)
							 @else
									@empty()
										 Blocked artist is empty
									@endempty
							 @endif --}}
						</div>
				 </div>
			</div>
	 </section>
@endsection
@section('script')
<script type="text/javascript">

  var artistPermit = {};
  var pendingPermit = {};
  var processingPermit = {};
  var activePermit = {};
  var archivePermit = {};
  var active_artist_table = {};

  var hash = window.location.hash;

  $(document).ready(function () {
    $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function(){
       $('.nav-tabs a[href="#new-request"]').tab('show');
    });
    $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function(){
     $('.nav-tabs a[href="#pending-request"]').tab('show');
    });
    //   $("#kt_page_portlet > div > section > div:nth-child(3) > div").click(function(){
    //  $('.nav-tabs a[href="#new-request"]').tab('show');
    // });
    // Instantiate the Bloodhound suggestion engine
    var result = new Bloodhound({
      datumTokenizer: function(datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
      },
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
        wildcard: '%QUERY',
        url: '{{ route('admin.artist_permit.search') }}?q=%QUERY',
        transform: function(response) {
          console.log(response);
          // Map the remote source JSON array to a JavaScript object array
          return $.map(response.reference_number, function(data) {
            return {
              value: data.result
            };
          });
        }
      }
    });

    // Instantiate the Typeahead UI
    $('.typeahead').typeahead(null, {
      hint: true,
      highlight: true,
      minLength: 1,
      display: 'value',
      source: result,
     templates: {
        empty: [
          '<div class="empty-message">',
            'unable to find any Best Picture winners that match the current query',
          '</div>'
        ].join('\n'),
        suggestion: Handlebars.compile('<div><strong>@{{value}}</strong> – @{{year}}</div>')
      }
    });


    // var bestPictures = new Bloodhound({
    //   datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
    //   queryTokenizer: Bloodhound.tokenizers.whitespace,
    //   // prefetch: '../data/films/post_1960.json',
    //   remote: {
    //     url: '{{ route('admin.artist_permit.search') }}',
    //     // wildcard: '%QUERY'
    //   }
    // });

    // $('#search-application .typeahead').typeahead(null, {
    //   name: 'best-pictures',
    //   display: 'value',
    //   source: bestPictures
    // });



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
      if (current_tab == '#pending-request' ) { pendingRequest(); }
      if (current_tab == '#processing-permit') { processingTable(); }
      if (current_tab == '#active-permit' ) { approvedTable(); }
      if (current_tab == '#archive-permit') { rejectedTable(); }
      if (current_tab == '#active-artist' ) { activeArtistTable(); }
      if (current_tab == '#blocked-artist') { blockArtistTable(); }
    });
  });

  function blockArtistTable() {
    $('button#unblock-artist-button').click(function () {

      var rows_selected = block_artist_table.column(0).checkboxes.selected();
      artist_id=[]
      $.each(rows_selected, function(index, rowId) { artist_id.push(rowId); })
      if(artist_id.length>0){
        $.ajax({
          type: 'post',
          url: " {{route('admin.checked_list')}}",
          data: {id:artist_id},
          success: function (data) {
            var html=$('#unblock_checked_list').html('<tr><th>Sn</th><th>Name</th><th>Person Code</th></tr>');
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
          dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
                  d.artist_status = $('#artist-permit-status').val();
                  d.profession_id = $('select[name=profession_id]').val();
                  d.country_id = $('select[name=country_id]').val();
               }
            },
            columnDefs: [
               {targets: [0, 1, 4, 5], className: 'no-wrap'},
            //    {
            //       targets:0,
            //       orderable: false,
            //       checkboxes: {
            //          selectRow: true
            //       }
            //    }
            ],
            // select: {
            //    style: 'multi'
            // },
            // order: [[1, 'asc']],
            columns: [
                // {data: 'artist_id'},
               {data: 'person_code'},
               {data: 'name'},
               {data: 'profession'},
               {data: 'nationality'},
               {data: 'mobile_number'},
               {data: 'active_permit'},
               {data: 'artist_status'},
            ],
            createdRow: function (row, data, index) {
               $('#active-artist-modal').on('shown.bs.modal', function () {
               });

               $(row).click(function () {
									location.href = '{{url('/permit/artist/')}}/'+data.artist_id+'?tab='+hash;
            });

              }
         });


         //clear fillte button
         $('#artist-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); active_artist_table.draw();});

         active_artist_table.page.len($('#artist-length-change').val());
         $('#artist-length-change').change(function(){ active_artist_table.page.len( $(this).val() ).draw(); });

         var search = $.fn.dataTable.util.throttle(function(v){ active_artist_table.search(v).draw(); }, 500);
         $('input#search-artist-request').keyup(function(){ search($(this).val()); });


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
        
        var start = moment().subtract(29, 'days');
        var end = moment();
        var selected_date = [];

        $('input#active-applied-date').daterangepicker({
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
          $('input#active-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }).on('apply.daterangepicker', function(e, d){
         new_selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
         activePermit.draw();
        });

        activePermit = $('table#artist-permit-approved').DataTable({
          dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
               url: '{{ route('admin.artist_permit.datatable')}}',
               data: function (d) {
                  d.status = ['active'];
               }
            },
            columnDefs: [
               {targets: [0, 6], className: 'no-wrap'},
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

        //clear fillte button
        $('#active-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); activePermit.draw();});

        activePermit.page.len($('#acive-length-change').val());
        $('#active-length-change').change(function(){ activePermit.page.len( $(this).val() ).draw(); });

        var search = $.fn.dataTable.util.throttle(function(v){ activePermit.search(v).draw(); }, 500);
        $('input#search-active-request').keyup(function(){ search($(this).val()); });
      }

      function processingTable() {
        var start = moment().subtract(29, 'days');
        var end = moment();
        var selected_date = [];

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
         selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
         processingPermit.draw();
        });

         processingPermit = $('table#artist-permit-processing').DataTable({
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

         //clear fillte button
         $('#processing-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); processingPermit.draw();});

         processingPermit.page.len($('#processing-length-change').val());
         $('#processing-length-change').change(function(){ processingPermit.page.len( $(this).val() ).draw(); });

         var search = $.fn.dataTable.util.throttle(function(v){ processingPermit.search(v).draw(); }, 500);
         $('input#search-processing-request').keyup(function(){ search($(this).val()); });
      }

   

     function rejectedTable() {
      
      var start = moment().subtract(29, 'days');
      var end = moment();
      var selected_date = [];

      $('input#archive-applied-date').daterangepicker({
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
        $('input#archive-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
      }).on('apply.daterangepicker', function(e, d){
       selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
       archivePermit.draw();
      });

       archivePermit = $('table#artist-permit-rejected').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
         ajax: {
           url: '{{ route('admin.artist_permit.datatable') }}',
           data: function (d) {

            var status = $('select#archive-permit-status').val();
            d.request_type = $('select#archive-request-type').val();
            d.status = status != null ? [status] : ['rejected', 'expired', 'unprocessed'];
            d.date = $('#archive-applied-date').val()  ? selected_date : null;
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
       //clear fillte button
       $('#archive-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); archivePermit.draw();});

       archivePermit.page.len($('#archive-length-change').val());
       $('#archive-length-change').change(function(){ archivePermit.page.len( $(this).val() ).draw(); });


       var search = $.fn.dataTable.util.throttle(function(v){ archivePermit.search(v).draw(); }, 500);
       $('input#search-archive-request').keyup(function(){ search($(this).val()); });

     }

     function pendingRequest() {

       var start = moment().subtract(29, 'days');
       var end = moment();
       var selected_date = [];

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
        pendingPermit.draw();
       });


       pendingPermit = $('table#pending-permit').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.artist_permit.datatable') }}',
          data: function (d) {
             // var status = $('select#pending-permit-status').val();
             d.request_type = $('select#pending-request-type').val();
             d.status =  ['modified'];
             d.date = $('#pending-applied-date').val()  ? selected_date : null; 
           }
         },
         columnDefs: [
           {targets: [0, 2, 4, 5], className: 'no-wrap'},
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

       //clear fillte button
       $('#pending-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); pendingPermit.draw();});

       pendingPermit.page.len($('#pending-length-change').val());
       $('#pending-length-change').change(function(){ pendingPermit.page.len( $(this).val() ).draw(); });

       var search = $.fn.dataTable.util.throttle(function(v){ pendingPermit.search(v).draw(); }, 500);
       $('input#search-pending-request').keyup(function(){ search($(this).val()); });
     }
        
     function newRequest() {

       var start = moment().subtract(29, 'days');
       var end = moment();
       var selected_date = [];

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
        artistPermit.draw();
       });


       artistPermit = $('table#artist-permit').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.artist_permit.datatable') }}',
          data: function (d) {
             // var status = $('select#new-permit-status').val();
             d.request_type = $('select#new-request-type').val();
             d.status = ['new'];
             d.date = $('#new-applied-date').val()  ? selected_date : null; 
           }
         },
         // order: [[ 3, "desc" ]],
         columnDefs: [
           {targets: [0, 2, 4, 5], className: 'no-wrap'},
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

       //clear fillte button
       $('#new-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); artistPermit.draw();});

       artistPermit.page.len($('#new-length-change').val());
       $('#new-length-change').change(function(){ artistPermit.page.len( $(this).val() ).draw(); });

       var search = $.fn.dataTable.util.throttle(function(v){ artistPermit.search(v).draw(); }, 500);
       $('input#search-new-request').keyup(function(){ search($(this).val()); });
     }
</script>
@endsection
