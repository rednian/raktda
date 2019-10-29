<div class="modal fade" id="action-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<form method="post" class="kt-form kt-form--fit kt-form--label-right" id="permit-action"
						action="{{ route('admin.artist_permit.submit', $permit->permit_id) }}">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Permit Action</h5>
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
								<label class="col-sm-2 col-form-label">Action <span class="text-danger">*</span></label>
								<div class="col-sm-8">
									<select name="action" class="form-control-sm form-control custom-select">
										<option disabled selected>-Select Action-</option>
										 @if($all_artist == $disaaproved_artist ){
													<option value="approved-unpaid">Approve Application & Notify client for payment</option>
										 @endif
										<option value="send_back">Send back to client for modification of one or more artist information</option>
										<option value="need approval">Need higher Approval</option>
										<option value="rejected">Reject Application & Notify client</option>
									</select>
								</div>
							</div>
							<div class="form-group form-group-xs row d-none" id="approver">
								<label class="col-sm-2 col-form-label">Approvers <span class="text-danger">*</span></label>
								<div class="col-sm-8">
									<div class="kt-checkbox-inline">
										<label class="kt-checkbox">
											<input disabled id="chk-inspector" checked type="checkbox" name="role[]"
														 value="{{ $roles->where('NameEn','inspector')->first()->role_id }}"> Inspector
											<span></span>
										</label>
										<label class="kt-checkbox">
											<input disabled id="-chk-manager" type="checkbox" name="role[]" value="{{ $roles->where('NameEn','manager')->first()->role_id }}">
											Manager
											<span></span>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-sm-2 col-form-label">Notes</label>
								<div class="col-sm-8">
									<textarea name="comment" rows="4" class="form-control-sm form-control"></textarea>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u ">Submit</button>
					<button type="reset" class="btn btn-sm btn-secondary kt-font-bold kt-font-transform-u">Clear</button>
					<button type="button" class="btn btn-secondary btn-sm kt-pull-right" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>