@extends('layouts.app')

@section('title', 'Add Artist - Smart Government Rak')

@section('content')

<link href="{{ asset('/css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->all())}} --}}
<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
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
                                    <span>03</span> Upload Documents
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
                            <div class="kt-wizard-v3__form">
                                <!--begin::Accordion-->
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">

                                    <div class="card">
                                        <div class="card-header" id="headingTwo6">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseTwo6"
                                                aria-expanded="false" aria-controls="collapseTwo6">
                                                <h6 class="kt-font-transform-u"> Documents Required</h6>
                                            </div>
                                        </div>
                                        <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">

                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Document</th>
                                                        <th>Description</th>
                                                    </tr>
                                                    @foreach($requirements as $req)
                                                    <tr>
                                                        <td>{{$req->requirement_name}}</td>
                                                        <td>{{$req->requirement_description}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseThree6" aria-expanded="false"
                                                aria-controls="collapseThree6">
                                                <h6 class="kt-font-transform-u"> Permit Fees Structure</h6>
                                            </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Profession</th>
                                                        <th>Fee</th>
                                                    </tr>
                                                    @foreach($profession as $pt)
                                                    <tr>
                                                        <td>{{$pt->name_en}}</td>
                                                        <td>{{$pt->amount}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseFour6" aria-expanded="false"
                                                aria-controls="collapseFour6">
                                                <h6 class="kt-font-transform-u">Rules and Conditions</h6>
                                            </div>
                                        </div>
                                        <div id="collapseFour6" class="collapse" aria-labelledby="headingFour6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

                                            </div>
                                        </div>
                                    </div>
                                    <label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
                                        <input type="checkbox" id="agree" name="agree"> I Read and understand all
                                        service rules, And agree to continue submitting it.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                    $user_id = Auth::user()->user_id;
                    @endphp
                    <!--end: Form Wizard Step 1-->

                    <input type="hidden" id="from_date" value="{{session($user_id.'_apn_from_date')}}">
                    <input type="hidden" id="to_date" value="{{session($user_id.'_apn_to_date')}}">
                    <input type="hidden" id="location" value="{{session($user_id.'_apn_location')}}">
                    <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">


                    {{-- Artist details wizard Start --}}
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
                                                    <h6 class="kt-font-transform-u">Personal
                                                        information</h6>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Person
                                                                        Code</label>
                                                                    <input type="hidden" id="artist_number" value={{1}}>
                                                                    <div class="col-lg-5">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                name="code" id="code"
                                                                                placeholder="Person Code">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <span id="changeArtistLabel"
                                                                            class="kt-badge  kt-badge--danger kt-badge--inline d-none"
                                                                            onclick="removeSelectedArtist()">Change
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_en"
                                                                        class="col-4 col-form-label kt-font-bold text-right">First
                                                                        Name <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="fname_en" id="fname_en"
                                                                                placeholder="First Name">
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_en"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Last
                                                                        Name <span class="text-danger">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="lname_en" id="lname_en"
                                                                                placeholder="Last Name">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-group-sm row">
                                                                    <label for="nationality"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Nationality
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="form-control form-control-sm "
                                                                                name="nationality" id="nationality">
                                                                                {{--   - class for search in select  --}}
                                                                                <option value="">Select</option>
                                                                                @foreach ($countries as $ct)
                                                                                <option value="{{$ct->country_id}}">
                                                                                    {{$ct->nationality_en}}
                                                                                </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-group-sm row">
                                                                    <label for="dob"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Birth
                                                                        Date <span class="text-danger">*</span>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Passport
                                                                        No<span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="passport" id="passport"
                                                                                placeholder="Passport Number">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-group-sm row">
                                                                    <label for="pp_expiry"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Passport
                                                                        Expiry <span class="text-danger">*</span>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">UID
                                                                        <span class="text-danger">*</span> </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="uid_number" id="uid_number"
                                                                                placeholder="UID Number">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group form-group-sm row">
                                                                    <label for="dob"
                                                                        class="col-4 col-form-label kt-font-bold text-right">UID
                                                                        Expire Date <span class="text-danger">*</span>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Religion
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="religion" id="religion">
                                                                                <option value="">Select</option>
                                                                                @foreach ($religions as $reli)
                                                                                <option value={{$reli->id}}>
                                                                                    {{$reli->name_en}}
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
                                                                        Profession <span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="form-control form-control-sm "
                                                                                name="profession" id="profession"
                                                                                placeholder="Profession">
                                                                                <option value="">Select</option>
                                                                                @foreach ($profession as $pt)
                                                                                <option value="{{$pt->profession_id}}">
                                                                                    {{ucwords($pt->name_en)}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fname_ar"
                                                                        class="col-4 col-form-label kt-font-bold text-right">First
                                                                        Name - Ar <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                dir="rtl" name="fname_ar" id="fname_ar"
                                                                                placeholder="First Name in Arabic">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="lname_ar"
                                                                        class="col-4 col-form-label kt-font-bold text-right ">Last
                                                                        Name - Ar <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm"
                                                                                dir="rtl" name="lname_ar" id="lname_ar"
                                                                                class="form-control form-control-sm text-right "
                                                                                name="lname_ar" id="lname_ar"
                                                                                placeholder="Last Name in Arabic">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="gender"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Gender
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="gender" id="gender">
                                                                                <option value="">Select</option>
                                                                                <option value="1">Male</option>
                                                                                <option value="2">Female</option>
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
                                                                                    {{$vt->visa_type_en}}
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
                                                                                <option value="">Select</option>
                                                                                @foreach ($languages as $lang)
                                                                                <option value={{$lang->id}}>
                                                                                    {{$lang->name_en}}
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
                                                    <h6 class="kt-font-transform-u">Contact
                                                        information
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Mobile
                                                                        No <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="mobile" id="mobile"
                                                                                placeholder="Mobile No.">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group form-group-sm row">
                                                                    <label for="landline"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Phone
                                                                        No
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="landline" id="landline"
                                                                                placeholder="Landline No.">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                            </section>
                                                        </div>
                                                        <div class="col-6">
                                                            <section class="kt-form--label-right">
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="email"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Email
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                placeholder="Email" name="email"
                                                                                id="email" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-group-sm row">
                                                                    <label for="fax_no"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Fax
                                                                        No </label>
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
                                                    <h6 class="kt-font-transform-u">Address
                                                        information
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">Emirate
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class=" form-control form-control-sm "
                                                                                name="city" id="city"
                                                                                onChange="getAreas(this.value)">
                                                                                <option value="">Select</option>
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
                                                                        class="col-4 col-form-label kt-font-bold text-right">PO
                                                                        Box </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <input type="text"
                                                                                class="form-control form-control-sm "
                                                                                name="po_box" id="po_box"
                                                                                placeholder="PO box">


                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group form-group-sm row">
                                                                    <label for="address"
                                                                        class="col-4 col-form-label kt-font-bold text-right">Area
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <div class="input-group input-group-sm">
                                                                            <select
                                                                                class="  form-control form-control-sm "
                                                                                name="area" id="area">
                                                                                <option value="">Select</option>
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

                    <!--end: Form Wizard Step 3-->

                    {{-- <div class="kt-spinner kt-spinner--lg kt-spinner--dark" style="display:none"></div> --}}

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
                                        @php
                                        $i = 1;
                                        $issued_date = strtotime(date('Y-m-d',
                                        strtotime(session($user_id.'_apn_from_date'))));
                                        $expired_date = strtotime(date('Y-m-d',
                                        strtotime(session($user_id.'_apn_to_date'))));
                                        $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);
                                        @endphp
                                        @foreach ($requirements as $req)
                                        @if($req->term == 'long' && $diff > 30 || $req->term == 'short' )
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <label
                                                    class="kt-font-bold text--maroon">{{$req->requirement_name}}</label>
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
                    <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                        data-ktwizard-type="action-prev" id="prev_btn">
                        Previous
                    </div>

                    <input type="hidden" id="permit_id" value="{{$permit_id}}">

                    <a href="{{url('company/add_new_permit/'.$permit_id)}}">
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                            Back
                        </div>
                    </a>
                    {{--
                    class="btn red mt-ladda-btn ladda-button mt-progress-demo" --}}


                    <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                        data-ktwizard-type="action-submit" id="submit_btn">Add
                        Artist</a>
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

<div class="modal fade" id="artist_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
<script src="{{ asset('js/company/artist.js') }}"></script>
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script>
    $.ajaxSetup({
            headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
        });


    var fileUploadFns = [];
    var picUploader;
    var artistDetails = {};
    var documentDetails = {};


    $(document).ready(function () {
        localStorage.clear();
        setWizard();
        uploadFunction();
        PicUploadFunction();

        wizard = new KTWizard("kt_wizard_v3", {
            startStep: 1
        });

        wizard.on("change", function(wizard) {
            KTUtil.scrollTop();
        });

    });

    $('#agree').on('click', function(){
        if($(this).is(':checked')) {
            $('#agree_cb > span').removeClass('compulsory');
        }
    });



        const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    url: "{{route('company.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "doc_file_" + i,
                    // showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    returnType: "json",
                    showFileCounter: false,
                    abortStr: '',
                    multiple: false,
                    maxFileCount: 1,
                    showDownload: true,
                    showDelete: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
                    onLoad: function (obj) {
                        $code = $('#code').val();
                        if ($code) {
                            $.ajax({
                                cache: false,
                                url: "{{route('company.get_files_uploaded')}}",
                                type: 'POST',
                                data: {artist_permit: $('#artist_permit_num').val(), reqId: $('#req_id_' + i).val()},
                                dataType: "json",
                                success: function (data) {
                                    if (data) {
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let issue_datetime = new Date(data['issued_date']);
                                        let exp_datetime = new Date(data['expired_date']);
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');

                                        obj.createProgress(data.requirement['requirement_name'], "{{url('storage')}}"+'/' + data.path, '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                    }
                                }
                            });
                        }else{
                            var loadUrl = "{{route('company.resetUploadsSession', ':id')}}";
                            loadUrl = loadUrl.replace(':id', $('#req_id_' + i).val());
                            $.ajax({
                                url: loadUrl,
                                success: function(data)
                                {
                                }
                            });
                        }

                    },
                    onError: function (files, status, errMsg, pd) {
                        showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                        pd.statusbar.hide();
                    },
                    downloadCallback: function (files, pd) {
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
                $('#fileuploader_' + i + ' div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
            }
        };


        const PicUploadFunction = () => {
            picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('company.uploadPhoto')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                abortStr: '',
                previewHeight: '200px',
                previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                onLoad: function (obj) {
                    // console.log(obj);
                    $code = $('#code').val();
                    if ($code) {
                        $.ajax({
                            url: "get_uploaded_artist_photo/" + $code,
                            success: function (data) {
                                if (data[0].artist_permit[0].original) {
                                    obj.createProgress('Profile Pic', "{{url('storage')}}"+'/'+ data[0].artist_permit[0].original, '');
                                }
                            }
                        });
                    }

                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
        };


        var detailsValidator = $('#artist_details').validate({
            ignore: [],
            rules: {
                fname_en: 'required',
                fname_ar: 'required',
                lname_en: 'required',
                lname_ar: 'required',
                profession: 'required',
                permit_type: 'required',
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
                sp_name: 'required',
                gender: 'required',
                nationality: 'required',
                address: 'required',
                mobile: {
                    // number: true,
                    required: true
                },
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

        for (var i = 1; i <= $('#requirements_count').val(); i++) {
            docRules['doc_issue_date_' + i] = 'required';
            docRules['doc_exp_date_' + i] = 'required';
            docMessages['doc_issue_date_' + i] = '';
            docMessages['doc_exp_date_' + i] = '';
        }

        var documentsValidator = $('#documents_required').validate({
            rules: docRules,
            messages: docMessages
        });

        $("#check_inst").on("click", function () {
            console.log(stopNext(detailsValidator));
            setThis('none', 'block', 'block', 'none');
        });

        $("#artist_det").on("click", function () {
            !checkForTick() ? wizard.stop() : wizard.goTo(2) ;
            wizard.currentStep == 2 ? setThis('block', 'block', 'none', 'none') : '';
            wizard.isFirstStep() ? setThis('none', 'block', 'block', 'none') : '';
        });

        $("#upload_doc").on("click", function () {
            wizard.isFirstStep() ? !checkForTick() ? setThis('none', 'block', 'block', 'none') : '' : !(detailsValidator.form()) ? wizard.stop() : wizard.goTo(3) ;
            wizard.isFirstStep() ? !(detailsValidator.form()) ? wizard.stop() : '' : '';
            wizard.currentStep == 3 ? setThis('block', 'none', 'none', 'block') : '';
            wizard.isFirstStep() ? setThis('none', 'block', 'block', 'none') : '';
        });

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
        };

        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result ;
            if ($('#agree').is(':checked')) {
                $('#back_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                $('#agree_cb > span').removeClass('compulsory');
                // wizard.goNext();
                result = true;
            }else {
                wizard.stop();
                $('#agree_cb > span').addClass('compulsory');
                result = false;
            }
            return result;
        }


        $('#next_btn').click(function (e) {

            wizard = new KTWizard("kt_wizard_v3");

            if (wizard.currentStep == 1) {
                if ($('#agree').is(':checked')) {
                    $('#back_btn').css('display', 'none');
                    $('#prev_btn').css('display', 'block');
                    $('#agree_cb > span').removeClass('compulsory');
                }else {
                    wizard.stop();
                    $('#agree_cb > span').addClass('compulsory');
                }
                return;
            }

            // checking the next page is artist details
            if (wizard.currentStep == 2) {
                stopNext(detailsValidator);
                KTUtil.scrollTop();// validating the artist details page
                // object of array storing the artist details
                var artist_id = $('#artist_number').val();
                if (detailsValidator.form()) {
                    $('#submit_btn').css('display', 'block'); // display the submit button
                    $('#next_btn').css('display', 'none'); // hide the next button
                    artistDetails = {
                        id: $('#artist_id').val(),
                        ap_id: $('#artist_permit_num').val(),
                        code: $('#code').val(),
                        fname_en: $('#fname_en').val(),
                        fname_ar: $('#fname_ar').val(),
                        lname_en: $('#lname_en').val(),
                        lname_ar: $('#lname_ar').val(),
                        nationality: $('#nationality').val(),
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
                        fax_no: $('#fax_no').val(),
                        po_box: $('#po_box').val(),
                        uidNumber: $('#uid_number').val(),
                        uidExp: $('#uid_expiry').val(),
                        dob: $('#dob').val(),
                        landline: $('#landline').val(),
                        mobile: $('#mobile').val(),
                        email: $('#email').val(),
                        is_old_artist: $('#is_old_artist').val()
                    };

                    localStorage.setItem('artistDetails', JSON.stringify(artistDetails));
                    // insertIntoDrafts(3, JSON.stringify(artistDetails));
                }
            }
        });


        const docValidation = () => {
            var artist_number = $('#artist_number').val();
            var hasFile = true;
            var hasFileArray = [];
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
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
            if ($('#pic-file-upload').contents().length == 0) {
                hasPicture = false;
                $('#pic-upload').css('border', '2px dotted red');
            } else {
                hasPicture = true;
                $("#pic-upload").css('border', '2px dotted #A5A5C7');
            }
            if (hasFileArray.includes(false) || hasPicture == false) {
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

        $('#prev_btn').click(function (e) {
            wizard = new KTWizard("kt_wizard_v3");
            // console.log(wizard.currentStep);
            // console.log(detailsValidator)
            // console.log(detailsValidator.resetForm())
            if (wizard.currentStep == 2) {
                // detailsValidator.resetForm();
                $('#prev_btn').css('display', 'none');
                $('#back_btn').css('display', 'block');
            } else {
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            }
            $('#submit_btn').css('display', 'none');
        });


        const isExpiry = (num) => {
            let val = $('#doc_type_' + num).val();
            if ((val == 'photograph') || (val == 'medical')) {
                $('#doc_exp_date_' + num).css('display', 'none');
                $('#doc_issue_date_' + num).css('display', 'none');
                $('#doc_exp_date_' + num).removeAttr("required");
                $('#doc_issue_date_' + num).removeAttr("required");
            } else {
                $('#doc_exp_date_' + num).css('display', 'block');
                $('#doc_issue_date_' + num).css('display', 'block');
                $('#doc_exp_date_' + num).prop('required', true);
                $('#doc_issue_date_' + num).prop('required', true);
            }
        };


        $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

        $('#dob').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true, startView: 2, endDate:'-10Y'});

        $('#dob').on('changeDate', function (ev) {
            $('#dob').valid() || $('#dob').removeClass('invalid').addClass('success');
        });
        $('#uid_expiry').on('changeDate', function (ev) {
            $('#uid_expiry').valid() || $('#uid_expiry').removeClass('invalid').addClass('success');
        });
        $('#pp_expiry').on('changeDate', function (ev) {
            $('#pp_expiry').valid() || $('#pp_expiry').removeClass('invalid').addClass('success');
        });
        $('#visa_expiry').on('changeDate', function (ev) {
            $('#visa_expiry').valid() || $('#visa_expiry').removeClass('invalid').addClass('success');
        });

        for (var h = 0; h < $('#requirements_count').val(); h++) {
            $('#doc_issue_date').on('changeDate', function (ev) {
                $('#doc_issue_date').valid() || $('#doc_issue_date').removeClass('invalid').addClass('success');
            });
            $('#doc_exp_date').on('changeDate', function (ev) {
                $('#doc_exp_date').valid() || $('#doc_exp_date').removeClass('invalid').addClass('success');
            });
        }


        const getAreas = (city_id) => {
            $.ajax({
                url: "{{url('company/fetch_areas')}}" + '/' + city_id,
                success: function (result) {
                    // console.log(result)
                    $('#area').empty();
                    $('#area').append('<option value=" ">Select</option>');
                    for (let i = 0; i < result.length; i++) {
                        $('#area').append('<option value="' + result[i].id + '">' + result[i].area_en + '</option>');
                    }

                }
            });

        };

        $('#code').change(function (e) {
            searchCode(e);
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

                    if(data.artist_permit) {
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
                            $('#not_artist_personcode').html(code);
                        }

                    },error:function(){

                        alert("error!!!!");

                    }
                });
            }
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

        function clearPersonCode() {
            $('#code').val('');
            $('#is_old_artist').val(1);
            $('#artist_exists').modal('hide');
        }

        const setArtistDetails = () => {
            $('.ajax-file-upload-red').trigger('click');
            let ad = $('#artistDetailswithcode').val();
            ad = JSON.parse(ad);
            let ap_count = ad.artist_permit.length;
            let i = ap_count - 1;
            let apd = ad.artist_permit[i];
            $('#is_old_artist').val(2);

            var dob = moment(ad.birthdate, 'YYYY-MM-DD').format('DD-MM-YYYY');

            $('#changeArtistLabel').removeClass('d-none');
            $('#changeArtistLabel').addClass('ml-2');
            $('#artist_id').val(ad.artist_id);
            $('#code').val(ad.person_code);
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
            $('#id_no').val(apd.emirates_id),
            $('#language').val(apd.language_id),
            $('#religion').val(apd.religion_id),
            $('#gender').val(ad.gender_id),
            $('#city').val(apd.emirates_id);
            getAreas(apd.emirates_id);
            $('#address').val(apd.address_en),
            $('#uid_number').val(apd.uid_number),
            $('#dob').val(dob).datepicker('update'),
            $('#landline').val(apd.phone_number),
            $('#po_box').val(apd.po_box),
            $('#fax_no').val(apd.fax_number),
            $('#mobile').val(apd.mobile_number),
            $('#email').val(apd.email);
            $('#artist_permit_num').val(apd.artist_permit_id);
            $('#area').val(apd.area_id);
            PicUploadFunction();
            uploadFunction();
            $('#artist_exists').modal('hide');
            // $('#artist_details').validate();
        }

        $('#submit_btn').click((e) => {

            $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

        var hasFile = docValidation();

            if (documentsValidator.form() && hasFile) {

                var pd = localStorage.getItem('permitDetails');
                var ad = localStorage.getItem('artistDetails');
                var dd = localStorage.getItem('documentDetails');
                // $('.kt-spinner').show();

                // $('#pleaseWaitDialog').modal('show');

                var from_date  = $('#from_date').val();
                var to_date = $('#to_date').val();
                var location = $('#location').val();

                var permit_id = $('#permit_id').val();

                var permitD = {
                    from : from_date,
                    to: to_date,
                    location: location
                }
                $.ajax({
                    url: "{{route('company.add_artist_temp')}}",
                    type: "POST",
                    data: {
                        artistD: ad,
                        documentD: dd,
                        permitD: permitD,
                        permit_id: permit_id
                    },
                    success: function (result) {
                        if(result.message[0]){
                            localStorage.clear();
                            window.location.href = "{{url('company/add_new_permit')}}"+'/'+ permit_id;
                        }
                        console.log(result);
                        // $('#pleaseWaitDialog').modal('hide');
                    }
                });
            }

        });


</script>

@endsection
