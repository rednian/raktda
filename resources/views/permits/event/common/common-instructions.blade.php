{{-- <section class="accordion kt-margin-b-5 accordion-solid  border" id="permit-fee-details">
    <div class="card">
        <div class="card-header" id="headingThree6">
            <div class="card-title show" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false"
                aria-controls="collapseThree6">
                <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">
                    {{__('Permit Fee')}}
</h6>
</div>
</div>
<div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6" data-parent="#permit-fee-details">
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <tr>
                <th style="width:50%" class="kt-font-transform-u">
                    {{__('Event Type')}}</th>
                <th style="width:50%" class="kt-font-transform-u">{{__('Fee')}}
                    / {{__('Day')}} (AED)</th>
            </tr>
            @foreach($event_types as $pt)
            <tr>
                <td>{{$pt->name_en}}</td>
                <td>{{number_format($pt->amount,2)}}</td>
            </tr>
            @endforeach
        </table>


    </div>
</div>
</div>
</section> --}}
<section class="accordion kt-margin-b-5 accordion-solid border" id="permit-document-details">
    <div class="card">
        <div class="card-header" id="headingFour6">
            <div class="card-title show" data-toggle="collapse" data-target="#collapseFour6" aria-expanded="false"
                aria-controls="collapseFour6">
                <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark">
                    {{__('PERMIT FEE & REQUIRED DOCUMENTS')}}</h6>
            </div>
        </div>
        <div id="collapseFour6" class="collapse show" aria-labelledby="headingFour6"
            data-parent="#permit-document-details">
            <div class="card-body">

                @include('permits.event.common.documents_required',['event_types' =>
                $event_types])
            </div>
        </div>
    </div>
</section>