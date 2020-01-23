<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
    <div class="kt-form__section kt-form__section--first">
        <!--begin::Accordion-->
        @include('permits.artist.common.instructions-fee')
        <br>
        @include('permits.artist.common.required-documents')
        <br>

        {{-- <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample62">
                <div class="card">
                    <div class="card-header" id="headingFour6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour6"
                            aria-expanded="false" aria-controls="collapseFour6">
                            <h6 class="kt-font-transform-u kt-font-bolder">{{__('Rules and Conditions')}}</h6>
    </div>
</div>
<div id="collapseFour6" class="collapse" aria-labelledby="headingFour6" data-parent="#accordionExample62">
    <div class="card-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
        skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
        Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

    </div>
</div>
</div>
</div> --}}
<label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
    <input type="checkbox" id="agree" name="agree" checked>
    {{__('I read and understand all service, rules and agree to continue submitting it')}}
    <span></span>
</label>
</div>
</div>