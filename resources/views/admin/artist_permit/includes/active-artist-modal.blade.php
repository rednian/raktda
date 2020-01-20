<div class="modal fade" id="active-artist-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				 <form class="kt-form kt-form--fit kt-form--label-right" id="artist_form">
						<div class="modal-header">
							 <h5 class="modal-title kt-font-dark kt-font-transform-u" id="exampleModalLabel">{{__('Active Permit List')}} - <span id="artist-name"></span></h5>
							 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							 </button>
						</div>
						<div class="modal-body">
							<table class="table  table-hover  table-borderless table-striped table-sm border" id="active-permit">
								 <thead>
								 <tr>
										<th></th>
										<th>{{ __('REFERENCE NO.') }}</th>
										<th>{{ __('PERMIT NO.') }}</th>
										<th>{{ __('ESTABLISHMENT NAME') }}</th>
										<th>{{ __('PERMIT DURATION') }}</th>
										<th>{{ __('START DATE') }}</th>
										<th>{{ __('EXPIRY DATE') }}</th>
										<th>{{ __('REQUEST TYPE') }}</th>
										<th>{{ __('WORK LOCATION') }}</th>
								 	</tr>
								</thead>
							</table>
						</div>
						<div class="modal-footer">
							 <button type="button" class="btn btn-secondary btn-sm kt-pull-right" data-dismiss="modal">Close</button>
						</div>
				 </form>
			</div>
	 </div>
</div>
