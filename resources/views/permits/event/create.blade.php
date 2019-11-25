@extends('layouts.app')

@section('title', 'Add Event Permit - Smart Government Rak')

@section('content')

<link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->flush())}} --}}
{{-- {{dd(session()->all())}} --}}

<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->

                @include('permits.event.common.nav')

                <!--end: Form Wizard Nav -->
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                {{-- <div class="kt-form p-0 pb-5" id="kt_form" > --}}
                <div class="kt-form w-100 px-5" id="kt_form">
                    <!--begin: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <!--begin::Accordion-->
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                    <div class="card">
                                        <div class="card-header" id="headingThree6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseThree6" aria-expanded="false"
                                                aria-controls="collapseThree6">
                                                <h6 class="kt-font-transform-u"> {{__('Permit Fee')}}</h6>
                                            </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>{{__('Event Type')}}</th>
                                                        <th class="text-right">{{__('Fee')}} / {{__('Day')}} (AED)</th>
                                                    </tr>
                                                    @foreach($event_types as $pt)
                                                    <tr>
                                                        <td>{{$pt->name_en}}</td>
                                                        <td class="text-right">{{number_format($pt->amount,2)}}</td>
                                                    </tr>
                                                    @endforeach
                                                </table>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingFour6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseFour6" aria-expanded="false"
                                                aria-controls="collapseFour6">
                                                <h6 class="kt-font-transform-u">Rules and Conditions</h6>
                                            </div>
                                        </div>
                                        <div id="collapseFour6" class="collapse" aria-labelledby="headingFour6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

                                            </div>
                                        </div>
                                    </div>
                                    <label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
                                        <input type="checkbox" id="agree" name="agree">
                                        {{__('I Read and understand all service rules and agree to continue submitting it.')}}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <form id="eventdetails" action="" novalidate autocomplete="off">
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">Event Details</h6>
                                                </div>
                                            </div>
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#accordionExample5">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Type')}} <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-control form-control-sm"
                                                                name="event_type_id" id="event_type_id"
                                                                placeholder="Type"
                                                                onchange="getRequirementsList(this.value)">
                                                                <option value="">{{__('Select')}}</option>
                                                                @foreach ($event_types as $pt)
                                                                <option value="{{$pt->event_type_id}}">
                                                                    {{ucwords($pt->name_en)}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>


                                                        <div class="col-md-4 form-group form-group-xs">
                                                            <label for="name_en"
                                                                class=" col-form-label kt-font-bold text-right">{{__('Event Name')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm"
                                                                name="name_en" id="name_en"
                                                                placeholder="{{__('Event Name')}}">
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs">
                                                            <label for="name_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Event Name - Ar')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="name_ar" dir="rtl" id="name_ar"
                                                                placeholder="{{__('Event Name - Ar')}}">
                                                        </div>



                                                        <div class="col-md-4 form-group form-group-xs ">
                                                            <label for="description_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('Description')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <textarea type="text" class="form-control form-control-sm"
                                                                name="description_en" id="description_en"
                                                                placeholder="{{__('Description')}}" rows="1"
                                                                style="resize:none"></textarea>
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-xs ">
                                                            <label for=" description_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Description - Ar <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control form-control-sm"
                                                                name="description_ar" dir="rtl" id="description_ar"
                                                                placeholder="Description - Ar" rows="1"
                                                                style="resize:none"></textarea>
                                                        </div>



                                                        <div class="col-md-4  form-group form-group-xs ">
                                                            <label class=" col-form-label kt-font-bold text-right">
                                                                Do you have any Food truck ?</label>
                                                            <div class="kt-radio-inline">
                                                                <label class="kt-radio kt-radio--solid">
                                                                    <input type="radio" name="isTruck" value="1"
                                                                        onclick="checkTruck(1)"> Yes
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio kt-radio--solid">
                                                                    <input type="radio" name="isTruck" value="0" checked
                                                                        onclick="checkTruck(0)"> No
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-xs "
                                                            id="how_many_div">
                                                            <label for="no_of_trucks"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                How Many ?<span class="text-danger">*</span></label>
                                                            <select class="form-control form-control-sm"
                                                                name="no_of_trucks" id="no_of_trucks">
                                                                <option value="">{{__('Select')}}</option>
                                                                @for($i = 1;$i < 15; $i++) <option value="{{$i}}">
                                                                    {{$i}}
                                                                    </option>
                                                                    @endfor
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        <div class="card kt-margin-t-5">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title show" data-toggle="collapse"
                                                    data-target="#collapseTwo6" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u kt-font-dark">Date Details
                                                    </h6>
                                                </div>
                                            </div>

                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#accordionExample6" id="collapseTwo6">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-3 form-group form-group-xs ">
                                                            <label for="issued_date"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                {{__('From Date')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm date">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="issued_date" id="issued_date"
                                                                        placeholder="{{__('From Date')}}" />
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-3 form-group form-group-xs">
                                                            <label class="col-form-label">{{__('From Time')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm timepicker">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input class="form-control form-control-sm"
                                                                        value="{{date('h:i a', strtotime('10:00 AM'))}}"
                                                                        name="time_start" id="time_start" type="text" />
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-clock-o"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>



                                                        <div class="col-md-3 form-group form-group-xs ">
                                                            <label for="expired_date"
                                                                class=" col-form-label kt-font-bold text-right">{{__('To Date')}}<span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group input-group-sm date">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="expired_date" id="expired_date"
                                                                        placeholder="{{__('To Date')}}">
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-calendar"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 form-group form-group-xs">
                                                            <label class="col-form-label">{{__('To Time')}}<span
                                                                    class="text-danger">*</span></label>

                                                            <div class="input-group input-group-sm timepicker">
                                                                <div class="kt-input-icon kt-input-icon--right">
                                                                    <input class="form-control form-control-sm"
                                                                        value="{{date('h:i a', strtotime('5:00 PM'))}}"
                                                                        name="time_end" id="time_end" type="text" />
                                                                    <span
                                                                        class="kt-input-icon__icon kt-input-icon__icon--right">
                                                                        <span>
                                                                            <i class="la la-clock-o"></i>
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                            </div>

                                                        </div>



                                                    </div>
                                                </div>
                                            </div>



                                            <div class="card kt-margin-t-5">
                                                <div class="card-header" id="headingTwo6">
                                                    <div class="card-title show" data-toggle="collapse"
                                                        data-target="#collapseTwo5" aria-expanded="false"
                                                        aria-controls="collapseTwo6">
                                                        <h6 class="kt-font-transform-u kt-font-dark">Location Details
                                                        </h6>
                                                    </div>
                                                </div>

                                                <div class="collapse show" aria-labelledby="headingTwo6"
                                                    data-parent="#accordionExample6" id="collapseTwo5">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-6 form-group form-group-xs ">
                                                                <label for="venue_en"
                                                                    class=" col-form-label kt-font-bold text-right">
                                                                    {{__('Venue')}} <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="venue_en" id="venue_en"
                                                                    placeholder="{{__('Venue')}}">

                                                            </div>

                                                            <div class="col-md-6 form-group form-group-xs ">
                                                                <label for="venue_ar"
                                                                    class=" col-form-label kt-font-bold text-right">
                                                                    Venue - Ar <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    name="venue_ar" dir="rtl" id="venue_ar"
                                                                    placeholder="Venue - Ar">
                                                            </div>




                                                            <div class="col-md-4 form-group form-group-xs ">
                                                                <label for="emirate_id"
                                                                    class=" col-form-label kt-font-bold text-right">{{__('Emirate')}}
                                                                </label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    value="Rasal Khaimah" readonly>
                                                                <input type="hidden" name="emirate_id" id="emirate_id"
                                                                    value="5">
                                                            </div>


                                                            <div class="col-md-4 form-group form-group-xs ">
                                                                <label for="area_id"
                                                                    class=" col-form-label kt-font-bold text-right">{{__('Area')}}
                                                                </label>
                                                                <select class="  form-control form-control-sm "
                                                                    name="area_id" id="area_id">
                                                                    <option value="">{{__('Select')}}</option>
                                                                    @foreach($areas as $ar)
                                                                    <option value="{{$ar->id}}">
                                                                        {{$ar->area_en}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-4 form-group form-group-xs ">
                                                                <label for="country_id"
                                                                    class=" col-form-label kt-font-bold text-right">{{__('Country')}}
                                                                </label>
                                                                <input type="text" class="form-control form-control-sm"
                                                                    value="United Arab Emirates" readonly>
                                                                <input type="hidden" name="country_id" id="country_id"
                                                                    value="232">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card kt-margin-t-5">
                                                    <div class="card-header" id="headingTwo6">
                                                        <div class="card-title show" data-toggle="collapse"
                                                            data-target="#collapseTwo4" aria-expanded="false"
                                                            aria-controls="collapseTwo6">
                                                            <h6 class="kt-font-transform-u kt-font-dark">Map
                                                                Details
                                                            </h6>
                                                        </div>
                                                    </div>

                                                    <div class="collapse show" aria-labelledby="headingTwo6"
                                                        data-parent="#accordionExample6" id="collapseTwo4">
                                                        <div class="card-body">
                                                            <div class="row">

                                                                <div
                                                                    class="col-md-8 col-sm-12 form-group form-group-xs ">
                                                                    <label for="address"
                                                                        class=" col-form-label kt-font-bold text-right">Address
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm map-input"
                                                                        name="address" id="address-input"
                                                                        placeholder="Address" value="">
                                                                </div>

                                                                <div class="col-md-4 form-group form-group-xs ">
                                                                    <label for="street"
                                                                        class=" col-form-label kt-font-bold text-right">
                                                                        Street<span class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="street" id="street" placeholder="Street">
                                                                </div>

                                                                <input type="hidden" id="full_address"
                                                                    name="full_address">

                                                                <div class="col-md-6 form-group form-group-xs ">
                                                                    <label for="longitude"
                                                                        class=" col-form-label kt-font-bold text-right">
                                                                        Longitude <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="longitude" id="longitude"
                                                                        placeholder="Longitude">
                                                                </div>

                                                                <div class="col-md-6 form-group form-group-xs ">
                                                                    <label for="latitude"
                                                                        class=" col-form-label kt-font-bold text-right">
                                                                        Latitude <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control form-control-sm"
                                                                        name="latitude" id="latitude"
                                                                        placeholder="Latitude">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div id="address-map-container" style="width:100%;height:200px;padding:15px;">
                                    <div style="width: 100%; height: 100%" id="map"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="settings_event_start_date" value="{{getSettings()->event_start_after}}">

                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-form__section kt-form__section--first ">
                            <div class="kt-wizard-v3__form">
                                <form id="documents_required" method="post">

                                </form>
                                {{-- <form id="added_documents" method="post">
                                    <h5 class="text-dark kt-font-bold text-underline kt-margin-b-15">Food Truck Required
                                        documents</h5>
                                    @php
                                    $i = 1 ;
                                    @endphp
                                    <input type="hidden" id="truck_document_count" value="{{count($truck_req)}}">
                                @foreach($truck_req as $truck_requ)
                                <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label
                                            class="kt-font-bold text--maroon">{{getLangId()== 1 ?  $truck_requ->requirement_name :  $truck_requ->requirement_name_ar }}</label>
                                        <p for="" class="reqName">
                                            {{getLangId() == 1 ?  $truck_requ->requirement_description : $truck_requ->requirement_description_ar}}
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-sm-12">
                                        <label style="visibility:hidden">hidden</label>
                                        <div id="upload_foodtruck_1_{{$i}}">Upload</div>
                                    </div>
                                    @if($truck_requ->dates_required)
                                    <div class="col-lg-2 col-sm-12">
                                        <label for="" class="text--maroon kt-font-bold" title="Issue Date">
                                            {{__('Issue Date')}}</label>
                                        <input type="text" class="form-control form-control-sm date-picker"
                                            name="truck_doc_issue_date_1_{{$i}}" data-date-end-date="0d"
                                            id="truck_doc_issue_date_1_{{$i}}" placeholder="DD-MM-YYYY" />
                                    </div>
                                    <div class="col-lg-2 col-sm-12">
                                        <label for="" class="text--maroon kt-font-bold" title="Expiry Date">
                                            {{__('Expiry Date')}}</label>
                                        <input type="text" class="form-control form-control-sm date-picker"
                                            name="truck_doc_issue_date_1_{{$i}}" data-date-start-date="+30d"
                                            id="truck_doc_issue_date_1_{{$i}}" placeholder="DD-MM-YYYY" />
                                    </div>
                                    @endif
                                </div>
                                @php
                                $i++;
                                @endphp
                                @endforeach
                                </form>
                                <div class="text-right" id="add_document_btn">
                                    <span class="btn btn-sm btn-dark my-4" onclick="addUploadRow()"><i
                                            class="fa fa-plus"></i> Add Document of Food Truck <span
                                            id="food_truck_doc_num"></span>
                                    </span>
                                </div>--}}
                            </div>
                        </div>
                    </div>


                    <div class="kt-form__actions">
                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-prev" id="prev_btn">
                            {{__('Previous')}}
                        </div>


                        <a href="{{route('event.index')}}#applied">
                            <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u" id="back_btn">
                                {{__('Back')}}
                            </div>
                        </a>

                        <div class="btn-group" role="group" id="submit--btn-group">
                            <button id="btnGroupDrop1" type="button" class="btn btn--yellow btn-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{__('Submit')}}
                            </button>
                            <div class="dropdown-menu py-0" aria-labelledby="btnGroupDrop1">
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary btn-hover-success"
                                    value="finished" id="submit_btn">Finish &
                                    Submit</button>
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary btn-hover-danger"
                                    value="finished" id="submit_btn_artist">Submit & Add Artist</button>
                                <button name="submit" class="dropdown-item btn btn-sm btn-secondary" value="drafts"
                                    id="draft_btn">Save
                                    as Draft</button>
                            </div>
                        </div>


                        <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                            data-ktwizard-type="action-next" id="next_btn">
                            {{__('Next')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

@endsection

@section('script')

<script src="{{asset('js/company/artist.js')}}"></script>
<script src="{{asset('js/company/uploadfile.js')}}"></script>
<script src="{{asset('js/company/map.js')}}"></script>
<script
    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=places&callback=initialize"
    async defer></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    var fileUploadFns = [];
    var eventdetails = {};
    var documentDetails = {};
    // var truckdocumentDetails = {};
    var docRules = {};
    var docMessages = {};
    var documentsValidator ;
    var picUploader ;
    var truckDocUploader = [];


    $(document).ready(function(){
        setWizard();
        localStorage.clear();
        uploadFunction();
        picUploadFunction();

        // getRequirementsList(5);
        // wizard.goTo(2);

        $('#add_document_btn').css('display', 'none');
        $('#how_many_div').css('display', 'none');
        $('#submit--btn-group').css('display', 'none');
        $('#added_documents').hide();
    });

    function checkTruck(id) {
        if (id == 1) {
            $("#how_many_div").css("display", "block");
            $('#no_of_trucks').trigger("change");
            truckDocUpload();
        } else {
            $("#how_many_div").css("display", "none");
            $("#no_of_trucks").attr("required", false);
            $('#add_document_btn').css('display', "none");
            $('#added_documents').css('display', 'none');
        }
    }

    $('#no_of_trucks').change(function(){
        var no_of_trucks = $('#no_of_trucks').val();
        var count = parseInt($('#added_documents > div').length)
        if(no_of_trucks > 0){
            $('#added_documents').css('display', 'block');
            if(no_of_trucks > 1 && no_of_trucks > count){
                truckDocUpload();
                $('#add_document_btn').css('display', "block");
                $('#food_truck_doc_num').html(count + 1);
            }else if(no_of_trucks == 1){
                $('#add_document_btn').hide();
            }
        }
    });

    const uploadFunction = () => {
            // console.log($('#artist_number_doc').val());
            for (var i = 1; i <= $('#requirements_count').val(); i++) {
                fileUploadFns[i] = $("#fileuploader_" + i).uploadFile({
                    url: "{{route('event.uploadDocument')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    // acceptFiles: "image/*",
                    fileName: "doc_file_" + i,
                    showDownload: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    returnType: "json",
                    showProgress: false,
                    showFileCounter: false,
                    duplicateErrorStr: 'No duplicate files allowed',
                    multiple: true,
                    dragDrop: true,
                    abortStr: '',
                    maxFileCount: 2,
                    showDelete: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {id: i, reqId: $('#req_id_' + i).val() , reqName:$('#req_name_' + i).val()},
                    onSuccess: function (files, response, xhr, pd) {
                        //You can control using PD
                        pd.progressDiv.show();
                        pd.progressbar.width('0%');
                    },
                    onLoad:function(obj)
                    {
                        var loadUrl = "{{route('company.resetUploadsSession', ':id')}}";
                        loadUrl = loadUrl.replace(':id', $('#req_id_' + i).val());
                        $.ajax({
                            url: loadUrl,
                            success: function(data)
                            {
                            }
                        });
                    },
                    onError: function (files, status, errMsg, pd) {
                        showEventsMessages(JSON.stringify(files[0]) + ": " + errMsg + '<br/>');
                        pd.statusbar.hide();
                    },
                    downloadCallback: function (files, pd) {
                        let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteUploadedfile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: data.id},
                            success: function (result) {
                                console.log('success');
                            }
                        });
                    }
                });
                $('#fileuploader_' + i + ' div').attr('id', 'ajax-upload_' + i);
                $('#fileuploader_' + i + ' + div').attr('id', 'ajax-file-upload_' + i);
            }
        };

        const picUploadFunction = () => {
            picUploader = $('#pic_uploader').uploadFile({
                url: "{{route('event.uploadLogo')}}",
                method: "POST",
                allowedTypes: "jpeg,jpg,png",
                fileName: "pic_file",
                multiple: false,
                deleteStr: `<i class="la la-trash"></i>`,
                showFileSize: false,
                showFileCounter: false,
                abortStr: '',
                showProgress: false,
                previewHeight: '100px',
                previewWidth: "auto",
                returnType: "json",
                maxFileCount: 1,
                showPreview: true,
                showDelete: true,
                uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                onSuccess: function (files, response, xhr, pd) {
                    pd.filename.html('');
                },
            });
            $('#pic_uploader div').attr('id', 'pic-upload');
            $('#pic_uploader + div').attr('id', 'pic-file-upload');
        };
        

        var eventValidator = $('#eventdetails').validate({
            ignore: [],
            rules: {
                event_type_id: 'required',
                name_en: 'required',
                name_ar: 'required',
                issued_date: {
                    required: true,
                    dateNL: true
                },
                street: 'required',
                description_en: 'required',
                description_ar: 'required',
                time_start: 'required',
                venue_en: 'required',
                area_id: 'required',
                longitude: 'required',
                latitude: 'required',
                expired_date: {
                    required: true,
                    dateNL: true
                },
                time_end: 'required',
                venue_ar: 'required',
                address: 'required',
            },
            messages: {
                event_type_id: '',
                name_en: '',
                name_ar: '',
                issued_date: '',
                time_start: '',
                street: '',
                description_en: '',
                description_ar: '',
                area_id: '',
                longitude: '',
                latitude: '',
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
            if (!checkForTick()) {
                return
            }
            setThis('block', 'block', 'none', 'none');
        });

        $("#upload_doc").on("click", function () {
            wizard = new KTWizard("kt_wizard_v3");
            !checkForTick() ? wizard.stop : '';
            wizard.currentStep == 2 ? stopNext(eventValidator): "";
            eventValidator.form() ? setThis('block', 'none', 'none', 'block') : '';
        });

        const setThis = (prev, next, back, submit) => {
            $('#prev_btn').css('display', prev);
            $('#next_btn').css('display', next);
            $('#back_btn').css('display', back);
            $('#submit--btn-group').css('display', submit);
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
                $('#agree_cb > span').removeClass('compulsory');
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
            var isTruck = $("input:radio[name='isTruck']:checked").val();
            stopNext(eventValidator);
            $('#eventdetails').validate();
            if(isTruck == 1){
                $("#no_of_trucks").rules("add", "required");
            } else if(isTruck == 0) {
                $("#no_of_trucks").rules("remove", "required");
            }
            KTUtil.scrollTop();// validating the artist details page
            if (eventValidator.form()) {
                $('#next_btn').css('display', 'none'); // hide the next button
                $('#submit--btn-group').css('display', 'block');
                var noOfTrucks = $("input:radio[name='isTruck']:checked").val() == "1" ? $('#no_of_trucks').val() : "0" ;
                eventdetails = {
                    event_type_id: $('#event_type_id').val(),
                    name: $('#name_en').val(),
                    name_ar: $('#name_ar').val(),
                    issued_date: $('#issued_date').val(),
                    time_start: $('#time_start').val(),
                    venue_en: $('#venue_en').val(),
                    expired_date: $('#expired_date').val(),
                    time_end: $('#time_end').val(),
                    venue_ar: $('#venue_ar').val(),
                    address: $('#address-input').val(),
                    emirate_id: $('#emirate_id').val(),
                    longitude: $('#longitude').val(),
                    latitude: $('#latitude').val(),
                    area_id: $('#area_id').val(),
                    country_id: $('#country_id').val(),
                    street: $('#street').val(),
                    description_en: $('#description_en').val(),
                    description_ar: $('#description_ar').val(),
                    full_address: $('#full_address').val(),
                    no_of_trucks: noOfTrucks
                };

                localStorage.setItem('eventdetails', JSON.stringify(eventdetails));
                // insertIntoDrafts(3, JSON.stringify(artistDetails));
            }
        }
        });

        let documentNames = {};


        const docValidation = () => {

            var hasFile = true;
            var hasFileArray = [];
            var reqCount = $('#requirements_count').val();
            if(reqCount > 0)
            {
                for (var i = 1; i <= reqCount; i++) 
                {
                    let children = $('#ajax-file-upload_' + i).children();
                    let fileNames = Object.keys(children).map(function(key){
                        return children[key].innerText != undefined ? children[key].innerText : '';
                    });

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
                        documentNames[i] = {
                            reqId: $('#req_id_'+i).val(),
                            fileNames
                        }
                    }
                }

            }

            
            if ($('#pic-file-upload').contents().length == 0) {
                hasPicture = false;
                $('#pic-upload').css('border', '2px dotted red');
            } else {
                hasPicture = true;
                $("#pic-upload").css('border', '2px dotted #A5A5C7');
            }
            
           /* var hasTruckFileArray = [];
            var per_truck_doc = $('#truck_document_count').val();
            var no_of_trucks = $('#no_of_trucks').val();
            if(no_of_trucks > 0)
            {
                for(var k = 1;k <= no_of_trucks; k++)
                {
                    for(var j = 1; j <= per_truck_doc; j++)
                    {
                        console.log(truckdocumentDetails);
                        truckdocumentDetails[k] ={};
                        hasTruckFileArray[k] = {};
                        if ($('#truck-file-upload_' +k+'_'+j).length) {
                            if ($('#truck-file-upload_'+k+'_'+j).contents().length == 0) {
                                hasTruckFileArray[k] = false;
                                $("#upload_foodtruck_" +k+'_'+j).css('border', '2px dotted red');
                            } else {
                                hasTruckFileArray[k] = true;
                                $("#upload_foodtruck_" +k+'_'+j).css('border', '2px dotted #A5A5C7');
                            }
                        }
                        truckdocumentDetails[k][j] = {
                            issue_date: $('#truck_doc_issue_date_' + k+'_'+j).val(),
                            exp_date: $('#truck_doc_expiry_date_' + k+'_'+j).val()
                        }
                    }
                }
            }

            || hasTruckFileArray.includes(false
            */
            

            if (hasFileArray.includes(false) || hasPicture == false ) {
                hasFile = false;
            } else {
                hasFile = true;
            }

            localStorage.setItem('documentDetails', JSON.stringify(documentDetails));
            localStorage.setItem('documentNames', JSON.stringify(documentNames));
            // localStorage.setItem('truckdocumentDetails', JSON.stringify(truckdocumentDetails));
            return hasFile;

        }



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
            $('#submit--btn-group').css('display', 'none');
        });

        let start_days_count = $('#settings_event_start_date').val();

        $('#issued_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true,
            startDate: '+'+start_days_count+'d',
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
            var expDate = moment(minDate, 'DD-MM-YYYY').add(1,'month');
            $('#expired_date').datepicker('setStartDate', minDate);
            $('#expired_date').datepicker('setEndDate', expDate.format("DD-MM-YYYY"));
            $('#expired_date').val(expDate.format("DD-MM-YYYY")).datepicker('update');
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

        function call_this_to_submit(isArtist = null){
            var hasFile = docValidation();

                if (documentsValidator.form() && hasFile) {

                    $('#submit--btn-group #btnGroupDrop1').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    var dn = localStorage.getItem('documentNames');
                    // var tdd = localStorage.getItem('truckdocumentDetails');

                        $.ajax({
                            url: "{{route('event.store')}}",
                            type: "POST",
                            data: {
                                eventD: ed,
                                documentD: dd,
                                documentN: dn,
                                // tdd:tdd,
                                from: 'new'
                            },
                            success: function (result) {
                                console.log(result);
                                if(result.message[0]){
                                    if(isArtist)
                                    {
                                        var hrefUrl = "{{route('event.add_artist', ':id')}}";
                                        hrefUrl = hrefUrl.replace(':id', 0);
                                        window.location.href =  hrefUrl;
                                    } else
                                    {
                                        window.location.href = "{{route('event.index')}}#applied";
                                    }
                                    localStorage.clear();
                                }
                            }
                        });
                }else {
                    alert('Please Upload the required food truck documents');
                }
        }

        $('#submit_btn_artist').click(()=>{
            call_this_to_submit(1)
        })

        $('#submit_btn').click((e) => {
            call_this_to_submit();
        });



        $('#draft_btn').click((e) => {

            var hasFile = docValidation();

                if (documentsValidator.form() && hasFile) {

                    $('#submit--btn-group #btnGroupDrop1').addClass('kt-spinner kt-spinner--v2 kt-spinner--right kt-spinner--sm kt-spinner--dark');

                    var ed = localStorage.getItem('eventdetails');
                    var dd = localStorage.getItem('documentDetails');
                    // var tdd = localStorage.getItem('truckdocumentDetails');

                    $.ajax({
                        url: "{{route('company.event.add_draft')}}",
                        type: "POST",
                        data: {
                            eventD: ed,
                            documentD: dd,
                            // tdd: tdd
                        },
                        success: function (result) {
                            if(result.message[0]){
                                window.location.href = "{{route('event.index')}}#draft";
                                localStorage.clear();
                            }
                        }
                    });
                }

        });


        function getRequirementsList(id)
        {
            var url = "{{route('company.event.get_requirements', ':id')}}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                success: function (result) {
                 if(result){
                    $('#documents_required').empty();
                     var res = result.requirements;
                     $('#documents_required').append('<h5 class="text-dark kt-margin-b-15 text-underline kt-font-bold">Event Permit Required documents</h5><div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">Event Logo <span class="text-danger">( required )</span></label><p class="reqName">A image of the event logo/ banner </p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="pic_uploader">Upload</div></div></div><input hidden id="requirements_count" value="'+ res.length +'" />');
                     for(var i = 0; i < res.length; i++){
                         var j = i+ 1 ;
                         $('#documents_required').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+res[i].requirement_name+'<span class="text-danger"> ( required ) </span></label><p for="" class="reqName">'+( res[i].requirement_description ? res[i].requirement_description : '' )+'</p></div><input type="hidden" value="'+res[i].requirement_id+'" id="req_id_'+j+'"><input type="hidden" value="'+res[i].requirement_name+'"id="req_name_'+j+'"><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="fileuploader_'+j+'">Upload</div></div><input type="hidden" id="datesRequiredCheck_'+j+'" value="'+res[i].dates_required+'"><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'"></div></div>');
                         if(res[i].dates_required == "1")
                         {
                            $('#issue_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">{{__("Issue Date")}}</label><input type="text" class="form-control form-control-sm date-picker" name="doc_issue_date_'+j+'" data-date-end-date="0d" id="doc_issue_date_'+j+'" placeholder="DD-MM-YYYY"/>');
                            $('#exp_dd_'+j+'').append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="doc_exp_date_'+j+'" data-date-start-date="+30d" id="doc_exp_date_'+j+'" placeholder="DD-MM-YYYY" />');
                         }
                            docRules['doc_issue_date_' + j] = 'required';
                            docRules['doc_exp_date_' + j] = 'required';
                            docMessages['doc_issue_date_' + j] = '';
                            docMessages['doc_exp_date_' + j] = '';

                         $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});
                     }
                     uploadFunction();
                     picUploadFunction();
                      documentsValidator = $('#documents_required').validate({
                        rules: docRules,
                        messages: docMessages
                    });
                 }else {
                    $('#documents_required').empty();
                 }
                }
            });
        }


        const truckDocUpload = () => {
            var count = parseInt($('#added_documents > div').length);
            var per_truck_doc = $('#truck_document_count').val();
            for(var i = 1; i <= count ;i++){
                for(var j = 1; j <= per_truck_doc; j++)
                {
                    truckDocUploader[i] = $('#upload_foodtruck_'+i+"_"+j).uploadFile({
                    url: "{{route('event.uploadTruck')}}",
                    method: "POST",
                    allowedTypes: "jpeg,jpg,png,pdf",
                    fileName: "truck_file_"+i+"_"+j,
                    multiple: true,
                    downloadStr: `<i class="la la-download"></i>`,
                    deleteStr: `<i class="la la-trash"></i>`,
                    showFileSize: false,
                    showFileCounter: false,
                    showProgress: false,
                    abortStr: '',
                    returnType: "json",
                    maxFileCount: 2,
                    showPreview: false,
                    showDelete: true,
                    showDownload: true,
                    uploadButtonClass: 'btn btn--yellow mb-2 mr-2',
                    formData: {id: i, subid: j },
                    downloadCallback: function (files, pd) {
                        let file_path = files.filepath;
                            let path = file_path.replace('public/','');
                            window.open(
                        "{{url('storage')}}"+'/' + path,
                        '_blank'
                        );
                    },
                    deleteCallback: function(data,pd)
                    {
                        $.ajax({
                            url: "{{route('event.deleteTruckUploadedfile')}}",
                            type: 'POST',
                            data: {path: data.filepath, ext: data.ext, id: i , subid: j},
                            success: function (result) {
                                console.log('success');
                            }
                        });
                    }
                });
                $('#upload_foodtruck_'+i+'_'+j+' div').attr('id', 'truck-upload_'+i+'_'+j);
                $('#upload_foodtruck_'+i+'_'+j+' + div').attr('id', 'truck-file-upload_'+i+'_'+j);
                }
            }
        };

        function addUploadRow(){
            var per_truck_doc = $('#truck_document_count').val();
            var no_of_trucks = $('#no_of_trucks').val();
            var total = parseInt($('#added_documents > div').length);
            var count =  total / per_truck_doc;
            var nextcount = count + 1;

            $.ajax({
                url: "{{route('event.fetch_truck_req', '1')}}",
                success: function (result) {
                    if(result)
                    {
                        let j = nextcount;
                        for(var i = 0;i < result.length; i++)
                        {
                            var k = i+1;
                            $('#added_documents').append('<div class="row"><div class="col-lg-4 col-sm-12"><label class="kt-font-bold text--maroon">'+result[i].requirement_name+'</label><p for="" class="reqName">'+result[i].requirement_description+'</p></div><div class="col-lg-4 col-sm-12"><label style="visibility:hidden">hidden</label><div id="upload_foodtruck_'+j+'_'+k+'">Upload</div></div><div class="col-lg-2 col-sm-12" id="issue_dd_'+j+'_'+k+'"></div><div class="col-lg-2 col-sm-12" id="exp_dd_'+j+'_'+k+'"></div></div>');

                            if(result[i].dates_required)
                            {
                                $('#issue_dd_'+j+'_'+k).append('<label for="" class="text--maroon kt-font-bold" title="Issue Date">Issue Date</label><input type="text" class="form-control form-control-sm date-picker" name="truck_doc_issue_date_'+j+'_'+k+'" data-date-end-date="0d" id="truck_doc_issue_date_'+j+'_'+k+'" placeholder="DD-MM-YYYY"/>');
                                $('#exp_dd_'+j+'_'+k).append('<label for="" class="text--maroon kt-font-bold" title="Expiry Date">Expiry Date</label><input type="text" class="form-control form-control-sm date-picker" name="truck_doc_expiry_date_'+j+'_'+k+'" data-date-start-date="+30d" id="truck_doc_expiry_date_'+j+'_'+k+'" placeholder="DD-MM-YYYY" />');
                            }
                            truckDocUpload();
                            $('.date-picker').datepicker({format: 'dd-mm-yyyy', autoclose: true, todayHighlight: true});
                        }
                        if(nextcount == no_of_trucks)
                        {
                            $('#add_document_btn').hide();
                        }
                        $('#food_truck_doc_num').html(nextcount);
                    }
                }
            });
            
        }


        // for(let j = 1;j<=no_of_trucks; j++)
        // {
        //     for(var k = 1;k <= per_truck_doc; k++)
        //     {
        //         if ($('#truck-file-upload_' +j+'_'+k).length && $('#truck-file-upload_' +j+'_'+k).contents().length == 0){
        //             alert("Please upload the file and add next truck document !");
        //             return;
        //             checkVal = false;
        //         }else{
        //             checkval = true;
        //         }
        //     }
        // }

        // $('#issue_dd_'+j+'').append('');
        // $('#exp_dd_'+j+'').append('');



</script>

@endsection