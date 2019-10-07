@extends('layouts.app')

@section('title', 'Add Event Permit - Smart Government Rak')

@section('content')

<link href="{{ asset('/css/uploadfile.css') }}" rel="stylesheet">

{{-- {{dd(session()->all())}} --}}
<!-- begin:: Content -->
{{-- <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid"> --}}
<div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step"
                            data-ktwizard-state="current" id="check_inst" style="flex: 0 0 50% !important;">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>01</span> Check Instructions
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="event_det"
                            style="flex: 0 0 50% !important;">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>02</span> Event Details
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        {{-- <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" id="upload_doc">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>03</span> Upload Documents
                                    <Docs></Docs>
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a> --}}

                    </div>
                </div>

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
                                                <h6 class="kt-font-transform-u"> Permit Fees Structure</h6>
                                            </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">

                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla
                                                necessitatibus asperiores blanditiis vitae nemo ad.
                                                {{-- <table class="table table-borderless">
                                                    <tr>
                                                        <th>Profession</th>
                                                        <th>Fee</th>
                                                    </tr>
                                                    @foreach($profession as $pt)
                                                    <tr>
                                                        <td>{{$pt->name_en}}</td>
                                                <td>{{$pt->amount}}</td>
                                                </tr>
                                                @endforeach
                                                </table> --}}


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
                                        <input type="checkbox" id="agree" name="agree"> I Read
                                        and understand all
                                        service rules, And agree to continue submitting it.
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="agreed_value" value="{{old('agreed')}}" />


                    <form action="{{route('event.store')}}" method="POST">

                        @csrf
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <input type="hidden" id="agreed" name="agreed" value="1" />
                                    <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
                                        <div class="card">
                                            <div class="card-header" id="headingOne6">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseOne6" aria-expanded="true"
                                                    aria-controls="collapseOne6">
                                                    <h6 class="kt-font-transform-u">Event
                                                        information</h6>
                                                </div>
                                            </div>
                                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                                data-parent="#accordionExample5">
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="event_type_id"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Event Type <small>( <span
                                                                        class="text-danger">required</span>
                                                                    )</small></label>
                                                            <select
                                                                class="form-control form-control-sm {{$errors->has('event_type_id') ? 'is-invalid' : ''}}"
                                                                name="event_type_id" id="event_type_id"
                                                                placeholder="Type">
                                                                <option value="">Select</option>
                                                                @foreach ($event_types as $pt)
                                                                <option value="{{$pt->event_type_id}}"
                                                                    {{old('event_type_id') == $pt->event_type_id ? 'selected' : ''}}>
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
                                                                value="{{old('name_en')}}">
                                                        </div>

                                                        <div class=" col-md-4 form-group form-group-sm">
                                                            <label for="name_ar"
                                                                class=" col-form-label kt-font-bold text-right">Event
                                                                Name - Ar<small>( <span class="text-danger">required
                                                                    </span>)</small></label>
                                                            <input type="text"
                                                                class="form-control form-control-sm {{$errors->has('name_ar') ? 'is-invalid' : ''}}"
                                                                name="name_ar" id="name_ar" placeholder="Event Name"
                                                                value="{{old('name_ar')}}">
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
                                                                    name="issued_date" id="issued_date"

                                                                    placeholder="From Date"
                                                                    value="{{old('issued_date')}}">

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
                                                                    value="{{date('h:i a')}}" name="time_start"
                                                                    id="time_start" type="text"
                                                                    value="{{old('time_start')}}" />

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="venue_en"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Venue <small>( <span class="text-danger">required</span>
                                                                    )</small></label>
                                                            <input type="text"
                                                                class="form-control form-control-sm {{$errors->has('venue_en') ? 'is-invalid' : ''}}"

                                                                name="venue_en" id="venue_en" placeholder="Venue"
                                                                value="{{old('venue_en')}}">

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
                                                                    name="expired_date" id="expired_date"

                                                                    placeholder="To Date"
                                                                    value={{old('exprired_date')}}>

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
                                                                    value="{{date('h:i a')}}" name="time_end"

                                                                    id="time_end" type="text"
                                                                    value={{old('time_end')}} />

                                                            </div>

                                                        </div>



                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="venue_ar"
                                                                class=" col-form-label kt-font-bold text-right">
                                                                Venue - Ar <small>( <span
                                                                        class="text-danger">required</span>
                                                                    )</small></label>
                                                            <input type="text"
                                                                class="form-control form-control-sm {{$errors->has('venue_ar') ? 'is-invalid' : ''}}"
                                                                name="venue_ar" id="venue_ar" placeholder="Venue"
                                                                value={{old('venue_ar')}}>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-header" id="headingTwo6">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                    data-target="#collapseTwo6" aria-expanded="false"
                                                    aria-controls="collapseTwo6">
                                                    <h6 class="kt-font-transform-u">Contact
                                                        information
                                                    </h6>
                                                </div>
                                            </div>
                                            {{--id="collapseTwo6"--}}
                                            <div class="collapse show" aria-labelledby="headingTwo6"
                                                data-parent="#accordionExample6">
                                                <div class="card-body">

                                                    <div class="row">


                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="address"
                                                                class=" col-form-label kt-font-bold text-right">Address
                                                                <small>( <span class="text-danger">required</span>
                                                                    )</small></label>
                                                            <input type="text" class="form-control form-control-sm "
                                                                name="address" id="address" placeholder="Address"
                                                                value={{old('address')}}>
                                                        </div>

                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="emirate_id"
                                                                class=" col-form-label kt-font-bold text-right">Emirate
                                                                <small>( optional )</small></label>
                                                            <select class="form-control form-control-sm"
                                                                name="emirate_id" id="emirate_id"
                                                                onchange="getAreas(this.value)">
                                                                <option value="">Select</option>
                                                                @foreach($emirates as $em)
                                                                <option value="{{$em->id}}"
                                                                    {{$em->id == old('emirate_id') ? 'selected' : ''}}>
                                                                    {{$em->name_en}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                        <div class="col-md-4 form-group form-group-sm ">
                                                            <label for="area_id"
                                                                class=" col-form-label kt-font-bold text-right">Area
                                                                <small>( optional )</small></label>
                                                            <select class="  form-control form-control-sm "
                                                                name="area_id" id="area_id">
                                                                <option value="">Select</option>
                                                                @foreach($areas as $ar)
                                                                <option value="{{$ar->id}}"
                                                                    {{$ar->id == old('area_id') ? 'selected' : ''}}>
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
                                                                    {{old('country_id') == $ct->country_id ? 'selected' : ''}}>
                                                                    {{$ct->name_en}}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>


                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 3-->

                        {{-- <div class="kt-spinner kt-spinner--lg kt-spinner--dark" style="display:none"></div> --}}

                        <!--begin: Form Wizard Step 3-->



                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                        <div class="kt-form__actions">
                            <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev" id="prev_btn">
                                Previous
                            </div>

                                    </div>

                            <a href="{{url('company/event')}}">
                                <div class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                                    id="back_btn">
                                    Back
                                </div>
                            </a>

                            {{-- <button class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-submit">
                                Submit
                            </button> --}}

                            <div class="btn-group" role="group" id="submit_btn">
                                <button id="btnGroupDrop1" type="button" class="btn btn--yellow btn-sm dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    data-ktwizard-type="action-submit">
                                    Submit
                                </button>
                                <div class="dropdown-menu py-0" aria-labelledby="btnGroupDrop1">
                                    <button name="submit"
                                        class="dropdown-item btn btn-sm btn-secondary btn-hover-success"
                                        value="finished">Finish &
                                        Submit</button>
                                    <button name="submit" class="dropdown-item btn btn-sm btn-secondary"
                                        value="drafts">Save to Drafts</button>
                                </div>
                            </div>




                            <div class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-next" id="next_btn">
                                Next Step
                            </div>

                        </div>

                </div>

                </form>



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

<div class="modal fade" id="artist_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Person Code Search</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearPersonCode()">
                </button>
            </div>
            <div class="modal-body" id="person_code_modal">
            </div>
        </div>
    </div>
</div>



<!--end::Modal-->




@endsection


@section('script')
<script async src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="{{asset('/js/uploadfile.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {"X-CSRF-TOKEN": jQuery(`meta[name="csrf-token"]`).attr("content")}
    });

    $(document).ready(function(){
        wizard = new KTWizard("kt_wizard_v3");
        var is_agreed = $('#agreed_value').val();

        if(is_agreed == 1){
            wizard.goTo(2);
            $('#back_btn').css('display', 'none');
        }
    })

    $("#check_inst").on("click", function () {
        setThis('none', 'block', 'block', 'none');
    });

    $("#artist_det").on("click", function () {
        if (!checkForTick()) {
            return
        }
        setThis('block', 'none', 'none', 'block');
    });

    const setThis = (prev, next, back, submit) => {
        $('#prev_btn').css('display', prev);
        $('#next_btn').css('display', next);
        $('#back_btn').css('display', back);
        $('#submit_btn').css('display', submit);
    };

    const checkForTick = () => {
        wizard = new KTWizard("kt_wizard_v3");
        var result;
        if (wizard.currentStep == 1) {
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
        } else {
            result = true;
        }
        return result;
    };


        $('#next_btn').click(function () {

            wizard = new KTWizard("kt_wizard_v3");


            // checking the next page is artist details
            if (wizard.currentStep == 1) {
                if(checkForTick())
                {
                    $('#back_btn').css('display', 'none');
                    $('#submit_btn').css('display', 'block');
                }

            }
        });



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


        const getAreas = (city_id) => {
            $.ajax({
                url: "{{url('company/fetch_areas')}}" + '/' + city_id,
                success: function (result) {
                    // console.log(result)
                    $('#area_id').empty();
                    $('#area_id').append('<option value=" ">Select</option>');
                    for (let i = 0; i < result.length; i++) {
                        $('#area_id').append('<option value="' + result[i].id + '">' + result[i].area_en + '</option>');

                    }

                }
            });

        };




        $('#submit_btn').click((e) => {

              /*  var from_date  = $('#from_date').val();
                var to_date = $('#to_date').val();
                var location = $('#location').val();

                var permit_id = $('#permit_id').val();

                var permitD = {
                    from : from_date,
                    to: to_date,
                    location: location
                }
                // $.ajax({
                //     url: "{{route('company.add_artist_to_draft')}}",
                //     type: "POST",
                //     data: {
                //         artistD: ad,
                //         documentD: dd,
                //         permitD: permitD,
                //         permit_id: permit_id
                //     },
                //     success: function (result) {
                //         if(result.message[0]){
                //             localStorage.clear();
                //             window.location.href = "{{url('company/add_new_permit')}}"+'/'+ permit_id;
                //         }
                //         console.log(result);
                //         // $('#pleaseWaitDialog').modal('hide');
                //     }
                // });
            }*/

        });




</script>

@endsection
