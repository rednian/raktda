@extends('layouts.app')

@section('title', 'Payment Artist Permit - Smart Government Rak')


@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Make Payment')}}
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right permit--action-bar">
                        <a href="{{URL::signedRoute('artist.index')}}#applied"
                            class="btn btn--maroon kt-font-bold kt-font-transform-u btn-sm">
                            <i class="la la-arrow-left"></i>
                            {{__('Back')}}
                        </a>
                    </div>
                    <div class="my-auto float-right permit--action-bar--mobile">
                        <a href="{{URL::signedRoute('artist.index')}}#applied"
                            class="btn btn--maroon btn-elevate btn-sm">
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
                                    <span class="btn btn-label-success btn-sm btn-bold btn-upper">
                                        {{date('d M, y',strtotime($permit_details->issued_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('To Date')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-danger btn-sm btn-bold btn-upper">
                                        {{date('d M, y',strtotime($permit_details->expired_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('Permit Duration')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                        {{calculateDateDiff($permit_details->issued_date, $permit_details->expired_date)}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('Reference Number')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{$permit_details->reference_number}}
                                    </span>
                                </div>
                            </div>
                            @if($permit_details->event)
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('Connected Event ?')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{getLangId() == 1 ? ucwords($permit_details->event->name_en) : $permit_details->event->name_ar}}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="kt-widget__text kt-margin-t-10">
                            <strong>{{__('Work Location')}} :</strong>
                            {{getLangId() == 1 ? ucwords($permit_details->work_location) : $permit_details->work_location_ar}}
                        </div>
                    </div>



                    <div class="table-responsive">
                        <table class="table table-striped border table-hover table-borderless"
                            id="applied-artists-table">
                            <thead>
                                <tr class="kt-font-transform-u">
                                    <th>{{__('First Name')}}</th>
                                    <th>{{__('Last Name')}}</th>
                                    <th>{{__('Profession')}}</th>
                                    <th>{{__('Mobile Number')}}</th>
                                    {{-- <th>Email</th> --}}
                                    <th>{{__('Status')}}</th>
                                    <th class="text-center">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $statuses = [];
                                @endphp
                                @foreach ($permit_details->artistPermit as $artistPermit)
                                <tr>
                                    <td>{{ getLangId() == 1 ? ucwords($artistPermit->firstname_en) : $artistPermit->firstname_ar}}
                                    </td>
                                    <td>{{ getLangId() == 1 ? ucwords($artistPermit->lastname_en) : $artistPermit->lastname_ar}}
                                    </td>
                                    <td>{{ getLangId() == 1 ? ucwords($artistPermit->profession['name_en']) : $artistPermit->profession['name_ar']}}
                                    </td>
                                    <td>{{$artistPermit->mobile_number}}</td>
                                    {{-- <td>{{$artistPermit->email}}</td> --}}
                                    <td style="color:{{$artistPermit->artist_permit_status == 'approved' ? 'limegreen' : 'darkred'}}"
                                        class="kt-font-bold">
                                        {{ucwords($artistPermit->artist_permit_status)}}
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


                    <div class="d-flex justify-content-end">
                        <a href="{{URL::signedRoute('company.payment_gateway',[ 'id' => $permit_details->permit_id])}}">
                            <button class="btn btn--yellow btn-md btn-wide kt-font-bold kt-font-transform-u btn-sm"
                                {{in_array('approved',$statuses) ? '' : 'disabled'}}>
                                <i class="la la-check"></i>
                                {{__('Make Payment')}}
                            </button>
                        </a>
                    </div>



                </div>
            </div>

            @endsection