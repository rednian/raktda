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

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h4>{{__('Artist Permits')}}</h4>
        </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-0">
        <div class="row">
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Applied')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$artist_applied}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Valid')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$artist_valid}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Drafts')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$artist_expired}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Expired')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$artist_cancelled}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Cancelled')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$event_cancelled}}
                            </div>
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
    <div class="kt-portlet__body kt-padding-t-0">
        <div class="row">
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Applied')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$event_applied}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Valid')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$event_valid}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Drafts')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$event_drafts}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Expired')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$event_expired}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="kt-section kt-section--space-sm widget-toolbar">
                    <div class="kt-widget24 kt-widget24--solid">
                        <div class="kt-widget24__details">
                            <div class="kt-widget24__info">
                                <span class="kt-widget24__title">{{__('Cancelled')}}</span>
                                <small class="kt-widget24__desc">

                                </small>
                            </div>
                            <div class="kt-widget24__stats kt-font-default">
                                {{$event_cancelled}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection