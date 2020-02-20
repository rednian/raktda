@php
$isDisabled = isset($disabled) ? 'disabled' : '';
$isReadOnly = isset($disabled) ? 'readonly' : '';
@endphp
<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
    <div class="kt-form__section kt-form__section--first">
        @if(isset($edit))
        @component('permits.components.eventcomments', ['staff_comments' => $staff_comments])
        @endcomponent
        @endif
        <form id="eventdetails" action="" novalidate autocomplete="off">
            <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                id="accordionExample5">
                <div class="card">
                    <div class="card-header" id="headingOne6">
                        <div class="card-title show" data-toggle="collapse" data-target="#collapseOne6"
                            aria-expanded="true" aria-controls="collapseOne6">
                            <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">
                                {{__('Event Details')}}
                            </h6>
                        </div>
                    </div>
                    <input type="hidden" id="event_id" value="{{isset($event) ? $event->event_id : ''}}">
                    <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                        data-parent="#accordionExample5">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <section class="kt-form--label-right">

                                        <div class="form-group form-group-sm row">
                                            <label for="event_type_id"
                                                class="col-md-4 col-form-label kt-font-bold col-sm-12 text-left text-lg-right">
                                                {{__('Applicant Type')}} <span class=" text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control form-control-sm" name="firm_type"
                                                        id="firm_type" onchange="getRequirementsList()" {{$isDisabled}}>
                                                        <option value="">{{__('Select')}}</option>
                                                        <option value="corporate"
                                                            {{isset($event) ? $event->firm == 'corporate' ? 'selected' : '' : ''}}>
                                                            {{__('Corporate')}}</option>
                                                        <option value="government"
                                                            {{isset($event) ? $event->firm == 'government' ? 'selected' : '' : ''}}>
                                                            {{__('Government')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="event_type_id"
                                                class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Event Type')}} <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control form-control-sm" name="event_type_id"
                                                        id="event_type_id" placeholder="Type"
                                                        onchange="getRequirementsList();setSubTypes()" {{$isDisabled}}>
                                                        <option value="">{{__('Select')}}</option>
                                                        @foreach ($event_types as $pt)
                                                        <option value="{{$pt->event_type_id}}"
                                                            {{isset($event) ? $event->event_type_id == $pt->event_type_id ? 'selected' : '' : ''}}>
                                                            {{ getLangId() == 1 ? ucwords($pt->name_en) : $pt->name_ar}}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="event_type_id"
                                                class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Event Sub Type')}} <span class="text-danger"
                                                    id="event_sub_type_req"></span>
                                            </label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control form-control-sm"
                                                        name="event_sub_type_id" id="event_sub_type_id" {{$isDisabled}}>
                                                        <option value="">{{__('Select')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group form-group-sm row">
                                            <label for="no_of_audience"
                                                class="col-md-4 col-form-label kt-padding-l-0 kt-font-bold text-right">
                                                {{__('Expected Audience')}} <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <select class="form-control form-control-sm" name="no_of_audience"
                                                        id="no_of_audience" {{$isDisabled}}>
                                                        <option value="">{{__('Select')}}</option>
                                                        <option value="0-100"
                                                            {{isset($event) ? $event->audience_number == '0-100' ? 'selected': '' : ''}}>
                                                            0-100</option>
                                                        <option value="100-500"
                                                            {{isset($event) ? $event->audience_number == '100-500' ? 'selected': '' : ''}}>
                                                            100-500</option>
                                                        <option value="500-1000"
                                                            {{isset($event) ? $event->audience_number == '500-1000' ? 'selected': '' : ''}}>
                                                            500-1000</option>
                                                        <option value="1000&above"
                                                            {{isset($event) ? $event->audience_number == '1000&above' ? 'selected': '' : ''}}>
                                                            {{__('1000 & above')}}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="description_en"
                                                class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Event Details')}} <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <textarea type="text" class="form-control form-control-sm"
                                                        name="description_en" id="description_en" rows="3" dir="ltr"
                                                        maxlength="255"
                                                        {{$isReadOnly}}>{{isset($event) ? $event->description_en : ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" id="sel_event_sub_type"
                                            value="{{isset($event) ? $event->event_type_sub_id : ''}}">


                                        <div class="form-group form-group-sm row">
                                            <label class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Food Truck')}}
                                                ?</label>
                                            <div class="col-lg-8">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio ">
                                                        <input type="radio" name="isTruck" onclick="checkTruck(1)"
                                                            value="1"
                                                            {{isset($event) ? $event->is_truck == '1' ? 'checked': '' : ''}}
                                                            {{$isDisabled}}>
                                                        {{__('Yes')}}
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="isTruck" onclick="checkTruck(0)"
                                                            value="0"
                                                            {{isset($event) ? $event->is_truck == '0' ? 'checked': '' : 'checked'}}
                                                            {{$isDisabled}}>
                                                        {{__('No')}}
                                                        <span></span>
                                                    </label>
                                                    <i class="fa fa-edit fa-2x pull-right" id="truckEditBtn"
                                                        onclick="editTruck()"></i>
                                                </div>
                                                <input type="hidden" id="prev_val_isTruck" value="0">
                                            </div>
                                        </div>

                                    </section>
                                </div>
                                <div class="col-6">
                                    <section class="kt-form--label-right">

                                        <div class="form-group form-group-sm row">
                                            <label for="owner_name"
                                                class="col-md-4 col-form-label kt-font-bold text-right">{{__('Owner Name')}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm" dir="ltr"
                                                        name="owner_name" id="owner_name" maxlength="255"
                                                        value="{{isset($event) ? $event->owner_name : ''}}"
                                                        {{$isReadOnly}}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="owner_name"
                                                class="col-md-4 col-form-label kt-font-bold text-right">{{__('Owner Name (AR)')}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="owner_name_ar" dir="rtl" id="owner_name_ar"
                                                        maxlength="255"
                                                        value="{{isset($event) ? $event->owner_name_ar : ''}}"
                                                        {{$isReadOnly}}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="name_en"
                                                class="col-md-4 col-form-label kt-font-bold text-right">{{__('Event Name')}}
                                                <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="name_en" dir="ltr" id="name_en" maxlength="255"
                                                        value="{{isset($event) ? $event->name_en : ''}}"
                                                        {{$isReadOnly}}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for="name_ar"
                                                class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Event Name (AR)')}} <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control form-control-sm "
                                                        name="name_ar" dir="rtl" id="name_ar" maxlength="255"
                                                        value="{{isset($event) ? $event->name_ar : ''}}"
                                                        {{$isReadOnly}}>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label for=" description_ar"
                                                class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Event Details (AR)')}} <span class="text-danger">*</span></label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <textarea class="form-control form-control-sm" rows="3"
                                                        name="description_ar" dir="rtl" id="description_ar"
                                                        maxlength="255"
                                                        {{$isReadOnly}}>{{isset($event) ? $event->description_ar : ''}}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group form-group-sm row">
                                            <label class="col-md-4 col-form-label kt-font-bold text-right">
                                                {{__('Liquor')}} ?</label>
                                            <div class="col-lg-8">
                                                <div class="kt-radio-inline">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="isLiquor" onclick="checkLiquor(1)"
                                                            value="1"
                                                            {{isset($event) ? $event->is_liquor == '1' ? 'checked' : '' : ''}}
                                                            {{$isDisabled}}>
                                                        {{__('Yes')}}
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="isLiquor" onclick="checkLiquor(0)"
                                                            value="0"
                                                            {{isset($event) ? $event->is_liquor == '0' ? 'checked' : '' : 'checked'}}
                                                            {{$isDisabled}}>
                                                        {{__('No')}}
                                                        <span></span>
                                                    </label>
                                                    <i class="fa fa-edit fa-2x pull-right" id="liquorEditBtn"
                                                        onclick="editLiquor()"></i>
                                                </div>
                                                <input type="hidden" id="prev_val_isLiquor"
                                                    value="{{isset($event) ? $event->is_liquor : 0}}">
                                            </div>
                                        </div>

                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                id="accordionExample6">
                <div class="card">
                    <div class="card-header" id="headingTwo6">
                        <div class="card-title show" data-toggle="collapse" data-target="#collapseTwo6"
                            aria-expanded="false" aria-controls="collapseTwo6">
                            <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">
                                {{__('Date Details')}}
                            </h6>
                        </div>
                    </div>

                    <div class="collapse show" aria-labelledby="headingTwo6" data-parent="#accordionExample6"
                        id="collapseTwo6">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-3 form-group form-group-xs ">
                                    <label for="issued_date" class=" col-form-label kt-font-bold text-right">
                                        {{__('From Date')}} <span class="text-danger">*</span></label>
                                    <div class="input-group input-group-sm date">
                                        <div class="kt-input-icon kt-input-icon--right">
                                            <input type="text"
                                                class="form-control form-control-sm {{isset($disabled) ? 'mk-disabled' : ''}}"
                                                name="issued_date" id="issued_date" placeholder="DD-MM-YYYY"
                                                onchange="givWarn();check_duration()"
                                                value="{{isset($event) ? date('d-m-Y',strtotime($event->issued_date)) : ''}}"
                                                {{$isReadOnly}} />
                                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="col-md-3 form-group form-group-xs">
                        <label class="col-form-label">{{__('From Time')}} <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm timepicker">
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input class="form-control form-control-sm"
                                            value="{{date('h:i a', strtotime('10:00 AM'))}}" name="time_start"
                                            id="time_start" type="text" />
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                            <span>
                                                <i class="la la-clock-o"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>

                            </div> --}}



                            <div class="col-md-3 form-group form-group-xs ">
                                <label for="expired_date"
                                    class=" col-form-label kt-font-bold text-right">{{__('To Date')}}
                                    <span class="text-danger">*</span></label>
                                <div class="input-group input-group-sm date">
                                    <div class="kt-input-icon kt-input-icon--right">
                                        <input type="text"
                                            class="form-control form-control-sm {{isset($disabled) ? 'mk-disabled' : ''}}"
                                            name="expired_date" id="expired_date" onchange="check_duration()"
                                            placeholder="DD-MM-YYYY"
                                            value="{{isset($event) ? date('d-m-Y',strtotime($event->expired_date)) : ''}}">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                            <span>
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            {{-- 
                    <div class="col-md-3 form-group form-group-xs">
                        <label class="col-form-label">{{__('To Time')}} <span class="text-danger">*</span></label>

                            <div class="input-group input-group-sm timepicker">
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input class="form-control form-control-sm"
                                        value="{{date('h:i a', strtotime('5:00 PM'))}}" name="time_end" id="time_end"
                                        type="text" />
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                        <span>
                                            <i class="la la-clock-o"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-md-3 form-group form-group-xs ">
                            <label for="duration" class=" col-form-label kt-font-bold text-right">{{__('Duration')}}
                                <span class="text-danger">*</span></label>
                            <div class="input-group input-group-sm date">
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input type="text" class="form-control form-control-sm mk-disabled"
                                        id="date_duration" readonly>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
    </div>
</div>
</section>


<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border" id="accordionExample8">
    <div class="card">
        <div class="card-header" id="headingTwo6">
            <div class="card-title show" data-toggle="collapse" data-target="#collapseTwo4" aria-expanded="false"
                aria-controls="collapseTwo6">
                <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">
                    {{__('Location & Map Details')}}
                </h6>
            </div>
        </div>

        <div class="collapse show" aria-labelledby="headingTwo6" data-parent="#accordionExample8" id="collapseTwo4">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-5 form-group form-group-xs ">
                        <label for="venue_en" class=" col-form-label kt-font-bold text-right">
                            {{__('Venue')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="venue_en" dir="ltr" id="venue_en"
                            maxlength="255" value="{{isset($event) ? $event->venue_en : ''}}" {{$isReadOnly}}>

                    </div>

                    <div class="col-md-5 form-group form-group-xs ">
                        <label for="venue_ar" class=" col-form-label kt-font-bold text-right">
                            {{__('Venue (AR)')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" name="venue_ar" dir="rtl" id="venue_ar"
                            maxlength="255" value="{{isset($event) ? $event->venue_ar : ''}}" {{$isReadOnly}}>
                    </div>



                    <input type="hidden" name="emirate_id" id="emirate_id" value="5">
                    <input type="hidden" name="country_id" id="country_id" value="232">


                    <div class="col-md-2 form-group form-group-xs ">
                        <label for="area_id" class=" col-form-label kt-font-bold text-right">{{__('Area')}}
                            <span class="text-danger">*</span>
                        </label>
                        <select class="  form-control form-control-sm " name="area_id" id="area_id" {{$isDisabled}}>
                            <option value="">{{__('Select')}}</option>
                            @foreach($areas as $ar)
                            <option value="{{$ar->id}}"
                                {{isset($event) ? $ar->id == $event->area_id ? 'selected' : '' : '' }}>
                                {{$ar->area_en}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 col-sm-12 form-group form-group-xs ">
                        <label for="address" class=" col-form-label kt-font-bold text-right">{{__('Address')}}
                            <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control form-control-sm map-input" name="address"
                            id="address-input" dir="ltr" maxlength="255"
                            value="{{isset($event) ? $event->address : ''}}" {{$isReadOnly}}>
                    </div>

                    <div class="col-md-4 form-group form-group-xs ">
                        <label for="street" class=" col-form-label kt-font-bold text-right">
                            {{__('Street')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" dir="ltr" name="street" id="street"
                            value="{{isset($event) ? $event->street : ''}}" {{$isReadOnly}}>
                    </div>

                    <input type="hidden" id="full_address" name="full_address"
                        value="{{isset($event) ? $event->full_address : ''}}">

                    <div class="col-md-4 form-group form-group-xs ">
                        <label for="longitude" class=" col-form-label kt-font-bold text-right">
                            {{__('Longitude')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" dir="ltr" name="longitude"
                            id="longitude" value="{{isset($event) ? $event->longitude : ''}}" {{$isReadOnly}}>
                    </div>

                    <div class="col-md-4 form-group form-group-xs ">
                        <label for="latitude" class=" col-form-label kt-font-bold text-right">
                            {{__('Latitude')}} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control form-control-sm" dir="ltr"
                            value="{{isset($event) ? $event->latitude : ''}}" name="latitude" id="latitude"
                            {{$isReadOnly}}>
                    </div>

                    <div class="col-md-4 form-group form-group-xs ">
                        <label for="addi_loc_info" class=" col-form-label kt-font-bold text-right">
                            {{__('Additional Location Information')}}</label>
                        <textarea class="form-control form-control-sm" name="addi_loc_info" id="addi_loc_info" dir="ltr"
                            maxlength="255"
                            {{$isReadOnly}}>{{isset($event) ? $event->additional_location_info ? $event->additional_location_info : '' : ''}}</textarea>
                    </div>

                </div>
            </div>
            <div id="address-map-container" style="width:100%;height:200px;padding:15px;">
                <div style="width: 100%; height: 100%" id="map"></div>
            </div>
        </div>
</section>
</form>
</div>
</div>

<input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">

<script>
    function check_duration() {
        var iss = $('#issued_date').val();  
        var exp = $('#expired_date').val();
        if(iss && exp){
            var diff = dayCount(iss, exp) + 1;
            var exp_date = moment(iss, 'DD-MM-YYYY').format();
            $('#expired_date').datepicker('setStartDate', exp_date);
            $('#date_duration').val(diff + (diff > 1 ? ' days' : ' day'));
        }
    }
</script>