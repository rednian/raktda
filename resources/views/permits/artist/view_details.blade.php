@extends('layouts.app')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">{{__('Artist Permit Details')}}</h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$permit_details->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('artist.index')}}#{{$tab}}" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u
">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('artist.index')}}#{{$tab}}" class="btn btn--maroon btn-sm">
                    <i class="la la-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body pt-0">
        <div class="kt-widget5__info py-3">
            <span>{{__('From Date')}}:</span>&emsp;
            <span class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->issued_date))}}</span>&emsp;&emsp;
            <span>{{__('To Date')}}:</span>&emsp;
            <span class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->expired_date))}}</span>&emsp;&emsp;
            <span>{{__('Work Location')}}:</span>&emsp;
            <span
                class="kt-font-info">{{getLangId() == 1 ? ucwords($permit_details->work_location) : $permit_details->work_location_ar}}</span>&emsp;&emsp;
            <span>{{__('Reference No.')}}</span>&emsp;
            <span class="kt-font-info">{{$permit_details->reference_number}}</span>&emsp;&emsp;
            @if($permit_details->event)
            <span>{{__('Connected Event ?')}} :</span>&emsp;
            <span
                class="kt-font-info">{{getLangId() == 1 ? $permit_details->event->name_en : $permit_details->event->name_ar}}</span>&emsp;&emsp;
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover border table-borderless  " id="applied-artists-table">
                <thead>
                    <tr>
                        <th>{{__('First Name')}}</th>
                        <th>{{__('Last Name')}}</th>
                        <th>{{__('Profession')}}</th>
                        <th>{{__('Mobile Number')}}</th>
                        {{-- <th>@lang('words.email')</th> --}}
                        <th>{{__('Status')}}</th>
                        <th class="text-center">{{__('Action')}}</th>
                    </tr>
                </thead>
                {{-- {{dd($permit_details)}} --}}
                <tbody>
                    @foreach ($permit_details->artistPermit as $artistPermit)
                    <tr>
                        <td>{{ getLangId() == 1 ? ucwords($artistPermit->firstname_en) : $artistPermit->firstname_ar }}
                        </td>
                        <td>{{ getLangId() == 1 ? ucwords($artistPermit->lastname_en) : $artistPermit->lastname_ar }}
                        </td>
                        <td>{{ getLangId() == 1 ? ucwords($artistPermit->profession['name_en']) : $artistPermit->profession['name_ar']}}
                        </td>
                        <td>{{$artistPermit->mobile_number}}</td>
                        {{-- <td>{{$artistPermit->email}}</td> --}}
                        <td>
                            {{ucwords($artistPermit->artist_permit_status)}}
                        </td>
                        {{-- <td class="text-center"> <a href="#" data-toggle="modal"
                                onclick="getArtistDetails({{$artistPermit->artist_permit_id}})" title="View">
                        <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                        </a></td> --}}

                        <td class="text-center"> <a
                                href="{{route('artist_details.view' , [ 'id' => $artistPermit->artist_permit_id , 'from' => 'details'])}}">
                                <button class="btn btn-sm btn-secondary btn-elevate">{{__('View')}}</button>
                            </a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




    @include('permits.artist.modals.view_artist')



</div>

@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function getArtistDetails(artist_permit_id) {

        $.ajax({
            type: 'POST',
            url: '{{route("company.fetch_artist_details")}}',
            data: {ap_id:artist_permit_id},
            success: function(data) {
                // console.log(data);
                $('#detail-permit').empty();
               if(data)
               {
                   $('#artist_details').modal('show');
                var code = data.artist.person_code ? data.artist.person_code : '';
                $('#detail-permit').append('<table class="w-100  table  table-bordered"> <tr> <th>Code</th> <td >' + code + '</td><th>Profession</th> <td>' + ( data.profession  ?  data.profession.name_en : '' )+ '</td></tr><tr><th>First Name</th> <td >' + data.firstname_en + '</td>  <th>Last Name</th> <td>' + data.lastname_en + '</td> </tr><tr><th>First Name (AR)</th> <td >' + data.firstname_ar + '</td>  <th>Last Name (AR)</th> <td>' + data.lastname_ar + '</td> </tr> <tr> <th> Nationality </th> <td >' + data.nationality.nationality_en + '</td> <th>Email</th> <td>' + data.email + '</td>  </tr> <tr> <th>Passsport</th> <td >' + data.passport_number + '</td> <th>Passsport Exp</th> <td >' +moment(data.passport_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr><tr><th>BirthDate</th><td >' + moment(data.birthdate, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td> <th>Visa Type</th><td>'+data.visa_type.visa_type_en+ '</td></tr><tr><th>Visa Number</th> <td >' + data.visa_number + '</td> <th>Visa Expiry</th> <td>'+moment(data.visa_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') +'</td></tr><tr><th>UID Number</th> <td >' + data.uid_number + '</td> <th>UID Exp</th> <td >' +moment(data.uid_expire_date, 'YYYY/MM/DD').format('DD-MM-YYYY') + '</td></tr></table>');

               }
            }
        });
    }

    const showDocumentsFn = (doc) => {
        var base_url = window.location.origin;
        return '<tr><td>'+doc.document_name+'</td><td>'+doc.issued_date+'</td><td>'+doc.expired_date+'</td><td><a href="'+base_url+'/storage/'+doc.path+'" target="_blank">View</a></td></tr>';
    }


</script>
@endsection