@extends('layouts.admin.admin-app')
@section('style')
	<link href="{{ asset('/assets/css/wizard-3.css') }}" rel="stylesheet" type="text/css"/>
	
	{{-- <style>
		@if($artist_permit->artist_permit_status == 'approved' && Auth::user()->)
		.input-group-append{
			display:none;
		}
		@endif
	</style> --}}
	
@endsection
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile border" id="app-wizard">
	<div class="kt-portlet__head kt-portlet__head--sm">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ strtoupper($artist_permit->artist->fullName) }}</span></h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<a href="{{ route('admin.artist_permit.applicationdetails', $permit->permit_id) }}" class="btn btn-sm btn-maroon btn-elevate kt-margin-r-4 kt-font-transform-u">
				<i class="la la-arrow-left"></i>
				Back to permit details
			</a>
			<div class="dropdown dropdown-inline">
				<button type="button" class="btn btn-elevate btn-icon btn-sm btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="flaticon-more"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
					<a class="dropdown-item kt-font-transform-u" href="{{ route('admin.artist_permit.index') }}">Artist Permit list</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item kt-font-transform-u" href="{{ route('admin.artist.show', $artist_permit->artist_id) }}">Artist Information</a>
					<a class="dropdown-item kt-font-transform-u" href="javascript:void(0)">Company Information</a>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body kt-padding-t-5">
		<div class="kt-grid kt-wizard-v3 kt-wizard-v3--white" id="kt_wizard_v3" data-ktwizard-state="first">
			<div class="kt-grid__item">
				<div class="kt-wizard-v3__nav">
					<div class="kt-wizard-v3__nav-items">
						<a class="kt-wizard-v3__nav-item" href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="current">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>1</span>Artist Information</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
						<a class="kt-wizard-v3__nav-item" href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>2</span>Uploaded Documents</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
						<a class="kt-wizard-v3__nav-item" href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>3</span>Submit</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
				<form class="kt-form" id="kt_form" novalidate="novalidate" action="{{ route('admin.artist_permit.checklist', [
					'permit'=>$permit->permit_id,
					'artistpermit'=>$artist_permit->artist_permit_id
					]) }}" method="post">
					@csrf
					<div class="kt-wizard-v3__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
						<div class="kt-form__section kt-form__section--first">
							<div class="kt-wizard-v3__form">
								<section class="row">
									<div class="col kt-margin-t-20 kt-margin-b-20">
										@include('admin.artist_permit.includes.notification')
										@include('admin.artist_permit.includes.comment')
										@include('admin.artist_permit.includes.personal-info-tab')	
										@include('admin.artist_permit.includes.address-info-tab')
										@include('admin.artist_permit.includes.address1-info-tab')
									</div>
								</section>
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 1-->
						<!--begin: Form Wizard Step 2-->
						<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v3__form">
									<section class="row">
										<div class="col kt-margin-t-20 kt-margin-b-20">
											@include('admin.artist_permit.includes.notification')
											@include('admin.artist_permit.includes.comment')
											<?php
											$nearly_expire = $artist_permit->artistPermitDocument()->whereDate('expired_date', '<', Carbon\Carbon::now()->addMonth())->get();
