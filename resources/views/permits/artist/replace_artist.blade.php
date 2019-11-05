@extends('layouts.app')
@section('content')
<link href="{{asset('css/uploadfile.css')}}" rel="stylesheet">
@php
$language_id = Auth::user()->LanguageId;
@endphp
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span> Check Instructions
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="artist_det">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> Artist Details
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> Upload Docs
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <input type="hidden" id="temp_id" value="{{$artist_details->id}}">

            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->
                    @include('permits.artist.common.wizard_instructions')
                    <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">
                    <!--end: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="artist_details" novalidate>
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u">@lang('words.personal_information')
                                                    </h6>
                                                </div>
                                            </div>
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#accordionExample5">
                                                <div class="card-body">
                                                    <input type="hidden" id="artist_id"
                                                        value="{{$artist_details->artist_id}}" />
                                                    <input type="hidden" id="is_old_artist" />
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <section class="kt-form--label-right">
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="artist_number"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.person_code')</label>
                                                                    <input type="hidden" id="artist_number" value={{1}}>
                                                                    <div class="col-lg-5">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="code" id="code"
                                                                                placeholder="@lang('words.person_code')">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <span id="changeArtistLabel"
                                                                            class="kt-badge  kt-badge--danger kt-badge--inline d-none"
                                                                            onclick="removeSelectedArtist()">@lang('words.change')
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_en"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.first_name')<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="fname_en" id="fname_en"
                                                                                placeholder="@lang('words.first_name')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_en"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.last_name')<span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="lname_en" id="lname_en"
                                                                                placeholder="@lang('words.last_name')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="nationality"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.nationality')
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="form-control form-control-sm "
                                                                                name="nationality" id="nationality">
                                                                                {{--   - class for search in select  --}}
                                                                                <option value="">@lang('words.select')
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.birth_date')<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                placeholder="DD-MM-YYYY"
                                                                                data-date-end-date="0d" name="dob"
                                                                                id="dob" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="profession"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.passport_number')span
                                                                        class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="passport" id="passport"
                                                                                placeholder="@lang('words.passport_number')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="pp_expiry"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.passport_expiry')<span
                                                                            class="text-danger">*</span>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.uid_number')
                                                                        <span class="text-danger">*</span> </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="uid_number" id="uid_number"
                                                                                placeholder="@lang('words.uid_number')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="dob"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.uid_expiry')<span
                                                                            class="text-danger">*</span>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.religion')
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="religion" id="religion">
                                                                                <option value="">@lang('words.religion')
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
                                                                <input type="hidden" id="artist_permit_num">
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="profession"
                                                                        class="col-4 col-form-label kt-font-bold text-right">
                                                                        @lang('words.profession') <span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="form-control form-control-sm "
                                                                                name="profession" id="profession"
                                                                                disabled>
                                                                                <option value="">@lang('words.select')
                                                                                </option>
                                                                                @foreach ($profession as $pt)
                                                                                <option value="{{$pt->profession_id}}" <?php
                                                                                    if($pt->profession_id == $artist_details->profession_id){
                                                                                        echo 'selected';
                                                                                    }
                                                                                    ?>>
                                                                                    {{ucwords($language_id == 1 ? $pt->name_en : $pt->name_ar)}}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                            <input type="hidden" id="old_profession"
                                                                                value="{{$artist_details->profession_id}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_ar"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.first_name_ar')<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm text-right "
                                                                                name="fname_ar" id="fname_ar"
                                                                                placeholder="@lang('words.first_name_ar')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="lname_ar"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.last_name_ar')<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm text-right "
                                                                                name="lname_ar" id="lname_ar"
                                                                                placeholder="@lang('words.last_name_ar')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="gender"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.gender')
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="gender" id="gender">
                                                                                <option value="">@lang('words.select')
                                                                                </option>
                                                                                <option value="1">
                                                                                    {{$language_id == 1 ? 'Male' : 'الذكر'}}
                                                                                </option>
                                                                                <option value="2">
                                                                                    {{ $language_id == 1 ? 'Female' : 'أنثى ' }}
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="visa_type"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Visa
                                                                        Type <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="visa_type" id="visa_type">
                                                                                <option value="">Select</option>
                                                                                @foreach ($visatypes as $vt)
                                                                                <option value={{$vt->id}}>
                                                                                    {{ $language_id == 1 ?  $vt->visa_type_en : $vt->visa_type_ar}}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="visa_number"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Visa
                                                                        Number <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="visa_number" id="visa_number"
                                                                                placeholder="Visa Number">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="visa_number"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Visa
                                                                        Expire Date <span class="text-danger">*</span>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Identification
                                                                        No </label>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Sponser
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Languages
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="language" id="language">
                                                                                <option value="">@lang('words.select')
                                                                                </option>
                                                                                @foreach ($languages as $lang)
                                                                                <option value={{$lang->id}}>
                                                                                    {{ $language_id == 1 ?   $lang->name_en : $lang->name_ar }}
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
                                                    <h6 class="kt-font-transform-u">@lang('words.contact_information')
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.mobile_number')<span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="mobile" id="mobile"
                                                                                placeholder="@lang('words.mobile_number')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="landline"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.phone_number')
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="landline" id="landline"
                                                                                placeholder="@lang('words.phone_number')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div class="col-6">
                                                            <section class="kt-form--label-right">
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="email"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.email_address')
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                placeholder="@lang('words.email_address')"
                                                                                name="email" id="email" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fax_no"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.fax_number')</label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="fax_no" id="fax_no"
                                                                                placeholder="@lang('words.fax_number')">
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
                                                    <h6 class="kt-font-transform-u">@lang('words.address_information')
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Address
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="address" id="address"
                                                                                placeholder="Address">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" form-group form-group-sm row">
                                                                    <label for="address"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.emirate')
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="city" id="city"
                                                                                onChange="getAreas(this.value)">
                                                                                <option value="">@lang('words.select')
                                                                                </option>
                                                                                @foreach ($emirates as $em)
                                                                                <option value={{$em->id}}>
                                                                                    {{$em->name_en}}
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.po_box')</label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="po_box" id="po_box"
                                                                                placeholder="@lang('words.po_box')">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="address"
                                                                        class="col-4 col-form-label kt-font-bold text-right">@lang('words.area')
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="  form-control form-control-sm "
                                                                                name="area" id="area">
                                                                                <option value="">@lang('words.select')
                                                                                </option>
                                                                                @foreach ($areas as $ar)
                                                                                <option value={{$ar->id}}>
                                                                                    {{$ar->area_en}}
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
                    <!--begin: Form Wizard Step 3-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <form id="documents_required" method="post">
                                    <input type="hidden" id="artist_number_doc" value={{1}}>
                                    <input type="hidden" id="requirements_count" value={{count($requirements)}}>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <label class="kt-font-bold text--maroon"> Artist Photo</label>
                                                <p for="" class="reqName " title="Artist Photo">
                                                    Use Passport size picture with white background</p>
                                            </div>
                                            <div class="col-lg-4 col-sm-12">
                                                <label style="visibility:hidden">hidden</label>
                                                <div id="pic_uploader">Upload
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="issue_date" value="{{$artist_details->issue_date}}">
                                        <input type="hidden" id="expiry_date" value="{{$artist_details->expiry_date}}">
                                        @php
                                        $i = 1;
                                        $issued_date = strtotime($artist_details->issue_date);
                                        $expired_date = strtotime($artist_details->expiry_date);
                                        $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                                        @endphp
                                        @foreach ($requirements as $req)
                                        @if($req->term == 'long' && $diff > 30 || $req->term == 'short' )
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <label
                                                    class="kt-font-bold text--maroon">{{$language_id == 1 ? $req->requirement_name : $req->requirement_name_ar}}</label>
                                                <p for="" class="reqName    ">
                                                    {{$req->requirement_description}}</p>
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
                                            @if($req->dates_required == 1)
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue
                                                    Date</label>
                                                <input type="text" class="form-control form-control-sm date-picker"
                                                    name="doc_issue_date_{{$i}}" data-date-end-date="0d"
                                                    id="doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" <?php
                                                    if($req->validity != null || $req->validity != 0) {
                                                ?> onchange="set_document_expiry({{$req->validity}}, {{$i}})"
                                                    <?php } ?> />
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="" class="text--maroon kt-font-bold"
                                                    title="Expiry Date">Expiry
                                                    Date</label>
                                                <input type="text"
                                                    class="form-control form-control-sm date-picker {{($req->validity != null || $req->validity != 0) ? 'mk-disabled' : ''}}"
                                                    name="doc_exp_date_{{$i}}" data-date-start-date="+0d"
                                                    id="doc_exp_date_{{$i}}" placeholder="DD-MM-YYYY" />
                                            </div>
                                            @endif
                                        </div>
                                        @php
                                        $i++;
                                        @endphp
                                        @endif
                                        @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-form__actions">
                    <div class="btn btn-label-maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                        data-ktwizard-type="action-prev" id="prev_btn">
                        Previous
                    </div>
                    <input type="hidden" id="artist_permit_id" value="{{$permit_details->artist_permit_id}}">
                    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">
                    <a href="{{url('company/artist/permit/'.$permit_details->permit_id .'/amend')}}">
                        <div class="btn btn-label-yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            id="back_btn">
                            Back
                        </div>
                    </a>
                    <div class="btn btn-label-yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn"
                        style="display:none;">
                        <i class="la la-check"></i>
                        Submit
                    </div>
                    <div class="btn btn-label-maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
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
</div>
<!-- end:: Content -->
<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->
<!--begin::Modal-->
<div class="modal fade" id="artist_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Person Code Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearPersonCode()">
                </button>
            </div>
            <div class="modal-body" id="person_code_modal">
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="alert_profession" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>please select a artist with <span class="text--maroon">SAME PROFESSION</span> ! </p>
                <button class="btn btn--yellow btn-wide kt-font-transform-u float-right"
                    data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script>
    var fileUploadFns = [];
    var picUploader ;
    var artistDetails = new Object();
    var documentDetails = new Object();
    $(document).ready(function()
    {
        localStorage.clear();
        setWizard();
        uploadFunction();
        PicUploadFunction();
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url:"{{route('clear_the_temp')}}"
        });
        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(2);
        $('#back_btn').css('display', 'none');
        // fetchFromDrafts();
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
                returnType: "json",
                showFileCounter: false,
                abortStr: '',
                multiple: false,
                maxFileCount:1,
                showDelete: true,
                showDownload: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: i, reqName: $('#req_name_'+i).val() , reqId: $('#req_id_'+i).val()},
                onLoad:function(obj)
                {
                    $code = $('#code').val();
                    if($code){
                        $.ajaxSetup({
                        headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            cache: false,
                            url: "{{route('company.get_files_uploaded')}}",
                            type: 'POST',
                            data: {artist_permit: $('#artist_permit_num').val(), reqName: $('#req_name_'+i).val()},
                            dataType: "json",
                            success: function(data)
                            {
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
                    }
                },
                onError: function(files, status, errMsg, pd) {
                    showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                    pd.statusbar.hide();
                },
                downloadCallback:function(files,pd)
                {
                    if(files[0]) {
                        let user_id = $('#user_id').val();
                        let artistId = $('#artist_id').val();
                        let this_url = user_id + '/artist/' + artistId +'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
                    } else {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    }
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
                previewHeight: '200px',
                previewWidth: "auto",
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                abortStr: '',
                returnType: "json",
                maxFileCount:1,
                showPreview:true,
                showDelete: true,
                showDownload: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                onLoad:function(obj)
                {
                    $code = $('#code').val();
                    if($code){
                        $.ajaxSetup({
                            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            url: "{{url('company/get_files_uploaded_with_code')}}"+'/'+$code,
                            success: function(data)
                            {
                                if(data[0].artist_permit[0].original)
                                {
                                    obj.createProgress('Profile Pic',"{{url('storage')}}"+'/'+data[0].artist_permit[0].original,'');
                                }
                            }
                        });
                    }
                },
                onError: function (files, status, errMsg, pd) {
                    showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                    pd.statusbar.hide();
                }
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
    }

    var detailsValidator =  $('#artist_details').validate({
            ignore: [],
            rules: {
                fname_en: 'required',
                fname_ar: 'required',
                lname_en: 'required',
                lname_ar: 'required',
                permit_type: 'requried',
                profession: 'required',
                dob: {
                    required: true,
                    dateNL: true
                },
                uid_number: 'required',
                uid_expiry: {
                    required: true,
                    dateNL: true
                },
                passport: 'required',
                pp_expiry: {
                    required: true,
                    dateNL: true
                },
                visa_type: 'required',
                visa_number: 'required',
                visa_expiry: {
                    required: true,
                    dateNL: true
                },
                gender: 'required',
                sp_name: 'required',
                nationality: 'required',
                address: 'required',
                mobile: {
                    required : true
                } ,
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                fname_en: '',
                fname_ar: '',
                lname_en: '',
                lname_ar: '',
                profession: '',
                dob: '',
                uid_number: '',
                uid_expiry: '',
                permit_type: '',
                passport: '',
                pp_expiry: '',
                visa_type: '',
                visa_number: '',
                visa_expiry: '',
                sp_name: '',
                gender: '',
                nationality: '',
                address: '',
                mobile: {
                    // number: 'Please enter number',
                    required: ''
                },
                email: {
                    required: '',
                    email: '',
                },
            },
        });
        var docRules = {};
        var docMessages = {};
        for(var i = 1; i < $('#requirements_count').val(); i++)
        {
            docRules['doc_issue_date_'+i] = 'required';
            docRules['doc_exp_date_'+i] = 'required';
            docMessages['doc_issue_date_'+i] = 'This field is required';
            docMessages['doc_exp_date_'+i] = 'This field is required';
        }
        var documentsValidator = $('#documents_required').validate({
            rules: docRules,
            messages: docMessages
        });
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
                    // object of array storing the artist details
                    var artist_id = $('#artist_number').val() ;
                    if(detailsValidator.form())
                    {
                        $('#submit_btn').css('display', 'block'); // display the submit button
                        $('#next_btn').css('display', 'none'); // hide the next button
                        $('#addNew_btn').css('display', 'block'); // display the add new artist button
                        artistDetails = {
                            id: $('#artist_id').val(),
                            code: $('#code').val(),
                            fname_en: $('#fname_en').val(),
                            fname_ar:  $('#fname_ar').val(),
                            lname_en: $('#lname_en').val(),
                            lname_ar:  $('#lname_ar').val(),
                            nationality: $('#nationality').val(),
                            permit_type: $('#permit_type').val(),
                            profession: $('#profession').val(),
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
                            fax_number: $('#fax_no').val(),
                            po_box: $('#po_box').val(),
                            uidNumber: $('#uid_number').val(),
                            uidExp: $('#uid_expiry').val(),
                            dob: $('#dob').val(),
                            landline: $('#landline').val(),
                            mobile: $('#mobile').val(),
                            email: $('#email').val(),
                            is_old_artist: $('#is_old_artist').val()
                        }
                        localStorage.setItem('artistDetails', JSON.stringify(artistDetails));
                        // insertIntoDrafts(3, JSON.stringify(artistDetails));
                    }
                }
        });
        $('#prev_btn').click(function(){
            if(wizard.currentStep == 2){
                    $('#prev_btn').css('display', 'none');
                    $('#back_btn').css('display', 'block');
            } else{
                    $('#prev_btn').css('display', 'block');
                    $('#next_btn').css('display', 'block');
            }
            $('#submit_btn').css('display', 'none');
            $('#addNew_btn').css('display', 'none');
        });
        const docValidation = () => {
            var artist_number = $('#artist_number').val();
            var hasFile = true;
            var hasFileArray = [];
            documentDetails = {};
            for(var i = 1; i <= $('#requirements_count').val(); i++)
            {
                if ($('#ajax-file-upload_' + i).length) {
                    if($('#ajax-file-upload_'+i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_"+i).css('border', '2px dotted red');
                    }
                    else{
                        hasFileArray[i] = true;
                        $("#ajax-upload_"+i).css('border', '2px dotted #A5A5C7');
                    }
                    documentDetails[i] = {
                        issue_date :   $('#doc_issue_date_'+i).val(),
                        exp_date : $('#doc_exp_date_'+i).val()
                    }
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
        const isExpiry = (num) => {
            let val = $('#doc_type_'+num).val();
            if((val == 'photograph') || (val == 'medical') ){
                $('#doc_exp_date_'+num).css('display', 'none');
                $('#doc_issue_date_'+num).css('display', 'none');
                $('#doc_exp_date_'+num).removeAttr( "required" );
                $('#doc_issue_date_'+num).removeAttr( "required" );
            } else {
                $('#doc_exp_date_'+num).css('display', 'block');
                $('#doc_issue_date_'+num).css('display', 'block');
                $('#doc_exp_date_'+num).prop('required',true);
                $('#doc_issue_date_'+num).prop('required',true);
            }
        }
        $('.date-picker').datepicker({ format: 'dd-mm-yyyy', autoclose: true});

        $('#dob').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true, startView: 2, endDate:'-10Y'});

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
        function searchCode(){
            let code = $('#code').val();
            var permit_id = $('#permit_id').val();
            if(code){
                $.ajax({
                    url:"{{route('company.searchCode')}}",
                    type: 'POST',
                    data: {
                        code: code,
                        permit_id: permit_id
                    },
                    success: function(data){
                        $('#artist_exists').modal({
                                backdrop: 'static',
                                keyboard: false,
                                show: true
                            });
                            $('#person_code_modal').empty();
                        if(data.artist_permit){
                            let total_aps = data.artist_permit.length;
                            let j = total_aps - 1 ;
                            if(total_aps > 0) {
                                $('#person_code_modal').append('<div class="kt-widget30__item d-flex justify-content-around"> <div class="kt-widget30__pic mr-2"> <img id="profImg" title="image"> </div> <div class="kt-widget30__info" id="PC_Popup_Table"> <table> <tr> <th>Name:</th> <td id="ex_artist_en_name"></td> </tr> <tr> <th>Name(Ar):</th> <td id="ex_artist_ar_name"></td> </tr> <tr> <th>DOB:</th> <td id="ex_artist_dob"></td> </tr> <tr> <th>Gender:</th> <td id="ex_artist_gender"></td> </tr> <tr> <th>Mobile:</th> <td id="ex_artist_mobilenumber"></td> </tr><tr> <th>Email:</th> <td id="ex_artist_email"></td> </tr> <tr> <th>Nationality:</th> <td id="ex_artist_nationality"></td> </tr> </table> </div> <input type="hidden" id="artistDetailswithcode"> </div> <div class="d-flex justify-content-center mt-4"> <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="setArtistDetails()"data-dismiss="modal">Select this Artist</button> <button class="btn btn--maroon btn-bold btn-sm" onclick="clearPersonCode()" data-dismiss="modal">Not this Artist</button> </div>');
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

                            $('#not_artist_personcode').text(code);
                        }
                    },error:function(){
                        alert("error!!!!");
                    }
                });
            }
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
        const setArtistDetails = () => {
            $('.ajax-file-upload-red').trigger('click');
            let ad = $('#artistDetailswithcode').val();
            var old_profession = $('#old_profession').val();
            ad = JSON.parse(ad);
            var artist_permit_count = ad.artist_permit.length;
            var i = artist_permit_count - 1 ;
            let apd = ad.artist_permit[i] ;
            if(old_profession != apd.profession){
                $('#code').val('');
                $('#alert_profession').modal('show');
                return ;
            }
            $('#artist_exists').modal('hide');
            $('#is_old_artist').val(2);
            var dob = moment(apd.birthdate, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('#changeArtistLabel').removeClass('d-none');
            $('#changeArtistLabel').addClass('ml-2');
            $('#artist_id').val(ad.artist_id);
            $('#code').val(ad.person_code);$('#code').addClass('mk-disabled');
            $('#fname_en').val(apd.firstname_en);$('#fname_en').addClass('mk-disabled');
            $('#fname_ar').val(apd.firstname_ar);$('#fname_ar').addClass('mk-disabled');
            $('#lname_en').val(apd.lastname_en);$('#lname_en').addClass('mk-disabled');
            $('#lname_ar').val(apd.lastname_ar);$('#lname_ar').addClass('mk-disabled');
            $('#nationality').val(apd.country_id);
            var ppExp = moment(apd.passport_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('#pp_expiry').val(ppExp);
            var visaExp = moment(apd.visa_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('#visa_expiry').val(visaExp);
            var uidExp = moment(apd.uid_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY');
            $('#uid_expiry').val(uidExp);
            $('#permit_type').val(apd.permit_type_id),
            $('#profession').val(apd.profession),
            $('#passport').val(apd.passport_number),
            $('#visa_type').val(apd.visa_type),
            $('#visa_number').val(apd.visa_number),
            $('#sp_name').val(apd.sponsor_name_en),
            $('#id_no').val(apd.emirates_id),
            $('#language').val(apd.language),
            $('#religion').val(apd.religion),
            $('#gender').val(apd.gender),
            $('#city').val(apd.city);
            getAreas(apd.city);
            $('#address').val(apd.address_en),
            $('#uid_number').val(apd.uid_number),
            $('#dob').val(dob),
            $('#landline').val(apd.phone_number),
            $('#po_box').val(apd.po_box),
            $('#fax_no').val(apd.fax_number),
            $('#mobile').val(apd.mobile_number),
            $('#email').val(apd.email);
            $('#artist_permit_id').val(apd.artist_permit_id);
            $('#area').val(apd.area);
            PicUploadFunction();
            uploadFunction();
        }
        $('#submit_btn').click((e) => {
            $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
            var hasFile = docValidation();
            if(documentsValidator.form() && hasFile){
            var artist_permit_id = $('#artist_permit_id').val();
            var permit_id = $('#permit_id').val();
            var ad = localStorage.getItem('artistDetails');
            var dd = localStorage.getItem('documentDetails');
            var issue_d = $('#issue_date').val();
            var expiry_d = $('#expiry_date').val();
            let fromPage= 'amend';
            $.ajaxSetup({
                headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
            });
            $.ajax({
                    url:"{{route('company.update_artist_temp')}}",
                    type: "POST",
                    // processData:false,
                    // data: { permitDetails: pd},
                    data: {
                        permitId: permit_id,
                        artistD: ad ,
                        documentD: dd,
                        issue_d: issue_d,
                        expiry_d: expiry_d,
                        temp_id: $('#temp_id').val(),
                        from: fromPage
                    },
                    success: function(result){
                        // console.log(result)
                        if(result.message[0] == 'success')
                        {
                            localStorage.clear();
                            let toUrl= "{{route('artist.permit',[ 'id' => ':id' , 'from' => 'amend'])}}";;
                            toUrl = toUrl.replace(':id', permit_id);
                            window.location.href= toUrl ;
                        }
                    }
                });
            }
        })
</script>
@endsection
