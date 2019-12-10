@extends('layouts.app')
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
                                    <span>03</span> {{__('Upload Docs')}}
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
                    @include('permits.artist.common.wizard_instructions')
                    <!--end: Form Wizard Step 1-->
                    <input type="hidden" id="permit_from" value="{{$permit_details->issued_date}}">
                    <input type="hidden" id="permit_to" value="{{$permit_details->expired_date}}">
                    <!--begin: Permit Details Wizard-->
                    <input type="hidden" id="artist_permit_id" value="{{$permit_details->artist_permit_id}}">
                    {{-- Artist details wizard Start --}}
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="artist_details" novalidate autocomplete="off">
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">

                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u">{{__('Personal Information')}}</h6>
                                                </div>
                                            </div>
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#accordionExample5">
                                                <div class="card-body">
                                                    <input type="hidden" id="artist_id" />
                                                    <input type="hidden" id="is_old_artist" value="1" />
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <section class="kt-form--label-right">
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="artist_number"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Person Code')}}</label>
                                                                    <input type="hidden" id="artist_number" value={{1}}>
                                                                    <div class="col-lg-5">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="code" id="code"
                                                                                placeholder="{{__('Person Code')}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <span id="changeArtistLabel"
                                                                            class="kt-badge  kt-badge--danger kt-badge--inline d-none"
                                                                            onclick="removeSelectedArtist()">{{__('change')}}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_en"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('First Name')}}<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="fname_en" id="fname_en"
                                                                                placeholder="{{__('First Name')}}"
                                                                                onchange="checkforArtist()">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_en"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Last Name')}}<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="lname_en" id="lname_en"
                                                                                placeholder="{{__('Last Name')}}"
                                                                                onchange="checkforArtist()">
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
                                                                            <select
                                                                                class="form-control form-control-sm "
                                                                                name="nationality" id="nationality"
                                                                                onchange="checkforArtist();checkVisaRequired();">
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
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Birth Date')}}<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                placeholder="DD-MM-YYYY"
                                                                                data-date-end-date="0d" name="dob"
                                                                                id="dob" onchange="checkforArtist()" />
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
                                                                                data-date-start-date="30d"
                                                                                name="pp_expiry" id="pp_expiry" />
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
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="dob"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('UID Expiry')}}<span
                                                                            class="text-danger hd-uae">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm date-picker "
                                                                                placeholder="DD-MM-YYYY"
                                                                                data-date-start-date="30d"
                                                                                name="uid_expiry" id="uid_expiry" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="religion"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                        {{__('Religion')}}
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
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
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="col-6">
                                                            <section class="kt-form--label-right">
                                                                {{-- <input type="hidden" id="artist_permit_num"> --}}
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="profession"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                        {{__('Profession')}} <span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="form-control form-control-sm "
                                                                                name="profession" id="profession"
                                                                                placeholder="Profession">
                                                                                <option value="">{{__('Select')}}
                                                                                </option>
                                                                                @foreach ($profession as $pt)
                                                                                <option value="{{$pt->profession_id}}">
                                                                                    {{ucwords($language_id == 1 ? $pt->name_en : $pt->name_ar)}}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_ar"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('First Name - Ar')}}<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text" dir="rtl"
                                                                                class="form-control form-control-sm "
                                                                                name="fname_ar" id="fname_ar"
                                                                                placeholder="{{__('First Name - Ar')}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="lname_ar"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Last Name - Ar')}}<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text" dir="rtl"
                                                                                class="form-control form-control-sm "
                                                                                name="lname_ar" id="lname_ar"
                                                                                placeholder="{{__('Last Name - Ar')}}">
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
                                                                            <select
                                                                                class=" form-control form-control-sm "
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
                                                                        {{__('Visa Expiry')}}<span
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
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="id_no"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">Identification
                                                                        No <span
                                                                            class="text-danger sh-uae">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="id_no" id="id_no"
                                                                                placeholder="Identification No.">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="sp_name"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">Sponser
                                                                        Name <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="sp_name" id="sp_name"
                                                                                placeholder="Sponser Name">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" form-group form-group-sm row">
                                                                    <label for="language"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Language')}}
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
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
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample7">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseTwo6" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u">{{__('Contact Information')}}
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
                                                                        {{__('Mobile No')}}<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="mobile" id="mobile"
                                                                                placeholder="{{__('Mobile No')}}">
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
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
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
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                placeholder="{{__('Email')}}"
                                                                                name="email" id="email" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fax_no"
                                                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                                        {{__('Fax No')}}</label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="fax_no" id="fax_no"
                                                                                placeholder="Fax No">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample8">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo7">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseTwo7" aria-expanded="false"
                                                    aria-controls="collapseTwo7">
                                                    <h6 class="kt-font-transform-u">{{__('Address Information')}}
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
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
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
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="city" id="city"
                                                                                onChange="getAreas(this.value)">
                                                                                <option value=" ">{{__('Select')}}
                                                                                </option>
                                                                                @foreach ($emirates as $em)
                                                                                <option value={{$em->id}}
                                                                                    {{$em->id == '5' ? 'selected' : ''}}>
                                                                                    {{$language_id == 1 ? $em->name_en : $em->name_ar}}
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
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
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
                                                                            <select
                                                                                class="  form-control form-control-sm "
                                                                                name="area" id="area">
                                                                                <option value=" ">{{__('Select')}}
                                                                                </option>
                                                                                @foreach ($areas as $ar)
                                                                                <option value={{$ar->id}}>
                                                                                    {{$language_id == 1 ? $ar->area_en : $ar->area_ar}}
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
                            <div class="kt-wizard-v3__form">
                                <form id="documents_required" method="post" autocomplete="off">
                                    <input type="hidden" id="artist_number_doc" value={{1}}>
                                    <input type="hidden" id="requirements_count" value={{count($requirements)}}>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="kt-font-bold text--maroon"> Artist Photo <span
                                                        class="text-danger">( required
                                                        )</span></label>
                                                <p for="" class="reqName " title="Artist Photo">
                                                    Use Passport size picture with white background</p>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label style="visibility:hidden">hidden</label>
                                                <div id="pic_uploader">Upload
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
                                                    class="kt-font-bold text--maroon">{{getLangId() == 1 ? ucwords($req->requirement_name) : $req->requirement_name_ar  }}
                                                    <span id="cnd_{{$i}}"></span>
                                                </label>
                                                <p for="" class="reqName    ">
                                                    {{getLangId() == 1 ? ucwords($req->requirement_description) : $req->requirement_description_ar}}
                                                </p>
                                            </div>
                                            <input type="hidden" value="{{$req->requirement_id}}" id="req_id_{{$i}}">
                                            <input type="hidden" value="{{$req->requirement_name}}"
                                                id="req_name_{{$i}}">
                                            <div class="col-lg-4 col-sm-12">
                                                <label style="visibility:hidden">hidden</label>
                                                <div id="fileuploader_{{$i}}">Upload
                                                </div>
                                            </div>
                                            <input type="hidden" id="datesRequiredCheck_{{$i}}"
                                                value="{{$req->dates_required}}">
                                            <input type="hidden" id="permitTerm_{{$i}}" value="{{$req->term}}" />
                                            @if($req->dates_required == 1)
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue
                                                    Date</label>
                                                <input type="text" class="form-control form-control-sm date-picker"
                                                    name="doc_issue_date_{{$i}}" data-date-end-date="0d"
                                                    id="doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY"
                                                    onchange="setExpiryMindate('{{$i}}')" />
                                                <input type="hidden" id="doc_validity_{{$i}}"
                                                    value="{{$req->validity}}">
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="" class="text--maroon kt-font-bold"
                                                    title="Expiry Date">Expiry
                                                    Date</label>
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
                </div>
                <div class="kt-form__actions">
                    <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                        data-ktwizard-type="action-prev" id="prev_btn">
                        Previous
                    </div>
                    @php
                    if($from == 'amend'){
                    $route_back = $permit_details->permit_id.'/amend';
                    } elseif($from == 'edit') {
                    $route_back = $permit_details->permit_id.'/edit';
                    } elseif($from == 'renew') {
                    $route_back = $permit_details->permit_id.'/renew';
                    }
                    @endphp
                    <a href="{{url('company/artist/permit/'.$route_back)}}">
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                            Back
                        </div>
                    </a>
                    <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn"
                        style="display:none;">
                        Add Artist
                    </div>
                    <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                        data-ktwizard-type="action-next" id="next_btn">
                        Next Step
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
                <h5 class="modal-title" id="exampleModalLabel">Person Code Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearPersonCode()">
                </button>
            </div>
            <div class="modal-body" id="person_code_modal">
            </div>
        </div>
    </div>
