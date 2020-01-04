@extends('layouts.app')

@section('title', 'Artist Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">{{__('Artist Details')}}
            </h3>
        </div>
        @php
        if($from == 'new')
        {
        // $routeBack = url('company/artist/new/1');
        URL::signedRoute('company.add_new_permit', ['id' => 1]);
        }
        else if($from == 'draft')
        {
        // $routeBack = url('company/artist/view_draft_details/'.$artist_details->permit_id);
        $routeBack = URL::signedRoute('company.view_draft_details', ['id' => $artist_details->permit_id]);
        }
        else if($from == 'view-draft')
        {
        // $routeBack = url('company/artist/get_draft_details/'.$artist_details->permit_id);
        $routeBack = URL::signedRoute('company.get_draft_details', ['id' => $artist_details->permit_id]);

        }
        else if($from == 'event')
        {
        // $routeBack = url('company/event/add_artist/'.$artist_details->permit_id);
        $routeBack = URL::signedRoute('event.add_artist', ['id' => $artist_details->permit_id]);
        }
        else {
        // $routeBack = url('company/artist/permit/'.$artist_details->permit_id.'/'.$from);
        $routeBack = URL::signedRoute('artist.permit',['id' => $artist_details->permit_id , 'status' =>$from]);
        }
        @endphp

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{$routeBack}}" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
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
                    @if($artist_details->person_code)
                    <span href="#"><i class="flaticon2-calendar-3"></i>{{$artist_details->person_code}}</span>
                    @endif
                    <span href="#"><i class="flaticon2-new-email"></i>{{$artist_details->email}}</span>
                    <span href="#"><i class="flaticon2-phone"></i>{{$artist_details->mobile_number}}</span>
                    <span href="#"><i
                            class="flaticon2-placeholder"></i>{{ getLangId() == 1 ? ucwords($artist_details->Nationality['nationality_en']) : $artist_details->Nationality['nationality_ar']}}</span>
                </div>
            </div>
            <div class="mt-5 col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Profession')}}:</strong></label>
                        <p class="col col-md-6">
                            {{getLangId() == 1 ? ucwords($artist_details->profession['name_en']) : $artist_details->profession['name_ar']}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Birth Date')}}:</strong></label>
                        <p class="col col-md-6">
                            {{date('d-M-Y', strtotime($artist_details->birthdate))}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Gender')}}:</strong></label>
                        <p class="col col-md-6">
                            {{$artist_details->gender == '1' ? __('Male') : __('Female')}}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Passport No')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->passport_number}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Passport Expiry Date')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->passport_expire_date != '0000-00-00' ? date('d-M-Y', strtotime($artist_details->passport_expire_date)) : ''}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Phone Number')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->phone_number ? $artist_details->phone_number : 'Not Given'}}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Visa Type')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->visaType ? $artist_details->visaType->visa_type_en : ''}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Visa Number')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->visa_number ? $artist_details->visa_number : 'Not Given'}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Visa Expiry Date')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->visa_expire_date != '0000-00-00' ? date('d-M-Y', strtotime($artist_details->visa_expire_date)) : ''}}
                        </p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('UID No')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->uid_number}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('UID Expiry Date')}}:</strong></label>
                        <p class="col col-md-6 text-left">
                            {{$artist_details->uid_expire_date != '0000-00-00' ? date('d-M-Y', strtotime($artist_details->uid_expire_date)) : ''}}
                        </p>
                    </div>

                    {{-- <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 "><strong>{{__('Sponsor Name')}}:</strong></label>
                    <p class="col col-md-6 text-left">
                        {{$artist_details->sponsor_name_en}}</p>
                </div> --}}
                <div class="col-md-4 col-sm-12 row">
                    <label class="col col-md-6 "><strong>{{__('Address')}}:</strong></label>
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
                        <th class="text-left">{{__('Document Name')}}</th>
                        <th>{{__('Issued Date')}}</th>
                        <th>{{__('Expiry Date')}}</th>
                        <th>{{__('View')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artist_details->ArtistTempDocument as $req)
                    <tr>
                        <td style="width:50%;">
                            {{ getLangId() == 1 ? ucwords($req->requirement->requirement_name) : $req->requirement->requirement_name_ar}}
                        </td>
                        <td class="text-center">
                            {{$req->issued_date != '0000-00-00' ? date('d-m-Y', strtotime($req->issued_date)) : ''}}
                        </td>
                        <td class="text-center">
                            {{$req->expired_date != '0000-00-00' ? date('d-m-Y', strtotime($req->expired_date)) : ''}}
                        </td>
                        <td class="text-center">
                            <a href="{{asset('storage')}}{{'/'.$req->path}}" target="blank" ">
                                                                <button class=" btn btn-sm
                                btn-secondary">{{__('View')}}
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