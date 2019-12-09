@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Event Permit Details
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
            <div class="event--view-head">
                <div class="col-md-12 pb-4 d-flex flex-sm-column flex-md-row">
                    @if($event->logo_thumbnail)
                    <div class="col-md-4 img-responsive">
                        <img src="{{url('storage').'/'.$event->logo_thumbnail}}" alt="image">
                    </div>
                    @endif
                    <div class="col-md-8 d-flex flex-column justify-content-flex-start">
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Ref No')}}</label>
                            <span class="col-md-6">{{$event->reference_number}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Application Type')}}</label>
                            <span class="col-md-6">{{ucwords($event->firm)}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Event Name')}}</label>
                            <span class="col-md-6">{{getLangId() == 1 ? $event->name_en : $event->name_ar}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Venue')}}
                            </label>
                            <span class="col-md-6">{{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Address')}}</label>
                            <span class="col-md-6">{{$event->address}}</span>
                        </div>
                        <div class="pb-2 row">
                            <label
                                class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Area')}}</label>
                            <span class="col-md-6">{{$event->area['area_en']}}</span>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="event_id" value="{{$event->event_id}}">

                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Issue Date')}}</label>
                    <span class="col-md-6">{{$event->issued_date}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Expiry Date')}}</label>
                    <span class="col-md-6">{{$event->expired_date}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Est. Audience')}}</label>
                    <span class="col-md-6">{{$event->audience_number}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Time from')}}
                    </label>
                    <span class="col-md-6">{{$event->time_start}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Time To')}}
                    </label>
                    <span class="col-md-6">{{$event->time_end}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Description')}}
                    </label>
                    <span
                        class="col-md-6">{{getLangId() == 1 ? $event->description_en : $event->description_ar }}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Street')}}
                    </label>
                    <span class="col-md-6">{{$event->street}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Longitude')}}
                    </label>
                    <span class="col-md-6">{{$event->longitude}}</span>
                </div>
                <div class="col-md-4 pb-2 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Latitude')}}
                    </label>
                    <span class="col-md-6">{{$event->latitude}}</span>
                </div>
            </div>
            <div>
                @if($event->is_truck)
                <div class="d-flex kt-margin-b-10 justify-content-between">
                    <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Truck Details</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead class="text-center">
                            <th>#</th>
                            <th>{{__('Company')}}</th>
                            <th>{{__('Plate No')}}</th>
                            <th>{{__('Type of Food')}}</th>
                            <th>{{__('Reg Issued')}}</th>
                            <th>{{__('Reg Expired')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="food_truck_list">
                            @php
                            $i = 1;
                            @endphp
                            @foreach($event->truck as $truck)
                            <tr class="text-center">
                                <td>{{$i}}</td>
                                <td>{{getLangId() == 1 ? $truck->company_name_en : $truck->company_name_ar}}</td>
                                <td>{{$truck->plate_number}}</td>
                                <td>{{$truck->food_type}}</td>
                                <td>{{date('d-M-Y', strtotime($truck->registration_issued_date))}}
                                </td>
                                <td>{{date('d-M-Y', strtotime($truck->registration_expired_date))}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-secondary"
                                        onclick="viewThisTruck({{$truck->event_truck_id}})">View</a>
                                </td>
                            </tr>
                            @php
                            $i++;
                            @endphp
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
                <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Liquor Details</h5>
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead class="text-center">
                            <th>{{__('Company')}}</th>
                            <th>{{__('License No')}}</th>
                            <th>{{__('License Expiry')}}</th>
                            <th>{{__('Trade License')}}</th>
                            <th>{{__('TL Expiry')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="food_truck_list">
                            <tr class="text-center">
                                <td>{{getLangId() == 1 ? $liquor->company_name_en : $liquor->company_name_ar}}</td>
                                <td>{{$liquor->license_number}}</td>
                                <td>{{date('d-M-Y', strtotime($liquor->license_expired_date))}}</td>
                                <td>{{$liquor->trade_license}}
                                </td>
                                <td>{{date('d-M-Y', strtotime($liquor->trade_license_expired_date))}}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-secondary"
                                        onclick="viewLiquor('{{$liquor->event_liquor_id}}')">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                </div>

                <input type="hidden" class="map-input" id="address-input" value="{{$event->address}}" />
                <input type="hidden" id="latitude" value="{{$event->latitude}}" />
                <input type="hidden" id="longitude" value="{{$event->longitude}}" />
                <div id="address-map-container" style="width:100%;height:200px;padding:15px;">
                    <div style="width: 100%; height: 100%" id="map"></div>
                </div>
                @if($artist)
                {{-- {{dd($artist)}} --}}
                <div class="pt-2 img-responsive">
                    <h5 class="text--maroon kt-font-transform-u p-4">Artist Details</h5>
                    <table class="table table-striped table-hover border table-borderless">
                        <thead>
                            <tr>
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
                <div class="event--requirement-files pt-5">
                    <table class="table table-hover table-borderless border table-striped">
                        <thead class="text-center">
                            <tr>
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


                    @endif

                </div>

            </div>
        </div>
    </div>

    @include('permits.event.common.view_food_truck', ['truck_req'=>$truck_req])
    @include('permits.event.common.show_liquor', ['liquor_req'=>$liquor_req])

    @endsection



    @section('script')
    <script src="{{asset('js/company/map.js')}}"></script>
    <script src="{{asset('js/company/uploadfile.js')}}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6nhSpjNed-wgUyVMJQZJTRniW-Oj_Tgw&libraries=places&callback=initialize"
        async defer></script>

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
                                $('.ajax-file-upload-red').trigger('click');
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
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: false,
                    showDownload: true,
                    uploadButtonClass: 'btn btn--default mb-2 mr-2',
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
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: false,
                    showDownload: true,
                    uploadButtonClass: 'btn btn--default mb-2 mr-2',
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



        function viewLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url: url,
                success: function (data) {
                    if(data) 
                    {
                        $('#liquor_details').modal('show');
                        $('#l_company_name_en').val(data.company_name_en);
                        $('#l_company_name_ar').val(data.company_name_ar);
                        $('#license_no').val(data.license_number);
                        $('#license_no').val(data.license_number);
                        $('#l_issue_date').val(data.license_issued_date ? moment(data.license_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#l_expiry_date').val(data.license_expired_date ? moment(data.license_expired_date,'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#l_emirates').val(data.emirate_id ? JSON.parse(data.emirate_id) : '');
                        $('#trade_license_no').val(data.trade_license);
                        $('#tl_issue_date').val(data.trade_license_issued_date ? moment(data.trade_license_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#tl_expiry_date').val(data.trade_license_expired_date ? moment(data.trade_license_expired_date , 'YYYY-MM-DD').format('DD-MM-YYYY') : '');
                        $('#event_liquor_id').val(data.event_liquor_id);
                    }
                    $('.ajax-file-upload-red').trigger('click');
                    liquorDocUpload();
                }
            });
        }


 
    </script>
    @endsection