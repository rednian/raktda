@extends('layouts.admin.admin-app')
@section('style')
	 <link href="{{ asset('/assets/css/wizard-3.css') }}" rel="stylesheet" type="text/css"/>
	 <style>
			@media (min-width: 1024px){
				  .modal-lg, .modal-xl { max-width: none; }
				 .modal-dialog{ overflow-y: initial !important; margin: 0 0 0 1%}
				 .modal-body{  	height: calc(100vh - 130px);  overflow-y: auto;  }
			}
	 </style>
@stop
@section('content')
	 <div id="app-wizard" class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ ucwords($event->name_en) }}- application</span></h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-maroon btn-elevate kt-margin-r-4 kt-font-transform-u"><i class="la la-arrow-left"></i>
							 back to event list
						</a>
						<div class="dropdown dropdown-inline">
							 <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-elevate btn-icon btn-sm btn-icon-sm">
									<i class="flaticon-more"></i>
							 </button>
							 <div x-placement="bottom-end" class="dropdown-menu dropdown-menu-right">
									<a href="javascript:void(0)" class="dropdown-item kt-font-transform-u">Company Information</a></div>
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
													 <div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>1</span>Event Information</div>
													 <div class="kt-wizard-v3__nav-bar"></div>
												</div>
										 </a> <a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending" class="kt-wizard-v3__nav-item">
												<div class="kt-wizard-v3__nav-body">
													 <div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>2</span></div>
													 <div class="kt-wizard-v3__nav-bar"></div>
												</div>
										 </a> <a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending" class="kt-wizard-v3__nav-item">
												<div class="kt-wizard-v3__nav-body">
													 <div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>3</span></div>
													 <div class="kt-wizard-v3__nav-bar"></div>
												</div>
										 </a></div>
							 </div>
						</div>
						<div class="kt-grid__item kt-grid__item--fluid kt-wizard-v3__wrapper">
							 <form id="kt_form" novalidate="novalidate" action="http://raktda.test/artist_permit/404/application/257/checklist" method="post" class="kt-form">
									<div data-ktwizard-type="step-content" data-ktwizard-state="current" class="kt-wizard-v3__content">
										 <div class="kt-form__section kt-form__section--first">
												<div class="kt-wizard-v3__form">
													 <section class="row">
															<div class="col kt-margin-t-20 kt-margin-b-20">
																 @include('admin.artist_permit.includes.comment')
																 <div class="alert alert-outline-danger fade show" role="alert">
{{--																		<div class="alert-icon"><i class="flaticon-warning"></i></div>--}}
																		<div class="alert-text">
																			 <h6 class="alert-heading text-danger kt-font-transform-u">Important</h6>
																			 <p>
																					 The venue of this event has/have 3 active event.
																			 </p>
																			 <hr>
																			 <button type="button" data-target="#event-exist-modal" data-toggle="modal" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">Show Event Calendar</button>
																			 <button type="button" class="btn btn-sm btn-secondary  kt-font-transform-u" data-dismiss="alert" aria-label="Close">Close</button>
																		</div>
																 </div>
																 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-detail">
																		<div class="card">
																			 <div class="card-header" id="heading-detail">
																					<div class="card-title" data-toggle="collapse" data-target="#collapse-detail" aria-expanded="true"
																							 aria-controls="collapse-detail">
																						 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> Event Details</h6>
																					</div>
																			 </div>
																			 <div id="collapse-detail" class="collapse show" aria-labelledby="heading-detail" data-parent="#accordion-detail">
																					<div class="card-body">
																						 <div class="row form-group form-group-sm">
																								<div class="col-md-6">
																									 <label>Event Name <span class="text-danger">*</span></label>
																									 <div class="input-group input-group-sm">
																											<input value="{{ ucfirst($event->name_en) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append ">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="check[firstname]" value="Akshay" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-md-6">
																									 <label>Event Name (AR) <span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->name_ar) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="event_name" value="Akshay" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																						 </div>
																						 <div class="row form-group form-group-sm">
																								<div class="col-md-6">
																									 <label>Event Type <span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->type->name_en) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="check[firstname]" value="Akshay" type="checkbox">
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
																					<div class="card-title" data-toggle="collapse" data-target="#collapse-date" aria-expanded="true"
																							 aria-controls="collapse-date">
																						 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">Date Details</h6>
																					</div>
																			 </div>
																			 <div id="collapse-date" class="collapse show" aria-labelledby="heading-date" data-parent="#accordion-date">
																					<div class="card-body">
																						 <div class="row form-group form-group-sm">
																								<div class="col-3">
																									 <label>Date Start<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ $event->issued_date }}" readonly="readonly" type="text"
																														 class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-3">
																									 <label>Date End<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ $event->expired_date }}" readonly="readonly" type="text"
																														 class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-3">
																									 <label>Time Start<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ $event->time_start }}" readonly="readonly" type="text"
																														 class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-3">
																									 <label>Time Start<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ $event->time_end }}" readonly="readonly" type="text"
																														 class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
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
																					<div class="card-title" data-toggle="collapse" data-target="#collapse-address" aria-expanded="true"
																							 aria-controls="collapse-address">
																						 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">Location Details</h6>
																					</div>
																			 </div>
																			 <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
																					<div class="card-body">
																						 <div class="row form-group form-group-sm">
																								<div class="col-6">
																									 <label>Venue<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->venue_en) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-6">
																									 <label>Venue (AR)<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->venue_ar) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																						 
																						 </div>
																						 <div class="row form-group form-group-sm">
																								<div class="col-3">
																									 <label>Address<span class="text-danger">*</span></label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->address) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-3">
																									 <label>Area</label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->area->area_en) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-3">
																									 <label>Emirate</label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->emirate->name_en) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
																															 <span></span>
																														</label>
																												 </span>
																											</div>
																									 </div>
																								</div>
																								<div class="col-3">
																									 <label>Country</label>
																									 <div class="input-group">
																											<input value="{{ ucfirst($event->country->name_en) }}" readonly="readonly" type="text" class="form-control">
																											<div class="input-group-append">
																												 <span class="input-group-text">
																														<label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
																															 <input data-step="step-1" name="chec" type="checkbox">
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
																 <section class=" kt-margin-t-10">
																		<div class="col-md-12">
																			  <button type="submit" name="status" value="approve" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u btn-wide">Approve</button>
																			  <button type="submit" name="status" value="reject" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u btn-wide">Reject</button>
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
																 <div class="form-group"><textarea maxlength="255" name="comment" id="" rows="3" placeholder="Remarks for company..."
																																	 class="form-control form-control-sm"></textarea>
																		<div id="memo-error" class="error invalid-feedback">Reason for disapproving the artist is required.</div>
																		<div id="memo-error1" class="error invalid-feedback d-none">The comment should not be longer than 255 character.</div>
																 </div>
																 <div class="table-responsive-sm">
																		<div id="document-table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
																			 <div class="row">
																					<div class="col-sm-12 col-md-6">
																						 <div class="dataTables_length" id="document-table_length"><label><select name="document-table_length"
																																																											aria-controls="document-table"
																																																											class="custom-select custom-select-sm form-control form-control-sm">
																											<option value="5">5</option>
																											<option value="10">10</option>
																											<option value="25">25</option>
																											<option value="50">50</option>
																											<option value="100">100</option>
																									 </select> </label></div>
																					</div>
																					<div class="col-sm-12 col-md-6">
																						 <div id="document-table_filter" class="dataTables_filter"><label><input type="search"
																																																										 class="form-control form-control-sm"
																																																										 placeholder="Search..."
																																																										 aria-controls="document-table"></label></div>
																					</div>
																			 </div>
																			 <div class="row">
																					<div class="col-sm-12">
																						 <table id="document-table" class="table table-hover table-borderless table-striped dataTable no-footer" role="grid"
																										aria-describedby="document-table_info" style="width: 0px;">
																								<thead class="thead-dark">
																								<tr role="row">
																									 <th class="sorting_asc" tabindex="0" aria-controls="document-table" rowspan="1" colspan="1" aria-sort="ascending"
																											 aria-label="Document Name: activate to sort column descending" style="width: 0px;">Document Name
																									 </th>
																									 <th class="sorting" tabindex="0" aria-controls="document-table" rowspan="1" colspan="1"
																											 aria-label="Issued Date: activate to sort column ascending" style="width: 0px;">Issued Date
																									 </th>
																									 <th class="sorting" tabindex="0" aria-controls="document-table" rowspan="1" colspan="1"
																											 aria-label="Expiry Date: activate to sort column ascending" style="width: 0px;">Expiry Date
																									 </th>
																									 <th class="no-wrap sorting_disabled" rowspan="1" colspan="1" aria-label="Action" style="width: 0px;">Action</th>
																								</tr>
																								</thead>
																								<tbody>
																								<tr role="row" class="odd">
																									 <td class="sorting_1"><a href="http://raktda.test/storage/nrs_infoways/artist_permit/262/photos/thumb_1.jpg"
																																						data-fancybox="" data-caption="Akshay Kumar - Photo">Artist Photo</a></td>
																									 <td>Not Required</td>
																									 <td>Not Required</td>
																									 <td class=" no-wrap"><label class="kt-checkbox kt-checkbox--single kt-checkbox--default"><input type="checkbox"
																																																																									 class="step-2"
																																																																									 data-step="2"
																																																																									 name="Akshay Kumar"><span></span></label>
																									 </td>
																								</tr>
																								</tbody>
																						 </table>
																						 <div id="document-table_processing" class="dataTables_processing card" style="display: none;">
																								<div class="kt-spinner spinner-border kt-spinner-danger"></div>
																						 </div>
																					</div>
																			 </div>
																			 <div class="row">
																					<div class="col-sm-12 col-md-5">
																						 <div class="dataTables_info" id="document-table_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div>
																					</div>
																					<div class="col-sm-12 col-md-7">
																						 <div class="dataTables_paginate paging_simple_numbers" id="document-table_paginate">
																								<ul class="pagination">
																									 <li class="paginate_button page-item previous disabled" id="document-table_previous"><a href="#"
																																																																					 aria-controls="document-table"
																																																																					 data-dt-idx="0"
																																																																					 tabindex="0"
																																																																					 class="page-link"><i
																														 class="la la-angle-left"></i></a></li>
																									 <li class="paginate_button page-item next disabled" id="document-table_next"><a href="#"
																																																																	 aria-controls="document-table"
																																																																	 data-dt-idx="1" tabindex="0"
																																																																	 class="page-link"><i
																														 class="la la-angle-right"></i></a></li>
																								</ul>
																						 </div>
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
																 <div class="form-group"><textarea maxlength="255" name="comment" id="" rows="3" placeholder="Remarks for company..."
																																	 class="form-control form-control-sm"></textarea>
																		<div id="memo-error" class="error invalid-feedback">Reason for disapproving the artist is required.</div>
																		<div id="memo-error1" class="error invalid-feedback d-none">The comment should not be longer than 255 character.</div>
																 </div>
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
														 class="btn btn-elevate btn-maroon kt-font-bold  btn-sm kt-font-bold btn-wide kt-font-transform-u">Next
										 </button>
										 <div data-ktwizard-type="action-submit" class="dropdown">
												<button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
																class="btn btn-warning btn-sm btn-wide kt-font-bold kt-font-transform-u dropdown-toggle">
													 Take action &amp; finish
												</button>
												<div aria-labelledby="dropdownMenuButton" x-placement="bottom-start" class="dropdown-menu">
													 <button type="submit" name="artist_permit_status" value="approved" class="dropdown-item">Approve Artist</button>
													 <button type="submit" name="artist_permit_status" value="disapproved" class="dropdown-item">Disapprove Artist</button>
												</div>
										 </div>
									</div>
							 </form>
						</div>
				 </div>
			</div>
	 </div>
	  @include('admin.event.includes.existing-event-modal')
