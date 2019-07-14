@extends('layouts.app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Artist Type Permits</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route('profession.create') }}" style="margin-bottom: 2%" class="btn btn-outline-primary btn-elevate btn-icon-sm pull-right btn-sm">New Artist Type</a>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-condensed table-hover table-checkable" id="artist-profession">
                        <thead>
                            <tr>
                                <th>Artist Code</th>
                                <th>Artist Permit Name</th>
                                <th>Permit Fee</th>
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

       var profession = $('table#artist-profession').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('profession.datatable') }}',
               global: false,
           },
    
           columnDefs: [
                {targets:  0, className: 'no-wrap'},
                {targets:  3, className: 'no-wrap',sortable: false},
           ],
       
           columns: [
               { data: 'artist_permit_code', name: 'artist_permit_code'},
               { data: 'name_en', name: 'name_en'},
               {
                    render: function (data, type, full, meta){
                        return 'AED '+ full.artist_type_amount;
                    }
                },  
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
       
        // $("div.toolbar").html($('select[name=supplier_country]'));
    });
</script>
@endsection