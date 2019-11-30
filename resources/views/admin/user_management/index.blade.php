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
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Employee Management') }}</h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
					<a href="{{ URL::signedRoute('user_management.create') }}" class="btn btn-sm btn-warning btn-elevate kt-font-transform-u">
						 {{ __('ADD EMPLOYEE') }}
					</a>
			 	</div>
			 	{{-- {{ Auth::user()->roles()->first()->NameEn }} --}}
			</div>
			<div class="kt-portlet__body kt-padding-t-20">
				<table class="table table-borderless table-striped table-hover border" id="tblUser">
					 <thead>
					 <tr>
							<th>{{ __('EMPLOYEE') }}</th>
							<th>{{ __('DEPARTMENT') }}</th>
							<th>{{ __('ROLE') }}</th>
							<th>{{ __('DATE ADDED') }}</th>
							<th>{{ __('STATUS') }}</th>
							<th>{{ __('ACTIONS') }}</th>
					 </tr>
					 </thead>
				</table>
			</div>
	 </section>
@stop
@section('script')
	<script>
		var tblUser;
		$(document).ready(function(){
			tblUser = $('#tblUser').DataTable({
				processing: true,
	           	serverSide: true,
	           	ajax: {
	               url: '{{ route('user_management.datatable') }}',
	               global: false,
	           	},
	           	// columnDefs: [
	            //     {targets:  [3], className: 'no-wrap', sortable: false},
	           	// ],
	           	columns: [
	           		{ data: 'name', name: 'name' },
	           		{ data: 'department', name: 'department' },
	           		{ data: 'role', name: 'role' },
	           		{ data: 'CreatedAt', name: 'CreatedAt' },
	           		{ data: 'status', name: 'status' },
	               	{ data: 'actions', name: 'actions' }
	           	],
	           	fnCreatedRow: function(row, data, index){

	           		$(row).click(function(){
	           			location.href = data.show_url;
	           		});

		            // $('button.btn-delete', row).click(function(){
		            // 	var url = $(this).data('url');
		            //     bootbox.confirm('Are you sure you want delete the <span class="text-success"> ' + data.name + '</span>?', function(result){
		            //         if(result){
		            //             $.ajax({
			           //              url: url,
			           //              data: {_method: 'delete'},
			           //              type: 'post',
			           //              dataType: 'json'
		            //             }).done(function(response){
		            //               	tblEventTypes.ajax.reload(null, false);
		            //           	});
		            //         }
		            //     });
		            // });

		            // $('button.btn-edit', row).click(function(){
		            // 	location.href = $(this).data('url');
		            // });
	           	}
			});
		});
	</script>
@stop