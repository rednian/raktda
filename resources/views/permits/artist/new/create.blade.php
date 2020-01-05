@extends('layouts.app')

@section('title', 'Add New Permit - Smart Government Rak')
@section('content')

{{-- {{dd(session()->all())}} --}}
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Add New Artist Permit')}}
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u" title="Go Back">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </button>
                <button id="add_artist" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()" title="Add Artist">
                    <i class="la la-plus"></i>
                    {{__('Add Artist')}}
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
    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-widget5__info px-4">
            <div class="pb-2">
                <!--begin: Permit Details Wizard-->
                <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                    <div class="kt-form__section kt-form__section--first">
                        <div class="kt-wizard-v3__form">
                            <form id="permit_details" method="POST" autocomplete="off">
                                <div class="row">
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_from"
                                            class="col-form-label col-form-label-sm ">{{__('From Date')}} <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text"
                                                    class="form-control form-control-sm {{ count($artist_details) > 0 ? 'mk-disabled': ''}}"
                                                    name="permit_from" id="permit_from" placeholder="DD-MM-YYYY"
                                                    data-date-start-date="+0d" onchange="checkFilled();givWarn()"
                                                    value="{{ count($artist_details) > 0 ? date('d-m-Y',strtotime($artist_details[0]->issue_date)) :  ( session($user_id.'_apn_from_date') ? session($user_id.'_apn_from_date') : '') }}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="artiststartafter"
                                        value="{{getSettings()->artist_start_after}}" />
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_to"
                                            class="col-form-label col-form-label-sm">{{__('To Date')}}<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-sm">
                                            <div class="kt-input-icon kt-input-icon--right">
                                                <input type="text"
                                                    class="form-control form-control-sm {{ count($artist_details) > 0 ? 'mk-disabled': ''}}"
                                                    name="permit_to" id="permit_to" placeholder="DD-MM-YYYY"
                                                    onchange="checkFilled()"
                                                    value="{{count($artist_details) > 0 ? date('d-m-Y',strtotime($artist_details[0]->expiry_date)) :( session($user_id.'_apn_to_date') ? session($user_id.'_apn_to_date') : '') }}" />
                                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="work_loc"
                                            id="work_loc" onkeyup="checkFilled()"
                                            value="{{count($artist_details) > 0 ? getlangId() == 1 ? $artist_details[0]->work_location : $artist_details[0]->work_location_ar :(session($user_id.'_apn_location') ? session($user_id.'_apn_location') : '')}}" />
                                    </div>
                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location (AR)')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="work_loc_ar"
                                            id="work_loc_ar" onkeyup="checkFilled()" dir="rtl"
                                            value="{{count($artist_details) > 0 ? $artist_details[0]->work_location_ar :(session($user_id.'_apn_location_ar') ? session($user_id.'_apn_location_ar') : '')}}" />
                                    </div>
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for=""
                                            class="col-form-label col-form-label-sm">{{__('Connected Event ?')}}
                                        </label>
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio  ">
                                                <input type="radio" name="isEvent" onClick="changeIsEvent(1)"
                                                    {{count($artist_details) > 0 ? 'disabled' : ''}}
                                                    {{session($user_id.'_apn_is_event') && session($user_id.'_apn_is_event') == 1 ? 'checked' : ''}}
                                                    value="1">
                                                {{__('Yes')}}
                                                <input type="hidden" name="isEvent" value="1">
                                                <span></span>
                                            </label>
                                            <label class="kt-radio  ">
                                                <input type="radio" name="isEvent" onClick="changeIsEvent(0)"
                                                    {{count($artist_details) > 0 ? 'disabled' : ''}}
                                                    {{session($user_id.'_apn_is_event') ? session($user_id.'_apn_is_event') == 0 ? 'checked' : '' : 'checked'}}
                                                    value="0"> {{__('No')}}
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3 kt-margin-b-0" id="events_div"
                                        style="display:{{ session($user_id.'_apn_is_event') == 0 ? 'none': 'block'}}">
                                        <label for="event_id" class="col-form-label col-form-label-sm">
                                            {{__('Select Event')}} <span class="text-danger">*</span></label>
                                        <select type="text"
                                            class="form-control form-control-sm {{count($artist_details) > 0 ? 'mk-disabled' : ''}}"
                                            name="event_id" id="event_id" onchange="check_Add_Event()">
                                            <option value=" ">{{__('Select')}}</option>
                                            @if(count($events) > 0)
                                            @foreach($events as $event)
                                            <option value="{{$event->event_id}}"
                                                {{session($user_id.'_apn_event_id') == $event->event_id ? 'selected' : ''}}>
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
                <table class="table table-striped border table-hover table-borderless">
                    <thead>
                        <tr>
                            <th> {{__('First Name')}}</th>
                            <th> {{__('Last Name')}}</th>
                            <th> {{__('Profession')}}</th>
                            <th> {{__('Mobile Number')}}</th>
                            {{-- <th>Email</th> --}}
                            <th> {{__('Status')}}</th>
                            <th class="text-center"> {{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($artist_details) > 0)
                        @foreach($artist_details as $ad)
                        {{-- {{dd($ad)}} --}}
                        <tr>
                            <td>{{  getLangId() == 1 ? $ad->firstname_en : $ad->firstname_ar }}</td>
                            <td>{{  getLangId() == 1 ? $ad->lastname_en : $ad->lastname_ar}}</td>
                            <td>{{  getLangId() == 1 ? $ad->profession['name_en'] : $ad->profession['name_ar']}}</td>
                            <td>{{$ad->mobile_number}}</td>
                            {{-- <td>{{$ad->email}}</td> --}}
                            <td>{!! __($ad->artist_permit_status) !!}</td>
                            <td class="d-flex justify-content-center">
                                <a href="{{route('artist.edit_artist',[ 'id' => $ad->id , 'from' => 'new'])}}"
                                    title="{{__('Edit')}}">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('Edit')}}</button>
                                </a>
                                <a href="{{URL::signedRoute('temp_artist_details.view' ,['id'=> $ad->id , 'from' => 'new'])}}"
                                    title="{{__('View')}}">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('View')}}</button>
                                </a>
                                @if(count($artist_details) > 1)
                                <a href="#"
                                    onclick="delArtist({{$ad->id}},{{$ad->permit_id}},'{{$ad->firstname_en}}','{{$ad->lastname_en}}')"
                                    data-toggle="modal" data-target="#delartistmodal" title="{{__('Remove')}}">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('Remove')}}</button>
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
                class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u {{ count($artist_details) == 0 ? 'd-none' : ''}}"
                id="draft_btn" title="{{__('Save As Draft')}}">
                <i class="la la-check"></i>
                {{__('Save As Draft')}}
            </button>

            <button
                class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u {{ count($artist_details) == 0 ? 'd-none' : ''}}"
                id="submit_btn" {{ count($artist_details) == 0 ? 'disabled' : ''}}>
                <i class="la la-check"></i>
                {{__('Apply Permit')}}
            </button>
        </div>

    </div>


    @include('permits.artist.modals.remove_artist', ['from' => 'new'])

    @include('permits.artist.modals.leave_page')


    @include('permits.artist.modals.show_warning_modal',['day_count' =>getSettings()->artist_start_after ]);

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
            var minDate = $('#permit_from').val() ? moment($('#permit_from').val(), 'DD-MM-YYYY').toDate() : startDate;
            var maxDate = moment(minDate).add(3, 'M').toDate(); 
            $('#permit_to').datepicker('setEndDate', maxDate );
            $('#permit_to').datepicker('setStartDate', minDate);
            // $('#events_div').css('display', 'none');
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
            $('#permit_to').datepicker('setEndDate', maxDate);
            $('#permit_to').datepicker('setStartDate', minDate);
        });
        $('#permit_to').on('changeDate', function (ev) {
            $('#permit_to').valid() || $('#permit_to').removeClass('invalid').addClass('success');
        });


        function checkFilled(){
            var from = $('#permit_from').val();
            var to = $('#permit_to').val();
            var loc = $('#work_loc').val();
            var loc_ar = $('#work_loc_ar').val();
            var diff = $('#noofdays').val();
            var isEvent = $("input:radio[name='isEvent']:checked").val();
            var eventId = $('#event_id').val();
            if(isEvent == 1 && eventId != ' '){
                fetchEventDetails();
            }else if(isEvent == 0){
                $('#event_id').val(' ');
                eventId = ' ';
                if($('#total_artist_details').val() == 0)
                {
                    removeDisabled();
                }
            }
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
                    if(eventId != ' '){
                        fetchEventDetails();
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

        function check_Add_Event(){
            var event_id = $('#event_id').val();
            if(event_id == 'add_new')
            {
                window.location.replace = "{{ route('event.create')}}";
            }else{
                checkFilled();
            }
        }

        function disabledThese()
        {
            $('#add_artist').attr('disabled', true);
            $('#add_artist_sm').attr('disabled', true);
            $('#draft_btn').css('display', 'none');
            $('#submit_btn').css('display', 'none');
        }

        function removeDisabled()
        {
            $('#permit_from').removeClass('mk-disabled');
            $('#permit_to').removeClass('mk-disabled');
            $('#work_loc').removeClass('mk-disabled');
            $('#work_loc_ar').removeClass('mk-disabled');
        }

        function fetchEventDetails()
        {
            var eventId = $('#event_id').val();
            $.ajax({
                    url:"{{route('artist.fetch_event_details')}}",
                    type: "POST",
                    data: { event_id: eventId },
                    async: true,
                    success: function(result){
                        $('#permit_from').val(moment(result.issued_date,"DD-MMM-YYYY").utc().format('DD-MM-YYYY')); $('#permit_from').addClass('mk-disabled');
                        $('#permit_to').val(moment(result.expired_date,"DD-MMM-YYYY").utc().format('DD-MM-YYYY'));$('#permit_to').addClass('mk-disabled');
                        $('#work_loc').val(result.venue_en);$('#work_loc').addClass('mk-disabled');
                        $('#work_loc_ar').val(result.venue_ar);$('#work_loc_ar').addClass('mk-disabled');
                        $('#add_artist').attr('disabled', false);
                        $('#add_artist_sm').attr('disabled', false);
                    }
            });
        }

        function clearEventDetails()
        {
            $('#permit_from').val('');$('#permit_from').removeClass('mk-disabled');
            $('#permit_to').val('');  $('#permit_to').removeClass('mk-disabled');
            $('#work_loc').val('');   $('#work_loc').removeClass('mk-disabled');
            $('#work_loc_ar').val('');   $('#work_loc_ar').removeClass('mk-disabled');
            disabledThese();
        }

        function setCokkie(){
            var from = $('#permit_from').val();
            var to = $('#permit_to').val();
            var loc = $('#work_loc').val();
            var loc_ar = $('#work_loc_ar').val();
            var eventId = $('#event_id').val();
            var isEvent = $("input:radio[name='isEvent']:checked").val();
            var permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('company.storePermitDetails')}}",
                    type: "POST",
                    data: { from: from , to:to, loc:loc,loc_ar:loc_ar, eventId:eventId, isEvent: isEvent },
                    async: true,
                    success: function(result){
                        var Url = "{{ route('company.add_new_artist', [ 'id' => 1])}}";
                        Url = Url.replace(':id', permit_id);
                        window.location.href = Url;
                    }
            });
        }

        $('#back_btn , #back_btn_sm').click(function(){
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


        $('#submit_btn').click((e) => {

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
                        loc_ar: $('#work_loc_ar').val(),
                        event_id: $('#event_id').val(),
                        term: term
                    },
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'success',
                            message: 'Please wait...'
                        });
                    },
                    success: function(result){
                        window.location.replace="{{route('artist.index')}}#applied";
                        KTApp.unblockPage();
                    }
            });
        });

        $('#draft_btn').click((e) => {
            // $('#draft_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
            // $('#draft_btn').css('pointer-events', 'none');
            // $('#submit_btn').css('pointer-events', 'none');

            var temp_permit_id = $('#temp_permit_id').val();
            $.ajax({
                    url:"{{route('artist.add_draft')}}",
                    type: "POST",
                    data: {
                        temp_permit_id:temp_permit_id,
                        from: $('#permit_from').val() ,
                        to: $('#permit_to').val(),
                        loc: $('#work_loc').val(),
                        loc_ar: $('#work_loc_ar').val(),
                        event_id: $('#event_id').val()
                    },
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'success',
                            message: 'Please wait...'
                        });
                    },
                    success: function(result){
                        window.location.replace="{{route('artist.index')}}#draft";
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