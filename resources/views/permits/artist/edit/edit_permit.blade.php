@extends('layouts.app')

@section('content')

<!-- end:: Header -->

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- begin:: Content -->


@if(count($staff_comments) > 0)
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
    <div class="kt-portlet__head kt-portlet__head--lg" style="height:auto;">
        <div class="kt-portlet__head-label mt-4 w-100">
            <div class="alert alert-outline-danger fade show w-100" role="alert">
                <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                </div>
                <div class="alert-text">
                    <h5 class="alert-text">List of corrections advised by TDA</h5>
                    <ol type="a">
                        @foreach ($staff_comments as $sc)
                        <li class="alert-text">{{$sc->comment}}</li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="kt-portlet kt-portlet--mobile" style="z-index:1;">
        <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">Edit Artist Permit
                </h3>
                <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                    <strong>{{$permit_details['permit_number']}}</strong></span>
            </div>

            <div class="kt-portlet__head-toolbar">
                <div class="my-auto float-right permit--action-bar">
                    <a href="{{url('company/artist_permits')}}" class="btn btn--maroon btn-elevate btn-sm">
                        <i class="la la-angle-left"></i>
                        Back
                    </a>
                    <a href="{{url('company/add_artist_to_permit/edit/'.$permit_details->permit_id)}}"
                        class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u">
                        <i class="la la-plus"></i>
                        Add New Artist
                    </a>
                </div>

                <div class="my-auto float-right permit--action-bar--mobile">
                    <a href="{{url('company/artist_permits')}}" class="btn btn--maroon btn-elevate btn-sm">
                        <i class="la la-angle-left"></i>
                    </a>
                    <a href="{{url('company/add_artist_to_permit/edit/'.$permit_details->permit_id)}}"
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
                    <span
                        class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->issued_date))}}</span>&emsp;&emsp;
                    <span>To Date:</span>&emsp;
                    <span
                        class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->expired_date))}}</span>&emsp;&emsp;
                    <span>Work Location:</span>&emsp;
                    <span class="kt-font-info">{{$permit_details->work_location}}</span>&emsp;&emsp;
                    <span>Reference No:</span>&emsp;
                    <span class="kt-font-info">{{$permit_details->reference_number}}</span>&emsp;&emsp;
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
                                {{-- <th>Status</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- {{dd($artist_details)}} --}}
                            @php
                            $i = 0 ;
                            @endphp
                            <input type="hidden" id="total_artist_details" value="{{count($artist_details)}}">
                            @foreach ($artist_details as $artist_detail)
                            <tr>

                                <td>{{$artist_detail->firstname_en}}</td>
                                <td>{{$artist_detail->lastname_en}}</td>
                                <td>{{$artist_detail->permitType['name_en']}}</td>
                                <td>{{$artist_detail->mobile_number}}</td>
                                <td>{{$artist_detail->email}}</td>
                                {{-- <td><span
                                                    class="kt-badge kt-badge--inline kt-badge--pill kt-badge--{{$artist_details->artist['artist_status'] == 'active' ? 'success' : 'danger'}}">{{$artist_details->artist['artist_status']}}</span>
                                </td> --}}

                                <td class="text-center">
                                    <a href="{{url('company/edit_edit_artist/'.$artist_detail->id)}}"
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
                                        onclick="delArtist({{$artist_detail->id}},{{$artist_detail->permit_id}},'{{$artist_detail->firstname_en}}','{{$artist_detail->lastname_en}}')"
                                        data-toggle="modal" data-target="#delartistmodal"
                                        class="btn-clean btn-icon btn-icon-sm" title="Delete">
                                        <i class="la la-trash la-2x"></i>
                                    </a>
                                    @endif
                                    <a href="#" data-toggle="modal" data-target="#error_list"
                                        onclick="getErrorFields({{$artist_detail->artist_permit_id}})"
                                        class="btn-clean btn-icon btn-icon-sm" title="View">
                                        <i class="la la-comment la-2x"></i>
                                    </a>
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
            </div>

            <div class="d-flex justify-content-end">
                <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" onclick="submit()">
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
        <div class="modal fade" id="error_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Fields to be corrected !</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body" id="field-list">
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
                            <input type="hidden" name="del_artist_from" value="edit" />
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

    // $(window).on('unload',function () {
    //     var ids = $('#temp_id_array').val();
    //     $.ajax({
    //             type: 'POST',
    //             url: '{{url("company/check_update_is_edit")}}',
    //             data: {permit_id: $('#permit_id').val(),  temp_ids: ids},
    //             success: function(data) {
    //                 console.log('this' +data);
    //             }
    //     });
    // });

    $(window).on('beforeunload', function (e)
    {
        var permit_id = $('#permit_id').val();
        var nextUrl = document.activeElement.href;
        if(nextUrl == undefined){
            return;
        }
        var total = $('#total_artist_details').val();
        var addUrl = "{{url('company/add_artist_to_permit/edit')}}/"+permit_id ;
        if(nextUrl != addUrl ){
            var tempArr = [];
            for(var i = 0 ; i < total; i++){
                var temp_id = $('#temp_id_'+i).val();
                var tempUrl = "{{url('company/edit_edit_artist')}}"+'/' +temp_id ;
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
    });



    function getArtistDetails(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("company.fetch_artist_temp_data")}}',
            data: {artist_temp_id:id},
            success: function(data) {
                // console.log(data);
                $('#detail-permit').empty();
            if(data)
            {
                var code = data.person_code ? data.person_code != 0 ? data.person_code : '' : '';
                $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr> <th>Code</th> <td>' + code + '</td> <th>First Name</th> <td >' + data.firstname_en + '</td>  </tr> <tr> <th>Last Name</th> <td>' + data.lastname_en + '</td> <th>Nationality</th> <td >' +  data.nationality.country_enName + '</td>  </tr> <tr> <th>Email</th> <td>' + data.email + '</td> <th>Permit Type</th> <td >' + data.permit_type.name_en + '</td>  </tr> <tr> <th>Profession</th> <td>' + (data.profession ? data.profession.name_en : '') + '</td> <th>Phone Number</th> <td >' + data.phone_number + '</td>  </tr><tr> <th>Passport</th> <td >' + data.passport_number + '</td> <th>UID Number</th> <td >' + data.uid_number + '</td> </tr> <tr> <th>DOB</th> <td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr></table>');

            }
            }
        });
    }


    function getErrorFields(id) {
        $.ajax({
            type: 'POST',
            url: '{{route("company.get_error_fields_list")}}',
            data: {artist_permit_id:id},
            success: function(data) {
                console.log(data);
                $('#field-list').empty();
                $('#field-list').css('display', 'inline');
               if(data)
               {
                    $('#field-list').append('Please Add correct values for the following Fields: <br /><br />');
                   for(var i = 0;i < data.checklist.length; i++){
                        $('#field-list').append('<span class="text--maroon kt-font-bold">'+ data.checklist[i].fieldname+'</span>')
                        i + 1 == data.checklist.length ?  $('#field-list').append('. ') :$('#field-list').append(', ');
                   }
               } else {
                    $('#field-list').append('No Comments')
               }
            }
        });
    }

    const showDocumentsFn = (doc) => {
        var base_url = window.location.origin;
        return '<tr><td>'+doc.document_name+'</td><td>'+doc.issued_date+'</td><td>'+doc.expired_date+'</td><td><a href="'+base_url+'/storage/'+doc.path+'" target="_blank">View</a></td></tr>';
    }

    function submit() {
        $.ajax({
            url: '{{route("company.move_temp_to_permit")}}',
            type: 'POST',
            data: {permit_id: $('#permit_id').val()},
            success: function(result) {
                if(result.message[0] == 'success')
                {
                    window.location.href="{{url('company/artist_permits')}}";
                }
            }
        });
    }

    function delArtist(temp_id, permit_id, fname, lname) {
            $('#del_temp_id').val(temp_id);
            $('#del_permit_id').val(permit_id);
            $('#del_fname').val(fname);
            $('#warning_text').html('Are you sure to remove <b>' + fname + ' ' + lname + '</b> from this permit ?');
            $('#warning_text').css('color', '#580000')
        }


    </script>
    @endsection
