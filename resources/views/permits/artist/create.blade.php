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
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
                <div class="kt-grid__item">
                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v3__nav">
                        <div class="kt-wizard-v3__nav-items" role="tablist">
                            <a class="kt-wizard-v3__nav-item " data-ktwizard-type="step" href="#"
                                data-ktwizard-state="current">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>1</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>2</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>3</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>4</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>5</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            {{-- <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#" style="flex: 0 0 17%;">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>6</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a> --}}
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
                            <div class="kt-heading kt-heading--md">Instructions
                            </div>
                            <div class="kt-form__section kt-form__section--first mb-5">

                                <!--begin::Accordion-->
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                    <div class="card">
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne6"
                                                aria-expanded="true" aria-controls="collapseOne6">
                                                <i class="flaticon-pie-chart-1"></i> Artist Details Required
                                            </div>
                                        </div>
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo6" aria-expanded="false"
                                                aria-controls="collapseTwo6">
                                                <i class="flaticon2-notification"></i> Documents Required
                                            </div>
                                        </div>
                                        <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseThree6" aria-expanded="false"
                                                aria-controls="collapseThree6">
                                                <i class="flaticon2-chart"></i> Permit Fees Structure
                                            </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Accordion-->
                            </div>



                        </div>

                        <!--end: Form Wizard Step 1-->

                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Artist Permit Details</div>

                            <form id="artist_permit_form" name="artist_permit_form" enctype="multipart/form-data">

                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form">
                                        <div class="row">

                                            <div class="form-group col-3">
                                                <label>Artist Type</label>
                                                <select type="text" class="form-control " name="artist_type"
                                                    id="artist_type">
                                                    <option value="">Select</option>
                                                    @foreach ($profession as $pf)
                                                    <option value={{$pf->artist_type_id}}>{{$pf->name_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-3">
                                                <label>From Date</label>
                                                <input type="text" class="form-control date-picker"
                                                    name="artist_permit_from" id="artist_permit_form"
                                                    data-date-start-date="+0d" placeholder="MM/DD/YY" />
                                            </div>


                                            <div class="form-group col-3">
                                                <label>To Date</label>
                                                <input type="text" class="form-control date-picker"
                                                    name="artist_permit_to" id="artist_permit_to" placeholder="MM/DD/YY"
                                                    data-date-start-date="+0d" />
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Artist Name - EN</label>
                                                <input type="text" class="form-control" name="artist_name_en"
                                                    id="artist_name_en" placeholder="Artist Name - EN">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Artist Name - AR</label>
                                                <input type="text" class="form-control" name="artist_name_ar"
                                                    id="artist_name_ar" placeholder="Artist Name - AR">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Nationality</label>
                                                <select type="text" class="form-control" name="artist_nationality"
                                                    id="artist_nationality">
                                                    <option value="">Select</option>
                                                    @foreach ($countries as $ct)
                                                    <option value={{$ct}}>{{$ct}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Profession</label>
                                                <input type="text" class="form-control" placeholder="Profession"
                                                    name="artist_profession" id="artist_profession" />
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Passport Number</label>
                                                <input type="text" class="form-control" name="artist_passport"
                                                    id="artist_passport" placeholder="Passport Number">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>UID Number</label>
                                                <input type="text" class="form-control" name="artist_uid_number"
                                                    id="artist_uid_number" placeholder="UID Number">
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Date of Birth</label>
                                                <input type="text" class="form-control date-picker"
                                                    placeholder="MM/DD/YYYY" name="artist_dob" id="artist_dob" />
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Telephone Number</label>
                                                <input type="text" class="form-control" name="artist_telephone"
                                                    id="artist_telephone" placeholder="Telephone Number">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" name="artist_mobile"
                                                    id="artist_mobile" placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Email"
                                                    name="artist_email" id="artist_email" />
                                            </div>

                                        </div>


                                    </div>
                                </div>
                        </div>

                        <!--end: Form Wizard Step 2-->

                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Upload Necessary Documents
                                <span class="float-right">
                                    <button class="btn btn-warning btn-sm" onclick="add_new_row()"> + Add
                                        New</button>
                                </span>
                            </div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form" id="document_row">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <select type="text" class="form-control" name="artist_upload_doc_type"
                                                id="doc_type_1">
                                                <option value="passport" selected>Passport</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="file" class="form-control" name="artist_upload_doc_file"
                                                id="doc_file_1" placeholder="">
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="text" class="form-control date-picker"
                                                name="artist_upload_doc_exp_date" id="doc_exp_date_1"
                                                placeholder="Expiry">
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="form-group col-4">
                                            <select type="text" class="form-control" name="artist_upload_doc_type[]"
                                                id="doc_type_1">
                                                <option value="visa" selected>Visa</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="file" class="form-control" name="artist_upload_doc_file[]"
                                                id="doc_file_1" placeholder="">
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="text" class="form-control date-picker"
                                                name="artist_upload_doc_exp_date[]" id="doc_exp_date_1"
                                                placeholder="Expiry">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <select type="text" class="form-control" name="artist_upload_doc_type[]"
                                                id="doc_type_1">
                                                <option value="photograph" selected>Photograph</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="file" class="form-control" name="artist_upload_doc_file[]"
                                                id="doc_file_1" placeholder="">
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <select type="text" class="form-control" name="artist_upload_doc_type[]"
                                                id="doc_type_1">
                                                <option value="medical" selected>Medical Certificate
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <input type="file" class="form-control" name="artist_upload_doc_file[]"
                                                id="doc_file_1" placeholder="">
                                        </div>

                                    </div> --}}

                                </div>

                                <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                    id="submit_btn">
                                    Submit
                                </div>
                            </div>




                            <!--end: Form Wizard Step 3-->

                            <!--begin: Form Wizard Step 4-->
                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Permit Request Applied Successfully
                                </div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form">
                                        <div class="form-group">
                                            <label>Permit Details</label>
                                            <div class="kt-card">
                                                <h2>Artist Name and details</h2>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <!--end: Form Wizard Step 4-->

                            <!--begin: Form Wizard Step 5-->
                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Make Payment
                                </div>
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__review">
                                        <div class="kt-wizard-v3__review-item">
                                            <div class="kt-wizard-v3__review-title">
                                                Permit ID
                                            </div>
                                            <div class="kt-wizard-v3__review-content">
                                                Address Line 1<br />
                                                Address Line 2<br />
                                                Melbourne 3000, VIC, Australia
                                                and Other Details on the Permit
                                            </div>
                                            <div class="kt-wizard-v3__review-content kt-heading">
                                                Total Payable Amount: AED 195
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 5-->

                            <!--begin: Form Wizard Step 5-->
                            {{-- <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
            <div class="kt-heading kt-heading--md">Permit Issued Successfully
            </div>
            <div class="kt-form__section kt-form__section--first">
                <div class="kt-wizard-v3__review">
                    <div class="kt-wizard-v3__review-item">
                        <div class="kt-wizard-v3__review-title">
                            Permit ID
                        </div>
                        <div class="kt-wizard-v3__review-content">
                            Address Line 1<br />
                            Address Line 2<br />
                            Melbourne 3000, VIC, Australia
                            and Other Details on the Permit
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}

                            <!--end: Form Wizard Step 5-->

                            <!--begin: Form Actions -->



                            <!--end: Form Actions -->


                        </div>

                        <div class="kt-form__actions">
                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev">
                                Previous
                            </div>

                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-next" id="next_btn">
                                Next Step
                            </div>
                        </div>

                        </form>

                        <!--end: Form Wizard Form-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->

</div>


<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->



@endsection


@section('script')

<script>
    $("#submit_btn").bind("click", (e) => {
        e.preventDefault();

        $('form[id="artist_permit_form"]').validate({
            rules: {
                // artist_type: 'required',
                // artist_permit_from: 'required',
                // artist_permit_to: 'required',
                // artist_name_en: 'required',
                // artist_nationality: 'required',
                // artist_passport: 'required',
                // artist_uid_number: 'required',
                // artist_dob: 'required',
                // artist_telephone: {
                //     number: true,
                //     required : true
                // } ,
                // artist_dob: 'required',
                // artist_profession: 'required',
                // artist_mobile: {
                //     number: true,
                //     required : true
                // } ,
                // artist_email: {
                //     required: true,
                //     email: true,
                // },
                doc_type_1: 'required',
                doc_file_1: 'required',
                doc_exp_date_1: 'required'
            },
            messages: {
                // artist_type: 'This field is required',
                // artist_permit_from: 'This field is required',
                // artist_permit_to: 'This field is required',
                // artist_name_en: 'This field is required',
                // artist_nationality: 'This field is required',
                // artist_passport: 'This field is required',
                // artist_uid_number: 'This field is required',
                // artist_dob: 'This field is required',
                // artist_telephone: 'This field is required',
                // artist_profession: 'This field is required',
                // artist_mobile: 'This field is required',
                // artist_email: 'Enter a valid email',
                doc_type_1: 'This field is required',
                doc_file_1: 'This field is required',
                doc_exp_date_1: 'This field is required',
            },
            submitHandler: function(form) {}
    });

        // let artist_type = $('#artist_type').val();
        // let from_date = $('input[name=artist_permit_from]').val();
        // let to_date = $('input[name=artist_permit_to]').val();
        // let name_en =  $('input[name=artist_name_en]').val();
        // let name_ar =  $('input[name=artist_name_ar]').val();
        // let nationality = $('#artist_nationality').val();
        // let passport =  $('input[name=artist_passport]').val();
        // let uid =  $('input[name=artist_uid_number]').val();
        // let dob =  $('input[name=artist_dob]').val();
        // let telephone =  $('input[name=artist_telephone]').val();
        // let mobile =  $('input[name=artist_mobile]').val();
        // let email =  $('input[name=artist_email]').val();
        // let profession =  $('input[name=artist_profession]').val();

        //artist_type: artist_type, from_date: from_date, to_date: to_date, name_en: name_en, name_ar: name_ar, nationality: nationality, passport: passport, uid: uid, dob: dob, telephone: telephone, mobile: mobile, email: email, profession: profession

        let doc_type = $('select[id][name="artist_upload_doc_type"]').val();
        let doc_file = $('input[name="artist_upload_doc_file"]')[0].files ;
        let doc_exp_date = $('input[name="artist_upload_doc_exp_date"]').val();

        // fileData = new FormData();
        // fileData.append(doc_file.name,doc_file);


        // console.log(doc_type, doc_file, doc_exp_date);

        // return


        $.ajax({

        url: '{{url("/company/apply_artist_permit")}}',
        type: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            )
        },
        dataType: 'application/json',
        data: {
            doc_type:doc_type, doc_file:doc_file, doc_exp_date:doc_exp_date
        },
        processData:false,
        success: function() {

        }
        });
    });

    // const add_new_row = () => {
    //     let num = $('#document_row').length;
    //     let next_num = num + 1 ;
    //    $('#document_row').append('<div class="row" id="row_'+num+'"><div class="form-group col-4"> <label>Document Type</label> <select type="text" class="form-control" name="artist_upload_doc_type[]" id="doc_type_'+next_num+'"> <option value="0">Select</option> <option value="1">Passport</option> <option value="2">Visa</option> <option value="3">Photograph</option> <option value="4">Medical Certificate</option> </select> </div> <div class="form-group col-4"> <label>Upload File</label> <input type="file" class="form-control" name="artist_upload_doc_file[]" id="doc_file_'+next_num+'" placeholder=""> </div> <div class="form-group col-3"> <label>Expiry Date</label> <input type="text" class="form-control date-picker" name="artist_upload_doc_exp_date[]" id="doc_exp_date_'+next_num+'" placeholder="MM/DD/YY"> </div><i class="fa fa-trash " onclick="del_row('+num+')" style="color:red;margin:auto;"></i></div>');
    // }

    $('.date-picker').datepicker({
        format: 'mm/dd/yyyy',
    });

    const del_row = (id) => {

        $('#row_'+id).remove();
    }


    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };



</script>

<link href={{'../assets/css/demo1/pages/general/wizard/wizard-3.css'}} rel="stylesheet" type="text/css" />
<script src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>

@endsection
