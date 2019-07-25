@extends('layouts.admin-app')
@section('action')
     <a href="{{ route('permit_type.create') }}" style="margin-bottom: 2%" class="btn btn-brand pull-right btn-sm">New Permit Type</a>
@endsection
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">Permit Type</h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                   
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered table-condensed table-hover table-sm" id="artist-profession">
                        <thead>
                            <tr>
                                <th>Permit Code</th>
                                <th>Name</th>
                                <th>Fee</th>
                                <th>Duration</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
    </div>
</section>
<div class="select-type hide">
  <div class="form-row">
     <div class="col-2">
      <?php
        $types = App\PermitType::groupBy('permit_type')->get();
        $statuses = App\PermitType::groupBy('status')->get();
      ?>
        <select onchange="artistType.draw();" name="permit_type" id="permit_type" class="form-control input-sm select2">
            <option value="">All Type</option>
            @if(!empty($types))
              @foreach($types as $type)
                <option value="{{ $type->permit_type }}">{{ ucwords($type->permit_type) }}</option>
              @endforeach
            @endif        
        </select>
     </div>
  </div>
</div>
<div class="select-status hide">
  <div class="form-row">
     <div class="col-2">
        <select onchange="artistType.draw();" name="status" id="status" class="form-control input-sm select2">
            <option value="">All Status</option>
            @if(!empty($statuses))
              @foreach($statuses as $status)
                <option value="{{ $status->status }}">{{ $status->status ? 'Active' : 'Inactive' }}</option>
              @endforeach
            @endif        
        </select>
     </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  var artistType = {};
    $(document).ready(function(){

        artistType = $('table#artist-profession').DataTable({
           dom: '<"pull-left"l><"toolbar"><"toolbar2">frt<"pull-left"i>p',
           ajax: {
               url: '{{ route('permit_type.datatable') }}',
               data: function(data){
                  data.permit_type = $('select[name=permit_type]').val();
                  data.status = $('select[name=status]').val();
               }
           },
    
           columnDefs: [
                {targets:  [0, 4, 5], className: 'no-wrap'},
                {targets:  6, className: 'no-wrap',sortable: false},
           ],
           columns: [
       
               { data: 'permit_type_code', name: 'permit_type_code'},
               { data: 'name_en', name: 'name_en'},
               {
                    render: function (data, type, full, meta){
                        return full.amount+' AED';
                    }
                },
                 { data: 'duration', name: 'duration'},
                 { data: 'permit_type', name: 'permit_type'},
                 {
                  render: function(data, type, full, meta){
                     var status = full.status ?  'checked': '';

                    var html  = '<span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">';
                        html += '   <label style="margin-bottom: 0">';
                        html += '       <input class="checkbox" '+status+' type="checkbox" name="status">';
                        html += '      <span></span>';
                        html += ' </label>';
                        html += '</span>';
                      return html;        
                  }
                 },
               {
                   render: function (data, type, full, meta) {
                    
                      return ' <button type="button" class="btn btn-outline-danger btn-delete btn-sm btn-elevate">Delete</button>\
                                <a class="btn btn-outline-info btn-sm btn-elevate">Edit</a>';

                   },
               },
           ],
            
           fnCreatedRow: function(row, data, index){

            //change the status
            $('input[type=checkbox].checkbox', row).change(function(){

              var status = $(this).prop('checked') ? 1 : 0;
              $.ajax({
                url: '{{ url('settings/permit_type') }}/'+data.permit_type_id+'/update_status',
                data: { _method : 'PUT', status:  status }
              }).done(function(response){});

            });
           
           //delete 
            $('button.btn-delete', row).click(function(){
                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.name_en + '</span>?', function(result){
                    if(result){
                        $.ajax({
                          url: '{{ url('settings/permit_type') }}/'+data.permit_type_id,
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

         $("div.toolbar").html($('.select-type').removeClass('hide'));
         $("div.toolbar2").html($('.select-status').removeClass('hide'));
    });
</script>
@endsection