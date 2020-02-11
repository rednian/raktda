@extends('layouts.app')

@section('title', __('Notifications') . ' - ' . __('Smart Government Rak'))

@section('style')
<style>
	.unread {
		background-color: #e0e8ff;
	}

	table tbody tr td {
		border-style: dashed !important;
		border-color: #CCC !important;
	}
</style>
@stop
@section('content')
<section class="kt-portlet  kt-portlet--head-sm kt-portlet--responsive-mobile">
	<div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
		<div class="kt-portlet__head-label">
			<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">{{ __('Notifications') }}</h3>
		</div>
	</div>
	<div class="kt-portlet__body kt-padding-t-0">
		<table class="table table-bordered border table-sm" id="tblNotifications">
			<thead class="kt-hide">
				<tr>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
</section>
@stop
@section('script')
<script>
	$(document).ready(function(){
			$('table#tblNotifications').DataTable({
	           processing: true,
	           serverSide: true,
	           ajax: {
	               url: '{{ route('company.notifications.datatable') }}',
	               global: false,
	           },
	           columns: [
	               { data: 'notification', name: 'notification'},
	           ],
	           fnCreatedRow: function(row, data, index){
		            if(data.status == 'unread'){
		            	$(row).addClass('unread');
		            }

		            //ON CLICK NOTIFICATION
		            $(row).click(function(){
		            	toRead(data.id, data.url);
		            });
	           }
	       });
		});
</script>
@stop