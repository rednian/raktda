
<section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
	<?php
	$countries = \App\Country::has('artist')->get();
	$professions = App\Profession::whereHas('artistpermit', function($q){
		$q->whereHas('permit', function($q){
			$q->where('permit_status', '!=', 'draft');
		})
		->whereHas('artist',  function($q){
			$q->where('artist_status', 'blocked');
		});
	})
	->get();
	?>
	 <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
	 <select onchange="artistPermit.draw();" class="select2 mb-2 mr-sm-2 kt-margin-l-15">
	 	<option>-All Profession-</option>
	 	@if(!empty($professions))
	 		 @foreach($professions as $profession)
	 				<option value="{{$profession->profession_id}}">{{ ucwords($profession->name_en) }}</option>
	 		 @endforeach
	 	@endif
	 </select>
	 <label for="inlineFormInputName2" class="kt-margin-5"></label>
	 <select onchange="artistPermit.draw();" class="select2 mb-2 mr-sm-2 kt-margin-l-15">
	 	<option selected>-Select Nationality -</option>
	 	@if(!empty($countries))
	 		@foreach($countries as $country)
	 			<option value="{{ $country->country_id }}">{{ ucwords($country->nationality_en) }}</option>
	 		@endforeach
	 	@endif
	 </select>
</section>
<table class="table  table-hover  table-borderless table-striped" id="block-artist">
	 <thead class="thead-dark">
	 <tr>
			<th></th>
			<th>Person Code</th>
			<th>Artist Name</th>
			<th>Profession</th>
			<th>Nationality</th>
			<th>Mobile Number</th>
			<th>Active Permit</th>
			<th>Artist Status</th>
	 </tr>
	 </thead>
</table>

@include('admin.artist_permit.includes.artist-block-modal')

