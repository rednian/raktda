@extends('layouts.app')

@section('title', 'Payment Permit - Smart Government Rak')


@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Make Payment
                    </h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right">
                        <a href="{{url('company/artist_permits')}}" class="btn btn--maroon btn-elevate btn-sm">
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
                            @foreach ($permit_details->artistPermit as $artistPermit)
                            <tr>
                                <td>{{$artistPermit->artist['firstname_en']}}</td>
                                <td>{{$artistPermit->artist['lastname_en']}}</td>
                                <td>{{$artistPermit->profession['name_en']}}</td>
                                <td>{{$artistPermit->mobile_number}}</td>
                                <td>{{$artistPermit->email}}</td>
                                <td style="color:{{$artistPermit->artist_permit_status == 'approved' ? 'green' : 'red'}}"
                                    class="kt-font-bold">
                                    {{ucwords($artistPermit->artist_permit_status)}}
                                </td>
                                <td class=" text-center"> <a href="#" data-toggle="modal" data-target="#artist_details"
                                        onclick="getArtistDetails({{$artistPermit->artist_id}}, {{$artistPermit->artist_permit_id}})"
                                        class="btn-clean btn-icon btn-icon-md" title="View">
                                        <i class="la la-file la-2x"></i>
                                    </a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{url('company/payment_gateway/'.$permit_details->permit_id)}}">
                        <div class="btn btn--yellow btn-md btn-wide kt-font-bold kt-font-transform-u btn-sm">
                            Make Payment
                        </div>
                    </a>
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
                    $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr> <th>Code</th> <td >' + code + '</td><th>Profession</th> <td>' + ( data.profession  ?  data.profession.name_en : '' )+ '</td></tr><tr><th>First Name</th> <td >' + data.artist.firstname_en + '</td>  <th>Last Name</th> <td>' + data.artist.lastname_en + '</td> </tr><tr><th>First Name - Ar</th> <td >' + data.artist.firstname_ar + '</td>  <th>Last Name - Ar</th> <td>' + data.artist.lastname_ar + '</td> </tr> <tr> <th> Nationality </th> <td >' + data.artist.nationality.nationality_en + '</td> <th>Email</th> <td>' + data.email + '</td>  </tr> <tr> <th>Passsport</th> <td >' + data.passport_number + '</td> <th>Passsport Exp</th> <td >' +moment(data.passport_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr><tr><th>BirthDate</th><td >' + moment(data.artist.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Visa Type</th><td>'+data.visa_type.visa_type_en+ '</td></tr><tr><th>Visa Number</th> <td >' + data.visa_number + '</td> <th>Visa Expiry</th> <td>'+moment(data.visa_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr><tr><th>UID Number</th> <td >' + data.uid_number + '</td> <th>UID Exp</th> <td >' +moment(data.uid_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr> <tr>  <th>Mobile Number</th> <td >' + data.mobile_number + '</td><th>Phone Number</th> <td >' + data.phone_number + '</td></tr></table>');

                }
                }
            });
        }
        </script>

        @endsection
