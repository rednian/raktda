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
        if($from == 'new')
        {
        // $routeBack = url('company/artist/new/1');
        $routeBack = URL::signedRoute('company.add_new_permit', ['id' => 1]);
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
                    <i class="la la-angle-{{getLangId() == 1 ? 'left' : 'right'}}"></i>
                    {{__('BACK')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{$routeBack}}" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-{{getLangId() == 1 ? 'left' : 'right'}}"></i>
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
                    {{-- <img src="{{url('storage').'/'.$artist_details->thumbnail}}" alt="image"> --}}
                    <a id="artist_image" href="{{url('storage').'/'.$artist_details->original}}"><img
                            src="{{url('storage').'/'.$artist_details->thumbnail}}" alt="" /></a>
                    @endif
                </div>
                <div class="artist--view-head-details">
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0">
                        <i class="fa fa-user-alt la-2x text-muted"></i>
                        {{getLangId() == 1 ? ucfirst($artist_details->firstname_en).' '.ucfirst($artist_details->lastname_en) : $artist_details->firstname_ar.' '.$artist_details->lastname_ar}}
                    </span>
                    {{-- @if($artist_details->person_code)
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0">
                        <i class="fa fa-id-card-alt fa-2x text-muted"></i>
                        {{$artist_details->person_code}}
                    </span>
                    @endif --}}
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0"><i
                            class="fa fa-envelope fa-2x text-muted"></i>{{$artist_details->email}}</span>
                    <span href="#" class="kt-font-bolder form-control-plaintext kt-padding-b-0">
                        <i class="fa fa-flag fa-2x text-muted"></i>
                        {{ getLangId() == 1 ? ucfirst($artist_details->Nationality['nationality_en']) : $artist_details->Nationality['nationality_ar']}}
                    </span>
                </div>
            </div>
            <div class="mt-5 col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Profession')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{getLangId() == 1 ? ucfirst($artist_details->profession['name_en']) : $artist_details->profession['name_ar']}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Date of Birth')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{date('d-M-Y', strtotime($artist_details->birthdate))}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Gender')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->gender == '1' ? __('Male') : __('Female')}}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Passport No')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->passport_number}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Passport Expiry')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$artist_details->passport_expire_date != '0000-00-00' ? date('d-M-Y', strtotime($artist_details->passport_expire_date)) : ''}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Mobile Number')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->mobile_number }}</p>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Visa Type')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->visaType ? $artist_details->visaType->visa_type_en : ''}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Visa Number')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->visa_number ? $artist_details->visa_number : ''}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Visa Expiry Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->visa_expire_date != '0000-00-00' ? date('d-M-Y', strtotime($artist_details->visa_expire_date)) : ''}}
                        </p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('UID No')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->uid_number}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Phone Number')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$artist_details->phone_number ? $artist_details->phone_number : ''}}</p>
                    </div>

            </div>
            <div class="row">
                <label class="col col-md-2 col-form-label kt-padding-r-0 kt-font-bolder ">{{__('Address')}}</label>
                <p class="col form-control-plaintext kt-padding-l-0">
                    {{$artist_details->address_en}}</p>
            </div>
        </div>
        @if(count($artist_details->ArtistTempDocument) > 0)
        <div class="artist--documents kt-margin-t-10">
            <table class="table table-hover table-borderless border table-striped">
                <thead class="text-center">
                    <tr class=" kt-font-transform-u">
                        <th class="text-left">{{__('Document Name')}}</th>
                        <th>{{__('Issue Date')}}</th>
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
                                                                <button class=" btn btn-sm btn-secondary
                                btn-hover-warning">{{__('View')}}
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

@section('script')

<script>
    $('#artist_image').fancybox();
</script>

@endsection