<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
    <div class="kt-form__section kt-form__section--first">
        @if($from == 'edit')
        @component('permits.components.artist_permit_comments', ['staff_comments' =>
        $staff_comments])
        @endcomponent
        @endif
        {{-- @if($from == 'edit')
            @include('permits.components.artist_comments')
            @endif --}}
        <form id="artist_details" novalidate autocomplete="off">
            <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample5">
                <div class="card">
                    <div class="card-header" id="headingOne6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6"
                            aria-expanded="true" aria-controls="collapseOne6">
                            <h6 class="kt-font-transform-u">{{__('Artist Details')}}</h6>
                        </div>
                    </div>
                    <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                        data-parent="#accordionExample5">
                        <div class="card-body">
                            <input type="hidden" id="artist_id" value="{{$artist_details->artist_id}}" />
                            <input type="hidden" id="is_old_artist" />

                            <div class="row">
                                <div class="col-6">
                                    <section class="kt-form--label-right">
                                        <input type="hidden" id="artist_number" value={{1}}>
                                        <input type="hidden" class="form-control form-control-sm" name="code" id="code"
                                            value="{{$artist_details->person_code != 0 ? $artist_details->person_code : ''}}">
                                        <div class="form-group form-group-sm row">
                                            <label for="fname_en"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">
                                                {{__('First Name')}} <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="fname_en" id="fname_en" placeholder="{{__('First Name')}}"
                                                        value="{{$artist_details->firstname_en}}">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-group form-group-sm row">
                                            <label for="fname_en"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Last Name')}}<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="lname_en" id="lname_en" placeholder="{{__('Last Name')}}"
                                                        value="{{$artist_details->lastname_en}}">
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
                                                    <select class="form-control form-control-sm " name="nationality"
                                                        id="nationality" onchange="checkVisaRequired()">
                                                        {{--   - class for search in select  --}}
                                                        <option value="">{{__('Select')}}</option>
                                                        @foreach ($countries as $ct)
                                                        <option value="{{$ct->country_id}}" <?php
                                                                    if($ct->country_id == $artist_details->nationality)
                                                                    { echo 'selected ' ;}?>>
                                                            {{getLangId() == 1 ? $ct->nationality_en : $ct->nationality_ar}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="dob"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Birth Date')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        placeholder="DD-MM-YYYY" data-date-end-date="0d" name="dob"
                                                        id="dob"
                                                        value="{{date('d-m-Y', strtotime($artist_details->birthdate))}}" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-group-sm row">
                                            <label for="profession"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Passport No.')}}
                                                <span class="text-danger hd-uae">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="passport" id="passport"
                                                        placeholder="{{__('Passport Number')}}"
                                                        value="{{$artist_details->passport_number}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm row">
                                            <label for="pp_expiry"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Passport Expiry')}}<span
                                                    class="text-danger hd-uae">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm date-picker "
                                                        placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                        name="pp_expiry" id="pp_expiry"
                                                        value="{{$artist_details->passport_expire_date != '0000-00-00' ? date('d-m-Y', strtotime($artist_details->passport_expire_date)) : ''}}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="uid_number"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('UID No')}}
                                                <span class="text-danger hd-uae">*</span> </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="uid_number" id="uid_number" placeholder="{{__('UID No')}}"
                                                        value="{{$artist_details->uid_number}}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-group-sm row">
                                            <label for="dob"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('UID Expiry Date')}}
                                                <span class="text-danger hd-uae">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm date-picker "
                                                        placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                        name="uid_expiry" id="uid_expiry"
                                                        value="{{$artist_details->uid_expire_date != '0000-00-00' ? date('d-m-Y', strtotime($artist_details->uid_expire_date)) : ''}}" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-group-sm row">
                                            <label for="religion"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Religion')}}
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select class=" form-control form-control-sm " name="religion"
                                                        id="religion">
                                                        <option value=" ">{{__('Select')}}</option>
                                                        @foreach ($religions as $reli)
                                                        <option value={{$reli->id}} {{$reli->id == $artist_details->religion ?
                                                                         'selected': ''}}>
                                                            {{getLangId() == 1 ? $reli->name_en : $reli->name_ar}}
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
                                            <label for="fname_ar"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('First Name (AR)')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text"
                                                        class="form-control form-control-sm text-left text-lg-right "
                                                        name="fname_ar" id="fname_ar"
                                                        value="{{$artist_details->firstname_ar}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-group-sm row">
                                            <label for="lname_ar"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Last Name (AR)')}}
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" dir="rtl" class="form-control form-control-sm"
                                                        name="lname_ar" id="lname_ar"
                                                        value="{{$artist_details->lastname_ar}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="profession"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Profession')}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control form-control-sm " name="profession"
                                                        id="profession" placeholder="{{__('Profession')}}">
                                                        <option value="">{{__('Select')}}</option>
                                                        @foreach ($profession as $pt)
                                                        <option value="{{$pt->profession_id}}"
                                                            <?php if($pt->profession_id == $artist_details->profession_id){ echo 'selected' ;}?>>
                                                            {{getLangId() == 1 ? ucwords($pt->name_en) : $pt->name_ar}}
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
                                                    <select class=" form-control form-control-sm " name="gender"
                                                        id="gender">
                                                        <option value="">{{__('Select')}}</option>
                                                        <option value="1"
                                                            {{ $artist_details->gender == 1 ? 'selected' : '' }}>
                                                            {{getLangId() == 1 ? 'Male' : 'الذكر'}}</option>
                                                        <option value="2"
                                                            {{ $artist_details->gender == 2 ? 'selected' : '' }}>
                                                            {{getLangId() == 1 ? 'Female' : 'أنثى'}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>





                                        <div class="form-group form-group-sm row">
                                            <label for="visa_type"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Visa Type')}}
                                                <span class="text-danger hd-uae hd-eu">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select type="text" class="form-control form-control-sm"
                                                        name="visa_type" id="visa_type">
                                                        <option value="">{{__('Select')}}</option>
                                                        @foreach ($visatypes as $vt)
                                                        <option value={{$vt->id}}
                                                            {{$vt->id == $artist_details->visa_type ?  'selected' : '' }}>
                                                            {{getLangId() == 1 ? $vt->visa_type_en : $vt->visa_type_ar}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-group-sm row">
                                            <label for="visa_number"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Visa Number')}}
                                                <span class="text-danger hd-uae hd-eu">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="visa_number" id="visa_number"
                                                        placeholder="{{__('Visa Number')}}"
                                                        value="{{$artist_details->visa_number}}">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-group-sm row">
                                            <label for="visa_expiry"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Visa Expiry Date')}}
                                                <span class="text-danger hd-uae hd-eu">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm date-picker "
                                                        placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                        name="visa_expiry" id="visa_expiry"
                                                        value="{{$artist_details->visa_expire_date != '0000-00-00' ? date('d-m-Y', strtotime($artist_details->visa_expire_date)) : ''}}" />
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="form-group form-group-sm row">
                                            <label for="id_no"
                                                class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Identification No')}}
                                        <span class="text-danger sh-uae">*</span></label>
                                        <div class="col-lg-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm " name="id_no"
                                                    id="id_no" value="{{$artist_details->emirates_id}}">
                                            </div>
                                        </div>
                                </div> --}}

                                <input type="hidden" name="id_no" id="id_no" value="">

                                <div class="form-group form-group-sm row">
                                    <label for="sp_name"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Sponsor Name')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm " name="sp_name"
                                                id="sp_name" placeholder="{{__('Sponsor Name')}}"
                                                value="{{$artist_details->sponsor_name_en}}">
                                        </div>
                                    </div>
                                </div>


                                <div class=" form-group form-group-sm row">
                                    <label for="language"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Language')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <select class=" form-control form-control-sm " name="language"
                                                id="language">
                                                <option value=" ">{{__('Select')}}</option>
                                                @foreach ($languages as $lang)
                                                <option value={{$lang->id}}
                                                    {{$lang->id == $artist_details->language ? 'selected' : ''}}>
                                                    {{getLangId() == 1 ? $lang->name_en : $lang->name_ar}}
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
    <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample7">

        <div class="card">
            <div class="card-header" id="headingTwo6">
                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6"
                    aria-expanded="false" aria-controls="collapseTwo6">
                    <h6 class="kt-font-transform-u">{{__('Contact Information')}}
                    </h6>
                </div>
            </div>
            <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6" data-parent="#accordionExample7">
                <div class="card-body">

                    <div class="row">
                        <div class="col-6">
                            <section class="kt-form--label-right">

                                <div class="form-group form-group-sm row">
                                    <label for="mobile"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Mobile Number')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm " name="mobile"
                                                id="mobile" placeholder="{{__('Mobile Number')}}"
                                                value="{{$artist_details->mobile_number}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group form-group-sm row">
                                    <label for="landline"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Phone Number')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm " name="landline"
                                                id="landline" placeholder="{{__('Phone Number')}}"
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
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Email')}}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm "
                                                placeholder="{{__('Email')}}" name="email" id="email"
                                                value="{{$artist_details->email}}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group form-group-sm row">
                                    <label for="fax_no"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Fax No')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm " name="fax_no"
                                                id="fax_no" placeholder="{{__('Fax No')}}"
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
    <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample8">

        <div class="card">
            <div class="card-header" id="headingTwo7">
                <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo7"
                    aria-expanded="false" aria-controls="collapseTwo7">
                    <h6 class="kt-font-transform-u">{{__('Address Information')}}
                    </h6>
                </div>
            </div>
            <div id="collapseTwo7" class="collapse show" aria-labelledby="headingTwo7" data-parent="#accordionExample8">
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
                                            <input type="text" class="form-control form-control-sm " name="address"
                                                id="address" placeholder="{{__('Address')}}"
                                                value="{{$artist_details->address_en}}">
                                        </div>
                                    </div>
                                </div>

                                <div class=" form-group form-group-sm row">
                                    <label for="address"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Emirate')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <select class=" form-control form-control-sm " name="city" id="city"
                                                onChange="getAreas(this.value, {{$artist_details->area}}, {{getLangId()}})">
                                                <option value="">{{__('Select')}}</option>
                                                @foreach ($emirates as $em)
                                                <option value="{{$em->id}}"
                                                    {{$em->id == $artist_details->city ? 'selected' : '' }}>
                                                    {{getLangId() == 1 ? $em->name_en : $em->name_ar}}
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
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('PO Box')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input type="text" class="form-control form-control-sm " name="po_box"
                                                id="po_box" placeholder="{{__('PO Box')}}"
                                                value="{{$artist_details->po_box}}">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group form-group-sm row">
                                    <label for="address"
                                        class="col-md-4 col-sm-12 col-form-label kt-font-bold text-left text-lg-right">{{__('Area')}}
                                    </label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <select class="  form-control form-control-sm " name="area" id="area">
                                                <option value="">{{__('Select')}}</option>
                                                @foreach ($areas as $ar)
                                                <option value="{{$ar->id}}"
                                                    {{$ar->id == $artist_details->area ? 'selected' : '' }}>
                                                    {{getLangId() == 1 ? $ar->area_en : $ar->area_ar}}
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