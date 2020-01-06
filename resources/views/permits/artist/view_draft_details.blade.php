@extends('layouts.app')

@section('content')

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-transform-u">{{__('Artist Permit Details')}}</h3>
        </div>

        <div class="kt-portlet__head-toolbar">
            <div class="my-auto float-right permit--action-bar">
                <a href="{{route('artist.index')}}#draft"
                    class="btn btn--maroon kt-font-bold kt-font-transform-u btn-elevate btn-sm">
                    <i class="la la-angle-left"></i>
                    {{__('Back')}}
                </a>
            </div>

            <div class="my-auto float-right permit--action-bar--mobile">
                <a href="{{route('artist.index')}}#draft" class="btn btn--maroon btn-elevate btn-sm">
                    <i class="la la-angle-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-0">

        <div class="kt-widget kt-widget--project-1">
            <div class="kt-widget__body kt-padding-l-0">
                <div class="kt-widget__stats ">
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('From Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-success btn-sm btn-bold btn-upper">
                                {{date('d M, y',strtotime($draft_details[0]->issue_date))}}
                            </span>
                        </div>
                    </div>
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('To Date')}}</span>
                        <div class="kt-widget__label">
                            <span class="btn btn-label-danger btn-sm btn-bold btn-upper">
                                {{date('d M, y',strtotime($draft_details[0]->expiry_date))}}
                            </span>
                        </div>
                    </div>
                    @if($draft_details[0]->event)
                    <div class="kt-widget__item">
                        <span class="kt-widget__date">{{__('Connected Event ?')}}</span>
                        <div class="kt-widget__label">
                            <span
                                class="btn btn-label-font-color-1 kt-label-bg-color-1 btn-sm btn-bold btn-upper cursor-text">
                                {{ getLangId() == 1 ? $draft_details[0]->event->name_en : $draft_details[0]->event->name_ar }}
                            </span>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="kt-widget__text kt-margin-t-10">
                    <strong>{{__('Work Location')}} :</strong>
                    {{getLangId() == 1 ? ucwords($draft_details[0]->work_location) : $draft_details[0]->work_location_ar}}
                </div>
            </div>



            <div class="table-responsive">
                <table class="table table-striped table-borderless border" id="applied-artists-table">
                    <thead>
                        <tr class="kt-font-transform-u">
                            <th>{{__('First Name')}}</th>
                            <th>{{__('Last Name')}}</th>
                            <th>{{__('Profession')}}</th>
                            <th>{{__('Mobile Number')}}</th>
                            <th>{{__('Status')}}</th>
                            <th class="text-center">{{__('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($draft_details as $atd)
                        <tr>
                            <td>{{ucwords($atd->firstname_en)}}</td>
                            <td>{{ucwords($atd->lastname_en)}}</td>
                            <td>{{ucwords($atd->profession['name_en'])}}</td>
                            <td>{{$atd->mobile_number}}</td>
                            <td>
                                {{ucwords($atd->artist_permit_status)}}
                            </td>
                            <td class="text-center">
                                <a href="{{URL::signedRoute('temp_artist_details.view' , [ 'id' => $atd->id , 'from' => 'view-draft'])}}"
                                    title="View">
                                    <button
                                        class="btn btn-sm btn-secondary btn-elevate btn-hover-warning">{{__('View')}}</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @endsection