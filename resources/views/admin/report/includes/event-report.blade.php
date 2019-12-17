<style>
    #event-report_wrapper .dt-buttons{
        background-color: #edeef4;
    }
</style>
<table class="table table-hover  table-borderless table-striped border" id="event-report">
    <thead>

    <tr>
        <th colspan="3"><select class="foform-control-sm form-control custom-select custom-select-sm " name="applied_date" id="applied-date">
                <option value="">{{__('APPLIED DATE')}}</option>
                <option value="1">{{__('Today')}}</option>
                <option value="2">{{__('Yesterday')}}</option>
                <option value="3">{{__('7 Days')}}</option>
                <option value="4">{{__('30 Days')}}</option>
                <option value="5">{{__('This Month')}}</option>
                <option value="6">{{__('Last Month')}}</option>
            </select></th>
        <th colspan="2"><select name="application_type" id="application-type" class="form-control-sm form-control custom-select custom-select-sm ">
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
        <th><button class="btn btn-sm btn-secondary" id="reset-event-table">{{__('RESET')}}</button></th>
    </tr>

    <tr>
        <th></th>
        <th>{{ __('Reference No') }}</th>
        <th>{{ __('Name') }}</th>
        <th>{{ __('Description') }}</th>
        <th>{{ __('Venue') }}</th>
        <th>{{ __('Address') }}</th>
        <th>{{ __('Company') }}</th>
        <th>{{ __('Issue Date') }}</th>
        <th>{{ __('Event Type') }}</th>
        <th>{{ __('Application Type') }}</th>
        <th>{{ __('Status') }}</th>
    </tr>
    </thead>

</table>

@section('script')


@endsection
{{--@include('admin.artist_permit.includes.artist-block-modal')--}}

