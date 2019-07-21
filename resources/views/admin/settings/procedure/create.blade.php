@extends('layouts.admin-app')
@section('content')
	<section class="row">
		<div class="col-lg-12">
			<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" >
				<div class="kt-portlet__head kt-portlet__head--lg" style="">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">New Approver Procedure</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<a href="{{ URL::previous() }}" class="btn btn-clean">
							<i class="la la-arrow-left"></i>
							<span class="kt-hidden-mobile">Back</span>
						</a>
						<a href="{{ route('approvers.index') }}" class="btn btn-outline-primary btn-sm">
							Procedures List
						</a>
					</div>
				</div>
				<div class="kt-portlet__body">
					<form class="kt-form" id="frm-procedure" method="post" action="{{ route('approvers.store') }}">
						@csrf
						<div class="row">
							<div class="col-xl-8">
								<div class="kt-section kt-section--first">
									<div class="kt-section__body">
										<div class="form-group row">
											<label class="col-2 col-form-label">Procedure Type<span class="text-danger">*</span></label>
											<div class="col-4">
												<select name="prod_type" class="form-control input-sm" autofocus>
													<option selected disabled> Select Procedure Type</option>
													<option value="artist">Artist Permit</option>
													<option value="event">Event Permit</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-2 col-form-label">Procedure Name <span class="text-danger">*</span></label>
											<div class="col-4">
												<input class="form-control input-sm" type="text" name="prod_name" autocomplete="off">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-2 col-form-label">Description</label>
											<div class="col-4">
												<textarea name="prod_description" class="form-control input-sm" rows="3"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<dib class="div col-2"></dib>
											<div class="col-9">
												<button type="submit" class="btn btn-outline-success btn-sm">Save</button>
												<button type="submit" class="btn btn-outline-success btn-sm">Save & Continue</button>
												<button type="button" class="btn btn-secondary btn-sm">Cancel</button>
											</div>
										</div>
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
			$('#frm-profession').validate({
				rules: {
					prof_name_en: {
						required: true,
						remote: {
							url: '{!! route('profession.isexist') !!}',
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