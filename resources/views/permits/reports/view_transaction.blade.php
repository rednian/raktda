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
                <a href="{{URL::signedRoute('company.reports')}}"
                   class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                    {{__('BACK')}}
                </a>

                <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id ])}}"
                    target="_blank"> <button class="btn btn-sm btn--yellow"><i class="la la-print"></i> {{__('PRINT')}}
                    </button>
                </a>

            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                {{-- <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id])}}"
                target="_blank">
                <button class="btn btn-sm btn--yellow"><i class="la la-print"></i>
                </button>
                </a> --}}
                <a href="{{URL::signedRoute('company.reports')}}"
                   class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                </a>

                <a href="{{URL::signedRoute('transaction.print', ['id' => $transaction->transaction_id ])}}"
                    target="_blank"> <button class="btn btn-sm btn--yellow"><i class="la la-print"></i>
                    </button>
                </a>

            </div>
        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0" id="main-div">
        <div class="kt-container kt-padding-l-0">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label kt-font-bolder">{{__('TRANSACTION ID')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->reference_number}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Transaction Date')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{date('jS F Y', strtotime($transaction->transaction_date))}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Paid For')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->transaction_type == 'event' ? __('Event Permit') : __('Artist Permit')}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Transaction No.')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->payment_transaction_id}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('Receipt No')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$transaction->payment_receipt_no}}
                        </p>
                    </div>
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
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label  kt-font-bolder">{{__('No.of.days')}}</label>
                        <p class="col col-md-6 form-control-plaintext">
                            {{$noofdays}} {{$noofdays > 1 ? __('days') : __('day') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- <h5 class="text-dark kt-margin-b-20 text-underline kt-font-bold">{{__('Artist Permit Details')}}
            </h5> --}}
            <div class="col-md-12">
                <table class="table table-hover table-borderless border table-striped">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('Type')}}</th>
                            <th>{{__('Detail')}}</th>
                            <th class="text-center">{{__('Quantity')}} </th>
                             <th class="text-right">{{__('Profession Fee')}} (AED)</th>
                            <th class="text-right">{{__('Total')}} (AED)</th>
                            <th></th>
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
                                            {{number_format((int)$getProfession['amount'] *  $artistCount,2)}}
                                        </td>
                                        <td class="text-right">
                                            {{number_format($at['amount'],2)}}
                                        </td>
                                        <td class="text-center">
                                            <a
                                                href="{{URL::signedRoute('artist_details.view', ['id' => $at['artist_permit.artist_permit_id'] , 'from' => 'transaction'])}}">
                                                <button class=" btn btn-sm btn-secondary btn-hover-warning">{{__('View')}}
                                                </button></a>
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
                                        <td class="text-center">
                                            <a href="{{URL::signedRoute('report.view_event', ['id' => $et->event->event_id ])}}">
                                                <button class=" btn btn-sm btn-secondary btn-hover-warning">{{__('View')}}
                                                </button>
                                            </a>
                                        </td>
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
                                        <td></td>
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
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <input type="hidden" value="{{$exempt}}" id="exempt-percentage">
            <input type="hidden" value="{{$feetotal}}" id="fee-total">


            <div class="table-responsive">
                <div class="{{getLangId() == 1 ? 'pull-right' : 'pull-left'}}">
                    <table class=" table table-borderless" id="total_div">
                        <tbody>
                            <tr>
                                <td>
                                    {{__('Total Amount')}}
                                </td>
                                <td id="total_amt" class="pull-right kt-font-bold">{{number_format($feetotal,2)}}</td>
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
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>

        let exempt = $('#exempt-percentage').val();

        if(exempt > 0) {
            let feeTotal = $('#fee-total').val();
            let discount = feeTotal * ( parseInt(exempt) / 100);
            let grandTotal = feeTotal - discount;

            $('#discount-amount').html('- '+formatAmount(discount));
            $('#discount-amount').addClass('text-success');
            $('#grand-total').html(formatAmount(grandTotal));

        }

        function formatAmount(amount)
        {
            return parseInt(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

    </script>
    @endsection
