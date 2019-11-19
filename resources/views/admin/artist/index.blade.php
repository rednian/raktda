@extends('layouts.admin-app')
@section('content')
<section class="row">
    <div class="col">
        <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--sm">
                <div class="kt-portlet__head-label">
                    <h4 class="kt-portlet__head-title">Artist List</h4>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <i class="la la-arrow-left"></i>
                    <button class="kt-hidden-mobile" onclick="goBack()">Back</button>
                    <div class="dropdown dropdown-inline">
                        <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon-more"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                            <a class="dropdown-item" href="{{ route('admin.artist_permit.index') }}">Artist Permit
                                List</a>
                            <a class="dropdown-item" href="{{ route('admin.artist_permit.request') }}">Artist Permit
                                Request List</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-hover" id="artist-table">
                    <thead>
                        <tr>
                            <th>Artist Name</th>
                            <th>Nationality</th>
                            <th>Email</th>
                            <th>Artist Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
    var artistTable = {};
  $(document).ready(function(){
      function goBack() {
          window.history.back();

      }


          var url = "http://javarevisited.blogspot.com";
         var location= $(location).attr('href',url);
         console.log(location);


          artistTable = $('table#artist-table').DataTable({
                ajax: {
                  url: '{{ route('admin.artist_permit.artistDataTable') }}',
                },

                columnDefs: [
                  {targets:  [3, 4], className: 'no-wrap',sortable: false},
                ],

                columns: [
                    { data: 'name'},
                    { data: 'nationality'},
                    { data: 'email'},
                    {
                      render: function(type, data, full, meta){
                          var status = full.artist_status;
                          var classname = 'success';
                          if(status == 'block'){ classname = 'danger';
                          }
                          return '<span class="kt-badge kt-badge--inline kt-badge--pill   kt-badge--'+classname+'">'+status+'</span>';
                      }
                    },
                    {
                      render: function(type, data, full, meta){
                         return '<a href="#" class="btn btn-brand active btn-sm btn-raised">view details</a>';
                      }
                    }
                ],

                 fnCreatedRow: function(row ,data, index){
                 },
          });

  });
</script>
@endsection
