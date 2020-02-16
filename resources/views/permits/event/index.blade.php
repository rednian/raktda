@extends('layouts.app')

@section('title', __('Event Permits') . ' - ' . __('Smart Government Rak'))

@section('style')
<style>
    .fc-unthemed .fc-event .fc-title,
    .fc-unthemed .fc-event-dot .fc-title {
        color: #fff;
    }

    .fc-unthemed .fc-event .fc-time,
    .fc-unthemed .fc-event-dot .fc-time {
        color: #fff;
    }

    .fc-content .fc-title .fc-description {
        color: #fff;
    }

    /* .fc-button-active {
        background: rgba(140, 39, 45, 0.5) !important;
        border: 1px solid #74788d !important;
    } */

    .widget-toolbar {
        cursor: pointer;
    }
</style>
@endsection
@section('content')

@if(check_is_blocked()['status'] == 'rejected')
@include('permits.artist.common.company_reject')
@endif

@if(check_is_blocked()['status'] == 'blocked')
@include('permits.artist.common.company_block')
@endif

<input type="hidden" id="lang_id" value="{{getLangId()}}">
<section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">

    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 "
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#applied"
                            data-target="#applied">{{__('Applied Permits')}} </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#valid">{{__('Valid Permits')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#expired">{{__('Expired Permits')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cancelled">{{__('History')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#draft">{{__('Drafts')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#calendar">{{__('Calendar')}}</a>
                    </li>
                    @if(check_is_blocked()['status'] != 'blocked' && check_is_blocked()['status'] != 'rejected')
                    <span class="nav-item"
                        style="position:absolute; {{Auth::user()->LanguageId == 1 ? 'right: 3%' : 'left: 3%' }}">
                        <a href="{{ URL::signedRoute('event.create')}}">
                            <button class="btn btn--yellow kt-font-transform-u btn-sm kt-font-bold"
                                id="nav--new-permit-btn">
                                <i class="la la-plus"></i>
                                {{__('Add New')}}
                            </button>
                            <button class="btn btn--yellow btn-sm mx-2" id="nav--new-permit-btn-mobile">
                                <i class="la la-plus"></i>
                            </button>
                        </a>
                    </span>
                    @endif
                </ul>


            </div>
        </section>

        <div class="tab-content">
            <div class="tab-pane show fade active" id="applied" role="tabpanel">
                <table class="table table-striped table-borderless border display nowrap" id="applied-events-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('Event Type')}}</th>
                            <th style="width:11%;" class="text-center">{{__('From')}} </th>
                            <th style="width:11%;" class="text-center">{{__('To')}} </th>
                            <th>{{__('Name')}}</th>
                            <th class="text-center">{{__('STATUS')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="tab-pane fade" id="valid" role="tabpanel">
                <table class="table table-striped table-borderless border" id="existing-events-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('Permit Number')}}</th>
                            <th>{{__('Event Type')}}</th>
                            <th style="width:11%;" class="text-center">{{__('From')}} </th>
                            <th style="width:11%;" class="text-center">{{__('To')}} </th>
                            <th>{{__('Event Name')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="tab-pane fade" id="expired" role="tabpanel">
                <table class="table table-striped table-borderless border" id="expired-events-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('Permit Number')}}</th>
                            <th>{{__('Event Type')}}</th>
                            <th class="text-center">{{__('From')}} </th>
                            <th class="text-center">{{__('To')}} </th>
                            <th>{{__('Event Name')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>

            <div class="tab-pane fade" id="cancelled" role="tabpanel">
                <table class="table table-striped table-borderless border" id="cancelled-events-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('REFERENCE NO.')}}</th>
                            <th>{{__('Permit Number')}}</th>
                            <th>{{__('Event Type')}}</th>
                            <th class="text-center">{{__('From')}} </th>
                            <th class="text-center">{{__('To')}} </th>
                            <th>{{__('Event Name')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>


            <div class="tab-pane fade" id="calendar" role="tabpanel">
                <div class="col-md-12">
                    <section id="event-calendar">
                    </section>
                </div>
            </div>

            <div class="tab-pane fade" id="draft" role="tabpanel">
                <table class="table table-striped table-borderless border" id="drafts-events-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('From')}} </th>
                            <th>{{__('To')}} </th>
                            <th>{{__('Event Name')}}</th>
                            <th>{{__('ADDED ON')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                            <th></th>
                        </tr>
                    </thead>

                </table>
            </div>




        </div>

</section>


<!--end: Datatable -->



<!--begin::Modal-->
<div class="modal fade" id="cancel_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Cancel Permit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('event.cancel')}}" id="cancel_permit_form" method="POST" novalidate>
                    @csrf
                    <label>{{__('Are you sure to Cancel this Permit of')}} <span class="text--maroon"
                            id="cancel_permit_number"></span>
                        ?</label>
                    <textarea name="cancel_reason" rows="3" placeholder="{{__('Enter the reason here')}}"
                        style="resize:none;" class="form-control" id="cancel_reason"></textarea>
                    <input type="hidden" id="cancel_permit_id" name="permit_id">
                    <input type="submit" class="btn btn-sm btn--maroon popup-submit-btn" value="{{__('Submit')}}">
                </form>
            </div>

        </div>
    </div>
</div>

<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="del_draft_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">{{__('Delete Draft')}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('event.delete_draft')}}" method="POST" novalidate>
                    @csrf
                    <label>{{__('Are you sure to delete this draft')}}
                        ? {{__('Data will be lost')}}</label>
                    <input type="hidden" id="del_draft_id" name="del_draft_id">
                    <div>
                        <input type="submit" class="btn btn-sm btn--maroon pull-right" value="Delete">
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<!--end::Modal-->

<!--begin::Modal-->

<div class="modal fade" id="cancelled_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">{{__('Cancelled Reason')}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">

                <p id="cancelled_reason" class="text--maroon kt-font-bold kt-font-transform-i"></p>

            </div>
        </div>
    </div>
</div>


<!--end::Modal-->
<!--begin::Modal-->
<div class="modal fade" id="rejected_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Rejected Reason')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <p id="rejected_reason" class="text--maroon kt-font-bold kt-font-transform-i"></p>
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->


</div>

@endsection

@section('script')

<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document).ready(function(){
            // calendarEvents();
            applied();
            valid();
            draft();
            expired();
            cancelled();
            setInterval(function(){ applied(); valid();}, 100000);
            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');

            $('.nav-tabs a').click(function (e) {
                $(this).tab('show');
                var scrollmem = $('body').scrollTop();
                window.location.hash = this.hash;
                $('html,body').scrollTop(scrollmem);
            });

            $('.nav-tabs a').on('shown.bs.tab', function (event) {
                var current_tab = $(event.target).attr('href');
                if (current_tab == '#applied' ) {  applied(); }
                if (current_tab == '#valid' ) { valid(); }
                if (current_tab == '#calendar') { calendarEvents(); }
                if (current_tab == '#draft' ) { draft(); }
                if (current_tab == '#expired' ) { expired(); }
                if (current_tab == '#cancelled' ) { cancelled(); }
            });

        }) 

       async function  applied(){
            var table1 = $('#applied-events-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                // order:[[6,'desc']],
                ajax:'{{route("company.event.fetch_applied")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'type_name', name: 'type_name' },
                    { data: 'issued_date', name: 'issued_date' , className: 'no-wrap'},
                    { data: 'expired_date', name: 'expired_date' , className: 'no-wrap'},
                    { data: 'name_en', name: 'name_en' },        
                    { data: 'permit_status', name: 'permit_status' },
                    { data: 'action', name: 'action' ,  className: "text-center"},
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 1 },
                    { targets: '_all', className:'no-wrap'},
                    {
                        targets:-3,
                        width: '10%',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return `<span class="kt-font-transform-c text-center">${data}</span>`;
                        }
                    }
                ],
                language: {
                    emptyTable: "No Applied Event Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
                
            });
       }

        function valid()
        {
            var table2 = $('#existing-events-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                ajax: '{{route("company.event.fetch_valid")}}',
                beforeSend: function (request) {
                    request.setRequestHeader("token", token);
                },
                columns: [
                    { data: 'permit_number', name: 'permit_number' },
                    { data: 'type_name', name: 'type_name' },
                    { data: 'issued_date', name: 'issued_date', className: 'no-wrap' },
                    { data: 'expired_date', name: 'expired_date' , className: 'no-wrap'},
                    { data: 'name_en', name: 'name_en' },
                    { data: 'action', name: 'action',  className: "text-center" },
                    { data: 'download', name: 'download',  className: "text-center" },
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                responsive: true,
                columnDefs: [
                ],
                language: {
                    emptyTable: "No Valid Event Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
            });
        }

        function draft() {
            var table3 = $('#drafts-events-table').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                deferRender: true,
                order:[[4,'desc']],
                ajax:   '{{route("company.event.fetch_draft")}}',
                beforeSend: function (request) {
                    request.setRequestHeader("token", token);
                },
                columns: [
                    { data: 'issued_date', name: 'issued_date' , className: 'no-wrap'},       
                    { data: 'expired_date', name: 'expired_date', className: 'no-wrap' },
                    { data: 'name_en', name: 'name_en' },
                    // { data: 'venue_en', name: 'venue_en' },
                    { data: 'created_at', defaultContent: 'None', name: 'created_at' , },
                    { data: 'action', name: 'action' ,  className: "text-center",  className: 'no-wrap'},
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                columnDefs: [
                    {
                        targets:-3,
                        width: '12%',
                        render: function(data, type, full, meta) {
                            return '<span >'+ moment(data).format('DD-MMM-YYYY') +'</span>';

                        }
                    },
                    {
                        targets: 4,
                        width: '10%',
                        className:'text-center',
                        render: function(data, type, full, meta) {
                            return $('#lang_id').val() == 1 ?  '<span >'+ data +'</span>' : '<span >'+ full.name_ar +'</span>';

                        }
                    },
                ],
                language: {
                    emptyTable: "{{__('No Event Permit Drafts')}}",
                    searchPlaceholder: "{{__('Search')}}"
                }

            });
        }


         function  expired(){
            var table4 = $('#expired-events-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                // order:[[6,'desc']],
                ajax:'{{route("company.event.fetch_expired")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'permit_number', name: 'permit_number' },
                    { data: 'type_name', name: 'type_name' },
                    { data: 'issued_date', name: 'issued_date' , className: 'no-wrap'},
                    { data: 'expired_date', name: 'expired_date' , className: 'no-wrap'},
                    { data: 'name_en', name: 'name_en' },        
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 1 },
                    { targets: '_all', className:'no-wrap'},
                    {
                        targets:-3,
                        width: '10%',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return `<span class="kt-font-transform-c text-center">${data}</span>`;
                        }
                    }
                ],
                language: {
                    emptyTable: "No Expired Event Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
                
            });
       }

        function  cancelled(){
            var table1 = $('#cancelled-events-table').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ordering: false,
                // order:[[6,'desc']],
                ajax:'{{route("company.event.fetch_cancelled")}}',
                columns: [
                    { data: 'reference_number', name: 'reference_number' },
                    { data: 'permit_number', name: 'permit_number' },
                    { data: 'type_name', name: 'type_name' },
                    { data: 'issued_date', name: 'issued_date' , className: 'no-wrap'},
                    { data: 'expired_date', name: 'expired_date' , className: 'no-wrap'},
                    { data: 'name_en', name: 'name_en' },        
                    { data: 'permit_status', name: 'permit_status' },
                    { data: 'action', name: 'action' ,  className: "text-center"},
                    { data: 'details', name: 'details' ,  className: "text-center"},
                ],
                responsive: true,
                columnDefs: [
                    { responsivePriority: 1, targets: 1 },
                    { targets: '_all', className:'no-wrap'},
                    {
                        targets:-3,
                        width: '10%',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return `<span class="kt-font-transform-c text-center">${data}</span>`;
                        }
                    }
                ],
                language: {
                    emptyTable: "No Cancelled or Rejected Permits",
                    searchPlaceholder: "{{__('Search')}}"
                }
                
            });
       }


   

    const cancel_permit = (id, refno, permit_no) => {
        var url = "{{route('company.event.get_status', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            success: function(result){
            //    result = result.replace(/\s/g, '');
            //     if(result != '') {
            //         if(result == 'new' || result == 'active'){
                        $('#cancel_permit').modal('show');
                        $('#cancel_permit_id').val(id);
                        if(permit_no)
                        {
                            $('#cancel_permit_number').html('<strong>'+permit_no+'</strong>');
                        }else{
                            $('#cancel_permit_number').html('<strong>'+refno+'</strong>');
                        }
                    // }else {
                    //         alert('Permit is already in processing');
                    // }

                
            }
        });

    }

    const delete_draft  = (id, refno) => {
        $('#del_draft_modal').modal('show');
        $('#del_draft_id').val(id);
    }

    
    $('#cancel_permit_form').validate({
        rules: {
            cancel_reason: 'required'
        },
        messages: {
            cancel_reason: 'Please Enter the Reason !'
        }
    });


    const show_cancelled = (id) => {
        var url = "{{route('company.event.cancel_reason', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            success: function(data){
                if(data) {
                    $('#cancelled_reason').html(data);
                }

            }
        });
    }   


    const rejected_permit = id => {
        let url = "{{route('event.reject_reason', ':id')}}";
        url = url.replace(':id', id);
        event.reject_reason
        $.ajax({
            url: url,
            success: function(data){
                $('#rejected_reason').html(data.comment);
            }
        });
    }



     function calendarEvents(){
      var todayDate = moment().startOf('day');
          var YM = todayDate.format('YYYY-MM');
          var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
          var TODAY = todayDate.format('YYYY-MM-DD');
          var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
          var calendarEl = document.getElementById('event-calendar');

          var calendar = new FullCalendar.Calendar(calendarEl, {
              plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
              @if(Auth::user()->LanguageId != 1)
                locale: 'ar',
                @endif
              isRTL: KTUtil.isRTL(),
              header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'listWeek,listDay,dayGridMonth,timeGridWeek',
              },
            //   height: 'auto',
              allDaySlot: true,
              height: 800,
            contentHeight: 750,
              aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
              nowIndicator: true,
              // now: TODAY + 'T09:25:00', // just for demo
              views: {
                  dayGridMonth: { buttonText: '{{ __('Month') }}' },
                  timeGridWeek: { buttonText: '{{ __('Week') }}' },
                  timeGridDay: { buttonText: '{{ __('Day') }}' },
                  listDay: { buttonText: '{{ __('Day List') }}' },
                  listWeek: { buttonText: '{{ __('Week List') }}' }
              },
            //   defaultView: 'dayGridMonth',
            defaultView: 'listWeek',
              // defaultDate: TODAY,
              editable: false,
              eventLimit: true, // allow "more" link when too many events
              navLinks: true,
              events: {
                  url: '{{ route('company.event.calendar') }}',
                  textColor: '#fff !important'
              },
              eventRender: function(info) {
                    var element = $(info.el);
                    element.find('.fc-time').html(moment(info.event.start).format('LT'));
                    element.find('.fc-title').html('&emsp;'+info.event.title.toUpperCase());
                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', 'VENUE: '+info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>'); 
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>'); 
                        }
                    } 
                }
          });
          calendar.render();
     }

</script>

@endsection