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
                            {{-- <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#"
                                style="flex: 0 0 17%;">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>6</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div> --}}
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

                        <form action="{{route('company.apply_artist_permit')}}" method="POST"
                            enctype="multipart/form-data">
                            {{csrf_field()}}


                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                <div class="kt-heading kt-heading--md">Artist Permit Details</div>


                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form">
                                        <div class="row">

                                            <div class="form-group col-3">
                                                <label>Artist Type</label>
                                                <select type="text" class="form-control " name="permit_type"
                                                    id="permit_type">
                                                    <option value="">Select</option>
                                                    @foreach ($profession as $pf)
                                                    <option value={{$pf->artist_type_id}}>{{$pf->artist_type_en}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-3">
                                                <label>From Date</label>
                                                <input type="text" class="form-control date-picker" name="permit_from"
                                                    id="permit_form" data-date-start-date="+0d"
                                                    placeholder="MM/DD/YY" />
                                            </div>


                                            <div class="form-group col-3">
                                                <label>To Date</label>
                                                <input type="text" class="form-control date-picker" name="permit_to"
                                                    id="permit_to" placeholder="MM/DD/YY" data-date-start-date="+0d" />
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Artist Name - EN</label>
                                                <input type="text" class="form-control" name="name_en" id="name_en"
                                                    placeholder="Artist Name - EN">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Artist Name - AR</label>
                                                <input type="text" class="form-control" name="name_ar" id="name_ar"
                                                    placeholder="Artist Name - AR">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Nationality</label>
                                                <select type="text" class="form-control" name="nationality"
                                                    id="nationality">
                                                    <option value="">Select</option>
                                                    @foreach ($countries as $ct)
                                                    <option value={{$ct}}>{{$ct}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Profession</label>
                                                <input type="text" class="form-control" placeholder="Profession"
                                                    name="profession" id="profession" />
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Passport Number</label>
                                                <input type="text" class="form-control" name="passport" id="passport"
                                                    placeholder="Passport Number">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>UID Number</label>
                                                <input type="text" class="form-control" name="uid_number"
                                                    id="uid_number" placeholder="UID Number">
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Date of Birth</label>
                                                <input type="text" class="form-control date-picker"
                                                    placeholder="MM/DD/YYYY" name="dob" id="dob" />
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Telephone Number</label>
                                                <input type="text" class="form-control" name="telephone" id="telephone"
                                                    placeholder="Telephone Number">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" name="mobile" id="mobile"
                                                    placeholder="Mobile Number">
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Email</label>
                                                <input type="text" class="form-control" placeholder="Email" name="email"
                                                    id="email" />
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Work Location</label>
                                                <input type="text" class="form-control" placeholder="Work Location"
                                                    name="work_loc" id="work_loc" />
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
                                        <div class="btn btn-warning btn-sm" onclick="add_new_row()"> + Add
                                            New</div>
                                    </span>
                                </div>

                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form" id="document_row">
                                        <div class="row doc_row" id="row_1">
                                            <div class="form-group col-3">
                                                <select type="text" class="form-control" name="doc_type[]"
                                                    id="doc_type_1" onchange="isExpiry(1)" required>
                                                    <option value="">Select Document Type</option>
                                                    <option value="passport">Passport</option>
                                                    <option value="visa">Visa</option>
                                                    <option value="photograph">Photograph</option>
                                                    <option value="medical">Medical Certificate</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <input type="file" class="form-control" name="doc_file[]"
                                                    id="doc_file_1" placeholder="" required />
                                            </div>
                                            <div class="form-group col-2">
                                                <input type="text" class="form-control date-picker"
                                                    name="doc_issue_date[]" id="doc_issue_date_1"
                                                    placeholder="Issue Date" />
                                            </div>
                                            <div class="form-group col-2">
                                                <input type="text" class="form-control date-picker"
                                                    name="doc_exp_date[]" id="doc_exp_date_1"
                                                    placeholder="Expiry Date" />
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="d-flex justify-content-center">
                                    <button
                                        class="btn btn-success mb-5 btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                        type="submit" id="submit_btn" style="display:none;">
                                        Submit
                                    </button>
                                </div>

                            </div>


                        </form>



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



                        <div class="kt-form__actions">
                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev" id="prev_btn">
                                Previous
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



@endsection


@section('script')

<script>
    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
        $('#prev_btn').css('display', 'block');
       if(wizard.currentStep == 2){
            $('#submit_btn').css('display', 'block');
            $('#next_btn').css('display','none');
       }else{
            $('#submit_btn').css('display', 'none');
            $('#next_btn').css('display', 'block');
       }
    });

    $('#prev_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
        console.log(wizard.currentStep);
       if(wizard.currentStep == 2){
            $('#prev_btn').css('display', 'none');
       }else{
            $('#prev_btn').css('display', 'block');
            $('#next_btn').css('display', 'block');
       }
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

    const add_new_row = () => {
        let num = $('.doc_row').siblings().length;
        let next_num = num + 2 ;
       $('#document_row').append('<div class="row" id="row_'+next_num+'"><div class="form-group col-3"> <select type="text" class="form-control" name="doc_type[]" id="doc_type_'+next_num+'" onchange="isExpiry('+next_num+')" required> <option value="">Select Document Type</option> <option value="passport">Passport</option> <option value="visa">Visa</option> <option value="photograph">Photograph</option> <option value="medical">Medical Certificate</option> </select> </div> <div class="form-group col-4">  <input type="file" class="form-control" name="doc_file[]" id="doc_file_'+next_num+'" placeholder="" required> </div>   <div class="form-group col-2"> <input type="text" class="form-control date-picker" name="doc_issue_date[]" id="doc_issue_date_'+next_num+'" placeholder="Issue Date" required/> </div><div class="form-group col-2"><input type="text" class="form-control date-picker" name="doc_exp_date[]" id="doc_exp_date_'+next_num+'" placeholder="Expiry Date"> </div><i class="fa fa-trash " onclick="del_row('+next_num+')" style="color:red;margin:10px auto;"></i></div>');
       $('.date-picker').datepicker({
        format: 'mm/dd/yyyy',
    });

    }

    $('.date-picker').datepicker({
        format: 'mm/dd/yyyy',
    });

    const del_row = (id) => {
        $('#row_'+id).remove();
    }


    // $("#submit_btn").bind("click", (e) => {
    //     e.preventDefault();

    //     $('form[id="artist_permit_form"]').validate({
    //         rules: {
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
            //     doc_type_1: 'required',
            //     doc_file_1: 'required',
            //     doc_exp_date_1: 'required'
            // },
            // messages: {
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
    //             doc_type_1: 'This field is required',
    //             doc_file_1: 'This field is required',
    //             doc_exp_date_1: 'This field is required',
    //         },
    //         submitHandler: function(form) {}
    // });

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

        // let doc_type = $('select[id][name="artist_upload_doc_type"]').val();
        // let doc_file = $('input[name="artist_upload_doc_file"]')[0].files ;
        // let doc_exp_date = $('input[name="artist_upload_doc_exp_date"]').val();


        // let doc_type = $('#doc_type_1').val();
        // let doc_file = $('#doc_file_1')[0].files[0] ;
        // let doc_exp_date = $('#doc_exp_date_1').val();

        // let fileData = new FormData();
        // fileData.append(doc_file.name,doc_file);


        // console.log(doc_type, fileData, doc_exp_date);

        // return


        // $.ajax({
        //     headers: {
        //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
        //         "content"
        //     )
        // },
        // type: "POST",
        // url: '/company/apply_artist_permit',
        // // dataType: 'application/json',
        // processData:false,
        // data: {
        //     doc_type:doc_type, doc_file:fileData, doc_exp_date:doc_exp_date
        // },
        // success: function(data) {
        //     console.log(data);
        // }
        // });
    // });




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


<script async src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>

@endsection
