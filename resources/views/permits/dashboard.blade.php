@extends('layouts.app')
@section('title', 'Dashboard - Smart Government Rak')
@section('style')
<style>
    .element-wrapper {
        padding-bottom: 3em;
    }

    .element-actions {
        float: right;
        position: relative;
        z-index: 2;
        margin-top: -0.2rem;
    }

    .element-wrapper .element-header {
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding-bottom: 1rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }

    .element-header::after {
        content: "";
        background-color: #b45454;
        width: 25px;
        height: 4px;
        border-radius: 0px;
        display: block;
        position: absolute;
        bottom: -3px;
        left: 0px;
    }

    h6.element-header {
        font-weight: 500;
        line-height: 1.2;
        color: #334152;
        font-size: 1.5rem;
    }

    .el-tablo {
        text-decoration: none;
        display: block;
        color: #3E4B5B;
        transition: all 0.25s ease;
    }

    .el-tablo:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0px 5px 12px rgba(126, 142, 177, 0.2);
    }

    .el-tablo:hover .label {
        -webkit-transform: translateY(-2px);
        transform: translateY(-2px);
    }

    .el-tablo:hover .label {
        color: #b45454;
    }

    .el-tablo:hover .value {
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px);
        color: #b45454;
    }

    .el-tablo .value {
        -webkit-transition: all 0.25s ease;
        transition: all 0.25s ease;
    }

    .element-box {
        padding: 1.5rem 2rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        background-color: #fff;
        box-shadow: 0px 2px 4px rgba(126, 142, 177, 0.12);
    }

    .label {
        display: block;
        font-size: .83rem;
        text-transform: uppercase;
        color: rgba(0, 0, 0, 0.8);
        letter-spacing: 1px;
    }

    .value {
        font-size: 2.43rem;
        font-weight: 500;
        letter-spacing: 1px;
        line-height: 1.2;
        display: inline-block;
        vertical-align: middle;
    }
</style>
@endsection


@section('content')


<div class="kt-portlet__body kt-padding-t-0">
    <div class="element-actions" style="float:{{ getLangId() == 1 ? 'right' : 'left'}}">
        <div class="form-inline justify-content-sm-end">
            <select name="filter_value" class="form-control form-control-sm" id="filter_value"
                onchange="filter_dashboard()">
                <option value="" disabled>{{__('Select')}}</option>
                <option value="today">{{__('Today')}}</option>
                <option value="lastweek">{{__('Last Week')}}</option>
                <option value="lastthirty">{{__('Last 30 days')}}</option>
                <option value="all" selected>{{__('All')}}</option>
            </select>
        </div>
    </div>
    <div class="col-md-12">
        <div class="element-wrapper">
            <h6 class="element-header">{{__('Artist Permit')}}</h6>
            <div class="element-content">
                <div class="row">
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Applied')}}</label>
                            <div class="value" id="artist_applied">{{$artist_applied}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Valid')}}</label>
                            <div class="value" id="artist_valid">{{$artist_valid}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Drafts')}}</label>
                            <div class="value" id="artist_drafts">{{$artist_drafts}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Expired')}}</label>
                            <div class="value" id="artist_expired">{{$artist_expired}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Cancelled')}}</label>
                            <div class="value" id="artist_cancelled">{{$artist_cancelled}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="element-wrapper">
            <h6 class="element-header">{{__('Event Permit')}}</h6>
            <div class="element-content">
                <div class="row">
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Applied')}}</label>
                            <div class="value" id="event_applied">{{$event_applied}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Valid')}}</label>
                            <div class="value" id="event_valid">{{$event_valid}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Drafts')}}</label>
                            <div class="value" id="event_drafts">{{$event_drafts}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Expired')}}</label>
                            <div class="value" id="event_expired">{{$event_expired}}</div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="element-box el-tablo">
                            <label class="label">{{__('Cancelled')}}</label>
                            <div class="value" id="event_cancelled">{{$event_cancelled}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function filter_dashboard()
    {
        $.ajax({
            type: "POST",
            url: "{{route('dashboard.filter')}}",
            data: { filterby: $('#filter_value').val()},
            dataType: "json",
            success: function(data) {
               if(data) {
                $('#artist_applied').html(data.artist_applied);
                $('#artist_valid').html(data.artist_valid);
                $('#artist_drafts').html(data.artist_drafts);
                $('#artist_expired').html(data.artist_expired);
                $('#artist_cancelled').html(data.artist_cancelled);
                $('#event_applied').html(data.event_applied);
                $('#event_valid').html(data.event_valid);
                $('#event_drafts').html(data.event_drafts);
                $('#event_expired').html(data.event_expired);
                $('#event_cancelled').html(data.event_cancelled);
               }
            }
        });
    }
</script>

@endsection