@extends('layouts.app')

@section('title', 'Happiness Meter Event Permit - Smart Government Rak')
@section('style')
<style>
    ::placeholder {
        font-style: italic;
    }
</style>
@endsection
@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->all())}} --}}
<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items" id="event-wizard--nav">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span> {{__('Instructions')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="event_det">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> {{__('Event Details')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> {{__('Upload Docs')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" id="mk_payment">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>04</span> {{__('Payment')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="happiness">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>05</span> {{__('Happiness')}}
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>

                    </div>
                </div>

                <!--end: Form Wizard Nav -->
            </div>

            <input type="hidden" id="user_id" value="{{Auth::user()->user_id}}">


            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->
                    @include('permits.event.common.instructions', ['event_types' => $event_types])


                    @include('permits.event.common.common-event-details', ['disabled' =>true])



                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <input type="hidden" id="requirements_count" />
                                <form id="documents_required">


                                </form>
                                <input type="hidden" id="addi_requirements_count">
                                <form id="addi_documents_required" novalidate>
                                </form>
                                <form id="image_upload_form">
                                    <div class="row">
                                        <div class="col-lg-4 col-sm-12"><label
                                                class="kt-font-bold text--maroon">{{__('Images')}}</label>
                                            <p class="reqName">{{__('Add multiple images')}}</p>
                                        </div>
                                        <div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label>
                                            <div id="image_uploader">{{__('Upload')}}</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                @if($event->firm == 'corporate')
                                <form id="make_payment">
                                    <div class="kt-widget kt-widget--project-1">
                                        <div class="kt-widget__body  kt-padding-l-10">
                                            <div class="kt-widget__stats d-">
                                                <div class="kt-widget__item">
                                                    <span class="kt-widget__date">{{__('From Date')}}</span>
                                                    <div class="kt-widget__label">
                                                        <span class="btn btn-label-success btn-sm btn-bold btn-upper">
                                                            {{date('d M,y',strtotime($event->issued_date))}}&nbsp;

                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="kt-widget__item">
                                                    <span class="kt-widget__date">{{__('To Date')}}</span>
                                                    <div class="kt-widget__label">
                                                        <span class="btn btn-label-danger btn-sm btn-bold btn-upper">
                                                            {{date('d M,y',strtotime($event->expired_date))}} &nbsp;

                                                        </span>
                                                    </div>
                                                </div>
                                                @php
                                                $issued_date = strtotime($event->issued_date);
                                                $expired_date = strtotime($event->expired_date);
                                                $noofdays = abs($expired_date - $issued_date) / 60 / 60 / 24;
                                                @endphp
                                                <div class="kt-widget__item">
                                                    <span class="kt-widget__date">{{__('No.of.days')}}</span>
                                                    <div class="kt-widget__label">
                                                        <span class="btn btn-label-info btn-sm btn-bold">
                                                            {{$noofdays.' '.($noofdays > 1 ? __('days') :
                                                            __('day'))}}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="kt-widget__item">
                                                    <span class="kt-widget__date">{{__('Reference No')}}</span>
                                                    <div class="kt-widget__label">
                                                        <span
                                                            class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                                            {{$event->reference_number}}
                                                        </span>
                                                    </div>
                                                </div>
                                                @if($event->request_type == 'amend')
                                                <div class="kt-widget__item">
                                                    <span class="kt-widget__date">{{__('Event Type')}}</span>
                                                    <div class="kt-widget__label">
                                                        <span
                                                            class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                                            {{getLangId() == 1 ? ucfirst($event->type['name_en']) : $event->type['name_ar']}}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="kt-widget__item">
                                                    <span class="kt-widget__date">{{__('Event Name')}}</span>
                                                    <div class="kt-widget__label">
                                                        <span
                                                            class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper">
                                                            {{getLangId() == 1 ? ucfirst($event->name_en) : $event->name_ar}}
                                                        </span>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="kt-widget__text kt-margin-t-10">
                                                <strong>{{__('Venue')}} :</strong>
                                                {{getLangId() == 1 ? $event->venue_en : $event->venue_ar}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <h4 class="text-center kt-block-center kt-margin-20">Amount to be Paid: AED 2500</h4> --}}
                                    @php
                                    $event_fee_total = 0;
                                    $event_vat_total = 0;
                                    $event_grand_total = 0;
                                    $truck_fee = 0;
                                    $liquor_fee = 0 ;
                                    $issued_date = strtotime($event->issued_date);
                                    $expired_date = strtotime($event->expired_date);
                                    $noofdays = abs($expired_date - $issued_date) / 60 / 60 / 24;
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-hover border table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Event Name')}}</th>
                                                    <th>{{__('Event Type')}}</th>
                                                    <th class="text-right">{{__('Fee')}} (AED)</th>
                                                    <th class="text-right">{{__('VAT')}} (5%)</th>
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
                                                    $vat_amt = $event_fee * 0.05;
                                                    $event_total = $event_fee + $vat_amt ;
                                                    $event_fee_total += $event_fee;
                                                    $event_vat_total += $vat_amt;
                                                    $event_grand_total += $event_total;
                                                    @endphp
                                                    <td class="text-right">
                                                        {{number_format($event_fee,2)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{number_format($vat_amt , 2)}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{number_format($event_total, 2)}}
                                                    </td>
                                                </tr>
                                                @if($event->is_truck == 1)
                                                <tr>
                                                    <td colspan="2">{{__('Food Truck')}}</td>
                                                    @php
                                                    $per_truck_fee = getSettings()->food_truck_fee;
                                                    $truck_fee += $noofdays * $per_truck_fee;
                                                    $event_fee_total += $truck_fee;
                                                    $event_grand_total += $truck_fee;
                                                    @endphp
                                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                                    <td class="text-right">0</td>
                                                    <td class="text-right">{{number_format($truck_fee, 2)}}</td>
                                                </tr>
                                                @endif
                                                @if($event->is_liquor == 1)
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

                                    <input type="hidden" id="truck_fee" value="{{$truck_fee}}">
                                    <input type="hidden" id="liquor_fee" value="{{$liquor_fee}}">
                                    <input type="hidden" id="is_truck" value="{{$event->is_truck}}">

                                    <input type="hidden" id="event_total_amount" value="{{$event_fee_total}}">
                                    <input type="hidden" id="event_vat_total" value="{{$event_vat_total}}">
                                    <input type="hidden" id="event_grand_total" value="{{$event_grand_total}}">

                                    <input type="hidden" value="{{$event->paid_artist_fee}}" id="paidArtistFee">

                                    @php
                                    $artist_fee_total = 0;
                                    $artist_vat_total = 0;
                                    $artist_g_total = 0 ;
                                    $artist_fee = 0;
                                    $artist_total = 0;
                                    @endphp

                                    @if($event->permit)
                                    <div class="table-responsive" id="artist_pay_table" style="display:none;">
                                        <table class="table table-borderless border table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Artist Name')}}</th>
                                                    <th>{{__('Artist Permit Type')}}</th>
                                                    <th class="text-right">{{__('Fee')}} (AED)</th>
                                                    <th class="text-right">{{__('VAT')}} (5%)</th>
                                                    <th class="text-right">{{__('Total')}} (AED) </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($event->permit->artistPermit as $ap)
                                                @if($ap->artist_permit_status == 'approved' && $ap->is_paid == 0)
                                                <tr>
                                                    <td>{{getLangId() == 1 ? $ap['firstname_en'] .' '.$ap['lastname_en'] : $ap['lastname_ar'] .' '.$ap['firstname_ar']}}
                                                    </td>
                                                    <td>
                                                        {{getLangId() == 1 ? $ap->profession['name_en'] : $ap->profession['name_ar']}}
                                                    </td>
                                                    @php
                                                    $artist_fee += $ap->profession['amount'] * $noofdays;
                                                    $artist_vat = $artist_fee * 0.05;
                                                    $artist_total += $artist_fee + $artist_vat;
                                                    $artist_fee_total += $artist_fee;
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
                                                        Total
                                                    </td>
                                                    <td class="kt-font-bold text-right">
                                                        {{number_format($artist_fee_total,2)}}
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
                                    <div style="display:none" id="is_event_pay_div">
                                        <label class="kt-checkbox kt-checkbox--warning ml-2 mt-3">
                                            <input type="checkbox" id="isEventPay" name="isEventPay" disabled>
                                            Do you wish to pay associated artist permit fee ?
                                            <span></span>
                                        </label>
                                    </div>
                                    @endif

                                    <input type="hidden" id="artist_fee_total" value="{{$artist_fee_total}}">
                                    <input type="hidden" id="artist_vat_total" value="{{$artist_vat_total}}">
                                    <input type="hidden" id="artist_g_total" value="{{$artist_g_total}}">

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
                                </form>
                                @else
                                <h4>{{__('No Payments for Government')}}</h4>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <form id="happiness_center" autocomplete="off" novalidate>
                                    <div class="d-flex justify-content-around happiness--center">
                                        <div id="sad" style="cursor:pointer" onclick="makeSelected(this.id, 0)">

                                            <?php echo file_get_contents('./img/sad.svg'); ?>

                                        </div>
                                        <div id="notbad" style="cursor:pointer" onclick="makeSelected(this.id, 50)">

                                            <?php echo file_get_contents('./img/notbad.svg'); ?>

                                        </div>

                                        <div id="happy" style="cursor:pointer" onclick="makeSelected(this.id, 100)">

                                            <?php echo file_get_contents('./img/happiness.svg'); ?>

                                        </div>
                                        <input type="hidden" id="rating">
                                        <input type="hidden" id="event" value="{{$event->event_id}}">
                                    </div>
                                    <div
                                        class="form-group row form-group-marginless kt-margin-t-40 kt-margin-l-auto kt-margin-r-auto">
                                        <label for=""
                                            class="kt-font-dark col-md-3 col-lg-3 col-form-label text-right">{{__('Your opinion matters')}}
                                            :</label>
                                        <div class="col-md-8">
                                            <textarea name="remarks" id="remarks" class="form-control form-control-sm "
                                                rows="4"
                                                placeholder="{{__('please enter your valuable comments')}}"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('PREVIOUS')}}
                        </div>


                        <a href="{{url('company/event')}}">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('BACK')}}
                            </div>
                        </a>


                        <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-submit" id="submit_btn">
                            {{__('SUBMIT')}}
                        </div>



                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            {{__('NEXT')}}
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>
</div>
</div>

