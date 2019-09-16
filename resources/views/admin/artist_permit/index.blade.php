@extends('layouts.admin.admin-app')
@section('content')
<section  class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
  <div class="kt-portlet__head kt-portlet__head--noborder">
    <div class="kt-portlet__head-label">
      <ul class="nav nav-pills kt-margin-t-15 " role="tablist ">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">New Request Permits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#kt_tabs_1_2">Processing Permits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " data-toggle="tab" href="#kt_tabs_1_3">Rejected Permits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4">Approved Permits</a>
        </li>

      </ul>
    </div>
    {{-- <div class="kt-portlet__head-toolbar">
      <div class="kt-input-icon kt-input-icon--right">
        <input type="text" class="form-control-sm form-control kt-input" placeholder="Search...">
        <span class="kt-input-icon__icon kt-input-icon__icon--right">
          <span><i class="la la-search"></i></span>
        </span>
      </div>
    </div> --}}
    </div>
   <div class="kt-portlet__body kt-padding-t-5">
    <div class="tab-content">
      <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
        <section class="row kt-padding-b-20">
          <div class="col-4">
            <div class="kt-section kt-section--space-sm">
                <div class="kt-widget24 kt-widget24--solid">
                  <div class="kt-widget24__details">
                    <div class="kt-widget24__info">
                      <a href="#" class="kt-widget24__title" title="Click to edit">
                       Tasks Pool
                      </a>
                      <span class="kt-widget24__desc">
                        Today
                      </span>
                    </div>
                    <span class="kt-widget24__stats kt-font-default">
                      340
                    </span>
                  </div>
                  <!-- <div class="progress progress--sm">
                    <div class="progress-bar kt-bg-default" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                  </div> -->
                </div>
              </div>
          </div>
          <div class="col-4">
            <div class="kt-section kt-section--space-sm">
                <div class="kt-widget24 kt-widget24--solid">
                  <div class="kt-widget24__details">
                    <div class="kt-widget24__info">
                      <a href="#" class="kt-widget24__title" title="Click to edit">
                        Staff Pool
                      </a>
                      <span class="kt-widget24__desc">
                        Today
                      </span>
                    </div>
                    <span class="kt-widget24__stats kt-font-default">
                      10
                    </span>
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
                      <a href="#" class="kt-widget24__title" title="Click to edit">
                       Client Pool
                      </a>
                      <span class="kt-widget24__desc">
                        Today
                      </span>
                    </div>
                    <span class="kt-widget24__stats kt-font-default">
                     50
                    </span>
                  </div>
                  <!-- <div class="progress progress--sm">
                    <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                  </div> -->
                </div>
              </div>
          </div>
        </section>
          <h6 class="kt-font-dark kt-margin-b-10 kt-font-transform-u">Filter Data</h6>
            <form class="kt-form kt-form--fit kt-margin-b-20 border kt-padding-20">
              <section class="row">
                <div class="col-4">
                  <div class="form-group form-group-xs">
                      <div class="kt-checkbox-inline">
                        <label class="kt-checkbox">
                          <input type="checkbox"> Submitted Today
                          <span></span>
                        </label>
                        <label class="kt-checkbox">
                          <input type="checkbox"> Action Needed
                          <span></span>
                        </label>
                      </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group row form-group-xs">
                     <label class="form-col-label col-5">Company Type</label>
                     <div class="col-7">
                       <select class="form-control form-control-sm" data-col-index="6">
                         <option value="">-Select All-</option>
                         <option value="">Private </option>
                         <option value="">Government</option>
                         <option value="">Individual</option>
                       </select>
                     </div>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group row form-group-xs">
                     <label class="form-col-label col-5">Request Type</label>
                     <div class="col-7">
                       <select class="form-control form-control-sm" data-col-index="6">
                         <option value="">-Select All-</option>
                         <option value="">New </option>
                         <option value="">Renew</option>
                         <option value="">Amend</option>
                         <option value="">Cancel</option>
                       </select>
                     </div>
                  </div>
                </div>
              </section>
              <div class="kt-separator kt-separator--xs kt-separator--dashed kt-margin-t-5 kt-margin-b-5"></div>
              <div class="row">
                <div class="col-lg-6">
                  <button class="btn btn-warning btn-sm btn-elevate kt-font-transform-u" id="kt_search">Apply Filter</button>
                  <button type="reset" class="btn btn-secondary btn-sm btn-elevate kt-font-bold kt-font-transform-u" id="kt_reset">Reset</button>
                </div>
                 
              </div>
          </form>   
        <table class="table  table-hover  table-borderless table-striped" id="artist-permit">
               <thead class="thead-dark">
                   <tr>
                       <th>Reference No.</th>
                       <th>Company Name</th>
                       <th>Trade License No.</th>
                       <th>Applied Date</th>
                       <th>Permit Start</th>
                       <th>No. of Artist</th>
                       <th>Request Type</th>
                   </tr>
               </thead>
           </table>
      </div>
      <div class="tab-pane" id="kt_tabs_1_2" role="tabpanel">
        <table class="table table-hover table-striped table-borderless" id="artist-permit-processing">
               <thead class="thead-dark">
                   <tr>
                       <th>Reference No.</th>
                       <th>Company Name</th>
                       <th>Trade License No.</th>
                       <th>Applied Date</th>
                       <th>Permit Start</th>
                       <th>No. of Artist</th>
                       <th>Request Type</th>
                   </tr>
               </thead>
           </table>
      </div>
      <div class="tab-pane" id="kt_tabs_1_3" role="tabpanel">
          <table class="table  table-hover  table-borderless table-striped" id="artist-permit-rejected">
                 <thead class="thead-dark">
                     <tr>
                         <th>Reference No.</th>
                         <th>Company Name</th>
                         <th>Trade License No.</th>
                         <th>Applied Date</th>
                         <th>Permit Start</th>
                         <th>No. of Artist</th>
                         <th>Request Type</th>
                     </tr>
                 </thead>
             </table>
      </div>
      <div class="tab-pane" id="kt_tabs_1_4" role="tabpanel">
        
      </div>
    </div>
   </div>
