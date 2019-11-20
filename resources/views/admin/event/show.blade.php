@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ ucfirst($event->name_en) }} - DETAILS</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.event.index') }}#{{ $tab }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 Back to permit list
            </a>
            <div class="dropdown dropdown-inline">
                 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        @if ($event->status == 'active' || $event->status == 'expired')
                            {{-- <div class="dropdown-divider"></div> --}}
                            <a target="_blank" class="dropdown-item kt-font-trasnform-u" href="{{ route('admin.event.download', $event->event_id) }}"><i class="la la-download"></i> download</a>
                        @endif
                 </div>
            </div>
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
      @if ($event->permit)
      <a href="{{ route('admin.artist_permit.show', $event->permit->permit_id) }}">
        <div class="alert alert-outline-danger alert-bold kt-margin-t-10 kt-margin-b-10" role="alert">
          <div class="alert-text">This event has an artist with reference number <span class="kt-font-danger">{{ $event->permit->reference_number }}</span>
          </div>
        </div>
        </a>
      @endif
      <div class="kt-widget kt-widget--project-1">
          <div class="kt-widget__head">
            <div class="kt-widget__label">
              <div class="kt-widget__media">
                <span class="kt-userpic kt-userpic--lg kt-userpic--circle">
                  <img src="{{ asset('/storage/'.$event->logo_thumbnail) }}" alt="image">
                </span>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__title">
                 {{ Auth::user()->LanguageId == 1 ? ucwords($event->name_en) : ucwords($event->name_ar) }}
                </span>
                <span class="kt-widget__desc">
                  <small> {{ Auth::user()->LanguageId == 1 ? ucwords($event->type->name_en) : $event->type->name_ar }}</small>
                  <br>{!! permitStatus($event->status) !!}
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
          <div class="kt-widget__body kt-padding-l-5 kt-padding-r-5">
            <span class="kt-widget__text kt-margin-t-15">
              {{ Auth::user()->LanguageId == 1 ? ucfirst($event->description_en) : ucfirst($event->description_ar)  }}
            </span>
            <section class="row kt-margin-t-15">
              <div class="col-md-6 col-xs-6 col-xs-12 col-lg-6">
                <section class="border kt-padding-5">
                    <h6 class="kt-font-dark">Event Information</h6>
                    <table class="table table-sm table-hover table-borderless">
                        
                        <tr>
                            <td>Reference No. </td>
                            <td class="kt-font-dark">{{ $event->reference_number }}</td>
                        </tr>
                        @if ($event->status == 'active' || $event->status == 'expired')
                        <tr>
                            <td>Permit Number. </td>
                             <td class="kt-font-dark">{{ $event->permit_number }}</td>
                        </tr>
                        @endif
                        
                        
                        <tr>
                            <td>Applied Date: </td>
                            <td class="kt-font-dark">{{ $event->created_at->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td>Permit Duration : </td>
                             <td class="kt-font-dark">{{ $event->created_at->format('d-M-Y') }}</td>
                        </tr>
                        @if ($event->no_of_trucks)
                          <tr>
                            <td>No. of Food Truck :</td>
                            <td>{{ $event->no_of_trucks }}</td>
                          </tr>
                        @endif
                        <tr>
                            <td>Venue : </td>
                             <td class="kt-font-dark">{{ $event->venue_en }}</td>
                        </tr>
                        <tr>
                            <td>Address : </td>
                             <td class="kt-font-dark">{{ $event->address.' '.$event->area->area_en.' '.$event->emirate->name_en.' '.$event->country->name_en }}</td>
                        </tr>
                        @if ($event->status == 'cancelled')
                        <tr>
                            <td>Cancel Reason:</td>
                             <td class="kt-font-dark">{{ ucwords($event->cancel_reason) }}</td>
                        </tr>
                        @endif
                    </table>
                </section>
              </div>
              <div class="col-md-6 col-xs-6 col-xs-12 col-lg-6">
                <section class="border kt-padding-5">
                    <h6 class="kt-font-dark">Permit Owner Information</h6>
                    <table class="table table-sm table-hover table-borderless">
                        <tr>
                            <td width="35%">Name :</td>
                            <td>{{ ucwords($event->owner->NameEn) }}</td>
                        </tr>
                        <tr>
                            <td>Owner Type: </td>
                            <td>{{ ucwords(userType($event->owner->type)) }}</td>
                        </tr>
                        <tr>
                            <td>Designation :</td>
                            <td>{{  ucwords($event->owner->designation) }}</td>
                        </tr>
                        <tr>
                            <td>Mobile :</td>
                             <td>{{ $event->owner->mobile_number }}</td>
                        </tr>
                        <tr>
                            <td>Email :</td>
                             <td>{{ $event->owner->email }}</td>
                        </tr>
                    </table>
                     <h6 class="kt-font-dark">Establishment Information</h6>
                     @if ($event->owner()->has('company') || $event->owner->type != 2)
                       <table class="table table-borderless table-sm">
                           <tr>
                               <td width="35%">Establishment Name: </td>
                               <td>{{ ucwords($event->owner->company->company_name) }}</td>
                           </tr>
                           @if ($event->owner->type == 1)
                              <tr>
                                  <td>Trade License No. :</td>
                                  <td>{{ $event->owner->company->company_trade_license }}</td>
                              </tr> 
                           @endif
                           <tr>
                              <td>Address:</td>
                               <td>{{ $event->owner->company->company_address.' '.$event->owner->company->city.' '.$event->owner->company->country }}</td>
                           </tr>
                       </table>
                       @else
                       @empty
                        Establishment Information is not required for this Event Owner.
                       @endempty
                     @endif
                     
                </section>
              </div>
            </section>
            
            
            <div class="kt-widget__content">
              <div class="kt-widget__details">
                <span class="kt-widget__subtitle">FOOD TRUCKS</span>
                <span class="kt-widget__value">{{ $event->no_of_trucks ? $event->no_of_trucks : 0 }}</span>
              </div>
              <div class="kt-widget__details">
                <span class="kt-widget__subtitle">ARTIST ON EVENT</span>
                @if ($event->permit()->count() > 0)
                  <div class="kt-badge kt-badge__pics">
                    @foreach ($event->permit->artistpermit as $index => $artist)
                      @if (++$index <= 5)
                        <a href="" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="dark" data-placement="top" title="" data-original-title="{{ ucwords($artist->fullname) }}">
                          <img src="{{ asset('/storage/'.$artist->thumbnail) }}" alt="image" class="img-thumbnail">
                        </a>
                        @else
                        <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                          +{{  ++$index - 5 }}
                        </a>
                      @endif
                    @endforeach
                  </div>
                  @else
                   <span class="kt-widget__value">0</span>
                @endif
                
              </div>
            </div>
          </div>
          {{-- <div class="kt-widget__footer">
            <div class="kt-widget__wrapper">
              <div class="kt-widget__section">
                <div class="kt-widget__blog">
                  <i class="flaticon2-list-1"></i>
                  <a href="#" class="kt-widget__value kt-font-brand">72 Tasks</a>
                </div>
                <div class="kt-widget__blog">
                  <i class="flaticon2-talk"></i>
                  <a href="#" class="kt-widget__value kt-font-brand">648 Comments</a>
                </div>
              </div>
              <div class="kt-widget__section">
                <button type="button" class="btn btn-brand btn-sm btn-upper btn-bold">details</button>
              </div>
            </div>
          </div> --}}
        </div>
        <section class="row kt-margin-b-5">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
                
            </div>
        </section>
      
        @if ($event->note_en || $event->note_ar)
          <table class="table">
            <thead>
              <tr>
                <th>Permit Note</th>
                <th>Permit Note (AR)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ ucwords($event->note_en) }}</td>
                <td>{{ ucwords($event->note_ar) }}</td>
              </tr>
            </tbody>
          </table>
        @endif
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x nav-tabs-line-right" role="tablist">
          <li class="nav-item">
            <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_2_3_tab_content" role="tab">
              <i class="fa fa-calendar-check-o" aria-hidden="true"></i>uploaded Requirements
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_2_2_tab_content" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>checked & approval history
            </a>
          </li>
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="kt_portlet_base_demo_2_3_tab_content" role="tabpanel">
            <table class="table table-hover table-borderless border table-striped" id="document-table">
                <thead>
                    <tr>
                        <th>DOCUMENT NAME</th>
                        <th>ISSUED DATE</th>
                        <th>EXPIRED DATE</th>
                        <th>FILES</th>
                    </tr>
                </thead>
                
            </table>
          </div>
          <div class="tab-pane" id="kt_portlet_base_demo_2_2_tab_content" role="tabpanel">
            <table class="table table-hover table-borderless border table-striped">
                <thead>
                    <tr>
                        <th class="no-wrap">CHECKED BY</th>
                        <th>REMARKS</th>
                        <th class="no-wrap">USER GROUP</th>
                        <th class="no-wrap">CHECKED DATE</th>
                        <th class="no-wrap">ACTION TAKEN</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($event->approve()->exists())
                    @foreach ($event->approve()->orderBy('updated_at')->get() as $approve)
                        <tr>
                            <td class="no-wrap">{{ ucwords($approve->user->NameEn) }}</td>
                            <td>{{ ($approve->comment->comment) }}</td>
                            <td>{{ ucwords($approve->role->NameEn) }}</td>
                            <td>{{ $approve->checked_at ? $approve->checked_at->format('d-M-Y') : null }}</td>
                            <td class="no-wrap">{{ $approve->status }}</td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
          </div>
          
        </div>
        
        
    </div>
</div>
@endsection
@section('script')
<script>
  var document_table = {}; 
  $(document).ready(function(){
    document_table = $('#document-table').DataTable({
      ajax: '{{ route('admin.event.uploadedRequiremet', $event->event_id) }}',
      columnDefs:[
      {targets:[1,2,3], className: 'no-wrap'}
      ],
      columns:[
        { data: 'name'},
        { data: 'start'},
        { data: 'end'},
        { data: 'files'},
      ]
    });
  });
</script>
@endsection