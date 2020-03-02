<div class="accordion accordion-solid border" id="accordionExample61">
    <div class="card">
        <div class="card-header" id="headingThree6">
            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseThree6" aria-expanded="false"
                aria-controls="collapseThree6">
                <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark"> {{__('PERMIT FEE FOR 30 DAYS')}}
                </h6>
            </div>
        </div>
        <div id="collapseThree6" class="collapse show" aria-labelledby="headingThree6"
            data-parent="#accordionExample61">
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <th style="width:50%">{{__('Profession')}}</th>
                        <th style="width:50%">{{__('Fee')}} (AED)</th>
                    </tr>
                    @foreach($profession as $pt)
                    <tr>
                        <td>{{getLangId() == 1 ? $pt->name_en : $pt->name_ar}}</td>
                        <td>{{number_format($pt->amount,2)}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>