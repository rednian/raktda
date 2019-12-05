@extends('layouts.admin.admin-app')
@section('style')
<style>
  .widget-toolbar{ cursor: pointer; }
</style>
{{-- <style>
  .twitter-typeahead {
    display: inline !important;
}

.typeahead-content {
    box-shadow: 0 1px 2px rgba(0,0,0,.26);
    background-color: #fff;
    cursor: pointer;
    margin-top: -15px;
    min-width: 100px;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    position: absolute;
    white-space: nowrap;
    z-index: 1001;
    will-change: width,height;
}

.typeahead-highlight {
    font-weight: 900;
}

.typeahead-suggestion {
    padding: 5px 0px 10px 10px;
}

.typeahead-suggestion:hover {
    background-color: #42A5F5;
    color: #FFF;
}

.typeahead-notfound {
    cursor:not-allowed;
    padding: 5px 0px 10px 10px;
}
</style> --}}
@endsection
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body">
        
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('New Request Permits') }}</a></li>
				 </ul>
          <div class="form-row d-none" style="position: absolute; right: -80px; top: 23px; width: 30%">
            <div class="col-12">
                <div class="input-group input-group-sm">
                    <div class="kt-input-icon kt-input-icon--right" id="search-application">
                      <input name="value" autocomplete="off" type="text" class="form-control form-control-sm typeahead" aria-label="Text input with checkbox" placeholder="Search application or artist ...">
                      <span class="kt-input-icon__icon kt-input-icon__icon--right">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
              </div>
            </div>
          </div>
        
				 <div class="tab-content">
						<div class="tab-pane show fade active" id="new-request" role="tabpanel">
									@include('admin.artist_permit.includes.new_request')
							{{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
							 @else
									@empty()
										 No New Request Permit
									@endempty
							 @endif --}}
						</div>
            
						
						
						
						
						
				 </div>
			</div>
	 </section>
@endsection
@section('script')
<script type="text/javascript">

  var artistPermit = {};
  var pendingPermit = {};
  var processingPermit = {};
  var activePermit = {};
  var archivePermit = {};
  var active_artist_table = {};

  var hash = window.location.hash;

  $(document).ready(function () {
    $("#kt_page_portlet > div > section > div:nth-child(1) > div").click(function(){
       $('.nav-tabs a[href="#new-request"]').tab('show');
    });
    $("#kt_page_portlet > div > section > div:nth-child(2) > div").click(function(){
     $('.nav-tabs a[href="#pending-request"]').tab('show');
    });
    //   $("#kt_page_portlet > div > section > div:nth-child(3) > div").click(function(){
    //  $('.nav-tabs a[href="#new-request"]').tab('show');
    // });
    // Instantiate the Bloodhound suggestion engine
    var result = new Bloodhound({
      datumTokenizer: function(datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
      },
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      remote: {
        wildcard: '%QUERY',
        url: '{{ route('admin.artist_permit.search') }}?q=%QUERY',
        transform: function(response) {
          console.log(response);
          // Map the remote source JSON array to a JavaScript object array
          return $.map(response.reference_number, function(data) {
            return {
              value: data.result
            };
          });
        }
      }
    });

    // Instantiate the Typeahead UI
    $('.typeahead').typeahead(null, {
      hint: true,
      highlight: true,
      minLength: 1,
      display: 'value',
      source: result,
     templates: {
        empty: [
          '<div class="empty-message">',
            'unable to find any Best Picture winners that match the current query',
          '</div>'
        ].join('\n'),
        suggestion: Handlebars.compile('<div><strong>@{{value}}</strong> – @{{year}}</div>')
      }
    });


    newRequest();
    setInterval(function(){ newRequest(); pendingRequest();}, 100000);

    hash && $('ul.nav a[href="' + hash + '"]').tab('show');
    
    $('.nav-tabs a').click(function (e) {
      $(this).tab('show');
      var scrollmem = $('body').scrollTop();
      window.location.hash = this.hash;
      $('html,body').scrollTop(scrollmem);
    });
  });


        
     function newRequest() {

       var start = moment().subtract(29, 'days');
       var end = moment();
       var selected_date = [];

       $('input#new-applied-date').daterangepicker({
         autoUpdateInput: false,
         buttonClasses: 'btn',
         applyClass: 'btn-warning btn-sm btn-elevate',
         cancelClass: 'btn-secondary btn-sm btn-elevate',
         startDate: start,
         endDate: end,
         maxDate: new Date,
         ranges: {
           '{{ __('Today') }}': [moment(), moment()],
           '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
           '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
           '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
           '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         }
       }, function (start, end, label) {
         $('input#new-applied-date.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
       }).on('apply.daterangepicker', function(e, d){
        selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
        artistPermit.draw();
       });


       artistPermit = $('table#artist-permit').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: {
          url: '{{ route('admin.artist_permit.datatable') }}',
          data: function (d) {
             // var status = $('select#new-permit-status').val();
             d.request_type = $('select#new-request-type').val();
             d.status = ['new'];
             d.date = $('#new-applied-date').val()  ? selected_date : null; 
           }
         },
         // order: [[ 3, "desc" ]],
         columnDefs: [
           {targets: [0, 2, 4, 5], className: 'no-wrap'},
         ],
         columns: [
           {data: 'reference_number'},
           {data: 'company_name'},
           {data: 'artist_number'},
           {data: 'request_type'},
           {data: 'applied_date'},
           {data: 'permit_status'}
         ],
         createdRow: function (row, data, index) {
           $(row).click(function () {
             location.href = '{{ url('/artist_permit') }}/' + data.permit_id + '/application';
           });
         },
         initComplete: function(setting, json){
          $('#new-count').html(json.new_count);
          $('#pending-count').html(json.pending_count);
          $('#cancelled-count').html(json.cancelled_count);
         }
       });

       //clear fillte button
       $('#new-btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); artistPermit.draw();});

       artistPermit.page.len($('#new-length-change').val());
       $('#new-length-change').change(function(){ artistPermit.page.len( $(this).val() ).draw(); });

       var search = $.fn.dataTable.util.throttle(function(v){ artistPermit.search(v).draw(); }, 500);
       $('input#search-new-request').keyup(function(){ search($(this).val()); });
     }
</script>
@endsection
