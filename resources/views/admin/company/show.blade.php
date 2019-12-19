@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}}-DETAILS</h3>
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
                            <div class="kt-widget__pic kt-widget__pic--brand kt-font-brand kt-font-boldest kt-hidden-">
                              SF
                            </div>
                            <div class="kt-widget__content">
                              <div class="kt-widget__head">
                                <span class="kt-widget__username">
                                  {{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}}
                                </span>
                                <div class="kt-widget__action">
                                  <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                  <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                                </div>
                              </div>
                              <div class="kt-widget__subhead">
                                <a href="#"><i class="flaticon2-new-email"></i>sergei@ford .com</a>
                                <a href="#"><i class="flaticon2-calendar-3"></i>Angular Developer</a>
                                <a href="#"><i class="flaticon2-placeholder"></i>Germany</a>
                              </div>
                              <div class="kt-widget__info">
                                <div class="kt-widget__desc">
                                    I distinguish three main text objektive could be merely to inform people.<br>
                                    A second could be persuade people.You want people to bay objective
                                </div>
                                <div class="kt-widget__progress">
                                  <div class="kt-widget__text">
                                    Progress
                                  </div>
                                  <div class="progress" style="height: 5px;width: 100%;">
                                    <div class="progress-bar kt-bg-brand" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                  <div class="kt-widget__stats">
                                    46%
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="kt-widget__bottom">
                            <div class="kt-widget__item">
                              <div class="kt-widget__icon">
                                <i class="flaticon-piggy-bank"></i>
                              </div>
                              <div class="kt-widget__details">
                                <span class="kt-widget__title">Earnings</span>
                                <span class="kt-widget__value"><span>$</span>349,900</span>
                              </div>
                            </div>
                            <div class="kt-widget__item">
                              <div class="kt-widget__icon">
                                <i class="flaticon-confetti"></i>
                              </div>
                              <div class="kt-widget__details">
                                <span class="kt-widget__title">Expenses</span>
                                <span class="kt-widget__value"><span>$</span>654,200</span>
                              </div>
                            </div>
                            <div class="kt-widget__item">
                              <div class="kt-widget__icon">
                                <i class="flaticon-pie-chart"></i>
                              </div>
                              <div class="kt-widget__details">
                                <span class="kt-widget__title">Net</span>
                                <span class="kt-widget__value"><span>$</span>876,323</span>
                              </div>
                            </div>
                            <div class="kt-widget__item">
                              <div class="kt-widget__icon">
                                <i class="flaticon-file-2"></i>
                              </div>
                              <div class="kt-widget__details">
                                <span class="kt-widget__title">54 Tasks</span>
                                <a href="#" class="kt-widget__value kt-font-brand">View</a>
                              </div>
                            </div>
                            <div class="kt-widget__item">
                              <div class="kt-widget__icon">
                                <i class="flaticon-chat-1"></i>
                              </div>
                              <div class="kt-widget__details">
                                <span class="kt-widget__title">683 Comments</span>
                                <a href="#" class="kt-widget__value kt-font-brand">View</a>
                              </div>
                            </div>
                            <div class="kt-widget__item">
                              <div class="kt-widget__icon">
                                <i class="flaticon-network"></i>
                              </div>
                              <div class="kt-widget__details">
                                <div class="kt-section__content kt-section__content--solid">
                                  <div class="kt-badge kt-badge__pics">
                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                      <img src="./assets/media/users/100_7.jpg" alt="image">
                                    </a>
                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                      <img src="./assets/media/users/100_3.jpg" alt="image">
                                    </a>
                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                      <img src="./assets/media/users/100_2.jpg" alt="image">
                                    </a>
                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
                                      <img src="./assets/media/users/100_13.jpg" alt="image">
                                    </a>
                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                      <img src="./assets/media/users/100_4.jpg" alt="image">
                                    </a>
                                    <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                                      +7
                                    </a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
      <div class="kt-widget kt-widget--project-1">
                              <div class="kt-widget__head d-flex">
                                <div class="kt-widget__label">
                                  <div class="kt-widget__media kt-widget__media--m">
                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden-">
                                                            MP
                                                          </div>
                                    <span class="kt-userpic kt-userpic--md kt-userpic--circle kt-hidden">
                                      <img src="./assets/media/project-logos/5.png" alt="image">
                                    </span>
                                    {{-- <span class="kt-userpic kt-userpic--md kt-userpic--circle">
                                      Xx
                                    </span> --}}
                                  </div>
                                  <div class="kt-widget__info kt-padding-0 kt-margin-l-15">
                                    <span class="kt-widget__title">
                                     
                                    </span>
                                    <span class="kt-widget__desc">
                                      <small> {{ucfirst(Auth::user()->LanguageId == 1 ? $company->type->name_en : $company->type->name_ar )}}</small>
                                    </span>
                                  </div>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                  <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                    <i class="flaticon-more-1"></i>
                                  </a>
                                  <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right">
                                    <ul class="kt-nav">
                                      <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                          <i class="kt-nav__link-icon flaticon2-line-chart"></i>
                                          <span class="kt-nav__link-text">Reports</span>
                                        </a>
                                      </li>
                                      <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                          <i class="kt-nav__link-icon flaticon2-send"></i>
                                          <span class="kt-nav__link-text">Messages</span>
                                        </a>
                                      </li>
                                      <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                          <i class="kt-nav__link-icon flaticon2-pie-chart-1"></i>
                                          <span class="kt-nav__link-text">Charts</span>
                                        </a>
                                      </li>
                                      <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                          <i class="kt-nav__link-icon flaticon2-avatar"></i>
                                          <span class="kt-nav__link-text">Members</span>
                                        </a>
                                      </li>
                                      <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                          <i class="kt-nav__link-icon flaticon2-settings"></i>
                                          <span class="kt-nav__link-text">Settings</span>
                                        </a>
                                      </li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                              <div class="kt-widget__body">
                                <span class="kt-widget__text kt-margin-t-0 kt-padding-t-5">
                                  I distinguish three main text objecttives.First<br>
                                  your objective could be merely
                                </span>
                                <div class="kt-widget__stats kt-margin-t-20">
                                  <div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
                                    <span class="kt-widget__date kt-padding-0 kt-margin-r-10">
                                      Start
                                    </span>
                                    <div class="kt-widget__label">
                                      <span class="btn btn-label-brand btn-sm btn-bold btn-upper">16 jan, 19</span>
                                    </div>
                                  </div>
                                  <div class="kt-widget__item d-flex align-items-center kt-padding-l-0">
                                    <span class="kt-widget__date kt-padding-0 kt-margin-r-10 ">
                                      Due
                                    </span>
                                    <div class="kt-widget__label">
                                      <span class="btn btn-label-danger btn-sm btn-bold btn-upper">30 may, 19</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="kt-widget__container">
                                  <span class="kt-widget__subtitel">Progress</span>
                                  <div class="kt-widget__progress d-flex align-items-center flex-fill">
                                    <div class="progress" style="height: 5px;width: 100%;">
                                      <div class="progress-bar kt-bg-success" role="progressbar" style="width: 21%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="kt-widget__stat">
                                      21%
                                    </span>
                                  </div>
                                </div>
                              </div>
                              <div class="kt-widget__footer">
                                <div class="kt-widget__wrapper">
                                  <div class="kt-widget__section">
                                    <div class="kt-widget__blog">
                                      <i class="flaticon2-list-1"></i>
                                      <a href="#" class="kt-widget__value kt-font-brand">87 Tasks</a>
                                    </div>
                                    <div class="kt-widget__blog">
                                      <i class="flaticon2-talk"></i>
                                      <a href="#" class="kt-widget__value kt-font-brand">759 Comments</a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
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
