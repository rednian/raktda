<div class="kt-portlet__body kt-padding-5">
    <section class="row">
        <div class="col-md-3">
            <div class="border kt-padding-5">
                <ul class="nav nav-pills nav-fill nav-flex-column kt-margin-b-0" role="tablist">
                    @php
                    $i = 1;
                    @endphp
                    @foreach($event_types as $et)
                    <li class="nav-item" style="width: 100%;">
                        <a class="nav-link {{$i == 1 ? 'active' : ''}} kt-padding-5" data-toggle="tab"
                            href="#kt_tabs_5_{{$i}}">{{ getLangId() == 1 ? ucwords($et->name_en) : $et->name_ar}}</a>
                    </li>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="border kt-padding-5">
                <div class="tab-content">
                    @php
                    $i = 1;
                    @endphp
                    @foreach($event_types as $et)
                    <div class="tab-pane {{$i == 1 ? 'active' : ''}}" id="kt_tabs_5_{{$i}}" role="tabpanel">
                        <table class="table table-borderless table-sm">
                            <tr class="kt-font-transform-u">
                                <th>#</th>
                                <th>{{__('Document Name')}}</th>
                                <th>{{__('Notes')}}</th>
                            </tr>
                            @php
                            $j = 1;
                            @endphp
                            @foreach($et->event_type_requirements as $req)
                            <tr>
                                <td>{{$j}}</td>
                                <td>{{getLangId() == 1 ? ucwords($req->requirement->requirement_name) : $req->requirement->requirement_name_ar}}
                                </td>
                                <td>{{getLangId() == 1 ? ucwords($req->requirement->requirement_description) : $req->requirement->requirement_description_ar}}
                                </td>
                            </tr>
                            @php
                            $j++;
                            @endphp
                            @endforeach
                            @if($et->event_type_requirements->count() == 0)
                            <tr>
                                <td></td>
                                <td colspan="2">{{__('No Documents Required')}}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>