@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Event Permit Details
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$event->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    Back
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>

            </div>
        </div>
    </div>


    <div class="kt-portlet__body">
        <div class="kt-container">
            <div class="event--view-head">
                <div class="col-md-12 pb-4 d-flex flex-sm-column flex-md-row">
                    <div class="col-md-4 img-responsive">
                        <img src="{{url('storage').'/'.$event->logo_thumbnail}}" alt="image">
                    </div>
                    <div class="col-md-8 d-flex flex-column justify-content-flex-start">
                        <div class="pb-2 row">
                            <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">REF
                                NO</label>
                            <span class="col-md-6">{{$event->reference_number}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Application
                                Type</label>
                            <span class="col-md-6">{{ucwords($event->firm)}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">EVENT
                                NAME</label>
                            <span class="col-md-6">{{getLangId() == 1 ? $event->name_en : $event->name_ar}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">VENUE
                                NAME
                            </label>
                            <span class="col-md-6">{{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">ADDRESS</label>
                            <span class="col-md-6">{{$event->address}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">AREA</label>
                            <span class="col-md-6">{{$event->area['area_en']}}</span>
                        </div>

                    </div>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Issue
                        Date</label>
                    <span class="col-md-6">{{$event->issued_date}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Expiry
                        Date</label>
                    <span class="col-md-6">{{$event->expired_date}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Est.
                        Audience</label>
                    <span class="col-md-6">{{$event->audience_number}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Time from
                    </label>
                    <span class="col-md-6">{{$event->time_start}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Time To
                    </label>
                    <span class="col-md-6">{{$event->time_end}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Description
                    </label>
                    <span
                        class="col-md-6">{{getLangId() == 1 ? $event->description_en : $event->description_ar }}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Street
                    </label>
                    <span class="col-md-6">{{$event->street}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Longitude
                    </label>
                    <span class="col-md-6">{{$event->longitude}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Latitude
                    </label>
                    <span class="col-md-6">{{$event->latitude}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Have Truck ?
                    </label>
                    <span class="col-md-6">{{$event->is_truck == 1 ? 'Yes' : 'No'}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Have Liquor ?
                    </label>
                    <span class="col-md-6">{{$event->is_liquor == 1 ? 'Yes' : 'No'}}</span>
                </div>
            </div>
            <input type="hidden" class="map-input" id="address-input" value="{{$event->address}}" />
            <input type="hidden" id="latitude" value="{{$event->latitude}}" />
            <input type="hidden" id="longitude" value="{{$event->longitude}}" />
            <div id="address-map-container" style="width:100%;height:200px;padding:15px;">
                <div style="width: 100%; height: 100%" id="map"></div>
            </div>
            @if($artist)
            {{-- {{dd($artist)}} --}}
            <div class="pt-2 img-responsive">
                <h5 class="text--maroon kt-font-transform-u p-4">Artist Details</h5>
                <table class="table table-striped table-hover border table-borderless">
                    <thead>
                        <tr>
                            <th>@lang('words.first_name')</th>
                            <th>@lang('words.last_name')</th>
                            <th>@lang('words.profession')</th>
                            <th>@lang('words.mobile_number')</th>
                            <th>@lang('words.status')</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artist->artistPermit as $at)
                        <tr>
                            <td>{{$at->firstname_en}}</td>
                            <td>{{$at->lastname_en}}</td>
                            <td>{{$at->profession['name_en']}}</td>
                            <td>{{$at->mobile_number}}</td>
                            <td>
                                {{ucwords($at->artist_permit_status)}}
                            </td>

                            <td class="text-center"> <a
                                    href="{{route('artist_details.view' , [ 'id' => $at->artist_permit_id , 'from' => 'event'])}}"
                                    title="View">
                                    <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                                </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @if(count($eventReq) > 0)
            <div class="event--requirement-files pt-5">
                <table class="table table-hover table-borderless border table-striped">
                    <thead class="text-center">
                        <tr>
                            <th class="text-left">Document Name</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventReq as $req)
                        <tr>
                            <td style="width:50%;">{{$req->requirement_name}}</td>
                            <td class="text-center">
                                {{$req->pivot['issued_date'] != '0000-00-00' ? date('d-m-Y', strtotime($req->pivot['issued_date'])) : ''}}
                            </td>
                            <td class="text-center">
                                {{$req->pivot['expired_date'] != '0000-00-00' ? date('d-m-Y', strtotime($req->pivot['expired_date'])) : ''}}
                            </td>
                            <td class="text-center">
                                <a href="{{asset('storage')}}{{'/'.$req->pivot['path']}}" target="blank" ">
                                    <button class=" btn btn-sm btn-secondary">View
                                    </button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @endif
            @endsection

            @section('script')
            <script src="{{asset('js/company/map.js')}}"></script>
            <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6nhSpjNed-wgUyVMJQZJTRniW-Oj_Tgw&libraries=places&callback=initialize"
                async defer></script>
            @endsection