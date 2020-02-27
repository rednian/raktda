@extends('layouts.admin.admin-app')
@section('style')
<style>
  .table-display td{
    padding: 0 0.3rem;
  }
</style>
@endsection
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ $event->name }} - {!! permitStatus($event->status) !!}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="javascript:void(0)" onclick="window.history.back()" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 {{ __('BACK') }}
            </a>
            @if(!Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
            @if (in_array($event->status, ['active', 'expired', 'cancelled']) && !is_null($event->approved_by))
                {{-- <div class="dropdown-divider"></div> --}}
                <a target="_blank" class="btn btn-warning kt-font-transform-u btn-sm kt-margin-l-5"
                href="{{ URL::signedRoute('admin.event.download', $event->event_id) }}"><i class="la la-download"></i> {{ __('Download Permit') }}</a>
            @endif
            <div class="dropdown dropdown-inline">
                 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more"></i>
                 </button>
                 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">

                  <a class="dropdown-item kt-font-trasnform-u" href="{{ URL::signedRoute('admin.company.show', $event->owner->company) }}">
                    {{ __('Establishment Detail') }}
                  </a>

                 </div>
            </div>
            @endif
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">

      @if ($event->status == 'active')
        <section class="row kt-margin-t-10">
          <div class="col-md-12">
            <div class="accordion accordion-solid  accordion-toggle-plus" id="accordionExample6">
                <div class="card border">
                  <div class="card-header " id="headingOne6">
                    <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse" data-target="#collapseOne6">
                        <h6 class="kt-font-dark">{{__('CANCEL EVENT')}}</h6>
                    </div>
                  </div>
                  <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                    <div class="card-body kt-padding-b-0">
                      <form action="{{ route('admin.event.cancel', $event->event_id) }}" method="post" class="form" id="frm-status">
                        @csrf
                        <div class="form-group row form-group-sm">
                          <div class="col-md-6">
                            <label for="">{{ __('Remarks') }} <span class="text-danger">*</span></label>
                            <textarea required="" name="comment" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                          </div>
                          <div class="col-md-6">
                            <label for="">{{ __('Remarks (AR)') }} <span class="text-danger">*</span></label>
                            <textarea required="" name="comment_ar" dir="rtl" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col">
                            <button class="btn btn-sm btn-maroon kt-transform-u" name="status" value="cancelled">{{ __('SUBMIT') }}</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </section>
      @endif

      {{-- EVENT APPROVAL BY INSPECTOR, MANAGER AND GOVERNMENT --}}
      @if(Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
      @if($event->comment()->where('action', '!=', 'pending')->when(Auth::user()->roles()->first()->role_id == 6, function($q){
            $q->where('government_id', Auth::user()->government_id);
        })->where('role_id', Auth::user()->roles()->first()->role_id)->latest()->first())
      @php
        $action = $event->comment()->where('action', '!=', 'pending')->when(Auth::user()->roles()->first()->role_id == 6, function($q){
            $q->where('government_id', Auth::user()->government_id);
        })->where('role_id', Auth::user()->roles()->first()->role_id)->latest()->first();
      @endphp
      <div class="alert alert-outline-danger fade show" role="alert" style="margin-bottom:0px">
        <div class="alert-text">
          <h6 class="alert-heading text-danger kt-font-transform-u">{{ __('Last Action Taken') }}</h6>
          <table class="table table-hover table-bordered table-striped">
            <thead>
              <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Checked Date') }}</th>
                <th>{{ __('Remarks') }}</th>
                <th class="text-right">{{ __('Action') }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $action->user->NameEn }}</td>
                <td>{{ $action->updated_at }}</td>
                <td>{{ $action->comment }}
                    @if($action->exempt_payment)
                      <br><span class="kt-badge kt-badge--warning kt-badge--inline">{{ __('Exempted for Payment') }}</span>
                    @endif
                </td>
                <td class="text-right">{!! permitStatus($action->action) !!}</td>
              </tr>
            </tbody>
          </table>
           <a href="#tabDetails" onclick="$('ul.nav a[href=\'#kt_portlet_base_demo_4_4_tab_content\']').tab('show');" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">{{ __('See History') }}
           </a>
        </div>
      </div>
      @endif
      @if($event->comment()->where('action', 'pending')->where('role_id', Auth::user()->roles()->first()->role_id)->latest()->first())
      <section class="row kt-margin-t-10">
          <div class="col-md-12">
            <div class="accordion accordion-solid  accordion-toggle-plus" id="accordionExample7">
                <div class="card border">
                  <div class="card-header " id="headingOne7">
                    <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse" data-target="#collapseOne7">
                        {{__('TAKE ACTION')}}
                    </div>
                  </div>
                  <div id="collapseOne7" class="collapse show" aria-labelledby="headingOne7" data-parent="#accordionExample7">
                    <div class="card-body kt-padding-b-0">
                      <form action="{{ route('admin.event.savecomment', $event->event_id) }}" method="post" class="form" id="frm-savecomment">
                        @csrf
                        <div class="form-group row form-group-sm">
                            <div class="col-md-6">
                                <label for="">{{ __('Action') }} <span class="text-danger">*</span></label>
                                <select required="" name="action" class="form-control form-control-sm">
                                    <option value=""></option>
                                    <option value="approved">{{ __('Approved') }}</option>
                                    <option value="rejected">{{ __('Rejected') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row form-group-sm">
                          <div class="col-md-6">
                            <label for="">{{ __('Remarks') }} <span class="text-danger">*</span></label>
                            <textarea required="" name="comment" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                          </div>
                          <div class="col-md-6">
                            <label for="">{{ __('Remarks (AR)') }} <span class="text-danger">*</span></label>
                            <textarea required="" name="comment_ar" dir="rtl" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                          </div>
                        </div>
                        @if(Auth::user()->roles()->whereIn('roles.role_id', [5])->exists())
                        <div class="form-group row form-group-sm">
                            <div class="col-md-6">
                                <label class="kt-checkbox kt-checkbox--default kt-font-dark">
                                  <input name="bypass_payment" value="1" type="checkbox"> {{ __('Bypass the payment') }}
                                  <span></span>
                                </label>
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                          <div class="col">
                            <button type="button" id="btnCheckedPermit" class="btn btn-sm btn-maroon kt-transform-u">{{ __('SUBMIT') }}</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
      </section>
      @endif
      @endif
      {{-- @include('admin.event.includes.existing-notification') --}}
      <section class="row kt-margin-t-10">
        <div class="col-md-7">
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-5">{{__('Event Name')}} </span>: {{Auth::user()->LanguageId == 1 ?  ucfirst($event->name_en) : $event->name_ar }}</p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-5">{{__('Event Owner')}} </span>: {{Auth::user()->LanguageId == 1 ?  ucfirst($event->owner_name) : $event->owner_name_ar }}</p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-15">{{__('Event Type')}} </span>:
            {{Auth::user()->LanguageId == 1 ?  ucfirst($event->type->name_en) : $event->type->name_ar }}
          </p>
          <p class="kt-margin-b-0 kt-font-dark">
            <span class="kt-font-bold kt-margin-r-20">{{__('Event Subcategory')}}</span>:
            {{ $event->subType()->exists() ? Auth::user()->LanguageId == 1 ? ucfirst($event->subType->name_en) : ucfirst($event->subType->name_ar) : '-'}}
          </p>

          <p class="kt-margin-b-0 kt-font-dark">
            <span class="kt-font-bold kt-margin-r-20">{{__('Start Date')}}</span>:
            {{ date('d-F-Y', strtotime($event->issued_date)) }}
          </p>
          <p class="kt-margin-b-0 kt-font-dark">
            <span class="kt-font-bold kt-margin-r-25">{{__('End Date')}}</span>:
            {{ date('d-F-Y', strtotime($event->expired_date)) }}
          </p>
          <p class="kt-margin-b-0 kt-font-dark">
            <span class="kt-font-bold kt-margin-r-25">{{__('Event Duration')}}</span>:
            @php
              $date = Carbon\Carbon::parse($event->issued_date)->diffInDays($event->expired_date);
              $day = $date > 1 ? ' Days' :' Day';
            @endphp
            {{ $date.$day }}
          </p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-40">{{__('Venue')}}</span>:
            {{  Auth::user()->LanguageId == 1 ? ucfirst($event->venue_en) :  $event->venue_ar }}
          </p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-30">{{__('Address')}}</span>: {{ $event->full_address }}</p>
          <hr class="kt-margin-t-30">
          <section class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__bottom kt-margin-0" style="border:none;">
              <div class="kt-widget__item kt-padding-t-5">
                <div class="kt-widget__icon">
                  <i class="flaticon-truck"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{__('FOOD TRUCK')}}</span>
                  <span class="kt-widget__value">{{$event->truck()->count()}}</span>
                </div>
              </div>
              <div class="kt-widget__item  kt-padding-t-5">
                <div class="kt-widget__icon">
                  <i class="la la-glass"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{__('HAS LIQUOR')}}</span>
                  <span class="kt-widget__value">{{$event->liquor()->exists() > 0 ? 'YES' : 'NO'}}</span>
                </div>
              </div>
              <div class="kt-widget__item kt-padding-t-5">
                <div class="kt-widget__icon">
                  <i class="flaticon-web"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{{__('IMAGES')}}}</span>
                  <a href="#" class="kt-widget__value">{{$event->otherUpload()->count()}}</a>
                </div>
              </div>
              <div class="kt-widget__item kt-padding-t-0">
                <div class="kt-widget__icon">
                  <i class="flaticon-network"></i>
                </div>
                <div class="kt-widget__details">
                  <div class="kt-section__content kt-section__content--solid">
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
                       <span class="kt-widget__title">{{__('ARTIST')}}</span>
                       <span class="kt-widget__value">0</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </section>

          <iframe class="border kt-margin-t-10 kt-padding-5" id='mapcanvas'
                  src='https://maps.google.com/maps?q={{ urlencode($event->address)}}&Roadmap&z=10&ie=UTF8&iwloc=&output=embed&z=17'
                  style="height: 400px; width: 100%; margin-top: 1%; border-style: none;" >
          </iframe>

        </div>
        <div class="col-md-5">
            <div class="border kt-padding-10">
                <div class="kt-widget kt-widget--user-profile-4">
                  <div class="kt-widget__head kt-margin-t-5">
                    <div class="kt-widget__media kt-margin-b-5">
                      @if ($event->thumbnail)
                        <img src="{{ asset('/storage/'.$event->logo_thumbnail) }}" class="kt-widget__img img-circle" alt="image">
                        @else
                        <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                          @php
                            $name = explode(' ', $event->name_en);
                            $name = strtoupper(substr($name[0], 0, 1));
                          @endphp
                          {{$name}}
                        </div>
                      @endif
                    </div>
                    <div class="kt-widget__content">
{{--                      <div class="kt-widget__section">--}}
{{--                        <div class="kt-widget__button">--}}
{{--                          {!! permitStatus($event->status)!!}                      --}}
{{--                        </div>--}}
{{--                      </div>--}}
                      @if ($event->status == 'cancelled')
                       <div class="kt-widget__section">
                        <h6 class="kt-font-dark">{{ __('Cancel Reason') }}   <small title="{{$event->cancel_date->format('l h:i A | d-F-Y')}}" class="pull-right text-underline">{{humanDate($event->cancel_date)}}</small></h6>

                        <hr class="kt-margin-b-0 kt-margin-t-0">
                        <p>
                          {{ucfirst($event->cancel_reason)}}
                        </p>
                       </div>
                      @endif
                    </div>
                  </div>
                  <div class="kt-widget__body kt-margin-t-5">
                    <hr>
                     <h6 class="kt-font-dark kt-font-transform-u">{{ __('Permit Information') }}</h6>
                     <table class="table table-sm table-hover table-borderless table-display">
                      <tr>
                          <td>{{ __('Submitted Date') }} : </td>
                          <td class="kt-font-dark">{{ $event->created_at->format('d-F-Y') }}</td>
                      </tr>
                         <tr>
                             <td>{{ __('Reference No.') }} :</td>
                             <td class="kt-font-dark"><code style="font-size:;">{{ $event->reference_number }}</code></td>
                         </tr>
                          <tr>
                             <td>{{ __('Permit Number') }} :</td>
                              <td class="kt-font-dark"><code>{{ $event->permit_number ? $event->permit_number : 'N/A' }}</code></td>
                         </tr>
                         <tr>
                             <td>{{ __('Expected Audience') }} :</td>
                              <td class="kt-font-dark">{{$event->audience_number}}</td>
                         </tr>
                         @if (!empty($event->approved_by))
                           <tr>
                               <td>{{ __('Approved By') }} :</td>
                                <td class="kt-font-dark">{{ucwords($event->approved->NameEn)}}</td>
                           </tr>
                           <tr>
                             <td>{{ __('Approved Date') }} :</td>
                              <td class="kt-font-dark"><span title="{{$event->approved_date->format('h:i A | d-F-Y')}}" class="text-underline">{{humanDate($event->approved_date)}}</span></td>
                         </tr>
                         @endif


                         <tr>
                             <td>{{ __('Printed Note') }} :</td>
                              <td class="kt-font-dark">{{ Auth::user()->LanguageId == 1 ? ucfirst($event->note_en) : $event->note_ar }}</td>
                         </tr>
                     </table>
                     <hr>
                     <h6 class="kt-font-dark kt-font-transform-u">{{__('Liquor Details')}}</h6>
                     @if ($event->liquor()->exists())
                       <table class="table table-sm table-hover table-borderless table-display">
                         <tr>
                          <tr>
                            <td width="55%">{{__('Establishment Name')}} :</td>
                            <td>{{Auth::user()->LanguageId == 1 ? ucfirst($event->liquor->company_name_en) : $event->liquor->company_name_ar}}</td>
                          </tr>
                           <td>{{__('Provided by venue')}} : </td>
                           <td>{{$event->provided ? 'YES' : 'NO'}}</td>
                           @if ($event->provided)
                             <tr>
                               <td>{{__('Liquor Permit Number: ')}}</td>
                               <td>{{$event->liquor->liquor_permit_no}}</td>
                             </tr>
                             @else
                             <tr>
                               <td>{{__('Liquor Service')}} :</td>
                               <td>{{$event->liquor->liquor_service}}</td>
                             </tr>
                             <tr>
                               <td>{{__('Liquor Types')}} :</td>
                               <td>{{$event->liquor->liquor_type}}</td>
                             </tr>
                             <tr>
                               <td>{{__('Purchase Receipt Number')}} :</td>
                               <td>{{$event->liquor->purchase_receipt}}</td>
                             </tr>
                           @endif
                         </tr>
                       </table>
                       @else
                      <small> {{__('No Liquor on this event.')}}</small>
                     @endif

                     {{-- <div class="d-flex justify-content-center">
                      @if ($event->transaction()->exists())
                       <button type="button" class="btn btn-secondary btn-sm kt-margin-r-5">Download</button>
                      @endif

                     </div> --}}
                     <hr>
                      <h6 class="kt-font-dark kt-font-transform-u">{{ __('Establishment Details') }}</h6>
                      @if ($event->owner->company()->exists())
                        <table class="table table-borderless table-sm table-display">
                            <tr>
                                <td><span style="font-size: large;" class="flaticon-home"></span> : </td>
                                <td>{{ ucwords(Auth::user()->LanguageId == 1 ? ucfirst($event->owner->company->name_en) : $event->owner->company->name_ar ) }}</td>
                            </tr>
                            <tr>
                                <td><span style="font-size: large;" class="flaticon-email"></span> : </td>
                                <td>{{ $event->owner->company->company_email }}</td>
                            </tr>
                            <tr>
                                <td><span style="font-size: large;" class="la la-phone"></span> : </td>
                                <td>{{ $event->owner->company->phone_number }}</td>
                            </tr>
                            <tr>
                               <td><span style="font-size: large;" class="flaticon-placeholder-3"></span> :</td>
                               @if (Auth::user()->LanguageId == 1)
                                <td>{{ $event->owner->company->addres }} {{ $event->owner->company->area->area_en}} {{ $event->owner->company->emirate->name_en}} {{ $event->owner->company->country->name_en}}</td>
                                @else
                                <td>{{ $event->owner->company->addres }} {{ ucfirst($event->owner->company->area->area_ar)}} {{ ucfirst($event->owner->company->emirate->name_ar)}} {{ ucfirst($event->owner->company->country->name_ar)}}</td>
                               @endif
                            </tr>
                        </table>
                        <hr>
                         <h6 class="kt-font-dark kt-font-transform-u">{{ __('Contact Information') }}</h6>
                        <table class="table table-borderless table-sm table-display">
                            <tr>
                                <td class="no-wrap"><span style="font-size: large;" class="flaticon-profile-1"></span> </td>
                                <td>{{ ucwords(Auth::user()->LanguageId == 1 ? ucfirst($event->owner->company->contact->contact_name_en) : $event->owner->company->contact->contact_name_ar ) }}</td>
                            </tr>
                            <tr>
                                <td><span style="font-size: large;" class="la la-suitcase"></span> </td>
                                <td>{{ Auth::user()->LanguageId == 1 ? ucwords($event->owner->company->contact->designation_en) : ucwords($event->owner->company->contact->designation_ar) }}</td>
                            </tr>
                            <tr>
                                <td><span style="font-size: large;" class="la la-mobile-phone"></span> </td>
                                <td>{{ $event->owner->company->contact->mobile_number }}</td>
                            </tr>

                        </table>
                        @else
                        @empty
                         {{ __('Establishment Information is not required for this Event Owner.') }}
                        @endempty
                      @endif
                  </div>
                </div>
            </div>
        </div>
      </section>

      <section class="row">
        <div class="col-md-7">
          <div class="form-group form-group-sm">
            <label class="kt-font-dark kt-font-transform-u">{{__('Event Details')}}</label>
            <textarea style="resize: both;" readonly rows="4" class="form-control">{{ Auth::user()->LanguageId == 1 ? ucfirst($event->description_en) : $event->description_ar }}</textarea>
          </div>
        </div>
        @if(!Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists() && (in_array($event->status, ['active', 'expired']) && !is_null($event->approved_by)))
        <div class="col-md-5">
          <form class=" kt-padding-5 kt-margin-t-10">
            <div class="form-group row form-group-sm">
            <label class="col-10 col-form-label">{{ __('Show event to all registered company calendar') }}</label>
              <div class="col-2">
                <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
                  <label class="kt-margin-b-0">
                    <input type="checkbox" {{$event->is_display_all ?  'checked' : null }} name="is_display_all">
                    <span></span>
                  </label>
                </span>
              </div>
            </div>
            <div class="form-group row form-group-sm">
              <label class="col-10 col-form-label">{{ __('Show event to public website calendar') }}</label>
              <div class="col-2">
                <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
                  <label class="kt-margin-b-0">
                    <input type="checkbox" {{$event->is_display_web ?  'checked' : null }} name="is_display_web">
                    <span></span>
                  </label>
                </span>
              </div>
            </div>
          </form>
        </div>
        @endif
      </section>

        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x nav-tabs-line-right" role="tablist" id="tabDetails">
          <li class="nav-item">
            <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#event-tab" role="tab">
              <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{ __('EVENT ATTACHMENT') }}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->eventRequirement()->count()}}</span>
            </a>
          </li>
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#truck-tab" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('TRUCK INFORMATION') }}
               <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->truck()->count()}}</span>
            </a>
          </li>
          @endif
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#liquor-tab" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('LIQUOR DETAILS') }}

            </a>
          </li>
          @endif
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#artist-tab" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('ARTIST PERMIT DETAILS') }}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{!is_null($event->permit) ? $event->permit->artistPermit()->count() : 0}}</span>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#images-tab" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('EVENT IMAGES') }}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->otherUpload()->count()}}</span>
            </a>
          </li>
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_4_4_tab_content" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('ACTION HISTORY') }}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->comment()->where('action', '!=', 'pending')->count()}}</span>
            </a>
          </li>
          @endif
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="event-tab" role="tabpanel">
             <table class="table border borderless table-hover table-" id="requirement-table">
              <thead>
                <tr>
                   <th>{{ __('REQUIREMENT NAME') }}</th>
                   <th>{{ __('FILES') }}</th>
                   <th>{{ __('ISSUED DATE') }}</th>
                   <th>{{ __('EXPIRY DATE') }}</th>
                </tr>
              </thead>
             </table>
          </div>
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <div class="tab-pane" id="truck-tab" role="tabpanel">
             <table class="table border borderless table-hover table-sm" id="truck-table">
              <thead>
                <tr>
                   <th>{{ __('NAME') }}</th>
                   <th>{{ __('ESTABLISHMENT NAME') }}</th>
                   <th>{{ __('SERVICE TYPE') }}</th>
                   <th>{{ __('TRAFFIC PLATE NUMBER') }}</th>
                   <th>{{ __('ISSUED DATE') }}</th>
                   <th>{{ __('REGISTRATION EXPIRY DATE') }}</th>
                   <th>{{ __('ACTION') }}</th>
                </tr>
              </thead>
             </table>
          </div>
          @endif
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
           <div class="tab-pane" id="liquor-tab" role="tabpanel">
              {{-- <table class="table table-borderless "></table> --}}
           </div>
          @endif
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <div class="tab-pane " id="artist-tab" role="tabpanel">
             <table class="table border borderless table-hover table-" id="artist-table">
              <thead>
                <tr>
                   <th></th>
                   <th>{{ __('NAME') }}</th>
                   <th>{{ __('PROFESSION') }}</th>
                   <th>{{ __('PERSON CODE') }}</th>
                   <th>{{ __('BIRTHDATE') }}</th>
                   <th>{{ __('AGE') }}</th>
                   <th>{{ __('MOBILE NUMBER') }}</th>
                   <th>{{ __('EMAIL') }}</th>
                </tr>
              </thead>
             </table>
          </div>
          @endif
          <div class="tab-pane" id="images-tab" role="tabpanel">
           <table class="table border borderless table-hover" id="image-table">
              <thead>
                <tr>
                  <th>{{ __('FILES') }}</th>
                </tr>
              </thead>
             </table>
          </div>
          @if(!Auth::user()->roles()->whereIn('roles.role_id', [6])->exists())
          <div class="tab-pane" id="kt_portlet_base_demo_4_4_tab_content" role="tabpanel">
            <table class="table table-hover table-borderless border table-striped table-sm" id="event-comment-datatable">
                <thead>
                    <tr>
                        <th class="no-wrap">{{ __('NAME') }}</th>
                        <th>{{ __('REMARKS') }}</th>
                        <th class="no-wrap">{{ __('DATE') }}</th>
                        <th class="no-wrap">{{ __('ACTION TAKEN') }}</th>
                    </tr>
                </thead>
            </table>
          </div>
          @endif
        </div>
    </div>
