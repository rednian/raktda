@extends('layouts.app')
@section('content')
<link href="{{asset('css/uploadfile.css')}}" rel="stylesheet">
<!-- begin:: Content -->
<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
                <div class="kt-grid__item">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v3__nav">
                        <div class="kt-wizard-v3__nav-items">
                            <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                                data-ktwizard-state="current" id="check_inst">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>01</span>{{__('Instructions')}}
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="artist_det">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>02</span> {{__('Artist Details')}}
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>03</span>{{__('Upload Docs')}}
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>

                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                @php
                $language_id = getLangId();
                @endphp


                <input type="hidden" id="artist_permit_id" value="{{$artist_details->artist_permit_id }}">
                <input type="hidden" id="temp_artist_id" value="{{$artist_details->artist_id }}">
                <input type="hidden" id="temp_id" value="{{$artist_details->id}}">
                <input type="hidden" id="issue_date" value="{{$artist_details->issue_date}}">
                <input type="hidden" id="expiry_date" value="{{$artist_details->expiry_date}}">

                <input type="hidden" id="language_id" value="{{$language_id}}">

                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                    <!--begin: Form Wizard Form-->
                    {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                    <div class="kt-form w-100 px-5" id="kt_form">
                        <!--begin: Form Wizard Step 1-->

                        @include('permits.artist.common.wizard_instructions')

                        <input type="hidden" id="fromPage" value={{$from}}>
                        <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">

                        <!--end: Form Wizard Step 1-->

                        @include('permits.artist.common.edit-artist-details-html', [ 'artist_details' =>
                        $artist_details, 'from' => $from, 'staff_comments' => $staff_comments])

                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-form__section kt-form__section--first ">
                                @component('permits.components.artist_permit_comments', ['staff_comments' =>
                                $staff_comments])
                                @endcomponent
                                <div class="kt-wizard-v3__form">
                                    <form id="documents_required" method="post" autocomplete="off">
                                        <input type="hidden" id="artist_number_doc" value={{1}}>
                                        <input type="hidden" id="requirements_count" value={{count($requirements)}}>
                                        <div class="kt-form__section kt-form__section--first">

                                            <div class="row">
                                                <div class="col-lg-4 col-sm-12">
                                                    <label class="kt-font-bold text--maroon"> Artist Photo <span
                                                            class="text-danger">*</span></label>
                                                    <p for="" class="reqName " title="Artist Photo">
                                                        Use Passport size picture with white background</p>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <label style="visibility:hidden">hidden</label>
                                                    <div id="pic_uploader">Upload
                                                    </div>
                                                </div>

                                            </div>
                                            @php
                                            $i = 1;
                                            $user_id = Auth::user()->user_id;
                                            $issued_date = strtotime($artist_details->issue_date);
                                            $expired_date = strtotime($artist_details->expiry_date);
                                            $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                                            @endphp
                                            <input type="hidden" id="permitNoOfDays" value="{{$diff}}" />
                                            @foreach ($requirements as $req)
                                            <div class="row">
                                                <div class="col-lg-4 col-sm-12">
                                                    <label
                                                        class="kt-font-bold text--maroon">{{$language_id == 1 ?$req->requirement_name : $req->requirement_name_ar}}
                                                        <span id="cnd_{{$i}}"></span>
                                                    </label>
                                                    <p for="" class="reqName">
                                                        {{$req->requirement_description}}</p>
                                                </div>
                                                <input type="hidden" value="{{$req->requirement_id}}"
                                                    id="req_id_{{$i}}">
                                                <input type="hidden" value="{{$req->requirement_name}}"
                                                    id="req_name_{{$i}}">

                                                <div class="col-lg-4 col-sm-12">
                                                    <label style="visibility:hidden">hidden</label>
                                                    <div id="fileuploader_{{$i}}">Upload
                                                    </div>
                                                </div>
                                                <input type="hidden" id="datesRequiredCheck_{{$i}}"
                                                    value="{{$req->dates_required}}">
                                                <input type="hidden" id="permitTerm_{{$i}}" value="{{$req->term}}">
                                                @if($req->dates_required == 1)
                                                <div class="col-lg-2 col-sm-12">
                                                    <label for="" class="text--maroon kt-font-bold"
                                                        title="Issue Date">@lang('words.issue_date')</label>
                                                    <input type="text" class="form-control form-control-sm date-picker"
                                                        name="doc_issue_date_{{$i}}" data-date-end-date="0d"
                                                        id="doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY"
                                                        onchange="setExpiryMindate('{{$i}}')" />
                                                    <input type="hidden" id="doc_validity_{{$i}}"
                                                        value="{{$req->validity}}">
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <label for="" class="text--maroon kt-font-bold"
                                                        title="Expiry Date">@lang('words.expired_date')</label>
                                                    <input type="text" class="form-control form-control-sm date-picker"
                                                        name="doc_exp_date_{{$i}}" data-date-start-date="+0d"
                                                        id="doc_exp_date_{{$i}}" placeholder="DD-MM-YYYY" />
                                                </div>
                                                @endif
                                            </div>


                                            @php
                                            $i++;
                                            @endphp

                                            @endforeach

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('Previous')}}
                        </div>
                        <input type="hidden" id="permit_id" value={{$artist_details->permit_id}}>
                        @php
                        $backUrl = '';
                        switch ($from) {
                        case 'amend':
                        $backUrl = 'company/artist/permit/'.$artist_details->permit_id .'/amend';
                        break;
                        case 'renew':
                        $backUrl = 'company/artist/permit/'.$artist_details->permit_id .'/renew';
                        break;
                        case 'edit':
                        $backUrl = 'company/artist/permit/'.$artist_details->permit_id .'/edit';
                        break;
                        case 'new':
                        $backUrl = 'company/artist/new/1';
                        break;
                        case 'event':
                        $backUrl = 'company/event/add_artist/'.$artist_details->permit_id ;
                        break;
                        }
                        @endphp

                        <a href="{{url($backUrl)}}">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('Back')}}
                            </div>
                        </a>
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn">
                            <i class="la la-check"></i>
                            {{__('Submit')}}
                        </div>

                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            {{__('Next')}}
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
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script>
    var fileUploadFns = [];
    var picUploader ;
    var artistDetails = new Object();
    var documentDetails = new Object();

    $(document).ready(function(){

        localStorage.clear();
        setWizard();
        // upload file
       uploadFunction();
       PicUploadFunction();
       var nationality = $('#nationality').val();
       checkVisaRequired(nationality);
       $('.sh-uae').hide();

       $('#submit_btn').css('display', 'none');

        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(2);
        $('#back_btn').css('display', 'none');

        $('#city').val() ? getAreas($('#city').val(), $('#sel_area').val(), $('#language_id').val()) : '';

    });

    const uploadFunction = () => {
        // console.log($('#artist_number_doc').val());
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
            const requiId = $('#req_id_'+i).val();
            fileUploadFns[i] = $("#fileuploader_"+i).uploadFile({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('company.uploadDocument')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png,pdf",
                fileName: "doc_file_"+i,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                maxFileSize: 5242880,
                showFileCounter: false,
                abortStr: '',
                multiple: false,
                maxFileCount:1,
                showDelete: true,
                showDownload: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: i, reqId: requiId , artistNo: $('#artist_number_doc').val()},
                onSuccess: function (files, response, xhr, pd) {
                        //You can control using PD
                    pd.progressDiv.show();
                    pd.progressbar.width('0%');
                },
                onLoad:function(obj)
                {
                    var temp_id = $('#temp_id').val();
                    if(temp_id){
                        $.ajaxSetup({
                        headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            cache: false,
                            url: "{{route('company.get_temp_files_by_temp_id')}}",
                            type: 'POST',
                            data: {temp_id:  temp_id, reqId: requiId },
                            dataType: "json",
                            success: function(data)
                            {
                                // console.log('../../storage/'+data[0]["path"]);
                                let id = obj[0].id;
                                let number = id.split("_");
                                let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                const d = data["path"].split("/");
                                let docName = d[d.length - 1];
                                obj.createProgress(docName,"{{url('/storage')}}"+'/'+data.path,'');
                                if(formatted_issue_date != NaN-NaN-NaN)
                                {
                                    $('#doc_issue_date_'+number[1]).val(formatted_issue_date);
                                    $('#doc_exp_date_'+number[1]).val(formatted_exp_date);
                                }
                            }
                        });
                    }

                },
                downloadCallback:function(files,pd)
                {
                    if(files[0]) {
                        let user_id = $('#user_id').val();
                        let artistId = $('#temp_artist_id').val();
                        let this_url = user_id + '/artist/' + artistId +'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
                    } else {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    }
                },
            });
            $('#fileuploader_'+i+' div').attr('id', 'ajax-upload_'+i);
            $('#fileuploader_'+i+' + div').attr('id', 'ajax-file-upload_'+i);
        }
    }

    const PicUploadFunction = () => {
        picUploader = $('#pic_uploader').uploadFile({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('company.uploadPhoto')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                maxFileCount:1,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                previewHeight: '100px',
                previewWidth: "auto",
                abortStr: '',
                showPreview:true,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                formData: {id: 0, reqName: 'Artist Photo' , artistNo: $('#artist_number_doc').val()},
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
                },
                onLoad:function(obj)
                {
                    var temp_id = $('#temp_id').val();
                    if(temp_id){
                        $.ajaxSetup({
                            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            url: "{{url('company/get_temp_photo_temp_id')}}"+'/'+temp_id,
                            success: function(data)
                            {
                                // console.log(data[0].original_pic);
                                if(data[0].original)
                                {
                                    obj.createProgress('',"{{url('/storage')}}"+'/'+data[0].original,'');
                                }
                            }
                        });
                    }

                },
                onError: function (files, status, errMsg, pd) {
                    showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                    pd.statusbar.hide();
                }
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
    }


    var detailsValidator = $("#artist_details").validate({
            ignore: [],
            rules: {
                fname_en: "required",
                fname_ar: "required",
                lname_en: "required",
                lname_ar: "required",
                profession: "required",
                permit_type: "required",
                dob: {
                    required: true,
                    dateNL: true
                },
                uid_number: "required",
                uid_expiry: {
                    required: true,
                    dateNL: true
                },
                passport: "required",
                pp_expiry: {
                    required: true,
                    dateNL: true
                },
                visa_number: "required",
                visa_type: "required",
                visa_expiry: {
                    required: true,
                    dateNL: true
                },
                gender: "required",
                nationality: "required",
                address: "required",
                mobile: {
                    // number: true,
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                fname_en: "",
                fname_ar: "",
                lname_en: "",
                lname_ar: "",
                profession: "",
                dob: "",
                uid_number: "",
                uid_expiry: "",
                permit_type: "",
                passport: "",
                pp_expiry: "",
                visa_type: "",
                visa_number: "",
                visa_expiry: "",
                gender: "",
                nationality: "",
                address: "",
                mobile: {
                    // number: 'Please enter number',
                    required: ""
                },
                email: {
                    required: "",
                    email: ""
                }
            }
        });

        function checkVisaRequired(){
            var nationality = $('#nationality').val();
            if(nationality)
            {
                if(nationality == '232'){
                    $('.sh-uae').show();
                    $('.hd-uae').hide();
                    $('select[name="visa_type"]').rules("remove", "required");$('#visa_type').removeClass('is-invalid');
                    $('input[name="visa_number"]').rules("remove"), "required";$('#visa_number').removeClass('is-invalid');
                    $('input[name="visa_expiry"]').rules("remove", "required");$('#visa_expiry').removeClass('is-invalid');
                    $('input[name="passport"]').rules("remove", "required");$('#passport').removeClass('is-invalid');
                    $('input[name="pp_expiry"]').rules("remove", "required");$('#pp_expiry').removeClass('is-invalid');
                    $('input[name="uid_number"]').rules("remove", "required");$('#uid_number').removeClass('is-invalid');
                    $('input[name="uid_expiry"]').rules("remove", "required");$('#uid_expiry').removeClass('is-invalid');
                    $('input[name="id_no"]').rules('add', { required: true, messages: {required:''}});
                    for (var i = 1; i <= $('#requirements_count').val(); i++) {
                        if($('#req_id_'+i).val() == 6){
                            delete docRules['doc_issue_date_' + i];
                            delete docRules['doc_exp_date_' + i];
                        }
                    }
                    return ;
                }else
                {
                    $('.sh-uae').hide();
                    $('.hd-uae').show();
                    $('input[name="id_no"]').rules('remove', "required");$('#id_no').removeClass('is-invalid');
                    $('input[name="passport"]').rules('add', { required: true, messages: {required:''}});
                    $('input[name="pp_expiry"]').rules('add', { required: true, messages: {required:''}});
                    $('input[name="uid_number"]').rules('add', { required: true, messages: {required:''}});
                    $('input[name="uid_expiry"]').rules('add', { required: true, messages: {required:''}});
                    for (var i = 1; i <= $('#requirements_count').val(); i++) {
                        if($('#req_id_'+i).val() == 6){
                            docRules['doc_issue_date_' + i] = 'required';
                            docRules['doc_exp_date_' + i] = 'required';
                        }
                    }
                }
                var url = "{{route('artist.checkVisaRequired', ':id')}}";
                url = url.replace(':id', nationality);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (result) {
                        $('#nationality_cont').val(result.trim());
                        // console.log(result.trim())
                        if(result.trim() == "EU")
                        {
                            $('select[name="visa_type"]').rules('remove', "required");$('#visa_type').removeClass('is-invalid');
                            $('input[name="visa_number"]').rules('remove', "required");$('#visa_number').removeClass('is-invalid');
                            $('input[name="visa_expiry"]').rules('remove', "required");$('#visa_expiry').removeClass('is-invalid');
                            $('.hd-eu').hide();
                        }else {
                            $('select[name="visa_type"]').rules('add', { required: true, messages: {required:''}});
                            $('input[name="visa_number"]').rules('add', { required: true, messages: {required:''}});
                            $('input[name="visa_expiry"]').rules('add', { required: true, messages: {required:''}});
                            $('.hd-eu').show();
                        }
                        
                    }
                });
            }
        }



        var docRules = {};
        var docMessages = {};
        var term;

        for(var i = 1; i < $('#requirements_count').val(); i++)
        {
            var noofdays = $('#permitNoOfDays').val();
            term = $('#permitTerm_'+i).val();
            if((term == 'long' && noofdays > 30) || term == 'short')
            {
                docRules['doc_issue_date_'+i] = 'required';
                docRules['doc_exp_date_'+i] = 'required';
                docMessages['doc_issue_date_'+i] = 'This field is required';
                docMessages['doc_exp_date_'+i] = 'This field is required';
            }
        }

        $( "#check_inst" ).on( "click", function() {
            setThis('none', 'block', 'block', 'none');
        });

        $( "#artist_det" ).on( "click", function() {
            if(!checkForTick()) return ;
            setThis('block', 'block', 'none', 'none');
        });

        $( "#upload_doc" ).on( "click", function() {
            wizard = new KTWizard("kt_wizard_v3");
            if(!checkForTick()) return ;
            wizard.currentStep == 3 ? ( detailsValidator.form() ? setThis('block', 'none', 'none', 'block') : stopNext(detailsValidator) ) : setThis('block', 'none', 'none', 'block') ;
        });

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
        }

        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result ;
            if (wizard.currentStep == 1) {
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
            }else{
                result = true;
            }
            return result;
        }



    $('#next_btn').click(function(){
        wizard = new KTWizard("kt_wizard_v3");

        checkForTick();
       // checking the next page is artist details
       if(wizard.currentStep == 2)
       {
            stopNext(detailsValidator); // validating the artist details page
            // object of array storing the artist details
            var artist_id = $('#artist_number').val() ;
            if(detailsValidator.form())
            {
                $('#submit_btn').css('display', 'block'); // display the submit button
                $('#next_btn').css('display', 'none'); // hide the next button
                $('#addNew_btn').css('display', 'block'); // display the add new artist button
                artistDetails = {
                    id: $('#artist_id').val(),
                    code: $('#code').val(),
                    fname_en: $('#fname_en').val(),
                    fname_ar:  $('#fname_ar').val(),
                    lname_en: $('#lname_en').val(),
                    lname_ar:  $('#lname_ar').val(),
                    nationality: $('#nationality').val(),
                    profession: $('#profession').val(),
                    permit_type: $('#permit_type').val(),
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
                    fax_number: $('#fax_no').val(),
                    po_box: $('#po_box').val(),
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

        var nationality = $('#nationality').val();

        if(nationality)
        {
            var noofdays = $('#permitNoOfDays').val();
            var term ;
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
                term = $('#permitTerm_'+i).val();
                if((term == 'long' && noofdays > 30) || term == 'short')
                {
                    $('#cnd_'+i).html('*');
                    $('#cnd_'+i).addClass('text-danger');
                    if(nationality == '232' && $('#req_name_'+i).val().toLowerCase() == 'visa')
                    {
                        $('#cnd_'+i).html('');
                        $('#cnd_'+i).removeClass('text-danger');
                    }
                }else{
                    $('#cnd_'+i).html('');
                    $('#cnd_'+i).removeClass('text-danger');
                }
            }
        }

    });



    const docValidation = () => {
        var artist_number = $('#artist_number').val();
        var hasFile = true;
        var hasFileArray = [];
        documentDetails = {};
        var noofdays = $('#permitNoOfDays').val();
        var nationality = $('#nationality').val();
        var term ;
        for(var i = 1; i <= $('#requirements_count').val(); i++)
        {
            term = $('#permitTerm_'+i).val();
            if((term == 'long' && noofdays > 30) || term == 'short')
            {
                if ($('#ajax-file-upload_' + i).length) {
                    if($('#ajax-file-upload_'+i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_"+i).css('border', '2px dotted red');
                    }
                    else{
                        hasFileArray[i] = true;
                        $("#ajax-upload_"+i).css('border', '2px dotted #A5A5C7');
                    }
                }
                if(nationality == '232' && $('#req_id_'+i).val() == 6)
                {
                    hasFileArray[i] = true;
                    $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                }
            }
            documentDetails[i] = {
                issue_date :   $('#doc_issue_date_'+i).val(),
                exp_date : $('#doc_exp_date_'+i).val()
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

        documentsValidator = $('#documents_required').validate({
            rules: docRules,
            messages: docMessages
        })

        if(documentsValidator.form() && hasFile){

            $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
        // var artist_permit_id = $('#artist_permit_id').val();
        var permit_id = $('#permit_id').val();
        var temp_id = $('#temp_id').val();
        var ad = localStorage.getItem('artistDetails');
        var dd = localStorage.getItem('documentDetails');
        var issue_d = $('#issue_date').val();
        var expiry_d = $('#expiry_date').val();
        var fromPage = $('#fromPage').val();

        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        $.ajax({
                url:"{{route('company.update_artist_temp')}}",
                type: "POST",
                // processData:false,
                // data: { permitDetails: pd},
                data: {
                    artistD: ad ,
                    documentD: dd,
                    temp_id: temp_id,
                    permit_id: permit_id,
                    issue_d: issue_d,
                    expiry_d: expiry_d,
                    from: fromPage
                },
                success: function(result){

                    // console.log(result)
                    if(result.message[0] == 'success')
                    {
                        $('#submit_btn').removeClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');

                        localStorage.clear(); let toUrl = '';
                        if(fromPage == 'new')
                        {
                            toUrl = "{{url('company/artist/new')}}";
                            window.location.href= toUrl +'/'+ permit_id;
                        } else {
                            toUrl= "{{route('artist.permit',[ 'id' => ':id' , 'from' => ':from'])}}";;
                            if(fromPage == 'amend'){
                                toUrl = toUrl.replace(':from', 'amend');
                            }else if(fromPage == 'edit') {
                                toUrl = toUrl.replace(':from', 'edit');
                            } else if(fromPage == 'renew') {
                                toUrl = toUrl.replace(':from', 'renew');
                            } else if(fromPage == 'draft') {
                                toUrl = toUrl.replace(':from', 'draft');
                            }  else if(fromPage == 'event') {
                                toUrl = toUrl.replace(':from', 'event');
                            }
                            toUrl = toUrl.replace(':id', permit_id);
                            window.location.href= toUrl ;
                        }

                    }
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
            $('#back_btn').css('display', 'block');
       }else{
            $('#prev_btn').css('display', 'block');
            $('#next_btn').css('display', 'block');
       }
       $('#submit_btn').css('display', 'none');
    });



    $('.date-picker').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true
    })

    $('#dob').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true, startView: 2, endDate:'-10Y'});

    $('#dob').on('changeDate', function(ev) { $('#dob').valid() || $('#dob').removeClass('invalid').addClass('success'); });
    $('#uid_expiry').on('changeDate', function(ev) { $('#uid_expiry').valid() || $('#uid_expiry').removeClass('invalid').addClass('success');});
    $('#pp_expiry').on('changeDate', function(ev) { $('#pp_expiry').valid() || $('#pp_expiry').removeClass('invalid').addClass('success');});
    $('#visa_expiry').on('changeDate', function(ev) { $('#visa_expiry').valid() || $('#visa_expiry').removeClass('invalid').addClass('success');});


    const getAreas = (city_id, sel_id, language_id) => {
        $.ajax({
                url:"{{url('company/fetch_areas')}}"+'/'+city_id,
                success: function(result){
                    // console.log(result)
                    $('#area').empty();
                    $('#area').append('<option value=" ">Select</option>');
                    for(let i = 0; i< result.length;i++)
                    {
                        if(language_id == "1"){
                            $('#area').append('<option value="'+result[i].id+'" >'+result[i].area_en+'</option>');
                        }
                        else if(language_id == "2"){
                            $('#area').append('<option value="'+result[i].id+'" >'+result[i].area_ar+'</option>');
                        }
                    }
                    if(sel_id){
                        $('#area').val(sel_id);
                    }
                }
            });

    }

</script>
@endsection