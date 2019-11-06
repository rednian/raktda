
<section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
	 <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> {{ __('Filter By:') }}</label>
	 <select onchange="artistPermit.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="new-request-type">
			<option value="new">New</option>
			<option value="renew">Renew</option>
			<option value="amend">Amend</option>
	 </select>
	 <label for="inlineFormInputName2" class="kt-margin-5"></label>
	 <select onchange="artistPermit.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="new-permit-status">
			<option value="new">New</option>
			<option value="modified">Modified Permit by Client</option>
			<option value="unprocessed">Unprocessed</option>
	 </select>
	 <label for="inlineFormInputName2"></label>
	 {{-- <input type="text" id="new-applied-date" data-tab="new" class="form-control mb-2 mr-sm-2 kt-margin-l-15 kt-margin-t-5" placeholder="Start Date" autocomplete="off"> --}}
</section>


<section class="form-row">
	<div class="col-1">
		<div>
			<select name="length_change" id="new-length-change" class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
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
				  			<input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="APPLIED DATE" id="new-applied-date" >
				  			<span class="kt-input-icon__icon kt-input-icon__icon--right">
				  				<span><i class="la la-calendar"></i></span>
				  			</span>
				  		</div>
				</div>
			</div>
			<div class="col-3">
				<select name="" id="new-request-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="ArtistPermit.new.table.draw()" >
					<option selected disabled >REQUEST TYPE</option>
					<option value="new">New Application</option>
					<option value="amend">Amend Application</option>
					<option value="renew">Renew Application</option>
				</select>
			</div>
			<div class="col-3">
				<select  name="" id="new-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="ArtistPermit.new.table.draw()">
					<option disabled selected>PERMIT STATUS</option>
					<option value="new">New</option>
					<option value="modified">Amend</option>
				</select>
			</div>
			<div class="col-1">
				<button type="button" class="btn btn-sm btn-secondary" id="new-btn-reset">RESET</button>
			</div>
		</section>
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
<table class="table table-hover table-borderless table-striped border" id="artist-permit">
	<thead>
	 <tr>
	 	<th>{{ __('REFERENCE NO.') }}</th>
		<th>{{ __('ESTABLISHMENT NAME') }}</th>
		<th>
			{{ __('NO. OF ARTIST') }}
			<span data-content="The number of artist that already checked"
				  data-original-title="" data-container="body" data-toggle="kt-popover"
				  data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
			</span>
		</th>
		<th>{{ __('APPLIED DATE') }}</th>
		<th>{{ __('REQUEST TYPE') }}</th>
		<th>{{ __('PERMIT STATUS') }}</th>
	 </tr>
	 </thead>
</table>