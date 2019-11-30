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
                    </div>
                </div>
                @if($permit_details->event)
                <div class="pb-3">
                    <span>Connected to Event :</span>&emsp;
                    <span
                        class="kt-font-info">{{getLangId() == 1 ? $permit_details->event->name_en : $permit_details->event->name_ar}}</span>&emsp;&emsp;
                </div>
                @endif
                {{-- <h4 class="text-center kt-block-center kt-margin-20">Amount to be Paid: AED 2500</h4> --}}
                <div class="table-responsive">
                    <table class="table table-borderless border table-hover table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Artist Name')}}</th>
                                <th>{{__('Type')}}</th>
                                <th class="text-right">{{__('Fee')}} (AED)</th>
                                <th class="text-right">VAT(5%)</th>
                                <th class="text-right">Total (AED) </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $extras = 0 ;
                            $fee = 0;
                            $total = 0;
                            $vat_t = 0;
                            @endphp
                            @foreach($permit_details->artistPermit as $ap)
                            @if($ap->artist_permit_status == 'approved')
                            <tr>
                                <td>{{$ap['firstname_en'] .' '.$ap['lastname_en'] }}
                                </td>
                                <td>
                                    {{$ap->profession['name_en']}}
                                </td>
                                <td class="text-right">
                                    {{number_format($ap->profession['amount'],2)}}
                                    @php
                                    $fee+=$ap->profession['amount'];
                                    $vat = $ap->profession['amount'] * 0.05;
                                    $vat_t+= $vat;
                                    @endphp
                                </td>

                                <td class="text-right">
                                    {{number_format($vat,2)}}
                                </td>
                                <td class="text-right">
                                    {{number_format($ap->profession['amount'] + $vat, 2)}}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="kt-font-bold">
                                    Total
                                </td>
                                <td class="kt-font-bold text-right">
                                    {{number_format($fee,2)}}
                                </td>

                                <td class="kt-font-bold text-right">
                                    {{number_format($vat_t,2)}}
                                </td>
                                <td class="kt-font-bold text-right">
                                    {{number_format($fee+$extras+$vat_t,2)}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if($permit_details->event)
                @php
                $event = $permit_details->event;
                @endphp
                <div class="table-responsive">
                    <table class="table table-borderless table-hover border table-striped">
                        <thead>
                            <tr class="text-center">
                                <th class="text-left">{{__('Event Name')}}</th>
                                <th class="text-left">{{__('Event Type')}}</th>
                                <th class="text-right">{{__('Fee')}} (AED)</th>
                                <th class="text-right">VAT(5%)</th>
                                <th class="text-right">Total (AED) </th>
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
                                <td class="text-right">
                                    {{number_format($event->type['amount'],2)}}
                                </td>
                                <td class="text-right">
                                    {{number_format($event->type['amount'] * 0.05, 2)}}
                                    @php
                                    $vat = $event->type['amount'] * 0.05 ;
                                    @endphp
                                </td>
                                <td class="text-right">
                                    {{number_format($event->type['amount'] + $vat, 2)}}
                                </td>
                            </tr>
                        </tbody>

                        <input type="hidden" id="amount" value="{{$event->type['amount']}}">
                        <input type="hidden" id="vat" value="{{$vat}}">
                    </table>
                </div>
                <div>
                    <label class="kt-checkbox kt-checkbox--warning ml-2 mt-3">
                        <input type="checkbox" id="isEventPay" name="isEventPay">
                        Do you wish to pay event permit fee ?
                        <span></span>
                    </label>
                </div>
                @endif

                <form action="{{route('company.payment', $permit_details->permit_id)}}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u"
                            id="pay_btn">PAY</button>
                    </div>


                </form>

            </div>
        </div>
    </div>
</div>



@endsection