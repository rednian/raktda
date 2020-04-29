<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$transaction->transaction_id}}</title>
    <style>
        * {
            box-sizing: border-box;
            overflow: hidden;
        }

        .logo--header,
        .logo--logo-header {
            width: 100%;
            position: absolute;
        }

        .logo--header tr th:nth-child(1),
        .logo--logo-header tr td:nth-child(1) {
            text-align: left;
            padding-left: 5px;
        }

        .logo--header tr th:nth-child(2),
        .logo--logo-header tr td:nth-child(2) {
            text-align: right;
        }


        #tda_logo {
            height: 80px;
            margin-right: 25px;
        }

        #govt_logo {
            height: 40px;
            margin-left: 25px;
        }

        #heading {
            width: 100%;
            margin-top: 60px;
            margin-bottom: 20px;
            padding: 5px 0;
        }

        #heading div {
            width: 100%;
            text-align: center;
            font-weight: 700;
        }



        td {
            text-align: center;
        }


        .text-center {
            text-align: center;
        }

        footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
        }

        #main-div {
            width: 100%;
        }

        #main-div .row {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .row p {
            padding: 0;
            margin: 0;
        }

        .row label {
            font-weight: bold;
            margin-right: 10px;

        }

        table.table:not(#total_div) {
            width: 100%;
            /* border: 1px solid #000; */
            border-collapse: collapse;
            margin-top: 20px;
        }

        #total_div {
            float: right;
            margin-top: 10px;
        }

        table#total_div tbody tr td:nth-child(1) {
            font-weight: bold;
            text-align: left;
        }

        table#total_div tbody tr td:nth-child(2) {
            text-align: right;
        }

        #date_data {
            border-collapse: collapse;
        }

        .full-width {
            width: 100%;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
        }

        .print--footer {
            padding: 15px 0 0;
            width: 100%;
            margin:0px;
            border-width:0px;
            font-size: 10px;
        }

        .discount-tr {
            border-bottom: 1px solid #000 !important;
        }



    </style>
</head>

