@extends('layouts.admin.admin-app')
@section('content')
	 <div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">Artist Permit Details</h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ route('admin.artist_permit.index') }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
							 <i class="la la-arrow-left"></i>
							 Back to permit list
						</a>
						<div class="dropdown dropdown-inline">
							 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="flaticon-more"></i>
							 </button>
							 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
									<a class="dropdown-item kt-font-trasnform-u" href="#">Company Details</a>
									{{-- <div class="dropdown-divider"></div> --}}
									{{-- <a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a> --}}
							 </div>
						</div>
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-5">
        @if ($permit->event()->count() > 0)
        <a href="{{ route('admin.event.show', $permit->event->event_id) }}">
          <div class="alert alert-outline-danger alert-bold kt-margin-t-10 kt-margin-b-10" role="alert">
            <div class="alert-text">This permit is connected to <span class="text-success kt-font-bold kt-font-transform-u">{{ $permit->event->name_en }}</span> event with reference number <span class="kt-font-danger">{{ $permit->event->reference_number }}</span>
              {{-- <span class="btn btn-maroon kt-font-transform-u btn-sm">Event Details <span class="la la-arrow-right"></span></span> --}}
            </div>
          </div>
          </a>
        @endif
				 <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample5">
						<div class="card">
							 <div class="card-header" id="headingOne5">
									<div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#collapseOne5"
											 aria-expanded="true" aria-controls="collapseOne5">
										 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">Basic Information</h6>
									</div>
							 </div>
							 <div id="collapseOne5" class="collapse show" aria-labelledby="headingOne5" data-parent="#accordionExample5">
									<div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
										 @include('admin.artist_permit.includes.company-information')
									</div>
							 </div>
						</div>
              @if ($permit->comment()->count() > 0)
               <div class="card">
                <div class="card-header" id="headingThree5">
                  <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#collapseThree5" aria-expanded="true" aria-controls="collapseThree5">
                    <h6 class="kt-font-dark kt-font-transform-u">checked & Approval History</h6>
                  </div>
                </div>
                <div id="collapseThree5" class="collapse show" aria-labelledby="headingThree5" data-parent="#accordionExample5">
                  <div class="card-body">
                    <table class=" border table-striped table table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>CHECKED BY</th>
                          <th>REMARKS</th>
                          <th>USER GROUP</th>
                          <th>CHECKED DATE</th>
                          <th>ACTION TAKEN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($permit->comment()->doesntHave('artistPermitComment')->orderBy('created_at', 'desc')->get() as $comment)
                        <tr>
                            <td>{{ ucwords($comment->user->NameEn) }}</td>
                            <td>
                              {{ ucfirst($comment->comment) }}
                              @if($comment->exempt_payment)
                              <br><span class="kt-badge kt-badge--warning kt-badge--inline">Exempted for Payment</span>
                              @endif
                            </td>
                            <td>{{ ucfirst($comment->role->NameEn) }}</td>
                            <td>{{ $comment->checked_date }}</td>
                            <td>{{ ucfirst($comment->action) }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              @endif
            </div>
            <section class="accordion accordion-solid accordion-toggle-plus kt-margin-t-15" id="accordion-permit-artist">
              <div class="card">
                <div class="card-header" id="accordion-permit-artist-heading-one">
                  <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#accordion-permit-artist-collapse-one"
											 aria-expanded="true" aria-controls="accordion-permit-artist-collapse-one">
										 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">Artist List</h6>
									</div>
							 </div>
							 <div id="accordion-permit-artist-collapse-one" class="collapse show" aria-labelledby="accordion-permit-artist-heading-one"
										data-parent="#accordion-permit-artist">
									<div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
                    <?php  $is_artist_check = $permit->artistpermit()->where('artist_permit_status', 'unchecked')->exists(); ?>
                    <div id="action-alert" class="alert d-none alert-outline-danger fade show" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning"></i></div>
                      <div class="alert-text">Please check each artist with the action status of
                        <span class="kt-badge kt-badge--warning kt-badge--inline">Unchecked</span>
                        before taking action!
                      </div>
                    </div>
                    <div id="action-alert-unselected" class="alert d-none alert-outline-danger fade show" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning"></i></div>
                      <div class="alert-text">Please check atleast one artist before taking action!</div>
                      <div class="alert-close"></div>
                    </div>
                    <table class="table table-hover table-borderless table-striped border table-sm" id="artist-table">
                      <thead>
                        <tr>
													 <th>PERSON CODE</th>
													 <th>ARSTIST NAME</th>
													 <th>AGE</th>
													 <th>PROFESSION</th>
													 <th>NATIONALITY</th>
													 <th>STATUS</th>
													 <th>ACTION</th>
												</tr>
												</thead>
										 </table>
									</div>
							 </div>
						</div>
				 </section>
				 <section class="accordion accordion-solid accordion-toggle-plus kt-margin-t-15" id="accordion-permit-history">
          <div class="card">
            <div class="card-header" id="accordion-permit-history-heading-one">
              <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#accordion-permit-history-collapse-one"
											 aria-expanded="true" aria-controls="accordion-permit-history-collapse-one">
                       <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">Permit History</h6>
              </div>
            </div>
            <div id="accordion-permit-history-collapse-one" class="collapse show" aria-labelledby="accordion-permit-history-heading-one"
										data-parent="#accordion-permit-history">
                <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
                  <?php
                  $permit_history = \App\Permit::whereNotIn('permit_status', ['cancelled', 'unprocessed', 'draft'])
                  ->whereDate('created_at', '<', $permit->created_at)
                  ->whereNotNull('permit_number')
									->where('permit_number', $permit->number)
									->get();
                  ?>
                  @if($permit_history->count() > 0)
                  <table class="table table-striped table-borderless table-hover" id="table-permit-history">
                    <thead>
                      <tr>
                        <th>Applied Date</th>
                        <th>Issued Date</th>
                        <th>Expired Date</th>
                        <th>Artists</th>
                        <th>Request Type</th>
                        <th>Permit Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                  </table>
                  @else
                    @empty Permit History is Empty @endempty
                  @endif
                </div>
              </div>
            </div>
          </section>
        </div>
        <?php
        $artist_number = $permit->artistpermit()->count();
        $check = $permit->artistpermit; ?>
		@include('admin.artist_permit.includes.submit-action', ['permit' => $permit])
		@include('admin.artist_permit.includes.comment-modal', ['permit' => $permit])
    @include('admin.artist_permit.includes.document')
		@include('admin.artist_permit.includes.check-existing permit')
	<div id="action-container">
			<button id="btn-action" class="btn btn-warning btn-sm btn-elevate kt-margin-l-5 kt-font-transform-u kt-bold">Take Action for application</button>
	</div>
@endsection
@section('script')
<script type="text/javascript">
  var artist = {};
  $(document).ready(function () {


    submitAction();
    artistTable();
    permitHistory();

    //UPDATE LOCK EVERY 5 SECONDS
    var lockinterval = setInterval(updateLock, 60000);

    $('button#btn-action').click(function () {
      if ('{{ $is_artist_check  }}') {
        $('#action-alert').removeClass('d-none');
      } else {
        $('#action-alert-unselected').addClass('d-none');
        $('#action-alert').addClass('d-none');
        $('#action-modal').modal('show');
      }
    });

    $('#permit-action').validate({
    // onsubmit: false,
    // debug:true,
    rules: {
      comment: {
      // required: true,
      minlength: 1,
    },
    action: {
      required: true
    }
  },
  invalidHandler: function (event, validator) {
    var errors = validator.numberOfInvalids();
    KTUtil.scrollTop();
  },

  submitHandler: function (form) {
      var rows_selected = artist.column(0).checkboxes.selected();
      rows_selected.each(function (v) {
        $(form).append($('<input >').attr('type', 'hidden').attr('name', 'artist_permit_id[]').val(v)); });
      form[0].submit();
    }
  });

  $('div.toolbar').html($('#action-container'));

     $('input[name=bypass_payment][type=checkbox]').prop('checked', false);

  });

  function permitHistory() {
    $('table#table-permit-history').DataTable({
      ajax: {
        url: '{{ route('admin.artist_permit.history', $permit->permit_id) }}'
      },
      columnDefs: [
      {targets: [5, 6], className: 'no-wrap'}
      ],
      columns: [
         {data: 'applied_date'},
         {data: 'issued_date'},
         {data: 'expired_date'},
         {data: 'expired_date'},
         {
            render: function (row, type, full, meta) {
               return full.request_type + ' Application';
            }
         },
         {data: 'permit_status'},
         {data: 'action'}
      ]
   });
  }

  function artistTable() {
     artist = $('table#artist-table').DataTable({
        dom: '<"toolbar pull-left">frt<"pull-left"i>p',
        ajax: {
           url: '{{ route('admin.artist_permit.applicationdetails.datatable', $permit->permit_id) }}'
        },
        columnDefs: [
           {targets: [0, 2, 5, 6], className: 'no-wrap'}
        ],
        columns: [
           {data: 'person_code'},
           {
              render: function (type, data, full, meta) {
                 var url = '{{ url('/permit/artist') }}/' + full.artist_id;
                 return '<a class="underlined kt-font-dark kt-font-bold" href="' + url + '">' + full.fullname + '</a>';
              }
           },
           {
              render: function (type, data, full, meta) {
                 return '<span title="" data-original-title="Tooltip title" data-placement="top" data-container="body" data-toggle="kt-tooltip" >' + full.age + '</span>';
              }
           },
           {data: 'profession'},
           {data: 'nationality'},
           {data: 'artist_status'},
           {data: 'action'},
        ],
        createdRow: function (row, data, index) {
           $('td input[type=checkbox]', row).click(function (e) {
              e.stopPropagation();
           });
           $('.btn-document', row).click(function(e){
            e.stopPropagation();
              documents(data);
              $('#document-modal').modal('show');
           });

           $('.btn-comment-modal', row).click(function (e) {
              e.stopPropagation();
              viewComment(data);
              $('#comment-modal').modal('show');
           });

           $(row).click(function () {
              var url = '{{ url('/artist_permit') }}/' + data.permit_id + '/application/' + data.artist_permit_id;
              if (!data.existing_permit) {
                 location.href = url;
              } else {
								 $('#existing-permit-alert').removeClass('d-none').find('.alert-text').html(data.existing_permit);
								 $('#check-existing-permit-modal').find('a').attr('href', url);
								 existingPermit(data);
                 $('#check-existing-permit-modal').modal('show');
              }
           });
        },
        initComplete: function (settings, json) {
           $('#artist-total').html(json.recordsTotal);
        }
     });
  }

  function existingPermit(data) {
     $('form#frm-existing-permit').find('a[href]').attr('href', '{{ url('/artist_permit/') }}/'+data.permit_id+'/application/'+data.artist_permit_id);
     $('form#frm-existing-permit').validate({
        rules: {
           comment: {
              required: true,
              minlength: 1,
              maxlength: 255
           }
        }
     });
     
     $.ajax({
				url: '{{ url('/artist_permit/') }}/'+data.permit_id+'/application/'+data.artist_permit_id+'/checklist',
				data: $('form#frm-existing-permit').serialize(),
				type: 'post',
				dataType: 'json'
		 }).done(function (response) {
				if(response){
				   artist.ajax().reload();
				}
     });
     
  }

  function submitAction() {
     $('select[name=action]').change(function () {
        if ($(this).val() == 'need approval') {
           $('#approver').removeClass('d-none');
           $('#chk-inspector').removeAttr('disabled', true).attr('checked', true);
           $('#-chk-manager').removeAttr('disabled', true).removeAttr('checked', true);
        } else {
           $('#approver').addClass('d-none');
           $('#chk-inspector').attr('disabled', true).attr('checked', true);
           $('#-chk-manager').attr('disabled', true).removeAttr('checked', true);
        }
     });
  }

  function documents(data){
      $('#document-modal').on('shown.bs.modal', function(){
          $('table#table-document').DataTable({
              ajax:{ 
                  url: '{{ url('/artist_permit') }}/'+'{{ $permit->permit_id }}'+'/application/'+data.artist_permit_id+'/documentDatatable',
              },
              columnDefs:[
              {targets: [1, 2], className: 'no-wrap'}
              ],
              columns:[
              {data: 'document_name'},
              {data: 'issued_date'},
              {data: 'expired_date'},
              ]
          });
      });
  }

  function viewComment(data) {
     $('#comment-modal').on('shown.bs.modal', function () {

        $('button[type=reset]').trigger('click');
        $('table#table-comment').DataTable({
           ajax: {
              url: '{{ url('/artist_permit') }}/'+{{$permit->permit_id}}+'/application/'+data.artist_permit_id + '/comment/datatable'
           },
           columnDefs: [
              {targets: [1, 2], className: 'no-wrap'}
           ],
           columns: [
              {data: 'comment'},
              {data: 'commented_by'},
              {data: 'commented_on'}
           ]
        });
     });
  }

  function updateLock(){
      $.ajax({
         url: '{{ route('artist_permit.lock', $permit->permit_id) }}',
         type: 'post',
         success: function(){
            console.log('test lock');
         }
      });
  }
</script>
@endsection
