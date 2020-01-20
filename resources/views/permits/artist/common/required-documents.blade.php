<div class="accordion accordion-solid border" id="accordionExample6">
    <div class="card">
        <div class="card-header" id="headingTwo6">
            <div class="card-title" data-toggle="collapse" data-target="#collapseTwo6" aria-expanded="false"
                aria-controls="collapseTwo6">
                <h6 class="kt-font-transform-u kt-font-bolder kt-font-dark">
                    {{__('Required Documents')}}</h6>
            </div>
        </div>
        <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6" data-parent="#accordionExample6">
            <div class="card-body">

                <table class="table table-borderless table-sm">
                    <tr>
                        <th style="width:50%">{{__('Document Name')}}</th>
                        <th style="width:50%">{{__('Notes')}}</th>
                    </tr>
                    @foreach($requirements as $req)
                    <tr>
                        <td>{{getLangId() == 1 ? $req->requirement_name : $req->requirement_name_ar}}
                        </td>
                        <td>{{getLangId() == 1 ? $req->requirement_description : $req->requirement_description_ar}}
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
</div>