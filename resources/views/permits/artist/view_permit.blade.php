@extends('layouts.app')


@section('content')

@include('layouts.subheader',['heading' => ' Permit','subheading' => 'View Permit'])

<div class="kt-content  kt-grid__item kt-grid__item--fluid " id="kt_content">
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-brand flaticon2-copy"></i>
                </span>
                <h3 class="kt-portlet__head-title">
                    View Artist Permit Details
                </h3>
            </div>
            <div class="my-auto float-right">
                <a href="../artist_permits" class="btn btn-default btn-elevate btn-icon-sm">
                    <i class="la la-angle-left"></i>
                    Back
                </a>
                <a href="../edit_add_new_artist/{{$permit_details['permit_id']}}"
                    class="btn btn-brand btn-elevate btn-icon-sm ">
                    <i class="la la-plus"></i>
                    Add New Artist
                </a>

            </div>
        </div>
        <div class="kt-portlet__body">

            <div class="kt-widget5__info">
                <div>
                    <span>From Date:</span>
                    <span class="kt-font-info">{{date('d-m-Y',strtotime($permit_details['issued_date']))}}</span>&emsp;
                    <span>To Date:</span>
                    <span class="kt-font-info">{{date('d-m-Y',strtotime($permit_details['expired_date']))}}</span>
                </div><br />
                <div>
                    <span>Work Location:</span>
                    <span class="kt-font-info">{{$permit_details['work_location']}}</span>&emsp;
                    <span>Applied On:</span>
                    <span class="kt-font-info">{{$permit_details['created_at']}}</span>&emsp;
                </div><br />
                <div>
                    <span>Permit Status</span>
                    <span class="kt-font-info">{{$permit_details['permit_status']}}</span>
                </div><br />
            </div>

            <input type="hidden" id="permit_id" value="{{$permit_details['permit_id']}}">

            <!--begin: Datatable -->
            <table class="table table-striped- table-bordered table-condensed table-hover table-checkable"
                id="applied-artists-table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Profession</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>




        </div>
    </div>

</div>

<!--begin::Modal-->
<div class="modal fade" id="delartistmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('company.delete_artist_from_permit')}}" method="post">
                    @csrf
                    <p id="warning_text"></p>
                    <input type="hidden" id="del_artist_id" name="del_artist_id" />
                    <input type="hidden" id="del_permit_id" name="del_permit_id" />
                    <input type="submit" value="Remove" class="btn btn-danger1 float-right">
                </form>
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->


@endsection


@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
			headers : { "X-CSRF-TOKEN" :jQuery(`meta[name="csrf-token"]`).attr("content")}
		});
        var table1 = $('#applied-artists-table').DataTable({
            responsive: true,
            processing: false,
            serverSide: true,
            searching: true,
            pageLength: 5,
            order:[[4,'desc']],
            lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
            ajax: {
                url: '{{route("company.getArtistsInPermit")}}',
                data: { id: $('#permit_id').val()},
                method:'post'
            },
            columns: [
                { data: 'artist.firstname_en', name: 'artist.firstname_en' },
                { data: 'artist.lastname_en', name: 'artist.lastname_en' },
                { data: 'permit_type.name_en', name: 'permit_type.name_en' },
                { data: 'artist.mobile_number', name: 'artist.mobile_number' },
                { data: 'artist.email', name: 'artist.email' },
                { data: 'artist.artist_status', name: 'artist.artist_status' },
                { data: 'action', name: 'action' },
            ]
        });

    //     table1.on( 'order.dt search.dt', function () {
    //     table1.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    //         cell.innerHTML = i+1;
    //     } );
    // } ).draw();

    });

    function delArtist(aid, pid, total, fname, lname) {
        $('#del_artist_id').val(aid);
        $('#del_permit_id').val(pid);
        $('#warning_text').html('Are you sure to remove <b>'+ fname + ' '+ lname+ '</b> from this permit ?');
        $('#warning_text').css('color', '#580000')
    }
</script>
@endsection
