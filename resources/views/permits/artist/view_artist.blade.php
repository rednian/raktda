@extends('layouts.app')

@section('title', 'Artist Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title  kt-font-transform-u">{{__('Artist Details')}}
            </h3>
        </div>
        @php
        // if($from == 'details'){
        // $backUrl = url('company/artist/get_permit_details').'/'.$artist_details->permit_id .'?tab=applied' ;
        // } else if($from == 'payment') {
        // $backUrl = url('company/artist/make_payment/').'/'.$artist_details->permit_id ;
        // } else if($from == 'event') {
        // $backUrl = url('company/event').'/'.$artist_details->permit->event_id .'?tab=applied';
        // }

        if($from == 'details'){
        $backUrl = URL::signedRoute('company.get_permit_details',[ 'id' => $artist_details->permit_id , 'tab' =>
        'applied' ]);
        } else if($from == 'payment') {
        $backUrl = URL::signedRoute('company.make_payment', [ 'id' => $artist_details->permit_id ]);
        } else if($from == 'event') {
        $backUrl = URL::signedRoute('event.show',[ 'id' => $artist_details->permit->event_id , 'tab' => 'applied']);
        } else if($from == 'transaction') {
        $backUrl = URL::signedRoute('report.view',[ 'id' => $artist_details->artistPermitTransaction[0]->transaction_id
        ]);
        }

        @endphp

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{$backUrl}}" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{$backUrl}}" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
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
                        class="kt-widget__pic kt-widget__pic--danger kt-font-dark kt-font-boldest kt-font-light kt-hidden-">
                        {{ucwords($artist_details->firstname_en[0])}}{{ucwords($artist_details->lastname_en[0])}}
                    </span>
                    @else
                    <img src="{{url('storage').'/'.$artist_details->thumbnail}}" alt="image">
                    @endif
                </div>
                <div class="artist--view-head-details">
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0">
                        <i class="fa fa-user-alt text-muted la-2x"></i>
                        {{getLangId() == 1 ? ucwords($artist_details->firstname_en).' '.ucwords($artist_details->lastname_en) : ucwords($artist_details->firstname_ar).' '.ucwords($artist_details->lastname_ar)}}</span>
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0">
                        <i class="fa fa-id-card-alt fa-2x text-muted"></i>
                        {{$artist_details->artist['person_code'] ?? ''}}
                    </span>
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0"><i
                            class="fa fa-envelope fa-2x text-muted"></i>{{$artist_details->email}}</span>
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0">
                        <i class="fa fa-flag fa-2x text-muted"></i>
                        {{getLangId() == 1 ? ucwords($artist_details->Nationality['nationality_en']) : $artist_details->Nationality['nationality_ar']}}
                    </span>
                </div>
            </div>
            <div class="mt-5 col-md-12 ">
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Profession')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{getLangId() == 1 ? ucwords($artist_details->profession['name_en']) : $artist_details->profession['name_ar']}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Birth Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{date('d-M-Y', strtotime($artist_details->birthdate))}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Gender')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->gender == '1' ? __('Male') : __('Female')}}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Passport No')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->passport_number}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Passport Expiry')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->passport_expire_date->year > 1 ? date('d-M-Y', strtotime($artist_details->passport_expire_date)) : ''}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Mobile Number')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->mobile_number}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Visa Type')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->visaType ? $artist_details->visaType->visa_type_en : ''}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Visa Number')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->visa_number ? $artist_details->visa_number : ''}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Visa Expiry Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->visa_expire_date->year > 1 ? date('d-M-Y', strtotime($artist_details->visa_expire_date)) : ''}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('UID No')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->uid_number}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('UID Expiry Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->uid_expire_date->year > 1 ? date('d-M-Y', strtotime($artist_details->uid_expire_date)) : ''}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Phone Number')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$artist_details->phone_number ? $artist_details->phone_number : ''}}</p>
                    </div>
                    {{-- <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 ">{{__('Sponsor Name')}}:</label>
                    <p class="col col-md-6">
                        {{ucwords($artist_details->sponsor_name_en)}}</p>
                </div> --}}
            </div>
            <div class="row">
                <label class="col col-md-2 col-form-label kt-padding-r-0">{{__('Address')}}</label>
                <p class="col form-control-plaintext kt-font-bolder kt-padding-l-0">
                    {{ucwords($artist_details->address_en)}}</p>
            </div>
        </div>

        @if(count($artist_details->artistPermitDocument) > 0)
        <div class="artist--documents pt-5">
            <table class="table table-hover table-borderless border table-striped">
                <thead class="text-center">
                    <tr class=" kt-font-transform-u ">
                        <th class="text-left">{{__('Document Name')}}</th>
                        <th>{{__('Issued Date')}}</th>
                        <th>{{__('Expiry Date')}}</th>
                        <th>{{__('View')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artist_details->artistPermitDocument as $req)
                    <tr>
                        <td style="width:50%;">
                            {{$req->requirement ? ucfirst($req->requirement->requirement_name) : ''}}
                        </td>
                        <td class="text-center">
                            {{$req->issued_date != '0000-00-00' ? date('d-m-Y', strtotime($req->issued_date)) : ''}}
                        </td>
                        <td class="text-center">
                            {{$req->expired_date != '0000-00-00' ? date('d-m-Y', strtotime($req->expired_date)) : ''}}
                        </td>
                        <td class="text-center">
                            <a href="{{asset('storage')}}{{'/'.$req->path}}" target="blank" ">
                                            <button class=" btn btn-sm btn-secondary btn-hover-warning">{{__('View')}}
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