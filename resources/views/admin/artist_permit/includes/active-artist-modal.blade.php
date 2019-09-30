<div class="modal fade" id="active-artist-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				 <form method="post" class="kt-form kt-form--fit kt-form--label-right" id="artist-action">
						<div class="modal-header">
							 <h5 class="modal-title kt-font-dark" id="exampleModalLabel">Artist Action</h5>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 </button>
						</div>
						<div class="modal-body">
							 <section class="kt-section kt-padding-10">
									<div class="kt-section__desc">
										 @csrf
										 <div class="form-group">
												<label>Remarks <span class="text-danger">*</span></label>
												<textarea name="comment" rows="4" class="form-control-sm form-control" placeholder="Reason for blocking/unblocking the artist.."></textarea>
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