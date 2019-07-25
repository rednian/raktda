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
                  <i class="flaticon-multimedia"></i> Pending Request
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_tab_content" role="tab" aria-selected="false">
                  <i class="flaticon-cogwheel-2"></i> All Permit
                </a>
              </li>
              
            </ul>
          </div>
        </div>
        <div class="kt-portlet__body">
          <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_base_demo_1_tab_content" role="tabpanel">
              <table class="table table-bordered table-condensed table-hover table-sm">
                  <thead>
                      <tr>
                          <th>Company Name</th>
                          <th>Permit Number</th>
                          <th>Issued Date</th>
                          <th>Expired Date</th>
                          <th>Permit Status</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
              </table>
            </div>
            <div class="tab-pane" id="kt_portlet_base_demo_2_tab_content" role="tabpanel">
              <table class="table table-bordered table-condensed table-hover table-sm" id="artist-permit">
                  <thead>
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
          </div>
        </div>
    </div>
  </div>
</section>
<div class="select-company hide">
  <div class="form-row">
     <div class="col-2">
        <select onchange="artistPermit.draw();" name="company_id" id="company_id" class="form-control input-sm select2">
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
        <select onchange="artistPermit.draw();" name="permit_status" id="permit_status" class="form-control input-sm select2">
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
     var artistPermitRequest = {};
    $(document).ready(function(){

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
        
                { data: 'company_name', name: 'company_name'},
                { data: 'permit_number', name: 'permit_number'},
                { data: 'issued_date', name: 'issued_date'},
                { data: 'expired_date', name: 'expired_date'},
                {
                  render: function(data, type, full, meta){
                      var className = null;
                      
                      if(full.permit_status == 'active'){ className = 'kt-badge--success'; }
                      if(full.permit_status == 'rejected'){ className = 'kt-badge--danger'; }
                      if(full.permit_status == 'cancelled'){ className = 'kt-badge--warning'; }

                    return '<span class="kt-badge '+className+' kt-badge--inline kt-badge--pill">'+full.permit_status+'</span>';
                  }
                },

                {
                    render: function (data, type, full, meta) {
                     
                       return '<a href="#" class="btn btn-outline-info btn-sm btn-elevate">Show Details</a>';

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