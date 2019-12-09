
<table class="table table-hover  table-borderless table-striped border" id="event-report">
    <thead>

    <tr>
        <th colspan="3"><select class="form-control" name="applied_date" id="applied-date">
                <option value="">APPLIED DATE</option>
                <option value="1">Today</option>
                <option value="2">Yesterday</option>
                <option value="3">7 Days</option>
                <option value="4">30 days</option>
                <option value="5">This Month</option>
                <option value="6">Last Month</option>

            </select></th>
        <th colspan="2"><select name="application_type" id="application-type" class="form-control">
            <option value="">APPLICATION TYPE</option>
            <option value="private">Private</option>
            <option value="government">Government</option>
            <option value="individual">Individual</option>
            </select>
        </th>

        <th colspan="2">
            <select name="status" id="status" class="form-control">
            <option value="">STATUS</option>
            <option value="new">New</option>
            <option value="amended">Amended</option>
            </select>
        </th>
        <th><button class="btn btn-secondary" id="reset-event-table">RESET</button></th>
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
        <th>{{ __('Updated At') }}</th>
    </tr>
    </thead>

</table>

@section('script')


@endsection
{{--@include('admin.artist_permit.includes.artist-block-modal')--}}

