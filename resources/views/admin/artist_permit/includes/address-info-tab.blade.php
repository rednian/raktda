<section class="accordion accordion-solid accordion-toggle-plus  kt-margin-b-10" id="accordion-contact">
    <div class="card border">
        <div class="card-header" id="heading-contact">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-contact" aria-expanded="true" aria-controls="collapse-contact">
                <h6 class="kt-font-dark kt-font-transform-u">{{ __('CONTACT DETAILS') }}</h6>
            </div>
        </div>
        <div id="collapse-contact" class="collapse show" aria-labelledby="heading-contact" data-parent="#accordion-contact" style="">
            <section class="card-body">
              <section class="kt-form kt-form--label-right ">
                  <div class="form-group form-group-sm  row">
                      <label class="col-4 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{ __('CHECK ALL ARTIST CONTACT DETAILS') }}</label>
                      <div class="col-1">
                          <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
                              <label>
                                  <input type="checkbox" id="checked-all-contact" name="">
                                  <span></span>
                              </label>
                          </span>
                      </div>
                  </div>
              </section>
                <section class="row">
                    <div class="col-6">
                        <section class="kt-form kt-form--label-right">
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Mobile Number') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->mobile_number }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ $artist_permit->mobile_number }}" type="checkbox" name="mobile number">
                                              <span></span>
                                            </label>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Fax Number') }}</label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->fax_number }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ $artist_permit->fax_number }}" type="checkbox" name="fax number">
                                              <span></span>
                                            </label>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Sponsor Name') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->sponsor_name_en }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ $artist_permit->sponsor_name_en }}" type="checkbox" name="sponsor name">
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
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Phone Number') }} <span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->phone_number }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ $artist_permit->phone_number }}" type="checkbox" name="phone number">
                                              <span></span>
                                            </label>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-sm row">
                                <label for="example-search-input" class="col-4 col-form-label kt-font-dark">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <div class="input-group input-group-sm">
                                        <input value="{{ $artist_permit->email }}" type="text" readonly class="form-control form-control-sm">
                                        <div class="input-group-append">
                                          <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                              <input data-step="step-1" value="{{ $artist_permit->email }}" type="checkbox" name="email">
                                              <span></span>
                                            </label>
                                          </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="form-group form-group-sm row">--}}
                                {{--<label for="example-search-input" class="col-4 col-form-label kt-font-dark">Sponsor Name (AR)<span--}}
                                        {{--class="text-danger">*</span></label>--}}
                                {{--<div class="col-lg-8">--}}
                                    {{--<div class="input-group input-group-sm">--}}
                                        {{--<input value="{{ $artist_permit->sponsor_name_ar}}" type="text" readonly--}}
                                                     {{--class="form-control form-control-sm">--}}
                                        {{--<div class="input-group-append">--}}
  {{--<span class="input-group-text">--}}
    {{--<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">--}}
      {{--<input data-step="step-1" value="{{ $artist_permit->sponsor_name_ar }}"--}}
                                                                     {{--type="checkbox" name="sponsor name">--}}
      {{--<span></span>--}}
    {{--</label>--}}
  {{--</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </section>
                    </div>
                </section>
            </section>
        </div>
    </div>
</section>
