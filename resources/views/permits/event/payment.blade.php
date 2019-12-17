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
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items" id="event-wizard--nav">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span> {{__('Instructions')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="event_det">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> {{__('Event Details')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> {{__('Upload Docs')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" id="mk_payment">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>04</span> {{__('Payment')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <div class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>05</span> {{__('Happiness')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </div>

                    </div>
                </div>

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
                                        id="event-details-div">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">{{__('Event Details')}}
                                                    </h6>
                                                </div>
                                            </div>
                                            <input type="hidden" id="event_id" value="{{$event->event_id}}">
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#event-details-div">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Establishment Name')}} <span
                                                                    class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control form-control-sm"
                                                                name="firm_type" id="firm_type" disabled>
                                                                <option value="">{{__('Select')}}</option>
                                                                <option value="government"
                                                                    {{$event->firm == 'government' ? 'selected' : ''}}>
                                                                    {{__('Goverment')}}
                                                                </option>
                                                                <option value="corporate"
                                                                    {{$event->firm == 'corporate' ? 'selected' : ''}}>
                                                                    {{__('Corporate')}}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Type')}} <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control form-control-sm"
                                                                name="event_type_id" id="event_type_id"
                                                                placeholder="Type" disabled>
                                                                <option value="">{{__('Select')}}</option>
                                                                @foreach ($event_types as $pt)
                                                                <option value="{{$pt->event_type_id}}"
                                                                    {{$event->event_type_id == $pt->event_type_id ? 'selected' : ''}}>
                                                                    {{ucwords($pt->name_en)}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="owner_name"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Owner Name')}}
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="owner_name" id="owner_name"
                                                                placeholder="{{__('Owner Name')}}"
                                                                value="{{$event->owner_name}}" readonly>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="owner_name"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Owner Name - Ar')}}
                                                                <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="owner_name_ar" id="owner_name_ar"
                                                                placeholder="{{__('Owner Name - Ar')}}"
                                                                value="{{$event->owner_name_ar}}" readonly>
                                                        </div>



                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="name_en"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Event Name')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="name_en" id="name_en"
                                                                placeholder="{{__('Event Name')}}"
                                                                value="{{$event->name_en}}" readonly>
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs">
                                                            <label for="name_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Name - Ar')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="name_ar" dir="rtl" id="name_ar"
                                                                placeholder="{{__('Event Name - Ar')}}"
                                                                value="{{$event->name_ar}}" readonly>
                                                        </div>



                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="description_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Details ')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <textarea type="text" class="form-control form-control-sm"
                                                                name="description_en" id="description_en"
                                                                placeholder="{{__('Event Details')}}" rows="3"
                                                                maxlength="255"
                                                                readonly>{{$event->description_en}}</textarea>
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs ">
                                                            <label for=" description_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Details - Ar')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control form-control-sm"
                                                                name="description_ar" dir="rtl" id="description_ar"
                                                                placeholder="{{__('Event Details - Ar')}}" rows="3"
                                                                maxlength="255"
                                                                readonly>{{$event->description_ar}}</textarea>
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs ">
                                                            <label for="no_of_audience"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Expected Audience')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <select class="form-control form-control-sm"
                                                                name="no_of_audience" id="no_of_audience" disabled>
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
                                                                    1000 & above</option>
                                                            </select>
                                                        </div>


                                                        <div class="col-md-4  form-group form-group-xs ">
                                                            <label class="col-form-label"> {{__('Food truck')}}
                                                                ?</label>
                                                            {{-- <label class="kt-checkbox kt-checkbox--bold ml-2 pt-1">
                                                                        <input type="checkbox" name="isTruck" id="isTruck">
                                                                        <span></span>
                                                                    </label> --}}
                                                            <div class="kt-radio-inline">
                                                                <label class="kt-radio ">
                                                                    <input type="radio" name="isTruck" value="1"
                                                                        {{$event->is_truck == '1' ? 'checked': ''}}
                                                                        disabled> {{__('Yes')}}
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="isTruck" value="0"
                                                                        {{$event->is_truck == '0' ? 'checked': ''}}
                                                                        disabled> {{__('No')}}
                                                                    <span></span>
                                                                </label>

                                                                <i class="fa fa-file fa-2x pull-right" id="truckEditBtn"
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
                                                                        disabled> {{__('Yes')}}
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio">
                                                                    <input type="radio" name="isLiquor" value="0"
                                                                        {{$event->is_liquor == '0' ? 'checked': ''}}
                                                                        disabled>
                                                                    {{__('No')}}
                                                                    <span></span>
                                                                </label>
                                                                <i class="fa fa-file fa-2x pull-right"
                                                                    id="liquorEditBtn" onclick="editLiquor()"></i>
                                                            </div>
                                                            <input type="hidden" id="prev_val_isLiquor"
                                                                value="{{$event->is_liquor}}">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                    </section>



                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="permit-date-details">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseTwo6" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">{{__('Date Details')}}
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#permit-date-details" id="collapseTwo6">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-3 form-group form-group-xs ">
                                                            <label for="issued_date"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('From Date')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm date">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="issued_date" id="issued_date"
                                                                        placeholder="{{__('From Date')}}"
                                                                        value="{{date('d-m-Y',strtotime($event->issued_date))}}"
                                                                        disabled />
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
                                                            <label class="col-form-label">{{__('From Time')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm timepicker">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input class="form-control form-control-sm"
                                                                        value="{{date('d-m-Y',strtotime($event->time_start))}}"
                                                                        name="time_start" id="time_start" type="text"
                                                                        disabled />
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
                                                                        placeholder="{{__('To Date')}}"
                                                                        value="{{date('d-m-Y',strtotime($event->expired_date))}}"
                                                                        disabled>
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
                                                                        id="time_end" type="text" disabled />
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
                                    </section>

                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="permit-location-details">
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
                                                data-parent="#permit-location-details" id="collapseTwo5">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="venue_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Venue')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_en" id="venue_en"
                                                                placeholder="{{__('Venue')}}"
                                                                value="{{$event->venue_en}}" readonly>

                                                        </div>

                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="venue_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Venue - Ar')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_ar" dir="rtl" id="venue_ar"
                                                                placeholder="Venue - Ar" value="{{$event->venue_ar}}"
                                                                readonly>
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
                                                            </label>
                                                            <select class="  form-control form-control-sm "
                                                                name="area_id" id="area_id" disabled>
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
                                    </section>

                                    <section
                                        class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                        id="permit-map-details">

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
                                                data-parent="#permit-map-details" id="collapseTwo4">
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
                                                                value="{{$event->address}}" readonly>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="street"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Street')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="street" id="street" placeholder="Street"
                                                                value="{{$event->street}}" readonly>
                                                        </div>

                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="longitude"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Longitude')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="longitude" id="longitude" placeholder="Longitude"
                                                                value="{{$event->longitude}}" readonly>
                                                        </div>

                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="latitude"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Latitude')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="latitude" id="latitude" placeholder="Latitude"
                                                                value="{{$event->latitude}}" readonly>
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




                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <input type="hidden" id="requirements_count" />
                                <form id="documents_required">
                                </form>
                                <input type="hidden" id="addi_requirements_count">
                                <form id="addi_documents_required" novalidate>
                                </form>
                                <form id="image_upload_form">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">{{__('Event
                                            Images')}}</label>
                                            <p class="reqName">{{__('Add multiple images of the event')}}</p>
                                        </div>
                                        <div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label>
                                            <div id="image_uploader">{{__('Upload')}}</div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12"><label
                                                class="kt-font-bold text--maroon">{{__('Description')}}</label>
                                            <input type="text" name="description" id="description"
                                                class="form-control form-control-sm" placeholder="Image Description">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <form id="make_payment">
                                    <div class="kt-widget5__info pb-4">
                                        <div class="pb-2">
                                            <span>{{__('From Date')}}:</span>&emsp;
                                            <span class="kt-font-info">{{$event->issued_date}}
                                                {{$event->time_start}}</span>&emsp;&emsp;
                                            <span>{{__('To Date')}}:</span>&emsp;
                                            <span class="kt-font-info">{{$event->expired_date}}
                                                {{$event->time_end}}</span>&emsp;&emsp;
                                            <span>{{__('Venue')}}:</span>&emsp;
                                            <span
                                                class="kt-font-info">{{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}
                                            </span>&emsp;&emsp;
                                            <span>{{__('Ref NO.')}}:</span>&emsp;
                                            <span class="kt-font-info">{{$event->reference_number}}</span>&emsp;&emsp;
                                        </div>
                                    </div>
                                    {{-- <h4 class="text-center kt-block-center kt-margin-20">Amount to be Paid: AED 2500</h4> --}}
                                    @php
                                    $event_fee_total = 0;
                                    $event_vat_total = 0;
                                    $event_grand_total = 0;
                                    $truck_fee = 0;
                                    $liquor_fee = 0;
                                    $issued_date = strtotime($event->issued_date);
                                    $expired_date = strtotime($event->expired_date);
                                    $noofdays = abs($expired_date - $issued_date) / 60 / 60 / 24;
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover border table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Event Name')}}</th>
                                                    <th>{{__('Event Type')}}</th>
                                                    <th class="text-right">{{__('Fee')}} (AED)</th>
                                                    <th class="text-right">{{__('VAT')}} (5%)</th>
                                                    <th class="text-right">{{__('Total')}} (AED) </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-left">
                                                        {{getLangId() == 1 ? $event->name_en : $event->name_ar}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{getLangId() == 1 ? $event->type['name_en'] : $event->type['name_ar']}}
                                                    </td>
                                                    @php
                                                    $event_fee = $event->type['amount'] * $noofdays;
                                                    $vat_amt = $event_fee * 0.05;
                                                    $event_total = $event_fee + $vat_amt ;
                                                    $event_fee_total += $event_fee;
                                                    $event_vat_total += $vat_amt;
                                                    $event_grand_total += $event_total;
                                                    @endphp
                                                    <td class="text-right">
                                                        {{number_format($event_fee,2)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{number_format($vat_amt , 2)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{number_format($event_total, 2)}}
                                                    </td>
                                                </tr>
                                                @if($event->is_truck == 1)
                                                <tr>
                                                    <td colspan="2">{{__('Truck Fee')}} </td>
                                                    @php
                                                    $per_truck_fee = getSettings()->food_truck_fee;
                                                    $truck_fee += $noofdays * $per_truck_fee;
                                                    $event_fee_total += $truck_fee;
                                                    $event_grand_total += $truck_fee;
                                                    @endphp
                                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                                    <td class="text-right">0</td>
                                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                                </tr>
                                                @endif
                                                @if($event->is_liquor == 1)
                                                <tr>
                                                    <td colspan="2">{{__('Liquor')}} </td>
                                                    @php
                                                    $per_liquor_fee = getSettings()->liquor_fee;
                                                    $liquor_fee += $noofdays * $per_liquor_fee;
                                                    $event_fee_total += $liquor_fee;
                                                    $event_grand_total += $liquor_fee;
                                                    @endphp
                                                    <td class="text-right">{{number_format($liquor_fee, 2)}}</td>
                                                    <td class="text-right">0</td>
                                                    <td class="text-right">{{number_format($liquor_fee, 2)}}</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>

                                    <input type="hidden" id="truck_fee" value="{{$truck_fee}}">
                                    <input type="hidden" id="liquor_fee" value="{{$liquor_fee}}">
                                    <input type="hidden" id="is_truck" value="{{$event->is_truck}}">

                                    <input type="hidden" id="event_total_amount" value="{{$event_fee_total}}">
                                    <input type="hidden" id="event_vat_total" value="{{$event_vat_total}}">
                                    <input type="hidden" id="event_grand_total" value="{{$event_grand_total}}">


                                    <input type="hidden" value="{{$containsApproved}}" id="containsApproved">
                                    <input type="hidden" value="{{$isPaid}}" id="isPaid">

                                    @php
                                    $artist_fee_total = 0;
                                    $artist_vat_total = 0;
                                    $artist_g_total = 0 ;
                                    @endphp

                                    @if($event->permit)
                                    <div class="table-responsive" id="artist_pay_table" style="display:none;">
                                        <table class="table table-borderless border table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Artist Name')}}</th>
                                                    <th>{{__('Artist Permit Type')}}</th>
                                                    <th class="text-right">{{__('Fee')}} (AED)</th>
                                                    <th class="text-right">{{__('VAT')}} (5%)</th>
                                                    <th class="text-right">{{__('Total')}} (AED) </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($event->permit->artistPermit as $ap)
                                                @if($ap->artist_permit_status == 'approved' && $ap->is_paid == 0)
                                                <tr>
                                                    <td>{{getLangId() == 1 ? $ap['firstname_en'] .' '.$ap['lastname_en'] : $ap['lastname_ar'] .' '.$ap['firstname_ar']}}
                                                    </td>
                                                    <td>
                                                        {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                                    </td>
                                                    @php
                                                    $artist_fee = $ap->profession['amount'] * $noofdays;
                                                    $artist_vat = $artist_fee * 0.05;
                                                    $artist_total = $artist_fee + $artist_vat;
                                                    $artist_fee_total += $artist_fee;
                                                    $artist_vat_total += $artist_vat;
                                                    $artist_g_total += $artist_total;
                                                    @endphp
                                                    <td class="text-right">
                                                        {{number_format($artist_fee,2)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{number_format($artist_vat,2)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{number_format($artist_total, 2)}}
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" class="kt-font-bold">
                                                        Total
                                                    </td>
                                                    <td class="kt-font-bold text-right">
                                                        {{number_format($artist_fee_total,2)}}
                                                    </td>

                                                    <td class="kt-font-bold text-right">
                                                        {{number_format($artist_vat_total,2)}}
                                                    </td>
                                                    <td class="kt-font-bold text-right">
                                                        {{number_format($artist_g_total,2)}}
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div style="display:none" id="is_event_pay_div">
                                        <label class="kt-checkbox kt-checkbox--warning ml-2 mt-3">
                                            <input type="checkbox" id="isEventPay" name="isEventPay"
                                                onchange="check_permit()">
                                            Do you wish to pay associated artist permit fee ?
                                            <span></span>
                                        </label>
                                    </div>
                                    @endif

                                    <input type="hidden" id="artist_fee_total" value="{{$artist_fee_total}}">
                                    <input type="hidden" id="artist_vat_total" value="{{$artist_vat_total}}">
                                    <input type="hidden" id="artist_g_total" value="{{$artist_g_total}}">

                                    <div class="table-responsive">
                                        <div class="pull-right">
                                            <table class=" table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            {{__('Total Amount')}}
                                                        </td>
                                                        <td id="total_amt" class="pull-right kt-font-bold"></td>
                                                    </tr>
                                                    <tr style="border-bottom:1px solid black;">
                                                        <td>{{__('Total Vat')}}</td>
                                                        <td id="total_vat" class="pull-right kt-font-bold"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="kt-font-transform-u">
                                                            {{__('Grand Total')}}
                                                        </td>
                                                        <td id="grand_total" class="pull-right kt-font-bold"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <input type="hidden" id="amount">
                                    <input type="hidden" id="vat">
                                    <input type="hidden" id="total">
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('Previous')}}
                        </div>


                        <a href="{{route('event.index')}}#applied">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('Back')}}
                            </div>
                        </a>

                        @if($event->firm == 'government')

                        <a href="{{route('event.happiness', [ 'id' => $event->event_id ])}}">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                                id="submit_next_btn">
                                {{__('Next')}}
                            </div>
                        </a>
                        @else
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn">
                            <i class="fa fa-check"></i>
                            {{__('Pay')}}
                        </div>
                        @endif

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

<!--begin::Modal-->



<!--end::Modal-->


@include('permits.event.common.show_food_truck', ['truck_req'=>$truck_req])
@include('permits.event.common.show_liquor', ['liquor_req'=>$liquor_req])


@endsection


@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script src="{{asset('js/company/map.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initialize"
    async defer></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    var truckDocUploader = [];
    var liquorDocUploader = [];

    $(document).ready(function(){
        setWizard();
        wizard = new KTWizard("kt_wizard_v3");
        $('.kt-checkbox span').removeClass('compulsory');
        wizard.goTo(4);
        $('#back_btn').css('display', 'none');
        $('#next_btn').css('display', 'none');
        $('#submit_btn').css('display', 'block');
        $('#submit_next_btn').css('display', 'block');
        localStorage.clear();
        getRequirementsList();
        getAddtionalRequirementsList($('#event_id').val());
        imageUploadFunction();
        var artistContains = $('#containsApproved').val();
        var isPaid = $('#isPaid').val();
        
        if(artistContains == 1 && isPaid == 0){
            $('#is_event_pay_div').show();
        }else {
            $('#is_event_pay_div').hide();
        }

        var eventTotalAmount = $('#event_total_amount').val();
        $('#total_amt').html(parseInt(eventTotalAmount).toFixed(2));
        var eventVatTotal = $('#event_vat_total').val();
        $('#total_vat').html(parseInt(eventVatTotal).toFixed(2));
        var eventGrandTotal = $('#event_grand_total').val();
        $('#grand_total').html(parseInt(eventGrandTotal).toFixed(2));
        $('#amount').val(eventTotalAmount);
        $('#vat').val(eventVatTotal);
        $('#total').val(eventGrandTotal);
        var isTruck = $('#prev_val_isTruck').val();
        if(isTruck == 0){
            $('#truckEditBtn').hide();
        }
        var isLiquor = $('#prev_val_isLiquor').val();
        if(isLiquor == 0){
            $('#liquorEditBtn').hide();
        }
    });

    function check_permit()
    {
        var eventTotalAmount = $('#event_total_amount').val();
        var eventVatTotal = $('#event_vat_total').val();
        var eventGrandTotal = $('#event_grand_total').val();
        var artist_fee_total = $('#artist_fee_total').val();
        var artist_vat_total = $('#artist_vat_total').val();
        var artist_g_total = $('#artist_g_total').val(); 
        var total_amt = parseInt(artist_fee_total) + parseInt(eventTotalAmount);
        var total_vat = parseInt(artist_vat_total) + parseInt(eventVatTotal);
        var grand_total = parseInt(artist_g_total) + parseInt(eventGrandTotal);
        if($('#isEventPay').prop("checked"))
        {
            $('#artist_pay_table').show();
            $('#total_amt').html(total_amt.toFixed(2));
            $('#total_vat').html(total_vat.toFixed(2));
            $('#grand_total').html(grand_total.toFixed(2));
            $('#amount').val(total_amt);
            $('#vat').val(total_vat);
            $('#total').val(grand_total);
        }else {
            $('#artist_pay_table').hide();
            $('#total_amt').html(parseInt(eventTotalAmount).toFixed(2));
            $('#total_vat').html(parseInt(eventVatTotal).toFixed(2));
            $('#grand_total').html(parseInt(eventGrandTotal).toFixed(2));
            $('#amount').val(eventTotalAmount);
            $('#vat').val(eventVatTotal);
            $('#total').val(eventGrandTotal);
        }
    }

    const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            for(var i = 1; i <= parseInt(per_truck_doc);i++){
                var requiId = $('#truck_req_id_'+i).val();
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: ``,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    uploadButtonClass: 'btn btn--default mb-2 mr-2',
                    showDownload: true,
                    formData: {
                        id: i , 
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    onSuccess: function (files, response, xhr, pd) {
                            //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let truck_id = $('#this_event_truck_id').val() ;
                        let this_url = user_id + '/event/' + eventId +'/truck/'+truck_id+ '/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
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
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
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
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
                $("#truck-upload_" + i).css('pointer-events', 'none');
            }
        };


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
                        $('#edit_food_truck').modal('show');
                        for(var s = 0;s < result.length;s++)
                        {
                            var k = s + 1 ;
                           $('#food_truck_list').append('<tr><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"> <button class="btn btn-secondary" onclick="viewThisTruck('+result[s].event_truck_id+', '+k+')">view</button></td></tr>');

                        }
                    }
                }
            });
        }

        function viewThisTruck(id, num)
        {
            var url = "{{route('event.fetch_this_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
                        $('#edit_food_truck').modal('hide');
                        $('#edit_truck_title').show();
                        $('#add_truck_title').hide();
                        $('#update_this_td').show();
                        $('#add_new_td').hide();
                        $('#edit_one_food_truck').modal('show');
                        $('#company_name_en').val(result.company_name_en);
                        $('#company_name_ar').val(result.company_name_ar);
                        $('#plate_no').val(result.plate_number);
                        $('#food_type').val(result.food_type);
                        $('#regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#this_event_truck_id').val(result.event_truck_id);
                        truckDocUpload();
                    }
                }
            });
        }

       

    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            let totalLength = parseInt($('#requirements_count').val())  + parseInt($('#addi_requirements_count').val());
            for (var i = 1; i <= totalLength; i++) {
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
                    showDelete: false,
                    returnType: "json",
                    showFileCounter: false,
                    abortStr: '',
                    multiple: false,
                    maxFileCount: 2,
                    uploadButtonClass: 'btn btn--default mb-2 mr-2',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
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
                            data: {eventId: $('#event_id').val() ,reqId: $('#req_id_' + i).val()},
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
                        ); }
                    }
                });
                $('#fileuploader_' + i ).closest('div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
                $("#ajax-upload_" + i).css('pointer-events', 'none');
            }
        };

        const picUploadFunction = () => {
            var picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('event.uploadLogo')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                abortStr: '',
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showPreview: true,
                showDelete: false,
                uploadButtonClass: 'btn btn--default mb-2 mr-2',
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
            $("#pic-upload").css('pointer-events', 'none');
        };


        var eventValidator = $('#eventdetails').validate({
           
        });


        $("#check_inst").on("click", function () {
            setThis('none', 'block', 'block', 'none');
        });

        $("#event_det").on("click", function () {
  
            setThis('block', 'block', 'none', 'none');
        });

        $("#upload_doc").on("click", function () {

            setThis('block', 'block', 'none', 'none');
        });

        $('#mk_payment').on('click', function(){
    
            setThis('block', 'none', 'none', 'block');
        })

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
            $('#submit_next_btn').css('display', submit);
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
                //$('#next_btn').css('display', 'block'); // hide the next button
                eventdetails = {
                };

                localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }

            if (wizard.currentStep == 3) {
                $('#submit_btn').css('display', 'block');
                $('#submit_next_btn').css('display', 'block');
                $('#next_btn').css('display', 'none');
            }
        });


        const docValidation = () => {
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#requirements_count').val();
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) {
                if ($('#ajax-file-upload_' + i).length) {
                    if ($('#ajax-file-upload_' + i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_" + i).css('border', '2px dotted red');
                    } else {
                        hasFileArray[i] = true;
                        $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                    }
                    documentDetails[i] = {
                        issue_date: $('#doc_issue_date_' + i).val(),
                        exp_date: $('#doc_exp_date_' + i).val()
                    }
                }
            }
            }


            if (hasFileArray.includes(false) ) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
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
            $('#submit_btn').css('display', 'none');
            $('#submit_next_btn').css('display', 'none');
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
            $('#expired_date').val(expDate.format("DD-MM-YYYY"));
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });


        const getAreas = (city_id) => {
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
                type: 'POST',
                data: {id: id, firm: firm},
                success: function (result) {
                    $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Event Permit Required documents</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">Event Logo </label><p class="reqName">A image of the event logo/ banner </p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">Upload</div></div></div>');
                 if(result){
                    $('#documents_required').empty();
                     var res = result;
                     $('#requirements_count').val(res.length);
                     
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+toCapitalize(res[i].requirement_name)+' <span id="cnd_'+j+'"></span></label><p for="" class="reqName">'+( res[i].requirement_description ? toCapitalize(res[i].requirement_description) : '' ) +'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');
                         if(res[i].event_type_requirements[0].is_mandatory == 1)
                         {
                            $('#cnd_'+j).html(' * ');
                            $('#cnd_'+j).removeClass('text-muted').addClass('text-danger');
                         }else {
                            $('#cnd_'+j).html('');
                            $('#cnd_'+j).removeClass('text-danger').addClass('text-muted');
                         }

                         if(res[i].dates_required)
                         {
                            $('#issue_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker mk-disabled" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY" readonly />');
                            $('#exp_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker mk-disabled" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" readonly/>')
                         }

            
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

        function getAddtionalRequirementsList(id)
        {
            var url = "{{route('company.event.get_additional_requirements', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (result) {
                 if(result){
                    $('#addi_documents_required').empty();
                     var res = result.additional_requirements;
                     $('#addi_requirements_count').val(res.length);
                     var j =  parseInt($('#requirements_count').val()) + 1 ;
                     if(j != NaN){
                     for(var i = 0; i < res.length; i++){
                         $('#addi_documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+res[i].requirement_name.toUpperCase()+'<span class="text-danger"> * </span></label><p for="" class="reqName">'+(res[i].requirement_description ? res[i].requirement_description : '')+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                        }
                        j++;
                        $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     }
                     uploadFunction();
                 }
                }
            });

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
                    deleteStr: ``,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showDelete: true,
                    showPreview: false,
                    uploadButtonClass: 'btn btn--default mb-2 mr-2',
                    showDownload: true,
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let liquor_id = $('#event_liquor_id').val();
                        let this_url = user_id + '/event/' + eventId +'/liquor/'+liquor_id+'/'+reqID+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
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
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
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
                    }
                    
                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
                $("#liquor-upload_" + i).css('pointer-events', 'none');
            }
        };

        function go_back_truck_list()
        {
            $('#edit_food_truck').modal('show');
            $('#edit_one_food_truck').modal('hide');
        }


        function editLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url:  url,
                success: function (data) {
                    if(data) 
                    {
                        $('#liquor_details').modal('show');
                        $('#event_liquor_id').val(data.event_liquor_id);
                        $('#liquor_details .ajax-file-upload-red').trigger('click');
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
                            liquorDocUpload();
                        }
                    }
                }
            });
        }

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

        $('#submit_btn').click((e) => {
                var paidArtistFee = 0;
                if($('#isEventPay').prop("checked")){
                    paidArtistFee = 1;
                }
                $.ajax({
                    url: "{{route('company.event.make_payment')}}",
                    type: "POST",
                    data: {
                        event_id:$('#event_id').val(),
                        amount: $('#amount').val(),
                        vat: $('#vat').val(),
                        isTruck: $('#is_truck').val(),
                        truck_fee: $('#truck_fee').val(),
                        total: $('#total').val(),
                        paidArtistFee: paidArtistFee
                    },
                    success: function (result) {
                        var toUrl = "{{route('event.happiness', ':id')}}";
                        toUrl = toUrl.replace(':id', $('#event_id').val());
                        if(result.message[0]){
                            window.location.href = toUrl;
                        }
                    }
                });
                

        });


        const imageUploadFunction = () => {
            var ImageUploader = $('#image_uploader').uploadFile({
                url: "{{route('event.uploadEventPics')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "image_file",
                multiple: true,
                deleteStr: `<i class="la la-trash"></i>`,
                downloadStr: `<i class="la la-download"></i>`,
                showFileSize: false,
                showFileCounter: false,
                abortStr: '',
                showProgress: false,
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                showPreview: true,
                showDelete: false,
                showDownload: true,
                uploadButtonClass: 'btn btn--default mb-2 mr-2',
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
                                        obj.createProgress(docName, "{{asset('storage')}}"+'/' + data["path"], '');
                                    }
                                }
                            }
                        });
                },
                downloadCallback: function (files, pd) {
                    let user_id = $('#user_id').val();
                    let eventId = $('#event_id').val();
                    let this_url = user_id + '/event/' + eventId +'/pictures/'+files;
                    window.open(
                    "{{url('storage')}}"+'/' + this_url,
                    '_blank'
                    ); 
                },
            });
            $('#image_uploader div').attr('id', 'image-upload');
            $('#image_uploader + div').attr('id', 'image-file-upload');
            $("#image-upload").css('pointer-events', 'none');
        };



</script>

@endsection