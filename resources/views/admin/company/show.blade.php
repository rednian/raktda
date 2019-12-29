@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}} - PROFILE </h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.company.index') }}#active-company" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 BACK
            </a>
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
          <div class="col-md-7">
            <section class="kt-form kt-form--label-right kt-padding-t-10 border-right">
              <h6 class="kt-font-dark">{{__('ESTABLISHMENT DETAILS')}}</h6>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__('Establishment Name')}} :</label>
                <div class="col-8">
                  @php
                    $user = Auth::user()->LanguageId;
                    $area = $user == 1 ? ucfirst($company->area->area_en) : $company->area->area_ar;
                    $emirate = $user == 1 ? ucfirst($company->emirate->name_en) : $company->emirate->name_ar;
                    $country = $user == 1 ? ucfirst($company->country->name_en) : $company->country->name_ar;
                    $address = $country. ' '.$emirate.' '.$area.' '.ucfirst($company->address);
                  @endphp
                  <span class="form-control-plaintext kt-font-bolder">{{ $user == 1 ? ucfirst($company->name_en) : $company->name_ar }}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__('Phone Number')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->phone_number}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__('Status')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{!! permitStatus($company->status)!!}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__('Establishment Email')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->company_email}}</span>
                </div>
              </div>
              
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__(' Trade License Number')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->trade_license}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__(' Trade License Issued Date')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->trade_license_issued_date->format('d-F-Y')}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__(' Trade License Expiry Date')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->trade_license_expired_date->format('d-F-Y')}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__(' Website')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->website}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__(' Address')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $address }}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-4 col-form-label">{{__(' Establishment Description')}} :</label>
                <div class="col-8">
                  <span class="form-control-plaintext kt-font-bolder">{{ $user == 1 ? ucfirst($company->company_description_en) : $company->company_description_ar }}</span>
                </div>
              </div>
              
            </section>
          </div>
          <div class="col-md-5">
            <section class="kt-form kt-form--label-right kt-padding-t-10">
              <h6 class="kt-font-dark">{{__('CONTACT PERSON DETAILS')}}</h6>
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__('Name')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $user == 1 ? ucfirst($company->contact->contact_name_en) : $company->contact_name_ar }}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__('Designation')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $user == 1 ? ucfirst($company->contact->designation_en) : $company->contact->designation_ar }}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__('Mobile Number')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->contact->mobile_number}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__('Email')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->contact->email}}</span>
                </div>
              </div>
              
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__(' Emirates ID Number')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->contact->emirate_identification}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__(' Emirates ID Issued Date')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->contact->emirate_id_issued_date->format('d-F-Y')}}</span>
                </div>
              </div>
              <div class="form-group form-group-xs row">
                <label class="col-5 col-form-label">{{__(' Emirates ID Expiry Date')}} :</label>
                <div class="col-7">
                  <span class="form-control-plaintext kt-font-bolder">{{ $company->contact->emirate_id_expired_date->format('d-F-Y')}}</span>
                </div>
              </div>

            </section>
          </div>
        </section>

        <div class="kt-widget kt-widget--user-profile-3">
          
          <div class="kt-widget__bottom">
            <div class="kt-widget__item col-3">
              <div class="kt-widget__icon">
                <i class="flaticon-event-calendar-symbol"></i>
              </div>
              <div class="kt-widget__details">
                <span class="kt-widget__title">{{__('ACTIVE EVENT PERMIT')}}</span>
                <span class="kt-widget__value">{{$company->event()->where('status', 'active')->count() }}</span>
              </div>
            </div>
            <div class="kt-widget__item col-3">
              <div class="kt-widget__icon">
                <i class="flaticon-file-2"></i>
              </div>
              <div class="kt-widget__details">
                <span class="kt-widget__title">{{__('ACTIVE ARTIST PERMIT')}}</span>
                <span class="kt-widget__value">{{$company->permit()->count()}}</span>
              </div>
            </div>
            
            
            
            
          </div>
        </div>

        <section class="row kt-margin-t-20">
            <div class="col-lg-12">
               <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x" role="tablist">
                <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#action-history" role="tab">
                        {{__('ACTION')}}
                        <span class="kt-badge kt-badge--outline kt-badge--info">{{$company->comment()->count()}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#event-tab" role="tab">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        {{__('EVENT PERMITS')}}
                         <span class="kt-badge kt-badge--outline kt-badge--info">{{$company->event()->count()}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#artist-permit-tab" role="tab">
                        {{__('ARTIST PERMIT')}}
                     <span class="kt-badge kt-badge--outline kt-badge--info">{{$company->permit()->count()}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#artist-tab" role="tab">
                        {{__('ARTIST LIST')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#requirement-tab" role="tab">
                        {{__('UPLOADED REQUIREMENTS')}}
                    </a>
                </li>
                
            </ul> 
            <div class="tab-content">
              <div class="tab-pane active" id="action-history" role="tabpanel">
                <section class="row kt-margin-t-10">
                  <div class="col-md-12">
                    @if ($company->status == 'blocked')
                     <div class="alert alert-outline-danger fade show kt-padding-t-0 kt-padding-b-0" role="alert">
                       <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                       <div class="alert-text">This company is currently blocked. 
                         <span title="{{$company->comment()->latest()->first()->created_at->format('l h:i A | d-F-Y')}}" class="text-underline">{{ humanDate($company->comment()->latest()->first()->created_at) }}</span><br>
                         <span>{{__('Please see the ACTION HISTORY for the remarks...')}}</span>
                       </div>
                       <div class="alert-close">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true"><i class="la la-close"></i></span>
                         </button>
                       </div>
                     </div>
                    @endif
                    @if ($company->status == 'active' || $company->status == 'blocked')
                     <div class="accordion accordion-solid  accordion-toggle-plus" id="accordionExample6">
                       <div class="card border kt-margin-b-10">
                         <div class="card-header " id="headingOne6">
                           <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                             @if ($company->status == 'active')
                               {{__('BLOCK ESTABLISHMENT')}}
                               @else
                               {{__('UNBLOCK ESTABLISHMENT')}}
                             @endif
                           </div>
                         </div>
                         <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
                           <div class="card-body kt-padding-b-0">
                             <form action="{{ route('admin.company.changestatus', $company->company_id) }}" method="post" class="form" id="frm-status">
                               @csrf
                               <div class="form-group row form-group-sm">
                                 <div class="col-md-6">
                                   <label for="">Remarks <span class="text-danger">*</span></label>
                                   <textarea required name="comment_en" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea> 
                                 </div>
                                 <div class="col-md-6">
                                   <label for="">Remarks (AR)<span class="text-danger">*</span></label>
                                   <textarea required name="comment_ar" dir="rtl" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea> 
                                 </div>
                               </div>
                               <div class="form-group row">
                                 <div class="col">
                                   @if ($company->status == 'active')
                                     <button class="btn btn-sm btn-maroon kt-transform-u" name="status" value="blocked">{{__('SUBMIT')}}</button>
                                     @else
                                     <button class="btn btn-sm btn-maroon kt-transform-u" name="status" value="active">{{__('SUBMIT')}}</button>
                                   @endif
                                  
                                 </div>
                               </div>
                             </form>
                           </div>
                         </div>
                       </div>
                     </div>
                    @endif
                  </div>
                </section>
                  <table class="table table-borderless table-striped table-hover table-sm border" id="action-table">
                      <thead>
                          <tr>
                              <th>{{__('NAME')}}</th>
                              <th>{{__('REMARKS')}}</th>
                              <th>{{__('ACTION')}}</th>
                              <th>{{__('DATE')}}</th>
                          </tr>
                      </thead>
                  </table>
              </div>
                <div class="tab-pane " id="event-tab" role="tabpanel">
                   <table class="table table-borderless table-striped table-hover border table-sm" id="event-table">
                       <thead>
                           <tr>
                               <th></th>
                               <th>{{__('EVENT NAME')}}</th>
                               <th>{{__('REFERENCE NO.')}}</th>
                               <th>{{__('PERMIT NO.')}}</th>
                               <th>{{__('EVENT DURATION')}}</th>
                               <th>{{__('APPLICATION TYPE')}}</th>
                               <th>{{__('STATUS')}}</th>
                               <th>{{__('VENUE')}}</th>
                               <th>{{__('LOCATION')}}</th>
                               <th>{{__('START')}}</th>
                               <th>{{__('END')}}</th>
                               <th>{{__('TIME')}}</th>
                               <th>{{__('FOOD TRUCK')}}</th>
                               <th>{{__('HAS LIQUOR')}}</th>
                               <th>{{__('NUMBER OF ARTIST')}}</th>
                           </tr>
                       </thead>
                   </table>
                </div>
                <div class="tab-pane" id="artist-permit-tab" role="tabpanel">
                   <table class="table table-borderless table-striped table-hover border" id="artist-permit-table">
                       <thead>
                           <tr>
                               {{-- <th></th> --}}
                               <th>{{__('REFERENCE NO.')}}</th>
                               <th>{{__('DURATION')}}</th>
                               <th>{{__('REQUEST TYPE')}}</th>
                               <th>{{__('PERMIT NO.')}}</th>
                               <th>{{__('NUMBER OF ARTIST')}}</th>
                               <th>{{__('STATUS')}}</th>
                               <th>{{__('WORK LOCATION')}}</th>
                           </tr>
                       </thead>
                   </table>
                </div>
                <div class="tab-pane" id="artist-tab" role="tabpanel">
                    <table class="table table-borderless table-striped table-hover border table-sm" id="artist-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{__('ARTIST NAME')}}</th>
                                <th>{{__('PERSON CODE.')}}</th>
                                <th>{{__('NATIONALITY')}}</th>
                                <th>{{__('MOBILE NUMBER')}}</th>
                                <th>{{__('EMAIL')}}</th>
                                <th>{{__('STATUS')}}</th>
                                <th>{{__('BIRTHDATE')}}</th>
                                <th>{{__('AGE')}}</th>
                                <th>{{__('RELIGION')}}</th>
                                <th>{{__('VISA TYPE')}}</th>
                                <th>{{__('VISA NUMBER')}}</th>
                                <th>{{__('VISA EXPIRY')}}</th>
                                <th>{{__('PASSPORT NUMBER')}}</th>
                                <th>{{__('PASSPORT EXPIRY')}}</th>
                                <th>{{__('IDETIFICATION NUMBER')}}</th>
                                <th>{{__('ADDRESS')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                 <div class="tab-pane" id="requirement-tab" role="tabpanel">
                  <table class="table table-borderless table-striped table-hover border" id="requirement-table">
                     <thead>
                        <tr>
                           {{-- <th>#</th> --}}
                           <th>{{__('REQUIREMENT NAME')}}</th>
                           <th>{{__('ISSUED DATE')}}</th>
                           <th>{{__('EXPIRED DATE')}}</th>
                        </tr>
                     </thead>
                  </table>
                 </div>
                
            </div>
            </div>
        </section>
         
                                                        
    </div>
</div>
@stop
@section('script')
<script type="text/javascript">
    var event = {};
    $(document).ready(function(){
      $('form#frm-status').validate();
        hasUrl();
        eventList();
        artistPermit();
        artist();
        documentRequirement();
        actionTable();
      
      
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          var current_tab = $(e.target).attr('href');

          if('#artist-permit-tab' == current_tab ){ artistPermit(); }
          if('#artist-tab' == current_tab ){  artist(); }
          if('#action-history' == current_tab ){ actionTable(); }
          if('#event-tab' == current_tab){   eventList(); }
        });

    });

   function documentRequirement(){
      $('#requirement-table').DataTable({
         ajax:{
            url: '{{ route('admin.company.application.datatable', $company->company_id) }}'
         },
         columns: [
         // {data: 'count'},
         {data: 'name'},
         {data: 'issued_date'},
         {data: 'expired_date'}
         ]
      });
   }

    function artistPermit(){
      $('table#artist-permit-table').DataTable({
        ajax: '{{ route('admin.company.artistpemit.datatable', $company->company_id) }}',
        columnDefs:[
        {targets: '_all', className: 'now-wrap'}
        ],
        columns:[
        {data: 'reference_number'},
        {data: 'duration'},
        {data: 'request_type'},
        {data: 'permit_number'},
        {data: 'artist_number'},
        {data: 'status'},
        {data: 'location'},
        ],
        createdRow: function(row, data, index){
          $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
        }
      });
    }

    function actionTable(){
      $('#action-table').DataTable({
        ajax: '{{ route('admin.company.comment.datatable', $company->company_id) }}',
        columnDefs:[
          {targets: '_all', className: 'no-wrap'}
        ],
        responsive: true,
        columns:[
        {data: 'name'},
        {data: 'remark'},
        {data: 'action'},
        {data: 'date'},
        ]
      });
    }

    function artist(){
        event =  $('table#artist-table').DataTable({
          // dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
          //       "<'row'<'col-sm-12'tr>>" +
          //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
               url: '{{ route('admin.company.artist.datatable', $company->company_id) }}',
               data: function(d){
                  // var status =  $('#active-permit-status').val();
                  // d.status = status ? [status] : ['blocked', 'active'];
                  // d.type = $('#active-applicant-type').val();
                  // d.area = $('#active-company-area').val();
               }
            },
            responsive: true,
            columnDefs:[
               {targets: '_all', className:'no-wrap'}
            ],
            columns:[
            {render: function(){ return null; }},
            {data: 'name'},
            {data: 'person_code'},
            {data: 'nationality'},
            {data: 'mobile_number'},
            {data: 'email'},
            {data: 'artist_status'},
            {data: 'birthdate'},
            {data: 'age'},
            {data: 'religion'},
            {data: 'visa_type'},
            {data: 'visa_number'},
            {data: 'visa_expiry'},
            {data: 'passport_number'},
            {data: 'passport_expire'},
            {data: 'identification_number'},
            {data: 'address'},
            ],
            createdRow: function(row, data, index){

               $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
            }
         });
    }

    function eventList() {
        event =  $('table#event-table').DataTable({
          // dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
          //       "<'row'<'col-sm-12'tr>>" +
          //       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: {
               url: '{{ route('admin.company.event.datatable', $company->company_id) }}',
               data: function(d){
                  // var status =  $('#active-permit-status').val();
                  // d.status = status ? [status] : ['blocked', 'active'];
                  // d.type = $('#active-applicant-type').val();
                  // d.area = $('#active-company-area').val();
               }
            },
            responsive: true,
            columnDefs:[
               {targets: '_all', className:'no-wrap'}
            ],
            columns:[
            {render: function(){ return null; }},
            {data: 'profile'},
            {data: 'reference_number'},
            {data: 'permit_number'},
            {data: 'duration'},
            {data: 'firm'},
            {data: 'status'},
            {data: 'venue'},
            {data: 'full_address'},
            {data: 'issued_date'},
            {data: 'expired_date'},
            {data: 'time'},
            {data: 'truck'},
            {data: 'liquor'},
            {data: 'artist'},
            ],
            createdRow: function(row, data, index){

               $('td:not(:first-child)',row).click(function(e){ location.href = data.link; });
            }
         });
    }

      function hasUrl(){
     var hash = window.location.hash;
     hash && $('ul.nav a[href="' + hash + '"]').tab('show');
     $('.nav-tabs a').click(function (e) {
       $(this).tab('show');
       var scrollmem = $('body').scrollTop();
       window.location.hash = this.hash;
       // $('html,body').scrollTop(scrollmem);
     });
   }
</script>
@endsection
