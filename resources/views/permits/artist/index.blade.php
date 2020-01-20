@extends('layouts.app')

@section('title', 'Artist Permits - Smart Government Rak')

@section('content')

@if(check_is_blocked()['status'] == 'rejected')
@include('permits.artist.common.company_reject')
@endif

@if(check_is_blocked()['status'] == 'blocked')
@include('permits.artist.common.company_block')
@endif

<section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">

    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 "
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#applied"
                            data-target="#applied">{{__('Applied Permits')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#valid">{{__('Valid Permits')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#expired">{{__('Expired Permits')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cancel">{{__('History')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#draft">{{__('Drafts')}}</a>
                    </li>
                    @if(check_is_blocked()['status'] != 'blocked' && check_is_blocked()['status'] != 'rejected')
                    <span class="nav-item"
                        style="position:absolute; {{    Auth::user()->LanguageId == 1 ? 'right: 3%' : 'left: 3%' }}">
                        <a href="{{ URL::signedRoute('company.add_new_permit', ['id' => 1])}}">
                            <button class="btn btn--yellow btn-sm kt-font-bold kt-font-transform-u"
                                id="nav--new-permit-btn">
                                <i class="la la-plus"></i>{{__('Add New')}}
                            </button>
                            <button class="btn btn--yellow btn-sm mx-2" id="nav--new-permit-btn-mobile">
                                <i class="la la-plus"></i>
                            </button>
                        </a>
                    </span>
                    @endif
                </ul>
            </div>
        </section>
        <div class="tab-content">
            <div class="tab-pane active" id="applied" role="tabpanel">
                <table class="table table-striped table-hover border table-borderless" id="applied-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('PERMIT TERM')}}</th>
                            <th>{{__('From Date')}}</th>
                            <th>{{__('To Date')}}</th>
                            <th>{{__('Work Location')}}</th>
                            <th>{{__('Artists')}}</th>
                            <th>{{__('STATUS')}}</th>
                            <th class="text-center">{{__('ACTION')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>

            </div>
            <div class="tab-pane" id="valid" role="tabpanel">
                <table class="table table-striped table-borderless table-hover border" id="existing-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('PERMIT TERM')}}</th>
                            <th>{{__('Permit Number')}}</th>
                            <th>{{__('From Date')}}</th>
                            <th>{{__('To Date')}}</th>
                            <th>{{__('Work Location')}}</th>
                            <th>{{__('Artists')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="tab-pane" id="expired" role="tabpanel">
                <table class="table table-striped table-borderless table-hover border" id="expired-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('PERMIT TERM')}}</th>
                            <th>{{__('Permit Number')}}</th>
                            <th>{{__('From Date')}}</th>
                            <th>{{__('To Date')}}</th>
                            <th>{{__('Work Location')}}</th>
                            <th class="text-center">{{__('Artists')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="tab-pane" id="cancel" role="tabpanel">
                <table class="table table-striped table-borderless table-hover border" id="cancelled-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('Permit Number')}}</th>
                            <th>{{__('From Date')}}</th>
                            <th>{{__('To Date')}}</th>
                            <th>{{__('Work Location')}}</th>
                            <th class="text-center">{{__('Artists')}}</th>
                            <th>{{__('STATUS')}}</th>
                            <th>{{__('Comments')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="tab-pane" id="draft" role="tabpanel">
                <table class="table table-striped table-borderless table-hover border" id="drafts-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('From Date')}}</th>
                            <th>{{__('To Date')}}</th>
                            <th>{{__('Work Location')}}</th>
                            <th>{{__('ADDED ON')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>


        </div>

        <!--end: Datatable -->



        <!--begin::Modal-->
        <div class="modal fade" id="cancel_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('Cancel Permit')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('company.cancel_permit')}}" id="cancel_permit_form" method="post"
                            novalidate>
                            @csrf
                            <label>{{__('Are you sure to Cancel this Permit of Ref No. ')}} <span class="text--maroon"
                                    id="cancel_permit_number"></span>
                                ?</label>
                            <textarea name="cancel_reason" rows="3" placeholder="Enter the reason here..."
                                style="resize:none;" class="form-control" id="cancel_reason"></textarea>
                            <input type="hidden" id="cancel_permit_id" name="permit_id">
                            <input type="submit" class="btn btn-sm btn--maroon popup-submit-btn" value="Cancel">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--end::Modal-->

        <!--begin::Modal-->
        <div class="modal fade" id="cancelled_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('Cancelled Reason')}}</h5>
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
        <div class="modal fade" id="del_draft_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">{{__('Delete Draft')}}</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('artist.delete_draft')}}" method="POST" novalidate>
                            @csrf
                            <label>{{__('Are you sure to delete this draft')}}
                                ? {{__('Data will be lost')}}</label>
                            <input type="hidden" id="del_draft_id" name="del_draft_id">
                            <div>
                                <input type="submit" class="btn btn-sm btn--maroon pull-right" value="Delete">
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>

        <!--end::Modal-->


        <!--begin::Modal-->
        <div class="modal fade" id="rejected_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{__('Rejected Reason')}}</h5>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var getLangid = $('#getLangid').val();

        $(document).ready(function(){
            applied();
            valid();
            draft();
            expired();
            cancelled();
            setInterval(function(){ applied(); valid();}, 100000);
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });

            $('.nav-tabs a').on('shown.bs.tab', function (event) {
                var current_tab = $(event.target).attr('href');
                if (current_tab == '#applied' ) {  applied(); }
                if (current_tab == '#valid' ) { valid(); }
                if (current_tab == '#draft' ) { draft(); }
                if (current_tab == '#expired' ) { expired(); }
                if (current_tab == '#cancelled' ) { cancelled(); }
            });

        });

       function applied()
       {
            var table1 = $('#applied-artists-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                search: {
                    caseInsensitive: false
                },
                // pageLength: 5,
                // order:[[5,'desc']],
                // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                ajax:'{{route("company.fetch_applied_artists")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'term', name: 'term' },
                    { data: 'issued_date', name: 'issued_date', className: 'no-wrap' },
                    { data: 'expired_date', name: 'expired_date', className: 'no-wrap' },
                    { data: 'work_location', name: 'work_location' ,className: 'work-location-column'},
                    { data: 'permit_id', name: 'permit_id', className: 'no-wrap' },
                    { data: 'permit_status', name: 'permit_status' },
                    { data: 'action', name: 'action',  className: "text-center" },
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                columnDefs: [
                    {
                        targets:5,
                        className:'text-center',
                        render: function(data, type, full, meta) {
                            var artistPermit = JSON.parse(data);  
                            return artistPermit.length;
                        }
                    }
                ],
                language: {
                    emptyTable: "No Applied Artist Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
            });
       }



       function valid()
       {
            var table2 = $('#existing-artists-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                search: {
                    caseInsensitive: false
                },
                ajax:'{{route("company.fetch_existing_artists")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'term', name: 'term' },
                    { data: 'permit_number', name: 'permit_number' },
                    { data: 'issued_date', name: 'issued_date' , className: 'no-wrap'},
                    { data: 'expired_date', name: 'expired_date' , className: 'no-wrap'},
                    { data: 'work_location', name: 'work_location' , className: 'work-location-column'},
                    { data: 'permit_id', name: 'permit_id' , className: 'no-wrap'},
                    { data: 'action', name: 'action' ,  className: "text-center no-wrap"},
                    { data: 'download', name: 'download' ,  className: "text-center" },
                    { data: 'details', name: 'details' ,  className: "text-center" },
                ],
                columnDefs: [
                    {targets:'_all' ,className:'no-wrap'},
                    {
                        targets:-4,
                        className:'text-center',
                        render: function(data, type, full, meta) {
                            var artistPermit = JSON.parse(data);  
                            var total = artistPermit.length;
                            var noofapproved = 0 ;
                            for (var i = 0 ;i < total; i++) {
                                if (artistPermit[i].artist_permit_status == 'approved') {
                                    noofapproved++;
                                }
                            }
                            return "{{__('Approved')}} " + noofapproved + ' of ' + total;
                        }
                    },
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
                    emptyTable: "No Valid Artist Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
            });
       }

       function draft()
       {
            var table3 = $('#drafts-artists-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                search: {
                    caseInsensitive: false
                },
                // ordering: false,
                // pageLength: 5,
                deferRender: true,
                // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                order:[[3,'desc']],
                ajax:'{{route("company.fetch_existing_drafts")}}',
                columns: [
                    { data: 'issued_date', name: 'issued_date' },
                    { data: 'expired_date', name: 'expired_date' },
                    { data: 'work_location', name: 'work_location' },
                    { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                    { data: 'action', name: 'action', className: "text-center"},
                    { data: 'details', name: 'details',  className: "text-center"},
                ],
                columnDefs: [
                    {
                        targets:-3,
                        render: function(data, type, full, meta) {
                            return '<span >'+ moment(data).format('DD-MMM-YYYY') +'</span>';

                        }
                    },
                ],
                language: {
                    emptyTable: "{{__('No Artist Drafts Added')}}",
                    searchPlaceholder: "{{__('Search')}}"
                }
            });
       }


       function expired()
       {
            var table4 = $('#expired-artists-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                // pageLength: 5,
                // order:[[5,'desc']],
                // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                ajax:'{{route("company.fetch_expired_permits")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'term', name: 'term' },
                    { data: 'permit_number', name: 'permit_number' },
                    { data: 'issued_date', name: 'issued_date', className: 'no-wrap' },
                    { data: 'expired_date', name: 'expired_date', className: 'no-wrap' },
                    { data: 'work_location', name: 'work_location' ,className: 'work-location-column'},
                    { data: 'permit_id', name: 'permit_id', className: 'no-wrap text-center' },
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                columnDefs: [
                    {
                        targets:6,
                        className:'text-center',
                        render: function(data, type, full, meta) {
                            var artistPermit = JSON.parse(data);  
                            return artistPermit.length;
                        }
                    }
                ],
                language: {
                    emptyTable: "No Expired Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
            });
       }



       function cancelled()
       {
            var table5 = $('#cancelled-artists-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                // pageLength: 5,
                // order:[[5,'desc']],
                // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                ajax:'{{route("company.fetch_cancelled_permits")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'permit_number', name: 'permit_number' },
                    { data: 'issued_date', name: 'issued_date', className: 'no-wrap' },
                    { data: 'expired_date', name: 'expired_date', className: 'no-wrap' },
                    { data: 'work_location', name: 'work_location' ,className: 'work-location-column'},
                    { data: 'permit_id', name: 'permit_id', className: 'no-wrap text-center' },
                    { data: 'permit_status', name: 'permit_status', className:'text-center' },
                    { data: 'action', name: 'action', className:'text-center no-wrap' },
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                columnDefs: [
                    {
                        targets:5,
                        className:'text-center',
                        render: function(data, type, full, meta) {
                            var artistPermit = JSON.parse(data);  
                            return artistPermit.length;
                        }
                    },
                ],
                language: {
                    emptyTable: "No Cancelled or Rejected Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
            });
       }



 

    const cancel_permit = (id,  refno) => {
        var url = "{{route('company.artist.get_status', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            success: function(result){
                console.log(result)
                if(result['lock'] == 'no'){
                    $('#cancel_permit').modal('show');
                    $('#cancel_permit_id').val(id);
                    $('#cancel_permit_number').html('<strong>'+refno+'</strong>');
                }
            }
        });
    }

    const delete_draft  = (id, refno) => {
        $('#del_draft_modal').modal('show');
        $('#del_draft_id').val(id);
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