@extends('layouts.app')

@section('title', 'Edit Event Permit')

@section('content')



<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">Edit Event Permit
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


        <form action="{{route('event.update', $event)}}" method="POST">
            @method('PATCH')
            @csrf
            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                <div class="kt-form__section kt-form__section--first">
                    <div class="kt-wizard-v3__form">
                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
                            <div class="card">
                                <div class="card-header" id="headingOne6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6"
                                        aria-expanded="true" aria-controls="collapseOne6">
                                        <h6 class="kt-font-transform-u">Event
                                            information</h6>
                                    </div>
                                </div>

                                <input type="hidden" name="event_id" value="{{$event->event_id}}">
                                <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                    data-parent="#accordionExample5">
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="event_type_id"
                                                    class=" col-form-label kt-font-bold text-right">
                                                    Event Type <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <select
                                                    class="form-control form-control-sm {{$errors->has('event_type_id') ? 'is-invalid' : ''}}"
                                                    name="event_type_id" id="event_type_id" placeholder="Type">
                                                    <option value="">Select</option>
                                                    @foreach ($event_types as $pt)
                                                    <option value="{{$pt->event_type_id}}"
                                                        {{$pt->event_type_id == $event->event_type_id ? 'selected' : ''}}>
                                                        {{ucwords($pt->name_en)}}</option>
                                                    @endforeach
                                                </select>

                                            </div>


                                            <div class="col-md-4 form-group form-group-sm">
                                                <label for="name_en"
                                                    class=" col-form-label kt-font-bold text-right">Event
                                                    Name <small>( <span class="text-danger">required
                                                        </span>)</small></label>
                                                <input type="text"
                                                    class="form-control form-control-sm {{$errors->has('name_en') ? 'is-invalid' : ''}}"
                                                    name="name_en" id="name_en" placeholder="Event Name"
                                                    value="{{$event->name_en}}">
                                            </div>

                                            <div class=" col-md-4 form-group form-group-sm">
                                                <label for="name_ar"
                                                    class=" col-form-label kt-font-bold text-right">Event
                                                    Name - Ar<small>( <span class="text-danger">required
                                                        </span>)</small></label>
                                                <input type="text"
                                                    class="form-control form-control-sm {{$errors->has('name_ar') ? 'is-invalid' : ''}}"
                                                    name="name_ar" id="name_ar" placeholder="Event Name"
                                                    value="{{$event->name_ar}}">
                                            </div>

                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="issued_date"
                                                    class=" col-form-label kt-font-bold text-right">From
                                                    Date <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control form-control-sm {{$errors->has('issued_date') ? 'is-invalid' : ''}}"
                                                        name="issued_date" id="issued_date" placeholder="From Date"
                                                        value="{{$event->issued_date}}">
                                                </div>
                                            </div>


                                            <div class="col-md-4 form-group form-group-sm">
                                                <label class="col-form-label">From
                                                    Time <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <div class="input-group timepicker">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="la la-clock-o"></i>
                                                        </span>
                                                    </div>
                                                    <input
                                                        class="form-control form-control-sm {{$errors->has('time_start') ? 'is-invalid' : ''}}"
                                                        name="time_start" id="time_start" type="text"
                                                        value="{{$event->time_start}}" />
                                                </div>

                                            </div>

                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="venue_en" class=" col-form-label kt-font-bold text-right">
                                                    Venue <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <input type="text"
                                                    class="form-control form-control-sm {{$errors->has('venue_en') ? 'is-invalid' : ''}}"
                                                    name="venue_en" id="venue_en" placeholder="Venue"
                                                    value={{$event->venue_en}}>
                                            </div>


                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="expired_date"
                                                    class=" col-form-label kt-font-bold text-right">To
                                                    Date <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text"
                                                        class="form-control form-control-sm {{$errors->has('expired_date') ? 'is-invalid' : ''}}"
                                                        name="expired_date" id="expired_date" placeholder="To Date"
                                                        value={{$event->expired_date}}>
                                                </div>
                                            </div>

                                            <div class="col-md-4 form-group form-group-sm">
                                                <label class="col-form-label">To Time <small>( <span
                                                            class="text-danger">required</span>
                                                        )</small></label>

                                                <div class="input-group timepicker">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="la la-clock-o"></i>
                                                        </span>
                                                    </div>
                                                    <input
                                                        class="form-control form-control-sm {{$errors->has('time_end') ? 'is-invalid' : ''}}"
                                                        value="{{$event->time_end}}" name="time_end" id="time_end"
                                                        type="text" />
                                                </div>

                                            </div>



                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="venue_ar" class=" col-form-label kt-font-bold text-right">
                                                    Venue - Ar <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <input type="text"
                                                    class="form-control form-control-sm {{$errors->has('venue_ar') ? 'is-invalid' : ''}}"
                                                    name="venue_ar" id="venue_ar" placeholder="Venue"
                                                    value={{$event->venue_ar}}>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">

                            <div class="card">
                                <div class="card-header" id="headingTwo6">
                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6"
                                        aria-expanded="false" aria-controls="collapseTwo6">
                                        <h6 class="kt-font-transform-u">Contact
                                            information
                                        </h6>
                                    </div>
                                </div>
                                <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6"
                                    data-parent="#accordionExample6">
                                    <div class="card-body">

                                        <div class="row">


                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="address"
                                                    class=" col-form-label kt-font-bold text-right">Address
                                                    <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <input type="text" class="form-control form-control-sm " name="address"
                                                    id="address" placeholder="Address">
                                            </div>

                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="emirate_id"
                                                    class=" col-form-label kt-font-bold text-right">Emirate
                                                    <small>( optional )</small></label>
                                                <select class="form-control form-control-sm" name="emirate_id"
                                                    id="emirate_id" onchange="getAreas(this.value)">
                                                    <option value="">Select</option>
                                                    @foreach($emirates as $em)
                                                    <option value="{{$em->id}}"
                                                        {{$em->id == $event->emirate_id ? 'selected' : ''}}>
                                                        {{$em->name_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="area_id"
                                                    class=" col-form-label kt-font-bold text-right">Area
                                                    <small>( optional )</small></label>
                                                <select class="  form-control form-control-sm " name="area_id"
                                                    id="area_id">
                                                    <option value="">Select</option>
                                                    @foreach($areas as $ar)
                                                    <option value="{{$ar->id}}"
                                                        {{$ar->id == $event->area_id ? 'selected' : ''}}>
                                                        {{$ar->area_en}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-md-4 form-group form-group-sm ">
                                                <label for="country_id"
                                                    class=" col-form-label kt-font-bold text-right">Country
                                                    <small>( <span class="text-danger">required</span>
                                                        )</small></label>
                                                <select
                                                    class="form-control form-control-sm {{$errors->has('country_id') ? 'is-invalid' : ''}}"
                                                    name="country_id" id="country_id">
                                                    {{--   - class for search in select  --}}
                                                    <option value="">Select</option>
                                                    @foreach ($countries as $ct)
                                                    <option value="{{$ct->country_id}}"
                                                        {{$event->country_id == $ct->country_id ? 'selected' : ''}}>
                                                        {{$ct->name_en}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                        </div>


                                    </div>

                                </div>

                            </div>

                            <button
                                class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u kt-pull-right"
                                data-ktwizard-type="action-submit" id="submit_btn">
                                Submit
                            </button>

        </form>




    </div>


</div>



</div>
</div>
</div>

</div>

@endsection

@section('scripts')
<script>
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

        $('#time_start').timepicker();
        $('#time_end').timepicker();

        $('#issued_date').on('changeDate', function (selected) {
            $('#issued_date').valid() || $('#issued_date').removeClass('invalid').addClass('success');
            var minDate = new Date(selected.date.valueOf());
            $('#expired_date').datepicker('setStartDate', minDate);
        });
        $('#expired_date').on('changeDate', function (ev) {
            $('#expired_date').valid() || $('#expired_date').removeClass('invalid').addClass('success');
        });
</script>
@endsection
