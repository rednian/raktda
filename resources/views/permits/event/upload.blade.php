@extends('layouts.app')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Upload Docs - Event Permit
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

        <div class="kt-widget5__info">
            <div class="table-responsive pb-2">
                <table class="w-100 table table-borderless">
                    <tr>
                        <th>Name</th>
                        <td>{{$event->name_en}}</td>
                        <th>Name - Ar</th>
                        <td>{{$event->name_ar}}</td>
                        <th>From Date</th>
                        <td>{{$event->issued_date}}</td>
                        <th>To Date</th>
                        <td>{{$event->expired_date}}</td>
                    </tr>
                    <tr>
                        <th>Venue</th>
                        <td>{{$event->venue_en}}</td>
                        <th>Venue - Ar</th>
                        <td>{{$event->venue_ar}}</td>
                        <th>From Time</th>
                        <td>{{$event->time_start}}</td>
                        <th>To Time</th>
                        <td>{{$event->time_end}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="form-group">
            <label>Upload File</label>
            <div></div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>


    </div>

</div>


@endsection
