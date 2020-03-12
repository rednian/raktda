@extends('layouts.admin.admin-app')
@section('style')
<style>
    .dt-buttons{
        margin-top: auto;
    }
    body{
        font-family: Poppins;
    }
    th{
        font-size: 10px;font-weight: bold;white-space: nowrap;
    }
    td{
        /* font-size: 10px;font-weight:400 */
    }
    #eventTransactionTable_filter{
        float: right;
    }
    .btn-secondary{
        height: 30px;
        line-height: 3px;
    }
    input .hightlight{
        color: red;
        border: 1px solid red;
    }
    #selectApplicationTypeId:focus{
        border: none;
        padding: 7px;
        outline: none;
        height: 33px;
        box-shadow: -1px 5px 5px -7px;
    }
    #selectEventTypeId:focus{
        border: none;
        padding: 7px;
        outline: none;
        height: 33px;
        box-shadow: -1px 5px 5px -7px;
    }

    #selectApplicationTypeId:hover{
        border: none;
        padding: 7px;
        outline: none;
        height: 33px;
        box-shadow: -1px 5px 5px -7px;
    }
    #selectEventTypeId:hover{
        border: none;
        padding: 7px;
        outline: none;
        height: 33px;
        box-shadow: -1px 5px 5px -7px;
    }

    #start_date:hover{
        border: none;

        outline: none;

        box-shadow: -1px 5px 5px -5px;
    }
    #end_date:hover{
        border: none;
        outline: none;

        box-shadow: -1px 5px 5px -5px;
    }
th{
    font-weight: bold;

}
    </style>
