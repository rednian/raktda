@extends('layouts.app')

@section('content')

@component('layouts.subheader')
@slot('heading')
Permits
@endslot
@slot('subheading')
Artist Permit
@endslot
@slot('subSubHeading')
Happiness Meter
@endslot
@endcomponent

<div class="alert alert-success d-none" id="respMess" role="alert">
    <div class="alert-text">Thank you for your response</div>
</div>

<!-- begin:: Content -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
    <div class="kt-portlet">

        <div class="kt-portlet__body kt-portlet__body--fit">


            <div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="step-first">
                <div class="kt-grid__item">
                    <!--begin: Form Wizard Nav -->



                    <div class="kt-wizard-v3__nav">
                        <div class="kt-wizard-v3__nav-items" role="tablist">

                            <div class="kt-wizard-v3__nav-item " data-ktwizard-type="step" href="#"
                                data-ktwizard-state="current">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>1</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>2</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>3</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>4</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>5</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            {{-- <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#"
                                style="flex: 0 0 17%;">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>6</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div> --}}
                        </div>
                    </div>


                    <!--end: Form Wizard Nav -->
                </div>


                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">

                    <div class="kt-form w-100 p-5" id="kt_form">

                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content"
                            data-ktwizard-state="current">
                        </div>

                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        </div>

                        <!--begin: Form Wizard Step 4-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">

                        </div>


                        <!--end: Form Wizard Step 4-->

                        <!--begin: Form Wizard Step 5-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">

                        </div>

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Wizard Step 5-->
                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                            {{-- <div class="kt-heading kt-heading--md"> Are you Happy ?
                            </div> --}}
                            <div class="kt-form__section kt-form__section--first">
                                <div class="d-flex justify-content-around">
                                    <div id="happy" style="cursor:pointer">
                                        {{-- <a href="/company/artist_permits"> --}}
                                        <img src="{{asset('img/happiness.svg')}}" alt="" id="happy_btn">
                                        {{-- </a> --}}
                                    </div>
                                    <div id="notbad" style="cursor:pointer">
                                        {{-- <a href="/company/artist_permits"> --}}
                                        <img src="{{asset('img/notbad.svg')}}" alt="" id="notbad_btn">
                                        {{-- </a> --}}
                                    </div>
                                    <div id="sad" style="cursor:pointer">
                                        {{-- <a href="/company/artist_permits"> --}}
                                        <img src="{{asset('img/sad.svg')}}" alt="" id="sad_btn">
                                        {{-- </a> --}}
                                    </div>
                                    <input type="hidden" id="artist_permit_id" value={{$id}}>
                                </div>

                            </div>
                        </div>

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Actions -->



                        <!--end: Form Actions -->



                        <div class="kt-form__actions" style="justify-content: center;float:none !important;">
                            {{-- <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev" id="prev_btn">
                                Previous
                            </div>

                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-next" id="next_btn">
                                Next Step
                            </div> --}}
                            <a href="/company/artist_permits"
                                class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u text-white"
                                id="pay_btn">
                                Back to Home
                            </a>
                        </div>

                    </div>



                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('script')

<script>
    $(document).ready(function(){
        wizard = new KTWizard("kt_wizard_v3",{
            startStep: 5
        });
        $('#next_btn').css('display','none');
        $('#prev_btn').css('display','none');
        $('.kt-form__actions').css('float', 'right');
    })

    var rating = '';
    var permit_id = $('#artist_permit_id').val();


    $('#happy_btn').click(function(){
        rating = 'happy';
        sendRating();
    })
    $('#notbad_btn').click(function(){
        rating = 'notbad';
        sendRating();
    })
    $('#sad_btn').click( function(){
        rating = 'sad';
        sendRating();
    })

    function sendRating() {
        $.ajax({
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            )
        },
        type: "POST",
        url: "{{route('company.submit_happiness')}}",
        dataType: 'application/json',
        // processData:false,
        data: { rating:rating, permit_id: permit_id },
        success: function(data) {
           setTimeout( $('#respMess').css('display', 'block'), 2000);
        }
        });
    }

    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };

</script>

@endsection
