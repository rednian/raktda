@extends('layouts.app')

@section('content')
@component('layouts.subheader')
@slot('heading')
Permits
@endslot
@slot('subheading')
Artists
@endslot
@endcomponent


<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-copy"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    New Artist Permit Requests
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <a href="/company/add_new_artist" class="btn btn-brand btn-elevate btn-icon-sm">
                                <i class="la la-plus"></i>
                                New Artist Permit
                            </a>
                            &nbsp;
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>

                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link" onclick="window.print();">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a target="_blank" class="kt-nav__link"
                                            href="{{route('export_applied_artist_permits')}}">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-condensed table-hover table-checkable"
                id="applied-artists-table">
                <thead>
                    <tr>
                        <th>Permit No.</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Work Location</th>
                        <th>Applied On</th>
                        <th>Actions</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>




        </div>
    </div>


    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-paper"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    Existing Artist Requests
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-wrapper">
                    <div class="kt-portlet__head-actions">
                        <div class="dropdown dropdown-inline">
                            <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-download"></i> Export
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__section kt-nav__section--first">
                                        <span class="kt-nav__section-text">Choose an option</span>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon la la-print"></i>
                                            <span class="kt-nav__link-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a target="_blank" class="kt-nav__link"
                                            href="{{route('export_existing_artist_permits')}}">
                                            <i class="kt-nav__link-icon la la-file-excel-o"></i>
                                            <span class="kt-nav__link-text">Excel</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-hover table-checkable" id="existing-artists-table">
                <thead>
                    <tr>
                        <th>Permit No.</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Work Location</th>
                        <th>Applied On</th>
                        <th>Actions</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <!--end: Datatable -->
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="artist_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Artist Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="detail-permit">
                </div>
            </div>
        </div>
    </div>

    <!--end::Modal-->

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
                <form id="cancel_permit_form" action="{{route('company.cancel_permit')}}" method="post" novalidate>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <label for="cancel_reason" class="form-control-label">Reason :</label>
                        <textarea name="cancel_reason" placeholder="Enter the reason here..." style="resize:none;"
                            class="form-control" id="cancel_reason" rows="3"></textarea>
                        <input type="hidden" id="cancel_permit_id" name="permit_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-sm btn-danger" value="Cancel">
                    </div>
                </form>
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
                    <p id="cancelled_reason"></p>
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

        var table1 = $('#applied-artists-table').DataTable({
            responsive: true,
            processing: false,
            serverSide: true,
            searching: true,
            pageLength: 5,
            order:[[4,'desc']],
            lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            ajax:'{{route("company.json_applied_artists_list")}}',
            columns: [
                { data: 'permit_number', name: 'permit_number' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ]
        });



        var table2 = $('#existing-artists-table').DataTable({
            responsive: true,
            processing: false,
            serverSide: true,
            searching: true,
            pageLength: 5,
            deferRender: true,
            lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            order:[[4,'desc']],
            ajax:'{{route("company.json_existing_artists_list")}}',
            columns: [
                { data: 'permit_number', name: 'permit_number' },
                { data: 'issued_date', name: 'issued_date' },
                { data: 'expired_date', name: 'expired_date' },
                { data: 'work_location', name: 'work_location' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ]
        });


    });

    const cancel_permit = (id) => {
        $('#cancel_permit_id').val(id);
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
                console.log(data);
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


     async function show_details(id) {

        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        $.ajax({
            type: 'POST',
            url: '{{route("company.fetch_artist_details")}}',
            data: {permit_id:id},
            success: function(data) {
                $('#detail-permit').empty();
               if(data)
               {
                   $('#detail-permit').append('<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">');
                   for(var i = 0;i < data.length; i++){
                   $('#detail-permit').append('<div class="card"> <div class="card-header" id="heading'+i+'"> <div class="card-title" data-toggle="collapse" data-target="#collapseOne'+i+'" aria-expanded="true" aria-controls="collapseOne1"> <i class="flaticon2-user"></i> <span class="mainTitle">'+ data[i].artist.name+' - '+ data[i].artist.nationality+' - '+ data[i].artist.mobile_number+'</span></div> </div> <div id="collapseOne'+i+'" class="collapse" aria-labelledby="heading'+i+'" data-parent="#accordionExample6"> <div class="card-body"> <table class="w-100 detailPopupTable table"> <tr> <th>Email</th> <td>'+data[i].artist.email+'</td> <th>Profession</th> <td >'+data[i].permit_type.name_en+'</td>  </tr> <tr> <th>Passsport</th> <td >'+data[i].artist.passport_number+'</td> <th>UID Number</th> <td >'+data[i].artist.uid_number+'</td> </tr> <tr> <th>DOB</th> <td >'+data[i].artist.birthdate+'</td> <th>Phone Number</th> <td >'+data[i].artist.phone_number+'</td></tr></table><table class="w-100 detailPopupTable table"> <thead><th>Doc Type</th><th>Issue Date</th><th>Expiry Date</th><th>Action</th></thead><tbody>'+data[i].artist_permit_document.map(showDocumentsFn)+'</tbody></table></div> </div> </div><br/>');
                   (i == 0) ? $('#collapseOne'+i).addClass('show') : '';
                   }
                   $('#detail-permit').append('</div>');
                   $('.mainTitle').css('text-transform', 'capitalize');
               }
            }
        });
    }

    const showDocumentsFn = (doc) => {
        var base_url = window.location.origin;
        return '<tr><td>'+doc.document_name+'</td><td>'+doc.issued_date+'</td><td>'+doc.expired_date+'</td><td><a href="'+base_url+'/storage/'+doc.path+'" target="_blank">View</a></td></tr>';
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
