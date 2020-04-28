@extends('layouts.app')

@section('title', 'Payment Event Permit - Smart Government Rak')

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">
{{-- {{dd(session()->all())}} --}}
<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items" id="event-wizard--nav">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span> {{__('Instructions')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="event_det">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> {{__('Event Details')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> {{__('Upload Docs')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" id="mk_payment">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>04</span> {{__('Payment')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <div class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>05</span> {{__('Happiness')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </div>

                    </div>
                </div>

                <!--end: Form Wizard Nav -->
            </div>


            <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">


            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->

                    @include('permits.event.common.instructions', ['event_types' => $event_types])

                    @include('permits.event.common.common-event-details', ['disabled' =>true])



                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <input type="hidden" id="requirements_count" />
                                <form id="documents_required">
                                </form>
                                <input type="hidden" id="addi_requirements_count">
                                <form id="addi_documents_required" novalidate>
                                </form>
                                <form id="image_upload_form">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12"><label
                                                class="kt-font-bold text--maroon">{{__('Images')}}</label>
                                            <p class="reqName">{{__('Add multiple images')}}</p>
                                        </div>
                                        <div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label>
                                            <div id="image_uploader">{{__('Upload')}}</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <form id="make_payment">
                                <div class="kt-widget kt-widget--project-1">
                                    <div class="kt-widget__body  kt-padding-l-10">
                                        <div class="kt-widget__stats d-">
                                            <div class="kt-widget__item">
                                                <span class="kt-widget__date pb-1">{{__('From Date')}}</span>
                                                <div class="kt-widget__label">
                                                    <span
                                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                                        {{date('jS F Y',strtotime($event->issued_date))}}&nbsp;

                                                    </span>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <span class="kt-widget__date pb-1">{{__('To Date')}}</span>
                                                <div class="kt-widget__label">
                                                    <span
                                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                                        {{date('jS F Y',strtotime($event->expired_date))}} &nbsp;

                                                    </span>
                                                </div>
                                            </div>
                                            @php
                                            $issued_date = strtotime($event->issued_date);
                                            $expired_date = strtotime($event->expired_date);
                                            $noofdays = (abs($expired_date - $issued_date) / 60 / 60 / 24) + 1;
                                            @endphp
                                            <div class="kt-widget__item">
                                                <span class="kt-widget__date pb-1">{{__('No.of.days')}}</span>
                                                <div class="kt-widget__label">
                                                    <span
                                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                                        {{$noofdays.' '.($noofdays > 1 ? __('days') :
                                                        __('day'))}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <span class="kt-widget__date pb-1">{{__('Reference No')}}</span>
                                                <div class="kt-widget__label">
                                                    <span
                                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                                        {{$event->reference_number}}
                                                    </span>
                                                </div>
                                            </div>
                                            @if($event->request_type == 'amend')
                                            <div class="kt-widget__item">
                                                <span class="kt-widget__date pb-1">{{__('Event Type')}}</span>
                                                <div class="kt-widget__label">
                                                    <span
                                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                                        {{getLangId() == 1 ? ucfirst($event->type['name_en']) : $event->type['name_ar']}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="kt-widget__item">
                                                <span class="kt-widget__date pb-1">{{__('Event Name')}}</span>
                                                <div class="kt-widget__label">
                                                    <span
                                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                                        {{getLangId() == 1 ? ucfirst($event->name_en) : $event->name_ar}}
                                                    </span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="kt-widget__text kt-margin-t-10">
                                            <strong>{{__('Venue')}} :</strong>
                                           <span  class="kt-widget__label pl-1"> {{getLangId() == 1 ? ucfirst($event->venue_en) : $event->venue_ar}}</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <h4 class="text-center kt-block-center kt-margin-20">Amount to be Paid: AED 2500</h4> --}}

                                @php

                                $event_fee_total = 0;
                                $truck_fee = 0;
                                $liquor_fee = 0;
                                @endphp
                                <input type="hidden" value="{{$noofdays}}" id="noofdays">
                                <div class="table-responsive col-md-12">
                                    <table class="table table-borderless table-hover border table-striped">
                                        <thead>
                                            <tr class="kt-font-transform-u">
                                                <th>{{__('Event Name')}}</th>
                                                <th>{{__('Event Type')}}</th>
                                                <th class="text-right">{{__('Fee / Day')}} (AED)</th>
                                                <th class="text-center">{{__('No.of.days')}}</th>
                                                <th class="text-center">{{__('Qty')}}</th>
                                                {{-- <th class="text-right">{{__('VAT')}} (5%)</th> --}}
                                                <th class="text-right">{{__('Total')}} (AED) </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($event->request_type != 'amend' && $event->paid == 0)
                                            <tr>
                                                <td class="text-left">
                                                    {{getLangId() == 1 ? ucwords($event->name_en) : $event->name_ar}}
                                                </td>
                                                <td class="text-left">
                                                    {{getLangId() == 1 ? ucwords($event->type['name_en']) : $event->type['name_ar']}}
                                                </td>
                                                @php
                                                $per_day_fee = (float)$event->type['amount'];
                                                $event_fee =  $per_day_fee * $noofdays;
                                                $event_fee_total += $event_fee;
                                                @endphp
                                                <td class="text-right">
                                                    {{number_format($per_day_fee,2)}}
                                                </td>
                                                <td class="text-center">
                                                    {{$noofdays}}
                                                </td>
                                                <td class="text-center">1</td>
                                                {{-- <td class="text-right">
                                                    {{number_format($vat_amt , 2)}}
                                                </td> --}}
                                                <td class="text-right">
                                                    {{number_format($event_fee, 2)}}
                                                </td>
                                            </tr>
                                            @endif
                                            @if(isset($event->truck) && count($event->truck->where('paid', 0)) > 0)
                                            <tr>
                                                @php
                                                $nooftrucks = count($event->truck->where('paid', 0));
                                                $per_truck_fee = (float)getSettings()->food_truck_fee;
                                                $truck_fee += $noofdays * $per_truck_fee * $nooftrucks;
                                                $event_fee_total += $truck_fee;
                                                @endphp
                                                <td colspan="2">{{__('Food Truck')}}</td>
                                                <td class="text-right">{{number_format($per_truck_fee, 2)}} / truck</td>
                                                <td class="text-center">
                                                    {{$noofdays}}
                                                </td>
                                                <td class="text-center">{{$nooftrucks}}</td>
                                                <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                            </tr>
                                            @endif
                                            @if($event->liquor->company_name_en !== null &&
                                            $event->liquor->provided == 0 && $event->liquor->paid == 0)
                                            <tr>
                                                <td colspan="2">{{__('Liquor')}} </td>
                                                @php
                                                $per_liquor_fee = (float)getSettings()->liquor_fee;
                                                $liquor_fee += $noofdays * $per_liquor_fee;
                                                $event_fee_total += $liquor_fee;
                                                @endphp
                                                <td class="text-right">{{number_format($per_liquor_fee, 2)}}</td>
                                                <td class="text-center">
                                                    {{$noofdays}}
                                                </td>
                                                <td class="text-center">-</td>
                                                <td class="text-right">{{number_format($liquor_fee, 2)}}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                <input type="hidden" id="truck_fee" value="{{$truck_fee}}">
                                <input type="hidden" id="liquor_fee" value="{{$liquor_fee}}">

                                <input type="hidden" id="event_total_amount" value="{{$event_fee_total}}">


                                <input type="hidden" value="{{$containsApproved}}" id="containsApproved">
                                <input type="hidden" value="{{$isPaid}}" id="isPaid">

                                @php
                                $artist_fee_total = 0;
                                @endphp

                                @if($event->permit && $event->permit->permit_status == 'approved-unpaid')
                                <div class="table-responsive col-md-12" id="artist_pay_table" style="display:none;">
                                    <table class="table table-borderless border table-hover table-striped">
                                        <thead>
                                            <tr class="kt-font-transform-u">
                                                <th>{{__('FIRST NAME')}}</th>
                                                <th>{{__('LAST NAME')}}</th>
                                                <th>{{__('Profession')}}</th>
                                                <th class="text-right">{{__('Profession Fee')}} (AED)</th>
                                                <th class="text-right">{{__('Total')}} (AED) </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($event->permit->artistPermit as $ap)
                                            @if($ap->artist_permit_status == 'approved' && $ap->is_paid == 0)
                                            <tr>
                                                <td>{{getLangId() == 1 ? $ap['firstname_en'] : $ap['firstname_ar']}}
                                                </td>
                                                <td>{{getLangId() == 1 ? $ap['lastname_en'] : $ap['lastname_ar']}}
                                                </td>
                                                <td>
                                                    {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                                </td>
                                                @php
                                                $professional_fee = (float) $ap->profession['amount'];
                                                $noofmonths = ceil($noofdays ? $noofdays/30 : 1) ;
                                                $artist_fee = $professional_fee * $noofmonths;
                                                $artist_fee_total += $artist_fee;
                                                @endphp
                                                <td class="text-right">
                                                    {{number_format($professional_fee,2)}}
                                                </td>
                                                {{-- <td class="text-right">
                                                    {{$noofdays.' '.__('days')}}
                                                </td> --}}
                                                <td class="text-right">
                                                    {{number_format($artist_fee, 2)}}
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <div style="display:none" id="is_event_pay_div">
                                    <label class="kt-checkbox kt-checkbox--warning ml-2 mt-3">
                                        <input type="checkbox" id="isEventPay" name="isEventPay"
                                            onchange="check_permit()">
                                        {{__('Do you want to pay the connected Artist Permit?')}}
                                        <span></span>
                                    </label>
                                </div>
                                @endif


                                <input type="hidden" value="{{$exempt}}" id="exempt-percentage">

                                <input type="hidden" id="artist_fee_total" value="{{$artist_fee_total}}">

                                <div class="table-responsive ">
                                    <div class="{{getLangId() == 1 ? 'pull-right' : 'pull-left'}}">
                                        <table class=" table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        {{__('Total Amount')}}
                                                    </td>
                                                    <td id="total_amt" class="pull-right kt-font-bold"></td>
                                                </tr>
                                                @if(!is_null($exempt) && $exempt > 0)
                                                    <tr style="border-bottom:1px solid #000;">
                                                        <td>
                                                            {{__('Discount Amount')}}
                                                        </td>
                                                        <td id="discount-amount" class="pull-right kt-font-bold"></td>
                                                    </tr>

                                                    <tr>
                                                        <td class="kt-font-transform-u">
                                                            {{__('Grand Total')}} (AED)
                                                        </td>
                                                        <td id="grand-total" class="pull-right kt-font-bold"></td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <input type="hidden" id="amount">
                                <input type="hidden" id="discount">
                                <input type="hidden" id="total">

                            </form>
                        </div>
                    </div>



                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('PREVIOUS')}}
                        </div>


                        <a href="{{URL::signedRoute('event.index')}}#applied">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('BACK')}}
                            </div>
                        </a>

                        {{-- @if($event->firm == 'government')

                        <a href="{{route('event.happiness', [ 'id' => $event->event_id ])}}">
                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            id="submit_next_btn">
                            {{__('Next')}}
                        </div>
                        </a>
                        @else --}}


                       <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                           onclick="Checkout.showLightbox()" id="submit_btn" data-ktwizard-type="action-submit">
                           <i class="fa fa-check"></i>
                           {{__('PAY')}}
                       </div>


{{--                     <button class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"onclick="paymentDoneUpdation('xyz', '10245');">payment</button>--}}

                        <a href="{{URL::signedRoute('event.happiness', [ 'id' => $event])}}" id="pay_next_btn"
                            class="kt-hide "><span
                                class="text-white btn btn-sm btn-wide btn--maroon kt-font-bold kt-font-transform-u">{{__('NEXT')}}</span>
                        </a>



                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            {{__('NEXT')}}
                        </div>


                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- end:: Content -->

<?php

$url = 'https://test-rakbankpay.mtf.gateway.mastercard.com/api/rest/version/54/merchant/NRSINFOWAYSL/session';
$postFields = array(
    'apiOperation' => 'CREATE_CHECKOUT_SESSION',
    'order' => array(
        'currency' => 'AED',
        'id' => getPaymentOrderId('event', $event->event_id)
    ),
    'interaction' => array(
        // "returnUrl" => route('event.happiness', ['id' => $event->event_id]),
        'operation' => 'PURCHASE'
    ),
);
$username = "merchant.NRSINFOWAYSL";
$password = "aabf38b7ab511335ba2fb786206b1dc0";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
// curl_setopt($curl, CURLOPT_HTTPHEADER, array(
// 'Content-Type: application/json'
// ));
curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postFields));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$output = curl_exec($curl);
curl_close($curl);
$output = json_decode($output);

?>

<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
        <div id="ajax_loader" style="min-height: 100vh;">
            <img src="{{asset('/img/ajax-loader.gif')}}" style="position: absolute; top:50%; left: 50%;">
        </div>
    </div>
</div>



@include('permits.event.foodtruck.show_food_truck', ['truck_req'=>$truck_req])
@include('permits.event.liquor.show_liquor', ['liquor_req'=>$liquor_req])
@endsection


@section('script')

<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script src="{{asset('js/company/map.js')}}"></script>

<script src="https://test-rakbankpay.mtf.gateway.mastercard.com/checkout/version/54/checkout.js"
    data-error="errorCallback" data-cancel="cancelCallback" data-complete="completedCallback">
    //
</script>
<script>
    function errorCallback(error) {
        $.notify({
        title: 'Error',
        message: "{{__('Payment cancelled ! Please Try Again')}}",
        },{
            type:'danger',
            animate: {
                enter: 'animated zoomIn',
                exit: 'animated zoomOut'
            },
        });
    }
    function cancelCallback() {
        $.notify({
            title: 'Error',
            message: "{{__('Payment cancelled ! Please Try Again')}}",
        },{
            type:'danger',
            animate: {
                enter: 'animated zoomIn',
                exit: 'animated zoomOut'
            },
        });
    }


    var sessionId = "{{$output->session->id}}";

    var successIndicator = "{{$output->successIndicator}}";


    Checkout.configure({
        merchant: 'NRSINFOWAYSL',
        order: {
            amount: function() {
                var discount = $('#discount').val();
                var amount = discount > 0 ? $('#total').val() : $('#amount').val();
                return amount;
            },
            currency: 'AED',
            description: 'Event Permit Payment'
        },
        session: {
            id: sessionId
        },
        interaction: {
            merchant: {
                    name: "{{__('Ras Al Khaimah TDA')}}",
            },
            @if(getLangId() == 2)
            locale : 'ar-AE',
            @endif
            displayControl: {
                billingAddress  : 'HIDE',
            }
        }
    });


    function completedCallback(resultIndicator, sessionVersion) {
        var transactionID, receipt ;
        if(successIndicator == resultIndicator)
        {
            var orderId = '{{getPaymentOrderId("event", $event->event_id)}}';
            var url = "{{route('company.getpaymentdetails', ['orderid' => ':orderId'])}}";
            url = url.replace(':orderId', orderId);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(res){
                    var res = JSON.parse(res);
                    var transactionId = res.transaction[0].transaction.acquirer.transactionId;
                    var receipt = res.transaction[0].transaction.receipt;
                    paymentDoneUpdation(transactionId, receipt);
                }
            });
        }
    }

    // console.log('{{getPaymentOrderId("event", $event->event_id)}}');

    function paymentDoneUpdation(transactionId,receipt) {
        var paidArtistFee = 0;
        if($('#isEventPay').prop("checked")){
            paidArtistFee = 1;
        }
        $.ajax({
            url: "{{route('company.event.make_payment')}}",
            type: "POST",
            data: {
                event_id:$('#event_id').val(),
                amount: $('#amount').val(),
                exempt: $('#exempt-percentage').val(),
                truck_fee: $('#truck_fee').val(),
                liquor_fee: $('#liquor_fee').val(),
                noofdays: $('#noofdays').val(),
                paidArtistFee: paidArtistFee,
                transactionId: transactionId,
                receipt: receipt,
                orderId: '{{getPaymentOrderId("event", $event->event_id)}}'
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
                if(result.message[0]){
                    window.location.href = result.toURL ;
                }
                KTApp.unblockPage();
            }
        });
    }

