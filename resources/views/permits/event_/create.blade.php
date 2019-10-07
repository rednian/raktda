@extends('layouts.app')

@section('content')
@component('layouts.subheader')
@slot('heading')
Permits
@endslot
@slot('subheading')
Event Permit
@endslot
@slot('subSubHeading')
Apply New Event Permit
@endslot
@endcomponent



<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">
        <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
                <div class="kt-grid__item">
                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v3__nav">
                        <div class="kt-wizard-v3__nav-items" role="tablist">
                            <a class="kt-wizard-v3__nav-item " data-ktwizard-type="step" href="#"
                                data-ktwizard-state="current">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>1</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>2</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>3</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                            {{-- <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#" style="flex: 0 0 17%;">
                                    <div class="kt-wizard-v3__nav-body">
                                        <div class="kt-wizard-v3__nav-label">
                                            <span>4</span>
                                        </div>
                                        <div class="kt-wizard-v3__nav-bar"></div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#" style="flex: 0 0 17%;">
                                    <div class="kt-wizard-v3__nav-body">
                                        <div class="kt-wizard-v3__nav-label">
                                            <span>5</span>
                                        </div>
                                        <div class="kt-wizard-v3__nav-bar"></div>
                                    </div>
                                </a>
                                <a class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#" style="flex: 0 0 17%;">
                                    <div class="kt-wizard-v3__nav-body">
                                        <div class="kt-wizard-v3__nav-label">
                                            <span>6</span>
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
                    <form class="kt-form" id="kt_form" style="width: 90%">
                        <!--begin: Form Wizard Step 1-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                            data-ktwizard-state="current">
                            <div class="kt-heading kt-heading--md">Instructions
                            </div>
                            <div class="kt-form__section kt-form__section--first mb-5">

                                <!--begin::Accordion-->
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                    <div class="card">
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title" data-toggle="collapse" data-target="#collapseOne6"
                                                aria-expanded="true" aria-controls="collapseOne6">
                                                <i class="flaticon-pie-chart-1"></i> Event Details Required
                                            </div>
                                        </div>
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseTwo6" aria-expanded="false"
                                                aria-controls="collapseTwo6">
                                                <i class="flaticon2-notification"></i> Documents Required
                                            </div>
                                        </div>
                                        <div id="collapseTwo6" class="collapse" aria-labelledby="headingTwo6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree6">
                                            <div class="card-title collapsed" data-toggle="collapse"
                                                data-target="#collapseThree6" aria-expanded="false"
                                                aria-controls="collapseThree6">
                                                <i class="flaticon2-chart"></i> Permit Fees Structure
                                            </div>
                                        </div>
                                        <div id="collapseThree6" class="collapse" aria-labelledby="headingThree6"
                                            data-parent="#accordionExample6">
                                            <div class="card-body">
                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                                                terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                                                skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid
                                                single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh
                                                helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                                proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft
                                                beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                haven't heard of them accusamus labore sustainable VHS.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--end::Accordion-->
                            </div>

                        </div>

                        <!--end: Form Wizard Step 1-->

                        <!--begin: Form Wizard Step 2-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Event Permit Details</div>

                            @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                {!! $error !!}<br>
                                @endforeach
                            </div>
                            @endif

                            @if (session('status'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span></button>
                                {{ session('status') }}
                            </div>
                            @endif

                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <form method="POST" action="/company/apply_event_permit">
                                        {{ csrf_field()}}
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label>Event Type</label>
                                                <select type="text" class="form-control " name="event_type">
                                                    <option value="">Select</option>
                                                    <option value="Entertainment Events / Without Ticket">Entertainment
                                                        Events / Without Ticket</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-4">
                                                <label>From Date</label>
                                                <div class="input-group" data-date-format="dd-mm-yyyy"
                                                    data-date-start-date="+0d">
                                                    <input type="text" class="form-control date-picker"
                                                        name="event_permit_from" placeholder="MM/DD/YY">
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="form-group col-4 ">
                                                <label>To Date</label>
                                                <div class="input-group" data-date-format="dd-mm-yyyy"
                                                    data-date-start-date="+0d">
                                                    <input type="text" class="form-control date-picker"
                                                        name="event_permit_to" placeholder="MM/DD/YY" />
                                                    <span class="input-group-btn">
                                                        <button class="btn default" type="button">
                                                            <i class="fa fa-calendar"></i>
                                                        </button>
                                                    </span>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label>Event Name - EN</label>
                                                <input type="text" class="form-control" name="event_name_en"
                                                    placeholder="Event Name - EN">
                                            </div>
                                            <div class="form-group col-4">
                                                <label>Event Name - AR</label>
                                                <input type="text" class="form-control" name="event_name_ar"
                                                    placeholder="Event Name - AR">
                                            </div>

                                            <div class="form-group col-4">
                                                <label>Event Venue</label>
                                                <input type="text" placeholder="Event Venue" class="form-control"
                                                    name="event_venue">
                                            </div>

                                        </div>



                                </div>
                                <!--begin: Form Actions -->


                                <!--end: Form Actions -->
                            </div>
                        </div>

                        <!--end: Form Wizard Step 2-->

                        <!--begin: Form Wizard Step 3-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            <div class="kt-heading kt-heading--md">Upload Necessary Documents
                                <span class="float-right">
                                    <button class="btn btn-warning btn-sm"> + Add New</button>
                                </span>
                            </div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__form">
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label>Document Type</label>
                                            <select type="text" class="form-control" name="artist_upload_doc_type">
                                                <option value="">Select</option>
                                                <option value="Trade License">Trade License</option>
                                                <option value="Trade License">NOC</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-4">
                                            <label>Upload File</label>
                                            <input type="file" class="form-control" name="artist_upload_doc_file"
                                                placeholder="">
                                        </div>
                                        <div class="form-group col-4">
                                            <label>Expiry Date</label>
                                            <input type="date" class="form-control" name="artist_upload_doc_exp_date"
                                                placeholder="MM/DD/YY">
                                        </div>
                                    </div>







                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 3-->

                        <!--begin: Form Wizard Step 4-->
                        {{-- <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                <div class="kt-heading kt-heading--md">Permit Request Applied Successfully
                </div>
                <div class="kt-form__section kt-form__section--first">
                    <div class="kt-wizard-v3__form">
                        <div class="form-group">
                            <label>Permit Details</label>
                            <div class="kt-card">
                                <h2>Artist Name and details</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}


                        <!--end: Form Wizard Step 4-->

                        <!--begin: Form Wizard Step 5-->
                        {{-- <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                <div class="kt-heading kt-heading--md">Make Payment
                </div>
                <div class="kt-form__section kt-form__section--first">
                    <div class="kt-wizard-v3__review">
                        <div class="kt-wizard-v3__review-item">
                            <div class="kt-wizard-v3__review-title">
                                Permit ID
                            </div>
                            <div class="kt-wizard-v3__review-content">
                                Address Line 1<br />
                                Address Line 2<br />
                                Melbourne 3000, VIC, Australia
                                and Other Details on the Permit
                            </div>
                            <div class="kt-wizard-v3__review-content kt-heading">
                                Total Payable Amount: AED 195
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Wizard Step 5-->
                        {{-- <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                <div class="kt-heading kt-heading--md">Permit Issued Successfully
                </div>
                <div class="kt-form__section kt-form__section--first">
                    <div class="kt-wizard-v3__review">
                        <div class="kt-wizard-v3__review-item">
                            <div class="kt-wizard-v3__review-title">
                                Permit ID
                            </div>
                            <div class="kt-wizard-v3__review-content">
                                Address Line 1<br />
                                Address Line 2<br />
                                Melbourne 3000, VIC, Australia
                                and Other Details on the Permit
                            </div>
                        </div>

                    </div>
                </div>
            </div> --}}

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev">
                                Previous
                            </div>
                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-submit">
                                Submit
                            </div>
                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-next">
                                Next Step
                            </div>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                </div>

                <!--end: Form Wizard Form-->
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

<div>

    @endsection

    @section('script')

    <script>
        var KTAppOptions = {
                    "colors": {
                        "state": {
                            "brand": "#5d78ff",
                            "dark": "#282a3c",
                            "light": "#ffffff",
                            "primary": "#5867dd",
                            "success": "#34bfa3",
                            "info": "#36a3f7",
                            "warning": "#ffb822",
                            "danger": "#fd3995"
                        },
                        "base": {
                            "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                            "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                        }
                    }
                };
    </script>

    <link href={{'../assets/css/demo1/pages/general/wizard/wizard-3.css'}} rel="stylesheet" type="text/css" />
    {{-- <script src={{asset('./assets/js/demo1/pages/wizard/wizard-3.js')}} type="text/javascript"></script> --}}

    @endsection
