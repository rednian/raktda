@extends('layouts.app')

@section('title', 'Event Permit Details')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Amend Event Permit
            </h3>
            <span class="text--yellow bg--maroon px-3 ml-3 text-center mr-2">
                <strong>{{$event->permit_number}}
                </strong>
            </span>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                    Back
                </a>

            </div>
            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('event.index')}}#{{$tab}}"
                    class="btn btn--maroon btn-elevate btn-sm kt-font-bold kt-font-transform-u">
                    <i class="la la-arrow-left"></i>
                </a>

            </div>
        </div>
    </div>

    <input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">

    <div class="kt-portlet__body">
        <form action="{{route('event.applyAmend')}}" method="POST">
            @csrf
            <div class="kt-container">
                <div class="event--view-head">

                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">REF
                            NO</label>
                        <span class="col-md-6">{{$event->reference_number}}</span>
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">EVENT
                            NAME</label>
                        <span class="col-md-6">{{$event->name_en}}</span>
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">VENUE NAME
                        </label>
                        <span class="col-md-6">{{$event->venue_en}}</span>
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">ISSUE DATE
                        </label>
                        <input type="text" class="col-md-6 form-control form-control-sm datepicker" name="issued_date"
                            id="issued_date" value="{{date('d-m-Y', strtotime($event->issued_date))}}"
                            onchange="changeExpiry();givWarn()" />
                    </div>
                    @php
                    $issued_date = strtotime($event->issued_date);
                    $expired_date = strtotime($event->expired_date);
                    $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                    @endphp
                    <input type="hidden" id="days" value="{{$diff}}">
                    <input type="hidden" name="event_id" value="{{$event->event_id}}">
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u pr-4">EXPIRY
                            Date
                        </label>
                        <input type="text" class="col-md-6 form-control form-control-sm datepicker"
                            name="disp_expired_date" id="disp_expired_date"
                            value="{{date('d-m-Y', strtotime($event->expired_date))}}" disabled />
                        <input type="hidden" name="expired_date" id="expired_date"
                            value="{{date('d-m-Y', strtotime($event->expired_date))}}" />
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">Area</label>
                        <span class="col-md-6">{{$event->area['area_en']}}</span>
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">START TIME
                        </label>
                        <input type="text" class="col-md-6 form-control form-control-sm" name="time_start"
                            id="time_start" value="{{$event->time_start}}" />
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">END TIME
                        </label>
                        <input type="text" class="col-md-6 form-control form-control-sm" name="time_end" id="time_end"
                            value="{{$event->time_end}}" />
                    </div>
                    <div class="col-md-4 pb-4 row">
                        <label
                            class="col-md-6 text-left event--view-detail-item-title kt-font-transform-u">emirate</label>
                        <span class="col-md-6">{{$event->emirate['name_en']}}</span>
                    </div>
                </div>

                <input type="submit"
                    class="col-md-2 btn btn--yellow btn-sm kt-font-bold kt-font-transform-u float-right" id="submit_btn"
                    value="submit">


        </form>

    </div>
</div>

{{--

            @if(count($eventReq) > 0)
            <div class="event--requirement-files pt-5">
                <table class="table table-hover table-borderless border table-striped">
                    <thead class="text-center">
                        <tr>
                            <th class="text-left">Document Name</th>
                            <th>Issue Date</th>
                            <th>Expiry Date</th>
                            <th>View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($eventReq as $req)
                        <tr>
                            <td style="width:50%;">{{$req->requirement_name}}</td>
<td class="text-center">
    {{$req->pivot['issued_date'] != '0000-00-00' ? date('d-m-Y', strtotime($req->pivot['issued_date'])) : ''}}
</td>
<td class="text-center">
    {{$req->pivot['expired_date'] != '0000-00-00' ? date('d-m-Y', strtotime($req->pivot['expired_date'])) : ''}}
</td>
<td class="text-center">
    <a href="{{asset('storage')}}{{'/'.$req->pivot['path']}}" target="blank" ">
                                    <button class=" btn btn-sm btn-secondary">View
        </button></a>
</td>
</tr>
@endforeach
</tbody>
</table>

</div>
@endif
--}}

@include('permits.event.common.show_warning_modal');



@endsection

@section('script')
<script>
    $('.datepicker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});

        $('#time_start').timepicker();
        $('#time_end').timepicker();

        function changeExpiry(){
            var days = $('#days').val();
            var issued_date = $('#issued_date').val();
            var exp = moment(issued_date, 'DD-MM-YYYY').add(days, 'days').toDate();
            $('#disp_expired_date').val(moment(exp).format('DD-MM-YYYY'));
            $('#expired_date').val(moment(exp).format('DD-MM-YYYY'));
        }

        function givWarn()
        {
            console.log('hiere')
            var from_date = $('#issued_date').val();
            // var exp_date = $('#expired_date').val();
            let start_days_count = $('#settings_event_start_date').val();
            if(from_date)
            {
                var x = moment(from_date, "DD-MM-YYYY");
                // var y = moment(exp_date, "DD-MM-YYYY");
                var to = moment();

                var from = moment([x.format('YYYY'), x.month(), x.format('DD')]);
                // var to = moment([y.format('YYYY'), y.month(), y.format('DD')]);
                var today = moment([to.format('YYYY'), to.month(), to.format('DD')]);

                var diff = from.diff(today, 'days');

                if(diff <= start_days_count)
                {
                    // alert('It will take 10 days to process the permit');
                    $('#showwarning').modal('show');
                }
            }
        }

</script>
@endsection