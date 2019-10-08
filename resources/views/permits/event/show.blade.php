@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Event Permit Details
            </h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">

                <a href="{{url('company/event')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                    Back
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{url('company/event')}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-angle-left"></i>
                </a>

            </div>
        </div>
    </div>

    {{-- {{dd($events)}} --}}

    <div class="kt-portlet__body">


        <div class="kt-container">
            <div class="event--view-head">
                <h1>{{$event->reference_number}}</h1>
                <div class="event--view-location">
                    <div>{{$event->venue_en}} {{$event->venue_ar}} </div>
                    <div>{{$event->area['area_en']}}</div>
                    <div>{{$event->emirate['name_en']}}</div>
                    <div>{{$event->country['name_en']}}</div>
                </div>
            </div>
            <div class="event--view-details">
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">NAME</span>
                    <span class="event--view-detail-item-value">{{$event->name_en}} <br> {{$event->name_ar}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">ISSUED DATE / TIME</span>
                    <span class="event--view-detail-item-value">{{$event->issued_date}} <br>
                        {{$event->time_start}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">EXPIRY DATE / TIME</span>
                    <span class="event--view-detail-item-value">{{$event->expired_date}} <br>
                        {{$event->time_end}}</span>
                </div>
                <div class="event--view-detail-item">
                    <span class="event--view-detail-item-title">ADDRESS</span>
                    <span class="event--view-detail-item-value">{{$event->address}}</span>
                </div>
            </div>
            <!--
            <div class="kt-invoice__body">
                <div class="kt-invoice__container">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>DESCRIPTION</th>
                                    <th>HOURS</th>
                                    <th>RATE</th>
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Creative Design</td>
                                    <td>80</td>
                                    <td>$40.00</td>
                                    <td>$3200.00</td>
                                </tr>
                                <tr>
                                    <td>Front-End Development</td>
                                    <td>120</td>
                                    <td>$40.00</td>
                                    <td>$4800.00</td>
                                </tr>
                                <tr>
                                    <td>Back-End Development</td>
                                    <td>210</td>
                                    <td>$60.00</td>
                                    <td>$12600.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
            {{-- <div class="kt-invoice__footer">
                    <div class="kt-invoice__container">
                        <div class="kt-invoice__bank">
                            <div class="kt-invoice__title">BANK TRANSFER</div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__label">Account Name:</span>
                                <span class="kt-invoice__value">Barclays UK</span></span>
                            </div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__label">Account Number:</span>
                                <span class="kt-invoice__value">1234567890934</span></span>
                            </div>
                            <div class="kt-invoice__item">
                                <span class="kt-invoice__label">Code:</span>
                                <span class="kt-invoice__value">BARC0032UK</span></span>
                            </div>
                        </div>
                        <div class="kt-invoice__total">
                            <span class="kt-invoice__title">TOTAL AMOUNT</span>
                            <span class="kt-invoice__price">$20.600.00</span>
                            <span class="kt-invoice__notice">Taxes Included</span>
                        </div>
                    </div>
                </div> --}}
            {{-- <div class="kt-invoice__actions">
                            <div class="kt-invoice__container">
                                <button type="button" class="btn btn-label-brand btn-bold"
                                    onclick="window.print();">Download Invoice</button>
                                <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Print
                                    Invoice</button>
                            </div>
                        </div> --}}

        </div>

        {{--

        <div class="d-flex">

            <div class="col-md-6">
                <div class="form-group form-group-xs row">
<label class="col-4 col-form-label">Reference Number :</label>
<div class="col-8">
    <span class="form-control-plaintext kt-font-bolder">{{$event->reference_number}}</span>
    </div>
</div>
<div class="form-group form-group-xs row">
    <label class="col-4 col-form-label">Name :</label>
    <div class="col-8">
        <span class="form-control-plaintext kt-font-bolder">{{$event->name_en}}</span>
    </div>
</div>
<div class="form-group form-group-xs row">
    <label class="col-4 col-form-label">From Date :</label>
    <div class="col-8">
        <span class="form-control-plaintext kt-font-bolder">{{$event->issued_date}}</span>
    </div>
</div>
<div class="form-group form-group-xs row">
    <label class="col-4 col-form-label">From Time :</label>
    <div class="col-8">
        <span class="form-control-plaintext kt-font-bolder">{{$event->time_start}}</span>
    </div>
</div>
<div class="form-group form-group-xs row">
    <label class="col-4 col-form-label">Venue :</label>
    <div class="col-8">
        <span class="form-control-plaintext kt-font-bolder">{{$event->venue_en}}</span>
    </div>
</div>

<div class="form-group form-group-xs row">
    <label class="col-4 col-form-label">Address :</label>
    <div class="col-8">
        <span class="form-control-plaintext kt-font-bolder">{{$event->address}}</span>
    </div>
</div>
<div class="form-group form-group-xs row">
    <label class="col-4 col-form-label">Area :</label>
    <div class="col-8">
        <span class="form-control-plaintext kt-font-bolder">{{$event->area['area_en']}}</span>
    </div>
</div>

</div>

<div class="col-md-6">
    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">Status:</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->status}}</span>
        </div>
    </div>
    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">Name - Ar:</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->name_ar}}</span>
        </div>
    </div>
    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">To Date:</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->expired_date}}</span>
        </div>
    </div>
    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">To Time:</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->time_end}}</span>
        </div>
    </div>
    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">Venue - Ar:</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->venue_ar}}</span>
        </div>
    </div>

    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">Emirate :</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->emirate['name_en']}}</span>
        </div>
    </div>

    <div class="form-group form-group-xs row">
        <label class="col-4 col-form-label">Country :</label>
        <div class="col-8">
            <span class="form-control-plaintext kt-font-bolder">{{$event->country['name_en']}}</span>
        </div>
    </div>

</div>

--}}
</div>

{{--
        <span>From Date:</span>&emsp;
        <span class="kt-font-info"></span>&emsp;&emsp;
        <span>To Date:</span>&emsp;
        <span class="kt-font-info">{{date('d-M-Y',strtotime($events->expired_date))}}</span>&emsp;&emsp;
<span>Venue:</span>&emsp;
<span class="kt-font-info">{{$events->venue_en}}</span>&emsp;&emsp;
<span>Reference No:</span>&emsp;
<span class="kt-font-info">{{$events->reference_number}}</span>&emsp;&emsp; --}}





</div>

@endsection
