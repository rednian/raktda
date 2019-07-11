@extends('layouts.app')
@section('content')
	<section class="row">
		<div class="col-lg-12">
			<div class="kt-portlet kt-portlet--last kt-portlet--head-lg kt-portlet--responsive-mobile" >
				<div class="kt-portlet__head kt-portlet__head--lg" style="">
					<div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title">New Artist Profession</h3>
					</div>
					<div class="kt-portlet__head-toolbar">
						<a href="{{ URL::previous() }}" class="btn btn-clean kt-margin-r-10">
							<i class="la la-arrow-left"></i>
							<span class="kt-hidden-mobile">Back</span>
						</a>
						<a href="{{ route('settings.index') }}" class="btn btn-brand btn-sm">
							Profession List
						</a>
					</div>
				</div>
				<div class="kt-portlet__body">
					<form class="kt-form" id="frm-profession" method="post" action="{{ route('profession.store') }}">
						@csrf
						<div class="row">
							<div class="col-xl-8">
								<div class="kt-section kt-section--first">
									<div class="kt-section__body">
										<div class="form-group row">
											<label class="col-2 col-form-label">Profession Name <span class="text-danger">*</span></label>
											<div class="col-4">
												<input class="form-control input-sm" type="text" name="prof_name_en" autocomplete="off" autofocus>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-2 col-form-label">Profession Fee <span class="text-danger">*</span></label>
											<div class="col-4">
												<input class="form-control input-sm" type="text" name="prof_amount" autocomplete="off">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-2 col-form-label">Description</label>
											<div class="col-4">
												<textarea name="prof_description" class="form-control input-sm" rows="3"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<dib class="div col-2"></dib>
											<div class="col-9">
												<button type="submit" class="btn btn-outline-primary btn-sm kt-margin-t-5 kt-margin-b-5">Save</button>
												<button type="submit" class="btn btn-outline-primary btn-sm kt-margin-t-5 kt-margin-b-5">Save & Continue</button>
												<button type="button" class="btn btn-outline-default btn-sm kt-margin-t-5 kt-margin-b-5">Cancel</button>
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