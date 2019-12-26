@extends('layouts.admin.admin-app')
@section('content')
	 <div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Artist Permit') }}</h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ URL::signedRoute('admin.artist_permit.index') }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
							 <i class="la la-arrow-left"></i>
							 {{ __('Back') }}
						</a>
            @if(!Auth::user()->roles()->whereIn('roles.role_id', [4,5,6])->exists())
						<div class="dropdown dropdown-inline">
							 <button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="flaticon-more"></i>
							 </button>
							 <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
									<a class="dropdown-item kt-font-trasnform-u" href="{{ URL::signedRoute('admin.company.show', $permit->owner->company->company_id) }}">
                  {{ __('Establishment Details') }}
                </a>
							 </div>
						</div>
            @endif
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-5">
        @if ($permit->event()->count() > 0)
        <a href="{{ URL::signedRoute('admin.event.show', $permit->event->event_id) }}">
          <div class="alert alert-outline-danger alert-bold kt-margin-t-10 kt-margin-b-10" role="alert">
            <div class="alert-text">{{ __('This permit is connected to') }} <span class="text-success kt-font-bold kt-font-transform-u">{{ $permit->event->name_en }}</span> {{ __('event with reference number') }} <span class="kt-font-danger">{{ $permit->event->reference_number }}</span>
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
										 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">{{ __('Basic Information') }}</h6>
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
                    <h6 class="kt-font-dark kt-font-transform-u">{{ __('Checked History') }}</h6>
                  </div>
                </div>
                <div id="collapseThree5" class="collapse show" aria-labelledby="headingThree5" data-parent="#accordionExample5">
                  <div class="card-body">
                    <table class=" border table-striped table table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>{{ __('CHECKED BY') }}</th>
                          <th>{{ __('REMARKS') }}</th>
                          <th>{{ __('USER ROLE') }}</th>
                          <th>{{ __('CHECKED DATE') }}</th>
                          <th>{{ __('ACTION TAKEN') }}</th>
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
                            <td>{{ $comment->role_id != 6 ? ucfirst($comment->role->NameEn) : (Auth::user()->LanguageId == 1 ? ucwords($comment->government->government_name_en) : $comment->government->government_name_ar) }}</td>
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
										 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">{{ __('Artist List') }}</h6>
									</div>
							 </div>
							 <div id="accordion-permit-artist-collapse-one" class="collapse show" aria-labelledby="accordion-permit-artist-heading-one"
										data-parent="#accordion-permit-artist">
									<div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
                    <?php  $is_artist_check = $permit->artistpermit()->where('artist_permit_status', 'unchecked')->exists(); ?>
                    <div id="action-alert" class="alert d-none alert-outline-danger fade show" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning"></i></div>
                      <div class="alert-text">
                          {{ __('Please check each artist with the action status of unchecked before taking action!') }}
                      </div>
                    </div>
                    <div id="action-alert-unselected" class="alert d-none alert-outline-danger fade show" role="alert">
                      <div class="alert-icon"><i class="flaticon-warning"></i></div>
                      <div class="alert-text">{{ __('Please check atleast one checkbox to take action.') }}</div>
                      <div class="alert-close"></div>
                    </div>
                    <table class="table table-hover table-borderless table-striped border table-sm" id="artist-table">
                      <thead>
                        <tr>
													 <th>{{ __('PERSON CODE') }}</th>
													 <th>{{ __('ARTIST NAME') }}</th>
													 <th>{{ __('AGE') }}</th>
													 <th>{{ __('PROFESSION') }}</th>
													 <th>{{ __('NATIONALITY') }}</th>
													 <th>{{ __('STATUS') }}</th>
													 <th>{{ __('ACTION') }}</th>
												</tr>
												</thead>
										 </table>
									</div>
							 </div>
						</div>
				 </section>
         @if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists())
				 <section class="accordion accordion-solid accordion-toggle-plus kt-margin-t-15" id="accordion-permit-history">
          <div class="card">
            <div class="card-header" id="accordion-permit-history-heading-one">
              <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#accordion-permit-history-collapse-one"
											 aria-expanded="true" aria-controls="accordion-permit-history-collapse-one">
                       <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">{{ __('PERMIT HISTORY') }}</h6>
                       <span class="kt-badge kt-badge--outline kt-badge--info">{{$rivision}}</span>
              </div>
            </div>
            <div id="accordion-permit-history-collapse-one" class="collapse show" aria-labelledby="accordion-permit-history-heading-one"
										data-parent="#accordion-permit-history">
                <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
                  <table class="table table-striped table-borderless table-hover" id="table-permit-history">
                    <thead>
                      <tr>
                        <th>{{ __('RIVISION NO.') }}</th>
                        <th>{{ __('REFERENCE NO.') }}</th>
                        <th>{{ __('PERMIT NO.') }}</th>
                        <th>{{ __('NO. OF ARTIST') }}</th>
                        <th>{{ __('PERMIT DURATION') }}</th>
                        <th>{{ __('PERMIT START DATE') }}</th>
                        <th>{{ __('PERMIT END DATE') }}</th>
                        <th>{{ __('REQUEST TYPE') }}</th>
                        <th>{{ __('STATUS') }}</th>
                      </tr>
                    </thead>
                  </table>
             
                </div>
              </div>
            </div>
          </section>
          @endif
        </div>
        <?php
        $artist_number = $permit->artistpermit()->count();
        $check = $permit->artistpermit; ?>
		@include('admin.artist_permit.includes.submit-action', ['permit' => $permit])
		@include('admin.artist_permit.includes.comment-modal', ['permit' => $permit])
    @include('admin.artist_permit.includes.document')
		@include('admin.artist_permit.includes.check-existing permit')
	<div id="action-container">
			<button id="btn-action" class="btn btn-warning btn-sm btn-elevate kt-margin-l-5 kt-font-transform-u kt-bold">{{ __('Take Action For Application') }}</button>
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

      $('#chk-government').on('change', function(){
          if(this.checked) {
              $('#selectDepartment').removeClass('kt-hide');
              $('#selectDepartment #select-department').removeAttr('disabled', true);
          }else{
              $('#selectDepartment').addClass('kt-hide');
              $('#selectDepartment #select-department').attr('disabled', true);
              $('#selectDepartment #select-department').val('').trigger('change');
          }
      });

      var depselect = $('select#select-department');
      depselect.select2({
           minimumResultsForSearch: 'Infinity',
           maximumSelectionLength: 2,
           placeholder: 'Select Government Department',
           autoWidth: true,
           width: '100%',
           allowClear: true,
           tags: true
      });

  });

  function permitHistory() {
    $('table#table-permit-history').DataTable({
      ajax: {
        url: '{{ route('admin.artist_permit.history', $permit->permit_id) }}'
      },
      columnDefs: [
      {targets: '_all', className: 'no-wrap'}
      ],
      responsive: true,
      columns: [
         {data: 'rivision_number'},
         {data: 'reference_number'},
         {data: 'permit_number'},
         {data: 'artist_number'},
         {data: 'duration'},
         {data: 'issued_date'},
         {data: 'expired_date'},
         {data: 'request_type'},
         {data: 'permit_status'}
      ],
      createdRow: function(row, data, index){
        $('td:not(:first-child)', row).click(function(){location.href = data.link;});
      }
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
                 return '<a class="underlined kt-font-dark kt-font-bold" href="' + full.artist_link + '">' + full.fullname + '</a>';
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
                 location.href = data.show_link;
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
           $('#chk-government').removeAttr('disabled', true).removeAttr('checked', true);
        } else {
           $('#approver').addClass('d-none');
           $('#chk-inspector').attr('disabled', true).attr('checked', true);
           $('#-chk-manager').attr('disabled', true).removeAttr('checked', true);
           $('#chk-government').attr('disabled', true).removeAttr('checked', true);
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
