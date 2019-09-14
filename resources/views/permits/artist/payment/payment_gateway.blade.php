@extends('layouts.app')


@section('content')

<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <div class="row">
            <div class="col-lg-12">

                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title"> Payment Gateway</h3>
                        </div>

                        <div class="kt-portlet__head-toolbar">
                            <div class="my-auto float-right">
                                <a href="/company/make_payment/{{$permit_details->permit_id}}"
                                    class="btn btn--maroon btn-elevate btn-sm">
                                    <i class="la la-angle-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet__body">

                        <h4 class="text-center kt-block-center kt-margin-20">Amount to be Paid: AED 2500</h4>


                        <div class="d-flex justify-content-center">
                            <a href="../happiness_meter/{{$permit_details->permit_id}}">
                                <button
                                    class="btn btn-sm btn-wide btn--yellow kt-font-bold kt-font-transform-u">PAY</button>
                            </a>
                        </div>

                    </div>
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