//											dd($nearly_expire);
											?>
											{{--@if ($nearly_expire->count() > 0	)--}}
												{{--<div class="alert alert-outline-danger fade show" role="alert">--}}
													{{--<div class="alert-icon"><i class="flaticon-warning"></i></div>--}}
													{{--<div class="alert-text">--}}
														{{--<div>The Following documents either about to expire or already expired.</div>--}}
														{{--<ol>--}}
															{{--@foreach ($nearly_expire as $document)--}}
																{{--<li>{{ ucfirst($document->document_name) }}</li>--}}
															{{--@endforeach--}}
														{{--</ol>--}}
													{{--</div>--}}
													{{--<div class="alert-close">--}}
														{{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
															{{--<span aria-hidden="true"><i class="la la-close"></i></span>--}}
														{{--</button>--}}
													{{--</div>--}}
												{{--</div>--}}
											{{--@endif--}}
											<table class="border table table-hover table-borderless table-striped" id="document-table">
												<thead>
												<tr>
													<th>DOCUMENT NAME</th>
													<th>ISSUED DATE</th>
													<th>EXPIRED DATE</th>
													<th>ACTION</th>
												</tr>
												</thead>
											</table>
										</div>
									</section>
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 2-->
						<!--begin: Form Wizard Step 3-->
						<div class="kt-wizard-v3__content" data-ktwizard-type="step-content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v3__form">
									<section class="row">
										<div class="col kt-margin-t-20 kt-margin-b-20">
											@include('admin.artist_permit.includes.notification')
											@include('admin.artist_permit.includes.comment')
{{--											@if ($existing_permit->count() > 0)--}}
{{--												<div class="alert alert-outline-danger show" role="alert">--}}
{{--													<div class="alert-icon"><i class="flaticon-danger"></i></div>--}}
{{--													<div class="alert-text"><span class="text-danger kt-font-bold">--}}
{{--                      {{ strtoupper($artist_permit->artist->fullName) }}--}}
{{--                    </span> has <span class="text-danger kt-font-bolder">{{ $existing_permit->count() }}</span> active Permit.--}}
{{--													</div>--}}
{{--													<div class="alert-close">--}}
{{--														<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--															<span aria-hidden="true"><i class="la la-close"></i></span>--}}
{{--														</button>--}}
{{--													</div>--}}
{{--												</div>--}}
{{--												<table class="table table-hover table-striped table-borderless" id="permit-history">--}}
{{--													<thead class="thead-dark">--}}
{{--													<tr>--}}
{{--														<th>Reference No.</th>--}}
{{--														<th>Company Name</th>--}}
{{--														<th>Permit No.</th>--}}
{{--														<th>Permit Start</th>--}}
{{--														<th>Permit Expiry</th>--}}
{{--														<th>Permit Status</th>--}}
{{--													</tr>--}}
{{--													</thead>--}}
{{--												</table>--}}
{{--											@else--}}
{{--											@endif--}}
										</div>
									</section>
								</div>
							</div>
						</div>
						<!--end: Form Wizard Step 3-->
						<!--begin: Form Actions -->
						<div class="kt-form__actions">
							<button type="button" class="btn btn-elevate btn-maroon btn-sm kt-font-bold kt-font-transform-u btn-wide"
											data-ktwizard-type="action-prev">Previous
							</button>
							<button type="button" class="btn active btn-elevate btn-warning kt-font-bold  btn-sm kt-font-bold btn-wide kt-font-transform-u"
											data-ktwizard-type="action-next">Next
							</button>
							<div class="dropdown" data-ktwizard-type="action-submit">
								<button class="btn btn-warning btn-sm btn-wide kt-font-bold kt-font-transform-u dropdown-toggle" type="button"
												id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Take action & finish
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
									<button type="submit" name="artist_permit_status" value="approved" class="dropdown-item">Approve Artist</button>
									<button type="submit" name="artist_permit_status" value="disapproved" class="dropdown-item">Disapprove Artist</button>
								</div>
							</div>
						</div>
						<!--end: Form Actions -->
					</form>
					<!--end: Form Wizard Form-->
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.common.dev.js"></script>
	<script type="text/javascript">
		new Vue({
			el: '#app-wizard',
			data: {
				comment: null
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('textarea[name=comment]').keyup(function(){
				if($(this).val().length == 255){
					$('#memo-error1').removeClass('d-none');
				}
				else{
					$('#memo-error1').addClass('d-none');
				}
			});
			checkDisapprove();

			var form = $('form#kt_form');
			var wizardEl;
			var validator;
			$(document).on('change','input[type=checkbox]', function(){
				if($(this).is(':checked')){
					$(this).parents('.input-group').find('input[type=text]').addClass('is-valid').removeClass('is-invalid');
					$(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
				}
				else{
					$(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
					$(this).parents('label').removeClass('kt-checkbox--success').addClass('kt-checkbox--default');
				}
			});

			var wizard = new KTWizard("kt_wizard_v3", {startStep: 1});
			wizard.on("beforeNext", function(wizardObj) {
				{{-- @if($artist_permit->artist_permit_status != 'approved') --}}
				if(wizardObj.currentStep == 1){
					$('input[type=checkbox][data-step=step-1]').each(function () {
						if(!$(this).is(':checked')){
							$(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
							wizardObj.stop();
						}
					});
				}

				if(wizardObj.currentStep == 2){
					$('input[type=checkbox].step-2').each(function () {
						if(!$(this).is(':checked')){
							$(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--danger');
							wizardObj.stop();
						}
						else{
							$(this).parents('label').removeClass('kt-checkbox--danger').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
						}
					});

				}
				{{-- @endif --}}
			}).on("change", function(wizard) { KTUtil.scrollTop(); });
		});
	</script>
	<script>
		$(document).ready(function () {
			$('button#btn-check-existing-permit').click(function () {
				$.ajax({
					url: '{{ url('/arist_permit/') }}/'+{{ $permit->permit_id }}+'/checkactivepermit/'+{{ $artist_permit->artist_id }},
					dataType: 'json',
					beforeSend: function () {
						KTApp.blockPage({
							overlayColor: '#000',
							type: 'v2',
							state: 'success',
							size: 'lg',
							message: 'Searching for existing permit. Please wait for a few minutes...'
						});
					}
				}).done(function (response) {
					// if (response.result.count > 0) {
						// $('#active-permit-alert')
					// }
					KTApp.unblockPage();
				});

			});

			$('#document-table').DataTable({
				ajax: {
					url: '{{ url('/artist_permit') }}/'+{{ $permit->permit_id }}+'/application/'+{{ $artist_permit->artist_permit_id }}+'/documentDatatable'
				},
				columnDefs: [
					{targets: [3], className: 'no-wrap'},
					{targets: [3], className: 'no-wrap', sortable: false},
				],
				columns: [
					{data: 'document_name'},
					{data: 'issued_date'},
					{data: 'expired_date'},
					{
						render: function (row, type, full, meta) {
							var html = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">';
							html += '<input type="checkbox" class="step-2" data-step="2"  name="' + full.name + '">';
							html += '<span></span>';
							html += '</label>';
							return html;
						}
					}
				],

				createdRow: function (row, data, index) {
					$('input[type=checkbox]', row).change(function () {
						// if ($(this).is(':checked')) {
						// 	$(this).parents('tr').addClass('table-primary');
						// }
						// else {
						// 	$(this).parents('tr').removeClass('table-primary');
						// }

					});
				}
			});

			$('#permit-history').DataTable({
				ajax: {
					url: '{{ url('/permit/artist_permit') }}/'+{{ $permit->permit_id }}+'/application/'+{{ $artist_permit->artist_id }}+'/permitHistory'
				},
				columnDefs: [
					{targets: [0], className: 'no-wrap'},
					{targets: [0], className: 'no-wrap', sortable: false},
				],
				columns: [
					{data: 'reference_number'},
					{data: 'company_name'},
					{data: 'permit_number'},
					{data: 'permit_start'},
					{data: 'expiry_date'},
					{data: 'permit_status'},
				],
			});
		});

		function checkDisapprove() {
			$('button[type=submit][value=disapproved]').click(function(e){
				if($('textarea[name=comment]').val() == ''){
					e.preventDefault();
					$('textarea[name=comment]').addClass('is-invalid');
				}
				else{
					$('textarea[name=comment]').removeClass('is-invalid');
				}


			});
		}
	</script>
@endsection