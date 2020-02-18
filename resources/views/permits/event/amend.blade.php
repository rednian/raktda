@extends('layouts.app')

@section('title', 'Amend Event Permit - Smart Government Rak')

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Amend Event Permit')}}
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$event->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{URL::signedRoute('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{URL::signedRoute('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>

            </div>
        </div>
    </div>

    <input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-container col-md-12 kt-padding-0 kt-margin-b-15 row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Reference No.')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->reference_number}}
                        </p>
                    </div>
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Est. Type')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{__(ucfirst($event->firm))}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Owner Name')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->owner_name}}
                        </p>
                    </div>
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Owner Name - Ar')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->owner_name_ar}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event Name')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{getLangId() == 1 ? $event->name_en : $event->name_ar}}
                        </p>
                    </div>
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event Type')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{getLangId() == 1 ? $event->type->name_en : $event->type->name_ar}}

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event SubType')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->subType->sub_name_en !== null ?  getLangId() == 1 ? $event->subType->sub_name_en : $event->subType->sub_name_ar : ''}}
                        </p>
                    </div>
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Exp. Audience')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->audience_number}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Longitude')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->longitude}}
                        </p>
                    </div>
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Latitude')}}</label>
                        <p class="col col-md-6 form-control-plaintext ">
                            {{$event->latitude}}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Food Truck')}}</label>
                        <div class="col col-md-6 d-flex">
                            <span class="form-control-plaintext">
                                {{$event->truck()->exists() ? 'Yes' : 'No'}}</span>
                            @if(!$event->truck()->exists())
                            {{-- <button type="button" class="btn btn-sm btn-secondary btn-hover-warning">{{__('Add')}}</button>
                            --}}
                            <i class="fa fa-pencil-alt fnt-16  kt-padding-t-10" onclick="addTruck()"></i>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Liquor')}}</label>
                        <div class="col col-md-6 d-flex">
                            <span class="form-control-plaintext ">
                                {{$event->liquor()->exists() ? 'Yes' : 'No'}}</span>
                            @if(!$event->liquor()->exists())
                            {{-- <button type="button" class="btn btn-sm btn-secondary btn-hover-warning">{{__('Add')}}</button>
                            --}}
                            <i class="fa fa-pencil-alt fnt-16  kt-padding-t-10" onclick="addLiquor()"></i>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6 form-group form-group-xs ">
                        <label for="issued_date" class=" col-form-label kt-font-bold text-right">
                            {{__('From Date')}} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm date">
                            <div class="kt-input-icon kt-input-icon--right">
                                <input type="text" class="form-control form-control-sm " name="issued_date"
                                    id="issued_date" placeholder="DD-MM-YYYY"
                                    value="{{date('d-m-Y', strtotime($event->issued_date))}}"
                                    onchange="changeExpiry();givWarn()" />
                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                    <span>
                                        <i class="la la-calendar"></i>
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    @php
                    $issued_date = strtotime($event->issued_date);
                    $expired_date = strtotime($event->expired_date);
                    $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                    @endphp
                    <input type="hidden" id="days" value="{{$diff}}">
                    <input type="hidden" id="event_id" name="event_id" value="{{$event->event_id}}">


                    <div class="col-md-6 form-group form-group-xs ">
                        <label for="issued_date" class=" col-form-label kt-font-bold text-right">
                            {{__('To Date')}} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-sm date">
                            <div class="kt-input-icon kt-input-icon--right">
                                <input type="text" class="form-control form-control-sm" name="disp_expired_date"
                                    id="disp_expired_date" value="{{date('d-m-Y', strtotime($event->expired_date))}}"
                                    disabled />
                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                    <span>
                                        <i class="la la-calendar"></i>
                                    </span>
                                </span>
                            </div>
                            <input type="hidden" name="expired_date" id="expired_date"
                                value="{{date('d-m-Y', strtotime($event->expired_date))}}" />
                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-6 form-group form-group-xs ">
                        <label for="time_start" class=" col-form-label kt-font-bold text-right">
                            {{__('Start Time')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="time_start" id="time_start"
                    value="{{$event->time_start}}" />
            </div>
            <div class="col-md-6 form-group form-group-xs ">
                <label for="time_start" class=" col-form-label kt-font-bold text-right">
                    {{__('End Time')}} <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="time_end" id="time_end"
                    value="{{$event->time_end}}" />
            </div>
        </div> --}}
    </div>
