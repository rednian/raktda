@extends('layouts.admin.admin-app')
@section('style')
@stop
@section('content')
	 <section id="kt_page_portlet" class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title ">Create Event Type</h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ URL::previous()  }}" class="btn btn-clean btn-sm btn-elevate kt-margin-r-4 kt-font-transform-u">
							 <i class="la la-arrow-left"></i>
							 back
						</a>
						<div class="btn-group">
													<button type="button" class="btn btn-brand btn-sm">
														<i class="la la-check"></i>
														<span class="kt-hidden-mobile">Save</span>
													</button>
													<button type="button" class="btn btn-sm btn-brand dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true"
																	aria-expanded="false">
													</button>
													<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" >
														<ul class="kt-nav">
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-reload"></i>
																	<span class="kt-nav__link-text">Save &amp; continue</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-power"></i>
																	<span class="kt-nav__link-text">Save &amp; exit</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-edit-interface-symbol-of-pencil-tool"></i>
																	<span class="kt-nav__link-text">Save &amp; edit</span>
																</a>
															</li>
															<li class="kt-nav__item">
																<a href="#" class="kt-nav__link">
																	<i class="kt-nav__link-icon flaticon2-add-1"></i>
																	<span class="kt-nav__link-text">Save &amp; add new</span>
																</a>
															</li>
														</ul>
													</div>
												</div>
				 </div>
			</div>
			<div class="kt-portlet__body">
				 <form action="" class="kt-form kt-form--fit">
						<section class="row">
							 <div class="col-lg-5 col-xs-12">
									<div class="form-group form-group-sm">
										 <label>Event Type <span class="kt-font-danger">*</span></label>
										 <input type="email" class="form-control form-control-sm" required>
									</div>
							 </div>
							 <div class="col-lg-5 col-xs-12">
									<div class="form-group form-group-sm">
										 <label>Event Type <span class="kt-font-sm text-muted">(Arabic)</span> <span class="kt-font-danger">*</span></label>
										 <input type="email" class="form-control form-control-sm" required>
									</div>
							 </div>
						</section>
						<section class="row">
							 <div class="col-lg-10">
									<section class="form-group form-group-sm">
										 <label>Event Type Fee <span class="kt-font-danger">*</span></label>
										 <input type="text" class="form-control form-control-sm" autocomplete="off" required>
									</section>
							 </div>
						</section>
						<section class="row">
							 <div class="col-lg-5 col-xs-12">
									<div class="form-group form-group-sm">
										 <label>Event Type Description </label>
										 <textarea name="description_en" class="form-control form-control-sm" autocomplete="off" rows="4"></textarea>
									</div>
							 </div>
							 <div class="col-lg-5 col-xs-12">
									<div class="form-group form-group-sm">
										 <label>Event Type Description <span class="kt-font-sm text-muted">(Arabic)</span></label>
										 <textarea name="description_ar" class="form-control form-control-sm" autocomplete="off" rows="4"></textarea>
									</div>
							 </div>
						</section>
						<section class="row">
							 <div class="col-xs-12 col-lg-10">
									<label>Event Type Requirement <span class="kt-font-danger">*</span></label>
									<div class="input-group input-group-sm">
										 <select name="requirement_id" class="form-control form-control-sm custom-select custom-select-sm"></select>
										 <div class="input-group-append ">
												<button id="btn-new-requirement" type="button" class="btn btn-secondary" data-target="#kt_modal_4" data-toggle="modal">
													 <i class="la la-plus kt-font-success kt-font-boldest"></i>
												</button>
										 </div>
									</div>
							 
							 </div>
						</section>
				 </form>
			</div>
	 </section>
	 
	 <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				 <form name="frm-requirement" class="kt-form kt-form--fit" method="post" action="{{ route('admin.setting.requirement.store') }}">
				 	@csrf
						<div class="modal-content">
							 <div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Create New Requirement</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									</button>
							 </div>
							 <div class="modal-body">
									<section class="row">
										 <div class="col-lg-5 col-xs-12">
												<div class="form-group form-group-xs">
													 <label>Requirement Name <span class="kt-font-danger">*</span></label>
													 <input type="hidden" value="event" name="requirement_type">
													  <textarea name="requirement_name" class="form-control form-control-sm"  rows="3" required autocomplete="off"></textarea>
												</div>
										 </div>
										 <div class="col-lg-5 col-xs-12">
												<div class="form-group form-group-sm">
													 <label>Requirement Name <span class="kt-font-sm text-muted">(Arabic)</span> <span class="kt-font-danger">*</span></label>
													 <textarea name="requirement_name_ar" class="form-control form-control-sm"  rows="3" required autocomplete="off"></textarea>
												</div>
										 </div>
									</section>
									<section class="row">
										 <div class="col-lg-5 col-xs-12">
												<div class="form-group form-group-xs">
													 <label>Description </label>
													 <textarea name="requirement_description" class="form-control form-control-sm" autocomplete="off" rows="5"></textarea>
												</div>
										 </div>
										 <div class="col-lg-5 col-xs-12">
												<div class="form-group form-group-xs">
													 <label>Description <span class="kt-font-sm text-muted">(Arabic)</span></label>
													 <textarea name="requirement_description_ar" class="form-control form-control-sm" autocomplete="off" rows="5"></textarea>
												</div>
										 </div>
									</section>
							 </div>
							 <div class="modal-footer" style="justify-content: flex-start;">
							 	<button type="submit" class="btn  btn-sm btn-label-danger btn-elevate kt-font-transform-u">
							 		<span class="la la-plus kt-font-bolder"></span> Save Requirement
								</button>
								<button type="reset" class="btn btn-secondary  btn-sm" data-dismiss="modal">Cancel</button>
							 </div>
						</div>
				 </form>
			</div>
	 </div>
