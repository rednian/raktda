@extends('layouts.app')

@section('title', ' Event Permit Draft - Smart Government Rak')

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->all())}} --}}
<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->

                @include('permits.event.common.nav')

                <!--end: Form Wizard Nav -->
            </div>

            <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">


            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->

                    @include('permits.event.common.instructions', ['event_types' => $event_types])

                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="eventdetails" action="" novalidate autocomplete="off">
                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="event-details">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark">{{__('Event
                                                Details')}}</h6>
                                                </div>
                                            </div>
                                            <input type="hidden" id="event_id" value="{{$event->event_id}}">
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#event-details">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Establishment Type')}}<span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control form-control-sm"
                                                                name="firm_type" id="firm_type"
                                                                onchange="getRequirementsList()">
                                                                <option value="">{{__('Select')}}</option>

                                                                <option value="corporate"
                                                                    {{$event->firm == 'corporate' ? 'selected' : ''}}>
                                                                    {{__('Corporate')}}
                                                                </option>
                                                                <option value="government"
                                                                    {{$event->firm == 'government' ? 'selected' : ''}}>
                                                                    {{__('Government')}}
                                                                </option>
                                                            </select>
                                                        </div>



                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="owner_name"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Owner Name')}}
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="owner_name" id="owner_name" dir="ltr"
                                                                placeholder="{{__('Owner Name')}}"
                                                                value="{{$event->owner_name}}">
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="owner_name"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Owner Name - Ar')}}
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="owner_name_ar" id="owner_name_ar" dir="rtl"
                                                                placeholder="{{__('Owner Name - Ar')}}"
                                                                value="{{$event->owner_name_ar}}">
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Type')}} <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control form-control-sm"
                                                                name="event_type_id" id="event_type_id"
                                                                placeholder="Type"
                                                                onchange="getRequirementsList();setSubTypes();">
                                                                <option value="">{{__('Select')}}</option>
                                                                @foreach ($event_types as $pt)
                                                                <option value="{{$pt->event_type_id}}"
                                                                    {{$event->event_type_id == $pt->event_type_id ? 'selected' : ''}}>
                                                                    {{getLangId() == 1 ? ucwords($pt->name_en) : $pt->name_ar}}
                                                                </option>
                                                                @endforeach
                                                            </select>

                                                        </div>


                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="name_en"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Event Name')}}
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="name_en" id="name_en" dir="ltr"
                                                                placeholder="{{__('Event Name')}}"
                                                                value="{{$event->name_en}}">
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs">
                                                            <label for="name_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Name (AR)')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="name_ar" dir="rtl" id="name_ar"
                                                                placeholder="{{__('Event Name (AR)')}}"
                                                                value="{{$event->name_ar}}">
                                                        </div>

                                                        <input type="hidden" id="sel_event_sub_type"
                                                            value="{{$event->event_type_sub_id}}">


                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Sub Type')}} <span class="text-danger"
                                                                    id="event_sub_type_req"></span>
                                                            </label>
                                                            <select class="form-control form-control-sm"
                                                                name="event_sub_type_id" id="event_sub_type_id">
                                                                <option value="">{{__('Select')}}</option>
                                                                {{-- @foreach ($event_sub_types as $pt)
                                                                <option value="{{$pt->event_type_sub_id}}">
                                                                {{getLangId() == 1 ? ucwords($pt->sub_name_en) : $pt->sub_name_ar}}
                                                                </option>
                                                                @endforeach --}}
                                                            </select>
                                                        </div>


                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="description_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Details')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea type="text" class="form-control form-control-sm"
                                                                name="description_en" id="description_en" dir="ltr"
                                                                placeholder="{{__('Event Details')}}" rows="3"
                                                                maxlength="255">{{$event->description_en}}</textarea>
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs ">
                                                            <label for=" description_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Details (AR)')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control form-control-sm"
                                                                name="description_ar" dir="rtl" id="description_ar"
                                                                placeholder="{{__('Event Details (AR)')}}" rows="3"
                                                                maxlength="255">{{$event->description_ar}}</textarea>
                                                        </div>


                                                        <div class=" col-md-4 form-group form-group-xs ">
                                                            <label for="no_of_audience"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Expected Audience')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control form-control-sm"
                                                                name="no_of_audience" id="no_of_audience">
                                                                <option value="">{{__('Select')}}</option>
                                                                <option value="0-100"
                                                                    {{$event->audience_number == '0-100' ? 'selected': ''}}>
                                                                    0-100</option>
                                                                <option value="100-500"
                                                                    {{$event->audience_number == '100-500' ? 'selected': ''}}>
                                                                    100-500</option>
                                                                <option value="500-1000"
                                                                    {{$event->audience_number == '500-1000' ? 'selected': ''}}>
                                                                    500-1000</option>
                                                                <option value="1000&above"
                                                                    {{$event->audience_number == '1000&above' ? 'selected': ''}}>
                                                                    {{__('1000 & above')}}</option>
                                                            </select>
                                                        </div>





                                                        <div class="col-md-4  form-group form-group-xs ">
                                                            <label class="col-form-label"> {{__('Food Truck')}}
                                                                ?</label>
                                                            {{-- <label class="kt-checkbox kt-checkbox--bold ml-2 pt-1">
                                                                        <input type="checkbox" name="isTruck" id="isTruck">
                                                                        <span></span>
                                                                    </label> --}}
                                                            <div class="kt-radio-inline">
                                                                <label class="kt-radio ">
                                                                    <input type="radio" name="isTruck"
                                                                        onclick="checkTruck(1)" value="1"
                                                                        {{$event->is_truck == '1' ? 'checked': ''}}>
                                                                    {{__('Yes')}}
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="isTruck"
                                                                        onclick="checkTruck(1)" value="0"
                                                                        {{$event->is_truck == '0' ? 'checked': ''}}>
                                                                    {{__('No')}}
                                                                    <span></span>
                                                                </label>
                                                                <i class="fa fa-edit fa-2x pull-right" id="truckEditBtn"
                                                                    onclick="editTruck()"></i>
                                                            </div>
                                                            <input type="hidden" id="prev_val_isTruck"
                                                                value="{{$event->is_truck}}">
                                                        </div>

                                                        <div class="col-md-4  form-group form-group-xs ">
                                                            <label class="col-form-label"> {{__('Liquor')}} ?</label>
                                                            <div class="kt-radio-inline">
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="isLiquor" value="1"
                                                                        {{$event->is_liquor == '1' ? 'checked': ''}}
                                                                        onclick="checkLiquor(1)">
                                                                    {{__('Yes')}}
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="isLiquor" value="0"
                                                                        {{$event->is_liquor == '0' ? 'checked': ''}}
                                                                        onclick="checkLiquor(0)">
                                                                    {{__('No')}}
                                                                    <span></span>
                                                                </label>
                                                                <i class="fa fa-edit fa-2x pull-right"
                                                                    id="liquorEditBtn" onclick="editLiquor()"></i>

                                                            </div>
                                                            <input type="hidden" id="prev_val_isLiquor"
                                                                value="{{$event->is_liquor}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="date-details">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseTwo6" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u kt-font-dark kt-font-bolder">
                                                        {{__('Date Details')}}
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#date-details" id="collapseTwo6">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3 form-group form-group-xs ">
                                                            <label for="issued_date"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('From Date')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm date">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="issued_date" id="issued_date"
                                                                        placeholder="DD-MM-YYYY" onchange="givWarn()"
                                                                        value="{{date('d-m-Y',strtotime($event->issued_date))}}" />
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3 form-group form-group-xs">
                                                            <label class="col-form-label">{{__('From Time')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm timepicker">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input class="form-control form-control-sm"
                                                                        value="{{$event->time_start}}" name="time_start"
                                                                        id="time_start" type="text" />
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-clock-o"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>



                                                        <div class="col-md-3 form-group form-group-xs ">
                                                            <label for="expired_date"
                                                                class=" col-form-label kt-font-bold text-right">{{__('To Date')}}
                                                                <span class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm date">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="expired_date" id="expired_date"
                                                                        placeholder="DD-MM-YYYY"
                                                                        value="{{date('d-m-Y',strtotime($event->expired_date))}}">
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 form-group form-group-xs">
                                                            <label class="col-form-label">{{__('To Time')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm timepicker">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input class="form-control form-control-sm"
                                                                        value="{{$event->time_end}}" name="time_end"
                                                                        id="time_end" type="text" />
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-clock-o"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="location-details">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseTwo5" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">
                                                        {{__('Location Details')}}
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#accordionExample6" id="collapseTwo5">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="venue_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Venue')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_en" id="venue_en" dir="ltr"
                                                                placeholder="{{__('Venue')}}"
                                                                value="{{$event->venue_en}}">

                                                        </div>

                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="venue_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__(' Venue (AR)')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_ar" dir="rtl" id="venue_ar"
                                                                placeholder="{{__(' Venue (AR)')}}"
                                                                value="{{$event->venue_ar}}">
                                                        </div>


                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="emirate_id"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Emirate')}}
                                                            </label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                value="Ras Al Khaimah" readonly>
                                                            <input type="hidden" name="emirate_id" id="emirate_id"
                                                                value="5">
                                                        </div>


                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="area_id"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Area')}}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="  form-control form-control-sm "
                                                                name="area_id" id="area_id">
                                                                <option value="">{{__('Select')}}</option>
                                                                @foreach($areas as $ar)
                                                                <option value="{{$ar->id}}"
                                                                    {{$ar->id == $event->area_id ? 'selected' : ''}}>
                                                                    {{$ar->area_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="country_id"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Country')}}
                                                            </label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                value="United Arab Emirates" readonly>
                                                            <input type="hidden" name="country_id" id="country_id"
                                                                value="232">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="map-detials">

                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseTwo4" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">{{__('Map
                                                        Details')}}
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#accordionExample6" id="collapseTwo4">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-8 col-sm-12 form-group form-group-xs ">
                                                            <label for="address"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Address')}}
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text"
                                                                class="form-control form-control-sm map-input"
                                                                name="address" id="address-input" placeholder="Address"
                                                                value="{{$event->address}}" dir="ltr">
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="street"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Street')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="street" id="street" dir="ltr" placeholder="Street"
                                                                value="{{$event->street}}">
                                                        </div>

                                                        <input type="hidden" id="full_address" name="full_address"
                                                            value="{{$event->full_address}}">

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="longitude"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Longitude')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="longitude" id="longitude" dir="ltr"
                                                                placeholder="Longitude" value="{{$event->longitude}}">
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="latitude"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Latitude')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="latitude" id="latitude" dir="ltr"
                                                                placeholder="Latitude" value="{{$event->latitude}}">
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="addi_loc_info"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Additional Location Information')}} </label>
                                                            <textarea class="form-control form-control-sm"
                                                                name="addi_loc_info" id="addi_loc_info" dir="ltr"
                                                                rows="2">{{$event->additional_location_info ? $event->additional_location_info : ''}}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="address-map-container"
                                                    style="width:100%;height:200px;padding:15px;">
                                                    <div style="width: 100%; height: 100%" id="map"></div>
                                                </div>
                                            </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>


                    <input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">


                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            @include('permits.components.requirements')
                            <form id="documents_required">
                            </form>
                            <form id="image_upload_form">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12"><label
                                            class="kt-font-bold text--maroon">{{__('Images')}}</label>
                                        <p class="reqName">{{__('Add multiple images')}}</p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label>
                                        <div id="image_uploader">{{__('Upload')}}</div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('Previous')}}
                        </div>

                        <a href="{{route('event.index')}}#draft">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('Back')}}
                            </div>
                        </a>

                        <div class="btn-group" role="group" id="submit--btn-group">
                            <button id="btnGroupDrop1" type="button" class="btn btn--yellow btn-sm dropdown-toggle "
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__('Submit')}}
                            </button>
                            <div class="dropdown-menu py-0" aria-labelledby="btnGroupDrop1">
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary btn-hover-success"
                                    value="finished" id="submit_btn">Finish &
                                    Submit</button>
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary" value="drafts"
                                    id="draft_btn">Update
                                    Draft</button>
                            </div>
                        </div>


                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            {{__('Next')}}
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- end:: Content -->



<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
        <div id="ajax_loader" style="min-height: 100vh;">
            <img src="{{asset('/img/ajax-loader.gif')}}" style="position: absolute; top:50%; left: 50%;">
        </div>
    </div>
</div>

@include('permits.event.common.show_warning_modal', ['day_count' => getSettings()->event_start_after]);

@include('permits.event.common.sure_to_remove');

@include('permits.event.common.edit_food_truck', ['truck_req'=>$truck_req])
@include('permits.event.common.liquor', ['liquor_req'=>$liquor_req])

@endsection


@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script src="{{asset('js/company/map.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6nhSpjNed-wgUyVMJQZJTRniW-Oj_Tgw&libraries=places&callback=initialize"
    async defer></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    let documentNames = {};
    var truckDocUploader = [];
    var liquorDocUploader = [];
    var truckDocValidator ;
    var liquorDocDetails = {};
    var truckAdditionalValidator ;
    var truckDetails = {};
    var truckDocDetails = {};
    var docRules = {};
    var docMessages = {};
    var documentsValidator = '';
    var truckDocRules = {};
    var truckDocMessages = {};
    var liquorNames  = {};
    var truckDocNames = {};
    var truckDocumentsValidator ;
    var liquorDocumentsValidator ;


    $(document).ready(function(){
        setWizard();
        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(2);
        $('#back_btn').css('display', 'none');
        localStorage.clear();
        getRequirementsList();
        imageUploadFunction();

        setSubTypes($('#event_type_id').val());

        $('#submit--btn-group').css('display', 'none');
        $('#add_document_btn').hide();

        var isTruck = $('#prev_val_isTruck').val();
        if(isTruck == 0){
            $('#truckEditBtn').hide();
        }
        var isLiquor = $('#prev_val_isLiquor').val();
        if(isLiquor == 0){
            $('#liquorEditBtn').hide();
        }

        truckDocUpload();
    });

    function givWarn()
    {
        var from_date = $('#issued_date').val();
        // var exp_date = $('#expired_date').val();
        let start_days_count = $('#settings_event_start_date').val();
        if(from_date)
        {
            var x = moment(from_date, "DD-MM-YYYY");
            // var y = moment(exp_date, "DD-MM-YYYY");
            var to = moment();

            var from = moment([x.format('YYYY'), x.month(), x.format('DD')]);
            // var to = moment([y.format('YYYY'), y.month(), y.format('DD')]);
            var today = moment([to.format('YYYY'), to.month(), to.format('DD')]);

            var diff = from.diff(today, 'days');

            if(diff <= start_days_count)
            {
                // alert('It will take 10 days to process the permit');
                $('#showwarning').modal('show');
            }
        }
    }


    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
                let requiId = $('#req_id_' + i).val() ;
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('event.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "doc_file_" + i,
                    showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    maxFileSize: 5242880,
                    returnType: "json",
                    showFileCounter: false,
                    abortStr: '',
                    multiple: false,
                    maxFileCount: 2,
                    showDelete: true,
                    uploadButtonClass: 'btn btn-secondary mb-2 mr-2',
                    formData: {id: i, reqId: requiId , reqName:$('#req_name_' + i).val()},
                    onSuccess: function (files, response, xhr, pd) {
                            //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    onLoad: function (obj) {
                        $.ajax({
                            cache: false,
                            url: "{{route('company.event.get_uploaded_docs')}}",
                            type: 'POST',
                            data: {eventId: $('#event_id').val() ,reqId: requiId},
                            dataType: "json",
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let issue_datetime = new Date(data['issued_date']);
                                        let exp_datetime = new Date(data['expired_date']);
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        // const d = data["path"].split("/");
                                        // let docName = d[d.length - 1];
                                        const d = data["path"].split("/");
                                        var cc = d.splice(4,5);
                                        let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        obj.createProgress(docName, "{{asset('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                        j++;
                                    }

                                }

                            }
                        });


                    },
                    onError: function (files, status, errMsg, pd) {
                        showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                        pd.statusbar.hide();
                    },
                    downloadCallback: function (files, pd) {
                        if(files[0]) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let this_url = user_id + '/event/' + eventId +'/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        ); } else {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                        }
                    }
                });
                $('#fileuploader_' + i + ' div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
            }
        };

        const picUploadFunction = () => {
            picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('event.uploadLogo')}}",
                headers:  {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")},
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                deleteStr: `<i class="la la-trash"></i>`,   
                showFileSize: false,
                maxFileSize: 5242880,
                showFileCounter: false,
                abortStr: '',
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn-secondary mb-2 mr-2',
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
                },
                onLoad: function (obj) {
                    var url = "{{route('event.get_uploaded_logo',':id')}}" ;
                    url = url.replace(':id', $('#event_id').val() );
                    $.ajax({
                        url: url,
                        success: function (data) {
                            // console.log(data);
                            if (data.trim() != '') {
                                obj.createProgress('', "{{url('storage')}}"+'/'+ data, '');
                            }
                        }
                    });
                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
        };


        var eventValidator = $('#eventdetails').validate({
            ignore: [],
            rules: {
                event_type_id: 'required',
                name_en: 'required',
                name_ar: 'required',
                issued_date: {
                    required: true,
                    dateNL: true
                },
                street: 'required',
                description_en: 'required',
                description_ar: 'required',
                time_start: 'required',
                venue_en: 'required',
                area_id: 'required',
                longitude: 'required',
                latitude: 'required',
                expired_date: {
                    required: true,
                    dateNL: true
                },
                time_end: 'required',
                venue_ar: 'required',
                address: 'required',
                firm_type: 'required',
                no_of_audience: 'required',
                owner_name: 'required',
                owner_name_ar: 'required',
            },
            messages: {
                event_type_id: '',
                name_en: '',
                name_ar: '',
                issued_date: {
                    required: "",
                    dateNL: ""
                },
                street: '',
                description_en: '',
                description_ar: '',
                time_start: '',
                venue_en: '',
                area_id: '',
                longitude: '',
                latitude: '',
                expired_date: {
                    required: "",
                    dateNL: ""
                },
                time_end: '',
                venue_ar: '',
                address: '',
                firm_type: '',
                no_of_audience: '',
                owner_name:'',
                owner_name_ar: '',
            },
        });


        $("#check_inst").on("click", function () {
            setThis('none', 'block', 'block', 'none');
        });

        $("#event_det").on("click", function () {
            if (!checkForTick()) {
                return
            }
            setThis('block', 'block', 'none', 'none');
        });

        $("#upload_doc").on("click", function () {
            // wizard = new KTWizard("kt_wizard_v3");
            // if (!checkForTick()) return;
            // if (wizard.currentStep == 3) {

            // }

            $('#next_btn').trigger('click');

            setThis('block', 'none', 'none', 'block');
        });

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit--btn-group').css('display', submit);
        };

        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result;
            if ($('#agree').not(':checked')) {
                wizard.stop();
                $('#agree_cb > span').addClass('compulsory');
                result = false;
            }
            if ($('#agree').is(':checked')) {
                $('#back_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                $('#agree_cb > span').removeClass('compulsory');
                wizard.goNext();
                result = true;
            }

            return result;
        };


        $('#next_btn').click(function () {

        wizard = new KTWizard("kt_wizard_v3");

        checkForTick();
        // checking the next page is artist details
        if (wizard.currentStep == 2) {
            stopNext(eventValidator);
            KTUtil.scrollTop();// validating the artist details page
            if (eventValidator.form()) {
                $('#next_btn').css('display', 'none'); // hide the next button
                $('#submit--btn-group').css('display', 'block');
                var noOfTrucks = $("input:radio[name='isTruck']:checked").val() == "1" ? $('#no_of_trucks').val() : "0" ;
                eventdetails = {
                    event_draft_id: $('#event_id').val(),
                    event_type_id: $('#event_type_id').val(),
                    name: $('#name_en').val(),
                    name_ar: $('#name_ar').val(),
                    issued_date: $('#issued_date').val(),
                    time_start: $('#time_start').val(),
                    venue_en: $('#venue_en').val(),
                    expired_date: $('#expired_date').val(),
                    time_end: $('#time_end').val(),
                    venue_ar: $('#venue_ar').val(),
                    address: $('#address-input').val(),
                    emirate_id: $('#emirate_id').val(),
                    longitude: $('#longitude').val(),
                    latitude: $('#latitude').val(),
                    area_id: $('#area_id').val(),
                    country_id: $('#country_id').val(),
                    street: $('#street').val(),
                    description_en: $('#description_en').val(),
                    description_ar: $('#description_ar').val(),
                    full_address: $('#full_address').val(),
                    firm_type: $('#firm_type').val(),
                    isTruck: $("input:radio[name='isTruck']:checked").val(),
                    isLiquor: $("input:radio[name='isLiquor']:checked").val(),
                    no_of_audience: $('#no_of_audience').val(),
                    owner_name: $('#owner_name').val(),
                    owner_name_ar: $('#owner_name_ar').val(),
                    addi_loc_info: $('#addi_loc_info').val(),
                    event_sub_type_id: $('#event_sub_type_id').val()
                };

                localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }
        });

        

        const docValidation = () => {
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#requirements_count').val();
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) {
                let children = $('#ajax-file-upload_' + i).children();
                let fileNames = Object.keys(children).map(function(key){
                    return children[key].innerText != undefined ? children[key].innerText : '';
                });

                if ($('#ajax-file-upload_' + i).length) {
                    if ($('#ajax-file-upload_' + i).contents().length == 0) {
                        if($('#eventReqIsMandatory_'+i).val() == 1)
                        {
                            hasFileArray[i] = false;
                            $("#ajax-upload_" + i).css('border', '2px dotted red');
                        }
                    } else {
                        hasFileArray[i] = true;
                        $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                    }
                    documentDetails[i] = {
                        issue_date: $('#doc_issue_date_' + i).val(),
                        exp_date: $('#doc_exp_date_' + i).val()
                    }
                    documentNames[i] = {
                        reqId: $('#req_id_'+i).val(),
                        fileNames
                    }
                }
            }
            }

            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }


            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
            localStorage.setItem('documentNames', JSON.stringify(documentNames));
                return hasFile;
            };



        const stopNext = (validator_name) => {
            wizard.on("beforeNext", function (wizardObj) {
                if (validator_name.form() !== true) {
                    wizardObj.stop(); // don't go to the next step
                }
            });
        };

        $('#prev_btn').click(function () {
            wizard = new KTWizard("kt_wizard_v3");
            if (wizard.currentStep == 2) {
                $('#prev_btn').css('display', 'none');
                $('#back_btn').css('display', 'block');
            } else {
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            }
            $('#submit--btn-group').css('display', 'none');
        });


        $('#issued_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });
        $('#expired_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });

        $('#time_start').timepicker();
        $('#time_end').timepicker();

        $('#issued_date').on('changeDate', function (selected) {
            $('#issued_date').valid() || $('#issued_date').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            var expDate = moment(minDate, 'DD-MM-YYYY').add('month', 1);
            $('#expired_date').datepicker('setStartDate', minDate);
            $('#expired_date').datepicker('setEndDate', expDate.format("DD-MM-YYYY"));
            $('#expired_date').val(expDate.format("DD-MM-YYYY"));
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });


        const getAreas = (city_id) => {
           if(city_id)
           {
            $.ajax({
                url: "{{url('company/fetch_areas')}}" + '/' + city_id,
                success: function (result) {
                    // console.log(result)
                    $('#area_id').empty();
                    $('#area_id').append('<option value="">Select</option>');
                    for (let i = 0; i < result.length; i++) {
                        $('#area_id').append('<option value="' + result[i].id + '">' + result[i].area_en + '</option>');

                    }

                }
            });
           }

        };

        function toCapitalize(word) {
            if(word)
            {
                return word.charAt(0).toUpperCase() + word.substring(1);
            }
        }


        function getRequirementsList()
        {
            var id = $('#event_type_id').val();
            var firm = $('#firm_type').val();
            $.ajax({
                url: "{{route('company.event.get_requirements')}}",
                type: "POST", 
                data: { id: id, firm: firm},
                success: function (result) {
                 if(result){
                    $('#documents_required').empty();
                     var res = result;
                     $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Event Permit Required documents</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">Event Logo </label><p class="reqName">A image of the event logo/ banner </p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">Upload</div></div></div><input hidden id="requirements_count" value="'+ res.length +'" />');
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+toCapitalize(res[i].requirement_name)+' <span id="cnd_'+j+'"></span></label><p class="reqName">'+( res[i].requirement_description ? toCapitalize(res[i].requirement_description) : '')+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><input type="hidden" id="eventReqIsMandatory_'+j+'" value="'+res[i].event_type_requirements[0].is_mandatory+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                         }

                         
                         if(res[i].event_type_requirements[0].is_mandatory == 1)
                         {
                            $('#cnd_'+j).html(' * ');
                            $('#cnd_'+j).removeClass('text-muted').addClass('text-danger');
                            docRules['doc_issue_date_' + j] = 'required';
                            docRules['doc_exp_date_' + j] = 'required';
                            docMessages['doc_issue_date_' + j] = '';
                            docMessages['doc_exp_date_' + j] = '';
                         }else {
                            $('#cnd_'+j).html(' ');
                            $('#cnd_'+j).removeClass('text-danger').addClass('text-muted');
                         }
                        
                        documentsValidator = $('#documents_required').validate({
                            rules: docRules,
                            messages: docMessages
                        });

                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     uploadFunction();
                     picUploadFunction();
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });

        }


        $('#submit_btn').click((e) => {

            var hasFile = docValidation();

                if ((documentsValidator != '' ? documentsValidator.form() : 1) && hasFile ) {

                    // $('#submit--btn-group #btnGroupDrop1').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

                    getImagePaths();

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    var dn = localStorage.getItem('documentNames');
                    var img = localStorage.getItem('imagePaths');

                        $.ajax({
                            url: "{{route('event.store')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                                documentN: dn,
                                from: 'draft',
                                imgPaths: img, 
                                description: $('#description').val()
                            },
                            beforeSend: function() {
                                KTApp.blockPage({
                                    overlayColor: '#000000',
                                    type: 'v2',
                                    state: 'success',
                                    message: 'Please wait...'
                                });
                            },
                            success: function (result) {
                                if(result.message[0]){
                                    localStorage.clear();
                                    window.location.href = "{{route('event.index')}}#applied";
                                    KTApp.unblockPage();
                                }
                            }
                        });
                }

        });



        $('#draft_btn').click((e) => {

            var hasFile = docValidation();

                if ((documentsValidator != '' ? documentsValidator.form() : 1) && hasFile) {

                    // $('#submit--btn-group #btnGroupDrop1').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

                    getImagePaths();
                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    var dn = localStorage.getItem('documentNames');
                    var img = localStorage.getItem('imagePaths');

                        $.ajax({
                            url: "{{route('company.event.update_draft')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                                documentN: dn,
                                evtId: $('#event_id').val(),
                                imgPaths: img, 
                                description: $('#description').val()
                            },
                            beforeSend: function() {
                                KTApp.blockPage({
                                    overlayColor: '#000000',
                                    type: 'v2',
                                    state: 'success',
                                    message: 'Please wait...'
                                });
                            },
                            success: function (result) {
                                if(result.message[0]){
                                    localStorage.clear();
                                    window.location.href = "{{route('event.index')}}#draft";
                                    KTApp.unblockPage();
                                }
                            }
                        });
                }

        });


        $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });

          /* Truck Script */

        function checkTruck(id) {
            var prev = $('#prev_val_isTruck').val();
            if (id == 1) {
               editTruck();
            } else if(id == 0 && prev == 1) {
                $('#notSaveModal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                $('#sure_remove_close').attr('onclick', changeIsTruck());
                $('#fromSection').val('truck');
            }
        }


        function changeIsTruck() {
            if($('#food_truck_list tr').length == 0)
            {
                $('input[name="isTruck"]').filter('[value=0]').prop('checked', true);
            }else {
                $('input[name="isTruck"]').filter('[value=1]').prop('checked', true);
            }
           
        }

        $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });


        var truckValidator = $('#truck_details_form').validate({
            rules: {
                company_name_en: 'required',
                company_name_ar: 'required',
                plate_no: 'required',
                food_type: 'required',
                regis_issue_date: 'required',
                regis_expiry_date: 'required'
            },
            messages: {
                company_name_en: '',
                company_name_ar: '',
                plate_no: '',
                food_type: '',
                regis_issue_date: '',
                regis_expiry_date: ''
            }
        });

        function truckDocValidation(){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#truck_document_count').val();
            // var total = parseInt($('#truck_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) 
                {
                    if($('#truck-file-upload_'+i).length) {
                        if($('#truck-file-upload_'+i).contents().length === 0)
                        {
                            hasFileArray[i] = false;
                            $('#truck-upload_'+i).css('border', '2px dotted red');
                        } else {
                            hasFileArray[i] = true;
                            $("#truck-upload_" + i).css('border', '2px dotted #A5A5C7');
                        }
                        truckDocDetails[i] = {
                            issue_date: $('#truck_doc_issue_date_' + i).val(),
                            exp_date: $('#truck_doc_exp_date_' + i).val()
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            localStorage.setItem('truck_doc_details', JSON.stringify(truckDocDetails));

            return hasFile;
        }

        for(var i = 1; i <= $('#truck_document_count').val(); i++)
        {
            if($('#truckdatesRequiredCheck_'+i).val() == 1)
            {
                truckDocRules['truck_doc_issue_date_'+i] = 'required';
                truckDocRules['truck_doc_exp_date_'+i] = 'required';
                truckDocMessages['truck_doc_issue_date_'+i] = '';
                truckDocMessages['truck_doc_exp_date_'+i] = '';
            }
        }

        var liquorDocRules = {};
        var liquorDocMessages = {};

        for(var i = 1; i <= $('#liquor_document_count').val(); i++)
        {
            if($('#liquordatesRequiredCheck_'+i).val() == 1)
            {
                liquorDocRules['liquor_doc_issue_date_'+i] = 'required';
                liquorDocRules['liquor_doc_exp_date_'+i] = 'required';
                liquorDocMessages['liquor_doc_issue_date_'+i] = '';
                liquorDocMessages['liquor_doc_exp_date_'+i] = '';
            }
        }

        function go_back_truck_list()
        {
            $('#edit_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#edit_one_food_truck').modal('hide');
        }


        function editTruck(){
            var event_id = $('#event_id').val() ;
            var url = "{{route('event.fetch_truck_details_by_event_id', ':id')}}" ;
            url = url.replace(':id', event_id);
            $.ajax({    
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        $('#food_truck_list').empty();
                        // console.log(result);
                        $('#edit_food_truck').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                        for(var s = 0;s < result.length;s++)
                        {
                            var k = s + 1 ;
       
                           $('#food_truck_list').append('<tr><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td>'+ result[s].company_name_ar+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"> <span onclick="editThisTruck('+result[s].event_truck_id+', '+k+')"><i class="fa fa-pen fnt-16 text-info"></i></span>&emsp;<span id="append_'+s+'"></span></td></tr>');

                            if(result.length > 1){
                                $('#append_'+s+'').append('<span onclick="deleteThisTruck('+result[s].event_truck_id+')"><i class="fa fa-trash fnt-16 text-danger"></i></span>');
                            }

                        
                        }

                        
                    }
                }
            });
        }

        function deleteThisTruck(id)
        {
            var url = "{{route('event.delete_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result.status.trim() == 'done') 
                    {
                        editTruck();
                        $('#disp_mess').html('<h5 class="text-danger py-2">Food Truck Details Deleted successfully</h5>');
                        setTimeout(function(){ $('#disp_mess').html('');}, 2000)
                    }
                }
            });
        }
    
        function editThisTruck(id, num)
        {
            var url = "{{route('event.fetch_this_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        // console.log(result);
                        $('#edit_food_truck').modal('hide');
                        $('#edit_truck_title').show();
                        $('#add_truck_title').hide();
                        $('#update_this_td').show();
                        $('#add_new_td').hide();
                        $('#edit_one_food_truck').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                        $('#company_name_en').val(result.company_name_en);
                        $('#company_name_ar').val(result.company_name_ar);
                        $('#plate_no').val(result.plate_number);
                        $('#food_type').val(result.food_type);
                        $('#regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#this_event_truck_id').val(result.event_truck_id);
                        truckDocumentsValidator = $('#truck_upload_form').validate({
                            rules: truckDocRules,
                            messages: truckDocMessages
                        });
                        truckDocUpload();
                    }
                }
            });
        }

        $('#add_new_truck').click(function(){
            $('#edit_one_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#truck_details_form').trigger('reset');
            $('#truck_upload_form').trigger('reset');
            $('#edit_truck_title').hide();
            $('#update_this_td').hide();
            $('#add_truck_title').show();
            $('#this_event_truck_id').val('');
            $('#add_new_td').show();
            $('#edit_food_truck').modal('hide');
            $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
            truckDocumentsValidator = $('#truck_upload_form').validate({
                rules: truckDocRules,
                messages: truckDocMessages
            });
            truckDocUpload();
        });

        $('#add_new_td').click(function(){
            var hasFile = truckDocValidation();
            if((truckDocumentsValidator != '' ? truckDocumentsValidator.form() : 1 ) && truckValidator.form() && hasFile)
            {
                var truck_details = {
                    company_name_en: $('#company_name_en').val(),
                    company_name_ar: $('#company_name_ar').val(),
                    plate_no: $('#plate_no').val(),
                    food_type: $('#food_type').val(),
                    regis_issue_date: $('#regis_issue_date').val(),
                    regis_expiry_date: $('#regis_expiry_date').val()
                }
                var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url: "{{route('event.add_update_truck')}}",
                        type: "POST",
                        data: {
                            event_id: $('#event_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            truckDocDetails: truckDocDetails,
                            truck_id: ''
                        },
                        success: function (result) {
                            if(result.status.trim() == 'done')
                            {
                                editTruck();
                                $('#edit_one_food_truck').modal('hide');
                                $('#edit_food_truck').modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                    show: true
                                });
                                $('#prev_val_isTruck').val(1);
                                $('#disp_mess').html('<h5 class="text-success py-2">Food Truck details Added successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                            }
                        }
                    });
                }
            }
        });

        $('#update_this_td').click(function(){
            var hasFile = truckDocValidation();
            if((truckDocumentsValidator != '' ? truckDocumentsValidator.form() : 1 ) && truckValidator.form() && hasFile)
            {
                var truck_details = {
                    company_name_en: $('#company_name_en').val(),
                    company_name_ar: $('#company_name_ar').val(),
                    plate_no: $('#plate_no').val(),
                    food_type: $('#food_type').val(),
                    regis_issue_date: $('#regis_issue_date').val(),
                    regis_expiry_date: $('#regis_expiry_date').val()
                }
                var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url:  "{{route('event.add_update_truck')}}",
                        type: 'POST', 
                        data: {
                            truck_id : $('#this_event_truck_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            truckDocDetails: truckDocDetails,
                            eventId: $('#event_id').val()
                        },
                        success: function (result) {
                            if(result.status.trim() == 'done')
                            {
                                editTruck();
                                $('#edit_food_truck').modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                    show: true
                                });
                                $('#edit_one_food_truck').modal('hide');
                                $('#prev_val_isTruck').val(1);
                                $('#disp_mess').html('<h5 class="text-success py-2">Food Truck details updated successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                            }
                        }
                    });
                }
            }
        });

        const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            var total = parseInt($('#truck_additional_doc > div').length);
            for(var i = 1; i <= parseInt(per_truck_doc) + total ;i++){
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    maxFileSize: 5242880,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-secondary mb-2 mr-2',
                    formData: {
                        id: i , 
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    downloadCallback: function (files, pd) {
                        if(files)
                        {
                            let user_id = $('#user_id').val();
                            let event_id = $('#event_id').val();
                            let truck_id = $('#this_event_truck_id').val();
                            let path = user_id+'/event/'+ event_id +'/truck/' +truck_id +'/'+reqID +'/' +files;
                            window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }else {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                                window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }
                    },
                    onLoad:function(obj)
                    {
                        var ev_tr_id = $('#this_event_truck_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_truck_docs')}}",
                            type: 'POST',
                            data: {
                                truckId: ev_tr_id,
                                reqId: $('#truck_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        var cc = d.splice(4,5);
                                        let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        // let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#truck_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#truck_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteTruckUploadedfile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: i },
                            success: function (result) {
                                console.log('success');
                            }   
                        });
                    }
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
            }
        };

 
    


        // script for liquor details



        function checkLiquorVenue(id)
        {
            if(id == 1)
            {
                $('#liquor_provided_form').show();
                $('#liquor_details_form').hide();
                $('#liquor_upload_form').hide();
            }else if(id == 0) {
                $('#liquor_provided_form').hide();
                $('#liquor_details_form').show();
                $('#liquor_upload_form').show();
            }
        }


        function changeLiquorService()
        {
            var service = $('#liquor_service').val();
            if(service == 'limited')
            {
                $('#limited_types').show();
            }else{
                $('#limited_types').hide();
            }
        }

        function changeIsLiquor() {
            if($('#event_liquor_id').val() == '')
            {
                $('input[name="isLiquor"]').filter('[value=0]').prop('checked', true);
            }else {
                $('input[name="isLiquor"]').filter('[value=1]').prop('checked', true);
            }
        }

        var liquorValidator = $('#liquor_details_form').validate({
            rules: {
                l_company_name_en: 'required',
                l_company_name_ar: 'required',
                purchase_receipt: 'required',
                liquor_service: 'required',
            },
            messages: {
                l_company_name_en: '',
                l_company_name_ar: '',
                purchase_receipt: '',
                liquor_service: '',
            }
        });

        var liquorProvidedValidator = $('#liquor_provided_form').validate({
            rules: {
                liquor_permit_no: 'required'
            },
            messages: {
                liquor_permit_no: ''
            }
        })

        function liqourDocValidation(){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = parseInt($('#liquor_document_count').val());
            // var total = parseInt($('#liquor_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var d = 1; d <= reqCount; d++) 
                {
                    let children = $('#liquor-file-upload_' + d).children();
                    let fileNames = Object.keys(children).map(function(key){
                        return children[key].innerText != undefined ? children[key].innerText : '';
                    });

                    if($('#liquor-file-upload_'+d).length) {
                        if($('#liquor-file-upload_'+d).contents().length === 0)
                        {
                            hasFileArray[d] = false;
                            $('#liquor-upload_'+d).css('border', '2px dotted red');
                        } else {
                            hasFileArray[d] = true;
                            $("#liquor-upload_" + d).css('border', '2px dotted #A5A5C7');
                        }
                        liquorDocDetails[d] = {
                            issue_date: $('#liquor_doc_issue_date_' + d).length ? $('#liquor_doc_issue_date_' + d).val() : '',
                            exp_date: $('#liquor_doc_exp_date_' + d).length ? $('#liquor_doc_exp_date_' + d).val() : '',
                        }

                        liquorNames[d] = {
                            reqId: $('#liqour_req_id_'+d).val(),
                            fileNames
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            // localStorage.setItem('liquordocumentDetails', JSON.stringify());

            return hasFile;
        }



    
        const liquorDocUpload = () => {
            var per_doc = $('#liquor_document_count').val();
            // var total = parseInt($('#liquor_additional_doc > div').length);
            for(var i = 1; i <=  parseInt(per_doc);i++){
                    var reqID =  $('#liqour_req_id_'+i).val()  ;
                    liquorDocUploader[i] = $('#liquoruploader_'+i).uploadFile({
                    url: "{{route('event.uploadLiquor')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",       
                    fileName: "liquor_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    maxFileSize: 5242880,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-secondary mb-2 mr-2',
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                        if(files)
                        {
                            let file_path = files.filepath;
                                let path = file_path.replace('public/','');
                                window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }else {
                            let user_id = $('#user_id').val();
                            let event_id = $('#event_id').val();
                            let liquor_id = $('#event_liquor_id').val();
                            let path = user_id+'/event/'+ event_id +'/liquor/' +liquor_id +'/'+reqID +'/' +files;
                            window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }
                        
                    },
                    onLoad:function(obj)
                    {
                        var ev_lq_id = $('#event_liquor_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_liquor_docs')}}",
                            type: 'POST',
                            data: {
                                liquor_id: ev_lq_id,
                                reqId: $('#liqour_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#liquor_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#liquor_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteLiquorFile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: data.id},
                            success: function (result) {
                                // console.log('success');
                            }
                        });
                    }
                    
                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
            }
        };

        
        $('#update_lq').click(function(){
            var hasFile = liqourDocValidation();
            var type = $("input:radio[name='isLiquorVenue']:checked").val();
            if(type == 0 ? (liquorDocumentsValidator != '' ? liquorDocumentsValidator.form() : 1) && liquorValidator.form() && hasFile : liquorProvidedValidator.form())
            {
                if(type == 0)
                {
                    liquorDetails = {
                        company_name_en: $('#l_company_name_en').val(),
                        company_name_ar: $('#l_company_name_ar').val(),
                        purchase_receipt: $('#purchase_receipt').val(),
                        liquor_service: $('#liquor_service').val(),
                    };
                    if($('#liquor_service').val() == 'limited'){
                        liquorDetails['liquor_types'] = $('#liquor_types').val()
                    }
                } else {
                    liquorDetails = {
                        liquor_permit_no: $('#liquor_permit_no').val(),
                    };
                }
                $.ajax({
                        url: "{{route('event.add_liquor')}}",
                        type: "POST",
                        data: {
                            liquorDetails: liquorDetails,
                            liquorDocDetails: JSON.stringify(liquorDocDetails),
                            liquorNames: JSON.stringify(liquorNames),
                            type: type,
                            event_liquor_id: $('#event_liquor_id').val()
                        },  
                        success: function (result) {
                            if(result)
                            {
                                $('#event_liquor_id').val(result.event_liquor_id);
                                $('#liquorEditBtn').show();
                                $('#prev_val_isLiquor').val(1);
                            }
                        }
                });
                // localStorage.setItem('liquor_details', JSON.stringify(liquorDetails));
                $('#liquor_details').modal('hide');
            }
        });


        function checkLiquor(id){
            var prev = $('#prev_val_isLiquor').val();
            if(id == 1){
                editLiquor();
            }
            if(id == 0 && prev == 1) {
                // alert('The Added data will be lost');
                $('#notSaveModal').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                $('#sure_remove_close').attr('onclick', changeIsLiquor());
                $('#fromSection').val('liquor');
            }
        }

    function editLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url:  url,
                success: function (data) {
                    if(data.length) 
                    {
                        $('#event_liquor_id').val(data.event_liquor_id);
                        if(data.provided == 1)
                        {
                            checkLiquorVenue(1);
                            $('#liquor_permit_no').val(data.liquor_permit_no);
                            $("input:radio[name='isLiquorVenue'][value='1']").attr('checked', true);
                        }else {
                            checkLiquorVenue(0);
                            $("input:radio[name='isLiquorVenue'][value='0']").attr('checked', true)
                            $('#l_company_name_en').val(data.company_name_en);
                            $('#l_company_name_ar').val(data.company_name_ar);
                            $('#purchase_receipt').val(data.purchase_receipt);
                            $('#liquor_service').val(data.liquor_service);
                            changeLiquorService();
                            $('#liquor_types').val(data.liquor_types);
                           
                        }
                    }
                    // $('#liquor_details').modal('show');
                    $('#liquor_details').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                    $('#liquor_details .ajax-file-upload-red').trigger('click');
                    liquorDocumentsValidator = $('#liquor_upload_form').validate({
                        rules: liquorDocRules,
                        messages: liquorDocMessages
                    });
                    liquorDocUpload();
                }
            });
        }


        
       function changeData()
       {
            var fromSection = $('#fromSection').val();
            $.ajax({
                url:  "{{route('event.deleteTruckLiquor')}}",
                type: 'POST',
                data: { from: fromSection, eventId: $('#event_id').val() },
                success: function (result) {
                    $('#notSaveModal').modal('hide');
                    if(fromSection == 'truck'){
                        $('#truckEditBtn').hide();
                        $('input[name="isTruck"]').filter('[value=0]').prop('checked', true);
                    }else if(fromSection == 'liquor'){
                        $('#liquorEditBtn').hide();
                        $('input[name="isLiquor"]').filter('[value=0]').prop('checked', true);
                    }
                }
            });
       }


       function getImagePaths() {
            var reqCount = $('#image-file-upload > .ajax-file-upload-statusbar').length;
            if(reqCount > 0)
            {
                var paths = [];
                for (var i = 1; i <= reqCount; i++) 
                {
                    let src = $('#image-file-upload > .ajax-file-upload-statusbar:nth-child('+i+') img').attr('src').split('/').slice(4, ).join('/');
                    paths.push(src);
                }               
                localStorage.setItem('imagePaths', JSON.stringify(paths));
            }
       }

       

       const imageUploadFunction = () => {
            var ImageUploader = $('#image_uploader').uploadFile({
                url: "{{route('event.uploadEventPics')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "image_file",
                multiple: true,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                maxFileSize: 5242880,
                abortStr: '',
                showProgress: false,
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn-secondary mb-2 mr-2',
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
                },
                onLoad: function(obj) {
                    var url = "{{route('event.get_uploaded_eventImages', ':id')}}";
                    url = url.replace(':id', $('#event_id').val());
                    $.ajax({
                            // cache: false,
                            url: url,
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    if(data[0]) {
                                        $('#description').val(data[0].description);
                                    }
                                    for(data of data) {
                                        const d = data["path"].split("/");
                                        let docName = d[d.length - 1];
                                        obj.createProgress('', "{{asset('storage')}}"+'/' + data["path"], '');
                                    }
                                }
                            }
                        });

        
                },
                downloadCallback: function (files, pd) {
                    let file_path = files;
                    let path = file_path.replace('public/','');
                        window.open(
                    "{{url('storage')}}"+'/' + path,
                    '_blank'
                    );
                },
            });
            $('#image_uploader div').attr('id', 'image-upload');
            $('#image_uploader + div').attr('id', 'image-file-upload');
        };

        function setSubTypes()
        {
            var langId = $('#getLangid').val();
            var et = $('#event_type_id').val();
            var sub_id = $('#sel_event_sub_type').val();
            if(et)
            {
                var url = "{{route('event.get_event_sub_types', ':id')}}";
                url = url.replace(':id', et);
                $.ajax({
                url: url ,
                success: function (result) {
                         $('#event_sub_type_id').empty();
                         $('#event_sub_type_id').append('<option value="">{{__('Select')}}</option>');
                        if(result.length > 0){
                            for(var  i = 0; i< result.length;i++)
                            {
                                $('#event_sub_type_id').append('<option value="'+result[i].event_type_sub_id+'" >'+(langId == 1 ? toCapitalize(result[i].sub_name_en) : result[i].sub_name_ar)+'</option>');
                                if(result[i].event_type_sub_id == sub_id){
                                    $('#event_sub_type_id option[value='+result[i].event_type_sub_id+']').attr('selected', 'selected');
                                }
                                
                            }   
                            $('select[name="event_sub_type_id"]').rules('add', { required: true, messages: {required:''}});
                            $('#event_sub_type_req').html('*');
                        }else 
                        {
                            $('select[name="event_sub_type_id"]').rules("remove"), "required";$('#event_sub_type_id').removeClass('is-invalid');
                            $('#event_sub_type_req').html('');
                        }
                    }
                });
            }
        }
        


</script>

@endsection