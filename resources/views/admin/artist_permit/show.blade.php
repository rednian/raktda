@extends('layouts.admin.admin-app')
@section('content')
	 <div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">Artist Permit Details</h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ route('admin.artist_permit.index') }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
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
						@if ($permit->approver->count() > 0)
							 <div class="card">
									<div class="card-header" id="headingThree5">
										 <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse"
													data-target="#collapseThree5" aria-expanded="true" aria-controls="collapseThree5">
												<h6 class="kt-font-dark kt-font-transform-u">Approvers</h6>
										 </div>
									</div>
									<div id="collapseThree5" class="collapse show" aria-labelledby="headingThree5" data-parent="#accordionExample5">
										 <div class="card-body">
												<table class="table-striped table table-borderless table-hover">
													 <thead class="thead-dark">
													 <tr>
															<th class="no-wrap">User Role</th>
															<th class="no-wrap">Checked By</th>
															<th>Notes</th>
															<th class="no-wrap">Checked Date</th>
															<th class="no-wrap">Action Taken</th>
													 </tr>
													 </thead>
													 <tbody>
													 @foreach ($permit->approver as $approver)
															<tr>
																 <td class="no-wrap">{{ ucwords($approver->role->NameEn) }}</td>
																 <td class="no-wrap">{{ ucwords($approver->user->employee->emp_name) }}</td>
																 <td>
																 
																 </td>
																 <td class="no-wrap">{{ $approver->created_at->format('d-M-Y h:m a') }}</td>
																 <td class="no-wrap">{!! permitStatus($approver->status) !!}</td>
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
										 <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">Artist History</h6>
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
										 <table class="table table-hover table-borderless table-striped table-sm" id="artist-table">
												<thead class="thead-dark">
												<tr>
													 <th>Person Code</th>
													 <th>Artist Name</th>
													 <th>Age</th>
													 <th>Profession</th>
													 <th>Nationality</th>
													 <th>
															Action Status
															<span data-content="Click the artist name to view the artist information and permit history."
																		data-original-title="" data-container="body" data-toggle="kt-popover"
																		data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
															</span>
													 </th>
													 <th>Action</th>
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
													 <thead class="thead-dark">
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
												 @empty
														Permit History is Empty
												 @endempty
										 @endif
									</div>
							 </div>
						</div>
				 </section>
			</div>
		<?php
		$artist_number = $permit->artistpermit()->count();
		$check = $permit->artistpermit;
		?>
			@include('admin.artist_permit.includes.comment-modal', ['permit' => $permit])
			@include('admin.artist_permit.includes.check-existing permit')
{{--			<div id="action-container">--}}
{{--				 <button id="btn-action" class="btn btn-warning btn-sm btn-elevate kt-margin-l-5 kt-font-transform-u kt-bold">Take Action for application</button>--}}
{{--			</div>--}}
			@endsection
			@section('script')
				 <script type="text/javascript">
            var artist = {};
            $(document).ready(function () {
               submitAction();
               artistTable();
               existingPermit();
               permitHistory();

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
                        minlength: 1
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
                        $(form).append($('<input >').attr('type', 'hidden').attr('name', 'artist_permit_id[]').val(v));
                     });
                     form[0].submit();
                  }
               });
							 
               $('div.toolbar').html($('#action-container'));

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
                     {
                        render: function (type, data, full, meta) {
                           return '<button class="btn btn-secondary btn-sm btn-elevate btn-comment-modal">View Comment</button>';
                        }
                     }
                  ],
                  createdRow: function (row, data, index) {
                     $('td input[type=checkbox]', row).click(function (e) {
                        e.stopPropagation();
                     });
                     $('.btn-comment-modal', row).click(function (e) {
                        e.stopPropagation();
                        viewComment(data);
                        $('#comment-modal').modal('show');
                     });

                   
                  },
                  initComplete: function (settings, json) {
                     $('#artist-total').html(json.recordsTotal);
                  }
               });
            }

            function existingPermit() {
               $('form#frm-existing-permit').validate({
                  rules: {
                     comment: {
                        required: true,
                        minlength: 1,
                        maxlength: 255
                     }
                  }
               });
            }

            function submitAction() {
               $('select[name=action]').change(function () {
                  if ($(this).val() == 'approval') {
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

            function viewComment(data) {
               $('#comment-modal').on('shown.bs.modal', function () {

                  $('button[type=reset]').trigger('click');
                  $('table#table-comment').DataTable({
                     ajax: {
                        url: '{{ url('/arist_permit') }}/'+{{$permit->permit_id}}+'/application/'+data.artist_permit_id + '/comment/datatable'
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
				 </script>
@endsection
