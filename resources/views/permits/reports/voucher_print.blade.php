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
            margin-top: 80px;
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
            {{-- <div>
                تصريح مؤقت
            </div> --}}
            <div>
                Payment Voucher
            </div>
        </div>
    </header>

    <div class="kt-portlet__body kt-padding-t-0" id="main-div">
        <div class="kt-container kt-padding-l-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Transaction No.')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$transaction->reference_number}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Transaction Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{date('d-M-Y', strtotime($transaction->transaction_date))}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Transaction ID')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$transaction->payment_transaction_id}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Receipt No')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$transaction->payment_receipt_no}}
                        </p>
                    </div>
                </div>
            </div>

            @php
            $feetotal = 0;
            $vattotal = 0;
            $grandtotal = 0;
            @endphp

            @if($transaction->artistPermitTransaction()->exists())
            {{-- <h5 class="text-dark kt-margin-b-20 text-underline kt-font-bold">{{__('Artist Permit Details')}}
            </h5> --}}
            <div class="col-md-12">
                <table class="table table-hover table-borderless border table-striped" border="1">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('Artist Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th class="text-right">{{__('Amount')}} (AED)</th>
                            <th class="text-right">{{__('Vat')}} (5%)</th>
                            <th class="text-right">{{__('Total')}} (AED)</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($transaction->artistPermitTransaction as $at)
                        <tr>
                            <td>
                                {{getLangId() == 1 ? ucfirst($at->artistPermit->firstname_en).' '. ucfirst($at->artistPermit->lastname_en) : $at->artistPermit->lastname_ar.' '.$at->artistPermit->firstname_ar}}
                            </td>
                            <td>
                                {{getLangId() == 1 ? ucfirst($at->artistPermit->profession->name_en) : $at->artistPermit->profession->name_ar}}
                            </td>
                            <td class="text-right">
                                {{number_format($at->amount,2)}}
                            </td>
                            <td class="text-right">
                                {{number_format($at->vat,2)}}
                            </td>
                            @php
                            $total = $at->amount + $at->vat;
                            $feetotal += $at->amount;
                            $vattotal += $at->vat;
                            $grandtotal += $total;
                            @endphp
                            <td class="text-right">
                                {{number_format($total,2)}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            {{-- {{dd($transaction->eventTransaction)}} --}}

            @if($transaction->eventTransaction()->exists())
            {{-- <h5 class="text-dark kt-margin-b-20 text-underline kt-font-bold">{{__('Event Permit Details')}}
            </h5> --}}
            <div class="col-md-12">
                <table class="table table-hover table-borderless border table-striped" border="1">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th class="text-left">{{__('Event Name')}}</th>
                            <th class="text-left">{{__('Event Type')}}</th>
                            <th class="text-right">{{__('Fee')}} (AED) / Day</th>
                            <th class="text-center">{{__('No.of.days')}}</th>
                            <th class="text-center">{{__('Qty')}}</th>
                            <th class="text-right">{{__('Total')}} (AED) </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->eventTransaction as $et)
                        @php
                        $from_d = strtotime($et->event->issued_date);
                        $to_d = strtotime($et->event->expired_date);
                        $noofdays = abs($from_d - $to_d) / 60 / 60 / 24;
                        @endphp
                        @if($et->type == 'event')
                        <tr>
                            <td class="text-left">
                                {{getLangId() == 1 ? ucfirst($et->event->name_en) : $et->event->name_ar}}</td>
                            <td class="text-left">
                                {{getLangId() == 1 ? ucfirst($et->event->type->name_en) : $et->event->type->name_en }}
                            </td>
                            <td class="text-right">{{number_format($et->event->type->amount,2)}}</td>
                            @php
                            $noofdays = abs($et->amount / $et->event->type->amount );
                            @endphp
                            <td class="text-center">
                                {{$noofdays}}
                            </td>
                            <td class="text-right">-</td>
                            @php
                            $total = $et->amount + $et->vat;
                            $feetotal += $et->amount;
                            $vattotal += $et->vat;
                            $grandtotal += $total;
                            @endphp
                            <td class="text-right">{{number_format($feetotal,2)}}</td>
                        </tr>
                        @elseif($et->type == 'truck')
                        <tr>
                            <td class="text-left">{{__('Truck Fee')}}</td>
                            <td></td>
                            @php
                            $truck_count = $et->total_trucks;
                            $per_truck_fee = $et->amount / ( $truck_count * $noofdays ) ;
                            @endphp
                            <td class="text-right">{{number_format($per_truck_fee,2)}} / truck</td>
                            <td class="text-center">
                                {{$noofdays}}
                            </td>
                            <td class="text-center">{{$truck_count}}</td>
                            @php
                            $total = $et->amount + $et->vat;
                            $feetotal += $et->amount;
                            $vattotal += $et->vat;
                            $grandtotal += $total;
                            @endphp
                            <td class="text-right">{{number_format($feetotal,2)}}</td>
                        </tr>
                        @elseif($et->type == 'liquor')
                        <tr>
                            <td class="text-left">{{__('Liqour Fee')}}</td>
                            <td></td>
                            @php
                            $per_liquor_fee = $et->amount / $noofdays ;
                            @endphp
                            <td class="text-right">{{number_format($per_liquor_fee,2)}}</td>
                            <td class="text-center">
                                {{$noofdays}}
                            </td>
                            <td>-</td>
                            @php
                            $total = $et->amount + $et->vat;
                            $feetotal += $et->amount;
                            $vattotal += $et->vat;
                            $grandtotal += $total;
                            @endphp
                            <td class="text-right">{{number_format($et->amount,2)}}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif

            <div class="pull-right">
                <table class=" table table-borderless" id="total_div">
                    <tbody>
                        <tr>
                            <td>
                                {{__('Total Amount')}}
                            </td>
                            <td id="total_amt" class="pull-right kt-font-bold">{{number_format($feetotal,2)}}</td>
                        </tr>
                        <tr style="border-bottom:1px solid black;">
                            <td>{{__('Total Vat')}} (5%)</td>
                            <td id="total_vat" class="pull-right kt-font-bold">{{number_format($vattotal,2)}}</td>
                        </tr>
                        <hr>
                        <tr>
                            <td class="kt-font-transform-u">
                                {{__('Grand Total')}} (AED)
                            </td>
                            <td id="grand_total" class="pull-right kt-font-bold">{{number_format($grandtotal,2)}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>





            <table id="date_data">
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
                <div>
                    Department of Tourism Licensing & Quality Assurance - RAKTDA - Al Marjan Island - RAK - UAE, PO BOX
                    29798
                </div>
                <div>
                    T +97172338998, F +97172338118
                </div>
                <div>
                    TLQA@raktda.com &emsp; www.raktda.com
                </div>
            </footer>

            <script>
                window.onload = function(){
                    window.open();
                    window.print();
                    setTimeout(function () { window.close(); }, 500);
                    //
                }
            </script>
</body>

</html>