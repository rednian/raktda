@extends('layouts.app')

@section('title', 'Add New Permit - Smart Government Rak')
@section('content')

{{-- {{dd(session()->all())}} --}}
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Add Artist to Event Permit
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u" title="Go Back">
                    <i class="la la-arrow-left"></i>
                    Back
                </button>
                <button id="add_artist" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()" title="Add Artist">
                    <i class="la la-plus"></i>
                    Add Artist
                </button>
            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u"
                    title="Go Back">
                    <i class="la la-arrow-left"></i>
                </button>
                <button id="add_artist_sm" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
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
                            <form id="permit_details" method="POST" autocomplete="off">
                                <div class=" row">
                                    <div class="form-group col-lg-2">
                                        <label for="permit_from" class="col-form-label col-form-label-sm ">From
                                            Date <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control form-control-sm mk-disabled"
                                                    name="permit_from" id="permit_from" placeholder="DD-MM-YYYY"
                                                    value="{{date('d-m-Y', strtotime($event->issued_date))}}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-2">
                                        <label for="permit_to" class="col-form-label col-form-label-sm">To
                                            Date <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text" class="form-control form-control-sm mk-disabled"
                                                    name="permit_to" id="permit_to" placeholder="DD-MM-YYYY"
                                                    value="{{date('d-m-Y', strtotime($event->expired_date))}}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-3">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            Location <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm mk-disabled"
                                            placeholder="Location" name="work_loc" id="work_loc"
                                            value="{{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}" />
                                    </div>
                                    <div class="form-group col-lg-2">
                                        <label for="" class="col-form-label col-form-label-sm">Connected Event
                                            ?</label>
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio ">
                                                <input type="radio" name="isEvent" checked value="1">
                                                Yes
                                                <span></span>
                                            </label>
                                            <label class="kt-radio ">
                                                <input type="radio" name="isEvent" value="0" disabled> No
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="event_id" class="col-form-label col-form-label-sm">
                                            Events <span class="text-danger">*</span></label>
                                        <select type="text" class="form-control form-control-sm mk-disabled"
                                            name="event_id" id="event_id">
                                            <option value=" ">Select</option>
                                            <option value="{{$event->event_id}}" selected>
                                                {{getLangId() == 1 ? $event->name_en : $event->name_ar}}</option>
                                        </select>
                                    </div>
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
                        {{-- <th>Email</th> --}}
                        <th>Status</th>
                        <th class="text-center">Actions</th>
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
                        {{-- <td>{{$ad->email}}</td> --}}
                        <td>{{$ad->artist_permit_status}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{route('artist.edit_artist',[ 'id' => $ad->id , 'from' => 'event'])}}"
                                title="Edit">
                                <button class="btn btn-sm btn-secondary btn-elevate">Edit</button>
                            </a>
                            <a href="{{route('temp_artist_details.view' ,['id'=> $ad->id , 'from' => 'event'])}}"
                                title="View">
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

        <div class="d-flex flex-row-reverse">
            <button class=" btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u
            {{ count($artist_details) == 0 ? 'd-none' : ''}}" id="submit_btn" title="Submit Permit">
                <i class="la la-check"></i>
                Submit Permit
            </button>
        </div>

    </div>


    @include('permits.artist.modals.view_artist')

    @include('permits.artist.modals.remove_artist', ['from' => 'new'])

    @include('permits.artist.modals.leave_page')

    @endsection


    @section('script')
    <script src="{{ asset('js/company/artist.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
        });

        function setCokkie(){
            var from = $('#permit_from').val();
            var to = $('#permit_to').val();
            var loc = $('#work_loc').val();
            var eventId = $('#event_id').val();
            var isEvent = $("input:radio[name='isEvent']:checked").val();
            var permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('company.storePermitDetails')}}",
                    type: "POST",
                    data: { from: from , to:to, loc:loc, eventId:eventId, isEvent: isEvent },
                    async: true,
                    success: function(result){
                        window.location.href="{{url('company/artist/add_new')}}"+ '/'+permit_id + '/event';
                    }
            });
        }

        $('#back_btn').click(function(){
            $total_artists = $('#total_artist_details').val();

            if($total_artists > 0) {
                $('#back_btn_modal').modal('show');
            } else {
                window.location.href = "{{route('event.index')}}#applied";
            }
        });

        $('#back_btn_sm').click(function(){
            $total_artists = $('#total_artist_details').val();

            if($total_artists > 0) {
                $('#back_btn_modal').modal('show');
            } else {
                window.location.href = "{{route('event.index')}}#applied";
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
                        window.location.href="{{route('event.index')}}#applied";
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

        $('#submit_btn').click((e) => {
            $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
            var temp_permit_id = $('#temp_permit_id').val();
            var noofdays = dayCount($('#permit_from').val(), $('#permit_to').val());var term;
            if(noofdays < 30) { term = 'short'; } else { term='long';}
            $.ajax({
                    url:"{{route('artist.store')}}",
                    type: "POST",
                    data: {
                        temp_permit_id:temp_permit_id ,
                        from: $('#permit_from').val() ,
                        to: $('#permit_to').val(),
                        loc: $('#work_loc').val(),
                        event_id: $('#event_id').val(),
                        term: term
                    },
                    success: function(result){
                        $('#submit_btn').removeClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
                        window.location.href="{{route('artist.index')}}#applied";
                    }
            });
        });


    </script>

    @endsection