<div class="kt-portlet__body kt-padding-5">
    <section class="row">
        <div class="col-md-3">
            <div class="kt-padding-5 kt-margin-t-5">
                <p class="kt-font-transform-u kt-font-bolder kt-heading kt-margin-t-0">{{__('Event Types')}}</p>
                <ul class="nav nav-pills nav-fill nav-flex-column kt-margin-b-0" id="event_type_nav" role="tablist">
                    @php
                    $i = 1;
                    @endphp
                    @foreach($event_types as $et)
                    <li class="nav-item" style="width: 100%;">
                        <a class="nav-link {{$i == 1 ? 'active' : ''}} kt-padding-5" data-toggle="tab"
                            href="#kt_tabs_5_{{$i}}" style="display:flex;justify-content:space-between">
                             <span >{{ getLangId() == 1 ? ucfirst($et->name_en) : $et->name_ar}}</span>
                            <span ><i class="fa {{getLangId() == 1 ? 'fa-angle-right' : 'fa-angle-left'}} text-white"></i></span>
                        </a>
                    </li>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                @php
                $i = 1;
                @endphp
                @foreach($event_types as $et)
                <div class="tab-pane {{$i == 1 ? 'active' : ''}}" id="kt_tabs_5_{{$i}}" role="tabpanel">
                    @if($et->subType()->exists())
                    <table class="table table-borderless border table-sm subtype_table">
                        <thead>
                            <tr class="kt-font-transform-u">
                                <th class="text-center">#</th>
                                <th style="width: 70%;" class="kt-padding-l-20">{{__('Event Sub Type')}}</th>
                                <th style="width: 30%;" class="text-right kt-padding-r-20">{{__('Fee / Day')}}(AED)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $k = 1;
                            @endphp
                            @foreach($et->subType as $ett)
                            <tr class="kt-padding-l-20 kt-padding-r-20">
                                <td class="text-center">{{$k}}</td>
                                <td class="text-left ">
                                    {{ getLangId() == 1 ? ucfirst($ett->sub_name_en) : $ett->sub_name_ar}}
                                </td>
                                <td class="text-right kt-padding-r-20">
                                    {{number_format($et->amount,2)}}</td>
                            </tr>
                            @php
                            $k++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    <section class="row">
                    <h6 class="kt-heading p-0 m-0 pl-3">{{__('Required Documents')}}</h6>
                        <div class="col-md-12">
                            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger kt-margin-b-10"
                                role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active" data-toggle="tab"
                                        href="#corporate">{{__('Corporate')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#government"
                                        data-target="#government">{{__('Government')}} </a>
                                </li>
                            </ul>
                        </div>
                    </section>
                    <div class="tab-content">
                        <div class="tab-pane show fade active" id="corporate" role="tabpanel">
                            <table class="table table-borderless  kt-margin-t-10">
                                <thead>
                                    <tr class="kt-font-transform-u">
                                        <th class="text-center">#</th>
                                        <th style="width: 40%;">{{__('Document Name')}}</th>
                                        <th style="width: 50%;">{{__('Notes')}}</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @php
                                    $j = 1; $c_count = 0;
                                    @endphp
                                    @foreach($et->event_type_requirements as $req)
                                    @if(isset($req->requirement) && strtolower($req->requirement->requirement_name) !=
                                    'other documents' &&
                                    $req->requirement->type == 'corporate')
                                    @php
                                    $c_count++;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$j}}</td>
                                        <td>{{getLangId() == 1 ? ucfirst($req->requirement->requirement_name) : $req->requirement->requirement_name_ar}}
                                        </td>
                                        <td>{{getLangId() == 1 ? ucfirst($req->requirement->requirement_description) : $req->requirement->requirement_description_ar}}
                                        </td>
                                    </tr>
                                    @php
                                    $j++;
                                    @endphp
                                    @endif
                                    @endforeach
                                    @if($c_count == 0)
                                    <tr>
                                        <td></td>
                                        <td colspan="2">{{__('No Required Documents')}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="government" role="tabpanel">
                            <table class="table table-borderless  kt-margin-t-10">
                                <thead>
                                    <tr class="kt-font-transform-u ">
                                        <th class="text-center">#</th>
                                        <th style="width: 40%;">{{__('Document Name')}}</th>
                                        <th style="width: 50%;">{{__('Notes')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $j = 1; $g_count = 0;
                                    @endphp
                                    @foreach($et->event_type_requirements as $req)
                                    @if(isset($req->requirement) && strtolower($req->requirement->requirement_name) !=
                                    'other documents' &&
                                    $req->requirement->type == 'government')
                                    @php
                                    $g_count++;
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{$j}}</td>
                                        <td>{{getLangId() == 1 ? ucfirst($req->requirement->requirement_name) : $req->requirement->requirement_name_ar}}
                                        </td>
                                        <td>{{getLangId() == 1 ? ucfirst($req->requirement->requirement_description) : $req->requirement->requirement_description_ar}}
                                        </td>
                                    </tr>
                                    @php
                                    $j++;
                                    @endphp
                                    @endif
                                    @endforeach
                                    @if($g_count == 0)
                                    <tr>
                                        <td></td>
                                        <td colspan="2">{{__('No Required Documents')}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @php
                $i++;
                @endphp
                @endforeach
            </div>

        </div>
    </section>
</div>