@extends('layouts.admin.admin-app')
@section('style')
<link href="{{ asset('/assets/css/wizard-3.css') }}" rel="stylesheet" type="text/css" />
</style>
@endsection
@section('content')
<div  class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border" id="kt_page_portlet">
  <div class="kt-portlet__head kt-portlet__head--sm">
      <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ strtoupper($artist_permit->artist->fullName) }}</span></h3>
      </div>
      <div class="kt-portlet__head-toolbar">
        <a href="{{ route('admin.artist_permit.applicationdetails', $permit->permit_id) }}" class="btn btn-sm btn-secondary btn-elevate kt-margin-r-4 kt-font-transform-u"><i class="la la-arrow-left"></i> Back to permit details</a>
        <div class="dropdown dropdown-inline">
          <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="flaticon-more"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" >
            <a class="dropdown-item kt-font-transform-u" href="{{ route('admin.artist_permit.index') }}">Artist Permit list</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item kt-font-transform-u" href="{{ route('admin.artist.show', $artist_permit->artist_id) }}">Artist Information</a>
            <a class="dropdown-item kt-font-transform-u" href="javascript:void(0)">Company Information</a>
          </div>
        </div>
      </div>
  </div>
  <div class="kt-portlet__body kt-padding-t-5">
    <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">
      <div class="kt-grid__item">

        <!--begin: Form Wizard Nav -->
        <div class="kt-wizard-v3__nav">
          <div class="kt-wizard-v3__nav-items">
            <a class="kt-wizard-v3__nav-item" href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="current">
              <div class="kt-wizard-v3__nav-body">
                <div class="kt-wizard-v3__nav-label  text-center">
                  <span>1</span> 
                </div>
                <div class="kt-wizard-v3__nav-bar"></div>
              </div>
            </a>
            <a class="kt-wizard-v3__nav-item" href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending">
              <div class="kt-wizard-v3__nav-body">
                <div class="kt-wizard-v3__nav-label  text-center">
                  <span>2</span>
                </div>
                <div class="kt-wizard-v3__nav-bar"></div>
              </div>
            </a>
            <a class="kt-wizard-v3__nav-item" href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending">
              <div class="kt-wizard-v3__nav-body">
                <div class="kt-wizard-v3__nav-label  text-center">
                  <span>3</span> 
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
            <div class="kt-wizard-v3__form">
              <section class="row">
                <div class="col kt-margin-t-20 kt-margin-b-20">
                  <div class="form-group sticky">
                    <textarea name="comment" v-model="comment" id="" class="form-control form-control-sm" rows="3" placeholder="Some remarks here..."></textarea>
                  </div>
                  <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                    <div class="card">
                      <div class="card-header" id="headingOne6">
                        <div class="card-title" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                          <h6 class="kt-font-dark kt-font-transform-u">Personal information</h6>
                        </div>
                      </div>
                      <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                        <div class="card-body">
                         <section class="row">
                           <div class="col-6">
                             <section class="kt-form kt-form--label-right">
                                 <div class="form-group form-group-sm row">
                                      <label for="example-search-input" class="col-4 col-form-label kt-font-dark">First Name <span class="text-danger">*</span></label>
                                      <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input {{ is($artist_permit, 'firstname') ? 'is-valid': null }} value="{{ ucwords($artist_permit->artist->firstname_en) }}" readonly type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" name="firstname" value="{{ ucwords($artist_permit->artist->firstname_en) }}" type="checkbox" value="off">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Person Code <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input readonly type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ $artist_permit->artist->person_code }}"  name="person code" type="checkbox">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Gender <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ ucwords($artist_permit->artist->gender->name_en) }}" type="text" readonly  class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ ucwords($artist_permit->artist->gender->name_en) }}" name="gender" type="checkbox">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Nationality <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ ucwords($artist_permit->artist->nationality) }}" readonly  type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ ucwords($artist_permit->artist->nationality) }}" type="checkbox" name="nationality">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Passport No. <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ ucwords($artist_permit->passport_number) }}" readonly  type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ ucwords($artist_permit->passport_number) }}" type="checkbox" name="passport number">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">UID No. <span class="text-danger">*</span></label>
                                     <div class="col-lg-8"> 
                                          <div class="input-group input-group-sm">
                                             <input value="{{ ucwords($artist_permit->uid_number) }}" readonly type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ ucwords($artist_permit->uid_number) }}" type="checkbox" name="UID number">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                             </section>
                           </div>
                           <div class="col-6">
                             <section class="kt-form kt-form--label-right">
                                 <div class="form-group form-group-sm row">
                                      <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Last Name <span class="text-danger">*</span></label>
                                      <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ ucwords($artist_permit->artist->lastname_en) }}" readonly  type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" name="lastname" value="{{ ucwords($artist_permit->artist->lastname_en) }}" type="checkbox">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Profession <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ ucwords($artist_permit->permittype->name_en) }}" readonly name="profession_en" type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ ucwords($artist_permit->permittype->name_en) }}" type="checkbox" name="profession">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Age <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ $artist_permit->artist->age }}" readonly type="text" class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default" >
                                                   <input name="age" data-check="checklist" value="{{ $artist_permit->artist->age }}" type="checkbox">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                           @if ($artist_permit->artist->age < 18)
                                              <span class="form-text text-danger">Age is less than 18.</span>
                                           @endif
                                          
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Language</label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ $artist_permit->language->name_en ? $artist_permit->language->name_en : null}}" type="text" readonly class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default" >
                                                   <input data-check="checklist" value="{{ $artist_permit->language->name_en ? $artist_permit->language->name_en : null}}" type="checkbox" name="language">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Passport Expiry <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ $artist_permit->passport__expire_date }}" type="text"  readonly class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-check="checklist" value="{{ $artist_permit->passport__expire_date }}" type="checkbox" name="passport expiry date">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                                 <div class="form-group form-group-sm row">
                                     <label for="example-search-input" class="col-4 col-form-label kt-font-dark">UID Expiry <span class="text-danger">*</span></label>
                                     <div class="col-lg-8">
                                          <div class="input-group input-group-sm">
                                             <input value="{{ $artist_permit->uid_expire_date->format('d-M-d') }}"  type="text"  readonly class="form-control form-control-sm">
                                             <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default" >
                                                   <input data-check="checklist" value="{{ $artist_permit->uid_expire_date->format('d-M-d') }}" type="checkbox" name="UID expire date">
                                                   <span></span>
                                                 </label>
                                               </span>
                                             </div>
                                           </div>
                                      </div>
                                 </div>
                             </section>
                           </div>
                         </section>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="false" aria-controls="collapseTwo6">
                          <h6 class="kt-font-dark kt-font-transform-u">Contact information</h6>
                        </div>
                      </div>
                      <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6" data-parent="#accordionExample6">
                        <div class="card-body">
                          <section class="row">
                            <div class="col-6">
                              <section class="kt-form kt-form--label-right">
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Mobile Number <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ $artist_permit->mobile_number }}" type="text"  readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ $artist_permit->mobile_number }}" type="checkbox" name="mobile number">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div>
                                </div>
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Fax Number <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ $artist_permit->fax_number }}" type="text"  readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ $artist_permit->fax_number }}" type="checkbox" name="fax number">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div>
                                </div>
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Sponsor Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ $artist_permit->sponsor_name_en }}" type="text"  readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ $artist_permit->sponsor_name_en }}" type="checkbox" name="sponsor name">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div>
                                </div>
                              </section>
                            </div>
                            <div class="col-6">
                              <section class="kt-form kt-form--label-right">
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Phone Number <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ $artist_permit->phone_number }}" type="text"  readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ $artist_permit->phone_number }}" type="checkbox" name="phone number">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div>
                                </div>
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Email Address <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ $artist_permit->email }}" type="text" readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ $artist_permit->email }}" type="checkbox" name="email">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div>
                                </div>
                              </section>
                            </div>
                          </section>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingThree6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false" aria-controls="collapseThree6">
                         <h6 class="kt-font-dark kt-font-transform-u">Address information</h6>
                        </div>
                      </div>
                      <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6" data-parent="#accordionExample6">
                        <div class="card-body">
                          <div class="kt-form kt-form--label-right">
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-2 col-form-label kt-font-dark">Address <span class="text-danger">*</span></label>
                                <div class="col-10">
                                     <div class="input-group input-group-sm">
                                       <input value="{{ ucwords($artist_permit->address_en) }}" type="text"  readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-check="checklist" value="{{ ucwords($artist_permit->address_en) }}" type="checkbox" name="address">
                                              <span></span>
                                            </label>
                                          </span>
                                        </div>
                                      </div>
                                 </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-2 col-form-label kt-font-dark">P.O. Box <span class="text-danger">*</span></label>
                                <div class="col-10">
                                     <div class="input-group input-group-sm">
                                        <input value="{{ ucwords($artist_permit->po_box) }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-check="checklist" value="{{ ucwords($artist_permit->po_box) }}" type="checkbox" name="po box">
                                              <span></span>
                                            </label>
                                          </span>
                                        </div>
                                      </div>
                                 </div>
                            </div>
                            <section class="row">
                              <div class="col-6">
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Area <span class="text-danger">*</span></label>
                                    <div class="col-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ ucwords($artist_permit->area->area_en) }}" type="text"  readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ ucwords($artist_permit->area->area_en) }}" type="checkbox" name="area">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div>
                                </div>
                              </div>
                              <div class="col-6">
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">City <span class="text-danger">*</span></label>
                                    <div class="col-8">
                                         <div class="input-group input-group-sm">
                                            <input value="{{ ucwords($artist_permit->emirate->name_en) }}" type="text"  readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-check="checklist" value="{{ ucwords($artist_permit->emirate->name_en) }}" type="checkbox" name="area">
                                                  <span></span>
                                                </label>
                                              </span>
                                            </div>
                                          </div>
                                     </div> 
                                </div>
                              </div>
                            </section>
                          </div>
                          
                        </div>
                      </div>
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
              <section class="row">
                <div class="col kt-margin-t-20 kt-margin-b-20">
                  <section class="form-group sticky">
                    <textarea v-model="comment" name="comment" rows="3" class="form-control form-control-sm" placeholder="Some remarks here..."></textarea>
                  </section>
                  <?php 
                    $nearly_expire = $artist_permit->artistPermitDocument()->whereDate('expired_date', '<', Carbon\Carbon::now()->addMonth())->get();
                   ?>
                  @if ($nearly_expire->count() > 0)
                    <div class="alert alert-outline-danger fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">
                          <div>The Following documents either about to expire or already expired.</div>
                          <ol>
                            @foreach ($nearly_expire as $document)
                              <li>{{ ucfirst($document->document_name) }}</li>
                            @endforeach
                          </ol>
                        </div>
                        <div class="alert-close">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                          </button>
                        </div>
                      </div>
                  @endif
                  <table class="table table-hover table-borderless table-striped" id="document-table">
                    <thead class="thead-dark">
                      <tr>
                        <th>Document Name</th>
                        <th>Issued Date</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    </table>
                </div>
              </section>
            </div>
          </div>
        </div>
      <!--end: Form Wizard Step 2-->

      <!--begin: Form Wizard Step 3-->
      <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
        <div class="kt-form__section kt-form__section--first">
          <div class="kt-wizard-v3__form">
            <section class="row">
              <div class="col kt-margin-t-20 kt-margin-b-20">
                <section class="form-group sticky">
                  <textarea v-model="comment" name="comment" rows="3" class="form-control form-control-sm" placeholder="Some remarks here..."></textarea>
                </section>

                @if ($existing_permit->count() > 0)
                  <div class="alert alert-outline-danger show" role="alert">
                    <div class="alert-icon"><i class="flaticon-danger"></i></div>
                    <div class="alert-text"><span class="text-danger kt-font-bold">
                      {{ strtoupper($artist_permit->artist->fullName) }}
                    </span> has <span class="text-danger kt-font-bolder">{{ $existing_permit->count() }}</span> active Permit.</div>
                    <div class="alert-close">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="la la-close"></i></span>
                      </button> 
                    </div>
                  </div>
                <table class="table table-hover table-striped table-borderless" id="permit-history">
                    <thead class="thead-dark">
                      <tr>
                        <th>Reference No.</th>
                        <th>Company Name</th>
                        <th>Permit No.</th>
                        <th>Permit Start</th>
                        <th>Permit Expiry</th>
                        <th>Permit Status</th>
                      </tr>
                    </thead>
                  </table>
                  @else

                @endif
              </div>
            </section>
          </div>
        </div>
      </div>
      <!--end: Form Wizard Step 3-->
      <!--begin: Form Actions -->
      <div class="kt-form__actions">
        <div class="btn btn-elevate btn-secondary  btn-sm kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
        Previous
        </div>
        <div class="btn active btn-elevate btn-warning kt-font-bold  btn-sm kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
        Next
        </div>
        <div class="btn active btn-warning btn-sm kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
          Finish & New
        </div>
      </div>
      <!--end: Form Actions -->
  </form>
      <!--end: Form Wizard Form-->
  </div>
