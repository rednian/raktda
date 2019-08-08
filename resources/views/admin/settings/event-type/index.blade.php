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
                    <a href="{{ route('event_type.create') }}" style="margin-bottom: 2%"
                        class="btn btn-outline-primary pull-right btn-sm">New Event Type
                    </a>
                </div>
            </div>
            <div class="kt-portlet__body">
                <table class="table table-striped- table-bordered table-condensed table-hover table-checkable"
                    id="event-type">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Event Type</th>
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
               { data: 'event_type_code', name: 'event_type_code'},
               { data: 'event_type_en', name: 'event_type_en'},
               {
                    render: function (data, type, full, meta){
                        return full.event_type_amount+' AED';
                    }
                },
               { data: 'event_duration', name: 'event_duration'},
               {
                   render: function (data, type, full, meta) {
                      var url = '{{ url('profession') }}';
                      return ' <button type="button" class="btn btn-outline-danger btn-delete btn-sm">Delete</button>\
                                <a class="btn btn-outline-info btn-sm">Edit</a>';

                   },
               },
           ],

           fnCreatedRow: function(row, data, index){


            $('button.btn-delete', row).click(function(){
                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.event_type_en + '</span>?', function(result){
                    if(result){
                        $.ajax({
                          url: '{{ url('settings/event/event_type') }}/'+data.event_type_id,
                          data: {_method: 'delete'},
                          type: 'post',
                          dataType: 'json'
                        }).done(function(response){
                          event_type.ajax.reload(null, false);
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
