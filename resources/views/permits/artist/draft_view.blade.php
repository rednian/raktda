@extends('layouts.app')

@section('title', 'Add New Permit - Smart Government Rak')
@section('content')

{{-- {{dd(session()->all())}} --}}
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('View Draft Details')}}
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                    {{__('Back')}}
                </button>
                {{-- <button id="add_artist" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()">
                    <i class="la la-plus"></i>
                    Add Artist
                </button> --}}
                <a href="{{url('company/artist/add_new/'.$artist_details[0]->permit_id.'/draft')}}">
                    <button id="add_artist" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                        <i class="la la-plus"></i>
                        {{__('Add Artist')}}
                    </button>
                </a>
            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                </button>
                {{-- <button id="add_artist" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()">
                    <i class="la la-plus"></i>
                </button> --}}
                <a href="{{url('company/artist/add_new/'.$artist_details[0]->permit_id.'/draft')}}">
                    <button id="add_artist_sm" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                        <i class="la la-plus"></i>
                    </button>
                </a>
            </div>
        </div>
    </div>
    @php
    $user_id = Auth::user()->user_id;
    @endphp
    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-widget5__info px-4">
            <div class="pb-2">
                <!--begin: Permit Details Wizard-->
                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                    <div class="kt-form__section kt-form__section--first">
                        <div class="kt-wizard-v3__form">
                            <form id="permit_details" method="POST" autocomplete="off">
                                <div class=" row">
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_from"
                                            class="col-form-label col-form-label-sm">{{__('From Date')}} <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text"
                                                    class="form-control form-control-sm {{ count($artist_details) > 0 ? 'mk-disabled': ''}}"
                                                    name="permit_from" id="permit_from" placeholder="DD-MM-YYYY"
                                                    data-date-start-date="+0d" onchange="checkFilled();givWarn()"
                                                    value="{{ count($artist_details) > 0 ? date('d-m-Y',strtotime($artist_details[0]->issue_date)) : '' }}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="artiststartafter"
                                        value="{{getSettings()->artist_start_after}}">

                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_to"
                                            class="col-form-label col-form-label-sm">{{__('To Date')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text"
                                                    class="form-control form-control-sm {{ count($artist_details) > 0 ? 'mk-disabled': ''}}"
                                                    name="permit_to" id="permit_to" data-date-start-date="+1d"
                                                    placeholder="DD-MM-YYYY" onchange="checkFilled()"
                                                    value="{{count($artist_details) > 0 ? date('d-m-Y',strtotime($artist_details[0]->expiry_date)) : '' }}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc"
                                            class="col-form-label col-form-label-sm">{{__('Work Location')}}<span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="work_loc"
                                            id="work_loc" onkeyup="checkFilled()"
                                            value="{{count($artist_details) > 0 ? getLangId() == 1 ? $artist_details[0]->work_location : $artist_details[0]->work_location_ar :(session($user_id.'_apn_location') ? session($user_id.'_apn_location') : '') }}" />
                                    </div>

                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location - Ar')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="work_loc_ar"
                                            id="work_loc_ar" onkeyup="checkFilled()" dir="rtl"
                                            value="{{count($artist_details) > 0 ? $artist_details[0]->work_location_ar :(session($user_id.'_apn_location_ar') ? session($user_id.'_apn_location_ar') : '')}}" />
                                    </div>
                                    {{-- {{dd($artist_details[0])}} --}}
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="" class="col-form-label col-form-label-sm">{{__('Connected Event')}}
                                            ?</label>
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio ">
                                                <input type="radio" name="isEvent" onClick="changeIsEvent(1)" value="1"
                                                    {{$artist_details[0]->event ? 'checked' : ''}}> {{__('Yes')}}
                                                <span></span>
                                            </label>
                                            <label class="kt-radio ">
                                                <input type="radio" name="isEvent" onClick="changeIsEvent(0)"
                                                    {{$artist_details[0]->event ? '' : 'checked'}} value="0">
                                                {{__('No')}}
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <input type="hidden" value="{{$artist_details[0]->event}}" id="eventdetails" />

                                    <div class="form-group col-lg-3 kt-margin-b-0" id="events_div">
                                        <label for="event_id" class="col-form-label col-form-label-sm">
                                            {{__('Events')}} <span class="text-danger">*</span></label>
                                        <select type="text" class="form-control form-control-sm" name="event_id"
                                            id="event_id" onchange="check_Add_Event()">
                                            <option value=" ">{{__('Select')}}</option>
                                            @if(count($events) > 0)
                                            @foreach($events as $event)
                                            <option value="{{$event->event_id}}"
                                                {{$artist_details[0]->event ? $artist_details[0]->event->event_id == $event->event_id ? 'selected' : '' : ''}}>
                                                {{getLangId() == 1 ? ucwords($event->name_en) : $event->name_ar}}
                                            </option>
                                            @endforeach
                                            @endif
                                            <option value="add_new" class="kt-font-bolder">{{__('Add New')}}</option>
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
        <div class="col-md-12 kt-margin-t-10">
            <div class="table-responsive">
                <table class="table table-striped table-hover border table-borderless">
                    <thead>
                        <tr>
                            <th>{{__('First Name')}}</th>
                            <th>{{__('Last Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th>{{__('Mobile Number')}}</th>
                            {{-- <th>Email</th> --}}
                            <th>{{__('Status')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($artist_details) > 0)
                        @foreach($artist_details as $ad)
                        {{-- {{dd($ad)}} --}}
                        <tr>
                            <td>{{getLangId() == 1 ? ucwords($ad->firstname_en) : $ad->firstname_ar}}</td>
                            <td>{{getLangId() == 1 ? ucwords($ad->lastname_en) : $ad->lastname_ar}}</td>
                            <td>{{getLangId() == 1 ? ucwords($ad->profession['name_en']) : $ad->profession['name_ar']}}
                            </td>
                            <td>{{$ad->mobile_number}}</td>
                            {{-- <td>{{$ad->email}}</td> --}}
                            <td>{{__($ad->artist_permit_status)}}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{URL::signedRoute('company.edit_artist_draft',[ 'id' =>  $ad->id])}}">
                                    <button class="btn btn-sm btn-secondary btn-elevate ">{{__('Edit')}}</button>
                                </a>
                                <a
                                    href="{{URL::signedRoute('temp_artist_details.view' , [ 'id' => $ad->id , 'from' => 'draft'])}}">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('View')}}</button>
                                </a>
                                @if(count($artist_details) > 1)
                                <a href="#"
                                    onclick="delArtist({{$ad->id}},{{$ad->permit_id}},'{{$ad->firstname_en}}','{{$ad->lastname_en}}')"
                                    data-toggle="modal" data-target="#delartistmodal">
                                    <button class="btn btn-sm btn-secondary btn-elevate ">{{__('Remove')}}</button>
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">{{__('Please Add Artists')}} ...!</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">

        <div class="d-flex justify-content-between">
            <button
                class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u {{ count($artist_details) < 0 ? 'd-none' :'' }}"
                id="draft_btn">
                <i class="la la-check"></i>
                {{__('Update to Drafts')}}
            </button>

            <button
                class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u {{ count($artist_details) < 0 ? 'd-none' :'' }}"
                id="submit_btn">
                <i class="la la-check"></i>
                {{__('Apply Permit')}}
            </button>
        </div>

    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="delartistmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Remove Artist')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('company.delete_artist_from_temp')}}" method="POST" autocomplete="off">
                        @csrf
                        <p id="warning_text"></p>
                        <input type="hidden" id="del_temp_id" name="del_temp_id" />
                        {{-- <input type="hidden" name="del_artist_from" value="draft" /> --}}
                        <input type="hidden" name="del_permit_id" id="del_permit_id">
                        <input type="submit" value="Remove"
                            class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->


    @include('permits.artist.modals.leave_page')

    @include('permits.artist.modals.show_warning_modal', ['day_count' =>getSettings()->artist_start_after ]);

    @endsection


    @section('script')
    <script src="{{ asset('js/company/artist.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
        });

        function changeIsEvent(id){
            if(id==1){
                $('#events_div').css('display', 'block');
            }else {
                $('#events_div').css('display', 'none');
            }
            checkFilled();
        }


        $(document).ready(function(){
            $('#add_artist').attr('disabled', true);
            checkFilled();
            var artiststartafter = $('#artiststartafter').val();
            var today = moment().toDate();
            var startDate = moment(today).add(artiststartafter, 'days').toDate();
            // $('#permit_from').datepicker('setStartDate', startDate);
            var minDate = moment($('#permit_from').val(), 'DD-MM-YYYY').toDate();
            var maxDate = moment(minDate).add(3, 'M').toDate();
            $('#permit_to').datepicker('setStartDate', minDate);
            $('#permit_to').datepicker('setEndDate', maxDate);
            var eventd = $('#eventdetails').val();
            if(eventd == '') $('#events_div').css('display', 'none');
        });


        $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});
        $('#permit_from').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
            zIndexOffset: 98
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
            var maxDate = moment(minDate).add(3, 'M').toDate();
            $('#permit_to').datepicker('setStartDate', minDate);
            $('#permit_to').datepicker('setEndDate', maxDate);
        });
        $('#permit_to').on('changeDate', function (ev) {
            $('#permit_to').valid() || $('#permit_to').removeClass('invalid').addClass('success');
        });


        function checkFilled(){
            var from = $('#permit_from').val();
            var to = $('#permit_to').val();
            var loc = $('#work_loc').val();
            var loc_ar = $('#work_loc_ar').val();
            var isEvent = $("input:radio[name='isEvent']:checked").val();
            var eventId = $('#event_id').val();
            var artistcount = $('#total_artist_details').val();
            $('#add_artist').attr('disabled', loc == '' || loc_ar == '' ? true : false) ;
            $('#add_artist_sm').attr('disabled', loc == '' || loc_ar == '' ? true : false) ;
            if(from && to && loc && loc_ar) {
                if(isEvent == 0 || (isEvent == 1 && eventId != ' '))
                {
                    $('#add_artist').attr('disabled', false);
                    $('#add_artist_sm').attr('disabled', false);
                    if(artistcount > 0)
                    {
                        $('#draft_btn').css('display', 'block');
                        $('#submit_btn').css('display', 'block');
                    }
                }
                else {
                    disabledThese();
                }
            }
            else
            {
                disabledThese();
            }

        }

        function disabledThese()
        {
            $('#add_artist').attr('disabled', true);
            $('#add_artist_sm').attr('disabled', true);
            $('#draft_btn').css('display', 'none');
            $('#submit_btn').css('display', 'none');
        }

        $('#back_btn , #back_btn_sm').click(function(){
            $total_artists = $('#total_artist_details').val();

            if($total_artists > 0) {
                $('#back_btn_modal').modal('show');
            } else {
                window.location.href = "{{url('artist.index')}}#draft";
            }
        });

        // $('#back_btn_sm').click(function(){
        //     $total_artists = $('#total_artist_details').val();

        //     if($total_artists > 0) {
        //         $('#back_btn_modal').modal('show');
        //     } else {
        //         window.location.href = "{{url('artist.index')}}#draft";
        //     }
        // });

        function go_back_confirm_function(){
            var temp_permit_id =  $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('company.clear_the_temp_data')}}",
                    type: "POST",
                    data: { permit_id: temp_permit_id, from: 'add_new'},
                    async: true,
                    success: function(result){
                        window.location.href=result.toURL;
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
       

        function check_Add_Event(){
            var event_id = $('#event_id').val();
            if(event_id == 'add_new')
            {
                window.location.href = "{{URL::signedRoute('event.create')}}";
            }else{
                checkFilled();
            }
        }


        $('#submit_btn').click((e) => {

            var temp_permit_id = $('#temp_permit_id').val();
            var noofdays = dayCount($('#permit_from').val(), $('#permit_to').val());var term;
            if(noofdays < 30) { term = 'short'; } else { term='long';}
            $.ajax({
                    url:"{{route('artist.store')}}",
                    type: "POST",
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'success',
                            message: 'Please wait...'
                        });  
                    },
                    data: {
                        temp_permit_id:temp_permit_id,
                        from: $('#permit_from').val() ,
                        to: $('#permit_to').val(),
                        loc: $('#work_loc').val(),
                        loc_ar: $('#work_loc_ar').val(),
                        event_id: $('#event_id').val(),
                        term: term,
                        fromWhere: 'draft'
                    },
                    success: function(result){
                        // window.location.href="{{route('artist.index')}}#applied";
                        window.location.href= result.toURL;
                        KTApp.unblockPage();
                    }
            });
        });

        $('#draft_btn').click((e) => {
            // $('#draft_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
            // $('#submit_btn').css('pointer-events', 'none');
            // $('#draft_btn').css('pointer-events', 'none');
            var temp_permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('artist.add_draft')}}",
                    type: "POST",
                    data: {
                        temp_permit_id:temp_permit_id ,
                        from: $('#permit_from').val() ,
                        to: $('#permit_to').val(),
                        loc: $('#work_loc').val(),
                        loc_ar: $('#work_loc_ar').val(),
                        event_id: $('#event_id').val()
                    },
                    beforeSend: function(){
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'success',
                            message: 'Please wait...'
                        });
                    },
                    success: function(result){
                        window.location.href= result.toURL;
                        KTApp.unblockPage();
                    }
                });
        });

        
        function givWarn()
        {
            var from_date = $('#permit_from').val();
            let start_days_count = $('#artiststartafter').val();
            if(from_date)
            {
                var x = moment(from_date, "DD-MM-YYYY");
                var to = moment();
                var from = moment([x.format('YYYY'), x.month(), x.format('DD')]);
                var today = moment([to.format('YYYY'), to.month(), to.format('DD')]);
                var diff = from.diff(today, 'days');
                if(diff <= start_days_count)
                {
                    $('#showwarning').modal('show');
                }
            }
        }


    </script>

    @endsection