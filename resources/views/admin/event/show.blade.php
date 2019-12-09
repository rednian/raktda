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
            <h3 class="kt-portlet__head-title kt-font-dark">{{ Auth::user()->LanguageId == 1 ? ucfirst($event->name_en) : ucfirst($event->name_ar) }} - {{ __('DETAILS') }}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.event.index') }}#{{ $tab }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
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
      @include('admin.event.includes.existing-notification')
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

        </div>
        <div class="col-md-4 border">
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
      </section>
        <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x nav-tabs-line-right" role="tablist">
          <li class="nav-item">
            <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_1_4_tab_content" role="tab">
              <i class="fa fa-calendar-check-o" aria-hidden="true"></i>{{ __('EVENT REQUIREMENTS') }}
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->eventRequirement()->count()}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_2_4_tab_content" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('TRUCK INFORMATION') }} 
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->truck()->count()}}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_3_4_tab_content" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('ARTIST INFORMATION') }} 
              {{-- <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->truck()->count()}}</span> --}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_portlet_base_demo_4_4_tab_content" role="tab">
              <i class="fa fa-bar-chart" aria-hidden="true"></i>{{ __('ACTION HISTORY') }} 
              <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->comment()->count()}}</span>
            </a>
          </li>
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="kt_portlet_base_demo_1_4_tab_content" role="tabpanel">
             <table class="table border borderless table-hover table-" id="requirement-table">
              <thead>
                <tr>
                   <th>{{ __('REQUIREMENT NAME') }}</th>
                   <th>{{ __('FILES') }}</th>
                   <th>{{ __('ISSUED DATE') }}</th>
                   <th>{{ __('EXPIRED DATE') }}</th>
                </tr>
              </thead>
             </table>
          </div>
          <div class="tab-pane" id="kt_portlet_base_demo_2_4_tab_content" role="tabpanel">
            <table class="table table-hover table-borderless border table-striped table-sm" id="event-comment-datatable">
                <thead>
                    <tr>
                        <th class="no-wrap">{{ __('NAME') }}</th>
                        <th>{{ __('REMARKS') }}</th>
                        <th class="no-wrap">{{ __('CHECKED DATE') }}</th>
                        <th class="no-wrap">{{ __('ACTION TAKEN') }}</th>
                    </tr>
                </thead>
            </table>
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

     eventComment();
     requirementTable();
  });

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