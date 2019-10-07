<ul class="nav nav-pills" role="tablist">
	 <li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#kt_tabs_3_1">Event Type</a>
	 </li>
	 <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#kt_tabs_3_2">Event Type Requirements</a>
	 </li>
	 <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#kt_tabs_3_3">Settings</a>
	 </li>
</ul>
<div class="tab-content">
	 <div class="tab-pane active" id="kt_tabs_3_1" role="tabpanel">
			<section class="row">
				 <div class="col-12">
						<a href="{{ route('admin.setting.event.create') }}"  class="btn btn-sm btn-warning btn-elevate kt-font-transform-u kt-pull-right kt-margin-b-10">New Event Type</a>
				 </div>
			</section>
			<table class="table table-borderless table-light--dark table-striped table-hover" id="event-type-table">
				 <thead>
				 <tr>
						<th>Event Type Name</th>
						<th>Description</th>
						<th>Event Type Fee</th>
						<th>Added By</th>
						<th>Added On</th>
						<th>Actions</th>
				 </tr>
				 </thead>
			</table>
	 </div>
	 <div class="tab-pane" id="kt_tabs_3_2" role="tabpanel">
{{--			<a href="#" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u kt-pull-right kt-margin-b-10"></span> New--}}
{{--				 Event Requirement</a>--}}
			<table class="table  table-striped table-hover table-borderless" id="event-requirement-table">
				 <thead>
				 <tr>
						<th>Requirement Name</th>
						<th>Description</th>
						<th>Event Type</th>
						<th>Date Required</th>
						<th>Action</th>
				 </tr>
				 </thead>
			</table>
	 </div>
	 <div class="tab-pane" id="kt_tabs_3_3" role="tabpanel">
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged
	 </div>
	 <div class="tab-pane" id="kt_tabs_3_4" role="tabpanel">
			Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
	 </div>
</div>