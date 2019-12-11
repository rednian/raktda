<div class="modal fade" id="active-artist-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				 <form class="kt-form kt-form--fit kt-form--label-right" id="artist_form">
						<div class="modal-header">
							 <h5 class="modal-title kt-font-dark" id="exampleModalLabel">{{__('Artist Action')}}</h5>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 </button>
						</div>
						<div class="modal-body">
                            <div class="col">
                               <table class="table table-borderless" id="checked_list"  style="padding: 5px">

                               </table>
                            </div>
							 <section class="kt-section kt-padding-10">
									<div class="kt-section__desc">
										 @csrf
										 <div class="form-group">
												<label>{{__('Remarks')}} <span class="text-danger">*</span></label>
												<textarea id="comment" name="comment" rows="4" class="form-control-sm form-control" placeholder="Reason for blocking/unblocking the artist.."></textarea>
										 </div>
                                        <div id="ajax-alert" style="display: none">{{__('Artist Blocked')}}</div>
									</div>
							 </section>
						</div>
						<div class="modal-footer">
                            <input type="submit" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u " id="block_artist" value="Submit">
							 <button type="reset" class="btn btn-sm btn-secondary kt-font-bold kt-font-transform-u">{{__('Clear')}}</button>
							 <button type="button" class="btn btn-secondary btn-sm kt-pull-right" data-dismiss="modal">{{__('Close')}}</button>
						</div>
				 </form>
			</div>
	 </div>
</div>
