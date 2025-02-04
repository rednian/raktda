@extends('layouts.admin.admin-app')
@section('style')
<style> .widget-toolbar { cursor: pointer; } </style>
@endsection
@section('content')
<section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
  <div class="kt-portlet__body">
    <section class="row kt-padding-b-20">
      <div class="col-2">
        <div class="kt-section kt-section--space-sm widget-toolbar">
          <div class="kt-widget24 kt-widget24--solid">
            <div class="kt-widget24__details">
              <div class="kt-widget24__info">
                <span class="kt-widget24__title" title="Click to edit">{{ __('NEW') }}</span>
                <small class="kt-widget24__desc">{{ __('All Request') }}</small>
              </div>
              <span id="new-count" class="kt-widget24__stats kt-font-default">{{ $new_request }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="kt-section kt-section--space-sm widget-toolbar">
          <div class="kt-widget24 kt-widget24--solid">
            <div class="kt-widget24__details">
              <div class="kt-widget24__info">
                <span class="kt-widget24__title" title="Click to edit">{{ __('PENDING') }}</span>
                <small class="kt-widget24__desc">{{ __('All Request') }}</small>
              </div>
              <span id="pending-count" class="kt-widget24__stats kt-font-default">{{ $pending_request }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="kt-section kt-section--space-sm widget-toolbar">
          <div class="kt-widget24 kt-widget24--solid">
            <div class="kt-widget24__details">
              <div class="kt-widget24__info">
                <span class="kt-widget24__title" title="Click to edit">{{ __('CANCELLED') }}</span>
                <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
              </div>
              <span class="kt-widget24__stats kt-font-default">{{ $cancelled_permit }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="kt-section kt-section--space-sm widget-toolbar">
          <div class="kt-widget24 kt-widget24--solid">
            <div class="kt-widget24__details">
              <div class="kt-widget24__info">
                <span class="kt-widget24__title" title="Click to edit">{{ __('REJECTED') }}</span>
                <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
              </div>
              <span class="kt-widget24__stats kt-font-default">{{ $rejected_permit }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="kt-section kt-section--space-sm widget-toolbar">
          <div class="kt-widget24 kt-widget24--solid">
            <div class="kt-widget24__details">
              <div class="kt-widget24__info">
                <span class="kt-widget24__title" title="Click to edit">{{ __('PROCESSING') }}</span>
                <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
              </div>
              <span class="kt-widget24__stats kt-font-default">{{ $processing }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-2">
        <div class="kt-section kt-section--space-sm">
          <div class="kt-widget24 kt-widget24--solid">
            <div class="kt-widget24__details">
              <div class="kt-widget24__info">
                <span class="kt-widget24__title" title="Click to edit">{{ __('COMPLETED') }}</span>
                <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
              </div>
              <span class="kt-widget24__stats kt-font-default">{{ $active_permit }}</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist"
      id="artist-permit-nav">
      <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('New Requests') }}
            <span class="kt-badge kt-badge--outline kt-badge--info">{{ $new_request }}</span>
        </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#pending-request" data-target="#pending-request">{{ __('Pending Requests') }}
            <span class="kt-badge kt-badge--outline kt-badge--info">{{ $pending_request }}</span>
        </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#processing-permit">{{ __('Processing Permits') }}
            <span class="kt-badge kt-badge--outline kt-badge--info">{{ $processing }}</span>
        </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#active-permit">{{ __('Actions') }}
            <span class="kt-badge kt-badge--outline kt-badge--info">{{ $active }}</span>
        </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#archive-permit">{{ __('Artists History') }}
        </a>
    </li>
      <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#active-artist">{{ __('Artist List') }}</a>
        </li>
    </ul>
    <div class="form-row d-none" style="position: absolute; right: -80px; top: 23px; width: 30%">
      <div class="col-12">
        <div class="input-group input-group-sm">
          <div class="kt-input-icon kt-input-icon--right" id="search-application">
            <input name="value" autocomplete="off" type="text" class="form-control form-control-sm typeahead"
              aria-label="Text input with checkbox" placeholder="Search application or artist ...">
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
      </div>
      <div class="tab-pane show fade" id="pending-request" role="tabpanel">
        @include('admin.artist_permit.includes.pending-permit')
      </div>
      <div class="tab-pane fade" id="processing-permit" role="tabpanel">
        @include('admin.artist_permit.includes.processing')
      </div>
      <div class="tab-pane fade" id="active-permit" role="tabpanel">
        @include('admin.artist_permit.includes.approved')
      </div>
      <div class="tab-pane fade" id="archive-permit" role="tabpanel">
        @include('admin.artist_permit.includes.archive')
      </div>
      <div class="tab-pane fade" id="active-artist" role="tabpanel">
        @include('admin.artist_permit.includes.active-artist')
      </div>
      <div class="tab-pane fade kt-hide" id="blocked-artist" role="tabpanel">
        @include('admin.artist_permit.includes.block-artist')
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
  var active_permit_table = {};

  var hash = window.location.hash;

  $(document).ready(function () {
    $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function(){$('.nav-tabs a[href="#new-request"]').tab('show'); });
    $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function(){$('.nav-tabs a[href="#pending-request"]').tab('show');});
    $("#kt_page_portlet > div > section > div:nth-child(3) > div").click(function(){$('.nav-tabs a[href="#archive-permit"]').tab('show');});
    $("#kt_page_portlet > div > section > div:nth-child(4) > div").click(function(){$('.nav-tabs a[href="#archive-permit"]').tab('show');});
    $("#kt_page_portlet > div > section > div:nth-child(5) > div").click(function(){$('.nav-tabs a[href="#processing-permit"]').tab('show');});



    // {
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

    newRequest();
    setInterval(function(){ newRequest(); pendingRequest();}, 100000);

    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });

    $('.nav-tabs a').on('shown.bs.tab', function (event) {
      var current_tab = $(event.target).attr('href');
      if (current_tab == '#new-request' ) {  newRequest(); }
      if (current_tab == '#pending-request' ) { pendingRequest(); }
      if (current_tab == '#processing-permit') { processingTable(); }
      if (current_tab == '#active-permit' ) { approvedTable(); }
      if (current_tab == '#archive-permit') { rejectedTable(); }
      if (current_tab == '#active-artist' ) { activeArtistTable(); }
      if (current_tab == '#blocked-artist') { blockArtistTable(); }
    });
  });


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
        responsive:true,
        columnDefs: [ {targets: '_all', className: 'no-wrap'} ],
        columns: [
           {data: 'active_permit'},
           {data: 'person_code'},
           {data: 'name'},
           {data: 'profession'},
           {data: 'nationality'},
           {data: 'mobile_number'},
           {data: 'artist_status'},
           {data: 'age'},
           {data: 'birthdate'},
        ],
        createdRow: function (row, data, index) {
            $('.btn-show-permit', row).click(function(e){
              e.stopPropagation();
              $('span#artist-name').html(data.name);
                active_permit_table = $('table#active-permit').DataTable({
                  ajax: {
                    url: '{{ url('permit/artist') }}/'+data.artist_id+'/activepermitdatatable'
                  },
                  responsive: true,
                  columnDefs:[{targets:'_all', className: 'no-wrap'}],
                  columns: [
                  {data: 'reference_number'},
                  {data: 'permit_number'},
                  {data: 'name'},
                  {data: 'profession'},
                  {data: 'expired_date'},
                  {data: 'location'},
                  ],
                    createdRow: function(row, data, index){

                      $('table.dataTable.dtr-inline.collapsed', row).click(function(e) { e.stopPropagation(); });

                      $(row).click(function(){ location.href = data.link; });
                    }
                });

            $('#active-artist-modal').modal('show');
            });

            // active_permit_table.responsive.recalc();


           $('td:not(:first-child)' ,row).click(function () { location.href = data.show_link; });

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
        locale:{'customRangeLabel':'{{ __('Custom From & To') }}'},
        ranges: {
          '{{ __('Today') }}': [moment(), moment()],
          '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
          '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
          '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
          '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
            d.status = status != null ? [status] : ['rejected', 'expired', 'cancelled', 'cancelled'];
            d.date = $('#archive-applied-date').val()  ? selected_date : null;
           }
         },
         columnDefs: [
           {targets: '_all', className: 'no-wrap'},
           {targets: [5], sortable: false}
         ],
           responsive: true,
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'location'},
           {data: 'duration'},
           {data: 'artist_number'},
        //    {data: 'request_type'},
           {data: 'permit_status'},
         ],

         createdRow: function (row, data, index) {

            $('td:not(:first-child)', row).click(function(){ location.href = data.show_link; });
         }
       });
       //clear fillte button
       $('#archive-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); archivePermit.draw();});

       archivePermit.page.len($('#archive-length-change').val());
       $('#archive-length-change').change(function(){ archivePermit.page.len( $(this).val() ).draw(); });


       var search = $.fn.dataTable.util.throttle(function(v){ archivePermit.search(v).draw(); }, 500);
       $('input#search-archive-request').keyup(function(){ search($(this).val()); });

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
          locale:{'customRangeLabel':'{{ __('Custom From & To') }}'},
          ranges: {
            '{{ __('Today') }}': [moment(), moment()],
            '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
            '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
            '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
            '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
            responsive:true,
            columnDefs: [
               {targets: '_all', className: 'no-wrap'},
               {targets: 5, sortable: false},
            ],
            columns: [
            //    {render:function(){ return null;}},
               {data: 'action'},
               {data: 'reference_number'},
               {data: 'permit_number'},
               {data: 'company_name'},
               {data: 'approved_date'},
               {data: 'duration'},
               {data: 'artist_number'},
            //    {data: 'request_type'},
               {data: 'location'}
            ],

            createdRow: function (row, data, index) {
                $('table.dataTable.dtr-inline.collapsed', row).click(function(e) { e.stopPropagation(); });

            //   $('td:not(:first-child)',row).click(function(e){ location.href = data.application_link; });
              $('td:not(:first-child)', row).click(function () { location.href = data.show_link; });
              $('.btn-download', row).click(function(e){ e.stopPropagation(); });

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
          locale:{'customRangeLabel':'{{ __('Custom From & To') }}'},
          ranges: {
            '{{ __('Today') }}': [moment(), moment()],
            '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
            '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
            '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
            '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
        }, function (start, end, label) {
          $('input#processing-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }).on('apply.daterangepicker', function(e, d){
         selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
         processingPermit.draw();
        });

         processingPermit = $('table#artist-permit-processing').DataTable({
          {{--  dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",  --}}
            ajax: {
               url: '{{ route('admin.artist_permit.datatable') }}',
               data: function (d) {
                  d.status = ['approved-unpaid', 'modification request', 'processing', 'need approval'];
               }
            },
            columnDefs: [
               {targets: '_all', className: 'no-wrap'},
            ],
            order: [[3, 'desc']],
             responsive:true,
            columns: [
               {data: 'reference_number'},
               {data: 'company_name'},
               {data: 'duration'},
               {data: 'artist_number'},
               // { data: 'company_type'},
               {data: 'updated_at'},
               {data: 'permit_status'},
               //{data: 'request_type'},
            ],

            createdRow: function (row, data, index) {
               $('td:not(:first-child)',row).click(function () {location.href = data.show_link; });
            }
         });

         //clear fillte button
         $('#processing-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); processingPermit.draw();});

         processingPermit.page.len($('#processing-length-change').val());
         $('#processing-length-change').change(function(){ processingPermit.page.len( $(this).val() ).draw(); });

         var search = $.fn.dataTable.util.throttle(function(v){ processingPermit.search(v).draw(); }, 500);
         $('input#search-processing-request').keyup(function(){ search($(this).val()); });
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
         locale:{'customRangeLabel':'{{ __('Custom From & To') }}'},
         ranges: {
           '{{ __('Today') }}': [moment(), moment()],
           '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
           '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
           '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
           '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
             d.term = $('select#pending-permit-term').val();
             d.status =  ['checked', 'modified'];//ADDED BY DONSKIE
             d.date = $('#pending-applied-date').val()  ? selected_date : null;
           }
         },
         columnDefs: [
           {targets: '_all', className: 'no-wrap'},
         ],
         order: [[3, 'asc']],
         responsive: true,
         columns: [
           // {render:function(){return  null;}},
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'artist_number'},
           {data: 'updated_at'},
           {data: 'duration'},
           {data: 'permit_status'},
        //    {data: 'term'},
           {data: 'request_type'},
           {data: 'location'},
           {data: 'has_event'},
           {data: 'event'},
           {data: 'rivision'},
         ],
         createdRow: function (row, data, index) {
           $('td:not(:first-child)',row).click(function () {
             location.href = data.application_link;
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
       locale:{'customRangeLabel':'{{ __('Custom From & To') }}'},
         ranges: {
           '{{ __('Today') }}': [moment(), moment()],
           '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
           '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
           '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
           '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
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
             d.term = $('select#new-permit-term').val();
             d.status = ['new'];
             d.date = $('#new-applied-date').val()  ? selected_date : null;
           }
         },
         responsive: true,
         order: [[ 0, "desc" ]],
         columnDefs: [
           {targets: '_all', className: 'no-wrap'},
         ],
         columns: [
           // {render:function(){ return null;}},
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'artist_number'},
           {data: 'applied_date'},
        //    {data: 'term'},
           {data: 'duration'},
           {data: 'request_type'},
           {data: 'location'},
           {data: 'has_event'},
           {data: 'event'},
           {data: 'rivision'},
         ],
         createdRow: function (row, data, index) {
           $('td:not(:first-child)',row).click(function(e){ location.href = data.application_link; });
         },
         initComplete: function(setting, json){
          $('#new-count').html(json.new_count);
          $('#pending-count').html(json.pending_count);
          $('#cancelled-count').html(json.cancelled_count);
         }
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
