@extends('layouts.admin.admin-app')
@section('style')
<link href="{{ asset('/assets/css/wizard-3.css') }}" rel="stylesheet" type="text/css"/>
<style>
	@media (min-width: 1024px) {
		#event-exist-modal .modal-lg, .modal-xl { max-width: none; }
		#event-exist-modal .modal-dialog { overflow-y: initial !important; margin: 0 0 0 1; }
		#event-exist-modal .modal-body { height: calc(100vh - 130px); overflow-y: auto; } }
</style>
@stop
@section('content')
<section id="app-wizard" class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
	<div class="kt-portlet__head kt-portlet__head--sm">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ ucwords($event->name_en) }}- application</span></h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-outline-secondary kt-margin-r-4 kt-font-transform-u">
				<i class="la la-arrow-left"></i>back to event list
			</a>
			<div class="dropdown dropdown-inline">
				<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-elevate btn-icon btn-sm btn-icon-sm">
					<i class="flaticon-more"></i>
				</button>
				<div x-placement="bottom-end" class="dropdown-menu dropdown-menu-right">
					<a href="javascript:void(0)" class="dropdown-item kt-font-transform-u">Company Information</a>
				</div>
			</div>
		</div>
	</div>
	<div class="kt-portlet__body kt-padding-t-5">
		<div id="kt_wizard_v3" data-ktwizard-state="first" class="kt-grid kt-wizard-v3 kt-wizard-v3--white">
			<div class="kt-grid__item">
				<div class="kt-wizard-v3__nav">
					<div class="kt-wizard-v3__nav-items">
						<a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="current" class="kt-wizard-v3__nav-item">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>1</span>{{ __('EVENT INFORMATION') }}</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
						<a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending" class="kt-wizard-v3__nav-item">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>2</span>{{ __('UPLOADED DOCUMENTS') }}</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
						 <a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending" class="kt-wizard-v3__nav-item">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>3</span> {{ __('EVENT APPROVER') }}</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						 </a>
					</div>
				</div>
				</div>
				<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
					<form id="kt_form" class="kt-form"  method="post" action="{{ route('admin.event.submit', $event->event_id) }}">
						@csrf
						<div data-ktwizard-type="step-content" data-ktwizard-state="current" class="kt-wizard-v3__content">
							<div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v3__form">
									<section class="row kt-margin-t-20 kt-margin-b-20">
										<div class="col">
											@include('admin.event.includes.existing-notification')
											@include('admin.event.includes.latest-comment')
					 						@include('admin.artist_permit.includes.comment')
					 						@if ($existing_event->count() > 0)
					 							<div class="alert alert-outline-danger fade show" role="alert">
					 							<div class="alert-text">
					 								<h6 class="alert-heading text-danger kt-font-transform-u">Important</h6>
													<p>The venue of this event has {{ $existing_event->count() }} active event.</p>
													<hr>
													 <button type="button" data-target="#event-exist-modal" data-toggle="modal"
														 class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">Show Event Calendar
													 </button>
													 <button type="button" class="btn btn-sm btn-secondary  kt-font-transform-u" data-dismiss="alert" aria-label="Close">Close
													 </button>
												</div>

											 </div>
					 						@endif
											 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-detail">
												<div class="card">
													<div class="card-header" id="heading-detail">
														<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-detail" aria-expanded="true" aria-controls="collapse-detail">
															<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('EVENT DETAILS') }}</h6>
														</div>
													 </div>
													 <div id="collapse-detail" class="collapse show" aria-labelledby="heading-detail" data-parent="#accordion-detail">
														<div class="card-body">
															<div class="row form-group form-group-sm">
																<div class="col-sm-6">
																	 <label class="kt-font-dark">{{ __('Event Type') }} <span class="text-danger">*</span></label>
																	  <div class="input-group input-group-sm">
																	 	<input value="{{ ucfirst($event->type->name_en) }}" name="event_type" readonly="readonly" type="text"
																	 					 class="form-control">
																	 	<div class="input-group-append">
																	 		<span class="input-group-text">
																	 			<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																	 				<input data-step="step-1" type="checkbox">
																	 				<span></span>
																	 			</label>
																	 		 </span>
																	 	</div>
																	  </div>
																</div>
																<div class="col-sm-6">
																	 <label class="kt-font-dark">{{ __('Number of food Trucks') }}</label>
																	  <div class="input-group input-group-sm">
																	 	<input value="{{ ucfirst($event->no_of_trucks) }}" name="no_of_trucks" readonly="readonly" type="text"
																	 					 class="form-control">
																	 	<div class="input-group-append">
																	 		<span class="input-group-text">
																	 			<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																	 				<input data-step="step-1" type="checkbox">
																	 				<span></span>
																	 			</label>
																	 		 </span>
																	 	</div>
																	  </div>
																</div>
															</div>
															<div class="row form-group form-group-sm">
																<div class="col-md-6">
																	<label class="kt-font-dark">{{ __('Event Name') }} <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																		<input value="{{ ucfirst($event->name_en) }}" name="name_en" readonly="readonly" type="text" class="form-control">
																		<div class="input-group-append ">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox">
																					<span></span>
																				</label>
																			</span>
																		</div>
																	</div>
																	{{-- <span class="form-text text-muted">We'll never share your email with anyone else.</span> --}}
																</div>
																<div class="col-md-6">
																	<label class="kt-font-dark">{{ __('Event Name (AR)') }} <span class="text-danger">*</span></label>
																	 <div class="input-group input-group-sm">
																		<input value="{{ ucfirst($event->name_ar) }}" name="name_ar" readonly="readonly" type="text" class="form-control">
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox">
																					<span></span>
																				</label>
																			</span>
																		</div>
																	 </div>
																</div>
															</div>
															<div class="row form-group form-group-sm">
																<div class="col-md-6">
																	 <label class="kt-font-dark">{{ __('Description') }} <span class="text-danger">*</span></label>
																	 <div class="input-group input-group-sm">
																	 	<textarea name="description_en" rowspan="3" class="form-control" readonly>{{ ucfirst($event->description_en) }}</textarea>
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox">
																					<span></span>
																				</label>
																			 </span>
																		</div>
																	 </div>
																</div>
																<div class="col-md-6">
																	 <label class="kt-font-dark">{{ __('Description (AR)') }} <span class="text-danger">*</span></label>
																	 <div class="input-group input-group-sm">
																	 	<textarea name="description_ar" rowspan="3" class="form-control" readonly>{{ ucfirst($event->description_ar) }}</textarea>
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox">
																					<span></span>
																				</label>
																			 </span>
																		</div>
																	 </div>
																</div>
															</div>
														</div>
													 </div>
												</div>
											 </section>
											 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-date">
													<div class="card">
														 <div class="card-header" id="heading-date">
																<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-date"
																		 aria-expanded="true"
																		 aria-controls="collapse-date">
																	 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('DATE DETAILS') }}</h6>
																</div>
														 </div>
														 <div id="collapse-date" class="collapse show" aria-labelledby="heading-date" data-parent="#accordion-date">
																<div class="card-body">
																	 <div class="row form-group form-group-sm">
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Date Start') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->issued_date }}" name="issued_date" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1"  type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Date End') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->expired_date }}" name="expired_date" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Time Start') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->time_start }}" name="time_start" readonly="readonly" type="text" class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Time End') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->time_end }}" name="time_end" readonly="readonly" type="text" class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																	 </div>
																</div>
														 </div>
													</div>
											 </section>
											 <section class="accordion accordion-solid accordion-toggle-plus" id="accordion-address">
													<div class="card">
														 <div class="card-header" id="heading-address">
																<div class="card-title kt-padding-b-5 kt-padding-t-10" data-toggle="collapse" data-target="#collapse-address"
																		 aria-expanded="true" aria-controls="collapse-address">
																	 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('LOCATION DETAILS') }}</h6>
																</div>
														 </div>
														 <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
																<div class="card-body">
																	 <div class="row form-group form-group-sm">
																			<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Venue') }}<span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->venue_en) }}" name="venue_en" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Venue (AR)') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->venue_ar) }}" name="venue_ar" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																	 </div>
																	 <div class="row form-group form-group-sm">
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Address') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->address) }}" name="address" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Area') }}</label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->area->area_en) }}" name="area_en" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Emirate') }}</label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->emirate->name_en) }}" name="emirates" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1" type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																			<div class="col-3">
																				 <label class="kt-font-dark">{{ __('Country') }}</label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->country->name_en) }}" name="country" readonly="readonly" type="text"
																									 class="form-control">
																						<div class="input-group-append">
																							 <span class="input-group-text">
																									<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																										 <input data-step="step-1"  type="checkbox">
																										 <span></span>
																									</label>
																							 </span>
																						</div>
																				 </div>
																			</div>
																	 </div>
																</div>
														 </div>
													</div>
											 </section>
											 <div class="accordion accordion-solid accordion-toggle-plus" id="accordion-map">
												<div class="card">
													<div class="card-header" id="heading-map">
														<div class="card-title" data-toggle="collapse" data-target="#collapse-map" aria-expanded="true" aria-controls="collapse-map">
														<h6 class="kt-font-transform-u kt-font-dark kt-font-bolder">map details</h6>
														</div>
													</div>
													<div id="collapse-map" class="collapse show" aria-labelledby="heading-map" data-parent="#accordion-map" style="">
														<div class="card-body">
															<div class="row">
																<div class="col-sm-8">
																	<label>Map Full Address <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																		<input value="{{$event->full_address}}" name="" readonly="readonly" type="text" class="form-control" > 
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox"> 
																					<span></span>
																				</label>
																			</span>
																		</div>
																	</div>
																</div>
																<div class="col-sm-2">
																	<label>Latitude <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																		<input value="{{$event->latitude}}" name="" readonly="readonly" type="text" class="form-control" > 
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox"> 
																					<span></span>
																				</label>
																			</span>
																		</div>
																	</div>
																</div>
																<div class="col-sm-2">
																	<label>Latitude <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																		<input value="{{$event->longitude}}" name="" readonly="readonly" type="text" class="form-control" > 
																		<div class="input-group-append">
																			<span class="input-group-text">
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																					<input data-step="step-1" type="checkbox"> 
																					<span></span>
																				</label>
																			</span>
																		</div>
																	</div>
																</div>
															</div>
															<section class="row">
																<div class="col">
																	<div id="kt_gmap_3" style="height:150px;"></div>
																</div>
															</section>
														</div>
													</div>
												</div>
											</div>
										</div>
									 </section>
								</div>
						 </div>
					</div>
					<div data-ktwizard-type="step-content" class="kt-wizard-v3__content">
						 <div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v3__form">
									 <section class="row">
											<div class="col kt-margin-t-20 kt-margin-b-20">
												@include('admin.event.includes.existing-notification')
												@include('admin.event.includes.latest-comment')
												 @include('admin.artist_permit.includes.comment')
												 <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
												<div class="card">
													<div class="card-header" id="headingOne6">
														<div class="card-title kt-padding-t-5 kt-padding-b-10" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
															<h6 class="kt-font-transform-u kt-font-dark">Event requirements</h6>
														</div>
													</div>
													<div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
														<div class="card-body">
															 <table class="table border borderless table-hover">
																<thead>
																	<tr>
																		 <th>#</th>
																		 <th>{{ __('DOCUMENT NAME') }}</th>
																		 <th>{{ __('ISSUED DATE') }}</th>
																		 <th>{{ __('EXPIRED DATE') }}</th>
																		 <th>{{ __('ACTION') }}</th>
																	</tr>
																</thead>
																<tbody>
																	@php
																		$requirements = App\Requirement::whereHas('events', function($q) use ($event){
																			$q->where('event.event_id', $event->event_id);
																		})->whereHas('eventRequirement', function($q){
																			$q->where('requirement_type', 'event');
																		})->get();
																	@endphp
																	<tr>
																		<td>1</td>
																		<td><a href="{{ asset('/storage/'.$event->logo_thumbnail) }}" data-fancybox data-caption="Event Logo">Event Logo</a></td>
																		<td>Not Required</td>
																		<td>Not Required</td>
																		<td>
																			<label class="kt-checkbox kt-checkbox--single kt-checkbox--default"><input type="checkbox" class="step-2" data-step="2"><span></span></label>
																		</td>
																	</tr>
																	@if ($requirements->count() > 0)
																		@foreach ($requirements as $index => $requirement)
																			<tr>
																				<td>{{ ++$index+1 }}</td>
																				<td>
																					@php
																						$name = Auth::user()->LanguageId == 1 ? ucfirst($requirement->requirement_name) : $requirement->requirement_name_ar;
																					@endphp
																					 <a href="{{ asset('/storage/'.$requirement->eventRequirement()->first()->path) }}"  data-fancybox data-caption="{{$name}}">{{$name}}</a>
																					
																				</td>
																				<td>{{ $requirement->dates_required ? $requirement->eventRequirement()->first()->issued_date->format('d-M-Y') : 'Not Required' }}</td>
																				<td>{{ $requirement->dates_required ? $requirement->eventRequirement()->first()->expired_date->format('d-M-Y') : 'Not Required' }}</td>
																				<td>
																					<label class="kt-checkbox kt-checkbox--single kt-checkbox--default"><input type="checkbox" class="step-2" data-step="2"><span></span></label>
																				</td>
																			</tr>
																		@endforeach
																	@endif
																</tbody>
															 </table>
														</div>
													</div>
												</div>
											</div>
											@if ($event->no_of_trucks > 0)
											 <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-5" id="accordion-truck">
											<div class="card">
												<div class="card-header" id="heading-truck">
													<div class="card-title kt-padding-t-5 kt-padding-b-10" data-toggle="collapse" data-target="#collapse-truck" aria-expanded="true" aria-controls="collapse-truck">
														<h6 class="kt-font-transform-u kt-font-dark">FOOD TRUCK requirements</h6>
													</div>
												</div>
												<div id="collapse-truck" class="collapse show" aria-labelledby="heading-truck" data-parent="#accordion-truck" style="">
													<div class="card-body">
														 <table class="table border borderless table-hover">
															<thead>
																<tr>
																	 <th>#</th>
																	 <th>{{ __('DOCUMENT NAME') }}</th>
																	 <th>{{ __('ISSUED DATE') }}</th>
																	 <th>{{ __('EXPIRED DATE') }}</th>
																	 <th>{{ __('ACTION') }}</th>
																</tr>
															</thead>
															<tbody>
																@php
																	$requirements = App\Requirement::whereHas('events', function($q) use ($event){
																		$q->where('event.event_id', $event->event_id);
																	})->whereHas('eventRequirement', function($q){
																		$q->where('requirement_type', 'truck');
																	})->get();
																@endphp
																
																@if ($requirements->count() > 0)
																	@foreach ($requirements as $index => $requirement)
																		<tr>
																			<td>{{ ++$index+1 }}</td>
																			<td>
																				@php
																					$name = Auth::user()->LanguageId == 1 ? ucfirst($requirement->requirement_name) : $requirement->requirement_name_ar;
																				@endphp
																				 <a href="{{ asset('/storage/'.$requirement->eventRequirement()->first()->path) }}"  data-fancybox data-caption="{{$name}}">{{$name}}</a>
																				
																			</td>
																			<td>{{ $requirement->dates_required ? $requirement->eventRequirement()->first()->issued_date->format('d-M-Y') : 'Not Required' }}</td>
																			<td>{{ $requirement->dates_required ? $requirement->eventRequirement()->first()->expired_date->format('d-M-Y') : 'Not Required' }}</td>
																			<td>
																				<label class="kt-checkbox kt-checkbox--single kt-checkbox--default"><input type="checkbox" class="step-2" data-step="2"><span></span></label>
																			</td>
																		</tr>
																	@endforeach
																@endif
															</tbody>
														 </table>
													</div>
												</div>
											</div>
										</div>
											@endif

												  

												 {{-- <table class="table border borderless table-hover" id="requirement-table">
													<thead>
														<tr>
															 <th></th>
															 <th>{{ __('TYPE') }}</th>
															 <th></th>	
															 <th>{{ __('ISSUED DATE') }}</th>
															 <th>{{ __('EXPIRED DATE') }}</th>
															 <th>{{ __('ACTION') }}</th>
														</tr>
													</thead>
												 </table> --}}
											</div>
									 </section>
								</div>
						 </div>
					</div>
					<div data-ktwizard-type="step-content" class="kt-wizard-v3__content">
						 <div class="kt-form__section kt-form__section--first">
								<div class="kt-wizard-v3__form">
									 <section class="row">
											<div class="col kt-margin-t-20 kt-margin-b-20">
												@include('admin.event.includes.existing-notification')
												@include('admin.event.includes.latest-comment')
												  @include('admin.artist_permit.includes.comment')
												   <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-action">
												  	<div class="card">
												  		<div class="card-header" id="heading-action">
												  			<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-action" aria-expanded="true" aria-controls="collapse-action">
												  				<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> Select action</h6>
												  			</div>
												  		 </div>
												  		 <div id="collapse-action" class="collapse show" aria-labelledby="heading-action" data-parent="#accordion-action">
												  			<div class="card-body">
												  				<section class="row">
												  					<div class="col-md-12">
												  						<div class="form-group row">
  																			<div class="col-12">
  																				<div class="kt-radio-inline">
  																					<label class="kt-radio kt-radion--bold kt-radio--success">
  																						<input value="approved-unpaid" type="radio" name="status"> Approve Application
  																						<span></span>
  																					</label>
  																					<label class="kt-radio kt-radion--bold kt-radio--success">
  																						<input value="need modification" type="radio" name="status"> Send Back for Amendment
  																						<span></span>
  																					</label>
  																					<label class="kt-radio kt-radion--bold kt-radio--success">
  																						<input value="need approval" type="radio" name="status"> Need Approval
  																						<span></span>
  																					</label>
  																					<label class="kt-radio kt-radion--bold kt-radio--success">
  																						<input value="rejected" type="radio" name="status"> Reject Application
  																						<span></span>
  																					</label>
  																				</div>
  																			</div>
  																		</div>
												  					</div>

												  					<div class="col-md-4">
												  						{{-- <div class="form-group form-group-sm">
												  							<label for="" class="kt-font-dark">Action <span class="text-danger">*</span></label>
												  							<select name="status" id="" class="form-control custom-select" required>
												  								 <option selected disabled>Select Action</option>
												  								 <option value="approved-unpaid">Approve Application</option>
												  								 <option value="need approval">Need Approval</option>
												  								 <option value="need modification">Send back for Amendments</option>
												  								 <option value="rejected">Reject Application</option>
												  							</select>												  	
												  						</div> --}}
												  						<div class="form-group form-group-sm kt-hide">
												  							<label for="" class="kt-font-dark">Approvers <span class="text-danger">*</span></label>
												  							<select disabled required id="select-approver" name="approver[]" multiple="multiple" id="" class="form-control">
												  										 @if($role = App\Roles::where('Type', 0)->where('NameEn', '!=', 'admin')->where('NameEn', '!=', 'admin assistant')
												  										 ->count() > 0)
												  												@foreach(App\Roles::where('Type', 0)->where('NameEn', '!=', 'admin')->where('NameEn', '!=', 'admin assistant')
												  										 ->get() as $role)
												  													 	<option value="{{ $role->role_id }}">{{ ucwords($role->NameEn) }}</option>
												  												@endforeach
												  										 @endif
												  							 </select>
												  						</div>
												  					</div>
												  				</section>
												  				<section class="row d-none" id="printed-note">
												  					<div class="col-sm-6">
												  						<div class="form-group-sm">
												  							<label>Note</label>
												  							<textarea disabled name="note_en" rowspan="3" class="form-control form-control-sm" placeholder="Please write a short note that will appear in the printed permit"></textarea>
												  						</div>
												  					</div>
												  					<div class="col-sm-6">
												  						<div class="form-group-sm">
												  							<label>Note (AR)</label>
												  							<textarea disabled placeholder="Please write an arabic note" name="note_ar" rowspan="3" class="form-control form-control-sm"></textarea>
												  						</div>
												  					</div>
												  				</section>
												  				{{-- <section class="row" id="select-additional">
												  					<div class="col">
												  						<p style="display: inline;">
												  							Do you want to add an additional Requirement before sending back to client?
												  							
												  						</p>
					  						  							<span class="kt-switch kt-switch--sm kt-switch--success kt-switch--outline kt-padding-t-20">
					  														<label style="margin-bottom: 0">
					  															<input type="checkbox" name="">
					  															<span></span>
					  														</label>
					  													</span>
												  					</div>
												  				</section> --}}
												  			</div>
												  		</div>
												  	</div>
												  </section>
												   <section class="accordion kt-hide kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-requirements">
												  	<div class="card">
												  		<div class="card-header" id="heading-requirements">
												  			<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-requirements" aria-expanded="true" aria-controls="collapse-requirements">
												  				<h6><span class="kt-font-bolder kt-font-transform-u kt-font-dark">Additional Requirements</span>
												  					<small class="text-muted">Select Addtional Requirements from the list or add new requirement.</small>
												  				</h6>
												  			</div>
												  		 </div>
												  		 <div id="collapse-requirements" class="collapse show" aria-labelledby="heading-requirements" data-parent="#accordion-requirements">
												  			<div class="card-body">
												  				<table class="table table-borderless table-hover table-striped  border" id="additional-requirement">
												  					<thead>
												  						<tr>
												  							<th></th>
												  							<th>REQUIREMENT NAME</th>
												  						</tr>
												  					</thead>
												  				</table>
												  			</div>
												  		</div>
												  	</div>
												  </section>
												   @if ($event->approve()->exists())
												   <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-20" id="accordion-approver">
												       <div class="card">
												           <div class="card-header" id="headingOne-approver">
												               <div class="card-title kt-padding-t-10 kt-padding-b-10 kt-margin-b-5" data-toggle="collapse" data-target="#collapse-approver"
												                   aria-expanded="true" aria-controls="collapse-approver">
												                   <h6 class="kt-font-dark kt-font-transform-u kt-font-bolder">Checked & Approval History</h6>
												               </div>
												           </div>
												           <div id="collapse-approver" class="collapse show" aria-labelledby="headingOne-approver" data-parent="#accordion-approver">
												               <div class="card-body border kt-padding-r-15 kt-padding-l-15 kt-padding-t-10 kt-padding-b-10">
												                   <table class="table table-hover table-borderless border table-striped">
												                       <thead>
												                           <tr>
												                               <th>CHECKED BY</th>
												                               <th>REMARKS</th>
												                               <th>USER GROUP</th>
												                               <th>CHECKED DATE</th>
												                               <th>ACTION TAKEN</th>
												                           </tr>
												                       </thead>
												                       <tbody>
												                           @if ($event->approve()->exists())
												                           @foreach ($event->approve()->orderBy('updated_at')->get() as $approve)
												                               <tr>
												                                   <td>{{ ucwords($approve->user->NameEn) }}</td>
												                                   <td>{{ ($approve->comment->comment) }}</td>
												                                   <td>{{ ucwords($approve->role->NameEn) }}</td>
												                                   <td>{{ $approve->checked_at ? $approve->checked_at->format('d-M-Y') : null }}</td>
												                                   <td>{{ $approve->status }}</td>
												                               </tr>
												                           @endforeach
												                           @endif
												                       </tbody>
												                   </table>
												               </div>
												           </div>
												       </div>  
												   </div>
												   @endif
											</div>
									 </section>
								</div>
						 </div>
					</div>
					<div class="kt-form__actions">
						 <button type="button" data-ktwizard-type="action-prev" class="btn btn-elevate btn-maroon btn-sm kt-font-bold kt-font-transform-u btn-wide">
								Previous
						 </button>
						 <button type="button" data-ktwizard-type="action-next"
										 class="btn btn-elevate btn-warning kt-font-bold  btn-sm kt-font-bold btn-wide kt-font-transform-u">Next
						 </button>
						 <div data-ktwizard-type="action-submit" class="dropdown">
								<button id="btn-submit" type="submit" class="btn btn-warning btn-sm  kt-font-bold kt-font-transform-u">Submit</button>
						 </div>
					</div>
			 </form>
				</div>
		 </div>
	</div>
	 </section>
	 @include('admin.event.includes.existing-event-modal')
