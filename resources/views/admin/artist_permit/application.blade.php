@extends('layouts.admin-app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet">
    <div class="kt-portlet__body kt-portlet__body--fit">
        <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">
            <div class="kt-grid__item">

                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v3__nav">
                    <div class="kt-wizard-v3__nav-items">
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>1</span> Artist Information
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="pending">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>2</span> Uploaded Documents
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="pending">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>3</span> 
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                        
                        <a class="kt-wizard-v3__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="pending">
                            <div class="kt-wizard-v3__nav-body">
                                <div class="kt-wizard-v3__nav-label">
                                    <span>4</span> Review and Submit
                                </div>
                                <div class="kt-wizard-v3__nav-bar"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <!--end: Form Wizard Nav -->
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                <!--begin: Form Wizard Form-->
                <form class="kt-form" id="kt_form" novalidate="novalidate">

                    <!--begin: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="kt-form__section kt-form__section--first">
                            @if(!empty($artist_permit))
                                <section class="row">
                                    <div class="col-md-12">
                                        <div class="accordion accordion-solid accordion-toggle-plus" id="{{ $artist_permit->permit_status }}">
                                                @foreach($artist_permit->artist as $key => $artist)
                                                <div class="card">
                                                    <div class="card-header" id="{{ $artist->uid_number }}">
                                                        <div class="card-title" data-toggle="collapse" data-target="#{{ $artist->passport_number }}" aria-expanded="true" aria-controls="{{ $artist->passport_number }}">
                                                            <i class="flaticon-users-1"></i> {{ ucwords($artist->name) }}
                                                        </div>
                                                    </div>
                                                    <div id="{{ $artist->passport_number }}" class="collapse {{ $key == 0 ? 'show': '' }}" aria-labelledby="{{ $artist->uid_number }}" data-parent="#{{ $artist_permit->permit_status }}">
                                                        <div class="card-body">
                                                            <div class="form-group row">
                                                                <textarea name="artist_note[]" id=""  rows="3" class="form-control input-sm"></textarea>
                                                            </div>
                                                            <div class="kt-widget2">
                                                                <section class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ ucwords($artist->name) }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                        Artist Name
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info">
                                                                                <div class="kt-widget2__title">
                                                                                    {{ $artist->name }}
                                                                                    <span class="kt-widget2__username"></span>
                                                                                    
                                                                                </div>
                                                                                <a href="#" class="kt-widget2__title">
                                                                                    Completa Financial Report For Emirates Airlines
                                                                                    <p></p>
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                        By Sean
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                    </div>
                                </section>
                            @endif
                            
                            
                        </div>
                    </div>

                    <!--end: Form Wizard Step 1-->

                    <!--begin: Form Wizard Step 2-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-heading kt-heading--md">Enter the Details of your Delivery</div>
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <div class="form-group">
                                    <label>Package Details</label>
                                    <input type="text" class="form-control" name="package" placeholder="Package Details" value="Complete Workstation (Monitor, Computer, Keyboard &amp; Mouse)">
                                    <span class="form-text text-muted">Please enter your Pakcage Details.</span>
                                </div>
                                <div class="form-group">
                                    <label>Package Weight in KG</label>
                                    <input type="text" class="form-control" name="weight" placeholder="Package Weight" value="25">
                                    <span class="form-text text-muted">Please enter your Package Weight in KG.</span>
                                </div>
                                <div class="kt-wizard-v3__form-label">Package Dimensions</div>
                                <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Package Width in CM</label>
                                            <input type="text" class="form-control" name="width" placeholder="Package Width" value="110">
                                            <span class="form-text text-muted">Please enter your Package Width in CM.</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Package Height in CM</label>
                                            <input type="text" class="form-control" name="height" placeholder="Package Length" value="90">
                                            <span class="form-text text-muted">Please enter your Package Width in CM.</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label>Package Length in CM</label>
                                            <input type="text" class="form-control" name="length" placeholder="Package Length" value="150">
                                            <span class="form-text text-muted">Please enter your Package Length in CM.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 2-->

                    <!--begin: Form Wizard Step 3-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-heading kt-heading--md">Select your Services</div>
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__form">
                                <div class="form-group">
                                    <label>Delivery Type</label>
                                    <select name="delivery" class="form-control">
                                        <option value="">Select a Service Type Option</option>
                                        <option value="overnight" selected="">Overnight Delivery (within 48 hours)</option>
                                        <option value="express">Express Delivery (within 5 working days)</option>
                                        <option value="basic">Basic Delivery (within 5 - 10 working days)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Packaging Type</label>
                                    <select name="packaging" class="form-control">
                                        <option value="">Select a Packaging Type Option</option>
                                        <option value="regular" selected="">Regular Packaging</option>
                                        <option value="oversized">Oversized Packaging</option>
                                        <option value="fragile">Fragile Packaging</option>
                                        <option value="frozen">Frozen Packaging</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Preferred Delivery Window</label>
                                    <select name="preferreddelivery" class="form-control">
                                        <option value="">Select a Preferred Delivery Option</option>
                                        <option value="morning" selected="">Morning Delivery (8:00AM - 11:00AM)</option>
                                        <option value="afternoon">Afternoon Delivery (11:00AM - 3:00PM)</option>
                                        <option value="evening">Evening Delivery (3:00PM - 7:00PM)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 3-->

                    <!--begin: Form Wizard Step 5-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        <div class="kt-heading kt-heading--md">Review your Details and Submit</div>
                        <div class="kt-form__section kt-form__section--first">
                            <div class="kt-wizard-v3__review">
                                <div class="kt-wizard-v3__review-item">
                                    <div class="kt-wizard-v3__review-title">
                                        Current Address
                                    </div>
                                    <div class="kt-wizard-v3__review-content">
                                        Address Line 1<br>
                                        Address Line 2<br>
                                        Melbourne 3000, VIC, Australia
                                    </div>
                                </div>
                                <div class="kt-wizard-v3__review-item">
                                    <div class="kt-wizard-v3__review-title">
                                        Delivery Details
                                    </div>
                                    <div class="kt-wizard-v3__review-content">
                                        Package: Complete Workstation (Monitor, Computer, Keyboard &amp; Mouse)<br>
                                        Weight: 25kg<br>
                                        Dimensions: 110cm (w) x 90cm (h) x 150cm (L)
                                    </div>
                                </div>
                                <div class="kt-wizard-v3__review-item">
                                    <div class="kt-wizard-v3__review-title">
                                        Delivery Service Type
                                    </div>
                                    <div class="kt-wizard-v3__review-content">
                                        Overnight Delivery with Regular Packaging<br>
                                        Preferred Morning (8:00AM - 11:00AM) Delivery
                                    </div>
                                </div>
                                <div class="kt-wizard-v3__review-item">
                                    <div class="kt-wizard-v3__review-title">
                                        Delivery Address
                                    </div>
                                    <div class="kt-wizard-v3__review-content">
                                        Address Line 1<br>
                                        Address Line 2<br>
                                        Preston 3072, VIC, Australia
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--end: Form Wizard Step 5-->

                    <!--begin: Form Actions -->
                    <div class="kt-form__actions">
                        <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                            Previous
                        </div>
                        <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                            Submit
                        </div>
                        <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                            Next Step
                        </div>
                    </div>

                    <!--end: Form Actions -->
                </form>

                <!--end: Form Wizard Form-->
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
@endsection

