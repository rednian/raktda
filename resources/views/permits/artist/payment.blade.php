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
Make Payment
@endslot
@endcomponent

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
                            <div class="kt-heading kt-heading--md">
                            </div>
                            <div class="kt-form__section kt-form__section--first">
                                <div class="kt-wizard-v3__review">
                                    <div class="kt-wizard-v3__review-item">
                                        {{-- <div class="kt-wizard-v3__review-title">
                                             Permit
                                        </div> --}}

                                        <div class="kt-wizard-v3__review-content">


                                            <div class="kt-widget5">
                                                <div class="kt-widget5__item">

                                                    <div class="kt-widget5__content">
                                                        <div class="kt-widget5__pic">
                                                            <img class="kt-widget7__img"
                                                                src="https://source.unsplash.com/random/"
                                                                style="height:150px;width:160px;" alt="">
                                                        </div>
                                                        <div class="kt-widget5__section">
                                                            <a href="#" class="kt-widget5__title">
                                                                {{$artist_details[0]->artist['name']}}
                                                            </a>
                                                            <p class="kt-widget5__desc">
                                                                {{$artist_details[0]->artist['email']}}<br />
                                                                {{$artist_details[0]->artist['mobile_number']}}
                                                            </p>
                                                            <div class="kt-widget5__info">

                                                                <span>Permit Type:</span>
                                                                <span class="kt-font-info">
                                                                    {{$artist_details[0]->artist['artisttype']->artist_type_en}}</span>
                                                                <span>Nationality:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['nationality']}}</span>
                                                                <span>Passport Number:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['passport_number']}}</span>
                                                                <span>UID Number:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['uid_number']}}</span>
                                                                <span>D-O-B:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['birthdate']}}</span>
                                                                <span>Phone Number:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['phone_number']}}</span>
                                                                <span>Profession:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['profession']}}</span>
                                                                <span>Applied On:</span>
                                                                <span
                                                                    class="kt-font-info">{{$artist_details[0]->artist['created_at']}}</span>
                                                                <input type="hidden" name="p_artist_id"
                                                                    id="{{$artist_details[0]->artist['artist_id']}}">
                                                                <input type="hidden" name="p_artist_permit_id"
                                                                    id="{{$artist_details[0]->artist['artist_permit_id']}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                        </div>
                                        <div class="kt-wizard-v3__review-content kt-heading">
                                            Total Payable Amount: AED
                                            {{$artist_details[0]->artist['artisttype']->amount}}
                                        </div>
                                        {{-- @php
                                        dd($artist_details);
                                        @endphp --}}


                                    </div>

                                </div>
                            </div>
                        </div>

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Wizard Step 5-->
                        {{-- <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
    <div class="kt-heading kt-heading--md">Permit Issued Successfully
    </div>
    <div class="kt-form__section kt-form__section--first">
        <div class="kt-wizard-v3__review">
            <div class="kt-wizard-v3__review-item">
                <div class="kt-wizard-v3__review-title">
                    Permit ID
                </div>
                <div class="kt-wizard-v3__review-content">
                    Address Line 1<br />
                    Address Line 2<br />
                    Melbourne 3000, VIC, Australia
                    and Other Details on the Permit
                </div>
            </div>

        </div>
    </div>
</div> --}}

                        <!--end: Form Wizard Step 5-->

                        <!--begin: Form Actions -->



                        <!--end: Form Actions -->



                        <div class="kt-form__actions">
                            {{-- <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-prev" id="prev_btn">
                                Previous
                            </div>

                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                data-ktwizard-type="action-next" id="next_btn">
                                Next Step
                            </div> --}}
                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u"
                                id="pay_btn">
                                Pay
                            </div>
                        </div>

                    </div>



                    <!--end: Form Wizard Form-->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Content -->



<!-- begin::Scrolltop -->
<div id="kt_scrolltop" class="kt-scrolltop">
    <i class="fa fa-arrow-up"></i>
</div>

<!-- end::Scrolltop -->



@endsection


@section('script')

<script>
    $(document).ready(function(){
        wizard = new KTWizard("kt_wizard_v3",{
            startStep: 4
        });
        $('#next_btn').css('display','none');
        $('#prev_btn').css('display','none');
    })


    $("#pay_btn").bind("click", (e) => {
        e.preventDefault();
        let id = $('#p_artist_id').val();
        let permit_id = $('#p_artist_permit_id').val();
        $.ajax({
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                "content"
            )
        },
        type: "POST",
        url: "{{route('company.payment_gateway')}}",
        // dataType: 'application/json',
        processData:false,
        data: {id:id , permit_id:permit_id},
        success: function(data) {
            console.log(data);
        }
        });
    });




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

<script async src={{asset('./js/new_artist_permit.js')}} type="text/javascript"></script>

@endsection
