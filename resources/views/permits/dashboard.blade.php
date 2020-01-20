@extends('layouts.app')

@section('style')
<style>
    .kt-widget17__item {
        padding: 1rem !important;
        margin: 0 0.5rem !important;
        background: rgba(0, 0, 0, .2) !important;
    }

    .kt-widget17__subtitle {
        /* display: inline !important; */
    }

    .kt-widget17__desc {
        float: right;
        font-size: 2rem !important;
    }
</style>
@endsection

@section('content')

{{-- <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
        </div>

        <div class="kt-portlet__head-toolbar">
            <button class="btn btn-sm btn-hover-warning btn-info kt-margin-r-10">
                {{__('Today')}}
</button>
<button class="btn btn-sm btn-hover-warning btn-info kt-margin-r-10">
    {{__('Month')}}
</button>
<button class="btn btn-sm btn-hover-warning btn-info kt-margin-r-10">
    {{__('Year')}}
</button>
</div>
</div>
</div> --}}

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h4>{{__('Artist Permits')}}</h4>
        </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-50 kt-padding-b-35">
        <div class="kt-widget17">
            <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--sides">
                <div class="kt-widget17__stats">
                    <div class="kt-widget17__items">
                        <div class="kt-widget17__item" style="">
                            <div class="kt-widget17__subtitle">{{__('Applied')}}</div>
                            <div class="kt-widget17__desc">{{$artist_applied}}</div>
                        </div>
                        <div class="kt-widget17__item" style="background-color: rgba(0,255,0,.2)">
                            <div class="kt-widget17__subtitle">{{__('Valid')}}</div>
                            <div class="kt-widget17__desc">{{$artist_valid}}</div>
                        </div>
                        <div class="kt-widget17__item" style="background-color: #f9f69a">
                            <div class="kt-widget17__subtitle">{{__('Drafts')}}</div>
                            <div class="kt-widget17__desc">{{$artist_drafts}}</div>
                        </div>

                        <div class="kt-widget17__item" style="background-color: #d58b8b">
                            <div class="kt-widget17__subtitle">{{__('Expired')}}</div>
                            <div class="kt-widget17__desc">{{$artist_expired}}</div>
                        </div>
                        <div class="kt-widget17__item" style="background-color: #8babc1">
                            <div class="kt-widget17__subtitle">{{__('Cancelled')}}</div>
                            <div class="kt-widget17__desc">{{$artist_cancelled}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h4>{{__('Event Permits')}}</h4>
        </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-50 kt-padding-b-35">
        <div class="kt-widget17">
            <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--sides">
                <div class="kt-widget17__stats">
                    <div class="kt-widget17__items">
                        <div class="kt-widget17__item" style="background-color: rgba(0,0,0,.2)">
                            <div class="kt-widget17__subtitle">{{__('Applied')}}</div>
                            <div class="kt-widget17__desc">{{$event_applied}}</div>
                        </div>
                        <div class="kt-widget17__item" style="background-color: rgba(0,255,0,.2)">
                            <div class="kt-widget17__subtitle">{{__('Valid')}}</div>
                            <div class="kt-widget17__desc">{{$event_valid}}</div>
                        </div>
                        <div class="kt-widget17__item" style="background-color: #f9f69a">
                            <div class="kt-widget17__subtitle">{{__('Drafts')}}</div>
                            <div class="kt-widget17__desc">{{$event_drafts}}</div>
                        </div>

                        <div class="kt-widget17__item" style="background-color: #d58b8b">
                            <div class="kt-widget17__subtitle">{{__('Expired')}}</div>
                            <div class="kt-widget17__desc">{{$event_expired}}</div>
                        </div>
                        <div class="kt-widget17__item" style="background-color: #8babc1">
                            <div class="kt-widget17__subtitle">{{__('Cancelled')}}</div>
                            <div class="kt-widget17__desc">{{$event_cancelled}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection