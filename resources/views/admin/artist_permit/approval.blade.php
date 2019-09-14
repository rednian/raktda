@extends('layouts.admin-app')
@section('action')
<a href="javascript:void(0)" class="btn btn-sm btn-raised btn-light"><i class="la la-arrow-left"></i> Back</a>
<a href="javascript:void(0)" class="btn btn-sm btn-raised btn-brand">Company Details</a>
@endsection
@section('content')
    <section class="row">
        <div class="col-lg-12">
            <div class="kt-portlet kt-portlet--last  kt-portlet--responsive-mobile" id="kt_page_portlet">
                <div class="kt-portlet__head kt-portlet__head--lg" style="">
                    <div class="kt-portlet__head-label">
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="btn-group">
                            <button type="button" class="btn btn-brand btn-raised btn-sm ">
                                <span class="kt-hidden-mobile">Action</span>
                            </button>
                            <button type="button" class="btn btn-brand btn-raised dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-reload"></i>
                                            <span class="kt-nav__link-text">Save &amp; continue</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-power"></i>
                                            <span class="kt-nav__link-text">Save &amp; exit</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-edit-interface-symbol-of-pencil-tool"></i>
                                            <span class="kt-nav__link-text">Save &amp; edit</span>
                                        </a>
                                    </li>
                                    <li class="kt-nav__item">
                                        <a href="#" class="kt-nav__link">
                                            <i class="kt-nav__link-icon flaticon2-add-1"></i>
                                            <span class="kt-nav__link-text">Save &amp; add new</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <section class="row">
                        <div class="col">
                            <div class="form-group row">
                                <textarea name="comment"  rows="3" placeholder="Some comments here..." class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </section>
                    
                    
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    
@endsection