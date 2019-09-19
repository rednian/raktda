<table class="table table-hover table-striped table-borderless" id="artist-permit-processing">
	<thead class="thead-dark">
	<tr>
		<th>Reference No.</th>
		<th>Company Name</th>
		<th>Trade License No.</th>
		<th>Applied Date</th>
		<th>Permit Start</th>
		<th>No. of Artist</th>
		<th>Request Type</th>
	</tr>
	</thead>
</table>
@section('script')
	<script>
		var permit_processing = {};
		$(document).ready(function () {
			// processing permit table
			permit_processing = $('table#artist-permit-processing').DataTable({
				ajax: {
					url: '{{ route('admin.artist_permit.datatable') }}',
					data: function(d){
						d.status = 'processing';
					}
				},

				columnDefs: [
					{targets: [0,4, 5, 6], className: 'no-wrap'},
					{targets:  5, className: 'no-wrap',sortable: false},
				],

				columns: [
					{ data: 'reference_number'},
					{ data: 'company_name'},
					{ data: 'trade_license_number'},
					{ data: 'applied_date'},
					{ data: 'permit_start'},
					{ data: 'artist_number'},
					{ data: 'request_type'},
				],

				createdRow: function(row, data, index){
					$(row).click(function(){
						location.href = '{{ url('/artist_permit') }}/'+data.permit_id+'/application-details';
					});
				},
			});
		});
	</script>
	@stop
