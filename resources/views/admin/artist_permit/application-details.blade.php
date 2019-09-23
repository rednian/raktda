@extends('layouts.admin.admin-app')
@section('content')
	<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border" >
		<div class="kt-portlet__head kt-portlet__head--sm">
			<div class="kt-portlet__head-label">
				<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">Artist Permit Details</h3>
			</div>
			<div class="kt-portlet__head-toolbar">
				<a href="{{ route('admin.artist_permit.index') }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u"><i
						class="la la-arrow-left"></i> Back to permit list</a>
				<div class="dropdown dropdown-inline">
					<button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true"
									aria-expanded="false">
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
													<td class="text-danger kt-font-bolder">{{ $permit->reference_number }}</td>
												</tr>
												<tr>
													<td>Request Type:</td>
													<td>{{ ucfirst($permit->request_type) }} Application</td>
												</tr>
												<tr>
													<td>Permit Status :</td>
													<td>
														<?php
														$status = $permit->permit_status;
														$class_name = 'warning';
														if (strtolower($permit->permit_status) == 'new') {
															$class_name = 'success';
														}
														if (strtolower($permit->permit_status) == 'processing' || strtolower($permit->permit_status) == 'modification request') {

															$class_name = 'warning';
														}
														if (strtolower($permit->permit_status) == 'pending from client') {
															$class_name = 'info';
														}
														if (strtolower($permit->permit_status) == 'new-update from client') {
															$class_name = 'info';
														}
														if (strtolower($permit->permit_status) == 'unprocessed') {
															$class_name = 'danger';
														}
														if(strtolower($permit->permit_status) == 'modification request'){
															$status = 'need modification';
														}
														?>
														<span
															class="kt-badge kt-badge--inline kt-badge--{{$class_name}}">{{ ucwords($status) }}</span>
													</td>
												</tr>
												@if ($permit->number)
													<tr>
														<td>Permit Number :</td>
														<td>{{ $permit->permit_number ? $permit->permit_number : null   }}</td>
													</tr>
												@endif
												<tr>
													<td width="35%">Submitted Date:</td>
													<td>
                            <span class="kt-font-transform-u">
                              {{ $permit->created_at ? $permit->created_at->format('d-M-Y') : null   }}
                            </span>
													</td>
												</tr>
												<tr>
													<td>Permit Start :</td>
													<td>
                            <span class="kt-font-transform-u">
                              {{ $permit->issued_date ? $permit->issued_date->format('d-M-Y') : null }}
                            </span>
													</td>
												</tr>
												<tr>
													<td>Work Location :</td>
													<td>{{ ucwords($permit->work_location) }}</td>
												</tr>
												<tr>
													<td>Number of Artist :</td>
													<td>{{ $permit->artistpermit()->count() }}</td>
												</tr>
												@if ($permit->artist->where('artist_status', 'block')->count() > 0)
													<tr>
														<td>Block Artist :</td>
														<td>{{ $permit->artist->where('artist_status', 'block')->count() }}</td>
													</tr>
												@endif

												{{-- <tr>
													<td>Permit Revision :</td>
													<td>{{ $permit->artist->where('artist_status', 'block')->count() }}</td>
												</tr> --}}
											</table>
										</div>
									</section>
								</div>
								<div class="col-6">
									<section class="kt-section border kt-padding-10 kt-margin-b-20">
										<div class="kt-section__desc">
											<h6 class="kt-font-dark kt-font-bold kt-margin-b-10">Company Information</h6>
											<table class="table table-borderless table-sm">
												<tr>
													<td width="36%">Company Name :</td>
													<td class="text-danger kt-font-bolder">{{ ucwords($permit->company->company_name) }}</td>
												</tr>
												<tr>
													<td>Trade License Number :</td>
													<td>{{ $permit->company->company_trade_license }}</td>
												</tr>
												<tr>
													<td>Company Status :</td>

													<td>
														@if($permit->company->company_status == 'active')
															<span class="kt-badge kt-badge--success kt-badge--inline">{{ ucfirst($permit->company->company_status) }}</span>
															@endif
															@if($permit->company->company_status == 'block')
																<span class="kt-badge kt-badge--danger kt-badge--inline">{{ ucfirst($permit->company->company_status) }}</span>
															@endif
												</td>
												</tr>
											</table>
											<h6 class="kt-font-dark kt-font-bold kt-margin-b-10 kt-margin-t-20">Company Contact information</h6>
											<table class="table table-borderless table-sm">
												<tr>
													<td width="36%"> Contact Person :</td>
													<td class=" kt-font-bolder ">{{ ucwords($permit->company->contact_person) }}</td>
												</tr>
												<tr>
													<td> Mobile Number :</td>
													<td>{{ $permit->company->company_mobile_number }}</td>
												</tr>
												<tr>
													<td> Phone Number :</td>
													<td>{{ $permit->company->company_phone_number }}</td>
												</tr>
												<tr>
													<td>Company Email :</td>
													<td>{{ $permit->company->company_email }}</td>
												</tr>
											</table>
										</div>
									</section>
								</div>
							</section>
							<section class="row kt-margin-b-10">
								<div class="col">

								</div>
							</section>
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

								<table class="table-striped table table-borderless">
									<thead class="thead-dark">
									<tr>
										<th class="no-wrap">User Role</th>
										<th class="no-wrap">Checked By</th>
										<th >Notes</th>
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
												{{ $approver->noteComment }}
											</td>
											<td class="no-wrap">{{ $approver->created_at->format('d-M-Y h:m a') }}</td>
											<td class="no-wrap">
												@if ($approver->status == 'approved')
													<span class="kt-badge kt-badge--success kt-badge--inline">{{ ucwords($approver->status) }}</span>
												@endif
												@if ($approver->status == 'request for modification ')
													<span class="kt-badge kt-badge--warning kt-badge--inline">{{ ucwords($approver->status) }}</span>
												@endif
													@if ($approver->status == 'rejected')
														<span class="kt-badge kt-badge--danger kt-badge--inline">{{ ucwords($approver->status) }}</span>
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
						<div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5 " data-toggle="collapse" data-target="#collapseTwo5"
								 aria-expanded="true" aria-controls="collapseTwo5">
							<h6 class="kt-font-dark kt-font-transform-u">Artist List</h6>
						</div>
					</div>
					<div id="collapseTwo5" class="collapse show" aria-labelledby="headingTwo5" data-parent="#accordionExample5" style="">
						<div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10">
							<?php  $is_artist_check = $permit->artistpermit()->where('artist_permit_status', 'unchecked')->exists(); ?>
							<div id="action-alert" class="alert d-none alert-outline-danger fade show" role="alert">
								<div class="alert-icon"><i class="flaticon-warning"></i></div>
								<div class="alert-text">Please check each artist with the action status of
									<span class="kt-badge kt-badge--warning kt-badge--inline">Unchecked</span>
									before taking action!
								</div>
								{{--<div class="alert-close">--}}
									{{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
										{{--<span aria-hidden="true"><i class="la la-close"></i></span>--}}
									{{--</button>--}}
								{{--</div>--}}
							</div>

							<div id="action-alert-unselected" class="alert d-none alert-outline-danger fade show" role="alert">
								<div class="alert-icon"><i class="flaticon-warning"></i></div>
								<div class="alert-text">Please check atleast one artist before taking action!</div>
								<div class="alert-close">
									{{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
										{{--<span aria-hidden="true"><i class="la la-close"></i></span>--}}
									{{--</button>--}}
								</div>
							</div>

							<table class="table table-hover table-borderless table-striped table-sm" id="artist-table">
								<thead class="thead-dark">
								<tr>
									{{--<th></th>--}}
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
			</div>
		</div>
		<?php
		$artist_number = $permit->artistpermit()->count();
		$check = $permit->artistpermit;
		//  dd($check);
		?>
		@include('admin.artist_permit.includes.submit-action', ['permit' => $permit])
		@include('admin.artist_permit.includes.comment-modal', ['permit' => $permit])
		{{--@if($type == 'new')--}}
			<div id="action-container">
				<button id="btn-action" class="btn btn-warning btn-sm btn-elevate kt-margin-l-5 kt-font-transform-u kt-bold">
					Take Action for application
				</button>
			</div>
		{{--@endif--}}
		@endsection
		@section('script')
			<script type="text/javascript">
				var artist = {};
				$(document).ready(function () {
					submitAction();



					artist = $('table#artist-table').DataTable({
						dom: '<"toolbar pull-left">frt<"pull-left"i>p',
						ajax: {
							url: '{{ route('admin.artist_permit.applicationdetails.datatable', $permit->permit_id) }}'
						},
						columnDefs: [
							{targets: [0,2, 5, 6], className: 'no-wrap'},
							// {
							// 	targets: 0,
							// 	searchable: false,
							// 	orderable: false,
							// 	// 'render': function(data, type, row, meta){
							// 	// 	if(type === 'display'){
							// 	// 		var html = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default dt-checkboxes">';
							// 	// 		    html += '<input type="checkbox" class="dt-checkboxes">';
							// 	// 		    html += '<span></span>';
							// 	// 		    html += '</label>';
							// 	// 	}
							// 	// 	return html;
							// 	// },
							// 	checkboxes: {
							// 		'selectRow': true,
							// 		selectAllRender: '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default dt-checkboxes"><input type="checkbox"><span></span></label>'
							// 	}
							// }
						],
						// select: {
						// 	style: 'multi',
						// 	selector: 'td:first-child'
						// },
						// order: [[1, 'asc']],
						columns: [
							// {data: 'artist_permit_id'},
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
							{data: 'country'},
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

								$('td:not(:first-child)', row).click(function () {
									location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application/' + data.artist_permit_id;
								});


						},
						initComplete: function (settings, json) {
							$('#artist-total').html(json.recordsTotal);
						}
					});


					$('button#btn-action').click(function () {
						// var rows_selected = artist.column(0).checkboxes.selected();
						// $('#number-selected').html(rows_selected.length);
						if ('{{ $is_artist_check  }}') {
							$('#action-alert').removeClass('d-none');
						}
						// else if(rows_selected.length == 0){
						// $('#action-alert-unselected').removeClass('d-none');
						// }
						else {
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
								$(form).append($('<input >').attr('type', 'hidden').attr('name', 'artist_permit_id[]').val(v));
							});
							form[0].submit();
						}
					});


					$('div.toolbar').html($('#action-container'));

				});

				function  submitAction() {
					$('select[name=action]').change(function(){
						if($(this).val() == 'approval'){
							$('#approver').removeClass('d-none');
							$('#chk-inspector').removeAttr('disabled', true).attr('checked',true);
							$('#-chk-manager').removeAttr('disabled', true).removeAttr('checked', true);
						}
						else{
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
