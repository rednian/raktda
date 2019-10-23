@extends('layouts.app')

@section('title', 'Amend Permit - Smart Government Rak')

@section('content')
<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Amend Artist Permit
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$permit_details['permit_number']}}</strong></span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <button id="back_btn" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                    Back
                </button>
                <a href="{{url('/company/add_artist_to_permit/amend/'.$permit_details->permit_id)}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                    Add Artist
                </a>
            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <button id="back_btn" class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                </button>
                <a href="{{url('/company/add_artist_to_permit/amend/'.$permit_details->permit_id)}}"
                    class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-plus"></i>
                </a>
            </div>
        </div>
    </div>


    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">

    <div class="kt-portlet__body">
        <div class="kt-widget5__info py-4">
            <div class="pb-2">
                <span>From Date:</span>&emsp;
                <span class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->issued_date))}}</span>&emsp;&emsp;
                <span>To Date:</span>&emsp;
                <span class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->expired_date))}}</span>&emsp;&emsp;
                <span>Work Location:</span>&emsp;
                <span class="kt-font-info">{{$permit_details->work_location}}</span>&emsp;&emsp;
                <span>Reference No:</span>&emsp;
                <span class="kt-font-info">{{$permit_details->reference_number}}</span>&emsp;&emsp;
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-borderless" id="applied-artists-table">
                <thead class="thead-dark">
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
                    @php
                    $i = 0 ;
                    @endphp
                    <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">
                    @foreach ($artist_details as $artist_detail)
                    <tr>
                        <td>{{ucwords($artist_detail->firstname_en)}}</td>
                        <td>{{ucwords($artist_detail->lastname_en)}}</td>
                        <td style="width:20%;">{{ucwords($artist_detail->profession['name_en'])}}</td>
                        <td>{{$artist_detail->mobile_number}}</td>
                        <td>{{$artist_detail->email}}</td>
                        <td>
                            {{ucwords($artist_detail->artist_permit_status)}}
                        </td>
                        <td class="text-center">
                            <a href="{{route('artist.edit_artist',[ 'id' => $artist_detail->id , 'from' => 'amend'])}}"
                                class="btn-clean btn-icon btn-icon-sm" title="Replace Artist">
                                <i class="la la-refresh la-2x"></i>
                            </a>
                            <a href="#" data-toggle="modal" data-target="#artist_details"
                                onclick="getArtistDetails({{$artist_detail->id}})"
                                class="btn-clean btn-icon btn-icon-sm" title="View Artist">
                                <i class="la la-file la-2x"></i>
                            </a>
                            @if(count($artist_details) > 1)
                            <a href="#"
                                onclick="delArtist({{$artist_detail->id}},{{$artist_detail->permit_id}},'{{$artist_detail->firstname_en}}','{{$artist_detail->lastname_en}}')"
                                data-toggle="modal" data-target="#delartistmodal" class="btn-clean btn-icon btn-icon-sm"
                                title="Delete">
                                <i class="la la-trash la-2x"></i>
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
                Re-Submit
            </div>
        </div>
    </div>


    <!--begin::Modal-->
    <div class="modal fade" id="artist_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Artist Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="detail-permit">
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

    <!--begin::Modal-->
    <div class="modal fade" id="delartistmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Remove Artist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('company.delete_artist')}}" method="POST">
                        @csrf
                        <p id="warning_text"></p>
                        <input type="hidden" id="del_temp_id" name="del_temp_id" />
                        <input type="hidden" name="del_artist_from" value="amend" />
                        <input type="hidden" name="del_permit_id" id="del_permit_id">
                        <input type="submit" value="Remove"
                            class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

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
                        class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->




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

        var permit_id = $('#permit_id').val();
        var nextUrl = document.activeElement.href;
        if(nextUrl == undefined){
            return;
        }
        var total = $('#total_artist_details').val();
        var addUrl = "{{url('company/add_artist_to_permit/amend')}}/"+permit_id ;
        if(nextUrl != addUrl ){
            var tempArr = [];
            for(var i = 0 ; i < total; i++){
                var temp_id = $('#temp_id_'+i).val();
                var tempUrl = "{{url('company/replace_artist')}}"+'/' +temp_id ;
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

        return 'Are you sure you want to leave?';
    }

    $('#back_btn').click(function(){
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
                data: { permit_id: temp_permit_id, from: 'amend'},
                async: true,
                success: function(result){
                    window.location.href="{{route('artist.index')}}#valid";
                }
        });
    }


    function getArtistDetails(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("company.fetch_artist_temp_data")}}',
            data: {artist_temp_id:id},
            success: function(data) {
                $('#detail-permit').empty();
            if(data)
            {
                var code = data.person_code ? data.person_code : '';
                $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr>  <th>First Name</th> <td >' + data.firstname_en + '</td>  <th>Last Name</th> <td>' + data.lastname_en + '</td></tr> <tr>  <th>First Name - Ar</th> <td >' + data.firstname_ar + '</td>  <th>Last Name - Ar</th> <td>' + data.lastname_ar + '</td></tr><tr><th>Profession</th> <td >' + data.profession.name_en + '</td>  <th>Nationality</th> <td >' +  data.nationality.nationality_en + '</td> </tr> <tr><th>Email</th> <td>' + data.email + '</td>  <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr><tr><th>Passsport</th> <td >' + data.passport_number + '</td><th>Passsport Exp</th> <td >' +moment(data.passport_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr><tr><th>BirthDate</th><td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Visa Type</th><td>'+data.visa_type+ '</td></tr><tr><th>Visa Number</th> <td >' + data.visa_number + '</td> <th>Visa Expiry</th> <td>'+moment(data.visa_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr><tr><th>UID Number</th> <td >' + data.uid_number + '</td> <th>UID Expiry</th> <td>'+moment(data.uid_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr></table>');

            }
            }
        });
    }

    const showDocumentsFn = (doc) => {
        var base_url = window.location.origin;
        return '<tr><td>'+doc.document_name+'</td><td>'+doc.issued_date+'</td><td>'+doc.expired_date+'</td><td><a href="'+base_url+'/storage/'+doc.path+'" target="_blank">View</a></td></tr>';
    }

    function delArtist(temp_id, permit_id, fname, lname) {
        $('#del_temp_id').val(temp_id);
        $('#del_permit_id').val(permit_id);
        $('#del_fname').val(fname);
        $('#warning_text').html('Are you sure to remove <b>' + fname + ' ' + lname + '</b> from this permit ?');
        $('#warning_text').css('color', '#580000');
    }

    $('#submit_btn').click( function() {
        $('#submit_btn').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--dark');
        $.ajax({
            type: 'POST',
            url: '{{route("artist.update_permit")}}',
            data: {permit_id: $('#permit_id').val()},
            success: function(result) {
                if(result.message[0] == 'success')
                {
                    window.location.href="{{route('artist.index')}}#applied";
                }
            }
        });
    });


</script>
@endsection