@stop
@section('script')
	 	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.common.dev.js"></script>
	 <script>
	 	var add_requirements_table = {};
		new Vue({ el: '#app-wizard', data: { comment: null } });

     $(document).ready(function () {


       var todayDate = moment().startOf('day');
       var YM = todayDate.format('YYYY-MM');
       var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
       var TODAY = todayDate.format('YYYY-MM-DD');
       var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

       var calendarEl = document.getElementById('kt_calendar');
       var calendar = new FullCalendar.Calendar(calendarEl, {
         plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
         refetchResourcesOnNavigate: true,

         isRTL: KTUtil.isRTL(),
         header: {
           left: 'prev,next today',
           center: 'title',
           right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
         },

         height: 800,
         contentHeight: 750,
         aspectRatio: 3,

         views: {
           dayGridMonth: {buttonText: 'Month'},
           timeGridWeek: {buttonText: 'Week'},
           timeGridDay: {buttonText: 'Day'},
           listWeek: {buttonText: 'List'}
         },

         defaultView: 'dayGridMonth',
         defaultDate: TODAY,

         editable: true,
         eventLimit: true, // allow "more" link when too many events
         navLinks: true,

           events: [
                   @foreach($existing_event as $event)
                  {
                    title: '{{$event->name_en .' : '.$event->time_start}}',
                    start: '{{$event->issued_date}}',
                    description: '{{$event->name_ar}}',
                   //end'{{--{{$event->expired_date}}--}}',
                    className: "fc-event-danger fc-event-solid-warning",
                  },
                  @endforeach
                ],
 
          eventRender: function(info) {
              var element = $(info.el);
              if (info.event.extendedProps && info.event.extendedProps.description) {
                  if (element.hasClass('fc-day-grid-event')) {
                      element.data('content', info.event.extendedProps.description);

                      element.data('placement', 'top');
                      KTApp.initPopover(element);
                  } else if (element.hasClass('fc-time-grid-event')) {
                      element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                  } else if (element.find('.fc-list-item-title').lenght !== 0) {
                      element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                  }
              }
          }
       });

       calendar.render();
       // updateLock();
       eventDetails();
       wizard();
       requirementTable();
       formSubmit();
     });

     
     function formSubmit() {
       var approver = $('select#select-approver');

       
       //show or hide the approver selection
       $('input[name=status]').change(function () {
		 if($(this).val() == 'need approval') { approver.parents('.form-group').removeClass('kt-hide'); $('#printed-note').addClass('d-none').find('textarea').attr('disabled', true); }
		 else if($(this).val() == 'approved-unpaid'){ $('#printed-note').removeClass('d-none').find('textarea').removeAttr('disabled', true); }
		 else{ approver.parents('.form-group').addClass('kt-hide');  $('#printed-note').addClass('d-none').find('textarea').attr('disabled', true); }
       });
       
       approver.select2({
		 minimumResultsForSearch: 'Infinity',
		 maximumSelectionLength: 2,
		 placeholder: 'Select Approver',
		 autoWidth: true,
		 width: '100%',
		 allowClear: true,
		 tags: true
       });

       $('select#select-additional').select2({
       	minimumResultsForSearch: 'Infinity',
       	// maximumSelectionLength: 2,
       	// placeholder: '',
       	autoWidth: true,
       	width: '100%',
       	allowClear: true,
       	tags: true
       });
     }

     function additionalRequirementTable(){
     	add_requirements_table = $('table#additional-requirement').DataTable({
     		  dom: '<"toolbar-add pull-left"><"toolbar-active-1 pull-left"><"toolbar-active-2 pull-left">frt<"pull-left"i>p',
     		  'pageLength': 20,
     		ajax:{ url: '{{ route('admin.event.additionalrequirementdatatable', $event->event_id) }}'},
     		serverSide: false,	
     		columnDefs:[
     		{targets: 0, checkboxes: { selectRow: true }, sortable: false, className: 'no-wrap'}
     		],
     		language:{
     			'sEmptyTable': 'Requirement list is empty. <span class="kt-font-bold kt-font-transform-u kt-font-dark">Please add new requirements</span>'
     		},
     		select:{ style: 'multi' },
     		columns: [
     			{ data: 'requirement_id'},
     			{ data: 'name'},
     		]
     	});

     	var counter = 0;

     	 $('div.toolbar-add').html('<button type="button" id="btn-add" class="btn btn-sm btn-warning kt-font-dark kt-font-bold kt-font-transform-u">Add New Requirement</button>');
     	 $('#btn-add').on( 'click', function () {
     	 	var html = '<section class="row">';
     	 		html += '	<div class="col-sm-4">'
     	 		html += '		<div class="form-group form-group-xs">';
     	 		html += '			<input type="text" autofocus autocomplete="off" class="form-control form-control-sm" name="requirements['+counter+'][name]" placeholder="requirement name">';
     	 		html += '		</div>';
     	 		html += '	</div>';
     	 		html += ' <div class="col-sm-4">';
     	 		html += ' 	<div  class="form-group form-group-xs">';
     	 		html += '		<input placeholder="description" type="text" name="requirements['+counter+'][description]" class="form-control form-control-sm" >';
     	 		html += ' 	</div>';
     	 		html += ' </div>';
     	 		html += '	<div class="col-sm-4">';
     	 		html + '		<div class="form-group form-group-xs">';
     	 		html += '			<div class="kt-checkbox--inline kt-forn-dark">';
     	 		html += '				<label class="kt-checkbox"><input type="checkbox"  name="requirements['+counter+'][date]"> Issued date & Expired date required?<span></span></label>';
     	 		html += '			</div>';
     	 		html += '		</div>';
     	 		html += '	</div>';
     	 		html += '</section>';
     	 	var data = {requirement_id: '', name: html };
     	 	counter++;
     	 	add_requirements_table.row.add(data).draw();
     	    });
     	 
     	 
     	$('form#kt_form').submit(function(e){
     		var form = this;
     		   var rows_selected = add_requirements_table.column(0).checkboxes.selected();
     		   rows_selected.each(function(v){
     		   	  $(form).append( $('<input>').attr('type', 'hidden').attr('name', 'requirements_id[]').val(v) );
     		   });
     	});
     }
     
     function requirementTable(){
       var dt = $('table#requirement-table').DataTable({
				 ajax: {
				   url: '{{ route('admin.event.applicationDatatable',  $event->event_id) }}',
					  data: function(d){},
				 },
				 columnDefs:[
					 {targets: [1,2, 3], className: 'no-wrap'},
					 {targets:[1], "visible": false},
				 ],
				  "order": [[ 1, 'asc' ]],
				 columns:[
				 	 {
				 	 	orderable:  false,
				 	 	data: null,
				 	 	defaultContent: '<span class="la la-angle-double-down text-success"></span>'
				 	 },
					 {data: 'type'},
					 {data: 'name'},
					 {data: 'issued_date'},
					 {data: 'expired_date'},
           {
             render: function (row, type, full, meta) {
               var html = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">';
               html += '<input type="checkbox" class="step-2" data-step="2">';
               html += '<span></span>';
               html += '</label>';
               return html;
             }
           }
				 ],
				 "drawCallback": function ( settings ) {
				      var api = this.api();
				      var rows = api.rows( {page:'current'} ).nodes();
				      var last=null;
				 
				      api.column(1, {page:'current'} ).data().each( function ( group, i ) {
				          if ( last !== group ) {
				              $(rows).eq( i ).before(
				                  '<tr class="group"><td colspan="5">'+group+'</td></tr>'
				              );
				 
				              last = group;
				          }
				      } );
				  },
				  initComplete: function(){
				  	// $("#requirement-table").DataTable().rows().every( function () {
				  	//     var tr = $(this.node());
				  	//     this.child(format(tr.data('child-value'))).show();
				  	//     tr.addClass('shown');
				  	// });
				  }
			 });

        var detailRows = [];

     

       // $('#requirement-table tbody tr td .la-angle-double-down').click();

        // $('#requirement-table tbody').on( 'click', 'tr td .la-angle-double-down', function () {
        //        var tr = $(this).closest('tr');
        //        var row = dt.row( tr );
        //        var idx = $.inArray( tr.attr('id'), detailRows );
        
        //        if ( row.child.isShown() ) {
        //            tr.removeClass( 'details' );
        //            row.child.hide();
        
        //            // Remove from the 'open' array
        //            detailRows.splice( idx, 1 );
        //        }
        //        else {
        //            tr.addClass( 'details' );
        //            row.child( format( row.data() ) ).show();
        
        //            // Add to the 'open' array
        //            if ( idx === -1 ) {
        //                detailRows.push( tr.attr('id') );
        //            }
        //        }
        //    } );

        // On each draw, loop over the `detailRows` array and show any child rows
           dt.on( 'draw', function () {
               $.each( detailRows, function ( i, id ) {
                   $('#'+id+' td .la-angle-double-down').trigger( 'click' );
               } );
           } );
		 }

		 function format ( d ) {
		     return 'Full name:<br>'+
		         'Salary: <br>'+
		         'The child row can contain any data you wish, including links, images, inner tables etc.';
		 }
     
     function wizard() {
       $(document).on('change','input[type=checkbox]', function(){
				if($(this).is(':checked')){
					$(this).parents('.input-group').find('input[type=text]').addClass('is-valid').removeClass('is-invalid');
					$(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
				}
				else{
					$(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
					$(this).parents('label').removeClass('kt-checkbox--success').addClass('kt-checkbox--default');
				}
			});
			 var wizard = new KTWizard("kt_wizard_v3", {startStep: 1});
			 wizard.on("beforeNext", function(wizardObj) {
			 	if(wizardObj.currentStep == 1){
 						$('input[type=checkbox][data-step=step-1]').each(function () {
 							if(!$(this).is(':checked')){
 								$(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
 								wizardObj.stop();
 							}
 						});
 					}
 					if(wizardObj.currentStep == 2){
						$('input[type=checkbox].step-2').each(function () {
							if(!$(this).is(':checked')){
								$(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--danger');
								wizardObj.stop();
							}
							else{
								$(this).parents('label').removeClass('kt-checkbox--danger').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
							}
						});
					}

			 });
     }

     function eventDetails() {
     	$('form#kt_form').validate({
     	  rules: {
     	    'status': {required: true},
     	  },
     	  invalidHandler: function (event, validator) {
     	    KTUtil.scrollTop();
     	  }
     	});



     	$('form#kt_form').submit(function(e){

     		if($('input[name=status]').val() != 'approved-unpaid' && $('textarea[name=comment]').val() == ''){
     			e.preventDefault();
     			// alert(123456);
     			// $('form#kt_form').validate().element('.txt-comment');
     			$('textarea[name=comment]').addClass('is-invalid');
     		}
     		else{
     			$('textarea[name=comment]').removeClass('is-invalid');
     		}

     		if($('input[name=status]').val() == 'rejected' && $('textarea[name=comment]').val() == ''){
     			e.preventDefault();
     			$('textarea[name=comment]').addClass('is-invalid');
     		}

     		// if($('select[name=status]').val() == 'need approval'){
     		// 	$('#approver').removeAttr('disabled', true);
     		// }
     		// else{
     		// 	$('#approver').removeAttr('disabled', true);
     		// }
     	});

     	$('input[name=status]').click(function(){
     		if($(this).val() == 'need approval'){
     			$('#select-approver').removeAttr('disabled');
     		}
     		else{
     			$('#select-approver').attr('disabled', true);
     		}
     		if($(this).val() == 'need modification'){
     			$('#accordion-requirements').removeClass('kt-hide');
     			additionalRequirementTable();
     		}
     		else{
     			$('#accordion-requirements').addClass('kt-hide');
     			// console.log(add_requirements_table.column(0).checkboxes.deselectAll());
     			// add_requirements_table.column(0).checkboxes.deselectAll();
     		}
     	});


     	
     
 
     }

     function updateLock() {
       setInterval(function () {
         $.ajax({
           url: '{{ route('admin.event.lock', $event->event_id) }}',
           data: {active: true}
         });
       }, 5000);
     }
	 </script>
@stop
