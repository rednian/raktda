
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
					<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">Edit Event Type</h3>
			 </div>
			 <div class="kt-portlet__head-toolbar">
					<a href="{{ url('settings#event_types') }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u kt-margin-r-10">
						 <i class="la la-arrow-left"></i>
						 Back to Settings
					</a>
					<div class="btn-group">
						<button type="button" data-submittype="continue" class="btn btn-sm btn-warning btn-submit">
							<i class="la la-check"></i>
							<span class="kt-hidden-mobile">Save</span>
						</button>
						<button type="button" class="btn btn-sm btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						</button>
						<div class="dropdown-menu dropdown-menu-right">
							<ul class="kt-nav">
								<li class="kt-nav__item">
									<a href="#" data-submittype="continue" class="kt-nav__link btn-submit">
										<i class="kt-nav__link-icon flaticon2-reload"></i>
										<span class="kt-nav__link-text">Save & continue</span>
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
										<span class="kt-nav__link-text">Save & edit</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
			 </div>
		</div>
		<div class="kt-portlet__body kt-padding-t-0">
			<form method="POST" id="formAddEventType" action="{{ route('event_type.update', $event_type->event_type_id) }}">
			@csrf
			@method('patch')
			<section class="row kt-margin-t-50">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">Event Type
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $event_type->name_en }}" type="text" name="name_en" required class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">Event Type (AR)
                        	<span class="text-danger">*</span>
                        </label>
                        <input value="{{ $event_type->name_ar }}" type="text" name="name_ar" required class="form-control form-control-sm">
                    </div>
                </div>
            </section>
            <section class="row kt-margin-t-10">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">Description
                            <span class="text-danger">*</span>
                        </label>
                        <textarea name="description_en" class="form-control form-control-sm" required rows="3">{{ $event_type->description_en }}</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">Description (AR)
                        	<span class="text-danger">*</span>
                        </label>
                        <textarea name="description_ar" class="form-control form-control-sm" required rows="3">{{ $event_type->description_ar }}</textarea>
                    </div>
                </div>
            </section>
            <section class="row kt-margin-t-10">
                <div class="col-sm-6">
                    <div class="form-group form-group-sm">
                        <label for="example-search-input" class="kt-font-dark">Amount
                            <span class="text-danger">*</span>
                        </label>
                        <input value="{{ $event_type->amount }}" type="text" name="amount" required class="form-control form-control-sm">
                    </div>
                </div>
            </section>
            <div class="requirements"></div>
            <input type="hidden" name="submit_type">
        	</form>

        	<section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-20" id="accordion-detail">
				<div class="card">
					<div class="card-header" id="heading-detail">
						<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-detail" aria-expanded="true" aria-controls="collapse-detail">
							<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> Select Requirements</h6>
						</div>
					 </div>
					 <div id="collapse-detail" class="collapse show" aria-labelledby="heading-detail" data-parent="#accordion-detail">
						<div class="card-body">

							<div id="action-alert-unselected" class="alert d-none alert-outline-danger fade show" role="alert">
									<div class="alert-icon"><i class="flaticon-warning"></i></div>
									<div class="alert-text">Please check atleast one requirement before taking action!</div>
									<div class="alert-close"></div>
							</div>
							<table class="table table-borderless table-striped table-hover border" id="tblRequirement">
								 <thead>
									 <tr>
									 	<th></th>
										<th>REQUIREMENT</th>
										<th>DESCRIPTION</th>
										<th>DATE REQUIRED</th>
										<th>VALIDITY (months)</th>
									 </tr>
								 </thead>
							</table>
						</div>
					 </div>
				</div>
			 </section>
		</div>
	</section>
@stop
@section('script')
	<script>
	
	var tblRequirement;

    $(document).ready(function () {

    	loadRequirements();

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
		var validated_form = $('form#formAddEventType').validate({
     		rules:{
     			name_en:{
     				required: true,
					remote: {
		                url: '{{ route('event_type.isexist') }}',
		                data: { type: 'update', id: {{ $event_type->event_type_id }} }
		            }
     			},
     			name_ar:{
     				required: true,
					remote: {
		                url: '{{ route('event_type.isexist') }}',
		                data: { type: 'update', id: {{ $event_type->event_type_id }} }
		            }
     			},
     			amount:{
     				required: true,
     			}
     		}
     	});

     	$('.btn-submit').click(function(){

     		var type = $(this).data('submittype');
     		$('#formAddEventType input[name=submit_type]').val(type);
     		$('#formAddEventType .requirements').html('');

     		//GET SELECTED ROWS AND APPEND TO FORM ON SUBMIT FORM
     		var rows_selected = tblRequirement.column(0).checkboxes.selected();

     		if(rows_selected.length == 0){
     			$('#action-alert-unselected').removeClass('d-none');
     			return false;
     		}

            $.each(rows_selected, function(index, requirement_id){
                $('#formAddEventType .requirements').append(
                    $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'requirement_id[]')
                        .val(requirement_id)
                );
            });

     		$('#formAddEventType').trigger('submit');
     	});
    });

    function loadRequirements(){
    	tblRequirement = $('table#tblRequirement').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('requirements.datatable') }}',
               data: { type: 'event', event_type_id : {{ $event_type->event_type_id }} },
               global: false,
           },
           order: [[1, 'asc']],
           columnDefs: [
           		{
                    targets:0,
                    orderable: false,
                    checkboxes: {
                        selectRow: true
                    },
                    className: 'no-wrap', sortable: false
                },
                {targets:  [2], className: 'no-wrap', sortable: false},
           ],
           select: {
             	style: 'multi'
         	},
           columns: [
           	   { data: 'requirement_id', name: 'requirement_id'},
               { data: 'requirement_name', name: 'requirement_name'},
               { data: 'requirement_description', name: 'requirement_description'},
               { data: 'dates_required', name: 'dates_required'},
               { data: 'validity', name: 'validity'},
           ],
           createdRow: function(row, data, index){
           		if(data.isInEventType == 1){
	        		var cell = tblRequirement.cell($('.dt-checkboxes', row).closest('td'));
			      	cell.checkboxes.select(true);
	        	}
           }
       });
    }
	</script>
@stop