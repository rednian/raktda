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
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">System Settings</h3>
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-0">
				 <ul id="main-tab" class="nav nav-tabs  nav-tabs-line nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10" role="tablist">
						<li class="nav-item">
							 <a class="nav-link active" data-toggle="tab" href="#profession" role="tab">Profession</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#requirements" role="tab">Requirements</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#event_types" role="tab">Event Types</a>
						</li>
						{{-- <li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#event_requirements" role="tab">Event Requirements</a>
						</li> --}}
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane active" id="profession" role="tabpanel">
							<section class="row">
								 <div class="col-12">
										<a href="{{ route('settings.profession.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">New Profession</a>
								 </div>
							</section>
							<table class="table table-borderless table-striped table-hover border table-sm" id="tblProfession">
								 <thead>
								 <tr>
										<th>PROFESSION NAME</th>
										<th>ALLOW MULTIPLE PERMIT</th>
										<th>PROFESSION FEE</th>
										<th>ADDED BY</th>
										<th>ADDED ON</th>
										<th>ACTIONS</th>
								 </tr>
								 </thead>
							</table>
						</div>
						<div class="tab-pane" id="requirements" role="tabpanel">
							<section class="row">
								 <div class="col-12">
										<a href="{{ route('requirements.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">New Requirement</a>
								 </div>
							</section>
							<table class="table table-borderless table-striped table-hover border table-sm" id="tblRequirement">
								 <thead>
								 <tr>
										<th>REQUIREMENT</th>
										<th>DESCRIPTION</th>
										<th>VALIDITY (months)</th>
										<th>PERMIT TERM</th>
										<th>DATE REQUIRED</th>
										<th>STATUS</th>
										<th>ACTIONS</th>
								 </tr>
								 </thead>
							</table>
						</div>
						<div class="tab-pane" id="event_types" role="tabpanel">
							 <section class="row">
								 <div class="col-12">
										<a href="{{ route('event_type.create') }}" class="btn btn-sm btn-warning btn-elevate kt-bold kt-font-transform-u kt-pull-right kt-margin-b-10">New Event Type</a>
								 </div>
							</section>
							<table class="table table-borderless table-striped table-hover border table-sm" id="tblEventTypes">
								 <thead>
								 <tr>
										<th>EVENT TYPE</th>
										<th>DESCRIPTION</th>
										<th>EVENT TYPE FEE</th>
										<th>ACTIONS</th>
								 </tr>
								 </thead>
							</table>
						</div>
						{{-- <div class="tab-pane" id="event_requirements" role="tabpanel">
							 
						</div> --}}
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

	        var current_tab = $(event.target).text();
	        if(current_tab == 'Profession'){
	        	loadProfessions();
	        }

	        if(current_tab == 'Requirements'){
	        	loadRequirements()
	        }

	        if(current_tab == 'Event Types'){
	        	loadEventType();
	        }

	        if(current_tab == 'Event Requirements'){

	        }
	    });

	    //ON CLOSING THE TAB
	    $('#main-tab.nav.nav-tabs a[data-toggle="tab"]').on('hidden.bs.tab', function (e) {
			
			var prevTab = $(e.target).text();
			if(prevTab == 'Profession'){
				tblProfession.destroy();
	        }

	        if(prevTab == 'Requirements'){
	        	tblRequirement.destroy();
	        }

	        if(prevTab == 'Event Types'){
	        	tblEventTypes.destroy();
	        }

	        if(prevTab == 'Event Requirements'){

	        }
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