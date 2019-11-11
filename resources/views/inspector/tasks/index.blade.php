@extends('layouts.inspector.layout')
@section('style')
<style>

</style>
@stop
@section('content')
	<section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
		<div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
			 <div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('TASKS') }}</h3>
			 </div>
		</div>
		<div class="kt-portlet__body kt-padding-t-0">
			 <ul id="main-tab" class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
					<li class="nav-item">
						 <a class="nav-link active" data-toggle="tab" href="#artist_permit" role="tab">{{ __('Artist Permit') }}</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" data-toggle="tab" href="#event_permit" role="tab">{{ __('Event Permit') }}</a>
					</li>
					<li class="nav-item">
						 <a class="nav-link" data-toggle="tab" href="#classification" role="tab">{{ __('Classification') }}</a>
					</li>
			 </ul>
			 <div class="tab-content">
					<div class="tab-pane active" id="artist_permit" role="tabpanel">
						<table class="table  table-hover  table-borderless table-striped border" id="artist-permit-approved">
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
					</div>
					<div class="tab-pane" id="event_permit" role="tabpanel">
						<section class="row">
							 <div class="col-12">
									<a href="{{ route('requirements.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">New Requirement</a>
							 </div>
						</section>
						<table class="table table-borderless table-striped table-hover border table-sm" id="tblRequirement">
							 <thead>
							 <tr>
									<th>REQUIREMENT</th>
									<th>DESCRIPTION</th>
									<th>VALIDITY (months)</th>
									<th>PERMIT TERM</th>
									<th>DATE REQUIRED</th>
									<th>STATUS</th>
									<th>ACTIONS</th>
							 </tr>
							 </thead>
						</table>
					</div>
					<div class="tab-pane" id="classification" role="tabpanel">
						 <section class="row">
							 <div class="col-12">
									<a href="{{ route('event_type.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">New Event Type</a>
							 </div>
						</section>
						<table class="table table-borderless table-striped table-hover border table-sm" id="tblEventTypes">
							 <thead>
							 <tr>
									<th>EVENT TYPE</th>
									<th>DESCRIPTION</th>
									<th>EVENT TYPE FEE</th>
									<th>ACTIONS</th>
							 </tr>
							 </thead>
						</table>
					</div>
					{{-- <div class="tab-pane" id="event_requirements" role="tabpanel">
						 
					</div> --}}
			 </div>
		</div>
	</section>
@endsection
@section('script')
<script type="text/javascript">
    
</script>
@endsection
