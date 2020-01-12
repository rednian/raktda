@extends('layouts.app')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Transaction Reports')}}</h3>
            <span class=" text--yellow bg--maroon px-3 ml-3 text-center mr-2">
            </span>
        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover border table-borderless" id="transaction-details-table">
                <thead>
                    <tr class="kt-font-transform-u text-center">
                        <th>#</th>
                        <th>{{__('Transaction ID')}}</th>
                        <th>{{__('Transaction No')}}</th>
                        <th>{{__('Amount')}}(AED)</th>
                        <th>{{__('VAT')}}(AED)</th>
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
        
        var t = $('#transaction-details-table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            searching: true,
            ordering: false,
            // order:[[6,'desc']],
            ajax:'{{route("company.transactions")}}',
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
            }
            
        });

        t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

</script>

@endsection