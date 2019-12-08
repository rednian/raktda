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
																						<input value="{{ date('d-F-Y', strtotime($event->issued_date)) }}" name="issued_date" readonly="readonly" type="text"
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
																							<input value="{{ date('d-F-Y', strtotime($truck->registration_issued_date)) }}" name="registration_issued_date" readonly="readonly" type="text"
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
																							<input value="{{ date('d-F-Y', strtotime($truck->registration_expired_date)) }}" name="registration_expired_date" readonly="readonly" type="text"
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
												 @if ($event->truck()->count() > 0)
												 		<div class="accordion accordion-solid accordion-toggle-plus" id="accordion-truck">
												 		<div class="card border">
												 			<div class="card-header" id="heading-truck">
												 				<div class="card-title kt-padding-b-5 kt-padding-t-10" data-toggle="collapse" data-target="#collapse-truck" aria-expanded="true" aria-controls="collapse-truck">
												 					<span class="kt-font-dark kt-font-bold">{{__('FOOD TRUCK REQUIREMENTS')}} <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->truck()->count()}}</span></span>
												 				</div>
												 			</div>
												 			<div id="collapse-truck" class="collapse show" aria-labelledby="heading-truck" data-parent="#accordion-truck">
												 				<div class="card-body">
												 					<table class="table table-hover table-borderless table-sm border table-striped" id="truck-table">
												 						<thead>
												 							<tr>
												 								 <th>#</th>
												 								 <th>{{ __('COMPANY NAME') }}</th>
												 								 <th>{{ __('FOOD TYPE') }}</th>
												 								 <th>{{ __('PLATE NUMBER') }}</th>
												 								 <th>{{ __('ACTION') }}</th>
												 							</tr>
												 						</thead>
												 					 </table>
												 				</div>
												 			</div>
												 		</div>
												 	</div>
												 @endif
											 <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x " role="tablist">
											 	<li class="nav-item">
											 		<a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content" role="tab">
											 			{{__('EVENT REQUIREMENTS')}} <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->eventRequirement()->count()}}</span>
											 		</a>
											 	</li>
											 	@if ($event->liquor()->count() > 0)
											 		<li class="nav-item">
											 			<a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_3_tab_content" role="tab">
											 				{{__('LIQUOR REQUIREMENTS')}} <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->liquor()->count()}}</span>
											 			</a>
											 		</li>
											 	@endif
											 </ul>
											 <div class="tab-content">
 												<div class="tab-pane active" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
 													 <table class="table border borderless table-hover table-sm" id="requirement-table">
 														<thead>
 															<tr>
 																 <th>{{ __('REQUIREMENT NAME') }}</th>
 																 <th>{{ __('FILES') }}</th>
 																 <th>{{ __('ISSUED DATE') }}</th>
 																 <th>{{ __('EXPIRED DATE') }}</th>
 																 <th>{{ __('ACTION') }}</th>
 															</tr>
 														</thead>
 													 </table>
 												</div>
 												
 												<div class="tab-pane" id="kt_portlet_base_demo_2_3_tab_content" role="tabpanel">
 													<table class="table border borderless table-hover table-sm" id="liquor-table">
 														<thead>
 															<tr>
 																 <th>{{ __('REQUIREMENT NAME') }}</th>
 																 <th>{{ __('FILES') }}</th>
 																 <th>{{ __('ISSUED DATE') }}</th>
 																 <th>{{ __('EXPIRED DATE') }}</th>
 																 <th>{{ __('ACTION') }}</th>
 															</tr>
 														</thead>
 													 </table>
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
	 {{-- document modal --}}
	 <div class="modal fade" id="truck-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<table class="table table-borderless table-hover table-striped  border" id="truck-requirement-table">
						<thead>
							<tr>
								 <th>{{ __('REQUIREMENT NAME') }}</th>
								 <th>{{ __('FILES') }}</th>
								 <th>{{ __('ISSUED DATE') }}</th>
								 <th>{{ __('EXPIRED DATE') }}</th>
								 <th>{{ __('ACTION') }}</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
