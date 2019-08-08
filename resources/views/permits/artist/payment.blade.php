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
<div class="kt-content  kt-grid__item kt-grid__item--fluid " id="kt_content_company_artist">
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
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>6</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
                            <div class="kt-wizard-v3__nav-item" data-ktwizard-type="step" href="#">
                                <div class="kt-wizard-v3__nav-body">
                                    <div class="kt-wizard-v3__nav-label">
                                        <span>7</span>
                                    </div>
                                    <div class="kt-wizard-v3__nav-bar"></div>
                                </div>
                            </div>
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

                        <div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
                        </div>

                        {{-- {{print_r($artist_details[0]->permit[0]->permit_number)}}
                        {{print_r($artist_details[0]->permit[0]->issued_date)}}
                        {{print_r($artist_details[0]->permit[0]->expired_date)}}
                        {{print_r($artist_details[0]->permit[0]->work_location)}} --}}
                        {{-- <pre>
                        {{print_r()}}
                        </pre> --}}
                        {{-- {{dd($artist_details)}} --}}

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

                                        @foreach ($permit_details as $artist)

                                        {{-- {{dd($artist->artist)}} --}}
                                        <div class="kt-wizard-v3__review-content">


                                            <div class="kt-widget5">
                                                <div class="kt-widget5__item">

                                                    <div class="kt-widget5__content">
                                                        <div class="kt-widget5__pic">
                                                            @php
                                                            $fileNameArray = [];
                                                            @endphp
                                                            @foreach($artist->artistPermitDocument
                                                            as
                                                            $doc)
                                                            @php
                                                            array_push($fileNameArray, $doc->document_name);
                                                            @endphp
                                                            @endforeach

                                                            @if(in_array("artist photo",$fileNameArray))
                                                            <img class="kt-widget7__img" src="{{$doc->path}}"
                                                                style="height:150px;width:160px;" alt="" />
                                                            @else
                                                            <img src="{{asset('img/default.jpg')}}" alt="" />
                                                            @endif
                                                        </div>
                                                        <div class="kt-widget5__section">
                                                            <a href="#" class="kt-widget5__title">
                                                                {{$artist->artist['name']}}
                                                            </a>
                                                            <p class="kt-widget5__desc">
                                                                {{$artist->artist['email']}}<br />
                                                                {{$artist->artist['mobile_number']}}
                                                            </p>
                                                            <div class="d-flex flex-row">
                                                                @foreach($artist->artistPermitDocument
                                                                as
                                                                $doc)
                                                                @if($doc->document_name != 'artist photo')
                                                                <a href="{{asset('storage/'.$doc->path)}}"
                                                                    target="_blank"><button
                                                                        class="btn btn-sm btn-info mr-5">{{$doc->document_name}}</button>
                                                                </a>
                                                                @endif
                                                                {{--dd(storage_path())}} --}}
                                                                @endforeach
                                                            </div>
                                                            <div class="kt-widget5__info">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td> <span>Nationality:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->artist['nationality']}}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span>Passport Number:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->artist['passport_number']}}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span>UID Number:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->artist['uid_number']}}</span>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <span>D-O-B:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->artist['birthdate']}}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span>Phone Number:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->artist['phone_number']}}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span>Applied On:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->artist['created_at']}}</span>
                                                                            </td>
                                                                            <td>
                                                                                <span>Profession:</span>
                                                                                <span
                                                                                    class="kt-font-info">{{$artist->permitType['name_en']}}</span>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>


                                                                <input type="hidden" name="p_artist_id"
                                                                    id="{{$artist->artist['artist_id']}}">
                                                                <input type="hidden" name="p_artist_permit_id"
                                                                    id="{{$artist->pivot['permit_id']}}">
                                                            </div>
                                                            <div class="kt-wizard-v3__review-content kt-heading">
                                                                <label for="">Permit Fee:</label>
                                                                <span><small>AED
                                                                        {{$artist->permitType['amount']}}</small></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                        @endforeach


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
            startStep: 5
        });
        $('#next_btn').css('display','none');
        $('#prev_btn').css('display','none');
        $('.kt-form__actions').css('float', 'right');
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
        // type: "POST",
        url: "{{route('company.payment_gateway')}}",
        // dataType: 'application/json',
        processData:false,
        // data: {id:id , permit_id:permit_id},
        success: function(data) {
            let url = '{{route('company.payment_gateway')}}';
            $(location).attr('href',url);
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
