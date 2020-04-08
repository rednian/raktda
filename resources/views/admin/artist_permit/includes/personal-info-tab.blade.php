<section class="accordion accordion-solid accordion-toggle-plus kt-margin-b-10" id="accordion-personal">
    <div class="card border">
        <div class="card-header" id="heading-personal">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-personal" aria-expanded="true" aria-controls="collapse-personal">
                <h6 class="kt-font-dark kt-font-transform-u">{{ __('Artist Details') }}</h6>
            </div>
        </div>
        <div id="collapse-personal" class="collapse show" aria-labelledby="heading-personal" data-parent="#accordion-personal" style="">
            <section class="card-body">
                <section class="kt-form kt-form--label-right ">
                    <div class="form-group form-group-sm  row">
                        <label class="col-3 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{ __('CHECK ALL ARTIST DETAILS') }}</label>
                        <div class="col-1">
                            <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
                                <label>
                                    <input type="checkbox" id="checked-all-detail" name="">
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-sm-6">
                        <section class="kt-form kt-form--label-right">
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('First Name') }}
                                    <span class="kt-font-danger">*</span>
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Last Name') }}
                                    <span class="kt-font-danger">*</span>
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Profession') }}
                                    <span class="kt-font-danger">*</span>
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
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Nationality') }}</label>
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
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Religion') }}</label>
                                    <div class="col-lg-8">
                                        <div class="input-group input-group-sm">
                                            <input value="{{ ucwords($artist_permit->religion->name_en) }}" readonly type="text" class="form-control form-control-sm">
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
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Gender') }} <span class="kt-font-danger">*</span></label>
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
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Person Code') }} <span class="kt-font-danger">*</span></label>
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
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Passport No.') }} <span class="kt-font-danger">*</span></label>
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
                                    <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Visa Number') }}</label>
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('First Name (AR)') }}<span class="kt-font-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input {{ is($artist_permit, 'firstname') ? 'is-valid': null }} value="{{ ucwords($artist_permit->firstname_ar) }}" readonly type="text" class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" name="check[firstname]" value="{{ ucwords($artist_permit->firstname_ar) }}" type="checkbox">
                                               <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Last Name (AR)') }}<span class="kt-font-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ ucwords($artist_permit->lastname_ar) }}" readonly type="text" class="form-control form-control-sm">
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
                            {{--  <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Identification No.') }} <span class="kt-font-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->identification_number }}" readonly type="text" class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" value="{{ $artist_permit->identification_number }}" type="checkbox">
                                                   <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>  --}}
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Birthdate') }} <span class="kt-font-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->birthdate->format('d-M-Y') }}" readonly type="text" class="form-control form-control-sm">
                                        <div class="input-group-append">
                                           <span class="input-group-text">
                                             <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                               <input data-step="step-1" value="{{ $artist_permit->birthdate }}" type="checkbox">
                                                   <span></span>
                                             </label>
                                           </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Passport Expiry Date') }} <span class="kt-font-danger">*</span></label>
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
                            <div class="form-group form-group-sm row kt-hide">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{__('UID Expiry Date')}}  <span class="kt-font-danger">*</span></label>
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Language') }}</label>
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('UID No.') }} <span class="kt-font-danger">*</span></label>
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Visa Expiry Date') }} </label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->visa_number ? ucwords($artist_permit->visa_expire_date->format('d-M-Y')): null }}" readonly type="text" class="form-control form-control-sm">
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
