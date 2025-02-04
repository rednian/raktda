<section class="form-row">
	<div class="col-1">
		<div>
			<select name="length_change" id="new-length-change"
				class="form-control-sm form-control custom-select custom-select-sm" aria-controls="artist-permit">
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
						<input autocomplete="off" type="text" class="form-control form-control-sm"
							aria-label="Text input with checkbox" placeholder="{{ __('SUBMITTED DATE') }}"
							id="new-applied-date">
						<span class="kt-input-icon__icon kt-input-icon__icon--right">
							<span><i class="la la-calendar"></i></span>
						</span>
					</div>
				</div>
			</div>
			{{-- <div class="col-3">
				<select name="" id="new-permit-term"
					class="form-control-sm form-control custom-select custom-select-sm " onchange="artistPermit.draw()">
					<option selected disabled>{{ __('PERMIT TERM') }}</option>
					<option value="short">{{ __('Short Term') }} (Less than 30 Days Permit)</option>
					<option value="long">{{ __('Long Term') }} (More than 30 Days Permit)</option>
				</select>
			</div> --}}
			{{-- <div class="col-3">
				<select  name="" id="new-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="artistPermit.draw()">
					<option disabled selected>PERMIT STATUS</option>
					<option value="new">New</option>
					<option value="modified">Amend</option>
				</select>
			</div> --}}
			<div class="col-5">
				<button type="button" class="btn btn-sm btn-secondary" id="new-btn-reset">{{ __('RESET') }}</button>
			</div>
		</form>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-sm">
			<div class="kt-input-icon kt-input-icon--right">
				<input type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..."
					id="search-new-request">
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
{{--			<th></th>--}}
			<th>{{ __('REFERENCE NO.') }}</th>
			<th>{{ __('ESTABLISHMENT NAME') }}</th>
			<th>
				{{ __('NO. OF ARTIST') }}
			</th>
			<th>{{ __('SUBMITTED DATE') }}</th>
			<th>{{ __('PERMIT DURATION') }}</th>
			<th>{{ __('REQUEST TYPE') }}</th>
			<th>{{ __('WORK LOCATION') }}</th>
			<th>{{ __('CONNECTED TO AN EVENT') }}</th>
			<th>{{ __('EVENT NAME') }}</th>
			<th>{{ __('PERMIT REVISION') }}</th>
		</tr>
	</thead>
</table>
