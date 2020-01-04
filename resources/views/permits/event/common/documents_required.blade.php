<div class="kt-portlet__body">
    <ul class="nav nav-pills nav-fill" role="tablist">
        @php
        $i = 1;
        @endphp
        @foreach($event_types as $et)
        <li class="nav-item kt-margin-b-10">
            <a class="nav-link {{$i == 1 ? 'active' : ''}}" data-toggle="tab"
                href="#kt_tabs_5_{{$i}}">{{ getLangId() == 1 ? ucwords($et->name_en) : $et->name_ar}}</a>
        </li>
        @php
        $i++;
        @endphp
        @endforeach
    </ul>
    <div class="tab-content">
        @php
        $i = 1;
        @endphp
        @foreach($event_types as $et)
        <div class="tab-pane {{$i == 1 ? 'active' : ''}}" id="kt_tabs_5_{{$i}}" role="tabpanel">
            <table class="table table-borderless table-sm">
                <tr>
                    <th>#</th>
                    <th>{{__('Document Name')}}</th>
                    <th>{{__('Description')}}</th>
                </tr>
                @php
                $i = 1;
                @endphp
                @foreach($et->event_type_requirements as $req)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{getLangId() == 1 ? $req->requirement->requirement_name : $req->requirement->requirement_name_ar}}
                    </td>
                    <td>{{getLangId() == 1 ? $req->requirement->requirement_description : $req->requirement->requirement_description_ar}}
                    </td>
                </tr>
                @php
                $i++;
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