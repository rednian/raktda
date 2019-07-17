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
Make Payment
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

                    <div class="kt-form w-100 p-5" id="kt_form">

                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                            data-ktwizard-state="current">
                        </div>

                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        </div>

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


    $('.date-picker').datepicker({
        format: 'mm/dd/yyyy',
    });

    const del_row = (id) => {
        $('#row_'+id).remove();
    }

    $(document).ready(function(){
        wizard = new KTWizard("kt_wizard_v3",{
            startStep: 4
        });
    })


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

<link href={{'../../assets/css/demo1/pages/general/wizard/wizard-3.css'}} rel="stylesheet" type="text/css" />
<script src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>

@endsection
