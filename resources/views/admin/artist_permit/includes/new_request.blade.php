<section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
	 <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
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

<table class="table table-hover table-borderless table-striped border" id="artist-permit">
	<thead>
	 <tr>
	 	<th>REFERENCE NO.</th>
		<th>ESTABLISHMENT NAME</th>
		<th>
			NO. OF ARTIST
			<span data-content="The number of artist that already checked"
				  data-original-title="" data-container="body" data-toggle="kt-popover"
				  data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
			</span>
		</th>
		<th>APPLIED DATE</th>
		<th>REQUEST TYPE</th>
		<th>PERMIT STATUS</th>
	 </tr>
	 </thead>
</table>