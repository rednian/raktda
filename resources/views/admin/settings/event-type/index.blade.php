@extends('layouts.app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Event Permit Type</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ URL::previous() }}" class="btn btn-clean">
                            <i class="la la-arrow-left"></i>
                            <span class="kt-hidden-mobile">Back</span>
                        </a>
                        <a href="{{ route('event_type.create') }}" style="margin-bottom: 2%" class="btn btn-outline-primary pull-right btn-sm">New Event Type 
                        </a>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-striped- table-bordered table-condensed table-hover table-checkable" id="event-type">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Event Permit Name</th>
                                <th>Event Fee</th>
                                <th>Duration</th>
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

       var event_type = $('table#event-type').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('event_type.datatable') }}',
               global: false,
           },
    
           columnDefs: [
                {targets:  4, className: 'no-wrap',sortable: false},
                {targets:  0, className: 'no-wrap'}
           ],
       
           columns: [
               { data: 'permit_code', name: 'permit_code'},
               { data: 'name_en', name: 'name_en'},
               {
                    render: function (data, type, full, meta){
                        return 'AED '+ full.amount_fee;
                    }
                },  
               { data: 'permit_type', name: 'permit_type'},
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