</div>


<div>
    <table class="table table-borderless border">
        <tbody>
            <tr>
                <td class="kt-font-bolder">{{__('Event Details')}}
                </td>
                <td>:</td>
                <td class="">{{getLangId() == 1 ? $event->description_en : $event->description_ar}}</td>
            </tr>
            <tr>
                <td class="kt-font-bolder">{{__('Address')}}
                </td>
                <td>:</td>
                <td class="">{{$event->address}}</td>
            </tr>
            <tr>
                <td class="kt-font-bolder">{{__('Venue')}}
                </td>
                <td>:</td>
                <td class="">{{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}</td>
            </tr>
        </tbody>
    </table>
</div>
<div>
    @if($event->truck()->exists())
    <div class="d-flex kt-margin-b-10 justify-content-between kt-margin-t-15">
        <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Food Truck Details')}}</h5>
        <button class="btn btn-sm btn-secondary btn-hover-warning"
            id="add_new_truck">{{__('Add New Food Truck')}}</button>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless border table-striped">
            <thead class="text-center">
                <th>#</th>
                <th>{{__('Establishment Name')}}</th>
                <th>{{__('Establishment Name (AR)')}}</th>
                <th>{{__('Traffic Plate No')}}</th>
                <th>{{__('Food Services')}}</th>
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

<input type="hidden" id="isLiquor" value="{{$event->liquor()->exists() == true ? 1 : 0 }}">

<div>
    @if($event->liquor()->exists())
    <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Liquor Details')}}</h5>
    <div class="col-md-12 form-group form-group-xs d-flex">
        <label class="col-form-label"> {{__('Provided by venue')}}
            ?</label>
        <div class="kt-radio-inline" style="margin: auto 5%;">
            <label class="kt-radio ">
                <input type="radio" name="isLiquorVenue" onclick="checkLiquorVenue(1)" value="1">
                {{__('Yes')}}
                <span></span>
            </label>
            <label class="kt-radio">
                <input type="radio" name="isLiquorVenue" onclick="checkLiquorVenue(0)" value="0">
                {{__('No')}}
                <span></span>
            </label>
        </div>
    </div>
    <input type="hidden" id="liquor_provided" value="{{$event->liquor->provided}}">
    <form class="col-md-12" id="liquor_details_form" novalidate autocomplete="off">
        <div class="row">
            <div class="col-md-4 form-group form-group-xs">
                <label for="" class="col-form-label kt-font-bold">{{__('Establishment Name')}} <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="l_company_name_en" id="l_company_name_en"
                    value="{{$event->liquor->company_name_en}}" autocomplete="off">
            </div>
            <div class="col-md-4 form-group form-group-xs">
                <label for="" class="col-form-label kt-font-bold">{{__('Establishment Name (AR)')}} <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="l_company_name_ar" id="l_company_name_ar"
                    dir="rtl" value="{{$event->liquor->company_name_ar}}" autocomplete="off">
            </div>
            <div class="col-md-4 form-group form-group-xs">
                <label for="" class="col-form-label kt-font-bold">{{__('Purchase Receipt No')}} <span
                        class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" name="purchase_receipt" id="purchase_receipt"
                    value="{{$event->liquor->purchase_receipt}}" autocomplete="off">
            </div>
            <div class="col-md-4 form-group form-group-xs">
                <label for="" class="col-form-label kt-font-bold">{{__('Liquor Service')}} <span
                        class="text-danger">*</span></label>
                <select class="form-control form-control-sm" name="liquor_service" id="liquor_service"
                    onchange="changeLiquorService()">
                    <option value="">{{__('Select')}}</option>
                    <option value="limited" {{$event->liquor->liquor_service == 'limited' ? 'selected' : ''}}>
                        {{__('Limited')}}</option>
                    <option value="unlimited" {{$event->liquor->liquor_service == 'unlimited' ? 'selected' : ''}}>
                        {{__('Unlimited')}}</option>
                </select>
            </div>
            <div class="col-md-4 form-group form-group-xs" id="limited_types">
                <label for="" class="col-form-label kt-font-bold">{{__('Types of Liquor')}} <span
                        class="text-danger">*</span></label>
                <textarea type="text" dir="ltr" class="form-control form-control-sm" name="liquor_types"
                    id="liquor_types" autocomplete="off" value="{{$event->liquor->liquor_types}}"></textarea>
            </div>
            <input type="hidden" id="event_liquor_id" value="{{$event->liquor->event_liquor_id}}">
        </div>
    </form>
    <form id="liquor_provided_form" autocomplete="off">
        <div class="col-md-4 form-group form-group-xs">
            <label for="" class="col-form-label kt-font-bold">{{__('Liquor Permit No')}} <span
                    class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" name="liquor_permit_no" id="liquor_permit_no"
                value="{{$event->liquor->liquor_permit_no ? $event->liquor->liquor_permit_no : ''}}" autocomplete="off">
        </div>
    </form>
</div>
<div class="kt-margin-t-20" id="liquor_upload_form-div">
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
            <input type="hidden" id="liquordatesRequiredCheck_{{$i}}" value="{{$req->dates_required}}">
            @if($req->dates_required == 1)
            <div class="col-lg-2 col-sm-12">
                <label for="" class="text--maroon kt-font-bold" title="Issue Date">{{__('Issued Date')}}</label>
                <input type="text" class="form-control form-control-sm date-picker" name="liquor_doc_issue_date_{{$i}}"
                    data-date-end-date="0d" id="liquor_doc_issue_date_{{$i}}" placeholder="DD-MM-YYYY" />
            </div>
            <div class="col-lg-2 col-sm-12">
                <label for="" class="text--maroon kt-font-bold" title="Expiry Date">{{__('Expiry Date')}}</label>
                <input type="text" class="form-control form-control-sm date-picker" name="liquor_doc_exp_date_{{$i}}"
                    id="liquor_doc_exp_date_{{$i}}" placeholder="DD-MM-YYYY" />
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


<div class="d-flex kt-margin-t-20 justify-content-md-end justify-content-sm-center">
    <input type="submit" class="col-md-2 btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn"
        value="{{__('submit')}}">
</div>
</div>
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
                <h6 class="text--maroon">{{__('Are you sure to remove data')}} ?</h6>
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

@include('permits.event.common.show_warning_modal', ['day_count' => getSettings()->event_start_after]);

@if($event->truck()->exists())
@include('permits.event.common.amend_food_truck', ['truck_req'=>$truck_req])
@else
@include('permits.event.common.edit_food_truck', ['truck_req'=>$truck_req])
@endif

@include('permits.event.common.liquor', ['liquor_req'=>$liquor_req, 'from' => 'amend'])

@endsection

@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    $('#issued_date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '+1d',
        orientation: "bottom left"
    });
    $('#expired_date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
        orientation: "bottom left"
    });

    var truckDocUploader = [];
    var liquorDocUploader = [];
    var truckDocValidator ;
    // var liquorDocDetails = {};
    var truckDetails = {};
    var liquorDetails = {};
    // var truckDocDetails = {};
    var truckDocRules = {};
    var truckDocMessages = {};
    var docRules = {};
    var docMessages = {};
    var liquorNames= {};
    // var truckDocumentsValidator ;
    // var liquorDocumentsValidator ;

    $(document).ready(function(){
        liquorDocUpload();
        @if($event->truck()->exists())
        editTruck();
        @endif
        var provided = $('#liquor_provided').val();
        checkLiquorVenue(provided);
        changeLiquorService();
        $("input:radio[name='isLiquorVenue'][value='"+provided+"']").attr('checked', true);
    })

    $('.datepicker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true, orientation: 'bottom' });

        // $('#time_start').timepicker();
        // $('#time_end').timepicker();

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

        // var truckDocRules = {};
        // var truckDocMessages = {};

        // for(var i = 1; i <= $('#truck_document_count').val(); i++)
        // {
        //     if($('#truckdatesRequiredCheck_'+i).val() == 1)
        //     {
        //         truckDocRules['truck_doc_issue_date_'+i] = 'required';
        //         truckDocRules['truck_doc_exp_date_'+i] = 'required';
        //         truckDocMessages['truck_doc_issue_date_'+i] = '';
        //         truckDocMessages['truck_doc_exp_date_'+i] = '';
        //     }
        // }

        // var liquorDocRules = {};
        // var liquorDocMessages = {};

        // for(var i = 1; i <= $('#liquor_document_count').val(); i++)
        // {
        //     if($('#liquordatesRequiredCheck_'+i).val() == 1)
        //     {
        //         liquorDocRules['liquor_doc_issue_date_'+i] = 'required';
        //         liquorDocRules['liquor_doc_exp_date_'+i] = 'required';
        //         liquorDocMessages['liquor_doc_issue_date_'+i] = '';
        //         liquorDocMessages['liquor_doc_exp_date_'+i] = '';
        //     }
        // }

        

        $('#submit_btn').click(function(){
            var hasFile = liqourDocValidation();
            var isLiquor = $('#isLiquor').val();
            var type ;
            if(isLiquor) {
                type =  $("input:radio[name='isLiquorVenue']:checked").val();
            }
            if(isLiquor == 1 ? type == 0 ? liquorValidator.form() && hasFile : liquorProvidedValidator.form() : 1)
            {
                if(isLiquor) {
                    if(type == 0)
                    {
                        liquorDetails = {
                            company_name_en: $('#l_company_name_en').val(),
                            company_name_ar: $('#l_company_name_ar').val(),
                            purchase_receipt: $('#purchase_receipt').val(),
                            liquor_service: $('#liquor_service').val(),
                        };
                        if($('#liquor_service').val() == 'limited'){
                            liquorDetails['liquor_types'] = $('#liquor_types').val()
                        }
                    } else {
                        liquorDetails = {
                            liquor_permit_no: $('#liquor_permit_no').val(),
                        };
                    }
                }
                $.ajax({    
                    url:  "{{route('event.applyAmend')}}",
                    type:'POST',
                    data: { 
                        event_id: $('#event_id').val(),
                        issued_date: $('#issued_date').val(),
                        expired_date: $('#expired_date').val(),
                        time_start:  '',
                        type: type,
                        time_end: '',
                        liquorDetails: liquorDetails,
                        // liquorDocDetails: JSON.stringify(liquorDocDetails),
                        liquorNames: JSON.stringify(liquorNames),
                        event_liquor_id: $('#event_liquor_id').val()
                    }, 
                    beforeSend: function() {
                        KTApp.blockPage({
                            overlayColor: '#000000',
                            type: 'v2',
                            state: 'success',
                            message: '{{__("Please wait...")}}'
                        });
                    },
                    success: function (result) {
                        console.log(result);
                        KTApp.unblockPage();
                        if(result) 
                        {
                            window.location.href = result.toURL;
                        }
                    }

            });
                // localStorage.setItem('liquor_details', JSON.stringify(liquorDetails));
                $('#liquor_details').modal('hide');
            }
           
        });

         
        $('#regis_issue_date , #regis_expiry_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
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
                        // truckDocDetails[i] = {
                        //     issue_date: $('#truck_doc_issue_date_' + i).val(),
                        //     exp_date: $('#truck_doc_exp_date_' + i).val()
                        // }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            // localStorage.setItem('truck_doc_details', JSON.stringify(truckDocDetails));

            return hasFile;
        }

        
        function go_back_truck_list()
        {
            $('#edit_food_truck').modal('show');
            $('#edit_one_food_truck').modal('hide');
        }

        function addLiquor() {
            $('#liquor_details').modal('show'); 
            checkLiquorVenue(0);
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
                           $('#food_truck_list').append('<tr class="text-center"><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td class="text-right">'+ result[s].company_name_ar+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"> <span onclick="editThisTruck('+result[s].event_truck_id+', '+k+')"><i class="fa fa-pen fnt-16 text-info"></i></span></button>&emsp;<span id="append_'+s+'"></span></td></tr>');

                           if(result[s].paid == 0){
                               $('#append_'+s+'').append('<a class="btn btn-secondary" data-target="#removeModal" data-toggle="modal"><i class="fa fa-trash fnt-16 text-danger"></i></a>');
                               $('#remove_truck_id').val(result[s].event_truck_id);
                           }

                        
                        }
                    }
                }
            });
        }

        $('#update_lq').click(function(){
            var hasFile = liqourDocValidation();
            var type = $("input:radio[name='isLiquorVenue']:checked").val();
            if(type == 0 ? liquorValidator.form() && hasFile : liquorProvidedValidator.form())
            {
                if(type == 0)
                {
                    liquorDetails = {
                        company_name_en: $('#l_company_name_en').val(),
                        company_name_ar: $('#l_company_name_ar').val(),
                        purchase_receipt: $('#purchase_receipt').val(),
                        liquor_service: $('#liquor_service').val(),
                    };
                    if($('#liquor_service').val() == 'limited'){
                        liquorDetails['liquor_types'] = $('#liquor_types').val()
                    }
                } else {
                    liquorDetails = {
                        liquor_permit_no: $('#liquor_permit_no').val(),
                    };
                }
                $.ajax({
                        url: "{{route('event.add_liquor')}}",
                        type: "POST",
                        data: {
                            liquorDetails: liquorDetails,
                            // liquorDocDetails: JSON.stringify(liquorDocDetails),
                            liquorNames: JSON.stringify(liquorNames),
                            from: 'amend',
                            type: type,
                            event_id: $('#event_id').val(),
                            event_liquor_id: $('#event_liquor_id').val()
                        },  
                        success: function (result) {
                            if(result)
                            {
                                $('#event_liquor_id').val(result.event_liquor_id);
                                $("input:radio[name='isLiquorVenue']:checked").val(result.provided);
                                location.reload(true);
                            }
                        }
                });
                // localStorage.setItem('liquor_details', JSON.stringify(liquorDetails));
                $('#liquor_details').modal('hide');
            }
        });
        

        function addTruck(){
            // $('#edit_food_truck').modal('show');
            $('#edit_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
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
                    if(result.status.trim() == 'done') 
                    {
                        editTruck();
                        $('#removeModal').modal('hide');
                        $('#disp_mess').html('<h5 class="text-danger py-2">Food Truck Details Deleted successfully</h5>');
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
                        $('#edit_one_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
                        $('#company_name_en').val(result.company_name_en);
                        $('#company_name_ar').val(result.company_name_ar);
                        $('#plate_no').val(result.plate_number);
                        $('#food_type').val(result.food_type);
                        $('#regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#this_event_truck_id').val(result.event_truck_id);
                        $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
                        // truckDocumentsValidator = $('#truck_upload_form').validate({
                        //     rules: truckDocRules,
                        //     messages: truckDocMessages
                        // });
                        truckDocUpload();
                    }
                }
            });
        }

        $('#add_new_truck').click(function(){
            $('#this_event_truck_id').val('');
            $('#edit_one_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#truck_details_form').trigger('reset');
            $('#edit_truck_title').hide();
            $('#update_this_td').hide();
            $('#add_truck_title').show();
            $('#add_new_td').show();
            $('#edit_food_truck').modal('hide');
            $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
            // truckDocumentsValidator = $('#truck_upload_form').validate({
            //     rules: truckDocRules,
            //     messages: truckDocMessages
            // });
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
                // var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url: "{{route('event.add_update_truck')}}",
                        type: "POST",
                        data: {
                            event_id: $('#event_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            from: 'amend',
                            // truckDocDetails: truckDocDetails,
                            truck_id: ''
                        },
                        success: function (result) {
                            if(result.status.trim() == 'done')
                            {
                                editTruck();
                                $('#edit_one_food_truck').modal('hide');
                                $('#edit_food_truck').modal('show');
                                $('#disp_mess').html('<h5 class="text-success py-2">Food Truck details Added successfully</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                                location.reload(true);
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
                // var truckDocDetails = localStorage.getItem('truck_doc_details');
                if(truckDetails)
                {
                    $.ajax({
                        url:  "{{route('event.add_update_truck')}}",
                        type: 'POST', 
                        data: {
                            truck_id : $('#this_event_truck_id').val(),
                            truckDetails: JSON.stringify(truck_details),
                            // truckDocDetails: truckDocDetails,
                            eventId: $('#event_id').val(),
                            from: 'amend'
                        },
                        success: function (result) {
                            if(result.status.trim() == 'done') 
                            {
                                editTruck();
                                $('#edit_food_truck').modal('show');
                                $('#edit_one_food_truck').modal('hide');
                                $('#disp_mess').html('<h5 class="text-success py-2">Food Truck details updated successfully</h5>');
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
                    maxFileSize: 5242880,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
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
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
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
                purchase_receipt: 'required',
                liquor_service: 'required',
            },
            messages: {
                l_company_name_en: '',
                l_company_name_ar: '',
                purchase_receipt: '',
                liquor_service: '',
            }
        });

        var liquorProvidedValidator = $('#liquor_provided_form').validate({
            rules: {
                liquor_permit_no: 'required'
            },
            messages: {
                liquor_permit_no: ''
            }
        })

        function liqourDocValidation(){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = parseInt($('#liquor_document_count').val());
            // var total = parseInt($('#liquor_additional_doc > div').length);
            if(reqCount > 0)
            {
                for (var d = 1; d <= reqCount; d++) 
                {
                    let children = $('#liquor-file-upload_' + d).children();
                    let fileNames = Object.keys(children).map(function(key){
                        return children[key].innerText != undefined ? children[key].innerText : '';
                    });

                    if($('#liquor-file-upload_'+d).length) {
                        if($('#liquor-file-upload_'+d).contents().length === 0)
                        {
                            hasFileArray[d] = false;
                            $('#liquor-upload_'+d).css('border', '2px dotted red');
                        } else {
                            hasFileArray[d] = true;
                            $("#liquor-upload_" + d).css('border', '2px dotted #A5A5C7');
                        }
                        // liquorDocDetails[d] = {
                        //     issue_date: $('#liquor_doc_issue_date_' + d).length ? $('#liquor_doc_issue_date_' + d).val() : '',
                        //     exp_date: $('#liquor_doc_exp_date_' + d).length ? $('#liquor_doc_exp_date_' + d).val() : '',
                        // }

                        liquorNames[d] = {
                            reqId: $('#liqour_req_id_'+d).val(),
                            fileNames
                        }
                    }
                }
            }
            if (hasFileArray.includes(false)) {
                hasFile = false;
            } else {
                hasFile = true;
            }
            // localStorage.setItem('liquordocumentDetails', JSON.stringify());

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
                    maxFileSize: 5242880,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
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
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
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

        function checkLiquorVenue(id)
        {
            if(id == 1)
            {
                $('#liquor_provided_form').show();
                $('#liquor_details_form').hide();
                $('#liquor_upload_form').hide();
                $('#liquor_upload_form-div').hide();
            }else if(id == 0) {
                $('#liquor_provided_form').hide();
                $('#liquor_details_form').show();
                $('#liquor_upload_form').show();
                $('#liquor_upload_form-div').show();
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

        // function editLiquor(){
        //     var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
        //     url = url.replace(':id', $('#event_id').val());
        //     $.ajax({
        //         url:  url,
        //         success: function (data) {
        //             console.log(data)
        //             if(data.length) 
        //             {
        //                 $('#liquor_details .ajax-file-upload-red').trigger('click');
        //                 // $('#liquor_details').modal('show');
        //                 $('#event_liquor_id').val(data.event_liquor_id);
        //                 if(data.provided == 1)
        //                 {
        //                     checkLiquorVenue(1);
        //                     $('#liquor_permit_no').val(data.liquor_permit_no);
        //                     $("input:radio[name='isLiquorVenue'][value='1']").attr('checked', true);
        //                 }else {
        //                     checkLiquorVenue(0);
        //                     $("input:radio[name='isLiquorVenue'][value='0']").attr('checked', true)
        //                     $('#l_company_name_en').val(data.company_name_en);
        //                     $('#l_company_name_ar').val(data.company_name_ar);
        //                     $('#purchase_receipt').val(data.purchase_receipt);
        //                     $('#liquor_service').val(data.liquor_service);
        //                     changeLiquorService();
        //                     $('#liquor_types').val(data.liquor_types);
        //                     liquorDocUpload();
        //                 }
        //             }
        //         }
        //     });
        // }

        

</script>
@endsection