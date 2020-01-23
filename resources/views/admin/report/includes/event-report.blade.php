<style>
    #event-report_wrapper .dt-buttons {
        background-color: #edeef4;
    }

</style>


    <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-1x nav-tabs-line-danger" role="tablist"
        id="event_ul_list" style="margin-top: -20px">

        <li id="active_events" class="nav-item"><a class="nav-link active" data-toggle="tab" href="#" data-target="#">
                <span style="font-size: 11px">{{__('ACTIVE EVENTS')}}</span>
                <input type="text" value="active" id="active_events_input" hidden>
            </a></li>
        <li id="events_next_30_days" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
                <span style="font-size: 11px">{{__('EVENTS IN NEXT 30 DAYS')}}</span>
                <input type="text" value="+30" id="events_in_30_days" hidden>
            </a></li>
        <li id="events_next_60_days" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
                <span style="font-size: 11px">{{__('EVENTS IN NEXT 60 DAYS')}}</span>
                <input type="text" value='+60' id="events_in_60_days" hidden>
            </a></li>
        <li id="events_previous_30_days" class="nav-item"><a class="nav-link" data-toggle="tab" href="#">
                <span style="font-size: 11px">{{__('EVENTS IN LAST 30 DAYS')}}</span>
                <input type="text" value='-30' id="events_in_previous_30_days" hidden>
            </a></li>

        <li id="all_events" class="nav-item"><a class="nav-link" data-toggle="tab" href="#" data-target="#">
                <span style="font-size: 11px;">{{__('ALL EVENTS')}}</span>
                <input type="text" value="all" id="all_events_input" hidden>
            </a></li>
        <button id="filter_event_button"
                style="height: 27px;line-height: 2px;border-radius: 2px;margin-top: 10px;margin-left: 11px;"
                class="btn btn-sm pull-right btn-warning">Filter
        </button>

        <button id="reset_event_table"
                style="    height: 27px;line-height: 2px;border-radius: 2px;margin-top: 10px;margin-left: 11px;"
                class="btn btn-sm pull-right btn-secondary">Reset
        </button>
        </li>
    </ul>


<table class="table table-hover  table-bordered table-striped " id="event-report">
    <thead>

    <tr id="filter_to_hide" style="display: none">
        <th colspan="2"><select class="foform-control-sm form-control custom-select custom-select-sm "
                                name="applied_date" id="applied-date">
                <option value="">{{__('APPLIED DATE')}}</option>
                <option value="1">{{__('Today')}}</option>
                <option value="2">{{__('Yesterday')}}</option>
                <option value="3">{{__('7 Days')}}</option>
                <option value="4">{{__('30 Days')}}</option>
                <option value="5">{{__('This Month')}}</option>
                <option value="6">{{__('Last Month')}}</option>
            </select></th>
        <th colspan="2"><select name="application_type" style="width: fit-content" id="application-type"
                                class="form-control-sm form-control custom-select custom-select-sm ">
                <option value="">{{__('APPLICATION TYPE')}}</option>
                <option value="corporate">{{__('Corporate')}}</option>
                <option value="government">{{__('Government')}}</option>
                {{--  <option value="individual">{{__('Individual')}}</option>--}}
            </select>
        </th>

        <th colspan="2">
            <select name="status" id="status" class="form-control-sm form-control custom-select custom-select-sm ">
                <option value="">{{__('STATUS')}}</option>
                <option value="new">{{__('New')}}</option>
                <option value="amended">{{__('Amended')}}</option>
            </select>
        </th>
        <th>
            <button class="btn btn-sm btn-secondary" id="reset_event_table">{{__('RESET')}}</button>
        </th>
    </tr>
    <tr>
        <th style="font-weight: bold;white-space: nowrap">{{ __('REFERENCE NO.') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('APPLICATION TYPE') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('EVENT TYPE') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('EVENT NAME') }}</th>
        <th style="font-weight: bold">{{ __('DESCRIPTION') }}</th>
        <th style="font-weight: bold">{{ __('VENUE') }}</th>
        <th style="font-weight: bold">{{ __('ADDRESS') }}</th>
        <th style="font-weight: bold">{{ __('COMPANY') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('EVENT DATE') }}</th>
        <th style="font-weight: bold;white-space: nowrap">{{ __('NO. OF DAYS') }}</th>
        <th style="font-weight: bold">{{ __('STATUS') }}</th>
        <th></th>
    </tr>
    </thead>
</table>

{{--@include('admin.artist_permit.includes.artist-block-modal')--}}

