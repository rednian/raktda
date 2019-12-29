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
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Account Settings') }}</h3>
				</div>
				<div class="kt-portlet__head-toolbar">
					<button type="button" id="btnSaveSettings" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">
						 <i class="la la-check"></i>
						 {{ __('SAVE CHANGES') }}
					</button>
				</div>
			</div>
			<div class="kt-portlet__body kt-padding-t-0">

				
				 <ul id="main-tab" class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
						<li class="nav-item">
							 <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">{{ __('Personal Details') }}</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#credentials" role="tab">{{ __('Account Settings') }}</a>
						</li>
				 </ul>
				 <form action="{{ route('admin.settings.account.save') }}" id="formAccountSettings" method="POST">
				 <div class="tab-content">
				 		@csrf
						<div class="tab-pane active" id="personal" role="tabpanel">
							<section class="row kt-margin-t-20">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Name') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input value="{{ $user->NameEn }}" type="text" name="NameEn" required class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				            <section class="row kt-margin-t-10">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Name (AR)') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input value="{{ $user->NameAr }}" type="text" name="NameAr" required class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				            <section class="row kt-margin-t-10">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Email Address') }}
				                        </label>
				                        <input value="{{ $user->email }}" type="text" name="email" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				             <section class="row kt-margin-t-10">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Mobile Number') }}
				                        </label>
				                        <input value="{{ $user->mobile_number }}" type="text" name="mobile_number" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>
						</div>
						<div class="tab-pane" id="credentials" role="tabpanel">

							{{-- <h5 class="kt-font-dark kt-margin-t-20">{{ __('Change Username') }}</h5> --}}
							<section class="row kt-margin-t-20">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label class="kt-checkbox kt-checkbox--default kt-font-dark">
											<input name="change_username" value="1" type="checkbox"> {{ __('Change Username') }}
											<span></span>
										</label>
				                    </div>
				                </div>
				            </section>
				            <section class="row">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Username') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input disabled value="{{ $user->username }}" type="text" name="username" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				            {{-- <h5 class="kt-font-dark kt-margin-t-20">{{ __('Change Password') }}</h5> --}}
				            <section class="row kt-margin-t-20">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label class="kt-checkbox kt-checkbox--default kt-font-dark">
											<input name="change_password" value="1" type="checkbox"> {{ __('Change Password') }}
											<span></span>
										</label>
				                    </div>
				                </div>
				            </section>
				            <section class="row">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Current Password') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input disabled type="password" name="current_password" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				            <section class="row">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('New Password') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input disabled type="password" id="new_password" name="new_password" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

				            <section class="row">
				                <div class="col-sm-6">
				                    <div class="form-group form-group-sm">
				                        <label for="example-search-input" class="kt-font-dark">
				                        	{{ __('Confirm Password') }}
				                            <span class="text-danger">*</span>
				                        </label>
				                        <input disabled type="password" name="confirm_password" class="form-control form-control-sm">
				                    </div>
				                </div>
				            </section>

						</div>
					
				 </div>
				 </form>
			</div>
	 </section>
@stop
@section('script')
	<script>
		
		$(document).ready(function(){

			var hash = window.location.hash;
	        if(hash){
	        	$('ul.nav.nav-tabs#main-tab a[href="' + hash + '"]').tab('show');
	        }

			$('#main-tab.nav.nav-tabs a').click(function (e) {
		        var scrollmem = $('body').scrollTop();
		        window.location.hash = this.hash;
		        $('html,body').scrollTop(scrollmem);
	       	});

	       	$('form#formAccountSettings').validate();

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

			$(document).on('change','input[name=change_username][type=checkbox]', function(){
				if($(this).is(':checked')){
					$('input[name=username]').removeAttr('disabled');
					$('form#formAccountSettings input[name=username]').rules( "add", {
					  	required: true
					});
				}
				else{
					$('input[name=username]').val('{{ $user->username }}');
					$('input[name=username]').attr('disabled', true);
					$('form#formAccountSettings input[name=username]').rules( "remove", "required");
				}
			});

			$(document).on('change','input[name=change_password][type=checkbox]', function(){
				if($(this).is(':checked')){
					$('input[name=current_password]').removeAttr('disabled');
					$('form#formAccountSettings input[name=current_password]').rules( "add", {
					  	required: true
					});

					$('input[name=new_password]').removeAttr('disabled');
					$('form#formAccountSettings input[name=new_password]').rules( "add", {
					  	required: true
					});

					$('input[name=confirm_password]').removeAttr('disabled');
					$('form#formAccountSettings input[name=confirm_password]').rules( "add", {
					  	required: true
					});
					$('form#formAccountSettings input[name=confirm_password]').rules( "add", {
					  	equalTo: '#new_password'
					});
				}
				else{
					$('input[name=current_password]').val('');
					$('input[name=new_password]').val('');
					$('input[name=confirm_password]').val('');

					$('input[name=current_password]').attr('disabled', true);
					$('input[name=new_password]').attr('disabled', true);
					$('input[name=confirm_password]').attr('disabled', true);

					$('form#formAccountSettings input[name=current_password]').rules( "remove", "required");
					$('form#formAccountSettings input[name=new_password]').rules( "remove", "required");
					$('form#formAccountSettings input[name=confirm_password]').rules( "remove", "required");
					$('form#formAccountSettings input[name=confirm_password]').rules( "remove", "equalTo");
				}
			});

			$('#btnSaveSettings').click(function(){
				bootbox.confirm('{{ __('Are you sure you want to save settings?') }}', function(result){
					if(result){
						$('form#formAccountSettings').trigger('submit');
					}
				});
			});
		});
	</script>
@stop