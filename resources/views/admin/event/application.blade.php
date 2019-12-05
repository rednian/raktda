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
			<h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ ucwords($event->name_en) }} - {{ __('APPLICATION') }}</span></h3>
		</div>
		<div class="kt-portlet__head-toolbar">
			<a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-outline-secondary kt-margin-r-4 kt-font-transform-u">
				<i class="la la-arrow-left"></i>{{ __('BACK TO EVENT LIST') }}
			</a>
			<div class="dropdown dropdown-inline">
				<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-elevate btn-icon btn-sm btn-icon-sm">
					<i class="flaticon-more"></i>
				</button>
				<div x-placement="bottom-end" class="dropdown-menu dropdown-menu-right">
					<a href="javascript:void(0)" class="dropdown-item kt-font-transform-u">{{ __('COMPANY INFORMATION') }}</a>
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
									<section class="row kt-margin-t-5 kt-margin-b-20">
										<div class="col">
											@include('admin.event.includes.existing-notification')
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
											 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border" id="accordion-detail">
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
																	<section class="row">
																		<div class="col-md-6">
																			 <label class="kt-font-dark">{{ __('Application Type') }}</label>
																			<div class="input-group input-group-sm">
																	 	<input value="{{ ucfirst($event->firm) }}" name="no_of_trucks" readonly="readonly" type="text"
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
																		<div class="col-md-6">
																			<label class="kt-font-dark">{{ __('Expected Audience') }}</label>
																			<div class="input-group input-group-sm">
																				<input value="{{ ucfirst($event->audience_number) }}" name="no_of_trucks" readonly="readonly" type="text"
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
																	</section>
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
											 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border" id="accordion-date">
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
											 @if ($event->truck()->count() > 0)
											 	<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border" id="accordion-truck">
													<div class="card">
														 <div class="card-header" id="heading-truck">
																<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-truck"
																		 aria-expanded="true"
																		 aria-controls="collapse-truck">
																	 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('TRUCK DETAILS') }}</h6>
																</div>
														 </div>
														 <div id="collapse-truck" class="collapse show" aria-labelledby="heading-truck" data-parent="#accordion-truck">
																<div class="card-body">
																	<section class="row form-group form-group-sm">
																		<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Number of Food Truck') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->number_of_trucks }}" name="time_end" readonly="readonly" type="text" class="form-control">
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
																	</section>
																	@foreach ($event->truck as  $index => $truck)
																		<section class="kt-section border kt-padding-5" style="margin-bottom: 10px !important">
																			<div class="kt-section__title kt-margin-b-10">
																				<h4 class="kt-margin-b-0 kt-font-dark kt-font-transform-u text-danger" style="font-size: small;">Truck {{++$index}} - Information</h4>
																			</div>
																			<div class="kt-section__content">
																				<div class="row form-group form-group-sm">
																					<div class="col-6">
																						 <label class="kt-font-dark">{{ __('Company Name') }} <span class="text-danger">*</span></label>
																						 <div class="input-group input-group-sm">
																								<input value="{{ $truck->company_name_en }}" name="company_name_en" readonly="readonly" type="text"
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
																					<div class="col-6">
																						<label class="kt-font-dark">{{ __('Company Name (AR)') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $truck->company_name_ar }}" name="company_name_ar" readonly="readonly" type="text"
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
																		 		<div class="row form-group form-group-sm">
																					<div class="col-3">
																						 <label class="kt-font-dark">{{ __('Food Type') }} <span class="text-danger">*</span></label>
																						 <div class="input-group input-group-sm">
																								<input value="{{ $truck->food_type }}" name="food_type" readonly="readonly" type="text"
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
																						<label class="kt-font-dark">{{ __('Plate Number') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $truck->plate_number }}" name="plate_number" readonly="readonly" type="text"
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
																						<label class="kt-font-dark">{{ __('Registration Issued Date') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $truck->registration_issued_date->format('d-M-Y') }}" name="registration_issued_date" readonly="readonly" type="text"
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
																						<label class="kt-font-dark">{{ __('Registration Expired Date') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $truck->registration_expired_date->format('d-M-Y') }}" name="registration_expired_date" readonly="readonly" type="text"
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
																		</section>
																	@endforeach
																</div>
														 </div>
													</div>
											 </section>
											 @endif
											 @if ($event->liquor()->exists() )
											 	<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus border" id="accordion-liquor">
													<div class="card">
														 <div class="card-header" id="heading-liquor">
																<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-liquor"
																		 aria-expanded="true"
																		 aria-controls="collapse-liquor">
																	 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('LIQUOR DETAILS') }}</h6>
																</div>
														 </div>
														 <div id="collapse-liquor" class="collapse show" aria-labelledby="heading-liquor" data-parent="#accordion-liquor">
																<div class="card-body">
																	 <div class="row form-group form-group-sm">
																			<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Establishment Name') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->liquor->company_name_en }}" name="company_name" readonly="readonly" type="text"
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
																			<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Establishment Name (AR)') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->liquor->company_name_ar }}" name="expired_date" readonly="readonly" type="text"
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
																			<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Trade License Number') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->liquor->trade_license }}" name="company_name" readonly="readonly" type="text"
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
																			<div class="col-6">
																				<div class="row">
																					<div class="col-md-6">
																						<label class="kt-font-dark">{{ __('Trade License Issued Date') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $event->liquor->trade_license_issued_date }}" name="expired_date" readonly="readonly" type="text"
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
																					<div class="col-md-6">
																						<label class="kt-font-dark">{{ __('Trade License Expired Date') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $event->liquor->trade_license_expired_date }}" name="expired_date" readonly="readonly" type="text"
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
																				 
																				 
																			</div>
																	 </div>
																	 <div class="row form-group form-group-sm">
																			<div class="col-6">
																				 <label class="kt-font-dark">{{ __('Liquor License Number') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ $event->liquor->license_number }}" name="company_name" readonly="readonly" type="text"
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
																			<div class="col-6">
																				<div class="row">
																					<div class="col-md-6">
																						<label class="kt-font-dark">{{ __('Liquor License Issued Date') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $event->liquor->license_issued_date }}" name="expired_date" readonly="readonly" type="text"
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
																					<div class="col-md-6">
																						<label class="kt-font-dark">{{ __('Liquor License Expired Date') }} <span class="text-danger">*</span></label>
																						<div class="input-group input-group-sm">
																							<input value="{{ $event->liquor->license_expired_date }}" name="expired_date" readonly="readonly" type="text"
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
																			</div>
																	 </div>
																</div>
														 </div>
													</div>
											 </section>
											 @endif
											 
											 <section class="accordion accordion-solid accordion-toggle-plus border" id="accordion-address">
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
																				 <label class="kt-font-dark">{{ __('Street') }} <span class="text-danger">*</span></label>
																				 <div class="input-group input-group-sm">
																						<input value="{{ ucfirst($event->street) }}" name="address" readonly="readonly" type="text"
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
											 <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-5 border" id="accordion-map">
												<div class="card">
													<div class="card-header" id="heading-map">
														<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-map" aria-expanded="true" aria-controls="collapse-map">
														<h6 class="kt-font-transform-u kt-font-dark kt-font-bolder">map details</h6>
														</div>
													</div>
													<div id="collapse-map" class="collapse show" aria-labelledby="heading-map" data-parent="#accordion-map" style="">
														<div class="card-body">
															<div class="row">
																<div class="col-sm-6">
																	<label class="kt-font-dark">Map Full Address <span class="text-danger">*</span></label>
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
																<div class="col-sm-3">
																	<label class="kt-font-dark">Latitude <span class="text-danger">*</span></label>
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
																<div class="col-sm-3">
																	<label class="kt-font-dark">Latitude <span class="text-danger">*</span></label>
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
																 <iframe class="border kt-padding-5" width='100%' height='100%' id='mapcanvas' src='https://maps.google.com/maps?q={{ urlencode($event->full_address)}}&Roadmap&z=10&ie=UTF8&iwloc=&output=embed&z=17'style="height: 310px; padding: 1px; width: 100%; margin-top: 1%; border-style: none;" >
																 	</iframe>
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
																					 <a data-fancybox="gallery" href="{{ asset('/storage/'.$requirement->eventRequirement()->first()->path) }}"  data-fancybox data-caption="{{$name}}">{{$name}}</a>
																					
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


											<table id="event-table" class="table dataTable border kt-hide">
												<thead>
													<tr>
														<th>DOCUMENT NAME</th>
														<th>NUMBER OF FILE</th>
														<th>ISSUED DATE</th>
														<th>EXPIRED DATE</th>
														<th>FIlE TYPE</th>
														<th>ACTION</th>
													</tr>
												</thead>
												<tbody>
													<tr data-tt-id="1" class="expanded">
											    		<td colspan="5"><span style="font-size: large;" class="flaticon-folder kt-font-dark kt-font-boldest"></span> EVENT DOCUMENTS</td>
											  		</tr>
											  		@if ($requirements->count() > 0)
											  			<tr data-tt-id="1-1" data-tt-parent-id="1">
											    			<td colspan="5"><span class="flaticon-folder kt-font-dark"></span> Uploaded Documents</td>
											  			</tr>
											  			@foreach ($requirements as $index => $requirement)
											  				@php
											  					$event_requirements = $requirement->eventRequirement()->whereHas('event', function($q) use ($event){ $q->where('event.event_id', $event->event_id);})->get();
											  				@endphp
											  				<tr data-tt-id="1-1-{{$index}}" data-tt-parent-id="1-1">
											    				<td>{{++$index}}. {{ucfirst($requirement->requirement_name)}}{{ fileName('') }}</td>
											    				<td>{{ $event_requirements->count() }}</td>
											    				<td>{{$event_requirements->first()->issued_date->year > 1 ? $event_requirements->first()->issued_date->format('d-M-Y') : null}}</td>
											    				<td>{{$event_requirements->first()->issued_date->year > 1 ? $event_requirements->first()->expired_date->format('d-M-Y') : null}}</td>
											    				
											  				</tr>
											  				@foreach ($event_requirements as $key => $event_requirement)
										  						<tr data-tt-id="1-1-1-1" data-tt-parent-id="1-1-{{$index}}">
										  							<td>File {{++$key}} of {{ +$index }}</td>
										  						</tr>
											  				@endforeach

											  			@endforeach
											  			@if ($event->logo_thumbnail)
											  				<tr data-tt-id="1-1-1" data-tt-parent-id="1-1">
											    			<td>{{$event->requirements()->count()+1}}. Event Logo</td>
											    			<td>-</td>
											    			<td>-</td>
											    			<td>{{ fileName($event->logo_thumbnail) }}</td>
											    			<td>-</td>
											  			</tr>
											  			@endif
											  			
											  		@endif
											  			
											  	
											  	

											  		@if ($event->additionalRequirements()->exists())
											  		<tr data-tt-id="1-3" data-tt-parent-id="1">
											    		<td colspan="5"><span class="flaticon-folder kt-font-dark"></span> Additional Documents</td>
											  		</tr>
											  		@foreach ($event->additionalRequirements as $index => $requirement)
											  			<tr data-tt-id="1-3-1" data-tt-parent-id="1-3">
											    			<td colspan="4">{{ ++$index }}. {{ $requirement->requirement_name }}</td>
											  			</tr>
											  			@if ($requirement->eventRequirement()->exists())
											  				@foreach ($requirement->eventRequirement as $key => $uploaded)
											  					<tr data-tt-id="1-3-1-1" data-tt-parent-id="1-3-1">
											    					<td colspan="4">{{ ++$key }}. {{ $requirement->requirement_name }}</td>
											  					</tr>
											  				@endforeach
											  			@endif
											  		@endforeach
											  		@endif
											  		
											  		<tr data-tt-id="1-2" data-tt-parent-id="1">
												    		<td colspan="4"><span class="flaticon-folder kt-font-dark"></span> Other Documents</td>
											  		</tr>
											  			<tr data-tt-id="1-2-1" data-tt-parent-id="1-2">
											    		<td colspan="5"><span class="flaticon-folder kt-font-dark"></span> Other Documents</td>
											  		</tr>
											  		</tr>
											  			<tr data-tt-id="1-2-1-1" data-tt-parent-id="1-2-1">
											    		<td colspan="5"><span class="flaticon-folder kt-font-dark"></span> Other Documents</td>
											  		</tr>
											  		<tr data-tt-id="3">
											    		<td><span style="font-size: large;" class="flaticon-folder kt-font-dark kt-font-boldest"></span> TRUCK DOCUMENTS</td>
											  		</tr>
											  		<tr data-tt-id="2" data-tt-parent-id="3">
											    		<td>Child</td>
											  		</tr>
											  		<tr data-tt-id="2" data-tt-parent-id="3">
											    		<td>Child</td>
											  		</tr>
											  		<tr data-tt-id="a">
											    		<td><span style="font-size: large;" class="flaticon-folder kt-font-dark kt-font-boldest"></span> LIQUOR DOCUMENTS</td>
											  		</tr>
												</tbody>
											</table>

												  

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
												  @include('admin.artist_permit.includes.comment')
												   <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-action">
												  	<div class="card">
												  		<div class="card-header" id="heading-action">
												  			<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-action" aria-expanded="true" aria-controls="collapse-action">
												  				<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Select Action') }}</h6>
												  			</div>
												  		 </div>
												  		 <div id="collapse-action" class="collapse show" aria-labelledby="heading-action" data-parent="#accordion-action">
												  			<div class="card-body">
												  				<section class="row">
												  					<div class="col-md-12">
												  						<div class="form-group row form-group-sm">
  																			<div class="col-12">
  																				<div class="kt-radio-inline">
  																					<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
  																						<input value="approved-unpaid" type="radio" name="status"> Approve Application
  																						<span></span>
  																					</label>
  																					<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
  																						<input value="need modification" type="radio" name="status"> Send Back for Amendment
  																						<span></span>
  																					</label>
  																					<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
  																						<input value="need approval" type="radio" name="status"> Need Approval
  																						<span></span>
  																					</label>
  																					<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
  																						<input value="rejected" type="radio" name="status"> Reject Application
  																						<span></span>
  																					</label>
  																				</div>
  																			</div>
  																		</div>
												  					</div>

												  					<div class="col-md-4">
												  						<div class="form-group form-group-sm kt-hide">
												  							<label for="" class="kt-font-dark">{{ __('Approvers') }} <span class="text-danger">*</span></label>
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
												  				<section class="row d-none" id="select-additional">
												  					<div class="col">
												  						<p style="display: inline;" class="kt-font-dark">
												  							Do you want to add additional Requirement before sending back to client?
												  							
												  						</p>
					  						  							<label class="kt-checkbox kt-checkbox--single kt-checkbox--default kt-margin-b-0 ">
					  						  								<input type="checkbox"  class="step-2"><span></span>
					  						  							</label>
												  					</div>
												  				</section>
												  				<section class="row d-none" id="printed-note">
												  					<div class="col-sm-6">
												  						<div class="form-group-sm">
												  							<label>{{ __('Note') }}</label>
												  							<textarea disabled name="note_en" rowspan="3" class="form-control form-control-sm" placeholder="Please write a short note that will appear in the printed permit"></textarea>
												  						</div>
												  					</div>
												  					<div class="col-sm-6">
												  						<div class="form-group-sm">
												  							<label>{{ __('Note (AR)') }}</label>
												  							<textarea disabled placeholder="Please write an arabic note" name="note_ar" rowspan="3" class="form-control form-control-sm"></textarea>
												  						</div>
												  					</div>
												  				</section>
												  				
												  			</div>
												  		</div>
												  	</div>
												  </section>
												   <section class="accordion kt-hide kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-requirements">
												  	<div class="card">
												  		<div class="card-header" id="heading-requirements">
												  			<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-requirements" aria-expanded="true" aria-controls="collapse-requirements">
												  				<h6><span class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('Additional Requirements') }}</span>
												  					<small class="text-muted">{{ __('Select Additional Requirements from the list or add new requirement') }}</small>
												  				</h6>
												  			</div>
												  		 </div>
												  		 <div id="collapse-requirements" class="collapse show" aria-labelledby="heading-requirements" data-parent="#accordion-requirements">
												  			<div class="card-body">
												  				<table class="table table-borderless table-hover table-striped  border" id="additional-requirement">
												  					<thead>
												  						<tr>
												  							<th></th>
												  							<th>{{ __('REQUIREMENT NAME') }}</th>
												  						</tr>
												  					</thead>
												  				</table>
												  			</div>
												  		</div>
												  	</div>
												  </section>
											</div>
									 </section>
								</div>
						 </div>
					</div>
					<div class="kt-form__actions">
						 <button type="button" data-ktwizard-type="action-prev" class="btn btn-elevate btn-maroon btn-sm kt-font-bold kt-font-transform-u btn-wide">
								{{ __('PREVIOUS') }}
						 </button>
						 <button type="button" data-ktwizard-type="action-next"
										 class="btn btn-elevate btn-warning kt-font-bold  btn-sm kt-font-bold btn-wide kt-font-transform-u">{{ __('NEXT') }}
						 </button>
						 <div data-ktwizard-type="action-submit" class="dropdown">
								<button id="btn-submit" type="submit" class="btn btn-warning btn-sm  kt-font-bold kt-font-transform-u">{{ __('SUBMIT') }}</button>
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

     	$('#event-table').treetable({
     		// expandable: true,
     	});
     	// $('#event-table').treetable('expandAll');

     	$("#event-table tbody").on("mousedown", "tr", function() {
     	  $(".selected").not(this).removeClass("selected");
     	  $(this).toggleClass("selected");
     	});

     	$("#event-table .folder").each(function() {
     	  $(this).parents("tr").droppable({
     	    accept: ".file, .folder",
     	    drop: function(e, ui) {
     	      var droppedEl = ui.draggable.parents("tr");
     	      $("#example-advanced").treetable("move", droppedEl.data("ttId"), $(this).data("ttId"));
     	    },
     	    hoverClass: "accept",
     	    over: function(e, ui) {
     	      var droppedEl = ui.draggable.parents("tr");
     	      if(this != droppedEl[0] && !$(this).is(".expanded")) {
     	        $("#event-table").treetable("expandNode", $(this).data("ttId"));
     	      }
     	    }
     	  });
     	});


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
     });

     


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

     	 $('div.toolbar-add').html('<button type="button" id="btn-add" class="btn btn-sm btn-warning kt-font-dark kt-font-bold kt-font-transform-u">{{ __('Add New Requirement') }}</button>');
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
     
 

     function eventDetails() {
 
     	$('form#kt_form').validate({
     	  rules: {
     	    status: {required: true},
     	  },
     	  messages: {
     	  	status: 'Please select an action.'
     	  },

     	  invalidHandler: function (event, validator) {
     	  	console.log(validator);
     	    KTUtil.scrollTop();
     	  }
     	});

     	var approver = $('select#select-approver');

     	approver.select2({
		 minimumResultsForSearch: 'Infinity',
		 maximumSelectionLength: 2,
		 placeholder: 'Select Approver',
		 autoWidth: true,
		 width: '100%',
		 allowClear: true,
		 tags: true
       });

     	$('input[name=status][type=radio]').change(function(){
     		if($(this).val() == 'need modification'){
     		 $('#accordion-requirements').removeClass('kt-hide');
     		 additionalRequirementTable();
     		}
     		else{
     			 $('#accordion-requirements').addClass('kt-hide');
     		} 

     		if($(this).val() == 'approved-unpaid'){
     			$('#printed-note').removeClass('d-none').find('textarea').removeAttr('disabled', true);
     		}
     		else{
     			$('#printed-note').addClass('d-none').find('textarea').attr('disabled', true);
     		}

     	

     		if($(this).val() == 'need approval'){
     			 approver.parents('.form-group').removeClass('kt-hide').find('select').removeAttr('disabled', true); 
     		}
     		else{
     			 approver.parents('.form-group').addClass('kt-hide').find('select').attr('disabled', true); 
     		}
     	});


     	$('form#kt_form').submit(function(e){
     		var status  = $(this).find('input[type=radio][name=status]:checked').val();
     		if(status != 'approved-unpaid' && $(this).find('textarea[name=comment]').val() == '' ){
     		$(this).find('textarea[name=comment]').addClass('is-invalid');
     			e.preventDefault();
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

     function wizard() {
     	$(document).on('change','input[type=checkbox]', function(){
			if($(this).is(':checked')){
				$(this).parents('.input-group').find('input[type=text]').addClass('is-valid').removeClass('is-invalid');
				$(this).parents('.input-group').find('textarea').addClass('is-valid').removeClass('is-invalid');
				$(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
			}
			else{
				$(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
				$(this).parents('.input-group').find('textarea').removeClass('is-valid').addClass('is-invalid');
				$(this).parents('label').removeClass('kt-checkbox--success').addClass('kt-checkbox--default');
			}
     });

	 var wizard = new KTWizard("kt_wizard_v3", {startStep: 1});
	 wizard.on("beforeNext", function(wizardObj) {
	 	if(wizardObj.currentStep == 1){
	 		$('input[type=checkbox][data-step=step-1]').each(function () {
	 			if(!$(this).is(':checked')){
	 				$(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
	 				$(this).parents('.input-group').find('textarea').removeClass('is-valid').addClass('is-invalid');
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
	 </script>
@stop
