@extends('layouts.app')

@section('title', 'Account Information - Smart Government Rak')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/jquery.filer/css/jquery.filer.css') }}">
<link rel="stylesheet" type="text/css"
  href="{{ asset('assets/vendors/custom/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}">
<link rel="stylesheet" href="{{asset('css/jquery.ccpicker.css')}}" />
<style>
  .jFiler-items-default .jFiler-item {
    padding: 8px;
    margin-bottom: 5px;
  }
</style>
@stop
@section('content')

@if(check_is_blocked()['status'] == 'rejected')
@include('permits.artist.common.company_reject')
@endif

@if(check_is_blocked()['status'] == 'blocked')
@include('permits.artist.common.company_block')
@endif


<div class="kt-portlet kt-portlet--tabs">
  <div class="kt-portlet__head">
    <div class="kt-portlet__head-toolbar">
      <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger"
        role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#user-profile" role="tab" aria-selected="false">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
              height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
              <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                <path
                  d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                  fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                <path
                  d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                  fill="#000000" fill-rule="nonzero"></path>
              </g>
            </svg>{{__('Account Information')}}
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="kt-portlet__body kt-padding-t-15">
    <div class="tab-content">
      <div class="tab-pane active" id="user-profile" role="tabpanel">
        <div class="kt-form kt-form--label-right">
          <div class="kt-form__body col-sm-12 col-md-10">
            <div class="kt-section kt-section--first">
              <form action="{{route('company.updateUser', $company->company_id )}}" id="userdetails_form" method="POST"
                novalidate>
                @csrf
                <div class="kt-section__body mt-5">
                  {{-- <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Account:</h3>
                                        </div>
                                    </div> --}}
                  @php
                  $user = Auth::user();
                  @endphp
                  <div class="form-group  row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Name (EN)')}}</label>
                    <div class="col-lg-9 col-xl-6">
                      <input type="text" class="form-control form-control-sm" name="acccount_name_en"
                        id="acccount_name_en" dir="ltr" value="{{$user->NameEn}}" />
                    </div>
                  </div>

                   <div class="form-group  row">
                      <label class="col-xl-3 col-lg-3 col-form-label">{{__('Name (AR)')}}</label>
                      <div class="col-lg-9 col-xl-6">
                        <input type="text" class="form-control form-control-sm" name="acccount_name_ar"
                        id="acccount_name_ar" dir="rtl" value="{{$user->NameAr}}" />
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Username')}}</label>
                    <div class="col-lg-9 col-xl-6">
                      <input disabled class="form-control form-control-sm" id="account_username" name="account_username"
                        type="text" value="{{$user->username}}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Email Address')}}</label>
                    <div class="col-lg-9 col-xl-6">
                      {{-- <div class="input-group"> --}}
                        {{-- <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span>
                        </div> --}}
                        <input type="text" class="form-control form-control-sm" name="account_email" id="account_email"
                          value="{{$user->email}}" placeholder="Email" aria-describedby="basic-addon1">
                      {{-- </div> --}}
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Mobile Number')}}</label>
                    <div class="col-lg-9 col-xl-6">
                      <div class="input-group input-group-sm d-flex align-items-center">
                        {{-- <div class="input-group-prepend"><span class="input-group-text"><i
                              class="la la-mobile"></i></span></div> --}}
                        <input type="text" class="form-control form-control-sm" value="{{$user->mobile_number}}"
                          name="account_mobile" id="account_mobile" pattern="[0-9]+" min="0"
                          placeholder="Mobile Number">
                      </div>
                    </div>
                  </div>


                  {{-- <div class="form-group form-group-last row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked=""> Email
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked=""> SMS
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Phone
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}

                  <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                    <label class="col-xl-3 col-lg-3 col-form-label"></label>
                    <div class="col-lg-9 col-xl-6">
                      <button type="button" data-target="#changePasswordModal" data-toggle="modal"
                        class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">{{__('Change your Password ?')}}</button>
                    </div>
                  </div>
                </div>
            </div>

            <div>
              <button class="btn btn-sm btn--yellow {{ getLangId() == 1 ? 'pull-right' : 'pull-left'}}">{{__('Save Changes')}}</button>
            </div>
            </form>
          </div>
        </div>

      </div>
    </div>



    {{-- change password modal --}}

    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{__('Change Password ?')}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            </button>
          </div>
          <div class="modal-body container">
            <form action="{{route('company.changePassword', $company->company_id )}}" id="passwordChangeform"
              method="POST" novalidate>
              @csrf
              <div class="row kt-margin-b-2">
                <label for="" class="col-md-4 col-form-label">{{__('Old Password')}}</label>
                <div class="form-group form-group-sm col-md-6">
                  <input type="text" class="form-control form-control-sm " id="old_password" name="old_password">
                </div>
              </div>
              <div class="row kt-margin-b-2">
                <label for="" class="col-md-4 col-form-label">{{__('New Password')}}</label>
                <div class="form-group form-group-sm col-md-6">
                  <input type="text" class="form-control form-control-sm" id="new_password" name="new_password">
                </div>
              </div>
              <div class="row kt-margin-b-2">
                <label for="" class="col-md-4 col-form-label">{{__('Confirm Password')}}</label>
                <div class="form-group form-group-sm col-md-6">
                  <input type="text" class="form-control form-control-sm" id="confirm_password" name="confirm_password">
                </div>
              </div>
              <input type="submit" value="{{__('Change')}}" onclick="changePassword()"
                class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
          </div>
          </form>
        </div>
      </div>
    </div>

    {{-- change password modal --}}


    @endsection
    @section('script')
    <script src="{{ asset('assets/vendors/custom/jquery.filer/js/jquery.filer.js') }}"></script>
    <script src="{{asset('js/jquery.ccpicker.js')}}"></script>
    <script>
      window.files = [];
    var filenames = [];
    var name = null;
    var requirementTable = {};
    var is_valid = false;

    $(document).ready(function(){
    requirement();
    datePicker();
    type();
    uploaded();
    hasUrl();

    $('#account_mobile').CcPicker({
      dataUrl:"../../data.json",
      // countryFilter : false,
      searchPlaceHolder : 'Find...'
    });
    @if($user->phoneCode)
    $('#account_mobile').CcPicker('setCountryByPhoneCode','{{$user->phoneCode}}')
    @endif
    // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    // var current_tab = $(e.target).attr('href');

    // if('#new-request' == current_tab ){ newCompany(); }
    // if('#processing-request' == current_tab ){ processing(); }
    // if('#active-company' == current_tab ){ company(); }
    // });




    // $('form[name=edit_company]').validate({
    // submitHandler: function(form){
    // KTApp.block('.kt-portlet', {
    // overlayColor: '#000000',
    // type: 'v2',
    // state: 'success',
    // message: 'Please wait...'
    // });
    // },

    // invalidHandler: function(){
    // KTApp.unblock('.kt-portlet');
    // KTUtil.scrollTop();
    // },

    // });

  


    $('.select2').select2({
    placeholder: '{{__('Please select Area in Ras Al Khaimah')}}',
    allowClear: true
    });

    $('#btn-save').click(function(){
    var name = $('#upload-row').find('select').val();
    var file = document.getElementById('file').files;

    if(file.length == 0 ){
    $('#upload-row').find('#file').addClass('is-invalid');
    is_valid = false;
    }
    else{
    $('#upload-row').find('input#file').removeClass('is-invalid');
    is_valid = true;
    }

    if(name == null){
    $('#upload-row').find('select').addClass('is-invalid');
    is_valid = false;
    }
    else{
    $('#upload-row').find('select').addClass('is-valid');
    is_valid = true;
    }

    if(is_valid){
    $(this).removeAttr('disabled', true);
    upload();
    }
    else{
    $(this).attr('disabled', true);
    }


    });




    $('#upload-row').find('select').change(function(){
    var attr = $('#upload-row').find('input.date-picker');
    if(typeof attr !== typeof undefined && attr !== false ){
    attr.val(' ');
    }

    if($(this).val() && $('input[type=file]').prop('files') > 0){
    $('#upload-row').find('button#btn-save').removeAttr('disabled', true);
    $(this).removeClass('is-invalid').addClass('is-valid');
    $('inputfile]#file').val(' ');
    // files = [];
    }
    else{
    $('#upload-row').find('button#btn-save').attr('disabled', true);
    $(this).addClass('is-valid');
    }
    });

    $('#upload-row').find('input#file').change(function(){
    if ($(this).prop('files') > 0 && $('#upload-row').find('select').val() == null) {
    $('#upload-row').find('button#btn-save').attr('disabled', true);
    $(this).addClass('is-valid');
    }
    else{
    $('#upload-row').find('button#btn-save').removeAttr('disabled', true);
    $(this).removeClass('is-invalid').addClass('is-valid');
    }
    });


    });


    function hasUrl(){
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');
    $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
    });
    }



    function uploaded(){
    requirementTable = $('#upload-requirement-table').DataTable({
    dom: "<'row d-none'<'col-sm-12 col-md-6 '><' col-sm-12 col-md-6'>>" +
      "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-12 col-md-5'i>"+
          "<'col-sm-12 col-md-7'p>>", 
            ajax: '{{ route('company.requirement.datatable', $company->company_id) }}',
            // columnDefs:[{targets: [4], className:'no-wrap'}],
            "order": [[ 0, 'asc' ]],
            rowGroup: {
            startRender: function ( rows, group ) {
            var row_data = rows.data()[0];
            return $('<tr />').append( '<td>'+group+'</td>' )
            .append( '<td>'+rows.count()+'</td>' )
            .append( '<td>'+row_data.issued_date+'</td>' )
            .append( '<td>'+row_data.expired_date+'</td>' )
            .append( '<td></td>' )
            // .append( '<td>'+row_data.action+'</td>' )
            .append( '<tr />' );
            },
            dataSrc: 'name'
            },
            columns:[
            // {data: 'name'},
            {data: 'file'},
            {render: function(data){ return null}},
            {render: function(data){ return null}},
            {render: function(data){ return null}},
            {data: 'action'},
            ],
            createdRow: function(row, data, index){
            $('.btn-remove',row).click(function(){
            $.ajax({
            url: '{{ route('company.requirement.delete', $company->company_id) }}',
            data: {company_requirement_id : data.company_requirement_id, path: data.path},
            type: 'post',
            beforeSend: function(){
            KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            message: '{{__("Please wait...")}}'
            });
            }
            }).done(function(response, textStatus, xhr){
            if(xhr.status == 200){
            KTApp.unblockPage();
            requirementTable.ajax.reload();
            }
            });

            });
            }
            });
            }


            function upload(){

            var formData = new FormData();
            files.forEach(function(v, i){
            formData.append('files[]', v.file);
            });

            // formData.append('issued_date', $('#upload-date-start').val());
            // formData.append('expired_date', $('#upload-date-end').val());
            formData.append('requirement_id', $('select[name=requirement_id]').val());
            formData.append('requirement_name', name);

            $.ajax({
            url: '{{ route('company.upload', $company->company_id) }}',
            type: 'POST',
            data: formData,
            cache: false,
            processData:false,
            contentType: false,
            beforeSend: function(){
            KTApp.blockPage({
            overlayColor: '#000000',
            type: 'v2',
            state: 'success',
            message: '{{__("Please wait...")}}'
            });
            },
            }).done(function(response, textStatus, xhr){

            if(xhr.status == 200){
            $('#upload-row').find('input').val('');
            $('#upload-row').find('input').removeClass('is-valid');
            $('#upload-row').find('select[name=requirement_id]').removeClass('is-valid');
            $('#upload-row').find('select[name=requirement_id]')[0].selectedIndex = 0;
            requirementTable.ajax.reload();
            KTApp.unblockPage();
            files = [];
            $('#upload-date-start').val(' ');
            $('#upload-date-end').val('');
            }
            });
            }

            function readUrl(input) {

            if(input.files.length > 0){
            $.each(input.files, function(i, v){
            var reader = new FileReader();
            reader.readAsDataURL(v);
            files.push({ file: v});
            reader.onload = function(e){
            files.push(e.target.result);
            };
            });
            }

            }


            function type(){
            $('select[name=company_type_id]').change(function(){
            //if establishment type is corporate
            if($(this).val() == 2){
            $('#trade-license-container').removeClass('kt-hide').find('input').removeAttr('disabled',
            true).attr('required', true);

            }
            else{
            $('#trade-license-container').addClass('kt-hide').find('input').attr('disabled',
            true).removeAttr('required', true);
            }
            });
            }


            function requirement(){
            $('select[name=requirement_id]').change(function(){
            if($(this).find('option:selected').data('date') != 1){
            $('.date-required').find('input').attr('disabled', true);
            $('.date-required').find('span').addClass('kt-hide');
            }
            else{
            $('.date-required').find('input').removeAttr('disabled', true);
            $('.date-required').find('span').removeClass('kt-hide');
            }
            name = $(this).find('option:selected').data('name');
            });

            $('select[name=requirement_id]').html('');
            $('select[name=requirement_id]').append('<option selected disabled>Select Requirement</option>');
            $.ajax({
            url: '{{ route('company.requirement') }}',
            dataType: 'json',
            }).done(function(response){
            if(response){
            $.each(response, function(i, v){
            $('select[name=requirement_id]').append('<option data-name="'+v.requirement_name+'"data-date="'+v.dates_required+'" value="'+v.requirement_id+'">'+v.requirement_name+'</option>');
            });
            $('select[name=requirement_id]').append('<option value="other upload">Other</option>');
            }
            });
            }


            $('#userdetails_form').validate({
            rules:{
            acccount_name_en: 'required',
            account_username: {
            required: true,
            minlength: 5,
            remote: {
            url: '{{route('company.account_exists')}}',
            type: 'post',
            data: { username: function(){
            return $('#account_username').val();
            }}
            }
            },
            account_email: {
            required: true,
            email: true,
            remote: {
            url: '{{route('company.account_exists')}}',
            type: 'post',
            data: {email: function(){
            return $('#account_email').val();
            }}
            }
            },
            account_mobile: {
            required: true,
            remote: {
            url: '{{route('company.account_exists')}}',
            type: 'post',
            data: {mobile_number:  $('#account_mobile').val()
            ,phoneCode: $('#account_mobile_phoneCode').val() },
            }
            }
            },
            messages: {
            acccount_name_en: 'Please fill in the name',
            account_username: {
            required: 'Please fill in the username',
            minlength: 'Minimum 5 characters required',
            remote: 'This Username already exists'
            },
            account_email: {
            required: 'Please fill in the Email',
            email: 'Please Enter a valid Email',
            remote: 'This Email already exists'
            },
            account_mobile: {
            required: 'Please fill in the mobile',
            remote: 'This Mobile Number already exists'
            }
            }
            });


            $('#passwordChangeform').validate({
            rules: {
            old_password: {
            required: true,
            remote: {
            url: '{{route('company.account_exists')}}',
            type: 'post',
            data: {old_password: function(){
            return $('#old_password').val();
            }},
            delay: 1000
            }
            },
            new_password: {
            required: true,
            minlength: 8 ,
            notEqual: "#account_username",
            pwcheck: true,
            },
            confirm_password: {
            required: true,
            equalTo: "#new_password"
            }
            },
            messages: {
            old_password: {
            required: 'Please fill in the old password',
            remote: 'Password is wrong'
            },
            new_password: {
            required: 'Please fill in the new password',
            minlength: 'Minimum 8 characters required',
            pwcheck: 'At Least one lowercase letter and one digit'
            },
            confirm_password: {
            required: 'Please fill in the confirm password',
            equalTo: 'New password and confirm password should be same',
            }
            }
            })

            $.validator.addMethod("pwcheck", function(value) {
            return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
            });

            $.validator.addMethod("notEqual", function(value, element, param) {
            return this.optional(element) || value != param;
            }, "Should not be the same as username");

            function datePicker(){
            var arrows;
            if (KTUtil.isRTL()) {
            arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
            }
            } else {
            arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
            }
            }

            var date = new Date();
            date.setDate(date.getDate()+1);

            $('.date-picker.end').datepicker({
            rtl: KTUtil.isRTL(),
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
            startDate: date,
            templates: arrows,
            format:'dd-mm-yyyy',
            });

            $('.date-picker.start').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom left",
            endDate: '+0d',
            templates: arrows,
            format:'dd-mm-yyyy',
            });
            }
    </script>
    @endsection