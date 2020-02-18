
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
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ $type == 'g' ? __('ADD GOVERNMENT USER') : __('ADD NEW EMPLOYEE') }}</h3>
			 </div>
			 <div class="kt-portlet__head-toolbar">
					<a href="{{ URL::signedRoute('user_management.index') . ( $type == 'g' ? '#government_management' : '#employee_management') }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u kt-margin-r-10">
						 <i class="la la-arrow-left"></i>
						 {{ __('BACK') }}
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
			<form method="POST" id="formAddUser" action="{{ route('user_management.store') }}">
			@csrf

			<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="inspection-settings">
				<div class="card">
					<div class="card-header" id="inspection-settings-heading">
						<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#inspection-settings-details" aria-expanded="true" aria-controls="inspection-settings-details">
							<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Personal Details') }}</h6>
						</div>
					 </div>
					 <div id="inspection-settings-details" class="collapse show" aria-labelledby="inspection-settings-heading" data-parent="#inspection-settings">
						<div class="card-body">

							<section class="row kt-margin-t-10">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Name') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input  value="" type="text" name="NameEn" required class="form-control form-control-sm" autocomplete="off" autofocus>
				                    </div>
				                </div>
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Name (AR)') }}
				                        	<span class="text-danger">*</span>
				                        </label>
				                        <input dir="rtl" value="" type="text" name="NameAr" required class="form-control form-control-sm" autocomplete="off">
				                    </div>
				                </div>
				            </section>

				            <section class="row kt-margin-t-10">

				            	@if($type == 'g')
								<div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Department') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <select required name="government_id" class="form-control form-control-sm">
				                        	<option value=""></option>
				                        	@foreach(App\Government::orderBy('government_name_en')->get() as $dep)
											<option value="{{ $dep->government_id }}">{{ Auth::user()->LanguageId == 1 ? $dep->government_name_en : $dep->government_name_ar }}</option>
				                        	@endforeach
				                        </select>
				                    </div>
				                </div>
				            	@endif

				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Designation') }}
				                        	<span class="text-danger">*</span>
				                        </label>
				                        <input  autocomplete="off" value="" type="text" name="designation" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				            <section class="row kt-margin-t-10">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Email Address') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input autocomplete="off" type="text" name="email" class="form-control form-control-sm">
				                    </div>
				                </div>
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Mobile Number') }}
				                        	<span class="text-danger">*</span>
				                        </label>
				                        <input autocomplete="off"  value="" type="text" name="mobile_number" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

						</div>
					 </div>
				</div>
			 </section>

			 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="event-settings">
				<div class="card">
					<div class="card-header" id="event-settings-heading">
						<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#event-settings-details" aria-expanded="true" aria-controls="event-settings-details">
							<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('ACCOUNT SETTINGS') }}</h6>
						</div>
					 </div>
					 <div id="event-settings-details" class="collapse show" aria-labelledby="event-settings-heading" data-parent="#event-settings">
						<div class="card-body">

							<section class="row kt-margin-t-10">
								@if(is_null($type))
								<div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('User Role') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <select name="role_id" class="form-control form-control-sm">
				                        	<option value=""></option>
				                        	@foreach(App\Roles::where('type', 0)->get() as $role)
				                        	@if($role->role_id != 6)
											<option value="{{ $role->role_id }}">{{ Auth::user()->LanguageId == 1 ? ucwords($role->NameEn) : $role->NameAr }}</option>
											@endif
				                        	@endforeach
				                        </select>
				                    </div>
				                </div>
				                @else
				                <input type="hidden" name="role_id" value="6">
				                @endif
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Username') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input autocomplete="off"  value="" type="text" name="username" required class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>
				            <section class="row kt-margin-t-10">
				            	<div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Password') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input value="" type="password" name="password" required class="form-control form-control-sm">
				                    </div>
				                </div>
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">{{ __('Confirm Password') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input value="" type="password" name="confirm_password" required class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

						</div>
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
		//SUBMIT FORM
		var validated_form = $('form#formAddUser').validate();

     	$('.btn-submit').click(function(){
     		var type = $(this).data('submittype');
     		$('#formAddUser input[name=submit_type]').val(type);
     		$('#formAddUser').trigger('submit');
     	});
    });
	</script>
@stop
