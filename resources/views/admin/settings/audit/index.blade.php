@extends('layouts.admin-app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Artist Permit Type</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <a href="{{ route('artist_type.create') }}" style="margin-bottom: 2%" class="btn btn-outline-primary btn-elevate btn-icon-sm pull-right btn-sm">New Artist Permit Type</a>
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

       var artistType = $('table#artist-profession').DataTable({
           ajax: {
               url: '{{ route('artist_type.datatable') }}',
           },
    
           columnDefs: [
                {targets:  0, className: 'no-wrap'},
                {targets:  3, className: 'no-wrap',sortable: false},
           ],
           columns: [
       
               { data: 'artist_type_code', name: 'artist_type_code'},
               { data: 'artist_type_en', name: 'artist_type_en'},
               {
                    render: function (data, type, full, meta){
                        return full.amount+' AED';
                    }
                },  
               {
                   render: function (data, type, full, meta) {
                      var url = '{{ url('profession') }}';
                      return ' <button type="button" class="btn btn-outline-danger btn-delete btn-sm ">Delete</button>\
                                <a class="btn btn-outline-info btn-sm ">Edit</a>';

                   },
               },
           ],
            
           fnCreatedRow: function(row, data, index){
           

            $('button.btn-delete', row).click(function(){
                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.artist_type_en + '</span>?', function(result){
                    if(result){
                        $.ajax({
                          url: '{{ url('settings/artist/artist_type') }}/'+data.artist_type_id,
                          data: {_method: 'delete'},
                          type: 'post',
                          dataType: 'json'
                        }).done(function(response){
                          artistType.ajax.reload(null, false);
                      });
                    }
                });
            });

           }
       });
       
        // $("div.toolbar").html($('select[name=supplier_country]'));
    });
</script>
@endsection