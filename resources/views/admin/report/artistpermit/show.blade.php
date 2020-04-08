@extends('layouts.admin.admin-app')
@section('content')
    <section class="kt-portlet kt-portlet--head-sm">
        <div class="kt-portlet__head kt-portlet__head--sm">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-primary">{{ __('ARTIST PROFILE') }}</span></h3></div>
            <div class="kt-portlet__head-toolbar">
                <button id="clickme" class="btn btn-sm btn-secondary btn-elevate  kt-font-transform-u">
                    <i class="la la-arrow-left"></i>{{ __('BACK TO Previous') }}
                </button>
            </div>
        </div>
        <div class="kt-portlet__body" style="padding-bottom: 0 !important;">
            <div class="accordion accordion-solid accordion-toggle-plus kt-margin-b-5 kt-hide" id="accordion-personal">
                <div class="card">
                    <div class="card-header" id="heading-personal">
                        <div class="card-title collapsed kt-padding-t-15 kt-padding-b-10" data-toggle="collapse" data-target="#collapse-personal" aria-expanded="false" aria-controls="collapse-personal">
                            <h6 class="kt-font-dark kt-font-transform-u">{{ __('PERSONAL INFORMATION') }}</h6>
                        </div>
                    </div>
                    <div id="collapse-personal" class="collapse show" aria-labelledby="heading-personal" data-parent="#accordion-personal" style="">
                        <div class="card-body">
                            <div class="kt-widget kt-widget--user-profile-3">
                                <div class="kt-widget__top">


                                    <div class="kt-widget__content">
                                        <div class="kt-widget__head">
                                            <div class="kt-widget__user">

                                                <span class="kt-widget__username kt-padding-b-10 kt-margin-r-5"></span>
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input  id="artist-status" type="checkbox"  name="">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>

                                                <span class="kt-widget__username kt-padding-b-10 kt-margin-r-5">{{ ucwords($artist_permit->name) }}</span>
                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                <label>
                                                    <input {{ $artist_permit->artist->artist_status == 'active'? 'checked': null }} id="artist-status" type="checkbox"  name="">
                                                    <span></span>
                                                </label>
                                            </span>

                                            </div>
                                        </div>

                                        <div class="kt-widget__subhead">

																 <span>{{ __('Current Company') }} :
                                                                    <span class="kt-font-dark kt-font-bolder">
                                                                   {{--     {{Auth()->user()->LanguageId==1? $artist->permit()->latest()->first()->owner->company->name_en : $artist->permit()->latest()->first()->owner->company->name_ar}}--}}
                                                                    </span>
                                                                </span>


    										 <span>{{ __('Current Company') }} :
                                                <span class="kt-font-dark kt-font-bolder">
                                                    {{Auth()->user()->LanguageId==1? $artist_permit->permit()->latest()->first()->owner->company->name_en : $artist_permit->permit()->latest()->first()->owner->company->name_ar}}
                                                </span>
                                            </span>
                                            {{--										 <a href="#"><i class="flaticon2-calendar-3"></i>PR Manager </a>--}}
                                            {{--										 <a href="#"><i class="flaticon2-placeholder"></i>Melbourne</a>--}}

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_1" role="tab" aria-selected="true">{{ __('PERSONAL INFORMATION') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_2" role="tab" aria-selected="true">{{ __('PERMIT HISTORY') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_3" role="tab" aria-selected="false">{{ __('STATUS HISTORY') }}</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="kt_tabs_6_1" role="tabpanel">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">ARTIST DETAILS</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">PERSONAL DETAILS</h5>
                                            <ul>
                                                <li>Person Code : <span>{{$artist->person_code}}</span></li>
                                                <li>Date of Birth : <span>{{$artist->artist_permit?$artist->artist_permit->birthdate:'' }}</span></li>
                                                <li>Age :</li>
                                                <li>Gender</li>
                                                {{-- <li>Religion</li> --}}
                                                <li>Identification Number</li>
                                                <li>UID Number</li>
                                                {{-- <li>UID Expiry Date</li> --}}
                                                <li>Visa Type</li>
                                                <li>Visa Number</li>
                                                <li>Passport Number</li>
                                                <li>Passport Expiry Date</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="card ">
                                        <div class="card-body">
                                            <h5 class="card-title">CONTACT INFORMATION</h5>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">ADDRESS DETAILS</h5>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">SPONSOR DETAILS</h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">PERMIT DETAILS <span><button id="printHistory" class="pull-right btn btn-secondary btn-sm" style="line-height: 7px">Print</button></span></h5>
                                            <table class="table table-striped" id="PrintHistoryTable">
                                                <tr>
                                                    <th>#</th>
                                                    <th>PERMIT NO.</th>
                                                    <th>REFERENCE NO.</th>
                                                    <th>ISSUE DATE</th>
                                                    <th>EXPIRE DATE</th>
                                                    <th>STATUS</th>
                                                </tr>
                                                @foreach($artist->permit as $key => $permit)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$permit->permit_number}}</td>
                                                    <td>{{$permit->reference_number}}</td>
                                                    <td>{{\Carbon\Carbon::parse($permit->issued_date)->format('d-M-Y')}}</td>
                                                    <td>{{\Carbon\Carbon::parse($permit->expired_date)->format('d-M-Y')}}</td>
                                                    <td>
                                                   @if($permit->permit_status=='expired')
                                                            <button class="btn btn-danger btn-sm" style="line-height: 6px;
                                                                                                               border: none;
                                                                                                               border-radius: 2px;
                                                                                                               width: 73px;">{{$permit->permit_status}}</button>
                                                            @elseif($permit->permit_status=='new')
                                                                <button class="btn btn-success btn-sm"  style="line-height: 6px;
                                                                                                               border: none;
                                                                                                               border-radius: 2px;
                                                                                                               width: 73px;">{{$permit->permit_status}}</button>
                                                            @else
                                                            <button class="btn btn-warning btn-sm"  style="line-height: 6px;
                                                                                                               border: none;
                                                                                                               border-radius: 2px;
                                                                                                               width: 73px;">{{$permit->permit_status}}</button>
                                                    @endif
                                                    </td>
                                                </tr>
                                                 @endforeach
                                            </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="kt_tabs_6_2" role="tabpanel">

                        <table class="table table-striped table-borderless table-hover border" id="artist-permit-history">
                            <thead>
                            <tr>
                                <th>{{ __('REFERENCE NO.') }}</th>
                                <th>{{ __('ESTABLISHMENT NAME') }}</th>
                                <th>{{ __('PERMIT NO.') }}</th>
                                <th>{{ __('ISSUED DATE') }}</th>
                                <th>{{ __('EXPIRED DATE') }}</th>
                                <th>{{ __('PERMIT STATUS') }}</th>
                                <th>{{ __('ACTION') }}</th>
                            </tr>
                            </thead>
                        </table>

                </div>
                <div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">

                        <table class="table table-striped table-borderless table-hover border table-hover" id="status-history">
                            <thead>
                            <tr>
                                <th>{{ __('UNBLOCKED/BLOCKED BY') }}</th>
                                <th>{{ __('REMARKS') }}</th>
                                <th>{{ __('DATE') }}</th>
                                <th>{{ __('ACTION TAKEN') }}</th>
                            </tr>
                            </thead>
                        </table>

                </div>
            </div>

        </div>
    </section>
{{--    @include('admin.artist.include.artist-block-modal')
    @include('admin.artist_permit.includes.document')--}}
