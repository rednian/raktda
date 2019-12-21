@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendors/custom/fileupload/css/fileinput.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/vendors/custom/fileupload//themes/explorer-fas/theme.css') }}">
<style>
    
</style>
@stop
@section('content')
<div class="kt-portlet kt-portlet--tabs">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#kt_user_edit_tab_1" role="tab" aria-selected="false">
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
                    <a class="nav-link" data-toggle="tab" href="#kt_user_edit_tab_2" role="tab" aria-selected="false">
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
                <div class="tab-pane active" id="kt_user_edit_tab_1" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                      @if ($company->status == 'draft')
                        <div class="alert alert-warning alert-elevate fade show" role="alert">
                          <div class="alert-icon"><i class="flaticon-warning"></i></div>
                          <div class="alert-text">{{__('Please complete the required fields below to register your company and enjoy the full services of RAKTDA. ')}}</div>
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
                                    <form name="edit_company" action="{{ route('company.update', $company->company_id) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                       {{-- @method('PUT') --}}
                                        @csrf
                                       <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                                           <div class="card">
                                               <div class="card-header" id="headingOne6">
                                                   <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="true" aria-controls="collapseOne6">
                                                       <h6 class="kt-font-dark ">ESTABLISHMENT DETAILS</h6>
                                                   </div>
                                               </div>
                                               <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
                                                   <div class="card-body">
                                                       <section required class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label >Establistment Type <span class="text-danger">*</span></label>
                                                               <select name="company_type_id" class="form-control form-control-sm">
                                                                   @if (App\CompanyType::orderBy('name_en')->count() > 0)
                                                                       @foreach (App\CompanyType::orderBy('name_en')->get() as $type)
                                                                           <option {{$company->company_type_id == $type->company_type_id ? 'selected': null }} value="{{$type->company_type_id}}">{{ucfirst($type->name_en)}}</option>
                                                                       @endforeach
                                                                   @endif
                                                               </select>
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label >Establishment Name <span class="text-danger">*</span></label>
                                                               <input name="name_en" required autocomplete="off"  class="form-control form-control-sm" type="text" value="{{$company->name_en}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label >Establishment Name (AR)<span class="text-danger">*</span></label>
                                                               <input dir="rtl" name="name_ar" required autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->name_ar}}">
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
                                                                       <input name="trade_license_issued_date"  autocomplete="off" class="date-picker start form-control form-control-sm" type="text" value="{{$company->trade_license_issued_date ? $company->trade_license_issued_date->format('d-F-Y') :  null }}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label >Trade License Expired Date<span class="text-danger">*</span></label>
                                                                      <input name="trade_license_expired_date"  autocomplete="off" class="date-picker end form-control form-control-sm" type="text" value="{{$company->trade_license_expired_date ? $company->trade_license_expired_date->format('d-F-Y') :  null }}"> 
                                                                   </div>
                                                               </div>
                                                              
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label >Establishment Email <span class="text-danger">*</span></label>
                                                               <input name="company_email" required autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->company_email}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="row form-group form-group-sm">
                                                                   <div class="col-sm-6">
                                                                       <label >Phone Number<span class="text-danger">*</span></label>
                                                                       <input name="phone_number" required autocomplete="off" class="form-control form-control-sm" type="text" value="{{$company->phone_number}}">
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
                                                                       <input name="address" required autocomplete="off"  class="form-control form-control-sm" type="text" value="{{$company->address}}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label >Country <span class="text-danger">*</span></label>
                                                                      <select name="country_id" class="form-control form-control-sm">
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
                                                                       <select name="emirate_id"  class="form-control form-control-sm">
                                                                          @if (App\Emirates::orderBy('name_en')->count() > 0)
                                                                              @foreach (App\Emirates::orderBy('name_en')->get() as $emirate)
                                                                              <option {{ $emirate->id == $company->emirate_id ? 'selected': null }} value="{{$emirate->id}}">{{ucfirst($emirate->name_en)}}</option>
                                                                              @endforeach
                                                                          @endif
                                                                       </select>
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                      <label>Area<span class="text-danger">*</span></label>
                                                                      <select required name="area_id" class="form-control form-control-sm">
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
                                                               <textarea rows="4" autocomplete="off" required class="form-control form-control-sm" name="company_description_en">{{$company->company_description_en}}</textarea>
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label >Establishment Details (AR)<span class="text-danger">*</span></label>
                                                               <textarea rows="4" autocomplete="off" required class="form-control form-control-sm" name="company_description_ar">{{$company->company_description_ar}}</textarea>
                                                           </div>
                                                       </section>
                                                       
                                                   </div>
                                               </div>
                                           </div>        
                                       </div>
                                       <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-10" id="accordion-contact">
                                           <div class="card">
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
                                                               <input dir="rtl" name="contact_name_ar" autocomplete="off" required class="form-control form-control-sm" type="text" value="{{$company->contact->contact_name_ar}}">
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Designation')}} <span class="text-danger">*</span></label>
                                                               <input autocomplete="off" required name="designation_en" class="form-control form-control-sm" type="text" value="{{$company->contact->designation_en}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label>{{__('Designation (AR)')}} <span class="text-danger">*</span></label>
                                                               <input dir="rtl" name="designation_ar" autocomplete="off" required class="form-control form-control-sm" type="text" value="{{$company->contact->designation_en}}">
                                                           </div>
                                                       </section>
                                                       
                                                       
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Email Address')}} <span class="text-danger">*</span></label>
                                                               <input name="email" class="form-control form-control-sm" type="email" value="{{$company->contact->email}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <label>{{__('Mobile Number')}} <span class="text-danger">*</span></label>
                                                               <input name="mobile_number" class="form-control form-control-sm" type="text" value="{{$company->contact->mobile_number}}">
                                                           </div>
                                                       </section>
                                                       <section class="row form-group form-group-sm">
                                                           <div class="col-md-6">
                                                               <label>{{__('Emirates ID')}} <span class="text-danger">*</span></label>
                                                               <input name="emirate_identication" class="form-control form-control-sm" type="text" value="{{$company->contact->emirate_identication}}">
                                                           </div>
                                                           <div class="col-md-6">
                                                               <div class="form-group row">
                                                                   <div class="col-sm-6">
                                                                       <label>{{__('Emirates ID Issued Date')}} <span class="text-danger">*</span></label>
                                                                       <input autocomplete="off" name="emirate_id_issued_date" class="date-picker start form-control form-control-sm" type="text" value="{{$company->contact->emirate_id_issued_date ? $company->contact->emirate_id_issued_date->format('d-F-Y') : null }}">
                                                                   </div>
                                                                   <div class="col-sm-6">
                                                                    <input type="hidden" name="reference_number" value="123456789">
                                                                       <label>{{__('Emirates ID EXpired Date')}} <span class="text-danger">*</span></label>
                                                                       <input autocomplete="off" name="emirate_id_expired_date" class="date-picker end form-control form-control-sm" type="text" value="{{$company->contact->emirate_id_expired_date ? $company->contact->emirate_id_expired_date->format('d-F-Y') :  null }}">
                                                                   </div>
                                                               </div>
                                                           </div>
                                                       </section>
                                                   </div>
                                               </div>
                                           </div>        
                                       </div>
                                       <div class="accordion accordion-solid accordion-toggle-plus kt-margin-t-10" id="accordion-requirement">
                                           <div class="card">
                                               <div class="card-header" id="heading-requirement">
                                                   <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-requirement" aria-expanded="true" aria-controls="collapse-requirement">
                                                       <h6 class="kt-font-dark "><span class="kt-font-transform-u">Requirement</span> <small>Please upload the required documents.</small></h6>
                                                   </div>
                                               </div>
                                               <div id="collapse-requirement" class="collapse show" aria-labelledby="heading-requirement" data-parent="#accordion-requirement" style="font-language-override: ">
                                                   <div class="card-body">
                                                    {{-- <div class="alert alert-secondary kt-padding-t-5 kt-padding-b-5" role="alert">
                                                        <div class="alert-icon"><i class="flaticon-exclamation-2"></i></div>
                                                        <div class="alert-text kt-font-dark">
                                                          <h6 class="alert-heading kt-margin-b-0">Note :</h6>
                                                          <p class="text-danger">
                                                            Uploaded file will be removed if replace with new upload.
                                                          </p>
                                                          <hr class="kt-margin-5">
                                                          <ul>
                                                            <li>maximum file size 5MB</li>
                                                          </ul>
                                                        </div>
                                                      </div> --}}
                                                      <table class="table table-borderless border table-hover" id="requirement-datatable">
                                                        <thead>
                                                          <tr>
                                                            <th>{{__('REQUIREMENT NAME')}}</th>
                                                            <th>{{__('FILE SIZE')}}</th>
                                                            <th>{{__('ISSUED DATE')}}</th>
                                                            <th>{{__('EXPIRED DATE')}}</th>
                                                          </tr>
                                                        </thead>
                                                      </table>
                                                      {{--  @if ($requirements = App\Requirement::where('requirement_type', 'company')->get())
                                                           @foreach ($requirements as $key => $requirement)
                                                             <div class="form-group-sm form-group row">

                                                               <div class="col-sm-6">
                                                                   <label>{{Auth::user()->LanguageId == 1 ? ucfirst($requirement->requirement_name) : $requirement->requirement_name_ar}} <span class="text-danger">*</span></label>
                                                                   <input name="file[{{$requirement->requirement_id}}][name]" value="{{$requirement->requirement_name}}"  type="hidden" readonly>
                                                                   <input onchange="readUrl(this);" name="file[{{$requirement->requirement_id}}][file][]"  type="file" autocomplete="off" class="form-control-sm form-control" multiple>
                                                               </div>

                                                               <div class="col-sm-2">
                                                                   <label>Issued Date <span class="text-danger {{$requirement->dates_required ? null: 'kt-hide'}} ">*</span></label>
                                                                   <input {{$requirement->dates_required ? 'required': 'null'}} type="text" name="file[{{$requirement->requirement_id}}][issued_date]" class="date-picker start form-control-sm form-control" autocomplete="off">
                                                               </div>

                                                               <div class="col-sm-2">
                                                                   <label>Expired Date <span class="text-danger {{$requirement->dates_required ? null: 'kt-hide'}} ">*</span></label>
                                                                   <input {{$requirement->dates_required ? 'required': 'null'}}  type="text" name="file[{{$requirement->requirement_id}}][expired_date]" class="date-picker end form-control-sm form-control" autocomplete="off">
                                                               </div>

                                                             </div>

                                                             <div class="form-group row">
                                                               <div class="col-12">
                                                                 <table>
                                                                   <tr>
                                                                     <td></td>
                                                                     <td><button class="btn btn-danger btn-sm">remove</button></td>
                                                                     <td>
                                                                      @foreach ($requirement->company as $file)
                                                                       <span>{{$file->path}}</span>
                                                                      @endforeach
                                                                     </td>
                                                                   </tr>
                                                                 </table>
                                                               </div>
                                                             </div>
                                                             
                                                           @endforeach
                                                       @endif --}}
                                                       
                                                   </div>
                                                   
                                               </div>
                                               
                                           </div>        
                                       </div>
                                       <div class="form-group row kt-margin-t-10">

                                        
                                        
                                           <div class="col-sm-12">
                                            @if ($company->status == 'draft')
                                               <button style="padding: 0.5rem 1rem;" type="submit" name="submit" value="draft" class="btn btn-secondary btn-sm kt-font-transform-u kt-font-dark">Save as Draft</button>
                                            @endif
                                               <button type="submit" name="submit" value="submitted" class="btn btn--maroon btn-sm kt-font-transform-u">Submit Application</button>
                                           </div>
                                       </div>
                                    </form>
                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="kt_user_edit_tab_2" role="tabpanel">
                    <div class="kt-form kt-form--label-right kt-hide">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Account:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-spinner kt-spinner--sm kt-spinner--success kt-spinner--right kt-spinner--input">
                                                <input class="form-control" type="text" value="nick84">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
                                                <input type="text" class="form-control" value="nick.watson@loop.com" placeholder="Email" aria-describedby="basic-addon1">
                                            </div>
                                            <span class="form-text text-muted">Email will not be publicly displayed. <a href="#" class="kt-link">Learn more</a>.</span>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group form-group-last row">
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
                                    </div>
                                </div>
                            </div>

                            <div class="kt-separator kt-separator--border-dashed kt-separator--portlet-fit kt-separator--space-lg"></div>

                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="row">
                                        <label class="col-xl-3"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <h3 class="kt-section__title kt-section__title-sm">Security:</h3>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Login verification</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <button type="button" class="btn btn-label-brand btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Setup login verification</button>
                                            <span class="form-text text-muted">
                                            After you log in, you will be asked for additional information to confirm your identity and protect your account from being compromised. 
                                            <a href="#" class="kt-link">Learn more</a>.
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Password reset verification</label>
                                        <div class="col-lg-9 col-xl-6">
                                            <div class="kt-checkbox-single">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox"> Require personal information to reset your password.
                                                    <span></span>
                                                </label>
                                            </div>
                                            <span class="form-text text-muted">
                                            For extra security, this requires you to confirm your email or phone number when you reset your password.
                                            <a href="#" class="kt-link">Learn more</a>.
                                        </span>
                                        </div>
                                    </div>
                                    <div class="form-group row kt-margin-t-10 kt-margin-b-10">
                                        <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                        <div class="col-lg-9 col-xl-6">
                                            <button type="button" class="btn btn-label-danger btn-bold btn-sm kt-margin-t-5 kt-margin-b-5">Deactivate your account ?</button>
                                        </div>
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
@section('script')
<script>
  var files = [];
  var filenames = [];

    $(document).ready(function(){

      datePicker();
      requirementDatatable();

   
      $('select[name=company_type_id]').change(function(){
        //if establishment type is corporate
        if($(this).val() == 2){
          $('#trade-license-container').removeClass('kt-hide').find('input').removeAttr('disabled', true).attr('required', true);
        }
        else{
         $('#trade-license-container').addClass('kt-hide').find('input').attr('disabled', true).removeAttr('required', true); 
        }
      });

      $('form[name=edit_company]').validate();




    });


    function requirementDatatable(){
      $('#requirement-datatable').DataTable({
        ajax:{
          url: '{{ route('company.requirement.datatable', $company->company_id) }}'
        }
        ,
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
      // if (input.files && input.files[0]) {

      //   for (var i = 0; i < input.files.length; i++) {
      //     var reader = new FileReader();
      //     reader.readAsDataURL(input.files[i]);

      //     reader.onload = function (e) {
      //       var url = e.target.result

      //       files.push(url);
      //       // showImages();
      //     };
      //   }
      // }
    }


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
            templates: arrows
        });

       $('.date-picker.start').datepicker({
            rtl: KTUtil.isRTL(),
            todayHighlight: true,
            orientation: "bottom left",
            endDate: '+0d',
            templates: arrows
        });
    }
</script>
@endsection
