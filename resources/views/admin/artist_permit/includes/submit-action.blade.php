<div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<form method="post" class="kt-form kt-form--fit kt-form--label-right" id="permit-action"
						action="{{ route('admin.artist_permit.submit', $permit->permit_id) }}">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">{{ __('Permit Action') }}</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<section class="kt-section kt-padding-10">
						<div class="kt-section__desc">
							@csrf
							 <?php
							 $all_artist = $permit->artistpermit()->count();
							 $disaaproved_artist = $permit->artistpermit()->where('artist_permit_status', 'approved')->count();
							 ?>
							<div class="form-group form-group-xs row">
								<label class="col-sm-2 col-form-label">{{ __('Action') }} <span class="text-danger">*</span></label>
								<div class="col-sm-8">
									<select name="action" class="form-control-sm form-control custom-select">
										@if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists())
										<option disabled selected>{{ __('-Select Action-') }}</option>
										 @if($all_artist == $disaaproved_artist ){
													<option value="approved-unpaid">{{ __('Approve Application and notify client for payment') }}</option>
										 @endif

										<option value="send_back">{{ __('Bounce back to client for modification') }}</option>
										<option value="need approval">{{ __('Need Approval') }}</option>
										<option value="rejected">{{ __('Reject Application') }}</option>
										@else
										<option disabled selected>{{ __('-Select Action-') }}</option>
										<option value="approved">{{ __('Approved') }}</option>
										<option value="rejected">{{ __('Rejected') }}</option>
										@endif
									</select>
								</div>
							</div>
							<div class="form-group form-group-xs row d-none" id="approver">
								<label class="col-sm-2 col-form-label">{{ __('Approvers') }} <span class="text-danger">*</span></label>
								<div class="col-sm-8">
									<div class="kt-checkbox-inline">
										<label class="kt-checkbox">
											<input required disabled id="chk-inspector" checked type="checkbox" name="role[]"
														 value="{{ $roles->where('NameEn','inspector')->first()->role_id }}"> {{ __('Inspector') }}
											<span></span>
										</label>
										<label class="kt-checkbox">
											<input required disabled id="-chk-manager" type="checkbox" name="role[]" value="{{ $roles->where('NameEn','manager')->first()->role_id }}">
											{{ __('Manager') }}
											<span></span>
										</label>
										{{-- <label class="kt-checkbox">
											<input disabled id="chk-government" type="checkbox" name="role[]" value="{{ $roles->where('NameEn','government')->first()->role_id }}">
											Government
											<span></span>
										</label> --}}
									</div>
								</div>
							</div>
							<div class="form-group form-group-xs row kt-hide" id="selectDepartment">
	  							 <label class="col-sm-2 col-form-label">{{ __('Government Entities') }} <span class="text-danger">*</span></label>
								<div class="col-sm-8">
									<select disabled required id="select-department" name="department[]" multiple="multiple" id="" class="form-control">
										@if(App\Government::has('getUsers')->count() > 0)
										@foreach(App\Government::has('getUsers')->get() as $gov)
										<option value="{{ $gov->government_id }}">{{ Auth::user()->LanguageId == 1 ? ucwords($gov->government_name_en) : $gov->government_name_ar }}</option>
										@endforeach
										@endif
		  							 </select>
								</div>
	  						</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">{{ __('Remarks') }} <span class="text-danger">*</span></label>
								<div class="col-sm-8">
									<textarea required name="comment" rows="4" class="form-control-sm form-control"></textarea>
								</div>
							</div>
							@if(Auth::user()->roles()->whereIn('roles.role_id', [5])->exists())
							<div class="form-group row">
								<label class="col-sm-2 col-form-label"></label>
								<div class="col-sm-8">
									<label class="kt-checkbox kt-checkbox--default kt-font-dark">
										<input name="bypass_payment" value="1" type="checkbox"> {{ __('Bypass the payment') }}
										<span></span>
									</label>
								</div>
							</div>
							@endif
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u ">{{ __('Submit') }}</button>
					<button type="reset" class="btn btn-sm btn-secondary kt-font-bold kt-font-transform-u">{{ __('Clear') }}</button>
					<button type="button" class="btn btn-secondary btn-sm kt-pull-right" data-dismiss="modal">{{ __('Close') }}</button>
				</div>
			</form>
		</div>
	</div>
</div>