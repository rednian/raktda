@extends('layouts.app')


@section('content')

<!-- begin:: Content -->

<div class="row">
    <div class="col-lg-12">

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title"> Payment Gateway</h3>
                </div>

                <div class="kt-portlet__head-toolbar">
                    <div class="my-auto float-right">
                        <a href="{{url('company/artist/make_payment').'/'.$permit_details->permit_id}}" class="btn btn--maroon btn-sm kt-font-bold kt-font-transform-u
                            ">
                            <i class="la la-arrow-left"></i>
                            Back
                        </a>
                    </div>
                    <div class="my-auto float-right permit--action-bar--mobile">
                        <a href="{{url('company/artist/make_payment').'/'.$permit_details->permit_id}}"
                            class="btn btn--maroon btn-elevate btn-sm">
                            <i class="la la-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-widget5__info py-2">
                    <div>
                        <span class="kt-font-dark">{{__('From Date')}}:</span>&emsp;
                        <span
                            class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->issued_date))}}</span>&emsp;&emsp;
                        <span class="kt-font-dark">{{__('To Date')}}:</span>&emsp;
                        <span
                            class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->expired_date))}}</span>&emsp;&emsp;
                        <span class="kt-font-dark">{{__('Location')}}:</span>&emsp;
                        <span class="kt-font-info">{{$permit_details->work_location}}</span>&emsp;&emsp;
                        <span class="kt-font-dark">{{__('Ref No.')}}:</span>&emsp;
                        <span class="kt-font-info">{{$permit_details->reference_number}}</span>&emsp;&emsp;
                        @if($permit_details->event)
                        <span>Connected to Event :</span>&emsp;
                        <span
                            class="kt-font-info">{{getLangId() == 1 ? $permit_details->event->name_en : $permit_details->event->name_ar}}</span>&emsp;&emsp;
                        @endif
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
                            @if($ap->artist_permit_status == 'approved')
                            <tr>
                                <td>{{getLangId() == 1 ? $ap['firstname_en'] .' '.$ap['lastname_en'] : $ap['lastname_ar'] .' '. $ap['firstname_ar']}}
                                </td>
                                <td>
                                    {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                </td>
                                @php
                                $artist_fee = $ap->profession['amount'] * $noofdays;
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
                $event = $permit_details->event;
                @endphp

                @if($event && $event->paid != 1)
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
                                <td colspan="2">{{__('Truck Fee')}} x <b>{{count($event->truck)}}</b> </td>
                                @php
                                $per_truck_fee = getSettings()->food_truck_fee;
                                $no_of_trucks = count($event->truck);
                                $truck_fee = $noofdays * $per_truck_fee * $no_of_trucks;
                                $event_fee_total += $truck_fee;
                                $event_grand_total += $truck_fee;
                                @endphp
                                <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                <td class="text-right">0</td>
                                <td class="text-right">{{number_format($truck_fee, 2)}}</td>
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
                    <button class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u"
                        id="pay_btn">{{__('PAY')}}</button>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection

@section('script')
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

    $('#pay_btn').click((e) => {
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
                        var toUrl = "{{route('company.happiness_center', ':id')}}";
                        toUrl = toUrl.replace(':id', $('#permit_id').val());
                        if(result.message[0]){
                            window.location.href = toUrl;
                        }
                    }
                });
                

        });

</script>
@endsection