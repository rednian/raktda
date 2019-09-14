@extends('layouts.app')

@section('content')



<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- end:: Header -->
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">


    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <section class="row">
            <div class="col">

                <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">


                    <div class="kt-portlet__body">

                        <ul class="nav nav-tabs " role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">Applied
                                    Artists Permits </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#" data-target="#kt_tabs_1_2">Existing
                                    Artists Permits</a>
                            </li>
                            <li class="nav-item" style="position:absolute; right: 3%;">
                                <a href="/company/add_new_artist"><button class="btn btn--yellow btn-sm btn-wide">Add
                                        New
                                        Permit</button></a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
                                <table
                                    class="table table-striped- table-bordered table-condensed table-hover table-checkable"
                                    id="applied-artists-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Refer No.</th>
                                            <th>Permit No.</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Address</th>
                                            <th>Applied on</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="tab-pane " id="kt_tabs_1_2" role="tabpanel">
                                <table class="table table-striped- table-bordered table-hover table-checkable"
                                    id="existing-artists-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Refer No.</th>
                                            <th>Permit No.</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                            <th>Address</th>
                                            <th>Applied on</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--end: Datatable -->
                    </div>
            </div>
    </div>


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
                    <form action="{{route('company.cancel_permit')}}" id="cancel_permit_form" method="post" novalidate>
                        {{csrf_field()}}
                        <label>Are you sure to Cancel this Permit of ID <span class="text--maroon"
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




</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table1 = $('#applied-artists-table').DataTable({
            responsive: true,
            beforeSend: function (request) {
                request.setRequestHeader("token", token);
            },
            processing: false,
            serverSide: true,
            searching: true,
            // pageLength: 5,
            order:[[5,'desc']],
            // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            ajax:'{{route("company.fetch_applied_artists")}}',
            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'permit_number', name: 'permit_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'permit_status', name: 'permit_status' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:2,
                    width: '12%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:3,
                    width: '12%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:4,
                    width: '10%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:5,
                    width: '12%',
                    render: function(data, type, full, meta) {
                        return '<span class="kt-font-bold">'+ moment(data).format('DD-MMM-YYYY') +'</span>';

					}
                },
                {
                    targets:1,
                    width: '12%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:-3,
                    width: '10%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                }
            ],
            language: {
                emptyTable: "No Applied Artist Permits"
            }
        });



        var table2 = $('#existing-artists-table').DataTable({
            responsive: true,
            beforeSend: function (request) {
                request.setRequestHeader("token", token);
            },
            processing: false,
            serverSide: true,
            searching: true,
            // pageLength: 5,
            deferRender: true,
            // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            order:[[4,'desc']],
            ajax:'{{route("company.fetch_existing_artists")}}',
            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'permit_number', name: 'permit_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'permit_status', name: 'permit_status' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:2,
                    width: '12%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:3,
                    width: '12%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:4,
                    width: '10%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:5,
                    width: '12%',
                    render: function(data, type, full, meta) {
                        return '<span class="kt-font-bold">'+ moment(data).format('DD-MMM-YYYY') +'</span>';

					}
                },
                {
                    targets:1,
                    width: '12%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                },
                {
                    targets:-3,
                    width: '10%',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-bold">${data}</span>`;
					}
                }
            ],
            language: {
                emptyTable: "No Existing Artist Permits"
            }
        });


    });

    const cancel_permit = (id, number) => {
        $('#cancel_permit_id').val(id);
        $('#cancel_permit_number').html('<strong>'+number+'</strong>');
    }

    const show_cancelled = (id) => {
        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        $.ajax({
            url: "{{route('company.show_cancelled')}}",
            type: 'POST',
            data: {id:id},
            success: function(data){
            //  $("#div1").html(result);
                // console.log(data);
                $('#cancelled_reason').html(data[0].cancel_reason);
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
    })


</script>
@endsection
