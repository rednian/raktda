{{--<h6 class="kt-font-dark kt-margin-b-10 kt-font-transform-u">Filter Data</h6>--}}
<div class="alert alert-outline-danger d-none" role="alert" id="active-artist-alert">
	 <div class="alert-icon"><i class="flaticon-warning"></i></div>
	 <div class="alert-text">Please check atleast one checkbox
			<input type="checkbox" disabled checked>
			to take action.
	 </div>
</div>
<table class="table  table-hover  table-borderless table-striped" id="active-artist">
	 <thead class="thead-dark">
	 <tr>
			<th></th>
			<th>Person Code</th>
			<th>Artist Name</th>
			<th>Profession</th>
			<th>Nationality</th>
			<th>Mobile Number</th>
			<th>Active Permit</th>
	 </tr>
	 </thead>
</table>
@include('admin.artist_permit.includes.active-artist-modal')
<?php
$professions = App\Profession::whereHas('artistpermit', function($q){
	$q->whereHas('permit', function($q){
		$q->where('permit_status', '!=', 'draft');
	});
})->get();
?>

<?php
$countries = \App\Country::has('artist')->get();
?>
<div id="active-profession-container">
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
</div>
<div id="active-nationality-container">
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
</div>
