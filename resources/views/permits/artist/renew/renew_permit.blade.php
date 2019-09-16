@extends('layouts.app')

@section('content')

<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Renew Artist Permit <span
                            class="text--yellow bg--maroon px-3 ml-3 text-center"><strong>{{$new_permit_num}}</strong></span>
                    </h3>
                </div>
                <input type="hidden" name="permit_number" value="{{$new_permit_num}}">
                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right">
                        <a href="/company/artist_permits"
                            class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                            <i class="la la-angle-left"></i>
                            Back
                        </a>
                        <a href="/company/add_artist_to_permit/{{$permit_id}}/{{'renew'}}"
                            class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                            <i class="la la-plus"></i>
                            Add Artist
                        </a>
                    </div>
                </div>
            </div>

            <input type="hidden" id="permit_id" value="{{$permit_id}}">

            <div class="kt-portlet__body">
                <div class="kt-widget5__info py-4">
                    <div class="pb-2">
                        <span>From Date:</span>&emsp;
                        <span class="kt-font-info">{{date('d-M-Y',strtotime($issued_date))}}</span>&emsp;&emsp;
                        <input type="hidden" id="issued_date" value="{{$issued_date}}">
                        <span>To Date:</span>&emsp;
                        <span class="kt-font-info">{{date('d-M-Y',strtotime($expired_date))}}</span>&emsp;&emsp;
                        <input type="hidden" id="expired_date" value="{{$expired_date}}">
                        <span>Work Location:</span>&emsp;
                        <span class="kt-font-info">{{$work_location}}</span>&emsp;&emsp;
                        <input type="hidden" id="work_location" value="{{$work_location}}">
                    </div>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
                        <table class="table table-striped table-borderless" id="applied-artists-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Profession</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($artist_details as $artist_detail)
                                <tr>
                                    <td>{{$artist_detail->firstname_en}}</td>
                                    <td>{{$artist_detail->lastname_en}}</td>
                                    <td>{{$artist_detail->permitType['name_en']}}</td>
                                    <td>{{$artist_detail->mobile_number}}</td>
                                    <td>{{$artist_detail->email}}</td>
                                    <td class="text-center">
                                        <a href="../edit_artist/{{'renew'}}/{{$artist_detail->artist_permit_id}}"
                                            class="btn-clean btn-icon btn-icon-sm" title="Edit">
                                            <i class="la la-pencil la-2x"></i>
                                        </a>
                                        <a href="#" data-toggle="modal" data-target="#artist_details"
                                            onclick="getArtistDetails({{$artist_detail->id}})"
                                            class="btn-clean btn-icon btn-icon-sm" title="View">
                                            <i class="la la-file la-2x"></i>
                                        </a>
                                        @if(count($artist_details) > 1)
                                        <a href="#"
                                            onclick="delArtist({{$artist_detail->artist_permit_id}},{{$artist_detail->permit_id}},'{{$artistPermit->firstname_en}}','{{$artist_detail->lastname_en}}')"
                                            data-toggle="modal" data-target="#delartistmodal"
                                            class="btn-clean btn-icon btn-icon-sm" title="Delete">
                                            <i class="la la-trash la-2x"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" onclick="submit()">
                        Re-Submit
                    </div>
                </div>
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
                        <input type="hidden" id="del_artist_permit_id" name="del_artist_permit_id" />
                        <input type="hidden" name="del_artist_from" value="renew" />
                        <input type="hidden" name="del_permit_id" id="del_permit_id">
                        <input type="submit" value="Remove"
                            class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
                    </form>
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


    function getArtistDetails(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("company.fetch_artist_temp_data")}}',
            data: {artist_temp_id:id},
            success: function(data) {
                console.log(data);
                $('#detail-permit').empty();
            if(data)
            {
                var code = data.person_code ? data.person_code : '';
                $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr> <th>Code</th> <td>' + code + '</td> <th>First Name</th> <td >' + data.firstname_en + '</td>  </tr> <tr> <th>Last Name</th> <td>' + data.lastname_en + '</td> <th>Nationality</th> <td >' + data.nationality + '</td>  </tr> <tr> <th>Email</th> <td>' + data.email + '</td> <th>Profession</th> <td >' + data.permit_type.name_en + '</td>  </tr> <tr> <th>Passsport</th> <td >' + data.passport_number + '</td> <th>UID Number</th> <td >' + data.uid_number + '</td> </tr> <tr> <th>DOB</th> <td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr></table>');

            }
            }
        });
    }

    function submit() {
        $.ajax({
            type: 'POST',
            url: '{{route("company.move_temp_to_permit_renew")}}',
            data: {
                permit_number: $('#permit_number').val(),
                permit_id: $('#permit_id').val(),
                work_location: $('#work_location').val(),
                issued_date: $('#issued_date').val(),
                expired_date: $('#expired_date').val()
            },
            success: function(data) {
                // console.log(data);
              if(data.message == 'success') {
                window.location.href="{{url('company/artist_permits')}}";
              }
            }
        });
    }

    function delArtist(artist_permit_id, permit_id, fname, lname) {
        $('#del_artist_permit_id').val(artist_permit_id);
        $('#del_permit_id').val(permit_id);
        $('#del_fname').val(fname);
        $('#warning_text').html('Are you sure to remove <b>' + fname + ' ' + lname + '</b> from this permit ?');
        $('#warning_text').css('color', '#580000')
    }


</script>
@endsection