@endsection
@section('content')

    <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet"
             style="padding: 20px">
{{--
        <div class="col">
            <span style="    font-weight: bold;
                              color: #adadad;
                              font-size: 15px;">EVENTS TRANSACTIONS REPORT</span>
            <a href="{{url('artist_reports#transaction-report-tab')}}"><button style="    background-color: #b45454;
                              color: white;
                              box-shadow: -1px 6px 11px -6px #969696;
                              border: none;
                              border-radius: 3px;
                              height: 27px;
                              float: right;
                              line-height: 4px;
                              margin-top: -14px;
                              margin-right: -10px;
                              margin-bottom: 7px;" class="btn">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>BACK</button></a>
             </div>
        --}}

        <div class="row">
            <div class="col-10" style="font-size: 16px;color: grey;font-weight: 500">{{__('EVENTS TRANSACTIONS REPORT')}}</div>
                  <div class="col">
                       <a href="{{url('artist_reports#transaction-report-tab')}}"><button style="background-color: #b45454;
                       border: none;
                       float: right;" class="btn  btn-danger btn-sm"> <i class="fa fa-arrow-left" style="margin: 2px"></i>{{__('BACK')}}</button></a></div>
                  </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 6px">
            {{-- <a class="navbar-brand" href="#">Navbar w/ text</a>--}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav mr-auto" style="font-weight: 500;">
                    <li class="nav-item" id="SelectEventType">
                        <select style="border: none;padding: 7px;height: 33px" id="selectRange">
                            <option value="-7">{{__('Last 7 Days')}}</option>
                            <option value="-30">{{__('Last 30 Days')}}</option>
                            <option value="current">{{__('This Month')}}</option>
                            <option value="all">{{__('All')}}</option>
                        </select>

                    </li>
                    <li class="nav-item" id="SelectEventType">
                        <select style="border: none;padding: 7px;height: 33px" id="selectEventTypeId">
                            <option value="">{{__('Select Type')}}</option>
                            @foreach(\App\EventType::has('event')->get() as $transaction)
                                <option value="{{$transaction->event_type_id}}">{{Auth()->user()->LanguageId==1?$transaction->name_en:$transaction->name_ar}}</option>
                            @endforeach
                        </select>

                    </li>
                    <li class="nav-item" id="SelectApplicationType" >
                        <select style="border: none;padding: 7px;height: 33px" id="selectApplicationTypeId">
                            <option value="">{{__('Select Event')}}</option>
                            <option value="1">{{__('Government')}}</option>
                            <option value="2">{{__('Corporate')}}</option>
                        </select>

                    </li>
                    <li style="padding: 4px;display: flex">
                        <span id="start_tooltip" style="    position: absolute;
                                      margin-top: -31px;
                                      font-size: 12px;
                                      font-weight: 300;
                                      color: red;
                                      box-shadow: 2px 7px 8px -3px #b7b7b7;
                                      padding: 3px;
                                      border-radius: 5px;"></span>
                        <input style="height: 31px; border: none; margin-top: -4px;" type="text" id="start_date" class="form-control" placeholder="From Date">

                    </li>
                    <li style="padding: 4px;display: flex">
                        <input style="height: 31px;color: #bfbfbf; border: none; margin-top: -4px;" type="text" id="end_date" class="form-control" placeholder="To Date">

                    </li>
                   </ul>
                <span class="navbar-text" style="white-space: nowrap">
           Total Amount : <span style="color: #6d6d6d;font-weight: 500" id="totalAmount"></span></span>
            </div>
        </nav>

        <table class="table  table-hover  table-bordered table-striped border" id="eventTransactionTable">

            <tfoot><tr>
                <th colspan="7" class="text-right">{{__('TOTAL:')}}</th>
                <th id="amountFooter"></th>
                <th id="vatFooter"></th>
                <th id="totalFooter"></th>
            </tr></tfoot>
        </table>
    </section>
@endsection
@section('script')

    <script>
        $(document).ready(function () {
        sevenDaysTransactions();
            $('#selectRange').change(function() {
                var days = $('#selectRange option:selected').val();
                var selectEventTypeId=$('#selectEventTypeId').val();
                var selectApplicationTypeId=$('#selectApplicationTypeId option:selected').val();
                $('#start_date').val('');
                $('#end_date').val('');
                $('#eventTransactionTable').DataTable({
                    dom: 'Bfrtip',
                    "searching": true,
                    "columnDefs": [
                        {
                            "targets": [7, 8, 9],
                            "className": "text-right"
                        },
                        {
                            targets: [4],
                            visible: false,
                        },
                    ],
                    buttons: ['pageLength',
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 7, 8, 9]
                            },
                            title: function () {
                                return 'Event Transactions ' + Date.now();
                            },
                            customize: function (win) {
                                $(win.document.body).prepend(
                                    '<h3 style="text-align:center;font-weight: bold"><span style="margin-left: 30px;">Event Transactions </span><span style="float: right;font-size: 13px;font-weight: bold;margin-top: 8px" id="totalAmount"></span></h3>'
                                );
                                var totalAmount = $('#totalAmount').html();
                                var amount = $('#amountFooter').html();
                                var vat = $('#vatFooter').html();
                                var total = $('#totalFooter').html();
                                $(win.document.body).find('table').append(
                                    '<tfoot><tr><th colspan="3" class="text-right">Total</th><th style="text-align:right;">' + amount + '</th><th style="text-align:right;">' + vat + '</th><th style="text-align: right">' + totalAmount + '</th></tr></tfoot>'
                                );
                                $(win.document.body).find('td').css({'font-size': '15px'})
                                $(win.document.body).find('td').css({'white-space': 'nowrap'})
                                $(win.document.body).find('th').css({'font-size': '15px'})
                                $(win.document.body).find('h3').css({'font-size': '15px'})
                                $(win.document.body).find('#totalAmount').append($('#totalFooter').html());
                                $(win.document.body)

                                    .prepend(
                                        '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                    );
                                $(win.document.body).css({'font-size': '20px'})
                                $(win.document.body).find('h1')
                                    .css('display', 'none')
                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css({'font-size': '12px'});
                            }
                        },
                        {
                            extend: 'excel',
                            footer: true,
                            title: function () {
                                return 'Events Transactions ' + Date.now();
                            },

                        }
                    ],
                    lengthMenu: [
                        [10, 25, 50],
                        ['10 rows', '25 rows', '50 rows']
                    ],
                    processing: true,
                    language: {
                        processing: '<span>Processing</span>',
                    },
                    serverSide: true,
                    footer: true,


                    ajax: {
                        url: '{{route('admin.artist_permit_report.eventTransactionDateRange')}}',
                        method: 'post',
                       data:{selectEventTypeId:selectEventTypeId,selectApplicationTypeId:selectApplicationTypeId,days:days}
                    },
                    "columns": [
                        {title: 'REFERENCE NO.', data: 'reference_number', name: 'reference_number'},
                        {title: 'EVENT NAME', data: 'event_name', name: 'event_name'},
                        {title: 'TRANSACTION DATE', data: 'transaction_date', name: 'transaction_date'},
                        {title: 'EVENT DATE', data: 'issued_date', name: 'issued_date'},
                        {title: 'EXPIRY DATE', data: 'expired_date', name: 'expired_date'},
                        {title: 'TYPE', data: 'application_type', name: 'application_type'},
                        {title: 'EVENT TYPE', data: 'event_type', name: 'event_type'},
                        {title: 'AMOUNT', data: 'amount', name: 'amount'},
                        {title: 'VAT (5%)', data: 'vat', name: 'vat'},
                        {title: 'TOTAL', data: 'total', name: 'total'},
                    ],
                    footerCallback: function (row, data, start, end, display) {
                        var api = this.api();
                        // Remove the formatting to get integer data for summation
                        var intVal = function (i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
                        // Total over all pages
                        if (api.column(9).data().length > 0) {
                            var amount = api
                                .column(7, {page: 'current'})
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                });
                            var vat = api
                                .column(8, {page: 'current'})
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                });
                            var total = api
                                .column(9, {page: 'current'})
                                .data()
                                .reduce(function (a, b) {
                                    return intVal(a) + intVal(b);
                                });

                            $('#amountFooter').html(accounting.formatMoney(amount, 'AED '));
                            $('#totalAmount').html(accounting.formatMoney(total, 'AED '));
                            $('#vatFooter').html(accounting.formatMoney(vat, 'AED '));
                            $('#totalFooter').html(accounting.formatMoney(total, 'AED '));

                        } else {

                            $('#amountFooter').html(' 0.00');
                            $('#totalAmount').html('0.00');
                            $('#vatFooter').html('0.00');
                            $('#totalFooter').html('0.00');
                        }
                    },
                });
            });


         function sevenDaysTransactions(){
          var days=$('#selectRange option:selected').val();
             $('#eventTransactionTable').DataTable( {
                 dom: 'Bfrtip',
                 "searching": true,
                 "columnDefs": [
                     {   "targets": [7,8,9],
                         "className": "text-right"},
                     {
                         targets:[4],
                         visible:false,
                     },
                 ],
                 buttons: ['pageLength',
                     {
                         extend: 'print',
                         exportOptions: {
                             columns: [0, 1, 2, 7, 8, 9]
                         },
                         title:function(){
                             return   'Event Transactions '+Date.now();
                         },
                         customize: function ( win ) {
                             $(win.document.body).prepend(
                                 '<h3 style="text-align:center;font-weight: bold"><span style="margin-left: 30px;">Event Transactions </span><span style="float: right;font-size: 13px;font-weight: bold;margin-top: 8px" id="totalAmount"></span></h3>'
                             );
                             var totalAmount= $('#totalAmount').html();
                             var amount=$('#amountFooter').html();
                             var vat=$('#vatFooter').html();
                             var total=$('#totalFooter').html();
                             $(win.document.body).find('table').append(
                                 '<tfoot><tr><th colspan="3" class="text-right">Total</th><th style="text-align:right;">'+amount+'</th><th style="text-align:right;">'+vat+'</th><th style="text-align: right">'+totalAmount+'</th></tr></tfoot>'
                             );
                             $(win.document.body).find('td').css({'font-size':'15px'})
                             $(win.document.body).find('th').css({'font-size':'15px'})
                             $(win.document.body).find('td').css({'white-space': 'nowrap'})
                             $(win.document.body).find('h3').css({'font-size':'15px'})
                             $(win.document.body).find('#totalAmount').append($('#totalFooter').html());
                             $(win.document.body)

                                 .prepend(
                                     '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                 );
                             $(win.document.body).css({'font-size':'20px'})
                             $(win.document.body).find('h1')
                                 .css( 'display', 'none' )
                             $(win.document.body).find( 'table' )
                                 .addClass( 'compact' )
                                 .css({ 'font-size': '12px'});
                         }
                     },
                     {
                         extend: 'excel',
                         footer:true,
                         title: function () {
                             return 'Events Transactions '+Date.now();
                         },

                     }
                 ],
                 lengthMenu: [
                     [10, 25, 50],
                     ['10 rows', '25 rows', '50 rows']
                 ],
                 processing: true,
                 language: {
                     processing: '<span>Processing</span>',
                 },
                 serverSide: true,
                 footer: true,


                 ajax: {
                     url:'{{route('admin.artist_permit_report.eventTransactionDateRange')}}',
                     method:'post',
                     data:{days:days}
                 },
                 "columns": [
                     {title:'REFERENCE NO.',data: 'reference_number', name: 'reference_number'},
                     {title:'EVENT NAME',data: 'event_name', name: 'event_name'},
                     {title:'TRANSACTION DATE',data: 'transaction_date', name: 'transaction_date'},
                     {title:'EVENT DATE',data: 'issued_date', name: 'issued_date'},
                     {title:'EXPIRY DATE',data: 'expired_date', name: 'expired_date'},
                     {title:'TYPE',data: 'application_type', name: 'application_type'},
                     {title:'EVENT TYPE',data: 'event_type', name: 'event_type'},
                     {title:'AMOUNT',data: 'amount', name: 'amount'},
                     {title:'VAT (5%)',data: 'vat', name: 'vat'},
                     {title:'TOTAL',data: 'total', name: 'total'},
                 ],
                 footerCallback: function ( row, data, start, end, display ) {
                     var api = this.api();
                     // Remove the formatting to get integer data for summation
                     var intVal = function ( i ) {
                         return typeof i === 'string' ?
                             i.replace(/[\$,]/g, '')*1 :
                             typeof i === 'number' ?
                                 i : 0;
                     };
                     // Total over all pages
                     if (api.column(9).data().length>0){
                         var amount = api
                             .column( 7 ,{ page: 'current'} )
                             .data()
                             .reduce( function (a, b) {
                                 return intVal(a) + intVal(b);
                             } );
                         var vat = api
                             .column( 8,{ page: 'current'}  )
                             .data()
                             .reduce( function (a, b) {
                                 return intVal(a) + intVal(b);
                             } );
                         var total = api
                             .column( 9 ,{ page: 'current'} )
                             .data()
                             .reduce( function (a, b) {
                                 return intVal(a) + intVal(b);
                             } );

                         $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                         $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                         $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                         $('#totalFooter').html(accounting.formatMoney(total,'AED '));

                     }
                     else{

                         $('#amountFooter').html(' 0.00');
                         $('#totalAmount').html('0.00');
                         $('#vatFooter').html('0.00');
                         $('#totalFooter').html('0.00');
                     }
                 },
             } );

            }
       function eventTransactions(){
               $('#eventTransactionTable').DataTable( {
                   dom: 'Bfrtip',
                   "searching": true,
                   "columnDefs": [
                       {
                           "targets": [7,8,9],
                           "className": "text-right",
                       },  {
                           targets:[4],
                           visible:false,
                       },
                       ],
                   buttons: ['pageLength',
                       {
                           extend: 'print',

                           exportOptions: {
                               columns: [0, 1, 2, 7, 8, 9]
                           },
                           title:function(){
                               return   'Event Transactions '+Date.now();
                           },
                           customize: function ( win ) {
                               $(win.document.body).prepend(
                                   '<h3 style="text-align:center"><span style="position:absolute;margin-left: -20px">Event Transactions</span><span style="float: right;font-size: 13px;font-weight: bold;margin-top: 8px" id="totalAmount">TOTAL AMOUNT: </span></h3>'
                               );
                               var totalAmount= $('#totalAmount').html();
                               var amount=$('#amountFooter').html();
                               var vat=$('#vatFooter').html();
                               var total=$('#totalFooter').html();
                               $(win.document.body).find('table').append(
                                   '<tfoot><tr><th colspan="3" class="text-right">Total</th><th style="text-align:right;">'+amount+'</th><th style="text-align:right;">'+vat+'</th><th style="text-align: right">'+totalAmount+'</th></tr></tfoot>'
                               );
                               $(win.document.body).find('#totalAmount').append($('#totalFooter').html());
                               $(win.document.body).find('td').css({'font-size':'15px'})
                               $(win.document.body).find('td').css({'white-space': 'nowrap'})
                               $(win.document.body).find('th').css({'font-size':'15px'})
                               $(win.document.body).find('h3').css({'font-size':'15px'})
                               $(win.document.body)
                                   .prepend(
                                       '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                   );
                               $(win.document.body).find('h1')
                                   .css( 'display', 'none' )
                               $(win.document.body).find( 'table' )
                                   .addClass( 'compact' )
                                   .css({ 'font-size': 'inherit'});
                             }
                          },
                       {
                           extend: 'excel',
                            footer:true,
                           title: function () {
                               return 'Events Transactions '+Date.now();
                           },
                       },
                   ],
                   lengthMenu: [
                       [10, 25, 50],
                       ['10 rows', '25 rows', '50 rows']
                   ],
                   processing: true,
                   language: {
                       processing: '<span>Processing</span>',
                   },
                   serverSide: true,
                   footer: true,

                   ajax: {
                     url:'{{route('admin.artist_permit_report.eventTransactionDatatable')}}',
                     method:'get'
                   },
                   "columns": [
                       {title:'REFERENCE NO.',data: 'reference_number', name: 'reference_number'},
                       {title:'EVENT NAME',data: 'event_name', name: 'event_name'},
                       {title:'TRANSACTION DATE',data: 'transaction_date', name: 'transaction_date'},
                       {title:'EVENT DATE',data: 'issued_date', name: 'issued_date'},
                       {title:'EXPIRY DATE',data: 'expired_date', name: 'expired_date'},
                       {title:'TYPE',data: 'application_type', name: 'application_type'},
                       {title:'EVENT TYPE',data: 'event_type', name: 'event_type'},
                       {title:'AMOUNT',data: 'amount', name: 'amount'},
                       {title:'VAT (5%)',data: 'vat', name: 'vat'},
                       {title:'TOTAL',data: 'total', name: 'total'},
                   ],
                   footerCallback: function ( row, data, start, end, display ) {
                       var api = this.api();
                       // Remove the formatting to get integer data for summation
                       var intVal = function ( i ) {
                           return typeof i === 'string' ?
                               i.replace(/[\$,]/g, '')*1 :
                               typeof i === 'number' ?
                                   i : 0;
                                      };
                           // Total over all pages
                            if (api.column(4).data().length>0){
                             var amount = api
                                .column( 7 ,{ page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                  return intVal(a) + intVal(b);
                               });
                                 var vat = api
                               .column( 8,{ page: 'current'}  )
                               .data()
                               .reduce( function (a, b) {
                                   return intVal(a)+intVal(b)
                               } );
                           var total = api
                               .column( 9 ,{ page: 'current'} )
                               .data()
                               .reduce( function (a, b) {
                                   return intVal(a) + intVal(b)
                               });
                           $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                           $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                           $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                           $('#totalFooter').html(accounting.formatMoney(total,'AED '));
                       }
                       else{
                           $('#amountFooter').html('0.00');
                           $('#totalAmount').html('0.00');
                           $('#vatFooter').html('0.00');
                           $('#totalFooter').html('0.00');
                         }
                    },
              });
           }

            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4',
                format:'dd-mm-yyyy',
                todayHighlight: true,
                iconsLibrary: 'fontawesome',
                autoclose: true,
                minDate: function () {
                    return $('#start_date').val();
                }
            });

                $('#end_date').datepicker({
                    uiLibrary: 'bootstrap4',
                    format:'dd-mm-yyyy',
                    todayHighlight: true,
                    autoclose: true,
                    iconsLibrary: 'fontawesome',
                    minDate: function () {
                        return $('#end_date').val();
                    }
                });

            $('#selectApplicationTypeId').change(function() {
                var days = $('#selectRange option:selected').val();
                var selectEventTypeId=$('#selectEventTypeId').val();
                var selectApplicationTypeId=$('#selectApplicationTypeId option:selected').val();
                var selectNames=$('#selectEventTypeId option:selected').text();
                var start = $('#start_date').val('')
                var end = $('#end_date').val('')
                $('#eventTransactionTable').DataTable( {
                    dom: 'Bfrtip',
                    "searching": true,
                    "columnDefs": [
                        {   "targets": [7,8,9],
                            "className": "text-right"},
                        {
                            targets:[4],
                            visible:false,
                        },
                    ],
                    buttons: ['pageLength',
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [0, 1, 2, 7, 8, 9]
                            },
                            title:function(){
                                return   'Event Transactions '+Date.now();
                            },
                            customize: function ( win ) {
                                $(win.document.body).prepend(
                                    '<h3 style="text-align:center;font-weight: bold"><span style="margin-left: 30px;">Event Transactions </span><span style="float: right;font-size: 13px;font-weight: bold;margin-top: 8px" id="totalAmount"></span></h3>'
                                );
                                var totalAmount= $('#totalAmount').html();
                                var amount=$('#amountFooter').html();
                                var vat=$('#vatFooter').html();
                                var total=$('#totalFooter').html();
                                $(win.document.body).find('table').append(
                                    '<tfoot><tr><th colspan="3" class="text-right">Total</th><th style="text-align:right;">'+amount+'</th><th style="text-align:right;">'+vat+'</th><th style="text-align: right">'+totalAmount+'</th></tr></tfoot>'
                                );
                                $(win.document.body).find('td').css({'font-size':'15px'})
                                $(win.document.body).find('th').css({'font-size':'15px'})
                                $(win.document.body).find('td').css({'white-space': 'nowrap'})
                                $(win.document.body).find('h3').css({'font-size':'15px'})
                                $(win.document.body).find('#totalAmount').append($('#totalFooter').html());
                                $(win.document.body)

                                    .prepend(
                                        '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                    );
                                $(win.document.body).css({'font-size':'20px'})
                                $(win.document.body).find('h1')
                                    .css( 'display', 'none' )
                                $(win.document.body).find( 'table' )
                                    .addClass( 'compact' )
                                    .css({ 'font-size': '12px'});
                            }
                        },
                        {
                            extend: 'excel',
                            footer:true,
                            title: function () {
                                return 'Events Transactions '+Date.now();
                            },

                        }
                    ],
                    lengthMenu: [
                        [10, 25, 50],
                        ['10 rows', '25 rows', '50 rows']
                    ],
                    processing: true,
                    language: {
                        processing: '<span>Processing</span>',
                    },
                    serverSide: true,
                    footer: true,


                    ajax: {
                        url:'{{route('admin.artist_permit_report.eventTransactionDateRange')}}',
                        method:'post',
                        data:{selectEventTypeId:selectEventTypeId,selectApplicationTypeId:selectApplicationTypeId,days:days}
                    },
                    "columns": [
                        {title:'REFERENCE NO.',data: 'reference_number', name: 'reference_number'},
                        {title:'EVENT NAME',data: 'event_name', name: 'event_name'},
                        {title:'TRANSACTION DATE',data: 'transaction_date', name: 'transaction_date'},
                        {title:'EVENT DATE',data: 'issued_date', name: 'issued_date'},
                        {title:'EXPIRY DATE',data: 'expired_date', name: 'expired_date'},
                        {title:'TYPE',data: 'application_type', name: 'application_type'},
                        {title:'EVENT TYPE',data: 'event_type', name: 'event_type'},
                        {title:'AMOUNT',data: 'amount', name: 'amount'},
                        {title:'VAT (5%)',data: 'vat', name: 'vat'},
                        {title:'TOTAL',data: 'total', name: 'total'},
                    ],
                    footerCallback: function ( row, data, start, end, display ) {
                        var api = this.api();
                        // Remove the formatting to get integer data for summation
                        var intVal = function ( i ) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '')*1 :
                                typeof i === 'number' ?
                                    i : 0;
                        };
                        // Total over all pages
                        if (api.column(9).data().length>0){
                            var amount = api
                                .column( 7 ,{ page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                } );
                            var vat = api
                                .column( 8,{ page: 'current'}  )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                } );
                            var total = api
                                .column( 9 ,{ page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return intVal(a) + intVal(b);
                                } );

                            $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                            $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                            $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                            $('#totalFooter').html(accounting.formatMoney(total,'AED '));

                        }
                        else{

                            $('#amountFooter').html(' 0.00');
                            $('#totalAmount').html('0.00');
                            $('#vatFooter').html('0.00');
                            $('#totalFooter').html('0.00');
                        }
                    },
                } );
            });


            $('#selectEventTypeId').change(function() {
                var days = $('#selectRange option:selected').val();
                var selectEventTypeId=$('#selectEventTypeId option:selected').val();
                var selectApplicationTypeId=$('#selectApplicationTypeId option:selected').val();
                var selectNames=$('#selectEventTypeId option:selected').text();
                var start = $('#start_date').val('')
                var end = $('#end_date').val('')

                    $('#eventTransactionTable').DataTable( {
                        dom: 'Bfrtip',
                        "searching": true,
                        "columnDefs": [
                            {   "targets": [7,8,9],
                                "className": "text-right"},
                            {
                                targets:[4],
                                visible:false,
                            },
                        ],
                        buttons: ['pageLength',
                            {
                                extend: 'print',
                                exportOptions: {
                                    columns: [0, 1, 2, 7, 8, 9]
                                },
                                title:function(){
                                    return   'Event Transactions '+Date.now();
                                },
                                customize: function ( win ) {
                                    $(win.document.body).prepend(
                                        '<h3 style="text-align:center;font-weight: bold"><span style="margin-left: 30px;"> Event Transactions </span><span style="float: right;font-size: 13px;font-weight: bold;margin-top: 8px" id="totalAmount"></span></h3>'
                                    );
                                    var totalAmount= $('#totalAmount').html();
                                    var amount=$('#amountFooter').html();
                                    var vat=$('#vatFooter').html();
                                    var total=$('#totalFooter').html();
                                    $(win.document.body).find('table').append(
                                        '<tfoot><tr><th colspan="3" class="text-right">Total</th><th style="text-align:right;">'+amount+'</th><th style="text-align:right;">'+vat+'</th><th style="text-align: right">'+totalAmount+'</th></tr></tfoot>'
                                    );
                                    $(win.document.body).find('td').css({'font-size':'15px'})
                                    $(win.document.body).find('th').css({'font-size':'15px'})
                                    $(win.document.body).find('td').css({'white-space': 'nowrap'})
                                    $(win.document.body).find('h3').css({'font-size':'15px'})
                                    $(win.document.body).find('#totalAmount').append($('#totalFooter').html());
                                    $(win.document.body)

                                        .prepend(
                                            '<img src="{{asset('img/raktdalogo.png')}}"/>'
                                        );
                                    $(win.document.body).css({'font-size':'20px'})
                                    $(win.document.body).find('h1')
                                        .css( 'display', 'none' )
                                    $(win.document.body).find( 'table' )
                                        .addClass( 'compact' )
                                        .css({ 'font-size': '12px'});
                                }
                            },
                            {
                                extend: 'excel',
footer:true,
                                title: function () {
                                    return 'Events Transactions '+Date.now();
                                },

                            }
                        ],
                        lengthMenu: [
                            [10, 25, 50],
                            ['10 rows', '25 rows', '50 rows']
                        ],
                        processing: true,
                        language: {
                            processing: '<span>Processing</span>',
                        },
                        serverSide: true,
                        footer: true,


                        ajax: {
                            url:'{{route('admin.artist_permit_report.eventTransactionDateRange')}}',
                            method:'post',
                            data:{days:days,selectEventTypeId:selectEventTypeId,selectApplicationTypeId:selectApplicationTypeId}
                        },
                        "columns": [
                            {title:'REFERENCE NO.',data: 'reference_number', name: 'reference_number'},
                            {title:'EVENT NAME',data: 'event_name', name: 'event_name'},
                            {title:'TRANSACTION DATE',data: 'transaction_date', name: 'transaction_date'},
                            {title:'EVENT DATE',data: 'issued_date', name: 'issued_date'},
                            {title:'EXPIRY DATE',data: 'expired_date', name: 'expired_date'},
                            {title:'TYPE',data: 'application_type', name: 'application_type'},
                            {title:'EVENT TYPE',data: 'event_type', name: 'event_type'},
                            {title:'AMOUNT',data: 'amount', name: 'amount'},
                            {title:'VAT (5%)',data: 'vat', name: 'vat'},
                            {title:'TOTAL',data: 'total', name: 'total'},
                        ],
                        footerCallback: function ( row, data, start, end, display ) {
                            var api = this.api();
                            // Remove the formatting to get integer data for summation
                            var intVal = function ( i ) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '')*1 :
                                    typeof i === 'number' ?
                                        i : 0;
                            };
                            // Total over all pages
                            if (api.column(9).data().length>0){
                                var amount = api
                                    .column( 7 ,{ page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    } );
                                var vat = api
                                    .column( 8,{ page: 'current'}  )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    } );
                                var total = api
                                    .column( 9 ,{ page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    } );

                                $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                                $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                                $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                                $('#totalFooter').html(accounting.formatMoney(total,'AED '));

                            }
                            else{
                                $('#amountFooter').html(' 0.00');
                                $('#totalAmount').html('0.00');
                                $('#vatFooter').html('0.00');
                                $('#totalFooter').html('0.00');
                            }
                        },
                    } );
                });




        $('#end_date').change(function () {
            if($('#start_date').val().length>0){
                dates();
            }
           else{
               alert('Select Start Date')
            }
        });
        $('#start_date').change(function () {
            if($('#start_date').val().length>0) {
                dates();
            }
        });

            function dates() {
                $('#selectRange').val('Select')
                var selectEventTypeId=$('#selectEventTypeId').val();
                var selectApplicationTypeId=$('#selectApplicationTypeId').val();
                var selectNames=$('#selectEventTypeId option:selected').text();
                var end_date=$('#end_date').val();
                var start_date=$('#start_date').val();
                var d = new Date();
                var strDate = d.getFullYear() + "-" + ('0' +(d.getMonth()+1)).slice(-2)+ "-" +   ('0'+ d.getDate()).slice(-2) ;
                var today=strDate.split('-')
                var  todayString=today[0]+today[1]+today[2]
                var start=start_date.split('-')
                var end=end_date.split('-')
                var  start_string=start[2]+start[1]+start[0]
                var   end_string=end[2]+end[1]+end[0]

                console.log('start '+start_string+'  end  '+end_string +'  today  '+todayString )
                if(start_date !='') {
                    if (end_string <= todayString){
                        $('#end_date').css({border:'1px solid #589c5894',color:'green'});
                        if (end_string >= start_string) {
                            $('#end_date').css({border:'1px solid #589c5894',color:'green'});
                            $('#start_date').css({border:'1px solid #589c5894',color:'green'});
                            $('#eventTransactionTable').DataTable({
                                dom: 'Bfrtip',
                                "searching": true,
                                "columnDefs": [{
                                    "targets": [7, 8, 9],
                                    "className": "text-right",
                                },
                                    {
                                        targets:[4],
                                        visible:false,
                                    },
                                ],
                                buttons: ['pageLength',
                                    {
                                        extend: 'print',
                                        exportOptions: {
                                            columns: [0, 1, 2, 7, 8, 9]
                                        },
                                        title: function () {
                                            return 'Event Transactions ' + Date.now();
                                        },
                                        customize: function (win) {
                                            if(selectEventTypeId !=''){
                                            $(win.document.body).prepend(
                                                '<h3 style="font-family:arial;text-align:center;font-size: 16px;font-weight: bold""><span style="margin-left: 13%" >Event Transactions Between ' + start_date + ' and ' + end_date + '</span><span style="float:right" id="totalAmount">TOTAL: </span></h3>'
                                            );}
                                            else{
                                                $(win.document.body).prepend(
                                                    '<h3 style="font-family:arial;text-align:center;font-size: 16px;font-weight: bold""><span style="margin-left: 13%" >Event Transactions Between ' + start_date + ' and ' + end_date + '</span><span style="float:right" id="totalAmount">TOTAL: </span></h3>'
                                                );
                                            }
                                            var totalAmount= $('#totalAmount').html();
                                            var amount=$('#amountFooter').html();
                                            var vat=$('#vatFooter').html();
                                            var total=$('#totalFooter').html();
                                            $(win.document.body).find('table').append(
                                                '<tfoot><tr><th colspan="3" class="text-right">Total</th><th style="text-align:right;">'+amount+'</th><th style="text-align:right;">'+vat+'</th><th style="text-align: right">'+totalAmount+'</th></tr></tfoot>'
                                            );
                                            $(win.document.body).find('td').css({'font-size':'15px'})
                                            $(win.document.body).find('th').css({'font-size':'15px'})
                                            $(win.document.body).find('h3').css({'font-size':'15px'})
                                            $(win.document.body).find('td').css({'white-space': 'nowrap'})
                                            $(win.document.body).find('#totalAmount').append($('#totalFooter').html());
                                            $(win.document.body).prepend('<img src="{{asset('img/raktdalogo.png')}}"/>');
                                            $(win.document.body).find('h1').css('display', 'none')
                                            $(win.document.body).find( 'table' ).addClass( 'compact' ).css({ 'font-size': '12px'});
                                        }
                                    },
                                    {
                                        extend: 'excel',
                                         footer:true,
                                        title: function () {
                                            return 'Events Transactions ' + Date.now();
                                        },
                                    }
                                ],
                                lengthMenu: [
                                    [10, 25, 50],
                                    ['10 rows', '25 rows', '50 rows']
                                ],
                                processing: true,
                                language: {
                                    processing: '<span>Processing</span>',
                                },
                                serverSide: true,
                                footer: true,
                                ajax: {
                                    url: '{{route('admin.artist_permit_report.eventTransactionDateRange')}}',
                                    method: 'post',
                                    data: {
                                        selectEventTypeId: selectEventTypeId,
                                        selectApplicationTypeId:selectApplicationTypeId,
                                        start_date: start_date,
                                        end_date: end_date
                                    }
                                },
                                "columns": [
                                    {title: 'REFERENCE NO.', data: 'reference_number', name: 'reference_number'},
                                    {title: 'EVENT NAME', data: 'event_name', name: 'event_name'},
                                    {title: 'TRANSACTION DATE', data: 'transaction_date', name: 'transaction_date'},
                                    {title: 'EVENT DATE', data: 'issued_date', name: 'issued_date'},
                                    {title: 'EXPIRY DATE', data: 'expired_date', name: 'expired_date'},
                                    {title: 'TYPE', data: 'application_type', name: 'application_type'},
                                    {title: 'EVENT TYPE', data: 'event_type', name: 'event_type'},
                                    {title: 'AMOUNT', data: 'amount', name: 'amount'},
                                    {title: 'VAT (5%)', data: 'vat', name: 'vat'},
                                    {title: 'TOTAL', data: 'total', name: 'total'},
                                ],
                                footerCallback: function (row, data, start, end, display) {
                                    var api = this.api();
                                    // Remove the formatting to get integer data for summation
                                    var intVal = function (i) {
                                        return typeof i === 'string' ?
                                            i.replace(/[\$,]/g, '') * 1 :
                                            typeof i === 'number' ?
                                                i : 0;
                                    };
                                    // Total over all pages
                                    if (api.column(4).data().length > 0) {
                                        var amount = api
                                            .column(7, {page: 'current'})
                                            .data()
                                            .reduce(function (a, b) {
                                                return intVal(a) + intVal(b);
                                            });
                                        var vat = api
                                            .column(8, {page: 'current'})
                                            .data()
                                            .reduce(function (a, b) {
                                                return intVal(a) + intVal(b);
                                            });
                                        var total = api
                                            .column(9, {page: 'current'})
                                            .data()
                                            .reduce(function (a, b) {
                                                return intVal(a) + intVal(b);
                                            });

                                        $('#amountFooter').html(accounting.formatMoney(amount,'AED '));
                                        $('#totalAmount').html(accounting.formatMoney(total,'AED '));
                                        $('#vatFooter').html(accounting.formatMoney(vat,'AED '));
                                        $('#totalFooter').html(accounting.formatMoney(total,'AED '));

                                    } else {

                                        $('#amountFooter').html('0.00');
                                        $('#totalAmount').html('0.00');
                                        $('#vatFooter').html('0.00');
                                        $('#totalFooter').html('0.00');
                                    }
                                 },
                               });
                            }
                        else
                            {
                            alert('Start Date must be Less than End Date')
                               $('#end_date').css({border:'1px solid #ff0000c4',color:'#ff0000c4'});
                               $('#start_date').css({border:'1px solid #ff0000c4',color:'#ff0000c4'});
                          /*      setTimeout(
                                    function() {
                                        $('#end_date').css({border:'none',color:'#888'}); },
                                    2000
                                );*/
                        }
                       }
                    else
                        {
                         $('#start_tooltip').append('Please Select End Date').fadeOut(4000)
                        $('#end_date').css({border:'1px solid #ff0000c4',color:'#ff0000c4'});
                    }
                }
                else{
                    alert('Enter Start Date')
                }
            }
        });
    </script>
    <script src="{{asset('js/moneyFormator.js')}}"></script>

@endsection

