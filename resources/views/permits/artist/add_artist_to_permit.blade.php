@extends('layouts.app')

@section('title', 'Add Artist - Smart Government Rak')

@section('content')
<link href="{{asset('css/uploadfile.css')}}" rel="stylesheet">
@php
$language_id = \Auth::user()->LanguageId;
@endphp
<!-- begin:: Content -->
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span>{{__('Instructions')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="artist_det">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> {{__('Artist Details')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> {{__('Upload Documents')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <!--end: Form Wizard Nav -->
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="kt-form__section kt-form__section--first">
                            <!--begin::Accordion-->
                            @include('permits.artist.common.instructions-fee')
                            <br>
                            @include('permits.artist.common.required-documents')
                            <br>
                            <label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
                                <input type="checkbox" id="agree" name="agree">
                                {{__('I read and understand all service, rules and agree to continue submitting it')}}
                                <span></span>
                            </label>

                        </div>
                    </div>
                    <!--end: Form Wizard Step 1-->
                    <input type="hidden" id="permit_from" value="{{$permit_details->issued_date}}">
                    <input type="hidden" id="permit_to" value="{{$permit_details->expired_date}}">
                    <!--begin: Permit Details Wizard-->
                    <input type="hidden" id="artist_permit_id" value="">
                    {{-- Artist details wizard Start --}}
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            {{-- <div class="kt-wizard-v3__form"> --}}
                            <form id="artist_details" novalidate autocomplete="off">
                                <div class="col-md-12 kt-margin-b-10 row">
                                    <label for="artist_number"
                                        class="col-md-3 col-form-label kt-font-bold col-sm-12 kt-padding-0 text-left text-lg-right">{{__('Search by Person Code')}}</label>
                                    <div class="col-lg-2">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm" name="code"
                                                id="code" placeholder="e.g. 2015">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <span id="changeArtistLabel" class="btn btn--maroon btn-sm d-none"
                                            onclick="removeSelectedArtist()">{{__('Change')}}
                                        </span>
                                    </div>
                                </div>
                                <div class="accordion accordion-solid accordion-toggle-plus border"
                                    id="accordionExample5">

                                    <div class="card">
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseOne6" aria-expanded="true"
                                                aria-controls="collapseOne6">
                                                <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark">
                                                    {{__('Artist Details')}}</h6>
                                            </div>
                                        </div>
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                            data-parent="#accordionExample5">
                                            <div class="card-body">
                                                <input type="hidden" id="artist_id" />
                                                <input type="hidden" id="is_old_artist" value="{{1}}" />
                                                <div class="row">
                                                    <div class="col-6">
                                                        <section class="kt-form--label-right">
                                                            <input type="hidden" id="artist_number" value={{1}}>

                                                            <div class="form-group form-group-sm row">
                                                                <label for="fname_en"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('First Name (EN)')}}<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm "
                                                                            name="fname_en" id="fname_en" dir="ltr"
                                                                            onchange="checkforArtistKeyUp()">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="fname_en"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Last Name (EN)')}}<span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm "
                                                                            name="lname_en" id="lname_en" dir="ltr"
                                                                            onchange="checkforArtistKeyUp()">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="nationality"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Nationality')}}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <select class="form-control form-control-sm "
                                                                            name="nationality" id="nationality"
                                                                            onchange="checkforArtist();">
                                                                            {{--   - class for search in select  --}}
                                                                            <option value="">{{__('Select')}}
                                                                            </option>
                                                                            @foreach ($countries as $ct)
                                                                            <option value="{{$ct->country_id}}">
                                                                                {{$language_id == 1 ? $ct->nationality_en : $ct->nationality_ar}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="dob"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Date of Birth')}}<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm "
                                                                            placeholder="DD-MM-YYYY"
                                                                            data-date-end-date="0d" name="dob" id="dob"
                                                                            value="01-01-{{date('Y') - 18}}"
                                                                            onchange="checkforArtist()" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="profession"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                    {{__('Passport No')}}<span
                                                                        class="text-danger hd-uae">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm "
                                                                            name="passport" id="passport"
                                                                            placeholder="{{__('Passport No')}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="pp_expiry"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                    {{__('Passport Expiry')}}<span
                                                                        class="text-danger hd-uae">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm date-picker "
                                                                            placeholder="DD-MM-YYYY"
                                                                            data-date-start-date="30d" name="pp_expiry"
                                                                            id="pp_expiry" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="uid_number"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('UID No')}}
                                                                    <span class="text-danger hd-uae">
                                                                        *</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm "
                                                                            name="uid_number" id="uid_number"
                                                                            placeholder="{{__('UID No')}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="form-group form-group-sm row">
                                                                <label for="uid_expiry"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('UID Expiry Date')}}<span
                                                                        class="text-danger hd-uae">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm date-picker "
                                                                            placeholder="DD-MM-YYYY"
                                                                            data-date-start-date="30d" name="uid_expiry"
                                                                            id="uid_expiry" />
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            {{-- <div class="form-group form-group-sm row">
                                                                <label for="religion"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                    {{__('Religion')}}
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <select class=" form-control form-control-sm "
                                                                            name="religion" id="religion">
                                                                            <option value=" ">{{__('Select')}}
                                                                            </option>
                                                                            @foreach ($religions as $reli)
                                                                            <option value={{$reli->id}}>
                                                                                {{$language_id == 1 ? $reli->name_en : $reli->name_ar}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div> --}}


                                                    <div class="form-group form-group-sm row">
                                                        <label for="sp_name"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Sponsor Name')}}
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="sp_name" id="sp_name">
                                                            </div>
                                                        </div>
                                                    </div>

                                                        </section>
                                                    </div>
                                                    <div class="col-6">
                                                        <section class="kt-form--label-right">
                                                            {{-- <input type="hidden" id="artist_permit_num"> --}}

                                                            <div class="form-group form-group-sm row">
                                                                <label for="fname_ar"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('First Name (AR)')}}<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text" dir="rtl"
                                                                            class="form-control form-control-sm "
                                                                            name="fname_ar" id="fname_ar">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="lname_ar"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Last Name (AR)')}}<span
                                                                        class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text" dir="rtl"
                                                                            class="form-control form-control-sm "
                                                                            name="lname_ar" id="lname_ar">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-group-sm row">
                                                                <label for="profession"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                    {{__('Profession')}} <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <select class="form-control form-control-sm "
                                                                            name="profession" id="profession"
                                                                            placeholder="Profession">
                                                                            <option value="">{{__('Select')}}
                                                                            </option>
                                                                            @foreach ($profession as $pt)
                                                                            <option value="{{$pt->profession_id}}">
                                                                                {{$language_id == 1 ? ucwords($pt->name_en) : $pt->name_ar}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group form-group-sm row">
                                                                <label for="gender"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Gender')}}
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <select class=" form-control form-control-sm "
                                                                            name="gender" id="gender">
                                                                            <option value="">{{__('Select')}}
                                                                            </option>
                                                                            <option value="1">
                                                                                {{$language_id == 1 ? 'Male' : 'الذكر'}}
                                                                            </option>
                                                                            <option value="2">
                                                                                {{$language_id == 1 ? 'Female' : 'أنثى'}}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="visa_type"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Visa Type')}}<span
                                                                        class="text-danger hd-uae hd-eu">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <select type="text"
                                                                            class="form-control form-control-sm"
                                                                            name="visa_type" id="visa_type">
                                                                            <option value="">{{__('Select')}}
                                                                            </option>
                                                                            @foreach ($visatypes as $vt)
                                                                            <option value={{$vt->id}}>
                                                                                {{$language_id == 1 ? $vt->visa_type_en : $vt->visa_type_ar}}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="visa_number"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                    {{__('Visa Number')}} <span
                                                                        class="text-danger hd-uae hd-eu">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm "
                                                                            name="visa_number" id="visa_number"
                                                                            placeholder="{{__('Visa Number')}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group-sm row">
                                                                <label for="visa_expiry"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                    {{__('Visa Expiry Date')}}<span
                                                                        class="text-danger hd-uae hd-eu">*</span>
                                                                </label>
                                                                <div class="col-lg-8">
                                                                    <div class="input-group input-group-sm">
                                                                        <input type="text"
                                                                            class="form-control form-control-sm date-picker "
                                                                            placeholder="DD-MM-YYYY"
                                                                            data-date-start-date="30d"
                                                                            name="visa_expiry" id="visa_expiry" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- <div class="form-group form-group-sm row">
                                                                <label for="id_no"
                                                                    class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Identification No')}}
                                                            <span class="text-danger sh-uae">*</span></label>
                                                            <div class="col-lg-8">
                                                                <div class="input-group input-group-sm">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm "
                                                                        name="id_no" id="id_no">
                                                                </div>
                                                            </div>
                                                    </div> --}}

                                                    <input type="hidden" value="" name="id_no" id="id_no">


                                                    {{-- <div class=" form-group form-group-sm row">
                                                        <label for="language"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Language')}}
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <select class=" form-control form-control-sm "
                                                                    name="language" id="language">
                                                                    <option value=" ">{{__('Select')}}
                                                                    </option>
                                                                    @foreach ($languages as $lang)
                                                                    <option value={{$lang->id}}>
                                                                        {{$language_id == 1 ? $lang->name_en : $lang->name_ar}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> --}}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <br>
                        <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample7">
                            <div class="card">
                                <div class="card-header" id="headingTwo6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6"
                                        aria-expanded="false" aria-controls="collapseTwo6">
                                        <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark">
                                            {{__('CONTACT DETAILS')}}
                                        </h6>
                                    </div>
                                </div>
                                <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6"
                                    data-parent="#accordionExample7">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <section class="kt-form--label-right">
                                                    <div class="form-group form-group-sm row">
                                                        <label for="mobile"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                            {{__('Mobile Number')}}<span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="mobile" id="mobile" pattern="^\+?[0-9,-]{3,14}$"
                                                                    placeholder="{{__('Mobile Number')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-sm row">
                                                        <label for="landline"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                            {{__('Phone Number')}}
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="landline" id="landline"
                                                                    placeholder="{{__('Phone Number')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="col-6">
                                                <section class="kt-form--label-right">
                                                    <div class="form-group form-group-sm row">
                                                        <label for="email"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Email')}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    placeholder="{{__('Email')}}" name="email"
                                                                    id="email" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="form-group form-group-sm row">
                                                        <label for="fax_no"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                            {{__('Fax No')}}</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="fax_no" id="fax_no">
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample8">
                            <div class="card">
                                <div class="card-header" id="headingTwo7">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo7"
                                        aria-expanded="false" aria-controls="collapseTwo7">
                                        <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark">
                                            {{__('ADDRESS INFORMATION')}}
                                        </h6>
                                    </div>
                                </div>
                                <div id="collapseTwo7" class="collapse show" aria-labelledby="headingTwo7"
                                    data-parent="#accordionExample8">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <section class="kt-form--label-right">
                                                    <div class="form-group form-group-sm row">
                                                        <label for="address"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Address')}}
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="address" id="address"
                                                                    placeholder="{{__('Address')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" form-group form-group-sm row">
                                                        <label for="address"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Emirate')}}
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <select class=" form-control form-control-sm "
                                                                    name="city" id="city"
                                                                    onChange="getAreas(this.value)">
                                                                    <option value=" ">{{__('Select')}}
                                                                    </option>
                                                                    @foreach ($emirates as $em)
                                                                    <option value={{$em->id}}
                                                                        {{$em->id == '5' ? 'selected' : ''}}>
                                                                        {{$language_id == 1 ? ucfirst($em->name_en) : $em->name_ar}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            <div class="col-6">
                                                <section class="kt-form--label-right">
                                                    <div class="form-group form-group-sm row">
                                                        <label for="email"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                            {{__('PO Box')}}</label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="po_box" id="po_box"
                                                                    placeholder="{{__('PO Box')}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-group-sm row">
                                                        <label for="address"
                                                            class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Area')}}
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <div class="input-group input-group-sm">
                                                                <select class="  form-control form-control-sm "
                                                                    name="area" id="area">
                                                                    <option value=" ">{{__('Select')}}
                                                                    </option>
                                                                    @foreach ($areas as $ar)
                                                                    <option value={{$ar->id}}>
                                                                        {{$language_id == 1 ? ucfirst($ar->area_en) : $ar->area_ar}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> {{---end accordion---}}
                            </form>
                        </div>
                    </div>
                </div>
                <!--end: Form Wizard Step 3-->
                <input type="hidden" value="{{$permit_id}}" id="permit_id">
                <input type="hidden" value="{{$from}}" id="from_page">
                <!--begin: Form Wizard Step 3-->
                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                    <div class="kt-form__section kt-form__section--first ">
                        @include('permits.components.requirements')
                        <form id="documents_required" method="post" autocomplete="off">
                            <input type="hidden" id="artist_number_doc" value={{1}}>
                            <input type="hidden" id="requirements_count" value={{count($requirements)}}>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label class="kt-font-bold text--maroon"> {{__('Artist Photo')}} <span
                                                class="text-danger">*</span></label>
                                        <p for="" class="reqName " title="Artist Photo">
                                            {{__('Use Passport size picture with white background')}} </p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label style="visibility:hidden">hidden</label>
                                        <div id="pic_uploader"> {{__('Upload')}}
                                        </div>
                                    </div>
                                </div>
                                @php
                                $i = 1;
                                $issued_date = strtotime($permit_details->issued_date);
                                $expired_date = strtotime($permit_details->expired_date);
                                $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                                @endphp
                                <input type="hidden" id="permitNoOfDays" value="{{$diff}}" />
                                @foreach ($requirements as $req)
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label
                                            class="kt-font-bold text--maroon">{{getLangId() == 1 ? ucfirst($req->requirement_name) : $req->requirement_name_ar  }}
                                            <span id="cnd_{{$i}}"></span>
                                        </label>
                                        <p for="" class="reqName    ">
                                            {{getLangId() == 1 ? ucfirst($req->requirement_description) : $req->requirement_description_ar}}
                                        </p>
                                    </div>
                                    <input type="hidden" value="{{$req->requirement_id}}" id="req_id_{{$i}}">
                                    <input type="hidden" value="{{$req->requirement_name}}" id="req_name_{{$i}}">
                                    <div class="col-lg-4 col-sm-12">
                                        <label style="visibility:hidden">hidden</label>
                                        <div id="fileuploader_{{$i}}">{{__('Upload')}}
                                        </div>
                                    </div>
                                    <input type="hidden" id="datesRequiredCheck_{{$i}}"
                                        value="{{$req->dates_required}}">
                                    <input type="hidden" id="permitTerm_{{$i}}" value="{{$req->term}}" />
                                    @if($req->dates_required == 1)
                                    <div class="col-lg-2 col-sm-12">
                                        <label for="" class="text--maroon kt-font-bold"
                                            title="Issue Date">{{__('Issue Date')}}</label>
                                        <input type="text" class="form-control form-control-sm date-picker"
                                            name="doc_issue_date_{{$i}}" data-date-end-date="0d"
                                            id="doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY"
                                            onchange="setExpiryMindate('{{$i}}')" />
                                        <input type="hidden" id="doc_validity_{{$i}}" value="{{$req->validity}}">
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <label for="" class="text--maroon kt-font-bold"
                                            title="Expiry Date">{{__('Expiry Date')}}</label>
                                        <input type="text" class="form-control form-control-sm date-picker "
                                            name="doc_exp_date_{{$i}}" data-date-start-date="+0d"
                                            id="doc_exp_date_{{$i}}" placeholder="DD-MM-YYYY" />
                                    </div>
                                    @endif
                                </div>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                        </form>
                    </div>
                </div>
            </div>
            <div class="kt-form__actions">
                <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                    data-ktwizard-type="action-prev" id="prev_btn">
                    {{__('PREVIOUS')}}
                </div>
                @php
                if($from == 'amend'){
                $route_back = 'amend';
                } elseif($from == 'edit') {
                $route_back = 'edit';
                } elseif($from == 'renew') {
                $route_back = 'renew';
                }
                @endphp
                <a
                    href="{{URL::signedRoute('artist.permit',[ 'id' => $permit_details->permit_id , 'status'=> $route_back])}}">
                    <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                        {{__('BACK')}}
                    </div>
                </a>
                <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn"
                    style="display:none;">
                    {{__('ADD ARTIST')}}
                </div>
                <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                    data-ktwizard-type="action-next" id="next_btn">
                    {{__('NEXT')}}
                </div>
            </div>
        </div>
        <!--end: Form Wizard Form-->
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
<div class="modal fade" id="artist_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Person Code Search')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearPersonCode()">
                </button>
            </div>
            <div class="modal-body" id="person_code_modal">
            </div>
        </div>
    </div>
</div>

@include('permits.artist.modals.artist_in_permit');
@include('permits.artist.modals.single_permit_artist_warning_modal')

@endsection
@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script>
    $.ajaxSetup({
            headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var picUploader ;
    var artistDetails = new Object();
    var documentDetails = new Object();
    $(document).ready(function(){
        localStorage.clear();
        setWizard();
        // upload file
       uploadFunction();
       PicUploadFunction();
       getAreas(5);
       $('.hd-eu').hide();

        wizard.on("change", function(wizard) {
            KTUtil.scrollTop();
        });
    });

    function setExpiryMindate(i) {
        var i = parseInt(i);
        // req_name_
        if ($("#doc_issue_date_" + i).length) {
            $req_name = $('#req_name_'+i).val();
            if($req_name.toLowerCase() == 'medical report')
            {
                if($("#doc_issue_date_" + i).val())
                {
                    var issuedate = moment($("#doc_issue_date_" + i).val(), 'DD-MM-YYYY').format('YYYY-MM-DD');
                    var minDate = moment(issuedate)
                        .add(6, "M").subtract(1, 'day');
                    var expDate = moment(minDate).format('DD-MM-YYYY');
                    $("#doc_exp_date_" + i).val(expDate).datepicker("update");
                    $("#doc_exp_date_" + i).attr('disabled', true);
                }else {
                    $("#doc_exp_date_" + i).val('').datepicker("update");
                    $("#doc_exp_date_" + i).attr('disabled', false);
                }

            }
        }
    }


    const uploadFunction = () => {
        // console.log($('#artist_number_doc').val());
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
            let reqId = $('#req_id_'+i).val() ;
            fileUploadFns[i] = $("#fileuploader_"+i).uploadFile({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('company.uploadDocument')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png,pdf",
                fileName: "doc_file_"+i,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                maxFileSize: 5242880,
                showFileCounter: false,
                abortStr: '',
                multiple: false,
                maxFileCount:1,
                showDownload: true,
                showDelete: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                formData: {id: i, reqName: $('#req_name_'+i).val() , reqId: $('#req_id_'+i).val()},
                onSuccess: function (files, response, xhr, pd) {
                        //You can control using PD
                    pd.progressDiv.show();
                    pd.progressbar.width('0%');
                },
                onLoad:function(obj)
                {
                    var code = $('#code').val();
                    $.ajax({
                            url: "{{route('artist.reset_req_in_session')}}",
                            type: 'POST',
                            data: { id: $('#req_id_'+i).val()}
                    })
                    $.ajax({
                        cache: false,
                        url: "{{route('company.get_files_uploaded')}}",
                        type: 'POST',
                        data: {artist_permit: $('#artist_permit_id').val(), reqId: $('#req_id_'+i).val()},
                        dataType: "json",
                        success: function(data)
                        {
                            // console.log('../../storage/'+data[0]["path"]);
                            let id = obj[0].id;
                            let number = id.split("_");
                            let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                            let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                            const d = data["path"].split("/");
                            let docName = d[d.length - 1];
                            obj.createProgress(docName,"{{url('storage')}}"+'/'+data.path,'');
                            if(formatted_issue_date != NaN-NaN-NaN)
                            {
                                $('#doc_issue_date_'+number[1]).val(formatted_issue_date);
                                $('#doc_exp_date_'+number[1]).val(formatted_exp_date);
                            }
                        }
                    });

                },
                deleteCallback: function(data, pd) // Delete function must be present when showDelete is set to true
                {
                    $.ajax({
                            cache: false,
                            url: "{{route('company.delete_files_in_session')}}",
                            type: 'POST',
                            data: {requiredID : reqId},
                            success: function (data) {

                            }
                    });
                },
                downloadCallback:function(files,pd)
                {
                    if(files.filepath) {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    } else {
                        let user_id = $('#user_id').val();
                        let artistpermitid = $('#artist_permit_id').val();
                        let this_url = user_id + '/artist/' + artistpermitid +'/'+reqId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );

                    }
                },
                onError: function (files, status, errMsg, pd) {
                    showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                    pd.statusbar.hide();
                }
            });
            $('#fileuploader_'+i+' div').attr('id', 'ajax-upload_'+i);
            $('#fileuploader_'+i+' + div').attr('id', 'ajax-file-upload_'+i);
        }
    }
    const PicUploadFunction = () => {
        picUploader = $('#pic_uploader').uploadFile({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('company.uploadPhoto')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                maxFileCount:1,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileCounter: false,
                abortStr: '',
                showDelete: true,
                showDownload: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                formData: {id: 0, reqName: 'Artist Photo' , artistNo: $('#artist_number_doc').val()},
                // onSuccess: function (files, response, xhr, pd) {
                //     pd.filename.html('');
                // },
                deleteCallback: function(data, pd) // Delete function must be present when showDelete is set to true
                {
                    $.ajax({
                            cache: false,
                            url: "{{route('company.delete_pic_files_in_session')}}",
                            type: 'POST',
                    });
                },
                onLoad:function(obj)
                {
                    $code = $('#code').val();
                    if($code){
                        var url = "{{route('company.get_uploaded_artist_photo', ':code')}}";
                        url = url.replace(':code', $code);
                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(data)
                            {
                                if(data[0])
                                {
                                    let len = data[0].artist_permit.length;
                                    let i = data[0].artist_permit.length - 1;
                                    if (data[0].artist_permit[i].thumbnail) {
                                        // let ex = explode('/', data[0].artist_permit[i].thumbnail);
                                        let ex = data[0].artist_permit[i].thumbnail.split('/').pop();
                                        obj.createProgress(ex, "{{url('storage')}}"+'/'+ data[0].artist_permit[i].thumbnail, '');
                                    }
                                }
                            }
                        });
                    }
                },
                downloadCallback: function (files, pd) {
                    if(files.filepath) {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    }else{
                        let user_id = $('#user_id').val();
                        let artistpermitid = $('#artist_permit_id').val();
                        let this_url = user_id + '/artist/' + artistpermitid +'/photos/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
                    }
                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
    }

    var detailsValidator = $("#artist_details").validate({
    ignore: [],
    rules: {
        fname_en: "required",
        fname_ar: "required",
        lname_en: "required",
        lname_ar: "required",
        profession: "required",
        permit_type: "required",
        dob: {
            required: true,
            dateNL: true
        },
        uid_number: "required",
        //uid_expiry: {
        //    required: true,
         //   dateNL: true
        //},
        passport: "required",
        pp_expiry: {
            required: true,
            dateNL: true
        },
        // visa_type: "required",
        // visa_number: 'required',
        visa_expiry: {
            dateNL: true
        },
        gender: "required",
        nationality: "required",
        address: "required",
        mobile: {
            // number: true,
            required: true
        },
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        fname_en: "",
        fname_ar: "",
        lname_en: "",
        lname_ar: "",
        profession: "",
        dob: "",
        uid_number: "",
        //uid_expiry: "",
        permit_type: "",
        passport: "",
        pp_expiry: "",
        visa_number:"",
        visa_type: "",
        visa_expiry: "",
        gender: "",
        nationality: "",
        address: "",
        mobile: {
            // number: 'Please enter number',
            required: ""
        },
        email: {
            required: "",
            email: ""
        }
    }
});


function checkVisaRequired(){
            var nationality = $('#nationality').val();
            if(nationality)
            {
                if(nationality == '232'){
                    $('.sh-uae').show();
                    $('.hd-uae').hide();
                    $('select[name="visa_type"]').rules("remove", "required");$('#visa_type').removeClass('is-invalid');
                    $('input[name="visa_number"]').rules("remove"), "required";$('#visa_number').removeClass('is-invalid');
                    $('input[name="visa_expiry"]').rules("remove", "required");$('#visa_expiry').removeClass('is-invalid');
                    $('input[name="passport"]').rules("remove", "required");$('#passport').removeClass('is-invalid');
                    $('input[name="pp_expiry"]').rules("remove", "required");$('#pp_expiry').removeClass('is-invalid');
                    $('input[name="uid_number"]').rules("remove", "required");$('#uid_number').removeClass('is-invalid');
                    $('input[name="uid_expiry"]').rules("remove", "required");$('#uid_expiry').removeClass('is-invalid');
                    $('input[name="id_no"]').rules('add', { required: true, messages: {required:''}});
                    for (var i = 1; i <= $('#requirements_count').val(); i++) {
                        if($('#req_id_'+i).val() == 6){
                            delete docRules['doc_issue_date_' + i];
                            delete docRules['doc_exp_date_' + i];
                        }
                    }
                    return ;
                }else
                {
                    $('.sh-uae').hide();
                    $('.hd-uae').show();
                    $('input[name="id_no"]').rules('remove', "required");$('#id_no').removeClass('is-invalid');
                    $('input[name="passport"]').rules('add', { required: true, messages: {required:''}});
                    $('input[name="pp_expiry"]').rules('add', { required: true, messages: {required:''}});
                    $('input[name="uid_number"]').rules('add', { required: true, messages: {required:''}});
                    $('input[name="uid_expiry"]').rules('add', { required: true, messages: {required:''}});
                    for (var i = 1; i <= $('#requirements_count').val(); i++) {
                        if($('#req_id_'+i).val() == 6){
                            docRules['doc_issue_date_' + i] = 'required';
                            docRules['doc_exp_date_' + i] = 'required';
                        }
                    }
                }
                var url = "{{route('artist.checkVisaRequired', ':id')}}";
                url = url.replace(':id', nationality);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (result) {
                        $('#nationality_cont').val(result.trim());
                        // console.log(result.trim())
                        if(result.trim() == "EU")
                        {
                            $('select[name="visa_type"]').rules('remove', "required");$('#visa_type').removeClass('is-invalid');
                            $('input[name="visa_number"]').rules('remove', "required");$('#visa_number').removeClass('is-invalid');
                            $('input[name="visa_expiry"]').rules('remove', "required");$('#visa_expiry').removeClass('is-invalid');
                            $('.hd-eu').hide();
                        }else {
                            $('select[name="visa_type"]').rules('add', { required: true, messages: {required:''}});
                            $('input[name="visa_number"]').rules('add', { required: true, messages: {required:''}});
                            $('input[name="visa_expiry"]').rules('add', { required: true, messages: {required:''}});
                            $('.hd-eu').show();
                        }

                    }
                });
            }
        }

        var docRules = {};
        var docMessages = {};
        var term;
        var documentsValidator;

        for(var i = 1; i < $('#requirements_count').val(); i++)
        {
            var noofdays = $('#permitNoOfDays').val();
            term = $('#permitTerm_'+i).val();
            if(term == 'short')
            {
                docRules['doc_issue_date_'+i] = 'required';
                docRules['doc_exp_date_'+i] = 'required';
                docMessages['doc_issue_date_'+i] = '';
                docMessages['doc_exp_date_'+i] = '';
            }
        }

        $( "#check_inst" ).on( "click", function() {
            setThis('none', 'block', 'block', 'none');
        });
        $( "#artist_det" ).on( "click", function() {
            if(!checkForTick()) { return  };
            setThis('block', 'block', 'none', 'none');
        });
        $( "#upload_doc" ).on( "click", function() {
            wizard = new KTWizard("kt_wizard_v3");
            if(!checkForTick()) return ;
            if(wizard.currentStep == 3){
                stopNext(detailsValidator);
                return;
            }
            setThis('block', 'none', 'none', 'block');
        });
        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
        }
        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result ;
            if (wizard.currentStep == 1) {
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
            }else{
                result = true;
            }
            return result;
        }
    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
        checkForTick();
       // checking the next page is artist details
       if(wizard.currentStep == 2)
       {
            stopNext(detailsValidator); // validating the artist details page
            KTUtil.scrollTop();
            // object of array storing the artist details
            var artist_id = $('#artist_number').val() ;
            if(detailsValidator.form())
            {
                $('#submit_btn').css('display', 'block'); // display the submit button
                $('#next_btn').css('display', 'none'); // hide the next button
                artistDetails = {
                    id: $('#permit_id').val(),
                    artist_permit_id: $('#artist_permit_id').val(),
                    artist_id: $('#artist_id').val(),
                    code: $('#code').val(),
                    fname_en: $('#fname_en').val(),
                    fname_ar:  $('#fname_ar').val(),
                    lname_en: $('#lname_en').val(),
                    lname_ar:  $('#lname_ar').val(),
                    nationality: $('#nationality').val(),
                    profession: $('#profession').val(),
                    permit_type: $('#permit_type').val(),
                    passport: $('#passport').val(),
                    ppExp: $('#pp_expiry').val(),
                    visaType: $('#visa_type').val(),
                    visaNumber: $('#visa_number').val(),
                    visaExp: $('#visa_expiry').val(),
                    spName: $('#sp_name').val(),
                    idNo: $('#id_no').val(),
                    //language: $('#language').val(),
                    //religion: $('#religion').val(),
                    gender: $('#gender').val(),
                    city: $('#city').val(),
                    area: $('#area').val(),
                    address: $('#address').val(),
                    uidNumber: $('#uid_number').val(),
                    uidExp: $('#uid_expiry').val(),
                    dob: $('#dob').val(),
                    po_box: $('#po_box').val(),
                    //fax_no: $('#fax_no').val(),
                    landline: $('#landline').val(),
                    mobile: $('#mobile').val(),
                    email: $('#email').val(),
                    is_old_artist: $('#is_old_artist').val()
                }
                localStorage.setItem('artistDetails', JSON.stringify(artistDetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }

        var nationality = $('#nationality').val();

            if(nationality)
            {
                var noofdays = $('#permitNoOfDays').val();
                var term ;
                for (var i = 1; i <= $('#requirements_count').val(); i++) {
                    term = $('#permitTerm_'+i).val();
                    if(term == 'short')
                    {
                        $('#cnd_'+i).html('*');
                        $('#cnd_'+i).addClass('text-danger');
                        if(nationality == '232' && $('#req_name_'+i).val().toLowerCase() == 'visa')
                        {
                            $('#cnd_'+i).html('');
                            $('#cnd_'+i).removeClass('text-danger');
                        }
                    }else{
                        $('#cnd_'+i).html('');
                        $('#cnd_'+i).removeClass('text-danger');
                    }
                    if($('#req_name_'+i).val().toLowerCase() == 'other documents')
                    {
                        $('#cnd_'+i).html('');
                    }
                }
            }
    });
    const docValidation = () => {
        var artist_number = $('#artist_number').val();
        var hasFile = true;
        var hasFileArray = [];
        documentDetails = {};
        var noofdays = $('#permitNoOfDays').val();
        var nationality = $('#nationality').val();
        var term ;
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
            term = $('#permitTerm_'+i).val();
            if(term == 'short')
            {
                if ($('#ajax-file-upload_' + i).length) {
                    if($('#ajax-file-upload_'+i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_"+i).css('border', '2px dotted red');
                        KTUtil.scrollTop();
                    }
                    else{
                        hasFileArray[i] = true;
                        $("#ajax-upload_"+i).css('border', '2px dotted #A5A5C7');
                    }
                    if($('#req_name_'+i).val().toLowerCase() == 'other documents') {
                        hasFileArray[i] = true;
                        $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                    }
                }
                if(nationality == '232' && $('#req_id_'+i).val() == 6)
                {
                    hasFileArray[i] = true;
                    $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                }
            }
            documentDetails[i] = {
                issue_date :   $('#doc_issue_date_'+i).val(),
                exp_date : $('#doc_exp_date_'+i).val()
            }
        }
        if($('#pic-file-upload').contents().length == 0) {
            hasPicture = false;
            $('#pic-upload').css('border', '2px dotted red');
        }
        else {
            hasPicture = true;
            $("#pic-upload").css('border', '2px dotted #A5A5C7');
        }
        if(hasFileArray.includes(false) || hasPicture == false){
            hasFile = false;
        } else {
            hasFile = true;
        }
        localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
        return hasFile ;
    }
    const stopNext = (validator_name) => {
        wizard.on("beforeNext", function(wizardObj) {
            if (validator_name.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        });
    }
    $('#prev_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
        // alert(wizard.currentStep);
       if(wizard.currentStep == 2){
            $('#prev_btn').css('display', 'none');
            $('#back_btn').css('display', 'block');
       }
       else
       {
            $('#prev_btn').css('display', 'block');
            $('#next_btn').css('display', 'block');
       }
       $('#submit_btn').css('display', 'none');
    });

    $('.date-picker').datepicker({format: 'dd-mm-yyyy',autoclose: true, @if(getLangId() == 2)
            language: 'ar'
            @endif});
    $('#dob').datepicker({format: 'dd-mm-yyyy',autoclose: true,todayHighlight: true, @if(getLangId() == 2)
            language: 'ar'
            @endif});
    $('#dob').on('changeDate', function(ev) { $('#dob').valid() || $('#dob').removeClass('invalid').addClass('success'); });
    $('#uid_expiry').on('changeDate', function(ev) { $('#uid_expiry').valid() || $('#uid_expiry').removeClass('invalid').addClass('success');});
    $('#pp_expiry').on('changeDate', function(ev) { $('#pp_expiry').valid() || $('#pp_expiry').removeClass('invalid').addClass('success');});
    $('#visa_expiry').on('changeDate', function(ev) { $('#visa_expiry').valid() || $('#visa_expiry').removeClass('invalid').addClass('success');});

        const getAreas = (city_id) => {
            if(city_id){
                $.ajax({
                    url:"{{url('company/fetch_areas')}}"+'/'+city_id,
                    success: function(result){
                        // console.log(result)
                        $('#area').empty();
                        $('#area').append('<option value=" ">{!!__('Select')!!}</option>');
                        for(let i = 0; i< result.length;i++)
                        {
                            let area = $('#getLangid').val() == 1 ? result[i].area_en : result[i].area_ar ;
                            if(area)
                            {
                                $('#area').append('<option value="'+result[i].id+'">'+area+'</option>');
                            }
                        }
                    }
                });
            }
        }

        $('#code').keyup(function (e) {
            var code = $('#code').val();
            if(code.length >= 4)
            {
                searchCode();
            }
        });

        function checkforArtistKeyUp(){
          setTimeout( checkforArtist(),4000);
        }

        function checkTheArtistProfession() {
            let artist_id = $('#artist_id').val();
            let profession = $('#profession').val();
            if(artist_id){
                $.ajax({
                        url:"{{route('artist.checkArtistProfession')}}",
                        type: 'POST',
                        data: {
                            artist_id: artist_id,
                            profession: profession
                        },
                        success: function (data) {
                            if(data.response == 'notallowed') {
                                $('#professionWarning').modal('show');
                                $('#profession').val('')
                                return ;
                            }
                        }
                });
            }
        }

        function searchCode() {
            let code = $('#code').val();
            var permit_id = $('#permit_id').val();
            if (code) {
                $.ajax({
                    url:"{{route('company.searchCode')}}",
                    type: 'POST',
                    data: {
                        code: code,
                        permit_id: permit_id
                    },
                    success: function (data) {

                        if(data.has_single_permit)
                        {
                            $('#singlePermitWarning').modal('show');
                            $('#code').val('');
                            return ;
                        }

                        $('#person_code_modal').empty();

                        $('#artist_exists').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });

                        let NotFoundMessage = "{{trans_choice('messages.no_artist_found', Auth::user()->LanguageId ,['personcode' => ':personcode'])}}";
                            NotFoundMessage = NotFoundMessage.replace(":personcode", code);

                        if(data.artist_d == null)
                        {
                            $('#person_code_modal').append('<p class="text-center text-danger kt-font-bolder"><span class="text--maroon kt-font-bold"> '+NotFoundMessage+'</span></p> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-wide btn-sm mr-3" onclick="clearPersonCode()"data-dismiss="modal">{!!__("OK")!!}</button> </div>');
                            return;
                        }else if(data.artist_d.artist_status == 'blocked')
                        {
                            $('#person_code_modal').append('<div class="kt--maroon text-center kt-font-bold">{!!__("Sorry, This Artist is blocked ! Please Select a New Artist")!!}</div>');
                            return ;
                        }

                        data = data.artist_d ;

                        if(data.artist_permit.length > 0) {

                            let total_aps = data.artist_permit.length;
                            let j = total_aps - 1 ;
                            if(total_aps > 0) {
                                $('#person_code_modal').append('<div class="kt-widget30__item d-flex justify-content-around"> <div class="kt-widget30__pic mr-2"> <img id="profImg" title="image"> </div> <div class="kt-widget30__info" id="PC_Popup_Table"> <table> <tr> <th>{!!__('Name')!!}:</th> <td id="ex_artist_en_name"></td> </tr>  <tr> <th>{!!__('Date of Birth')!!}:</th> <td id="ex_artist_dob"></td> </tr> <tr> <th>{!!__('Gender')!!}:</th> <td id="ex_artist_gender"></td> </tr> <tr> <th>{!!__('Mobile Number')!!}:</th> <td id="ex_artist_mobilenumber"></td> </tr><tr> <th>{!!__('Email')!!}:</th> <td id="ex_artist_email"></td> </tr> <tr> <th>{!!__('Nationality')!!}:</th> <td id="ex_artist_nationality"></td> </tr> </table> </div> <input type="hidden" id="artistDetailswithcode"> </div> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="setArtistDetails(1)" data-dismiss="modal">{!!__('Select this artist')!!}</button> <button class="btn btn--maroon btn-bold btn-sm" onclick="clearPersonCode()" data-dismiss="modal">{!!__('Not this artist')!!}</button> </div>');
                                $('#artistDetailswithcode').val(JSON.stringify(data));
                                var getLangId = $('#getLangid').val();
                                let apd = data.artist_permit[j];
                                $('#ex_artist_en_name').html(getLangId == 1 ? capitalizeFirst(apd.firstname_en)+' '+capitalizeFirst(apd.lastname_en)  : apd.lastname_ar+' '+apd.firstname_ar);
                                $('#ex_artist_mobilenumber').html(apd.mobile_number);
                                $('#ex_artist_email').html(apd.email);
                                $('#ex_artist_personcode').html(data.person_code);
                                var dob = moment(apd.birthdate, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                $('#ex_artist_dob').html(dob);
                                $('#ex_artist_nationality').html(getLangId == 1 ? capitalizeFirst(apd.nationality.nationality_en) : apd.nationality.nationality_ar);
                                var gender = apd.gender == 1 ? '{{__('Male')}}' : '{{__('Female')}}';
                                $('#ex_artist_gender').html(gender);
                                $('#profImg').attr('src', apd.thumbnail ? "{{url('storage')}}"+'/'+apd.thumbnail : '');
                                $('#profImg').css({
                                    height: '150px',
                                    width: '135px',
                                    objectFit: 'cover',
                                    padding: '5px',
                                    border: '1px solid rgba(0,0,0,0.4)'
                                });
                            }
                        }
                        else
                        {
                            $('#person_code_modal').append('<p class="text-center text-danger kt-font-bolder"><span class="text--maroon kt-font-bold"> '+NotFoundMessage+'</span></p> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-wide btn-sm mr-3" onclick="clearPersonCode()"data-dismiss="modal">{!!__("OK")!!}</button> </div>');
                        }

                    },error:function(){

                        alert("error!!!!");

                    }
                });
            }
        }

        const setArtistDetails = (from) => {
            $('.ajax-file-upload-red').trigger('click');
            let ad = $('#artistDetailswithcode').val();
            ad = JSON.parse(ad);
            let apd ;
            if(from == 1)
            {
                let ap_count = ad.artist_permit.length;
                let i = ap_count - 1;
                apd = ad.artist_permit[i];
                $('#artist_id').val(ad.artist_id);
                $('#code').val(ad.person_code);
                setDataIntoArtistDetails(apd);
            }else if(from == 2){
                $.ajax({
                    url: "{{route('artist.check_artist_exists_in_permit')}}",
                    type: "POST",
                    async: false,
                    data: {
                        permit_id:$('#permit_id').val(),
                        artist_id: ad.artist.artist_id
                    },
                    success: function (result) {
                        if(result.trim() == 'yes')
                        {
                            $('#artist_in_permit_exists').modal('show');
                            clearPersonCode();
                            return ;
                        }else {
                            apd = ad;
                            $('#artist_id').val(ad.artist.artist_id);
                            $('#code').val(ad.artist.person_code);
                            setDataIntoArtistDetails(apd);
                        }
                    }
                });
            }

        }

        function setDataIntoArtistDetails(apd)
        {
            $('#is_old_artist').val(2);

            var dob = moment(apd.birthdate, 'YYYY-MM-DD').format('DD-MM-YYYY');

            $('#changeArtistLabel').removeClass('d-none');
            $('#changeArtistLabel').addClass('ml-2');

            $('#code').addClass('mk-disabled');
            $('#fname_en').val(apd.firstname_en);
            $('#fname_en').addClass('mk-disabled');
            $('#fname_ar').val(apd.firstname_ar);
            $('#fname_ar').addClass('mk-disabled');
            $('#lname_en').val(apd.lastname_en);
            $('#lname_en').addClass('mk-disabled');
            $('#lname_ar').val(apd.lastname_ar);
            $('#lname_ar').addClass('mk-disabled');
            $('#nationality').val(apd.country_id),
            $('#profession').val(apd.profession_id),
            $('#permit_type').val(apd.permit_type_id),
            $('#passport').val(apd.passport_number);
            var ppExp = moment(apd.passport_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('#pp_expiry').val(ppExp).datepicker('update');
            var visaExp = moment(apd.visa_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('#visa_expiry').val(visaExp).datepicker('update');
            var uidExp = moment(apd.uid_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            //$('#uid_expiry').val(uidExp).datepicker('update');
            $('#visa_type').val(apd.visa_type_id),
            $('#visa_number').val(apd.visa_number),
            $('#sp_name').val(apd.sponsor_name_en),
            $('#id_no').val(apd.identification_number);

            $('#gender').val(apd.gender_id);
            if(apd.emirate_id){
                $('#city').val(apd.emirate_id);
            }
            getAreas(apd.emirate_id);
            $('#address').val(apd.address_en),
            $('#uid_number').val(apd.uid_number),
            $('#dob').val(dob).datepicker('update'),
            $('#landline').val(apd.phone_number),
            $('#po_box').val(apd.po_box),
           // $('#fax_no').val(apd.fax_number),
            $('#mobile').val(apd.mobile_number),
            $('#email').val(apd.email);
            $('#artist_permit_id').val(apd.artist_permit_id);
            $('#area').val(apd.area_id);
            PicUploadFunction();
            uploadFunction();
            detailsValidator.form();
            $('#artist_exists').modal('hide');
            // $('#artist_details').validate();
        }


        function clearPersonCode() {
            $('#code').val('');
            $('#is_old_artist').val(1);
            $('#artist_exists').modal('hide');
        }

        function removeSelectedArtist(){
            $('.ajax-file-upload-red').trigger('click');
            $('#artist_details').trigger('reset');
            $('#documents_required').trigger('reset');
            $('#artist_id').val('');
            $('#fname_en').removeClass('mk-disabled');
            $('#fname_ar').removeClass('mk-disabled');
            $('#lname_en').removeClass('mk-disabled');
            $('#lname_ar').removeClass('mk-disabled');
            $('#artist_permit_id').val('');
            $('#changeArtistLabel').addClass('d-none');
            $('#code').removeClass('mk-disabled');
            $('#code').val('');
            $('#is_old_artist').val(1);
            PicUploadFunction();
            uploadFunction();
            $('#artist_exists').modal('hide');
        }

        function checkforArtist() {
            let firstname = $("#fname_en").val();
            let lastname = $("#lname_en").val();
            let nationality = $("#nationality").val();
            let dob = $("#dob").val();
            if (firstname != "" && lastname != "" && nationality != "" && dob != "") {
                $.ajax({
                    url: "{{route('artist.check_artist_exists')}}",
                    type: "POST",
                    data: {
                        fname: firstname,
                        lname: lastname,
                        nationality: nationality,
                        dob: dob
                    },
                    success: function(result) {
                        if (result.isArtist) {
                            var data = result.data;
                            $("#person_code_modal").empty();
                            $("#artist_exists").modal({
                                backdrop: "static",
                                keyboard: false,
                                show: true
                            });
                            if(data.artist.artist_status == 'blocked')
                            {
                                $('#person_code_modal').append('<div class="text--maroon">Sorry This Artist is blocked ! Please Select a New Artist</div>');
                                return ;
                            }
                            $("#person_code_modal").append(
                                '<div class="kt-widget30__item d-flex justify-content-around"> <div class="kt-widget30__pic mr-2"> <img id="profImg" title="image"> </div> <div class="kt-widget30__info" id="PC_Popup_Table"> <table> <tr> <th>{{__('Name')}}:</th> <td id="ex_artist_en_name"></td> </tr> <tr> <tr> <th>DOB:</th> <td id="ex_artist_dob"></td> </tr> <tr> <th>{{__('Gender')}}:</th> <td id="ex_artist_gender"></td> </tr> <tr> <th>{{__('Mobile Number')}}:</th> <td id="ex_artist_mobilenumber"></td> </tr><tr> <th>{{__('Email')}}:</th> <td id="ex_artist_email"></td> </tr> <tr> <th>{{__('Nationality')}}:</th> <td id="ex_artist_nationality"></td> </tr> </table> </div> <input type="hidden" id="artistDetailswithcode"> </div> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="setArtistDetails(2)"data-dismiss="modal">{{__('Select this Artist')}}</button> <button class="btn btn--maroon btn-bold btn-sm" onclick="clearPersonCode()" data-dismiss="modal">{{__('Not this Artist')}}</button> </div>'
                            );
                            $("#artistDetailswithcode").val(JSON.stringify(data));
                            var langid = $('#getLangid').val();
                            $('#ex_artist_en_name').html(langid == 1 ? capitalizeFirst(data.firstname_en)+' '+capitalizeFirst(data.lastname_en)  : data.lastname_ar+' '+data.firstname_ar);

                            $("#ex_artist_mobilenumber").html(data.mobile_number);
                            $("#ex_artist_email").html(data.email);
                            $("#ex_artist_personcode").html(data.person_code);
                            var dob = moment(data.birthdate, "YYYY-MM-DD").format("DD-MM-YYYY");
                            $("#ex_artist_dob").html(dob);
                            $("#ex_artist_nationality").html(langid == 1 ? capitalizeFirst(data.nationality.nationality_en) : data.nationality.nationality_ar);
                            var gender = data.gender == 1 ? __('Male') : __('Female');
                            $("#ex_artist_gender").html(gender);
                            $("#profImg").attr(
                                "src",
                                data.thumbnail
                                    ? "{{url('storage')}}" + "/" + data.thumbnail
                                    : ""
                            );
                            $("#profImg").css({
                                height: "150px",
                                width: "135px",
                                objectFit: "cover",
                                padding: "5px",
                                border: "1px solid rgba(0,0,0,0.4)"
                            });
                        }
                    }
                });
            }
        }

        $('#submit_btn').click((e) => {
        var hasFile = docValidation();
        documentsValidator = $('#documents_required').validate({
            rules: docRules,
            messages: docMessages
        })
        if(documentsValidator.form() && hasFile){
        var ad = localStorage.getItem('artistDetails');
        var dd = localStorage.getItem('documentDetails');
        var artist_permit_id = $('#artist_permit_id').val();
        var permit_from = $('#permit_from').val();
        var permit_to = $('#permit_to').val();
        var permit_id = $('#permit_id').val();
        var from_page = $('#from_page').val();
        // $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');

        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
        });
        $.ajax({
                url:"{{route('company.add_artist_temp')}}",
                type: "POST",
                data: {
                    artistD: ad ,
                    documentD: dd ,
                    permit_id: permit_id,
                    from: permit_from,
                    to: permit_to,
                    btnOption: 1,
                    fromPage: from_page
                },
                beforeSend: function() {
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: '{{__("Please wait...")}}'
                });
                },
                success: function(result){
                    localStorage.clear();
                    // let toUrl= "{{route('artist.permit',[ 'id' => ':id' , 'from' => ':from'])}}";;
                    // if(from_page == 'amend'){
                    //     toUrl = toUrl.replace(':from', 'amend');
                    // }else if(from_page == 'edit') {
                    //     toUrl = toUrl.replace(':from', 'edit');
                    // } else if(from_page == 'renew') {
                    //     toUrl = toUrl.replace(':from', 'renew');
                    // }
                    // toUrl = toUrl.replace(':id', permit_id);
                    window.location.href= result.toURL ;
                    KTApp.unblockPage();
                }
            });
        }
        })
</script>
{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}
@endsection
