@extends('layouts.app')

@section('title', 'Artist Permits - Smart Government Rak')

@section('content')

<section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">

    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 "
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#"
                            data-target="#applied">@lang('words.applied_artist_permit')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#valid">@lang('words.valid_artist_permit')</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#draft">@lang('words.artist_permit_drafts')</a>
                    </li>
                    <span class="nav-item"
                        style="position:absolute; {{    Auth::user()->LanguageId == 1 ? 'right: 3%' : 'left: 3%' }}">
                        <a href="{{ url('company/add_new_permit')}}">
                            <button class="btn btn-label-yellow btn-sm kt-font-bold kt-font-transform-u"
                                id="nav--new-permit-btn">
                                <i class="la la-plus"></i>@lang('words.add_new')
                            </button>
                            <button class="btn btn-label-yellow btn-sm mx-2" id="nav--new-permit-btn-mobile">
                                <i class="la la-plus"></i>
                            </button>
                        </a>
                    </span>
                </ul>
            </div>
        </section>


        <div class="tab-content">
            <div class="tab-pane active" id="applied" role="tabpanel">
                <table class="table table-striped table-hover border table-borderless" id="applied-artists-table">
                    <thead>
                        <tr>
                            <th>@lang('words.reference_no')</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>@lang('words.location')</th>
                            <th>@lang('words.noofartist')</th>
                            <th>@lang('words.status')</th>
                            <th>Actions</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                </table>

            </div>
            <div class="tab-pane" id="valid" role="tabpanel">
                <table class="table table-striped table-borderless table-hover border" id="existing-artists-table">
                    <thead>
                        <tr>
                            <th>@lang('words.reference_no')</th>
                            <th>@lang('words.permit_number')</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>@lang('words.location')</th>
                            <th>@lang('words.noofartist')</th>
                            <th>Actions</th>
                            <th>Details</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="tab-pane" id="draft" role="tabpanel">
                <table class="table table-striped table-borderless table-hover border" id="drafts-artists-table">
                    <thead>
                        <tr>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>@lang('words.location')</th>
                            <th>Added On</th>
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
                        <form action="{{route('company.cancel_permit')}}" id="cancel_permit_form" method="post"
                            novalidate>
                            @csrf
                            <label>Are you sure to Cancel this Permit of Ref No. <span class="text--maroon"
                                    id="cancel_permit_number"></span>
                                ?</label>
                            <textarea name="cancel_reason" rows="3" placeholder="Enter the reason here..."
                                style="resize:none;" class="form-control" id="cancel_reason"></textarea>
                            <input type="hidden" id="cancel_permit_id" name="permit_id">
                            <input type="submit" class="btn btn-sm btn-label-maroon popup-submit-btn" value="Cancel">
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

        var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');
            $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });

        var table1 = $('#applied-artists-table').DataTable({
            responsive: true,
            processing: false,
            serverSide: true,
            searching: true,
            // pageLength: 5,
            // order:[[5,'desc']],
            // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            ajax:'{{route("company.fetch_applied_artists")}}',
            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'artist_count', name: 'artist_count' },
                { data: 'permit_status', name: 'permit_status' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:2,
                    width: '12%',
                    render: function(data, type, full, meta) {
						return `<span >${data}</span>`;
					}
                },
                {
                    targets:3,
                    width: '10%',
                    render: function(data, type, full, meta) {
						return `<span >${data}</span>`;
					}
                },
                {
                    targets:1,
                    width: '12%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return `<span >${data}</span>`;
					}
                },
                {
                    targets:4,
                    className: 'text-center',
                    render: function(data, type, full, meta) {
                        return `<span >${data}</span>`;
					}
                },
                {
                    targets:-3,
                    width: '10%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-transform-c">${data}</span>`;
					}
                }
            ],
            language: {
                emptyTable: "No Applied Artist Permits"
            }
        });



        var table2 = $('#existing-artists-table').DataTable({
            responsive: true,
            // beforeSend: function (request) {
            //     request.setRequestHeader("token", token);
            // },
            processing: false,
            serverSide: true,
            searching: true,
            // pageLength: 5,
            deferRender: true,
            // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            // order:[[6,'desc']],
            ajax:'{{route("company.fetch_existing_artists")}}',
            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'permit_number', name: 'permit_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'artist_count', name: 'artist_count' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
                { data: 'download', name: 'download' },
            ],
            columnDefs: [
                {
                    targets:-1,
                    width: '5%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
						return data;
					}
                }
            ],
            language: {
                emptyTable: "No Valid Artist Permits"
            }
        });

        var table3 = $('#drafts-artists-table').DataTable({
            responsive: true,
            processing: false,
            serverSide: true,
            searching: true,
            // pageLength: 5,
            deferRender: true,
            // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            // order:[[3,'desc']],
            ajax:'{{route("company.fetch_existing_drafts")}}',
            columns: [
                { data: 'issued_date', name: 'issued_date' },
                { data: 'expired_date', name: 'expired_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:-3,
                    width: '12%',
                    render: function(data, type, full, meta) {
                        return '<span >'+ moment(data).format('DD-MMM-YYYY') +'</span>';

					}
                },
            ],
            language: {
                emptyTable: "No Drafts Added"
            }
        });


    });

    const cancel_permit = (id, refno) => {
        var url = "{{route('company.artist.get_status', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            success: function(result){
               result = result.replace(/\s/g, '');
                if(result != '') {
                    if(result == 'new'){
                        $('#cancel_permit').modal('show');
                        $('#cancel_permit_id').val(id);
                        $('#cancel_permit_number').html('<strong>'+refno+'</strong>');
                    }else {
                        alert('Permit is already in processing');
                    }

                }
            }
        });
    }

    const show_cancelled = (id) => {
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
        messages: {
            cancel_reason: 'Please Enter the Reason !'
        }
    });


    const rejected_permit = id => {
        $.ajax({
            url: "{{url('company/show_rejected')}}"+'/'+id,
            success: function(data){
                $('#rejected_reason').html(data.comment);
            }
        });
    }


    </script>
    @endsection
