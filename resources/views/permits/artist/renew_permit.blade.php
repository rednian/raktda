@extends('layouts.app')

@section('title', 'Renew Artist Permit - Smart Government Rak')

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('RENEW ARTIST PERMIT')}}</h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$permit_details->permit_number}}
                </strong>
            </span>
        </div>
        <div class="kt-portlet__head-toolbar ">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-{{getLangId() == 1 ? 'left' : 'right'}}"></i>
                    {{__('BACK')}}
                </button>
                {{-- <a href="{{url('company/artist/add_artist_to_permit/renew/'.$permit_details->permit_id)}}"
                class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                <i class="la la-plus"></i>
                {{__('Add Artist')}}
                </a> --}}
                <a href="{{URL::signedRoute('company.add_artist_to_permit',['from' => 'renew', 'id' => $permit_details->permit_id])}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                    {{__('ADD ARTIST')}}
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-{{getLangId() == 1 ? 'left' : 'right'}}"></i>
                </button>
                <a href="{{URL::signedRoute('company.add_artist_to_permit',['from' => 'renew', 'id' => $permit_details->permit_id])}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                </a>
            </div>
        </div>
    </div>


    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-widget kt-widget--project-1">
            <div class="kt-widget__body kt-padding-l-0">
                <div class="kt-widget__stats d-">
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('From Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                {{date('d F Y',strtotime($artist_details[0]->issue_date))}}
                            </span>
                        </div>
                    </div>
                    <input type="hidden" id="issued_date" value="{{$artist_details[0]->issue_date}}">
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('To Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                {{date('d F Y',strtotime($artist_details[0]->expiry_date))}}
                            </span>
                        </div>
                    </div>
                    <input type="hidden" id="expired_date" value="{{$artist_details[0]->expiry_date}}">
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Permit Duration')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                {{calculateDateDiff($artist_details[0]->issue_date, $artist_details[0]->expiry_date)}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="kt-widget__text kt-margin-t-10">
                    <strong>{{__('Work Location')}} :</strong>
                    {{getLangId() == 1 ? ucfirst($permit_details->work_location) : $permit_details->work_location_ar}}
                </div>
            </div>
            <input type="hidden" id="work_location" value="{{$permit_details->work_location}}">
            <input type="hidden" id="work_location_ar" value="{{$permit_details->work_location_ar}}">
        </div>


        <div class="table-responsive">
            <table class="table table-striped border table-hover table-borderless" id="applied-artists-table">
                <thead>
                    <tr class="kt-font-transform-u">
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
                    @php
                    $i = 0 ;
                    @endphp
                    <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">
                    @foreach ($artist_details as $artist_detail)
                    <tr>
                        <td>{{ getLangId() == 1 ? ucfirst($artist_detail->firstname_en) : $artist_detail->firstname_ar}}
                        </td>
                        <td>{{ getLangId() == 1 ? ucfirst($artist_detail->lastname_en) : $artist_detail->lastname_ar}}
                        </td>
                        <td>{{ getLangId() == 1 ? ucfirst($artist_detail->profession['name_en']) : $artist_detail->profession['name_ar']}}
                        </td>
                        <td>{{$artist_detail->mobile_number}}</td>
                        {{-- <td>{{$artist_detail->email}}</td> --}}
                        <td>
                            {{__(ucfirst($artist_detail->artist_permit_status))}}
                        </td>
                        <td class="d-flex justify-content-center">
                            <a href="{{URL::signedRoute('artist.edit_artist',[ 'id' => $artist_detail->id , 'from' => 'renew'])}}"
                                title="{{__('Edit')}}">
                                <button
                                    class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">{{__('Edit')}}</button>
                            </a>
                            <a href="{{URL::signedRoute('temp_artist_details.view' , [ 'id' => $artist_detail->id , 'from' => 'renew'])}}"
                                title="{{__('View')}}">
                                <button
                                    class="btn btn-sm btn-secondary btn-elevate btn-hover-warning kt-margin-r-5">{{__('View')}}</button>
                            </a>
                            @if(count($artist_details) > 1)
                            <a href="#"
                                onclick="delArtist({{$artist_detail->id}},{{$artist_detail->permit_id}},'{{$artist_detail->firstname_en.' '.$artist_detail->lastname_en}}','{{$artist_detail->lastname_ar.' '.$artist_detail->firstname_ar}}')"
                                data-toggle="modal" data-target="#delartistmodal" title="{{__('Remove')}}">
                                <button
                                    class="btn btn-sm btn-secondary btn-elevate btn-hover-warning">{{__('Remove')}}</button>
                            </a>
                            @endif
                        </td>
                        <input type="hidden" id="temp_id_{{$i}}" value="{{$artist_detail->id}}">
                        @php
                        $i++;
                        @endphp
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="submit_btn">
                <i class="la la-check"></i>
                {{__('SUBMIT')}}
            </div>
        </div>
    </div>


    @include('permits.artist.modals.remove_artist' , ['from' => 'renew'])

    @include('permits.artist.modals.leave_page')


</div>

@endsection

@section('script')
<script src="{{ asset('js/company/artist.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function stopNavigate(event) {
        $(window).off('beforeunload');
    }

    $('#kt_aside_menu ul li a').on('mouseenter', stopNavigate)
        .on('mouseout', function () {
        $(window).on('beforeunload', windowBeforeUnload);
    });


    function windowBeforeUnload() {

        var permit_id = $('#permit_id').val();
        var nextUrl = document.activeElement.href;
        if(nextUrl == undefined){
            return;
        }
        var total = $('#total_artist_details').val();
        var addUrl = "{{URL::signedRoute('company.add_artist_to_permit', ['from' => ':from' , 'id' => ':id'])}}" ;
        addUrl = addUrl.replace(':from' , 'renew');
        addUrl = addUrl.replace(':id' , permit_id);
        if(nextUrl != addUrl ){
            var tempArr = [];
            for(var i = 0 ; i < total; i++){
                var temp_id = $('#temp_id_'+i).val();
                var tempUrl = "{{URL::signedRoute('artist.edit_artist', [ 'from' => ':from' , 'id' => ':id' ])}}" ;
                tempUrl = tempUrl.replace(':from', 'renew');
                tempUrl = tempUrl.replace(':id', temp_id);
                // var tempUrl = "{{url('company/artist/permit')}}"+'/' +temp_id +'/renew';
                tempArr.push(tempUrl);
            }

            if(!tempArr.includes(nextUrl)){
                $.ajax({
                    type: 'GET',
                    url: "{{url('company/update_is_edit')}}"+"/" +permit_id,
                    success: function(data) {
                        // console.log('at last it worked');
                    }
                });
            }

        }
        // return 'Are you sure you want to leave?';
    }


    $('#back_btn, #back_btn_sm').click(function(){
        $total_artists = $('#total_artist_details').val();

        if($total_artists > 0) {
            $('#back_btn_modal').modal('show');
        } else {
            window.location.href = "{{route('artist.index')}}#valid";
        }
    });

    function go_back_confirm_function(){
        var temp_permit_id =  $('#permit_id').val();
        $.ajax({
                url:"{{route('company.clear_the_temp_data')}}",
                type: "POST",
                data: { permit_id: temp_permit_id,from: 'renew'},
                async: true,
                success: function(result){
                    window.location.href=result.toURL;
                }
        });
    }

    $('#submit_btn').click(function() {
        // $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
        // $('#submit_btn').css('pointer-events', 'none');
       
        var temp_permit_id = $('#permit_id').val();
        var noofdays = dayCount($('#issued_date').val(), $('#expired_date').val());var term;
            if(noofdays < 30) { term = 'short'; } else { term='long';}
        $.ajax({
            type: 'POST',
            url: '{{route("artist.store")}}',
            data: {
                temp_permit_id:temp_permit_id,
                from: $('#issued_date').val() ,
                to: $('#expired_date').val(),
                loc: $('#work_location').val(),
                loc_ar: $('#work_location_ar').val(),
                term: term, 
                fromWhere: 'renew'
            },
            beforeSend: function() {
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: '{{__("Please wait...")}}'
                });
            },
            success: function(data) {
                // console.log(data);
              if(data.message[0] == 'success') {
                window.location.href= data.toURL;
                KTApp.unblockPage();
              }
            }
        });
    });

    function delArtist(temp_id, permit_id, nameEn, nameAr) {
        $('#del_temp_id').val(temp_id);
        $('#del_permit_id').val(permit_id);
        let name = $('#getLangId').val() == 1 ? nameEn : nameAr ;
        // $('#warning_text').html("{{__('Are you sure to remove')}} <b>" + name  +"</b> {{__('from this permit ?')}}");
        let warnText = "{{ trans_choice('messages.remove_artist', Auth::user()->LanguageId , ['name' => ':artistname' ])}}";
        warnText  = warnText.replace(':artistname', name);
        $('#warning_text').html(warnText);
        $('#warning_text').css('color', '#580000')
    }


</script>
@endsection