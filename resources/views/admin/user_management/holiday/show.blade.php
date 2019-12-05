
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
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Edit Holiday') }}</h3>
			 </div>
			 <div class="kt-portlet__head-toolbar">
					<a href="{{ URL::signedRoute('user_management.index') . '#holiday' }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u kt-margin-r-10">
						 <i class="la la-arrow-left"></i>
						 {{ __('BACK TO LIST') }}
					</a>
					<button id="btnDeleteHoliday" type="button" class="btn btn-sm btn-danger btn-elevate kt-font-transform-u kt-margin-r-10">
						 <i class="la la-times"></i>
						 {{ __('DELETE') }}
					</button>
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
								</li>
								<li class="kt-nav__item">
									<a href="#" data-submittype="new" class="kt-nav__link btn-submit">
										<i class="kt-nav__link-icon flaticon2-add-1"></i>
										<span class="kt-nav__link-text">{{ __('Save & edit') }}</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
			 </div>
		</div>
		<div class="kt-portlet__body kt-padding-t-0">
			<form method="POST" id="formAddHoliday" action="{{ route('user_management.holiday.update', $holiday->holiday_id) }}">
			@csrf
			@method('patch')
			
			<section class="row kt-margin-t-50">
				<div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Holiday Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $holiday->holiday_name }}" type="text" class="form-control form-control-sm" name="holiday_name">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Holiday Name (AR)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $holiday->holiday_name_ar }}" type="text" class="form-control form-control-sm" name="holiday_name_ar">
                    </div>
                </div>
			</section>

            <section class="row kt-margin-t-10">
                <div class="col-sm-12">
                    <div style="border:1px dashed #CCC;padding:10px">
                    	<section class="row kt-margin-t-10">
			                <div class="col-sm-6">
			                	<div class="form-group">
			                		<label for="example-search-input" class="kt-font-dark">{{ __('Start Date & Time') }}
			                            <span class="text-danger">*</span>
			                        </label>
				                    <div class="input-group date">
										<input value="{{ date('m/d/Y h:i A', strtotime($holiday->holiday_start)) }}" required name="holiday_start" type="text" class="form-control" id="kt_datetimepicker_start" placeholder="Select date and time"/>
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar glyphicon-th"></i>
											</span>
										</div>
									</div>
			                	</div>
			                </div>
			                <div class="col-sm-6">
			                	<div class="form-group">
				                	<label for="example-search-input" class="kt-font-dark">{{ __('End Date & Time') }}
			                            <span class="text-danger">*</span>
			                        </label>
				                    <div class="input-group date">
										<input value="{{ date('m/d/Y h:i A', strtotime($holiday->holiday_end)) }}" required name="holiday_end" type="text" class="form-control" id="kt_datetimepicker_end" placeholder="Select date and time"/>
										<div class="input-group-append">
											<span class="input-group-text">
												<i class="la la-calendar glyphicon-th"></i>
											</span>
										</div>
									</div>
								</div>
			                </div>
			            </section>
                    </div>
                </div>
            </section>
            
            <input type="hidden" name="submit_type">
        	</form>

        	<form method="POST" id="formDeleteHoliday" action="{{ route('user_management.holiday.delete', $holiday->holiday_id) }}">
        		@csrf
        		@method('delete')
        	</form>
		</div>
	</section>
@stop
@section('script')
	<script>

    $(document).ready(function(){
		
		$('#kt_datetimepicker_start').datetimepicker({
            format: "mm/dd/yyyy HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left',
        });

        $('#kt_datetimepicker_end').datetimepicker({
            format: "mm/dd/yyyy HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            pickerPosition: 'bottom-left'
        });

        $('#kt_select2_1, #kt_select2_1_validate').select2({
            placeholder: "Select an employee"
        });

        var validated_form = $('form#formAddHoliday').validate();
        $('.btn-submit').click(function(){

     		var type = $(this).data('submittype');
     		$('#formAddHoliday input[name=submit_type]').val(type);

     		var startDate = $('input[name=holiday_start]').val();
     		var endDate = $('input[name=holiday_end]').val();

     		startDate = new Date(startDate);
			endDate = new Date(endDate);

			//CHECK DATE -> MAKE SURE THAT END DATE IS LARGER THAN START DATE
			var diff = endDate - startDate;
			if(diff <= 0){
				$.notify({
			        title: 'Invalid Dates',
			        message: 'Make sure that end date is larger than start date.',
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


     		$('#formAddHoliday').trigger('submit');
     	});

     	$('#btnDeleteHoliday').click(function(){
     		bootbox.confirm('Are you sure you want to delete Holiday?', function(result){
     			if(result){
     				$('#formDeleteHoliday').trigger('submit');
     			}
     		});
     	});
    });

	</script>
@stop