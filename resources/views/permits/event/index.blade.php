@extends('layouts.app')

@section('title', 'Event Permits - Smart Government Rak')



@section('content')


<section class="kt-portlet kt-portlet--head-sm kt-portlet--responsive-mobile" id="kt_page_portlet">

    <div class="kt-portlet__body kt-padding-t-5">
        <section class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-t-15 "
                    role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#applied" data-target="#applied">Applied
                            Event Permits </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#valid">Valid Event Permits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#calendar">Event Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#draft">Event Permit Drafts</a>
                    </li>
                    <span class="nav-item"
                        style="position:absolute; {{Auth::user()->LanguageId == 1 ? 'right: 3%' : 'left: 3%' }}">
                        <a href="{{ route('event.create')}}">

                            <button class="btn btn-label-yellow kt-font-transform-u btn-sm" id="nav--new-permit-btn">
                                <i class="la la-plus"></i>
                                Add New
                            </button>
                            <button class="btn btn-label-yellow btn-sm mx-2" id="nav--new-permit-btn-mobile">
                                <i class="la la-plus"></i>
                            </button>
                        </a>
                    </span>
                </ul>


            </div>
        </section>

        <div class="tab-content">
            <div class="tab-pane show fade active" id="applied" role="tabpanel">
                <table class="table table-striped table-hover table-borderless border" id="applied-events-table">
                    <thead>
                        <tr>
                            <th>Refer No.</th>
                            <th>Name</th>
                            <th>From </th>
                            <th>To </th>
                            <th>@lang('words.venue')</th>
                            <th>Type</th>
                            <th>@lang('words.status')</th>
                            <th>Actions</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                </table>

            </div>
            <div class="tab-pane fade" id="valid" role="tabpanel">
                <table class="table table-striped table-borderless border" id="existing-events-table">
                    <thead>
                        <tr>
                            <th>Permit No.</th>
                            <th>Name</th>
                            <th>From </th>
                            <th>To </th>
                            <th>@lang('words.venue')</th>
                            <th>Type</th>
                            <th>Actions</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                </table>
            </div>


            <div class="tab-pane fade" id="calendar" role="tabpanel">
                <div class="row">
                    <div class="col-md-3">
                        <section class="accordion accordion-solid accordion-toggle-plus" id="accordion-address">
                            <div class="card">
                                <div class="card-header" id="heading-address">
                                    <div class="card-title kt-padding-b-5 kt-padding-t-10" data-toggle="collapse"
                                        data-target="#collapse-address" aria-expanded="true"
                                        aria-controls="collapse-address">
                                        <h6 class="kt-font-bold kt-font-transform-u kt-font-dark">Event type legend</h6>
                                    </div>
                                </div>
                                <div id="collapse-address" class="collapse show" aria-labelledby="heading-address"
                                    data-parent="#accordion-address">
                                    <div class="card-body" style="padding: 1px;">
                                        <table class="table table-borderless table- ">
                                            <tbody>
                                                @if (!empty($types))
                                                @foreach ($types as $type)
                                                <tr>
                                                    <td>
                                                        <span
                                                            style="padding: 5px ; border-radius: 2px; color: #fff; background-color: {!! $type->color !!}">
                                                            {{  Auth::user()->LanguageId == 1 ? ucfirst(substr($type->name_en, 0, 20)): ucfirst($type->name_ar)  }}
                                                    </td>
                                                    </span>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-9">
                        <section id="event-calendar">
                        </section>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="draft" role="tabpanel">
                <table class="table table-striped table-borderless border" id="drafts-events-table">
                    <thead>
                        <tr>
                            <th>From </th>
                            <th>To </th>
                            <th>@lang('words.venue')</th>
                            <th>@lang('words.event_name')</th>
                            <th>Applied On</th>
                            <th>Actions</th>
                            <th>Details</th>
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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Cancel Permit</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('event.cancel')}}" id="cancel_permit_form" method="POST" novalidate>
                    @csrf
                    <label>Are you sure to Cancel this Permit of Ref No. <span class="text--maroon"
                            id="cancel_permit_number"></span>
                        ?</label>
                    <textarea name="cancel_reason" rows="3" placeholder="Enter the reason here..." style="resize:none;"
                        class="form-control" id="cancel_reason"></textarea>
                    <input type="hidden" id="cancel_permit_id" name="permit_id">
                    <input type="submit" class="btn btn-sm btn-label-maroon popup-submit-btn" value="Cancel Permit">
                </form>
            </div>

        </div>
    </div>
</div>

<!--end::Modal-->

<!--begin::Modal-->

