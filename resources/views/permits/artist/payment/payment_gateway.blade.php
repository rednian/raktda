@extends('layouts.app')


@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <a href="{{url('company/make_payment').'/'.$permit_details->permit_id}}"
                            class="btn btn--maroon btn-elevate btn-sm">
                            <i class="la la-angle-left"></i>
                            Back
                        </a>
                    </div>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="kt-widget5__info pb-4">
                    <div class="pb-2">
                        <span>From Date:</span>&emsp;
                        <span
                            class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->issued_date))}}</span>&emsp;&emsp;
                        <span>To Date:</span>&emsp;
                        <span
                            class="kt-font-info">{{date('d-M-Y',strtotime($permit_details->expired_date))}}</span>&emsp;&emsp;
                        <span>Work Location:</span>&emsp;
                        <span class="kt-font-info">{{$permit_details->work_location}}</span>&emsp;&emsp;
                        <span>Reference No:</span>&emsp;
                        <span class="kt-font-info">{{$permit_details->reference_number}}</span>&emsp;&emsp;
                    </div>
                </div>
                {{-- <h4 class="text-center kt-block-center kt-margin-20">Amount to be Paid: AED 2500</h4> --}}
                <div class="table-responsive">
                    <table class="table table-borderless table-striped">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>Artist Name</th>
                                <th>Artist Permit Type</th>
                                <th>Fee (AED)</th>
                                <th>Extras (AED)</th>
                                <th>Comments</th>
                                <th>Total (AED) </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $extras = 0 ;
                            $fee = 0;
                            $total = 0 ;
                            @endphp
                            @foreach($permit_details->artistPermit as $ap)
                            <tr>
                                <td class="text-center">{{$ap->artist['firstname_en'] .' '.$ap->lastname_en }}</td>
                                <td class="text-center">
                                    {{$ap->permitType['name_en']}}
                                </td>
                                <td class="text-right">
                                    {{$ap->permitType['amount']}}
                                    @php
                                    $fee+=$ap->permitType['amount'];
                                    @endphp
                                </td>
                                <td class="text-right">

                                </td>
                                <td class="text-center">

                                </td>
                                <td class="text-right">
                                    {{$ap->permitType['amount']}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="kt-font-bold text-center">
                                    Total
                                </td>
                                <td class="kt-font-bold text-right">
                                    {{$fee}}
                                </td>
                                <td class="kt-font-bold text-right">
                                    {{$extras}}
                                </td>
                                <td class="kt-font-bold">
                                    &nbsp;
                                </td>
                                <td class="kt-font-bold text-right">
                                    {{$fee+$extras}}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>



                <div class="d-flex justify-content-end">
                    <a href="{{url('company/pay_fee/'.$permit_details->permit_id)}}">
                        <button class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u">PAY</button>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection


@section('script')

<script>


</script>

@endsection
