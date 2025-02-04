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
		<h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ $event->name }} - {!! permitStatus($event->request_type) !!}</span></h3>
	</div>
	<div class="kt-portlet__head-toolbar">
		<a href="{{ URL::signedRoute('admin.event.index') }}" class="btn btn-sm btn-outline-secondary kt-margin-r-4 kt-font-transform-u">
			<i class="la la-arrow-left"></i>{{ __('BACK') }}
		</a>
		<div class="dropdown dropdown-inline">
			<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-elevate btn-icon btn-sm btn-icon-sm">
				<i class="flaticon-more"></i>
			</button>
			<div x-placement="bottom-end" class="dropdown-menu dropdown-menu-right">
				<a href="{{ URL::signedRoute('admin.company.show', $event->owner->company->company_id)}}" class="dropdown-item kt-font-transform-u">{{ __('ESTABLISHMENT DETAILS') }}</a>
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
							<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>1</span>{{ __('EVENT DETAILS') }}</div>
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
							<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>3</span> {{ __('SUBMIT') }}</div>
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
																<section class="row">
																	<div class="col-md-6">
																			<label class="kt-font-dark">{{ __('Application Type') }}</label>
																		<div class="input-group input-group-sm">
																	<input value="{{ __(ucfirst($event->firm)) }}" name="no_of_trucks" readonly="readonly" type="text"
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
															<div class="col-6">
																<section class="kt-form kt-form--label-right ">
																    <div class="form-group form-group-sm  row">
																        <label class="col-11 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{ __('CHECK ALL EVENT DETAILS') }}</label>
																        <div class="col-1">
																            <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
																                <label>
																                    <input type="checkbox" id="checked-all-details" name="">
																                    <span></span>
																                </label>
																            </span>
																        </div>
																    </div>
																</section>
															</div>
														</div>
														<div class="row form-group form-group-sm">
															<div class="col-sm-6">
																	<label class="kt-font-dark">{{ __('Event Type') }} <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																	<input value="{{ ucfirst($event->type->name) }}" name="event_type" readonly="readonly" type="text"
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
																<label class="kt-font-dark">{{ __('Event Subcategory') }} </label>
																<div class="input-group input-group-sm">
																<input value="{{ ucfirst(Auth::user()->LanguageId == 1 ? $event->subType->sub_name_en : $event->subType->sub_name_ar) }}" name="event_type" readonly="readonly" type="text"
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
																<label class="kt-font-dark">{{ __('Event Name (EN)') }} <span class="text-danger">*</span></label>
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
																	<input dir="rtl" value="{{ ucfirst($event->name_ar) }}" name="name_ar" readonly="readonly" type="text" class="form-control">
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
																<label class="kt-font-dark">{{ __('Owner Name (EN)') }} <span class="text-danger">*</span></label>
																<div class="input-group input-group-sm">
																	<input value="{{ ucfirst($event->owner_name) }}" name="name_en" readonly="readonly" type="text" class="form-control">
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
																<label class="kt-font-dark">{{ __('Owner Name (AR)') }} <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																	<input dir="rtl" value="{{ ucfirst($event->owner_name_ar) }}" name="name_ar" readonly="readonly" type="text" class="form-control">
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
																	<label class="kt-font-dark">{{ __('Event Details') }} <span class="text-danger">*</span></label>
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
																	<label class="kt-font-dark">{{ __('Event Details (AR)') }} <span class="text-danger">*</span></label>
																	<div class="input-group input-group-sm">
																	<textarea dir="rtl" name="description_ar" rowspan="3" class="form-control" readonly>{{ ucfirst($event->description_ar) }}</textarea>
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
															<div class="card-body kt-font-dark">
                                                                <div class="row form-group form-group-sm">
                                                                    <div class="col-6"></div>
                                                                    <div class="col-6">
																		<section class="kt-form kt-form--label-right ">
																		    <div class="form-group form-group-sm  row">
																		        <label class="col-11 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{ __('CHECK ALL EVENT DATE DETAILS') }} </label>
																		        <div class="col-1">
																		            <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
																		                <label>
																		                    <input type="checkbox" id="checked-all-date" name="">
																		                    <span></span>
																		                </label>
																		            </span>
																		        </div>
																		    </div>
																		</section>
																	</div>
																	</div>
																	<div class="row form-group form-group-sm">
                                                                        <div class="col-4">
																			<label class="kt-font-dark">{{ __('Event Duration') }} <span class="text-danger">*</span></label>
																			<div class="input-group input-group-sm">
																			@php
                                                                                $date = Carbon\Carbon::parse($event->issued_date)->diffInDays($event->expired_date);
                                                                                $date = $date +1;
                                                                                $day = $date > 1 ? ' '.__('Days') : ' '.__('Day');
                                                                                // dd();
																			@endphp
																				<input value="{{ $date.$day }}" name="issued_date" readonly="readonly" type="text"
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
																		<div class="col-4">
																				<label class="kt-font-dark">{{ __('Start Date') }} <span class="text-danger">*</span></label>
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
																		<div class="col-4">
																				<label class="kt-font-dark">{{ __('End Date') }} <span class="text-danger">*</span></label>
																				<div class="input-group input-group-sm">
																					<input value="{{ date('d-F-Y', strtotime($event->expired_date)) }}" name="expired_date" readonly="readonly" type="text"
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
																		<div class="col-3 kt-hide">
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
																		<div class="col-3 kt-hide">
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
																	<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('FOOD TRUCK DETAILS') }}</h6>
															</div>
														</div>
														<div id="collapse-truck" class="collapse show" aria-labelledby="heading-truck" data-parent="#accordion-truck">
															<div class="card-body kt-font-dark">
																<section class="row form-group form-group-sm">
																	<div class="col-6">
																				<label class="kt-font-dark">{{ __('Number of Food Truck') }} <span class="text-danger">*</span></label>
																				<div class="input-group input-group-sm">
																					<input value="{{ $event->truck()->count() }}" name="time_end" readonly="readonly" type="text" class="form-control">
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
																		<section class="kt-form kt-form--label-right ">
																		    <div class="form-group form-group-sm  row">
																		        <label class="col-11 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{__('CHECK ALL EVENT FOOD TRUCK DETAILS')}}</label>
																		        <div class="col-1">
																		            <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
																		                <label>
																		                    <input type="checkbox" id="checked-all-truck" name="">
																		                    <span></span>
																		                </label>
																		            </span>
																		        </div>
																		    </div>
																		</section>
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
																						<label class="kt-font-dark">{{ __('Establishment Name') }} <span class="text-danger">*</span></label>
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
																					<label class="kt-font-dark">{{ __('Establishment Name (AR)') }} <span class="text-danger">*</span></label>
																					<div class="input-group input-group-sm">
																						<input dir="rtl" value="{{ $truck->company_name_ar }}" name="company_name_ar" readonly="readonly" type="text"
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
																						<label class="kt-font-dark">{{ __('Provided F & B') }} <span class="text-danger">*</span></label>
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
																					<label class="kt-font-dark">{{ __('Traffic Plate Number') }} <span class="text-danger">*</span></label>
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
																					<label class="kt-font-dark">{{ __('Registration Expiry Date') }} <span class="text-danger">*</span></label>
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
															<div class="card-body kt-font-dark">

                                                                <section class="row">
                                                                    <div class="col-6">
                                                                        @if ($event->liquor->provided)
                                                                            <p class=" kt-font-bold">
                                                                                <span class="kt-font-danger">{{ __('Note:') }}</span>
                                                                                {{__('Liquor will be provided by the venue.')}}
                                                                            </p>
                                                                        @else
                                                                            <p class=" kt-font-bold">
                                                                                <span class="kt-font-danger">{{ __('Note:') }}</span>
                                                                                {{__('Liquor was purchased from a licensed store.')}}
                                                                            </p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-6">
																		<section class="kt-form kt-form--label-right ">
																		    <div class="form-group form-group-sm  row">
																		        <label class="col-11 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{__('CHECK ALL EVENT LIQUOR DETAILS')}}</label>
																		        <div class="col-1">
																		            <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
																		                <label>
																		                    <input type="checkbox" id="checked-all-liquor" name="">
																		                    <span></span>
																		                </label>
																		            </span>
																		        </div>
																		    </div>
																		</section>
																	</div>
                                                                </section>

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
																					<input dir="rtl" value="{{ $event->liquor->company_name_ar }}" name="expired_date" readonly="readonly" type="text"
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
																	@if ($event->liquor->provided)
																	<div class="row form-group form-group-sm">
																	<div class="col-6">
																		<label class="kt-font-dark">{{ __('Liquor Permit Number') }} <span class="text-danger">*</span></label>
																				<div class="input-group input-group-sm">
																					<input value="{{ $event->liquor->liquor_permit_no }}" readonly="readonly" type="text"
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

																	@else
																	<div class="row form-group form-group-sm">
																		<div class="col-6">
																				<label class="kt-font-dark">{{ __('Liquor Service') }} <span class="text-danger">*</span></label>
																				<div class="input-group input-group-sm">
																					<input value="{{ $event->liquor->liquor_service }}" readonly="readonly" type="text"
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
																					<label class="kt-font-dark">{{ __('Liquor Types') }} <span class="text-danger">*</span></label>
																					<div class="input-group input-group-sm">
																						<input value="{{ $event->liquor->liquor_types }}" name="expired_date" readonly="readonly" type="text"
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
																					<label class="kt-font-dark">{{ __('Purchase Receipt Number') }} <span class="text-danger">*</span></label>
																					<div class="input-group input-group-sm">
																						<input value="{{ $event->liquor->purchase_receipt }}" name="expired_date" readonly="readonly" type="text"
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
																	@endif


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
																	<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('LOCATION AND MAP DETAILS') }}</h6>
															</div>
														</div>
														<div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
															<div class="card-body kt-font-dark">
																<div class="row form-group form-group-sm">
																	<div class="col-6"></div>
																	<div class="col-6">
																		<section class="kt-form kt-form--label-right ">
																		    <div class="form-group form-group-sm  row">
																		        <label class="col-11 col-form-label kt-font-dark kt-font-bold kt-font-transform-u">{{ __('CHECK ALL EVENT LOCATION DETAILS') }} </label>
																		        <div class="col-1">
																		            <span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
																		                <label>
																		                    <input type="checkbox" id="checked-all-address" name="">
																		                    <span></span>
																		                </label>
																		            </span>
																		        </div>
																		    </div>
																		</section>
																	</div>
																</div>
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
																					<input dir="rtl" value="{{ ucfirst($event->venue_ar) }}" name="venue_ar" readonly="readonly" type="text"
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
																		<div class="col-6">
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
																	</div>

																	<div class="row form-group form-group-sm">
																		<div class="col-md-6">
																			<label for="">{{__('Address')}} <span>*</span></label>
																			<textarea readonly rows="2" class="form-control form-control-sm">{{ucfirst($event->address)}}</textarea>
																		</div>
																		<div class="col-md-6">
																			<label for="">{{__('Additional Location Information')}}</label>
																			<textarea readonly rows="2" class="form-control form-control-sm">{{ucfirst($event->additional_location_info)}}</textarea>
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
											</section>

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
											<ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x " role="tablist">
											<li class="nav-item">
												<a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_1_3_tab_content" role="tab">
													{{__('EVENT ATTACHMENT')}} <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->eventRequirement()->count()}}</span>
												</a>
											</li>
											@if ($event->liquor()->count() > 0)
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_3_tab_content" role="tab">
														{{__('LIQUOR ATTACHMENT')}} <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->liquor()->count()}}</span>
													</a>
												</li>
											@endif

											@if ($event->truck()->count() > 0)
												<li class="nav-item">
													<a class="nav-link" data-toggle="tab" href="#food-truck-tab" role="tab">
														{{__('FOOD TRUCK ATTACHMENT')}}
														<span class="kt-badge kt-badge--outline kt-badge--info">{{$event->truck()->count()}}</span></span>
													</a>
												</li>
											@endif

											{{-- @if ($event->otherUpload()->count() > 0) --}}
											<li class="nav-item">
												<a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_3_3_tab_content" role="tab">
													{{__('EVENT IMAGES')}} <span class="kt-badge kt-badge--outline kt-badge--info">{{$event->otherUpload()->count()}}</span>
												</a>
											</li>
											{{-- @endif --}}
											</ul>
											<div class="tab-content">
											<div class="tab-pane active" id="kt_portlet_base_demo_1_3_tab_content" role="tabpanel">
													<table class="table border borderless table-hover table-sm" id="requirement-table">
													<thead>
														<tr>
																<th>{{ __('DOCUMENT NAME') }}</th>
																<th>{{ __('NO. OF FILES') }}</th>
																<th>{{ __('ISSUED DATE') }}</th>
																<th>{{ __('EXPIRY DATE') }}</th>
																<th>{{ __('ACTION') }}</th>
														</tr>
													</thead>
													</table>
											</div>
											<div class="tab-pane" id="food-truck-tab" role="tabpanel">
												<table class="table table-hover table-borderless table-sm border table-striped" id="truck-table">
													<thead>
														<tr>
																<th>#</th>
																<th>{{ __('ESTABLISHMENT NAME') }}</th>
																<th>{{ __('PROVIDED F & B') }}</th>
																<th>{{ __('TRAFFIC PLATE NUMBER') }}</th>
																<th>{{ __('ACTION') }}</th>
														</tr>
													</thead>
													</table>
											</div>

											<div class="tab-pane" id="kt_portlet_base_demo_2_3_tab_content" role="tabpanel">
												<table class="table border borderless table-hover table-sm" id="liquor-table">
													<thead>
														<tr>
																<th>{{ __('DOCUMENT NAME') }}</th>
																<th>{{ __('NO. OF FILES') }}</th>
																<th>{{ __('ISSUED DATE') }}</th>
																<th>{{ __('EXPIRY DATE') }}</th>
																<th>{{ __('ACTION') }}</th>
														</tr>
													</thead>
													</table>
											</div>
											<div class="tab-pane" id="kt_portlet_base_demo_3_3_tab_content" role="tabpanel">
												<table class="table border borderless table-hover table-sm" id="image-table">
													<thead>
														<tr>
															<th>{{ __('NO. OF FILES') }}</th>
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

												{{-- CHECKED HISTORY --}}
												@if($event->comment()->exists())
												<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-check-history">
												<div class="card">
													<div class="card-header" id="heading-check-history">
														<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-check-history" aria-expanded="true" aria-controls="collapse-check-history">
															<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Action History') }}</h6>
														</div>
														</div>
														<div id="collapse-check-history" class="collapse show" aria-labelledby="heading-check-history" data-parent="#accordion-check-history">

														<div class="card-body">
															<table class="table table-head-noborder table-borderless table-striped border no-footer dataTable" id="checked-history-table">
																<thead>
																	<tr>
																			<th>{{ __('NAME') }}</th>
																			<th>{{ __('REMARKS') }}</th>
																			<th>{{ __('DATE') }}</th>
																			<th>{{ __('ACTION TAKEN') }}</th>
																	</tr>
																</thead>
																</table>
														</div>
													</div>
												</div>
												</section>
												@endif

												{{-- ACTION --}}
												<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-action">
												<div class="card">
													<div class="card-header" id="heading-action">
														<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-action" aria-expanded="true" aria-controls="collapse-action">
															<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Select Action') }}</h6>
														</div>
														</div>
														<div id="collapse-action" class="collapse show" aria-labelledby="heading-action" data-parent="#accordion-action">

														@if(!Auth::user()->roles()->whereIn('roles.role_id', [4, 5])->exists())
														<div class="card-body">
															<section class="row">
																<div class="col-md-12">
																	<div class="form-group row form-group-sm">
																		<div class="col-12">
																			<div class="kt-radio-inline">
																				<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
																					<input value="approved-unpaid" type="radio" name="status"> {{ __('Approve Application') }}
																					<span></span>
																				</label>
																				<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
																					<input value="need modification" type="radio" name="status"> {{ __('Bounce Back Application for Ammendments') }}
																					<span></span>
																				</label>
																				<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
																					<input value="need approval" type="radio" name="status"> {{ __('Application Need Approval') }}
																					<span></span>
																				</label>
																				<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
																					<input value="rejected" type="radio" name="status"> {{ __('Reject Application') }}
																					<span></span>
																				</label>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group form-group kt-hide">
																		<label for="" class="kt-font-dark">{{ __('Approvers') }} <span class="text-danger">*</span></label>
																		<select disabled required id="select-approver" name="approver[]" multiple="multiple" id="" class="form-control">
																						@if($role = App\Roles::where('Type', 0)->where('NameEn', '!=', 'admin')->where('NameEn', '!=', 'admin assistant')
																						->count() > 0)
																							@foreach(App\Roles::where('Type', 0)->where('NameEn', '!=', 'admin')->where('NameEn', '!=', 'admin assistant')
																						->get() as $role)
																								{{-- SHOW ONLY INSPECTOR AND MANGER --}}
																								{{-- @if($role->role_id != 6) --}}
																									<option value="{{ $role->role_id }}">{{ ucwords($role->NameEn) }}</option>
																								{{-- @endif --}}
																							@endforeach
																						@endif
																			</select>
																	</div>
																	{{-- <div class="form-group form-group kt-hide">
																		<div class="kt-checkbox-inline">
																			<label class="kt-checkbox">
																				<input type="checkbox" id="site-inspection" name="inspection"> {{ __('Site Inspection Required') }}
																				<span></span>
																			</label>
																		</div>
																	</div> --}}
																</div>
																<div class="col-md-6">
																	<div class="form-group form-group kt-hide">
																		<label for="" class="kt-font-dark">{{ __('Government Entities') }} <span class="text-danger">*</span></label>
																		<select disabled required id="select-department" name="department[]" multiple="multiple" id="" class="form-control">
																			@if(App\Government::has('getUsers')->count() > 0)
																			@foreach(App\Government::has('getUsers')->get() as $gov)
																			<option value="{{ $gov->government_id }}">{{ Auth::user()->LanguageId == 1 ? ucwords($gov->government_name_en) : $gov->government_name_ar }}</option>
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
																		<textarea dir="ltr" disabled name="note_en" rowspan="3" class="form-control form-control-sm"></textarea>
																	</div>
																</div>
																<div class="col-sm-6">
																	<div class="form-group-sm">
																		<label>{{ __('Note (AR)') }}</label>
																		<textarea dir="rtl" disabled name="note_ar" rowspan="3" class="form-control form-control-sm"></textarea>
																	</div>
																</div>
															</section>

														</div>
														@endif

														{{-- ADD BY DONSKIE --}}
														@if(Auth::user()->roles()->whereIn('roles.role_id', [4, 5])->exists())
														<div class="card-body">
															<section class="row">
																<div class="col-md-12">
																	<div class="form-group row form-group-sm">
																		<div class="col-12">
																			<div class="kt-radio-inline">
																				<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
																					<input value="approved" type="radio" name="status"> {{ __('Approve Application') }}
																					<span></span>
																				</label>
																				<label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
																					<input value="rejected" type="radio" name="status"> {{ __('Reject Application') }}
																					<span></span>
																				</label>
																			</div>
																		</div>
																	</div>
																</div>
															</section>
														</div>
														@endif
													</div>
												</div>
												</section>
												<section class="accordion kt-hide kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-requirements">
												<div class="card">
													<div class="card-header" id="heading-requirements">
														<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-requirements" aria-expanded="true" aria-controls="collapse-requirements">
															<h6><span class="kt-font-bolder kt-font-transform-u kt-font-dark">{{ __('ADDITIONAL ATTACHMENT') }}</span>
																<small class="text-muted">{{ __('Add additional attachment to display in the client uplaods.') }}</small>
															</h6>
														</div>
														</div>
														<div id="collapse-requirements" class="collapse show" aria-labelledby="heading-requirements" data-parent="#accordion-requirements">
														<div class="card-body">
                                                            <div v-if="show" class="alert alert-outline-danger kt-margin-b-5 kt-padding-b-5 kt-padding-t-5 fade show" role="alert">
                                                                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                                            <div class="alert-text">{{__('You can only add maximum of 10 additional attachment.')}}</div>

                                                            </div>
                                                            <div class="form-group form-group-xs">
                                                                <button @click="add" class="btn btn-sm btn-warning kt-font-transform-u kt-font-dark" type="button">
                                                                    <span class="la la-plus"></span>
                                                                   {{ __('ADD') }}
                                                                </button>
                                                            </div>
                                                            <table class="table table-borderless table-hover border table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="no-wrap">#</th>
                                                                        <th>{{ __('DOCUMENT NAME') }}</th>
                                                                        <th>{{ __('DESCRIPTION') }}</th>
                                                                        <th class="no-wrap"></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="(requirement, index) in requirements" :key="index">
                                                                        <td class="text-center">@{{ index+1 }}</td>
                                                                        <td>
                                                                            <div class="form-group form-group-xs">
                                                                                <input v-model="requirement.name_en" :name="`requirements[${index}][requirement_name]`" type="text" class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group form-group-xs">
                                                                                <input :name="`requirements[${index}][requirement_description]`"  v-model="requirement.description_en" type="text" class="form-control" autocomplete="off">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group form-group-xs">
                                                                               <button tabindex="-1" type="button" @click="remove(index)" class="btn btn-sm btn-clean btn-secondary"><span class="la la-times text-danger"></span></button>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
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
								<th>{{ __('EXPIRY DATE') }}</th>
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
	new Vue({
        el: '#app-wizard',
        data: {
            show: false,
            comment: null,
            requirements: [
                {name_en: null, description_en: null, name_ar: null, description_ar: null }
            ]
        },
        methods: {
            add: function(){
                if(this.requirements.length < 10){
                    this.show = false;
                    this.requirements.push({name_en: null, description_en: null, name_ar: null, description_ar: null });
                }
                else{
                    this.show = true;
                }
            },
            remove: function(index){
                this.show = false;
                this.$delete(this.requirements, index);
            }
        },
        });

	$(document).ready(function () {
		checkAll();

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
	imageTable();

	@if($event->comment()->exists())
	commentHistory();
	@endif
	});

	function imageTable(){
	$('table#image-table').DataTable({
		ajax: '{{ route('admin.event.images.datatable', $event->event_id) }}',
		columns:[
		{data: 'path'}
		]
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

	function commentHistory(){
	$('table#checked-history-table').DataTable({
		ajax:{
			url: '{{ route('admin.event.comment', $event->event_id) }}',
		},
		lengthChange: false,
		filter: false,
		columnDefs:[{target:'_all', className: 'no-wrap'}],
		responsive: true,
		columns: [
			{data: 'name'},
			{data: 'comment'},
			{data: 'date'},
			{data: 'action_taken'},
		]
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
					{targets: [1,2,3,4], className: 'no-wrap'},
				],
				"order": [[ 0, 'asc' ]],
				rowGroup: {
				startRender: function ( rows, group ) {
					var row_data = rows.data()[0];
					return $('<tr/>').append( '<td>'+group+'</td>' )
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

	var form = $('form#kt_form').validate({
        invalidHandler: function (event, validator) {
		KTUtil.scrollTop();
		},
		rules: {
		status: {required: true},
		},
		messages: {
		status: 'Please select an action.'
		},

	});

    $('form#kt_form').submit(function(e){
        var note = $(this).find('textarea[name=comment]').val().trim().length;
            if(form.valid() && (note != 0)){
                KTApp.block('.kt-portlet', {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: 'Please wait...'
                });
            }
        });

	var approver = $('select#select-approver');
	var departmentsSelect2 = $('select#select-department');

	approver.change(function(){
		var val = $(this).val();
		if(val.indexOf('4') > -1){
			$('input#site-inspection').parents('.form-group').removeClass('kt-hide');
		}
		else{
			$('input#site-inspection').parents('.form-group').addClass('kt-hide');
			$('input#site-inspection').removeAttr('checked', true);
			$('input#site-inspection').prop('checked', false);
		}

		if(val.indexOf('6') > -1){
			$('select#select-department').val('').trigger('change');
			$('select#select-department').parents('.form-group').removeClass('kt-hide');
			$('select#select-department').removeAttr('disabled', true);
		}
		else{
			$('select#select-department').parents('.form-group').addClass('kt-hide');
			$('select#select-department').attr('disabled', true);
		}
	});

	approver.select2({
		minimumResultsForSearch: 'Infinity',
		placeholder: 'Select Approver',
		autoWidth: true,
		width: '100%',
		allowClear: true,
		tags: true
	});

	departmentsSelect2.select2({
		minimumResultsForSearch: 'Infinity',
		placeholder: 'Select Government Department',
		autoWidth: true,
		width: '100%',
		allowClear: true,
		tags: true
	});

	$('input[name=status][type=radio]').change(function(){
		if($(this).val() == 'need modification'){
			$('#accordion-requirements').removeClass('kt-hide');
			// additionalRequirementTable();
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
			$('input#site-inspection').parents('.form-group').addClass('kt-hide');
			$('select#select-department').val('').trigger('change');
			$('select#select-approver').val('').trigger('change');
			$('select#select-department').parents('.form-group').addClass('kt-hide');
			$('select#select-department').attr('disabled', true);
		}
	});


	$('form#kt_form').submit(function(e){
		var status  = $(this).find('input[type=radio][name=status]:checked').val();
		if(status != 'approved-unpaid' && $(this).find('textarea[name=comment]').val() == '' ){
		$(this).find('textarea[name=comment]').addClass('is-invalid');
			e.preventDefault();
            KTUtil.scrollTop();
            $(this).find('textarea[name=comment]').focus();
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
                KTUtil.scrollTop();
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

function checkAll(){
	$('input[type=checkbox]#checked-all-details').change(function(){ checkedAttr($(this)); });
	$('input[type=checkbox]#checked-all-date').change(function(){ checkedAttr($(this)); });
	$('input[type=checkbox]#checked-all-address').change(function(){ checkedAttr($(this)); });
	$('input[type=checkbox]#checked-all-truck').change(function(){ checkedAttr($(this)); });
	$('input[type=checkbox]#checked-all-liquor').change(function(){ checkedAttr($(this)); });
}

function checkedAttr(obj) {
	if($(obj).is(':checked')){
		$(obj).parents('.card-body').find('input[type=checkbox]').attr('checked', true);
		$(obj).parents('.card-body').find('input[type=text]').addClass('is-valid').removeClass('is-invalid');
		$(obj).parents('.card-body').find('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');

	}
	else{
		$(obj).parents('.card-body').find('input[type=checkbox]').removeAttr('checked', true);
		$(obj).parents('.card-body').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
		$(obj).parents('.card-body').find('label').removeClass('kt-checkbox--success').addClass('kt-checkbox--default');
	}

}
</script>
@stop
