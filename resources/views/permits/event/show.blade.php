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
