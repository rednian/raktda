@extends('layouts.app')

@section('title', 'View Artist Permit Details - Smart Government Rak')

@section('content')

@if(check_is_blocked()['status'] == 'blocked')
@include('permits.artist.common.company_block')
@endif


<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('ARTIST PERMIT DETAILS')}}</h3>
            <span class=" text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$permit_details->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                @if(check_is_blocked()['status'] != 'blocked')
                @if($permit_details->permit_status == 'approved-unpaid')
                @if($permit_details->event)
                @if($permit_details->event->firm == 'government' || $permit_details->event->exempt_payment == 1)
                <a href="{{URL::signedRoute('company.happiness_center',  $permit_details->permit_id)}}"
                    class="btn btn-success btn-sm kt-font-bold kt-font-transform-u kt-margin-r-10">
                    {{__('Happiness')}}
                </a>
                @endif
                @else
                <a href="{{URL::signedRoute('company.make_payment',  $permit_details->permit_id)}}"
                    class="btn btn-success btn-sm kt-font-bold kt-font-transform-u kt-margin-r-10">
                    {{__('Payment')}}
                    @endif
                    @elseif($permit_details->permit_status == 'modification request')
                    @php
                    $approved_artist = false;
                    foreach ($permit_details->artistPermit as $ap) {
                    if ($ap->artist_permit_status == 'approved') {
                    $approved_artist = true;
                    }
                    }
                    @endphp
                    <a
                        href="{{URL::signedRoute('artist.permit', ['id' => $permit_details->permit_id, 'status' => 'edit'])}}"><span
                            class="btn btn-warning btn-sm kt-margin-r-10">{{__('EDIT')}}</span></a>
                    @if($approved_artist)
                    @if($permit_details->event)
                    @if($permit_details->event->firm == 'government')
                    <a href="{{URL::signedRoute('company.happiness_center', $permit_details->permit_id)}}"><span
                            class="btn btn-success btn-sm kt-margin-r-10">{{__('HAPPINESS')}}</span></a>
                    @endif
                    @else
                    <a href="{{URL::signedRoute('company.make_payment', $permit_details->permit_id)}}"><span
                            class="btn btn-success btn-sm kt-margin-r-10">{{__('PAYMENT')}}</span></a>
                    @endif
                    @endif
                    @endif
                    @endif
                    <a href="{{URL::signedRoute('artist.index')}}#{{$tab}}"
                        class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u">
                        <i class="la la-arrow-left"></i>
                        {{__('BACK')}}
                    </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                @if(check_is_blocked()['status'] != 'blocked')
                @if($permit_details->permit_status == 'approved-unpaid')
                @if($permit_details->event)
                @if($permit_details->event->firm == 'government' || $permit_details->event->exempt_payment == 1)
                <a href="{{URL::signedRoute('company.happiness_center',  $permit_details->permit_id)}}"
                    class="btn btn-success btn-sm kt-font-bold kt-font-transform-u kt-margin-r-10">
                    <i class="fa fa-smile"> </i>
                </a>
                @endif
                @else
                <a href="{{URL::signedRoute('company.make_payment',  $permit_details->permit_id)}}"
                    class="btn btn-success btn-sm kt-font-bold kt-font-transform-u kt-margin-r-10">
                    <i class="fa fa-money-bill-wave"> </i>
                    @endif
                    @elseif($permit_details->permit_status == 'modification request')
                    @php
                    $approved_artist = false;
                    foreach ($permit_details->artistPermit as $ap) {
                    if ($ap->artist_permit_status == 'approved') {
                    $approved_artist = true;
                    }
                    }
                    @endphp
                    <a
                        href="{{URL::signedRoute('artist.permit', ['id' => $permit_details->permit_id, 'status' => 'edit'])}}"><span
                            class="btn btn-warning btn-sm kt-margin-r-10"><i class="fa fa-edit"></i></span></a>
                    @if($approved_artist)
                    @if($permit_details->event)
                    @if($permit_details->event->firm == 'government')
                    <a href="{{URL::signedRoute('company.happiness_center', $permit_details->permit_id)}}"><span
                            class="btn btn-success btn-sm kt-margin-r-10"><i class="fa fa-smile"> </i></span></a>
                    @endif
                    @else
                    <a href="{{URL::signedRoute('company.make_payment', $permit_details->permit_id)}}"><span
                            class="btn btn-success btn-sm kt-margin-r-10"><i class="fa fa-money-bill-wave">
                            </i></span></a>
                    @endif
                    @endif
                    @endif
                    @endif
                    <a href="{{URL::signedRoute('artist.index')}}#{{$tab}}" class="btn btn--maroon btn-sm">
                        <i class="la la-arrow-left"></i>
                    </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-widget kt-widget--project-1">
            <div class="kt-widget__body kt-padding-l-0">
                <div class="kt-widget__stats d-">
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('From Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                {{date('d F Y',strtotime($permit_details->issued_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('To Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                {{date('d F Y',strtotime($permit_details->expired_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Permit Duration')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                {{calculateDateDiff($permit_details->issued_date, $permit_details->expired_date)}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Reference No')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{$permit_details->reference_number}}
                            </span>
                        </div>
                    </div>
                    @if($permit_details->event)
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Connected Event')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{getLangId() == 1 ? ucwords($permit_details->event->name_en) : $permit_details->event->name_ar}}
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="kt-widget__text kt-margin-t-20">
                    <strong>{{__('Work Location')}} :</strong>
                    {{getLangId() == 1 ? ucfirst($permit_details->work_location) : $permit_details->work_location_ar}}
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped table-hover border table-borderless  " id="applied-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u ">
                            <th>{{__('FIRST NAME')}}</th>
                            <th>{{__('LAST NAME')}}</th>
                            <th>{{__('PROFESSION')}}</th>
                            <th>{{__('MOBILE NUMBER')}}</th>
                            {{-- <th>@lang('words.email')</th> --}}
                            <th>{{__('STATUS')}}</th>
                            <th class="text-center">{{__('ACTION')}}</th>
                        </tr>
                    </thead>
                    {{-- {{dd($permit_details)}} --}}
                    <tbody>
                        @foreach ($permit_details->artistPermit as $artistPermit)
                        <tr>
                            <td>{{ getLangId() == 1 ? ucfirst($artistPermit->firstname_en) : $artistPermit->firstname_ar }}
                            </td>
                            <td>{{ getLangId() == 1 ? ucfirst($artistPermit->lastname_en) : $artistPermit->lastname_ar }}
                            </td>
                            <td>{{ getLangId() == 1 ? ucfirst($artistPermit->profession['name_en']) : $artistPermit->profession['name_ar']}}
                            </td>
                            <td>{{$artistPermit->mobile_number}}</td>
                            {{-- <td>{{$artistPermit->email}}</td> --}}
                            <td>
                                {{ucwords($artistPermit->artist_permit_status)}}
                            </td>


                            <td class="text-center"> <a
                                    href="{{URL::signedRoute('artist_details.view' , [ 'id' => $artistPermit->artist_permit_id , 'from' => $tab])}}">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning">{{__('View')}}</button>
                                </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    @endsection