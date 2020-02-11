{{--<h6 class="kt-font-dark kt-margin-b-10 kt-font-transform-u">Filter Data</h6>--}}
<div class="alert alert-outline-danger d-none" role="alert" id="active-artist-alert">
	 <div class="alert-icon"><i class="flaticon-warning"></i></div>
	 <div class="alert-text">Please check atleast one checkbox
			<input type="checkbox" disabled checked>
			to take action.
	 </div>
</div>
<section class="form-row">
	<div class="col-1">
		<div>
			<select name="length_change" id="artist-length-change" class="form-control-sm form-control custom-select custom-select-sm">
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
				<button type="button" id="btn-active-action" class="btn btn-warning btn-sm kt-font-transform-u">Take Action</button>
			</div> --}}
			<div class="col-3">
				<select name="profession_id" id="artist-profession" class="form-control-sm form-control custom-select custom-select-sm " onchange="active_artist_table.draw()" >
					<option selected disabled >{{ __('PROFESSION') }}</option>
					@if ($professions->count() > 0)
						@foreach ($professions as $profession)
							<option value="{{ $profession->profession_id }}">{{ Auth::user()->LanguageId == 1 ? ucwords($profession->name_en) : $profession->name_ar }}</option>
						@endforeach
					@endif
				</select>
			</div>
			<div class="col-3">
				<select  name="" id="artist-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="active_artist_table.draw()">
					<option disabled selected>{{ __('STATUS') }}</option>
					<option value="active">{{ __('Active Artists') }}</option>
					<option value="blocked">{{ __('Blocked Artists') }}</option>
				</select>
			</div>
			<div class="col-2">
				<button type="button" class="btn btn-sm btn-secondary" id="artist-btn-reset">{{ __('RESET') }}</button>
			</div>
		</form>
	</div>
	<div class="col-md-3">
		<div class="form-group form-group-sm">
			<div class="kt-input-icon kt-input-icon--right">
				<input type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-artist-request">
				<span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="la la-search"></i></span>
				</span>
			</div>
		</div>
	</div>
</section>
<table class="table table-hover table-borderless table-striped border table-sm" id="active-artist">
	 <thead>
	 <tr>
			{{-- <th></th> --}}
			<th>{{ __('ACTIVE PERMITS') }}</th>
			<th>{{ __('PERSON CODE') }}</th>
			<th>{{ __('ARTIST NAME') }}</th>
			<th>{{ __('PROFESSION') }}</th>
			<th>{{ __('NATIONALITY') }}</th>
			<th>{{ __('MOBILE NUMBER') }}</th>
			<th>{{ __('STATUS') }}</th>
			<th>{{ __('AGE') }}</th>
			<th>{{ __('BIRTHDATE') }}</th>
	 </tr>
	 </thead>
</table>
@include('admin.artist_permit.includes.active-artist-modal')
<?php

$professions = App\ArtistPermit::whereHas('artist', function($q){
	$q->where('artist_status', 'active');
})
->groupBy('profession_id')->get();

$countries = \App\Countries::whereHas('artistpermit.artist', function($q){
	$q->where('artist_status', 'active');
})->get();
?>
{{-- <div id="active-profession-container">
	 <section class="form-group form-group-xs row" style="margin-left:1px">
			<div class="col-sm-12">
				 <select class="form-control select2 form-control-sm" name="profession_id" onchange="$('table#active-artist').DataTable().draw()">
						<option value="">-All Profession-</option>
						@if(!empty($professions))
							 @foreach($professions as $profession)
									<option value="{{$profession->profession_id}}">{{ ucwords($profession->name_en) }}</option>
							 @endforeach
						@endif
				 </select>
			</div>
	 </section>
</div> --}}
{{-- <div id="active-nationality-container">
	 <div class="form-group form-group-xs row" style="margin-left: 1px">
			<div class="col-sm-12">
				 <select class="form-control select2 form-control-sm" name="country_id" onchange="$('table#active-artist').DataTable().draw()">
						<option value="">-All Nationality -</option>
						@if(!empty($countries))
							 @foreach($countries as $country)
									<option value="{{ $country->country_id }}">{{ ucwords($country->nationality_en) }}</option>
							 @endforeach
						@endif
				 </select>
			</div>

	 </div>
</div> --}}
