@extends('layouts.app')

@section('title', 'Payment Artist Permit - Smart Government Rak')


@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Fees payment')}}
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right permit--action-bar">
                        <a href="{{URL::signedRoute('artist.index')}}#applied"
                            class="btn btn--maroon kt-font-bold kt-font-transform-u btn-sm">
                            <i class="la la-angle-left"></i>
                            {{__('BACK')}}
                        </a>
                    </div>
                    <div class="my-auto float-right permit--action-bar--mobile">
                        <a href="{{URL::signedRoute('artist.index')}}#applied"
                            class="btn btn--maroon btn-elevate btn-sm">
                            <i class="la la-angle-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body kt-padding-t-0">
                <div class="kt-widget kt-widget--project-1">
                    <div class="kt-widget__body kt-padding-l-0">
                        <div class="kt-widget__stats d-">
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('From Date')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                        {{date('d F Y',strtotime($permit_details->issued_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('To Date')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                        {{date('d F Y',strtotime($permit_details->expired_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('Permit Duration')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                        {{calculateDateDiff($permit_details->issued_date, $permit_details->expired_date)}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('Reference No')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{$permit_details->reference_number}}
                                    </span>
                                </div>
                            </div>
                            @if($permit_details->event)
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('Connected to Event')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{getLangId() == 1 ? ucwords($permit_details->event->name_en) : $permit_details->event->name_ar}}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="kt-widget__text kt-margin-t-20">
                            <strong>{{__('Work Location')}} :</strong>
                            {{getLangId() == 1 ? ucwords($permit_details->work_location) : $permit_details->work_location_ar}}
                        </div>
                    </div>



                    <div class="table-responsive">
                        <table class="table table-striped border table-hover table-borderless"
                            id="applied-artists-table">
                            <thead>
                                <tr class="kt-font-transform-u">
                                    <th>{{__('FIRST NAME')}}</th>
                                    <th>{{__('LAST NAME')}}</th>
                                    <th>{{__('PROFESSION')}}</th>
                                    <th>{{__('MOBILE NUMBER')}}</th>
                                    {{-- <th>Email</th> --}}
                                    <th>{{__('STATUS')}}</th>
                                    <th class="text-center">{{__('ACTION')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $statuses = [];
                                @endphp
                                @foreach ($permit_details->artistPermit as $artistPermit)
                                <tr>
                                    <td>{{ getLangId() == 1 ? ucfirst($artistPermit->firstname_en) : $artistPermit->firstname_ar}}
                                    </td>
                                    <td>{{ getLangId() == 1 ? ucfirst($artistPermit->lastname_en) : $artistPermit->lastname_ar}}
                                    </td>
                                    <td>{{ getLangId() == 1 ? ucfirst($artistPermit->profession['name_en']) : $artistPermit->profession['name_ar']}}
                                    </td>
                                    <td>{{$artistPermit->mobile_number}}</td>
                                    {{-- <td>{{$artistPermit->email}}</td> --}}
                                    <td style="color:{{$artistPermit->artist_permit_status == 'approved' ? 'limegreen' : 'darkred'}}"
                                        class="kt-font-bold">
                                        {{__(ucfirst($artistPermit->artist_permit_status))}}
                                    </td>
                                    <td class=" text-center">
                                        {{-- <a href="#" data-toggle="modal"
                                        onclick="getArtistDetails({{$artistPermit->artist_id}},{{$artistPermit->artist_permit_id}})"
                                        title="View">
                                        <button class="btn btn-sm btn-secondary btn-elevate ">View</button>
                                        </a> --}}
                                        <a
                                            href="{{URL::signedRoute('artist_details.view' , [ 'id' => $artistPermit->artist_permit_id , 'from' => 'payment'])}}">
                                            <button class="btn btn-sm btn-secondary btn-elevate">{{__('View')}}</button>
                                        </a>
                                    </td>
                                </tr>
                                @php
                                array_push($statuses, $artistPermit->artist_permit_status);
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{URL::signedRoute('company.payment_gateway',[ 'id' => $permit_details->permit_id])}}">
                            <button class="btn btn--yellow btn-md btn-wide kt-font-bold kt-font-transform-u btn-sm"
                                {{in_array('approved',$statuses) ? '' : 'disabled'}}>
                                {{__('Fees payment')}}
                            </button>
                        </a>
                    </div>



                </div>
            </div>

            @endsection
