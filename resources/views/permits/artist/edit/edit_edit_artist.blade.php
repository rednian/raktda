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
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
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
                                        <input type="checkbox" id="agree" name="agree" checked> I Read and
                                        understand
                                        all
                                        service rules, And agree to continue submitting it.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Form Wizard Step 1-->

                    {{-- {{dd($field_list->checklist)}} --}}

                    <!--begin: Permit Details Wizard-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="permit_details" method="POST">

                                    <input type="hidden" id="artist_permit_id"
                                        value="{{$permit_details->artist_permit_id}}">
                                    <div class=" row">
                                        <div class="form-group col-lg-3">
                                            <label for="permit_from" class="col-form-label col-form-label-sm">From
                                                Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="permit_from" id="permit_from" data-date-start-date="+0d"
                                                    placeholder="DD-MM-YYYY"
                                                    value="{{date('d-m-Y',strtotime($permit_details->permit['issued_date']))}}"
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
                                                    value="{{date('d-m-Y',strtotime($permit_details->permit['expired_date']))}}"
                                                    disabled />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="work_loc" class="col-form-label col-form-label-sm">Work
                                                Location:*</label>
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Work Location" name="work_loc" id="work_loc"
                                                value="{{$permit_details->permit['work_location']}}" disabled />
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

                    @php
                    $fieldnames = [];
                    if(!empty($field_list->checklist)) {
                    foreach($field_list->checklist as $row){
                    array_push($fieldnames,$row->fieldname);
                    }
                    }
                    @endphp

                    {{-- Artist details wizard Start --}}
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="artist_details">
                                    <input type="hidden" id="artist_number" value="{{1}}">
                                    <input type="hidden" id="artist_id" value="{{$artist_details->id}}">
                                    <div class=" row">
                                        <div class="form-group col-lg-3">
                                            <label for="name_en" class="col-form-label col-form-label-sm">Person
                                                Code:</label>
                                            <input type="text" class="form-control form-control-sm " id="dcode"
                                                placeholder="Person Code" value="{{$artist_details->person_code}}"
                                                disabled>
                                            <input type="hidden" class="form-control form-control-sm " name="code"
                                                id="code" placeholder="Person Code"
                                                value="{{$artist_details->person_code}}">
                                            <small>only enter if you know person code</small>
                                        </div>
                                        <input type="hidden" id="is_old_artist"
                                            value="{{$artist_details->is_old_artist}}">
                                        <input type="hidden" id="temp_id" value="{{$artist_details->id}}">
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="profession"
                                                class="col-form-label col-form-label-sm">Profession:*</label>
                                            <select
                                                class="form-control form-control-sm {{in_array('profession', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="profession" id="profession" placeholder="Profession">
                                                <option value="">Select</option>
                                                @foreach ($permitTypes as $pt)
                                                <option value="{{$pt->permit_type_id}}"
                                                    <?php if($pt->permit_type_id == $artist_details->permit_type_id){ echo 'selected' ;}?>>
                                                    {{$pt->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="fname_en" class="col-form-label col-form-label-sm">First
                                                Name:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('firstname', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="fname_en" id="fname_en" placeholder="First Name"
                                                    value="{{$artist_details->firstname_en}}">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="lname_en" class="col-form-label col-form-label-sm">Last
                                                Name:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('lastname', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="lname_en" id="lname_en" placeholder="Last Name"
                                                    value="{{$artist_details->lastname_en}}">
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="artist_permit_num">
                                    <div class="row">

                                        <div class="form-group col-lg-3">
                                            <label for="fname_ar" class="col-form-label col-form-label-sm">First
                                                Name (Arabic):*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm text-right {{in_array('firstname_ar', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="fname_ar" id="fname_ar" placeholder="First Name (Arabic)"
                                                    value="{{$artist_details->firstname_ar}}">
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="lname_ar" class="col-form-label col-form-label-sm">Last Name
                                                (Arabic):*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-user"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm text-right {{in_array('lastname_ar', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="lname_ar" id="lname_ar" placeholder="Last Name (Arabic)"
                                                    value="{{$artist_details->lastname_ar}}">
                                            </div>
                                        </div>


                                        <div class="form-group col-lg-3">
                                            <label for="dob" class="col-form-label col-form-label-sm">DOB:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('birthdate', $fieldnames) ? 'is-invalid' : ''}}"
                                                    placeholder="DD-MM-YYYY" data-date-end-date="0d" name="dob" id="dob"
                                                    value="{{$artist_details->birthdate ? date('d-m-Y', strtotime($artist_details->birthdate)) : ''}}" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="uid_number" class="col-form-label col-form-label-sm">UID:*
                                            </label>
                                            <input type="text"
                                                class="form-control form-control-sm {{in_array('UID number', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="uid_number" id="uid_number" placeholder="UID Number"
                                                value={{$artist_details->uid_number}}>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3">
                                            <label for="uid_expiry" class="col-form-label col-form-label-sm">UID
                                                Expire Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm date-picker {{in_array('UID expire date', $fieldnames) ? 'is-invalid' : ''}}"
                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                    name="uid_expiry" id="uid_expiry"
                                                    value="{{$artist_details->uid_expire_date ? date('d-m-Y', strtotime($artist_details->uid_expire_date)) : ''}}" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="passport" class="col-form-label col-form-label-sm">Passport
                                                No:*</label>
                                            <input type="text"
                                                class="form-control form-control-sm {{in_array('passport number', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="passport" id="passport" placeholder="Passport Number"
                                                value="{{$artist_details->passport_number}}">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="pp_expiry" class="col-form-label col-form-label-sm">PP
                                                Expire Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm date-picker {{in_array('passport expiry date', $fieldnames) ? 'is-invalid' : ''}}"
                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d" name="pp_expiry"
                                                    id="pp_expiry"
                                                    value="{{$artist_details->passport_expire_date ? date('d-m-Y', strtotime($artist_details->passport_expire_date)) : ''}}" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="visa_type" class="col-form-label col-form-label-sm">Visa
                                                Type:*</label>
                                            <select type="text"
                                                class="form-control form-control-sm {{in_array('visa type', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="visa_type" id="visa_type">
                                                <option value="">Select</option>
                                                @foreach ($visa_types as $vt)
                                                <option value="{{$vt->id}}"
                                                    <?php if($vt->id == $artist_details->visa_type) { echo 'selected' ;}?>>
                                                    {{$vt->visa_type_en}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3">
                                            <label for="visa_number" class="col-form-label col-form-label-sm">Visa
                                                Number:*</label>
                                            <input type="text"
                                                class="form-control form-control-sm {{in_array('visa number', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="visa_number" id="visa_number" placeholder="Visa Number"
                                                value="{{$artist_details->visa_number}}">
                                        </div>

                                        <div class="form-group col-lg-3">
                                            <label for="visa_expiry" class="col-form-label col-form-label-sm">Visa
                                                Expire Date:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-calendar"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm date-picker {{in_array('visa expiry date', $fieldnames) ? 'is-invalid' : ''}}"
                                                    placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                    name="visa_expiry" id="visa_expiry"
                                                    value="{{$artist_details->visa_expire_date ? date('d-m-Y', strtotime($artist_details->visa_expire_date)) : ''}}" />
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="sp_name" class="col-form-label col-form-label-sm">Sponser
                                                Name:*</label>
                                            <input type="text"
                                                class="form-control form-control-sm {{in_array('sponsor name', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="sp_name" id="sp_name" placeholder="Sponsor Name"
                                                value="{{$artist_details->sponsor_name_en}}">
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="telephone"
                                                class="col-form-label col-form-label-sm">Identification No:</label>
                                            <input type="text"
                                                class="form-control form-control-sm {{in_array('id no', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="id_no" id="id_no" placeholder="Identification No."
                                                value="{{$artist_details->emirates_id}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="nationality"
                                                class="col-form-label col-form-label-sm">Nationality:*</label>
                                            <select
                                                class="form-control form-control-sm {{in_array('nationality', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="nationality" id="nationality">

                                                <option value="">Select</option>
                                                @foreach ($countries as $ct)
                                                <option value="{{$ct->country_code}}"
                                                    <?php if($ct->country_code == $artist_details->nationality){ echo 'selected' ;}?>>
                                                    {{$ct->country_enNationality}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class=" form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="language"
                                                class="col-form-label col-form-label-sm">Languages:</label>
                                            <select
                                                class=" form-control form-control-sm {{in_array('language', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="language" id="language">
                                                <option value="">Select</option>
                                                @foreach ($languages as $lang)
                                                <option value="{{$lang->id}}"
                                                    <?php if($lang->id == $artist_details->language){ echo 'selected';}?>>
                                                    {{$lang->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="religion"
                                                class="col-form-label col-form-label-sm">Religion:</label>
                                            <select
                                                class=" form-control form-control-sm {{in_array('religion', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="religion" id="religion">
                                                <option value="">Select</option>
                                                @foreach ($religions as $reli)
                                                <option value="{{$reli->id}}"
                                                    <?php if($reli->id == $artist_details->religion){ echo 'selected';}?>>
                                                    {{$reli->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="gender"
                                                class="col-form-label col-form-label-sm">Gender:*</label>
                                            <select
                                                class=" form-control form-control-sm {{in_array('gender', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="gender" id="gender">
                                                <option value="">Select</option>
                                                <option value="1"
                                                    <?php if($artist_details->gender == 1){ echo 'selected';}?>>
                                                    Male</option>
                                                <option value="2"
                                                    <?php if($artist_details->gender == 2){ echo 'selected';}?>>
                                                    Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="city" class="col-form-label col-form-label-sm">Emirate:</label>
                                            <select
                                                class=" form-control form-control-sm {{in_array('city', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="city" id="city" onChange="getAreas(this.value, '')">
                                                <option value="">Select</option>
                                                @foreach ($emirates as $em)
                                                <option value="{{$em->id}}"
                                                    <?php if($em->id == $artist_details->city){ echo 'selected';}?>>
                                                    {{$em->name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="sel_area" id="sel_area"
                                            value="{{$artist_details->area}}">
                                        <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                            <label for="area" class="col-form-label col-form-label-sm">Area:</label>
                                            <select
                                                class="  form-control form-control-sm {{in_array('area', $fieldnames) ? 'is-invalid' : ''}}"
                                                name="area" id="area">
                                                <option value="">Select</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="address"
                                                class="col-form-label col-form-label-sm">Address:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-map-marker"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('address', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="address" id="address" placeholder="Address"
                                                    value="{{$artist_details->address_en}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="address" class="col-form-label col-form-label-sm">PO
                                                Box:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"></div>
                                                <input type="text" class="form-control form-control-sm" name="po_box"
                                                    id="po_box" placeholder="PO box"
                                                    value="{{$artist_details->po_box}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-3">
                                            <label for="address" class="col-form-label col-form-label-sm">Fax
                                                No:</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"></div>
                                                <input type="text" class="form-control form-control-sm" name="fax_no"
                                                    id="fax_no" placeholder="Fax No"
                                                    value="{{$artist_details->fax_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="landline" class="col-form-label col-form-label-sm">LandLine
                                                No:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-phone-square"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('phone number', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="landline" id="landline" placeholder="Landline No."
                                                    value="{{$artist_details->phone_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="mobile" class="col-form-label col-form-label-sm">Mobile
                                                No:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-mobile-phone"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('mobile phone', $fieldnames) ? 'is-invalid' : ''}}"
                                                    name="mobile" id="mobile" placeholder="Mobile No."
                                                    value="{{$artist_details->mobile_number}}">
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label for="email" class="col-form-label col-form-label-sm">Email:*</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i
                                                            class="la la-envelope-o"></i></span></div>
                                                <input type="text"
                                                    class="form-control form-control-sm {{in_array('email', $fieldnames) ? 'is-invalid' : ''}}"
                                                    placeholder="Email" name="email" id="email"
                                                    value="{{$artist_details->email}}" />
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 3-->



                    <!--begin: Form Wizard Step 3-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <form id="documents_required" method="post">
                                    <input type="hidden" id="artist_number_doc" value={{1}}>
                                    <input type="hidden" id="requirements_count" value={{count($requirements)}}>
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form" id="document_row">
                                            <div class="row">
                                                <div class="form-group col-2">
                                                    <label for="" class="reqName" title="Artist Photo">Artist
                                                        Photo</label>
                                                </div>
                                                <div class="form-group col-6">
                                                    <div id="pic_uploader">Upload
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php
                                    $i = 1;
                                    @endphp
                                    @foreach ($requirements as $req)
                                    <div class="kt-form__section kt-form__section--first">
                                        <div class="kt-wizard-v3__form" id="document_row">
                                            <div class="row">
                                                <div class="form-group col-2">
                                                    <label for="" class="reqName"
                                                        title="{{$req->requirement_description}}">{{$req->requirement_name}}</label>
                                                    <input type="hidden" value="{{$req->requirement_name}}"
                                                        id="req_name_{{$i}}">
                                                </div>
                                                <div class="form-group col-6">
                                                    <div id="fileuploader_{{$i}}">Upload
                                                    </div>
                                                </div>
                                                <input type="hidden" id="datesRequiredCheck_{{$i}}"
                                                    value="{{$req->dates_required}}">
                                                @if($req->dates_required == 1)
                                                <div class="form-group col-2">
                                                    <input type="text" class="form-control date-picker"
                                                        name="doc_issue_date_{{$i}}" data-date-end-date="0d"
                                                        id="doc_issue_date_{{$i}}" placeholder="Issue Date" />
                                                </div>
                                                <div class="form-group col-2">
                                                    <input type="text" class="form-control date-picker"
                                                        name="doc_exp_date_{{$i}}" data-date-start-date="+30d"
                                                        id="doc_exp_date_{{$i}}" placeholder=" Expiry Date" />
                                                </div>
                                                @endif
                                            </div>

                                        </div>
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
                        <input type="hidden" value="{{$permit_details->permit_id}}" id="permit_id">

                        <a href="{{url('company/edit_permit/'.$permit_details->permit_id)}}">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                Back
                            </div>
                        </a>
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn"
                            style="display:none;">
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

        $('.reqName').tooltip();

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url:"{{route('clear_the_temp')}}"
        });

        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(3);
        $('#back_btn').css('display', 'none');
        var city = $('#city').val();
        var sel_area = $('#sel_area').val();
        city ? getAreas(city, sel_area) : '';
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
                    var temp_id = $('#temp_id').val();
                    if(temp_id){
                        $.ajaxSetup({
                        headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            cache: false,
                            url: "{{route('company.get_temp_files_by_artist_permit_id')}}",
                            type: 'POST',
                            data: {temp_id:  temp_id, reqName: $('#req_name_'+i).val()},
                            dataType: "json",
                            success: function(data)
                            {
                                // console.log(data);
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
                url: "{{route('company.upload_file')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                maxFileCount:1,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
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
                            url: "{{url('company/get_temp_photo_artist_permit_id')}}"+'/'+temp_id,
                            success: function(data)
                            {
                                // console.log(data);
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
                    number: true,
                    required : true
                } ,
                mobile: {
                    number: true,
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
                    number: 'Must be a Number'
                },
                mobile: {
                    number: 'Please enter number',
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


    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");

        // checking the next page is permit details
       if(wizard.currentStep == 2){
            stopNext(permitValidator); // validating the permit details page
           // storing the values of permit details
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
                    id: $('#artist_id').val(),
                    code: $('#code').val(),
                    fname_en: $('#fname_en').val(),
                    fname_ar:  $('#fname_ar').val(),
                    lname_en: $('#lname_en').val(),
                    lname_ar:  $('#lname_ar').val(),
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

    $('#submit_btn').click((e) => {

        var hasFile = docValidation();

        if(documentsValidator.form() && hasFile){

        var artist_permit_id = $('#artist_permit_id').val();
        var permit_id = $('#permit_id').val();
        var temp_id = $('#temp_id').val();
        var ad = localStorage.getItem('artistDetails');
        var dd = localStorage.getItem('documentDetails');

        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
        });
        $.ajax({
                url:"{{route('company.update_artist_temp_data')}}",
                type: "POST",
                // processData:false,
                // data: { permitDetails: pd},
                data: {
                    permitId: artist_permit_id,
                    artistD: ad ,
                    documentD: dd,
                    temp_id: temp_id,
                    permit_id: permit_id,
                    updateChecklist: true
                },
                success: function(result){
                    console.log(result);
                    if(result.message[0] == 'success')
                    {
                        localStorage.clear();
                        window.location.href="{{url('company/edit_permit')}}"+'/'+ permit_id;

                    }
                }
            });
        }

})

</script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script async src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>
@endsection
