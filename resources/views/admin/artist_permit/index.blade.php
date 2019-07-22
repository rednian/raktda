@extends('layouts.admin-app')
@section('content')
<section class="row">
  <div class="col-md-12">
    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
              <h3 class="kt-portlet__head-title">You have <strong id="request-number" class="kt-badge kt-badge--primary kt-badge--inline kt-badge--pill">0</strong> company requested for artist permit.</h3>
          </div>
      </div>
      <div class="kt-portlet__body">
        <div class="kt-portlet__content">
          <table class="table table-condensed table-hover table-sm table-bordered" id="table-artist-request">
            <thead>
              <tr>
                <th>Company Name</th>
                <th>Trade License No.</th>
                <th>Submitted On</th>
                <th>Number of Artist</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
        </div>
  </div>
</section>
<section class="row">
    <div class="col-md-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Artist Permit List</h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered table-condensed table-hover" id="table-artist">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Permit No.</th>
                                <th>Artist Name</th>
                                <th>Issued Date</th>
                                <th>Expired Date</th>
                                <th>Company Name</th>
                                <th>Permit Status</th>
                                <th></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
    </div>
</section>

<div class="select-container hide">
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
@endsection
@section('script')
<script type="text/javascript">
     var artistPermit = {};
     var artistPermitRequest = {};
    $(document).ready(function(){

        artistPermitRequest = $('table#table-artist-request').DataTable({
          ajax: {
              url: '{{ route('artist.datatablerequest') }}',
              data: function(d){
                 // d.type = 'new';
              }
          },
          columnDefs: [
            {targets:  [3,4], className: 'no-wrap',sortable: false},
            {targets: 4, className: 'text-center'}
          ],
          columns: [
            { data: 'company_name', name: 'company_name'},
            { data: 'company_trade_license', name: 'company_trade_license'},
            { data: 'submitted_on', name: 'submitted_on'},
            {
              render: function (data, type, full, meta){
                  return ' <span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">'+full.artist_number+'</span>';
              }
            },
            { 
              render: function(data, type, full, meta){
                var url = '{{ url('permit/artist') }}/'+full.artist_permit_id;
                return '<a href="'+url+'" class="btn btn-link btn-sm">Take Action</a>';
              }
            },
          ],
          initComplete: function(setting, json){
            $('#request-number').html(json.recordsTotal);
          }
        });
       


        artistPermit = $('table#table-artist').DataTable({
            dom: '<"pull-left"l><"toolbar"><"toolbar2">frt<"pull-left"i>p',
           ajax: {
               url: '{{ route('artist.datatable') }}',
               data: function(d){
                  d.permit_status = null;
                  d.company_id = $('select[name=company_id]').val();
               }
           },

            buttons: [
                        {
                            extend: 'colvis',
                            className: 'btn btn-default btn-sm with-border',
                            text: '<i class="fa fa-gear"></i> Columns <i class="fa fa-caret-down"></i>',
                            postfixButtons: [ 'colvisRestore' ],
                            init: function(api, node, config) {
                                  $(node).removeClass('btn-default');
                               }
                        }
                ],


           columnDefs: [
                  // {
                  //    'targets': 0,
                  //    'searchable':false,
                  //    'orderable':false,
                  //    'className': 'dt-body-center',
                  //    'render': function (data, type, full, meta){
                  //        return '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid"><input class="m-checkable" type="checkbox" name="id[]" value="'+ $('<div/>').text(data).html() + '"></label>';
                  //    }
                  // },
                { targets: 0, orderable: false,  checkboxes: { selectRow: true } },
                {targets:  [1, 2, 3, 4, 5, 6], className: 'no-wrap'},
                {targets:  7, className: 'no-wrap',sortable: false},
           ],
           'select': { 'style': 'multi' },
           'order': [[1, 'asc']],
      
           columns: [
              { data: 'artist_permit_id', name: 'artist_permit_id'},
               { data: 'permit_number', name: 'permit_number'},
               { data: 'name', name: 'name'},
               { data: 'issued_date', name: 'issued_date'},
               { data: 'expired_date', name: 'expired_date'},
               { data: 'company_name', name: 'company_name'},
               {
                render: function(data, type, full, meta){
                    var className = 'kt-badge--default';
                    var status = null;
                    if(full.permit_status == 'new'){
                      status = 'New Request'; className = 'kt-badge--danger';
                    }
                    if(full.permit_status == 'active'){
                      status = 'Active'; className = 'kt-badge--success';
                    }
                  return ' <span class="kt-badge '+className+' kt-badge--inline kt-badge--pill">'+status+'</span>';
                } 
               },
               {
                   render: function (data, type, full, meta) {
                    var url = '';
                       // url = '{{ url('permit/artist') }}/'+full.artist_id+'/application/'+full.artist_permit_id;
                     
                      return '<a class="btn btn-link btn-sm" href="'+url+'">Show Details</a>';

                   },
               },
           ],
          
            
           fnCreatedRow: function(row, data, index){
            
            //$('td', row).click(function(){ var url = '{{ url('project') }}/' + data.project_id; location.href = url; });
              
              // e.stopPropagation();
           },



       });
          
          window.rows_selected = artistPermit.column(0).checkboxes.selected();
          $.each(rows_selected, function(index, id){

            console.log(id);
          });

        $('input[type=checkbox].dt-checkboxes').change(function(event) {
          
        });;

        $("div.toolbar").html($('.select-container').removeClass('hide'));
        $('#table-artist').wrap('<div class="table-responsive"></div>');
       
    });
</script>
@endsection