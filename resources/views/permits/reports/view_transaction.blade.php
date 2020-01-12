@extends('layouts.app')

@section('title', 'Artist Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title  kt-font-transform-u">{{__('View Transaction Report')}}
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{URL::signedRoute('company.reports')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    {{__('Back')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{URL::signedRoute('company.reports')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="kt-container kt-padding-l-0">
            <div class="col-md-12 ">
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
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Made From')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{ucwords($transaction->transaction_type)}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Transaction ID')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$transaction->payment_transaction_id}}</p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Transaction Receipt')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$transaction->payment_receipt_no}}
                        </p>
                    </div>
                    <div class="col-md-4 col-sm-12 row">
                        <label class="col col-md-6 col-form-label">{{__('Order ID')}}</label>
                        <p class="col col-md-6 form-control-plaintext kt-font-bolder">
                            {{$transaction->payment_order_id}}</p>
                    </div>
                </div>
            </div>



            @if($transaction->artistPermitTransaction()->exists())
            <h5 class="text-dark kt-margin-b-20 text-underline kt-font-bold">{{__('Artist Permit Details')}}
            </h5>
            <div class="col-md-12">
                <table class="table table-hover table-borderless border table-striped">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th class="text-center">#</th>
                            <th>{{__('Artist Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th>{{__('Mobile No.')}}</th>
                            <th>{{__('Email')}}</th>
                            <th class="text-center">{{__('View')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->artistPermitTransaction as $at)
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                {{getLangId() == 1 ? ucfirst($at->artistPermit->firstname_en).' '. ucfirst($at->artistPermit->lastname_en) : $at->artistPermit->lastname_ar.' '.$at->artistPermit->firstname_ar}}
                            </td>
                            <td>
                                {{getLangId() == 1 ? ucfirst($at->artistPermit->profession->name_en) : $at->artistPermit->profession->name_ar}}
                            </td>
                            <td>
                                {{$at->artistPermit->mobile_number}}
                            </td>
                            <td>
                                {{$at->artistPermit->email}}
                            </td>
                            <td>
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

            @if($transaction->eventTransaction()->exists())
            <h5 class="text-dark kt-margin-b-20 text-underline kt-font-bold">{{__('Event Permit Details')}}
            </h5>
            <div class="col-md-12">
                <table class="table table-hover table-borderless border table-striped">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th class="text-center">#</th>
                            <th>{{__('Event Name')}}</th>
                            <th>{{__('From')}}</th>
                            <th>{{__('To')}}</th>
                            <th>{{__('Type')}}</th>
                            <th class="text-center">{{__('View')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->eventTransaction as $et)
                        <tr>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @endif


        </div>
    </div>

</div>

@endsection