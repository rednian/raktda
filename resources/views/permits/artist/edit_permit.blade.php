@extends('layouts.app')

@section('title', 'Edit Permit - Smart Government Rak')

@section('content')

@include('permits.components.comments', ['staff_comments' => $staff_comments])

<div class="kt-portlet kt-portlet--mobile" style="z-index:1;">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Edit Artist Permit')}}
            </h3>

        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </button>
                {{-- <a href="{{url('company/artist/add_artist_to_permit/edit/'.$permit_details->permit_id)}}"
                class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                <i class="la la-plus"></i>
                {{__('Add Artist')}}
                </a> --}}
                <a href="{{route('company.add_artist_to_permit',['from' => 'edit', 'id' => $permit_details->permit_id])}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                    {{__('Add Artist')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-sm">
                    <i class="la la-arrow-left"></i>
                </button>
                <a href="{{route('company.add_artist_to_permit',['from' => 'edit', 'id' => $permit_details->permit_id])}}"
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
                            <span class="btn btn-label-success btn-sm btn-bold btn-upper">
                                {{date('d M, y',strtotime($permit_details->issued_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('To Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-danger btn-sm btn-bold btn-upper">
                                {{date('d M, y',strtotime($permit_details->expired_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Permit Term')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{$permit_details->term}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Reference Number')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{$permit_details->reference_number}}
                            </span>
                        </div>
                    </div>
                    @if($permit_details->event)
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Connected Event ?')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{getLangId() == 1 ? $permit_details->event->name_en : $permit_details->event->name_ar}}
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="kt-widget__text kt-margin-t-10">
                    <strong>{{__('Work Location')}} :</strong>
                    {{getLangId() == 1 ? ucwords($permit_details->work_location) : $permit_details->work_location_ar}}
                </div>
            </div>


            <div class="table-responsive">
                <table class="table table-striped border table-hover table-borderless" id="applied-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
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
                        @php
                        $i = 0 ;
                        @endphp
                        <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">
                        @foreach ($artist_details as $artist_detail)
                        <tr>
                            <td>{{ getLangId() == 1 ? $artist_detail->firstname_en :  $artist_detail->firstname_ar}}
                            </td>
                            <td>{{ getLangId() == 1 ? $artist_detail->lastname_en :  $artist_detail->lastname_ar}}</td>
                            <td>{{ getLangId() == 1 ? $artist_detail->profession['name_en'] : $artist_detail->profession['name_ar']}}
                            </td>
                            <td>{{$artist_detail->mobile_number}}</td>
                            {{-- <td>{{$artist_detail->email}}</td> --}}
                            <td>
                                {{ ucwords($artist_detail->artist_permit_status)}}
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="{{URL::signedRoute('artist.edit_artist',[ 'id' => $artist_detail->id , 'from' => 'edit'])}}"
                                    title="Edit">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('Edit')}}</button>
                                </a>
                                <a href="{{URL::signedRoute('temp_artist_details.view' , [ 'id' => $artist_detail->id , 'from' => 'edit'])}}"
                                    title="View">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('View')}}</button>
                                </a>
                                @if(count($artist_details) > 1)
                                <a href="#"
                                    onclick="delArtist({{$artist_detail->id}},{{$artist_detail->permit_id}},'{{$artist_detail->firstname_en}}','{{$artist_detail->lastname_en}}')"
                                    data-toggle="modal" data-target="#delartistmodal" title="{{__('Remove')}}">
                                    <button class="btn btn-sm btn-secondary btn-elevate">{{__('Remove')}}</button>
                                </a>
                                @endif
                                {{-- @if(count($staff_comments) > 0)
                                <a href="#" onclick="getArtistComments({{$artist_detail->artist_permit_id}})">
                                <i class="la la-comment la-2x pl-4"></i>
                                </a>
                                @endif --}}
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
                <div class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn">
                    <i class="la la-check"></i>
                    {{__('Submit')}}
                </div>
            </div>
        </div>
    </div>



    @include('permits.artist.modals.leave_page')

    @include('permits.artist.modals.remove_artist', ['from' => 'edit'])


    <div class="modal fade" id="artist_permit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Comments on Artist')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="artistpermitcomment">
                </div>
            </div>
        </div>
    </div>


</div>

@endsection

@section('script')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function(){

            $('#kt_aside_menu ul li a').on('mouseenter', stopNavigate)
                .on('mouseout', function () {
                $(window).on('beforeunload', windowBeforeUnload);
            });
        })

        function stopNavigate(event) {
            $(window).off('beforeunload');
        }

        function windowBeforeUnload() {
            // return 'Are you sure you want to leave?';
            var permit_id = $('#permit_id').val();
            var nextUrl = document.activeElement.href;
            if(nextUrl == undefined){
                return;
            }
            var total = $('#total_artist_details').val();

            var addUrl = "{{url('company/artist/add_artist_to_permit/edit')}}/"+permit_id ;

            if(nextUrl != addUrl ){
                var tempArr = [];
                for(var i = 0 ; i < total; i++){
                    var temp_id = $('#temp_id_'+i).val();
                    var tempUrl = "{{url('company/artist/permit')}}"+'/' +temp_id + '/edit' ;
                    // var tempUrl = "{{url('company/edit_edit_artist')}}"+'/' +temp_id ;
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


    $('#back_btn , #back_btn_sm').click(function(){
        $total_artists = $('#total_artist_details').val();
        if($total_artists > 0) {
            $('#back_btn_modal').modal('show');
        } else {
            window.location.href = "{{route('artist.index')}}#applied";
        }
    });


    function go_back_confirm_function(){
        var temp_permit_id =  $('#permit_id').val();
        $.ajax({
                url:"{{route('company.clear_the_temp_data')}}",
                type: "POST",
                data: { permit_id: temp_permit_id, from: 'edit'},
                async: true,
                success: function(result){
                    window.location.href="{{route('artist.index')}}#applied";
                }
        });
    }


    $('#submit_btn').click(function() {
        // $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
        // $('#submit_btn').css('pointer-events', 'none');
        $.ajax({
            url: '{{route("artist.update_permit")}}',
            type: 'POST',
            data: {permit_id: $('#permit_id').val()},
            beforeSend: function() {
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: 'Please wait...'
                });
            },
            success: function(result) {
                if(result.message[0] == 'success')
                {
                    window.location.href=result.toURL;
                    KTApp.unblockPage();
                }
            }
        });
    });

    function delArtist(temp_id, permit_id, fname, lname) {
        $('#del_temp_id').val(temp_id);
        $('#del_permit_id').val(permit_id);
        $('#del_fname').val(fname);
        $('#warning_text').html('Are you sure to remove <b>' + fname + ' ' + lname + '</b> from this permit ?');
        $('#warning_text').css('color', '#580000')
    }

    function getArtistComments(id){
        let url = '{{route("artist.fetch_artist_comment", ":id")}}';
        url = url.replace(':id', id);
        $.ajax({
            url: url ,
            success: function(result) {
                let comm = result.comments;
                $('#artistpermitcomment').empty();
                if(comm.length)
                {
                    $('#artist_permit_modal').modal('show');
                    for(const com of comm){
                        $('#artistpermitcomment').append(com.comment);
                    }
                }
            }
        });
    }


</script>
@endsection