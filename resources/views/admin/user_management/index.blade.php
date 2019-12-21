@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
<style>
  .fc-unthemed .fc-event .fc-title, .fc-unthemed .fc-event-dot .fc-title { color: #fff; }
  .fc-unthemed .fc-event .fc-time, .fc-unthemed .fc-event-dot .fc-time { color: #fff; }
   .widget-toolbar{ cursor: pointer; }
</style>
@stop
@section('content')
	 <section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
			<div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('User Management') }}</h3>
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-0">

				<ul id="main-tab" class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
		            <li class="nav-item">
		               <a class="nav-link active" data-toggle="tab" href="#employee_management" role="tab">{{ __('Employee') }}</a>
		            </li>
		            <li class="nav-item">
		               <a class="nav-link" data-toggle="tab" href="#government_management" role="tab">{{ __('Government Entities') }}</a>
		            </li>
		        </ul>
		        <div class="tab-content">
					<div class="tab-pane active" id="employee_management" role="tabpanel">
						<ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
				            <li class="nav-item">
				               <a class="nav-link active" data-toggle="tab" href="#employee" role="tab">{{ __('Employees') }}</a>
				            </li>
				            <li class="nav-item">
				               <a class="nav-link" data-toggle="tab" href="#leave" role="tab">{{ __('Time Off') }}</a>
				            </li>
				            <li class="nav-item">
				               <a class="nav-link" data-toggle="tab" href="#holiday" role="tab">{{ __('Holiday') }}</a>
				            </li>
				        </ul>
				        <div class="tab-content">
		            		<div class="tab-pane active" id="employee" role="tabpanel">
		            			<section class="row">
					                <div class="col-12">
										<a href="{{ URL::signedRoute('user_management.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('ADD EMPLOYEE') }}</a>
					                </div>
					             </section>
						         <table class="table table-borderless table-striped table-hover border" id="tblUser">
									 <thead>
									 <tr>
											<th>{{ __('EMPLOYEE') }}</th>
											<th>{{ __('ROLE') }}</th>
											<th>{{ __('DATE ADDED') }}</th>
											<th>{{ __('STATUS') }}</th>
											<th>{{ __('ACTIONS') }}</th>
									 </tr>
									 </thead>
								</table>
						    </div>
		            		<div class="tab-pane" id="leave" role="tabpanel">
								<section class="row">
									<div class="col-sm-4">
					                    <div class="form-group">
					                        <select required name="user_id" id="kt_select2_1" class="form-control" style="width:100%">
					                        	<option value=""></option>
					                        	@foreach(App\User::areEmployees()->orderBy('NameEn')->get() as $emp)
												<option data-url="{{ URL::signedRoute('user_management.leave.get', ['user' => $emp->user_id]) }}" value="{{ $emp->user_id }}">{{ Auth::user()->LanguageId == 1 ? $emp->NameEn : $emp->NameAr }}</option>
					                        	@endforeach
					                        </select>
					                    </div>
					                </div>
					                <div class="col-sm-2">
					                    <button type="button" id="btnShowAllLeaves" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u">{{ __('All') }}</button>
					                </div>
					                 <div class="col-sm-6">
					                    <a href="{{ URL::signedRoute('user_management.leave.add', ['user' => null]) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('NEW TIME OFF') }}</a>
					                 </div>
					            </section>
					            <section class="row">
					                <div class="col-12">
					                    <div id="leave_calendar"></div>
					                </div>
					            </section>
		            		</div>
		            		<div class="tab-pane" id="holiday" role="tabpanel">
								<section class="row">
					                 <div class="col-12">
					                    <a href="{{ URL::signedRoute('user_management.holiday.add') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('Add Holiday') }}</a>
					                 </div>
					             </section>
					             <section class="row">
					                  <div class="col-12">
					                    <div id="holiday_calendar"></div>
					                  </div>
					             </section>
		            		</div>
		            	</div>
					</div>
					<div class="tab-pane" id="government_management" role="tabpanel">
						<section class="row">
			                <div class="col-12">
								<a href="{{ URL::signedRoute('user_management.create', ['t' => 'g']) }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('ADD USER') }}</a>
			                </div>
			             </section>
				         <table class="table table-borderless table-striped table-hover border" id="tblUserGov">
							 <thead>
							 <tr>
									<th>{{ __('NAME') }}</th>
									<th>{{ __('DEPARTMENT') }}</th>
									<th>{{ __('ROLE') }}</th>
									<th>{{ __('DATE ADDED') }}</th>
									<th>{{ __('STATUS') }}</th>
									<th>{{ __('ACTIONS') }}</th>
							 </tr>
							 </thead>
						</table>
					</div>
		        </div>
				
			</div>
	 </section>
