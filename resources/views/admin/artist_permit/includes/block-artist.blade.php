<h6 class="kt-font-dark kt-margin-b-10 kt-font-transform-u">Filter Data</h6>
<form class="kt-form kt-form--fit kt-margin-b-20 border kt-padding-20" method="get">
	 <section class="row form-group form-group-sm">
			<div class="col-sm-8">
				 <section class="row">
						<div class="col-sm-4">
							 <label>Profession</label>
					<?php
					$professions = App\Profession::whereHas('artistpermit', function($q){
						$q->whereHas('permit', function($q){
							$q->where('permit_status', '!=', 'draft');
						});
					})->get();
					?>
							 <select class="form-control custom-select" name="profession_id">
									<option>-All Profession-</option>
									@if(!empty($professions))
										 @foreach($professions as $profession)
												<option value="{{$profession->profession_id}}">{{ ucwords($profession->name_en) }}</option>
										 @endforeach
									@endif
							 </select>
						</div>
						<div class="col-sm-4">
							 <label>Nationality</label>
					<?php
					$countries = \App\Country::has('artist')->get();
					?>
							 <select class="form-control custom-select" name="nationality">
									<option selected>-Select Nationality -</option>
									@if(!empty($countries))
										 @foreach($countries as $country)
												<option value="{{ $country->country_id }}">{{ ucwords($country->nationality_en) }}</option>
										 @endforeach
									@endif
							 </select>
						</div>
						<div class="col-sm-4">
							 <label>Artist Status</label>
							 <select class="form-control custom-select" name="artist_status">
									<option selected>-Select Artist Status -</option>
									<option value="active">Active</option>
									<option value="block">Block</option>
							 </select>
						</div>
				 </section>
			</div>
	 </section>
	 <div class="kt-separator kt-separator--sm kt-separator--dashed kt-margin-t-10 kt-margin-b-10"></div>
	 <div class="row">
			<div class="col-lg-6">
				 <button type="submit" class="btn btn-warning btn-sm btn-elevate kt-font-transform-u" id="kt_search">Apply Filter</button>
				 <button type="reset" class="btn btn-secondary btn-sm btn-elevate kt-font-bold kt-font-transform-u" id="kt_reset">Clear Filter</button>
			</div>
	 </div>
</form>
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
