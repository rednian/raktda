@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ Auth::user()->LanguageId == 1 ? ucfirst($event->name_en) : ucfirst($event->name_ar) }} - {{ __('DETAILS') }}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.event.index') }}#{{ $tab }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 {{ __('BACK TO PERMIT LIST') }}
            </a>
            <div class="dropdown dropdown-inline">
                 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                        @if ($event->status == 'active' || $event->status == 'expired')
                            {{-- <div class="dropdown-divider"></div> --}}
                            <a target="_blank" class="dropdown-item kt-font-trasnform-u" href="{{ route('admin.event.download', $event->event_id) }}"><i class="la la-download"></i> {{ __('Download') }}</a>
                        @endif
                 </div>
            </div>
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row kt-margin-b-5">
            <div class="col-md-6">
                <section class="border kt-padding-5">
                    <h6 class="kt-font-dark">{{ __('Event Information') }}</h6>
                    <table class="table table-sm table-hover table-borderless">
                        <tr>
                            <td width="27%">{{ __('Permit Status') }} : </td>
                            <td class="kt-font-dark">{!! permitStatus($event->status) !!}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Reference No.') }} :</td>
                            <td class="kt-font-dark">{{ $event->reference_number }}</td>
                        </tr>
                        @if ($event->status == 'active' || $event->status == 'expired')
                        <tr>
                            <td>{{ __('Permit Number') }} :</td>
                             <td class="kt-font-dark">{{ $event->permit_number }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>{{ __('Event Name') }} : </td>
                            <td class="kt-font-dark">{{  ucfirst($event->name_en) }}</td>
                        </tr>
                        
                        <tr>
                            <td>{{ __('Applied Date') }} : </td>
                            <td class="kt-font-dark">{{ $event->created_at->format('d-M-Y') }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Permit Duration') }} : </td>
                             <td class="kt-font-dark">{{ $event->created_at->format('d-M-Y') }}</td>
                        </tr>
                        @if ($event->no_of_trucks)
                          <tr>
                            <td>No. of Food Truck :</td>
                            <td>{{ $event->no_of_trucks }}</td>
                          </tr>
                        @endif
                        <tr>
                            <td>{{ __('Venue') }} : </td>
                             <td class="kt-font-dark">{{ $event->venue_en }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Address') }} : </td>
                             <td class="kt-font-dark">{{ $event->address.' '.$event->area->area_en.' '.$event->emirate->name_en.' '.$event->country->name_en }}</td>
                        </tr>
                    </table>
                </section>
            </div>
            <div class="col-md-6">
                <section class="border kt-padding-5">
                    <h6 class="kt-font-dark">{{ __('Permit Owner Information') }}</h6>
                    <table class="table table-sm table-hover table-borderless">
                        <tr>
                            <td width="35%">{{ __('Name') }} :</td>
                            <td>{{ Auth::user()->LanguageId == 1 ? ucwords($event->owner->NameEn) : ucwords($event->owner->NameAr) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Owner Type') }} : </td>
                            <td>{{ ucwords(userType($event->owner->type)) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Designation') }} :</td>
                            <td>{{  ucwords($event->owner->designation) }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Mobile') }} :</td>
                             <td>{{ $event->owner->mobile_number }}</td>
                        </tr>
                        <tr>
                            <td>{{ __('Email') }} :</td>
                             <td>{{ $event->owner->email }}</td>
                        </tr>
                    </table>
                     <h6 class="kt-font-dark">{{ __('Establishment Information') }}</h6>
                     @if ($event->owner()->has('company') || $event->owner->type != 2)
                       <table class="table table-borderless table-sm">
                           <tr>
                               <td width="35%">{{ __('Establishment Name') }} : </td>
                               <td>{{ ucwords($event->owner->company->company_name) }}</td>
                           </tr>
                           @if ($event->owner->type == 1)
                              <tr>
                                  <td>{{ __('Trade License Number') }} :</td>
                                  <td>{{ $event->owner->company->company_trade_license }}</td>
                              </tr> 
                           @endif
                           <tr>
                              <td>{{ __('Address') }} :</td>
                               <td>{{ $event->owner->company->company_address.' '.$event->owner->company->city.' '.$event->owner->company->country }}</td>
                           </tr>
                       </table>
                       @else
                       @empty
                        {{ __('Establishment Information is not required for this Event Owner.') }}
                       @endempty
                     @endif
                     
                </section>
            </div>
        </section>
        @if ($event->note_en || $event->note_ar)
          <table class="table">
            <thead>
              <tr>
                <th>{{ __('Permit Note') }}</th>
                <th>{{ __('Permit Note (AR)') }}</th>
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
              <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{ __('UPLOADED REQUIREMENTS') }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_2_2_tab_content" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('CHECKED & APPROVAL HISTORY') }}
            </a>
          </li>
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="kt_portlet_base_demo_2_3_tab_content" role="tabpanel">
            <table class="table table-hover table-borderless border table-striped" id="document-table">
                <thead>
                    <tr>
                        <th>{{ __('DOCUMENT NAME') }}</th>
                        <th>{{ __('ISSUED DATE') }}</th>
                        <th>{{ __('EXPIRED DATE') }}</th>
                        <th>{{ __('FILES') }}</th>
                    </tr>
                </thead>
                
            </table>
          </div>
          <div class="tab-pane" id="kt_portlet_base_demo_2_2_tab_content" role="tabpanel">
            <table class="table table-hover table-borderless border table-striped">
                <thead>
                    <tr>
                        <th class="no-wrap">{{ __('CHECKED BY') }}</th>
                        <th>{{ __('REMARKS') }}</th>
                        <th class="no-wrap">{{ __('USER GROUP') }}</th>
                        <th class="no-wrap">{{ __('CHECKED DATE') }}</th>
                        <th class="no-wrap">{{ __('ACTION TAKEN') }}</th>
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