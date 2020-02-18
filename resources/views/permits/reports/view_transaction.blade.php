@extends('layouts.app')

@section('title', 'Artist Details')

@section('style')
<style>
    @media print {
        * {
            text-align: center;
        }
    }
</style>
@endsection

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title  kt-font-transform-u">{{__('View Transaction Report')}}
            </h3>
        </div>



        <div class="kt-portlet__head-toolbar">

            <div class="my-auto float-right permit--action-bar">
                {{-- <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id])}}"
                target="_blank">
                <button class="btn btn-sm btn--yellow"><i class="la la-print"></i> {{__('Print')}}
                </button>
                </a> --}}
                <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id ])}}"
                    target="_blank"> <button class="btn btn-sm btn--yellow"><i class="la la-print"></i> {{__('Print')}}
                    </button>
                </a>
                <a href="{{URL::signedRoute('company.reports')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                {{-- <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id])}}"
                target="_blank">
                <button class="btn btn-sm btn--yellow"><i class="la la-print"></i>
                </button>
                </a> --}}
                <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id ])}}"
                    target="_blank"> <button class="btn btn-sm btn--yellow"><i class="la la-print"></i>
                    </button>
                </a>
                <a href="{{URL::signedRoute('company.reports')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0" id="main-div">
        <div class="kt-container kt-padding-l-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('Transaction No.')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->reference_number}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Transaction Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{date('d-M-Y', strtotime($transaction->transaction_date))}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Made From')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{ucwords($transaction->transaction_type)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Transaction ID')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->payment_transaction_id}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Receipt No')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->payment_receipt_no}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Currency')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            AED
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
                <table class="table table-hover table-borderless border table-striped">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('Artist Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th class="text-right">{{__('Amount')}} (AED)</th>
                            <th class="text-right">{{__('Vat')}} (5%)</th>
                            <th class="text-right">{{__('Total')}} (AED)</th>
                            <th class="text-center">{{__('View')}}</th>
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
                            <td class="text-center">
                                <a
                                    href="{{URL::signedRoute('artist_details.view', ['id' => $at->artistPermit->artist_permit_id , 'from' => 'transaction'])}}">
                                    <button class=" btn btn-sm btn-secondary btn-hover-warning">{{__('View')}}
                                    </button></a>
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
                <table class="table table-hover table-borderless border table-striped">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th class="text-left">{{__('Event Name')}}</th>
                            <th class="text-left">{{__('Event Type')}}</th>
                            <th class="text-right">{{__('Fee')}} (AED)</th>
                            <th class="text-right">{{__('Vat')}}(5%)</th>
                            <th class="text-right">{{__('Total')}} (AED) </th>
                            <th class="text-center">{{__('View')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->eventTransaction as $et)
                        @if($et->type == 'event')
                        <tr>
                            <td>{{getLangId() == 1 ? ucwords($et->event->name_en) : $et->event->name_ar}}
                            </td>
                            <td>{{getLangId() == 1 ? ucwords($et->event->type->name_en) : $et->event->type->name_en }}
                            </td>
                            <td class="text-right">{{number_format($et->amount,2)}}</td>
                            <td class="text-right">{{number_format($et->vat,2)}}</td>
                            @php
                            $total = $et->amount + $et->vat;
                            $feetotal += $et->amount;
                            $vattotal += $et->vat;
                            $grandtotal = $total;
                            @endphp
                            <td class="text-right">{{number_format($total,2)}}</td>

                            <td class="text-center">
                                <a href="{{URL::signedRoute('report.view_event', ['id' => $et->event->event_id ])}}">
                                    <button class=" btn btn-sm btn-secondary btn-hover-warning">{{__('View')}}
                                    </button>
                                </a>
                            </td>
                        </tr>
                        @elseif($et->type == 'truck')
                        <tr>
                            <td colspan="2">{{__('Truck Fee')}}</td>
                            <td class="text-right">{{number_format($et->amount,2)}}</td>
                            <td class="text-right">{{number_format($et->vat,2)}}</td>
                            @php
                            $total = $et->amount + $et->vat;
                            $feetotal += $et->amount;
                            $vattotal += $et->vat;
                            $grandtotal += $total;
                            @endphp
                            <td class="text-right">{{number_format($total,2)}}</td>
                            <td></td>
                        </tr>
                        @elseif($et->type == 'liquor')
                        <tr>
                            <td colspan="2">{{__('Liqour Fee')}}</td>
                            <td class="text-right">{{number_format($et->amount,2)}}</td>
                            <td class="text-right">{{number_format($et->vat,2)}}</td>
                            @php
                            $total = $et->amount + $et->vat;
                            $feetotal += $et->amount;
                            $vattotal += $et->vat;
                            $grandtotal += $total;
                            @endphp
                            <td class="text-right">{{number_format($total,2)}}</td>
                            <td></td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif


            <div class="table-responsive">
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
                            <tr>
                                <td class="kt-font-transform-u">
                                    {{__('Grand Total')}} (AED)
                                </td>
                                <td id="grand_total" class="pull-right kt-font-bold">
                                    {{number_format($grandtotal,2)}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>

@endsection