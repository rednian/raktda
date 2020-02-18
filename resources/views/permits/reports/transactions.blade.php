@extends('layouts.app')
@section('title', 'Transaction Reports - Smart Government Rak')
@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Transaction Reports')}}</h3>

        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0">
        <section class="form-row" id="filter-container">
            <div class="col-1">
                <div>
                    <select name="length_change" id="artist-length-change"
                        class="form-control-sm form-control custom-select custom-select-sm"
                        aria-controls="artist-permit">
                        <option value='10'>10</option>
                        <option value='25'>25</option>
                        <option value='50'>50</option>
                        <option value='75'>75</option>
                        <option value='100'>100</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <form class="form-row">
                    <div class="col-3">
                        <div>
                            <select name="made_from" id="made_from"
                                class="form-control-sm form-control custom-select custom-select-sm" onchange="t.draw()">
                                <option value=' '>{{__('From')}}</option>
                                <option value='artist'>{{__('Artist')}}</option>
                                <option value='event'>{{__('Event')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="input-group input-daterange input-group-sm">
                            <div class="kt-input-icon kt-input-icon--right">
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="{{ __('Added on') }}" id="applied-date-from">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                    <span><i class="la la-calendar"></i></span>
                                </span>
                            </div>
                            {{-- <div class="col-2 input-group-addon text-center" style="text-transform:Capitalize;">to
                            </div>
                            <div class="col-5 kt-input-icon kt-input-icon--right">
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="{{ __('To Date') }}" id="applied-date-to">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
                                <span><i class="la la-calendar"></i></span>
                            </span>
                        </div> --}}
                    </div>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-sm btn--maroon" id="btn-reset">{{ __('RESET') }}</button>
            </div>
            </form>
    </div>
    <div class="col-md-2">
        <div class="form-group form-group-sm">
            <button class="btn btn-sm" style="background-color: #eee" onclick="printTransactions()">
                <i class='fa fa-print'></i>
            </button>
            <button class="btn btn-sm" style="background-color: #eee" onclick="excelTransactions()">
                <i class='fa fa-file-excel'></i>
            </button>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group form-group-sm">
            <div class="kt-input-icon kt-input-icon--right">
                <input type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..."
                    id="search-new-request">
                <span class="kt-input-icon__icon kt-input-icon__icon--right">
                    <span><i class="la la-search"></i></span>
                </span>
            </div>
        </div>
    </div>
    </section>
    <table class="table table-striped table-hover border table-borderless" id="transaction-details-table">
        <thead>
            <tr class="kt-font-transform-u text-center">
                <th>#</th>
                <th>{{__('Transaction ID')}}</th>
                <th>{{__('Receipt No')}}</th>
                <th>{{__('Amount')}}(AED)</th>
                <th>{{__('VAT')}}(5%)</th>
                <th>{{__('Total')}}(AED)</th>
                <th>{{__('From')}}</th>
                <th>{{__('Added On')}}</th>

                <th>{{__('View')}}</th>
                {{-- <th class="text-center">{{__('Action')}}</th> --}}
            </tr>
        </thead>
        {{-- {{dd($permit_details)}} --}}
        <tbody>

        </tbody>
    </table>
</div>


</div>

</section>

@endsection

@section('script')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var start = moment().subtract(29, 'days');
        var end = moment();
        var selected_date = [];

        
        var t = $('#transaction-details-table').DataTable({
            dom: "<'row d-none'<'col-sm-12 col-md-2'l><'col-sm-12 col-md-10'>f>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            // dom: 'Brtip',
            // dom: '<"pull-right">B<>',
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            // order:[[6,'desc']],
            ajax: {
                url:'{{route("company.transactions")}}',
                data: function (d) {
                    d.made_from = $('#made_from').val();
                    d.date = $('#applied-date-from').val()  ? selected_date : null;
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'transaction_id', name: 'transaction_id' },
                { data: 'receipt_no', name: 'receipt_no' },
                { data: 'amount', name: 'amount' , className:"no-wrap text-right" },
                { data: 'vat', name: 'vat' , className: 'no-wrap text-right'},
                { data: 'total', name: 'total' , className: 'no-wrap text-right'},
                { data: 'from', name: 'from' , className: 'no-wrap'},
                { data: 'created_at', name: 'created_at' , className: 'no-wrap'},
                
                { data: 'action', name: 'action' ,  className: "text-center"},
            ],
            columnDefs: [
                { className: "text-center", targets: "_all" },
            ],
            language: {
                emptyTable: "{{__('No Transactions')}}",
                searchPlaceholder: "{{__('Search')}}"
            },
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1,2,3,4,5]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print current page',
                    title: function() {
                        return 'Transaction Report';
                    },
                    exportOptions: {
                        // columns: ':visible',
                        columns: [0,1,2,3,4,5]
                    },
                    customize: function ( win ) {
                            $(win.document.body).prepend(
                                '<h3 style="font-family:arial;text-align:center">Transaction Report</h3>'
                            );
                            $(win.document.body).find('h1').css('display', 'none');
                            $(win.document.body)
                                .css( 'font-size', '10pt' )
                                .prepend(
                                    '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                );
                            
                            // $(win.document.body).find('table').removeClass("table-borderless border");
                            // $(win.document.body).find('table').attr('border', 1);
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css({ 'font-size': 'inherit', 'border-collapse': 'collapse'});
                        }
                }
            ]
            
        });

        $('input#applied-date-from').daterangepicker({
          autoUpdateInput: false,
          buttonClasses: 'btn',
          applyClass: 'btn-warning btn-sm btn-elevate',
          cancelClass: 'btn-secondary btn-sm btn-elevate',
          startDate: start,
          endDate: end,
          maxDate: new Date,
          locale:{'customRangeLabel':'Custom From & To'},
          ranges: {
            '{{ __('Today') }}': [moment(), moment()],
            '{{ __('Yesterday') }}': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '{{ __('Last 7 Days') }}': [moment().subtract(6, 'days'), moment()],
            '{{ __('Last 30 Days') }}': [moment().subtract(29, 'days'), moment()],
            '{{ __('This Month') }}': [moment().startOf('month'), moment().endOf('month')],
            '{{ __('Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          }
        }, function (start, end, label) {
          $('input#applied-date-from.form-control').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }).on('apply.daterangepicker', function(e, d){
         selected_date = {'start': d.startDate.format('YYYY-MM-DD'), 'end': d.endDate.format('YYYY-MM-DD') };
         t.draw();
        });

        

        function excelTransactions()
        {
            t.buttons( 0 ).trigger();
        }

        function printTransactions()
        {
            t.buttons( 1 ).trigger();
        }


        $('#btn-reset').click(function(){ $(this).closest('form.form-row')[0].reset(); t.draw();});

        t.buttons().container()
            .appendTo( $('.col-sm-6:eq(0)', t.table().container() ) );

        t.page.len($('#artist-length-change').val());
        $('#artist-length-change').change(function(){ t.page.len( $(this).val() ).draw(); });

        var search = $.fn.dataTable.util.throttle(function(v){ t.search(v).draw(); }, 500);
        $('input#search-new-request').keyup(function(){ search($(this).val()); });


        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();


        // $('#applied-date-from, #applied-date-to').datepicker({
        //     format: 'dd-mm-yyyy',
        //     autoclose: true,
        //     todayHighlight: true,
        //     orientation: "bottom left"
        // });

        // $('.input-daterange input').each(function() {
        //     $(this).datepicker('clearDates');
        // });

</script>

@endsection