</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6nhSpjNed-wgUyVMJQZJTRniW-Oj_Tgw&libraries=places&callback=initialize"
    async defer></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    var truckDocUploader = [];
    var liquorDocUploader = [];

    $(document).ready(function(){
        setWizard();
        wizard = new KTWizard("kt_wizard_v3");
        $('.kt-checkbox span').removeClass('compulsory');
        wizard.goTo(4);
        $('#back_btn').css('display', 'none');
        $('#next_btn').css('display', 'none');
        $('#submit_btn').css('display', 'block');
        // $('#submit_next_btn').css('display', 'block');
        localStorage.clear();
        getRequirementsList();
        getAddtionalRequirementsList($('#event_id').val());
        imageUploadFunction();
        var artistContains = $('#containsApproved').val();
        var isPaid = $('#isPaid').val();

        if(artistContains == 1 && isPaid == 0){
            $('#is_event_pay_div').show();
        }else {
            $('#is_event_pay_div').hide();
        }

        var eventTotalAmount = $('#event_total_amount').val();
        $('#total_amt').html(formatAmount(eventTotalAmount));
        var eventVatTotal = $('#event_vat_total').val();
        $('#amount').val(eventTotalAmount);
        discountFunction(eventTotalAmount);
        if(eventTotalAmount == 0){
            $('#pay_next_btn').removeClass('kt-hide');
            $('#submit_btn').addClass('kt-hide');
        }

        var isTruck = $('#prev_val_isTruck').val();
        if(isTruck == 0){
            $('#truckEditBtn').hide();
        }
        var isLiquor = $('#prev_val_isLiquor').val();
        if(isLiquor == 0){
            $('#liquorEditBtn').hide();
        }
        check_duration();
    });

    function discountFunction(artistTotalFee) {
        var exempt = $('#exempt-percentage').val();
        var discount = calculateDiscount(artistTotalFee, exempt);
        $('#discount-amount').html(formatAmount(discount));
        $('#discount').val(discount);
        var total = artistTotalFee - parseInt(discount) ;
        $('#grand-total').html(formatAmount(total));
        $('#total').val(total);
    }

    function formatAmount(amount)
    {
        return parseInt(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }

    function calculateDiscount(amount, percentage){
        let discountAmount = 0;
        if(percentage != null && percentage > 0)
        {
            discountAmount = amount * ( parseInt(percentage) /100 );
        }
        return discountAmount;
    }

    var getLangid = $('#getLangid').val();

    function check_permit()
    {
        var eventTotalAmount = $('#event_total_amount').val();

        var artist_fee_total = $('#artist_fee_total').val();

        var total_amt = parseInt(artist_fee_total) + parseInt(eventTotalAmount);

        if($('#isEventPay').prop("checked"))
        {
            $('#artist_pay_table').show();
            $('#total_amt').html(formatAmount(total_amt));
            $('#amount').val(total_amt);
            discountFunction(total_amt);
            if(total_amt == 0){
                $('#pay_next_btn').removeClass('kt-hide');
                $('#submit_btn').addClass('kt-hide');
            }else {
                $('#submit_btn').removeClass('kt-hide');
                $('#pay_next_btn').addClass('kt-hide');
            }
        }else {
            $('#artist_pay_table').hide();
            $('#total_amt').html(formatAmount(eventTotalAmount));
            $('#amount').val(eventTotalAmount);
            discountFunction(eventTotalAmount);
            if(eventTotalAmount == 0){
                $('#pay_next_btn').removeClass('kt-hide');
                $('#submit_btn').addClass('kt-hide');
            }else {
                $('#submit_btn').removeClass('kt-hide');
                $('#pay_next_btn').addClass('kt-hide');
            }
        }
    }

    const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            for(var i = 1; i <= parseInt(per_truck_doc);i++){
                var requiId = $('#truck_req_id_'+i).val();
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: ``,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    showDownload: true,
                    formData: {
                        id: i ,
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    onSuccess: function (files, response, xhr, pd) {
                            //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let truck_id = $('#this_event_truck_id').val() ;
                        let this_url = user_id + '/event/' + eventId +'/truck/'+truck_id+ '/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
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
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
                $("#truck-upload_" + i).css('pointer-events', 'none');
            }
        };


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
                           $('#food_truck_list').append('<tr><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td class="text-right">'+ result[s].company_name_ar+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"> <button class="btn btn-secondary" onclick="viewThisTruck('+result[s].event_truck_id+', '+k+')">view</button></td></tr>');

                        }
                    }
                }
            });
        }

        function viewThisTruck(id, num)
        {
            var url = "{{route('event.fetch_this_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result)
                    {
                        $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
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
                        truckDocUpload();
                    }
                }
            });
        }



    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            let totalLength = parseInt($('#requirements_count').val())  + parseInt($('#addi_requirements_count').val());
            for (var i = 1; i <= totalLength; i++) {
                let requiId = $('#req_id_' + i).val() ;
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('event.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "doc_file_" + i,
                    showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    showDelete: false,
                    returnType: "json",
                    showFileCounter: false,
                    abortStr: '',
                    multiple: false,
                    maxFileCount: 5,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
                    onSuccess: function (files, response, xhr, pd) {
                            //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    onLoad: function (obj) {
                        $.ajax({
                            cache: false,
                            url: "{{route('company.event.get_uploaded_docs')}}",
                            type: 'POST',
                            data: {eventId: $('#event_id').val() ,reqId: $('#req_id_' + i).val()},
                            dataType: "json",
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    for(data of data) {
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let issue_datetime = new Date(data['issued_date']);
                                        let exp_datetime = new Date(data['expired_date']);
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        // const d = data["path"].split("/");
                                        // let docName = d[d.length - 1];
                                        const d = data["path"].split("/");
                                        var cc = d.splice(4,5);
                                        let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        obj.createProgress(docName, "{{asset('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }

                                        j++;
                                    }

                                }
                            }
                        });


                    },
                    onError: function (files, status, errMsg, pd) {
                        showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                        pd.statusbar.hide();
                    },
                    downloadCallback: function (files, pd) {
                        if(files[0]) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let this_url = user_id + '/event/' + eventId +'/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        ); }
                    }
                });
                $('#fileuploader_' + i ).closest('div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
                $("#ajax-upload_" + i).css('pointer-events', 'none');
            }
        };

        const picUploadFunction = () => {
            var picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('event.uploadLogo')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                deleteStr: `<i class="la la-trash"></i>`,
                showDownload: true,
                downloadStr:  `<i class="la la-download"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileCounter: false,
                abortStr: '',
                // previewHeight: '100px',
                // previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                // showPreview: true,
                showDelete: false,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                onLoad: function (obj) {
                    var url = "{{route('event.get_uploaded_logo',':id')}}" ;
                    url = url.replace(':id', $('#event_id').val() );
                    $.ajax({
                        url: url,
                        success: function (data) {
                            // console.log(data);
                            if (data.trim() != '') {
                                let ex = data.split('/').pop();
                               obj.createProgress(ex, "{{url('storage')}}"+'/'+ data, '');
                            }
                        }
                    });
                },
                downloadCallback: function(files, pd) {
                    if(files.filepath){
                        let file_path = files.filepath;
                        let path = file_path.replace('public/','');
                        window.open(
                    "{{url('storage')}}"+'/' + path,
                    '_blank'
                    );
                    }else {
                        let event_id = $('#event_id').val();
                        let user_id = $('#user_id').val();
                        let path = user_id+'/event/'+event_id+'/photos/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    }
                }
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
            $("#pic-upload").css('pointer-events', 'none');
        };


        var eventValidator = $('#eventdetails').validate({

        });


        $("#check_inst").on("click", function () {
            setThis('none', 'block', 'block', 'none');
        });

        $("#event_det").on("click", function () {

            setThis('block', 'block', 'none', 'none');
        });

        $("#upload_doc").on("click", function () {

            setThis('block', 'block', 'none', 'none');
        });

        $('#mk_payment').on('click', function(){

            setThis('block', 'none', 'none', 'block');
        })

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
            // $('#submit_next_btn').css('display', submit);
        };

        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result;

            if ($('#agree').not(':checked')) {
                wizard.stop();
                $('#agree_cb > span').addClass('compulsory');
                result = false;
            }
            if ($('#agree').is(':checked')) {
                $('#back_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                wizard.goNext();
                result = true;
            }
            return result;
        };


        $('#next_btn').click(function () {

        wizard = new KTWizard("kt_wizard_v3");

        checkForTick();
        // checking the next page is artist details
        if (wizard.currentStep == 2) {
            stopNext(eventValidator);
            KTUtil.scrollTop();// validating the artist details page
            if (eventValidator.form()) {
                //$('#next_btn').css('display', 'block'); // hide the next button
                eventdetails = {
                };

                localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }

            if (wizard.currentStep == 3) {
                $('#submit_btn').css('display', 'block');
                // $('#submit_next_btn').css('display', 'block');
                $('#pay_next_btn').css('display', 'block');
                $('#next_btn').css('display', 'none');
            }
        });


        const docValidation = () => {
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#requirements_count').val();
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) {
                if ($('#ajax-file-upload_' + i).length) {
                    if ($('#ajax-file-upload_' + i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_" + i).css('border', '2px dotted red');
                    } else {
                        hasFileArray[i] = true;
                        $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                    }
                    documentDetails[i] = {
                        issue_date: $('#doc_issue_date_' + i).val(),
                        exp_date: $('#doc_exp_date_' + i).val()
                    }
                }
            }
            }


            if (hasFileArray.includes(false) ) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
                return hasFile;
            };

            const stopNext = (validator_name) => {
                wizard.on("beforeNext", function (wizardObj) {
                    if (validator_name.form() !== true) {
                        wizardObj.stop(); // don't go to the next step
                    }
                });
            };

        $('#prev_btn').click(function () {
            wizard = new KTWizard("kt_wizard_v3");
            if (wizard.currentStep == 2) {
                $('#prev_btn').css('display', 'none');
                $('#back_btn').css('display', 'block');
            } else {
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            }
            $('#submit_btn').css('display', 'none');
            $('#pay_next_btn').css('display', 'none');
            // $('#submit_next_btn').css('display', 'none');
        });


        $('#issued_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });
        $('#expired_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });

        // $('#time_start').timepicker();
        // $('#time_end').timepicker();

        $('#issued_date').on('changeDate', function (selected) {
            $('#issued_date').valid() || $('#issued_date').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            var expDate = moment(minDate, 'DD-MM-YYYY').add('month', 1);
            $('#expired_date').datepicker('setStartDate', minDate);
            $('#expired_date').val(expDate.format("DD-MM-YYYY"));
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });


        const getAreas = (city_id) => {
            $.ajax({
                url: "{{url('company/fetch_areas')}}" + '/' + city_id,
                success: function (result) {
                    // console.log(result)
                    $('#area_id').empty();
                    $('#area_id').append('<option value="">Select</option>');
                    for (let i = 0; i < result.length; i++) {
                        $('#area_id').append('<option value="' + result[i].id + '">' + result[i].area_en + '</option>');

                    }

                }
            });

        };


        function getRequirementsList()
        {
            var id = $('#event_type_id').val();
            var firm = $('#firm_type').val();
            $.ajax({
                url: "{{route('company.event.get_requirements')}}",
                type: 'POST',
                data: {id: id, firm: firm},
                success: function (result) {
                    $('#documents_required').empty();
                    var res = result;
                     $('#requirements_count').val(res.length);
                    $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Event Permit Required documents</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">{{__('Event Logo')}}</label><p class="reqName">{{__('An image of the Event Logo / Banner')}}</p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">Upload</div></div></div>');
                 if(result){
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+(getLangid == 1 ? capitalizeFirst(res[i].requirement_name) : res[i].requirement_name_ar )+' <span id="cnd_'+j+'"></span></label><p for="" class="reqName">'+( getLangid == 1 ? (res[i].requirement_description ? capitalizeFirst(res[i].requirement_description) : '') : (res[i].requirement_description_ar ? res[i].requirement_description_ar : '') ) +'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');
                         if(res[i].event_type_requirements[0].is_mandatory == 1)
                         {
                            $('#cnd_'+j).html(' * ');
                            $('#cnd_'+j).removeClass('text-muted').addClass('text-danger');
                         }else {
                            $('#cnd_'+j).html('');
                            $('#cnd_'+j).removeClass('text-danger').addClass('text-muted');
                         }

                         if(res[i].dates_required)
                         {
                            $('#issue_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker mk-disabled" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY" readonly />');
                            $('#exp_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker mk-disabled" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" readonly/>')
                         }


                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     uploadFunction();
                     picUploadFunction();
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });

        }

        function getAddtionalRequirementsList(id)
        {
            var url = "{{route('company.event.get_additional_requirements', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (result) {
                 if(result){
                    $('#addi_documents_required').empty();
                     var res = result.additional_requirements;
                     $('#addi_requirements_count').val(res.length);
                     var j =  parseInt($('#requirements_count').val()) + 1 ;
                     if(j != NaN){
                     for(var i = 0; i < res.length; i++){
                         $('#addi_documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+(getLangid == 1 ? capitalizeFirst(res[i].requirement_name) : res[i].requirement_name_ar )+'<span class="text-danger"> * </span></label><p for="" class="reqName">'+(res[i].requirement_description != null ? getLangid == 1 ? capitalizeFirst(res[i].requirement_description) : res[i].requirement_description_ar : '')+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                        }
                        j++;
                        $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     }
                     uploadFunction();
                 }
                }
            });

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
                    deleteStr: ``,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showDelete: true,
                    showPreview: false,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    showDownload: true,
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let liquor_id = $('#event_liquor_id').val();
                        let this_url = user_id + '/event/' + eventId +'/liquor/'+liquor_id+'/'+reqID+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
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
                    }

                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
                $("#liquor-upload_" + i).css('pointer-events', 'none');
            }
        };

        function go_back_truck_list()
        {
            $('#edit_food_truck').modal('show');
            $('#edit_one_food_truck').modal('hide');
        }


        function editLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url:  url,
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


        const imageUploadFunction = () => {
            var ImageUploader = $('#image_uploader').uploadFile({
                url: "{{route('event.uploadEventPics')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "image_file",
                multiple: true,
                deleteStr: `<i class="la la-trash"></i>`,
                downloadStr: `<i class="la la-download"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileCounter: false,
                abortStr: '',
                showProgress: false,
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                // showPreview: true,
                showDelete: false,
                showDownload: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
                },
                onLoad: function(obj) {
                    var url = "{{route('event.get_uploaded_eventImages', ':id')}}";
                    url = url.replace(':id', $('#event_id').val());
                    $.ajax({
                            // cache: false,
                            url: url,
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    if(data[0]) {
                                        $('#description').val(data[0].description);
                                    }
                                    for(data of data) {
                                        const d = data["path"].split("/");
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{asset('storage')}}"+'/' + data["path"], '');
                                    }
                                }
                            }
                        });
                },
                downloadCallback: function (files, pd) {
                    let user_id = $('#user_id').val();
                    let eventId = $('#event_id').val();
                    let this_url = user_id + '/event/' + eventId +'/pictures/'+files;
                    window.open(
                    "{{url('storage')}}"+'/' + this_url,
                    '_blank'
                    );
                },
            });
            $('#image_uploader div').attr('id', 'image-upload');
            $('#image_uploader + div').attr('id', 'image-file-upload');
            $("#image-upload").css('pointer-events', 'none');
        };

        $('.subtype_table').DataTable({
            ordering: false,
            dom:"<'row d-none'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'><'col-sm-12 col-md-7'p>>",
            language: {
                @if(Auth::check() && Auth::user()->LanguageId != 1)
                info: 'رض _START_ إلى _END_ للـــ _TOTAL_',
                @endif
                paginate: {
                    previous: '<',
                    next:     '>'
                },
                aria: {
                    paginate: {
                        previous: 'Previous',
                        next:     'Next'
                    }
                }
            },
        });



</script>

@endsection
