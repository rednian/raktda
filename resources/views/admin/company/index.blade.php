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
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('New') }}</a>
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
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Pending ') }}</a>
                  <small class="kt-widget24__desc">{{ __('All Request') }}</small>
                </div>
                <span id="pending-count" class="kt-widget24__stats kt-font-default">{{ 0 }}</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="kt-section kt-section--space-sm widget-toolbar">
            <div class="kt-widget24 kt-widget24--solid">
              <div class="kt-widget24__details">
                <div class="kt-widget24__info">
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Blacklisted') }}</a>
                  <small class="kt-widget24__desc">{{ __('Last 30 days') }}</small>
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
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Approved ') }}</a>
                  <small class="kt-widget24__desc">{{ __('Last 30 days') }}</small>
                </div>
                <span class="kt-widget24__stats kt-font-default">{{ $approved }}</span>
              </div>
            </div>
          </div>
        </div>
        
        {{-- <div class="col-2">
          <div class="kt-section kt-section--space-sm ">
            <div class="kt-widget24 kt-widget24--solid">
              <div class="kt-widget24__details">
                <div class="kt-widget24__info">
                  <a href="#" class="kt-widget24__title" title="Click to edit">{{ __('Action Taken') }}</a>
                  <small class="kt-widget24__desc">{{ __('Last 30 days') }}</small>
                </div>
                <span class="kt-widget24__stats kt-font-default">{{ 0 }}</span>
              </div>
            </div>
          </div>
        </div> --}}
      </section>
      <section class="row">
         <div class="col-md-12">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 " role="tablist" id="company-nav">
               <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('Company Registration') }}</a></li>
               <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#active-company">{{ __('Active Company') }}</a></li>
               <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#blaclist-company">{{ __('Blacklisted Company') }}</a></li>
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
                       <div class="col-4">
                           <div class="input-group input-group-sm">
                               <div class="kt-input-icon kt-input-icon--right">
                                 <input autocomplete="off" type="text" class="form-control form-control-sm" placeholder="{{ __('APPLIED DATE') }}" id="new-applied-date" >
                                 <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                   <span><i class="la la-calendar"></i></span>
                                 </span>
                               </div>
                         </div>
                       </div>
                       <div class="col-3">
                         <select name="" id="new-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="new_company.draw()" >
                           <option selected disabled >{{ __('ESTABLISHMENT TYPE') }}</option>
                           <option value="private">{{ __('Private') }}</option>
                           <option value="government">{{ __('Government') }}</option>
                           {{-- <option value="individual">{{ __('Individual') }}</option> --}}
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
                            <th>{{ __('PHONE NUMBER') }}</th>
                            <th>{{ __('TYPE') }}</th>
                            <th>{{ __('APPLIED DATE') }}</th>
                            <th>{{ __('STATUS') }}</th>
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
                          <div class="col-4">
                              <div class="input-group input-group-sm">
                                  <div class="kt-input-icon kt-input-icon--right">
                                    <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="{{ __('APPLIED DATE') }}" id="active-applied-date" >
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                      <span><i class="la la-calendar"></i></span>
                                    </span>
                                  </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <select name="" id="new-applicant-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="newEventTable.draw()" >
                              <option selected disabled >{{ __('APPLICATION TYPE') }}</option>
                              <option value="private">{{ __('Private') }}</option>
                              <option value="government">{{ __('Government') }}</option>
                              <option value="individual">{{ __('Individual') }}</option>
                            </select>
                          </div>
                          <div class="col-3">
                            <select  name="" id="new-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="newEventTable.draw()">
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
                            <input autocomplete="off" type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-new-request">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
                              <span><i class="la la-search"></i></span>
                            </span>
                          </div>
                        </div>
                      </div>
                  </section>
                  <table class="table table-hover table-borderless table- border table-striped" id="active-company-table">
                    <thead>
                        <tr>
                            <th>{{ __('REFERENCE NO.') }}</th>
                            <th>{{ __('ESTABLISHMENT NAME') }}</th>
                            <th>{{ __('PHONE NUMBER') }}</th>
                            <th>{{ __('TYPE') }}</th>
                            <th>{{ __('APPLIED DATE') }}</th>
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
   $(document).ready(function(){
      hasUrl()
      newCompany();
   });
   
   function newCompany(){

     new_company=  $('table#new-company-request').DataTable({
         dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
         ajax: {
            url: '{{ route('admin.company.datatable') }}',
            data: function(d){
               d.status = ['new', 'pending'];
               d.type = $('#new-applicant-type').val();
            }
         },
         columnDefs:[
            {targets:[0, 4, 5], className:'no-wrap'}
         ],
         columns:[
         {data: 'reference_number'},
         {data: 'name'},
         {data: 'phone_number'},
         {data: 'type'},
         {data: 'date'},
         {data: 'status'},
         ],
         createdRow: function(row, data, index){
            $(row).click(function(e){
               location.href = '{{ url('/company_registration') }}/'+data.company_id+'/application';
            });
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