@extends('layouts.app')

@section('title', 'Add Event Permit - Smart Government Rak')

@section('style')
<style>
    .dropdown-menu {
        min-width: auto !important;
    }
</style>
@endsection

{{-- {{dd(session(Auth::user()->user_id . '_image_file'))}} --}}

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->flush())}} --}}
{{-- {{dd(session()->all())}} --}}
@php
// $user_id = Auth::user()->user_id;
// session()->forget($user_id . '_image_size');
// session()->forget($user_id . '_image_file');
// session()->forget($user_id . '_image_ext');
// session()->forget($user_id . '_image_thumb');
// dd(session()->all())
@endphp

<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->

                @include('permits.event.common.nav')

                <!--end: Form Wizard Nav -->
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="kt-form__section kt-form__section--first">
                            <!--begin::Accordion-->
                            @include('permits.event.common.common-instructions')
                            {{-- <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                                    id="permit-instruction-details">
                                    <div class="card">
                                        <div class="card-header" id="headingFour6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseFour6" aria-expanded="false"
                                                aria-controls="collapseFour6">
                                                <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">
                                                    {{__('Rules and Conditions')}}</h6>
                        </div>
                    </div>
                    <div id="collapseFour6" class="collapse show" aria-labelledby="headingFour6"
                        data-parent="#permit-instruction-details">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                            terry richardson ad squid. 3 wolf moon officia aute
                        </div>
                    </div>
                </div>
                </section> --}}
                <label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
                    <input type="checkbox" id="agree" name="agree">
                    {{__('I read and understand all service, rules and agree to continue submitting it')}}
                    <span></span>
                </label>
            </div>
        </div>


        @include('permits.event.common.common-event-details')

        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
            <div class="kt-form__section kt-form__section--first ">
                <div class="">
                    @include('permits.components.requirements')
                    <form id="documents_required" method="post">

                    </form>
                    <form id="image_upload_form">
                        <div class="row">
                            <div class="col-lg-4 col-sm-12"><label
                                    class="kt-font-bold text--maroon">{{__('Images')}}</label>
                                <p class="reqName">{{__('Add multiple images')}}</p>
                            </div>
                            <div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label>
                                <div id="image_uploader"></div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>


        <div class="kt-form__actions">
            <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                data-ktwizard-type="action-prev" id="prev_btn">
                {{__('PREVIOUS')}}
            </div>


            <a href="{{URL::signedRoute('event.index')}}#applied">
                <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                    {{__('BACK')}}
                </div>
            </a>

            <div class="btn-group" role="group" id="submit--btn-group">
                <button id="btnGroupDrop1" type="button" class="btn btn--yellow btn-sm dropdown-toggle"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{__('SUBMIT')}}
                </button>
                <div class="dropdown-menu py-0" aria-labelledby="btnGroupDrop1">
                    <button name="submit" class="dropdown-item btn btn-sm btn-secondary" value="finished"
                        id="submit_btn">{{__('Finish & Submit')}}</button>
                    <button name="submit" class="dropdown-item btn btn-sm btn-secondary" value="finished"
                        id="submit_btn_artist">{{__('Submit and Add Artist')}}</button>
                    <button name="submit" class="dropdown-item btn btn-sm btn-secondary" value="drafts"
                        id="draft_btn">{{__('Save as Draft')}}</button>
                </div>
            </div>


            <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                data-ktwizard-type="action-next" id="next_btn">
                {{__('NEXT')}}
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- end:: Content -->

<input type="hidden" id="et_truck_ids">
<input type="hidden" id="et_liquor_id">

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
        <div id="ajax_loader" style="min-height: 100vh;">
            <img src="{{asset('/img/ajax-loader.gif')}}" style="position: absolute; top:50%; left: 50%;">
        </div>
    </div>
</div>

<!--begin::Modal-->






@include('permits.event.common.show_warning_modal', ['day_count' => getSettings()->event_start_after]);

@include('permits.event.common.sure_to_remove');

@include('permits.event.common.edit_food_truck', ['truck_req'=>$truck_req])
@include('permits.event.common.liquor',['liquor_req'=>$liquor_req])


@endsection

@section('script')

