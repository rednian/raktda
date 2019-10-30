@extends('layouts.app')

@section('title', 'Add New Permit - Smart Government Rak')
@section('content')

{{-- {{dd(session()->all())}} --}}
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Add New Artist Permit
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn-label-back btn-sm kt-font-bold kt-font-transform-u"
                    title="Go Back">
                    <i class="la la-arrow-left"></i>
                    Back
                </button>
                <button id="add_artist" class="btn btn-label-yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()" title="Add Artist">
                    <i class="la la-plus"></i>
                    Add Artist
                </button>
            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn" class="btn btn-label-back btn-elevate btn-sm kt-font-bold kt-font-transform-u"
                    title="Go Back">
                    <i class="la la-arrow-left"></i>
                </button>
                <button id="add_artist" class="btn btn-label-yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()" title="Add Artist">
                    <i class="la la-plus"></i>
                </button>
            </div>
        </div>
    </div>
    @php
    $user_id = Auth::user()->user_id;
    @endphp
    <div class="kt-portlet__body">
        <div class="kt-widget5__info px-4">
            <div class="pb-2">
                <!--begin: Permit Details Wizard-->
                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                    <div class="kt-form__section kt-form__section--first">
                        <div class="kt-wizard-v3__form">
                            <form id="permit_details" method="POST">
                                <div class=" row">
                                    <div class="form-group col-lg-3">
                                        <label for="permit_from" class="col-form-label col-form-label-sm">From
                                            Date <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="la la-calendar"></i></span></div>
                                            <input type="text" class="form-control form-control-sm" name="permit_from"
                                                id="permit_from" data-date-start-date="+0d" placeholder="DD-MM-YYYY"
                                                onchange="checkFilled()"
                                                value="{{ count($artist_details) > 0 ? date('d-m-Y',strtotime($artist_details[0]->issue_date)) : ( session($user_id.'_apn_from_date') ? session($user_id.'_apn_from_date') : '') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="permit_to" class="col-form-label col-form-label-sm">To
                                            Date <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="la la-calendar"></i></span></div>
                                            <input type="text" class="form-control form-control-sm" name="permit_to"
                                                id="permit_to" data-date-start-date="+1d" placeholder="DD-MM-YYYY"
                                                onchange="checkFilled()"
                                                value="{{count($artist_details) > 0 ? date('d-m-Y',strtotime($artist_details[0]->expiry_date)) :( session($user_id.'_apn_to_date') ? session($user_id.'_apn_to_date') : '') }}" />
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Location"
                                            name="work_loc" id="work_loc" onkeyup="checkFilled()"
                                            value="{{count($artist_details) > 0 ? $artist_details[0]->work_location :(session($user_id.'_apn_location') ? session($user_id.'_apn_location') : '') }}" />
                                    </div>
                                    {{-- <div class="form-group col-lg-3">
                                        <label for="" class="col-form-label col-form-label-sm">Connected Event
                                            ?</label>
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="isEvent" value="0"> Yes
                                                <span></span>
                                            </label>
                                            <label class="kt-radio kt-radio--solid">
                                                <input type="radio" name="isEvent" checked value="1"> No
                                                <span></span>
                                            </label>
                                        </div>
                                    </div> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Permit details wizard end --}}
            </div>
        </div>

        <input type="hidden" id="temp_permit_id" value="{{$permit_id}}">

        <div class="table-responsive">
            <table class="table table-striped border table-hover table-borderless">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Profession</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($artist_details) > 0)
                    @foreach($artist_details as $ad)
                    {{-- {{dd($ad)}} --}}
                    <tr>
                        <td>{{$ad->firstname_en}}</td>
                        <td>{{$ad->lastname_en}}</td>
                        <td>{{$ad->profession['name_en']}}</td>
                        <td>{{$ad->mobile_number}}</td>
                        <td>{{$ad->email}}</td>
                        <td>{{$ad->artist_permit_status}}</td>
                        <td>
                            <a href="{{route('artist.edit_artist',[ 'id' => $ad->id , 'from' => 'new'])}}" title="Edit">
                                <button class="btn btn-sm btn-secondary btn-elevate">Edit</button>
                            </a>
                            <a href="#" data-toggle="modal" onclick="getArtistDetails({{$ad->id}})" title="View">
                                <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                            </a>
                            @if(count($artist_details) > 1)
                            <a href="#"
                                onclick="delArtist({{$ad->id}},{{$ad->permit_id}},'{{$ad->firstname_en}}','{{$ad->lastname_en}}')"
                                data-toggle="modal" data-target="#delartistmodal" title="Delete">
                                <button class="btn btn-sm btn-secondary btn-elevate">Remove</button>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-center">Please Add Artists ...!</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">

        <div class="d-flex justify-content-between">
            <button
                class="btn btn-label-maroon btn-sm btn-wide kt-font-bold kt-font-transform-u {{ count($artist_details) == 0 ? 'd-none' : ''}}"
                id="draft_btn" title="Save as Draft">
                <i class="la la-check"></i>
                Save As Draft
            </button>

            <button
                class="btn btn-label-maroon btn-sm btn-wide kt-font-bold kt-font-transform-u {{ count($artist_details) == 0 ? 'd-none' : ''}}"
                id="submit_btn" {{ count($artist_details) == 0 ? 'disabled' : ''}} title="Submit Permit">
                <i class="la la-check"></i>
                Submit Permit
            </button>
        </div>

    </div>


    @include('permits.artist.modals.view_artist')

    @include('permits.artist.modals.remove_artist')

    <!--begin::Modal-->
    <div class="modal fade" id="back_btn_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave Page Warning !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    Changes you made may not be saved.
                    <input type="submit" value="Dont Save" onclick="go_back_confirm_function()"
                        class="btn btn-label-maroon btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->


    @endsection


    @section('script')
    <script>
        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
        });

        $(document).ready(function(){
            $('#add_artist').attr('disabled', true);
            checkFilled();
        });

        $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});
        $('#permit_from').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });
        $('#permit_to').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });

        $('#permit_from').on('changeDate', function (selected) {
            $('#permit_from').valid() || $('#permit_from').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            $('#permit_to').datepicker('setStartDate', minDate);
        });
        $('#permit_to').on('changeDate', function (ev) {
            $('#permit_to').valid() || $('#permit_to').removeClass('invalid').addClass('success');
        });


        function checkFilled(){
            var from = $('#permit_from').val();
            var to = $('#permit_to').val();
            var loc = $('#work_loc').val();
            var artistcount = $('#total_artist_details').val();
            $('#add_artist').attr('disabled', loc == '' ? true : false) ;
            if(from && to && loc) {
                $('#add_artist').attr('disabled', false);
                if(artistcount > 0)
                {
                    $('#draft_btn').css('display', 'block');
                    $('#submit_btn').css('display', 'block');
                }
            }else {
                $('#add_artist').attr('disabled', true);
                $('#draft_btn').css('display', 'none');
                $('#submit_btn').css('display', 'none');
            }
        }

        function setCokkie(){
            var from = $('#permit_from').val();
            var to = $('#permit_to').val();
            var loc = $('#work_loc').val();
            var permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('company.storePermitDetails')}}",
                    type: "POST",
                    data: { from: from , to:to, loc:loc },
                    async: true,
                    success: function(result){
                        window.location.href="{{url('company/add_new_artist')}}"+ '/'+permit_id;
                    }
            });
        }

        $('#back_btn').click(function(){
            $total_artists = $('#total_artist_details').val();

            if($total_artists > 0) {
                $('#back_btn_modal').modal('show');
            } else {
                window.location.href = "{{route('artist.index')}}#applied";
            }
        });

        function go_back_confirm_function(){
            var temp_permit_id =  $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('company.clear_the_temp_data')}}",
                    type: "POST",
                    data: { permit_id: temp_permit_id, from: 'add_new'},
                    async: true,
                    success: function(result){
                        window.location.href="{{route('artist.index')}}#applied";
                    }
            });
        }

        function delArtist(temp_id, permit_id, fname, lname) {
            $('#del_temp_id').val(temp_id);
            $('#del_permit_id').val(permit_id);
            $('#del_fname').val(fname);
            $('#warning_text').html('Are you sure to remove <b>' + fname + ' ' + lname + '</b> from this permit ?');
            $('#warning_text').css('color', '#580000');
        }



        var permitValidator = $('#permit_details').validate({
            rules: {
                permit_from: 'required',
                permit_to: 'required',
                work_loc: 'required'
            },
            messages: {
                permit_from:  'This field is required',
                permit_to: 'This field is required',
                work_loc:  'This field is required'
            }

        });

        // $('#add_artist').click(function(){
        //     var from = $('#permit_from').val();
        //     var to = $('#permit_to').val();
        //     var loc = $('#work_loc').val();
        //     $.ajax({
        //             url:"{{route('company.add_new_artist')}}",
        //             type: "POST",
        //             data: { from: from , to: to , loc: loc},
        //             success: function(result){
        //                 // window.location.href="{{url('company/add_new')}}";
        //             }
        //         });
        // })

        function getArtistDetails(id) {
            $.ajax({
                type: 'POST',
                url: '{{route("company.fetch_artist_temp_data")}}',
                data: {artist_temp_id:id},
                success: function(data) {
                    $('#detail-permit').empty();
                    if(data)
                    {
                        $('#artist_details').modal('show');
                        var code = data.person_code ? data.person_code : '';
                        $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr>  <th>First Name</th> <td >' + data.firstname_en + '</td>  <th>Last Name</th> <td>' + data.lastname_en + '</td></tr> <tr>  <th>First Name - Ar</th> <td >' + data.firstname_ar + '</td>  <th>Last Name - Ar</th> <td>' + data.lastname_ar + '</td></tr><tr><th>Profession</th> <td >' + data.profession.name_en + '</td>  <th>Nationality</th> <td >' +  data.nationality.nationality_en + '</td> </tr> <tr><th>Email</th> <td>' + data.email + '</td>  <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr><tr><th>Passsport</th> <td >' + data.passport_number + '</td><th>Passsport Exp</th> <td >' +moment(data.passport_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr><tr><th>BirthDate</th><td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Visa Type</th><td>'+ data.visa_type.visa_type_en + '</td></tr><tr><th>Visa Number</th> <td >' + data.visa_number + '</td> <th>Visa Expiry</th> <td>'+moment(data.visa_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr><tr><th>UID Number</th> <td >' + data.uid_number + '</td> <th>UID Expiry</th> <td>'+moment(data.uid_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr></table>');

                    }
                }
            });
        }


        $('#submit_btn').click((e) => {
            $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
            var temp_permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('artist.store')}}",
                    type: "POST",
                    data: { temp_permit_id:temp_permit_id },
                    success: function(result){
                        $('#submit_btn').removeClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
                        window.location.href="{{route('artist.index')}}#applied";
                    }
            });
        });

        $('#draft_btn').click((e) => {
            $('#draft_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
            var temp_permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('artist.add_draft')}}",
                    type: "POST",
                    data: { temp_permit_id:temp_permit_id },
                    success: function(result){
                        $('#draft_btn').removeClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
                        window.location.href="{{route('artist.index')}}#draft";
                    }
                });
        });


    </script>

    @endsection
