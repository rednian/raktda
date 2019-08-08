@extends('layouts.admin-app')
@section('content')
<section class="row">
  <div class="col-md-12">
    <div class="kt-portlet kt-portlet--tabs">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
             Artist Permit
            </h3>
          </div>
          <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-right" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_tab_content" role="tab" aria-selected="true">
                  <span class="kt-badge kt-badge--outline kt-badge--outline-2x kt-badge--success hide" id="number-permit-request">0 </span><i class="flaticon-users"></i>
                   Pending Request
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_tab_content" role="tab" aria-selected="false">
                  <i class="flaticon-users-1"></i> Artist Permit List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_3_tab_content" role="tab" aria-selected="false">
                  <i class="flaticon2-group"></i> Artist List
                </a>
              </li>
              
            </ul>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content" role="tabpanel">
              <table class="table table-bordered table-condensed table-hover table-sm" id="artist-request">
                  <thead class="thead-light">
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
            <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content" role="tabpanel">
              <table class="table table-bordered table-condensed table-hover table-sm" id="artist-permit">
                  <thead class="thead-light">
                      <tr>
                          <th>Company Name</th>
                          <th>Permit Number</th>
                          <th>Issued Date</th>
                          <th>Expired Date</th>
                          <th>Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
              </table>
            </div>
            <div class="tab-pane" id="kt_portlet_base_demo_3_tab_content" role="tabpanel">
              <table class="table table-bordered table-condensed table-hover table-sm" id="artist-table">
                  <thead class="thead-light">
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
          </div>
        </div>
    </div>
  </div>
</section>
<div class="select-company hide">
  <div class="form-row">
     <div class="col-2">
        <select onchange="artistPermit.draw();" name="company_id" id="company_id" class="custom-select input-sm select2">
            <option value="">All Company</option>
            @if(!empty($companies))
              @foreach($companies as $company)
                <option value="{{ $company->company_id }}">{{ ucwords($company->company_name) }}</option>
              @endforeach
            @endif        
        </select>
     </div>
  </div>
</div>
<div class="select-status hide">
  <div class="form-row">
     <div class="col-2">
        <select onchange="artistPermit.draw();" name="permit_status" id="permit_status" class="custom-select input-sm select2">
            <option value="">All Status</option>
            <option value="active">Active</option>       
            <option value="cancelled">Cancelled</option>       
            <option value="rejected">Rejected</option>       
        </select>
     </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
     var artistPermit = {};
     var artistTable = {};
     var artistPermitRequest = {};
    $(document).ready(function(){

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
                          if(status == 'block'){ classname = 'danger'; }
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
                // { data: 'work_location', name: 'work_location'},
                { data: 'issued_date'},
                { data: 'expired_date'},
                {
                  render: function(data, type, full, meta){
                      var className = null;
                      // if(full.permit_status == 'pending'){ className = 'kt-badge--info'; }
                    return '<span class="kt-badge kt-badge--inline kt-badge--pill   kt-badge--info">'+full.permit_status+'</span>';
                  }
                },
                { data: 'artist_number', name: 'artist_number'},
                {
                    render: function (data, type, full, meta) {
                      var url = '{{ url('permit/artist_permit') }}/'+full.permit_id+'/applicationdetails';
                       return '<a href="#" class="btn btn-brand active btn-sm btn-raised">view details</a>';

                    },
                },
            ],

            fnCreatedRow: function(row ,data, index){

                $('td', row).click(function(){ 
                  var url = '{{ url('permit/artist_permit') }}/' + data.permit_id+'/application-details'; 
                  location.href = url; 
                });

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


           // $('#artist-request').wrap('<div class="table-responsive"></div>');




         artistPermit = $('table#artist-permit').DataTable({
            dom: '<"pull-left"l><"toolbar"><"toolbar2">frt<"pull-left"i>p',
            ajax: {
                url: '{{ route('admin.artist_permit.datatable') }}',
                data: function(data){
                   data.company_id = $('select[name=company_id]').val();
                   data.permit_status = $('select[name=permit_status]').val();
                }
            },
        
            columnDefs: [
                 {targets: [0,4], className: 'no-wrap'},
                 {targets:  5, className: 'no-wrap',sortable: false},
            ],
            columns: [
        
                { data: 'company_name'},
                { data: 'permit_number'},
                { data: 'issued_date'},
                { data: 'expired_date'},
                {
                  render: function(data, type, full, meta){
                      var className = null;
                      
                      if(full.permit_status == 'active'){ className = 'success'; }
                      if(full.permit_status == 'rejected'){ className = 'danger'; }
                      if(full.permit_status == 'cancelled'){ className = 'warning'; }

                    return '<span class="kt-badge kt-badge--inline kt-badge--pill   kt-badge--'+className+'">'+full.permit_status+'</span>';
                  }
                },

                {
                    render: function (data, type, full, meta) {
                     
                       return '<a href="#" class="btn btn-brand active btn-sm btn-raised">view details</a>';

                    },
                },
            ],
             
            fnCreatedRow: function(row, data, index){

            }
        });

        $("div.toolbar").html($('.select-company').removeClass('hide'));
        $("div.toolbar2").html($('.select-status').removeClass('hide'));
    });
</script>
@endsection