@stop
@section('script')
	<script>
		var tblUser;
		var tblUserGov;
		$(document).ready(function(){

			$('#kt_select2_1, #kt_select2_1_validate').select2({
	            placeholder: "Search by Employee"
	        });

			var calendarEl = document.getElementById('leave_calendar');
			var holiday_calendar = document.getElementById('holiday_calendar');

			renderLeaveCalendar('{{ URL::signedRoute('user_management.leave.get', ['user' => null]) }}');

	        function renderLeaveCalendar(url){

	        	$('#leave_calendar').html('');

	        	var calendar = new FullCalendar.Calendar(calendarEl, {
	              plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
	              isRTL: KTUtil.isRTL(),
	              header: {
	                  left: 'prev,next today',
	                  center: 'title',
	                  right: 'listWeek,timeGridWeek,dayGridMonth',
	              },
	              @if(Auth::user()->LanguageId != 1)
	              locale: 'ar',
	              @endif
	              height: 'auto',
	              allDaySlot: true,
	              contentHeight: 450,
	              aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
	              nowIndicator: true,
	              views: {
	                  dayGridMonth: { buttonText: '{{ __('Month') }}' },
	                  timeGridWeek: { buttonText: '{{ __('Week') }}' },
	                  timeGridDay: { buttonText: '{{ __('Day') }}' },
	                  listWeek: { buttonText: '{{ __('Week List') }}' }
	              },
	              defaultView: 'listWeek',
	              editable: false,
	              eventLimit: true, // allow "more" link when too many events
	              navLinks: true,
	              events: {
	                url: url,
	                textColor : '#ffffff',
	              },
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
	        }

	        //FILTER LEAVE CALENDAR
	        $('#kt_select2_1').on('change', function(){
	        	var url = $('option:selected', this).data('url');
	  			renderLeaveCalendar(url);
	        });

	        //SHOW ALL LEAVES
	        $('#btnShowAllLeaves').on('click', function(){
	        	$('#kt_select2_1').val('').trigger('change');
	        	renderLeaveCalendar('{{ URL::signedRoute('user_management.leave.get', ['user' => null]) }}');
	        });


	        renderHolidayCalendar('{{ route('user_management.holiday.get') }}');

	        function renderHolidayCalendar(url){
	        	$('#holiday_calendar').html('');

	        	var holidayCal = new FullCalendar.Calendar(holiday_calendar, {
		              plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
		              @if(Auth::user()->LanguageId != 1)
		              locale: 'ar',
		              @endif
		              isRTL: KTUtil.isRTL(),
		              header: {
		                  left: 'prev,next today',
		                  center: 'title',
		                  right: 'listWeek,timeGridWeek,dayGridMonth',
		              },
		              height: 'auto',
		              allDaySlot: true,
		              contentHeight: 450,
		              aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
		              nowIndicator: true,
		              views: {
		                  dayGridMonth: { buttonText: '{{ __('Month') }}' },
		                  timeGridWeek: { buttonText: '{{ __('Week') }}' },
		                  timeGridDay: { buttonText: '{{ __('Day') }}' },
		                  listWeek: { buttonText: '{{ __('Week List') }}' }
		              },
		              defaultView: 'dayGridMonth',
		              editable: false,
		              eventLimit: true, // allow "more" link when too many events
		              navLinks: true,
		              events: {
		                url: url,
		                textColor : '#ffffff',
		              },
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
		          holidayCal.render();
	        }

			var hash = window.location.hash;

	        if(hash){
	          $('ul.nav.nav-tabs#main-tab a[href="' + hash + '"]').tab('show');
	        }

	        $('#main-tab.nav.nav-tabs a').click(function (e) {
	          var scrollmem = $('body').scrollTop();
	          window.location.hash = this.hash;
	          $('html,body').scrollTop(scrollmem);
	        });

			tblUser = $('#tblUser').DataTable({
				processing: true,
	           	serverSide: true,
	           	ajax: {
	               url: '{{ route('user_management.datatable') }}',
	               data: { employee : 1},
	               global: false,
	           	},
	           	columnDefs: [
	                {targets:  [4], className: 'no-wrap text-right', sortable: false},
	           	],
	           	columns: [
	           		{ data: 'name', name: 'name' },
	           		{ data: 'role', name: 'role' },
	           		{ data: 'CreatedAt', name: 'CreatedAt' },
	           		{ data: 'status', name: 'status' },
	               	{ data: 'actions', name: 'actions' }
	           	],
	           	fnCreatedRow: function(row, data, index){

	           		$(row).click(function(){
	           			location.href = data.show_url;
	           		});

		            // $('button.btn-delete', row).click(function(){
		            // 	var url = $(this).data('url');
		            //     bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.name + '</span>?', function(result){
		            //         if(result){
		            //             $.ajax({
			           //              url: url,
			           //              data: {_method: 'delete'},
			           //              type: 'post',
			           //              dataType: 'json'
		            //             }).done(function(response){
		            //               	tblEventTypes.ajax.reload(null, false);
		            //           	});
		            //         }
		            //     });
		            // });

		            // $('button.btn-edit', row).click(function(){
		            // 	location.href = $(this).data('url');
		            // });
	           	}
			});

			tblUserGov = $('#tblUserGov').DataTable({
				processing: true,
	           	serverSide: true,
	           	ajax: {
	               url: '{{ route('user_management.datatable') }}',
	               data: { government: 1},
	               global: false,
	           	},
	           	columnDefs: [
	                {targets:  [5], className: 'no-wrap text-right', sortable: false},
	           	],
	           	columns: [
	           		{ data: 'name', name: 'name' },
	           		{ data: 'department', name: 'department' },
	           		{ data: 'role', name: 'role' },
	           		{ data: 'CreatedAt', name: 'CreatedAt' },
	           		{ data: 'status', name: 'status' },
	               	{ data: 'actions', name: 'actions' }
	           	],
	           	fnCreatedRow: function(row, data, index){

	           		$(row).click(function(){
	           			location.href = data.show_url;
	           		});

		            // $('button.btn-delete', row).click(function(){
		            // 	var url = $(this).data('url');
		            //     bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.name + '</span>?', function(result){
		            //         if(result){
		            //             $.ajax({
			           //              url: url,
			           //              data: {_method: 'delete'},
			           //              type: 'post',
			           //              dataType: 'json'
		            //             }).done(function(response){
		            //               	tblEventTypes.ajax.reload(null, false);
		            //           	});
		            //         }
		            //     });
		            // });

		            // $('button.btn-edit', row).click(function(){
		            // 	location.href = $(this).data('url');
		            // });
	           	}
			});
		});
	</script>
@stop