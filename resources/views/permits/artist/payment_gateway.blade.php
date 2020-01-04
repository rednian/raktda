@extends('layouts.app')


@section('content')

<!-- begin:: Content -->

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title"> {{__('Payment Gateway')}}</h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right">
                        <a href="{{URL::signedRoute('company.make_payment', [ 'id' => $permit_details->permit_id ])}}"
                            class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u
                            ">
                            <i class="la la-arrow-left"></i>
                            {{__('Back')}}
                        </a>
                    </div>
                    <div class="my-auto float-right permit--action-bar--mobile">
                        <a href="{{URL::signedRoute('company.make_payment', [ 'id' => $permit_details->permit_id ])}}"
                            class="btn btn--maroon btn-elevate btn-sm">
                            <i class="la la-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-widget kt-widget--project-1">
                    <div class="kt-widget__body">
                        <div class="kt-widget__stats d-">
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('From Date')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-success btn-sm btn-bold btn-upper">
                                        {{date('d M, y',strtotime($permit_details->issued_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('To Date')}}</span>
                                <div class="kt-widget__label">
                                    <span class="btn btn-label-danger btn-sm btn-bold btn-upper">
                                        {{date('d M, y',strtotime($permit_details->expired_date))}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('Permit Term')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{$permit_details->term}}
                                    </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('Reference Number')}}</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{$permit_details->reference_number}}
                                    </span>
                                </div>
                            </div>
                            @if($permit_details->event)
                            <div class="kt-widget__item">
                                <span class="kt-widget__date">{{__('Connected Event ?')}} :</span>
                                <div class="kt-widget__label">
                                    <span
                                        class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                        {{getLangId() == 1 ? ucwords($permit_details->event->name_en) : $permit_details->event->name_ar}}
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="kt-widget__text kt-margin-t-10">
                            <strong>{{__('Work Location')}} :</strong>
                            {{getLangId() == 1 ? ucwords($permit_details->work_location) : $permit_details->work_location_ar}}
                        </div>
                    </div>


                    <input type="hidden" id="permit_id" value="{{$permit_details->permit_id}}">

                    @php
                    $artist_total_fee = 0;
                    $artist_vat_total = 0;
                    $artist_g_total = 0;
                    $issued_date = strtotime($permit_details->issued_date);
                    $expired_date = strtotime($permit_details->expired_date);
                    $noofdays = abs($expired_date - $issued_date) / 60 / 60 / 24;
                    @endphp

                    <input type="hidden" id="noofdays" value="{{$noofdays}}">
                    <div class="table-responsive">
                        <table class="table table-borderless border table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('Artist Name')}}</th>
                                    <th>{{__('Type')}}</th>
                                    <th class="text-right">{{__('Fee')}} (AED)</th>
                                    <th class="text-right">{{__('Vat')}}(5%)</th>
                                    <th class="text-right">{{__('Total')}} (AED) </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($permit_details->artistPermit as $ap)
                                @if($ap->artist_permit_status == 'approved' && $ap->is_paid == 0)
                                <tr>
                                    <td>{{getLangId() == 1 ? $ap['firstname_en'] .' '.$ap['lastname_en'] : $ap['lastname_ar'] .' '. $ap['firstname_ar']}}
                                    </td>
                                    <td>
                                        {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                    </td>
                                    @php
                                    $noofmonths = ceil($noofdays ? $noofdays : 1 / 30) ;
                                    $artist_fee = $ap->profession['amount'] * $noofmonths;
                                    $artist_vat = $artist_fee * 0.05;
                                    $artist_total = $artist_fee + $artist_vat;
                                    $artist_total_fee += $artist_fee;
                                    $artist_vat_total += $artist_vat;
                                    $artist_g_total += $artist_total;
                                    @endphp
                                    <td class="text-right">
                                        {{number_format($artist_fee,2)}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($artist_vat,2)}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($artist_total, 2)}}
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                                {{-- @if($permit_details->request_type == 'amend')
                            <tr>
                                <td colspan="2">{{__('Amendment Fee')}}
                                </td>
                                @php
                                $amend_fee = getSettings()->artist_amendment_fee ;
                                $artist_total += $amend_fee;
                                $artist_amend_vat = $amend_fee * 0.05;
                                $artist_vat_total += $artist_vat;
                                $artist_amend_total += $amend_fee + $artist_vat_total;
                                $artist_g_total += $artist_amend_total;
                                @endphp
                                <td class="text-right">
                                    {{number_format($amend_fee,2)}}
                                </td>
                                <td class="text-right">
                                    {{number_format($artist_amend_vat,2)}}
                                </td>
                                <td class="text-right">
                                    {{number_format($artist_amend_total, 2)}}
                                </td>
                                </tr>
                                @endif --}}
                            </tbody>


                            <tfoot>
                                <tr>
                                    <td colspan="2" class="kt-font-bold">
                                        {{__('Total')}}
                                    </td>
                                    <td class="kt-font-bold text-right">
                                        {{number_format($artist_total_fee,2)}}
                                    </td>

                                    <td class="kt-font-bold text-right">
                                        {{number_format($artist_vat_total,2)}}
                                    </td>
                                    <td class="kt-font-bold text-right">
                                        {{number_format($artist_g_total,2)}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <input type="hidden" id="artist_total_fee" value="{{$artist_total_fee}}">
                    <input type="hidden" id="artist_vat_total" value="{{$artist_vat_total}}">
                    <input type="hidden" id="artist_g_total" value="{{$artist_g_total}}">
                    @php
                    $event_fee_total = 0;
                    $event_vat_total = 0;
                    $event_grand_total = 0;
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
                                    <th class="text-right">{{__('Fee')}} (AED)</th>
                                    <th class="text-right">{{__('Vat')}}(5%)</th>
                                    <th class="text-right">{{__('Total')}} (AED) </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        {{getLangId() == 1 ? $event->name_en : $event->name_ar}}
                                    </td>
                                    <td class="text-left">
                                        {{getLangId() == 1 ? $event->type['name_en'] : $event->type['name_ar']}}
                                    </td>
                                    @php
                                    $event_fee = $event->type['amount'] * $noofdays;
                                    $event_vat = $event_fee * 0.05;
                                    $event_total = $event_fee + $event_vat;
                                    $event_fee_total += $event_fee;
                                    $event_vat_total += $event_vat;
                                    $event_grand_total += $event_total;
                                    @endphp
                                    <td class="text-right">
                                        {{number_format($event_fee,2)}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($event_vat, 2)}}
                                    </td>
                                    <td class="text-right">
                                        {{number_format($event_total, 2)}}
                                    </td>
                                </tr>
                                @if($event->is_truck == 1)
                                <tr>
                                    @php
                                    $per_truck_fee = getSettings()->food_truck_fee;
                                    $no_of_trucks = count($event->truck->where('paid', 0));
                                    $truck_fee += $noofdays * $per_truck_fee * $no_of_trucks;
                                    $event_fee_total += $truck_fee;
                                    $event_grand_total += $truck_fee;
                                    @endphp
                                    <td colspan="2">{{__('Truck Fee')}} x <b>{{$no_of_trucks}}</b> </td>
                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                    <td class="text-right">0</td>
                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                </tr>
                                @endif
                                @if($event->is_liquor == 1 && isset($event->liquor) &&
                                $event->liquor->provided == 0)
                                <tr>
                                    <td colspan="2">{{__('Liquor')}} </td>
                                    @php
                                    $per_liquor_fee = getSettings()->liquor_fee;
                                    $liquor_fee += $noofdays * $per_liquor_fee;
                                    $event_fee_total += $liquor_fee;
                                    $event_grand_total += $liquor_fee;
                                    @endphp
                                    <td class="text-right">{{number_format($liquor_fee, 2)}}</td>
                                    <td class="text-right">0</td>
                                    <td class="text-right">{{number_format($liquor_fee, 2)}}</td>
                                </tr>
                                @endif
                            </tbody>


                        </table>
                    </div>
                    <div>
                        <label class="kt-checkbox kt-checkbox--warning ml-2 mt-3">
                            <input type="checkbox" id="isEventPay" name="isEventPay" onchange="check_permit()">
                            {{__('Do you wish to pay Connected Event Permit fee ?')}}
                            <span></span>
                        </label>
                    </div>
                    @endif

                    <input type="hidden" id="event_fee_total" value="{{$event_fee_total}}">
                    <input type="hidden" id="event_vat_total" value="{{$event_vat_total}}">
                    <input type="hidden" id="event_grand_total" value="{{$event_grand_total}}">

                    <div class="table-responsive">
                        <div class="pull-right">
                            <table class=" table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            {{__('Total Amount')}}
                                        </td>
                                        <td id="total_amt" class="pull-right kt-font-bold"></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid black;">
                                        <td>{{__('Total Vat')}}</td>
                                        <td id="total_vat" class="pull-right kt-font-bold"></td>
                                    </tr>
                                    <tr>
                                        <td class="kt-font-transform-u">
                                            {{__('Grand Total')}}
                                        </td>
                                        <td id="grand_total" class="pull-right kt-font-bold"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <input type="hidden" id="amount">
                    <input type="hidden" id="vat">
                    <input type="hidden" id="total">



                    <div class="d-flex justify-content-end">
                        <button onclick="onclick=" Checkout.showLightbox()"
                            class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u"
                            id="pay_btn">{{__('PAY')}}</button>
                        {{-- onclick="Checkout.showPaymentPage()" --}}
                        {{-- <a href="{{route('artist.gateway', ['id' => $permit_details->permit_id ])}}"></a> --}}
                        {{-- <button class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u" id="pay_btn"
                        onclick="Checkout.showLightbox()">{{__('PAY')}}</button> --}}
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
        'id' => '5678'
    ),
    'interaction' => array(
        'operation' => 'VERIFY'
    ),
    'transaction' => array( 
        'source' => 'INTERNET'
    )
);
$username = 'merchant.NRSINFOWAYSL';
$password = 'aabf38b7ab511335ba2fb786206b1dc0';
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
// dd($output);
?>

    @endsection

    @section('script')
    <script src="https://test-rakbankpay.mtf.gateway.mastercard.com/checkout/version/54/checkout.js"
        data-error="errorCallback" data-cancel="cancelCallback" data-complete="completedCallback">
        // data-complete="completedCallback"
    </script>
    <script type="text/javascript">
        function errorCallback(error) {
            console.log(JSON.stringify(error));
        }

        function cancelCallback() {
            console.log('Payment cancelled');
        }

        function completedCallback(x, y) {
            console.log('test')
        }

        Checkout.configure({
            merchant: 'NRSINFOWAYSL',
            order: {
                amount: function() {
                    return  $('#total').val();
                },
                currency: 'AED',
                description: 'Permit payment',
                id: '5678'
            },
            interaction: {
                operation:'AUTHORIZE',
                merchant: {
                    name: 'RAKTDA NRS Infoways'
                },
                displayControl: {
                    billingAddress :'HIDE'
                }
            },
            session: {
                id: "{{$output->session->id}}"
            }
        });

    </script>
    <script>
        $(document).ready(function(){
        $('#event_details_table').hide();
        var artistTotalFee = $('#artist_total_fee').val();
        $('#total_amt').html(parseInt(artistTotalFee).toFixed(2));
        var artistVatTotal = $('#artist_vat_total').val();
        $('#total_vat').html(parseInt(artistVatTotal).toFixed(2));
        var artistGTotal = $('#artist_g_total').val();
        $('#grand_total').html(parseInt(artistGTotal).toFixed(2));
        $('#amount').val(artistTotalFee);
        $('#vat').val(artistVatTotal);
        $('#total').val(artistGTotal);
    });


    function check_permit(){
        var ischecked = $('#isEventPay').prop('checked');
        var artistTotalFee = $('#artist_total_fee').val();
        var artistVatTotal = $('#artist_vat_total').val();
        var artistGTotal = $('#artist_g_total').val();
        var eventFeeTotal = $('#event_fee_total').val();
        var eventVatTotal = $('#event_vat_total').val();
        var eventGrandTotal = $('#event_grand_total').val();
        var totalFee = parseInt(artistTotalFee) + parseInt(eventFeeTotal);
        var totalVat = parseInt(artistVatTotal) + parseInt(eventVatTotal);
        var total = parseInt(artistGTotal) + parseInt(eventGrandTotal);
        if(ischecked)
        {
            $('#event_details_table').show();
            $('#total_amt').html(totalFee.toFixed(2));
            $('#total_vat').html(totalVat.toFixed(2));
            $('#grand_total').html(total.toFixed(2));
            $('#amount').val(totalFee);
            $('#vat').val(totalVat);
            $('#total').val(total);
        }else{
            $('#event_details_table').hide();
            $('#total_amt').html(parseInt(artistTotalFee).toFixed(2));
            $('#total_vat').html(parseInt(artistVatTotal).toFixed(2));
            $('#grand_total').html(parseInt(artistGTotal).toFixed(2));
            $('#amount').val(artistTotalFee);
            $('#vat').val(artistVatTotal);
            $('#total').val(artistGTotal);
        }
    }

