@extends('layouts.admin.admin-app')
@section('content')
<section  class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
   <div class="kt-portlet__body kt-padding-t-5" style="position: relative">
		 <ul class="nav nav-tabs kt-margin-t-15 " role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">New Request Permits</a></li>
			 <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_2">Processing Permits</a></li>
			 <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_3">Rejected Permits</a></li>
			 <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kt_tabs_1_4">Approved Permits</a></li>
		 </ul>
			 {{--<div class="row" style="position: absolute; top: 15px; right: 20px">--}}
				 {{--<div class="col-12">--}}
					 {{--<div class="kt-input-icon kt-input-icon--right">--}}
						 {{--<input type="text" class="form-control-sm form-control kt-input" placeholder="Search...">--}}
						 {{--<span class="kt-input-icon__icon kt-input-icon__icon--right"><span><i class="la la-search"></i></span></span>--}}
					 {{--</div>--}}
				 {{--</div>--}}
			 {{--</div>--}}

    <div class="tab-content">
      <div class="tab-pane active" id="kt_tabs_1_1" role="tabpanel">
				@include('admin.artist_permit.includes.summary')
				{{--@include('admin.artist_permit.includes.new_request')--}}
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
										<option selected disabled>-Select Permit Status-</option>
										<option value="new">New</option>
										<option value="modified">Pending from client</option>
										<option value="modification request">New-update from client</option>
										<option value="unprocessed">Unprocessed</option>
										{{--<option value="locked">Locked</option>--}}
									</select>
								</div>
								<div class="col-sm-4">
									<label>Request Type</label>
									<select class="form-control form-control-sm" name="request_type" data-type="new_request">
										<option selected disabled>-Select Request Type-</option>
										<option value="new">New Application</option>
										<option value="renew">Renew Application</option>
										<option value="amend">Amend Application</option>
										<option value="cancel">Cancel Application</option>
									</select>
								</div>
							</section>
						</div>
					</section>
					<div class="kt-separator kt-separator--sm kt-separator--dashed kt-margin-t-10 kt-margin-b-10"></div>
					<div class="row">
						<div class="col-lg-6">
							<button type="submit" class="btn btn-warning btn-sm btn-elevate kt-font-transform-u" id="kt_search">Apply Filter</button>
							<button type="reset" class="btn btn-secondary btn-sm btn-elevate kt-font-bold kt-font-transform-u" id="kt_reset">Clear Filter</button>
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

			</div>
			<div class="tab-pane" id="kt_tabs_1_2" role="tabpanel">
				@include('admin.artist_permit.includes.summary')
				<table class="table  table-hover  table-borderless table-striped" id="artist-permit-processing">
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
			</div>
      <div class="tab-pane" id="kt_tabs_1_3" role="tabpanel">
				@include('admin.artist_permit.includes.summary')
				<table class="table  table-hover  table-borderless table-striped" id="artist-permit-rejected">
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
      </div>
      <div class="tab-pane" id="kt_tabs_1_4" role="tabpanel">
				@include('admin.artist_permit.includes.summary')
				<table class="table  table-hover  table-borderless table-striped" id="artist-permit-approved">
					<thead class="thead-dark">
					<tr>
						<th>Reference No.</th>
						<th>Permit Number</th>
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
      </div>
    </div>
   </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		rejectedTable();
		approvedTable();
		processingTable();
});

	function approvedTable() {
		$('table#artist-permit-approved').DataTable({
			ajax: {
				url: '{{ route('admin.artist_permit.datatable') }}',
				data: function(d){
					// d.request_type = $('select[name=request_type][data-type=new_request]').val();
					// d.permit_status = $('select[name=permit_status][data-type=new_request]').val();
					// d.permit_status = $('input[name=permit_start]').val();
					// d.issued_date = filter.getAction();
					// d.today = filter.getToday();
					d.status = ['active', 'expired'];
				}
			},
			columnDefs: [
				{targets: '_all', className: 'no-wrap'},
				{targets: 5,sortable: false},
			],
			columns: [
				{ data: 'reference_number'},
				{ data: 'permit_number'},
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
	}

	function processingTable(){
		$('table#artist-permit-processing').DataTable({
			ajax: {
				url: '{{ route('admin.artist_permit.datatable') }}',
				data: function(d){
					d.status = ['approved-unpaid', 'modification request'];
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
	}
	function rejectedTable() {
		$('table#artist-permit-rejected').DataTable({
			ajax: {
				url: '{{ route('admin.artist_permit.datatable') }}',
				data: function(d){
					// d.request_type = $('select[name=request_type][data-type=new_request]').val();
					// d.permit_status = $('select[name=permit_status][data-type=new_request]').val();
					// d.permit_status = $('input[name=permit_start]').val();
					// d.issued_date = filter.getAction();
					// d.today = filter.getToday();
					d.status = ['rejected'];
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
	}
</script>
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
						'new', 'modified', 'processing', 'unprocessed'
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
@endsection