@stop
@section('script')
	 <script>
			$(document).ready(function () {
			     var todayDate = moment().startOf('day');
            var YM = todayDate.format('YYYY-MM');
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = todayDate.format('YYYY-MM-DD');
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
               plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
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
                    dayGridMonth: { buttonText: 'Month' },
                    timeGridWeek: { buttonText: 'Week' },
                    timeGridDay: { buttonText: 'Day' },
                    listWeek: { buttonText: 'List' }
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,

                editable: true,
                eventLimit: true, // allow "more" link when too many events
                navLinks: true,
                // events: [
                //     {
                //         title: 'All Day Event',
                //         start: YM + '-01',
                //         description: 'Toto lorem ipsum dolor sit incid idunt ut',
                //         className: "fc-event-danger fc-event-solid-warning"
                //     },
                //     {
                //         title: 'Reporting',
                //         start: YM + '-14T13:30:00',
                //         description: 'Lorem ipsum dolor incid idunt ut labore',
                //         end: YM + '-14',
                //         className: "fc-event-success"
                //     },
                //     {
                //         title: 'Company Trip',
                //         start: YM + '-02',
                //         description: 'Lorem ipsum dolor sit tempor incid',
                //         end: YM + '-03',
                //         className: "fc-event-primary"
                //     },
                //     {
                //         title: 'ICT Expo 2017 - Product Release',
                //         start: YM + '-03',
                //         description: 'Lorem ipsum dolor sit tempor inci',
                //         end: YM + '-05',
                //         className: "fc-event-light fc-event-solid-primary"
                //     },
                //     {
                //         title: 'Dinner',
                //         start: YM + '-12',
                //         description: 'Lorem ipsum dolor sit amet, conse ctetur',
                //         end: YM + '-10'
                //     },
                //     {
                //         id: 999,
                //         title: 'Repeating Event',
                //         start: YM + '-09T16:00:00',
                //         description: 'Lorem ipsum dolor sit ncididunt ut labore',
                //         className: "fc-event-danger"
                //     },
                //     {
                //         id: 1000,
                //         title: 'Repeating Event',
                //         description: 'Lorem ipsum dolor sit amet, labore',
                //         start: YM + '-16T16:00:00'
                //     },
                //     {
                //         title: 'Conference',
                //         start: YESTERDAY,
                //         end: TOMORROW,
                //         description: 'Lorem ipsum dolor eius mod tempor labore',
                //         className: "fc-event-brand"
                //     },
                //     {
                //         title: 'Meeting',
                //         start: TODAY + 'T10:30:00',
                //         end: TODAY + 'T12:30:00',
                //         description: 'Lorem ipsum dolor eiu idunt ut labore'
                //     },
                //     {
                //         title: 'Lunch',
                //         start: TODAY + 'T12:00:00',
                //         className: "fc-event-info",
                //         description: 'Lorem ipsum dolor sit amet, ut labore'
                //     },
                //     {
                //         title: 'Meeting',
                //         start: TODAY + 'T14:30:00',
                //         className: "fc-event-warning",
                //         description: 'Lorem ipsum conse ctetur adipi scing'
                //     },
                //     {
                //         title: 'Happy Hour',
                //         start: TODAY + 'T17:30:00',
                //         className: "fc-event-info",
                //         description: 'Lorem ipsum dolor sit amet, conse ctetur'
                //     },
                //     {
                //         title: 'Dinner',
                //         start: TOMORROW + 'T05:00:00',
                //         className: "fc-event-solid-danger fc-event-light",
                //         description: 'Lorem ipsum dolor sit ctetur adipi scing'
                //     },
                //     {
                //         title: 'Birthday Party',
                //         start: TOMORROW + 'T07:00:00',
                //         className: "fc-event-primary",
                //         description: 'Lorem ipsum dolor sit amet, scing'
                //     },
                //     {
                //         title: 'Click for Google',
                //         url: 'http://google.com/',
                //         start: YM + '-28',
                //         className: "fc-event-solid-info fc-event-light",
                //         description: 'Lorem ipsum dolor sit amet, labore'
                //     }
                // ],

                // eventRender: function(info) {
                //     var element = $(info.el);
								//
                //     if (info.event.extendedProps && info.event.extendedProps.description) {
                //         if (element.hasClass('fc-day-grid-event')) {
                //             element.data('content', info.event.extendedProps.description);
                //             element.data('placement', 'top');
                //             KTApp.initPopover(element);
                //         } else if (element.hasClass('fc-time-grid-event')) {
                //             element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                //         } else if (element.find('.fc-list-item-title').lenght !== 0) {
                //             element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                //         }
                //     }
                // }
            });

            calendar.render();
            updateLock();
      });
			
			function updateLock() {
			   setInterval(function(){
			      $.ajax({
							 url: '{{ route('admin.event.lock', $event->event_id) }}',
							 data: { active: true }
						});
				 }, 5000);
      }
	 </script>
@stop