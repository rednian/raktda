@extends('layouts.app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Artist Permit</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-condensed table-hover table-checkable" id="table-artist">
                        <thead>
                            <tr>
                                <th>Permit No.</th>
                                <th>Artist Name</th>
                                <th>Permit Status</th>
                                <th>Issued Date</th>
                                <th>Expired Date</th>
                                <th>Company Name</th>
                                <th>Work Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){

       var profession = $('table#table-artist').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('artist.datatable') }}',
               global: false,
           },
    
           columnDefs: [
                {targets:  0, className: 'no-wrap'},
                {targets:  3, className: 'no-wrap',sortable: false},
           ],
       
           columns: [
               { data: 'permmit_number', name: 'permmit_number'},
               { data: 'name', name: 'name_en'},
               { data: 'permit_status', name: 'permit_status'},
               { data: 'issued_date', name: 'issued_date'},
               { data: 'expired_date', name: 'expired_date'},
               { data: 'company_name', name: 'company_name'},
               { data: 'work_location', name: 'work_location'},
               {
                   render: function (data, type, full, meta) {
                      var url = '{{ url('profession') }}';
                      return ' <a class="btn btn-link btn-outline-danger btn-sm kt-margin-t-5 kt-margin-b-5">Delete</a>\
                                <a class="btn btn-link btn-outline-info btn-sm kt-margin-t-5 kt-margin-b-5">Edit</a>';

                   },
               },
           ],
            
           fnCreatedRow: function(row, data, index){

           }
           //     $('button.btn-delete', row).click(function(){
           //         bootbox.confirm('Are you sure you want delete ' + data.supplier_name + '?', function(result){
           //             if(result == true){
           //                 $.ajax({
           //                     url: '{{ url('suppliers') }}/' + data.supplier_id,
           //                     data: { _method: 'DELETE' },
           //                     type: 'POST',
           //                     dataType: 'JSON',
           //                     success: function(){
           //                         tblSupplier.ajax.reload(null, false);
           //                     }
           //                 });
           //             }
           //         })
           //     });
           // }
       });

       ('#table-artist').wrap('<div class="table-responsive"></div>');
       
        // $("div.toolbar").html($('select[name=supplier_country]'));
    });
</script>
@endsection