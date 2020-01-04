
@extends('layouts.admin.admin-app')
@section('style')
	 <style>
			/*.dataTables_length{*/
			/*	 display:inline;*/
			/*}*/
	 </style>
@stop
@section('content')
	<section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
		<div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
			 <div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">Add New Schedule Type</h3>
			 </div>
			 <div class="kt-portlet__head-toolbar">
					<a href="{{ URL::signedRoute('admin.setting.index') }}#schedule_settings" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u kt-margin-r-10">
						 <i class="la la-arrow-left"></i>
						 {{ __('BACK TO SETTINGS') }}
					</a>
					<div class="btn-group">
						<button type="button" data-submittype="continue" class="btn btn-sm btn-warning btn-submit">
							<i class="la la-check"></i>
							<span class="kt-hidden-mobile">{{ __('Save') }}</span>
						</button>
						<button type="button" class="btn btn-sm btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="kt-nav">
								<li class="kt-nav__item">
									<a href="#" data-submittype="continue" class="kt-nav__link btn-submit">
										<i class="kt-nav__link-icon flaticon2-reload"></i>
										<span class="kt-nav__link-text">{{ __('Save & Continue') }}</span>
									</a>
								</li>{{-- 
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-power"></i>
										<span class="kt-nav__link-text">Save & exit</span>
									</a>
								</li>
								<li class="kt-nav__item">
									<a href="#" class="kt-nav__link">
										<i class="kt-nav__link-icon flaticon2-edit-interface-symbol-of-pencil-tool"></i>
										<span class="kt-nav__link-text">Save & edit</span>
									</a>
								</li> --}}
								<li class="kt-nav__item">
									<a href="#" data-submittype="new" class="kt-nav__link btn-submit">
										<i class="kt-nav__link-icon flaticon2-add-1"></i>
										<span class="kt-nav__link-text">{{ __('Save & add new') }}</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
			 </div>
		</div>
		<div class="kt-portlet__body kt-padding-t-0">
			<form method="POST" id="formAddScheduleType" action="{{ route('schedule_type.store') }}">
			@csrf
			<section class="row kt-margin-t-50">
                <div class="col-sm-6">
					<span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
						<label>
							<input type="checkbox" value="1" name="is_active"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;">{{ __('Set as Active') }}</b>
							<span></span>
						</label>
					</span>
				</div>
            </section>
			<section class="row kt-margin-t-10">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Schedule Type Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="" type="text" name="schedule_type_name" required class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Schedule Type Name (AR)') }}
                        	<span class="text-danger">*</span>
                        </label>
                        <input value="" type="text" name="schedule_type_name_ar" required class="form-control form-control-sm">
                    </div>
                </div>
            </section>
			
			<section class="row kt-margin-t-10">
                <div class="col-sm-12">
                    <div style="border:1px dashed #CCC;padding:10px">
                    	<section class="row kt-margin-t-10">
			                <div class="col-sm-3">
			                    <div class="form-group form-group-sm">
			                        <label for="example-search-input" class="kt-font-dark">{{ __('Time Start') }}
			                            <span class="text-danger">*</span>
			                        </label>
			                        <input value="" type="time" id="time_start" class="form-control form-control-sm pre_time">
			                    </div>
			                </div>
			                <div class="col-sm-3">
			                    <div class="form-group form-group-sm">
			                        <label for="example-search-input" class="kt-font-dark">{{ __('Time End') }}
			                        	<span class="text-danger">*</span>
			                        </label>
			                        <input value="" type="time" id="time_end" class="form-control form-control-sm pre_time">
			                    </div>
			                </div>
			                <div class="col-sm-3">
			                    <div class="form-group form-group-sm">
			                    	<label for="example-search-input" style="visibility: hidden" class="kt-font-dark">{{ __('Time Start') }}
			                            <span class="text-danger">*</span>
			                        </label><br>
			                    	<button type="button" id="btnSelectTime" class="btn btn-sm btn-warning">
										<i class="la la-check"></i>
										<span class="kt-hidden-mobile">{{ __('Proceed') }}</span>
									</button>
			                    </div>
			                </div>
			            </section>

			            <section class="row kt-margin-t-10">
			                <div class="col-sm-12">
			                    <table class="table table-borderless table-striped table-hover border" id="schedule-type-table">
									<thead>
										<tr>
											<th>{{ __('DAY') }}</th>
											<th class="no-wrap">{{ __('IS DAY OFF') }}</th>
											<th>{{ __('TIME START') }}</th>
											<th>{{ __('TIME END') }}</th>
										</tr>
									</thead>
									<tbody>
										@php
										$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
										@endphp

										@foreach($days as $key => $day)
										<tr>
											<th>{{ __($day) }}</th>
											<td class="text-center">
												<div class="form-group form-group-sm">
							                        <label class="kt-checkbox {{ $key == 5 || $key == 6 ? 'kt-checkbox--success' : 'kt-checkbox--default' }} kt-font-dark">
														<input class="is_dayoff" data-day="{{ $key }}" {{ $key == 5 || $key == 6 ? 'checked' : '' }} name="day[{{ $key }}][is_dayoff]" value="1" type="checkbox">
														<span></span>
													</label>
							                    </div>
											</td>
											<td>
												<div class="form-group form-group-sm">
							                        <input {{ $key == 5 || $key == 6 ? 'disabled' : '' }} type="time" name="day[{{ $key }}][time_start]" id="time_start_{{ $key }}" required class="form-control form-control-sm day_time_start">
							                    </div>
											</td>
											<td>
												<div class="form-group form-group-sm">
							                        <input {{ $key == 5 || $key == 6 ? 'disabled' : '' }} type="time" name="day[{{ $key }}][time_end]" id="time_end_{{ $key }}" required class="form-control form-control-sm day_time_end">
							                    </div>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
			                </div>
			            </section>
                    </div>
                </div>
            </section>
            <input type="hidden" name="submit_type">
        	</form>
		</div>
	</section>
