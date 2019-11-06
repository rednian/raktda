<section class="form-row">
	<div class="col-1">
		<div>
			<select name="length_change" id="active-length-change" class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
			    <option value='10'>10</option>
			    <option value='25'>25</option>
			    <option value='50'>50</option>
			    <option value='75'>75</option>
			    <option value='100'>100</option>
			</select>
		</div>
	</div>
	<div class="col-8">
		<form class="form-row">
			<div class="col-4">
				  <div class="input-group input-group-sm">
				  		<div class="kt-input-icon kt-input-icon--right">
				  			<input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="APPLIED DATE" id="active-applied-date" >
				  			<span class="kt-input-icon__icon kt-input-icon__icon--right">
				  				<span><i class="la la-calendar"></i></span>
				  			</span>
				  		</div>
				</div>
			</div>
			<div class="col-3">
				<select name="" id="active-request-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="ArtistPermit.new.table.draw()" >
					<option selected disabled >REQUEST TYPE</option>
					<option value="new">New Application</option>
					<option value="amend">Amend Application</option>
					<option value="renew">Renew Application</option>
				</select>
			</div>
			<div class="col-3">
				<select  name="" id="active-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="ArtistPermit.active.table.draw()">
					<option disabled selected>PERMIT STATUS</option>
					<option value="new">New</option>
					<option value="modified">Amend</option>
				</select>
			</div>
			<div class="col-1">
				<button type="button" class="btn btn-sm btn-secondary" id="new-btn-reset">RESET</button>
			</div>
		</form>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-sm">
			<div class="kt-input-icon kt-input-icon--right">
				<input type="search" class="form-control form-control-sm" placeholder="Search..." id="search-new-request">
				<span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="la la-search"></i></span>
				</span>
			</div>
		</div>
	</div>
</section>
<table class="table  table-hover  table-borderless table-striped table-sm border" id="artist-permit-approved">
	 <thead>
	 <tr>
			<th>{{ __('REFERENCE NO.') }}</th>
			<th>{{ __('PERMIT NUMBER') }}</th>
			<th>{{ __('ESTABLISHMENT NAME') }}</th>
			<th>{{ __('APPLIED DATE') }}</th>
			<th>{{ __('NO. OF ARTIST') }}
				 <span data-content="The number of artist that already checked"
							 data-original-title="" data-container="body" data-toggle="kt-popover"
							 data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
							</span>
			</th>
			<th>{{ __('REQUEST TYPE') }}</th>
			<th>{{ __('ACTION') }}</th>
	 </tr>
	 </thead>
</table>