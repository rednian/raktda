@extends('layouts.app')

@section('title', 'Edit Details - Smart Government Rak')

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/jquery.filer/css/jquery.filer.css') }}">
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/vendors/custom/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}">
<style>
    .jFiler-items-default .jFiler-item {
        padding: 8px;
        margin-bottom: 5px;
    }
    .make--disabled:parent {
        pointer-events:none;
    } 
    .make--disabled {
        cursor:no-drop;
        background: #ccc !important;
    }
    input.make--disabled:focus {
       border:1px solid #cccccc !important;
    }
</style>
@stop
@section('content')

@if(check_is_blocked()['status'] == 'rejected')
@include('permits.artist.common.company_reject')
@endif

@if(check_is_blocked()['status'] == 'blocked')
@include('permits.artist.common.company_block')
@endif
<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#company-edit" role="tab" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path
                                    d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                                    fill="#000000" fill-rule="nonzero"></path>
                                <path
                                    d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                                    fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>{{ __('Update Establishment Information') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <section class="kt-portlet__body kt-padding-t-15">
        <div class="tab-content kt-font-dark">
            <div class="tab-pane active" id="company-edit" role="tabpanel">

                @if ($company->status == 'back')
                <div class="alert alert-outline-danger fade show kt-padding-t-10 kt-padding-b-10" role="alert">
                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                    <div class="alert-text">
                        <div class="kt-font-bold"> {{__('Your application was bounced back, see the comment below')}}:</div>
                        <ul class="kt-margin-t-10">
                            @if ($company->comment()->latest()->exists())
                            <li>
                                {{ getLangId() == 1 ? ucfirst($company->comment()->latest()->first()->comment_en) : $company->comment()->latest()->first()->comment_ar}}
                            </li>
                            @endif
                        </ul>
                    </div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>
                @endif

                <div class="kt-form kt-form--label-right">


                    @if ($company->status == 'draft')
                    <div class="alert alert-outline-danger alert-elevate fade show kt-padding-b-5 kt-padding-t-5"
                        role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">
                            <ul>
                                <li>{{__('Please complete the required fields below and submit for approval and enjoy the full services of RAKTDA. ')}}
                                </li>
                                @if ($invalid)
                                <li>{{__('Please make sure all documents are uploaded before submitting.')}}</li>
                                @endif
                            </ul>
                        </div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>
                    @endif

                    <div class="kt-form__body kt-font-dark">
                        <div class="kt-section kt-section--first">
                            <div class="kt-section__body">



                                @if ($company->status == 'active' && $company->event()->count() < 0 || $company->
                                    permit()->count() < 0) <div class="alert alert-success" role="alert">
                                        <div class="alert-text">
                                            <h4 class="alert-heading">Congratulations. Your establishment is
                                                registered successfully!</h4>
                                            <p>You can now apply an <a href="{{ URL::signedRoute('event.create') }}"
                                                    class="btn btn-sm btn--maroon">EVENT
                                                    PERMIT</a> or <a href="{{ URL::signedRoute('artist.create') }}"
                                                    class="btn btn-sm btn--maroon">ARTIST
                                                    PERMIT</a> and enjoy the full services of RAKTDA.</p>
                                            {{-- <hr> --}}
                                            {{-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> --}}
                                        </div>
                            </div>
                            @endif

                            @if ($company->status == 'new' || $company->status == 'pending')
                            <div class="alert alert-success kt-padding-b-5" role="alert">
                                <div class="alert-text">
                                    <h4 class="alert-heading">Registration successfully submitted!</h4>
                                    <p>Your registration will be check by RAKTDA and notify you as soon as
                                        possible.</p>
                                    {{-- <hr> --}}
                                    {{-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> --}}
                                </div>
                            </div>
                            @else

                            <form name="edit_company" action="{{ route('company.update', $company->company_id) }}"
                                method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                {{-- @method('PUT') --}}
                                @csrf
                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                    <div class="card border">
                                        <div class="card-header" id="headingOne6">
                                            <div class="card-title kt-padding-t-10 kt-padding-b-5"
                                                data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true"
                                                aria-controls="collapseOne6">
                                                <h6 class="kt-font-dark ">{{__('Establishment Details')}}</h6>
                                            </div>
                                        </div>
                                        <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6"
                                            data-parent="#accordionExample6" style="">
                                            <div class="card-body">
                                                {{-- <section required class="row form-group form-group-sm">
                                                                <div class="col-md-6">
                                                                    <label >Establistment Type <span class="text-danger">*</span></label>
                                                                    @if ($company->status == 'active' || $company->status == 'blocked')
                                                                    <input value="{{Auth::user()->LanguageId == 1 ?   ucfirst($company->type->name_en) : $company->type->name_ar}}"
                                                type="text" class="form-control form-control-sm" autocomplete="off"
                                                disabled>
                                                @else
                                                <select name="company_type_id" class="form-control form-control-sm">
                                                    @if (App\CompanyType::orderBy('name_en')->count() > 0)
                                                    @foreach (App\CompanyType::orderBy('name_en')->get() as $type)
                                                    <option
                                                        {{$company->company_type_id == $type->company_type_id ? 'selected': null }}
                                                        value="{{$type->company_type_id}}">{{ucfirst($type->name_en)}}
                                                    </option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                                @endif

                                            </div>
    </section> --}}
    <section class="row form-group form-group-sm">
        @php
        if ($company->status == 'active' || $company->status == 'blocked') {
        $disabled = 'readonly';
        }
        else{
        $disabled = null;
        }
        @endphp
        <div class="col-md-6">
            <input type="hidden" name="empty_document" value="{{$invalid}}">
            <label>{{__('Establishment Name')}} <span class="text-danger">*</span></label>
            <input 
                type="text"
                name="name_en" 
                dir="ltr" 
                autocomplete="off"
                class="form-control form-control-sm {{$disabled == 'readonly' ? 'make--disabled' : '' }} @error('name_en') is-invalid @enderror" 
                value="{{old( 'name_en',$company->name_en)}}"
                required
                {{$disabled}}
                >
            @if ($errors->has('name_en'))
            <div class="invalid-feedback">{{$errors->first('name_en')}}</div>
            @endif

        </div>
        <div class="col-md-6">
            <label>{{__('Establishment Name (AR)')}}<span class="text-danger">*</span></label>
            <input required {{$disabled}} dir="rtl" name="name_ar" autocomplete="off"
                class="@error('name_ar') is-invalid @enderror form-control form-control-sm {{!is_null($disabled) ? 'make--disabled' : '' }}" type="text"
                value="{{old('name_ar', $company->name_ar)}}">
            @if ($errors->has('name_ar'))
            <div class="invalid-feedback">{{$errors->first('name_ar')}}</div>
            @endif
        </div>
    </section>
    <section id="trade-license-container" class="row form-group form-group-sm license">

        <div class="col-md-6">
            <div class="row form-group form-group-sm">
                <div class="col-sm-6">
                    <label>{{__('Business License Number')}}<span class="text-danger">*</span></label>
                    <input required name="trade_license" autocomplete="off" class="form-control form-control-sm
                                                                       @error('trade_license') is-invalid @enderror"
                        type="text" value="{{$company->trade_license }}">
                    @if ($errors->has('trade_license'))
                    <div class="invalid-feedback"> {{$errors->first('trade_license')}}</div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <label>{{__('Business License Expiry Date')}}<span class="text-danger">*</span></label>
                    <input required name="trade_license_expired_date" autocomplete="off"
                        class="date-picker end form-control form-control-sm
                                                                      @error('trade_license_    _date') is-invalid @enderror" type="text"
                        value="{{$company->trade_license_expired_date ? $company->trade_license_expired_date->format('d-m-Y') :  null }}">
                    @if ($errors->has('trade_license_expired_date'))
                    <div class="invalid-feedback"> {{$errors->first('trade_license_expired_date')}}</div>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row form-group form-group-sm">
                <div class="col-sm-6">
                    <label>{{__('Phone Number')}} <span class="text-danger">*</span></label>
                    <input required name="phone_number" autocomplete="off" class="form-control form-control-sm"
                        type="text" value="{{old('phone_number', $company->phone_number)}}">
                </div>
                <div class="col-sm-6">
                    <label>{{__('Email')}} <span class="text-danger">*</span></label>
                    <input required name="company_email" autocomplete="off"
                        class="form-control form-control-sm @error('company_email') is-invalid @enderror" type="text"
                        value="{{old('company_email', $company->company_email)}}">
                </div>
                @if ($errors->has('company_email'))
                <div class="invalid-feedback"> {{$errors->first('company_email')}}</div>
                @endif
            </div>

        </div>
    </section>
    <section class="row form-group form-group-sm">

    </section>
    <section class="row form-group form-group-sm">
        <div class="col-md-6">
            <div class="row form-group form-group-sm">
                <div class="col-sm-12">
                    <label>{{__('Area')}}<span class="text-danger">*</span></label>
                    <select required name="area_id" class="select2 form-control form-control-sm
                                                                      @error('area_id') is-invalid @enderror">
                        <option></option>
                        @if (App\Areas::where('emirates_id', 5)->orderBy('area_en')->count() > 0)
                        @foreach (App\Areas::where('emirates_id', 5)->orderBy('area_en')->get() as $area)
                        <option {{ $area->id == $company->area_id ? 'selected': null }}
                            value="{{old('area_id',$area->id)}}">{{getLangId() == 1 ? ucfirst($area->area_en) : $area->area_ar}}</option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('area_id'))
                    <div class="invalid-feedback"> {{$errors->first('area_id')}}</div>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="row form-group form-group-sm">
                <div class="col-sm-12">
                    <label>{{__('Address in Ras Al Khaimah')}}<span class="text-danger">*</span></label>
                    <textarea required dir="ltr" name="address" autocomplete="off" rows="2"
                        class="form-control @error('address') is-invalid @enderror">{{old('address', $company->address)}}</textarea>
                    @if ($errors->has('address'))
                    <div class="invalid-feedback"> {{$errors->first('address')}}</div>
                    @endif
                </div>

            </div>

        </div>
    </section>
    <section class="row form-group form-group-sm">
        <div class="col-md-6">
            <label>{{__('Establishment Details')}}<span class="text-danger">*</span></label>
            <textarea required rows="3" autocomplete="off" dir="ltr" class="form-control form-control-sm
                                                               @error('company_description_en') is-invalid @enderror"
                name="company_description_en">{{old('company_description_en',$company->company_description_en)}}</textarea>
            @if ($errors->has('company_description_en'))
            <div class="invalid-feedback"> {{$errors->first('company_description_en')}}</div>
            @endif
        </div>
        <div class="col-md-6">
            <label>{{__('Establishment Details (AR)')}}<span class="text-danger">*</span></label>
            <textarea required dir="rtl" rows="3" autocomplete="off"
                class="form-control form-control-sm @error('company_description_ar') is-invalid @enderror"
                name="company_description_ar">{{old('company_description_ar', $company->company_description_ar)}}</textarea>
            @if ($errors->has('company_description_ar'))
            <div class="invalid-feedback"> {{$errors->first('company_description_ar')}}</div>
            @endif
        </div>
    </section>

</div>
</div>
</div>
</div>
<div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-10" id="accordion-contact">
    <div class="card border">
        <div class="card-header" id="heading-contact">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse"
                data-target="#collapse-contact" aria-expanded="true" aria-controls="collapse-contact">
                <h6 class="kt-font-dark ">{{__('CONTACT PERSON DETAILS')}}</h6>
            </div>
        </div>
        <div id="collapse-contact" class="collapse show" aria-labelledby="heading-contact"
            data-parent="#accordion-contact" style="">
            <div class="card-body">
                <section class="row form-group form-group-sm">
                    <div class="col-md-6">
                        <label>{{__('Full Name (EN)')}} <span class="text-danger">*</span></label>
                        <input required autocomplete="off" name="contact_name_en"
                            class="form-control form-control-sm @error('contact_name_en') is-invalid @enderror"
                            type="text" value="{{old('contact_name_en', $company->contact->contact_name_en)}}">
                        @if ($errors->has('contact_name_en'))
                        <div class="invalid-feedback"> {{$errors->first('contact_name_en')}}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label>{{__('Full Name (AR)')}}<span class="text-danger">*</span></label>
                        <input required dir="rtl" name="contact_name_ar" autocomplete="off"
                            class="form-control form-control-sm @error('contact_name_ar') is-invalid @enderror"
                            type="text" value="{{old('contact_name_ar', $company->contact->contact_name_ar)}}">
                        @if ($errors->has('contact_name_ar'))
                        <div class="invalid-feedback"> {{$errors->first('contact_name_ar')}}</div>
                        @endif
                    </div>
                </section>
                <section class="row form-group form-group-sm">
                    <div class="col-md-6">
                        <label>{{__('Designation (EN)')}} <span class="text-danger">*</span></label>
                        <input required autocomplete="off" name="designation_en"
                            class="form-control form-control-sm @error('designation_en') is-invalid @enderror"
                            type="text" value="{{old('designation_en' ,$company->contact->designation_en)}}">
                        @if ($errors->has('designation_en'))
                        <div class="invalid-feedback"> {{$errors->first('designation_en')}}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label>{{__('Designation (AR)')}} <span class="text-danger">*</span></label>
                        <input dir="rtl" name="designation_ar" autocomplete="off"
                            class="form-control form-control-sm @error('designation_ar') is-invalid @enderror"
                            type="text" value="{{old('designation_ar', $company->contact->designation_ar)}}">
                        @if ($errors->has('designation_ar'))
                        <div class="invalid-feedback"> {{$errors->first('designation_ar')}}</div>
                        @endif
                    </div>
                </section>


                <section class="row form-group form-group-sm">

                    <div class="col-md-6">
                        <label>{{__('Mobile Number')}} <span class="text-danger">*</span></label>
                        <input required autocomplete="off" name="mobile_number"
                            class="form-control form-control-sm @error('mobile_number') is-invalid @enderror"
                            type="text" value="{{old('mobile_number', $company->contact->mobile_number)}}">
                        @if ($errors->has('mobile_number'))
                        <div class="invalid-feedback"> {{$errors->first('mobile_number')}}</div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label>{{__('Emirates ID')}} <span class="text-danger">*</span></label>
                                <input required autocomplete="off" name="emirate_identification"
                                    class="form-control form-control-sm @error('emirate_identification') is-invalid @enderror"
                                    type="text"
                                    value="{{old('emirate_identification', $company->contact->emirate_identification)}}">
                                @if ($errors->has('emirate_identification'))
                                <div class="invalid-feedback"> {{$errors->first('emirate_identification')}}</div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                <label>{{__('Emirates ID Expiry Date')}}
                                    <span class="text-danger">*</span></label>
                                <input required autocomplete="off" name="emirate_id_expired_date"
                                    class="date-picker end form-control form-control-sm @error('emirate_id_expired_date') is-invalid @enderror"
                                    type="text"
                                    value="{{ old('emirate_id_expired_date',($company->contact->emirate_id_expired_date ? $company->contact->emirate_id_expired_date->format('d-m-Y') :  null))}}">
                                @if ($errors->has('emirate_id_expired_date'))
                                <div class="invalid-feedback"> {{$errors->first('emirate_id_expired_date')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-10" id="accordion-requirement">
    <div class="card border">
        <div class="card-header" id="heading-requirement">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse"
                data-target="#collapse-requirement" aria-expanded="true" aria-controls="collapse-requirement">
                <h6 class="kt-font-dark "><span class="kt-font-transform-u">{{__('Required Documents')}}</span>
                    {{-- <small>Please upload the  documents.</small> --}}
                </h6>
            </div>
        </div>
        <div id="collapse-requirement" class="collapse show" aria-labelledby="heading-requirement"
            data-parent="#accordion-requirement">
            <div class="card-body">
                <div class="alert alert-secondary fade kt-margin-b-20 show kt-padding-t-10 kt-padding-b-0"
                    role="alert">
                    <div class="alert-icon">
                        <i class="flaticon-warning"></i>
                    </div>
                    <div class="alert-text kt-font-dark">
                        {{-- <span class="kt-font-danger kt-font-bold">{{__('Note')}}:</span> --}}
                        <ul>
                            {{-- <li class="kt-font-danger">{{__('Uploaded files will be deleted if not submitted or saved as draft.')}}</li>
                            <li>{{__('Uploading file not in the list? Please use the Other upload option.')}}</li> --}}
                            <li>{{__('The maximum file size for uploads is 5MB')}}</li>
                            <li>{{__('Accepted documents formats (pdf, jpg, png)')}}</li>
                        </ul>
                    </div>
                    <div class="alert-close">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="la la-close"></i></span>
                        </button>
                    </div>
                </div>


                <section class="row form-group form-group-xs" id="upload-row">
                    <div class="col-md-3">
                        <label>{{__('Document Name')}} <span class="text-danger">*</span></label>
                        <select name="requirement_id" class=" form-control"></select>
                    </div>
                    <div class="col-md-4">
                        <label>{{__('Upload Document')}} <span class="text-danger">*</span></label>
                        <input id="file" onchange="readUrl(this);" type="file" multiple class="form-control">
                    </div>
                    {{--                                                      <div class="col-md-2 date-required">--}}
                    {{--                                                        <label>{{__('Issued Date')}} <span
                        class="text-danger">*</span></label>--}}
                    {{--                                                        <input autocomplete="off" id="upload-date-start"  name="issued_date" type="text" multiple class="form-control date-picker start">--}}
                    {{--                                                      </div>--}}
                    {{--                                                      <div class="col-md-2 date-required">--}}
                    {{--                                                        <label>{{__('Expiry Date')}} <span
                        class="text-danger">*</span></label>--}}
                    {{--                                                        <input id="upload-date-end"  name="expired_date" type="text" multiple class="form-control date-picker end">--}}
                    {{--                                                      </div>--}}
                    <div class="col-md-1">
                        <label class="invisible">{{__('Button')}}</label>
                        <button autocomplete="off" type="button" id="btn-save"
                            class="btn btn-warning kt-font-transform-u">{{__('Upload')}}</button>
                    </div>
                </section>

                <table class="table table-borderless border" id="upload-requirement-table">
                    <thead>
                        <tr>
                            <th>{{__('Requirement Name')}}</th>
                            <th>{{__('No.of.Files')}}</th>
                            {{-- <th>{{__('ISSUED DATE')}}</th>
                            <th>{{__('EXPIRED DATE')}}</th> --}}
                            <th>{{__('Action')}}</th>
                        </tr>
                    </thead>
                </table>

            </div>

        </div>

    </div>
</div>
<div class="form-group row kt-margin-t-10 text-right">
    <div class="col-sm-12">
        @if ($company->status == 'draft')
        <button style="padding: 0.5rem 1rem;" type="submit" name="submit" value="draft"
            class="btn btn-secondary btn-sm kt-font-transform-u kt-font-dark btn-hover-warning">
            {{__('Save as Draft')}}
        </button>
        @endif
        <button {{$company->status == 'rejected' ? 'disabled' : null}} type="submit" name="submit" value="submitted"
            class="btn btn--maroon btn-sm kt-font-transform-u">{{__('Submit Application')}}</button>
    </div>

</div>
</form>
@endif


</div>
</div>
</div>
</div>
</div>


</div>
</section>
@endsection
@section('script')
<script src="{{ asset('assets/vendors/custom/jquery.filer/js/jquery.filer.js') }}"></script>
<script>
    window.files = [];
    var filenames = [];
    var name = null;
    var requirementTable = {};
    var is_valid = false;

    $(document).ready(function () {
        requirement();
        datePicker();
        type();
        uploaded();
        hasUrl();


       var form =  $('form[name=edit_company]').validate({
        //    rules:{
        //     trade_license_expired_date:{
        //         required: true,
        //         greaterThan: $(this).val()
        //     }
        //     },
            invalidHandler: function(e, validator){
                KTUtil.scrollTop();
            }
        });


        $('form[name=edit_company]').submit(function(){
            if(form.valid()){
                KTApp.block('.kt-portlet', {
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: 'Please wait...'
                });
            }
        });


        $('.select2').select2({
            placeholder: '{{__('Please select Area in Ras Al Khaimah')}}',
            allowClear: true
        });


        $('#btn-save').click(function () {
            var name = $('#upload-row').find('select').val();
            var file = document.getElementById('file').files;

            if (file.length == 0) {
                $('#upload-row').find('#file').addClass('is-invalid');
                is_valid = false;
            } else {
                $('#upload-row').find('input#file').removeClass('is-invalid');
                is_valid = true;
            }

            if (name == null) {
                $('#upload-row').find('select').addClass('is-invalid');
                is_valid = false;
            } else {
                $('#upload-row').find('select').addClass('is-valid');
                is_valid = true;
            }

            if (is_valid) {
                $(this).removeAttr('disabled', true);
                upload();
            } else {
                $(this).attr('disabled', true);
            }
        });

        $('#upload-row').find('select').change(function () {
            var attr = $('#upload-row').find('input.date-picker');
            if (typeof attr !== typeof undefined && attr !== false) {
                attr.val(' ');
            }

            if ($(this).val() && $('input[type=file]').prop('files') > 0) {
                $('#upload-row').find('button#btn-save').removeAttr('disabled', true);
                $(this).removeClass('is-invalid').addClass('is-valid');
                $('inputfile]#file').val(' ');
                // files = [];
            } else {
                $('#upload-row').find('button#btn-save').attr('disabled', true);
                $(this).addClass('is-valid');
            }
        });


        $('#upload-row').find('input#file').change(function () {
                if ($(this).prop('files') > 0 && $('#upload-row').find('select').val() == null) {
                    $('#upload-row').find('button#btn-save').attr('disabled', true);
                    $(this).addClass('is-valid');
                } else {
                    $('#upload-row').find('button#btn-save').removeAttr('disabled', true);
                    $(this).removeClass('is-invalid').addClass('is-valid');
                }
            });


    });


                    // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                    //   var current_tab = $(e.target).attr('href');

                    //   if('#new-request' == current_tab ){  newCompany(); }
                    //   if('#processing-request' == current_tab ){ processing();   }
                    //   if('#active-company' == current_tab ){  company(); }
                    // });


                    // $('form[name=edit_company]').validate({
                    //   submitHandler: function(form){
                    //     KTApp.block('.kt-portlet', {
                    //            overlayColor: '#000000',
                    //            type: 'v2',
                    //            state: 'success',
                    //            message: 'Please wait...'
                    //        });
                    //   },

                    //   invalidHandler: function(){
                    //     KTApp.unblock('.kt-portlet');
                    //     KTUtil.scrollTop();
                    //   },

                    // });


    function hasUrl() {
        var hash = window.location.hash;
        hash && $('ul.nav a[href="' + hash + '"]').tab('show');
        $('.nav-tabs a').click(function (e) {
            $(this).tab('show');
            var scrollmem = $('body').scrollTop();
            window.location.hash = this.hash;
            $('html,body').scrollTop(scrollmem);
        });
    }


    function uploaded() {
        requirementTable = $('#upload-requirement-table').DataTable({
            dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            ajax: '{{ route('company.requirement.datatable', $company->company_id) }}',
            // columnDefs:[{targets: [4], className:'no-wrap'}],
            "order": [[0, 'asc']],
            rowGroup: {
                startRender: function (rows, group) {
                    var row_data = rows.data()[0];
                    return $('<tr/>').append('<td >' + group + '</td>')
                        .append('<td>' + rows.count() + '</td>')
                        // .append('<td>' + row_data.issued_date + '</td>')
                        // .append('<td>' + row_data.expired_date + '</td>')
                        .append('<td></td>')
                        // .append( '<td>'+row_data.action+'</td>' )
                        .append('<tr/>');
                },
                dataSrc: 'name'
            },
            columns: [
                // {data: 'name'},
                {data: 'file'},
                {
                    render: function (data) {
                        return null
                    }
                },
                // {
                //     render: function (data) {
                //         return null
                //     }
                // },
                // {
                //     render: function (data) {
                //         return null
                //     }
                // },
                {data: 'action'},
            ],
            createdRow: function (row, data, index) {
                $('.btn-remove', row).click(function () {
                    $.ajax({
                        url: '{{ route('company.requirement.delete', $company->company_id) }}',
                        data: {company_requirement_id: data.company_requirement_id, path: data.path},
                        type: 'post',
                        beforeSend: function () {
                            KTApp.blockPage({
                                overlayColor: '#000000',
                                type: 'v2',
                                state: 'success',
                                message: '{{__("Please wait...")}}'
                            });
                        }
                    }).done(function (response, textStatus, xhr) {
                        if (xhr.status == 200) {
                            KTApp.unblockPage();
                            requirementTable.ajax.reload();
                        }
                    });

                });
            }
        });
    }


    function upload() {

        var formData = new FormData();
        files.forEach(function (v, i) {
            formData.append('files[]', v.file);
        });

        // formData.append('issued_date', $('#upload-date-start').val());
        // formData.append('expired_date', $('#upload-date-end').val());
        formData.append('requirement_id', $('select[name=requirement_id]').val());
        formData.append('requirement_name', name);

        $.ajax({
            url: '{{ route('company.upload', $company->company_id) }}',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: '{{__("Please wait...")}}'
                });
            },
        }).done(function (response, textStatus, xhr) {

            if (xhr.status == 200) {
                $('#upload-row').find('input').val('');
                $('#upload-row').find('input').removeClass('is-valid');
                $('#upload-row').find('select[name=requirement_id]').removeClass('is-valid');
                $('#upload-row').find('select[name=requirement_id]')[0].selectedIndex = 0;
                requirementTable.ajax.reload();
                KTApp.unblockPage();
                files = [];
                $('#upload-date-start').val(' ');
                $('#upload-date-end').val('');
            }
        });
    }

    function readUrl(input) {

        if (input.files.length > 0) {
            $.each(input.files, function (i, v) {
                var reader = new FileReader();
                reader.readAsDataURL(v);
                files.push({file: v});
                reader.onload = function (e) {
                    files.push(e.target.result);
                };
            });
        }

    }


    function type() {
        $('select[name=company_type_id]').change(function () {
            //if establishment type is corporate
            if ($(this).val() == 2) {
                $('#trade-license-container').removeClass('kt-hide').find('input').removeAttr('disabled', true).attr('required', true);

            } else {
                $('#trade-license-container').addClass('kt-hide').find('input').attr('disabled', true).removeAttr('required', true);
            }
        });
    }


    function requirement() {
        $('select[name=requirement_id]').change(function () {
            if ($(this).find('option:selected').data('date') != 1) {
                $('.date-required').find('input').attr('disabled', true);
                $('.date-required').find('span').addClass('kt-hide');
            } else {
                $('.date-required').find('input').removeAttr('disabled', true);
                $('.date-required').find('span').removeClass('kt-hide');
            }
            name = $(this).find('option:selected').data('name');
        });

        $('select[name=requirement_id]').html('');
        $('select[name=requirement_id]').append('<option selected disabled>{!! __('Select Requirement') !!}</option>');
        $.ajax({
            url: '{{ route('company.requirement') }}',
            dataType: 'json',
        }).done(function (response) {
            if (response) {
                $.each(response, function (i, v) {

                    var languageId = "{{Auth()->user()->LanguageId}}";
                    var requirementName = languageId == 1 ? v.requirement_name : v.requirement_name_ar;

                    $('select[name=requirement_id]').append(`<option data-name="${requirementName}" data-date="${v.dates_required}" value="${v.requirement_id}">${requirementName}</option>`);


                });
                //$('select[name=requirement_id]').append('<option value="other upload" >Other</option>');
            }
        });
    }


    $('#userdetails_form').validate({
        rules: {
            acccount_name_en: 'required',
            account_username: {
                required: true,
                minlength: 5,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: {
                        username: function () {
                            return $('#account_username').val();
                        }
                    }
                }
            },
            account_email: {
                required: true,
                email: true,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: {
                        email: function () {
                            return $('#account_email').val();
                        }
                    }
                }
            },
            account_mobile: {
                required: true,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: {
                        mobile_number: function () {
                            return $('#account_mobile').val();
                        }
                    },
                }
            }
        },
        messages: {
            acccount_name_en: 'Please fill in the name',
            account_username: {
                required: 'Please fill in the username',
                minlength: 'Minimum 5 characters required',
                remote: 'This Username already exists'
            },
            account_email: {
                required: 'Please fill in the Email',
                email: 'Please Enter a valid Email',
                remote: 'This Email already exists'
            },
            account_mobile: {
                required: 'Please fill in the mobile',
                remote: 'This Mobile Number already exists'
            }
        }
    });


    $('#passwordChangeform').validate({
        rules: {
            old_password: {
                required: true,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: {
                        old_password: function () {
                            return $('#old_password').val();
                        }
                    },
                    delay: 1000
                }
            },
            new_password: {
                required: true,
                minlength: 8,
                notEqual: "#account_username",
                pwcheck: true,
            },
            confirm_password: {
                required: true,
                equalTo: "#new_password"
            }
        },
        messages: {
            old_password: {
                required: 'Please fill in the old password',
                remote: 'Password is wrong'
            },
            new_password: {
                required: 'Please fill in the new password',
                minlength: 'Minimum 8 characters required',
                pwcheck: 'At Least one lowercase letter and one digit'
            },
            confirm_password: {
                required: 'Please fill in the confirm password',
                equalTo: 'New password and confirm password should be same',
            }
        }
    })

    $.validator.addMethod("pwcheck", function (value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
    });

    $.validator.addMethod("notEqual", function (value, element, param) {
        return this.optional(element) || value != param;
    }, "Should not be the same as username");

    $.validator.addMethod("greaterThan", function(value, element, params) {

        if (!/Invalid|NaN/.test(new Date(value))) {
            return new Date(value) > new Date($(params).val());
        }

        return isNaN(value) && isNaN($(params).val())
            || (Number(value) > Number($(params).val()));
    },'Expiry date must be greater than today.');

    function datePicker() {
        var arrows;
        if (KTUtil.isRTL()) {
            arrows = {
                leftArrow: '<i class="la la-angle-right"></i>',
                rightArrow: '<i class="la la-angle-left"></i>'
            }
        } else {
            arrows = {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        }

        var date = new Date();
        date.setDate(date.getDate() + 1);

        $('.date-picker.end').datepicker({
            rtl: KTUtil.isRTL(),
            autoclose: true,
            todayHighlight: true,
            orientation: "bottom left",
            startDate: date,
            templates: arrows,
            format: 'dd-mm-yyyy',
        });

        $('.date-picker.start').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom left",
            endDate: '+0d',
            templates: arrows,
            format: 'dd-mm-yyyy',
        });
    }
</script>
@endsection