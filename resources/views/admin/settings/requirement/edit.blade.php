
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
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __(strtoupper('Edit ' . ($req->requirement_type == 'artist' ? 'Artist' : 'Event') . ' Requirement')) }}</h3>
			 </div>
			 <div class="kt-portlet__head-toolbar">
					<a href="{{ $req->requirement_type == 'artist' ? URL::signedRoute('admin.setting.index') . '#artist_requirements' : URL::signedRoute('admin.setting.index') . '#event_requirements' }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u kt-margin-r-10">
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
			<form method="POST" id="formAddRequirement" action="{{ route('requirements.update', $req->requirement_id) }}">
			@csrf
			@method('patch')
			<section class="row kt-margin-t-50">
                <div class="col-sm-6">
					<span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
						<label>
							<input type="checkbox" value="1" {{ $req->status ? 'checked' : '' }} name="status"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;">{{ __('Enable Requirement') }}</b>
							<span></span>
						</label>
					</span>
				</div>
            </section>
			<section class="row kt-margin-t-10">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Requirement Name') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $req->requirement_name }}" type="text" name="requirement_name" required class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Requirement Name (AR)') }}
                        	<span class="text-danger">*</span>
                        </label>
                        <input value="{{ $req->requirement_name_ar }}" type="text" name="requirement_name_ar" required class="form-control form-control-sm">
                    </div>
                </div>
            </section>
            <section class="row">
                <div class="col-sm-12">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">{{ __('Description') }}
                            <span class="text-danger">*</span>
                        </label>
                        <textarea rows="4" name="requirement_description" required class="form-control from-control-sm">{{ $req->requirement_description }}</textarea>
                    </div>
                </div>
            </section>

            <section class="row kt-margin-t-10">
                <div class="col-sm-6">
					<span class="kt-switch kt-switch--outline kt-switch--sm kt-switch--icon kt-switch--success">
						<label>
							<input {{ $req->dates_required ? 'checked' : '' }} type="checkbox" name="dates_required" value="1"> <b class="kt-padding-t-5 kt-padding-l-5 kt-font-dark" style="font-weight:normal;display:inline-block;">{{ __('Requires Date Validation') }}</b>
							<span></span>
						</label>
					</span>
				</div>
            </section>

            <section class="row kt-margin-t-10 validity-input {{ $req->dates_required ? '' : 'kt-hide' }}">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark"> {{ __('Valid before expiry date (Months)') }}
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $req->validity }}" type="text" name="validity" class="form-control form-control-sm">
                    </div>
                </div>
            </section>

            <section class="row kt-margin-t-10">
                {{-- <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark"> Required to what permit type?
                            <span class="text-danger">*</span>
                        </label>
                        <select readonly name="requirement_type" id="" required class="form-control form-control-sm custom-select custom-select-sm">
                        	<option value=""></option>
                        	<option {{ $req->requirement_type == 'artist' ? 'selected' : '' }} value="artist">Artist Permit</option>
                        	<option {{ $req->requirement_type == 'event' ? 'selected' : '' }} value="event">Event Permit</option>
                        </select>
                    </div>
                </div> --}}
                <input type="hidden" value="{{ $req->requirement_type }}" name="requirement_type">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark"> {{ __('Permit Term') }}

                        </label>
                        <select name="term" id="" class="form-control form-control-sm custom-select custom-select-sm">
                        	<option value=""></option>
                        	<option {{ $req->term == 'long' ? 'selected' : '' }} value="long">{{ __('Long Term') }}</option>
                        	<option {{ $req->term == 'short' ? 'selected' : '' }} value="short">{{ __('Short Term') }}</option>
                        </select>
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
		var validated_form = $('form#formAddRequirement').validate({
     		rules:{
     			requirement_name:{
     				required: true,
					remote: {
		                url: '{{ route('requirements.isexist') }}',
		                 data: { type: 'update', id: {{ $req->requirement_id }} }
		            }
     			},
     			requirement_name_ar:{
     				required: true,
					remote: {
		                url: '{{ route('requirements.isexist') }}',
		                 data: { type: 'update', id: {{ $req->requirement_id }} }
		            }
     			}
     		}
     	});

     	$('.btn-submit').click(function(){
     		var type = $(this).data('submittype');
     		$('#formAddRequirement input[name=submit_type]').val(type);
     		$('#formAddRequirement').trigger('submit');
     	});

     	@if($req->dates_required)
     	$('form#formAddRequirement input[name=validity]').rules( "add", {
		  	required: true
		});
     	@endif

     	$(document).on('change','input[name=dates_required][type=checkbox]', function(){
			if($(this).is(':checked')){
				$('.validity-input').removeClass('kt-hide');

				$('form#formAddRequirement input[name=validity]').val({{ $req->validity }});
				$('form#formAddRequirement input[name=validity]').rules( "add", {
				  	required: true
				});
			}
			else{
				$('.validity-input').addClass('kt-hide');
				$('form#formAddRequirement input[name=validity]').rules( "remove", "required");
				$('form#formAddRequirement input[name=validity]').val('');
			}
		});
    });
	</script>
@stop
