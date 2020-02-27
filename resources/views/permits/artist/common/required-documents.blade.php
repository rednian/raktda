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

                <div class="tab-pane show fade active" id="short" role="tabpanel">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <th style="width:50%">{{__('Document Name')}}</th>
                            <th style="width:50%">{{__('Notes')}}</th>
                        </tr>
                        @foreach($requirements as $req)
                        @if(strtolower($req->requirement_name) != 'other documents')
                        <tr>
                            <td>{{getLangId() == 1 ? ucfirst($req->requirement_name) : $req->requirement_name_ar}}
                            </td>
                            <td>{{getLangId() == 1 ? ucfirst($req->requirement_description) : $req->requirement_description_ar}}
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--
        <div id="collapseTwo6" class="collapse show" aria-labelledby="headingTwo6" data-parent="#accordionExample6">
            <div class="card-body">
                <section class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger"
                            role="tablist">
                            <li class="nav-item ">
                                <a class="nav-link active" data-toggle="tab" href="#short">{{__('Short Term')}}
                                    <small>({{__('less than 30 days')}})</small></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-toggle="tab" href="#long"
                                    data-target="#long">{{__('Long Term')}} <small>({{__('more than 30 days')}})</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
                <div class="tab-content">
                    <div class="tab-pane show fade active" id="short" role="tabpanel">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th style="width:50%">{{__('Document Name')}}</th>
                                <th style="width:50%">{{__('Notes')}}</th>
                            </tr>
                            
                            @foreach($requirements as $req)
                            @if(strtolower($req->requirement_name) != 'other documents' &&
                            $req->term == 'short')
                            <tr>
                                <td>{{getLangId() == 1 ? ucfirst($req->requirement_name) : $req->requirement_name_ar}}
                                </td>
                                <td>{{getLangId() == 1 ? ucfirst($req->requirement_description) : $req->requirement_description_ar}}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="tab-pane show" id="long" role="tabpanel">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <th style="width:50%">{{__('Document Name')}}</th>
                                <th style="width:50%">{{__('Notes')}}</th>
                            </tr>
                            @foreach($requirements as $req)
                            @if(strtolower($req->requirement_name) != 'other documents' &&
                            $req->term == 'long')
                            <tr>
                                <td>{{getLangId() == 1 ? ucfirst($req->requirement_name) : $req->requirement_name_ar}}
                                </td>
                                <td>{{getLangId() == 1 ? ucfirst($req->requirement_description) : $req->requirement_description_ar}}
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    -->
    </div>
</div>