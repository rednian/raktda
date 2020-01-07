@extends('layouts.app')
@section('style')
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/jquery.filer/css/jquery.filer.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/custom/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css') }}">
 <style>
   .jFiler-items-default .jFiler-item {
    padding: 8px;
    margin-bottom: 5px;
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
            <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#company-edit" role="tab" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"></path>
                                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>{{ __('Establishment Information') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#user-profile" role="tab" aria-selected="false">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
                            </g>
                        </svg>{{__('Account Information')}}
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="kt-portlet__body kt-padding-t-15">
            <div class="tab-content">
                <div class="tab-pane active" id="company-edit" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                      @if ($company->status == 'draft')
                        <div class="alert alert-outline-danger alert-elevate fade show" role="alert">
                          <div class="alert-icon"><i class="flaticon-warning"></i></div>
                          <div class="alert-text">
                            <ul>
                              <li>{{__('Please complete the required fields below to register your company and enjoy the full services of RAKTDA. ')}}</li>
                            {{--   @if (!$valid)
                                <li>{{__('Please upload the required documents.')}}</li>
                              @endif --}}
                            </ul>
                          </div>
                          <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                          </div>
                        </div>
                      @endif
                      
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                  
                                  @if ($company->status == 'back' || $company->status == 'rejected' )
                                    <div class="alert alert-outline-danger kt-padding-t-5 kt-padding-b-5" role="alert">
                                        <div class="alert-text">
                                           @if ($company->status == 'back')
                                        <h6 class="alert-heading">{{__('Please check the comment below and update the information needed.')}}</h6>
                                           @endif
                                          
                                       
                                          @if ($company->status == 'rejected')
                                        <h4 class="alert-heading">{{__('Sorry your application was rejected.')}}</h4>
                                             <span>Your application was rejected and can no longer proceed. Please contact RAKTDA.</span>
                                           @endif 

                                          </p>
                                          <hr class="kt-margin-b-0">
                                          <p class="kt-margin-b-5">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->comment()->latest()->first()->comment_en :  $company->comment()->latest()->first()->comment_ar )}}</p>
                                        </div>
                                      </div>
                                  @endif
                                  @if ($company->status == 'active' && $company->event()->count() < 0 || $company->permit()->count() < 0)
                                    <div class="alert alert-success" role="alert">
                                       <div class="alert-text">
                                         <h4 class="alert-heading">Congratulation your establishment is registered successfully!</h4>
                                         <p>You can now apply an <a href="{{ route('event.create') }}" class="btn btn-sm btn--maroon">EVENT PERMIT</a> or  <a href="{{ route('artist.create') }}" class="btn btn-sm btn--maroon">ARTIST PERMIT</a> and enjoy the full services of RAKTDA.</p>
                                         {{-- <hr> --}}
                                         {{-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> --}}
                                       </div>
                                     </div> 
                                  @endif

                                  @if ($company->status == 'new' || $company->status == 'pending')
                                    <div class="alert alert-success kt-padding-b-5" role="alert">
                                       <div class="alert-text">
                                         <h4 class="alert-heading">Registration successfully submitted!</h4>
                                         <p>Your registration will be check by RAKTDA and notify you as soon as possible.</p>
                                         {{-- <hr> --}}
                                         {{-- <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p> --}}
                                       </div>
                                     </div>
                                    @else
                                    <form name="edit_company" action="{{ route('company.update', $company->company_id) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                       {{-- @method('PUT') --}}
                                        @csrf
                                       <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                           <div class="card border">
                                               <div class="card-header" id="headingOne6">
                                                   <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                                       <h6 class="kt-font-dark ">ESTABLISHMENT DETAILS</h6>
                                                   </div>
                                               </div>
                                               <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
                                                   <div class="card-body">
                                                       {{-- <section required class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label >Establistment Type <span class="text-danger">*</span></label>
                                                               @if ($company->status == 'active' || $company->status == 'blocked')
                                                               <input value="{{Auth::user()->LanguageId == 1 ?   ucfirst($company->type->name_en) : $company->type->name_ar}}" type="text" class="form-control form-control-sm" autocomplete="off" disabled>
                                                                 @else
                                                                 <select name="company_type_id" class="form-control form-control-sm">
                                                                     @if (App\CompanyType::orderBy('name_en')->count() > 0)
                                                                         @foreach (App\CompanyType::orderBy('name_en')->get() as $type)
                                                                             <option {{$company->company_type_id == $type->company_type_id ? 'selected': null }} value="{{$type->company_type_id}}">{{ucfirst($type->name_en)}}</option>
                                                                         @endforeach
                                                                     @endif
                                                                 </select>
                                                               @endif
                                                               
                                                           </div>
                                                       </section> --}}
                                                       <section class="row form-group form-group-sm">
                                                        @php
                                                          if ($company->status == 'active' || $company->status == 'blocked') {
                                                            $disabled = 'disabled';
                                                          }
                                                          else{
                                                            $disabled = null;
                                                          }
                                                        @endphp
                                                           <div class="col-md-6">
                                                               <label >Establishment Name <span class="text-danger">*</span></label>
                                                                <input name="company_type_id" type="hidden" value="{{App\CompanyType::where('name_en', 'corporate')->first()->company_type_id}}">
                                                               <input {{$disabled}}  name="name_en" required autocomplete="off"  class="form-control form-control-sm" type="text" value="{{$company->name_en}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label >Establishment Name (AR)<span class="text-danger">*</span></label>
                                                               <input {{$disabled}} dir="rtl" name="name_ar" required autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->name_ar}}">
                                                           </div>
                                                       </section>
                                                       <section id="trade-license-container" class="row form-group form-group-sm license {{ $company->company_type_id == 1 ? 'kt-hide': null }}">
                                                           <div class="col-md-6">
                                                               <label >Trade License Number <span class="text-danger">*</span></label>
                                                               <input name="trade_license"  autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->trade_license}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="row form-group form-group-sm">
                                                                   <div class="col-sm-6">
                                                                       <label >Trade License Issued Date<span class="text-danger">*</span></label>
                                                                       <input required name="trade_license_issued_date"  autocomplete="off" class="date-picker start form-control form-control-sm" type="text" value="{{$company->trade_license_issued_date ? $company->trade_license_issued_date->format('d-m-Y') :  null }}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label >Trade License Expired Date<span class="text-danger">*</span></label>
                                                                      <input required name="trade_license_expired_date"  autocomplete="off" class="date-picker end form-control form-control-sm" type="text" value="{{$company->trade_license_expired_date ? $company->trade_license_expired_date->format('d-m-Y') :  null }}"> 
                                                                   </div>
                                                               </div>
                                                              
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                           <label >{{__('Establishment Email')}}<span class="text-danger">*</span></label>
                                                               <input required name="company_email" required autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->company_email}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="row form-group form-group-sm">
                                                                   <div class="col-sm-6">
                                                                       <label >Phone Number<span class="text-danger">*</span></label>
                                                                       <input required name="phone_number" required autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->phone_number}}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label >Website</label>
                                                                      <input name="website" autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->website}}"> 
                                                                   </div>
                                                               </div>
                                                              
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <div class="row form-group form-group-sm">
                                                                   <div class="col-sm-6">
                                                                       <label >Address<span class="text-danger">*</span></label>
                                                                       <input name="address" required autocomplete="off"  class="form-control" type="text" value="{{$company->address}}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label >Country <span class="text-danger">*</span></label>
                                                                      <select required name="country_id" class="form-control form-control-sm select2">
                                                                          @if (App\Country::orderBy('name_en')->count() > 0)
                                                                              @foreach (App\Country::orderBy('name_en')->get() as $country)
                                                                              <option  {{ $country->country_id == $company->country_id ? 'selected': null }} value="{{$country->country_id}}">{{ucfirst($country->name_en)}}</option>
                                                                              @endforeach
                                                                          @endif
                                                                      </select>
                                                                   </div>
                                                               </div>
                                                              
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="row form-group form-group-sm">
                                                                   <div class="col-sm-6">
                                                                       <label >Emirate<span class="text-danger">*</span></label>
                                                                       <select required name="emirate_id"  class="select2 form-control form-control-sm">
                                                                          @if (App\Emirates::orderBy('name_en')->count() > 0)
                                                                              @foreach (App\Emirates::orderBy('name_en')->get() as $emirate)
                                                                              <option {{ $emirate->id == $company->emirate_id ? 'selected': null }} value="{{$emirate->id}}">{{ucfirst($emirate->name_en)}}</option>
                                                                              @endforeach
                                                                          @endif
                                                                       </select>
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label>Area<span class="text-danger">*</span></label>
                                                                      <select required name="area_id" class="select2 form-control form-control-sm">
                                                                          @if (App\Areas::where('emirates_id', 5)->orderBy('area_en')->count() > 0)
                                                                              @foreach (App\Areas::where('emirates_id', 5)->orderBy('area_en')->get() as $area)
                                                                              <option {{ $area->id == $company->area_id ? 'selected': null }}  value="{{$area->id}}">{{ucfirst($area->area_en)}}</option>
                                                                              @endforeach
                                                                          @endif
                                                                      </select>
                                                                   </div>
                                                               </div>
                                                              
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>Establishment Details<span class="text-danger">*</span></label>
                                                               <textarea required rows="4" autocomplete="off" required class="form-control form-control-sm" name="company_description_en">{{$company->company_description_en}}</textarea>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label >Establishment Details (AR)<span class="text-danger">*</span></label>
                                                               <textarea required dir="rtl" rows="4" autocomplete="off" required class="form-control form-control-sm" name="company_description_ar">{{$company->company_description_ar}}</textarea>
                                                           </div>
                                                       </section>
                                                       
                                                   </div>
                                               </div>
                                           </div>        
                                       </div>
                                       <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-10" id="accordion-contact">
                                           <div class="card border">
                                               <div class="card-header" id="heading-contact">
                                                   <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-contact" aria-expanded="true" aria-controls="collapse-contact">
                                                       <h6 class="kt-font-dark ">{{__('CONTACT PERSON DETAILS')}}</h6>
                                                   </div>
                                               </div>
                                               <div id="collapse-contact" class="collapse show" aria-labelledby="heading-contact" data-parent="#accordion-contact" style="">
                                                   <div class="card-body">
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Name')}} <span class="text-danger">*</span></label>
                                                               <input autocomplete="off" required name="contact_name_en" class="form-control form-control-sm" type="text" value="{{$company->contact->contact_name_en}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label >{{__('Name (AR)')}}<span class="text-danger">*</span></label>
                                                               <input required dir="rtl" name="contact_name_ar" autocomplete="off" required class="form-control form-control-sm" type="text" value="{{$company->contact->contact_name_ar}}">
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Designation')}} <span class="text-danger">*</span></label>
                                                               <input autocomplete="off" required name="designation_en" class="form-control form-control-sm" type="text" value="{{$company->contact->designation_en}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label>{{__('Designation (AR)')}} <span class="text-danger">*</span></label>
                                                               <input required dir="rtl" name="designation_ar" autocomplete="off" required class="form-control form-control-sm" type="text" value="{{$company->contact->designation_en}}">
                                                           </div>
                                                       </section>
                                                       
                                                       
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Email Address')}} <span class="text-danger">*</span></label>
                                                               <input required autocomplete="off" name="email" class="form-control form-control-sm" type="email" value="{{$company->contact->email}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label>{{__('Mobile Number')}} <span class="text-danger">*</span></label>
                                                               <input required autocomplete="off" name="mobile_number" class="form-control form-control-sm" type="text" value="{{$company->contact->mobile_number}}">
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Emirates ID')}} <span class="text-danger">*</span></label>
                                                               <input required autocomplete="off" name="emirate_identification" class="form-control form-control-sm" type="text" value="{{$company->contact->emirate_identification}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group row">
                                                                   <div class="col-sm-6">
                                                                       <label>{{__('Emirates ID Issued Date')}} <span class="text-danger">*</span></label>
                                                                       <input required autocomplete="off" autocomplete="off" name="emirate_id_issued_date" class="date-picker start form-control form-control-sm" type="text" value="{{$company->contact->emirate_id_issued_date ? $company->contact->emirate_id_issued_date->format('d-m-Y') : null }}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                    <input type="hidden" name="reference_number" value="123456789">
                                                                       <label>{{__('Emirates ID EXpired Date')}} <span class="text-danger">*</span></label>
                                                                       <input required  autocomplete="off" name="emirate_id_expired_date" class="date-picker end form-control form-control-sm" type="text" value="{{$company->contact->emirate_id_expired_date ? $company->contact->emirate_id_expired_date->format('d-m-Y') :  null }}">
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
                                                   <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-requirement" aria-expanded="true" aria-controls="collapse-requirement">
                                                       <h6 class="kt-font-dark "><span class="kt-font-transform-u">{{__('Document Requirements')}}</span> 
                                                        {{-- <small>Please upload the required documents.</small> --}}
                                                      </h6>
                                                   </div>
                                               </div>
                                               <div id="collapse-requirement" class="collapse show" aria-labelledby="heading-requirement" data-parent="#accordion-requirement">
                                                   <div class="card-body">
                                                    <div class="alert alert-outline-primary fade kt-margin-b-20 show kt-padding-t-0 kt-padding-b-0" role="alert">
                                                      <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
                                                      <div class="alert-text kt-font-dark">
                                                        <span class="kt-font-danger kt-font-bold">Note:</span>
                                                        <ul>
                                                          <li class="kt-font-danger">{{__('Uploaded files will be deleted if not submitted or saved as draft.')}}</li>
                                                          <li>{{__('The maximum file size for uploads is 5MB.')}}</li>
                                                          <li>{{__('File Upload (JPG, PNG & PDF) only allowed.')}}</li>
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
                                                        <label>{{__('Requirement Name')}} <span class="text-danger">*</span></label>
                                                        <select name="requirement_id" class=" form-control"></select>
                                                      </div>
                                                      <div class="col-md-4">
                                                        <label>{{__('Upload Requirement')}} <span class="text-danger">*</span></label>
                                                        <input  id="file" onchange="readUrl(this);" type="file" multiple class="form-control">
                                                      </div>
                                                      <div class="col-md-2 date-required">
                                                        <label>{{__('Issued Date')}} <span class="text-danger">*</span></label>
                                                        <input autocomplete="off" id="upload-date-start"  name="issued_date" type="text" multiple class="form-control date-picker start">
                                                      </div>
                                                      <div class="col-md-2 date-required">
                                                        <label>{{__('Expiry Date')}} <span class="text-danger">*</span></label>
                                                        <input id="upload-date-end"  name="expired_date" type="text" multiple class="form-control date-picker end">
                                                      </div>
                                                      <div class="col-md-1 kt-margin-l-0 kt-margin-r-0 kt-padding-0">
                                                        <label> </label>
                                                        <button autocomplete="off" type="button" id="btn-save" class="kt-margin-t-5 btn btn-warning kt-font-transform-u">{{__('Upload')}}</button>
                                                      </div>
                                                    </section>

                                                    <table class="table table-borderless border" id="upload-requirement-table">
                                                      <thead>
                                                        <tr>
                                                          <th>{{__('REQUIREMENT NAME')}}</th>
                                                          <th>{{__('FILE')}}</th>
                                                          <th>{{__('ISSUED DATE')}}</th>
                                                          <th>{{__('EXPIRED DATE')}}</th>
                                                          <th>{{__('ACTION')}}</th>
                                                        </tr>
                                                      </thead>
                                                    </table>
  
                                                   </div>
                                                   
                                               </div>
                                               
                                           </div>        
                                       </div>
                                       <div class="form-group row kt-margin-t-10">

                                        
                                        
                                          <div class="col-sm-12">
                                            @if ($company->status == 'draft')
                                               <button style="padding: 0.5rem 1rem;" type="submit" name="submit" value="draft" class="btn btn-secondary btn-sm kt-font-transform-u kt-font-dark">Save as Draft</button>
                                            @endif
                                               <button {{$company->status == 'rejected' ? 'disabled' : null}} type="submit" name="submit" value="submitted" class="btn btn--maroon btn-sm kt-font-transform-u">{{ $company->application ? 'Update Application' : 'Submit Application'}}</button>
                                           </div>
                                           
                                       </div>
                                    </form>
                                  @endif

                             
                                 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="user-profile" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body col-sm-12 col-md-10">
                            <div class="kt-section kt-section--first">
                            <form action="{{route('company.updateUser', $company->company_id )}}" id="userdetails_form" method="POST" novalidate>
                                @csrf
                                <div class="kt-section__body mt-5">
                                    {{-- <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Account:</h3>
                                        </div>
                                    </div> --}}
                                    @php
                                        $user = Auth::user();
                                    @endphp
                                    <div class="form-group  row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Name')}}</label>
                                       <div class="row col-lg-9 col-xl-6 m-auto">
                                        <input type="text" class="col-xl-5 col-lg-5 form-control form-control-sm" name="acccount_name_en" id="acccount_name_en" value="{{$user->NameEn}}" />
                                       <label class="col-xl-2 col-lg-2 col-form-label">{{__('Name (AR)')}}</label>
                                        <input type="text" class="col-xl-5 col-lg-5 form-control form-control-sm" name="acccount_name_ar" id="acccount_name_ar" dir="rtl" value="{{$user->NameAr}}" />
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Username')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <input class="form-control form-control-sm" id="account_username"   name="account_username" type="text"  value="{{$user->username}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Email Address')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" name="account_email" id="account_email" value="{{$user->email}}" placeholder="Email" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                    <label class="col-xl-3 col-lg-3 col-form-label">{{__('Mobile Number')}}</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-mobile"></i></span></div>
                                                <input type="text" class="form-control form-control-sm" value="{{$user->mobile_number}}" name="account_mobile" id="account_mobile" placeholder="Mobile Number">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    {{-- <div class="form-group form-group-last row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-inline">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked=""> Email
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" checked=""> SMS
                                                    <span></span>
                                                </label>
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Phone
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                 
                                    <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                        <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                        <div class="col-lg-9 col-xl-6">
                                        <button type="button" data-target="#changePasswordModal" data-toggle="modal" class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">{{__('Change your Password ?')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                            <button class="btn btn-sm btn--yellow pull-right">{{__('Save Changes')}}</button>
                            </div>
                        </form>
                </div>


                
            </div>
            
    </div>
</div>


{{-- change password modal --}}

<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Change Password')}} ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body container">
            <form action="{{route('company.changePassword', $company->company_id )}}" id="passwordChangeform" method="POST" novalidate>
                @csrf
                <div class="row kt-margin-b-2" >
                    <label for="" class="col-md-4 col-form-label">{{__('Old Password')}}</label>
                    <div class="form-group form-group-sm col-md-6">
                        <input type="text" class="form-control form-control-sm " id="old_password" name="old_password" >
                    </div>
                </div>
                <div class="row kt-margin-b-2" >
                    <label for="" class="col-md-4 col-form-label">{{__('New Password')}}</label>
                    <div class="form-group form-group-sm col-md-6">
                        <input type="text" class="form-control form-control-sm" id="new_password" name="new_password" >
                    </div>
                </div>
                <div class="row kt-margin-b-2" >
                    <label for="" class="col-md-4 col-form-label">{{__('Confirm Password')}}</label>
                    <div class="form-group form-group-sm col-md-6">
                    <input type="text" class="form-control form-control-sm" id="confirm_password" name="confirm_password" >
                    </div>
                </div>
            <input type="submit" value="{{__('Change')}}" onclick="changePassword()"
                    class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
            </div>
        </form>
        </div>
    </div>
</div>


{{-- change password modal --}}


@endsection
@section('script')
<script src="{{ asset('assets/vendors/custom/jquery.filer/js/jquery.filer.js') }}"></script>
<script>
  window.files = [];
  var filenames = [];
  var name = null;
  var requirementTable = {};
  var is_valid = false;

    $(document).ready(function(){
      requirement();
      datePicker();
      type();
      uploaded();
      hasUrl();

      // $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      //   var current_tab = $(e.target).attr('href');

      //   if('#new-request' == current_tab ){  newCompany(); }
      //   if('#processing-request' == current_tab ){ processing();   }
      //   if('#active-company' == current_tab ){  company(); }
      // });




      $('form[name=edit_company]').validate({
        invalidHandler: function(){
          KTUtil.scrollTop();
        },
      });




      $('.select2').select2();

      $('#btn-save').click(function(){
        var name = $('#upload-row').find('select').val();
        var file = document.getElementById('file').files;

        if(file.length == 0 ){
          $('#upload-row').find('#file').addClass('is-invalid');
          is_valid = false;
        }
        else{
          $('#upload-row').find('input#file').removeClass('is-invalid');
           is_valid = true;
        }

        if(name == null){
          $('#upload-row').find('select').addClass('is-invalid');
           is_valid = false;
        }
        else{
          $('#upload-row').find('select').addClass('is-valid');
           is_valid = true;
        }

        if(is_valid){
          $(this).removeAttr('disabled', true);
          upload();
        }
        else{
          $(this).attr('disabled', true);
        }

        
      });



      $('#upload-row').find('select').change(function(){
        var attr = $('#upload-row').find('input.date-picker');
          if(typeof attr !== typeof undefined && attr !== false ){
            attr.val(' ');
          }

        if($(this).val() && $('input[type=file]').prop('files') > 0){
          $('#upload-row').find('button#btn-save').removeAttr('disabled', true);
          $(this).removeClass('is-invalid').addClass('is-valid');
          $('inputfile]#file').val(' ');
          // files = [];
        }
        else{
         $('#upload-row').find('button#btn-save').attr('disabled', true);
          $(this).addClass('is-valid'); 
        }
      });

      $('#upload-row').find('input#file').change(function(){
        if ($(this).prop('files') > 0 && $('#upload-row').find('select').val() == null) {
          $('#upload-row').find('button#btn-save').attr('disabled', true);
           $(this).addClass('is-valid'); 
        }
        else{
          $('#upload-row').find('button#btn-save').removeAttr('disabled', true);
          $(this).removeClass('is-invalid').addClass('is-valid');
        }
      });


    });


    function hasUrl(){
      var hash = window.location.hash;
      hash && $('ul.nav a[href="' + hash + '"]').tab('show');
      $('.nav-tabs a').click(function (e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
      });
    }

    

    function uploaded(){
      requirementTable = $('#upload-requirement-table').DataTable({
        dom: "<'row d-none'<'col-sm-12 col-md-6 '><'col-sm-12 col-md-6'>>" +
              "<'row'<'col-sm-12'tr>>" +
              "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        ajax: '{{ route('company.requirement.datatable', $company->company_id) }}',
        // columnDefs:[{targets: [4], className:'no-wrap'}],
        "order": [[ 0, 'asc' ]],
          rowGroup: {
            startRender: function ( rows, group ) { 
             var row_data = rows.data()[0];
             return $('<tr/>').append( '<td >'+group+'</td>' )
                        .append( '<td>'+rows.count()+'</td>' )
                        .append( '<td>'+row_data.issued_date+'</td>' )
                        .append( '<td>'+row_data.expired_date+'</td>' )
                        .append( '<td></td>' )
                        // .append( '<td>'+row_data.action+'</td>' )
                        .append( '<tr/>' );
              },
           dataSrc: 'name'
        },
        columns:[
        // {data: 'name'},
        {data: 'file'},
        {render: function(data){ return null}},
        {render: function(data){ return null}},
        {render: function(data){ return null}},
        {data: 'action'},
        ],
        createdRow: function(row, data, index){
          $('.btn-remove',row).click(function(){
            $.ajax({
              url: '{{ route('company.requirement.delete', $company->company_id) }}',
              data: {company_requirement_id : data.company_requirement_id, path: data.path},
              type: 'post',
              beforeSend: function(){
                KTApp.blockPage({
                    overlayColor: '#000000',
                    type: 'v2',
                    state: 'success',
                    message: 'Please wait...'
                });
              }
            }).done(function(response, textStatus, xhr){
              if(xhr.status == 200){ 
                 KTApp.unblockPage();
                requirementTable.ajax.reload();
              }
            });

          });
        }
      });
    }


    function upload(){

      var formData = new FormData();
      files.forEach(function(v, i){
       formData.append('files[]', v.file);
      });

      formData.append('issued_date', $('#upload-date-start').val());
      formData.append('expired_date', $('#upload-date-end').val());
      formData.append('requirement_id', $('select[name=requirement_id]').val());
      formData.append('requirement_name', name);

      $.ajax({
           url: '{{ route('company.upload', $company->company_id) }}',
           type: 'POST',
           data: formData,
           cache: false,
           processData:false,
           contentType: false,
           beforeSend: function(){
            KTApp.blockPage({
                overlayColor: '#000000',
                type: 'v2',
                state: 'success',
                message: 'Please wait...'
            });
           },
         }).done(function(response, textStatus, xhr){

             if(xhr.status == 200){ 
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

      if(input.files.length > 0){
         $.each(input.files, function(i, v){
          var reader = new FileReader();
          reader.readAsDataURL(v);
          files.push({ file: v});
          reader.onload = function(e){
            files.push(e.target.result);
          };
         });
      }

    }


    function type(){
      $('select[name=company_type_id]').change(function(){
        //if establishment type is corporate
        if($(this).val() == 2){
          $('#trade-license-container').removeClass('kt-hide').find('input').removeAttr('disabled', true).attr('required', true);

        }
        else{
         $('#trade-license-container').addClass('kt-hide').find('input').attr('disabled', true).removeAttr('required', true); 
        }
      });
    }


    function requirement(){
      $('select[name=requirement_id]').change(function(){
        if($(this).find('option:selected').data('date') != 1){
          $('.date-required').find('input').attr('disabled', true);
          $('.date-required').find('span').addClass('kt-hide');
        }
        else{
           $('.date-required').find('input').removeAttr('disabled', true);
           $('.date-required').find('span').removeClass('kt-hide');
        }
        name = $(this).find('option:selected').data('name');
      });

      $('select[name=requirement_id]').html('');
      $('select[name=requirement_id]').append('<option selected disabled>Select Requirement</option>');
      $.ajax({
        url: '{{ route('company.requirement') }}',
        dataType: 'json',
      }).done(function(response){
        if(response){
          $.each(response, function(i, v){
            $('select[name=requirement_id]').append('<option data-name="'+v.requirement_name+'" data-date="'+v.dates_required+'" value="'+v.requirement_id+'">'+v.requirement_name+'</option>');
          });
          $('select[name=requirement_id]').append('<option value="other upload" >Other</option>');
        }
      });
    }


   $('#userdetails_form').validate({
        rules:{
            acccount_name_en: 'required',
            account_username: {
                required: true,
                minlength: 5,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: { username: function(){
                        return $('#account_username').val();
                    }}
                }
            },
            account_email: {
                required: true,
                email: true,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: {email: function(){
                        return $('#account_email').val();
                    }}
                }
            },
            account_mobile: {
                required: true,
                remote: {
                    url: '{{route('company.account_exists')}}',
                    type: 'post',
                    data: {mobile_number: function(){
                        return $('#account_mobile').val();
                    }},
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
                    data: {old_password: function(){
                        return $('#old_password').val();
                    }},
                    delay: 1000
                }
            },
            new_password: {
                required: true,
                minlength: 8 ,
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

    $.validator.addMethod("pwcheck", function(value) {
        return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
            && /[a-z]/.test(value) // has a lowercase letter
            && /\d/.test(value) // has a digit
    });

    $.validator.addMethod("notEqual", function(value, element, param) {
        return this.optional(element) || value != param;
        }, "Should not be the same as username");

    function datePicker(){
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
        date.setDate(date.getDate()-1);

      $('.date-picker.end').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
             startDate: date,
            templates: arrows,
            format:'dd-mm-yyyy'
        });

       $('.date-picker.start').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            endDate: '+0d',
            templates: arrows,
            format:'dd-mm-yyyy'
        });
    }
</script>
@endsection
