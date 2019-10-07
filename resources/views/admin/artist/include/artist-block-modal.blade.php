<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				 	<?php $artist = $artist_permit->artist; ?>
				 <form action="{{ route('admin.artist.update_status', $artist->artist_id) }}" id="frm-update-status" method="post">
						<div class="modal-header">
							 <h5 class="modal-title" id="exampleModalLabel">@if($artist->artist_status == 'active') <span class="text-danger kt-font-transform-u"><span
												 class="fa fa-user-slash"></span> Block</span>  @else
										 <span class="text-success"><span class="fa fa-user-check"></span>Unblocked  </span> @endif {{ ucwords($artist_permit->artist->fullname) }}
									Status
							 </h5>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 </button>
						</div>
						<div class="modal-body">
							 @csrf
							 <section class="form-group">
									<input type="hidden" value="0" name="is_multiple">
									<label for="">Remarks <span class="text-danger">*</span></label>
									<textarea name="remarks" class="form-control-sm form-control" rows="6" required></textarea>
							 </section>
						</div>
						<div class="modal-footer">
							 @if($artist->artist_status == 'active')
									<button type="submit" name="status" value="block" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u btn-wide">Block Artist</button>
							 @else
									<button type="submit"  name="status" value="unblock" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u btn-wide">Unblock Artist</button>
							 @endif
							 <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
						</div>
				 </form>
			</div>
	 </div>
</div>
