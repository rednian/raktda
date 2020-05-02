@extends('layouts.admin.admin-app')
@section('content')
<section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
    <div class="kt-portlet__body">
        <section class="row">
            <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('NEW') }}</a>
                                <small class="kt-widget24__desc">{{ __('All Request') }}</small>
                            </div>
                            <span id="new-count" class="kt-widget24__stats kt-font-default">{{ $new_company }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('PENDING') }}</a>
                                <small class="kt-widget24__desc">{{ __('All Request') }}</small>
                            </div>
                            <span id="pending-count" class="kt-widget24__stats kt-font-default">{{ $pending }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('BLACKLISTED') }}</a>
                                <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
                            </div>
                            <span id="cancelled-count" class="kt-widget24__stats kt-font-default">{{ $blocked }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('COMPLETED') }}</a>
                                <small class="kt-widget24__desc">{{ __('Last 30 Days') }}</small>
                            </div>
                            <span class="kt-widget24__stats kt-font-default">{{ $approved }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 " role="tablist" id="company-nav">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">
                            {{ __('Registration Requests') }}
                            <span class="kt-badge kt-badge--outline kt-badge--info">{{$new_company}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#bounce-back" data-target="#bounce-back">
                            {{ __('Bounce Back Requests') }}
                            <span class="kt-badge kt-badge--outline kt-badge--info">{{$bounce_back}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#processing-request" data-target="#processing-request">
                            {{ __('Pending Registrations') }}
                            <span class="kt-badge kt-badge--outline kt-badge--info">{{$pending}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#active-company">
                        {{ __('Establishment List') }}
                        </a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="row">
            <div class="col-md-12">
                <div class="tab-content">
                    <section class="tab-pane show fade active" id="new-request" role="tabpanel">
                        <section class="form-row">
                            <div class="col-1">
                                <div>
                       <select name="length_change" id="new-length-change" class="form-control-sm form-control custom-select custom-select-sm">
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
                       {{-- <div class="col-3">
                         <select name="company_id" id="new-company-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="new_company.draw()" >
                           <option selected disabled >{{ __('ESTABLISHMENT TYPE') }}</option>
                          @if ($types->count() >0 )
                            @foreach ($types as $type)
                             <option value="{{$type->company_type_id}}">{{ ucfirst(Auth::user()->LanguageId == 1 ? $type->name_en : $type->name_ar ) }}</option>
                            @endforeach
                          @endif
                         </select>
                       </div> --}}
                       <div class="col-3">
                         <select name="area_id" id="new-company-area" class="form-control-sm form-control custom-select custom-select-sm " onchange="new_company.draw()" >
                           <option selected disabled >{{ __('AREA') }}</option>
                          @if ($areas->count() >0 )
                            @foreach ($areas as $area)
                             <option value="{{$area->id}}">{{ ucfirst(Auth::user()->LanguageId == 1 ? $area->area_en : $area->area_ar ) }}</option>
                            @endforeach
                          @endif
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
                         <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-new-request">
                         <span class="kt-input-icon__icon kt-input-icon__icon--right">
                           <span><i class="la la-search"></i></span>
                         </span>
                       </div>
                     </div>
                   </div>
                </section>
               <table class="table table-hover table-borderless table- border table-striped" id="new-company-request">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('BUSINESS LICENSE EXPIRY DATE') }}</th>
                            <th>{{ __('TRADE LICENSE NUMBER') }}</th>
                            <th>{{ __('SUBMITTED DATE') }}</th>
                            <th>{{ __('REQUEST TYPE') }}</th>
                            <th>{{ __('COMPLETE ADDRESS') }}</th>
                        </tr>
                    </thead>
               </table>
               </section>
               <section  class="tab-pane show fade" id="bounce-back" role="tabpanel">
                {{-- <section class="form-row">
                    <div class="col-1">
                      <div>
                        <select name="length_change" id="bounce-length-change" class="form-control-sm form-control custom-select custom-select-sm">
                            <option value='10'>10</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                            <option value='75'>75</option>
                            <option value='100'>100</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group form-group-sm">
                        <div class="kt-input-icon kt-input-icon--right">
                          <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-bounce-request">
                          <span class="kt-input-icon__icon kt-input-icon__icon--right">
                            <span><i class="la la-search"></i></span>
                          </span>
                        </div>
                      </div>
                    </div>
                 </section> --}}
                <table class="table table-hover table-borderless table- border table-sm table-striped" id="back-table">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('BUSINESS LICENSE EXPIRY DATE') }}</th>
                            <th>{{ __('TRADE LICENSE NUMBER') }}</th>
                            <th>{{ __('SUBMITTED DATE') }}</th>
                            <th>{{ __('REQUEST TYPE') }}</th>
                            <th>{{ __('COMPLETE ADDRESS') }}</th>
                        </tr>
                    </thead>
            </table>
            </section>
                <section  class="tab-pane show fade" id="processing-request" role="tabpanel">
                    <table class="table table-hover table-borderless table- border table-sm table-striped" id="processing-table">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PHONE NUMBER') }}</th>
                            <th>{{ __('EMAIL') }}</th>
                            <th>{{ __('REQUEST TYPE') }}</th>
                            <th>{{ __('STATUS') }}</th>
                            <th>{{ __('COMPLETE ADDRESS') }}</th>
                            <th>{{ __('BUSINESS LICENSE EXPIRY DATE') }}</th>
                            <th>{{ __('BOUNCED BACK REASON') }}</th>
                        </tr>
                    </thead>
                </table>
                </section>
               <section  class="tab-pane show fade" id="active-company" role="tabpanel">
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

                          {{-- <div class="col-3">
                            <select name="" id="active-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="company_table.draw()" >
                              <option selected disabled >{{ __('ESTABLISHMENT TYPE') }}</option>
                              @if ($types->count() >0 )
                                @foreach ($types as $type)
                                 <option value="{{$type->company_type_id}}">{{ ucfirst(Auth::user()->LanguageId == 1 ? $type->name_en : $type->name_ar ) }}</option>
                                @endforeach
                              @endif
                            </select>
                          </div> --}}
                          <div class="col-3">
                            <select  name="" id="active-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="company_table.draw()">
                              <option disabled selected>{{ __('STATUS') }}</option>
                              <option value="active">{{ __('Active') }}</option>
                              <option value="blocked">{{ __('Blocked') }}</option>
                              <option value="Rejected">{{ __('Rejected') }}</option>
                            </select>
                          </div>
                          <div class="col-3">
                         <select name="area_id" id="active-company-area" class="form-control-sm form-control custom-select custom-select-sm " onchange="company_table.draw()" >
                           <option selected disabled >{{ __('AREA') }}</option>
                          @if ($areas = App\Areas::whereHas('company' ,function($q){
                            $q->whereIn('status', ['rejected', 'active', 'blocked']);
                          })->get() )
                            @foreach ($areas as $area)
                             <option value="{{$area->id}}">{{ ucfirst(Auth::user()->LanguageId == 1 ? $area->area_en : $area->area_ar ) }}</option>
                            @endforeach
                          @endif
                         </select>
                       </div>
                          <div class="col-2">
                            <button type="button" class="btn btn-sm btn-secondary" id="active-btn-reset">{{ __('RESET') }}</button>
                          </div>
                        </form>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group form-group-sm">
                          <div class="kt-input-icon kt-input-icon--right">
                            <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-active-request">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
                              <span><i class="la la-search"></i></span>
                            </span>
                          </div>
                        </div>
                      </div>
                  </section>
                  <table class="table table-hover table-borderless table- border table-striped" id="company-table">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PHONE NUMBER') }}</th>
                            <th>{{ __('APPROVED DATE') }}</th>
                            <th>{{ __('EMAIL') }}</th>
                            <th>{{ __('STATUS') }}</th>
                            <th>{{ __('COMPLETE ADDRESS') }}</th>
                            <th>{{ __('APPROVED BY') }}</th>
                            <th>{{ __('BUSINESS LICENSE NUMBER') }}</th>
                            <th>{{ __('BUSINESS LICENSE EXPIRY DATE') }}</th>
                        </tr>
                    </thead>
               </table>
               </section>
            </div>
         </div>
      </section>
   </div>
