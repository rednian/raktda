@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
<style>
  .fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title { color: #fff; }
  .fc-unthemed .fc-event .fc-time, .fc-unthemed .fc-event-dot .fc-time { color: #fff; }
   .widget-toolbar{ cursor: pointer; }
</style>

<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/timeline/main.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/fullcalendar-scheduler/packages/resource-timeline/main.css') }}">
@stop
@section('content')
    <section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
         <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
             <div class="kt-portlet__head-label">
                  <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __($inspection->permit->reference_number . ' - EVENT INSPECTION') }}</h3>
             </div>

             <div class="kt-portlet__head-toolbar">
                <a href="{{ URL::signedRoute('inspection.index') }}" class="btn btn-sm btn-outline-secondary btn-elevate kt-font-transform-u kt-margin-r-10">
                   <i class="la la-arrow-left"></i>
                   {{ __('BACK TO LIST') }}
                </a>

                <a href="{{ URL::signedRoute('inspection.inspect', $inspection->approval_id) }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
                  <i class="la la-search"></i>
                   {{ __('START INSPECTION') }}
                </a>

             </div>
         </div>
         <div class="kt-portlet__body kt-padding-t-0">


           
        <section class="row">
        <div class="col-md-8">
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-5">{{__('Event Name')}} </span>: {{Auth::user()->LanguageId == 1 ?  ucfirst($event->name_en) : $event->name_ar }}</p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-15">{{__('Event Type ')}} </span>: 
            {{Auth::user()->LanguageId == 1 ?  ucfirst($event->type->name_en) : $event->type->name_ar }}
          </p>

          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-20">{{__('Start Date')}}</span>: {{ date('d-F-Y', strtotime($event->issued_date)) }}</p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-25">{{__('End Date ')}}</span>: {{ date('d-F-Y', strtotime($event->expired_date)) }}</p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-50">{{__('Time ')}}</span>:  {{ $event->time_start }} -- {{ $event->time_end }}</p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-40">{{__('Venue ')}}</span>: 
            {{  Auth::user()->LanguageId == 1 ? ucfirst($event->venue_en) :  $event->venue_ar }}
          </p>
          <p class="kt-margin-b-0 kt-font-dark"><span class="kt-font-bold kt-margin-r-30">{{__('Address ')}}</span>: {{ $event->full_address }}</p>
          {{-- <h6 class="kt-font-dark kt-margin-t-10">Event Map Location</h6> --}}
          <iframe class="border kt-padding-5" id='mapcanvas' src='https://maps.google.com/maps?q={{ urlencode($event->full_address)}}&Roadmap&z=10&ie=UTF8&iwloc=&output=embed&z=17'style="height: 310px; width: 100%; margin-top: 1%; border-style: none;" >
          </iframe>
          <section class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__bottom kt-margin-0" style="border:none;">
              <div class="kt-widget__item kt-padding-t-5">
                <div class="kt-widget__icon">
                  <i class="flaticon-truck"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{__('Food Truck')}}</span>
                  <span class="kt-widget__value">{{$event->truck()->count()}}</span>
                </div>
              </div>
              <div class="kt-widget__item  kt-padding-t-5">
                <div class="kt-widget__icon">
                  <i class="la la-glass"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{__('HAS LIQUOR')}}</span>
                  <a href="#" class="kt-widget__value">{{$event->liquor()->count() > 0 ? 'YES' : 'NO'}}</a>
                </div>
              </div>
              <div class="kt-widget__item kt-padding-t-5">
                <div class="kt-widget__icon">
                  <i class="flaticon-web"></i>
                </div>
                <div class="kt-widget__details">
                  <span class="kt-widget__title">{{{__('IMAGES UPLOADED')}}}</span>
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
          
          <h6 class="kt-margin-t-10 kt-font-dark">{{__('Event Description')}}</h6>
          <p class="border kt-padding-5 kt-font-dark">
            {{ Auth::user()->LanguageId == 1 ? ucfirst($event->description_en) : $event->description_ar }}
          </p>

          <div class="row">
            <div class="col-sm-12">
              <h6 class="kt-margin-t-10 kt-font-dark">{{__('Appointment Details')}}</h6>
              <div class="border kt-padding-10 kt-font-dark">
                  <div class="row">
                      <div class="col-sm-12">
                        <div class="btn-group pull-right">
                          <button type="button" data-submittype="continue" class="btn btn-sm btn-warning btn-submit">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">{{ __('Save') }}</span>
                          </button>
                          <button type="button" class="btn btn-sm btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu dropdown-menu-right">
                            <ul class="kt-nav">
                              <li class="kt-nav__item">
                                <a href="#" data-submittype="continue" class="kt-nav__link btn-submit">
                                  <i class="kt-nav__link-icon flaticon2-reload"></i>
                                  <span class="kt-nav__link-text">{{ __('Save & Continue') }}</span>
                                </a>
                              </li>
                              <li class="kt-nav__item">
                                <a href="#" data-submittype="new" class="kt-nav__link btn-submit">
                                  <i class="kt-nav__link-icon flaticon2-add-1"></i>
                                  <span class="kt-nav__link-text">{{ __('Save & exit') }}</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="row">

                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="example-search-input" class="kt-font-dark">{{ __('Start Date & Time') }}
                                  <span class="text-danger">*</span>
                              </label>
                              
                              <div class="input-group input-group-sm">
                                <div class="kt-input-icon kt-input-icon--right">
                                  <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="Select date and time" id="kt_datetimepicker_start">
                                  <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                    <span><i class="la la-calendar"></i></span>
                                  </span>
                                </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="form-group">
                              <label for="example-search-input" class="kt-font-dark">{{ __('End Date & Time') }}
                                  <span class="text-danger">*</span>
                              </label>
                              {{-- <div class="input-group date">
                                <input required name="leave_end" type="text" class="form-control" id="kt_datetimepicker_end" placeholder="Select date and time"/>
                                <div class="input-group-append">
                                  <span class="input-group-text">
                                    <i class="la la-calendar glyphicon-th"></i>
                                  </span>
                                </div>
                            </div> --}}
                              <div class="input-group input-group-sm">
                                <div class="kt-input-icon kt-input-icon--right">
                                  <input autocomplete="off" type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="Select date and time" id="kt_datetimepicker_end">
                                  <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                    <span><i class="la la-calendar"></i></span>
                                  </span>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-md-4">
            <div class="border" style="padding:10px">
                
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
                  <div class="kt-widget__section">
                    <div class="kt-widget__button">
                      {!! permitStatus($event->status)!!}                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="kt-widget__body kt-margin-t-5">
                <hr>
                 <h6 class="kt-font-dark">{{ __('Permit Information') }}</h6>
                 <table class="table table-sm table-hover table-borderless table-display">
                  <tr>
                      <td>{{ __('Applied Date') }} : </td>
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
                     <tr>
                         <td>{{ __('Printed Note') }} :</td>
                          <td class="kt-font-dark">{{ Auth::user()->LanguageId == 1 ? ucfirst($event->note_en) : $event->note_ar }}</td>
                     </tr>      
                 </table>
                 <div class="d-flex justify-content-center">
                  @if ($event->transaction()->exists())
                   <button type="button" class="btn btn-secondary btn-sm kt-margin-r-5">Download</button>
                  @endif
                  @if ($event->status == 'active')
                   <button type="button" class="btn btn-maroon btn-sm">Cancel Event</button>
                  @endif
                 </div>
                 <hr>
                  <h6 class="kt-font-dark">{{ __('Establishment Information') }}</h6>
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
            
          </div>
    </section>
@stop
@section('script')
<script>
    $(document).ready(function(){
        $('#kt_datetimepicker_start').datetimepicker({
            format: "mm/dd/yyyy HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
        });

        $('#kt_datetimepicker_end').datetimepicker({
            format: "mm/dd/yyyy HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left'
        });
    });
</script>
@stop