<section class="form-row">
	<div class="col-8">
		<section class="form-row">
			<div class="col-4">
				  <div class="input-group input-group-sm">
				  		<div class="kt-input-icon kt-input-icon--right">
				  			<input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="APPLIED DATE" id="archive-applied-date" >
				  			<span class="kt-input-icon__icon kt-input-icon__icon--right">
				  				<span><i class="la la-calendar"></i></span>
				  			</span>
				  		</div>
				</div>
			</div>
			<div class="col-3">
				<select name="" id="archive-request-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="ArtistPermit.new.table.draw()" >
					<option selected disabled >{{__('REQUEST TYPE')}}</option>
					<option value="new">{{__('New Application')}}</option>
					<option value="amend">{{__('Amend Application')}}</option>
					<option value="renew">{{__('Renew Application')}}</option>
				</select>
			</div>
			<div class="col-3">
				<select  name="" id="archive-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="ArtistPermit.archive.table.draw()">
					<option disabled selected>{{__('PERMIT STATUS')}}</option>
					<option value="new">{{__('New')}}</option>
					<option value="modified">{{__('Amend')}}</option>
				</select>
			</div>
			<div class="col-1">
				<button type="button" class="btn btn-sm btn-secondary" id="archive-btn-reset">{{__('RESET')}}</button>
			</div>
		</section>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-sm">
			<div class="kt-input-icon kt-input-icon--right">
				<input type="search" class="form-control form-control-sm" placeholder="Search..." id="search-archive-request">
				<span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="la la-search"></i></span>
				</span>
			</div>
		</div>
	</div>
</section>

<table class="table  table-hover  table-borderless table-striped border" id="block-artist">
	 <thead>
	 <tr>
			<th></th>
			<th>{{ __('PERSON CODE') }}</th>
			<th>{{ __('ARTIST NAME') }}</th>
			<th>{{ __('PROFESSION') }}</th>
			<th>{{ __('NATIONALITY') }}</th>
			<th>{{ __('MOBILE NUMBER') }}</th>
			<th>{{ __('ACTIVE PERMIT') }}</th>
	 </tr>
	 </thead>
</table>

@include('admin.artist_permit.includes.artist-block-modal')

