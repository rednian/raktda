<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
    <div class="kt-form__section kt-form__section--first">
        <div class="kt-wizard-v3__form">
            <!--begin::Accordion-->
            @include('permits.event.common.common-instructions')
            {{-- <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border"
                id="permit-instruction-details">
                <div class="card">
                    <div class="card-header" id="headingFour6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour15"
                            aria-expanded="false" aria-controls="collapseFour6">
                            <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{__('Rules and Conditions')}}
            </h6>
        </div>
    </div>
    <div id="collapseFour15" class="collapse show" aria-labelledby="headingFour6"
        data-parent="#permit-instruction-details">
        <div class="card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
            terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
        </div>
    </div>
</div>
</section> --}}
<label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
    <input type="checkbox" id="agree" name="agree" checked disabled>
    {{-- {{__('I read and understand all service, rules and agree to continue submitting it')}} --}}
    {{__('I accept the above service terms and conditions')}}
    <span></span>
</label>
</div>
</div>
</div>