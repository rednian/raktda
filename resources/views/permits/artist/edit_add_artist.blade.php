@extends('layouts.app')


@section('content')

@component('layouts.subheader')
@slot('heading')
Permits
@endslot
@slot('subheading')
Artist Permit
@endslot

@slot('subSubHeading')
Apply New Artist Permit
@endslot

@endcomponent


<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content_company_artist">
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
                <div class="kt-grid__item">
                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v3__nav">
                        <div class="kt-wizard-v3__nav-items" role="tablist">
                            <div class="kt-wizard-v3__nav-item " data-ktwizard-type="step" href="#"
                                data-ktwizard-state="current">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>1</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>2</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>3</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>4</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>5</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>6</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>7</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                    <!--begin: Form Wizard Form-->
                    {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                    <div class="kt-form w-100 p-5" id="kt_form">
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                            data-ktwizard-state="current">






                        </div>

                        <!--end: Form Wizard Step 1-->

                        <!--begin: Permit Details Wizard-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">

                        </div>
                        {{-- Permit details wizard end --}}

                        {{-- Artist details wizard Start --}}
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Artist Details</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <form id="artist_details">
                                        <input type="hidden" id="artist_number" value={{1}}>
                                        <div class=" row">
                                            <div class="form-group col-lg-3">
                                                <label for="name_en" class="col-form-label col-form-label-sm">Person
                                                    Code:</label>
                                                <input type="text" class="form-control form-control-sm " name="code"
                                                    id="code" placeholder="Person Code">
                                                <small>only enter if you know person code</small>
                                            </div>
                                            <input type="hidden" id="is_old_artist" value="1">
                                            <div class="form-group col-lg-3">
                                                <label for="fname_en" class="col-form-label col-form-label-sm">First
                                                    Name:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-user"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="fname_en" id="fname_en" placeholder="First Name">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="fname_ar" class="col-form-label col-form-label-sm">First
                                                    Name (Arabic):</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-user"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="fname_ar" id="fname_ar" placeholder="First Name (Arabic)">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="lname_en" class="col-form-label col-form-label-sm">Last
                                                    Name:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-user"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lname_en" id="lname_en" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="artist_permit_num">
                                        <div class="row">
                                            <div class="form-group col-lg-3">
                                                <label for="lname_ar" class="col-form-label col-form-label-sm">Last Name
                                                    (Arabic):</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-user"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="lname_ar" id="lname_ar" placeholder="Last Name (Arabic)">
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                                <label for="profession"
                                                    class="col-form-label col-form-label-sm">Profession:</label>
                                                <select class="form-control form-control-sm " name="profession"
                                                    id="profession" placeholder="Profession">
                                                    <option value="">Select</option>
                                                    @foreach ($permitTypes as $pt)
                                                    <option value="{{$pt->permit_type_id}}">{{$pt->name_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="dob" class="col-form-label col-form-label-sm">DOB:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-calendar"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm date-picker"
                                                        placeholder="DD-MM-YYYY" data-date-end-date="0d" name="dob"
                                                        id="dob" />
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="uid_number" class="col-form-label col-form-label-sm">UID:
                                                </label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="uid_number" id="uid_number" placeholder="UID Number">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3">
                                                <label for="uid_expiry" class="col-form-label col-form-label-sm">UID
                                                    Expire Date:</label>
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
                                                    No:</label>
                                                <input type="text" class="form-control form-control-sm" name="passport"
                                                    id="passport" placeholder="Passport Number">
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="pp_expiry" class="col-form-label col-form-label-sm">PP
                                                    Expire Date:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-calendar"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm date-picker"
                                                        placeholder="DD-MM-YYYY" data-date-start-date="30d"
                                                        name="pp_expiry" id="pp_expiry" />
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                                <label for="visa_type" class="col-form-label col-form-label-sm">Visa
                                                    Type:</label>
                                                <select type="text" class="form-control form-control-sm "
                                                    name="visa_type" id="visa_type">
                                                    <option value="">Select</option>
                                                    <option value="Employment Visas">Employment Visas</option>
                                                    <option value="Tourist Visas">Tourist Visas</option>
                                                    <option value="Family Visas">Family Visas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3">
                                                <label for="visa_number" class="col-form-label col-form-label-sm">Visa
                                                    Number:</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="visa_number" id="visa_number" placeholder="Visa Number">
                                            </div>

                                            <div class="form-group col-lg-3">
                                                <label for="visa_expiry" class="col-form-label col-form-label-sm">Visa
                                                    Expire Date:</label>
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
                                                    Name:</label>
                                                <input type="text" class="form-control form-control-sm" name="sp_name"
                                                    id="sp_name" placeholder="Sponser Name">
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="telephone"
                                                    class="col-form-label col-form-label-sm">Identification No:</label>
                                                <input type="text" class="form-control form-control-sm" name="id_no"
                                                    id="id_no" placeholder="Identification No.">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                                <label for="nationality"
                                                    class="col-form-label col-form-label-sm">Nationality:</label>
                                                <select class="form-control form-control-sm " name="nationality"
                                                    id="nationality">
                                                    {{--   - class for search in select  --}}
                                                    <option value="">Select</option>
                                                    @foreach ($countries as $ct)
                                                    <option value={{$ct}}>{{$ct}}</option>
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
                                                <select class=" form-control form-control-sm" name="religion"
                                                    id="religion">
                                                    <option value="">Select</option>
                                                    @foreach ($religions as $reli)
                                                    <option value={{$reli->id}}>{{$reli->name_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                                <label for="gender"
                                                    class="col-form-label col-form-label-sm">Gender:</label>
                                                <select class=" form-control form-control-sm" name="gender" id="gender">
                                                    <option value="">Select</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3 w-100 d-flex flex-column">
                                                <label for="city" class="col-form-label col-form-label-sm">City:</label>
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
                                                    class="col-form-label col-form-label-sm">Address:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-map-marker"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="address" id="address" placeholder="Address">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="landline" class="col-form-label col-form-label-sm">LandLine
                                                    No:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-phone-square"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="landline" id="landline" placeholder="Landline No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-3">
                                                <label for="mobile" class="col-form-label col-form-label-sm">Mobile
                                                    No:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text"><i
                                                                class="la la-mobile-phone"></i></span></div>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="mobile" id="mobile" placeholder="Mobile No.">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label for="email"
                                                    class="col-form-label col-form-label-sm">Email</label>
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



                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Upload Documents Required
                            </div>
                            <form id="documents_required" method="post">
                                <input type="hidden" id="artist_number_doc" value={{1}}>
                                <input type="hidden" id="requirements_count" value={{count($requirements)}}>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form" id="document_row">
                                        <div class="row">
                                            <div class="form-group col-2">
                                                <label for="" class="reqName" title="Artist Photo">Artist Photo</label>
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



                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">

                        </div>



                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">

                        </div>



                        <div class="kt-form__actions">
                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev" id="prev_btn">
                                Previous
                            </div>

                            <div class="btn btn-outline-brand btn-pill kt-font-bold kt-font-transform-u" id="addNew_btn"
                                style="display:none;" onclick="startToFront()">
                                Add New Artist
                            </div>

                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                id="submit_btn" style="display:none;">
                                Apply
                            </div>

                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
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
<div class="modal fade" id="artist_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Artist Exists</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p>Artist with same person code exists ! </p>
                <div class="kt-widget30__item d-flex justify-content-around">
                    <div class="kt-widget30__pic">
                        <img id="profImg" title="image">
                    </div>
                    <div class="kt-widget30__info">
                        <p id="ex_artist_en_name"></p>
                        <p id="ex_artist_ar_name"></p>
                        <p id="ex_artist_phonenumber"></p>
                        <p id="ex_artist_mobilenumber"></p>
                        <p id="ex_artist_email"></p>
                    </div>
                    <input type="hidden" id="artistDetailswithcode">
                    <span class="kt-widget30__stats">
                        <button class="btn btn-label-brand btn-bold btn-sm" onclick="setArtistDetails()"
                            data-dismiss="modal">Select</button>
                    </span>
                </div>
                <small class="text-center">Are you sure to add the this artist, else please do not add person
                    code!</small>
            </div>

        </div>
    </div>
</div>

<!--end::Modal-->



@endsection


@section('script')

<script>
    var fileUploadFns = [];
    var picUploader ;
    var artistDetails = new Object();
    var documentDetails = new Object();

    $(document).ready(function(){
        $('#prev_btn').css('display', 'none');
        wizard = new KTWizard("kt_wizard_v3", {
            startStep: 3
        });

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
                showPreview: true,
                multiple: false,
                maxFileCount:1,
                showDelete: true,
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
                            url: "{{route('json_edit_artist_permit.get_files_uploaded')}}",
                            type: 'POST',
                            data: {artist_permit: $('#artist_permit_num').val(), reqName: $('#req_name_'+i).val()},
                            dataType: "json",
                            success: function(data)
                            {
                                // console.log('../../storage/'+data[0]["path"]);
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
                showDelete: true,
                formData: {id: 0, reqName: 'Artist Photo' , artistNo: $('#artist_number_doc').val()},
                onLoad:function(obj)
                {
                    $code = $('#code').val();
                    if($code){
                        $.ajaxSetup({
                            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            url: "get_files_uploaded_with_code/"+$code,
                            success: function(data)
                            {
                                if(data[0].artist_permit[0].original_pic)
                                {
                                    obj.createProgress('Profile Pic','../../storage/'+data[0].artist_permit[0].original_pic,'');
                                }
                            }
                        });
                    }

                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
    }


    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
        $('#prev_btn').css('display', 'block'); // to make the prev button display

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
                    landline: $('#landline').val(),
                    mobile: $('#mobile').val(),
                    email: $('#email').val(),
                    is_old_artist: $('#is_old_artist').val()
                }

                localStorage.setItem('artistDetails', JSON.stringify(artistDetails));
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
                exp_date : $('#doc_issue_date_'+i).val()
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

        var ad = localStorage.getItem('artistDetails');
        var dd = localStorage.getItem('documentDetails');

        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        $.ajax({
                url:"{{route('company.apply_artist_permit')}}",
                type: "POST",
                // processData:false,
                // data: { permitDetails: pd},
                data: {  artistD: ad , documentD: dd},
                success: function(result){
                    // console.log(result)
                    localStorage.clear();
                    window.location.href="/company/artist_permits";
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
       }
       else{
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
    })

    $('#permit_from').on('changeDate', function(ev) {
        if($('#permit_from').valid()){
            $('#permit_from').removeClass('invalid').addClass('success');
        }
    });
    $('#dob').on('changeDate', function(ev) {
        if($('#dob').valid()){
            $('#dob').removeClass('invalid').addClass('success');
        }
    });
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


        const getAreas = (city_id) => {
            $.ajax({
                    url:"fetch_areas/"+city_id,
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
            let code = $('#code').val();
            if(code){
                $.ajax({
                    url:"../searchCode/"+code,
                    success: function(data){
                        // console.log(data);
                        if(data) {
                            $('#artistDetailswithcode').val(JSON.stringify(data));
                            $('#ex_artist_en_name').html(data.firstname_en != null ?  data.firstname_en : '' + ' '+data.lastname_en != null ? data.lastname_en : '');
                            $('#ex_artist_ar_name').html(data.firstname_ar != null ?  data.firstname_ar : '' + ' '+data.lastname_ar != null ? data.lastname_ar : '');
                            $('#ex_artist_mobilenumber').html(data.mobile_number);
                            $('#ex_artist_phonenumber').html(data.phone_number);
                            $('#ex_artist_email').html(data.email);
                            $('#profImg').attr('src', data.artist_permit[0].thumbnail_pic ? data.artist_permit[0].thumbnail_pic : '');
                            $('#profImg').css('height', '150px');
                            $('#profImg').css('width', '150px');
                            $('#artist_exists').modal('show');
                        }

                    }
                });
            }

        });

        const setArtistDetails = () => {
            let ad = $('#artistDetailswithcode').val();
            ad = JSON.parse(ad);
            // console.log(ad);
            var dateArray = ad.birthdate.split('-');
            $('#is_old_artist').val(2);
            var newDate = dateArray[2] + "-" + dateArray[1]  +"-"  + dateArray[0];

            $('#code').val(ad.person_code),
            $('#fname_en').val(ad.firstname_en),
            $('#fname_ar').val(ad.firstname_ar),
            $('#lname_en').val(ad.lastname_en),
            $('#lname_ar').val(ad.lastname_ar),
            $('#nationality').val(ad.nationality),
            $('#profession').val(ad.artist_permit[0].profession),
            $('#passport').val(ad.passport_number),
            $('#pp_expiry').val(ad.pp_expiry_date),
            $('#visa_type').val(ad.visa_type),
            $('#visa_number').val(ad.visa_number),
            $('#visa_expiry').val(ad.visa_expiry_date),
            $('#sp_name').val(ad.sponser_name),
            $('#id_no').val(ad.id_no),
            $('#language').val(ad.language),
            $('#religion').val(ad.religion),
            $('#gender').val(ad.gender),
            $('#city').val(ad.emirate);
            getAreas(ad.emirate);
            $('#address').val(ad.address),
            $('#uid_number').val(ad.uid_number),
            $('#uid_expiry').val(ad.uid_expiry_date),
            $('#dob').val(newDate),
            $('#landline').val(ad.phone_number),
            $('#mobile').val(ad.mobile_number),
            $('#email').val(ad.email);
            $('#artist_permit_num').val(ad.artist_permit[0].artist_permit_id);
            $('#area').val(ad.area);
            PicUploadFunction();
            uploadFunction();
        }


</script>

<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>

@endsection