<div class="modal fade" id="cancelled_permit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Cancelled Reason</h5>

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
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rejected Reason</h5>
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
    $('#kt_tabs_list a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        // $('ul .nav-tabs > li > a').on('shown.bs.tab', function(e) {
        //     var id = $(e.target).attr("href").substr(1);
        //     window.location.hash = id;
        // });

        // var hash = window.location.hash;
        // $('#kt_tabs_list a[href="' + hash + '"]').tab('show');


        $(document).ready(function(){

            var hash = window.location.hash;
            hash && $('ul.nav a[href="' + hash + '"]').tab('show');
            $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
            });

            calendarEvents();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table1 = $('#applied-events-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            // order:[[6,'desc']],
            ajax:'{{route("company.event.fetch_applied")}}',

            columns: [
                { data: 'reference_number', name: 'reference_number' },
                { data: 'name_en', name: 'name_en' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'venue_en', name: 'venue_en' },
                { data: 'type.name_en', name: 'type.name_en' },
                // { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'permit_status', name: 'permit_status' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:1,

                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.name_ar}</span>`;
					}
                },
                {
                    targets:2,

                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.time_start}</span>`;
					}
                },
                {
                    targets:3,

                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.time_end}</span>`;
					}
                },
                {
                    targets:4,
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.venue_ar}</span>`;
					}
                },
                {
                    targets:5,
                    width: '15%',
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}</span>`;
					}
                },
                // {
                //     targets:6,
                //     className:'dt-head-nowrap dt-body-nowrap',
                //     render: function(data, type, full, meta) {
                //         return '<span >'+ moment(data).format('DD-MMM-YYYY') +'</span>';

				// 	}
                // },

                {
                    targets:-3,
                    width: '10%',
                    className: 'text-center',
                    render: function(data, type, full, meta) {
						return `<span class="kt-font-transform-c">${data}</span>`;
					}
                }
            ],
            language: {
                emptyTable: "No Applied Event Permits"
            }
        });



        var table2 = $('#existing-events-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            deferRender: true,
            ajax:'{{route("company.event.fetch_valid")}}',
            columns: [
                { data: 'permit_number', name: 'permit_number' },
                { data: 'name_en', name: 'name_en' },
                { data: 'issued_date', name: 'issue_date' },
                { data: 'expired_date', name: 'expire_date' },
                { data: 'venue_en', name: 'venue_en' },
                { data: 'type.name_en', name: 'type.name_en' },
                // { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
            ],
            columnDefs: [
                {
                    targets:1,
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.name_ar}</span>`;
					}
                },
                {
                    targets:2,
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.time_start}</span>`;
					}
                },
                {
                    targets:3,
                    width:'18%',
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.time_end}</span>`;
					}
                },
                {
                    targets:4,
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}<br/>${full.venue_ar}</span>`;
					}
                },
                {
                    targets:5,
                    width: '12%',
                    className: 'dt-body-nowrap dt-head-nowrap',
                    render: function(data, type, full, meta) {
						return `<span >${data}</span>`;
					}
                },

            ],
            language: {
                emptyTable: "No Existing Event Permits"
            }
        });

        var table3 = $('#drafts-events-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            deferRender: true,
            order:[[4,'desc']],
            ajax:   '{{route("company.event.fetch_draft")}}',
            columns: [
                { data: 'issued_date', name: 'issued_date' },
                { data: 'expired_date', name: 'expired_date' },
                { data: 'venue_en', name: 'venue_en' },
                { data: 'name_en', name: 'name_en' },
                { data: 'created_at', defaultContent: 'None', name: 'created_at' },
                { data: 'action', name: 'action' },
                { data: 'details', name: 'details' },
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
                    targets:0,
                    width: '10%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
                        return '<span >'+ data +' <br/> '+full.time_start+'</span>';

					}
                },
                {
                    targets:1,
                    width: '10%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
                        return '<span >'+ data +' <br/> '+full.time_end+'</span>';

					}
                },
                {
                    targets:2,
                    width: '10%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
                        return '<span >'+ data +' <br/> '+full.venue_ar+'</span>';

					}
                },
                {
                    targets:3,
                    width: '10%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
                        return '<span >'+ data +' <br/> '+full.name_ar+'</span>';

					}
                },
                {
                    targets:-1,
                    width: '10%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
                        return '<span >'+ data+'</span>';

					}
                },
                {
                    targets:-2,
                    width: '10%',
                    className:'text-center',
                    render: function(data, type, full, meta) {
                        return '<span >'+ data +'</span>';

					}
                },
            ],
            language: {
                emptyTable: "No Event Permit Drafts"
            }

        });


    });

    const cancel_permit = (id, refno) => {
        var url = "{{route('company.event.get_status', ':id')}}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            success: function(result){
               result = result.replace(/\s/g, '');
                if(result != '') {
                    if(result == 'new'){
                        $('#cancel_permit').modal('show');
                        $('#cancel_permit_id').val(id);
                        $('#cancel_permit_number').html('<strong>'+refno+'</strong>');
                    }else {
                            alert('Permit is already in processing');
                    }

                }
            }
        });

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

    $('#cancel_permit_form').validate({
        rules: {
            cancel_reason: 'required'
        },
        message: {
            cancel_reason: 'Please fill the field'
        }
    });


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
              isRTL: KTUtil.isRTL(),
              header: {
                  left: 'prev,next today',
                  center: 'title',
                  right: 'listWeek,listDay,dayGridMonth,timeGridWeek',
              },
              height: 'auto',
              contentHeight: 450,
              aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio
              nowIndicator: true,
              // now: TODAY + 'T09:25:00', // just for demo
              views: {
                  dayGridMonth: { buttonText: 'Month' },
                  timeGridWeek: { buttonText: 'Week' },
                  timeGridDay: { buttonText: 'Day' },
                  listDay: { buttonText: 'Day List' },
                  listWeek: { buttonText: 'Week List' }
              },
              defaultView: 'dayGridMonth',
              // defaultDate: TODAY,
              editable: true,
              eventLimit: true, // allow "more" link when too many events
              navLinks: true,
              events: {
                  url: '{{ route('company.event.calendar') }}',
                  textColor: '#fff'
              },
              eventRender: function(info) {
                  var element = $(info.el);
                  if (info.event.extendedProps && info.event.extendedProps.description) {
                      if (element.hasClass('fc-day-grid-event')) {
                          element.data('content', info.event.extendedProps.description);
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
