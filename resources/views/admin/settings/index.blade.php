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
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('System Settings') }}</h3>
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-0">
				 <ul id="main-tab" class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
						<li class="nav-item">
							 <a class="nav-link active" data-toggle="tab" href="#profession" role="tab">{{ __('Profession') }}</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#requirements" role="tab">{{ __('Requirements') }}</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#event_types" role="tab">{{ __('Event Types') }}</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#general_settings" role="tab">{{ __('General Settings') }}</a>
						</li>
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane active" id="profession" role="tabpanel">
							<section class="row">
								 <div class="col-12">
										<a href="{{ route('settings.profession.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('New Profession') }}</a>
								 </div>
							</section>
							<table class="table table-borderless table-striped table-hover border table-sm" id="tblProfession">
								 <thead>
								 <tr>
										<th>{{ __('PROFESSION NAME') }}</th>
										<th>{{ __('ALLOW MULTIPLE PERMIT') }}</th>
										<th>{{ __('PROFESSION FEE') }}</th>
										<th>{{ __('ADDED BY') }}</th>
										<th>{{ __('ADDED ON') }}</th>
										<th>{{ __('ACTIONS') }}</th>
								 </tr>
								 </thead>
							</table>
						</div>
						<div class="tab-pane" id="requirements" role="tabpanel">
							<section class="row">
								 <div class="col-12">
										<a href="{{ route('requirements.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('New Requirement') }}</a>
								 </div>
							</section>
							<table class="table table-borderless table-striped table-hover border table-sm" id="tblRequirement">
								 <thead>
								 <tr>
										<th>{{ __('REQUIREMENT') }}</th>
										<th>{{ __('DESCRIPTION') }}</th>
										<th>{{ __('VALIDITY (months)') }}</th>
										<th>{{ __('PERMIT TERM') }}</th>
										<th>{{ __('DATE REQUIRED') }}</th>
										<th>{{ __('STATUS') }}</th>
										<th>{{ __('ACTIONS') }}</th>
								 </tr>
								 </thead>
							</table>
						</div>
						<div class="tab-pane" id="event_types" role="tabpanel">
							 <section class="row">
								 <div class="col-12">
										<a href="{{ route('event_type.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">{{ __('New Event Type') }}</a>
								 </div>
							</section>
							<table class="table table-borderless table-striped table-hover border table-sm" id="tblEventTypes">
								 <thead>
								 <tr>
										<th>{{ __('EVENT TYPE') }}</th>
										<th>{{ __('DESCRIPTION') }}</th>
										<th>{{ __('EVENT TYPE FEE') }}</th>
										<th>{{ __('ACTIONS') }}</th>
								 </tr>
								 </thead>
							</table>
						</div>
						<div class="tab-pane" id="general_settings" role="tabpanel">
							<form method="POST" id="formSettings" action="{{ route('admin.setting.general_settings.save') }}">
							@csrf
							 <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder" style="padding:0px">
								 <div class="kt-portlet__head-label">
										<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('GENERAL SETTINGS') }}</h3>
								 </div>
								 <div class="kt-portlet__head-toolbar">
										<button type="button" id="btnSaveSettings" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">
											 <i class="la la-check"></i>
											 {{ __('Save Setting Changes') }}
										</button>
								 </div>
							</div>
							 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="inspection-settings">
								<div class="card">
									<div class="card-header" id="inspection-settings-heading">
										<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#inspection-settings-details" aria-expanded="true" aria-controls="inspection-settings-details">
											<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Inspection') }}</h6>
										</div>
									 </div>
									 <div id="inspection-settings-details" class="collapse show" aria-labelledby="inspection-settings-heading" data-parent="#inspection-settings">
										<div class="card-body">
											
											<section class="row kt-margin-t-10">
								                <div class="col-sm-6">
								                    <div class="form-group form-group-sm">
								                        <label for="example-search-input" class="kt-font-dark">
								                        	{{ __('Number of inspections per day (per inspector)') }}
								                            <span class="text-danger">*</span>
								                        </label>
								                        <input min="7" value="{{ $general_settings->inspection_per_day }}" type="text" name="inspection_per_day" required class="form-control form-control-sm">
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
											<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Event') }}</h6>
										</div>
									 </div>
									 <div id="event-settings-details" class="collapse show" aria-labelledby="event-settings-heading" data-parent="#event-settings">
										<div class="card-body">
											
											<section class="row kt-margin-t-10">
								                <div class="col-sm-6">
								                    <div class="form-group form-group-sm">
								                        <label for="example-search-input" class="kt-font-dark">
								                        	{{ __('Event starts after the date of application (No. of days)') }}
								                            <span class="text-danger">*</span>
								                        </label>
								                        <input min="7" value="{{ $general_settings->event_start_after }}" type="text" name="event_start_after" required class="form-control form-control-sm">
								                    </div>
								                </div>
								            </section>

										</div>
									 </div>
								</div>
							 </section>

							 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus kt-margin-t-0" id="artist-settings">
								<div class="card">
									<div class="card-header" id="artist-settings-heading">
										<div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#artist-settings-details" aria-expanded="true" aria-controls="artist-settings-details">
											<h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('Artist Permit') }}</h6>
										</div>
									 </div>
									 <div id="artist-settings-details" class="collapse show" aria-labelledby="artist-settings-heading" data-parent="#artist-settings">
										<div class="card-body">
											
											<section class="row kt-margin-t-10">
								                <div class="col-sm-6">
								                    <div class="form-group form-group-sm">
								                        <label for="example-search-input" class="kt-font-dark">
								                        	{{ __('Artist Permit Grace Period for Ammendments (No. of days)') }}
								                            <span class="text-danger">*</span>
								                        </label>
								                        <input min="1" value="{{ $general_settings->artist_permit_grace_period_amendment }}" type="text" name="artist_permit_grace_period_amendment" required class="form-control form-control-sm">
								                    </div>
								                </div>
								            </section>

								            <section class="row kt-margin-t-10">
								                <div class="col-sm-6">
								                    <div class="form-group form-group-sm">
								                        <label for="example-search-input" class="kt-font-dark">
								                        	{{ __('Artist Permit Grace Period for Renewal (No. of days)') }}
								                            <span class="text-danger">*</span>
								                        </label>
								                        <input min="1" value="{{ $general_settings->artist_permit_grace_period_renew }}" type="text" name="artist_permit_grace_period_renew" required class="form-control form-control-sm">
								                    </div>
								                </div>
								            </section>

								            <section class="row kt-margin-t-10">
								                <div class="col-sm-6">
								                    <div class="form-group form-group-sm">
								                        <label for="example-search-input" class="kt-font-dark">
								                        	{{ __('Artist Permit starts after the date of application (No. of days)') }}
								                            <span class="text-danger">*</span>
								                        </label>
								                        <input min="7"	value="{{ $general_settings->artist_start_after }} " type="text" name="artist_start_after" required class="form-control form-control-sm">
								                    </div>
								                </div>
								            </section>

										</div>
									 </div>
								</div>
							</section>
							</form>
						</div>
				 </div>
			</div>
	 </section>
