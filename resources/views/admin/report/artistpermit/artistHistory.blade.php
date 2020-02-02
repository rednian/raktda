@extends('layouts.admin.admin-app')
@section('content')
    <STYLE>
        #artist-permit-history_filter{
            float: right;
        }
    </STYLE>
    <section class="kt-portlet kt-portlet--head-sm">
        <div class="kt-portlet__head kt-portlet__head--sm kt-padding-l-15 kt-padding-r-15">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ __('ARTIST DETAILS') }}</span></h3></div>
            <div class="kt-portlet__head-toolbar">

              <button STYLE="background-color: #b45454;
                 color: white;
                 box-shadow: -1px 6px 11px -6px #969696;
                 border: none;
                 border-radius: 3px;" type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary btn-elevate  kt-font-transform-u">
                  <i class="la la-arrow-left"></i>{{ __('BACK') }}
              </button>
            </div>
        </div>
        <div class="kt-portlet__body kt-padding-15 kt-font-dark">
            <section class="row">
                @php
                    $artistpermit = $artist->artistpermit()->latest()->first();
                    $language = Auth::user()->LanguageId;
                @endphp
                <div class="col-md-4 kt-padding">
                    <div class="kt-widget kt-widget--user-profile-4 border">
                        <div class="kt-widget__head">
                            <div class="kt-widget__media">
                                <img class="kt-widget__img img-thumbnail" src="{{ asset('storage/'.$artistpermit->thumbnail) }}" >
                            </div>
                            <div class="kt-widget__content">
                                <div class="kt-widget__section">
                           <span class="kt-widget__username">
                      {{ $language == 1 ? ucwords($artistpermit->fullname) : $artistpermit->firstname_ar.' '.$artistpermit->lastname_ar }}
                           </span>
                                    <div class="kt-widget__button">
                                        @if ($artist->artist_status == 'active')
                                            <span class="btn btn-label-success btn-sm">{{ __(ucfirst($artist->artist_status)) }}</span>
                                        @else
                                            <span class="btn btn-label-danger btn-sm">{{ __(ucfirst($artist->artist_status)) }}</span>
                                        @endif
                                    </div>
                                    {{-- <div class="kt-widget__action">
                                      <a href="#" class="btn btn-icon btn-circle btn-label-facebook">
                                        <i class="socicon-facebook"></i>
                                      </a>
                                      <a href="#" class="btn btn-icon btn-circle btn-label-twitter">
                                        <i class="socicon-twitter"></i>
                                      </a>
                                      <a href="#" class="btn btn-icon btn-circle btn-label-google">
                                        <i class="socicon-google"></i>
                                      </a>
                                    </div> --}}
                                </div>
                            </div>
                      </div>
                        <div class="kt-widget__body kt-padding-l-5 kt-padding-r-5">
                            <h6 class="kt-font-dark kt-font-bold ">{{__('Artist Details')}}</h6>
                            <hr class="kt-margin-b-5  kt-margin-t-0">
                            <span>{{ __('Person Code') }} : <span id="person_code">{{$artist->person_code }}</span></span><br>
                            <span>{{ __('Age') }} : <span id="age">{{$artistpermit->birthdate->age }}</span></span><br>
                            <span>{{ __('Birthdate') }} : <span id="birthday">{{$artistpermit->birthdate->format('d-F-Y')}}</span></span><br>
                            <span>{{ __('Gender') }} : <span id="gender">{{$artistpermit->gender->name_en}}</span></span><br>
                            <span>{{ __('Religion') }} : <span id="religion">{{$artistpermit->religion->name_en}}</span></span><br>
                            <span>{{ __('Identification Number') }} : <span id="identification">{{$artistpermit->identification_number}}</span></span><br>
                            <span>{{ __('UID No.') }} : <span id="uid_no">{{$artistpermit->uid_number ? $artistpermit->uid_number : 'N/A'}}</span></span><br>
                            <span>{{ __('UID Expiry Date') }} : <span id="uid_expiry">{{$artistpermit->uid_expire_date ? $artistpermit->uid_expire_date->format('d-F-Y') : '-'}}</span></span><br>
                            <span>{{ __('Visa Type') }} : <span id="visa_type">{{$artistpermit->visaType->name_en ? ucfirst($artistpermit->visaType->name_en) : 'N/A'}}</span></span><br>
                            <span>{{ __('Visa No.') }} : <span id="visa_no">{{$artistpermit->visa_number ? $artistpermit->visa_number : '-' }}</span></span><br>
                            <span>{{ __('Passport No.') }} : <span id="pass_no">{{$artistpermit->passport_number ? $artistpermit->passport_number : '-' }}</span></span><br>
                            <span>{{ __('Passport Expiry Date') }} : <span id="pass_expiry">{{$artistpermit->passport_expire_date ? $artistpermit->passport_expire_date->format('d-F-Y') : '-' }}</span></span><br>
                            <h6 class="kt-font-dark kt-font-bold kt-margin-t-15 ">{{__('Contact Information')}}</h6>
                            <hr class="kt-margin-b-5  kt-margin-t-0">
                            <span>{{ __('Email') }} : <span id="email">{{$artistpermit->email }}</span></span><br>
                            <span>{{ __('Mobile Number') }} : {{$artistpermit->mobile_number }}</span><br>
                            <span>{{ __('Phone Number') }} : {{$artistpermit->phone_number }}</span><br>
                            <span>{{ __('Fax Number') }} : {{$artistpermit->fax_number }}</span><br>

                            <h6 class="kt-font-dark kt-font-bold kt-margin-t-15 ">{{__('Address Details')}}</h6>
                            <hr class="kt-margin-b-5  kt-margin-t-0">
                               @php
                                  $address = $language == 1 ? ucfirst($artistpermit->address_en) : $artistpermit->address_ar;
                                  $area = $language == 1 ? ucfirst($artistpermit->area->area_en) : $artistpermit->area->area_ar;
                                  $emirate = $language == 1 ? ucfirst($artistpermit->emirate->name_en) : $artistpermit->emirate->name_ar;
                                  $country = $language == 1 ? ucfirst($artistpermit->country->name_en) : $artistpermit->country->name_ar;
                               @endphp
                            <span id="address"> {{$address.' '.$area.' '.$emirate.' '.$country}}</span><br>
                            <h6 class="kt-font-dark kt-font-bold kt-margin-t-15 ">{{__('Current Sponsor Details')}}</h6>
                            <hr class="kt-margin-b-5  kt-margin-t-0">
                            <span>{{ __('Name') }} : <span id="sponsor_name">{{ucwords($artistpermit->sponsor_name_en) }}</span></span><br>
                          </div>
                        </div>
                      </div>
                <div class="col-md-8">
                    <div class="kt-widget kt-widget--user-profile-3">
                        <div class="kt-widget__bottom kt-margin-t-0 kt-hide">
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-confetti"></i>
                                    </div>
                                    <div class="kt-widget__details">
                                    <span class="kt-widget__title">{{__('ACTIVE PROFESSIONS')}}</span>
                                    <span class="kt-widget__value">
                      @if ($artistpermits = $artist->artistPermit()->whereHas('permit', function($q){ $q->where('permit_status', 'active'); })->get())
                                            @foreach ($artistpermits as $artistpermit)
                                                <small>{{ $artistpermit->profession->name_en }} </small>
                                            @endforeach
                                        @endif
                                     </span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
                                <div class="kt-widget__icon">
                                    <i class="flaticon-squares-4"></i>
                                </div>
                                <div class="kt-widget__details">
                                    @if ($permits = $artist->permit()->where('permit_status', 'active')->get())
                                        <span class="kt-widget__title">{{__('CURRENT ESTABLISHMENTS')}}</span>
                                        <span class="kt-widget__value">
                        @foreach ($permits as $permit)
                                                <small>{{ucfirst(Auth::user()->LanguageId == 1 ? $permit->owner->company->name_en : $permit->owner->company->name_ar)}} </small>
                                            @endforeach
                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <hr> --}}
             {{--       <div class="accordion accordion-solid  accordion-toggle-plus" id="accordionExample6">
                        <div class="card border">
                            <div class="card-header " id="headingOne6">
                                <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse" data-target="#collapseOne6">
                                    @if ($artist->artist_status == 'active')
                                        {{ __('BLOCK ARTIST') }}
                                    @else
                                        {{ __('UNBLOCK ARTIST') }}
                                    @endif
                                </div>
                            </div>
                            <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
                                <div class="card-body kt-padding-b-0">
                                    <form action="{{ route('admin.artist.update_status',$artist->artist_id) }}" method="post" class="form" id="frm-status">
                                        @csrf
                                        <div class="form-group row form-group-sm">
                                            <div class="col-md-6">
                                                <label for="">{{ __('Remarks') }} <span class="text-danger">*</span></label>
                                                <textarea required="" name="remarks" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">{{ __('Remarks (AR)') }}<span class="text-danger">*</span></label>
                                                <textarea required="" name="remarks_ar" dir="rtl" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                @if ($artist->artist_status == 'active')
                                                    <button type="submit" class="btn btn-sm btn-maroon kt-transform-u" name="status" value="blocked">{{ __('SUBMIT') }}</button>
                                                @else
                                                    <button type="submit" class="btn btn-sm btn-maroon kt-transform-u" name="status" value="active">{{ __('SUBMIT') }}</button>
                                                @endif
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    <section class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_2" role="tab" aria-selected="true">{{ __('PERMIT HISTORY') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_3" role="tab" aria-selected="false">{{ __('STATUS HISTORY') }}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="kt_tabs_6_2" role="tabpanel">

                                    <div id="artist_details"></div>

                                    <table class="table table-striped table-borderless table-hover border" id="artist-permit-history">
                                        <thead>
                                        <tr style="font-weight: bold;font-size: 12px">
                                            <th></th>
                                            <th>{{ __('ACTION') }}</th>
                                            <th style="white-space: nowrap">{{ __('REFERENCE NO.') }}</th>
                                            <th style="white-space: nowrap">{{ __('ESTABLISHMENT NAME') }}</th>
                                            <th style="white-space: nowrap">{{ __('PERMIT STATUS') }}</th>
                                            <th style="white-space: nowrap">{{ __('PERMIT NO.') }}</th>
                                            <th style="white-space: nowrap">{{ __('ISSUE DATE') }}</th>
                                            <th style="white-space: nowrap">{{ __('EXPIRY DATE') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody style="font-size: 12px"></tbody>
                                    </table>

                                </div>
                                <div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">
                                    <table class="table table-striped table-borderless table-hover border table-hover table-sm" id="status-history">
                                        <thead>
                                        <tr>
                                            <th>{{ __('NAME') }}</th>
                                            <th>{{ __('REMARKS') }}</th>
                                            <th>{{ __('DATE ADDED') }}</th>
                                            <th>{{ __('ACTION TAKEN') }}</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </section>

        </div>
    </section>
    {{-- @include('admin.artist.include.artist-block-modal') --}}
    @include('admin.artist_permit.includes.document')
@endsection
@section('script')
    <script>
        $('form#frm-status').validate();
        var is_checked = false;
        $(document).ready(function () {


            permitHistory();
            statusHistory();

            $('form#frm-update-status').validate({
                rules: {
                    remarks: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    }
                }
            });
        });

        function statusHistory() {
            $('table#status-history').DataTable({
                ajax: {
                    url: '{{ route('admin.artist.status_history', $artist_permit->artist_id) }}',
                    data: function (d) {
                    }
                },
                columnDefs: [
                    {targets: [0, 2, 3], className: 'no-wrap'}
                ],
                columns: [
                    {data: 'name'},
                    {data: 'remarks'},
                    {data: 'created_at'},
                    {data: 'action'}
                ]
            });
        }

        function permitHistory() {
            $('table#artist-permit-history').DataTable({
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        targets: [0,1,6],
                        visible: false,
                        "searchable": false,
                        },
                       {
                        targets: [],
                        className: "text-right",
                        }
                      ],
                   buttons: ['pageLength',
                    {
                        extend: 'print',
                        title: function () {
                            return 'Permit History' +new Date();
                        },
                        exportOptions: {
                            columns: [2,3,4,5,6,7],
                        },
                        customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h5 style="font-family:arial;text-align:center;font-weight:bold;color: black">PERMIT HISTORY</h5>'
                            );
                           var person_code=$('#person_code').html();
                           var uid_expiry=$('#uid_expiry').html();
                           var uid_no=$('#uid_no').html();
                           var visa_expiry=$('#visa_expiry').html();
                           var visa_type=$('#visa_type').html();
                           var visa_no=$('#visa_no').html();
                           var pass_expiry=$('#pass_expiry').html();
                           var pass_no=$('#pass_no').html();
                           var birthday=$('#birthday').html();
                           var age=$('#age').html();
                           var sponsor_name=$('#sponsor_name').html();
                           var address=$('#address').html();
                           var email=$('#email').html();


                            $(win.document.body).prepend(
                                '<table STYLE="color: #000000" class="table table-striped"><tr><th colspan="6" class="text-center" style="font-weight: bold;font-size: 15px">ARTIST DETAILS</th></tr>' +
                                '<tr><th>Person Code</th><td>'+person_code+'</td><th>Age</th><td>'+age+'</td><th>Birthday</th><td>'+birthday+'</td></tr>' +
                                '<tr><th>UID No.</th><td>'+uid_no+'</td><th>UID Expiry</th><td>'+uid_expiry+'</td><th>E-mail</th><td>'+email+'</td></tr>' +
                                '<tr><th>Visa Type</th><td>'+visa_type+'</td><th>Visa No.</th><td>'+visa_no+'</td><th>Passport No.</th><td>'+pass_no+'</td></tr>' +
                                '<tr><th>Passport Expiry</th><td>'+pass_expiry+'</td><th>Sponsor</th><td>'+sponsor_name+'</td><th>Address</th><td>'+address+'</td></tr></table>'
                                );

                            $(win.document.body).find('h1').css('display','none')
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );

                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': '12px'});
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [2,3,4,5,6,7]
                        },
                        title: function () {
                         return 'Permit History '+new Date();
                        },
                    },
                ],
                lengthMenu: [
                    [10, 25, 50],
                    ['10 rows', '25 rows', '50 rows']
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,
                searching: true,

                ajax: {
                    url: '{{ route('admin.artist.permit.history', $artist_permit->artist_id) }}',
                    data: function (d) {
                    }
                },
                columns: [
                    {render: function(){ return null; }},
                    {
                        render: function(type, row, full, meta){
                            return '<button class="btn btn-secondary btn-sm btn-document">{{ __('Documents') }}</button>';
                        }
                    },
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'permit_status'},
                    {data: 'permit_number'},
                    {data: 'issued_date'},
                    {data: 'expired_date'},
                ],
             /*   createdRow: function(row, data, index){
                    $('td:not(:first-child)',row).click(function(e){ location.href = '{{ url('/artist_permit') }}/'+data.permit_id; });

                    $('.btn-document', row).click(function(e){
                        e.stopPropagation();
                        documents(data);
                        $('#document-modal').modal('show');

                    });
                }*/
            });
        }


        function documents(data){
            console.log(data)
            $('#document-modal').on('shown.bs.modal', function(){
                $('table#table-document').DataTable({
                    ajax:{
                        url: '{{ url('/artist_permit') }}/'+data.permit_id+'/application/'+'{{ $artist_permit->artist_permit_id }}'+'/documentDatatable',
                    },
                    columns:[
                        {data: 'document_name'},
                        {data: 'issued_date'},
                        {data: 'expired_date'},
                    ]
                });
            });
        }

    </script>
@stop