<body id="data">
    <header>
        <table class="logo--logo-header">
            <tr>
                <td><img id="govt_logo" alt="Logo" src="{{ asset('/img/print_govt_logo.png') }}" /></td>
                <td><img id="tda_logo" alt="Logo" src="{{ asset('/img/print_tda_logo.png') }}" /></td>
            </tr>
        </table>
        <div id="heading">
            <div>
                <b>{{__('Payment Voucher')}}</b>
            </div>
        </div>
    </header>

    <div class="kt-portlet__body kt-padding-t-0" id="main-div">
        <table class="full-width col-md-12">
            <tr>
                <td class="text-left" style="width:25%;">
                    <b>{{__('Transaction No.')}}</b>
                </td>
                <td class="text-left" style="width:25%;">
                    {{$transaction->reference_number}}
                </td>
                <td></td>
                <td class="text-left" style="width:25%;">
                    <b> {{__('Transaction Date')}}</b>
                </td>
                <td class="text-right" style="width:25%;">
                    {{date('jS F Y', strtotime($transaction->transaction_date))}}
                </td>
            </tr>
        </table>
        <table class="full-width">
            <tr>
                <td class="text-left" style="width:25%;">
                    <b> {{__('Transaction ID')}}</b>
                </td>
                <td class="text-left" style="width:25%;">
                    {{$transaction->payment_transaction_id}}
                </td>
                <td></td>
                <td class="text-left" style="width:25%;">
                    <b>{{__('Receipt No')}}</b>
                </td>
                <td class="text-right" style="width:25%;">
                    {{$transaction->payment_receipt_no}}
                </td>
            </tr>
        </table>
        @php
            $noofdays = 1;
            if($transaction->eventTransaction()->exists())
            {
                $from_d = $transaction->eventTransaction[0]->event['issued_date'];
                $to_d = $transaction->eventTransaction[0]->event['expired_date'];
                $from_date = strtotime($from_d);
                $to_date = strtotime($to_d);
                $noofdays = (abs($from_date - $to_date) / 60 / 60 / 24) + 1;
            }
            else if($transaction->artistPermitTransaction()->exists()) {
                $from_d = $transaction->artistPermitTransaction[0]->permit['issued_date'];
                $to_d = $transaction->artistPermitTransaction[0]->permit['expired_date'];
                $from_date = strtotime($from_d);
                $to_date = strtotime($to_d);
                $noofdays = (abs($from_date - $to_date) / 60 / 60 / 24) + 1;
            }
        @endphp
        <table class="full-width">
            <tr>
                <td class="text-left" style="width:25%;">
                    <b> {{__('No of Days')}}</b>
                </td>
                <td class="text-left" style="width:25%;">
                    {{$noofdays}} {{$noofdays > 1 ? __('days') : __('day') }}
                </td>
                <td></td>
                <td class="text-left" style="width:25%;">
                </td>
                <td class="text-right" style="width:25%;">
                </td>
            </tr>
        </table>



        <div class="col-md-12" style="margin-top: 10px;">
            <table class="table full-width table-hover table-borderless border table-striped" border="1">
                <thead>
                    <tr class="kt-font-transform-u">
                        <th>{{__('Type')}}</th>
                        <th>{{__('Detail')}}</th>
                        <th class="text-center">{{__('Quantity')}} </th>
                        <th class="text-right">{{__('Profession Fee')}} (AED)</th>
                        <th class="text-right">{{__('Total')}} (AED)</th>
                    </tr>
                </thead>
                <tbody>
                @php  $feetotal = 0; @endphp
                @if($transaction->artistPermitTransaction()->exists())
                    @foreach($artistPermit->values()->toArray() as $index => $at)
                        @php
                            $artistCount =  collect($at)->count();
                           $at = array_dot($at[0]);
                        @endphp
                        @if($at['artist_permit.artist_permit_status'] == 'approved' && $at['artist_permit.is_paid'] == 1)
                            <tr>
                                <td>
                                    {{__('Artist')}}
                                </td>
                                @php
                                    $professionId = $at['artist_permit.profession_id'];
                                    $getProfession = getProfession($professionId);
                                    $feetotal += $at['amount'];
                                @endphp
                                <td>
                                    {{getLangId() == 1 ? $getProfession['name_en'] : $getProfession['name_ar']}}
                                </td>
                                <td class="text-center">
                                    {{$artistCount}}
                                </td>
                                <td  class="text-right">
                                    {{(int)$getProfession['amount'] *  $artistCount}}
                                </td>
                                <td class="text-right">
                                    {{number_format($at['amount'],2)}}
                                </td>

                            </tr>
                        @endif
                    @endforeach
                @endif
                @if($transaction->eventTransaction()->exists())

                    @foreach($transaction->eventTransaction as $et)

                        @if($et->type == 'event')
                            <tr>
                                <td>{{__('Event')}}</td>
                                <td>{{getLangId() == 1 ? ucfirst($et->event->name_en).'( '.ucfirst($et->event->type->name_en) .' )' : $et->event->name_ar. '( '.$et->event->type->name_en.' )'}}
                                </td>
                                <td class="text-center">1</td>
                                <td class="text-right">{{number_format($et->event->type->amount,2)}}</td>
                                @php
                                    $feetotal += $et->amount;
                                @endphp
                                <td class="text-right">{{number_format($et->amount,2)}}</td>

                            </tr>
                        @elseif($et->type == 'truck')
                            <tr>
                                <td colspan="2">{{__('Food Truck')}}</td>
                                @php
                                    $truck_count = $et->total_trucks;
                                    $per_truck_fee = !is_null($truck_count) ?  $et->amount / ( $truck_count * $noofdays ) : 1 ;
                                @endphp
                                <td class="text-center">{{$truck_count}}</td>
                                <td class="text-right">{{number_format($per_truck_fee,2)}} / truck</td>
                                @php
                                    $feetotal += $et->amount;
                                @endphp
                                <td class="text-right">{{number_format($et->amount,2)}}</td>
                            </tr>

                        @elseif($et->type == 'liquor')
                            <tr>
                                <td colspan="2">{{__('Liqour ')}}</td>
                                @php
                                    $per_liquor_fee = $et->amount / $noofdays ;
                                @endphp
                                <td class="text-center">1</td>
                                <td class="text-right">{{number_format($per_liquor_fee,2)}}</td>
                                @php
                                    $feetotal += $et->amount;
                                @endphp
                                <td class="text-right">{{number_format($et->amount,2)}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>


        <input type="hidden" value="{{$exempt}}" id="exempt-percentage">
        <input type="hidden" value="{{$feetotal}}" id="fee-total">


        <div>
            <table class=" table table-borderless" id="total_div">
                <tbody>
                    <tr>
                        <td>
                            {{__('Total Amount')}}
                        </td>
                        <td id="total_amt" class="pull-right kt-font-bold">{{number_format($feetotal,2)}}</td>
                    </tr>
                    @if(!is_null($exempt) && $exempt > 0)
                        <tr>
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





        <table id="date_data" border="1">
            <tr>
                <td>Printing Date: </td>
                <td>{{date('d/m/Y')}}</td>
            </tr>
        </table>
        <div id="dept_name">
            <h2>إدارة التراخيص السياحية وضمان الجودة</h2>
            <h3>Department of Tourism Licensing & Quality Assurance</h3>
        </div>
        <footer>
            @include('permits.components.print.footer')
        </footer>

        <script>

            window.onload = function(){
                    callThis();
                    window.open();
                    window.print();
                    setTimeout(function () { window.close(); }, 500);
                    //
                }

             function callThis()
             {
                 let exempt = document.querySelector('#exempt-percentage').value;

                 if(exempt > 0) {
                     let feeTotal = document.querySelector('#fee-total').value;
                     let discount = feeTotal * ( parseInt(exempt) / 100);
                     let grandTotal = feeTotal - discount;

                     document.querySelector('#discount-amount').innerHTML = '- '+formatAmount(discount);
                     document.querySelector('#discount-amount').setAttribute('style', 'color: #34bfa3');
                     document.querySelector('#grand-total').innerHTML = formatAmount(grandTotal);

                 }
             }

            function formatAmount(amount)
            {
                return parseInt(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
            }
        </script>
</body>

</html>
