@extends('layouts.app')


@section('content')



<meta name="csrf-token" content="{{ csrf_token() }}">


<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Make Payment <span
                            class="text--yellow bg--maroon px-3 ml-3 text-center"><strong>{{$permit_details['permit_number']}}</strong></span>
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right">
                        <a href="/company/artist_permits" class="btn btn--maroon btn-elevate btn-sm">
                            <i class="la la-angle-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-widget5__info pb-4">
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
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permit_details->artistPermit as $artistPermit)
                                <tr>
                                    <td>{{$artistPermit->artist['firstname_en']}}</td>
                                    <td>{{$artistPermit->artist['lastname_en']}}</td>
                                    <td>{{$artistPermit->permitType['name_en']}}</td>
                                    <td>{{$artistPermit->mobile_number}}</td>
                                    <td>{{$artistPermit->email}}</td>
                                    <td><span
                                            class="kt-badge kt-badge--inline kt-badge--pill kt-badge--{{$artistPermit->artist['artist_status'] == 'active' ? 'success' : 'danger'}}">{{$artistPermit->artist['artist_status']}}</span>
                                    </td>
                                    <td class="text-center"> <a href="#" data-toggle="modal"
                                            data-target="#artist_details"
                                            onclick="getArtistDetails({{$artistPermit->artist_id}}, {{$artistPermit->artist_permit_id}})"
                                            class="btn-clean btn-icon btn-icon-md" title="View">
                                            <i class="la la-file la-2x"></i>
                                        </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-end">
                            <a href="../payment_gateway/{{$permit_details->permit_id}}">
                                <div class="btn btn--yellow btn-md btn-wide kt-font-bold kt-font-transform-u btn-sm">
                                    Make Payment
                                </div>
                            </a>
                        </div>
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






    @endsection


    @section('script')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        function getArtistDetails(artist_id,artist_permit_id) {
            $.ajax({
                type: 'POST',
                url: '{{route("company.fetch_artist_details")}}',
                data: { ap_id:artist_permit_id},
                success: function(data) {
                    $('#detail-permit').empty();
                if(data)
                {
                    var code = data.artist.person_code ? data.artist.person_code : '';
                $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr> <th>Code</th> <td>' + code + '</td> <th>First Name</th> <td >' + data.artist.firstname_en + '</td>  </tr> <tr> <th>Last Name</th> <td>' + data.artist.lastname_en + '</td> <th>Nationality</th> <td >' + data.artist.nationality + '</td>  </tr> <tr> <th>Email</th> <td>' + data.email + '</td> <th>Profession</th> <td >' + data.permit_type.name_en + '</td>  </tr> <tr> <th>Passsport</th> <td >' + data.passport_number + '</td> <th>UID Number</th> <td >' + data.uid_number + '</td> </tr> <tr> <th>DOB</th> <td >' + moment(data.artist.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr></table>');

                }
                }
            });
        }
    </script>

    @endsection
