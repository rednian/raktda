@extends('layouts.app')
@section('content')
<link href="{{asset('css/uploadfile.css')}}" rel="stylesheet">
<!-- begin:: Content -->
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>1</span> Check Instructions
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>2</span> Permit Details
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>3</span> Artist Details
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>4</span> Upload Docs
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
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne6"
                                                aria-expanded="true" aria-controls="collapseOne6">
                                                Artist Details Required
                                            </div>
                                        </div>
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo6" aria-expanded="false"
                                                aria-controls="collapseTwo6">
                                                Documents Required
                                            </div>
                                        </div>
                                        <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseThree6" aria-expanded="false"
                                                aria-controls="collapseThree6">
                                                Permit Fees Structure </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseFour6" aria-expanded="false"
                                                aria-controls="collapseFour6">
                                                Rules and Conditions
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
                                    <label class="kt-checkbox kt-checkbox--brand ml-2" id="agree_cb">
                                        <input type="checkbox" id="agree" name="agree"> I Read and understand all
                                        service rules, And agree to continue submitting it.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 1-->


                    <!--begin: Permit Details Wizard-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="permit_details" method="POST">
                                    <div class=" row">
                                        <div class="form-group col-lg-3">
                                            <label for="permit_from" class="col-form-label col-form-label-sm">From
                                                Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm "
                                                    name="permit_from" id="permit_from" data-date-start-date="+0d"
                                                    placeholder="DD-MM-YYYY" onchange="setToDate()"
                                                    value="{{date('d-m-Y', strtotime($permit_details->issued_date))}}"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="permit_to" class="col-form-label col-form-label-sm">To
                                                Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm "
                                                    name="permit_to" id="permit_to" placeholder="DD-MM-YYYY"
                                                    data-date-start-date="+30d"
                                                    value="{{date('d-m-Y', strtotime($permit_details->expired_date))}}"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="work_loc" class="col-form-label col-form-label-sm">Work
                                                Location:*</label>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Work Location" name="work_loc" id="work_loc"
                                                value="{{$permit_details->work_location}}" disabled />
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="" class="col-form-label col-form-label-sm">Connected Event
                                                ?</label>
                                            <div class="kt-radio-inline">
                                                <label class="kt-radio kt-radio--solid">
                                                    <input type="radio" name="isEvent" value="0"> Yes
                                                    <span></span>
                                                </label>
                                                <label class="kt-radio kt-radio--solid">
                                                    <input type="radio" name="isEvent" checked value="1"> No
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Permit details wizard end --}}

                    <input type="hidden" id="artist_permit_id" value="{{$permit_details->artist_permit_id}}">

                    {{-- Artist details wizard Start --}}
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="artist_details">
                                    <input type="hidden" id="artist_number" value={{1}}>
                                    <div class=" row">
                                        <div class="form-group col-lg-3">
                                            <label for="name_en" class="col-form-label col-form-label-sm">Person
                                                Code: </label><span id="changeArtistLabel"
                                                class="kt-badge kt-badge--danger kt-badge--inline d-none"
                                                onclick="removeSelectedArtist()">
                                                Change </span>
                                            <input type="text" class="form-control form-control-sm " name="code"
                                                id="code" placeholder="Person Code">
                                            <small>only enter if you know person code</small>
                                        </div>
                                        <input type="hidden" id="artist_id" value="">
                                        <input type="hidden" id="is_old_artist" value="1">
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="permit_type" class="col-form-label col-form-label-sm">Permit
                                                Type:*</label>
                                            <select class="form-control form-control-sm " name="permit_type"
                                                id="permit_type" placeholder="Permit Type">
                                                <option value="">Select</option>
                                                @foreach ($permitTypes as $pt)
                                                <option value="{{$pt->permit_type_id}}">{{$pt->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="fname_en" class="col-form-label col-form-label-sm">First
                                                Name:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" name="fname_en"
                                                    id="fname_en" placeholder="First Name">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="lname_en" class="col-form-label col-form-label-sm">Last
                                                Name:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" name="lname_en"
                                                    id="lname_en" placeholder="Last Name">
                                            </div>
                                        </div>

                                        <input type="hidden" id="artist_permit_id">

                                        <div class="form-group col-lg-3">
                                            <label for="fname_ar" class="col-form-label col-form-label-sm">First
                                                Name (Arabic):*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text" class="form-control form-control-sm text-right"
                                                    name="fname_ar" id="fname_ar" placeholder="First Name (Arabic)">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="lname_ar" class="col-form-label col-form-label-sm">Last Name
                                                (Arabic):*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text" class="form-control form-control-sm text-right"
                                                    name="lname_ar" id="lname_ar" placeholder="Last Name (Arabic)">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="profession"
                                                class="col-form-label col-form-label-sm">Profession:*</label>
                                            <select class="form-control form-control-sm " name="profession"
                                                id="profession" placeholder="Profession">
                                                <option value="">Select</option>
                                                @foreach ($profession as $pf)
                                                <option value="{{$pf->profession_id}}">{{$pf->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group col-lg-3">
                                            <label for="dob" class="col-form-label col-form-label-sm">DOB:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm "
                                                    placeholder="DD-MM-YYYY" data-date-end-date="0d" name="dob"
                                                    id="dob" />
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="uid_number" class="col-form-label col-form-label-sm">UID:*
                                            </label>
                                            <input type="text" class="form-control form-control-sm" name="uid_number"
                                                id="uid_number" placeholder="UID Number">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="uid_expiry" class="col-form-label col-form-label-sm">UID
                                                Expire Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm date-picker"
                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                    name="uid_expiry" id="uid_expiry" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="passport" class="col-form-label col-form-label-sm">Passport
                                                No:*</label>
                                            <input type="text" class="form-control form-control-sm" name="passport"
                                                id="passport" placeholder="Passport Number">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="pp_expiry" class="col-form-label col-form-label-sm">PP
                                                Expire Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm date-picker"
                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d" name="pp_expiry"
                                                    id="pp_expiry" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="visa_type" class="col-form-label col-form-label-sm">Visa
                                                Type:*</label>
                                            <select type="text" class="form-control form-control-sm " name="visa_type"
                                                id="visa_type">
                                                <option value="">Select</option>
                                                @foreach($visatypes as $vt)
                                                <option value="{{$vt->id}}">{{$vt->visa_type_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="visa_number" class="col-form-label col-form-label-sm">Visa
                                                Number:*</label>
                                            <input type="text" class="form-control form-control-sm" name="visa_number"
                                                id="visa_number" placeholder="Visa Number">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="visa_expiry" class="col-form-label col-form-label-sm">Visa
                                                Expire Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm date-picker"
                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                    name="visa_expiry" id="visa_expiry" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="sp_name" class="col-form-label col-form-label-sm">Sponser
                                                Name:*</label>
                                            <input type="text" class="form-control form-control-sm" name="sp_name"
                                                id="sp_name" placeholder="Sponser Name">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="telephone"
                                                class="col-form-label col-form-label-sm">Identification No:</label>
                                            <input type="text" class="form-control form-control-sm" name="id_no"
                                                id="id_no" placeholder="Identification No.">
                                        </div>

                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="nationality"
                                                class="col-form-label col-form-label-sm">Nationality:*</label>
                                            <select class="form-control form-control-sm " name="nationality"
                                                id="nationality">
                                                {{--   - class for search in select  --}}
                                                <option value="">Select</option>
                                                @foreach ($countries as $ct)
                                                <option value="{{$ct->country_code}}">{{$ct->country_enNationality}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="language"
                                                class="col-form-label col-form-label-sm">Languages:</label>
                                            <select class=" form-control form-control-sm " name="language"
                                                id="language">
                                                <option value="">Select</option>
                                                @foreach ($languages as $lang)
                                                <option value={{$lang->id}}>{{$lang->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="religion"
                                                class="col-form-label col-form-label-sm">Religion:</label>
                                            <select class=" form-control form-control-sm" name="religion" id="religion">
                                                <option value="">Select</option>
                                                @foreach ($religions as $reli)
                                                <option value={{$reli->id}}>{{$reli->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="gender"
                                                class="col-form-label col-form-label-sm">Gender:*</label>
                                            <select class=" form-control form-control-sm" name="gender" id="gender">
                                                <option value="">Select</option>
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="city" class="col-form-label col-form-label-sm">Emirate:</label>
                                            <select class=" form-control form-control-sm " name="city" id="city"
                                                onChange="getAreas(this.value)">
                                                <option value="">Select</option>
                                                @foreach ($emirates as $em)
                                                <option value={{$em->id}}>{{$em->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="area" class="col-form-label col-form-label-sm">Area:</label>
                                            <select class="  form-control form-control-sm " name="area" id="area">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="address"
                                                class="col-form-label col-form-label-sm">Address:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-map-marker"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" name="address"
                                                    id="address" placeholder="Address">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="address" class="col-form-label col-form-label-sm">PO
                                                Box:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"></div>
                                                <input type="text" class="form-control form-control-sm" name="po_box"
                                                    id="po_box" placeholder="PO box">
                                            </div>
                                        </div>


                                        <div class="form-group col-lg-3">
                                            <label for="address" class="col-form-label col-form-label-sm">Fax
                                                No:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"></div>
                                                <input type="text" class="form-control form-control-sm" name="fax_no"
                                                    id="fax_no" placeholder="Fax No">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="landline" class="col-form-label col-form-label-sm">LandLine
                                                No:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-phone-square"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" name="landline"
                                                    id="landline" placeholder="Landline No.">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="mobile" class="col-form-label col-form-label-sm">Mobile
                                                No:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-mobile-phone"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" name="mobile"
                                                    id="mobile" placeholder="Mobile No.">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="email" class="col-form-label col-form-label-sm">Email:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-envelope-o"></i></span></div>
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Email" name="email" id="email" />
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 3-->

                    <input type="hidden" value="{{$permit_id}}" id="permit_id">
                    <input type="hidden" value="{{$from}}" id="from_page">

                    <!--begin: Form Wizard Step 3-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="documents_required" method="post">
                                    <input type="hidden" id="artist_number_doc" value={{1}}>
                                    <input type="hidden" id="requirements_count" value={{count($requirements)}}>

                                    <div class="row">
                                        <div class="col-lg-2 col-sm-12">
                                            <label style="visibility:hidden">hidden</label>
                                            <p for="" class="reqName text--maroon kt-font-bold" title="Artist Photo">
                                                Artist
                                                Photo:*</p>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <label style="visibility:hidden">hidden</label>
                                            <div id="pic_uploader">Upload
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($requirements as $req)
                                    <div class="row ">
                                        <div class="col-lg-2 col-sm-12">
                                            <label style="visibility:hidden">hidden</label>
                                            <p for="" class="reqName text--maroon kt-font-bold"
                                                title="{{$req->requirement_description}}">
                                                {{ucwords($req->requirement_name)}}:*</p>
                                        </div>
                                        <input type="hidden" value="{{$req->requirement_name}}" id="req_name_{{$i}}">

                                        <div class="col-lg-6 col-sm-12">
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
                                                id="doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" />
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry
                                                Date</label>
                                            <input type="text" class="form-control form-control-sm date-picker"
                                                name="doc_exp_date_{{$i}}" data-date-start-date="+30d"
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
                            Previous
                        </div>
                        @php
                        if($from == 'amend'){
                        $route_back = 'amend_permit/'.$permit_details->permit_id;
                        } elseif($from == 'edit') {
                        $route_back = 'edit_permit/'.$permit_details->permit_id;
                        } elseif($from == 'renew') {
                        $route_back = 'renew_permit/'.$permit_details->permit_id;
                        }
                        @endphp
                        <a href="{{url('company/'.$route_back)}}">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                Back
                            </div>
                        </a>
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn"
                            style="display:none;">
                            Add
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

<!--begin::Modal-->
<div class="modal fade" id="artist_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Artist With Code &emsp;<span class="text--maroon"
                        id="ex_artist_personcode"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p class="text-center">Artist with same person code exists ! </p>
                <div class="kt-widget30__item d-flex justify-content-around">
                    <div class="kt-widget30__pic mr-2">
                        <img id="profImg" title="image">
                    </div>
                    <div class="kt-widget30__info" id="PC_Popup_Table">
                        <table>
                            <tr>
                                <th>Name:</th>
                                <td id="ex_artist_en_name"></td>
                            </tr>
                            <tr>
                                <th>Name(Ar):</th>
                                <td id="ex_artist_ar_name"></td>
                            </tr>
                            <tr>
                                <th>DOB:</th>
                                <td id="ex_artist_dob"></td>
                            </tr>
                            <tr>
                                <th>Gender:</th>
                                <td id="ex_artist_gender"></td>
                            </tr>
                            <tr>
                                <th>Mobile:</th>
                                <td id="ex_artist_mobilenumber"></td>
                            </tr>
                            <tr>
                                <th>Phone:</th>
                                <td id="ex_artist_phonenumber"></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="ex_artist_email"></td>
                            </tr>
                            <tr>
                                <th>Nationality:</th>
                                <td id="ex_artist_nationality"></td>
                            </tr>
                        </table>
                    </div>
                    <input type="hidden" id="artistDetailswithcode">
                    {{-- <span class="kt-widget30__stats">
                        <button class="btn btn-label-brand btn-bold btn-sm" onclick="setArtistDetails()"
                            data-dismiss="modal">Select</button>
                    </span> --}}
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button class="btn btn--yellow btn-bold btn-sm mr-3" onclick="setArtistDetails()"
                        data-dismiss="modal">Select this Artist</button>
                    <button class="btn btn--maroon btn-bold btn-sm" onclick="clearPersonCode()" data-dismiss="modal">Not
                        this Artist</button>
                </div>
                <small class="d-flex justify-content-center">Are you sure to add the this artist, else please do not add
                    person
                    code!</small>
            </div>

        </div>
    </div>
</div>
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
        $('.reqName').tooltip();

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url:"{{route('clear_the_temp')}}"
        });

    });

    $('.kt-wizard-v3__nav-item').on('click', function() {
        wizard = new KTWizard("kt_wizard_v3");
         // get current step number
        setTimeout(function(){
            if(wizard.currentStep == 1) {
                $('#back_btn').css('display', 'block');
                $('#submit_btn').css('display', 'none');
                $('#prev_btn').css('display', 'none');
                $('#next_btn').css('display', 'block');
            } else if(wizard.currentStep == 2) {
                $('#back_btn').css('display', 'none');
                $('#submit_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            } else if(wizard.currentStep == 3) {
                searchCode();
                $('#back_btn').css('display', 'none');
                $('#submit_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            } else if(wizard.currentStep == 4){
                $('#back_btn').css('display', 'none');
                $('#submit_btn').css('display', 'block');
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'none');
            }
         }, 200);
    });


    const uploadFunction = () => {
        // console.log($('#artist_number_doc').val());
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
            fileUploadFns[i] = $("#fileuploader_"+i).uploadFile({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('company.upload_file')}}",
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
                formData: {id: i, reqName: $('#req_name_'+i).val() , artistNo: $('#artist_number_doc').val()},
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
                            data: {artist_permit: $('#artist_permit_id').val(), reqName: $('#req_name_'+i).val()},
                            dataType: "json",
                            success: function(data)
                            {
                                // console.log('../../storage/'+data[0]["path"]);
                                // console.log(data);
                              if(data.length > 0) {
                                let id = obj[0].id;
                                let number = id.split("_");
                                let issue_datetime = new Date(data[0]['issued_date']);
                                let exp_datetime = new Date(data[0]['expired_date']);
                                let formatted_issue_date = appendLeadingZeroes(issue_datetime.getDate()) + "-" + appendLeadingZeroes(issue_datetime.getMonth() + 1) + "-" + issue_datetime.getFullYear();
                                let formatted_exp_date = appendLeadingZeroes(exp_datetime.getDate()) + "-" + appendLeadingZeroes(exp_datetime.getMonth() + 1) + "-" + exp_datetime.getFullYear();

                                obj.createProgress(data[0]["document_name"],'../../storage/'+data[0]["path"],'');
                                if(formatted_issue_date != NaN-NaN-NaN)
                                {
                                    $('#doc_issue_date_'+number[1]).val(formatted_issue_date);
                                    $('#doc_exp_date_'+number[1]).val(formatted_exp_date);
                                }
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
                url: "{{route('company.upload_file')}}",
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
                abortStr: '',
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: 0, reqName: 'Artist Photo' , artistNo: $('#artist_number_doc').val()},
                onLoad:function(obj)
                {
                    $code = $('#code').val();
                    if($code){
                        $.ajaxSetup({
                            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            url: "{{url('company/get_files_uploaded_with_code')}}"+"/"+$code,
                            success: function(data)
                            {
                                if(data[0].artist_permit[0].original)
                                {
                                    obj.createProgress('Profile Pic','../../storage/'+data[0].artist_permit[0].original,'');
                                }
                            }
                        });
                    }
                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
    }


    // const insertIntoDrafts = (stepNo, data) => {
    //         $.ajax({
    //             headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: "insert_artist_data_into_drafts",
    //             type:'POST',
    //             data: { data: data, step: stepNo, section: 'New'}
    //         });
    // }

    var permitValidator = $('#permit_details').validate({
        rules: {
            permit_from: 'required',
            permit_to: 'required',
            work_loc: 'required'
        },
        messages: {
            permit_from:  'This field is required',
            permit_to: 'This field is required',
            work_loc:  'This field is required'
        }

    });


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
                gender: 'required',
                landline: {
                    // number: true,
                    required : true
                } ,
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
                gender: 'This field is required',
                landline: {
                    required: 'This field is required',
                    // number: 'Must be a Number'
                },
                mobile: {
                    // number: 'Please enter number',
                    required : 'This field is required'
                },
                email: {
                    required: 'This field is required',
                    email: 'Enter a valid email',
                },
            },
            // invalidHandler: function(event, validator){
            //     KTUtil.scrollTop();
            //     Swal.fire({
            //         title: "",
            //         text:
            //             "Please fill all the mandatory fields",
            //         type: "error",
            //         confirmButtonClass: "btn btn-secondary"
            //     });

            // },
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


    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");

        if (wizard.currentStep == 1) {
            if ($('#agree').not(':checked')) {
                wizard.stop();
                $('#agree_cb > span').addClass('compulsory');
            }
            if ($('#agree').is(':checked')) {
                $('#back_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                wizard.goNext();
            }
        }


        // checking the next page is permit details
       if(wizard.currentStep == 2){
            stopNext(permitValidator); // validating the permit details page
           // storing the values of permit details
           searchCode();
           if(permitValidator.form())
            {
                var permitDetails = {
                    fromDate: $('#permit_from').val(),
                    toDate: $('#permit_to').val(),
                    workLocation: $('#work_loc').val()
                }
                // passing the values to local storage
                localStorage.setItem('permitDetails', JSON.stringify(permitDetails));

                // insertIntoDrafts(2, JSON.stringify(permitDetails));
            }
       }
       // checking the next page is artist details
       if(wizard.currentStep == 3)
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
                    id: $('#permit_id').val(),
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
                    fax_number: $('#fax_no').val(),
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
        documentDetails[artist_number] = {};
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
            if($('#ajax-file-upload_'+i).contents().length == 0) {
                hasFileArray[i] = false;
                $("#ajax-upload_"+i).css('border', '2px dotted red');
                KTUtil.scrollTop();
            }
            else{
                hasFileArray[i] = true;
                $("#ajax-upload_"+i).css('border', '2px dotted #A5A5C7');
            }
            documentDetails[artist_number][i] = {
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
       else if(wizard.currentStep == 1){
            $('#back_btn').css('display', 'none');
       } else
       {
            $('#prev_btn').css('display', 'block');
            $('#next_btn').css('display', 'block');
       }
       $('#addNew_btn').css('display', 'none');
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
    });

    $('#permit_from').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left"
    });

    $('#permit_to').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left"
    });

    $('#dob').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startView: 2
    });


    function clearPersonCode() {
        $('#code').val('');
    }

    $('#permit_from').on('changeDate', function(ev) {$('#permit_from').valid() || $('#permit_from').removeClass('invalid').addClass('success');});
    $('#permit_to').on('changeDate', function(ev) {$('#permit_to').valid() || $('#permit_to').removeClass('invalid').addClass('success');});
    $('#dob').on('changeDate', function(ev) { $('#dob').valid() || $('#dob').removeClass('invalid').addClass('success'); });
    $('#uid_expiry').on('changeDate', function(ev) { $('#uid_expiry').valid() || $('#uid_expiry').removeClass('invalid').addClass('success');});
    $('#pp_expiry').on('changeDate', function(ev) { $('#pp_expiry').valid() || $('#pp_expiry').removeClass('invalid').addClass('success');});
    $('#visa_expiry').on('changeDate', function(ev) { $('#visa_expiry').valid() || $('#visa_expiry').removeClass('invalid').addClass('success');});

    const del_row = (id) => {
        $('#row_'+id).remove();
    }


    const setToDate = () => {
        var permitFrom = $('#permit_from').val();
        var da =  permitFrom.split('-');
        var permitFrom = da[1]+'/'+da[0]+'/'+da[2];
        var newDate = new Date(permitFrom);
        newDate.setDate(newDate.getDate() + 30);

        Date.prototype.toInputFormat = function(){
            var yyyy = this.getFullYear().toString();
            var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based
            var dd  = this.getDate().toString();
            return    (dd[1]?dd:"0"+dd[0]) + "-" + (mm[1]?mm:"0"+mm[0])  +"-"  + yyyy;
        }
        $('#permit_to').val(newDate.toInputFormat());
        $('#permit_to').valid();
    }



    const getAreas = (city_id) => {
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

    $('#code').keyup(function() {
        searchCode();
    });

    function searchCode(){
        let code = $('#code').val();
        if(code){
            $.ajax({
                url: "{{url('company/searchCode')}}"+ '/'+code,
                success: function(data){
                    // console.log(data);
                    if(data) {
                        $('#artistDetailswithcode').val(JSON.stringify(data));
                        $('#ex_artist_en_name').html((data.firstname_en != null ?  data.firstname_en : '') + ' ' + (data.lastname_en != null ? data.lastname_en : ''));
                        $('#ex_artist_ar_name').html((data.firstname_ar != null ?  data.firstname_ar : '') + ' '+ (data.lastname_ar != null ? data.lastname_ar : ''));
                        $total_aps = data.artist_permit.length;
                        $j = $total_aps - 1 ;
                        $('#ex_artist_mobilenumber').html(data.artist_permit[$j].mobile_number);
                        $('#ex_artist_phonenumber').html(data.artist_permit[$j].phone_number);
                        $('#ex_artist_email').html(data.artist_permit[$j].email);
                        $('#ex_artist_personcode').html(data.person_code);
                        var dateArray = data.birthdate.split('-');
                        var dob = dateArray[2] + "-" + dateArray[1]  +"-"  + dateArray[0];
                        $('#ex_artist_dob').html(dob);
                        $('#ex_artist_nationality').html(data.nationality);
                        var gender = data.artist_permit[$j].gender == 1 ? 'Male' : 'Female';
                        $('#ex_artist_gender').html(gender);
                        $('#profImg').attr('src', data.artist_permit[$j].thumbnail ? "/storage/"+data.artist_permit[$j].thumbnail : '');
                        $('#profImg').css('height', '150px');
                        $('#profImg').css('width', '150px');
                        $('#artist_exists').modal('show');
                    }

                }
            });
        }
    }

    function removeSelectedArtist(){
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
        PicUploadFunction();
        uploadFunction();
        picUploader.reset();
    }


        const setArtistDetails = () => {
            let ad = $('#artistDetailswithcode').val();
            ad = JSON.parse(ad);

            var ap_count = ad.artist_permit.length;
            var i = ap_count - 1 ;
            // console.log(ad);
            var dateArray = ad.birthdate.split('-');
            $('#is_old_artist').val(2);
            var newDate = dateArray[2] + "-" + dateArray[1]  +"-"  + dateArray[0];
            $('#changeArtistLabel').removeClass('d-none');
            $('#changeArtistLabel').addClass('ml-2');
            $('#artist_id').val(ad.artist_id);
            $('#code').val(ad.person_code);$('#code').addClass('mk-disabled');
            $('#fname_en').val(ad.firstname_en);$('#fname_en').addClass('mk-disabled');
            $('#fname_ar').val(ad.firstname_ar);$('#fname_ar').addClass('mk-disabled');
            $('#lname_en').val(ad.lastname_en);$('#lname_en').addClass('mk-disabled');
            $('#lname_ar').val(ad.lastname_ar);$('#lname_ar').addClass('mk-disabled');
            $('#nationality').val(ad.nationality),
            $('#permit_type').val(ad.artist_permit[i].permit_type_id),
            $('#profession').val(ad.artist_permit[i].profession_id),
            $('#passport').val(ad.artist_permit[i].passport_number),
            $('#pp_expiry').val(ad.artist_permit[i].passport_expire_date),
            $('#visa_type').val(ad.artist_permit[i].visa_type),
            $('#visa_number').val(ad.artist_permit[i].visa_number),
            $('#visa_expiry').val(ad.artist_permit[i].visa_expire_date),
            $('#sp_name').val(ad.artist_permit[i].sponsor_name_en),
            $('#id_no').val(ad.artist_permit[i].emirates_id),
            $('#language').val(ad.artist_permit[i].language),
            $('#religion').val(ad.artist_permit[i].religion),
            $('#gender').val(ad.artist_permit[i].gender),
            $('#city').val(ad.artist_permit[i].city);
            getAreas(ad.artist_permit[i].city);
            $('#address').val(ad.artist_permit[i].address_en),
            $('#uid_number').val(ad.artist_permit[i].uid_number),
            $('#uid_expiry').val(ad.artist_permit[i].uid_expire_date),
            $('#dob').val(newDate),
            $('#landline').val(ad.artist_permit[i].phone_number),
            $('#po_box').val(ad.artist_permit[i].po_box),
            $('#fax_no').val(ad.artist_permit[i].fax_number),
            $('#mobile').val(ad.artist_permit[i].mobile_number),
            $('#email').val(ad.artist_permit[i].email);
            $('#artist_permit_id').val(ad.artist_permit[i].artist_permit_id);
            $('#area').val(ad.artist_permit[i].area);
            PicUploadFunction();
            uploadFunction();
            $('#artist_details').validate();
        }


        $('#submit_btn').click((e) => {

        var hasFile = docValidation();

        if(documentsValidator.form() && hasFile){

        var ad = localStorage.getItem('artistDetails');
        var dd = localStorage.getItem('documentDetails');
        var artist_permit_id = $('#artist_permit_id').val();

        var permit_id = $('#permit_id').val();
        var from_page = $('#from_page').val();

        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
        });
        $.ajax({
                url:"{{route('company.add_to_artist_temp_data')}}",
                type: "POST",
                data: { artistD: ad , documentD: dd , permit_id: permit_id},
                success: function(result){
                    localStorage.clear();
                    if(from_page == 'amend'){
                        window.location.href="{{url('company/amend_permit')}}"+'/'+ permit_id;
                    }else if(from_page == 'edit') {
                        window.location.href="{{url('company/edit_permit')}}"+'/'+ permit_id;
                    } else if(from_page == 'renew') {
                        window.location.href="{{url('company/renew_permit')}}"+'/'+ permit_id;
                    }
                }
            });
        }
        })




</script>
{{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> --}}

@endsection