@stop
@section('script')
	<script>

	var tblProfession;
	var tblRequirement;
	var tblEventTypes;
	var tvlEventRequirement;

    $(document).ready(function () {

       	var hash = window.location.hash;

        if(hash){
        	$('ul.nav.nav-tabs#main-tab a[href="' + hash + '"]').tab('show');

        	if(hash == '#profession'){
        		loadProfessions();
        	}
        	if(hash == '#requirements'){
        		loadRequirements();
        	}
        	if(hash == '#event_types'){
        		loadEventType();
        	}
        }else{
        	loadProfessions();
        }

        $('#main-tab.nav.nav-tabs a').click(function (e) {
	        var scrollmem = $('body').scrollTop();
	        window.location.hash = this.hash;
	        $('html,body').scrollTop(scrollmem);
       	});
         
        //ON SHOWING THE TAB
	    $('#main-tab.nav.nav-tabs a').on('shown.bs.tab', function (event) {

	        var current_tab = $(event.target).attr('href');
	        if(current_tab == '#profession'){
	        	loadProfessions();
	        }
	        if(current_tab == '#requirements'){
	        	loadRequirements()
	        }
	        if(current_tab == '#event_types'){
	        	loadEventType();
	        }
	    });

	    //ON CLOSING THE TAB
	    $('#main-tab.nav.nav-tabs a[data-toggle="tab"]').on('hidden.bs.tab', function (e) {
			
			var prevTab = $(e.target).attr('href');
			if(prevTab == '#profession'){
				tblProfession.destroy();
	        }

	        if(prevTab == '#requirements'){
	        	tblRequirement.destroy();
	        }

	        if(prevTab == '#event_types'){
	        	tblEventTypes.destroy();
	        }
		});

		//FORM SETTINGS
		$('form#formSettings').validate();
		$(document).on('click', '#btnSaveSettings', function(){
			bootbox.confirm('Are you sure you want to save all changes?', function(result){
				if(result){
					$('form#formSettings').trigger('submit');
				}
			});
		});

    });

    function loadProfessions(){
    	tblProfession = $('table#tblProfession').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('settings.profession.datatable') }}',
               global: false,
           },
           columnDefs: [
                {targets:  5, className: 'no-wrap', sortable: false},
           ],
           columns: [
               { data: 'profession_name', name: 'profession_name'},
               { data: 'is_multiple', name: 'is_multiple'},
               { data: 'amount', name: 'amount'},
               { data: 'created_by', name: 'created_by'},
               { data: 'created_at', name: 'created_at'},
               { data: 'actions', name: 'actions' }
           ],
           fnCreatedRow: function(row, data, index){

	            $('button.btn-delete', row).click(function(){
	            	var url = $(this).data('url');
	                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.profession_name + '</span>?', function(result){
	                    if(result){
	                        $.ajax({
		                        url: url,
		                        data: {_method: 'delete'},
		                        type: 'post',
		                        dataType: 'json'
	                        }).done(function(response){
	                          	tblProfession.ajax.reload(null, false);
	                      	});
	                    }
	                });
	            });

	            $('button.btn-edit', row).click(function(){
	            	location.href = $(this).data('url');
	            });
           }

       });
    }

    function loadRequirements(){
    	tblRequirement = $('table#tblRequirement').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('requirements.datatable') }}',
               global: false,
           },
           columnDefs: [
                {targets:  [1,6], className: 'no-wrap', sortable: false},
           ],
           columns: [
               { data: 'requirement_name', name: 'requirement_name'},
               { data: 'requirement_description', name: 'requirement_description'},
               { data: 'validity', name: 'validity'},
               { data: 'term', name: 'term'},
               { data: 'dates_required', name: 'dates_required'},
               { data: 'status', name: 'status'},
               { data: 'actions', name: 'actions' }
           ],
           fnCreatedRow: function(row, data, index){

	            $('button.btn-delete', row).click(function(){
	            	var url = $(this).data('url');
	                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.requirement_name + '</span>?', function(result){
	                    if(result){
	                        $.ajax({
		                        url: url,
		                        data: {_method: 'delete'},
		                        type: 'post',
		                        dataType: 'json'
	                        }).done(function(response){
	                          	tblRequirement.ajax.reload(null, false);
	                      	});
	                    }
	                });
	            });

	            $('button.btn-edit', row).click(function(){
	            	location.href = $(this).data('url');
	            });
           }

       });
    }

    function loadEventType(){
    	tblEventTypes = $('table#tblEventTypes').DataTable({
           processing: true,
           serverSide: true,
           ajax: {
               url: '{{ route('event_type.datatable') }}',
               global: false,
           },
           columnDefs: [
                {targets:  [3], className: 'no-wrap', sortable: false},
           ],
           columns: [
           		{ data: 'name', name: 'name' },
           		{ data: 'description', name: 'description' },
           		{ data: 'amount', name: 'amount' },
               	{ data: 'actions', name: 'actions' }
           ],
           fnCreatedRow: function(row, data, index){

	            $('button.btn-delete', row).click(function(){
	            	var url = $(this).data('url');
	                bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.name + '</span>?', function(result){
	                    if(result){
	                        $.ajax({
		                        url: url,
		                        data: {_method: 'delete'},
		                        type: 'post',
		                        dataType: 'json'
	                        }).done(function(response){
	                          	tblEventTypes.ajax.reload(null, false);
	                      	});
	                    }
	                });
	            });

	            $('button.btn-edit', row).click(function(){
	            	location.href = $(this).data('url');
	            });
           }

       });
    }
	</script>
@stop