<script src="{{asset('js/company/artist.js')}}"></script>
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/map.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6nhSpjNed-wgUyVMJQZJTRniW-Oj_Tgw&libraries=places{{getlangId() == 2 ? '&language=ar' : ''}}&callback=initialize"
    async defer></script>
{{--  --}}
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    var docRules = {};
    var docMessages = {};
    let documentNames = {};
    var documentsValidator ;
    var picUploader ;
    var truckDocUploader = [];
    var liquorDocUploader = [];
    var liquorDocDetails = {};
    var truckDetails = {};
    var truckDocDetails = {};
    var liquorDetails = {};
    var liquorNames = {};
    var truckDocNames = {};
    var truckDocumentsValidator ;
    // var liquorDocumentsValidator ;


    $(document).ready(function(){

        $('input[dir=rtl],textarea[dir=rtl]').keyup(function(e){
            return false;
            var regex = RegExp('^[\u0621-\u064A\u0660-\u0669\s0-9]+$');
            return regex.test($(this).val()) ? true : false;
        });

        setWizard();
        localStorage.clear();
        uploadFunction();
        picUploadFunction();
        imageUploadFunction();
        $.ajax({
            url: "{{route('event.forgotEventPicsSession')}}",
            type: "POST",
            success: function(){}
        })

        $('#event_id').val(0);

        $('#add_document_btn').css('display', 'none');
        $('#how_many_div').css('display', 'none');
        $('#submit--btn-group').css('display', 'none');
        $('#added_documents').hide();

        $('#truckEditBtn').hide();
        $('#liquorEditBtn').hide();

        $('#liquor_provided_form').hide();
        $('#liquor_provided_upload_form').hide();
        $('#limited_types').hide();



    });



    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('event.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    // acceptFiles: "image/*",
                    fileName: "doc_file_" + i,
                    showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    returnType: "json",
                    showProgress: false,
                    showFileCounter: false,
                    duplicateErrorStr: 'No duplicate files allowed',
                    maxFileSize: 5242880,
                    multiple: true,
                    dragDrop: true,
                    abortStr: '',
                    maxFileCount: 5,
                    showDelete: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
                    onSuccess: function (files, response, xhr, pd) {
                        //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    onLoad:function(obj)
                    {
                        $.ajax({
                            url: "{{route('event.removeUploadedDocumentInSession')}}",
                            type: 'POST',
                            data: {reqId: $('#req_id_' + i).val()},
                            success: function(data)
                            {
                            }
                        });
                    },
                    onError: function (files, status, errMsg, pd) {
                        showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                        pd.statusbar.hide();
                    },
                    downloadCallback: function (files, pd) {
                        let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteUploadedfile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: data.id},
                            success: function (result) {
                                console.log('success');
                            }
                        });
                    }
                });
                $('#fileuploader_' + i + ' div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
            }
        };



        const picUploadFunction = () => {
            picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('event.uploadLogo')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileCounter: false,
                abortStr: '',
                maxFileSize: 5242880,
                downloadStr: `<i class="la la-download"></i>`,
                showProgress: false,
                // previewHeight: '100px',
                // previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showDownload: true,
                // showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                // onSuccess: function (files, response, xhr, pd) {
                //     pd.filename.html('');
                // },
                deleteCallback: function(data, pd) // Delete function must be present when showDelete is set to true
				{
					$.ajax({
							cache: false,
							url: "{{route('event.delete_logo_in_session')}}",
							type: 'POST',
							success: function (data) {

							}
					});
				},
                downloadCallback: function (files, pd) {
                        let file_path = files.filepath;
                        let path = file_path.replace('public/','');
                        window.open(
                    "{{url('storage')}}"+'/' + path,
                    '_blank'
                    );
                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
        };


        var eventValidator = $('#eventdetails').validate({
            ignore: [],
            rules: {
                event_type_id: 'required',
                name_en: 'required',
                name_ar: 'required',
                issued_date: {
                    required: true,
                    dateNL: true
                },
                street: 'required',
                description_en: 'required',
                description_ar: 'required',
                // time_start: 'required',
                venue_en: 'required',
                area_id: 'required',
                longitude: 'required',
                latitude: 'required',
                expired_date: {
                    required: true,
                    dateNL: true
                },
                // time_end: 'required',
                venue_ar: 'required',
                address: 'required',
                firm_type: 'required',
                no_of_audience: 'required',
                owner_name: 'required',
                owner_name_ar: 'required',
            },
            messages: {
                event_type_id: '',
                name_en: '',
                name_ar: '',
                issued_date: '',
                // time_start: '',
                street: '',
                description_en: '',
                description_ar: '',
                area_id: '',
                longitude: '',
                latitude: '',
                venue_en: '',
                expired_date: '',
                time_end: '',
                venue_ar: '',
                address: '',
                firm_type: '',
                no_of_audience:'',
                owner_name:'',
                owner_name_ar: '',
            },
        });

        $("#check_inst").on("click", function () {
            setThis('none', 'block', 'block', 'none');
        });

        $("#event_det").on("click", function () {
            if (!checkForTick()) {
                return
            }
            setThis('block', 'block', 'none', 'none');
        });

        $("#upload_doc").on("click", function () {
            wizard = new KTWizard("kt_wizard_v3");
            !checkForTick() ? wizard.stop : '';
            wizard.currentStep == 2 ? stopNext(eventValidator): "";
            eventValidator.form() ? setThis('block', 'none', 'none', 'block') : '';
        });

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit--btn-group').css('display', submit);
        };

        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result;
            if ($('#agree').not(':checked')) {
                wizard.stop();
                $('#agree_cb > span').addClass('compulsory');
                result = false;
            }
            if ($('#agree').is(':checked')) {
                $('#back_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                $('#agree_cb > span').removeClass('compulsory');
                wizard.goNext();
                result = true;
            }
            return result;
        };


        $('#next_btn').click(function () {

        wizard = new KTWizard("kt_wizard_v3");

        checkForTick();
        // checking the next page is artist details
        if (wizard.currentStep == 2) {
            stopNext(eventValidator);
            KTUtil.scrollTop();// validating the artist details page
            if (eventValidator.form()) {
                $('#next_btn').css('display', 'none'); // hide the next button
                $('#submit--btn-group').css('display', 'block');
                eventdetails = {
                    event_type_id: $('#event_type_id').val(),
                    name: $('#name_en').val(),
                    name_ar: $('#name_ar').val(),
                    issued_date: $('#issued_date').val(),
                    time_start: '',
                    venue_en: $('#venue_en').val(),
                    expired_date: $('#expired_date').val(),
                    time_end: '',
                    venue_ar: $('#venue_ar').val(),
                    address: $('#address-input').val(),
                    emirate_id: $('#emirate_id').val(),
                    longitude: $('#longitude').val(),
                    latitude: $('#latitude').val(),
                    area_id: $('#area_id').val(),
                    country_id: $('#country_id').val(),
                    street: $('#street').val(),
                    description_en: $('#description_en').val(),
                    description_ar: $('#description_ar').val(),
                    full_address: $('#full_address').val(),
                    firm_type: $('#firm_type').val(),
                    isTruck: $("input:radio[name='isTruck']:checked").val(),
                    isLiquor: $("input:radio[name='isLiquor']:checked").val(),
                    no_of_audience: $('#no_of_audience').val(),
                    owner_name: $('#owner_name').val(),
                    owner_name_ar: $('#owner_name_ar').val(),
                    addi_loc_info: $('#addi_loc_info').val(),
                    event_sub_type_id: $('#event_sub_type_id').val()
                };

                localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }
        });


        const docValidation = () => {

            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#requirements_count').val();
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++)
                {
                    let children = $('#ajax-file-upload_' + i).children();
                    let fileNames = Object.keys(children).map(function(key){
                        return children[key].innerText != undefined ? children[key].innerText : '';
                    });

                    if ($('#ajax-file-upload_' + i).length) {

                        if ($('#ajax-file-upload_' + i).contents().length == 0) {
                            if($('#eventReqIsMandatory_'+i).val() == 1)
                            {
                                hasFileArray[i] = false;
                                    $("#ajax-upload_" + i).css('border', '2px dotted red');
                            }
                        } else {
                            hasFileArray[i] = true;
                            $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                        }

                        documentDetails[i] = {
                            issue_date: $('#doc_issue_date_' + i).val(),
                            exp_date: $('#doc_exp_date_' + i).val()
                        }
                        documentNames[i] = {
                            reqId: $('#req_id_'+i).val(),
                            fileNames
                        }
                    }
                }

            }

            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            // if(no_of_trucks*per_truck_doc != $('#added_documents > div').length)
            // {
            //     alert('Upload the Foodtruck Required Docs');
            //     return ;
            // }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
            localStorage.setItem('documentNames', JSON.stringify(documentNames));
            return hasFile;

        }

        const stopNext = (validator_name) => {
            wizard.on("beforeNext", function (wizardObj) {
                if (validator_name.form() !== true) {
                    wizardObj.stop(); // don't go to the next step
                }
            });
        };

        $('#prev_btn').click(function () {
            wizard = new KTWizard("kt_wizard_v3");
            if (wizard.currentStep == 2) {
                $('#prev_btn').css('display', 'none');
                $('#back_btn').css('display', 'block');
            } else {
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            }
            $('#submit--btn-group').css('display', 'none');
        });

        $('#issued_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '+1d',
            orientation: "bottom left",
            @if(getLangId() == 2)
            language: 'ar'
            @endif
        });
        $('#expired_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
            @if(getLangId() == 2)
            language: 'ar'
            @endif
        });

        // $('#time_start').timepicker();
        // $('#time_end').timepicker();

        $('#issued_date').on('changeDate', function (selected) {
            $('#issued_date').valid() || $('#issued_date').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            // var expDate = moment(minDate, 'DD-MM-YYYY').add(1,'month').subtract(1, 'day');
            var expDate = moment(minDate, 'DD-MM-YYYY').add(1,'day');
            $('#expired_date').datepicker('setStartDate', minDate);
            // $('#expired_date').datepicker('setEndDate', expDate.format("DD-MM-YYYY"));
            $('#expired_date').val(expDate.format("DD-MM-YYYY")).datepicker('update');
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });


        const getAreas = (city_id) => {
          if(city_id){
            $.ajax({
                url: "{{url('company/fetch_areas')}}" + '/' + city_id,
                success: function (result) {
                    // console.log(result)
                    $('#area_id').empty();
                    $('#area_id').append('<option value="">Select</option>');
                    for (let i = 0; i < result.length; i++) {
                        $('#area_id').append('<option value="' + result[i].id + '">' + result[i].area_en + '</option>');

                    }
                }
            });
          }

        };

        function call_this_to_submit(isArtist = null){
            var hasFile = docValidation();
                if ((documentsValidator != '' ? documentsValidator.form() : 1) &&  hasFile ) {
                    // $('#submit--btn-group #btnGroupDrop1').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');
                    // $('#submit--btn-group').css('pointer-events', 'none');
                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    var dn = localStorage.getItem('documentNames');

                        $.ajax({
                            url: "{{route('event.store')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                                documentN: dn,
                                description: $('#description').val(),
                                from: 'new',
                                artist: isArtist
                            },
                            beforeSend: function() {
                                KTApp.blockPage({
                                    overlayColor: '#000000',
                                    type: 'v2',
                                    state: 'success',
                                    message: '{{__("Please wait...")}}'
                                });
                            },
                            success: function (result) {
                                // if(result.message[0]){
                                //     if(isArtist)
                                //     {
                                //         var hrefUrl = "{{URL::signedRoute('event.add_artist', ':id')}}";
                                //         hrefUrl = hrefUrl.replace(':id', 0);
                                //         window.location.href =  hrefUrl;
                                //     } else
                                //     {
                                //         window.location.href = "{{route('event.index')}}#applied";
                                //     }
                                //     localStorage.clear();
                                // }else {
                                //     window.location.href = "{{route('event.index')}}#applied";
                                // }
                                window.location.replace(result.toURL);
                                localStorage.clear();
                                KTApp.unblockPage();
                            }
                        });
                }
        }

        $('#submit_btn_artist').click(()=>{
            call_this_to_submit(1)
        })

        $('#submit_btn').click((e) => {
            call_this_to_submit();
        });



        $('#draft_btn').click((e) => {
            var hasFile = docValidation();
                if ((documentsValidator != '' ? documentsValidator.form() : 1) && hasFile) {
                    // $('#submit--btn-group #btnGroupDrop1').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

                    // $('#submit--btn-group').css('pointer-events', 'none');

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    var liquor_id = $('#et_liquor_id').val();
                    var truck_ids = $('#et_truck_ids').val();
                    $.ajax({
                        url: "{{route('company.event.add_draft')}}",
                        type: "POST",
                        data: {
                            eventD: ed,
                            documentD: dd,
                            liquorId: liquor_id,
                            description: $('#description').val(),
                            truckIds: truck_ids,
                        },
                        beforeSend: function() {
                            KTApp.blockPage({
                                overlayColor: '#000000',
                                type: 'v2',
                                state: 'success',
                                message: '{{__("Please wait...")}}'
                            });
                        },
                        success: function (result) {
                            if(result.message[0]){
                                // window.location.href = "{{route('event.index')}}#draft";
                                window.location.href = result.toURL;
                                localStorage.clear();
                                KTApp.unblockPage();
                            }
                        }
                    });
                }
        });

        function givWarn()
        {
            var from_date = $('#issued_date').val();
            // var exp_date = $('#expired_date').val();
            let start_days_count = $('#settings_event_start_date').val();
            if(from_date)
            {
                var x = moment(from_date, "DD-MM-YYYY");
                // var y = moment(exp_date, "DD-MM-YYYY");
                var to = moment();

                var from = moment([x.format('YYYY'), x.month(), x.format('DD')]);
                // var to = moment([y.format('YYYY'), y.month(), y.format('DD')]);
                var today = moment([to.format('YYYY'), to.month(), to.format('DD')]);

                var diff = from.diff(today, 'days');

                if(diff <= start_days_count)
                {
                    // alert('It will take 10 days to process the permit');
                    $('#showwarning').modal('show');
                }
            }
        }

        function setSubTypes()
        {
            var langId = $('#getLangid').val();
            var et = $('#event_type_id').val();
            if(et)
            {
                var url = "{{route('event.get_event_sub_types', ':id')}}";
                url = url.replace(':id', et);
                $.ajax({
                url: url ,
                success: function (result) {
                        $('#event_sub_type_id').empty();
                        $('#event_sub_type_id').append('<option value="">{{__('Select')}}</option>');
                        if(result.length > 0){
                            for(var  i = 0; i< result.length;i++)
                            {
                                $('#event_sub_type_id').append('<option value="'+result[i].event_type_sub_id+'">'+(langId == 1 ? capitalizeFirst(result[i].sub_name_en) : result[i].sub_name_ar)+'</option>');
                            }
                            $('select[name="event_sub_type_id"]').rules('add', { required: true, messages: {required:''}});
                            $('#event_sub_type_req').html('*');
                            $('#event_sub_type_id').removeClass('mk-disabled');
                        }else
                        {
                            $('select[name="event_sub_type_id"]').rules("remove"), "required";$('#event_sub_type_id').removeClass('is-invalid');
                            $('#event_sub_type_id').addClass('mk-disabled');
                            $('#event_sub_type_req').html('');
                        }
                    }
                });
            }
        }

        function getRequirementsList()
        {
            var firm = $('#firm_type').val();
            var id = $('#event_type_id').val();
            var langId = $('#getLangid').val();

            if(firm && id){
                $.ajax({
                url: "{{route('company.event.get_requirements')}}",
                type: "POST",
                data: { firm: firm , id: id},
                success: function (result) {
                    $('#documents_required').empty();
                    $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{!!__('Required Documents')!!}</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">{!!__('Event Logo')!!}</label><p class="reqName">{!!__('A image of the event logo/ banner')!!}</p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">{!!__('Upload')!!}</div></div></div><input hidden id="requirements_count"  />');
                 if(result){
                     var res = result;
                     $('#requirements_count').val(res.length);
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+( langId == 1 ? capitalizeFirst(res[i].requirement_name) : res[i].requirement_name_ar )+' <span id="cnd_'+j+'"></span></label><p for="" class="reqName">'+( langId == 1 ? capitalizeFirst(res[i].requirement_description) : displayIfNotNull(res[i].requirement_description_ar) )+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">{!!__('Upload')!!}</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><input type="hidden" id="eventReqIsMandatory_'+j+'" value="'+res[i].event_type_requirements[0].is_mandatory+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold">{!!__('Issued Date')!!}</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold">{!!__('Expiry Date')!!}</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+30d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />');
                         }


                         if(res[i].event_type_requirements[0].is_mandatory == 1)
                         {
                            $('#cnd_'+j).html(' * ');
                            $('#cnd_'+j).removeClass('text-muted').addClass('text-danger');
                            docRules['doc_issue_date_' + j] = 'required';
                            docRules['doc_exp_date_' + j] = 'required';
                            docMessages['doc_issue_date_' + j] = '';
                            docMessages['doc_exp_date_' + j] = '';
                         }else {
                            $('#cnd_'+j).html(' ');
                            $('#cnd_'+j).removeClass('text-danger').addClass('text-muted');
                         }


                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});
                     }
                     uploadFunction();
                     picUploadFunction();
                    documentsValidator = $('#documents_required').validate({
                        rules: docRules,
                        messages: docMessages
                    });
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });
            }
        }



        /* Truck Script */

        function checkTruck(id) {
            var prev = $('#prev_val_isTruck').val();
            if (id == 1) {
               editTruck();
            } else if(id == 0 && prev == 1) {
                $('#notSaveModal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                $('#sure_remove_close').attr('onclick', changeIsTruck());
                $('#fromSection').val('truck');
            }
        }


        function changeIsTruck() {
            if($('#food_truck_list tr').length)
            {
                $('input[name="isTruck"]').filter('[value=1]').prop('checked', true);
            }
            else {
                $('input[name="isTruck"]').filter('[value=0]').prop('checked', true);
            }
        }

        $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "top left"
        });

        $('#regis_issue_date , #regis_expiry_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });



        var truckValidator = $('#truck_details_form').validate({
            rules: {
                company_name_en: 'required',
                company_name_ar: 'required',
                plate_no: 'required',
                food_type: 'required',
                regis_issue_date: 'required',
                regis_expiry_date: 'required'
            },
            messages: {
                company_name_en: '',
                company_name_ar: '',
                plate_no: '',
                food_type: '',
                regis_issue_date: '',
                regis_expiry_date: ''
            }
        });

        function truckDocValidation(){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#truck_document_count').val();
            // var total = parseInt($('#truck_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++)
                {
                    let children = $('#truck-file-upload_' + i).children();
                    let fileNames = Object.keys(children).map(function(key){
                        return children[key].innerText != undefined ? children[key].innerText : '';
                    });

                    if($('#truck-file-upload_'+i).length) {
                        if($('#truck-file-upload_'+i).contents().length === 0)
                        {
                            hasFileArray[i] = false;
                            $('#truck-upload_'+i).css('border', '2px dotted red');
                        } else {
                            hasFileArray[i] = true;
                            $("#truck-upload_" + i).css('border', '2px dotted #A5A5C7');
                        }
                        // truckDocDetails[i] = {
                        //     issue_date: $('#truck_doc_issue_date_' + i).val(),
                        //     exp_date: $('#truck_doc_exp_date_' + i).val()
                        // }

                        truckDocNames[i] = {
                            reqId: $('#truck_req_id_'+i).val(),
                            fileNames
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            // localStorage.setItem('truck_doc_details', JSON.stringify(truckDocDetails));

            return hasFile;
        }

        // var truckDocRules = {};
        // var truckDocMessages = {};

        // for(var i = 1; i <= $('#truck_document_count').val(); i++)
        // {
        //     if($('#truckdatesRequiredCheck_'+i).val() == 1)
        //     {
        //         truckDocRules['truck_doc_issue_date_'+i] = 'required';
        //         truckDocRules['truck_doc_exp_date_'+i] = 'required';
        //         truckDocMessages['truck_doc_issue_date_'+i] = '';
        //         truckDocMessages['truck_doc_exp_date_'+i] = '';
        //     }
        // }

        // var liquorDocRules = {};
        // var liquorDocMessages = {};

        // for(var i = 1; i <= $('#liquor_document_count').val(); i++)
        // {
        //     if($('#liquordatesRequiredCheck_'+i).val() == 1)
        //     {
        //         liquorDocRules['liquor_doc_issue_date_'+i] = 'required';
        //         liquorDocRules['liquor_doc_exp_date_'+i] = 'required';
        //         liquorDocMessages['liquor_doc_issue_date_'+i] = '';
        //         liquorDocMessages['liquor_doc_exp_date_'+i] = '';
        //     }
        // }

        function go_back_truck_list()
        {
            $('#edit_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#edit_one_food_truck').modal('hide');
        }


        function editTruck(){
            // $('#edit_food_truck').modal('show');
            $('#edit_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $.ajax({
                url:  "{{route('event.fetch_truck_details')}}",
                type:'POST',
                data: {},
                success: function (result) {
                    if(result)
                    {
                        $('#food_truck_list').empty();
                        // console.log(result);
                        // $('#edit_food_truck').modal('show');
                        for(var s = 0;s < result.length;s++)
                        {
                            var k = s + 1 ;
                           $('#food_truck_list').append('<tr><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td class="text-right">'+ result[s].company_name_ar+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"> <span onclick="editThisTruck('+result[s].event_truck_id+', '+k+')"><i class="fa fa-pen fnt-16 text-info"></i></span>&emsp;<span id="append_'+s+'"></span></td></tr>');

                           if(result.length > 1){
                               $('#append_'+s+'').append('<span onclick="deleteThisTruck('+result[s].event_truck_id+')"><i class="fa fa-trash fnt-16 text-danger"></i></span>');
                           }

                        }
                        if(result.length > 0)
                        {
                            $('#truckEditBtn').show();
                        }

                    }else {
                        $('#food_truck_list').append('<tr>No Food Truck Added !! Please Add </tr>');
                    }
                }
            });
        }

        function deleteThisTruck(id)
        {
            var url = "{{route('event.delete_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result.status.trim() == 'done')
                    {
                        editTruck();
                        $('#disp_mess').html('<h5 class="text-danger py-2">Food Truck Details Deleted successfully</h5>');
                        setTimeout(function(){ $('#disp_mess').html('');}, 2000)
                    }
                }
            });
        }

        function editThisTruck(id, num)
        {
            var url = "{{route('event.fetch_this_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result)
                    {
                        // console.log(result);
                        $('#edit_food_truck').modal('hide');
                        $('#edit_truck_title').show();
                        $('#add_truck_title').hide();
                        $('#update_this_td').show();
                        $('#add_new_td').hide();
                        $('#edit_one_food_truck').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                        $('#company_name_en').val(result.company_name_en);
                        $('#company_name_ar').val(result.company_name_ar);
                        $('#plate_no').val(result.plate_number);
                        $('#food_type').val(result.food_type);
                        $('#regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#this_event_truck_id').val(result.event_truck_id);
                        $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
                        // truckDocumentsValidator = $('#truck_upload_form').validate({
                        //     rules: truckDocRules,
                        //     messages: truckDocMessages
                        // });
                        truckDocUpload();
                    }
                }
            });
        }

        $('#add_new_truck').click(function(){
            $('#this_event_truck_id').val('');
            $('#edit_one_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#truck_details_form').trigger('reset');
            $('#truck_upload_form').trigger('reset');
            $('#edit_truck_title').hide();
            $('#update_this_td').hide();
            $('#add_truck_title').show();
            $('#add_new_td').show();
            $('#edit_food_truck').modal('hide');
            $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
            // truckDocumentsValidator = $('#truck_upload_form').validate({
            //     rules: truckDocRules,
            //     messages: truckDocMessages
            // });
            truckDocUpload();
        });

        $('#add_new_td').click(function(){
            var hasFile = truckDocValidation();
            if(truckValidator.form() && hasFile)
            {
                var truck_details = {
                    company_name_en: $('#company_name_en').val(),
                    company_name_ar: $('#company_name_ar').val(),
                    plate_no: $('#plate_no').val(),
                    food_type: $('#food_type').val(),
                    regis_issue_date: $('#regis_issue_date').val(),
                    regis_expiry_date: $('#regis_expiry_date').val()
                }
                // var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url: "{{route('event.add_update_truck')}}",
                        type: "POST",
                        data: {
                            event_id: $('#event_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            // truckDocDetails: truckDocDetails,
                            truck_id: ''
                        },
                        success: function (result) {
                            if(result.status.trim() == 'done')
                            {
                                editTruck();
                                $('#edit_one_food_truck').modal('hide');
                                $('#edit_food_truck').modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                    show: true
                                });
                                $('#prev_val_isTruck').val(1);
                                $('#disp_mess').html('<h5 class="text-success py-2">Food Truck details Added successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                            }
                        }
                    });
                }
            }
        });

        $('#update_this_td').click(function(){
            var hasFile = truckDocValidation();
            if(truckValidator.form() && hasFile)
            {
                var truck_details = {
                    company_name_en: $('#company_name_en').val(),
                    company_name_ar: $('#company_name_ar').val(),
                    plate_no: $('#plate_no').val(),
                    food_type: $('#food_type').val(),
                    regis_issue_date: $('#regis_issue_date').val(),
                    regis_expiry_date: $('#regis_expiry_date').val()
                }
                // var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url:  "{{route('event.add_update_truck')}}",
                        type: 'POST',
                        data: {
                            truck_id : $('#this_event_truck_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            truckDocNames: JSON.stringify(truckDocNames),
                            // truckDocDetails: truckDocDetails,
                            eventId: $('#event_id').val()
                        },
                        success: function (result) {
                            if(result.status.trim() == 'done')
                            {
                                editTruck();
                                $('#edit_food_truck').modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                    show: true
                                });
                                $('#edit_one_food_truck').modal('hide');
                                $('#prev_val_isTruck').val(1);
                                $('#disp_mess').html('<h5 class="text-success py-2">Food Truck details updated successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                            }
                        }
                    });
                }
            }
        });

        const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            var total = parseInt($('#truck_additional_doc > div').length);
            for(var i = 1; i <= parseInt(per_truck_doc) + total ;i++){
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    maxFileSize: 5242880,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    formData: {
                        id: i ,
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    downloadCallback: function (files, pd) {
                        let file_path = files.filepath;
                        if(file_path) {
                            let path = file_path.replace('public/','');
                                window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }
                    },
                    onLoad:function(obj)
                    {
                        var ev_tr_id = $('#this_event_truck_id').val();
                        if(ev_tr_id){
                            $.ajax({
                                url: "{{route('event.fetch_this_truck_docs')}}",
                                type: 'POST',
                                data: {
                                    truckId: ev_tr_id,
                                    reqId: $('#truck_req_id_'+i).val(),
                                },
                                dataType: "json",
                                success: function(data)
                                {
                                    if (data) {
                                        let j = 1 ;
                                    for(data of data) {
                                            if(j <= 2 ){
                                            let id = obj[0].id;
                                            let number = id.split("_");
                                            let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                            let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                            const d = data["path"].split("/");
                                            // var cc = d.splice(4,5);
                                            // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                            let docName = d[d.length - 1];
                                            obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                            if (formatted_issue_date != NaN - NaN - NaN) {
                                                $('#truck_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                                $('#truck_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                            }
                                            }
                                        j++;
                                    }
                                    }
                                }
                            });
                        }
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteTruckUploadedfile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: i },
                            success: function (result) {
                            }
                        });
                    }
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
            }
        };





        // script for liquor details


        function checkLiquorVenue(id)
        {
            if(id == 1)
            {
                $('#liquor_provided_form').show();
                $('#liquor_details_form').hide();
                $('#liquor_upload_form').hide();
                $('#liquor_provided_upload_form').show();
            }else if(id == 0) {
                $('#liquor_provided_form').hide();
                $('#liquor_details_form').show();
                $('#liquor_upload_form').show();
                $('#liquor_provided_upload_form').hide();
            }
        }

        function changeLiquorService()
        {
            var service = $('#liquor_service').val();
            if(service == 'limited')
            {
                $('#limited_types').show();
            }else{
                $('#limited_types').hide();
            }
        }

        function changeIsLiquor() {
            if($('#event_liquor_id').val() == '')
            {
                $('input[name="isLiquor"]').filter('[value=0]').prop('checked', true);
            }else {
                $('input[name="isLiquor"]').filter('[value=1]').prop('checked', true);
            }
        }


        var liquorValidator = $('#liquor_details_form').validate({
            rules: {
                l_company_name_en: 'required',
                l_company_name_ar: 'required',
                purchase_receipt: 'required',
                liquor_service: 'required',
            },
            messages: {
                l_company_name_en: '',
                l_company_name_ar: '',
                purchase_receipt: '',
                liquor_service: '',
            }
        });

        var liquorProvidedValidator = $('#liquor_provided_form').validate({
            rules: {
                liquor_permit_no: 'required'
            },
            messages: {
                liquor_permit_no: ''
            }
        })

        function liqourDocValidation(type){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = parseInt($('#liquor_document_count').val());
            // var total = parseInt($('#liquor_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var d = 1; d <= reqCount; d++)
                {
                    let children = $('#liquor-file-upload_' + d).children();
                    let fileNames = Object.keys(children).map(function(key){
                        return children[key].innerText != undefined ? children[key].innerText : '';
                    });

                    if($('#liquor-file-upload_'+d).length) {
                        if($('#liquor-file-upload_'+d).contents().length === 0)
                        {
                            hasFileArray[d] = false;
                            $('#liquor-upload_'+d).css('border', '2px dotted red');
                            if($('#liqour_req_type_'+d).val() == 'provided' && type == 0) {
                                hasFileArray[d] = true;
                                $("#liquor-upload_" + d).css('border', '2px dotted #A5A5C7');
                            }
                        } else {
                            hasFileArray[d] = true;
                            $("#liquor-upload_" + d).css('border', '2px dotted #A5A5C7');
                        }
                        // liquorDocDetails[d] = {
                        //     issue_date: $('#liquor_doc_issue_date_' + d).length ? $('#liquor_doc_issue_date_' + d).val() : '',
                        //     exp_date: $('#liquor_doc_exp_date_' + d).length ? $('#liquor_doc_exp_date_' + d).val() : '',
                        // }

                        liquorNames[d] = {
                            reqId: $('#liqour_req_id_'+d).val(),
                            fileNames
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            // localStorage.setItem('liquordocumentDetails', JSON.stringify());

            return hasFile;
        }




        const liquorDocUpload = () => {
            var per_doc = $('#liquor_document_count').val();
            // var total = parseInt($('#liquor_additional_doc > div').length);
            for(var i = 1; i <=  parseInt(per_doc);i++){
                    var reqID =  $('#liqour_req_id_'+i).val()  ;
                    liquorDocUploader[i] = $('#liquoruploader_'+i).uploadFile({
                    url: "{{route('event.uploadLiquor')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "liquor_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    showFileCounter: false,
                    maxFileSize: 5242880,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                       if(files.filepath)
                       {
                            let file_path = files.filepath;
                                let path = file_path.replace('public/','');
                                window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                       }else{
                            let user_id = $('#user_id').val();
                            let event_id = $('#event_id').val();
                            let liquor_id = $('#event_liquor_id').val();
                            let path = user_id+'/event/temp/liquor/' +liquor_id +'/'+reqID +'/' +files;
                            window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                       }
                    },
                    onLoad:function(obj)
                    {
                        var ev_lq_id = $('#event_liquor_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_liquor_docs')}}",
                            type: 'POST',
                            data: {
                                liquor_id: ev_lq_id,
                                reqId: $('#liqour_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                $('#liquoruploader_'+i+' .ajax-file-upload-red').trigger('click');
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#liquor_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#liquor_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteLiquorFile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: data.id},
                            success: function (result) {
                                // console.log('success');
                            }
                        });
                    }

                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
            }
        };



        $('#update_lq').click(function(){
            var type = $("input:radio[name='isLiquorVenue']:checked").val();
            var hasFile = liqourDocValidation(type);
            if(type == 0 ? liquorValidator.form() && hasFile : liquorProvidedValidator.form())
            {
                if(type == 0)
                {
                    liquorDetails = {
                        company_name_en: $('#l_company_name_en').val(),
                        company_name_ar: $('#l_company_name_ar').val(),
                        purchase_receipt: $('#purchase_receipt').val(),
                        liquor_service: $('#liquor_service').val(),
                    };
                    if($('#liquor_service').val() == 'limited'){
                        liquorDetails['liquor_types'] = $('#liquor_types').val()
                    }
                } else {
                    liquorDetails = {
                        liquor_permit_no: $('#liquor_permit_no').val(),
                    };
                }
                $.ajax({
                        url: "{{route('event.add_liquor')}}",
                        type: "POST",
                        data: {
                            liquorDetails: liquorDetails,
                            // liquorDocDetails: JSON.stringify(liquorDocDetails),
                            liquorNames: JSON.stringify(liquorNames),
                            type: type,
                            event_liquor_id: $('#event_liquor_id').val()
                        },
                        success: function (result) {
                            if(result)
                            {
                                $('#event_liquor_id').val(result.event_liquor_id);
                                $('#liquorEditBtn').show();
                                $('#prev_val_isLiquor').val(1);
                            }
                        }
                });
                // localStorage.setItem('liquor_details', JSON.stringify(liquorDetails));
                $('#liquor_details').modal('hide');
            }
        });

        function checkLiquor(id){
            var prev = $('#prev_val_isLiquor').val();
            if(id == 1){
                editLiquor();
            }
            if(id == 0 && prev == 1) {
                // alert('The Added data will be lost');
                $('#notSaveModal').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                $('#sure_remove_close').attr('onclick', changeIsLiquor());
                $('#fromSection').val('liquor');
            }
        }


    function editLiquor(){
            $.ajax({
                url:  "{{route('event.fetch_liquor_details')}}",
                type: 'POST',
                success: function (data) {
                    if(data.length)
                    {
                        $('#event_liquor_id').val(data.event_liquor_id);
                        if(data.provided == 1)
                        {
                            checkLiquorVenue(1);
                            $('#liquor_permit_no').val(data.liquor_permit_no);
                            $("input:radio[name='isLiquorVenue'][value='1']").attr('checked', true);
                        }else {
                            checkLiquorVenue(0);
                            $("input:radio[name='isLiquorVenue'][value='0']").attr('checked', true)
                            $('#l_company_name_en').val(data.company_name_en);
                            $('#l_company_name_ar').val(data.company_name_ar);
                            $('#purchase_receipt').val(data.purchase_receipt);
                            $('#liquor_service').val(data.liquor_service);
                            changeLiquorService();
                            $('#liquor_types').val(data.liquor_types);

                        }
                    }
                    $('#liquor_details').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                    $('#liquor_details .ajax-file-upload-red').trigger('click');
                    // liquorDocumentsValidator = $('#liquor_upload_form').validate({
                    //     rules: liquorDocRules,
                    //     messages: liquorDocMessages
                    // });
                    liquorDocUpload();

                }
            });
        }


       function changeData()
       {
            var fromSection = $('#fromSection').val();
            $.ajax({
                url:  "{{route('event.deleteTruckLiquor')}}",
                type: 'POST',
                data: { from: fromSection, eventId: $('#event_id').val() },
                success: function (result) {
                    $('#notSaveModal').modal('hide');
                    if(fromSection == 'truck'){
                        $('#truckEditBtn').hide();
                        $('input[name="isTruck"]').filter('[value=0]').prop('checked', true);
                    }else if(fromSection == 'liquor'){
                        $('#liquorEditBtn').hide();
                        $('input[name="isLiquor"]').filter('[value=0]').prop('checked', true);
                    }

                }
            });
       }


       const imageUploadFunction = () => {
            picUploader = $('#image_uploader').uploadFile({
                url: "{{route('event.uploadEventPics')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "image_file",
                multiple: true,
                deleteStr: `<i class="la la-trash"></i>`,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileSize: false,
                showFileCounter: false,
                maxFileSize: 5242880,
                abortStr: '',
                showProgress: false,
                downloadStr: `<i class="la la-download"></i>`,
                returnType: "json",
                showDownload:true,
                sequential:true,
                maxFileCount:5,
                // showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                downloadCallback: function (files, pd) {
                    let path = files.filepath.replace('public/','');
                    window.open("{{url('storage')}}"+'/' + path,
                    '_blank');
                },
                deleteCallback: function(data,pd)
                {
                    $.ajax({
                        url: "{{route('event.deleteUploadedEventPic')}}",
                        type: 'POST',
                        data: {path: data.filepath, ext: data.ext },
                        success: function (result) {
                        }
                    });
                }
            });
            $('#image_uploader div').attr('id', 'image-upload');
            $('#image_uploader + div').attr('id', 'image-file-upload');
            $('#image-file-upload .ajax-file-upload-statusbar').css('margin-bottom', '5px !important');
        };


        $('.subtype_table').DataTable({
            ordering: false,
            dom:"<'row d-none'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            language: {
                @if(Auth::check() && Auth::user()->LanguageId != 1)
                info: 'رض _START_ إلى _END_ للـــ _TOTAL_'
                @endif
            },
        });

</script>

@endsection