</section>
<section class="row">
  <div class="col">
    <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
       <div class="kt-portlet__body" > 
          
          {{-- <section style="position: absolute; right: 15px">
            <div class="form-group form-group-sm" >
              <div class="col-sm-12">
               <div class="kt-input-icon kt-input-icon--right">
                    <input type="search" class="form-control-sm form-control" placeholder="Search..." >
                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                      <span><i class="la la-search"></i></span>
                    </span>
                  </div>
              </div>
            </div>
          </section> --}}
          
        
       </div>
    </section>
  </div>
</section>
@endsection

@section('script')
<script type="text/javascript">
     var artistPermit = {};
     var permit_processing = {};


 $(document).ready(function(){

// global
  $('input[type=checkbox]').change(function(){
    if( $(this).is(':checked') ){
      $(this).parent('label').addClass('kt-checkbox--success');
    }
    else{
       $(this).parent('label').removeClass('kt-checkbox--success');
    }
  });


// processing permit table
   permit_processing = $('table#artist-permit-processing').DataTable({
     // dom: `<'row'<'col-sm-12'<'toolbar'><'toolbar2'><f>tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
      ajax: {
          url: '{{ route('admin.artist_permit.datatable') }}',
          data: function(d){

            d.type = ['new', 'renew', 'cancel', 'amend'];
            d.status = 'processing';

            // if($('input[type=checkbox][name=today]').is(':checked')){
            //    d.today = $('input[type=checkbox][name=today]').val();
            // }
            // else{
            //   d.today = null;
            // }
            
          }
      },
  
      columnDefs: [
           {targets: [0,4, 5, 6], className: 'no-wrap'},
           {targets:  5, className: 'no-wrap',sortable: false},
      ],
      columns: [
          { data: 'reference_number'},
          { data: 'company_name'},
          { data: 'trade_license_number'},
          { data: 'applied_date'},
          { data: 'permit_start'},
          { data: 'artist_number'},
          { data: 'request_type'},
      ],
       
      createdRow: function(row, data, index){
        $(row).click(function(){
          location.href = '{{ url('/artist_permit') }}/'+data.permit_id+'/application-details';
        });
      },
  });


       
       // action needed  table
     $('table#artist-permit-rejected').DataTable({
        // "dom": '<"toolbar">rtip',
      // dom: '<"row"<"col text-left"f<"toolbar">>>rt<"pull-left"p><"pull-left kt-margin-l-5"l><"pull-right m-r-sm"i><"clearfix">',
        ajax: {
            url: '{{ route('admin.artist_permit.datatable') }}',
            data: function(d){
              d.status = 'rejected'
              
            }
        },
    
        columnDefs: [
             {targets: [0,4, 5, 6], className: 'no-wrap'},
             // {targets:  6, className: 'no-wrap',sortable: false},
        ],
        columns: [
            { data: 'reference_number'},
            { data: 'company_name'},
            { data: 'trade_license_number'},
            { data: 'applied_date'},
            { data: 'permit_start'},
            { data: 'artist_number'},
            { data: 'request_type'},
        ],
         
        createdRow: function(row, data, index){
          $(row).click(function(){
            location.href = '{{ url('/artist_permit') }}/'+data.permit_id+'/application';
          });
        }
    });

      artistPermit = $('table#artist-permit').DataTable({
         // "dom": '<"toolbar">rtip',
       // dom: '<"row"<"col text-left"f<"toolbar">>>rt<"pull-left"p><"pull-left kt-margin-l-5"l><"pull-right m-r-sm"i><"clearfix">',
         ajax: {
             url: '{{ route('admin.artist_permit.datatable') }}',
             data: function(d){

               d.type = ['new', 'renew', 'cancel', 'amend'];
               d.status = 'pending';

               if($('input[type=checkbox][name=today]').is(':checked')){
                  d.today = $('input[type=checkbox][name=today]').val();
               }
               else{
                 d.today = null;
               }
               
             }
         },
     
         columnDefs: [
              {targets: [0,4, 5, 6], className: 'no-wrap'},
              // {targets:  6, className: 'no-wrap',sortable: false},
         ],
         columns: [
             { data: 'reference_number'},
             { data: 'company_name'},
             { data: 'trade_license_number'},
             { data: 'applied_date'},
             { data: 'permit_start'},
             { data: 'artist_number'},
             { data: 'request_type'},
         ],
          
         createdRow: function(row, data, index){
           $(row).click(function(){
             location.href = '{{ url('/artist_permit') }}/'+data.permit_id+'/application';
           });
         }
     });

      // $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');



    $("div.toolbar").html($('.select2').removeClass('kt-hide'));
});
</script>
@endsection