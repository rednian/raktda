@extends('layouts.app')

@section('title', 'Amend Event Permit - Smart Government Rak')

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Amend Event Permit')}}
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$event->permit_number}}</strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{URL::signedRoute('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la {{getLangId() == 1 ? 'la-angle-left' : 'la-angle-right'}}"></i>
                    {{__('BACK')}}
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{URL::signedRoute('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la {{getLangId() == 1 ? 'la-angle-left' : 'la-angle-right'}}"></i>
                </a>

            </div>
        </div>
    </div>

    <input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-container col-md-12 kt-padding-0 kt-margin-b-15 row">
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Reference No')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{$event->reference_number}}
                </p>
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Applicant Type')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{__(ucfirst($event->firm))}}</p>
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event Name')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{getLangId() == 1 ? ucfirst($event->name_en) : $event->name_ar}}
                </p>
            </div>
            <div class="col-md-4 row">
                <label for="issued_date" class="col col-md-6 col-form-label kt-font-bolder">
                    {{__('From Date')}} <span class="text-danger">*</span></label>
                <div class="col col-md-6 form-group form-group-xs ">
                    <div class="input-group input-group-sm date">
                        <div class="kt-input-icon kt-input-icon--right">
                            <input type="text" class="form-control form-control-sm " name="issued_date"
                                   id="issued_date" placeholder="DD-MM-YYYY"
                                   value="{{date('d-m-Y', strtotime($event->issued_date))}}"
                                   onchange="changeExpiry();givWarn()" />
                            <input type="hidden" id="old-issue-date" value="{{date('d-m-Y', strtotime($event->issued_date))}}">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                <span>
                                    <i class="la la-calendar"></i>
                                </span>
                            </span>
                        </div>
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
            <div class="col-md-4 row">
                <label for="issued_date" class="col col-md-6 col-form-label kt-font-bolder">
                    {{__('To Date')}} </label>
                <div class="col col-md-6 form-group form-group-xs ">
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
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event Owner')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{getLangId() == 1 ? ucfirst($event->owner_name) : $event->owner_name_ar}}
                </p>
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event Type')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{getLangId() == 1 ? ucfirst($event->type->name_en) : $event->type->name_ar}}
                </p>
            </div>
            @if(!is_null($event->subType->sub_name_en))
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Event SubType')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{getLangId() == 1 ? ucwords($event->subType->sub_name_en) : $event->subType->sub_name_ar }}
                </p>
            </div>
            @endif
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Expected Audience')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                {{$event->audience_number}}
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Longitude')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{$event->longitude}}
                </p>
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Latitude')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{$event->latitude}}
                </p>
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Area')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{getLangId() == 1 ? ucfirst($event->area['area_en']) : $event->area['area_ar']}}
                </p>
            </div>
            <div class="col-md-4 row">
                <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Street')}}</label>
                <p class="col col-md-6 form-control-plaintext ">
                    {{$event->street}}
                </p>
            </div>
                <div class="col-md-4 row">
                    <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Food Truck')}} ?</label>
                    <div class="col col-md-6 d-flex">
                            <span class="form-control-plaintext">
                                {{$event->truck()->exists() ? __('Yes') : __('No')}}</span>
                        @if(!$event->truck()->exists())
                            {{-- <button type="button" class="btn btn-sm btn-secondary btn-hover-warning">{{__('Add')}}</button>
                            --}}
                            <i class="fa fa-plus-circle text-warning fnt-20 kt-padding-t-10" onclick="addTruck()" title="{{__('Add Food Truck')}}"></i>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 row">
                    <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Liquor Serving')}} ?</label>
                    <div class="col col-md-6 d-flex">
                            <span class="form-control-plaintext ">
                                {{$event->liquor()->exists() ? __('Yes') : __('No')}}</span>
                        @if(!$event->liquor()->exists())
                            {{-- <button type="button" class="btn btn-sm btn-secondary btn-hover-warning">{{__('Add')}}</button>
                            --}}
                            <i class="fa fa-plus-circle text-warning fnt-20 kt-padding-t-10" onclick="addLiquor()" title="{{__('Add Liquor')}}"></i>
                        @endif
                    </div>
                </div>

        </div>

        <div class="kt-container col-md-12 kt-padding-0 kt-margin-b-15 row">
            <div class="col-md-12 row">
                <label class="col col-md-2 col-form-label kt-font-bolder">{{__('Event Details')}}</label>
                <p class="col col-md-10 form-control-plaintext ">
                    {{getLangId() == 1 ? ucfirst($event->description_en) : $event->description_ar}}
                </p>
            </div>
            <div class="col-md-12 row">
                <label class="col col-md-2 col-form-label kt-font-bolder">{{__('Address')}}</label>
                <p class="col col-md-10 form-control-plaintext ">
                    {{$event->address}}
                </p>
            </div>
            <div class="col-md-12 row">
                <label class="col col-md-2 col-form-label kt-font-bolder">{{__('Venue')}}</label>
                <p class="col col-md-10 form-control-plaintext ">
                    {{getLangId() == 1 ? ucfirst($event->venue_en) : $event->venue_ar}}
                </p>
            </div>
        </div>

    @if($event->truck()->exists())
    <div class="d-flex kt-margin-b-10 justify-content-between kt-margin-t-15">
        <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Food Truck List')}}</h5>
        <button class="btn btn-sm btn-secondary btn-hover-elevate"
            id="add_new_truck">
            <i class="fa fa-plus text-warning"></i>
            {{__('Add New')}}</button>
    </div>
    <div class="table-responsive">
        <table class="table table-borderless border table-striped">
            <thead class="text-center">
                <th>#</th>
                <th>{{__('Establishment Name (EN)')}}</th>
                <th>{{__('Establishment Name (AR)')}}</th>
                <th>{{__('Traffic Plate No')}}</th>
                <th>{{__('Types of provided F&B')}}</th>
                <th></th>
            </thead>
            <tbody id="food_truck_list">

            </tbody>
        </table>

        <div id="disp_mess" class="text-center"></div>
    </div>
    @endif

    <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">

    <input type="hidden" id="isLiquor" value="{{$event->liquor()->exists() == true ? 1 : 0 }}">

    @if($event->liquor()->exists())

            <h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">{{__('Liquor Details')}}</h5>
            @if($event->liquor->provided == 0)
                <label class="col-form-label"> {{__('Provided by venue ?')}} &emsp;{{__('No')}}</label>
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead >
                            <th>{{__('Establishment Name (EN)')}}</th>
                            <th>{{__('Establishment Name (AR)')}}</th>
                            <th>{{__('Purchase Receipt No')}}</th>
                            <th>{{__('Liquor Service')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="liquor_list">
                            <td>{{$event->liquor->company_name_en}}</td>
                            <td>{{$event->liquor->company_name_ar}}</td>
                            <td>{{$event->liquor->purchase_receipt}}</td>
                            <td>{{ucfirst($event->liquor->liquor_service)}}</td>
                            <td>
                                @if($event->liquor->status == 2)
                                    <a onclick="editLiquor({{$event->liquor->event_liquor_id}})"><i class="fa fa-pen fnt-16 text-info"></i></a>
                                    &emsp;<a href="#" data-target="#removeLiquorModal" data-toggle="modal" onclick="setLiquorModal({{$event->liquor->event_liquor_id}})"><i class="fa fa-trash fnt-16 text-danger"></i></a>
                                    @else
                                <a href="#"  onClick="viewLiquor({{$event->liquor->event_liquor_id}})" title="{{__('View Liquor Details')}}"><i class="fa fa-file fnt-16 "></i></a>
                                    @endif
                            </td>
                        </tbody>
                    </table>
                </div>
            @elseif($event->liquor->provided == 1)
                <label class="col-form-label"> {{__('Provided by venue ?')}} &emsp; {{__('Yes')}}</label>
                <div class="table-responsive">
                    <table class="table table-borderless border table-striped">
                        <thead >
                            <th>{{__('Liquor Permit No')}}</th>
                            <th></th>
                        </thead>
                        <tbody id="liquor_list">
                            <td>{{$event->liquor->liquor_permit_no ? $event->liquor->liquor_permit_no : ''}}</td>
                            <td>
                                @if($event->liquor->status == 2)
                                    <a onclick="editLiquor({{$event->liquor->event_liquor_id}})"><i class="fa fa-pen fnt-16 text-info"></i></a>
                                    &emsp;<a href="#" data-target="#removeLiquorModal" data-toggle="modal" onclick="setLiquorModal({{$event->liquor->event_liquor_id}})"><i class="fa fa-trash fnt-16 text-danger"></i></a>
                                @else
                                <a href="#"  onClick="viewLiquor({{$event->liquor->event_liquor_id}})" title="{{__('View Liquor Details')}}"><i class="fa fa-file fnt-16 "></i></a>
                                @endif
                            </td>
                        </tbody>
                    </table>
                </div>
            @endif
            <input type="hidden" id="event_liquor_id" value="{{$event->liquor->event_liquor_id}}">

@endif


        <input type="hidden" name="unpaid-fee" value="{{$isUnpaid}}">

<div class="d-flex kt-margin-t-20 justify-content-md-end justify-content-sm-center">
    <input type="submit" class="col-md-2 btn btn--yellow btn-sm kt-font-bold kt-font-transform-u" id="submit_btn"
        value="{{__('Submit')}}">
</div>
</div>



<div class="modal hide" id="removeModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Remove Food Truck')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body d-flex justify-content-between">
                <h6 class="text--maroon">{{__('Are you sure to remove this food truck')}} ?</h6>
                <form action="{{route('event.foodtruck.delete')}}" method="POST">
                    @csrf
                    <input type="hidden" name="del_truck_id" id="del-truck-id">
                    <input type="hidden" name="del_truck_event_id" value="{{$event->event_id}}">
                    <input type="submit" class="btn btn-sm btn--yellow" value="{{__('Ok')}}">
                </form>
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



@include('permits.event.messages.show_warning_modal', ['day_count' => getSettings()->event_start_after]);

    @include('permits.event.foodtruck.amend_food_truck', ['truck_req'=>$truck_req])

    @include('permits.event.foodtruck.show-one-foodtruck', ['truck_req'=>$truck_req, 'from' => 'amend'])

    @include('permits.event.liquor.view_liquor', ['liquor_req'=>$liquor_req])

    @include('permits.event.liquor.liquor', ['liquor_req'=>$liquor_req, 'from' => 'amend'])

    @include('permits.event.liquor.remove-modal')

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

        var unPaidFee = $('#unpaid-fee').val();
        if(!unPaidFee)
        {
            $('#submit_btn').attr('disabled', true);
        }
        @if($event->liquor->status == 2)
        $('#submit_btn').attr('disabled', false);
        @endif

    })

    $('.datepicker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true, orientation: 'bottom' });

        // $('#time_start').timepicker();
        // $('#time_end').timepicker();

        function changeExpiry(){
            let oldIssueDate = $('#old-issue-date').val();
            var days = $('#days').val();
            var issued_date = $('#issued_date').val();
            var exp = moment(issued_date, 'DD-MM-YYYY').add(days, 'days').toDate();
            if(issued_date != oldIssueDate) {
                $('#submit_btn').attr('disabled', false);
            }
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
            var isLiquor = $('#isLiquor').val();
            var type ;
            if(isLiquor) {
                type =  $("input:radio[name='isLiquorVenue']:checked").val();
            }
            var hasFile = liqourDocValidation(type);
            // if(isLiquor == 1 ? type == 0 ? liquorValidator.form() && hasFile : liquorProvidedValidator.form() : 1)
            // {
                // if(isLiquor) {
                //     if(type == 0)
                //     {
                //         liquorDetails = {
                //             company_name_en: $('#l_company_name_en').val(),
                //             company_name_ar: $('#l_company_name_ar').val(),
                //             purchase_receipt: $('#purchase_receipt').val(),
                //             liquor_service: $('#liquor_service').val(),
                //         };
                //         if($('#liquor_service').val() == 'limited'){
                //             liquorDetails['liquor_types'] = $('#liquor_types').val()
                //         }
                //     } else {
                //         liquorDetails = {
                //             liquor_permit_no: $('#liquor_permit_no').val(),
                //         };
                //     }
                // }
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
                        // liquorDetails: liquorDetails,
                        // liquorDocDetails: JSON.stringify(liquorDocDetails),
                        // liquorNames: JSON.stringify(liquorNames),
                        // event_liquor_id: $('#event_liquor_id').val()
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
                        KTApp.unblockPage();
                        if(result)
                        {
                            window.location.href = result.toURL;
                        }
                    }

            });
                // localStorage.setItem('liquor_details', JSON.stringify(liquorDetails));
                // $('#liquor_details').modal('hide');
            // }

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


        function addLiquor() {
            $('#liquor_details').modal('show');
            checkLiquorVenue(0);
            changeLiquorService('unlimited');
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
                           $('#food_truck_list').append('<tr class="text-center"><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td class="text-right">'+ result[s].company_name_ar+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"><span id="append_'+s+'"></span></td></tr>');

                           if(result[s].paid == 0 && result[s].status == 2){
                               $('#append_'+s+'').append('<span onclick="editThisTruck('+result[s].event_truck_id+', '+k+')"><i class="fa fa-pen fnt-16 text-info"></i></span></button>&emsp;<a href="#" data-target="#removeModal" data-id="'+result[s].event_truck_id+'"  data-toggle="modal" id="remove-truck-btn"><i class="fa fa-trash fnt-16 text-danger"></i></a>');
                               $('#remove_truck_id').val(result[s].event_truck_id);
                               $('#submit_btn').attr('disabled', false);
                           }else {
                               $('#append_'+s)
                                   .append('<span><i class="fa fa-file fnt-16 " ' +
                                       'onclick="viewTruck('+result[s].event_truck_id+')"></i></span>');
                           }
                        }
                    }
                }
            });
        }

        function viewTruck(id) {
            var url = "{{route('event.fetch_this_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result)
                    {
                        $('#show-one-foodtruck').modal({
                            backdrop: 'static',
                            keyboard: false,
                            show: true
                        });
                        $('#so_company_name_en').val(result.company_name_en);
                        $('#so_company_name_ar').val(result.company_name_ar);
                        $('#so_plate_no').val(result.plate_number);
                        $('#so_food_type').val(result.food_type);
                        $('#so_regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#so_regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#so_this_event_truck_id').val(result.event_truck_id);
                        $('#show-one-foodtruck .ajax-file-upload-red').trigger('click');

                        truckDocUploadView();
                    }
                }
            });
        }

    const truckDocUploadView = () => {
        var per_truck_doc = $('#so_truck_document_count').val();
        var total = parseInt($('#so_truck_additional_doc > div').length);
        for(var i = 1; i <= parseInt(per_truck_doc) + total ;i++){
            let reqID = $('#truck_req_id_'+i).val();
            truckDocUploader[i] = $('#so_truckuploader_'+i).uploadFile({
                url: "{{route('event.uploadTruck')}}",
                method: "POST",
                fileName: "so_truck_file_"+i,
                multiple: true,
                downloadStr: `<i class="la la-download"></i>`,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                maxFileSize: 5242880,
                showFileCounter: false,
                showProgress: false,
                abortStr: '',
                returnType: "json",
                maxFileCount: 2,
                showPreview: false,
                showDownload: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                formData: {
                    id: i ,
                    reqId: $('#so_truck_req_id_'+i).val()
                },
                downloadCallback: function (files, pd) {

                    if(files)
                    {
                        let user_id = $('#user_id').val();
                        let event_id = $('#event_id').val();
                        let truck_id = $('#so_this_event_truck_id').val();
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
                    var ev_tr_id = $('#so_this_event_truck_id').val();
                    $.ajax({
                        url: "{{route('event.fetch_this_truck_docs')}}",
                        type: 'POST',
                        data: {
                            truckId: ev_tr_id,
                            reqId: $('#so_truck_req_id_'+i).val(),
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
        }
    };

        $(document).on('click', '#remove-truck-btn', function(){
            var bookId = $(this).data('id');
            $('#del-truck-id').val(bookId);
        })

        $('#update_lq').click(function(){
            var type = $("input:radio[name='isLiquorVenue']:checked").val();
            var hasFile = liqourDocValidation(type);
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
            $('#amend_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#edit_truck_title,#update_this_td').addClass('kt-hide');
            truckDocUpload();
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
                        $('#edit_truck_title').show();
                        $('#add_truck_title').hide();
                        $('#update_this_td').show();
                        $('#add_new_td').hide();
                        $('#amend_food_truck').modal({
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
            $('#amend_food_truck').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            $('#truck_details_form').trigger('reset');
            $('#edit_truck_title').hide();
            $('#update_this_td').hide();
            $('#add_truck_title').show();
            $('#amend_food_truck .ajax-file-upload-red').trigger('click');
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
<<<<<<< HEAD
                                editTruck();
=======
                                //editTruck();
                                location.reload(true);
>>>>>>> f2245977b6b50d027cc6c3807ef74b0abc304bae
                                $('#amend_food_truck').modal('hide');
                                $('#disp_mess').html('<h5 class="text-success py-2">{!! __('Food Truck details Added successfully') !!}</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                                $('#submit_btn').attr('disabled', false);
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
                                $('#amend_food_truck').modal('hide');
                                $('#disp_mess').html('<h5 class="text-success py-2">{!! __('Food Truck details updated successfully') !!}</h5>');
                                setTimeout(function(){ $('#disp_mess').html('');}, 2000);
                                $('#submit_btn').attr('disabled', false);
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
                let reqID = $('#truck_req_id_'+i).val();
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
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
                                console.log('');
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

        function liqourDocValidation(type){
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = parseInt($('#liquor_document_count').val());
            if(type == undefined) {
                type = 0;
            }
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
                            if($('#liqour_req_type_'+d).val() == 'provided' && type == 0) {
                                hasFileArray[d] = true;
                                $("#liquor-upload_" + d).css('border', '2px dotted #A5A5C7');
                            }
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
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
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
                        if(files.filepath) {
                            let file_path = files.filepath;
                            let path = file_path.replace('public/', '');
                            window.open(
                                "{{url('storage')}}" + '/' + path,
                                '_blank'
                            );
                        }
                        else {
                            let user_id = $('#user_id').val();
                            let event_id = $('#event_id').val();
                            let liquor_id = $('#event_liquor_id').val();
                            let path = user_id+'/event/'+ event_id +'/liquor/' +liquor_id +'/'+reqID +'/' +files;
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
                                   for(data of data) {
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
                $('#liquor_provided_upload_form').show();
                $('#liquor_details_form').hide();
                $('#liquor_upload_form').hide();
                // $('#liquor_upload_form-div').hide();
            }else if(id == 0) {
                $('#liquor_provided_form').hide();
                $('#liquor_provided_upload_form').hide();
                $('#liquor_details_form').show();
                $('#liquor_upload_form').show();
                // $('#liquor_upload_form-div').show();
            }
        }

        function changeLiquorService(service)
        {
            if(service == 'limited')
            {
                console.log('nothere')
                $('#limited_types').show();
            }else{
                console.log('here')
                $('#limited_types').hide();
            }
        }

        function setLiquorModal(id) {
            $('#del-liquor-id').val(id);
        }

    function editLiquor(id){
            if(id){
                var url = "{{route('liquor.show', ':id')}}";
                url = url.replace(':id', id);
                $.ajax({
                    url:  url,
                    success: function (data) {
                        if(data)
                        {
                            $('#liquor_details .ajax-file-upload-red').trigger('click');
                            $('#event_liquor_id').val(data.event_liquor_id);
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
                                changeLiquorService(data.liquor_service);
                                $('#liquor_types').val(data.liquor_types);
                                liquorDocUpload();
                            }
                            $('#liquor_details').modal('show');
                        }
                    }
                });
            }
        }




        function viewLiquor(id){
            var url = "{{URL::signedRoute('liquor.show', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (data) {
                    if(data.provided == 1)
                    {
                        $('#vl_liquor_provided_form').show();
                        $('#vl_liquor_provided_upload_form').show();
                        $('#vl_liquor_details_form').hide();
                        $('#vl_liquor_upload_form').hide();
                    }else if(data.provided == 0) {
                        $('#vl_liquor_provided_form').hide();
                        $('#vl_liquor_provided_upload_form').hide();
                        $('#vl_liquor_details_form').show();
                        $('#vl_liquor_upload_form').show();
                        // $('#liquor_upload_form-div').show();
                    }
                    if(data.provided == 1){
                        $('#vl_liquor_permit_no').val(data.liquor_permit_no);
                        $("input:radio[name='vl_isLiquorVenue'][value='1']").attr('checked', true);
                    }else if(data.provided == 0) {
                        $("input:radio[name='vl_isLiquorVenue'][value='0']").attr('checked', true);
                        $('#vl_company_name_en').val(data.company_name_en);
                        $('#vl_company_name_ar').val(data.company_name_ar);
                        $('#vl_purchase_receipt').val(data.purchase_receipt);
                        $('#vl_liquor_service').val(data.liquor_service);
                        if(data.liquor_service == 'limited')
                        {
                            $('#vl_limited_types').show();
                        }else{
                            $('#vl_limited_types').hide();
                        }
                        $('#vl_liquor_types').val(data.liquor_types);
                    }
                    resetLiquorUploads();
                    liquorDocUploadView();
                    $('#show_liquor_details').modal('show');
                }
            });
        }

    const liquorDocUploadView = () => {
        var per_doc = $('#vl_liquor_document_count').val();
        // var total = parseInt($('#liquor_additional_doc > div').length);
        for(var i = 1; i <=  parseInt(per_doc);i++){
            var reqID =  $('#vl_liqour_req_id_'+i).val()  ;
            liquorDocUploader[i] = $('#vl_liquoruploader_'+i).uploadFile({
                url: "{{route('event.uploadLiquor')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png,pdf",
                fileName: "vl_liquor_file_"+i,
                multiple: true,
                downloadStr: `<i class="la la-download"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                maxFileSize: 5242880,
                showFileCounter: false,
                showProgress: false,
                abortStr: '',
                returnType: "json",
                maxFileCount: 2,
                showPreview: false,
                showDelete:false,
                showDownload: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                formData: {id:  i, reqId: reqID },
                downloadCallback: function (files, pd) {
                    if(files.filepath) {
                        let file_path = files.filepath;
                        let path = file_path.replace('public/', '');
                        window.open(
                            "{{url('storage')}}" + '/' + path,
                            '_blank'
                        );
                    }
                    else {
                        let user_id = $('#user_id').val();
                        let event_id = $('#event_id').val();
                        let liquor_id = $('#vl_event_liquor_id').val();
                        let path = user_id+'/event/'+ event_id +'/liquor/' +liquor_id +'/'+reqID +'/' +files;
                        window.open(
                            "{{url('storage')}}"+'/' + path,
                            '_blank'
                        );
                    }

                },
                onLoad:function(obj)
                {
                    var ev_lq_id = $('#vl_event_liquor_id').val();
                    $.ajax({
                        url: "{{route('event.fetch_this_liquor_docs')}}",
                        type: 'POST',
                        data: {
                            liquor_id: ev_lq_id,
                            reqId: $('#vl_liqour_req_id_'+i).val(),
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
                                    }
                                    j++;
                                }
                            }
                        }
                    });
                },


            });
            $('#vl_liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
            $('#vl_liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
        }
    };


    function resetLiquorUploads(){
            let  per_doc = $('#liquor_document_count').val();
            // var total = parseInt($('#liquor_additional_doc > div').length);
            for(let i = 1; i <=  parseInt(per_doc);i++){
                let uploadObj =$('#liquoruploader_'+i).uploadFile();
                uploadObj.reset();
            }
        }



</script>
@endsection
