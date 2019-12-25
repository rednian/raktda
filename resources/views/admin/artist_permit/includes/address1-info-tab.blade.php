<section class="accordion accordion-solid accordion-toggle-plus  kt-margin-b-10" id="accordion-addres1">
    <div class="card">
        <div class="card-header" id="heading-addres1">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-addres1" aria-expanded="true" aria-controls="collapse-addres1">
                <h6 class="kt-font-dark kt-font-transform-u">{{ __('Address Information') }}</h6>
            </div>
        </div>
        <div id="collapse-addres1" class="collapse show" aria-labelledby="heading-addres1" data-parent="#accordion-addres1" style="">
            <section class="card-body">
                <div class="kt-form kt-form--label-right">
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="example-search-input" class="col-2 col-form-label kt-font-dark">{{ __('Address') }} <span
                                                                            class="text-danger">*</span></label>
                                                                    <div class="col-10">
                                                                        <div class="input-group input-group-sm">
                                                                            <input value="{{ ucwords($artist_permit->address_en) }}" type="text" readonly
                                                                                         class="form-control form-control-sm">
                                                                            <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ ucwords($artist_permit->address_en) }}"
                                                                                                         type="checkbox" name="address">
                                              <span></span>
                                            </label>
                                          </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group form-group-sm row">
                                                                    <label for="example-search-input" class="col-2 col-form-label kt-font-dark">{{ __('P.O. Box') }} </label>
                                                                    <div class="col-10">
                                                                        <div class="input-group input-group-sm">
                                                                            <input value="{{ ucwords($artist_permit->po_box) }}" type="text" readonly
                                                                                         class="form-control form-control-sm">
                                                                            <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ ucwords($artist_permit->po_box) }}"
                                                                                                         type="checkbox" name="po box">
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
                                                                            <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Area') }}</label>
                                                                            <div class="col-8">
                                                                                <div class="input-group input-group-sm">
                                                                                    <input value="{{ ucwords($artist_permit->area->area_en) }}" type="text" readonly
                                                                                                 class="form-control form-control-sm">
                                                                                    <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-step="step-1" value="{{ ucwords($artist_permit->area->area_en) }}"
                                                                                                                 type="checkbox" name="area">
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
                                                                            <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Emirate') }}</label>
                                                                            <div class="col-8">
                                                                                <div class="input-group input-group-sm">
                                                                                    <input value="{{ ucwords($artist_permit->emirate->name_en) }}" type="text" readonly
                                                                                                 class="form-control form-control-sm">
                                                                                    <div class="input-group-append">
                                              <span class="input-group-text">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                                  <input data-step="step-1" value="{{ ucwords($artist_permit->emirate->name_en) }}"
                                                                                                                 type="checkbox" name="area">
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
            </section>
        </div>
    </div>
</section>