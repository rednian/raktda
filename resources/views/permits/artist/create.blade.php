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

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Accordion-->
                            </div>



                        </div>

                        <!--end: Form Wizard Step 1-->

                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md"> Permit Details</div>


                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">

                                    <form id="permit_details" method="POST">
                                        <div class="row">
                                            <div class="form-group col-3">
                                                <label>From Date</label>
                                                <input type="text" class="form-control date-picker" name="permit_from"
                                                    id="permit_from" data-date-start-date="+0d" placeholder="DD-MM-YYYY"
                                                    onchange="setToDate()" />
                                            </div>


                                            <div class="form-group col-3">
                                                <label>To Date</label>
                                                <input type="text" class="form-control date-picker" name="permit_to"
                                                    id="permit_to" placeholder="DD-MM-YYYY"
                                                    data-date-start-date="+0d" />
                                            </div>



                                            <div class="form-group col-3">
                                                <label>Work Location</label>
                                                <input type="text" class="form-control" placeholder="Work Location"
                                                    name="work_loc" id="work_loc" />
                                            </div>

                                            <div class="form-group col-3">
                                                <label>Connected Event ?</label>
                                                <div class="kt-radio-inline pt-2">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="radio2"> Yes
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="radio2" checked> No
                                                        <span></span>
                                                    </label>

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
                            <div class="kt-heading kt-heading--md">Artist Details</div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <form id="artist_details">
                                        <input type="hidden" id="artist_number" value={{1}}>
                                        <div class="row">
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
                                            <div class="form-group col-3 w-100 d-flex flex-column">
                                                <label>Nationality</label>
                                                <select type="text" class="form-control" name="nationality"
                                                    id="nationality">
                                                    {{-- select2  - class for search in select  --}}
                                                    <option value="">Select</option>
                                                    @foreach ($countries as $ct)
                                                    <option value={{$ct}}>{{$ct}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-3">
                                                <label>Profession</label>
                                                <select class="form-control " name="profession" id="profession"
                                                    placeholder="Profession">
                                                    @foreach ($permitTypes as $pt)
                                                    <option value=" ">Select</option>
                                                    <option value="{{$pt->permit_type_id}}">{{$pt->name_en}}</option>
                                                    @endforeach
                                                </select>
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
                                                    placeholder="DD-MM-YYYY" data-date-end-date="0d" name="dob"
                                                    id="dob" />
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
                                <input type="hidden" id="requirements_count" value={{count($requirements)}}>
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



@endsection


@section('script')

<script>
    var fileUploadFns = [];
    var artistDetails = new Object();
    var documentDetails = new Object();

    $(document).ready(function(){


        localStorage.clear();
        // upload file
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
                multiple: false,
                maxFileCount:1,
                showDelete: true,
                formData: {id: i, reqName: $('#req_name_'+i).val() , artistNo: $('#artist_number').val()},
            });
            $('#fileuploader_'+i+' div').attr('id', 'ajax-upload_'+i);
            $('#fileuploader_'+i+' + div').attr('id', 'ajax-file-upload_'+i);
        }


        $('.reqName').tooltip();
        //clear the temp
        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url:"{{route('clear_the_temp')}}"
        });
    });


    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");
        $('#prev_btn').css('display', 'block'); // to make the prev button display
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
                    nameEn: $('#name_en').val(),
                    nameAr:  $('#name_ar').val(),
                    nationality: $('#nationality').val(),
                    profession: $('#profession').val(),
                    passport: $('#passport').val(),
                    uidNumber: $('#uid_number').val(),
                    dob: $('#dob').val(),
                    telephone: $('#telephone').val(),
                    mobile: $('#mobile').val(),
                    email: $('#email').val(),
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

        if(hasFileArray.includes(false)){
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

        var pd = localStorage.getItem('permitDetails');
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
                data: { permitD: pd, artistD: ad , documentD: dd},
                success: function(result){
                    // console.log(result)
                    localStorage.clear();
                    window.location.href="/company/artist_permits";
                }
            });
        }

    })


    const startToFront = () => {
        var hasFile = docValidation();
        if(documentsValidator.form() && hasFile)
        {
            for(var i = 1; i <= $('#requirements_count').val(); i++)
            {
                fileUploadFns[i].reset();
            }
            $('#artist_details')[0].reset();
            $('#documents_required')[0].reset();
            $('#submit_btn').css('display', 'none');
            $('#next_btn').css('display', 'block');
            $('#addNew_btn').css('display', 'none');

            var old_artist_id = $('#artist_number').val();
            var new_artist_id = parseInt(old_artist_id) + 1 ;
            $('#artist_number').val(new_artist_id);

            wizard = new KTWizard("kt_wizard_v3");
            wizard.goTo(3);
        }
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

    const setToDate= () => {
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

    var permitValidator = $('#permit_details').validate({
        rules: {
            permit_from: {
                required: true,
            },
            permit_to: {
                required: true,
            },
            work_loc: {
                required: true
            }
        },
        messages: {
            permit_from: {
                required: 'This field is required',
            },
            permit_to: {
                required: 'This field is required',
            },
            work_loc: {
                required: 'This field is required'
            }
        }

    });


    var detailsValidator =  $('#artist_details').validate({
            rules: {
                name_en: 'required',
                nationality: 'required',
                passport: 'required',
                uid_number: 'required',
                dob: 'required',
                telephone: {
                    number: true,
                    required : true
                } ,
                profession: 'required',
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
                name_en: 'This field is required',
                nationality: 'This field is required',
                passport: 'This field is required',
                uid_number: 'This field is required',
                dob: 'This field is required',
                telephone: {
                    required: 'This field is required',
                    number: 'Must be a Number'
                },
                profession: 'This field is required',
                mobile: {
                    number: 'Please enter number',
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


        // var documentValidator = $('#').validate({
        //     rules: {
        //         doc_issue_date_1: 'required'
        //     },
        //     messages:{

        //     }
        // });






        // let permit_type = $('#permit_type').val();
        // let from_date = $('#permit_from').val();
        // let to_date = $('#permit_to').val();
        // let name_en =  $('#name_en').val();
        // let name_ar =  $('#name_ar').val();
        // let nationality = $('#artist_nationality').val();
        // let passport =  $('#passport]').val();
        // let uid =  $('#uid_number]').val();
        // let dob =  $('#dob]').val();
        // let telephone =  $('#telephone]').val();
        // let mobile =  $('#mobile]').val();
        // let email =  $('#email]').val();
        // let profession =  $('#profession]').val();

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




    // const add_new_row = () => {
    //     let num = $('.doc_row').siblings().length;
    //     let next_num = num + 2 ;
    //    $('#document_row').append('<div class="row" id="row_'+next_num+'"><div class="form-group col-3"> <select type="text" class="form-control" name="doc_type[]" id="doc_type_'+next_num+'" onchange="isExpiry('+next_num+')" required> <option value="">Select Document Type</option> <option value="passport">Passport</option> <option value="visa">Visa</option> <option value="photograph">Photograph</option> <option value="medical">Medical Certificate</option> </select> </div> <div class="form-group col-4"> <div class="custom-file"> <input type="file" class="custom-file-input"  name="doc_file[]" id="doc_file_'+next_num+'"> <label class="custom-file-label" for="customFile">Choose file</label> </div> </div>   <div class="form-group col-2"> <input type="text" class="form-control date-picker" name="doc_issue_date[]" id="doc_issue_date_'+next_num+'" placeholder="Issue Date" required/> </div><div class="form-group col-2"><input type="text" class="form-control date-picker" name="doc_exp_date[]" id="doc_exp_date_'+next_num+'" placeholder="Expiry Date"> </div><i class="fa fa-trash " onclick="del_row('+next_num+')" style="color:red;margin:10px auto;"></i></div>');
    //    $('.date-picker').datepicker({
    //         format: 'mm/dd/yyyy',
    //     });

    // }



</script>

<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
<script async src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>

@endsection
