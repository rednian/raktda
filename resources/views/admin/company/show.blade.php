@extends('layouts.admin.admin-app')
@section('content')
<div class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
    <div class="kt-portlet__head kt-portlet__head--sm">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title kt-font-dark">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}}</h3>
        </div>
        <div class="kt-portlet__head-toolbar">
            <a href="{{ route('admin.company.index') }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
                 <i class="la la-arrow-left"></i>
                 BACK TO Company LIST
            </a>
         </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-5">
         
    </div>
</div>
@stop
