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
                    <i class="kt-font-brand flaticon2-line-chart"></i>
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
                                        <a href="#" class="kt-nav__link">
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
            <table class="table table-striped- table-bordered table-hover table-checkable" id="applied-artists-table">
                <thead>
                    <tr>

                        <th>Artist Name</th>
                        <th>Nationality</th>
                        <th>Mobile</th>
                        <th>Email</th>
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
                    <i class="kt-font-brand flaticon2-line-chart"></i>
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

                        <th>Artist Name</th>
                        <th>Nationality</th>
                        <th>Mobile</th>
                        <th>Email</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <table class="w-100 table table-striped">
                        <tr>
                            <th>Name</th>
                            <td id="a_name"></td>
                            <th>Profession</th>
                            <td id="a_profession"></td>
                        </tr>
                        <tr>
                            <th>Nationality</th>
                            <td id="a_nationality"></td>
                            <th>Work Location</th>
                            <td id="work_loc"></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td id="a_email"></td>
                            <th>Permit Type</th>
                            <td id="a_permit_type"></td>
                        </tr>
                        <tr>
                            <th>Passsport</th>
                            <td id="a_passport"></td>
                            <th>UID Number</th>
                            <td id="a_uid_no"></td>
                        </tr>
                        <tr>
                            <th>DOB</th>
                            <td id="a_dob"></td>
                            <th>Phone Number</th>
                            <td id="a_phone"></td>
                        </tr>
                    </table>
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
                <div class="modal-body">
                    <form action="{{route('company.cancel_permit')}}" method="post">
                        {{csrf_field()}}
                        <label for="">Please specify the reason</label>
                        <textarea name="cancel_reason" class="form-control mb-3" id="cancel_reason" rows="3">

                        </textarea>
                        <input type="hidden" id="cancel_permit_id" name="permit_id">
                        <input type="submit" class="btn btn-danger pt-2 d-inline float-right" value="Cancel">
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
                    <h5 class="modal-title" id="exampleModalLabel">Cancelled Permit</h5>
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
        var table = $('#applied-artists-table').DataTable({
        responsive: true,
        processing: false,
        serverSide: true,
        searching: false,
        pageLength: 5,
        lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
        ajax:'{{route("company.json_applied_artists_list")}}',
        order: [[ 4, "desc" ]],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'nationality', name: 'nationality' },
            { data: 'mobile_number', name: 'mobile' },
            { data: 'email', name: 'email' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
            { data: 'details', name: 'details' },
        ]
    });


    var table = $('#existing-artists-table').DataTable({
        responsive: true,
        processing: false,
        serverSide: true,
        searching: false,
        pageLength: 5,
        lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
        ajax:'{{route("company.json_existing_artists_list")}}',
        order: [[ 4, "desc" ]],
        columns: [
            { data: 'name', name: 'name' },
            { data: 'nationality', name: 'nationality' },
            { data: 'mobile_number', name: 'mobile' },
            { data: 'email', name: 'email' },
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


    const show_details = (id) => {
        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        $.ajax({
            type: 'POST',
            url: '{{route("company.fetch_artist_details")}}',
            data: {id:id},
            success: function(data) {
               if(data)
               {
                //   console.log();
                   $('#a_name').html(data[0].artist['name']);
                   $('#a_profession').html(data[0].artist['profession']);
                   $('#a_nationality').html(data[0].artist['nationality']);
                   $('#a_phone').html(data[0].artist['phone_number']);
                   $('#a_email').html(data[0].artist['email']);
                   $('#a_permit_type').html(data[0].artist['artisttype'].artist_type_en);
                   $('#a_passport').html(data[0].artist['passport_number']);
                   $('#a_uid_no').html(data[0].artist['uid_number']);
                   $('#a_dob').html(data[0].artist['birthdate']);
                   $('#work_loc').html(data[0].work_location);
               }
            }
        });
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
