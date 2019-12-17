@extends('layouts.app')

@section('title', 'View Event Permit - Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">{{__('Event Permit Details')}}
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$event->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>

            </div>
        </div>
    </div>

    <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">



    <div class="kt-portlet__body">
        <div class="kt-container">
            <section class="row">
                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr class="kt-margin-b-0 kt-font-dark">
                            <td class="kt-font-bold kt-margin-r-5">{{__('Event Name')}}</td>
                            <td>:</td>
                            <td>{{getLangId() == 1 ? ucwords($event->name_en) : $event->name_ar}}</td>
                        </tr>
                        <tr class="kt-margin-b-0 kt-font-dark">
                            <td class="kt-font-bold kt-margin-r-15">{{__('Event Type')}}</td>
                            <td>:</td>
                            <td>{{getLangId() == 1 ? ucwords($event->type->name_en) : $event->type->name_ar}}</td>
                        </tr>
                    </table>

                    <iframe class="border kt-padding-5" id='mapcanvas'
                        src='https://maps.google.com/maps?q={{ urlencode($event->full_address)}}&Roadmap&z=10&ie=UTF8&iwloc=&output=embed&z=17'
                        style="height: 310px; width: 100%; margin-top: 1%; border-style: none;"></iframe>
                    <h6 class="kt-margin-t-10 kt-font-dark">{{__('Event Description')}}</h6>
                    <p class="border kt-padding-5 kt-font-dark">
                        {{ Auth::user()->LanguageId == 1 ? ucfirst($event->description_en) : $event->description_ar }}
                    </p>

                </div>
                <div class="col-md-4 border">
                    <div class="kt-widget kt-widget--user-profile-4">
                        <div class="kt-widget__head kt-margin-t-5">
                            <div class="kt-widget__media kt-margin-b-5">
                                @if ($event->thumbnail)
                                <img src="{{ asset('/storage/'.$event->logo_thumbnail) }}"
                                    class="kt-widget__img img-circle" alt="image">
                                @else
                                <div
                                    class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                                    @php
                                    $name = explode(' ', $event->name_en);
                                    $name = strtoupper(substr($name[0], 0, 1));
                                    @endphp
                                    {{$name}}
                                </div>
                                @endif
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__section">
                                    <div class="kt-widget__button">
                                        {!! permitStatus($event->status)!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-widget__body kt-margin-t-5">
                            <hr>
                            <table class="table table-sm table-hover table-borderless table-display">
                                <tr>
                                    <td class="kt-font-bold">{{ __('Applied Date') }} </td>
                                    <td>:</td>
                                    <td class="kt-font-dark">{{ $event->created_at->format('d-F-Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{ __('Reference No.') }} </td>
                                    <td>:</td>
                                    <td class="kt-font-dark"><code
                                            style="font-size:;">{{ $event->reference_number }}</code></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{ __('Permit Number') }} </td>
                                    <td>:</td>
                                    <td class="kt-font-dark">
                                        <code>{{ $event->permit_number ? $event->permit_number : '' }}</code></td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{ __('Expected Audience') }} </td>
                                    <td>:</td>
                                    <td class="kt-font-dark">{{$event->audience_number}}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{__('From')}}</td>
                                    <td>:</td>
                                    <td>{{$event->issued_date}} <br>{{$event->time_start}}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{__('To')}}</td>
                                    <td>:</td>
                                    <td>{{$event->expired_date}} <br> {{$event->time_end}}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{__('Venue')}}</td>
                                    <td>:</td>
                                    <td>{{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}</td>
                                </tr>
                                <tr>
                                    <td class="kt-font-bold">{{__('Address')}}</td>
                                    <td>:</td>
                                    <td>{{$event->address}}</td>
                                </tr>
                            </table>


                        </div>
                    </div>
                </div>
            </section>

            <div>
                @if($event->is_truck && count($event->truck) > 0)
                <div class="d-flex kt-margin-b-10 justify-content-between">
                    <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Truck Details')}}</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead class="kt-font-transform-u">
                            <th>{{__('Company')}}</th>
                            <th>{{__('Company - Ar')}}</th>
                            <th>{{__('Type of Food')}}</th>
                            <th>{{__('Plate No')}}</th>
                            <th class="text-center"> {{__('Registration Exp')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="food_truck_list">
                            @foreach($event->truck as $truck)
                            <tr>
                                <td>{{ucwords($truck->company_name_en)}}</td>
                                <td>{{$truck->company_name_ar}}</td>
                                <td>{{ucwords($truck->food_type)}}</td>
                                <td>{{$truck->plate_number}}</td>
                                {{-- <td>{{date('d-M-Y', strtotime($truck->registration_issued_date))}}
                                </td> --}}
                                <td class="text-center">{{date('d-M-Y', strtotime($truck->registration_expired_date))}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-secondary"
                                        onclick="viewThisTruck({{$truck->event_truck_id}})">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                @if($event->is_liquor)
                @php
                $liquor = $event->liquor;
                @endphp
                <input type="hidden" id="liquor_id" value="{{$liquor->event_liquor_id}}">
                <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Liquor Details')}}</h5>
                <div class="col-md-12 row">
                    <span> {{__('Provided by Venue')}}: </span>&emsp;
                    <span class="kt-font-bold">{{$liquor->provided == 1 ? 'YES' : 'NO'}}</span>
                </div>

                @if($liquor->provided == 0)
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead class="kt-font-transform-u">
                            <th>{{__('Company')}}</th>
                            <th>{{__('Company Ar')}}</th>
                            <th>{{__('Purchase Receipt')}}</th>
                            <th>{{__('Liquor Service')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="food_truck_list">
                            <tr>
                                <td>{{$liquor->company_name_en}}</td>
                                <td>{{$liquor->company_name_ar}}</td>
                                <td>{{$liquor->purchase_receipt}}</td>
                                <td>{{$liquor->liquor_service}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-secondary"
                                        onclick="viewLiquor('{{$liquor->event_liquor_id}}')">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="table-responsive">
                    <div class="col-md-4 pb-2 row">
                        <label
                            class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Liquor Permit No')}}
                        </label>
                        <span class="col-md-6">{{$event->liquor_permit_no}}</span>
                    </div>
                </div>
                @endif
                @endif
            </div>



            @if($artist)
            {{-- {{dd($artist)}} --}}
            <div class="pt-2 img-responsive">
                <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Artist Details')}}</h5>
                <table class="table table-striped table-hover border table-borderless">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('First Name')}}</th>
                            <th>{{__('Last Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th>{{__('Mobile Number')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($artist->artistPermit as $at)
                        <tr>
                            <td>{{$at->firstname_en}}</td>
                            <td>{{$at->lastname_en}}</td>
                            <td>{{$at->profession['name_en']}}</td>
                            <td>{{$at->mobile_number}}</td>
                            <td>
                                {{ucwords($at->artist_permit_status)}}
                            </td>

                            <td class="text-center"> <a
                                    href="{{route('artist_details.view' , [ 'id' => $at->artist_permit_id , 'from' => 'event'])}}"
                                    title="View">
                                    <button class="btn btn-sm btn-secondary btn-elevate">View</button>
                                </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            @if(count($eventReq) > 0)
            <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Uploaded Requirements')}}</h5>
            <div class="event--requirement-files pt-5">
                <table class="table table-hover table-borderless border table-striped">
                    <thead class="text-center">
                        <tr class="kt-font-transform-u">
                            <th class="text-left">{{__('Document Name')}}</th>
                            <th>{{__('Issue Date')}}</th>
                            <th>{{__('Expiry Date')}}</th>
                            <th>{{__('View')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventReq as $req)
                        <tr>
                            <td style="width:50%;">{{$req->requirement_name}}</td>
                            <td class="text-center">
                                {{$req->pivot['issued_date'] != '0000-00-00' ? date('d-m-Y', strtotime($req->pivot['issued_date'])) : ''}}
                            </td>
                            <td class="text-center">
                                {{$req->pivot['expired_date'] != '0000-00-00' ? date('d-m-Y', strtotime($req->pivot['expired_date'])) : ''}}
                            </td>
                            <td class="text-center">
                                <a href="{{asset('storage')}}{{'/'.$req->pivot['path']}}" target="blank" ">
                                    <button class=" btn btn-sm btn-secondary">View
                                    </button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif

            {{-- {{dd($eventImages)}} --}}
            @if(count($eventImages) > 0)
            <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Event Images')}}</h5>
            <div class="row col-md-12">
                <label for="" class="kt-font-dark">{{__('Description')}}</label> :
                &emsp;<label for="">{{$eventImages[0]->description}}</label>
            </div>
            <div class="row col-md-12">
                @foreach($eventImages->reverse() as $upload)
                <div class="col-md-3 my-4">
                    <div class="container">
                        <div class="img-box" style="border:1px solid #ccc;padding:5px;border-radius:5px;">
                            <img src="{{url('storage').'/'.$upload->thumbnail}}" alt="Image"
                                style="width:100%; height:auto;">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

        </div>
    </div>
</div>

@include('permits.event.common.view_food_truck', ['truck_req'=>$truck_req])
@include('permits.event.common.show_liquor', ['liquor_req'=>$liquor_req])

@endsection



@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script>
    $.ajaxSetup({
                        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
                    });


                function viewThisTruck(id)
                {
                    var url = "{{route('event.fetch_this_truck_details', ':id')}}";
                    url = url.replace(':id', id);
                    $.ajax({
                        url:  url,
                        success: function (result) {
                            if(result) 
                            {
                                // console.log(result);
                                $('#edit_food_truck').modal('hide');
                                $('#edit_truck_title').show();
                                $('#add_truck_title').hide();
                                $('#update_this_td').show();
                                $('#add_new_td').hide();
                                $('#edit_one_food_truck').modal('show');
                                $('#company_name_en').val(result.company_name_en);
                                $('#company_name_ar').val(result.company_name_ar);
                                $('#plate_no').val(result.plate_number);
                                $('#food_type').val(result.food_type);
                                $('#regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                                $('#regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                                $('#this_event_truck_id').val(result.event_truck_id);
                                $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
                                truckDocUpload();
                            }
                        }
                    });
                }

                var truckDocUploader =[];

        const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            var total = parseInt($('#truck_additional_doc > div').length);
            for(var i = 1; i <= parseInt(per_truck_doc) + total ;i++){
                    var reqID = $('#truck_req_id_'+i).val() ;
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: ``,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-default mb-2 mr-2',
                    formData: {
                        id: i , 
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let event_id = $('#event_id').val();
                        let truck_id = $('#this_event_truck_id').val();
                        let path = user_id+'/event/'+ event_id +'/truck/' +truck_id +'/'+reqID +'/' +files;
                        window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    },
                    onLoad:function(obj)
                    {
                        var ev_tr_id = $('#this_event_truck_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_truck_docs')}}",
                            type: 'POST',
                            data: {
                                truckId: ev_tr_id,
                                reqId: $('#truck_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#truck_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#truck_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    },
                 
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
                $('#truck-upload_'+i).css('pointer-events', 'none');
            }
        };

        var liquorDocUploader  = [];

        const liquorDocUpload = () => {
            var per_doc = $('#liquor_document_count').val();
            // var total = parseInt($('#liquor_additional_doc > div').length);
            for(var i = 1; i <=  parseInt(per_doc);i++){
                    var reqID =  $('#liqour_req_id_'+i).val()  ;
                    liquorDocUploader[i] = $('#liquoruploader_'+i).uploadFile({
                    url: "{{route('event.uploadLiquor')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",       
                    fileName: "liquor_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: ``,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-default mb-2 mr-2',
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                        
                        // let path = file_path.replace('public/','');
                        let user_id = $('#user_id').val();
                        let event_id = $('#event_id').val();
                        let liquor_id = $('#liquor_id').val();
                        let path = user_id+'/event/'+ event_id +'/liquor/' +liquor_id +'/'+reqID +'/' +files;
                        window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    },
                    onLoad:function(obj)
                    {
                        var ev_lq_id = $('#event_liquor_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_liquor_docs')}}",
                            type: 'POST',
                            data: {
                                liquor_id: ev_lq_id,
                                reqId: $('#liqour_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        let docName =  d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#liquor_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#liquor_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    },
                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
                $('#liquor-upload_'+i).css('pointer-events', 'none');
            }
        };

        function checkLiquorVenue(id)
        {
            if(id == 1)
            {
                $('#liquor_provided_form').show();
                $('#liquor_details_form').hide();
                $('#liquor_upload_form').hide();
            }else if(id == 0) {
                $('#liquor_provided_form').hide();
                $('#liquor_details_form').show();
                $('#liquor_upload_form').show();
            }
        }


        function changeLiquorService()
        {
            var service = $('#liquor_service').val();
            if(service == 'limited')
            {
                $('#limited_types').show();
            }else{
                $('#limited_types').hide();
            }
        }



        function viewLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url: url,
                success: function (data) {
                    if(data) 
                    {
                        $('#liquor_details').modal('show');
                        $('#event_liquor_id').val(data.event_liquor_id);
                        $('#liquor_details .ajax-file-upload-red').trigger('click');
                        if(data.provided == 1)
                        {
                            checkLiquorVenue(1);
                            $('#liquor_permit_no').val(data.liquor_permit_no);
                            $("input:radio[name='isLiquorVenue'][value='1']").attr('checked', true);
                        }else {
                            checkLiquorVenue(0);
                            $("input:radio[name='isLiquorVenue'][value='0']").attr('checked', true)
                            $('#l_company_name_en').val(data.company_name_en);
                            $('#l_company_name_ar').val(data.company_name_ar);
                            $('#purchase_receipt').val(data.purchase_receipt);
                            $('#liquor_service').val(data.liquor_service);
                            changeLiquorService();
                            $('#liquor_types').val(data.liquor_types);
                            liquorDocUpload();
                        }
                    }
                }
            });
        }


 
</script>
@endsection