@extends('layouts.admin.admin-app')
@section('style')
    <style>


    </style>
@endsection
@section('content')
    <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet"
             style="padding: 20px">
        <table class="table table-bordered container-fluid " id="DivToPrint" style="padding: 3px">
            <tr>
                <th colspan="2">
                    <img style="width: 100%;margin-left: -8px" src="{{asset('img/raktdalogo.png')}}" alt="">
                </th>
            </tr>
            <tr>
                <th colspan="2" align="center" style="padding: 5px;height: 34px">{{__('EVENTS TRANSACTIONS DETAILS')}}</th>
            </tr>
            <tr>
                <th width="35%">{{__('REFERENCE NUMBER')}}</th>

            </tr>
            <tr>
                <th>{{__('NAME')}}</th>

            </tr>
            <tr>
                <th>{{__('PERMIT NUMBER')}}</th>


            </tr>
            <tr>
                <th>{{__('COMPANY')}}</th>

            </tr>
            <tr>
                <th>{{__('VENUE')}}</th>

            </tr>
            <tr>
                <th>{{__('DESCRIPTION')}}</th>

            </tr>
            <tr>
                <th>{{__('EMIRATE')}}</th>

            </tr>
            <tr>
                <th>{{__('APPLICATION TYPE')}}</th>
                <td>{{$event->firm}}</td>
            </tr>
        </table>
        <div class="container" align="center">
            <button class="btn print_button btn-sm" id="ClicktoPrintEvent" style="text-align: center">{{__('PRINT')}}</button>
        </div>

    </section>


@endsection
@section('script')
    <script>

    </script>

@endsection
