<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
    <div class="kt-form__section kt-form__section--first">
        <!--begin::Accordion-->
        <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample61">
            <div class="card">
                <div class="card-header" id="headingThree6">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6"
                        aria-expanded="false" aria-controls="collapseThree6">
                        <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark"> {{__('Permit Fee')}}</h6>
                    </div>
                </div>
                <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6"
                    data-parent="#accordionExample61">
                    <div class="card-body">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th style="width:50%" class="kt-font-transform-u">{{__('Profession')}}</th>
                                <th style="width:50%" class="kt-font-transform-u">{{__('Fee')}} (AED)</th>
                            </tr>
                            @foreach($profession as $pt)
                            <tr>
                                <td>{{getLangId() == 1 ? $pt->name_en : $pt->name_ar}}</td>
                                <td>{{number_format($pt->amount,2)}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="accordion accordion-solid accordion-toggle-plus border" id="accordionExample6">

            <div class="card">
                <div class="card-header" id="headingTwo6">
                    <div class="card-title" data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="false"
                        aria-controls="collapseTwo6">
                        <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark">{{__('Documents Required')}}
                        </h6>
                    </div>
                </div>
                <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6"
                    data-parent="#accordionExample6">
                    <div class="card-body">

                        <table class="table table-borderless table-sm">
                            <tr>
                                <th style="width:50%" class="kt-font-transform-u">{{__('Document Name')}}</th>
                                <th style="width:50%" class="kt-font-transform-u">{{__('Description')}}</th>
                            </tr>
                            @foreach($requirements as $req)
                            <tr>
                                <td>{{getLangId() == 1 ? $req->requirement_name : $req->requirement_name_ar}}</td>
                                <td>{{getLangId() == 1 ? $req->requirement_description : $req->requirement_description_ar}}
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>

        </div>
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