</section>
@stop
@section('script')
<script>
   var new_company = {};
   var company_table = {};
   var back = {};
   $(document).ready(function(){
    $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function(){$('.nav-tabs a[href="#new-request"]').tab('show'); });
    $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function(){$('.nav-tabs a[href="#bounce-back"]').tab('show'); });
    $("#kt_page_portlet > div > section > div:nth-child(3) > div").click(function(){$('.nav-tabs a[href="#processing-request"]').tab('show'); });
    $("#kt_page_portlet > div > section > div:nth-child(4) > div").click(function(){$('.nav-tabs a[href="#active-company"]').tab('show'); });

      hasUrl()
      newCompany();


      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var current_tab = $(e.target).attr('href');

        if('#new-request' == current_tab ){  newCompany(); }
        if('#processing-request' == current_tab ){ processing();   }
        if('#active-company' == current_tab ){  company(); }
        if('#bounce-back' == current_tab ){  bounceBack(); }
      });

   });

   function processing(){
    company_table =  $('table#processing-table').DataTable({
      // dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
      //       "<'row'<'col-sm-12'tr>>" +
      //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
           url: '{{ route('admin.company.datatable') }}',
           data: function(d){
              // var status =  $('#active-permit-status').val();
              d.status =  ['return'];
              // d.type = $('#active-applicant-type').val();
              // d.area = $('#active-company-area').val();
           }
        },
        responsive: true,
        columnDefs:[
           {targets: '_all', className:'no-wrap'}
        ],
        columns:[
        {data: 'reference_number'},
        {data: 'name'},
        {data: 'phone_number'},
        {data: 'company_email'},
        {data: 'request_type'},
        {data: 'status'},
        {data: 'full_address'},
        {data: 'expired_date'},
        {data: 'reason'},
        ],
        createdRow: function(row, data, index){

           $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
        }
     });
  }



   function company(){
    company_table =  $('table#company-table').DataTable({
      dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
           url: '{{ route('admin.company.datatable') }}',
           data: function(d){
              var status =  $('#active-permit-status').val();
              d.status = status ? [status] : ['blocked', 'active', 'rejected'];
              // d.type = $('#active-applicant-type').val();
              d.area = $('#active-company-area').val();
           }
        },
        'order': [[1, 'desc']],
        responsive: true,
        columnDefs:[
           {targets: '_all', className:'no-wrap'}
        ],
        columns:[
        {data: 'reference_number'},
        {data: 'name'},
        {data: 'phone_number'},
        {data: 'registered_date'},
        {data: 'company_email'},
        {data: 'status'},
        {data: 'full_address'},
        {data: 'registered_by'},
        {data: 'trade_license'},
        {data: 'expired_date'},
        ],
        createdRow: function(row, data, index){

        //    $('td:not(:first-child)',row).click(function(e){ alert() });
           $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
        }
     });


      //clear fillte button
       $('#active-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); company_table.draw();});
      //custom pagelength
      company_table.page.len($('#active-length-change').val());
      $('#active-length-change').change(function(){ company_table.page.len( $(this).val() ).draw(); });
      //custom search

      var search = $.fn.dataTable.util.throttle(function(v){ company_table.search(v).draw(); });
      $('input#search-active-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });

   }

function bounceBack(){

back =  $('table#back-table').DataTable({
    // dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
    //       "<'row'<'col-sm-12'tr>>" +
    //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    ajax: {
       url: '{{ route('admin.company.datatable') }}',
       data: function(d){
          d.status = ['bounce back'];
          // d.type = $('#new-company-type').val();
          d.area = $('#new-company-area').val();
       }
    },
    columnDefs:[
       {targets:'_all', className:'no-wrap'}
    ],
    responsive:true,
    columns:[
    {data: 'reference_number'},
    {data: 'name'},
    {data: 'expired_date'},
    {data: 'trade_license'},
    {data: 'date'},
    {data: 'request_type'},
    {data: 'full_address'},
    ],
    createdRow: function(row, data, index){
       $('td:not(:first-child)', row).click(function(e){ location.href = data.application_link; });
    }
 });

 //clear fillte button
  $('#bounce-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); back.draw();});
 //custom pagelength
 new_company.page.len($('#bounce-length-change').val());
 $('#bounce-length-change').change(function(){ back.page.len( $(this).val() ).draw(); });
 //custom search

 var search = $.fn.dataTable.util.throttle(function(v){ back.search(v).draw(); });
 $('input#search-bounce-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });
}

   function newCompany(){

     new_company =  $('table#new-company-request').DataTable({
         dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
         ajax: {
            url: '{{ route('admin.company.datatable') }}',
            data: function(d){
               d.status = ['new'];
               // d.type = $('#new-company-type').val();
               d.area = $('#new-company-area').val();
            }
         },
         columnDefs:[
            {targets:'_all', className:'no-wrap'}
         ],
         responsive:true,
         columns:[
         {data: 'reference_number'},
         {data: 'name'},
         {data: 'expired_date'},
         {data: 'trade_license'},
         {data: 'date'},
         {data: 'request_type'},
         {data: 'full_address'},
         ],
         createdRow: function(row, data, index){
            $('td:not(:first-child)', row).click(function(e){ location.href = data.application_link; });
         }
      });

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


      //clear fillte button
       $('#new-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); new_company.draw();});
      //custom pagelength
      new_company.page.len($('#new-length-change').val());
      $('#new-length-change').change(function(){ new_company.page.len( $(this).val() ).draw(); });
      //custom search

      var search = $.fn.dataTable.util.throttle(function(v){ new_company.search(v).draw(); });
      $('input#search-new-request').keyup(function(){ if($(this).val() == ''){ } search($(this).val()); });
   }

   function hasUrl(){
     var hash = window.location.hash;
     hash && $('ul.nav a[href="' + hash + '"]').tab('show');
     $('.nav-tabs a').click(function (e) {
       $(this).tab('show');
       var scrollmem = $('body').scrollTop();
       window.location.hash = this.hash;
       $('html,body').scrollTop(scrollmem);
     });
   }

</script>
@stop
