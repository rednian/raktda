@extends('layouts.admin-app')
@section('action')
<a href="{{ route('admin.artist_permit.index') }}" class="btn btn-light btn-elevate active btn-raised">
  <i class="la la-arrow-left"></i>
  <span class="kt-hidden-mobile">Back</span>
</a>
<a href="#" class="btn btn-brand active btn-sm btn-raised">Company Details</a>
@endsection
@section('content')
<section class="row">
   <div class="col">
    <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
               Permit Information
            </h3>
          </div>
        </div>
       <div class="kt-portlet__body">
          <div class="kt-widget kt-widget--user-profile-1">
              <div class="kt-widget__body">
                <div class="kt-widget__content" style="padding: 0">
                  <div class="kt-widget__info">
                    <span class="kt-widget__label">Permit Status: </span>
                      <span class="kt-widget__data">
                        @php
                        $class = 'primary';
                          if($permit->permit_status == 'active' ){ $class = 'success'; }
                          if($permit->permit_status == 'rejected' ){ $class = 'danger'; }
                          if($permit->permit_status == 'cancelled' ){ $class = 'warning'; }
                        @endphp
                        @status(['class'=>$class])
                          {{ $permit->permit_status }}
                        @endstatus
                      </span>
                  </div>
                  <div class="kt-widget__info">
                    <span class="kt-widget__label">Date Submit:</span>
                    <span class="kt-widget__data">{{ $permit->created_at->format('d-M-Y') }}</span>
                  </div>
                  <div class="kt-widget__info">
                    <span class="kt-widget__label">Permit Start:</span>
                    <span class="kt-widget__data">{{ $permit->issued_date->format('d-M-Y') }}</span>
                  </div>
                  <div class="kt-widget__info">
                    <span class="kt-widget__label">Permit End:</span>
                    <span class="kt-widget__data">{{ $permit->expired_date->format('d-M-Y') }}</span>
                  </div>
                  <div class="kt-widget__info">
                    <span class="kt-widget__label" style="display: block;">Work Location: </span>
                    <span class="kt-widget__data" style="dis">{{ $permit->work_location }}</span>
                  </div>  
                  
                </div>
              </div>
          </div>
       </div>
     </div>
  </div>
  <div class="col">
    <div class="kt-portlet ">
      <div class="kt-portlet__head  ">
        <div class="kt-portlet__head-label">
          <h3 class="kt-portlet__head-title">Company Information</h3>
        </div>
      </div>
      <div class="kt-portlet__body">
        <div class="kt-widget kt-widget--user-profile-1">
          <div class="kt-widget__head">
            <div class="kt-widget__content">
              <div class="kt-widget__section">
                <a href="#" class="kt-widget__username">{{ ucwords($permit->company->company_name) }}
                  @php
                  $class = 'primary';
                    if($permit->company->company_status == 'active' ){ $class = 'success'; }
                    if($permit->company->company_status == 'rejected' ){ $class = 'danger'; }
                    if($permit->company->company_status == 'cancelled' ){ $class = 'warning'; }
                  @endphp
                  @status(['class'=>$class])
                    {{ $permit->company->company_status }}
                  @endstatus
                </a>
                {{-- <span class="kt-widget__subtitle">
                  Head of Development
                </span> --}}
              </div>
              {{-- <div class="kt-widget__action">
                <button type="button" class="btn btn-info btn-sm">chat</button>&nbsp;
                <button type="button" class="btn btn-success btn-sm">follow</button>
              </div> --}}
            </div>
          </div>
          <div class="kt-widget__body">
            <div class="kt-widget__content">
              <div class="kt-widget__info">
                <span class="kt-widget__label">Contact Person: </span>
                <span class="kt-widget__data">{{ $permit->company->contact_person }}</span>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Designation: </span>
                <span class="kt-widget__data">{{ $permit->company->contact_person_designation }}</span>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Email:</span>
                <a href="mailto:{{ $permit->company->company_email }}" class="kt-widget__data">{{ $permit->company->company_email }}</a>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Phone:</span>
                <span class="kt-widget__data">{{ $permit->company->company_phone_number }}</span>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Mobile:</span>
                <span class="kt-widget__data">{{ $permit->company->company_mobile_number }}</span>
              </div>
              <div class="kt-widget__info">
                <span class="kt-widget__label">Location:</span>
                <span class="kt-widget__data">{{ $permit->company->company_address.' '.$permit->company->city.' '.$permit->company->country }}</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<section class="row">
      <div class="col-sm-12">
        <div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
            <div class="kt-portlet__head">
              <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Artist List
                </h3>
              </div>
            </div>
            <div class="kt-portlet__body">
              <table class="table table-bordered table-condensed table-hover" id="table-artist">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Name</th>
                      <th>Profession</th>
                      <th>Age</th>
                      <th>Nationality</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead> 
                </table>
            </div>
          </div>
      </div>
    </section>
    <section id="btn-submit" class="hide">
      <button class="btn btn-sm btn-light btn-raised">Submit to Manager</button>
    </section>
@endsection
@section('script')
<script>
  var artist_table = {};
  $(document).ready(function(){
    artist_table = $('table#table-artist').DataTable({
      dom: '<"pull-left"l><"toolbar"><"toolbar2">frt<"pull-left"i>p',
      ajax:{
        url: '{{ route('admin.artist_permit.applicationdetails.datatable', $permit) }}',
      },
      columnDefs: [
        {targets:  [5, 6], className: 'no-wrap',sortable: false},
        {targets: 0, checkboxes: {'selectRow': true} }
      ],
      select: { 'style': 'multi'},
      order: [[1, 'asc']],
      columns: [
        {data: 'artist_permit_id', name: 'artist_permit_id'},
        {data: 'name', name: 'name'},
        {data: 'name_en', name: 'name_en'},
        {data: 'age', name: 'age'},
        {data: 'nationality', name: 'nationality'},
        {data: 'status_label', name: 'status_label'},
        {
          render : function(type, data, full, meta){
            var url = '{{ url('permit/artist_permit') }}/'+full.permit_id+'/application/'+full.artist_permit_id;
            return '<a href="'+url+'" class="btn btn-sm btn-brand btn-raised active">Take Action</a>';
          }
        },

      ],

      createdRow: function(row, data, index){
        
        $('td input[type=checkbox].dt-checkboxes', row).change(function(){
          
        });

        var class_name = null;
        if(data.artist_permit_status == 'incomplete'){ class_name = 'text-warning'; }
        if(data.artist_permit_status == 'complete'){ class_name = 'text-success'; }
        if(data.artist_permit_status == 'rejected'){ class_name = 'text-danger'; }
        $('td', row).addClass(class_name);

      }
    });

     $("div.toolbar").html($('#btn-submit').removeClass('hide'));

    var selected_row = artist_table.column(0).checkboxes.selected();

    $('input[type=checkbox]').change(function(){

      console.log( artist_table.column(0).checkboxes.selected());
    });

    selected_row.each(function(index, row_id){

    });
  });
</script>
@endsection