<!-- end:: Content -->



<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>
<!-- end::Scrolltop -->

<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-body">
        <div id="ajax_loader" style="min-height: 100vh;">
            <img src="{{asset('/img/ajax-loader.gif')}}" style="position: absolute; top:50%; left: 50%;">
        </div>
    </div>
</div>

<!--begin::Modal-->



<!--end::Modal-->


@include('permits.event.common.show_food_truck', ['truck_req'=>$truck_req])
@include('permits.event.common.show_liquor', ['liquor_req'=>$liquor_req])

@endsection


@section('script')
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/artist.js')}}"></script>
<script src="{{asset('js/company/map.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA6nhSpjNed-wgUyVMJQZJTRniW-Oj_Tgw&libraries=places&callback=initialize"
    async defer></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    var documentsValidator ;
    var truckDocUploader = [];
    var liquorDocUploader = [];

    $(document).ready(function(){
        setWizard();
        wizard = new KTWizard("kt_wizard_v3");
        wizard.goTo(5);
        $('#back_btn').css('display', 'none');
        $('#next_btn').css('display', 'none');
        $('#submit_btn').css('display', 'block');
        localStorage.clear();
        getRequirementsList();
        getAddtionalRequirementsList($('#event_id').val());
        imageUploadFunction();
        var paidArtistFee = $('#paidArtistFee').val();

        if(paidArtistFee == 1)
        {
            $('#is_event_pay_div').show();
            $('#isEventPay').prop('checked', true);
            check_permit();
        }

        var eventTotalAmount = $('#event_total_amount').val();
        $('#total_amt').html(parseInt(eventTotalAmount).toFixed(2));
        var eventVatTotal = $('#event_vat_total').val();
        $('#total_vat').html(parseInt(eventVatTotal).toFixed(2));
        var eventGrandTotal = $('#event_grand_total').val();
        $('#grand_total').html(parseInt(eventGrandTotal).toFixed(2));
        $('#amount').val(eventTotalAmount);
        $('#vat').val(eventVatTotal);
        $('#total').val(eventGrandTotal);

        var isTruck = $('#prev_val_isTruck').val();
        if(isTruck == 0){
            $('#truckEditBtn').hide();
        }
        var isLiquor = $('#prev_val_isLiquor').val();
        if(isLiquor == 0){
            $('#liquorEditBtn').hide();
        }
        check_duration();
    });

    var getLangid = $('#getLangid').val();

    function check_permit()
    {
        var eventTotalAmount = $('#event_total_amount').val();
        var eventVatTotal = $('#event_vat_total').val();
        var eventGrandTotal = $('#event_grand_total').val();
        var artist_fee_total = $('#artist_fee_total').val();
        var artist_vat_total = $('#artist_vat_total').val();
        var artist_g_total = $('#artist_g_total').val(); 
        var total_amt = parseInt(artist_fee_total) + parseInt(eventTotalAmount);
        var total_vat = parseInt(artist_vat_total) + parseInt(eventVatTotal);
        var grand_total = parseInt(artist_g_total) + parseInt(eventGrandTotal);
        if($('#isEventPay').prop("checked"))
        {
            $('#artist_pay_table').show();
            $('#total_amt').html(total_amt.toFixed(2));
            $('#total_vat').html(total_vat.toFixed(2));
            $('#grand_total').html(grand_total.toFixed(2));
            $('#amount').val(total_amt);
            $('#vat').val(total_vat);
            $('#total').val(grand_total);
        }else {
            $('#artist_pay_table').hide();
            $('#total_amt').html(parseInt(eventTotalAmount).toFixed(2));
            $('#total_vat').html(parseInt(eventVatTotal).toFixed(2));
            $('#grand_total').html(parseInt(eventGrandTotal).toFixed(2));
            $('#amount').val(eventTotalAmount);
            $('#vat').val(eventVatTotal);
            $('#total').val(eventGrandTotal);
        }
    }

    function makeSelected(id, value) {
			// console.log(id);
			if (id == 'happy') {
				$('#happy svg path').attr('fill', '#80262b');
				$('#notbad svg path').attr('fill', '#EA9400');
				$('#sad svg path').attr('fill', '#EA9400');
			} else if (id == 'notbad') {
				$('#notbad svg path').attr('fill', '#80262b');
				$('#happy svg path').attr('fill', '#EA9400');
				$('#sad svg path').attr('fill', '#EA9400');
			} else if (id == 'sad') {
				$('#sad svg path').attr('fill', '#80262b');
				$('#happy svg path').attr('fill', '#EA9400');
				$('#notbad svg path').attr('fill', '#EA9400');
            }

            $('#rating').val(value);
    }

    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            let totalLength = parseInt($('#requirements_count').val())  + parseInt($('#addi_requirements_count').val());
            for (var i = 1; i <= totalLength; i++) {
                let requiId = $('#req_id_' + i).val() ;
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('event.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "doc_file_" + i,
                    showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    returnType: "json",
                    autoSubmit: false,
                    showFileCounter: false,
                    abortStr: '',
                    multiple: false,
                    maxFileCount: 5,
                    // showDelete: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
                    onSuccess: function (files, response, xhr, pd) {
                            //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    onLoad: function (obj) {

                        $.ajaxSetup({
                            headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
                        });
                        $.ajax({
                            cache: false,
                            url: "{{route('company.event.get_uploaded_docs')}}",
                            type: 'POST',
                            data: {eventId: $('#event_id').val() ,reqId: $('#req_id_' + i).val()},
                            dataType: "json",
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    for(data of data) {
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let issue_datetime = new Date(data['issued_date']);
                                        let exp_datetime = new Date(data['expired_date']);
                                        let formatted_issue_date = moment(data.issued_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        // const d = data["path"].split("/");
                                        // let docName = d[d.length - 1];
                                        const d = data["path"].split("/");
                                        var cc = d.splice(4,5);
                                        let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        obj.createProgress(docName, "{{asset('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        
                                        j++;
                                    }

                                }
                            }
                        });


                    },
                    onError: function (files, status, errMsg, pd) {
                        showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                        pd.statusbar.hide();
                    },
                    downloadCallback: function (files, pd) {
                        if(files[0]) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let this_url = user_id + '/event/' + eventId +'/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        ); }
                    }
                });
                $('#fileuploader_' + i + ' div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
                $("#ajax-upload_" + i).css('pointer-events', 'none');
            }
        };

        const picUploadFunction = () => {
            picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('event.uploadLogo')}}",
                headers:  {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")},
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                deleteStr: `<i class="la la-trash"></i>`,   
                downloadStr:  `<i class="la la-download"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileCounter: false,
                abortStr: '',
                // previewHeight: '100px',
                // previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showDownload: true,
                showDelete: false,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                onLoad: function (obj) {
                    var url = "{{route('event.get_uploaded_logo',':id')}}" ;
                    url = url.replace(':id', $('#event_id').val() );
                    $.ajax({
                        url: url,
                        success: function (data) {
                            // console.log(data);
                            if (data.trim() != '') {
                                let ex = data.split('/').pop();
                                obj.createProgress(ex, "{{url('storage')}}"+'/'+ data, '');
                            }
                        }
                    });
                },
                downloadCallback: function (files, pd) {
                    if(files.filepath){
                        let file_path = files.filepath;
                        let path = file_path.replace('public/','');
                        window.open(
                    "{{url('storage')}}"+'/' + path,
                    '_blank'
                    );
                    }else {
                        let event_id = $('#event_id').val();
                        let user_id = $('#user_id').val();
                        let path = user_id+'/event/'+event_id+'/photos/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    }
                }
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
            $("#pic-upload").css('pointer-events', 'none');
        };



        var eventValidator = $('#eventdetails').validate({
            ignore: [],
            rules: {
                event_type_id: 'required',
                name_en: 'required',
                name_ar: 'required',
                issued_date: 'required',
                // time_start: 'required',
                venue_en: 'required',
                expired_date: 'required',
                time_end: 'required',
                venue_ar: 'required',
                address: 'required',
            },
            messages: {
                event_type_id: '',
                name_en: '',
                name_ar: '',
                issued_date: '',
                // time_start: '',
                venue_en: '',
                expired_date: '',
                time_end: '',
                venue_ar: '',
                address: '',
            },
        });


        $("#check_inst").on("click", function () {
            setThis('none', 'block', 'block', 'none');
        });

        $("#event_det").on("click", function () {
     
            setThis('block', 'block', 'none', 'none');
        });

        $("#upload_doc").on("click", function () {
     
            setThis('block', 'block', 'none', 'none');
        });

        $('#mk_payment').on('click', function(){

            setThis('block', 'block', 'none', 'none');
        })

        $('#happiness').on('click', function(){
    
            setThis('block', 'none', 'none', 'block');
        })

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit_btn').css('display', submit);
        };

        const checkForTick = () => {
            wizard = new KTWizard("kt_wizard_v3");
            var result;

            if ($('#agree').not(':checked')) {
                wizard.stop();
                $('#agree_cb > span').addClass('compulsory');
                result = false;
            }
            if ($('#agree').is(':checked')) {
                $('#back_btn').css('display', 'none');
                $('#prev_btn').css('display', 'block');
                wizard.goNext();
                result = true;
            }
            return result;
        };


        $('#next_btn').click(function () {

        wizard = new KTWizard("kt_wizard_v3");

        checkForTick();
        // checking the next page is artist details
        if (wizard.currentStep == 2) {
            stopNext(eventValidator);
            KTUtil.scrollTop();// validating the artist details page
            if (eventValidator.form()) {
                //$('#next_btn').css('display', 'block'); // hide the next button
                eventdetails = {
                    event_id: $('#event_type_id').val(),
                    name: $('#name_en').val(),
                    name_ar: $('#name_ar').val(),
                    issued_date: $('#issued_date').val(),
                    time_start: '',
                    venue_en: $('#venue_en').val(),
                    expired_date: $('#expired_date').val(),
                    time_end: '',
                    venue_ar: $('#venue_ar').val(),
                    address: $('#address').val(),
                    emirate_id: $('#emirate_id').val(),
                    area_id: $('#area_id').val(),
                    country_id: $('#country_id').val()
                };

                localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }

        if (wizard.currentStep == 3) {

            $('#next_btn').css('display', 'block');
            
        }

        if (wizard.currentStep == 4) {

            $('#next_btn').css('display', 'none');
            $('#submit_btn').css('display', 'block');

        }
        });


        const docValidation = () => {
            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#requirements_count').val();
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) {
                if ($('#ajax-file-upload_' + i).length) {
                    if ($('#ajax-file-upload_' + i).contents().length == 0) {
                        hasFileArray[i] = false;
                        $("#ajax-upload_" + i).css('border', '2px dotted red');
                    } else {
                        hasFileArray[i] = true;
                        $("#ajax-upload_" + i).css('border', '2px dotted #A5A5C7');
                    }
                    documentDetails[i] = {
                        issue_date: $('#doc_issue_date_' + i).val(),
                        exp_date: $('#doc_exp_date_' + i).val()
                    }
                }
            }
            }


            if (hasFileArray.includes(false) ) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
                return hasFile;
            };



        const stopNext = (validator_name) => {
            wizard.on("beforeNext", function (wizardObj) {
                if (validator_name.form() !== true) {
                    wizardObj.stop(); // don't go to the next step
                }
            });
        };

        $('#prev_btn').click(function () {
            wizard = new KTWizard("kt_wizard_v3");
            if (wizard.currentStep == 2) {
                $('#prev_btn').css('display', 'none');
                $('#back_btn').css('display', 'block');
            } else {
                $('#prev_btn').css('display', 'block');
                $('#next_btn').css('display', 'block');
            }
            $('#submit_btn').css('display', 'none');
        });

        function editTruck(){
            var event_id = $('#event_id').val() ;
            var url = "{{route('event.fetch_truck_details_by_event_id', ':id')}}" ;
            url = url.replace(':id', event_id);
            $.ajax({    
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        $('#food_truck_list').empty();
                        // console.log(result);
                        $('#edit_food_truck').modal('show');
                        for(var s = 0;s < result.length;s++)
                        {
                            var k = s + 1 ;
                           $('#food_truck_list').append('<tr><td>'+k+'</td><td>'+ result[s].company_name_en+'</td><td class="text-right">'+ result[s].company_name_ar+'</td><td>'+ result[s].plate_number+'</td><td>'+ result[s].food_type+'</td><td class="text-center"> <button class="btn btn-secondary" onclick="viewThisTruck('+result[s].event_truck_id+', '+k+')">view</button>&emsp;<span id="append_'+s+'"></span></td></tr>');

                        
                        }

                        
                    }
                }
            });
        }

        function viewThisTruck(id, num)
        {
            var url = "{{route('event.fetch_this_truck_details', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url:  url,
                success: function (result) {
                    if(result) 
                    {
                        $('#edit_one_food_truck .ajax-file-upload-red').trigger('click');
                        $('#edit_food_truck').modal('hide');
                        $('#edit_truck_title').show();
                        $('#add_truck_title').hide();
                        $('#update_this_td').show();
                        $('#add_new_td').hide();
                        $('#edit_one_food_truck').modal('show');
                        $('#company_name_en').val(result.company_name_en);
                        $('#company_name_ar').val(result.company_name_ar);
                        $('#plate_no').val(result.plate_number);
                        $('#food_type').val(result.food_type);
                        $('#regis_issue_date').val(moment(result.registration_issued_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#regis_expiry_date').val(moment(result.registration_expired_date, 'YYYY-MM-DD').format('DD-MM-YYYY')).datepicker('update');
                        $('#this_event_truck_id').val(result.event_truck_id);
                        truckDocUpload();
                    }
                }
            });
        }

        const truckDocUpload = () => {
            var per_truck_doc = $('#truck_document_count').val();
            for(var i = 1; i <= parseInt(per_truck_doc);i++){
                var requiId = $('#truck_req_id_'+i).val();
                    truckDocUploader[i] = $('#truckuploader_'+i).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: ``,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    showDownload: true,
                    formData: {
                        id: i , 
                        reqId: $('#truck_req_id_'+i).val()
                    },
                    onSuccess: function (files, response, xhr, pd) {
                            //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let truck_id = $('#this_event_truck_id').val() ;
                        let this_url = user_id + '/event/' + eventId +'/truck/'+truck_id+ '/'+requiId+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
                    },
                    onLoad:function(obj)
                    {
                        var ev_tr_id = $('#this_event_truck_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_truck_docs')}}",
                            type: 'POST',
                            data: {
                                truckId: ev_tr_id,
                                reqId: $('#truck_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#truck_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#truck_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    },
                });
                $('#truckuploader_'+i+'  div').attr('id', 'truck-upload_'+i);
                $('#truckuploader_'+i+' + div').attr('id', 'truck-file-upload_'+i);
                $("#truck-upload_" + i).css('pointer-events', 'none');
            }
        };

        $('#issued_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });
        $('#expired_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left"
        });

        // $('#time_start').timepicker();
        // $('#time_end').timepicker();

        $('#issued_date').on('changeDate', function (selected) {
            $('#issued_date').valid() || $('#issued_date').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            $('#expired_date').datepicker('setStartDate', minDate);
            $('#expired_date').datepicker('setEndDate', expDate.format("DD-MM-YYYY"));
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });


        const getAreas = (city_id) => {
            $.ajax({
                url: "{{url('company/fetch_areas')}}" + '/' + city_id,
                success: function (result) {
                    // console.log(result)
                    $('#area_id').empty();
                    $('#area_id').append('<option value="">Select</option>');
                    for (let i = 0; i < result.length; i++) {
                        $('#area_id').append('<option value="' + result[i].id + '">' + result[i].area_en + '</option>');

                    }

                }
            });

        };


        function getRequirementsList()
        {
            var id = $('#event_type_id').val();
            var firm = $('#firm_type').val();
            $.ajax({
                url: "{{route('company.event.get_requirements')}}",
                type: "POST", 
                data: { id: id, firm: firm},
                success: function (result) {
                 if(result){
                    $('#documents_required').empty();
                     var res = result;
                     $('#requirements_count').val(res.length);
                     $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Event Permit Required documents</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">{{__('Event Logo')}}</label><p class="reqName">{{__('An image of the Event Logo / Banner')}}</p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">Upload</div></div></div>');
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+( getLangid == 1 ? capitalizeFirst(res[i].requirement_name) : res[i].requirement_name_ar ) +' <span id="cnd_'+j+'"></span></label><p for="" class="reqName">'+(res[i].requirement_description != null ? getLangid == 1 ? capitalizeFirst(res[i].requirement_description) : res[i].requirement_description_ar : '')+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');
                         if(res[i].event_type_requirements[0].is_mandatory == 1)
                         {
                            $('#cnd_'+j).html(' * ');
                            $('#cnd_'+j).removeClass('text-muted').addClass('text-danger');
                         }else {
                            $('#cnd_'+j).html('');
                            $('#cnd_'+j).removeClass('text-danger').addClass('text-muted');
                         }

                         if(res[i].dates_required)
                         {
                            $('#issue_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker mk-disabled" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker mk-disabled" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                         }

                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     uploadFunction();
                     picUploadFunction();
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });

        }

        function getAddtionalRequirementsList(id)
        {
            var url = "{{route('company.event.get_additional_requirements', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (result) {
                 if(result){
                    $('#addi_documents_required').empty();
                     var res = result.additional_requirements;
                     $('#addi_requirements_count').val(res.length);
                     var j =  parseInt($('#requirements_count').val()) + 1 ;
                     if(j != NaN){
                     for(var i = 0; i < res.length; i++){
                         $('#addi_documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+(getLangid == 1 ? capitalizeFirst(res[i].requirement_name) : res[i].requirement_name_ar )+'<span class="text-danger"> * </span></label><p for="" class="reqName">'+(res[i].requirement_description != null ? getLangid == 1 ? capitalizeFirst(res[i].requirement_description) : res[i].requirement_description_ar : '')+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');

                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j).append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+0d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />')
                         }

           
                        j++;
                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

                     }
                     }
                     uploadFunction();
                 }
                }
            });

        }



            function go_back_truck_list()
            {
                $('#edit_food_truck').modal('show');
                $('#edit_one_food_truck').modal('hide');
            }

            const liquorDocUpload = () => {
            var per_doc = $('#liquor_document_count').val();
            // var total = parseInt($('#liquor_additional_doc > div').length);
            for(var i = 1; i <=  parseInt(per_doc);i++){
                    var reqID =  $('#liqour_req_id_'+i).val()  ;
                    liquorDocUploader[i] = $('#liquoruploader_'+i).uploadFile({
                    url: "{{route('event.uploadLiquor')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",       
                    fileName: "liquor_file_"+i,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: ``,
                    showFileSize: false,
                    uploadStr: `{{__('Upload')}}`,
                    dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showDelete: true,
                    showPreview: false,
                    uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                    showDownload: true,
                    formData: {id:  i, reqId: reqID },
                    downloadCallback: function (files, pd) {
                        let user_id = $('#user_id').val();
                        let eventId = $('#event_id').val();
                        let liquor_id = $('#event_liquor_id').val();
                        let this_url = user_id + '/event/' + eventId +'/liquor/'+liquor_id+'/'+reqID+'/'+files;
                        window.open(
                        "{{url('storage')}}"+'/' + this_url,
                        '_blank'
                        );
                    },
                    onLoad:function(obj)
                    {
                        var ev_lq_id = $('#event_liquor_id').val();
                        $.ajax({
                            url: "{{route('event.fetch_this_liquor_docs')}}",
                            type: 'POST',
                            data: {
                                liquor_id: ev_lq_id,
                                reqId: $('#liqour_req_id_'+i).val(),
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if (data) {
                                    let j = 1 ;
                                   for(data of data) {
                                        if(j <= 2 ){
                                        let id = obj[0].id;
                                        let number = id.split("_");
                                        let formatted_issue_date = moment(data.issue_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        let formatted_exp_date = moment(data.expired_date,'YYYY-MM-DD').format('DD-MM-YYYY');
                                        const d = data["path"].split("/");
                                        // var cc = d.splice(4,5);
                                        // let docName =  cc.length > 1 ? cc.join('/') : cc ;
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{url('storage')}}"+'/' + data["path"], '');
                                        if (formatted_issue_date != NaN - NaN - NaN) {
                                            $('#liquor_doc_issue_date_' + number[1]).val(formatted_issue_date).datepicker('update');
                                            $('#liquor_doc_exp_date_' + number[1]).val(formatted_exp_date).datepicker('update');
                                        }
                                        }
                                    j++;
                                   }
                                }
                            }
                        });
                    }
                    
                });
                $('#liquoruploader_'+i+'  div').attr('id', 'liquor-upload_'+i);
                $('#liquoruploader_'+i+' + div').attr('id', 'liquor-file-upload_'+i);
                $("#liquor-upload_" + i).css('pointer-events', 'none');
            }
        };

        function editLiquor(){
            var url = "{{route('event.fetch_liquor_details_by_event_id', ':id')}}";
            url = url.replace(':id', $('#event_id').val());
            $.ajax({
                url:  url,
                success: function (data) {
                    if(data) 
                    {
                        $('#liquor_details').modal('show');
                        $('#event_liquor_id').val(data.event_liquor_id);
                        $('#liquor_details .ajax-file-upload-red').trigger('click');
                        if(data.provided == 1)
                        {
                            checkLiquorVenue(1);
                            $('#liquor_permit_no').val(data.liquor_permit_no);
                            $("input:radio[name='isLiquorVenue'][value='1']").attr('checked', true);
                        }else {
                            checkLiquorVenue(0);
                            $("input:radio[name='isLiquorVenue'][value='0']").attr('checked', true)
                            $('#l_company_name_en').val(data.company_name_en);
                            $('#l_company_name_ar').val(data.company_name_ar);
                            $('#purchase_receipt').val(data.purchase_receipt);
                            $('#liquor_service').val(data.liquor_service);
                            changeLiquorService();
                            $('#liquor_types').val(data.liquor_types);
                            liquorDocUpload();
                        }
                    }
                }
            });
        }

        function checkLiquorVenue(id)
        {
            if(id == 1)
            {
                $('#liquor_provided_form').show();
                $('#liquor_details_form').hide();
                $('#liquor_upload_form').hide();
            }else if(id == 0) {
                $('#liquor_provided_form').hide();
                $('#liquor_details_form').show();
                $('#liquor_upload_form').show();
            }
        }


        function changeLiquorService()
        {
            var service = $('#liquor_service').val();
            if(service == 'limited')
            {
                $('#limited_types').show();
            }else{
                $('#limited_types').hide();
            }
        }
   

        $('#submit_btn').click((e) => {
            var rating = $('#rating').val();
            if(rating)
            {
                    $('#submit_btn').css('pointer-events', 'none');
                    $.ajax({
                        url: "{{route('event.submit_happiness')}}",
                        type: "POST",
                        data: {
                            event_id:$('#event_id').val(),
                            happiness: $('#rating').val(),
                            remarks: $('#remarks').val()
                        },
                        beforeSend: function() {
                            KTApp.blockPage({
                                overlayColor: '#000000',
                                type: 'v2',
                                state: 'success',
                                message: '{{__("Please wait...")}}'
                            });
                        },
                        success: function (result) {
                            if(result.message[0]){
                                window.location.href = result.toURL;
                                KTApp.unblockPage();
                            }
                        }
                    });
                
               
            }else{
                alert("{{__('Please select your experience')}}");
            }
                

        });



        const imageUploadFunction = () => {
            var ImageUploader = $('#image_uploader').uploadFile({
                url: "{{route('event.uploadEventPics')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "image_file",
                multiple: true,
                deleteStr: `<i class="la la-trash"></i>`,
                downloadStr: `<i class="la la-download"></i>`,
                showFileSize: false,
                uploadStr: `{{__('Upload')}}`,
                dragDropStr: "<span><b>{{__('Drag and drop Files')}}</b></span>",
                showFileCounter: false,
                abortStr: '',
                showProgress: false,
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                // showPreview: true,
                showDelete: false,
                showDownload: true,
                uploadButtonClass: 'btn btn-secondary btn-sm ht-20 kt-margin-r-10',
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
                },
                onLoad: function(obj) {
                    var url = "{{route('event.get_uploaded_eventImages', ':id')}}";
                    url = url.replace(':id', $('#event_id').val());
                    $.ajax({
                            // cache: false,
                            url: url,
                            success: function (data) {
                                if (data) {
                                    let j = 1 ;
                                    if(data[0]) {
                                        $('#description').val(data[0].description);
                                    }
                                    for(data of data) {
                                        const d = data["path"].split("/");
                                        let docName = d[d.length - 1];
                                        obj.createProgress(docName, "{{asset('storage')}}"+'/' + data["path"], '');
                                    }
                                }
                            }
                        });
                },
                downloadCallback: function (files, pd) {
                    let user_id = $('#user_id').val();
                    let eventId = $('#event_id').val();
                    let this_url = user_id + '/event/' + eventId +'/pictures/'+files;
                    window.open(
                    "{{url('storage')}}"+'/' + this_url,
                    '_blank'
                    ); 
                },
            });
            $('#image_uploader div').attr('id', 'image-upload');
            $('#image_uploader + div').attr('id', 'image-file-upload');
            $("#image-upload").css('pointer-events', 'none');
        };

</script>

@endsection