</div>

<div class="modal fade" id="truck-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-borderless table-hover table-striped  border" id="truck-requirement-table">
            <thead>
              <tr>
                 <th>{{ __('REQUIREMENT NAME') }}</th>
                 <th>{{ __('FILES') }}</th>
                 <th>{{ __('ISSUED DATE') }}</th>
                 <th>{{ __('EXPIRY DATE') }}</th>
                 <th>{{ __('ACTION') }}</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
<script>
  var document_table = {};
  var comment_table = {};
  $(document).ready(function(){

    $('input[name=is_display_web]').change(function(){

       var val = $(this).is(':checked') ? 1 : null;

       bootbox.confirm('Are you sure you want to show the event to the public website calendar?', function(result){
         if(result){
           $.ajax({
             url: '{{ route('admin.event.showweb', $event->event_id) }}',
             data: {is_display_web: val }
           }).done(function(response){
           });
         }
       });
    });


    $('input[name=is_display_all]').change(function(){
      var el = $(this);
      if($(this).is(':checked')){
       var val = el.is(':checked') ? 1 : null;
       bootbox.confirm('Are you sure you want to show the event to registered user\'s calendar?', function(result){
         if(result){
           $.ajax({
             url: '{{ route('admin.event.showall', $event->event_id) }}',
             data: {is_display_all: val }
           }).done(function(response){

           });
         }
         else{
          var res = $('input[name=is_display_all]').removeAttr('checked', true);
          console.log(res);
          // el.removeAttr('checked', true);

         }
       });
      }
      else{
        var val = !$(this).is(':checked') ? 0 : 1;
        bootbox.confirm('Are you sure you want to remove the event from registered user\'s calendar?', function(result){
          if(result){
            $.ajax({
              url: '{{ route('admin.event.showall', $event->event_id) }}',
              data: {is_display_all: val }
            }).done(function(response){

            });
          }
          else{
            $('input[name=is_display_all]').attr('checked', true);
          }
        });
      }
    });

    $('form#frm-status').validate();
    $('form#frm-savecomment').validate();

     eventComment();
     requirementTable();
     imageTable();
     artist();
     truckTable();

     $('#btnCheckedPermit').click(function(){
        bootbox.confirm('{{ __('Are you sure you want submit') }}', function(result){
          if(result){
              $('#frm-savecomment').trigger('submit');
          }
        });
     });

  });

  function artist(){
    $('#artist-table').DataTable({
      ajax: '{{ route('admin.event.artist', $event->event_id) }}',
      columnDefs:[
        {targets: '_all', className: 'no-wrap'},
      ],
      responsive: true,
      columns:[
        {render: function(data){ return null}},
        {data: 'name'},
        {data: 'profession'},
        {data: 'person_code'},
        {data: 'birthdate'},
        {data: 'age'},
        {data: 'mobile_number'},
        {data: 'email'},
      ]
    });
  }

  function truckTable(){
    $('table#truck-table').DataTable({
      ajax: '{{ route('admin.event.truck.datatable', $event->event_id) }}',
      columnDefs:[
      {targets:'_all', className:'no-wrap'},
      ],
      responsive:true,
      columns: [
      {
        render: function(data, row, full, meta){
          return 'Food Truck No. '+full.DT_RowIndex;
        }
      },
      {data: 'name'},
      {data: 'type'},
      {data: 'plate_number'},
      {data: 'issued_date'},
      {data: 'expired_date'},
      {data: 'action'},
      ],
      createdRow: function(row, data, index){
        $('.btn-document', row).click(function(){
          $('#truck-modal').modal('show');
          $('#title').html('Food Truck No. '+data.DT_RowIndex);
          truckRequirement(data);
        });
      }
    });
   }


  function truckRequirement(data){
      $('table#truck-requirement-table').DataTable({
        ajax: '{{ url('/event') }}/'+'{{$event->event_id}}'+'/truck/'+data.event_truck_id+'/datatable',
        columnDefs:[
          {targets:[1,2,3,4], className:'no-wrap'},
          ],
          "order": [[ 0, 'asc' ]],
            rowGroup: {
              startRender: function ( rows, group ) {
               var row_data = rows.data()[0];
               return $('<tr/>').append( '<td >'+group+'</td>' )
                          .append( '<td>'+rows.count()+'</td>' )
                          .append( '<td>'+row_data.issued_date+'</td>' )
                                .append( '<td>'+row_data.expired_date+'</td>' )
                                .append( '<td></td>' )
                                .append( '<tr/>' );
                },
             dataSrc: 'name'
          },
          columns:[
            {data: 'files'},
            {render: function(data){ return null}},
            {render: function(data){ return null}},
            {render: function(data){ return null}},
            {
             render: function (row, type, full, meta) {
               var html = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">';
               html += '<input type="checkbox" class="step-2" data-step="2">';
               html += '<span></span>';
               html += '</label>';
               return html;
             }
           }
         ],

      });
     }

     function imageTable(){
      $('table#image-table').DataTable({
        ajax: '{{ route('admin.event.images.datatable', $event->event_id) }}',
        columns:[
        {data: 'path'}
        ]
      });
     }

  function requirementTable(){
    $('table#requirement-table').DataTable({
         ajax: {
           url: '{{ route('admin.event.applicationDatatable',  $event->event_id) }}',
            data: function(d){},
         },
         columnDefs:[
           {targets: [1,2, 3], className: 'no-wrap'},
         ],
          "order": [[ 0, 'asc' ]],
          rowGroup: {
            startRender: function ( rows, group ) {
             var row_data = rows.data()[0];
             return $('<tr/>').append( '<td >'+group+'</td>' )
                        .append( '<td>'+rows.count()+'</td>' )
                        .append( '<td>'+row_data.issued_date+'</td>' )
                              .append( '<td>'+row_data.expired_date+'</td>' )
                              .append( '<td></td>' )
                              .append( '<tr/>' );
              },
           dataSrc: 'name'
        },
         columns:[
           {data: 'files'},
           {render: function(data){ return null}},
           {render: function(data){ return null}},
           {render: function(data){ return null}},
         ],
       });


     }

  function eventComment(){
    comment_table = $('table#event-comment-datatable').DataTable({
      ajax:{
        url: '{{ route('admin.event.comment', $event->event_id) }}',
      },
      columnDefs:[{target:'_all', className: 'no-wrap'}],
      responsive: true,
      columns: [
      {data: 'name'},
      {data: 'comment'},
      {data: 'date'},
      {data: 'action_taken'},
      ]
    });
  }
</script>
@endsection
