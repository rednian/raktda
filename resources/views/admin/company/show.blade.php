@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}} -{{__('DETAILS')}}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.company.index') }}#active-company" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 BACK TO Company LIST
            </a>
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
      <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
              <div class="kt-widget__media kt-hidden">
                <img src="./assets/media/users/100_1.jpg" alt="image">
              </div>
              <div class="kt-widget__pic kt-widget__pic--dark kt-font-dark kt-font-boldest kt-font-light">
                @php
                  $name = explode(' ', $company->name_en);
                $first = $name[0];
                @endphp
                {{strtoupper(substr($first, 0, 1))}}
              </div>
              <div class="kt-widget__content">
                <div class="kt-widget__head">
                  <a href="#" class="kt-widget__username">
                  {{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}}
                  </a>
                </div>
                <section class="row">
                  <div class="col-md-4">
                    <div class="kt-widget__subhead">
                      <a href="#"><i class="flaticon2-new-email"></i>{{$company->company_email}}</a><br>
                      <a href="#"><i class="flaticon2-calendar-3"></i>Designer</a><br>
                    </div>
                  </div>
                  <div class="col-md-4">
                  
                  </div>
                  <div class="col-md-4">
                    
                  </div>
                </section>
                <div class="kt-widget__subhead">
                      <a href="#"><i class="flaticon2-placeholder"></i>
                        {{ucfirst($company->address)}} 
                        {{ucfirst($company->area->area_en)}} 
                        {{ucfirst($company->emirate->name_en)}}
                        {{ucfirst($company->country->name_en)}}
                      </a>
                    </div>
                
                
                <div class="kt-widget__info">
                  <div class="kt-widget__desc">
                     {{Auth::user()->Language == 1 ? $company->company_description_en : $company->company_description_ar }}
                  </div>
                  {{-- <div class="kt-widget__progress">
                    <div class="kt-widget__text">
                      Progress
                    </div>
                    <div class="progress" style="height: 5px;width: 100%;">
                      <div class="progress-bar kt-bg-danger" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="kt-widget__stats">
                      53%
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
            <div class="kt-widget__bottom">
              <div class="kt-widget__item">
                <div class="kt-widget__icon">
                  <i class="flaticon-event-calendar-symbol"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{__('ACTIVE EVENTS')}}</span>
                  <span class="kt-widget__value"><span>{{$company->event()->whereStatus('active')->count()}}</span>
                </div>
              </div>
              <div class="kt-widget__item">
                <div class="kt-widget__icon">
                  <i class="flaticon-file-2"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{__('ACTIVE ARTIST PERMITS')}}</span>
                  <span class="kt-widget__value kt-font-brand">{{$company->permit()->where('permit_status','active')->count()}}</span>
                </div>
              </div>
              
              
            </div>
          </div>
      <section class="row">
        <div class="col-md-12">
          <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
            <div class="card">
              <div class="card-header" id="headingOne6">
                <div class="card-title" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                  {{__('')}}
                </div>
              </div>
              <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
                <div class="card-body">
              
                </div>
              </div>
            </div>
          </div>
          <form action="" class="form">
            <div class="form-group row">
              <div class="col-md-6">
                <label for="">Remarks <span class="text-danger">*</span></label>
                <textarea name="comment_en" class="form-control form-control-sm" rows="4" autocomplete="off"></textarea> 
              </div>
              <div class="col-md-6"></div>
            </div>
          </form>
        </div>
      </section>
      
      
        <section class="row">
            <div class="col-lg-12">
               <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-2x" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#event-tab" role="tab">
                        <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        {{__('Event Permits')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_5_tab_content" role="tab">
                        {{__('Artist Permit')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#artist-tab" role="tab">
                        {{__('Artist List')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_4_5_tab_content" role="tab">
                        {{__('Upload Requirements')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_5_5_tab_content" role="tab">
                        {{__('Checked & Action History')}}
                    </a>
                </li>
            </ul> 
            <div class="tab-content">
                <div class="tab-pane active" id="event-tab" role="tabpanel">
                   <table class="table table-borderless table-striped table-hover border table-sm" id="event-table">
                       <thead>
                           <tr>
                               <th></th>
                               <th>{{__('EVENT NAME')}}</th>
                               <th>{{__('REFERENCE NO.')}}</th>
                               <th>{{__('PERMIT NO.')}}</th>
                               <th>{{__('EVENT DURATION.')}}</th>
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
                <div class="tab-pane" id="kt_portlet_base_demo_2_5_tab_content" role="tabpanel">
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
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
        hasUrl();
        eventList();
        artist();
    });

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
       $('html,body').scrollTop(scrollmem);
     });
   }
</script>
@endsection
