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
                                    <input type="hidden" id="artist_id"
                                        value="{{$artist_details->artist_id}}" />
                                    <input type="hidden" id="is_old_artist" />

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
                                                                placeholder="Person Code"
                                                                value="{{$artist_details->person_code != 0 ? $artist_details->person_code : ''}}">
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
                                                                placeholder="First Name"
                                                                value="{{$artist_details->firstname_en  }}">
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
                                                                placeholder="Last Name"
                                                                value="{{$artist_details->lastname_en  }}">
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
                                                                <option value="{{$ct->country_id}}" <?php
                                                                    if($ct->country_id == $artist_details->nationality)
                                                                    { echo 'selected ' ;}?>>
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
                                                                id="dob"
                                                                value="{{date('d-m-Y', strtotime($artist_details->birthdate))}}" />
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
                                                                placeholder="Passport Number"
                                                                value="{{$artist_details->passport_number}}">
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
                                                                name="pp_expiry" id="pp_expiry"
                                                                value="{{date('d-m-Y', strtotime($artist_details->passport_expire_date))}}" />
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
                                                                placeholder="UID Number"
                                                                value="{{$artist_details->uid_number}}">
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
                                                                name="uid_expiry" id="uid_expiry"
                                                                value="{{date('d-m-Y', strtotime($artist_details->uid_expire_date))}}" />
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
                                                                <option value={{$reli->id}} <?php
                                                                    if($reli->id == $artist_details->religion){
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>
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
                                                                <option value="{{$pt->profession_id}}"
                                                                    <?php if($pt->profession_id == $artist_details->profession_id){ echo 'selected' ;}?>>
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
                                                                class="form-control form-control-sm text-right "
                                                                name="fname_ar" id="fname_ar"
                                                                placeholder="First Name in Arabic"
                                                                value="{{$artist_details->firstname_ar}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm row">
                                                    <label for="lname_ar"
                                                        class="col-4 col-form-label kt-font-bold text-right">Last
                                                        Name - Ar <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <div class="input-group input-group-sm">
                                                            <input type="text"
                                                                class="form-control form-control-sm text-right "
                                                                name="lname_ar" id="lname_ar"
                                                                placeholder="Last Name in Arabic"
                                                                value="{{$artist_details->lastname_ar}}">
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
                                                                <option value="1"
                                                                    <?php if($artist_details->gender == 1) { echo 'selected' ; } ?>>
                                                                    Male</option>
                                                                <option value="2"
                                                                    <?php if($artist_details->gender == 2) { echo 'selected' ; } ?>>
                                                                    Female</option>
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
                                                                <option value={{$vt->id}} <?php
                                                                    if($vt->id == $artist_details->visa_type){
                                                                        echo 'selected' ;
                                                                    }
                                                                    ?>>
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
                                                                placeholder="Visa Number"
                                                                value="{{$artist_details->visa_number}}">
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
                                                                name="visa_expiry" id="visa_expiry"
                                                                value="{{date('d-m-Y', strtotime($artist_details->visa_expire_date))}}" />
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
                                                                placeholder="Identification No."
                                                                value="{{$artist_details->emirates_id}}">
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
                                                                placeholder="Sponser Name"
                                                                value="{{$artist_details->sponsor_name_en}}">
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
                                                                <option value={{$lang->id}} <?php
                                                                    if($lang->id == $artist_details->language){
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>
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
                                                                placeholder="Mobile No."
                                                                value="{{$artist_details->mobile_number}}">
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
                                                                placeholder="Landline No."
                                                                value="{{$artist_details->phone_number}}">
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
                                                                id="email"
                                                                value="{{$artist_details->email}}" />
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
                                                                placeholder="Fax No"
                                                                value="{{$artist_details->fax_number}}">
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
                                                                placeholder="Address"
                                                                value="{{$artist_details->address_en}}">
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
                                                                <option value={{$em->id}}
                                                                    <?php if($em->id == $artist_details->city){ echo 'selected' ;} ?>>
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
                                                                placeholder="PO box"
                                                                value="{{$artist_details->po_box}}">
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