</div>
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
       $('.sh-uae').hide();

        wizard.on("change", function(wizard) {
            KTUtil.scrollTop();
        });
    });
    const uploadFunction = () => {
        // console.log($('#artist_number_doc').val());
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
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
                showFileCounter: false,
                abortStr: '',
                multiple: false,
                maxFileCount:1,
                showDownload: true,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: i, reqName: $('#req_name_'+i).val() , reqId: $('#req_id_'+i).val()},
                onSuccess: function (files, response, xhr, pd) {
                        //You can control using PD
                    pd.progressDiv.show();
                    pd.progressbar.width('0%');
                },
                onLoad:function(obj)
                {
                    var code = $('#code').val();
                    if(code || $('#artist_permit_id').val())
                    {
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
                                obj.createProgress(data.requirement['requirement_name'],"{{url('storage')}}"+'/'+data.path,'');
                                if(formatted_issue_date != NaN-NaN-NaN)
                                {
                                    $('#doc_issue_date_'+number[1]).val(formatted_issue_date);
                                    $('#doc_exp_date_'+number[1]).val(formatted_exp_date);
                                }
                            }
                        });
                    }else{
                        var loadUrl = "{{route('company.resetUploadsSession', ':id')}}";
                        loadUrl = loadUrl.replace(':id', $('#req_id_' + i).val());
                        $.ajax({
                            url: loadUrl
                        });
                    }
                },
                downloadCallback:function(files,pd)
                {
                    let file_path = files.filepath;
                    let path = file_path.replace('public/','');
                    window.open(
                    "{{url('storage')}}"+'/' + path,
                    '_blank'
                    );
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
                showPreview:true,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                previewHeight: '100px',
                previewWidth: "auto",
                abortStr: '',
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: 0, reqName: 'Artist Photo' , artistNo: $('#artist_number_doc').val()},
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
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
                                if(data[0].artist_permit[0].original)
                                {
                                    obj.createProgress('',"{{url('storage')}}"+'/'+data[0].artist_permit[0].original,'');
                                }
                            }
                        });
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
        uid_expiry: {
            required: true,
            dateNL: true
        },
        passport: "required",
        pp_expiry: {
            required: true,
            dateNL: true
        },
        visa_type: "required",
        visa_number: 'required',
        visa_expiry: {
            required: true,
            dateNL: true
        },
        sp_name: "required",
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
        uid_expiry: "",
        permit_type: "",
        passport: "",
        pp_expiry: "",
        visa_number:"",
        visa_type: "",
        visa_expiry: "",
        sp_name: "",
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
            if((term == 'long' && noofdays > 30) || term == 'short')
            {
                docRules['doc_issue_date_'+i] = 'required';
                docRules['doc_exp_date_'+i] = 'required';
                docMessages['doc_issue_date_'+i] = 'This field is required';
                docMessages['doc_exp_date_'+i] = 'This field is required';
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
                    language: $('#language').val(),
                    religion: $('#religion').val(),
                    gender: $('#gender').val(),
                    city: $('#city').val(),
                    area: $('#area').val(),
                    address: $('#address').val(),
                    uidNumber: $('#uid_number').val(),
                    uidExp: $('#uid_expiry').val(),
                    dob: $('#dob').val(),
                    po_box: $('#po_box').val(),
                    fax_no: $('#fax_no').val(),
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
                    if((term == 'long' && noofdays > 30) || term == 'short')
                    {
                        $('#cnd_'+i).html('( Required )');
                        $('#cnd_'+i).addClass('text-danger');
                        $('#cnd_'+i).removeClass('text-muted');
                        if(nationality == '232' && $('#req_id_'+i).val() == 6)
                        {
                            $('#cnd_'+i).html('( Optional )');
                            $('#cnd_'+i).removeClass('text-danger');
                            $('#cnd_'+i).addClass('text-muted');
                        }
                    }else{
                        $('#cnd_'+i).html('( Optional )');
                        $('#cnd_'+i).removeClass('text-danger');
                        $('#cnd_'+i).addClass('text-muted');
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
            if((term == 'long' && noofdays > 30) || term == 'short')
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

    $('.date-picker').datepicker({format: 'dd-mm-yyyy',autoclose: true});
    $('#dob').datepicker({format: 'dd-mm-yyyy',autoclose: true,todayHighlight: true,startView: 2, endDate: '-10Y'});
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
                        $('#area').append('<option value=" ">Select</option>');
                        for(let i = 0; i< result.length;i++)
                        {
                            $('#area').append('<option value="'+result[i].id+'">'+result[i].area_en+'</option>');
                        }
                    }
                });
            }
        }

        $('#code').change(function() {
            searchCode();
        });

        function searchCode(e) {
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

                    $('#artist_exists').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                    $('#person_code_modal').empty();
                    if(data.artist_status == 'blocked')
                    {
                        $('#person_code_modal').append('<div class="kt-font-dark kt-font-bold">Sorry This Artist is blocked ! Please Select a New Artist</div>');
                        return ;
                    }
                    if(data.artist_permit) {
                        let total_aps = data.artist_permit.length;
                            let j = total_aps - 1 ;
                            if(total_aps > 0) {
                                $('#person_code_modal').append('<div class="kt-widget30__item d-flex justify-content-around"> <div class="kt-widget30__pic mr-2"> <img id="profImg" title="image"> </div> <div class="kt-widget30__info" id="PC_Popup_Table"> <table> <tr> <th>Name:</th> <td id="ex_artist_en_name"></td> </tr> <tr> <th>Name(Ar):</th> <td id="ex_artist_ar_name"></td> </tr> <tr> <th>DOB:</th> <td id="ex_artist_dob"></td> </tr> <tr> <th>Gender:</th> <td id="ex_artist_gender"></td> </tr> <tr> <th>Mobile:</th> <td id="ex_artist_mobilenumber"></td> </tr><tr> <th>Email:</th> <td id="ex_artist_email"></td> </tr> <tr> <th>Nationality:</th> <td id="ex_artist_nationality"></td> </tr> </table> </div> <input type="hidden" id="artistDetailswithcode"> </div> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="setArtistDetails(1)" data-dismiss="modal">Select this Artist</button> <button class="btn btn--maroon btn-bold btn-sm" onclick="clearPersonCode()" data-dismiss="modal">Not this Artist</button> </div>');
                                $('#artistDetailswithcode').val(JSON.stringify(data));
                                let apd = data.artist_permit[j];
                                $('#ex_artist_en_name').html((apd.firstname_en != null ?  apd.firstname_en : '') + ' ' + (apd.lastname_en != null ? apd.lastname_en : ''));
                                $('#ex_artist_ar_name').html((apd.firstname_ar != null ?  apd.firstname_ar : '') + ' '+ (apd.lastname_ar != null ? apd.lastname_ar : ''));
                                $('#ex_artist_mobilenumber').html(apd.mobile_number);
                                $('#ex_artist_email').html(apd.email);
                                $('#ex_artist_personcode').html(data.person_code);
                                var dob = moment(apd.birthdate, 'YYYY-MM-DD').format('DD-MM-YYYY');
                                $('#ex_artist_dob').html(dob);
                                $('#ex_artist_nationality').html(apd.nationality.nationality_en);
                                var gender = apd.gender == 1 ? 'Male' : 'Female';
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
                            $('#person_code_modal').append('<p class="text-center"><span class="text--maroon kt-font-bold">** Optional field</span><br/>Sorry ! No Artist Found with <span class="text--maroon kt-font-bold" id="not_artist_personcode"></span> ( or  is already added ). <br /> Please Add Another Artist ! </p> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="clearPersonCode()"data-dismiss="modal">Ok !</button> </div>');
                            $('#not_artist_personcode').html(code);
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
            }else if(from == 2){
                apd = ad;
                $('#artist_id').val(ad.artist.artist_id);
                $('#code').val(ad.artist.person_code);
            }

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
            $('#uid_expiry').val(uidExp).datepicker('update');
            $('#visa_type').val(apd.visa_type_id),
            $('#visa_number').val(apd.visa_number),
            $('#sp_name').val(apd.sponsor_name_en),
            $('#id_no').val(apd.identification_number);
            if(apd.language_id){
                $('#language').val(apd.language_id);
            }
            if(apd.religion_id){
                $('#religion').val(apd.religion_id);
            }
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
            $('#fax_no').val(apd.fax_number),
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
                                '<div class="kt-widget30__item d-flex justify-content-around"> <div class="kt-widget30__pic mr-2"> <img id="profImg" title="image"> </div> <div class="kt-widget30__info" id="PC_Popup_Table"> <table> <tr> <th>Name:</th> <td id="ex_artist_en_name"></td> </tr> <tr> <th>Name(Ar):</th> <td id="ex_artist_ar_name"></td> </tr> <tr> <th>DOB:</th> <td id="ex_artist_dob"></td> </tr> <tr> <th>Gender:</th> <td id="ex_artist_gender"></td> </tr> <tr> <th>Mobile:</th> <td id="ex_artist_mobilenumber"></td> </tr><tr> <th>Email:</th> <td id="ex_artist_email"></td> </tr> <tr> <th>Nationality:</th> <td id="ex_artist_nationality"></td> </tr> </table> </div> <input type="hidden" id="artistDetailswithcode"> </div> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="setArtistDetails(2)"data-dismiss="modal">Select this Artist</button> <button class="btn btn--maroon btn-bold btn-sm" onclick="clearPersonCode()" data-dismiss="modal">Not this Artist</button> </div>'
                            );
                            $("#artistDetailswithcode").val(JSON.stringify(data));
                            $("#ex_artist_en_name").html(
                                (data.firstname_en != null ? data.firstname_en : "") +
                                    " " +
                                    (data.lastname_en != null ? data.lastname_en : "")
                            );
                            $("#ex_artist_ar_name").html(
                                (data.firstname_ar != null ? data.firstname_ar : "") +
                                    " " +
                                    (data.lastname_ar != null ? data.lastname_ar : "")
                            );
                            $("#ex_artist_mobilenumber").html(data.mobile_number);
                            $("#ex_artist_email").html(data.email);
                            $("#ex_artist_personcode").html(data.person_code);
                            var dob = moment(data.birthdate, "YYYY-MM-DD").format(
                                "DD-MM-YYYY"
                            );
                            $("#ex_artist_dob").html(dob);
                            $("#ex_artist_nationality").html(
                                data.nationality.nationality_en
                            );
                            var gender = data.gender == 1 ? "Male" : "Female";
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
        $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
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
                    to: permit_to
                  },
                success: function(result){
                    localStorage.clear();
                    let toUrl= "{{route('artist.permit',[ 'id' => ':id' , 'from' => ':from'])}}";;
                    if(from_page == 'amend'){
                        toUrl = toUrl.replace(':from', 'amend');
                    }else if(from_page == 'edit') {
                        toUrl = toUrl.replace(':from', 'edit');
                    } else if(from_page == 'renew') {
                        toUrl = toUrl.replace(':from', 'renew');
                    }
                    toUrl = toUrl.replace(':id', permit_id);
                    window.location.href= toUrl ;
                }
            });
        }
        })
</script>
{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}
@endsection