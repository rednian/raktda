<section class="form-row">
	<div class="col-1">
		<div>
			<select name="length_change" id="active-length-change" class="form-control-sm form-control custom-select custom-select-sm">
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
			{{-- <div class="col-4">
				  <div class="input-group input-group-sm">
				  		<div class="kt-input-icon kt-input-icon--right">
				  			<input autocomplete="off" type="text" class="form-control form-control-sm" placeholder="{{ __('APPLIED DATE') }}" id="active-applied-date" >
				  			<span class="kt-input-icon__icon kt-input-icon__icon--right">
				  				<span><i class="la la-calendar"></i></span>
				  			</span>
				  		</div>
				</div>
			</div> --}}
			{{-- <div class="col-3">
				<select name="" id="active-request-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="activePermit.draw()" >
					<option selected disabled >{{ __('REQUEST TYPE') }}</option>
					<option value="new">{{ __('New Application') }}</option>
					<option value="amend">{{ __('Amend Application') }}</option>
					<option value="renew">{{ __('Renew Application') }}</option>
				</select>
			</div> --}}
			<div class="col-3">
				<select  name="" id="active-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="activePermit.draw()">
					<option disabled selected>{{ __('PERMIT STATUS') }}</option>
					<option value="new">{{ __('New') }}</option>
					<option value="modified">{{ __('Amend') }}</option>
				</select>
			</div>
			<div class="col-2">
				<button type="button" class="btn btn-sm btn-secondary" id="active-btn-reset">{{ __('RESET') }}</button>
			</div>
		</form>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-sm">
			<div class="kt-input-icon kt-input-icon--right">
				<input type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-active-request">
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
			<th></th>
			<th>{{ __('ACTION') }}</th>
			<th>{{ __('REFERENCE NO.') }}</th>
			<th>{{ __('PERMIT NO.') }}</th>
			<th>{{ __('ESTABLISHMENT NAME') }}</th>
			<th>{{ __('APPROVED DATE') }}</th>
			<th>{{ __('DURATION') }}</th>
			<th>{{ __('NO. OF ARTIST') }}
				 <span data-content="The number of artist that already checked"
							 data-original-title="" data-container="body" data-toggle="kt-popover"
							 data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
							</span>
			</th>
			<th>{{ __('REQUEST TYPE') }}</th>
			<th>{{ __('WORK LOCATION') }}</th>
	 	</tr>
	</thead>
</table>
