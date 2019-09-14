@extends('layouts.admin-app')
@section('content')
	<section class="row">
		<div class="col">
			 <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
			 	   <form class="kt-form kt-form--label-right" method="post" action="{{ route('procedure.store') }}">
			 	   		@csrf
		 	   		  <div class="kt-portlet__head kt-portlet__head--sm">
		 	   		  	<div class="kt-portlet__head-label">
		 	   		  	    <h4 class="kt-portlet__head-title">Create Procedure</h4>
		 	   		  	</div>
		 	   		  	<div class="kt-portlet__head-toolbar">
		 	   		  	   <a href="{{ URL::previous() }}" class="btn btn-sm btn-light btn-elevate active btn-raised">
		 	   		  	     <i class="la la-arrow-left"></i>
		 	   		  	     <span class="kt-hidden-mobile">Back</span>
		 	   		  	   </a>
		 	   		  	   <a href="{{ route('permit_type.create') }}" class="btn btn-brand active btn-raised btn-elevate btn-sm ">Create Permit Type</a>
		 	   		  	</div>
		 	   		  </div>
		 	   		  <div class="kt-portlet__body">
		 	   		  	<section class="row">
							<section class="col-10">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Procedure Type <span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<select name="procedure_type" class="form-control form-control-sm" required>
											<option disabled selected>-select type-</option>
											<option value="artist">Artist Permit</option>
											<option value="event">Event Permit</option>
										</select>
									</div>							
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Procedure Name <span class="text-danger">*</span></label>
									<div class="col-lg-9">
										<input type="text" class="form-control form-control-sm" name="procedure_name" required>
									</div>							
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Description</label>
									<div class="col-lg-9">
										<textarea name="description" class="form-control form-control-sm" rows="3"></textarea>
									</div>							
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label">Approvers <span class="text-danger">*</span></label>
									<div data-repeater-list="" class="col-lg-9">
										<div data-repeater-item="" class="form-group row align-items-center">
											<div class="col-md-4">
												<div class="kt-form__group--inline">
													<div class="kt-form__label">
														<label>User Group <span class="text-danger">*</span></label>
													</div>
													<div class="kt-form__control">
														<select name="role_id[]" id="" class="form-control form-control-sm">
															<option selected disabled>-select group-</option>
															@if (App\Roles::where('Type', 0)->where('NameEn', '!=', 'company')->exists())
																@foreach(App\Roles::where('Type', 0)->where('NameEn', '!=', 'company')->get() as $role)
																<option value="{{ $role->role_id }}">{{ ucwords($role->NameEn) }}</option>
																@endforeach
															@endif
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="kt-form__group--inline">
													<div class="kt-form__label">
														<label class="kt-label m-label--single">Duration <span class="text-danger">*</span></label>
													</div>
													<div class="kt-form__control">
														<select name="duration[]" id="" class="form-control form-control-sm"></select>
													</div>
												</div>
											</div>
											<div class="col-md-3">
												<div class="kt-form__group--inline">
													<div class="kt-form__label">
														<label class="kt-label m-label--single">Order</label>
													</div>
													<div class="kt-form__control">
														<input name="order[]" type="text" class="form-control form-control-sm"  value="First">
													</div>
												</div>
											</div>
											<div class="col-md-1">
												<div class="kt-form__group--inline">
													<div class="kt-form__label">
														<label class="kt-label m-label--single"></label>
													</div>
													<button type="button" class="btn btn-raised btn-success btn-add active btn-sm"><span class="la la-plus"></span></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row d-none" id="template">
										<label class="col-lg-3 col-form-label">Approvers <span class="text-danger">*</span></label>
										<div data-repeater-list="" class="col-lg-9">
											<div data-repeater-item="" class="form-group row align-items-center">
												<div class="col-md-4">
													<div class="kt-form__group--inline">
														<div class="kt-form__label">
															<label>User Group <span class="text-danger">*</span></label>
														</div>
														<div class="kt-form__control">
															<select name="role_id[]" id="" class="form-control form-control-sm">
																<option selected disabled>-select group-</option>
																@if (App\Roles::where('Type', 0)->where('NameEn', '!=', 'company')->exists())
																	@foreach(App\Roles::where('Type', 0)->where('NameEn', '!=', 'company')->get() as $role)
																	<option value="{{ $role->role_id }}">{{ ucwords($role->NameEn) }}</option>
																	@endforeach
																@endif
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="kt-form__group--inline">
														<div class="kt-form__label">
															<label class="kt-label m-label--single">Duration <span class="text-danger">*</span></label>
														</div>
														<div class="kt-form__control">
															<select name="duration[]" id="" class="form-control form-control-sm"></select>
														</div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="kt-form__group--inline">
														<div class="kt-form__label">
															<label class="kt-label m-label--single">Order</label>
														</div>
														<div class="kt-form__control">
															<input name="order[]" type="text" class="form-control form-control-sm"  value="First">
														</div>
													</div>
												</div>
												<div class="col-md-1">
													<div class="kt-form__group--inline">
														<div class="kt-form__label">
															<label class="kt-label m-label--single"></label>
														</div>
														<button type="button" class="btn btn-raised btn-remove btn-danger active btn-sm"><span class="la la-trash-o"></span></button>
													</div>
												</div>
											</div>
										</div>
									</div>
							</section>
						</section>
		 	   		  </div>
			 	   </form>
			 </section>
			<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" >
				<div class="kt-portlet__head kt-portlet__head--lg" style="">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">New Procedure</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<a href="{{ URL::previous() }}" class="btn btn-clean">
							<i class="la la-arrow-left"></i>
							<span class="kt-hidden-mobile">Back</span>
						</a>
						<a href="{{ route('procedure.index') }}" class="btn btn-outline-primary btn-sm">
							Procedures List
						</a>
					</div>
				</div>
				<div class="kt-portlet__body">
					<form class="kt-form kt-form--fit kt-form--label-right" method="post" action="{{ route('procedure.store') }}">
						@csrf
						
						<div class="kt-portlet__foot kt-portlet__foot--fit-x">
							<div class="kt-form__actions">
								<div class="row">
									<div class="col-lg-3"></div>
									<div class="col-lg-9">
										<button type="submit" class="btn active btn-sm btn-success btn-raised">Submit</button>
										<button type="reset" class="btn btn-sm btn-light btn-raised">Cancel</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('script')
	<script>
		$(document).ready(function(){

			$(document).on('click', '.btn-remove', function(){
				   var $row    = $(this).parents('.form-group').remove();
			});


			$('button.btn-add').click(function(){
				var template = $('#template'); 
					template.clone().removeClass('d-none').removeAttr('id').insertBefore(template);
			});

			$('form').validate(function(){
				rules: {
				
					// role_id :{ required:true },
					// duration :{ required:true },
					// order :{ required:true },
					// procedure_name: {
					// 	required: true,
					// 	remote:{
					// 		procedure_name: function(){
					// 			return $('input[name=procedure_name]').val();
					// 		}
					// 	}
					// },
						// procedure_type: { required:true },
				}
			});

		
			$('#frm-profession').validate({
				rules: {
					prof_name_en: {
						required: true,
						remote: {
						
							data: {
								prof_name_en: function() {
									return $('input[name=prof_name_en]').val();
								}
							}
						}
					},
					prof_amount: {
						required: true,
					}
				}
			});

		});
	</script>
@endsection