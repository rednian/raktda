@extends('layouts.admin-app')
@section('style')
<link href="{{ asset('/assets/css/demo1/pages/general/wizard/wizard-3.css') }}" rel="stylesheet" type="text/css" />
<style>
    .kt-switch{ height: 0 !important;}
    .kt-switch.kt-switch--sm input:empty ~ span {
        margin: -20px -4px  !important;
        width: 32px;
        border-radius: 12px; 
        }
    .kt-section{ margin: 0;}
    .kt-wizard-v3 .kt-wizard-v3__wrapper .kt-form .kt-wizard-v3__content .kt-wizard-v3__form {
         margin-top: 0; 
    }
    .kt-wizard-v3 .kt-wizard-v3__wrapper .kt-form .kt-wizard-v3__content {
        padding-bottom: 1px;
        margin-bottom: 1rem;
    }
</style>
@endsection
@section('action')
<a href="{{ route('admin.artist_permit.applicationdetails', $artist_permit->permit_id) }}" class="btn btn-light btn-elevate active btn-raised">
  <i class="la la-arrow-left"></i>
  <span class="kt-hidden-mobile">Back</span>
</a>
<a href="#" class="btn btn-brand btn-sm btn-raised active">Artist Details</a>
@endsection
@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--head-lg  kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg" style="">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Check Artist Application</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    {{-- <a href="#" class="btn btn-clean kt-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="kt-hidden-mobile">Back</span>
                    </a> --}}
                    <div class="btn-group">
                        <button type="button" id="btn-draft" class="btn btn-light btn-sm  ">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save as Draft</span>
                        </button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(123px, 38px, 0px);">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a href="javascript::void(0);" class="kt-nav__link" id="btn-rivision">
                                        <i class="kt-nav__link-icon flaticon2-reload"></i>
                                        <span class="kt-nav__link-text">Revise Application</span>
                                    </a>
                                </li>
                                {{-- <li class="kt-nav__item">
                                    <a href="javascript::void(0);" class="kt-nav__link" id="btn-approval">
                                        <i class="kt-nav__link-icon flaticon2-power"></i>
                                        <span class="kt-nav__link-text">Submit for Approval</span>
                                    </a>
                                </li> --}}
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="artist-wizard" data-ktwizard-state="first">
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
                                        <span>3</span> Review & Submit
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                    <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
                        <form class="kt-form" id="kt_form" novalidate="novalidate">
                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form" id="artist-detail">
                                        <section class="form-group row">
                                             <label>Remarks</label>
                                              <textarea name="comment" value="{{ !empty($artist_permit->comment->first()->comment) ? $artist_permit->comment->first()->comment : '' }}" class="form-control comment" id="artist-comment">{{ !empty($artist_permit->comment->first()->comment) ? $artist_permit->comment->first()->comment : '' }}</textarea>
                                        </section>
                                        <section class="row">
                                         
                                            <div class="col-lg-6">
                                                <div class="kt-section">
                                                    <div class="kt-section-title">Artist Information</div>
                                                    <div class="kt-section-body">
                                                        <section class="kt-form kt-form--label-right">
                                                            <div class="form-group row">
                                                                 <label for="example-search-input" class="col-3 col-form-label">Name</label>
                                                                 <div class="col-lg-9">
                                                                     <div class="input-group">
                                                                         <input  value="{{ $artist_permit->artist->name }}" name="name_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input  {{ check('name', $artist_permit->artist_permit_id) }} value="1" data-field="1" type="checkbox"  name="name">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                 </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Artist Status</label>
                                                                <div class="col-lg-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->artist_status }}" name="artist_status_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('artist_status', $artist_permit->artist_permit_id) }} value="1" data-field="1"  type="checkbox"  name="artist_status">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                   {{-- <div class="invalid-feedback">Shucks, check the formatting of that and try again.</div> --}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Age</label>
                                                                <div class="col-lg-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->birthdate->age }}" name="birthdate_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('birthdate', $artist_permit->artist_permit_id) }}  value="1" data-field="1"  type="checkbox"  name="birthdate">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Profession</label>
                                                                <div class="col-lg-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->permitType->name_en }}" name="profession_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('artist_status', $artist_permit->artist_permit_id) }} value="1" data-field="1"  type="checkbox"  name="profession">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                                <section class="kt-section">
                                                    <div class="kt-section-title">Contact Information</div>
                                                    <div class="kt-section-body">
                                                        <section class="kt-form kt-form--label-right">
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Email</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->email }}" name="email_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('email', $artist_permit->artist_permit_id) }} value="1" data-field="1" type="checkbox"  name="email">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Mobile No.</label>
                                                                <div class="col-9 ">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->mobile_number }}" name="mobile_number_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input  {{ check('mobile_number', $artist_permit->artist_permit_id) }}  value="1" data-field="1"  type="checkbox"  name="mobile_number">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                            <label for="example-search-input" class="col-3 col-form-label">Phone No.</label>
                                                            <div class="col-9">
                                                                <div class="input-group">
                                                                <input  value="{{ $artist_permit->artist->phone_number }}" name="phone_number_val" type="text" readonly class="form-control form-control-sm">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                           <label>
                                                                               <input {{ check('phone_number', $artist_permit->artist_permit_id) }} value="1" data-field="1"  type="checkbox"  name="phone_number">
                                                                               <span></span>
                                                                           </label>
                                                                       </span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        </section>
                                                    </div>
                                                </section>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="kt-section">
                                                    <div class="kt-section-title">Passport Information</div>
                                                    <div class="kt-section-body">
                                                         <section class="kt-form kt-form--label-right">
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Passport No.</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->passport_number }}" name="passport_number_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('passport_number', $artist_permit->artist_permit_id) }} value="1" data-field="1"  type="checkbox"  name="passport_number">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Issued Date</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->passport_issued_date }}" name="passport_issued_date_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('passport_issued_date', $artist_permit->artist_permit_id) }} value="1" data-field="1"  type="checkbox"  name="passport_issued_date">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Expiry Date</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->passport_expired_date }}" name="passport_expired_date_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('passport_expired_date', $artist_permit->artist_permit_id) }} value="1" data-field="1" type="checkbox"  name="passport_expired_date">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </section>
                                                    </div>
                                                </div>
                                                <div class="kt-section">
                                                    <div class="kt-section-title">Unified Number Information</div>
                                                    <div class="kt-section-body">
                                                          <section class="kt-form kt-form--label-right">
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">UID Number</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->uid_number }}" name="uid_number_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('uid_number', $artist_permit->artist_permit_id) }} value="1" data-field="1" type="checkbox"  name="uid_number">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Issued Date</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->uid_issued_date }}" name="uid_issued_date_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('uid_issued_date', $artist_permit->artist_permit_id) }}  value="1" data-field="1" type="checkbox"  name="uid_issued_date">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="example-search-input" class="col-3 col-form-label">Expiry Date</label>
                                                                <div class="col-9">
                                                                    <div class="input-group">
                                                                        <input  value="{{ $artist_permit->artist->uid_expired_date }}" name="uid_expired_date_val" type="text" readonly class="form-control form-control-sm">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">
                                                                                <span class="kt-switch kt-switch--sm kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                   <label>
                                                                                       <input {{ check('uid_issued_date', $artist_permit->artist_permit_id) }} value="1" data-field="1"  type="checkbox"  name="uid_expired_date">
                                                                                       <span></span>
                                                                                   </label>
                                                                               </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 1-->

                            <!--begin: Form Wizard Step 2-->
                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v3__form">
                                        <div class="form-group row">
                                            <label>Remarks</label>
                                         <textarea name="comment" value="{{ !empty($artist_permit->comment->first()->comment) ? $artist_permit->comment->first()->comment : '' }}" class="form-control comment">{{ !empty($artist_permit->comment->first()->comment) ? $artist_permit->comment->first()->comment : '' }}</textarea>
                                        </div>
                                        @if (!empty($artist_permit))
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>#</td>
                                                    <td>Document Name</td>
                                                    <td>Date Issued</td>
                                                    <td>Date Expiry</td>
                                                    <td>Action</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($artist_permit->artistPermitDocument as $index => $document)
                                                   <tr>
                                                       <td>{{ $index+1 }}</td>
                                                       <td>{{ $document->document_name }}</td>
                                                       <td>{{ $document->issued_date->format('d-M-Y') }}</td>
                                                       <td>{{ $document->expired_date->format('d-M-Y') }}</td>
                                                       <td>
                                                            <a href="#" class="fancy-box btn-raised btn-defaut" data-type="iframe" data-type="ajax" data-fancybox>view document</a>
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" checked="checked" name="">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </td>
                                                   </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--end: Form Wizard Step 2-->
                            <!--begin: Form Wizard Step 5-->
                            <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                              
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="form-group row">
                                        <label>Remarks</label>
                                        <textarea name="comment" value="{{ !empty($artist_permit->comment->first()->comment) ? $artist_permit->comment->first()->comment : '' }}" class="form-control comment">{{ !empty($artist_permit->comment->first()->comment) ? $artist_permit->comment->first()->comment : '' }}</textarea>
                                    </div>
                                    <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-2x nav-tabs-line-dark" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#kt_tabs_6_1" role="tab" aria-selected="true">Artist Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab" href="#kt_tabs_6_2" role="tab" aria-selected="false">Documents uploaded</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#kt_tabs_6_3" role="tab" aria-selected="false">Rivision</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="kt_tabs_6_1" role="tabpanel">
                                            <div class="kt-widget kt-widget--user-profile-3">
                                                <div class="kt-widget__top">
                                                    @if ($artist_permit->photo)
                                                        <div class="kt-widget__media">
                                                            <img src="{{ asset('storage/'.$artist_permit->photo->thumbnail) }}" alt="image">
                                                        </div>
                                                    @else
                                                    <div class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                                                        {!! defaultProfile($artist_permit->artist->name) !!}
                                                    </div>
                                                    @endif
                                                
                                                 
                                                    <div class="kt-widget__content">
                                                        <div class="kt-widget__head">
                                                            <span class="kt-widget__username">
                                                                {{ ucwords($artist_permit->artist->name ) }}
                                                            </span>
                                                       {{--      <a href="#" class="kt-widget__username">
                                                                Jason Muller
                                                                <i class="flaticon2-correct kt-font-success"></i>
                                                            </a> --}}
                                                            <div class="kt-widget__action">
                                                                <button type="button" class="btn btn-label-success btn-sm btn-upper">ask</button>&nbsp;
                                                                <button type="button" class="btn btn-brand btn-sm btn-upper">hire</button>
                                                            </div>
                                                        </div>
                                                        <div class="kt-widget__subhead">
                                                            <a href="#"><i class="flaticon2-new-email"></i>jason@siastudio.com</a>
                                                            <a href="#"><i class="flaticon2-calendar-3"></i>PR Manager </a>
                                                            <a href="#"><i class="flaticon2-placeholder"></i>Melbourne</a>
                                                        </div>
                                                        <div class="kt-widget__info">
                                                            <div class="kt-widget__desc">
                                                                I distinguish three main text objektive could be merely to inform people.<br>
                                                                A second could be persuade people.You want people to bay objective
                                                            </div>
                                                            <div class="kt-widget__progress">
                                                                <div class="kt-widget__text">
                                                                    Progress
                                                                </div>
                                                                <div class="progress" style="height: 5px;width: 100%;">
                                                                    <div class="progress-bar kt-bg-success" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                                <div class="kt-widget__stats">
                                                                    78%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                <div class="kt-widget__bottom">
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-piggy-bank"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Earnings</span>
                                            <span class="kt-widget__value"><span>$</span>249,500</span>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-confetti"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Expenses</span>
                                            <span class="kt-widget__value"><span>$</span>164,700</span>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-pie-chart"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">Net</span>
                                            <span class="kt-widget__value"><span>$</span>782,300</span>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-file-2"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">73 Tasks</span>
                                            <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-chat-1"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <span class="kt-widget__title">648 Comments</span>
                                            <a href="#" class="kt-widget__value kt-font-brand">View</a>
                                        </div>
                                    </div>
                                    <div class="kt-widget__item">
                                        <div class="kt-widget__icon">
                                            <i class="flaticon-network"></i>
                                        </div>
                                        <div class="kt-widget__details">
                                            <div class="kt-section__content kt-section__content--solid">
                                                <div class="kt-badge kt-badge__pics">
                                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="John Myer">
                                                        <img src="./assets/media/users/100_7.jpg" alt="image">
                                                    </a>
                                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Alison Brandy">
                                                        <img src="./assets/media/users/100_3.jpg" alt="image">
                                                    </a>
                                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Selina Cranson">
                                                        <img src="./assets/media/users/100_2.jpg" alt="image">
                                                    </a>
                                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Luke Walls">
                                                        <img src="./assets/media/users/100_13.jpg" alt="image">
                                                    </a>
                                                    <a href="#" class="kt-badge__pic" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" title="" data-original-title="Micheal York">
                                                        <img src="./assets/media/users/100_4.jpg" alt="image">
                                                    </a>
                                                    <a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">
                                                        +7
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                        </div>
                                                <div class="tab-pane" id="kt_tabs_6_2" role="tabpanel">
                                                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                                                </div>
                                                <div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">
                                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
                                                </div>
                                            </div>
                                </div>
                            </div>

                            <!--end: Form Wizard Step 5-->

                            <!--begin: Form Actions -->
                            <div class="kt-form__actions">
                                <div class="btn btn-secondary kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                    Previous
                                </div>
                                <div class="btn btn-success btn-sm  kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                    Finish & Continue
                                </div>
                             {{--    <div class="btn btn-brand btn-sm  kt-font-bold kt-font-transform-u">
                                    Return Request
                                </div>
                                <div class="btn btn-brand  kt-font-bold kt-font-transform-u">
                                    Submit for Approval
                                </div> --}}
                                <div class="btn btn-brand kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
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
</section>
<section class="row">
    <div class="col-md-12">
         <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Artist Permit History</h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet--height-fluid">
                <table class="table table-striped table-bordered table-hover table-checkable" id="artist-history">
                    <thead>
                        <tr>
                            <th>Permit Number</th>
                            <th>Profession</th>
                            <th>Issued Date</th>
                            <th>Expired Date</th>
                            {{-- <th>Work Location</th> --}}
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
@php
$isAdmin = false;
foreach (Auth::user()->roles as $role) {
    if($role->NameEn == 'admin'){
        $isAdmin =true;
    }
}
@endphp