@stop
@section('script')
	 <script>
     $(document).ready(function () {
       addNewRequirement();
       requirement();
     });
     function requirement(){
        $('select[name=requirement_id]').html('');
        $('select[name=requirement_id]').append('<option disabled selected>-Select Requirement-</option>');
        $.ajax({
        	url: '{{ route('admin.setting.requirement.index') }}',
        	dataType: 'json'
        }).done(function (response) {
        	$.each(response, function (i, v) {$('select[name=requirement_id]').append('<option value="'+v.requirement_id+'">'+v.name+'</option>');});
        });
    }

     function addNewRequirement() {
     	var validated_form = $('form[name=frm-requirement]').validate({
     		rules:{
     			requirement_name:{
     				required: true,
     				minlength: 5,
     				maxlength: 255,
						remote: '{{ route('admin.setting.requirement.isexist') }}'
     			},
     			requirement_name_ar:{
     				required: true,
     				minlength: 5,
     				maxlength: 255,
						remote: '{{ route('admin.setting.requirement.isexist') }}'
     			},
     			requirement_description:{
     				minlength: 1,
     				maxlength: 255
     			},
     			requirement_description_ar:{
     				minlength: 1,
     				maxlength: 255
     			}
     		},
				// invalidHandler: function(event, validator){
     		//   event.preventDefault();
     		//   console.log(validator.invalid);
				// 	// $(validator.submitButton).attr('disabled', true);
     		//   // validator.submitButton.addClass('kt-spinner kt-spinner--sm kt-spinner-danger');
				// },
				// submitHandler: function(form){
     		//   console.log(form);
     		//   form.ajaxSubmit({
				//
				// 	});
				// }
     	});
     	
     	$('form[name=frm-requirement]').submit(function(e) {
     		e.preventDefault();
     		$.ajax({
     			url: $(this).attr('action'),
     			data: $(this).serialize(),
     			type: $(this).attr('method'),
     			dataType: 'json'
     		}).done(function(response){
     		  if(response){
     		    validated_form.resetForm();
     		    $.each(response, function (i, v) {$('select[name=requirement_id]').append('<option selected value="'+v.requirement_id+'">'+v.requirement_name+'</option>')
					;});
					}
     		});
     	});
     }
	 </script>
@stop