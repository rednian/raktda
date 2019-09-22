@extends('layouts.admin.admin-app')
@section('content')
<section  class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
   <div class="kt-portlet__body kt-padding-t-5" style="position: relative">
		 <ul class="nav nav-tabs kt-margin-t-15 " role="tablist">
			 <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" data-target="#kt_tabs_1_1">New Request Permits</a></li>
			 {{--<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#kt_tabs_1_2">Processing Permits</a></li>--}}
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
				@include('admin.artist_permit.includes.new_request')
      </div>
      {{--<div class="tab-pane" id="kt_tabs_1_2" role="tabpanel">--}}
				{{--@include('admin.artist_permit.includes.summary')--}}
				{{--<table class="table table-hover table-striped table-borderless" id="table-artist-processing">--}}
					{{--<thead class="thead-dark">--}}
					{{--<tr>--}}
						{{--<th>Reference No.</th>--}}
						{{--<th>Company Name</th>--}}
						{{--<th>Trade License No.</th>--}}
						{{--<th>Applied Date</th>--}}
						{{--<th>Permit Start</th>--}}
						{{--<th>No. of Artist</th>--}}
						{{--<th>Request Type</th>--}}
					{{--</tr>--}}
					{{--</thead>--}}
				{{--</table>--}}
      {{--</div>--}}
      <div class="tab-pane" id="kt_tabs_1_3" role="tabpanel">
				@include('admin.artist_permit.includes.summary')
				<table class="table  table-hover  table-borderless table-striped" id="artist-permit-rejected">
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
      </div>
      <div class="tab-pane" id="kt_tabs_1_4" role="tabpanel">
				@include('admin.artist_permit.includes.summary')
      </div>
    </div>
   </div>
</section>
<section class="row">
  <div class="col">
    <section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">
       <div class="kt-portlet__body" > 
          

          
        
       </div>
    </section>
  </div>
</section>
@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		rejectedTable();

});
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
@endsection