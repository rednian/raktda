@extends('layouts.admin.admin-app')
@section('content')
<div  class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border" id="kt_page_portlet">
  <div class="kt-portlet__head kt-portlet__head--sm">
    <div class="kt-portlet__head-label">
      <h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">Artist Permit Details</h3>
    </div>
    <div class="kt-portlet__head-toolbar">
      <a href="{{ route('admin.artist_permit.index') }}" class="btn btn-sm btn-light btn-elevate kt-font-transform-u"><i class="la la-arrow-left"></i> Back</a>
      <div class="dropdown dropdown-inline">
        <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="flaticon-more"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" >
          <a class="dropdown-item kt-font-trasnform-u" href="#">Company Details</a>
          {{-- <div class="dropdown-divider"></div> --}}
          {{-- <a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a> --}}
        </div>
      </div>
    </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
      <div class="accordion accordion-light  accordion-toggle-arrow" id="accordionExample5">
        <div class="card">
          <div class="card-header" id="headingOne5">
            <div class="card-title kt-padding-t-10 kt-padding-b-10" data-toggle="collapse" data-target="#collapseOne5" aria-expanded="true" aria-controls="collapseOne5">
             <h6 class="kt-font-dark kt-font-transform-u">Basic Information</h6>
            </div>
          </div>
          <div id="collapseOne5" class="collapse show" aria-labelledby="headingOne5" data-parent="#accordionExample5">
            <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
              <section class="row kt-margin-b-10">
                <div class="col-6">
                  <section class="kt-section kt-padding-10 border">
                    <div class="kt-section__desc">
                    <h6 class="kt-font-dark kt-font-bold kt-margin-b-15">Permit Information</h6>
                      <table class="table table-borderless table-sm">
                        <tr>
                          <td>Reference No. :</td>
                          <td class="text-danger">{{ $permit->reference_number }}</td>
                        </tr>
                        <tr>
                          <td>Request Type :</td>
                          <td>
                            @if ($permit->request_type == 'new')
                             <span class="kt-badge kt-badge--inline kt-badge--info">{{ ucwords($permit->request_type) }}</span>
                            @endif
                            @if ($permit->request_type == 'renew')
                             <span class="kt-badge kt-badge--inline kt-badge--success">{{ ucwords($permit->request_type) }}</span>
                            @endif
                             @if ($permit->request_type == 'cancel')
                             <span class="kt-badge kt-badge--inline kt-badge--danger">{{ ucwords($permit->request_type) }}</span>
                            @endif
                            @if ($permit->request_type == 'amend')
                             <span class="kt-badge kt-badge--inline kt-badge--warning">{{ ucwords($permit->request_type) }}</span>
                            @endif
                          </td>
                        </tr>
                        @if ($permit->number)
                          <tr>
                            <td>Permit Number :</td>
                            <td>{{ $permit->permit_number ? $permit->permit_number : null   }}</td>
                          </tr>
                        @endif
                        <tr>
                          <td>Submitted Date:</td>
                          <td>
                            <span class="btn btn-label-brand btn-sm btn-bold btn-upper">{{ $permit->created_at ? $permit->created_at->format('d-M-Y') : null   }}</span>
                          </td>
                        </tr>
                        <tr>
                          <td>Permit Start :</td>
                          <td>
                            <span class="btn btn-label-brand btn-sm btn-bold btn-upper">{{ $permit->issued_date ? $permit->issued_date->format('d-M-Y') : null   }}</span>
                          </td>
                        </tr>
                        <tr>
                          <td>Work Location :</td>
                          <td>{{ ucwords($permit->work_location) }}</td>
                        </tr>
                      </table>
                      
                    </div>
                  </section>
                </div>
                <div class="col-6">
                  <section class="kt-section border kt-padding-10 kt-margin-b-20">
                    <div class="kt-section__desc">
                      <h6 class="kt-font-dark kt-font-bold kt-margin-b-10">Permit Action</h6>
                      <form method="post" class="kt-form" id="permit-action" action="{{ route('admin.artist_permit.submit', $permit->permit_id) }}">
                        @csrf
                        <div class="form-group form-group-xs">
                            <label>Notes</label>
                          <textarea name="comment"  rows="3" class="form-control-sm form-control"></textarea>
                        </div>
                        <div class="form-group form-group-sm">
                          <div class="kt-checkbox-list">
                            <label class="kt-checkbox">
                              <input type="checkbox" id="ck-need-approval"> Need Approval?
                              <span></span>
                            </label>
                          </div>
                        </div>
                        <div class="form-group kt-margin-t-15 d-none" id="approver-group">
                            <label>Approvers</label>
                            <div class="kt-checkbox-inline">
                              <label class="kt-checkbox">
                                <input  type="checkbox" name="role_id[]" value="{{ $roles->where('NameEn','inspector')->first()->role_id }}"> Inspector
                                <span></span>
                              </label>
                              <label class="kt-checkbox">
                                <input  type="checkbox" name="role_id[]" value="{{ $roles->where('NameEn','manager')->first()->role_id }}"> Manager
                                <span></span>
                              </label>
                            </div>
                            {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                          </div>
                          <div class="form-group">
                                <label>Select Action</label>
                                <div class="kt-radio-inline">
                                  <label class="kt-radio">
                                    <input type="radio" name="action" value="approve"> Approve
                                    <span></span>
                                  </label>
                                  <label class="kt-radio">
                                    <input type="radio" name="action" value="reject"> Reject
                                    <span></span>
                                  </label>
                                  <label class="kt-radio">
                                    <input type="radio" name="action" value="send_back"> Send Back to Client
                                    <span></span>
                                  </label>
                                </div>
                                {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                              </div>
                            <div class="form-group form-group-xs">
                              <button type="reset" class="btn btn-sm btn-elevate btn-light ">Clear</button>
                              <button type="submit" class="btn btn-sm btn-elevate btn-success">Submit</button>
                            </div>
                      </form>
                    </div>
                  </section>
                </div>
              </section>
              @if ( $permit->check->count() > 0)
                <div class="alert alert-outline-danger fade show" role="alert">
                  <div class="alert-icon"><i class="flaticon-warning"></i></div>
                  <div class="alert-text">
                    <p class="text-danger">The Following Artist have some discrepancy with their information.</p>
                    <ol class="text-danger">
                      @foreach ($permit->check as $check)
                        <li>{{ $check->artistPermit->artist->fullName }}</li>
                        <ul>
                          @foreach ($check->checklist as $checklist)
                            <li>{{ $checklist->fieldname }}</li>
                          @endforeach
                        </ul>
                      @endforeach
                    </ol>
                  </div>
                  <div class="alert-close">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"><i class="la la-close"></i></span>
                    </button>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
        @if ($permit->approver->count() > 0)
        <div class="card">
          <div class="card-header" id="headingThree5">
            <div class="card-title kt-padding-t-10 kt-padding-b-10" data-toggle="collapse" data-target="#collapseThree5" aria-expanded="true" aria-controls="collapseThree5">
              <h6 class="kt-font-dark kt-font-transform-u">Approvers</h6>
            </div>
          </div>
          <div id="collapseThree5" class="collapse show" aria-labelledby="headingThree5" data-parent="#accordionExample5">
            <div class="card-body">
             <table class="table-striped table table-borderless">
               <thead class="thead-dark">
                 <tr>
                   <th>User Role</th>
                   <th>Employee Name</th>
                   <th>Notes</th>
                   <th>Status</th>
                 </tr>
               </thead>
               <tbody>
                 @foreach ($permit->approver as $approver)
                 <tr>
                   <td>{{ ucwords($approver->role->NameEn) }}</td>
                   <td>{{ ucwords($approver->user->employee->emp_name) }}</td>
                   <td></td>
                   <td>
                    @if ($approver->status == 'approved')
                       <span class="kt-badge kt-badge--success kt-badge--inline">{{ ucwords($approver->status) }}</span>
                    @endif
                    @if ($approver->status == 'pending')
                       <span class="kt-badge kt-badge--info kt-badge--inline">{{ ucwords($approver->status) }}</span>
                    @endif
                   </td>
                 </tr>
                 @endforeach
               </tbody>
             </table>
            </div>
          </div>
        </div>
        @endif
        <div class="card">
          <div class="card-header" id="headingTwo5">
            <div class="card-title kt-padding-t-10 kt-padding-b-10  " data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="true" aria-controls="collapseTwo5">
               <h6 class="kt-font-dark kt-font-transform-u">Artist List</h6>
            </div>
          </div>
          <div id="collapseTwo5" class="collapse show" aria-labelledby="headingTwo5" data-parent="#accordionExample5" style="">
            <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10">
             <table class="table table-hover table-borderless table-striped table-sm" id="artist-table">
               <thead class="thead-dark">
                 <tr>
                   <th>Check</th>
                   <th>Person Code</th>
                   <th>Name</th>
                   <th>Age</th>
                   <th>Profession</th>
                   <th>Nationality</th>
                   <th>Artist Status</th>
                   <th>Action</th>
                 </tr>
               </thead>
               </table>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
var artist = {};
  var approver = {};

  $(document).ready(function(){

      $('#permit-action').validate({
         // onsubmit: false,
        debug:true,
        rules: {
          comment: {
            required: true,
            minlength: 1,
          },
          action:{
            required: true
          }
        },
        invalidHandler: function(event, validator) { 

          var errors  = validator.numberOfInvalids();

             KTUtil.scrollTop();
         },

         submitHandler: function (form) { form[0].submit(); }
      });

    $('input[type=checkbox]#ck-need-approval').change(function() {
      if($(this).is(':checked')){
        $('#approver-group').removeClass('d-none');
        $(this).find('input[type=checkbox]').removeAttr('disabled', true);
      }
      else{
           $('#approver-group').addClass('d-none');
           $(this).find('input[type=checkbox]').attr('disabled');
      }
    });

    $('input[type=checkbox]#ck-add-note').change(function() {
      if($(this).is(':checked')){
        $('textarea[name=comment]').removeAttr('disabled', true).parents('.form-group').removeClass('d-none');
      }
      else{
         $('textarea[name=comment]').attr('disabled', true).parent('.form-group').addClass('d-none');
      }
    });

     artist = $('table#artist-table');
     artist.DataTable({
      ajax:{
        url: '{{ route('admin.artist_permit.applicationdetails.datatable', $permit->permit_id) }}'
      },
        columnDefs: [
             {targets: '_all', className: 'no-wrap'},
             {targets:  [0], className: 'no-wrap',sortable: false},
        ],
        // order: [ [groupColumn, 'asc'] ], 
        columns: [
            {
              render: function (row, type, data){
                var check = data.check ?  'checked' : null;
                return  '<label class="kt-checkbox kt-checkbox--bold kt-checkbox--dark kt-checkbox--single"><input '+check+' disabled type="checkbox"><span></span></label>';
              }
            },
            { data: 'person_code'},
            { data: 'fullname'},
            { data: 'age'},
            { data: 'profession'},
            { data: 'nationality'},
            { data: 'artist_status'},
            {
              data: null,
              render: function(data, type){
                var url = '{{ url('/permit/artist') }}/'+data.artist_id;
                return '<a href="'+url+'" class="btn btn-link btn-elevate btn-sm">view artist</a>';
              }
            }
        ],       
        createdRow: function(row, data, index){


          $(row).click(function(){
            location.href = '{{ url('/artist_permit') }}/'+data.permit_id+'/application/'+data.artist_permit_id;
          });

          if(!data.check){
            if(data.type == 'Remove' || data.type == 'remove'){
             
            }
           
          }
        
          
        }
    });


  });
</script>
@endsection