$('#pay_btn').click(function(){
    var paidEventFee = 0;
    if($('#isEventPay').prop("checked")){
        paidEventFee = 1;
    }
    KTApp.blockPage({
               overlayColor: '#000000',
               type: 'v2',
               state: 'success',
               message: 'Please wait...'
           });
    $.ajax({
        url: "{{route('company.payment')}}",
        type: "POST",
        data: {
        permit_id:$('#permit_id').val(),
        amount: $('#amount').val(),
        vat: $('#vat').val(),
        total: $('#total').val(),
        noofdays: $('#noofdays').val(),
        paidEventFee: paidEventFee
        },
        success: function (result) {
        var toUrl = "{{URL::signedRoute('company.happiness_center', ':id')}}";
        toUrl = toUrl.replace(':id', $('#permit_id').val());
        if(result.message[0]){
        window.location.replace = toUrl;
        KTApp.unblockPage();
        }
        }
    });
});

function completeCallback(resultIndicator, sessionVersion) {
        var paidEventFee = 0;
        if($('#isEventPay').prop("checked")){
            paidEventFee = 1;
        }
        $.ajax({
            url: "{{route('company.payment')}}",
            type: "POST",
            data: {
                permit_id:$('#permit_id').val(),
                amount: $('#amount').val(),
                vat: $('#vat').val(),
                total: $('#total').val(),
                noofdays: $('#noofdays').val(),
                paidEventFee: paidEventFee
            },
            success: function (result) {
                var toUrl = "{{URL::signedRoute('company.happiness_center', ':id')}}";
                toUrl = toUrl.replace(':id', $('#permit_id').val());
                if(result.message[0]){
                    window.location.href = toUrl;
                }
            }
    });
}


    </script>

    @endsection