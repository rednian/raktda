@extends('layouts.admin.admin-app')
@section('style')
    <style>
        table {
            text-align: left;
            font-size: 13px;
        }

        .print_button {
            height: 27px;
            line-height: 2px;
            border: 2px solid #505050;
            color: black;
            border-radius: 4px;
            transition-duration: .3s;
        }

        .print_button:hover {
            height: 27px;
            line-height: 2px;
            box-shadow: 1px 7px 7px -6px black;
            border: 2px solid black;
            color: white;
            border-radius: 4px;
            background-color: black;
        }
        @media print {
            #DivToPrint {
               background-color: red;
            }
        }

    </style>
@endsection
@section('content')
    <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet"
             style="padding: 20px">
        <div>
            <div style="background-color: #f3e0eb;
            padding: 8px;
            color: #6f6f6f;
            font-family: arial;">{{__('EVENT DETAILS')}}</div>
        </div>

        <table class="table table-bordered container-fluid " id="DivToPrint" style="padding: 3px">
            <tr>
                <th colspan="2">
                    <img style="width: 100%;margin-left: -8px" src="{{asset('img/raktdalogo.png')}}" alt="">
                </th>
            </tr>
            <tr>
                <th colspan="2" align="center" style="padding: 5px;height: 34px">EVENTS DETAILS</th>
            </tr>
            <tr>
                <th width="35%">{{__('REFERENCE NUMBER')}}</th>
                <td>{{$event->reference_number}}</td>
            </tr>
            <tr>
                <th>{{__('NAME')}}</th>
                <td>{{ucwords($event->name_en)}}</td>
            </tr>
            <tr>
                <th>{{__('PERMIT NUMBER')}}</th>
                <td class="col-6">{{$event->permit_number}}</td>
            </tr>
            <tr>
                <th>{{__('COMPANY')}}</th>
                <td>{{ucwords($event->company?$event->company->name_en:'')}}</td>
            </tr>
            <tr>
                <th>{{__('VENUE')}}</th>
                <td>{{$event->venue_en}}</td>
            </tr>
            <tr>
                <th>{{__('DESCRIPTION')}}</th>
                <td>{{$event->description_en}}</td>
            </tr>
            <tr>
                <th>{{__('EMIRATE')}}</th>
                <td>{{$event->emirate->name_en}}</td>
            </tr>
            <tr>
                <th>{{__('ADDRESS')}}</th>
                <td>{{$event->address}}</td>
            </tr>
            <tr>
                <th>{{__('ISSUED DATE')}}</th>
                <td>{{$event->issued_date}}</td>
            </tr>
            <tr>
                <th>{{__('EXPIRY DATE')}}</th>
                <td>{{$event->expired_date}}</td>
            </tr>
            <tr>
                <th>{{__('APPLICATION TYPE')}}</th>
                <td>{{$event->firm}}</td>
            </tr>
            <tr>
                <th>{{__('EVENT TYPE')}}</th>
                <td>{{$event->type?$event->type->name_en:''}}</td>
            </tr>
        </table>
        <div class="container" align="center">
            <button class="btn print_button btn-sm" id="ClicktoPrintEvent" style="text-align: center">PRINT</button>
        </div>

    </section>

    <section>
        <iframe class="border kt-padding-5" id='mapcanvas'
                src='https://maps.google.com/maps?q={{ urlencode($event->full_address)}}&Roadmap&z=10&ie=UTF8&iwloc=&output=embed&z=17'
                style="height: 350px; width: 100%; margin-top: 1%; border-style: none;">
        </iframe>
        </div>
        <div class="col-md-5">
            <a href=""><button class="btn btn-secondary pull-right"><-BACK</button></a>
            <div class="border kt-padding-10">
                <div class="kt-widget kt-widget--user-profile-4">
                    <div class="kt-widget__head kt-margin-t-5">
                        <div class="kt-widget__media kt-margin-b-5">
                            @if ($event->thumbnail)
                                <img src="{{ asset('/storage/'.$event->logo_thumbnail) }}"
                                     class="kt-widget__img img-circle" alt="image">
                            @else
                                <div
                                    class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light">
                                    @php
                                        $name = explode(' ', $event->name_en);
                                        $name = strtoupper(substr($name[0], 0, 1));
                                    @endphp
                                    {{$name}}
                                </div>
                            @endif
                        </div>
                        <div class="kt-widget__content">
                            <div class="kt-widget__section">
                                <div class="kt-widget__button">
                                    {!! permitStatus($event->status)!!}
                                </div>
                            </div>
                            @if ($event->status == 'cancelled')
                                <div class="kt-widget__section">
                                    <h6 class="kt-font-dark">{{ __('Cancel Reason') }} <small
                                            title="{{$event->cancel_date->format('l h:i A | d-F-Y')}}"
                                            class="pull-right text-underline">{{humanDate($event->cancel_date)}}</small>
                                    </h6>

                                    <hr class="kt-margin-b-0 kt-margin-t-0">
                                    <p>
                                        {{ucfirst($event->cancel_reason)}}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="kt-widget__body kt-margin-t-5">
                        <hr>
                        <h6 class="kt-font-dark">{{ __('Permit Information') }}</h6>
                        <table class="table table-sm table-hover table-borderless table-display">
                            <tr>
                                <td>{{ __('Applied Date') }} :</td>
                                <td class="kt-font-dark">{{ $event->created_at->format('d-F-Y') }}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Reference No.') }} :</td>
                                <td class="kt-font-dark"><code style="">{{ $event->reference_number }}</code></td>
                            </tr>
                            <tr>
                                <td>{{ __('Permit Number') }} :</td>
                                <td class="kt-font-dark">
                                    <code>{{ $event->permit_number ? $event->permit_number : 'N/A' }}</code></td>
                            </tr>
                            <tr>
                                <td>{{ __('Expected Audience') }} :</td>
                                <td class="kt-font-dark">{{$event->audience_number}}</td>
                            </tr>
                            <tr>
                                <td>{{ __('Approved By') }} :</td>
                                <td class="kt-font-dark"></td>
                            </tr>
                            <tr>
                                <td>{{ __('Approved Date') }} :</td>
                                <td class="kt-font-dark"></td>
                            </tr>
                            <tr>
                                <td>{{ __('Printed Note') }} :</td>
                                <td class="kt-font-dark">{{ Auth::user()->LanguageId == 1 ? ucfirst($event->note_en) : $event->note_ar }}</td>
                            </tr>
                        </table>
                        <hr>
                        <h6 class="kt-font-dark">{{__('Liquor Details')}}</h6>
                        <table class="table table-sm table-hover table-borderless table-display">
                            <tr>
                            <tr>
                                <td width="55%">{{__('Establishment Name')}} :</td>
                                <td>{{Auth::user()->LanguageId == 1 ? ucfirst($event->liquor->company_name_en) : $event->liquor->company_name_ar}}</td>
                            </tr>
                            <td>{{__('Provided by venue')}} :</td>
                            <td>{{$event->provided ? 'YES' : 'NO'}}</td>
                            @if ($event->provided)
                                <tr>
                                    <td>{{__('Liquor Permit Number: ')}}</td>
                                    <td>{{$event->liquor->liquor_permit_no}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{__('Liquor Service')}} :</td>
                                    <td>{{$event->liquor->liquor_service}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Liquor Types')}} :</td>
                                    <td>{{$event->liquor->liquor_type}}</td>
                                </tr>
                                <tr>
                                    <td>{{__('Purchase Receipt Number')}} :</td>
                                    <td>{{$event->liquor->purchase_receipt}}</td>
                                </tr>
                                @endif
                                </tr>
                        </table>
                        <div class="d-flex justify-content-center">
                            @if ($event->transaction()->exists())
                                <button type="button" class="btn btn-secondary btn-sm kt-margin-r-5">Download</button>
                            @endif

                        </div>
                        <hr>
                        <h6 class="kt-font-dark">{{ __('Establishment Details') }}</h6>
                        @if ($event->owner->company()->exists())
                            <table class="table table-borderless table-sm table-display">
                                <tr>
                                    <td><span style="font-size: large;" class="flaticon-home"></span> :</td>
                                    <td>{{ ucwords(Auth::user()->LanguageId == 1 ? ucfirst($event->owner->company->name_en) : $event->owner->company->name_ar ) }}</td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: large;" class="flaticon-email"></span> :</td>
                                    <td>{{ $event->owner->company->company_email }}</td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: large;" class="la la-phone"></span> :</td>
                                    <td>{{ $event->owner->company->phone_number }}</td>
                                </tr>
                                <tr>
                                    <td><span style="font-size: large;" class="flaticon-placeholder-3"></span> :</td>
                                    @if (Auth::user()->LanguageId == 1)
                                        <td>{{ $event->owner->company->addres }} {{ $event->owner->company->area->area_en}} {{ $event->owner->company->emirate->name_en}} {{ $event->owner->company->country->name_en}}</td>
                                    @else
                                        <td>{{ $event->owner->company->addres }} {{ ucfirst($event->owner->company->area->area_ar)}} {{ ucfirst($event->owner->company->emirate->name_ar)}} {{ ucfirst($event->owner->company->country->name_ar)}}</td>
                                    @endif
                                </tr>
                            </table>
                        @else
                            @empty
                                {{ __('Establishment Information is not required for this Event Owner.') }}
                            @endempty
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script>
        $('#ClicktoPrintEvent').click(function () {

            var divToPrint = document.getElementById('DivToPrint');
            $(divToPrint).css({
                'font-size': '13px',
                'color': 'black',
                'text-align': 'left',
                'border': '1px solid grey',
                'padding': '4%',
                'font-family':
                    'arial'
            })
            newWin = window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.focus();
            newWin.print();
            newWin.close();


        })
    </script>

@endsection
