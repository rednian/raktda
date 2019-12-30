
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
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('EDIT PROFESSION') }}</h3>
			 </div>
			 <div class="kt-portlet__head-toolbar">
					<a href="{{ URL::signedRoute('admin.setting.index') }}#profession" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u kt-margin-r-10">
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
										<span class="kt-nav__link-text">{{ __('Save & edit') }}</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
			 </div>
		</div>
		<div class="kt-portlet__body kt-padding-t-0">
			<form method="POST" id="formAddProfession" action="{{ route('settings.profession.update', $profession->profession_id) }}">
			@csrf
			<section class="row kt-margin-t-50">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Profession') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $profession->name_en }}" type="text" name="name_en" required class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Profession (AR)') }}
                        	<span class="text-danger">*</span>
                        </label>
                        <input value="{{ $profession->name_ar }}" type="text" name="name_ar" required class="form-control form-control-sm">
                    </div>
                </div>
            </section>
            <section class="row kt-margin-t-10">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Profession Fee') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $profession->amount }}" type="text" name="amount" required class="form-control form-control-sm">
                    </div>
                </div>
            </section>
            <section class="row kt-margin-t-20">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label class="kt-checkbox kt-checkbox--default kt-font-dark">
							<input {{ $profession->is_multiple ? 'checked' : '' }} name="is_multiple" value="1" type="checkbox"> {{ __('Allows multiple permit') }}
							<span></span>
						</label>
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

		//SUBMIT FORM
		var validated_form = $('form#formAddProfession').validate({
     		rules:{
     			name_en:{
     				required: true,
					remote: {
		                url: '{{ route('settings.profession.isexist') }}',
		                data: { type: 'update', id: {{ $profession->profession_id }} }
		            }
     			},
     			name_ar:{
     				required: true,
					remote: {
		                url: '{{ route('settings.profession.isexist') }}',
		                data: { type: 'update', id: {{ $profession->profession_id }} }
		            }
     			},
     			amount:{
     				required: true,
     			}
     		}
     	});

     	$('.btn-submit').click(function(){
     		var type = $(this).data('submittype');
     		$('#formAddProfession input[name=submit_type]').val(type);
     		$('#formAddProfession').trigger('submit');
     	});
    });

	</script>
@stop