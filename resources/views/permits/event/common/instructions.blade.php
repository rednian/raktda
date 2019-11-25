<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
    <div class="kt-form__section kt-form__section--first">
        <div class="kt-wizard-v3__form">
            <!--begin::Accordion-->
            <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">


                <div class="card">
                    <div class="card-header" id="headingThree6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6"
                            aria-expanded="false" aria-controls="collapseThree6">
                            <h6 class="kt-font-transform-u"> {{__('Permit Fee')}}</h6>
                        </div>
                    </div>
                    <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6"
                        data-parent="#accordionExample6">
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th>{{__('Event Type')}}</th>
                                    <th class="text-right">{{__('Fee')}} / {{__('Day')}} (AED)</th>
                                </tr>
                                @foreach($event_types as $pt)
                                <tr>
                                    <td>{{$pt->name_en}}</td>
                                    <td class="text-right">{{number_format($pt->amount,2)}}</td>
                                </tr>
                                @endforeach
                            </table>


                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour6">
                        <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseFour6"
                            aria-expanded="false" aria-controls="collapseFour6">
                            <h6 class="kt-font-transform-u">Rules and Conditions</h6>
                        </div>
                    </div>
                    <div id="collapseFour6" class="collapse" aria-labelledby="headingFour6"
                        data-parent="#accordionExample6">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus
                            terry richardson ad squid. 3 wolf moon officia aute, non cupidatat
                            skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                            Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid

                        </div>
                    </div>
                </div>
                <label class="kt-checkbox kt-checkbox--brand ml-2 mt-3" id="agree_cb">
                    <input type="checkbox" id="agree" name="agree" checked disabled>
                    {{__('I Read and understand all service rules and agree to continue submitting it.')}}
                    <span></span>
                </label>
            </div>
        </div>
    </div>
</div>