</div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.common.dev.js"></script>
{{-- <script src="{{ asset('/assets/js/wizard-3.js') }}"></script> --}}
<script type="text/javascript">
  new Vue({
    el: '#kt_page_portlet',
    data: {
      comment: null
    }
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var form = $('form#kt_form');
    var wizardEl;
       var validator;
       var wizard =  new KTWizard("kt_wizard_v3", { startStep: 1 });
           // wizard.on("beforeNext", function(wizardObj) {
           //  if (validator.form() !== true) {
           //        wizardObj.stop(); 
           //    }
           // }).on("change", function(wizard) { KTUtil.scrollTop(); });
           // form.validate({
           //  ignore: true,
           //  rules:{

           //  }
           // });
  });
</script>
<script>
  var checklist = [];
  $(document).ready(function(){


    $('div[data-ktwizard-type=action-submit]').click(function(){
      
      $('input[type=checkbox][data-check=checklist]').each(function(){
        if(!$(this).is(':checked')){
          checklist.push({ fieldname: $(this).attr('name') , value: $(this).val() });
        }
      });

      $.ajax({
        url:'{{ url('/artist_permit') }}/'+{{ $permit->permit_id }}+'/application/'+{{ $artist_permit->artist_permit_id }}+'/checklist',
        data: {checklist: checklist, comment: $('textarea[name=comment]').val() },
        type: 'post',
        dataType:'json'
      }).done(function(response){
          checklist = [];
          var url = '{{ url('/artist_permit') }}/'+{{ $permit->permit_id }}+'/application';
           location.replace(url);
        
      });

  });

     $('#document-table').DataTable({
      ajax:{
        url: '{{ url('/permit/artist_permit') }}/'+{{ $permit->permit_id }}+'/application/'+{{ $artist_permit->artist_permit_id }}+'/documentDatatable'
      },
        columnDefs: [
             {targets: [3], className: 'no-wrap'},
             {targets:  [3], className: 'no-wrap',sortable: false},
        ],
        columns: [
            { data: 'document_name'},
            { data: 'issued_date'},
            { data: 'expired_date'},
            { data: 'action'},
        ],
    });


     $('#permit-history').DataTable({
      ajax:{
        url: '{{ url('/permit/artist_permit') }}/'+{{ $permit->permit_id }}+'/application/'+{{ $artist_permit->artist_id }}+'/permitHistory'
      },
        columnDefs: [
             {targets: [0], className: 'no-wrap'},
             {targets:  [0], className: 'no-wrap',sortable: false},
        ],
        columns: [
            { data: 'reference_number'},
            { data: 'company_name'},
            { data: 'permit_number'},
            { data: 'permit_start'},
            { data: 'expiry_date'},
            { data: 'permit_status'},
        ],
    });
  });
</script>
@endsection