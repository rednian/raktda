@extends('layouts.app')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">{{__('Artist Permit Details')}}</h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('artist.index')}}#draft"
                    class="btn btn--maroon kt-font-bold kt-font-transform-u btn-elevate btn-sm">
                    <i class="la la-angle-left"></i>
                    {{__('Back')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('artist.index')}}#draft" class="btn btn--maroon btn-elevate btn-sm">
                    <i class="la la-angle-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body pt-0">
        <div class="kt-widget5__info py-3">
            <div>
                <span>{{__('From Date')}}:</span>&emsp;
                <span class="kt-font-info">{{date('d-M-Y',strtotime($draft_details[0]->issue_date))}}</span>&emsp;&emsp;
                <span>{{__('To Date')}}:</span>&emsp;
                <span
                    class="kt-font-info">{{date('d-M-Y',strtotime($draft_details[0]->expiry_date))}}</span>&emsp;&emsp;
                <span>{{__('Work Location')}}:</span>&emsp;
                <span class="kt-font-info">
                    {{getLangId() == 1 ? ucwords($draft_details[0]->work_location) : $draft_details[0]->work_location_ar}}</span>&emsp;&emsp;
                @if($draft_details[0]->event)
                <span>{{__('Connected Event ?')}} :</span>&emsp;
                <span
                    class="kt-font-info">{{ getLangId() == 1 ? $draft_details[0]->event->name_en : $draft_details[0]->event->name_ar }}</span>&emsp;&emsp;
                @endif
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-striped table-borderless border" id="applied-artists-table">
                <thead>
                    <tr>
                        <th>{{__('First Name')}}</th>
                        <th>{{__('Last Name')}}</th>
                        <th>{{__('Profession')}}</th>
                        <th>{{__('Mobile Number')}}</th>
                        <th>{{__('Status')}}</th>
                        <th class="text-center">{{__('Action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($draft_details as $atd)
                    <tr>
                        <td>{{ucwords($atd->firstname_en)}}</td>
                        <td>{{ucwords($atd->lastname_en)}}</td>
                        <td>{{ucwords($atd->profession['name_en'])}}</td>
                        <td>{{$atd->mobile_number}}</td>
                        <td>
                            {{ucwords($atd->artist_permit_status)}}
                        </td>
                        {{-- <td class="text-center"> <a href="#" data-toggle="modal"
                                onclick="getArtistDetails({{$atd->id}})" class="btn-clean btn-icon btn-icon-md"
                        title="View">
                        <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                        </a></td> --}}
                        <td class="text-center">
                            <a href="{{route('temp_artist_details.view' , [ 'id' => $atd->id , 'from' => 'view-draft'])}}"
                                title="View">
                                <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




    <!--begin::Modal-->
    <div class="modal fade" id="artist_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Artist Details')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="detail-permit">
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
            data: {
                artist_temp_id: id
            },
            success: function(data) {
                // console.log(data);
                $('#detail-permit').empty();
                if (data) {
                    $('#artist_details').modal('show');
                    var code = data.person_code ? data.person_code != 0 ? data.person_code : '' : '';
                    $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr> <th>First Name</th> <td >' + data.firstname_en + '</td>   <th>Last Name</th> <td>' + data.lastname_en + '</td> </tr> <tr> <th>First Name (AR)</th> <td >' + data.firstname_ar + '</td>   <th>Last Name (AR)</th> <td>' + data.lastname_ar + '</td> </tr><th>Nationality</th> <td >' +  data.nationality.nationality_en + '</td><th>Gender</th> <td >' + ( data.gender == 1 ? 'male' : 'female')  + '</td>  </tr> <tr> <th>Email</th> <td>' + data.email + '</td> <th>Profession</th> <td >' + data.profession.name_en + '</td>  </tr> <tr> <th>Passport</th> <td >' + data.passport_number + '</td> <th>Passport Expiry</th> <td >' + moment(data.passport_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY') + '</td> </tr> <tr> <th>UID Number</th> <td >' + data.uid_number + '</td><th>UID Expiry</th> <td >' +  moment(data.uid_expire_date, 'YYYY-MM-DD').format('DD-MM-YYYY') + '</td>  </tr><tr> <th>DOB</th> <td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Mobile Number</th> <td >' + data.mobile_number + '</td></tr></table>');

                }
            }
        });
    }

    const showDocumentsFn = (doc) => {
        var base_url = window.location.origin;
        return '<tr><td>' + doc.document_name + '</td><td>' + doc.issued_date + '</td><td>' + doc.expired_date + '</td><td><a href="' + base_url + '/storage/' + doc.path + '" target="_blank">View</a></td></tr>';
    }
</script>
@endsection