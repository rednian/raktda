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

                @include('permits.event.common.nav')

            </div>

            <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">


            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->

                    @include('permits.event.common.instructions', ['event_types' => $event_types])


                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">

                            @component('permits.components.eventcomments', ['staff_comments' => $staff_comments])
                            @endcomponent

                            <form id="eventdetails" action="" novalidate autocomplete="off">
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
                                    <div class="card">
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title show" data-toggle="collapse"
                                                data-target="#collapseOne6" aria-expanded="true"
                                                aria-controls="collapseOne6">
                                                <h6 class="kt-font-transform-u kt-font-dark">Event Details</h6>
                                            </div>
                                        </div>
                                        <input type="hidden" id="event_id" value="{{$event->event_id}}">
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                            data-parent="#accordionExample5">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-4 form-group form-group-xs ">
                                                        <label for="event_type_id"
                                                            class=" col-form-label kt-font-bold text-right">
                                                            {{__('Event Type')}} <span class="text-danger">*</span>
                                                        </label>
                                                        <select class="form-control form-control-sm"
                                                            name="event_type_id" id="event_type_id" placeholder="Type"
                                                            onchange="getRequirementsList(this.value)">
                                                            <option value="">{{__('Select')}}</option>
                                                            @foreach ($event_types as $pt)
                                                            <option value="{{$pt->event_type_id}}"
                                                                {{$event->event_type_id == $pt->event_type_id ? 'selected' : ''}}>
                                                                {{ucwords($pt->name_en)}}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>


                                                    <div class="col-md-4 form-group form-group-xs">
                                                        <label for="name_en"
                                                            class=" col-form-label kt-font-bold text-right">{{__('Event Name')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="name_en" id="name_en"
                                                            placeholder="{{__('Event Name')}}"
                                                            value="{{$event->name_en}}">
                                                    </div>

                                                    <div class=" col-md-4 form-group form-group-xs">
                                                        <label for="name_ar"
                                                            class=" col-form-label kt-font-bold text-right">
                                                            {{__('Event Name - Ar')}}<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control form-control-sm "
                                                            name="name_ar" dir="rtl" id="name_ar"
                                                            placeholder="{{__('Event Name - Ar')}}"
                                                            value="{{$event->name_ar}}">
                                                    </div>



                                                    <div class="col-md-4 form-group form-group-xs ">
                                                        <label for="description_en"
                                                            class=" col-form-label kt-font-bold text-right">
                                                            {{__('Description')}}<span
                                                                class="text-danger">*</span></label>
                                                        <textarea type="text" class="form-control form-control-sm"
                                                            name="description_en" id="description_en"
                                                            placeholder="{{__('Description')}}" rows="1"
                                                            style="resize:none">{{$event->description_en}}</textarea>
                                                    </div>

                                                    <div class=" col-md-4 form-group form-group-xs ">
                                                        <label for=" description_ar"
                                                            class=" col-form-label kt-font-bold text-right">
                                                            Description - Ar <span class="text-danger">*</span></label>
                                                        <textarea class="form-control form-control-sm"
                                                            name="description_ar" dir="rtl" id="description_ar"
                                                            placeholder="Description - Ar" rows="1"
                                                            style="resize:none">{{$event->description_ar}}</textarea>
                                                    </div>



                                                    <div class="col-md-4  form-group form-group-xs ">
                                                        <label class=" col-form-label kt-font-bold text-right">
                                                            Do you have any Food truck ?</label>
                                                        <div class="kt-radio-inline">
                                                            <label class="kt-radio kt-radio--solid">
                                                                <input type="radio" name="isTruck" value="1"
                                                                    onclick="checkTruck(1)"
                                                                    {{$event->no_of_trucks == 0 ? '' : 'checked'}}>
                                                                Yes
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio kt-radio--solid">
                                                                <input type="radio" name="isTruck" value="0" checked
                                                                    onclick="checkTruck(0)"
                                                                    {{$event->no_of_trucks == 0 ? 'checked' : ''}}>
                                                                No
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 form-group form-group-xs " id="how_many_div">
                                                        <label for="no_of_trucks"
                                                            class=" col-form-label kt-font-bold text-right">
                                                            How Many ?<span class="text-danger">*</span></label>
                                                        <select class="form-control form-control-sm" name="no_of_trucks"
                                                            id="no_of_trucks">
                                                            <option value=" ">Select</option>
                                                            @for($i = 1;$i < 15; $i++) <option value="{{$i}}"
                                                                {{$event->no_of_trucks == $i ? 'selected' : ''}}>
                                                                {{$i}}
                                                                </option>
                                                                @endfor
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="card kt-margin-t-5">
                                        <div class="card-header" id="headingTwo6">
                                            <div class="card-title show" data-toggle="collapse"
                                                data-target="#collapseTwo6" aria-expanded="false"
                                                aria-controls="collapseTwo6">
                                                <h6 class="kt-font-transform-u kt-font-dark">Date Details
                                                </h6>
                                            </div>
                                        </div>

                                        <div class="collapse show" aria-labelledby="headingTwo6"
                                            data-parent="#accordionExample6" id="collapseTwo6">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-md-3 form-group form-group-xs ">
                                                        <label for="issued_date"
                                                            class=" col-form-label kt-font-bold text-right">
                                                            {{__('From Date')}}<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group input-group-sm date">
                                                            <div class="kt-input-icon kt-input-icon--right">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="issued_date" id="issued_date"
                                                                    placeholder="{{__('From Date')}}"
                                                                    value="{{date('d-m-Y',strtotime($event->issued_date))}}" />
                                                                <span
                                                                    class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3 form-group form-group-xs">
                                                        <label class="col-form-label">{{__('From Time')}}<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group input-group-sm timepicker">
                                                            <div class="kt-input-icon kt-input-icon--right">
                                                                <input class="form-control form-control-sm"
                                                                    value="{{date('d-m-Y',strtotime($event->time_start))}}"
                                                                    name="time_start" id="time_start" type="text" />
                                                                <span
                                                                    class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-clock-o"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>



                                                    <div class="col-md-3 form-group form-group-xs ">
                                                        <label for="expired_date"
                                                            class=" col-form-label kt-font-bold text-right">{{__('To Date')}}<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group input-group-sm date">
                                                            <div class="kt-input-icon kt-input-icon--right">
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="expired_date" id="expired_date"
                                                                    placeholder="{{__('To Date')}}"
                                                                    value="{{date('d-m-Y',strtotime($event->expired_date))}}">
                                                                <span
                                                                    class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 form-group form-group-xs">
                                                        <label class="col-form-label">{{__('To Time')}}<span
                                                                class="text-danger">*</span></label>

                                                        <div class="input-group input-group-sm timepicker">
                                                            <div class="kt-input-icon kt-input-icon--right">
                                                                <input class="form-control form-control-sm"
                                                                    value="{{$event->time_end}}" name="time_end"
                                                                    id="time_end" type="text" />
                                                                <span
                                                                    class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-clock-o"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>



                                                </div>
                                            </div>
                                        </div>



                                        <div class="card kt-margin-t-5">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseTwo5" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">Location Details
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#accordionExample6" id="collapseTwo5">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="venue_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Venue')}} <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_en" id="venue_en"
                                                                placeholder="{{__('Venue')}}"
                                                                value="{{$event->venue_en}}">

                                                        </div>

                                                        <div class="col-md-6 form-group form-group-xs ">
                                                            <label for="venue_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Venue - Ar <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="venue_ar" dir="rtl" id="venue_ar"
                                                                placeholder="Venue - Ar" value="{{$event->venue_ar}}">
                                                        </div>




                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="emirate_id"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Emirate')}}
                                                            </label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                value="Rasal Khaimah" readonly>
                                                            <input type="hidden" name="emirate_id" id="emirate_id"
                                                                value="5">
                                                        </div>


                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="area_id"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Area')}}
                                                            </label>
                                                            <select class="  form-control form-control-sm "
                                                                name="area_id" id="area_id">
                                                                <option value="">{{__('Select')}}</option>
                                                                @foreach($areas as $ar)
                                                                <option value="{{$ar->id}}"
                                                                    {{$ar->id == $event->area_id ? 'selected' : ''}}>
                                                                    {{$ar->area_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="country_id"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Country')}}
                                                            </label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                value="United Arab Emirates" readonly>
                                                            <input type="hidden" name="country_id" id="country_id"
                                                                value="232">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card kt-margin-t-5">
                                                <div class="card-header" id="headingTwo6">
                                                    <div class="card-title show" data-toggle="collapse"
                                                        data-target="#collapseTwo4" aria-expanded="false"
                                                        aria-controls="collapseTwo6">
                                                        <h6 class="kt-font-transform-u kt-font-dark">Map
                                                            Details
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="collapse show" aria-labelledby="headingTwo6"
                                                    data-parent="#accordionExample6" id="collapseTwo4">
                                                    <div class="card-body">
                                                        <div class="row">

                                                            <div class="col-md-8 col-sm-12 form-group form-group-xs ">
                                                                <label for="address"
                                                                    class=" col-form-label kt-font-bold text-right">Address
                                                                    <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"
                                                                    class="form-control form-control-sm map-input"
                                                                    name="address" id="address-input"
                                                                    placeholder="Address" value="{{$event->address}}">
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-xs ">
                                                                <label for="street"
                                                                    class=" col-form-label kt-font-bold text-right">
                                                                    Street<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="street" id="street" placeholder="Street"
                                                                    value="{{$event->street}}">
                                                            </div>

                                                            <input type="hidden" id="full_address" name="full_address"
                                                                value="{{$event->full_address}}">

                                                            <div class="col-md-6 form-group form-group-xs ">
                                                                <label for="longitude"
                                                                    class=" col-form-label kt-font-bold text-right">
                                                                    Longitude <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="longitude" id="longitude"
                                                                    placeholder="Longitude"
                                                                    value="{{$event->longitude}}">
                                                            </div>

                                                            <div class="col-md-6 form-group form-group-xs ">
                                                                <label for="latitude"
                                                                    class=" col-form-label kt-font-bold text-right">
                                                                    Latitude <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="latitude" id="latitude" placeholder="Latitude"
                                                                    value="{{$event->latitude}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="address-map-container" style="width:100%;height:200px;padding:15px;">
                                <div style="width: 100%; height: 100%" id="map"></div>
                            </div>

                        </div>
                    </div>



                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            @component('permits.components.eventcomments', ['staff_comments' => $staff_comments])
                            @endcomponent
                            <input type="hidden" id="requirements_count" />
                            <form id="documents_required" novalidate>

                            </form>
                            <input type="hidden" id="addi_requirements_count">
                            <form id="addi_documents_required" novalidate>
                            </form>
                        </div>
                    </div>
                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('Previous')}}
                        </div>


                        <a href="{{route('event.index')}}#applied">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('Back')}}
                            </div>
                        </a>


                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn">
                            {{__('Submit')}}
                        </div>



                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            {{__('Next')}}
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
<script src="{{asset('js/company/map.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initialize"
    async defer></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    var truckdocumentDetails = {};
    var addidocumentDetails = {};
    var truckDocUploader = [];
    var picUploader ;


    $(document).ready(function(){
        setWizard();
        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(2);
        $('#back_btn').css('display', 'none');
        localStorage.clear();
        setEventDetails();
        let event_id = $('#event_id').val();
        let event_type_id = $('#event_type_id').val();
        getRequirementsList(event_type_id);
        getAddtionalRequirementsList(event_id);
        uploadFunction();
        picUploadFunction();
        checkTruck(0);
        $('#submit_btn').css('display', 'none');
    });

    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            let totalLength = parseInt($('#requirements_count').val())  + parseInt($('#addi_requirements_count').val());
            for (var i = 1; i <= totalLength; i++) {
                let requiId = $('#req_id_' + i).val() ;
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('event.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "doc_file_" + i,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    returnType: "json",
                    showFileCounter: false,
                    duplicateErrorStr: 'No duplicate files allowed',
                    abortStr: '',
                    multiple: true,
                    maxFileCount: 2,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {id: i, reqId: requiId , reqName:$('#req_name_' + i).val()},
                    onLoad: function (obj) {
                        $.ajax({
                            cache: false,
                            url: "{{route('company.event.get_uploaded_docs')}}",
                            type: 'POST',
                            data: {eventId: $('#event_id').val() ,reqId: requiId},
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
                                        var cc = d.splice(4,5);
                                        let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        // let docName = d[d.length - 1];
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
                        if(files[0]) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let this_url = user_id + '/event/' + eventId +'/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        ); } else {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                        }
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
                showFileCounter: false,
                abortStr: '',
                previewHeight: '200px',
                previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                onLoad: function (obj) {
                    var url = "{{route('event.get_uploaded_logo',':id')}}" ;
                    url = url.replace(':id', $('#event_id').val() );
                    $.ajax({
                        url: url,
                        success: function (data) {
                            // console.log(data);
                            if (data) {
                                obj.createProgress('Logo Pic', "{{url('storage')}}"+'/'+ data, '');
                            }
                        }
                    });
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
                issued_date:{
                    required: true,
                    dateNL: true
                },
                street: 'required',
                description_en: 'required',
                description_ar: 'required',
                time_start: 'required',
                venue_en: 'required',
                area_id: 'required',
                longitude: 'required',
                latitude: 'required',
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
                    required: '' ,
                    dateNL: ''
                },
                street: '',
                description_en: '',
                description_ar: '',
                time_start: '',
                venue_en: '',
                area_id: '',
                longitude: '',
                latitude: '',
                expired_date:  {
                    required: '' ,
                    dateNL: ''
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
            !checkForTick() ? '' : setThis('block', 'block', 'none', 'none') ;
        });

        $("#upload_doc").on("click", function () {
            wizard = new KTWizard("kt_wizard_v3");
            wizard.currentStep == 2 ? (!eventValidator.form() ? stopNext(eventValidator) : setThis('block', 'none', 'none', 'block')) : setThis('block', 'none', 'none', 'block');
            ;
        });

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
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
                $('#submit_btn').css('display', 'block');
                setEventDetails();
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }
        });

        function checkTruck(id) {
        if (id == 1) {
            $("#how_many_div").css("display", "block");
            $("#no_of_trucks").attr("required", true);
            $('#add_document_btn').css('display', "block");
        } else {
            $("#how_many_div").css("display", "none");
            $("#no_of_trucks").attr("required", false);
            $('#add_document_btn').css('display', "none");
        }
    }

        function setEventDetails(){
            var noOfTrucks = $("input:radio[name='isTruck']:checked").val() == "1" ? $('#no_of_trucks').val() : "0" ;
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
                    no_of_trucks: noOfTrucks
            };
            localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
        }

        let documentNames = {};


        const docValidation = () => {
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = parseInt($('#requirements_count').val()) + parseInt($('#addi_requirements_count').val());
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) {
                let children = $('#ajax-file-upload_' + i).children();
                let fileNames = Object.keys(children).map(function(key){
                    return children[key].innerText != undefined ? children[key].innerText : '';
                });

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
                    documentNames[i] = {
                        reqId: $('#req_id_'+i).val(),
                        fileNames
                    }
                }
            }
            }

            if ($('#pic-file-upload').contents().length == 0) {
                hasPicture = false;
                $('#pic-upload').css('border', '2px dotted red');
            } else {
                hasPicture = true;
                $("#pic-upload").css('border', '2px dotted #A5A5C7');
            }


            if (hasFileArray.includes(false) || hasPicture == false) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
            localStorage.setItem('documentNames', JSON.stringify(documentNames));
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
            $('#submit_btn').css('display', 'none');
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
            $('#expired_date').datepicker('setEndDate', expDate.format("DD-MM-YYYY"));
            $('#expired_date').val(expDate.format("DD-MM-YYYY"));
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

        var docRules = {};
        var docMessages = {};
        var documentsValidator = '';
        var addiDocumentsValidator = '';


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
                     $('#requirements_count').val(res.length);
                     $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Event Permit Required documents</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">Event Logo <span class="text-danger">( required )</span></label><p class="reqName">A image of the event logo/ banner </p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">Upload</div></div></div>');
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row col-md-12"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+res[i].requirement_name+' <span class="text-danger">( required )</span></label><p for="" class="reqName">'+(res[i].requirement_description ? res[i].requirement_description : '')+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
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
                     picUploadFunction();
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });

        }

         function getAddtionalRequirementsList(id)
        {
            var url = "{{route('company.event.get_additional_requirements', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (result) {
                 if(result){
                    $('#addi_documents_required').empty();
                     var res = result.additional_requirements;
                     $('#addi_requirements_count').val(res.length);
                     var j =  parseInt($('#requirements_count').val()) + 1 ;
                     if(j != NaN){
                     for(var i = 0; i < res.length; i++){
                         $('#addi_documents_required').append('<div class="row col-md-12"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+res[i].requirement_name+'<span class="text-danger">( required )</span></label><p for="" class="reqName">'+res[i].requirement_description+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                         }

                            docRules['doc_issue_date_' + j] = 'required';
                            docRules['doc_exp_date_' + j] = 'required';
                            docMessages['doc_issue_date_' + j] = '';
                            docMessages['doc_exp_date_' + j] = '';

                            addiDocumentsValidator = $('#addi_documents_required').validate({
                                    rules: docRules,
                                    messages: docMessages
                                });
                                j++;
                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     }
                     uploadFunction();
                 }
                }
            });

        }


        $('#submit_btn').click((e) => {

            var hasFile = docValidation();

                if (documentsValidator.form() && hasFile) {

                    $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

                    // let addTotal = $('#addi_requirements_count').val();

                    // if(addTotal > 0)

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    var dn = localStorage.getItem('documentNames');

                        $.ajax({
                            url: "{{route('company.event.update_event')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                                documentN: dn,
                                event_id:$('#event_id').val()
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