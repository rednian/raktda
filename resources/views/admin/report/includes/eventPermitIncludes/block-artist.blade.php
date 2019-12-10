<section class="form-row">
	<div class="col-1">
		<div>
			<select name="length_change" id="archive-length-change" class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
			    <option value='10'>10</option>
			    <option value='25'>25</option>
			    <option value='50'>50</option>
			    <option value='75'>75</option>
			    <option value='100'>100</option>
			</select>
		</div>
	</div>
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
					<option selected disabled >REQUEST TYPE</option>
					<option value="new">New Application</option>
					<option value="amend">Amend Application</option>
					<option value="renew">Renew Application</option>
				</select>
			</div>
			<div class="col-3">
				<select  name="" id="archive-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="ArtistPermit.archive.table.draw()">
					<option disabled selected>PERMIT STATUS</option>
					<option value="new">New</option>
					<option value="modified">Amend</option>
				</select>
			</div>
			<div class="col-1">
				<button type="button" class="btn btn-sm btn-secondary" id="archive-btn-reset">RESET</button>
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

