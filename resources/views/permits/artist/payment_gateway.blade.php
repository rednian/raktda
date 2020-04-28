@extends('layouts.app')

@section('title', 'Make Payment Artist Permit - Smart Government Rak')

@section('content')

<!-- begin:: Content -->

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title kt-font-transform-u"> {{__('Payment Gateway')}}</h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right">
                        <a href="{{URL::signedRoute('company.make_payment', [ 'id' => $permit_details->permit_id ])}}" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u
                            ">
                            <i class="la la-angle-left"></i>
                            {{__('BACK')}}
                        </a>
                    </div>
                    <div class="my-auto float-right permit--action-bar--mobile">
                        <a href="{{URL::signedRoute('company.make_payment', [ 'id' => $permit_details->permit_id ])}}" class="btn btn--maroon btn-elevate btn-sm">
                            <i class="la la-angle-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body kt-padding-t-0">
                <div class="kt-widget kt-widget--project-1">
                    <div class="kt-widget__body kt-padding-l-0">
                        <div class="kt-widget__stats d-">
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('From Date')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                        {{date('jS F Y',strtotime($permit_details->issued_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('To Date')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold cursor-text">
                                        {{date('jS F Y',strtotime($permit_details->expired_date))}}
                                    </span>
                                </div>
                            </div>
                            @php
                            $artist_total_fee = 0;
                            $noofdays = diffInDays($permit_details->issued_date, $permit_details->expired_date) + 1;
                            @endphp
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('Permit Duration')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold">
                                        {{calculateDateDiff($permit_details->issued_date, $permit_details->expired_date)}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('Reference No')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{$permit_details->reference_number}}
                                    </span>
                                </div>
                            </div>
                            @if($permit_details->event)
                            <div class="kt-widget__item">
                                <span class="kt-widget__date pb-1">{{__('Connected to Event')}} :</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{getLangId() == 1 ? ucfirst($permit_details->event->name_en) : $permit_details->event->name_ar}}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="kt-widget__text kt-margin-t-20">
                           {{__('Work Location')}} :
                            <span  class="kt-widget__label kt-font-bolder">{{getLangId() == 1 ? ucfirst($permit_details->work_location) : $permit_details->work_location_ar}}</span>
                        </div>
                    </div>


                    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">


                    <input type="hidden" id="noofdays" value="{{$noofdays}}">
                    <div class="table-responsive">
                        <table class="table table-borderless border table-hover table-striped">
                            <thead>
                                <tr class="kt-font-transform-u">
                                    <th>{{__('FIRST NAME')}}</th>
                                    <th>{{__('LAST NAME')}}</th>
                                    <th>{{__('PROFESSION')}}</th>
                                    <th class=" text-right">{{__('Profession Fee')}} (AED)</th>
                                     <th class=" text-right">{{__('Amendment Fee')}}</th>
                                    <th class=" text-right">{{__('Total')}} (AED) </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permit_details->artistPermit as $ap)
                                @if($ap->artist_permit_status == 'approved')
                                    @if($ap->is_paid == 0)
                                    <tr>
                                        <td>{{getLangId() == 1 ? $ap['firstname_en'] :  $ap['firstname_ar']}}
                                        </td>
                                        <td>{{getLangId() == 1 ? $ap['lastname_en'] : $ap['lastname_ar'] }}</td>
                                        <td>
                                            {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                        </td>
                                        @php
                                        $noofmonths = ceil($noofdays ? $noofdays/30 : 1 ) ;
                                        $artist_fee = (int) $ap->profession['amount'] * $noofmonths;
                                        $artist_total_fee += $artist_fee;
                                        @endphp

                                        <td class="text-right">
                                            {{number_format((int)$ap->profession['amount'], 2)}}
                                        </td>
                                        <td class="text-right"></td>
                                        <td class="text-right">
                                            {{number_format($artist_fee,2)}}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($ap->is_paid == 2)
                                    <tr>
                                        <td>{{getLangId() == 1 ? $ap['firstname_en'] :  $ap['firstname_ar']}}
                                        </td>
                                        <td>{{getLangId() == 1 ? $ap['lastname_en'] : $ap['lastname_ar'] }}</td>
                                        <td>
                                            {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                        </td>
                                        @php
                                            $amendment_fee = 100;
                                            $artist_total_fee += $amendment_fee;
                                        @endphp

                                        <td class="text-right">
                                        </td>
                                        <td class="text-right">
                                            {{number_format($amendment_fee, 2)}}
                                        </td>
                                        <td class="text-right">
                                            {{number_format($amendment_fee, 2)}}
                                        </td>
                                    </tr>
                                    @endif
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <input type="hidden" id="artist_total_fee" value="{{$artist_total_fee}}">

                    @php
                    $event_fee_total = 0;
                    $liquor_fee = 0 ;
                    $truck_fee = 0;
                    $event = $permit_details->event;
                    @endphp

                    @if($event && $event->paid != 1 && $permit_details->request_type != 'amend')
                    <div class="table-responsive" id="event_details_table" style="display:none;">
                        <table class="table table-borderless table-hover border table-striped">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-left">{{__('Event Name')}}</th>
                                    <th class="text-left">{{__('Event Type')}}</th>
                                    <th class="text-right">{{__('Fee')}}/{{__('Day')}} (AED)</th>
                                    <th class="text-center">{{__('No.of.days')}} </th>
                                    <th class="text-center">{{__('Qty')}} </th>
                                    <th class="text-right">{{__('Total')}} (AED) </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        {{getLangId() == 1 ? ucfirst($event->name_en) : $event->name_ar}}
                                    </td>
                                    <td class="text-left">
                                        {{getLangId() == 1 ? ucfirst($event->type['name_en']) : $event->type['name_ar']}}
                                    </td>
                                    @php
                                    $event_fee = (int)$event->type['amount'] * $noofdays;
                                    $event_fee_total += $event_fee;
                                    @endphp
                                    <td class="text-right">
                                        {{number_format($event->type['amount'] ,2)}}
                                    </td>
                                    <td class="text-center">
                                        {{$noofdays}}
                                    </td>
                                    <td class="text-center"></td>
                                    <td class="text-right">
                                        {{number_format($event_fee, 2)}}
                                    </td>
                                </tr>
                                @if(isset($event->truck) && count($event->truck->where('paid', 0)) > 0)
                                <tr>
                                    @php
                                    $per_truck_fee = getSettings()->food_truck_fee;
                                    $no_of_trucks = count($event->truck->where('paid', 0));
                                    $truck_fee += $noofdays * $per_truck_fee * $no_of_trucks;
                                    $event_fee_total += $truck_fee;
                                    @endphp
                                    <td colspan="2">{{__('Truck Fee')}} x <b>{{$no_of_trucks}}</b> </td>
                                    <td class="text-right">{{number_format($per_truck_fee, 2)}}</td>
                                    <td class="text-center">{{$noofdays}}</td>
                                    <td class="text-center">{{$no_of_trucks}}</td>
                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                </tr>
                                @endif
                                @if($event->liquor->company_name_en !== null &&
                                $event->liquor->provided == 0 && $event->liquor->paid == 0)
                                <tr>
                                    <td colspan="2">{{__('Liquor')}} </td>
                                    @php
                                    $per_liquor_fee = getSettings()->liquor_fee;
                                    $liquor_fee += $noofdays * $per_liquor_fee;
                                    $event_fee_total += $liquor_fee;
                                    @endphp
                                    <td class="text-right">{{number_format($per_liquor_fee, 2)}}</td>
                                    <td class="text-center">{{$noofdays}}</td>
                                    <td class="text-center"></td>
                                    <td class="text-right">{{number_format($liquor_fee, 2)}}</td>
                                </tr>
                                @endif
                            </tbody>


                        </table>
                    </div>
                    <div>
                        <label class="kt-checkbox kt-checkbox--warning ml-2 mt-3">
                            <input type="checkbox" id="isEventPay" name="isEventPay" onchange="check_permit()">
                            {{__('Do you want to pay the connected Event Permit?')}}
                            <span></span>
                        </label>
                    </div>
                    @endif


                    <input type="hidden" id="exempt-percentage" value="{{$exempt}}">

                    <input type="hidden" id="event_fee_total" value="{{$event_fee_total}}">
                    <input type="hidden" id="event-liquor-fee" value="{{$liquor_fee}}">
                    <input type="hidden" id="event-truck-fee" value="{{$truck_fee}}">

                    <div class="table-responsive">
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


                    <div class="d-flex justify-content-end">

                        <button class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u" id="pay_btn" onclick="Checkout.showLightbox()">{{__('PAY')}}</button>

{{--                         <button onClick="paymentDoneUpdation('D', 'yes')">Pay</button>--}}

                        <a href="{{URL::signedRoute('company.happiness_center', [ 'id' => $permit_details->permit_id])}}"><button class="btn btn-sm btn-wide btn--maroon kt-font-bold kt-font-transform-u kt-hide" id="next_btn">{{__('NEXT')}}</button></a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <?php
    $url = 'https://test-rakbankpay.mtf.gateway.mastercard.com/api/rest/version/54/merchant/NRSINFOWAYSL/session';
    $postFields = array(
        'apiOperation' => 'CREATE_CHECKOUT_SESSION',
        'order' => array(
            'currency' => 'AED',
            'id' => getPaymentOrderId('artist', $permit_details->permit_id)
        ),
        'interaction' => array(
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

    @endsection


    @section('script')


    <script src="https://test-rakbankpay.mtf.gateway.mastercard.com/checkout/version/54/checkout.js" data-error="errorCallback" data-cancel="cancelCallback" data-complete="completedCallback">
    </script>
    <script>
        function errorCallback(error) {
            console.log(JSON.stringify(error));
            $.notify({
                title: 'Error'
                , message: "{{__('Payment Error ! Please Try Again')}}"
            , }, {
                type: 'danger'
                , animate: {
                    enter: 'animated zoomIn'
                    , exit: 'animated zoomOut'
                }
            , });
        }

        function cancelCallback() {
            $.notify({
                title: 'Error'
                , message: "{{__('Payment cancelled ! Please Try Again')}}"
            , }, {
                type: 'danger'
                , animate: {
                    enter: 'animated zoomIn'
                    , exit: 'animated zoomOut'
                }
            , });
        }


        var sessionId = "{{$output->session->id}}";

        var successIndicator = "{{$output->successIndicator}}";

        // console.log(sessionId);

        Checkout.configure({
            merchant: 'NRSINFOWAYSL'
            , order: {
                amount: function() {
                    var discount = $('#discount').val();
                    var amount = discount > 0 ? $('#total').val() : $('#amount').val();
                    return amount;
                }
                , currency: 'AED'
                , description: 'Artist Permit Payment'
            }
            , session: {
                id: sessionId
            }
            , interaction: {
                merchant: {
                    name: "{{__('Ras Al Khaimah TDA')}}"
                , }
                , @if(getLangId() == 2)
                locale: 'ar-AE'
                , @endif
                displayControl: {
                    billingAddress: 'HIDE'
                , }
            }
        });

        function completedCallback(resultIndicator, sessionVersion) {
            var transactionID, receipt;
            if (successIndicator == resultIndicator) {
                var orderId = '{{getPaymentOrderId("artist", $permit_details->permit_id)}}';
                var url = "{{route('company.getpaymentdetails', ['orderid' => ':orderId'])}}";
                url = url.replace(':orderId', orderId);
                $.ajax({
                    url: url
                    , type: 'GET'
                    , success: function(res) {
                        // console.log(res);
                        var res = JSON.parse(res);
                        var transactionId = res.transaction[0].transaction.acquirer.transactionId;
                        var receipt = res.transaction[0].transaction.receipt;
                        paymentDoneUpdation(transactionId, receipt);
                    }
                });
            }
        }


        function paymentDoneUpdation(transactionID, receipt) {

            var paidEventFee = 0,
                liquorFee = 0,
                truckFee = 0, eventFee = 0;

            if ($('#isEventPay').prop("checked")) {
                paidEventFee = 1;
                liquorFee = $('#event-liquor-fee').val();
                truckFee = $('#event-truck-fee').val();
                eventFee = $('#event_fee_total').val();
            }

            $.ajax({
                url: "{{route('company.payment')}}"
                , type: "POST"
                , beforeSend: function() {
                    KTApp.blockPage({
                        overlayColor: '#000000'
                        , type: 'v2'
                        , state: 'success'
                        , message: '{{__("Please wait...")}}'
                    });
                }
                , data: {
                    permit_id: $('#permit_id').val()
                    , amount: $('#amount').val(),
                    exempt: $('#exempt-percentage').val(),
                     liquorFee: liquorFee,
                     truckFee: truckFee,
                     eventFee: eventFee
                    , noofdays: $('#noofdays').val()
                    , paidEventFee: paidEventFee
                    , transactionId: transactionID
                    , receipt: receipt
                    , orderId: '{{getPaymentOrderId("artist", $permit_details->permit_id)}}'
                }
                , success: function(result) {
                    if (result.message[0]) {
                        window.location.href = result.toURL;
                        KTApp.unblockPage();
                    }
                }
            });
        }

    </script>
    <script>
        $(document).ready(function() {
            $('#event_details_table').hide();

            var artistTotalFee = $('#artist_total_fee').val();
            $('#total_amt').html(formatAmount(artistTotalFee));
            discountFunction(artistTotalFee);
            $('#amount').val(artistTotalFee);

            if (artistTotalFee == 0) {
                $('#next_btn').removeClass('kt-hide');
                $('#pay_btn').addClass('kt-hide');
            }

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

        function formatAmount(amount){
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

        function check_permit() {
            var ischecked = $('#isEventPay').prop('checked');
            // console.log(ischecked);
            var artistTotalFee = $('#artist_total_fee').val();
            var eventFeeTotal = $('#event_fee_total').val();
            var totalFee = parseInt(artistTotalFee) + parseInt(eventFeeTotal);

            if (ischecked) {
                $('#event_details_table').show();
                $('#total_amt').html(formatAmount(totalFee));
                $('#amount').val(totalFee);
                discountFunction(totalFee);
                if (totalFee == 0) {
                    $('#next_btn').removeClass('kt-hide');
                    $('#pay_btn').addClass('kt-hide');
                } else {
                    $('#pay_btn').removeClass('kt-hide');
                    $('#next_btn').addClass('kt-hide');
                }
            } else {
                $('#event_details_table').hide();

                $('#total_amt').html(formatAmount(artistTotalFee));
                discountFunction(artistTotalFee);
                $('#amount').val(artistTotalFee);

                if (artistTotalFee == 0) {
                    $('#next_btn').removeClass('kt-hide');
                    $('#pay_btn').addClass('kt-hide');
                } else {
                    $('#pay_btn').removeClass('kt-hide');
                    $('#next_btn').addClass('kt-hide');
                }
            }
        }

    </script>

    @endsection
