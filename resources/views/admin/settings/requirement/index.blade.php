@extends('layouts.admin-app')
@section('content')
<section class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Permit Requirement</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('requirement.create') }}" style="margin-bottom: 2%" class="btn btn-outline-primary btn-elevate btn-icon-sm pull-right btn-sm">New Permit Requirement</a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-striped table-bordered table-condensed table-hover table-sm" id="table-requirement">
                    <thead>
                        <tr>
                            <th>Requirement For</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
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
        <select onchange="requirementTable.draw();" name="requirement_type" id="requirement_type" class="form-control input-sm select2">
            <option value="">All Type</option>
            @if(!empty($requirements))
              @foreach($requirements as $requirement)
                <option value="{{ $requirement->requirement_type }}">{{ ucwords($requirement->requirement_type) }}</option>
              @endforeach
            @endif
        </select>
     </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  var requirementTable = {};
    $(document).ready(function(){

        requirementTable = $('table#table-requirement').DataTable({
            dom: '<"pull-left"l><"toolbar"><"toolbar2">frt<"pull-left"i>p',
           ajax: {
               url: '{{ route('requirement.datatable') }}',
               data: function(data){
                  data.requirement_type = $('select[name=requirement_type]').val();
               }
           },

           columnDefs: [
                {targets:  [0, 1,3], className: 'no-wrap'},
                {targets:  4, className: 'no-wrap',sortable: false},
           ],
           columns: [

               { data: 'requirement_type', name: 'requirement_type'},
               { data: 'requirement_name', name: 'requirement_name'},
               { data: 'requirement_description', name: 'requirement_description'},
               {
                  render : function(data, type, full, meta){

                    var status = full.status ?  'checked': '';

                    var html  = '<span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">';
                        html += '   <label>';
                        html += '       <input class="checkbox" '+status+' type="checkbox" name="status">';
                        html += '      <span></span>';
                        html += ' </label>';
                        html += '</span>';
                      return html;
                  }
               },
               {
                   render: function (data, type, full, meta) {
                      var url = '{{ url('settings/requirement') }}/'+full.requirement_id;
                      return ' <button type="button" class="btn btn-outline-danger btn-delete btn-sm btn-elevate">Delete</button>\
                                <a href="'+url+'" class="btn btn-outline-info btn-sm btn-elevate">Edit</a>';

                   },
               },
           ],

           fnCreatedRow: function(row, data, index){

              //change the status
              $('input[type=checkbox].checkbox', row).change(function(){

                var status = $(this).prop('checked') ? 1 : 0;
                $.ajax({
                  url: '{{ url('settings/requirement') }}/'+data.requirement_id+'/update_status',
                  data: { _method : 'PUT', status:  status }
                }).done(function(response){});

              });


            var type = data.requirement_type == 'artist' ? 'Artist Permit Requirement' : 'Event Permit Requirement';

            $('button.btn-delete', row).click(function(){
                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.requirement_name + ' for </span> '+type+' ?', function(result){
                    if(result){
                        $.ajax({
                          url: '{{ url('settings/requirement') }}/'+data.requirement_id,
                          data: {_method: 'delete'},
                          type: 'post',
                          dataType: 'json'
                        }).done(function(response){
                          requirementTable.ajax.reload(null, false);
                      });
                    }
                });
            });

           }
       });

        $("div.toolbar").html($('.select-container').removeClass('hide'));
        $('#table-requirement').wrap('<div class="table-responsive"></div>');


    });
</script>
@endsection
