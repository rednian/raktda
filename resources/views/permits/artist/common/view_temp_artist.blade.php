@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Artist Details
            </h3>
        </div>


        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                @if($from == 'new')
                <a href="{{url('company/add_new_permit/1')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    @else
                    <a href="{{url('company/artist/permit').'/'.$artist_details->permit_id.'/'.$from}}"
                        class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                        @endif
                        <i class="la la-arrow-left"></i>
                        Back
                    </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{url('company/get_permit_details?tab=applied')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
                <div class="kt-widget__media">
                    <img src="{{url('storage').'/'.$artist_details->thumbnail}}" alt="image">
                </div>
                @if($artist_details->thumbnail == '')
                <div
                    class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden-">
                    {{$artist_details->firstname_en[0]}}
                </div>
                @endif
                <div class="kt-widget__content">
                    <div class="kt-widget__head">
                        <a href="#" class="kt-widget__username">
                            {{$artist_details->firstname_en.' '.$artist_details->lastname_en}} &emsp;
                            {{$artist_details->firstname_ar.' '.$artist_details->lastname_ar}}
                        </a>
                    </div>
                    <div class="kt-widget__subhead">
                        <a href="#"><i class="flaticon2-new-email"></i>{{$artist_details->email}}</a>
                        <a href="#"><i class="flaticon2-phone"></i>{{$artist_details->mobile_number}}</a>
                        <a href="#"><i
                                class="flaticon2-placeholder"></i>{{$artist_details->Nationality['nationality_en']}}</a>
                    </div>
                    <div class="kt-widget__info mt-5">
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Birth Date:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{date('d-M-Y', strtotime($artist_details->birthdate))}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Gender:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->gender == '1' ? 'Male' : 'Female'}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Passport No:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->passport_number}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Passport Expiry:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{date('d-M-Y', strtotime($artist_details->passport_expire_date))}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Phone Number:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->phone_number}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Visa Number:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->visa_number}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Visa Expiry:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{date('d-M-Y', strtotime($artist_details->visa_expire_date))}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>UID No:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->uid_number}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Sponser Name:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->sponsor_name_en}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Sponser Name - Ar:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->sponsor_name_ar}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Address:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->address_en}}</p>
                        </div>
                        <div class="col-md-6 col-sm-12 row">
                            <label class="col col-md-6 text-md-right"><strong>Address - Ar:</strong></label>
                            <p class="col col-md-6 text-left">
                                {{$artist_details->address_ar}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @endsection
