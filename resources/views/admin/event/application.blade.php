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
		 	<a href="{{ route('admin.event.index') }}" class="btn btn-sm btn-maroon btn-elevate kt-margin-r-4 kt-font-transform-u">
		 		<i class="la la-arrow-left"></i>
		 		back to event list
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
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>1</span>Event Information</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
						<a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending" class="kt-wizard-v3__nav-item">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>2</span>Uploaded Requirements</div>
								<div class="kt-wizard-v3__nav-bar"></div>
							</div>
						</a>
						 <a href="javascript:void(0)" data-ktwizard-type="step" data-ktwizard-state="pending" class="kt-wizard-v3__nav-item">
							<div class="kt-wizard-v3__nav-body">
								<div class="kt-wizard-v3__nav-label  text-center kt-font-transform-u"><span>3</span>Event Approvers</div>
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
															<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> Event Details</h6>
														</div>
													 </div>
													 <div id="collapse-detail" class="collapse show" aria-labelledby="heading-detail" data-parent="#accordion-detail">
														<div class="card-body">
															<div class="row form-group form-group-sm">
																<div class="col-md-6">
																	<label>Event Name <span class="text-danger">*</span></label>
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
																</div>
																<div class="col-md-6">
																	<label>Event Name (AR) <span class="text-danger">*</span></label>
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
																	 <label>Event Type <span class="text-danger">*</span></label>
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
																	 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">Date Details</h6>
																</div>
														 </div>
														 <div id="collapse-date" class="collapse show" aria-labelledby="heading-date" data-parent="#accordion-date">
																<div class="card-body">
																	 <div class="row form-group form-group-sm">
																			<div class="col-3">
																				 <label>Date Start<span class="text-danger">*</span></label>
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
																				 <label>Date End<span class="text-danger">*</span></label>
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
																				 <label>Time Start<span class="text-danger">*</span></label>
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
																				 <label>Time Start<span class="text-danger">*</span></label>
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
																	 <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">Location Details</h6>
																</div>
														 </div>
														 <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
																<div class="card-body">
																	 <div class="row form-group form-group-sm">
																			<div class="col-6">
																				 <label>Venue<span class="text-danger">*</span></label>
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
																				 <label>Venue (AR)<span class="text-danger">*</span></label>
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
																				 <label>Address<span class="text-danger">*</span></label>
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
																				 <label>Area</label>
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
																				 <label>Emirate</label>
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
																				 <label>Country</label>
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
												 @include('admin.artist_permit.includes.comment')
												 <table class="table table-striped table-light--warning" id="requirement-table">
														<thead class="thead-dark">
														<tr>
															 <th>Requirement Name</th>
															 <th>Issued Date</th>
															 <th>Expired Date</th>
															 <th>Action</th>
														</tr>
														</thead>
												 </table>
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
												  @include('admin.artist_permit.includes.comment')
												 <section class="kt-form kt-form--label-right1">
														<div class="form-group form-group-sm row">
															 <label class="col-lg-2 col-form-label">Action <span class="text-danger">*</span></label>
															 <div class="col-lg-5">
																	<select name="status" id="" class="form-control custom-select" required>
																		 <option selected disabled>Select Action</option>
																		 <option value="approved-unpaid">Approve Application</option>
																		 <option value="need approval">Need Approval</option>
																		 <option value="need modification">Send back for Amendments</option>
																		 <option value="rejected">Reject Application</option>
																	</select>
															 </div>
														</div>
														<div class="form-group row kt-hide">
															 <label class="col-lg-2 col-form-label">Approvers <span class="text-danger">*</span></label>
															 <div class="col-lg-5">
																	<select id="select-approver" name="approver[]" multiple="multiple" id="" class="form-control">
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
								<button type="submit" class="btn btn-warning btn-sm  kt-font-bold kt-font-transform-u">Submit</button>
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
			new Vue({
				el: '#app-wizard',
				data: {
				  comment: null
				}
			});
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
       updateLock();
       eventDetails();
       wizard();
       requirementTable();
       formSubmit();
     });

     
     function formSubmit() {
       var approver = $('select#select-approver');
       
       //show or hide the approver selection
       $('select[name=status]').change(function () {
		 if($(this).val() == 'need approval') { approver.parents('.form-group').removeClass('kt-hide'); }
		 else{ approver.parents('.form-group').addClass('kt-hide'); }
       });
       
       approver.select2({
		 minimumResultsForSearch: 'Infinity',
		 placeholder: 'Select Approver',
		 autoWidth: true,
		 width: '100%',
		 allowClear: true,
		 tags: true
       });
       
       
       // $('button[name=status]').click(function () {
				//  if($(this).val() == 'rejected'){
				//    $('form#kt_form').validate({
				// 		 rules:{
				// 		   comment: {
				// 		     required: true
				// 			 }
				// 		 }
				// 	 });
				//  }
       // });
     }
     
     function requirementTable(){
       $('table#requirement-table').DataTable({
				 ajax: {
				   url: '{{ route('admin.event.applicationDatatable',  $event->event_id) }}',
					  data: function(d){},
				 },
				 columnDefs:[
					 {targets: [3], className: 'no-wrap'}
				 ],
				 columns:[
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
				 ]
			 });
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
     	$('form#kt_form').submit(function(){
     	var validator = $('form#kt_form').validate();
     		validator.element('select[name=status]');
     	});
     	
     	// $('form#kt_form').validate({
     	//   rules: {
     	//     comment: {required: true, maxlength: 255, minlength: 3},
     	//     status: {required: true},
     	//   },
     	//   invalidHandler: function (event, validator) {
     	//     KTUtil.scrollTop();
     	//     console.log($('textarea[name=comment]').val() );
     	//   }
     	// });
     	// $('form#kt_form').submit(function(e){
     	// 	e.preventDefault()

     	// 	if( $('select[name=status]').val() != 'approved-unpaid' ){
     	// 			// console.log($('select[name=status]').val());
     		
     	// 	}
     	// });
 
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
