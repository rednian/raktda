@extends('layouts.app')

@section('title', 'Artist Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Artist Details
            </h3>
        </div>
        @php
        if($from == 'new')
        {
        $routeBack = url('company/artist/new/1');
        }
        else if($from == 'draft')
        {
        $routeBack = url('company/artist/view_draft_details/'.$artist_details->permit_id);
        }
        else if($from == 'view-draft')
        {
        $routeBack = url('company/artist/get_draft_details/'.$artist_details->permit_id);
        }
        else {
        $routeBack = url('company/artist/permit/'.$artist_details->permit_id.'/'.$from);
        }
        @endphp

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{$routeBack}}" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    Back
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{$routeBack}}" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>


    <div class="kt-portlet__body">
        <div class="kt-container">
            <div class="artist--view-head">
                <div class="artist--view-head-image">
                    @if($artist_details->thumbnail == '')
                    <span
                        class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden-">
                        {{ucwords($artist_details->firstname_en[0])}}{{ucwords($artist_details->lastname_en[0])}}
                    </span>
                    @else
                    <img src="{{url('storage').'/'.$artist_details->thumbnail}}" alt="image">
                    @endif
                </div>
                <div class="artist--view-head-details">
                    <span href="#"><i
                            class="flaticon2-user"></i>{{getLangId() == 1 ? ucwords($artist_details->firstname_en).' '.ucwords($artist_details->lastname_en) : ucwords($artist_details->firstname_ar).' '.ucwords($artist_details->lastname_ar)}}</span>
                    <span href="#"><i class="flaticon2-new-email"></i>{{$artist_details->email}}</span>
                    <span href="#"><i class="flaticon2-phone"></i>{{$artist_details->mobile_number}}</span>
                    <span href="#"><i
                            class="flaticon2-placeholder"></i>{{$artist_details->Nationality['nationality_en']}}</span>
                </div>
            </div>
            <div class="mt-5 col-md-12">
                <div class="row">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Birth Date:</strong></label>
                        <p class="col col-md-6">
                            {{date('d-M-Y', strtotime($artist_details->birthdate))}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Gender:</strong></label>
                        <p class="col col-md-6">
                            {{$artist_details->gender == '1' ? 'Male' : 'Female'}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Passport No:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->passport_number}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Passport Expiry:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{date('d-M-Y', strtotime($artist_details->passport_expire_date))}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Phone Number:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->phone_number ? $artist_details->phone_number : 'Not Given'}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Visa Type:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->visaType->visa_type_en}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Visa Number:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->visa_number}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Visa Expiry:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{date('d-M-Y', strtotime($artist_details->visa_expire_date))}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>UID No:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->uid_number}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>UID Expiry:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{date('d-M-Y', strtotime($artist_details->uid_expire_date))}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Sponser Name:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->sponsor_name_en}}</p>
                    </div>
                    <div class="col-md-6 col-sm-12 row">
                        <label class="col col-md-6 "><strong>Address:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->address_en}}</p>
                    </div>
                </div>
            </div>
            @if(count($artist_details->ArtistTempDocument) > 0)
            <div class="artist--documents pt-5">
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
                        @foreach($artist_details->ArtistTempDocument as $req)
                        <tr>
                            <td style="width:50%;">{{$req->requirement->requirement_name}}</td>
                            <td class="text-center">
                                {{$req->issued_date != '0000-00-00' ? date('d-m-Y', strtotime($req->issued_date)) : ''}}
                            </td>
                            <td class="text-center">
                                {{$req->expired_date != '0000-00-00' ? date('d-m-Y', strtotime($req->expired_date)) : ''}}
                            </td>
                            <td class="text-center">
                                <a href="{{asset('storage')}}{{'/'.$req->path}}" target="blank" ">
                                                                <button class=" btn btn-sm btn-secondary">View
                                    </button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

</div>

@endsection
