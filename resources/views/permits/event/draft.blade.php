@extends('layouts.app')

@section('title', ' Event Permit Draft - Smart Government Rak')

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->all())}} --}}
<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items" id="event-wizard--nav">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span> Instructions
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="event_det">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> Event Details
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> Upload Docs
                                    <Docs></Docs>
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>04</span> Payment
                                    <Docs></Docs>
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </div>
                        <div class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>05</span> Happiness
                                    <Docs></Docs>
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
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <!--begin::Accordion-->
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">


                                    <div class="card">
                                        <div class="card-header" id="headingThree6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseThree6" aria-expanded="false"
                                                aria-controls="collapseThree6">
                                                <h6 class="kt-font-transform-u"> Permit Fees Structure</h6>
                                            </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">


                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Event Permit Type</th>
                                                        <th class="text-right">Fee (AED)</th>
                                                    </tr>
                                                    @foreach($event_types as $pt)
                                                    <tr>
                                                        <td>{{$pt->name_en}}</td>
                                                        <td class="text-right">{{number_format($pt->amount,2)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseFour6" aria-expanded="false"
                                                aria-controls="collapseFour6">
                                                <h6 class="kt-font-transform-u">Rules and Conditions</h6>
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
                                    <label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
                                        <input type="checkbox" id="agree" name="agree" checked> I Read
                                        and understand all
                                        service rules, And agree to continue submitting it.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="eventdetails" novalidate>
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u">Event
                                                        information</h6>
                                                </div>
                                            </div>
                                            <input type="hidden" id="event_id" value="{{$event->event_id}}">
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#accordionExample5">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Event Type <small>( <span
                                                                        class="text-danger">required</span>
                                                                    )</small></label>
                                                            <select class="form-control form-control-sm "
                                                                name="event_type_id" id="event_type_id"
                                                                placeholder="Type"
                                                                onchange="getRequirementsList(this.value)">
                                                                <option value="">Select</option>
                                                                @foreach ($event_types as $pt)
                                                                <option value="{{$pt->event_type_id}}"
                                                                    {{$event->event_type_id == $pt->event_type_id ? 'selected' : ''}}>
                                                                    {{ucwords($pt->name_en)}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>


                                                        <div class="col-md-4 form-group form-group-sm">
                                                            <label for="name_en"
                                                                class=" col-form-label kt-font-bold text-right">Event
                                                                Name <small>( <span class="text-danger">required
                                                                    </span>)</small></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="name_en" id="name_en" placeholder="Event Name"
                                                                value="{{$event->name_en}}">
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-sm">
                                                            <label for="name_ar"
                                                                class=" col-form-label kt-font-bold text-right">Event
                                                                Name - Ar<small>( <span class="text-danger">required
                                                                    </span>)</small></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="name_ar" id="name_ar" placeholder="Event Name"
                                                                value="{{$event->name_ar}}">
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="issued_date"
                                                                class=" col-form-label kt-font-bold text-right">From
                                                                Date <small>( <span class="text-danger">required</span>
                                                                    )</small></label>
                                                            <div class="input-group date">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar-check-o"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="issued_date" id="issued_date"
                                                                    placeholder="From Date"
                                                                    value="{{date('d-m-Y',strtotime($event->issued_date))}}">

                                                            </div>
                                                        </div>


                                                        <div class="col-md-4 form-group form-group-sm">
                                                            <label class="col-form-label">From
                                                                Time <small>( <span class="text-danger">required</span>
                                                                    )</small></label>
                                                            <div class="input-group timepicker">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-clock-o"></i>
                                                                    </span>
                                                                </div>
                                                                <input class="form-control form-control-sm"
                                                                    value="{{date('h:i a')}}" name="time_start"
                                                                    id="time_start" type="text"
                                                                    value="{{$event->time_start}}" />

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="venue_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Venue <small>( <span class="text-danger">required</span>
                                                                    )</small></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_en" id="venue_en" placeholder="Venue"
                                                                value="{{$event->venue_en}}">

                                                        </div>


                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="expired_date"
                                                                class=" col-form-label kt-font-bold text-right">To
                                                                Date <small>( <span class="text-danger">required</span>
                                                                    )</small></label>
                                                            <div class="input-group date">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar-check-o"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control form-control-sm "
                                                                    name="expired_date" id="expired_date"
                                                                    placeholder="To Date"
                                                                    value={{date('d-m-Y',strtotime($event->expired_date))}}>

                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-sm">
                                                            <label class="col-form-label">To Time <small>( <span
                                                                        class="text-danger">required</span>
                                                                    )</small></label>

                                                            <div class="input-group timepicker">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-clock-o"></i>
                                                                    </span>
                                                                </div>
                                                                <input class="form-control form-control-sm "
                                                                    name="time_end" id="time_end" type="text"
                                                                    value={{$event->time_end}} />

                                                            </div>

                                                        </div>



                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="venue_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Venue - Ar <small>( <span
                                                                        class="text-danger">required</span>
                                                                    )</small></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="venue_ar" id="venue_ar" placeholder="Venue"
                                                                value={{$event->venue_ar}}>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                        {{--id="collapseTwo6"--}}
                                        <div class="collapse show" aria-labelledby="headingTwo6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">

                                                <div class="row">


                                                    <div class="col-md-4 form-group form-group-sm ">
                                                        <label for="address"
                                                            class=" col-form-label kt-font-bold text-right">Address
                                                            <small>( <span class="text-danger">required</span>
                                                                )</small></label>
                                                        <input type="text" class="form-control form-control-sm "
                                                            name="address" id="address" placeholder="Address"
                                                            value={{$event->address}}>
                                                    </div>

                                                    <div class="col-md-4 form-group form-group-sm ">
                                                        <label for="emirate_id"
                                                            class=" col-form-label kt-font-bold text-right">Emirate
                                                        </label>
                                                        <select class="form-control form-control-sm" name="emirate_id"
                                                            id="emirate_id">
                                                            <option value="5">Ras Al Khaimah</option>
                                                        </select>

                                                    </div>


                                                    <div class="col-md-4 form-group form-group-sm ">
                                                        <label for="area_id"
                                                            class=" col-form-label kt-font-bold text-right">Area
                                                            <small>( optional )</small></label>
                                                        <select class="  form-control form-control-sm " name="area_id"
                                                            id="area_id">
                                                            <option value="">Select</option>
                                                            @foreach($areas as $ar)
                                                            <option value="{{$ar->id}}">
                                                                {{$ar->area_en}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 form-group form-group-sm ">
                                                        <label for="country_id"
                                                            class=" col-form-label kt-font-bold text-right">Country
                                                        </label>
                                                        <select class="form-control form-control-sm " name="country_id"
                                                            id="country_id">
                                                            <option value="{{232}}">
                                                                United Arab Emirates
                                                            </option>
                                                        </select>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>





                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <form id="documents_required">


                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            Previous
                        </div>

                        <a href="{{route('event.index')}}#draft">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                Back
                            </div>
                        </a>

                        <div class="btn-group" role="group" id="submit--btn-group">
                            <button id="btnGroupDrop1" type="button" class="btn btn--yellow btn-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Submit
                            </button>
                            <div class="dropdown-menu py-0" aria-labelledby="btnGroupDrop1">
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary btn-hover-success"
                                    value="finished" id="submit_btn">Finish &
                                    Submit</button>
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary" value="drafts"
                                    id="draft_btn">Update
                                    Draft</button>
                            </div>
                        </div>


                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            Next Step
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



<!--end::Modal-->




@endsection


@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};

    $(document).ready(function(){
        setWizard();
        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(2);
        $('#back_btn').css('display', 'none');
        localStorage.clear();
        var event_type_id = $('#event_type_id').val();
        getRequirementsList(event_type_id);
        uploadFunction();
        $('#submit--btn-group').css('display', 'none');
    });

    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('company.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "doc_file_" + i,
                    showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    returnType: "json",
                    showFileCounter: false,
                    abortStr: '',
                    multiple: false,
                    maxFileCount: 1,
                    showDelete: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
                    onLoad: function (obj) {

                        $.ajaxSetup({
                            headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            cache: false,
                            url: "{{route('company.event.get_uploaded_docs')}}",
                            type: 'POST',
                            data: {eventId: $('#event_id').val() ,reqId: $('#req_id_' + i).val()},
                            dataType: "json",
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let issue_datetime = new Date(data['issued_date']);
                                        let exp_datetime = new Date(data['expired_date']);
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                        j++;
                                    }

                                }

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
                    }
                });
                $('#fileuploader_' + i + ' div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
            }
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
                time_start: 'required',
                venue_en: 'required',
                expired_date: {
                    required: true,
                    dateNL: true
                },
                time_end: 'required',
                venue_ar: 'required',
                address: 'required',
            },
            messages: {
                event_type_id: '',
                name_en: '',
                name_ar: '',
                issued_date: {
                    required: "",
                    dateNL: ""
                },
                time_start: '',
                venue_en: '',
                expired_date: {
                    required: "",
                    dateNL: ""
                },
                time_end: '',
                venue_ar: '',
                address: '',
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
            if (!checkForTick()) return;
            if (wizard.currentStep == 3) {
                stopNext(eventValidator);
                return;
            }

            setThis('block', 'none', 'none', 'block');
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
                    time_start: $('#time_start').val(),
                    venue_en: $('#venue_en').val(),
                    expired_date: $('#expired_date').val(),
                    time_end: $('#time_end').val(),
                    venue_ar: $('#venue_ar').val(),
                    address: $('#address').val(),
                    emirate_id: $('#emirate_id').val(),
                    area_id: $('#area_id').val(),
                    country_id: $('#country_id').val()
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
                for (var i = 1; i <= reqCount; i++) {
                if ($('#ajax-file-upload_' + i).length) {
                    if ($('#ajax-file-upload_' + i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_" + i).css('border', '2px dotted red');
                    } else {
                        hasFileArray[i] = true;
                        $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                    }
                    documentDetails[i] = {
                        issue_date: $('#doc_issue_date_' + i).val(),
                        exp_date: $('#doc_exp_date_' + i).val()
                    }
                }
            }
            }


            if (hasFileArray.includes(false) ) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
                return hasFile;
            };



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
            orientation: "bottom left"
        });
        $('#expired_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });

        $('#time_start').timepicker();
        $('#time_end').timepicker();

        $('#issued_date').on('changeDate', function (selected) {
            $('#issued_date').valid() || $('#issued_date').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            var expDate = moment(minDate, 'DD-MM-YYYY').add('month', 1);
            $('#expired_date').datepicker('setStartDate', minDate);
            $('#expired_date').val(expDate.format("DD-MM-YYYY"));
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });


        const getAreas = (city_id) => {
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

        };

        var docRules = {};
        var docMessages = {};
        var documentsValidator = '';


        function getRequirementsList(id)
        {
            var url = "{{route('company.event.get_requirements', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (result) {
                 if(result){
                    $('#documents_required').empty();
                     var res = result.requirements;
                     $('#documents_required').append('<input hidden id="requirements_count" value="'+ res.length +'" />');
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+res[i].requirement_name+'</label><p for="" class="reqName">'+res[i].requirement_description+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd"></div><div class="col-lg-2 col-sm-12" id="exp_dd"></div></div>');

                         if(res[i].dates_required)
                         {
                            $('#issue_dd').append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd').append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                         }

                            docRules['doc_issue_date_' + j] = 'required';
                            docRules['doc_exp_date_' + j] = 'required';
                            docMessages['doc_issue_date_' + j] = '';
                            docMessages['doc_exp_date_' + j] = '';

                            documentsValidator = $('#documents_required').validate({
                                    rules: docRules,
                                    messages: docMessages
                                });

                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     uploadFunction();
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });

        }


        $('#submit_btn').click((e) => {

            var hasFile = docValidation();

                if (documentsValidator.form() && hasFile) {

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');

                        $.ajax({
                            url: "{{route('event.store')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                            },
                            success: function (result) {
                                if(result.message[0]){
                                    localStorage.clear();
                                    window.location.href = "{{route('event.index')}}";
                                }
                            }
                        });
                }

        });



        $('#draft_btn').click((e) => {

            var hasFile = docValidation();

                if (documentsValidator.form() && hasFile) {

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');

                        $.ajax({
                            url: "{{route('company.event.update_draft')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                                evtId: $('#event_id').val()
                            },
                            success: function (result) {
                                if(result.message[0]){
                                    localStorage.clear();
                                    window.location.href = "{{route('event.index')}}";
                                }
                            }
                        });
                }

        });



</script>

@endsection
