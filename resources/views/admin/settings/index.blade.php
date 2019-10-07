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
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u kt-font-dark">System Settings</h3>
				 </div>
				 <div class="kt-portlet__head-toolbar">
						<a href="{{ URL::previous() }}" class="btn btn-sm btn-maroon btn-elevate kt-font-transform-u">
							 <i class="la la-arrow-left"></i>
							 Back
						</a>
				 </div>
			</div>
			<div class="kt-portlet__body kt-padding-t-5">
				 <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-2x nav-tabs-line-danger" role="tablist">
						<li class="nav-item">
							 <a class="nav-link active" data-toggle="tab" href="#kt_tabs_9_1" role="tab">
									{{--									<i class="flaticon-time-2"></i> --}}
									Artist Permit
							 </a>
						</li>
						<li class="nav-item dropdown">
							 <a class="nav-link " href="#" role="button" aria-expanded="false">
									{{--									<i class="flaticon-placeholder-2"></i>--}}
									Event Permit
							 </a>
						</li>
						<li class="nav-item">
							 <a class="nav-link" data-toggle="tab" href="#kt_tabs_9_3" role="tab" aria-selected="false">Inspection</a>
						</li>
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane active" id="kt_tabs_9_1" role="tabpanel">
							 @include('admin.settings.artist-permt.setting')
						</div>
						<div class="tab-pane" id="kt_tabs_9_2" role="tabpanel">
							 It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the
							 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently.
						</div>
						<div class="tab-pane" id="kt_tabs_9_3" role="tabpanel">
							 Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
							 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
						</div>
				 </div>
			</div>
	 </section>
@stop
@section('script')
	 <script>
     $(document).ready(function () {
       professionTable();
     });

     function professionTable() {
       $('table#profession-table').DataTable({
         dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
           "<'row'<'col-sm-12'tr>>" +
           "<'row'<'col-sm-12 col-md-5' i><'col-sm-12 col-md-7'p>>",
         ajax: {
           url: '{{ route('admin.setting.profession.datatable') }}',
           data: function (d) {
           }
         },
         columnDefs: [
           {targets: []}
         ],
         columns: [
           {data: 'name'},
           {data: 'amount'},
           {data: 'is_multiple'},
           {data: 'created_by'},
           {data: 'created_at'},
           {
             render: function (display, full, data, meta) {

             }
           },
         ]
       });
     }
	 </script>
@stop