@endsection
@section('script')
    <script>
        var is_checked = false;
        $(document).ready(function () {
            $('button#btn-action').click(function(){
                $('#kt_modal_1').modal('show');
            });

            $('input#artist-status').change(function(){  });

            $('#kt_modal_1').on('hidden.bs.modal', function () {
                $('input#artist-status').attr();
            })

            $('#clickme').click(function(reload) {

                //     window.location.hash = '#kt_tabs_1_5';
                //  window.location.reload(true);
                window.history.back();
            });
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
                    url: '{{ route('admin.artist.status_history', $artist->artist_id) }}',
                    data: function (d) {
                    }
                },
                columnDefs: [
                    {targets: [0, 2, 3], className: 'no-wrap'}
                ],
                columns: [
                    {data: 'employee_name'},
                    {data: 'remarks'},
                    {data: 'created_at'},
                    {data: 'action'}
                ]
            });
        }
        $('#printHistory').click(function () {
            var tableToPrint =$('#PrintHistoryTable tbody')
            newWin = window.open("");
            newWin.document.write(tableToPrint.outerHTML);
            newWin.print();
            newWin.close();
        })

        function permitHistory() {
            $('table#artist-permit-history').DataTable({
                dom: 'Bfrtip',
                "searching":false,
                buttons: ['pageLength',
                    {
                        extend: 'pdf', messageBottom: datetime,
                        title: function () { return 'PERMIT HISTORY REPORT'; },

                    },
                    {
                        extend: 'excel',
                        title: function () {
                            return  'PERMIT HISTORY REPORT'; },
                    }
                ],
                lengthMenu: [
                    [ 10, 25, 50, 1 ],
                    [ '10 rows', '25 rows', '50 rows', 'Show all' ]
                ],
                processing: true,
                language: {
                    processing: '<span>Processing</span>',
                },
                serverSide: true,
                footer: true,

                ajax: {
                    url: '{{ route('admin.artist.permit.history', $artist->artist_id) }}',
                    data: function (d) {
                    }
                },
                columnDefs: [
                    {targets: [0, 5, 6], className: 'no-wrap'}
                ],
                columns: [
                    {data: 'reference_number'},
                    {data: 'company_name'},
                    {data: 'permit_number'},
                    {data: 'issued_date'},
                    {data: 'expired_date'},
                    {data: 'permit_status'},
                    {
                        render: function(type, row, full, meta){
                            return '<button class="btn btn-secondary btn-sm btn-document">Documents</button>';
                        }
                    }
                ],
                createdRow: function(row, data, index){

                    $('.btn-document', row).click(function(e){
                        e.stopPropagation();
                        documents(data);
                        $('#document-modal').modal('show');

                    });

                    $(row).click(function(){
                        location.href = '{{ url('/artist_permit') }}/'+data.permit_id;
                    });
                }
            });
        }

        function documents(data){
            console.log(data)
            $('#document-modal').on('shown.bs.modal', function(){
                $('table#table-document').DataTable({
                    ajax:{
                        url: '{{ url('/artist_permit') }}/'+data.permit_id+'/application/'+'{{ $artist->artist_permit_id }}'+'/documentDatatable',
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
