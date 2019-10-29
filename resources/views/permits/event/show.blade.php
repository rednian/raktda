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
                    <div>{{$event->address}} </div>
                    <div>{{$event->area['area_en']}}</div>
                    <div>{{$event->emirate['name_en']}}</div>
                    <div>{{$event->country['name_en']}}</div>
                </div>
            </div>
            <div class="event--view-details">
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title text-left pl-4">EVENT NAME</span>
                    <span class="event--view-detail-item-value">{{$event->name_en}} <br> {{$event->name_ar}}</span>
                </div>
                <div class="event--view-detail-item ">
                    <span class="event--view-detail-item-title text-left pl-4">ISSUE DATE / TIME</span>
                    <span class="event--view-detail-item-value">{{$event->issued_date}} <br>
                        {{$event->time_start}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title text-left pl-4">EXPIRY DATE / TIME</span>
                    <span class="event--view-detail-item-value">{{$event->expired_date}} <br>
                        {{$event->time_end}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title text-left pl-4">VENUE NAME</span>
                    <span class="event--view-detail-item-value">{{$event->venue_en}} <br /> {{$event->venue_ar}}</span>
                </div>
            </div>
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
                                    <button class=" btn btn-sm btn--maroon text-white">View
                                    </button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @endif
            @endsection
