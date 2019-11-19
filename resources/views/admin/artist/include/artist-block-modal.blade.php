<div class="modal fade" id="kt_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				 	<?php $artist = $artist_permit->artist; ?>
				 <form  method="post" action="{{ route('admin.artist.update_status', $artist->artist_id) }}" id="frm-update-status">
						<div class="modal-header">
							 <h5 class="modal-title" id="exampleModalLabel">@if($artist->artist_status == 'active') <span class="text-danger kt-font-transform-u"><span
												 class="fa fa-user-slash"></span> {{ __('Block') }}</span>  @else
										 <span class="text-success"><span class="fa fa-user-check"></span> {{ __('Unblock') }}  </span> @endif
							 </h5>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 </button>
						</div>
						<div class="modal-body">
							 @csrf
							 <section class="form-group">
									<input type="hidden" value="0" name="is_multiple">
									<label for="">{{ __('Remarks') }} <span class="text-danger">*</span></label>
									<textarea name="remarks" class="form-control-sm form-control" rows="6" required></textarea>
							 </section>
						</div>

						<div class="modal-footer">
							 @if($artist->artist_status == 'active')
									<button type="submit" name="status" value="block" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u btn-wide">{{ __('Block Artist') }}</button>
							 @else
									<button type="submit"  name="status" value="unblock" class="btn btn-sm btn-elevate btn-warning kt-font-transform-u btn-wide">{{ __('Unblock Artist') }}</button>
							 @endif
							 <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
						</div>
				 </form>
			</div>
	 </div>
</div>
