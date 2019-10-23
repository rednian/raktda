@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Event Permit Details
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                    Back
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                </a>

            </div>
        </div>
    </div>

    <div class="kt-portlet__body">


        <div class="kt-container">
            <div class="event--view-head">
                <h1>{{$event->reference_number}}</h1>
                <h1>{{$event->permit_number}}</h1>
                <div class="event--view-location">
                    <div>{{$event->venue_en}} {{$event->venue_ar}} </div>
                    <div>{{$event->area['area_en']}}</div>
                    <div>{{$event->emirate['name_en']}}</div>
                    <div>{{$event->country['name_en']}}</div>
                </div>
            </div>
            <div class="event--view-details">
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">NAME</span>
                    <span class="event--view-detail-item-value">{{$event->name_en}} <br> {{$event->name_ar}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">ISSUED DATE / TIME</span>
                    <span class="event--view-detail-item-value">{{$event->issued_date}} <br>
                        {{$event->time_start}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">EXPIRY DATE / TIME</span>
                    <span class="event--view-detail-item-value">{{$event->expired_date}} <br>
                        {{$event->time_end}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">ADDRESS</span>
                    <span class="event--view-detail-item-value">{{$event->address}}</span>
                </div>
            </div>
            @if(count($event->requirements) > 0)
            <div class="event--requirement-files pt-5">
                <h5>Documents</h5>
                <ul>
                    @php
                    $reqIds = array();
                    @endphp
                    @foreach($event->requirements as $req)
                    @if(!in_array($req->requirement_id, $reqIds))
                    <li class="kt-font-bold pt-2">
                        {{$req->requirement_name}}<br />
                        {{$req->requirement_description}} <br />
                        {{$req->pivot['issued_date'] != '0000-00-00' ? 'Issued
                        Date : '.date('d-m-Y', strtotime($req->pivot['issued_date'])) : ''}}&emsp;
                        {{$req->pivot['expired_date'] != '0000-00-00' ? 'Expired Date : '.date('d-m-Y', strtotime($req->pivot['expired_date'])) : ''}}<br />
                        @endif
                        <button class="btn btn-sm btn-info my-1"><a href="{{url('storage')}}{{'/'.$req->pivot['path']}}"
                                target="blank" class="text-white">View
                            </a></button>
                        @if(!in_array($req->requirement_id, $reqIds))
                    </li>
                    @endif
                    @php
                    array_push($reqIds, $req->requirement_id);
                    @endphp
                    @endforeach
                </ul>
            </div>
            @endif

            @endsection
