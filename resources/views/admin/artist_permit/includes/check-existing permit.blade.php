<div class="modal fade" id="check-existing-permit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				 
				 <form method="post" class="kt-form kt-form--fit kt-form--label-right" id="frm-existing-permit">
						<div class="modal-header">
							 <h5 class="modal-title" id="exampleModalLabel">Existing Permit</h5>
							 	<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							 <section class="kt-section kt-padding-10">
									<div class="kt-section__desc">
										 <div id="existing-permit-alert" class="alert alert-outline-danger d-none" role="alert">
												<div class="alert-icon"><i class="flaticon-warning"></i></div>
												<div class="alert-text kt-font-dark"></div>
										 </div>
										 <div class="form-group">
												<label>Remarks <span class="text-danger">*</span></label>
												<textarea name="comment" rows="5" class="form-control-sm form-control" placeholder="Remarks for Client..."></textarea>
												<input type="hidden" name="artist_permit_status" value="disapproved">
										 </div>
									</div>
									<div class="form-group row">
										 <div class="col-sm-12">
												<button type="submit" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u ">Disapprove Artist</button>
												<button type="reset" class="btn btn-sm btn-secondary kt-font-bold kt-font-transform-u">Clear</button>
												<a href="javascript:void(0)" class="btn btn-sm btn-elevate btn-maroon kt-font-transform-u kt-pull-right kt-margin-l-5">Continue Checking <i class="la la-arrow-right"></i></a>
												<button type="button" class="btn btn-secondary btn-sm kt-pull-right" data-dismiss="modal">Close</button>
										 </div>
									</div>
							 </section>
						</div>
				 </form>
			</div>
	 </div>
</div>