@stop
@section('script')
	 	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.common.dev.js"></script>
	 <script>
	 	var add_requirements_table = {};
		new Vue({ el: '#app-wizard', data: { comment: null } });

     $(document).ready(function () {

 

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
       liqourRequirement();
       truck();
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

     function truck(){
     	$('table#truck-table').DataTable({
     		ajax: '{{ route('admin.event.truck.datatable', $event->event_id) }}',
     		columnDefs:[
     		{targets:[0, 4], className:'no-wrap'},
     		],
     		columns: [
     		{
     			render: function(data, row, full, meta){
     				return 'Food Truck No. '+full.DT_RowIndex;
     			}
     		},
     		{data: 'name'},
     		{data: 'type'},
     		{data: 'plate_number'},
     		{data: 'action'},
     		],
     		createdRow: function(row, data, index){
     			$('.btn-document', row).click(function(){
     				$('#truck-modal').modal('show');
     				$('#title').html('Food Truck No. '+data.DT_RowIndex);
     				truckRequirement(data);
     			});
     		}
     	});
     }

     function truckRequirement(data){
     	$('table#truck-requirement-table').DataTable({
     		ajax: '{{ url('/event') }}/'+'{{$event->event_id}}'+'/truck/'+data.event_truck_id+'/datatable',
     		columnDefs:[
     			{targets:[1,2,3,4], className:'no-wrap'},
     			],
     			"order": [[ 0, 'asc' ]],
     			  rowGroup: {
     			  	startRender: function ( rows, group ) {
     			  	 var row_data = rows.data()[0];
     			  	 return $('<tr/>').append( '<td >'+group+'</td>' )
     			  	 						.append( '<td>'+rows.count()+'</td>' )
     			  	 						.append( '<td>'+row_data.issued_date+'</td>' )
     			  	                  .append( '<td>'+row_data.expired_date+'</td>' )
     			  	                  .append( '<td></td>' )
     			  	                  .append( '<tr/>' );
     			  	  },
     			   dataSrc: 'name'
     			},
     			columns:[
  			  	{data: 'files'},
  			  	{render: function(data){ return null}},
  			  	{render: function(data){ return null}},
  			  	{render: function(data){ return null}},
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

     	});
     }

     function liqourRequirement(){
     		$('table#liquor-table').DataTable({
     			ajax: '{{ route('admin.event.liquor.requirement', $event->event_id) }}',
     			columnDefs:[
     			{targets:[1,2,3,4], className:'no-wrap'},
     			],
  			  "order": [[ 0, 'asc' ]],
  			    rowGroup: {
  			    	startRender: function ( rows, group ) {
  			    	 var row_data = rows.data()[0];
  			    	 return $('<tr/>').append( '<td >'+group+'</td>' )
  			    	 						.append( '<td>'+rows.count()+'</td>' )
  			    	 						.append( '<td>'+row_data.issued_date+'</td>' )
  			    	                  .append( '<td>'+row_data.expired_date+'</td>' )
  			    	                  .append( '<td></td>' )
  			    	                  .append( '<tr/>' );
  			    	  },
  			     dataSrc: 'name'
  			  },
  			  	columns:[
  			  	{data: 'files'},
  			  	{render: function(data){ return null}},
  			  	{render: function(data){ return null}},
  			  	{render: function(data){ return null}},
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
     		});
     }
     
     function requirementTable(){

       var dt = $('table#requirement-table').DataTable({
				 ajax: {
				   url: '{{ route('admin.event.applicationDatatable',  $event->event_id) }}',
					  data: function(d){},
				 },
				 columnDefs:[
					 {targets: [1,2, 3, 4], className: 'no-wrap'},
				 ],
				  "order": [[ 0, 'asc' ]],
				  rowGroup: {
				  	startRender: function ( rows, group ) {
				  	 var row_data = rows.data()[0];
				  	 return $('<tr/>').append( '<td >'+group+'</td>' )
				  	 						.append( '<td>'+rows.count()+'</td>' )
				  	 						.append( '<td>'+row_data.issued_date+'</td>' )
				  	                  .append( '<td>'+row_data.expired_date+'</td>' )
				  	                  .append( '<td></td>' )
				  	                  .append( '<tr/>' );
				  	  },
				   dataSrc: 'name'
				},
				 columns:[
					 {data: 'files'},
					 {render: function(data){ return null}},
					 {render: function(data){ return null}},
					 {render: function(data){ return null}},
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
			 });

   
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
			$('input[type=checkbox][data-step=step-2]').each(function () {
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
