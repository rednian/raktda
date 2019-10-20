@extends('layouts.admin.admin-app')
@section('style')
<link rel="stylesheet" href="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css') }}">
@stop
@section('content')

	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body kt-padding-t-5">
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 " role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">New Event Requests</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#processing-permit">Processing Events</a></li>
						<li class="nav-item"><a class="nav-link " data-toggle="tab" href="#active-permit">Active Events</a></li>
						<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#archieve-permit">Archive Events</a></li>
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="new-request" role="tabpanel">
               @include('admin.artist_permit.includes.summary')
							 <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
									<label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
									<select onchange="newEventTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="new-permit-status">
										 <option value="new">New</option>
										 <option value="amend">Amend</option>
									</select>
									<label for="inlineFormInputName2" class="kt-margin-5"></label>
									<select onchange="newEventTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="new-applicant-type">
										 <option value="1">Private</option>
										 <option value="3">Government</option>
										 <option value="2">Individual</option>
									</select>
									<label for="inlineFormInputName2"></label>
									<input type="text" id="new-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15" placeholder="Start date of permit" autocomplete="off">
							 </section>
							 
							 <table class="table table-hover " id="new-event-request">
									<thead class="thead-dark">
									<tr>
										 <th>Reference No.</th>
										 <th>Establishment</th>
										 <th>Permit Owner</th>
										 <th>Event Name</th>
										 <th>Applied Date</th>
										 <th>Applicant Type</th>
										 <th>Start Date</th>
										 <th>Status</th>
									</tr>
									</thead>
							 </table>
						</div>
						<div class="tab-pane fade" id="processing-permit" role="tabpanel">
               @include('admin.artist_permit.includes.summary')
                <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
                  <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
                  <select onchange="eventProcessingTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="processing-permit-status">
                     <option value="approved-unpaid">Approved-unpaid</option>
                     <option value="processing">Processing</option>
                  </select>
                  <label for="inlineFormInputName2" class="kt-margin-5"></label>
                  <select onchange="eventProcessingTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="processing-applicant-type">
                     <option value="1">Private</option>
                     <option value="3">Government</option>
                     <option value="2">Individual</option>
                  </select>
                  <label for="inlineFormInputName2"></label>
                  <input type="text" id="processing-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15" placeholder="Start date of permit" autocomplete="off">
                </section>
							 <table class="table table-head-noborder table-borderless table-striped" id="new-event-processing">
									<thead class="thead-dark">
                  <tr>
                     <th>Reference No.</th>
                     <th>Establishment</th>
                     <th>Permit Owner</th>
                     <th>Event Name</th>
                     <th>Applied Date</th>
                     <th>Applicant Type</th>
                     <th>Start Date</th>
                     <th>Status</th>
                  </tr>
                  </thead>
							 </table>
						</div>
						<div class="tab-pane fade" id="active-permit" role="tabpanel">
               @include('admin.artist_permit.includes.summary')

                <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
                  <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
                  {{-- <select onchange="eventProcessingTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="active-permit-status">
                     <option value="new">New</option>
                     <option value="amend">Amend</option>
                  </select> --}}
                  <label for="inlineFormInputName2" class="kt-margin-5"></label>
                  <select onchange="eventProcessingTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="active-applicant-type">
                     <option value="1">Private</option>
                     <option value="3">Government</option>
                     <option value="2">Individual</option>
                  </select>
                  <label for="inlineFormInputName2"></label>
                  <input type="text" id="new-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15" placeholder="Start date of permit" autocomplete="off">
                </section>

							 <table class="table table-head-noborder table-borderless table-striped" id="new-event-active">
									<thead class="thead-dark">
                  <tr>
                     <th>Reference No.</th>
                     <th>Permit No.</th>
                     <th>Establishment</th>
                     <th>Permit Owner</th>
                     <th>Event Name</th>
                     <th>Applied Date</th>
                     <th>Applicant Type</th>
                     <th>Actions</th>
                  </tr>
                  </thead>
							 </table>
						</div>
						<div class="tab-pane fade" id="archieve-permit" role="tabpanel">
               @include('admin.artist_permit.includes.summary')
               <section class="form-inline kt-padding-5 kt-margin-b-5" style="background:#f5f5f5">
                 <label for="inlineFormInputName2" class="kt-margin-5 kt-font-dark"><span class="fa fa-filter kt-margin-r-5"></span> Filter By :</label>
                 <select onchange="eventArchiveTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="archive-permit-status">
                    <option value="expired">Expired</option>
                    <option value="rejected">Rejected</option>
                 </select>
                 <label for="inlineFormInputName2" class="kt-margin-5"></label>
                 <select onchange="eventArchiveTable.draw();" multiple="multiple" class=" mb-2 mr-sm-2 kt-margin-l-15" id="archive-applicant-type">
                    <option value="1">Private</option>
                    <option value="3">Government</option>
                    <option value="2">Individual</option>
                 </select>
                 <label for="inlineFormInputName2"></label>
                 <input type="text" id="new-applied-date" class="form-control mb-2 mr-sm-2 kt-margin-l-15" placeholder="Start date of permit" autocomplete="off">
               </section>
							 <table class="table table-head-noborder table-borderless table-striped" id="new-event-archive">
									<thead class="thead-dark">
                  <tr>
                     <th>Reference No.</th>
                     <th>Establishment</th>
                     <th>Permit Owner</th>
                     <th>Event Name</th>
                     <th>Applicant Type</th>
                     <th>Start Date</th>
                     <th>Status</th>
                     <th>Action</th>
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
			var newEventTable = {};
     var artistPermit = {};
     var eventProcessingTable= {};
     var eventArchiveTable = {};
     var eventActiveTable = {};
     var filter = {
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
       newEvent();
       
       var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-tabs a').click(function (e) {
          $(this).tab('show');
          var scrollmem = $('body').scrollTop();
          window.location.hash = this.hash;
          $('html,body').scrollTop(scrollmem);
        });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var current_tab = $(e.target).text();
        console.log(current_tab);
        if('Processing Events' == current_tab  && !$.fn.dataTable.isDataTable('table#new-event-processing')){ processing(); }
        if('Active Events' == current_tab  && !$.fn.dataTable.isDataTable('table#new-event-active')){ active(); }
        if('Archive Events' == current_tab  && !$.fn.dataTable.isDataTable('table#new-event-archive')){ archive(); }
      });

     

     });

     function archive() {
      $('select#archive-permit-status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Event Status',
        autoWidth: true,
        width: '24%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

      $('select#archive-applicant-type').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Applicant Type',
        autoWidth: true,
        width: '37%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

     eventArchiveTable = $('table#new-event-archive').DataTable({
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
          
          var status = $('select#processing-permit-status').val(); 
          var type = $('select#processing-applicant-type').val();

          d.status = status.length > 0 ? status : ['expired', 'rejected'];
          d.type =  type.length > 0 ? type : null;

          }
        },
        columnDefs: [
          {targets: '_all', className: 'no-wrap'}
        ],
        columns: [
          {data: 'reference_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          {data: 'type'},
          {data: 'start'},
          {data: 'status'},
          {data: 'action'},
        ],
        createdRow: function (row, data, index) {
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=archieve-permit';
          });
        }
      });
     }

     function active() {
      $('select#active-applicant-type').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Applicant Type',
        autoWidth: true,
        width: '37%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

      eventActiveTable = $('table#new-event-active').DataTable({
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            var status = $('select#processing-permit-status').val(); 
            var type = $('select#processing-applicant-type').val();

            // d.status = status.length > 0 ? status : ['approved-unpaid', 'unprocessed'];
            d.status = ['active'];
            d.type =  type.length > 0 ? type : null; 
          }
        },
        columnDefs: [
          {targets: '_all', className: 'no-wrap'}
        ],
        columns: [
          {data: 'reference_number'},
          {data: 'permit_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          {data: 'created_at'},
          {data: 'type'},
          {data: 'action'},
          // {data: 'status'}
        ],
        createdRow: function (row, data, index) {
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=active-permit';
          });
        }
      });
     }

     function processing() {
      $('select#processing-permit-status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Event Status',
        autoWidth: true,
        width: '21%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });

      $('select#processing-applicant-type').select2({
        minimumResultsForSearch: Infinity,
        placeholder: 'Applicant Type',
        autoWidth: true,
        width: '37%',
        // closeOnSelect: false,
        allowClear: true,
        tags: true
      });
      eventProcessingTable = $('table#new-event-processing').DataTable({
        ajax: {
          url: '{{ route('admin.event.datatable') }}',
          data: function (d) {
            var status = $('select#processing-permit-status').val(); 
            var type = $('select#processing-applicant-type').val();

            d.status = status.length > 0 ? status : ['approved-unpaid', 'processing', 'need approval'];
            d.type =  type.length > 0 ? type : null;
          }
        },
        columnDefs: [
          {targets: '_all', className: 'no-wrap'}
        ],
        columns: [
          {data: 'reference_number'},
          {data: 'establishment_name'},
          {data: 'owner'},
          {data: 'event_name'},
          {data: 'created_at'},
          {data: 'type'},
          {data: 'start'},
          {data: 'status'}
        ],
        createdRow: function (row, data, index) {
          $(row).click(function () {
            location.href = '{{ url('/event') }}/' + data.event_id+'?tab=processing-permit';
          });
        }
      });
     }

     function newEvent() {
       newEventTable = $('table#new-event-request').DataTable({
         ajax: {
           url: '{{ route('admin.event.datatable') }}',
           data: function (d) {
            var status = $('select#new-permit-status').val(); 
            var type = $('select#new-applicant-type').val();

             d.status = status.length > 0 ? status : ['new', 'amend'];
             d.type =  type.length > 0 ? type : null;

           }
         },
         columnDefs: [
           {targets: '_all', className: 'no-wrap'}
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'establishment_name'},
           {data: 'owner'},
           {data: 'event_name'},
           {data: 'created_at'},
           {data: 'type'},
           {data: 'start'},
           {data: 'status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/event') }}/' + data.event_id + '/application';
           });
         }
       });

       $('select#new-permit-status').select2({
         minimumResultsForSearch: Infinity,
         placeholder: 'Event Status',
         autoWidth: true,
         width: '21%',
         // closeOnSelect: false,
         allowClear: true,
         tags: true
       });

       $('select#new-applicant-type').select2({
         minimumResultsForSearch: Infinity,
         placeholder: 'Applicant Type',
         autoWidth: true,
         width: '37%',
         // closeOnSelect: false,
         allowClear: true,
         tags: true
       });
     }
	 </script>
@endsection

	 
