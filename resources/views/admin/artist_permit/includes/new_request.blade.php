<h6 class="kt-font-dark kt-margin-b-10 kt-font-transform-u">Filter Data</h6>
<form class="kt-form kt-form--fit kt-margin-b-20 border kt-padding-20" id="new-request-frm" method="get">
	<section class="row form-group form-group-sm">
		<div class="col-sm-4 kt-padding-t-20">
			<div class="kt-checkbox-inline kt-margin-t-">
				<label class="kt-checkbox">
					<input type="checkbox" name="today" value="{{ date('Y-m-d') }}" data-type="new_request"> Submitted Today
					<span></span>
				</label>
				<label class="kt-checkbox">
					<input type="checkbox"  name="issued_date" value="{{\Carbon\Carbon::now()->addWeek(1)->format('Y-m-d') }}" data-type="new_request"> Action Needed
					<span></span>
				</label>
			</div>
		</div>
		<div class="col-sm-8">
			<section class="row">
				<div class="col-sm-4">
					<label>Applied Date</label>
					<input type="text" class=" form-control form-control-sm" placeholder="Start date of permit" autocomplete="off" name="permit_start">
				</div>
				<div class="col-sm-4">
					<label>Permit Status</label>
					<select class="form-control form-control-sm" name="permit_status" data-type="new_request">
						<option selected disabled>-Select All-</option>
						<option value="new">New</option>
						<option value="processing">Processing</option>
						<option value="pending from client">Pending from client</option>
						<option value="New-update from client">New-update from client</option>
						<option value="unprocessed">unprocessed</option>
						<option value="locked">Locked</option>
					</select>
				</div>
				<div class="col-sm-4">
					<label>Request Type</label>
					<select class="form-control form-control-sm" name="request_type" data-type="new_request">
						<option selected disabled>-Select All-</option>
						<option value="new">New </option>
						<option value="renew">Renew</option>
						<option value="amend">Amend</option>
						<option value="cancel">Cancel</option>
					</select>
				</div>
			</section>
		</div>
	</section>
	<div class="kt-separator kt-separator--sm kt-separator--dashed kt-margin-t-10 kt-margin-b-10"></div>
	<div class="row">
		<div class="col-lg-6">
			<button type="submit" class="btn btn-warning btn-sm btn-elevate kt-font-transform-u" id="kt_search">Apply Filter</button>
			<button type="reset" class="btn btn-secondary btn-sm btn-elevate kt-font-bold kt-font-transform-u" id="kt_reset">Clear</button>
		</div>
	</div>
</form>
<table class="table  table-hover  table-borderless table-striped" id="artist-permit">
	<thead class="thead-dark">
	<tr>
		<th>Reference No.</th>
		<th>Company Name</th>
		<th>Applied Date</th>
		<th>No. of Artist
			<span data-content="The number of artist that already checked"
						data-original-title=""  data-container="body" data-toggle="kt-popover"
						data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
			</span>
		</th>
		<th>Request Type</th>
		<th>Permit Status</th>
	</tr>
	</thead>
</table>
@section('script')
	<script>
		var artistPermit = {};
		var filter ={
			today: null,
			action_needed: null,
			getAction: function () {
				return this.action_needed;
			},
			getToday: function () {
				return this.today;
			}
		};
		$(document).ready(function () {

			var start = moment().subtract(29, 'days');
			var end = moment();

			$('input[name=permit_start]').daterangepicker({
				autoUpdateInput: false,
				buttonClasses: 'btn',
				applyClass: 'btn-warning btn-sm btn-elevate',
				cancelClass: 'btn-secondary btn-sm btn-elevate',
				startDate: start,
				endDate: end,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				}
			},function(start, end, label) {
				$('input[name=permit_start].form-control').val( start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
			});


			$('input[type=checkbox][data-type=new_request][name=today]').click(function () {
				filter.today = $(this).is(':checked') ? $(this).val() : null;
			});
			$('input[type=checkbox][data-type=new_request][name=issued_date]').click(function () {
				filter.action_needed = $(this).is(':checked') ? $(this).val() : null;
			});
			var new_request_form = $('form#new-request-frm');
			new_request_form.submit(function (e) {
				e.preventDefault();
				artistPermit.ajax.reload(null, false);
			});

			new_request_form.find('button[type=reset]').click(function () {
				filter.today =null;
				filter.action_needed = null;
				new_request_form[0].reset();
				artistPermit.ajax.reload(null, false);
			});

			artistPermit = $('table#artist-permit').DataTable({
				ajax: {
					url: '{{ route('admin.artist_permit.datatable') }}',
					data: function(d){
						d.request_type = $('select[name=request_type][data-type=new_request]').val();
						d.permit_status = $('select[name=permit_status][data-type=new_request]').val();
						// d.permit_status = $('input[name=permit_start]').val();
						d.issued_date = filter.getAction();
						d.today = filter.getToday();
						d.status = [
							'new', 'edit', 'processing', 'pending from client',
							'approved-unpaid', 'unprocessed', 'new-update  from client'
						];
					}
				},
				columnDefs: [
					{targets: '_all', className: 'no-wrap'},
					{targets: 5,sortable: false},
				],
				columns: [
					{ data: 'reference_number'},
					{ data: 'company_name'},
					{ data: 'applied_date'},
					{ data: 'artist_number'},
					// { data: 'company_type'},
					{ data: 'request_type'},
					{ data: 'permit_status'},
				],

				createdRow: function(row, data, index){
					$(row).click(function(){
						location.href = '{{ url('/artist_permit') }}/'+data.permit_id+'/application';
					});
				}
			});
		});

	</script>
@stop