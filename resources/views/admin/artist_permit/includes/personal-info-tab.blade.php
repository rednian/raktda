<section class="accordion accordion-solid accordion-toggle-plus kt-margin-b-10" id="accordion-personal">
    <div class="card">
        <div class="card-header" id="heading-personal">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-personal" aria-expanded="true" aria-controls="collapse-personal">
                <h6 class="kt-font-dark kt-font-transform-u">Personal information</h6>
            </div>
        </div>
        <div id="collapse-personal" class="collapse show" aria-labelledby="heading-personal" data-parent="#accordion-personal" style="">
            <section class="card-body">
                <section class="row">
                    <div class="col-sm-6">
                        <section class="kt-form kt-form--label-right">
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">First Name
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input {{ is($artist_permit, 'firstname') ? 'is-valid': null }} value="{{ ucwords($artist_permit->firstname_en) }}" readonly type="text" class="form-control form-control-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                    <input data-step="step-1" name="check[firstname]" value="{{ ucwords($artist_permit->firstname_en) }}" type="checkbox">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Last Name 
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ ucwords($artist_permit->lastname_en) }}" readonly type="text"
                                                     class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" name="check[lastname]" value="{{ ucwords($artist_permit->lastname_en) }}" type="checkbox">
                                               <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Profession
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ ucwords($artist_permit->profession->name_en) }}" readonly type="text"
                                                         class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" value="{{ ucwords($artist_permit->profession->name_en) }}" type="checkbox" name="check[profession]">
                                               <span></span>
                                             </label>
                                           </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Nationality</label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input value="{{ ucwords($artist_permit->country->nationality_en) }}" readonly type="text" class="form-control form-control-sm">
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-step="step-1" data-check="checklist" value="{{ ucwords($artist_permit->country->nationality_en) }}" type="checkbox"
                                                                                                                    name="check[nationality]">
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
                                            <input value="{{ ucwords($artist_permit->gender->name_en) }}" type="text" readonly class="form-control form-control-sm">
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-step="step-1" value="{{ ucwords($artist_permit->gender->name_en) }}" name="check[gender]" type="checkbox">
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
                                            <input readonly type="text" value="{{ $artist_permit->artist->person_code }}" class="form-control form-control-sm">
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-step="step-1" value="{{ $artist_permit->artist->person_code }}" name="check[person_code]" type="checkbox">
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
                                            <input value="{{ ucwords($artist_permit->passport_number) }}" readonly type="text" class="form-control form-control-sm">
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-step="step-1" value="{{ ucwords($artist_permit->passport_number) }}" type="checkbox" name="check[passport_number]">
                                                   <span></span>
                                                 </label>
                                               </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Visa No. <span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input value="{{ ucwords($artist_permit->visa_number) }}" readonly type="text" class="form-control form-control-sm">
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-step="step-1" value="{{ ucwords($artist_permit->visa_number) }}" type="checkbox" name="check[visa_number]">
                                                   <span></span>
                                                 </label>
                                               </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </section>
                    </div>
                    <div class="col-sm-6">
                        <section class="kt-form kt-form--label-right">
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">First Name (AR)<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input {{ is($artist_permit, 'firstname') ? 'is-valid': null }} value="{{ ucwords($artist_permit->artist->firstname_ar) }}" readonly type="text" class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" name="check[firstname]" value="{{ ucwords($artist_permit->artist->firstname_ar) }}" type="checkbox">
                                               <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Last Name (AR)<span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ ucwords($artist_permit->artist->lastname_ar) }}" readonly type="text" class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" name="check[lastname]" value="{{ ucwords($artist_permit->artist->lastname_en) }}" type="checkbox">
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
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" value="{{ $artist_permit->artist->age }}" type="checkbox">
                                                   <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                    @if ($artist_permit->age < 18)
                                        <span class="form-text text-danger">Age is less than 18.</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Passport Expiry <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->passport_expire_date->format('d-M-Y') }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1"value="{{ $artist_permit->passport_expire_date->format('d-M-Y') }}" type="checkbox" name="passport expiry date">
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
                                        <input value="{{ $artist_permit->uid_expire_date->format('d-M-d') }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" value="{{ $artist_permit->uid_expire_date->format('d-M-d') }}" type="checkbox" name="UID expire date">
                                               <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Language</label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->language->name_en ? $artist_permit->language->name_en : null}}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" value="{{ $artist_permit->language->name_en ? $artist_permit->language->name_en : null}}" type="checkbox" name="language">
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
                                               <input data-step="step-1" value="{{ ucwords($artist_permit->uid_number) }}" type="checkbox" name="check[uid_number]">
                                               <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group form-group-sm row">
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">Visa Expiry<span class="text-danger">*</span></label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input value="{{ $artist_permit->visa_expire_date ? ucwords($artist_permit->visa_expire_date->format('d-M-Y')): null }}" readonly type="text" class="form-control form-control-sm">
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                   <input data-step="step-1" value="{{ $artist_permit->visa_expire_date ? ucwords($artist_permit->visa_expire_date->format('d-M-Y')): null }}" type="checkbox" name="check[visa_expiry_date]">
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
            </section>
        </div>
    </div>
</section>