@endsection
@section('script')
<script>
    var checklist = [];
    var artist_history = {};
    var artist_comment = null;
    var document_comment = null;
  
  // Class definition
    var KTWizard3 = function () {
        // Base elements
        var wizardEl;
        var formEl;
        var validator;
        var wizard;
        
        // Private functions
        var initWizard = function () {
            // Initialize form wizard
          
            wizard = new KTWizard('artist-wizard', { startStep: 3});


            // Validation before going to next page
            wizard.on('beforeNext', function(wizardObj) {
                if(!'{{$isAdmin}}' && wizardObj.currentStep == 2){
                      wizardObj.stop();
                }
               
             
                var counter = 0;
                $('input[data-field=1]').each(function(){
                    if($(this).prop('checked')){ counter++;}
                });
                if(counter == 0){ 
                    wizardObj.stop();
                    $.notify({
                        title: '',
                        message: 'Please Check the Artist Information first before procceding to the next steps.',
                    },{
                        type:'warning',
                        animate: {
                            enter: 'animated zoomIn',
                            exit: 'animated zoomOut'
                        },
                    });
                }
            });

            wizard.on('change', function(wizardObj){

               // var artist_comment = $('textarea.comment#artist-comment').val();
               // var document_comment = $('textarea.comment#document-comment').val();

             
            });



        }

        var initValidation = function() {
            validator = formEl.validate({
                // Validate only visible fields
                ignore: ":hidden",

                // Validation rules
                rules: {
                    //= Step 1
                    address1: {
                        required: true 
                    },
                    postcode: {
                        required: true
                    },     
                    city: {
                        required: true
                    },   
                    state: {
                        required: true
                    },   
                    country: {
                        required: true
                    },   

                    //= Step 2
                    package: {
                        required: true
                    },
                    weight: {
                        required: true
                    },  
                    width: {
                        required: true
                    },
                    height: {
                        required: true
                    },  
                    length: {
                        required: true
                    },             

                    //= Step 3
                    delivery: {
                        required: true
                    },
                    packaging: {
                        required: true
                    },  
                    preferreddelivery: {
                        required: true
                    },  

                    //= Step 4
                    locaddress1: {
                        required: true 
                    },
                    locpostcode: {
                        required: true
                    },     
                    loccity: {
                        required: true
                    },   
                    locstate: {
                        required: true
                    },   
                    loccountry: {
                        required: true
                    },
                },
                
                // Display error  
                // invalidHandler: function(event, validator) {     
                //     KTUtil.scrollTop();

                //     swal.fire({
                //         "title": "", 
                //         "text": "There are some errors in your submission. Please correct them.", 
                //         "type": "error",
                //         "confirmButtonClass": "btn btn-secondary"
                //     });
                // },

                // Submit valid form
                submitHandler: function (form) {
                    
                }
            });   
        }

        var initSubmit = function() {
            var btn = formEl.find('[data-ktwizard-type="action-submit"]');

            btn.on('click', function(e) {
                e.preventDefault();

                if (validator.form()) {
                    // See: src\js\framework\base\app.js
                    KTApp.progress(btn);
                    //KTApp.block(formEl);

                    // See: http://malsup.com/jquery/form/#ajaxSubmit
                    formEl.ajaxSubmit({
                        success: function() {
                            KTApp.unprogress(btn);
                            //KTApp.unblock(formEl);

                            swal.fire({
                                "title": "", 
                                "text": "The application has been successfully submitted!", 
                                "type": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            });
                        }
                    });
                }
            });
        }

        return {
            // public functions
            init: function() {
                wizardEl = KTUtil.get('kt_wizard_v3');
                formEl = $('#kt_form');

                initWizard(); 
                initValidation();
                initSubmit();
            }
        };
    }();

  
    $(document).ready(function(){
          console.log(KTApp.block);
          KTWizard3.init();

       

          $('button#btn-draft').click(function(){
            $('input[type=checkbox][data-field=1]').each(function(){
                  var fieldname = $(this).prop('name');
                  var old_value = $('input[name='+fieldname+'_val]').val();
                  var check = $(this).is(':checked') ?  1 : 0;
                  checklist.push({fieldname: fieldname , old_value: old_value, ischeck : check });
            });
            $.ajax({
                url: '{{ route('admin.artist_permit.checkApplication.savedraft', ['permit'=>$artist_permit->permit_id, 'artistpermit'=>$artist_permit->artist_permit_id]) }}',
                type: 'post',
                data: { data: checklist, comment: $('textarea').val()},
                beforeSend: function(){
                   KTApp.block('#kt_blockui_4_3_modal .modal-content', {
                       overlayColor: '#000000',
                       type: 'v2',
                       state: 'success',
                       size: 'lg'
                   });
                }
            }).done(function(){
                checklist = [];
            });
           
          });
     
 
        $('input[type=checkbox][data-field=1]').each(function(){ 
              if( $(this).prop('checked') ){
                  $(this).parents('.input-group').find('input[type=text]').addClass('is-valid');
              }
               else{
                $(this).parents('.input-group').find('input[type=text]').addClass('is-invalid');
                }
          });

        $('input[type=checkbox][data-field=1]').change(function(){
            if($(this).is(':checked')){
                 $(this).parents('.input-group').find('input[type=text]').removeClass('is-invalid').addClass('is-valid');
            }
             else{
                $(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
            }

        });


      artist_history = $('#artist-history').DataTable({
                          ajax:{
                              url: '{{ route('admin.artist_permit.history', $artist_permit->artist_permit_id) }}'
                          },
                          columnDefs: [
                              {targets: [5] , className: 'no-wrap',  orderable: false},
                              {targets: [4] , className: 'no-wrap'},
                          ],
                          columns: [
                              {data: 'permit_number'},
                              {data: 'name_en'},
                              {data: 'issued_date'},
                              {data: 'expired_date'},
                              // {data: 'work_location'},
                              {
                                  render: function(data, type, full, meta){

                                      return '@label(['class'=>'danger'])'+full.permit_status+'@endlabel';
                                  }
                              },
                              {
                                  render: function(data, type, full, meta){

                                      return '<a href="#" class="btn btn-raised btn-view active btn-sm btn-brand">view details</a>';
                                  }
                              }
                          ],

                          fnCreatedRow: function(row ,data, index){

                            // $('a.btn-view', row).click(function(){

                            // });
                          },

                          initComplete: function(setting, json){
                            if(json.recordsTotal > 0){
                                 $('#artist-history').parents('.row').find('.kt-portlet').show();
                            }
                          }
                      });
        $('#artist-history').parents('.row').find('.kt-portlet').hide();
        $('#artist-history').wrap('<div class="table-responsive"></div>');
    });
</script>
@endsection

