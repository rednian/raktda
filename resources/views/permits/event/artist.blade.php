@extends('layouts.app')

@section('title', 'Add Artist to Event Permit - Smart Government Rak')

@section('content')

{{-- {{dd(session()->all())}} --}}
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('ADD ARTIST TO EVENT PERMIT')}}
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u" title="Go Back">
                    <i class="la la-arrow-left"></i>
                    {{__('BACK')}}
                </button>
                <button id="add_artist" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()" title="Add Artist">
                    <i class="la la-plus"></i>
                    {{__('ADD ARTIST')}}
                </button>
            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u"
                    title="{{__('BACK')}}">
                    <i class="la la-arrow-left"></i>
                </button>
                <button id="add_artist_sm" class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                    onclick="setCokkie()" title="{{__('ADD ARTIST')}}">
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
                                <div class=" row">
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_from"
                                            class="col-form-label col-form-label-sm ">{{__('From Date')}} <span
                                                class="text-danger">*</span></label>
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

                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="permit_to"
                                            class="col-form-label col-form-label-sm">{{__('To Date')}} <span
                                                class="text-danger">*</span></label>
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
                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location (EN)')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm mk-disabled"
                                            placeholder="Work Location in English" name="work_loc" id="work_loc"
                                            dir="ltr" value="{{$event->venue_en}}" />
                                    </div>
                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="work_loc" class="col-form-label col-form-label-sm">
                                            {{__('Work Location (AR)')}} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm mk-disabled"
                                            placeholder="موقع العمل باللغة العربية" name="work_loc_ar" id="work_loc_ar"
                                            dir="rtl" value="{{$event->venue_ar}}" />
                                    </div>
                                    <div class="form-group col-lg-2 kt-margin-b-0">
                                        <label for="" class="col-form-label col-form-label-sm">{{__('CONNECTED EVENT')}}
                                        </label>
                                        <div class="kt-radio-inline">
                                            <label class="kt-radio ">
                                                <input type="radio" name="isEvent" checked value="1">
                                                {{__('Yes')}}
                                                <span></span>
                                            </label>
                                            <label class="kt-radio ">
                                                <input type="radio" name="isEvent" value="0" disabled> {{__('No')}}
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3 kt-margin-b-0">
                                        <label for="event_id" class="col-form-label col-form-label-sm">
                                            {{__('SELECT EVENT')}} <span class="text-danger">*</span></label>
                                        <select type="text" class="form-control form-control-sm mk-disabled"
                                            name="event_id" id="event_id">
                                            <option value=" ">{{__('Select')}}</option>
                                            <option value="{{$event->event_id}}" selected>
                                                {{getLangId() == 1 ? ucfirst($event->name_en) : $event->name_ar}}
                                            </option>
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
            <div class="table-responsive-sm">
                <table class="table table-striped border table-hover table-borderless">
                    <thead>
                        <tr>
                            <th>{{__('FIRST NAME')}}</th>
                            <th>{{__('LAST NAME')}}</th>
                            <th>{{__('PROFESSION')}}</th>
                            <th>{{__('MOBILE NUMBER')}}</th>
                            {{-- <th>Email</th> --}}
                            <th>{{__('STATUS')}}</th>
                            <th class="text-center">{{__('ACTION')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($artist_details) > 0)
                        @foreach($artist_details as $ad)
                        {{-- {{dd($ad)}} --}}
                        <tr>
                            <td>{{ getLangId() == 1 ? ucfirst($ad->firstname_en) : $ad->firstname_ar}}</td>
                            <td>{{ getLangId() == 1 ? ucfirst($ad->lastname_en) : $ad->lastname_ar}}</td>
                            <td>{{ getLangId() == 1 ? ucfirst($ad->profession['name_en']) : $ad->profession['name_ar']}}
                            </td>
                            <td>{{$ad->mobile_number}}</td>
                            {{-- <td>{{$ad->email}}</td> --}}
                            <td>{{__(ucwords($ad->artist_permit_status))}}</td>
                            <td class="d-flex justify-content-center">
                                <a
                                    href="{{URL::signedRoute('artist.edit_artist',[ 'id' => $ad->id , 'from' => 'event'])}}">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">{{__('Edit')}}</button>
                                </a>
                                <a
                                    href="{{URL::signedRoute('temp_artist_details.view' ,['id'=> $ad->id , 'from' => 'event'])}}">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">{{__('View')}}</button>
                                </a>
                                @if(count($artist_details) > 1)
                                <a href="#"
                                    onclick="delArtist({{$ad->id}},{{$ad->permit_id}},'{{$ad->firstname_en.' '.$ad->lastname_en}}','{{$ad->firstname_en.' '.$ad->lastname_ar}}')"
                                    data-toggle="modal" data-target="#delartistmodal">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning">{{__('Remove')}}</button>
                                </a>
                                @else
                                <button class="btn" style="visibility:hidden;">btn</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="7" class="text-center">{{__('No Artists Added')}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">

        <div class="d-flex flex-row-reverse">
            <button class=" btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u
            {{ count($artist_details) == 0 ? 'd-none' : ''}}" id="submit_btn">
                <i class="la la-check"></i>
                {{__('APPLY PERMIT')}}
            </button>
        </div>

    </div>

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
                    data: { from: from , to:to, loc:loc, eventId:eventId, isEvent: isEvent , fromPage: 'event', permitId: permit_id},
                    async: true,
                    success: function(result){
                        window.location.href= result.toURL;
                    }
            });
        }

        $('#back_btn, #back_btn_sm').click(function(){
            $total_artists = $('#total_artist_details').val();

            if($total_artists > 0) {
                $('#back_btn_modal').modal('show');
            } else {
                window.location.href = "{{URL::signedRoute('event.index')}}#applied";
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
                        window.location.href=result.toURL;
                    }
            });
        }

        function delArtist(temp_id, permit_id, fname, lname) {
            $('#del_temp_id').val(temp_id);
            $('#del_permit_id').val(permit_id);
            let name = $('#getLangId').val() == 1 ? nameEn : nameAr ;
            // $('#warning_text').html("{{__('Are you sure to remove')}} <b>" + name  +"</b> {{__('from this permit ?')}}");
            let warnText = "{{ trans_choice('messages.remove_artist', Auth::user()->LanguageId , ['name' => ':artistname' ])}}";
            warnText  = warnText.replace(':artistname', name);
            $('#warning_text').html(warnText);
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
                            message: '{{__("Please wait...")}}'
                        });
                    },
                    data: {
                        temp_permit_id:temp_permit_id ,
                        from: $('#permit_from').val() ,
                        to: $('#permit_to').val(),
                        loc: $('#work_loc').val(),
                        loc_ar: $('#work_loc_ar').val(),
                        event_id: $('#event_id').val(),
                        term: term,
                        fromWhere: 'event'
                    },
                    success: function(result){
                        // window.location.href="{{route('artist.index')}}#applied";
                        window.location.href= result.toURL;
                        KTApp.unblockPage();
                    }
            });
        });


    </script>

    @endsection