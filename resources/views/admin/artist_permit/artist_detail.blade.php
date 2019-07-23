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
                <form class="kt-form" id="kt_form" novalidate="novalidate" method="post" action="{{ route('artist.submit_artist') }}">
                    @csrf

                    <!--begin: Form Wizard Step 1-->
                    <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                        <div class="kt-form__section kt-form__section--first">
                            @if(!empty($artist_permit))
                            <section class="row">
                                <div class="col-md-12">
                                    <div class="kt-widget kt-widget--user-profile-2">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__media">
                                                <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light ">
                                              

                                                </div>
                                            </div>
                                            <div class="kt-widget__info">
                                                <a href="#" class="kt-widget__username">
                                                   {{ ucwords($company->company_name) }}
                                                </a>
                                                <span class="kt-widget__desc">{{ $company->contact_person }}</span>
                                                <span class="kt-widget__desc">i{{ $company->contact_person_designation }}</span>
                                            </div>
                                        </div>
                                        <div class="kt-widget__body">
                                            <div class="kt-widget__item">
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Email:</span>
                                                    <a href="#" class="kt-widget__data">{{ $company->company_email }}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Mobile:</span>
                                                    <a href="#" class="kt-widget__data">{{ $company->company_mobile_number }}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Phone:</span>
                                                    <a href="#" class="kt-widget__data">{{ $company->company_phone_number }}</a>
                                                </div>
                                                <div class="kt-widget__contact">
                                                    <span class="kt-widget__label">Location:</span>
                                                    <span class="kt-widget__data">{{ $company->company_address}}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-margin-t-20 kt-margin-b-20 kt-hidden" role="tablist">
                                            <li class="kt-nav__item kt-nav__item--active">
                                                <a class="kt-nav__link active" data-toggle="tab" href="#kt_profile_tab_personal_information" role="tab">
                                                    <span class="kt-nav__link-icon"><i class="flaticon2-calendar-3"></i></span>
                                                    <span class="kt-nav__link-text">Personal Information</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link" data-toggle="tab" href="#kt_profile_tab_account_information" role="tab">
                                                    <span class="kt-nav__link-icon"><i class="flaticon2-protected"></i></span>
                                                    <span class="kt-nav__link-text">Acccount Information</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="This feature is coming soon!">
                                                    <span class="kt-nav__link-icon"><i class="flaticon2-hourglass-1"></i></span>
                                                    <span class="kt-nav__link-text">Payments</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__separator"></li>
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="This feature is coming soon!">
                                                    <span class="kt-nav__link-icon"><i class="flaticon2-bell-2"></i></span>
                                                    <span class="kt-nav__link-text">Statements</span>
                                                </a>
                                            </li>
                                            <li class="kt-nav__item">
                                                <a class="kt-nav__link" href="#" role="tab" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="This feature is coming soon!">
                                                    <span class="kt-nav__link-icon"><i class="flaticon2-medical-records-1"></i></span>
                                                    <span class="kt-nav__link-text">Audit Log</span>
                                                </a>
                                            </li>
                                        </ul>

                                </div>
                            </section>
                                    <hr style="margin-top: 5%">
                                     <h5>Artist Permit Request</h5>
                                <section class="row" style="margin-top: 4%">
                                    <div class="col-md-12">
                                       
                                        <div class="accordion accordion-solid accordion-toggle-plus" id="{{ $artist_permit->permit_status }}">
                                            <input type="hidden" name="artist_permit_id[]" value="{{ $artist_permit->artist_permit_id }}">
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
                                                                <label for="">Remarks</label>
                                                                <input type="hidden" name="artist_id[]" value="{{ $artist->artist_id }}">
                                                                <textarea name="artist_note[]" id=""  rows="3" class="form-control input-sm"></textarea>
                                                            </div>
                                                            <div class="kt-widget2">
                                                                <section class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  value="1" name="artist_name[]">
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
                                                                                    <input type="checkbox"  value="1" name="uid_number[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ ucwords($artist->uid_number) }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                       UID Number
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <section class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="passport_number[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ ucwords($artist->passport_number) }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                        Passport Number
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="nationality[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ ucwords($artist->nationality) }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                       Nationality
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <section class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="birthdate[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ $artist->birthdate }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                        Birthdate
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="mobile_number[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ ucwords($artist->mobile_number) }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                       Mobile Number
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <section class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="email[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ $artist->email }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                        Email
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="phone_number[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ ucwords($artist->phone_number) }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                       Telephone Number
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                                <section class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="professon[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {{ $artist->profession }}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                        Profession
                                                                                    </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="kt-widget2__item">
                                                                         <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--warning">
                                                                                <label>
                                                                                    <input type="checkbox"  name="person_code[]">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            <div class="kt-widget2__info float-left">
                                                                                <a href="#" class="kt-widget2__title">
                                                                                   {!! $artist->person_code ? $artist->person_code : '<i class="text-warning">no person code provided</i>'  !!}
                                                                                    </a><a href="#" class="kt-widget2__username">
                                                                                       Person Code
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
                    <div class="kt-form__actions">
                        <a  href="{{ route('artist.index') }}" class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" >Back</a>
                        <a href="{{ route('artist.artist_documents', $artist_permit->artist_permit_id) }}" class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" >
                            Next Step
                        </a>
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
@section('script')
    <script>
        $(document).ready(function(){
            $('#kt_form').submit(function(e){
                console.log($(this).serializeArray());                
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                }).done(function(response){
                // console.log(response);
            });;
            })
        });
    </script>
@endsection

