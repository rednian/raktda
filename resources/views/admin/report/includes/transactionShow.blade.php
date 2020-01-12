@extends('layouts.admin.admin-app')

@section('content')
     @php
        $eventAmount=[];
            @endphp
             @if($transaction->eventTransaction)
               @foreach($transaction->eventTransaction as $event)
                @php
                array_push($eventAmount,$event->vat+$event->amount)
               @endphp
            @endforeach
                @php
                 $arr2=   array_sum($eventAmount)
                @endphp
         @endif


     @php
         $artistAmount=[];
     @endphp
     @if($transaction->artistPermitTransaction)
         @foreach($transaction->artistPermitTransaction as $artist)
             @php
                 array_push($artistAmount,$artist->vat+$artist->amount)
             @endphp
         @endforeach
         @php
            $arr1= array_sum($artistAmount);
         @endphp
     @endif


    <div id="accordion">
        <span>
                        Total Amount Received On Transaction Id <span style="font-weight: bold">{{$transaction->reference_number}} is <span>{{$arr1+$arr2}}</span></span>

       </span>
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button style="font-weight: bold" class="btn btn-elevate collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Event Transactions
                    </button>
                </h5>
            </div>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    @if($transaction->eventTransaction)
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>EVENT NAME</th>
                                <th style="white-space: nowrap">
                                    TRANSACTION DATE
                                </th>
                                <th>TRANSACTION ID</th>
                                <th class="text-right">AMOUNT</th>
                                <th  class="text-right">VAT</th>
                                <th class="text-right">TOTAL</th>

                            </tr>
                         @foreach($transaction->eventTransaction as $event)
                        <tr>
                            <td>{{$event->event?$event->event->name_en:''}}</td>
                            <td>{{ date_format($transaction->created_at,'d-M-Y')}}</td>
                            <td>{{$transaction->reference_number}}</td>
                            <td class="text-right">{{number_format($event->amount,2)}}</td>
                            <td class="text-right">{{number_format($event->vat,2)}}</td>
                            <td class="text-right">{{number_format($event->vat+$event->amount,2)}}</td>
                        </tr>
              @endforeach
                        </table>
                        @endif

                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button style="font-weight: bold" class="btn btn-elevate collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Artist Transaction
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    @if($transaction->artistPermitTransaction)
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>EVENT NAME</th>
                                <th style="white-space: nowrap">TRANSACTION DATE</th>
                                <th>TRANSACTION ID</th>
                                <th class="text-right">AMOUNT</th>
                                <th class="text-right">VAT</th>
                                <th class="text-right">TOTAL</th>

                            </tr>
                            @foreach($transaction->artistPermitTransaction as $artist)
                                <tr>
                                    <td>{{$artist->artistPermit?$artist->artistPermit->firstname_en.' '.$artist->artistPermit->lastname_en:''}}</td>
                                    <td>{{ date_format($transaction->created_at,'d-M-Y')}}</td>
                                    <td>{{$transaction->reference_number}}</td>
                                    <td class="text-right">{{number_format($artist->amount,2)}}</td>
                                    <td class="text-right">{{number_format($artist->vat,2)}}</td>
                                    <td class="text-right">{{number_format($artist->vat+$artist->amount,2)}}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif                </div>
            </div>
        </div>
    </div>

@endsection