@stop
@section('script')
	<script>

    $(document).ready(function () {

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

		$(document).on('change', 'input[type=checkbox].is_dayoff', function(){

			var day = $(this).data('day');

			if($(this).is(':checked')){

				//TIME START
				$('input#time_start_'+day).val('');
				$('input#time_start_'+day).attr('disabled', true);
				$('input#time_start_'+day).rules( "remove", "required");
				$('input#time_start_'+day).rules( "remove", "lessThan");

				//TIME END
				$('input#time_end_'+day).val('');
				$('input#time_end_'+day).attr('disabled', true);
				$('input#time_end_'+day).rules( "remove", "required");
				$('input#time_end_'+day).rules( "remove", "greaterThan");
			}
			else{

				//TIME START
				$('input#time_start_'+day).attr('disabled', false);
				$('input#time_start_'+day).rules( "add", {
					required: true
				});
				$('input#time_start_'+day).rules( "add", {
					lessThan: "#time_end_"+day
				});

				//TIME END
				$('input#time_end_'+day).attr('disabled', false);
				$('input#time_end_'+day).rules( "add", {
					required: true
				});
				$('input#time_end_'+day).rules( "add", {
					greaterThan: "#time_start_"+day
				});
			}
		});

		//SUBMIT FORM
		var validated_form = $('form#formAddScheduleType').validate({
     		rules:{
     			@foreach($days as $key => $day)
     			'day[{{ $key }}][time_start]': {
				    lessThan: "#time_end_{{ $key }}"
				},
     			'day[{{ $key }}][time_end]': {
				    greaterThan: "#time_start_{{ $key }}"
				},
     			@endforeach
     		}
     	});

     	$('.btn-submit').click(function(){
     		var type = $(this).data('submittype');
     		$('#formAddScheduleType input[name=submit_type]').val(type);
     		$('#formAddScheduleType').trigger('submit');
     	});

		$(document).on('click', '#btnSelectTime', function(){

			var time_start = document.getElementById("time_start").value;
			var time_end = document.getElementById("time_end").value;

			if(time_start.trim() == '' || time_end.trim() == ''){

				$.notify({
			        title: 'Information',
			        message: 'Please select time',
			        type:'error',
			    },{
			        type:'error',
			        animate: {
			            enter: 'animated zoomIn',
			            exit: 'animated zoomOut'
			        },
			    });

				return false;
			}

			if(time_start.trim() >= time_end.trim()){
				$.notify({
			        title: 'Information',
			        message: 'Invalid Time',
			        type:'error',
			    },{
			        type:'error',
			        animate: {
			            enter: 'animated zoomIn',
			            exit: 'animated zoomOut'
			        },
			    });
				return false;
			}

			$('.day_time_start:not([disabled])').val(time_start);
			$('.day_time_end:not([disabled])').val(time_end);
		});
    });
	</script>
@stop