@extends('layouts.app')

@section('title', 'Event Permits - Smart Government Rak')

@section('content')

<section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">


    <div class="kt-portlet__body">

        <ul class="nav nav-tabs " role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">Applied
                    Event Permits </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#" data-target="#kt_tabs_1_2">Valid
                    Event Permits</a>
            </li>
            <li class="nav-item">

                <a class="nav-link" data-toggle="tab" href="#" data-target="#kt_tabs_1_3">Permit Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#" data-target="#kt_tabs_1_4">

                    Event Permit Drafts</a>
            </li>
            <li class="nav-item"
                style="position:absolute; {{    Auth::user()->LanguageId == 1 ? 'right: 3%' : 'left: 3%' }}">
                <a href="{{ route('event.create')}}">

                    <button class="btn btn--yellow btn-sm btn-wide" id="nav--new-permit-btn">
                        Add New Permit
                    </button>
                    <button class="btn btn--yellow btn-sm mx-2" id="nav--new-permit-btn-mobile">
                        <i class="la la-plus"></i>
                    </button>
                </a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
                <table class="table table-striped table-borderless" id="applied-events-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Refer No.</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Venue</th>
                            {{-- <th>Type</th> --}}
                            <th>Applied On</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                </table>

            </div>
            <div class="tab-pane" id="kt_tabs_1_2" role="tabpanel">
                <table class="table table-striped table-borderless " id="existing-events-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Refer No.</th>
                            <th>Permit No.</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Venue</th>
                            {{-- <th>Type</th> --}}
                            <th>Applied On</th>
                            <th>Actions</th>
                            <th>Details</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>


            <div class="tab-pane" id="kt_tabs_1_3" role="tabpanel">
                <div class="kt-portlet__body">
                    <div id="kt_calendar"></div>

                </div>
            </div>

            <div class="tab-pane" id="kt_tabs_1_4" role="tabpanel">
                <table class="table table-striped table-borderless " id="drafts-events-table">
                    <thead class="thead-dark">
                        <tr>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Venue</th>
                            <th>Venue-Ar</th>
                            <th>Applied On</th>
                            <th>Actions</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                </table>
            </div>


        </div>


        <!--end: Datatable -->



        <!--begin::Modal-->
        <div class="modal fade" id="cancel_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Cancel Permit</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('event.cancel')}}" id="cancel_permit_form" method="POST" novalidate>
                            @csrf
                            <label>Are you sure to Cancel this Permit of Ref No. <span class="text--maroon"
                                    id="cancel_permit_number"></span>
                                ?</label>
                            <textarea name="cancel_reason" rows="3" placeholder="Enter the reason here..."
                                style="resize:none;" class="form-control" id="cancel_reason"></textarea>
                            <input type="hidden" id="cancel_permit_id" name="permit_id">
                            <input type="submit" class="btn btn-sm btn--yellow popup-submit-btn" value="Cancel Permit">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--end::Modal-->

        <!--begin::Modal-->

        <div class="modal fade" id="cancelled_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"

            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">Cancelled Reason</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">

                        <p id="cancelled_reason" class="text--maroon kt-font-bold kt-font-transform-i"></p>

                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->
        <!--begin::Modal-->
        <div class="modal fade" id="rejected_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rejected Reason</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="rejected_reason" class="text--maroon kt-font-bold kt-font-transform-i"></p>
                    </div>
                </div>
            </div>
        </div>

        <!--end::Modal-->

        <input type="hidden" id="valid_events" value="{{json_encode($events)}}">





    </div>

    @endsection

    @section('script')


    <script>
        var events = JSON.parse($('#valid_events').val());

        console.log(events);

        $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table1 = $('#applied-events-table').DataTable({
            responsive: true,

            processing: true,
            serverSide: true,
            searching: true,
            order:[[4,'desc']],
            ajax:'{{route("company.event.fetch_applied")}}',

            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'venue_en', name: 'venue_en' },
                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'permit_status', name: 'permit_status' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:0,

                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },

                {
                    targets:4,
                    className:'dt-head-nowrap dt-body-nowrap',
                    render: function(data, type, full, meta) {
                        return '<span class="kt-font-bold">'+ moment(data).format('DD-MMM-YYYY') +'</span>';

					}
                },

                {
                    targets:-3,
                    width: '10%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold kt-font-transform-c">${data}</span>`;
					}
                }
            ],
            language: {
                emptyTable: "No Applied Event Permits"
            }
        });



        var table2 = $('#existing-events-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            deferRender: true,
            order:[[4,'desc']],
            ajax:'{{route("company.event.fetch_valid")}}',
            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'venue_en', name: 'venue_en' },
                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'permit_status', name: 'permit_status' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:0,
                    className: 'dt-body-nowrap dt-head-nowrap',

                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },


                {
                    targets:4,
                    className:'dt-head-nowrap dt-body-nowrap',
                    render: function(data, type, full, meta) {
                        return '<span class="kt-font-bold">'+ moment(data).format('DD-MMM-YYYY') +'</span>';

					}
                },


                {
                    targets:-3,
                    width: '10%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
					return `<span class="kt-font-bold kt-font-transform-c">${data}</span>`;

					}
                }
            ],
            language: {
                emptyTable: "No Existing Event Permits"
            }
        });

        var table3 = $('#drafts-events-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            deferRender: true,
            order:[[4,'desc']],
            ajax:   '{{route("company.event.fetch_draft")}}',
            columns: [
                { data: 'issued_date', name: 'issued_date' },
                { data: 'expired_date', name: 'expired_date' },
                { data: 'venue_en', name: 'venue_en' },
                { data: 'venue_ar', name: 'venue_ar' },

                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:-3,
                    width: '12%',
                    render: function(data, type, full, meta) {
                        return '<span class="kt-font-bold">'+ moment(data).format('DD-MMM-YYYY') +'</span>';

					}
                },
            ],
            language: {
                emptyTable: "No Event Permit Drafts"
            }

        });



    });

    const cancel_permit = (id, refno) => {
        $('#cancel_permit_id').val(id);
        $('#cancel_permit_number').html('<strong>'+refno+'</strong>');
    }

    const show_cancelled = (id) => {
        var url = "{{route('company.event.cancel_reason', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            success: function(data){
                if(data) {
                    $('#cancelled_reason').html(data);
                }

            }
        });
    }

    $('#cancel_permit_form').validate({
        rules: {
            cancel_reason: 'required'
        },
        message: {
            cancel_reason: 'Please fill the field'
        }
    });


    const rejected_permit = id => {
        $.ajax({

            url: "{{url('company/reject_reason')}}"+'/'+id,
            success: function(data){
                $('#rejected_reason').html(data);
            }
        });
    }

    </script>
    <script src="{{asset('js/list-view.js')}}"></script>

    @endsection
