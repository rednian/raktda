@extends('layouts.admin-app')
@section('action')
     {{-- <a href="{{ route('permit_type.create') }}" style="margin-bottom: 2%" class="btn btn-brand active btn-raised pull-right btn-sm">New Permit Type</a> --}}
@endsection
@section('content')
<section class="row">
    <div class="col">
       <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
          <div class="kt-portlet__head kt-portlet__head--sm">
              <div class="kt-portlet__head-label">
                  <h4 class="kt-portlet__head-title">Artist List</h4>
              </div>
              <div class="kt-portlet__head-toolbar">
                 <a href="{{ URL::previous() }}" class="btn btn-sm btn-light ">
                   <i class="la la-arrow-left"></i>
                   <span class="kt-hidden-mobile">Back</span>
                 </a>
                 <div class="dropdown dropdown-inline">
                     <button type="button" class="btn btn-clean btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="flaticon-more"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                         <a href="" class="dropdown-item" href="#">Artist Permit List</a>
                         <a href=""  class="dropdown-item" href="#">Artist List</a>
                     </div>
                 </div>
              </div>
          </div>
          <div class="kt-portlet__body">
              <table class="table table-hover" id="artist-request">
                  <thead>
                      <tr>
                          <th>Company Name</th>
                          <th>Date Submitted</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Status</th>
                          <th># of Artist</th>
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
<script>
  artistPermitRequest = $('table#artist-request').DataTable({    
        ajax: {
        url: '{{ route('admin.artist_permit.requestDataTable') }}',
        data: function(data){
           // data.company_id = $('select[name=company_id]').val();
           // data.permit_status = $('select[name=permit_status]').val();
      }
    },
    columnDefs: [
      {targets:  [4, 5, 6], className: 'no-wrap',sortable: false},
    ],
    columns: [
        { data: 'company_name'},
        { data: 'submitted_date'},  
        { data: 'issued_date'},
        { data: 'expired_date'},
        {
          render: function(data, type, full, meta){
              var className = null;
            return '<span class="kt-badge kt-badge--inline kt-badge--pill   kt-badge--info">'+full.permit_status+'</span>';
          }
        },
        { data: 'artist_number', name: 'artist_number'},
        {
            render: function (data, type, full, meta) {
              var user_id = '{{ Auth::user()->user_id }}';

              if(!full.lock || user_id == full.user_id ){
                var url = '{{ url('permit/artist_permit') }}/'+full.permit_id+'/applicationdetails';
                 return '<a href="#" class="btn btn-brand active btn-sm btn-raised">view details</a>';
              }

              return '<img data-content="tesdfsgsg" data-container="body" data-offset="20x 20x" data-original-title data-trigger="focus" data-toggle="kt-popover" data-placement="top" src="{{ asset('/assets/media/icons/svg/Code/Info-circle.svg') }}"/>';



            },
        },
    ],

    createdRow: function(row ,data, index){
        var user_id = '{{ Auth::user()->user_id }}';
  
        if(!data.lock || user_id == data.user_id ){
            $('td', row).click(function(){ 
                var url = '{{ url('permit/artist_permit') }}/' + data.permit_id+'/application-details'; 
                location.href = url; 
              });
        }

      

    },

    fnRowCallback:function(row, data, index){

      $(row).css('cursor', 'pointer');
      // var now = moment().tz('Asia/Dubai');
      // var issued_date = moment(data.issued_date).add(2, 'days');

    
      // console.log(issued_date);

       
      //   if ( column.qty < 1  ){
      //      $(row).addClass('danger');
      //    }


      // if ( column.qty > 0 && column.qty < 20  ){
      //    $(row).addClass('warning');
      //  },
    },

    initComplete: function(setting, json){
      $('#number-permit-request').html(json.recordsTotal);
    }

  });
</script>
@endsection