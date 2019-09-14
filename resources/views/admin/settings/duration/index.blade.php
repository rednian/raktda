@extends('layouts.admin-app')
@section('style')
<link href="{{ asset('/assets/css/demo1/pages/general/wizard/wizard-3.css') }}" rel="stylesheet" type="text/css" />
<style>
    .kt-switch{ height: 0 !important;}
    .kt-switch.kt-switch--sm input:empty ~ span {
        margin: -20px -4px  !important;
        width: 32px;
        border-radius: 12px; 
        }
    .kt-section{ margin: 0;}
    .kt-wizard-v3 .kt-wizard-v3__wrapper .kt-form .kt-wizard-v3__content .kt-wizard-v3__form {
         margin-top: 0; 
    }
    .kt-wizard-v3 .kt-wizard-v3__wrapper .kt-form .kt-wizard-v3__content {
        padding-bottom: 1px;
        margin-bottom: 1rem;
    }
</style>
@endsection
@section('action')
<a href="#" class="btn btn-light btn-elevate active btn-raised">
  <i class="la la-arrow-left"></i>
  <span class="kt-hidden-mobile">Back</span>
</a>
<a href="#" class="btn btn-brand btn-sm btn-raised active">Artist Details</a>
@endsection
@section('content')
<section class="row">
    <div class="col-lg-12">
        <div class="kt-portlet kt-portlet--head-lg  kt-portlet--responsive-mobile" id="kt_page_portlet">
            <div class="kt-portlet__head kt-portlet__head--lg" style="">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Check Artist Application</h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    {{-- <a href="#" class="btn btn-clean kt-margin-r-10">
                        <i class="la la-arrow-left"></i>
                        <span class="kt-hidden-mobile">Back</span>
                    </a> --}}
                    <div class="btn-group">
                        <button type="button" id="btn-draft" class="btn btn-light btn-sm  ">
                            <i class="la la-check"></i>
                            <span class="kt-hidden-mobile">Save as Draft</span>
                        </button>
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(123px, 38px, 0px);">
                            <ul class="kt-nav">
                                <li class="kt-nav__item">
                                    <a href="javascript::void(0);" class="kt-nav__link" id="btn-rivision">
                                        <i class="kt-nav__link-icon flaticon2-reload"></i>
                                        <span class="kt-nav__link-text">Revise Application</span>
                                    </a>
                                </li>
                                {{-- <li class="kt-nav__item">
                                    <a href="javascript::void(0);" class="kt-nav__link" id="btn-approval">
                                        <i class="kt-nav__link-icon flaticon2-power"></i>
                                        <span class="kt-nav__link-text">Submit for Approval</span>
                                    </a>
                                </li> --}}
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           
            
        </div>
        
    </div>
</section>

@endsection

