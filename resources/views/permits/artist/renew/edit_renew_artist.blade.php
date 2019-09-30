@extends('layouts.app')
@section('content')
<link href="{{asset('css/uploadfile.css')}}" rel="stylesheet">

<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
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

                <input type="hidden" id="artist_permit_id" value="{{$artist_details->artist_permit_id }}">
                <input type="hidden" id="temp_id" value="{{$artist_details->id}}">
                <input type="hidden" id="issue_date" value="{{$artist_details->issue_date}}">
                <input type="hidden" id="expiry_date" value="{{$artist_details->expiry_date}}">

                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                    <!--begin: Form Wizard Form-->
                    {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                    <div class="kt-form w-100 px-5" id="kt_form">
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                            data-ktwizard-state="current">
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <!--begin::Accordion-->
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">

                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title" data-toggle="collapse"
                                                    data-target="#collapseTwo6" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
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
                                            <input type="checkbox" id="agree" name="agree" checked> I Read and
                                            understand all
                                            service rules, And agree to continue submitting it.
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 1-->


                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <form id="artist_details">
                                        <div class="accordion accordion-solid accordion-toggle-plus"
                                            id="accordionExample5">
                                            <div class="card">
                                                <div class="card-header" id="headingOne6">
                                                    <div class="card-title collapsed" data-toggle="collapse"
                                                        data-target="#collapseOne6" aria-expanded="true"
                                                        aria-controls="collapseOne6">
                                                        <h6 class="kt-font-transform-u">Personal
                                                            information</h6>
                                                    </div>
                                                </div>
                                                <div id="collapseOne6" class="collapse show"
                                                    aria-labelledby="headingOne6" data-parent="#accordionExample5">
                                                    <div class="card-body">
                                                        <input type="hidden" id="artist_id"
                                                            value="{{$artist_details->artist_id}}" />
                                                        <input type="hidden" id="is_old_artist" />
                                                        <div class="row">
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="artist_number"
                                                                    class=" col-form-label kt-font-bold text-right">Person
                                                                    Code</label><span id="changeArtistLabel"
                                                                    class="kt-badge  kt-badge--danger kt-badge--inline d-none"
                                                                    onclick="removeSelectedArtist()">Change </span>
                                                                <input type="hidden" id="artist_number" value={{1}}>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="code" id="code" placeholder="Person Code"
                                                                    value="{{$artist_details->person_code}}">
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-xs">
                                                                <label for="fname_en"
                                                                    class=" col-form-label kt-font-bold text-right">First
                                                                    Name <small>( <span class="text-danger">required
                                                                        </span>)</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="fname_en" id="fname_en"
                                                                    placeholder="First Name"
                                                                    value="{{$artist_details->firstname_en  }}">
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="fname_en"
                                                                    class=" col-form-label kt-font-bold text-right">Last
                                                                    Name <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="lname_en" id="lname_en"
                                                                    placeholder="Last Name"
                                                                    value="{{$artist_details->lastname_en  }}">
                                                            </div>

                                                            <input type="hidden" id="artist_permit_num">
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="profession"
                                                                    class=" col-form-label kt-font-bold text-right">
                                                                    Profession <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <select class="form-control form-control-sm "
                                                                    name="profession" id="profession"
                                                                    placeholder="Profession">
                                                                    <option value="">Select</option>
                                                                    @foreach ($profession as $pt)
                                                                    <option value="{{$pt->profession_id}}"
                                                                        <?php if($pt->profession_id == $artist_details->profession_id){ echo 'selected' ;}?>>
                                                                        {{ucwords($pt->name_en)}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="fname_ar"
                                                                    class=" col-form-label kt-font-bold text-right">First
                                                                    Name - Ar <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm text-right "
                                                                    name="fname_ar" id="fname_ar"
                                                                    placeholder="First Name in Arabic"
                                                                    value="{{$artist_details->firstname_ar}}">
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="lname_ar"
                                                                    class=" col-form-label kt-font-bold text-right">Last
                                                                    Name - Ar <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm text-right "
                                                                    name="lname_ar" id="lname_ar"
                                                                    placeholder="Last Name in Arabic"
                                                                    value="{{$artist_details->lastname_ar}}">
                                                            </div>
                                                            {{-- {{dd($artist_details)}} --}}
                                                            <div
                                                                class="col-md-4 for                    m-group form-group-sm ">
                                                                <label for="nationality"
                                                                    class=" col-form-label kt-font-bold text-right">Nationality
                                                                    <small>( <span class="text-danger">required</span>
                                                                        )</small></label>
                                                                <select class="form-control form-control-sm "
                                                                    name="nationality" id="nationality">
                                                                    {{--   - class for search in select  --}}
                                                                    <option value="">Select</option>
                                                                    @foreach ($countries as $ct)
                                                                    <option value="{{$ct->country_id}}" <?php
                                                if($ct->country_id == $artist_details->nationality)
                                                { echo 'selected ' ;}
                                                                                     ?>>
                                                                        {{$ct->nationality_en}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="dob"
                                                                    class=" col-form-label kt-font-bold text-right">Birth
                                                                    Date <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    placeholder="DD-MM-YYYY" data-date-end-date="0d"
                                                                    name="dob" id="dob"
                                                                    value="{{date('d-m-Y', strtotime($artist_details->birthdate))}}" />
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="dob"
                                                                    class=" col-form-label kt-font-bold text-right">Gender
                                                                    <small>( <span class="text-danger">required</span>
                                                                        )</small></label>
                                                                <select class=" form-control form-control-sm "
                                                                    name="gender" id="gender">
                                                                    <option value="">Select</option>
                                                                    <option value="1"
                                                                        <?php if($artist_details->gender == 1) { echo 'selected' ; } ?>>
                                                                        Male</option>
                                                                    <option value="2"
                                                                        <?php if($artist_details->gender == 2) { echo 'selected' ; } ?>>
                                                                        Female</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="profession"
                                                                    class=" col-form-label kt-font-bold text-right">Passport
                                                                    No <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="passport" id="passport"
                                                                    placeholder="Passport Number"
                                                                    value="{{$artist_details->passport_number}}">
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="pp_expiry"
                                                                    class=" col-form-label kt-font-bold text-right">Passport
                                                                    Expire Date <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm date-picker "
                                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                                    name="pp_expiry" id="pp_expiry"
                                                                    value="{{date('d-m-Y', strtotime($artist_details->passport_expire_date))}}" />
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="id_no"
                                                                    class=" col-form-label kt-font-bold text-right">Identification
                                                                    No <small>( optional
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="id_no" id="id_no"
                                                                    placeholder="Identification No."
                                                                    value="{{$artist_details->emirates_id}}">
                                                            </div>


                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="visa_type"
                                                                    class=" col-form-label kt-font-bold text-right">Visa
                                                                    Type <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <select type="text"
                                                                    class="form-control form-control-sm "
                                                                    name="visa_type" id="visa_type">
                                                                    <option value="">Select</option>
                                                                    @foreach ($visatypes as $vt)
                                                                    <option value={{$vt->id}} <?php

                                                                            if($vt->id == $artist_details->visa_type){
                                                                                echo 'selected' ;
                                                                            }
                                                                            ?>>{{$vt->visa_type_en}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="visa_number"
                                                                    class=" col-form-label kt-font-bold text-right">Visa
                                                                    Number <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="visa_number" id="visa_number"
                                                                    placeholder="Visa Number"
                                                                    value="{{$artist_details->visa_number}}">
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="visa_number"
                                                                    class=" col-form-label kt-font-bold text-right">Visa
                                                                    Expire Date <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm date-picker "
                                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                                    name="visa_expiry" id="visa_expiry"
                                                                    value="{{date('d-m-Y', strtotime($artist_details->visa_expire_date))}}" />
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="uid_number"
                                                                    class=" col-form-label kt-font-bold text-right">UID
                                                                    <small>( <span class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="uid_number" id="uid_number"
                                                                    placeholder="UID Number"
                                                                    value="{{$artist_details->uid_number}}">
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="dob"
                                                                    class=" col-form-label kt-font-bold text-right">UID
                                                                    Expire Date <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm date-picker "
                                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                                    name="uid_expiry" id="uid_expiry"
                                                                    value="{{date('d-m-Y', strtotime($artist_details->uid_expire_date))}}" />
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="language"
                                                                    class=" col-form-label kt-font-bold text-right">Languages
                                                                    <small>( optional )</small></label>
                                                                <select class=" form-control form-control-sm "
                                                                    name="language" id="language">
                                                                    <option value="">Select</option>
                                                                    @foreach ($languages as $lang)
                                                                    <option value={{$lang->id}} <?php
                                                                            if($lang->id == $artist_details->language){
                                                                                echo 'selected';
                                                                            }
                                                                            ?>>{{$lang->name_en}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="sp_name"
                                                                    class=" col-form-label kt-font-bold text-right">Sponser
                                                                    Name <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="sp_name" id="sp_name"
                                                                    placeholder="Sponser Name"
                                                                    value="{{$artist_details->sponsor_name_en}}">
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="religion"
                                                                    class=" col-form-label kt-font-bold text-right">Religion
                                                                    <small>( optional )</small></label>
                                                                <select class=" form-control form-control-sm "
                                                                    name="religion" id="religion">
                                                                    <option value="">Select</option>
                                                                    @foreach ($religions as $reli)
                                                                    <option value={{$reli->id}} <?php
                                                                        if($reli->id == $artist_details->religion){
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>{{$reli->name_en}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>



                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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
                                                <div id="collapseTwo6" class="collapse show"
                                                    aria-labelledby="headingTwo6" data-parent="#accordionExample5">
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="mobile"
                                                                    class=" col-form-label kt-font-bold text-right">Mobile
                                                                    No <small>( <span
                                                                            class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="mobile" id="mobile" placeholder="Mobile No."
                                                                    value="{{$artist_details->mobile_number}}">
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="email"
                                                                    class=" col-form-label kt-font-bold text-right">Email
                                                                    <small>( <span class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    placeholder="Email" name="email" id="email"
                                                                    value="{{$artist_details->email}}" />
                                                            </div>


                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="address"
                                                                    class=" col-form-label kt-font-bold text-right">Address
                                                                    <small>( <span class="text-danger">required</span>
                                                                        )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="address" id="address" placeholder="Address"
                                                                    value="{{$artist_details->address_en}}">
                                                            </div>


                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="landline"
                                                                    class=" col-form-label kt-font-bold text-right">Phone
                                                                    No <small>( optional )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="landline" id="landline"
                                                                    placeholder="Landline No."
                                                                    value="{{$artist_details->phone_number}}">
                                                            </div>
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="fax_no"
                                                                    class=" col-form-label kt-font-bold text-right">Fax
                                                                    No <small>( optional )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="fax_no" id="fax_no" placeholder="Fax No"
                                                                    value="{{$artist_details->fax_number}}">
                                                            </div>

                                                            {{-- </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="card">
                                                        <div class="card-header" id="headingThree6">
                                                            <div class="card-title collapsed" data-toggle="collapse"
                                                                data-target="#collapseThree6" aria-expanded="false"
                                                                aria-controls="collapseThree6">
                                                                <h6 class="kt-font-transform-u">Address
                                                                    information</h6>
                                                            </div>
                                                        </div>
                                                        <div id="collapseThree6" class="collapse show"
                                                            aria-labelledby="headingThree6" data-parent="#accordionExample5">
                                                            <div class="card-body">
                                                                <div class="row"> --}}
                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="address"
                                                                    class=" col-form-label kt-font-bold text-right">Emirate
                                                                    <small>( optional )</small></label>
                                                                <select class=" form-control form-control-sm "
                                                                    name="city" id="city"
                                                                    onChange="getAreas(this.value)">
                                                                    <option value="">Select</option>
                                                                    @foreach ($emirates as $em)
                                                                    <option value={{$em->id}}>{{$em->name_en}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="address"
                                                                    class=" col-form-label kt-font-bold text-right">Area
                                                                    <small>( optional )</small></label>
                                                                <select class="  form-control form-control-sm "
                                                                    name="area" id="area">
                                                                    <option value="">Select</option>

                                                                </select>
                                                            </div>





                                                            <div class="col-md-4 form-group form-group-sm ">
                                                                <label for="email"
                                                                    class=" col-form-label kt-font-bold text-right">PO
                                                                    Box <small>( optional )</small></label>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="po_box" id="po_box" placeholder="PO box">
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
                                            @php
                                            $i = 1;
                                            $user_id = Auth::user()->user_id;
                                            $issued_date = strtotime($artist_details->issue_date);
                                            $expired_date = strtotime($artist_details->expiry_date);
                                            $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
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
                                                <input type="hidden" value="{{$req->requirement_id}}"
                                                    id="req_id_{{$i}}">
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
                                                    <label for="" class="text--maroon kt-font-bold"
                                                        title="Issue Date">Issue
                                                        Date</label>
                                                    <input type="text" class="form-control form-control-sm date-picker"
                                                        name="doc_issue_date_{{$i}}" data-date-end-date="0d"
                                                        id="doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" />
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <label for="" class="text--maroon kt-font-bold"
                                                        title="Expiry Date">Expiry
                                                        Date</label>
                                                    <input type="text" class="form-control form-control-sm date-picker"
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
                        <input type="hidden" id="permit_id" value={{$artist_details->permit_id}}>

                        <a href="{{url('company/renew_permit').'/'.$artist_details->id}}">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                Back
                            </div>
                        </a>
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn">
                            Update
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


@endsection


@section('script')
<script async src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset('js/uploadfile.js')}}"></script>
<script>
    var fileUploadFns = [];
    var picUploader ;
    var artistDetails = new Object();
    var documentDetails = new Object();

    $(document).ready(function(){
        localStorage.clear();
        // upload file
       uploadFunction();
       PicUploadFunction();

       $('#submit_btn').css('display', 'none');

        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(2);
        $('#back_btn').css('display', 'none');

        $('#city').val() ? getAreas($('#city').val(), $('#sel_area').val()) : '';

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
                // showDownload: true,
                // showPreview: true,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                abortStr: '',
                multiple: false,
                maxFileCount:1,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: i, reqId: $('#req_id_'+i).val() , artistNo: $('#artist_number_doc').val()},
                onLoad:function(obj)
                {
                    var temp_id = $('#temp_id').val();
                    if(temp_id){
                        $.ajaxSetup({
                        headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            cache: false,
                            url: "{{route('company.get_temp_files_by_temp_id')}}",
                            type: 'POST',
                            data: {temp_id:  temp_id, reqId: $('#req_id_'+i).val()},
                            dataType: "json",
                            success: function(data)
                            {

                                // console.log('../../storage/'+data[0]["path"]);
                                let id = obj[0].id;
                                let number = id.split("_");
                                let issue_datetime = new Date(data.issued_date);
                                let exp_datetime = new Date(data.expired_date);
                                let formatted_issue_date = appendLeadingZeroes(issue_datetime.getDate()) + "-" + appendLeadingZeroes(issue_datetime.getMonth() + 1) + "-" + issue_datetime.getFullYear();
                                let formatted_exp_date = appendLeadingZeroes(exp_datetime.getDate()) + "-" + appendLeadingZeroes(exp_datetime.getMonth() + 1) + "-" + exp_datetime.getFullYear();

                                obj.createProgress(data.document_name,"{{url('/storage')}}"+'/'+data.path,'');
                                if(formatted_issue_date != NaN-NaN-NaN)
                                {
                                    $('#doc_issue_date_'+number[1]).val(formatted_issue_date);
                                    $('#doc_exp_date_'+number[1]).val(formatted_exp_date);
                                }
                            }
                        });
                    }

                },
                downloadCallback:function(filename,pd)
                {
                    // $.ajaxSetup({
                    //     headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                    //     });
                    //     $.ajax({
                    //         url: "{{route('company.download_file')}}",
                    //         type: 'POST',
                    //         data: {artist_permit: $('#artist_permit_num').val(), name: filename},
                    //         success: function(data)
                    //         {
                    //             console.log(data);
                    //         }
                    //     });
                    // location.href="download.php?filename="+filename;
                }
            });
            $('#fileuploader_'+i+' div').attr('id', 'ajax-upload_'+i);
            $('#fileuploader_'+i+' + div').attr('id', 'ajax-file-upload_'+i);
        }
    }


    function appendLeadingZeroes(n){
        if(n <= 9){
            return "0" + n;
        }
        return n
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
                showFileCounter: false,
                previewHeight: '200px',
                previewWidth: '200px',
                abortStr: '',
                showPreview:true,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: 0, reqName: 'Artist Photo' , artistNo: $('#artist_number_doc').val()},
                onLoad:function(obj)
                {
                    var temp_id = $('#temp_id').val();
                    if(temp_id){
                        $.ajaxSetup({
                            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            url: "{{url('company/get_temp_photo_temp_id')}}"+'/'+temp_id,
                            success: function(data)
                            {
                                // console.log(data[0].original_pic);
                                if(data[0].original)
                                {
                                    obj.createProgress('Profile Pic',"{{url('/storage')}}"+'/'+data[0].original,'');
                                }
                            }
                        });
                    }

                },
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
                profession: 'required',
                permit_type: 'required',
                dob: 'required',
                uid_number: 'required',
                uid_expiry: 'required',
                passport: 'required',
                pp_expiry: 'required',
                visa_type: 'required',
                visa_number: 'required',
                visa_expiry: 'required',
                sp_name: 'required',
                nationality: 'required',
                address: 'required',

                mobile: {
                    // number: true,
                    required : true
                } ,
                email: {
                    required: true,
                    email: true,
                },
            },
            messages: {
                fname_en: 'This field is required',
                fname_ar: 'This field is required',
                lname_en: 'This field is required',
                lname_ar: 'This field is required',
                permit_type: 'This field is required',
                profession: 'This field is required',
                dob: 'This field is required',
                uid_number: 'This field is required',
                uid_expiry: 'This field is required',
                passport: 'This field is required',
                pp_expiry: 'This field is required',
                visa_type: 'This field is required',
                visa_number: 'This field is required',
                visa_expiry: 'This field is required',
                sp_name: 'This field is required',
                nationality: 'This field is required',
                address: 'This field is required',

                mobile: {
                    // number: 'Please enter number',
                    required : 'This field is required'
                },
                email: {
                    required: 'This field is required',
                    email: 'Enter a valid email',
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
        })

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
                artistDetails[artist_id] = {
                    id: $('#artist_id').val(),
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
                    fax_number: $('#fax_no').val(),
                    po_box: $('#po_box').val(),
                    address: $('#address').val(),
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

    $('#submit_btn').click((e) => {

        var hasFile = docValidation();

        if(documentsValidator.form() && hasFile){
        // var artist_permit_id = $('#artist_permit_id').val();
        var permit_id = $('#permit_id').val();
        var temp_id = $('#temp_id').val();
        var ad = localStorage.getItem('artistDetails');
        var dd = localStorage.getItem('documentDetails');
        var issue_d = $('#issue_date').val();
        var expiry_d = $('#expiry_date').val();

        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        $.ajax({
                url:"{{route('company.update_artist_temp_data')}}",
                type: "POST",
                // processData:false,
                // data: { permitDetails: pd},
                data: {
                    artistD: ad ,
                    documentD: dd,
                    temp_id: temp_id,
                    permit_id: permit_id,
                    issue_d: issue_d,
                    expiry_d: expiry_d,
                    updateChecklist: false
                },
                success: function(result){
                    // console.log(result)
                    if(result.message[0] == 'success')
                    {
                        localStorage.clear();
                        window.location.href="{{url('company/add_new_permit')}}"+'/'+ permit_id;
                    }
                }
            });
        }

    })


    const stopNext = (validator_name) => {
        wizard.on("beforeNext", function(wizardObj) {
            if (validator_name.form() !== true) {
                wizardObj.stop(); // don't go to the next step
            }
        });
    }

    $('#prev_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
       if(wizard.currentStep == 2){
            $('#prev_btn').css('display', 'none');
            $('#back_btn').css('display', 'block');
       }else{
            $('#prev_btn').css('display', 'block');
            $('#next_btn').css('display', 'block');
       }
       $('#submit_btn').css('display', 'none');
    });


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


    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    })

    $('#permit_from').on('changeDate', function(ev) {$('#permit_from').valid() || $('#permit_from').removeClass('invalid').addClass('success');});
    $('#permit_to').on('changeDate', function(ev) {$('#permit_to').valid() || $('#permit_to').removeClass('invalid').addClass('success');});
    $('#dob').on('changeDate', function(ev) { $('#dob').valid() || $('#dob').removeClass('invalid').addClass('success'); });
    $('#uid_expiry').on('changeDate', function(ev) { $('#uid_expiry').valid() || $('#uid_expiry').removeClass('invalid').addClass('success');});
    $('#pp_expiry').on('changeDate', function(ev) { $('#pp_expiry').valid() || $('#pp_expiry').removeClass('invalid').addClass('success');});
    $('#visa_expiry').on('changeDate', function(ev) { $('#visa_expiry').valid() || $('#visa_expiry').removeClass('invalid').addClass('success');});


    const getAreas = (city_id, sel_id) => {
        $.ajax({
                url:"{{url('company/fetch_areas')}}"+'/'+city_id,
                success: function(result){
                    // console.log(result)
                    $('#area').empty();
                    $('#area').append('<option value=" ">Select</option>');
                    for(let i = 0; i< result.length;i++)
                    {
                        $('#area').append('<option value="'+result[i].id+'" >'+result[i].area_en+'</option>');
                    }
                    if(sel_id){
                        $('#area').val(sel_id);
                    }
                }
            });

    }

</script>
@endsection
