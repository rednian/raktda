@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">{{__('Amend Event Permit')}}
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

    <input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">

    <div class="kt-portlet__body">

        <div class="kt-container">
            <div class="event--view-head">
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Ref No.')}}</label>
                    <span class="col-md-6">{{$event->reference_number}}</span>
                </div>
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Event Name')}}</label>
                    <span class="col-md-6">{{$event->name_en}}</span>
                </div>
                <div class="col-md-4 pb-4 row">
                    <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Venue')}}
                    </label>
                    <span class="col-md-6">{{$event->venue_en}}</span>
                </div>
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Issued Date')}}
                    </label>
                    <input type="text" class="col-md-6 form-control form-control-sm datepicker" name="issued_date"
                        id="issued_date" value="{{date('d-m-Y', strtotime($event->issued_date))}}"
                        onchange="changeExpiry();givWarn()" />
                </div>
                @php
                $issued_date = strtotime($event->issued_date);
                $expired_date = strtotime($event->expired_date);
                $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                @endphp
                <input type="hidden" id="days" value="{{$diff}}">
                <input type="hidden" id="event_id" name="event_id" value="{{$event->event_id}}">
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u pr-4">{{__('Expired Date')}}
                    </label>
                    <input type="text" class="col-md-6 form-control form-control-sm datepicker" name="disp_expired_date"
                        id="disp_expired_date" value="{{date('d-m-Y', strtotime($event->expired_date))}}" disabled />
                    <input type="hidden" name="expired_date" id="expired_date"
                        value="{{date('d-m-Y', strtotime($event->expired_date))}}" />
                </div>
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Area')}}</label>
                    <span class="col-md-6">{{$event->area['area_en']}}</span>
                </div>
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Start Time')}}
                    </label>
                    <input type="text" class="col-md-6 form-control form-control-sm" name="time_start" id="time_start"
                        value="{{$event->time_start}}" />
                </div>
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('End Time')}}
                    </label>
                    <input type="text" class="col-md-6 form-control form-control-sm" name="time_end" id="time_end"
                        value="{{$event->time_end}}" />
                </div>
                <div class="col-md-4 pb-4 row">
                    <label
                        class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">{{__('Emirate')}}</label>
                    <span class="col-md-6">{{$event->emirate['name_en']}}</span>
                </div>

            </div>

            <div>
                @if($event->is_truck)
                <div class="d-flex kt-margin-b-10 justify-content-between">
                    <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Truck Details</h5>
                    <button class="btn btn-sm btn-default" id="add_new_truck">Add New Truck</button>
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

                        </tbody>
                    </table>

                    <div id="disp_mess" class="text-center"></div>
                </div>
                @endif
            </div>

            <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">

            <div>
                @if($event->is_liquor)
                <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Liquor Details</h5>
                <div>
                    <form class="col-md-12" id="liquor_details_form" novalidate autocomplete="off">
                        <div class="row">
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('Company Name')}}</label>
                                <input type="text" class="form-control form-control-sm" name="l_company_name_en"
                                    id="l_company_name_en" value="{{$event->liquor->company_name_en}}"
                                    autocomplete="off" placeholder="Company Name">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('Company Name - Ar')}}</label>
                                <input type="text" class="form-control form-control-sm" name="l_company_name_ar"
                                    value="{{$event->liquor->company_name_ar}}" id="l_company_name_ar"
                                    autocomplete="off" placeholder="Company Name - Ar">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('Trade License No')}}</label>
                                <input type="text" class="form-control form-control-sm" name="trade_license_no"
                                    value="{{$event->liquor->trade_license}}" id="trade_license_no" autocomplete="off"
                                    placeholder="Trade License No">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('TL Issue')}} </label>
                                <input type="text" class="form-control form-control-sm date-picker" name="tl_issue_date"
                                    value="{{date('d-m-Y', strtotime($event->liquor->trade_license_issued_date))}}"
                                    data-date-end-date="+0d" id="tl_issue_date" autocomplete="off"
                                    placeholder="DD-MM-YYYY">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('TL Expiry')}} </label>
                                <input type="text" class="form-control form-control-sm date-picker"
                                    name="tl_expiry_date"
                                    value="{{date('d-m-Y', strtotime($event->liquor->trade_license_expired_date))}}"
                                    data-date-start-date="+0d" id="tl_expiry_date" autocomplete="off"
                                    placeholder="DD-MM-YYYY">
                            </div>

                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('License No')}}</label>
                                <input type="text" class="form-control form-control-sm" name="license_no"
                                    id="license_no" autocomplete="off" value="{{$event->liquor->license_number}}"
                                    placeholder="License No">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('License Issue')}} </label>
                                <input type="text" class="form-control form-control-sm date-picker" name="l_issue_date"
                                    data-date-end-date="+0d" id="l_issue_date"
                                    value="{{date('d-m-Y', strtotime($event->liquor->license_issued_date))}}"
                                    autocomplete="off" placeholder="DD-MM-YYYY">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('License Expiry')}} </label>
                                <input type="text" class="form-control form-control-sm date-picker" name="l_expiry_date"
                                    value="{{date('d-m-Y', strtotime($event->liquor->license_expired_date))}}"
                                    data-date-start-date="+0d" id="l_expiry_date" autocomplete="off"
                                    placeholder="DD-MM-YYYY">
                            </div>
                            <div class="col-md-4 form-group form-group-xs">
                                <label for="" class="col-form-label kt-font-bold">{{__('Emirates')}} </label>
                                <select name="l_emirates[]" id="l_emirates" multiple
                                    class="form-control form-control-sm">
                                    <option value=" ">{{__('Select')}}</option>
                                    @foreach($emirates as $em)
                                    <option value="{{$em->id}}"
                                        {{ in_array($em->id,json_decode($event->liquor->emirate_id)) ? 'selected' : ''}}>
                                        {{$em->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" id="event_liquor_id" value="{{$event->liquor->event_liquor_id}}">
                        </div>
                    </form>
                </div>
                <div class="kt-margin-t-20">
                    <h5 class="text-dark kt-margin-b-20 text-underline kt-font-bold">{{__('Liquor Required Documents')}}
                    </h5>
                    <form id="liquor_upload_form" class="col-md-12">
                        <input type="hidden" id="liquor_document_count" value="{{count($liquor_req)}}">
                        @php
                        $i = 1;
                        @endphp
                        @foreach($liquor_req as $req)
                        <div class="row">
                            <div class="col-lg-4 col-sm-12">
                                <label
                                    class="kt-font-bold text--maroon">{{getLangId() == 1 ? ucwords($req->requirement_name) : $req->requirement_name_ar  }}
                                    <span id="cnd_{{$i}}"></span>
                                </label>
                                <p for="" class="reqName">
                                    {{getLangId() == 1 ? ucwords($req->requirement_description) : $req->requirement_description_ar}}
                                </p>
                            </div>
                            <input type="hidden" value="{{$req->requirement_id}}" id="liqour_req_id_{{$i}}">
                            <input type="hidden" value="{{$req->requirement_name}}" id="liqour_req_name_{{$i}}">
                            <div class="col-lg-4 col-sm-12">
                                <label style="visibility:hidden">hidden</label>
                                <div id="liquoruploader_{{$i}}">{{__('Upload')}}
                                </div>
                            </div>
                            <input type="hidden" id="datesRequiredCheck_{{$i}}" value="{{$req->dates_required}}">
                            @if($req->dates_required == 1)
                            <div class="col-lg-2 col-sm-12">
                                <label for="" class="text--maroon kt-font-bold"
                                    title="Issue Date">{{__('Issue Date')}}</label>
                                <input type="text" class="form-control form-control-sm date-picker"
                                    name="liquor_doc_issue_date_{{$i}}" data-date-end-date="0d"
                                    id="liquor_doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" />
                            </div>
                            <div class="col-lg-2 col-sm-12">
                                <label for="" class="text--maroon kt-font-bold"
                                    title="Expiry Date">{{__('Expiry Date')}}</label>
                                <input type="text" class="form-control form-control-sm date-picker"
                                    name="liquor_doc_exp_date_{{$i}}" id="liquor_doc_exp_date_{{$i}}"
                                    placeholder="DD-MM-YYYY" />
                            </div>
                            @endif
                        </div>
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </form>
                </div>

                @endif
            </div>

            <input type="submit"
                class="col-md-2 kt-margin-t-20 btn btn--yellow btn-sm kt-font-bold kt-font-transform-u float-right"
                id="submit_btn" value="submit">

        </div>
    </div>


    <div class="modal hide" id="removeModal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('Remove Truck')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body d-flex justify-content-between">
                    <h6 class="text--maroon">Are you sure to remove data ?</h6>
                    <input type="hidden" id="remove_truck_id">
                    <button class="btn btn-sm btn--yellow" onclick="deleteThisTruck()">{{__('Ok')}}</button>
                </div>
            </div>
        </div>
    </div>



    {{--

            @if(count($eventReq) > 0)
            <div class="event--requirement-files pt-5">
                <table class="table table-hover table-borderless border table-striped">
                    <thead class="text-center">
                        <tr>
                            <th class="text-left">Document Name</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>View</th>
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
--}}

@include('permits.event.common.show_warning_modal');

@include('permits.event.common.amend_food_truck', ['truck_req'=>$truck_req])

@endsection

@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var truckDocUploader = [];
    var liquorDocUploader = [];
    var truckDocValidator ;
    var liquorDocDetails = {};
    var truckDetails = {};
    var truckDocDetails = {};
    var truckDocRules = {};
    var truckDocMessages = {};
    var docRules = {};
    var docMessages = {};

    $(document).ready(function(){
        liquorDocUpload();
        editTruck();
    })

    $('.datepicker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

        $('#time_start').timepicker();
        $('#time_end').timepicker();

        function changeExpiry(){
            var days = $('#days').val();
            var issued_date = $('#issued_date').val();
            var exp = moment(issued_date, 'DD-MM-YYYY').add(days, 'days').toDate();
            $('#disp_expired_date').val(moment(exp).format('DD-MM-YYYY'));
            $('#expired_date').val(moment(exp).format('DD-MM-YYYY'));
        }

        function givWarn()
        {
            var from_date = $('#issued_date').val();
            // var exp_date = $('#expired_date').val();
            let start_days_count = $('#settings_event_start_date').val();
            if(from_date)
            {
                var x = moment(from_date, "DD-MM-YYYY");
                // var y = moment(exp_date, "DD-MM-YYYY");
                var to = moment();

                var from = moment([x.format('YYYY'), x.month(), x.format('DD')]);
                // var to = moment([y.format('YYYY'), y.month(), y.format('DD')]);
                var today = moment([to.format('YYYY'), to.month(), to.format('DD')]);

                var diff = from.diff(today, 'days');

                if(diff <= start_days_count)
                {
                    // alert('It will take 10 days to process the permit');
                    $('#showwarning').modal('show');
                }
            }
        }

        

        $('#submit_btn').click(function(){
            var hasFile = liqourDocValidation();
            if(liquorValidator.form() && hasFile)
            {
                liquorDetails = {
                    company_name_en: $('#l_company_name_en').val(),
                    company_name_ar: $('#l_company_name_ar').val(),
                    license_no: $('#license_no').val(),
                    l_emirates: $('#l_emirates').val(),
                    l_issue_date: $('#l_issue_date').val(),
                    l_expiry_date: $('#l_expiry_date').val(),
                    trade_license_no: $('#trade_license_no').val(),
                    tl_issue_date: $('#tl_issue_date').val(),
                    tl_expiry_date: $('#tl_expiry_date').val()
                };
                var liquorDocDetails = localStorage.getItem('liquordocumentDetails');
                $.ajax({    
                    url:  "{{route('event.applyAmend')}}",
                    type:'POST',
                    data: { 
                        event_id: $('#event_id').val(),
                        issued_date: $('#issued_date').val(),
                        expired_date: $('#expired_date').val(),
                        time_start:  $('#time_start').val(),
                        time_end: $('#time_end').val(),
                        liquorDetails: liquorDetails,
                        liquorDocDetails: liquorDocDetails,
                        event_liquor_id: $('#event_liquor_id').val()
                    },  
                    success: function (result) {
                        if(result) 
                        {
                            window.location.href = "{{route('event.index')}}#applied";
                        }
                    }

            });
                // localStorage.setItem('liquor_details', JSON.stringify(liquorDetails));
                $('#liquor_details').modal('hide');
            }
           
        });

          /* Truck Script */

        function checkTruck(id) {
            var prev = $('#prev_val_isTruck').val();
            if (id == 1) {
               editTruck();
            } else if(id == 0) {
                $('#notSaveModal').modal({
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    });
                $('#sure_remove_close').attr('onclick', changeIsTruck());
                $('#fromSection').val('truck');
            }
        }


        function changeIsTruck() {
            if($('#food_truck_list tr').length == 0)
            {
                $('input[name="isTruck"]').filter('[value=0]').prop('checked', true);
            }else {
                $('input[name="isTruck"]').filter('[value=1]').prop('checked', true);
            }
           
        }

        $('.date-picker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });


        var truckValidator = $('#truck_details_form').validate({
            rules: {
                company_name_en: 'required',
                company_name_ar: 'required',
                plate_no: 'required',
                food_type: 'required',
                regis_issue_date: 'required',
                regis_expiry_date: 'required'
            },
            messages: {
                company_name_en: '',
                company_name_ar: '',
                plate_no: '',
                food_type: '',
                regis_issue_date: '',
                regis_expiry_date: ''
            }
        });

        function truckDocValidation(){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#truck_document_count').val();
            // var total = parseInt($('#truck_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) 
                {
                    if($('#truck-file-upload_'+i).length) {
                        if($('#truck-file-upload_'+i).contents().length === 0)
                        {
                            hasFileArray[i] = false;
                            $('#truck-upload_'+i).css('border', '2px dotted red');
                        } else {
                            hasFileArray[i] = true;
                            $("#truck-upload_" + i).css('border', '2px dotted #A5A5C7');
                        }
                        truckDocDetails[i] = {
                            issue_date: $('#truck_doc_issue_date_' + i).val(),
                            exp_date: $('#truck_doc_exp_date_' + i).val()
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            localStorage.setItem('truck_doc_details', JSON.stringify(truckDocDetails));

            return hasFile;
        }

        for(var i = 1; i <= $('#truck_document_count').val(); i++)
        {
            docRules['truck_doc_issue_date_'+i] = 'required';
            docRules['truck_doc_exp_date_'+i] = 'required';
            docMessages['truck_doc_issue_date_'+i] = '';
            docMessages['truck_doc_exp_date_'+i] = '';
        }
        
        function go_back_truck_list()
        {
            $('#edit_food_truck').modal('show');
            $('#edit_one_food_truck').modal('hide');
        }


        function editTruck(){
            var event_id = $('#event_id').val() ;
            var url = "{{route('event.fetch_truck_details_by_event_id', ':id')}}" ;
            url = url.replace(':id', event_id);
            $.ajax({    
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        $('#food_truck_list').empty();
                        // console.log(result);
                        $('#edit_food_truck').modal('show');
                        for(var s = 0;s < result.length;s++)
                        {
                            var k = s + 1 ;
                           $('#food_truck_list').append('<tr class="text-center"><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td>'+ moment(result[s].registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')+'</td><td>'+ moment(result[s].registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')+'</td><td class="text-center"> <button class="btn btn-secondary" onclick="editThisTruck('+result[s].event_truck_id+', '+k+')">Edit</button>&emsp;<span id="append_'+s+'"></span></td></tr>');

                           if(result.length > 1){
                               $('#append_'+s+'').append('<a class="btn btn-secondary" data-target="#removeModal" data-toggle="modal">Remove</a>');
                               $('#remove_truck_id').val(result[s].event_truck_id);
                           }
                        
                        }

                        
                    }
                }
            });
        }

        function deleteThisTruck()
        {
            var id = $('#remove_truck_id').val();
            var url = "{{route('event.delete_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        editTruck();
                        $('#removeModal').modal('hide');
                        $('#disp_mess').html('<h5 class="text-danger py-2">Truck Details Deleted successfully</h5>');
                        setTimeout(function(){ $('#disp_mess').html('');}, 2000)
                    }
                }
            });
        }
    
        function editThisTruck(id, num)
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

        $('#add_new_truck').click(function(){
            $('.ajax-file-upload-red').trigger('click');
            $('#truck_details_form').trigger('reset');
            $('#edit_one_food_truck').modal('show');
            $('#edit_truck_title').hide();
            $('#update_this_td').hide();
            $('#add_truck_title').show();
            $('#add_new_td').show();
            $('#edit_food_truck').modal('hide');
            truckDocUpload();
        });

        $('#add_new_td').click(function(){
            var hasFile = truckDocValidation();
            if(truckValidator.form() && hasFile)
            {
                var truck_details = {
                    company_name_en: $('#company_name_en').val(),
                    company_name_ar: $('#company_name_ar').val(),
                    plate_no: $('#plate_no').val(),
                    food_type: $('#food_type').val(),
                    regis_issue_date: $('#regis_issue_date').val(),
                    regis_expiry_date: $('#regis_expiry_date').val()
                }
                var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url: "{{route('event.add_update_truck')}}",
                        type: "POST",
                        data: {
                            event_id: $('#event_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            truckDocDetails: truckDocDetails,
                            truck_id: ''
                        },
                        success: function (result) {
                            if(result)
                            {
                                editTruck();
                                $('#edit_one_food_truck').modal('hide');
                                $('#edit_food_truck').modal('show');
                                $('#disp_mess').html('<h5 class="text-success py-2">Truck details Added successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                            }
                        }
                    });
                }
            }
        });

        $('#update_this_td').click(function(){
            var hasFile = truckDocValidation();
            if(truckValidator.form() && hasFile)
            {
                var truck_details = {
                    company_name_en: $('#company_name_en').val(),
                    company_name_ar: $('#company_name_ar').val(),
                    plate_no: $('#plate_no').val(),
                    food_type: $('#food_type').val(),
                    regis_issue_date: $('#regis_issue_date').val(),
                    regis_expiry_date: $('#regis_expiry_date').val()
                }
                var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url:  "{{route('event.add_update_truck')}}",
                        type: 'POST', 
                        data: {
                            truck_id : $('#this_event_truck_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            truckDocDetails: truckDocDetails,
                            eventId: $('#event_id').val(),
                            from: 'amend'
                        },
                        success: function (result) {
                            if(result) 
                            {
                                editTruck();
                                $('#edit_food_truck').modal('show');
                                $('#edit_one_food_truck').modal('hide');
                                $('#disp_mess').html('<h5 class="text-success py-2">Truck details updated successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                            }
                        }
                    });
                }
            }
        });

        const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            var total = parseInt($('#truck_additional_doc > div').length);
            for(var i = 1; i <= parseInt(per_truck_doc) + total ;i++){
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
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {
                        id: i , 
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    downloadCallback: function (files, pd) {
                      
                        if(files)
                        {
                            let user_id = $('#user_id').val();
                            let event_id = $('#event_id').val();
                            let truck_id = $('#this_event_truck_id').val();
                            let path = user_id+'/event/'+ event_id +'/truck/' +truck_id +'/'+reqID +'/' +files;
                            window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }else {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }
                        
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
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteTruckUploadedfile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: i },
                            success: function (result) {
                                console.log('success');
                            }   
                        });
                    }
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
            }
        };

 
    


        // script for liquor details




        var liquorValidator = $('#liquor_details_form').validate({
            rules: {
                l_company_name_en: 'required',
                l_company_name_ar: 'required',
                license_no: 'required',
                l_issue_date: 'required',
                l_expiry_date: 'required',
                "l_emirates[]": {
                    l_emirate: true,
                },
                trade_license_no: 'required',
                tl_issue_date: 'required',
                tl_expiry_date: 'required'
            },
            messages: {
                l_company_name_en: '',
                l_company_name_ar: '',
                license_no: '',
                l_issue_date: '',
                l_expiry_date: '',
                "l_emirates[]": 'must have rasalkhaimah',
                trade_license_no: '',
                tl_issue_date: '',
                tl_expiry_date: ''
            }
        });

        function liqourDocValidation(){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = parseInt($('#liquor_document_count').val());
            // var total = parseInt($('#liquor_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var d = 1; d <= reqCount; d++) 
                {
                    if($('#liquor-file-upload_'+d).length) {
                        if($('#liquor-file-upload_'+d).contents().length === 0)
                        {
                            hasFileArray[d] = false;
                            $('#liquor-upload_'+d).css('border', '2px dotted red');
                        } else {
                            hasFileArray[d] = true;
                            $("#liquor-upload_" + d).css('border', '2px dotted #A5A5C7');
                        }
                        liquorDocDetails[d] = {
                            issue_date: $('#liquor_doc_issue_date_' + d).val(),
                            exp_date: $('#liquor_doc_issue_date_' + d).val(),
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            localStorage.setItem('liquordocumentDetails', JSON.stringify(liquorDocDetails));

            return hasFile;
        }



    
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
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                        if(files)
                        {
                            let user_id = $('#user_id').val();
                            let event_id = $('#event_id').val();
                            let liquor_id = $('#event_liquor_id').val();
                            let path = user_id+'/event/'+ event_id +'/liquor/' +liquor_id +'/'+reqID +'/' +files;
                            window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }else {
                            let file_path = files.filepath;
                                let path = file_path.replace('public/','');
                                window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                            );
                        }
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
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
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
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteLiquorFile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: data.id},
                            success: function (result) {
                                console.log('success');
                            }
                        });
                    }
                    
                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
            }
        };

        
 
        $.validator.addMethod("l_emirate", function(value, element) {
            // return $('select[name="l_emirates[]"]').includes('5');
            return value.includes("5");
        },'License must be valid in Rasalkhaimah');
    


</script>
@endsection