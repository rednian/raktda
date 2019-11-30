@extends('layouts.app')

@section('title', 'Edit Permit - Smart Government Rak')

@section('content')

@include('permits.components.comments', ['staff_comments' => $staff_comments])

<div class="kt-portlet kt-portlet--mobile" style="z-index:1;">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">{{__('Edit Artist Permit')}}
            </h3>

        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </button>
                @if($permit_details->permit_status != 'modification request')
                <a href="{{url('company/artist/add_artist_to_permit/edit/'.$permit_details->permit_id)}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                    {{__('Add Artist')}}
                </a>
                @endif
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn_sm" class="btn btn--maroon btn-sm">
                    <i class="la la-arrow-left"></i>
                </button>
                @if($permit_details->permit_status != 'modification request')
                <a href="{{url('company/artist/add_artist_to_permit/edit/'.$permit_details->permit_id)}}"
                    class="btn btn--yellow btn-sm kt-font-bold ">
                    <i class="la la-plus"></i>
                </a>
                @endif
            </div>

        </div>
    </div>

    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">

    <div class="kt-portlet__body pt-0">
        <div class="kt-widget5__info py-3">
            <div class="pb-2">
                <span class="kt-font-dark">{{__('Term')}}:</span>&emsp;
                <span class="kt-font-info">{{$permit_details->term}}</span>&emsp;&emsp;
                <span class="kt-font-dark">{{__('From Date')}}:</span>&emsp;
                <span class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->issued_date))}}</span>&emsp;&emsp;
                <span class="kt-font-dark">{{__('To Date')}}:</span>&emsp;
                <span class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->expired_date))}}</span>&emsp;&emsp;
                <span class="kt-font-dark">{{__('Location')}}:</span>&emsp;
                <span class="kt-font-info">{{$permit_details->work_location}}</span>&emsp;&emsp;
                <span class="kt-font-dark">{{__('Ref NO.')}}:</span>&emsp;
                <span class="kt-font-info">{{$permit_details->reference_number}}</span>&emsp;&emsp;
            </div>
        </div>
        @if($permit_details->event)
        <div class="pb-3">
            <span>Connected to Event :</span>&emsp;
            <span
                class="kt-font-info">{{getLangId() == 1 ? $permit_details->event->name_en : $permit_details->event->name_ar}}</span>&emsp;&emsp;
        </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped border table-hover table-borderless" id="applied-artists-table">
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
                    @php
                    $i = 0 ;
                    @endphp
                    <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">
                    @foreach ($artist_details as $artist_detail)
                    <tr>
                        <td>{{ getLangId() == 1 ? $artist_detail->firstname_en :  $artist_detail->firstname_ar}}</td>
                        <td>{{ getLangId() == 1 ? $artist_detail->lastname_en :  $artist_detail->lastname_ar}}</td>
                        <td>{{ getLangId() == 1 ? $artist_detail->profession['name_en'] : $artist_detail->profession['name_ar']}}
                        </td>
                        <td>{{$artist_detail->mobile_number}}</td>
                        {{-- <td>{{$artist_detail->email}}</td> --}}
                        <td>
                            {{ ucwords($artist_detail->artist_permit_status)}}
                        </td>

                        <td class="d-flex justify-content-center">
                            <a href="{{route('artist.edit_artist',[ 'id' => $artist_detail->id , 'from' => 'edit'])}}"
                                title="Edit">
                                <button class="btn btn-sm btn-secondary btn-elevate">Edit</button>
                            </a>
                            <a href="{{route('temp_artist_details.view' , [ 'id' => $artist_detail->id , 'from' => 'edit'])}}"
                                title="View">
                                <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                            </a>
                            @if(count($artist_details) > 1)
                            <a href="#"
                                onclick="delArtist({{$artist_detail->id}},{{$artist_detail->permit_id}},'{{$artist_detail->firstname_en}}','{{$artist_detail->lastname_en}}')"
                                data-toggle="modal" data-target="#delartistmodal" title="Remove">
                                <button class="btn btn-sm btn-secondary btn-elevate">Remove</button>
                            </a>
                            @endif
                            @if(count($staff_comments) > 0)
                            <a href="#" onclick="getArtistComments({{$artist_detail->artist_permit_id}})">
                                <i class="la la-comment la-2x pl-4"></i>
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
            <div class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn">
                <i class="la la-check"></i>
                {{__('Submit')}}
            </div>
        </div>
    </div>
</div>



@include('permits.artist.modals.leave_page')

@include('permits.artist.modals.view_artist')

@include('permits.artist.modals.remove_artist', ['from' => 'edit'])


<div class="modal fade" id="artist_permit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comments on Artist</h5>
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


    $('#back_btn').click(function(){
        $total_artists = $('#total_artist_details').val();
        if($total_artists > 0) {
            $('#back_btn_modal').modal('show');
        } else {
            window.location.href = "{{route('artist.index')}}#applied";
        }
    });

    $('#back_btn_sm').click(function(){
        $total_artists = $('#total_artist_details').val();
        if($total_artists > 0) {
            $('#back_btn_modal').modal('show');
        } else {
            window.location.href = "{{route('artist.index')}}#applied";
        }
    })

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


    function getArtistDetails(id) {
        $.ajax({
            url: '{{route("company.fetch_artist_temp_data")}}',
            type: 'POST',
            data: {artist_temp_id:id},
            success: function(data) {
                $('#detail-permit').empty();
                if(data)
                {
                    $('#artist_details').modal('show');
                    var code = data.person_code ? data.person_code : '';
                    $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr>  <th>First Name</th> <td >' + data.firstname_en + '</td>  <th>Last Name</th> <td>' + data.lastname_en + '</td></tr> <tr>  <th>First Name - Ar</th> <td >' + data.firstname_ar + '</td>  <th>Last Name - Ar</th> <td>' + data.lastname_ar + '</td></tr><tr><th>Profession</th> <td >' + data.profession.name_en + '</td>  <th>Nationality</th> <td >' +  ( data.nationality ? data.nationality.nationality_en : '' ) + '</td> </tr> <tr><th>Email</th> <td>' + data.email + '</td>  <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr><tr><th>Passsport</th> <td >' + data.passport_number + '</td><th>Passsport Exp</th> <td >' +moment(data.passport_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr><tr><th>BirthDate</th><td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Visa Type</th><td>'+data.visa_type.visa_type_en + '</td></tr><tr><th>Visa Number</th> <td >' + data.visa_number + '</td> <th>Visa Expiry</th> <td>'+moment(data.visa_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr><tr><th>UID Number</th> <td >' + data.uid_number + '</td> <th>UID Expiry</th> <td>'+moment(data.uid_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr></table>');

                }
            }
        });
    }

    const showDocumentsFn = (doc) => {
        var base_url = window.location.origin;
        return '<tr><td>'+doc.document_name+'</td><td>'+doc.issued_date+'</td><td>'+doc.expired_date+'</td><td><a href="'+base_url+'/storage/'+doc.path+'" target="_blank">View</a></td></tr>';
    }

    $('#submit_btn').click(function() {
        $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
        $.ajax({
            url: '{{route("artist.update_permit")}}',
            type: 'POST',
            data: {permit_id: $('#permit_id').val()},
            success: function(result) {
                if(result.message[0] == 'success')
                {
                    $('#submit_btn').removeClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
                    window.location.href="{{route('artist.index')}}#applied";
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
                $('#artist_permit_modal').modal('show');
                for(const com of comm){
                    $('#artistpermitcomment').append(com.comment);
                }
            }
        });
    }


</script>
@endsection