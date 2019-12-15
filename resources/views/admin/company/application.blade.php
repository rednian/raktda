@extends('layouts.admin.admin-app')
@section('content')
<section class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
   <div class="kt-portlet__head kt-portlet__head--sm">
      <div class="kt-portlet__head-label">
         <h3 class="kt-portlet__head-title kt-font-dark">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}} - Application</h3>
      </div>
      <div class="kt-portlet__head-toolbar">
         <a href="{{ route('admin.company.index') }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
            <i class="la la-arrow-left"></i>
           {{__(' BACK TO Company LIST')}}
         </a>
      </div>
   </div>
   <div class="kt-portlet__body kt-padding-t-5">
       <section class="accordion kt-margin-b-10 accordion-solid accordion-toggle-plus border" id="accordion-detail">
         <div class="card">
            <div class="card-header" id="heading-detail">
               <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-detail" aria-expanded="true" aria-controls="collapse-detail">
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('COMPANY DETAILS') }}</h6>
               </div>
             </div>
             <div id="collapse-detail" class="collapse show" aria-labelledby="heading-detail" data-parent="#accordion-detail">
               <div class="card-body">
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Company Name') }} <span class="text-danger">*</span></label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->name_en) }}" name="event_type" readonly="readonly" type="text"
                                        class="form-control">
                           <div class="input-group-append">
                              <span class="input-group-text">
                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                    <input data-step="step-1" type="checkbox" name="check[]">
                                    <span></span>
                                 </label>
                               </span>
                           </div>
                          </div>
                     </div>
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Company Name (AR)') }} <span class="text-danger">*</span></label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->name_ar) }}" name="event_type" readonly="readonly" type="text"
                                        class="form-control">
                           <div class="input-group-append">
                              <span class="input-group-text">
                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                    <input data-step="step-1" type="checkbox" name="check[]">
                                    <span></span>
                                 </label>
                               </span>
                           </div>
                          </div>
                     </div>
                  </div>
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Trade License Number') }}</label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->trade_license) }}" name="event_type" readonly="readonly" type="text"
                                        class="form-control">
                           <div class="input-group-append">
                              <span class="input-group-text">
                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                    <input data-step="step-1" type="checkbox" name="check[]">
                                    <span></span>
                                 </label>
                               </span>
                           </div>
                          </div>
                     </div>
                     <div class="col-sm-6">
                        <section class="row form-group form-group-sm">
                           <div class="col-sm-6">
                              <label class="kt-font-dark">{{ __('Trade License Issued Date') }} </label>
                              <div class="input-group input-group-sm">
                               <input value="{{ date('d-F-Y', strtotime($company->trade_license_issued_date)) }}" name="name_ar" readonly="readonly" type="text"
                                            class="form-control">
                               <div class="input-group-append">
                                  <span class="input-group-text">
                                     <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                        <input data-step="step-1" type="checkbox" name="check[]">
                                        <span></span>
                                     </label>
                                   </span>
                               </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <label class="kt-font-dark">{{ __('Trade License Expired Date') }}</label>
                              <div class="input-group input-group-sm">
                               <input value="{{ date('d-F-Y', strtotime($company->trade_license_expired_date)) }}" name="name_ar" readonly="readonly" type="text"
                                            class="form-control">
                               <div class="input-group-append">
                                  <span class="input-group-text">
                                     <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                        <input data-step="step-1" type="checkbox">
                                        <span></span>
                                     </label>
                                   </span>
                               </div>
                              </div>
                           </div>
                        </section>
                       
                          
                     </div>
                  </div>
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                        <section class="row form-group form-group-sm">
                           <div class="col-sm-6 kt-hide">
                              <label class="kt-font-dark">{{ __('Establishment Type') }} </label>
                              <div class="input-group input-group-sm">
                               <input value="{{ ucfirst($company->type) }}" name="name_ar" readonly="readonly" type="text"
                                            class="form-control">
                               <div class="input-group-append">
                                  <span class="input-group-text">
                                     <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                        <input data-step="step-1" type="checkbox">
                                        <span></span>
                                     </label>
                                   </span>
                               </div>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <label class="kt-font-dark">{{ __('Phone Number') }}</label>
                              <div class="input-group input-group-sm">
                               <input value="{{ $company->phone_number }}" name="name_ar" readonly="readonly" type="text"
                                            class="form-control"> 
                               <div class="input-group-append">
                                  <span class="input-group-text">
                                     <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                        <input data-step="step-1" type="checkbox">
                                        <span></span>
                                     </label>
                                   </span>
                               </div>
                              </div>
                           </div>
                        </section>
                     </div>
                     <div class="col-sm-6">
                        <section class="row form-group form-group-sm">
                           <div class="col-sm-6">
                              <label class="kt-font-dark">{{ __('Company Email') }} </label>
                              <div class="input-group input-group-sm">
                               <input value="{{ $company->email }}" name="name_ar" readonly="readonly" type="text"
                                            class="form-control">
                               <div class="input-group-append">
                                  <span class="input-group-text">
                                     <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                        <input data-step="step-1" type="checkbox">
                                        <span></span>
                                     </label>
                                   </span>
                               </div>
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <label class="kt-font-dark">{{ __('Company Website') }}</label>
                              <div class="input-group input-group-sm">
                               <input value="{{ $company->website ? $company->website : 'N/A' }}" name="name_ar" readonly="readonly" type="text"
                                            class="form-control">
                               <div class="input-group-append">
                                  <span class="input-group-text">
                                     <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                        <input data-step="step-1" type="checkbox">
                                        <span></span>
                                     </label>
                                   </span>
                               </div>
                              </div>
                           </div>
                        </section>
                       
                          
                     </div>
                  </div>
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-9">
                         <label class="kt-font-dark">{{ __('Address') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ ucfirst($company->address) }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                     <div class="col-sm-3">
                         <label class="kt-font-dark">{{ __('Area') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ ucfirst(Auth::user()->LanguageId == 1 ? $company->area->area_en : $company->area->area_ar) }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                  </div>
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Emirate') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ ucfirst( Auth::user()->LanguageId == 1 ? $company->emirate->name_en : $company->emirate->name_ar) }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Country') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ Auth::user()->LanguageId == 1 ? $company->country->name_en : $company->country->name_ar }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                  </div>
                  
               </div>
             </div>
         </div>
       </section>
       <section class="accordion kt-margin-b-10 accordion-solid accordion-toggle-plus border" id="accordion-address">
         <div class="card">
            <div class="card-header" id="heading-address">
               <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-address" aria-expanded="true" aria-controls="collapse-address">
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('COMPANY CONTACT PERSON DETAILS') }}</h6>
               </div>
             </div>
             <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
               <div class="card-body">
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Name') }} </label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->contact->name_en) }}" name="event_type" readonly="readonly" type="text"
                                        class="form-control">
                           <div class="input-group-append">
                              <span class="input-group-text">
                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                    <input data-step="step-1" type="checkbox">
                                    <span></span>
                                 </label>
                               </span>
                           </div>
                          </div>
                     </div>
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __(' Name (AR)') }} </label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->contact->name_ar) }}" name="event_type" readonly="readonly" type="text"
                                        class="form-control">
                           <div class="input-group-append">
                              <span class="input-group-text">
                                 <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                    <input data-step="step-1" type="checkbox">
                                    <span></span>
                                 </label>
                               </span>
                           </div>
                          </div>
                     </div>
                  </div>
                  <section class="row form-group form-group-sm">
                     <div class="col-sm-6">
                        <label class="kt-font-dark">{{ __('Designation') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ ucfirst($company->contact->designation_en) }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <label class="kt-font-dark">{{ __('Designation (AR)') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ $company->contact->designation_ar }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                  </section>
                  <section class="row form-group form-group-sm">
                     <div class="col-sm-6">
                        <label class="kt-font-dark">{{ __('Email') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ $company->contact->email }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <label class="kt-font-dark">{{ __('Mobile Number') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ $company->contact->mobile_number }}" name="name_ar" readonly="readonly" type="text"
                                      class="form-control">
                         <div class="input-group-append">
                            <span class="input-group-text">
                               <label class="kt-checkbox kt-checkbox--single kt-checkbox--default">
                                  <input data-step="step-1" type="checkbox">
                                  <span></span>
                               </label>
                             </span>
                         </div>
                        </div>
                     </div>
                  </section>
               </div>
             </div>
         </div>
       </section>
       <section class="accordion kt-margin-b-10 accordion-solid accordion-toggle-plus border" id="accordion-requirement">
         <div class="card">
            <div class="card-header" id="heading-requirement">
               <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-requirement" aria-expanded="true" aria-controls="collapse-requirement">
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('UPLOADED REQUIREMENTS ') }}</h6>
               </div>
             </div>
             <div id="collapse-requirement" class="collapse show" aria-labelledby="heading-requirement" data-parent="#accordion-requirement">
               <div class="card-body">
                  <table class="table table-borderless table-striped table-hover border" id="requirement-table">
                     <thead>
                        <tr>
                           <th>#</th>
                           <th>{{__('REQUIREMENT NAME')}}</th>
                           <th>{{__('ISSUED DATE')}}</th>
                           <th>{{__('EXPIRED DATE')}}</th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </section>
       <section class="accordion kt-margin-b-10 accordion-solid accordion-toggle-plus border" id="accordion-action">
         <div class="card">
            <div class="card-header" id="heading-action">
               <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-action" aria-expanded="true" aria-controls="collapse-action">
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('SELECT ACTION') }}</h6>
               </div>
             </div>
             <div id="collapse-action" class="collapse show" aria-labelledby="heading-action" data-parent="#accordion-action">
               <div class="card-body">
                  <form name="submit_application" action="{{ route('admin.company.submit', $company->company_id) }}" class="kt_form" method="post" accept-charset="utf-8">
                     @csrf
                     <div class="form-group ">
                        <label class="kt-font-dark">Remarks</label>
                        <textarea name="comment" class="form-control form-control-sm" rows="4"></textarea>
                     </div>
                     <div class="form-group">
                        <div class="kt-radio-inline">
                           <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                              <input value="active" type="radio" name="status"> Approve Registration
                              <span></span>
                           </label>
                           <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                              <input value="need modification" type="radio" name="status"> Send Back for Amendment
                              <span></span>
                           </label>
                           {{-- <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                              <input value="need approval" type="radio" name="status"> Need Approval
                              <span></span>
                           </label> --}}
                           <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                              <input value="rejected" type="radio" name="status"> Reject Application
                              <span></span>
                           </label>
                        </div>
                     </div>
                     <div class="form-group form-group-sm">
                        <button type="submit" class="btn btn-warning kt-font-transform-u btn-sm">Submit</button>
                     </div>
                  </form>
               </div>
             </div>
         </div>
       </section>
   </div>
</section>
@stop
@section('script')
<script>
   $(document).ready(function(){
      documentRequirement();
      validation();
   });
   function validation(){
      
      // $('form[name=submit_application]').submit(function(e){
         
      // });

      $(document).on('change','input[type=checkbox]', function(){
         if($(this).is(':checked')){
            $(this).parents('.input-group').find('input[type=text]').addClass('is-valid').removeClass('is-invalid');
            $(this).parents('.input-group').find('textarea').addClass('is-valid').removeClass('is-invalid');
            $(this).parents('label').removeClass('kt-checkbox--default').addClass('kt-checkbox--success');
         }
         else{
            $(this).parents('.input-group').find('input[type=text]').removeClass('is-valid').addClass('is-invalid');
            $(this).parents('.input-group').find('textarea').removeClass('is-valid').addClass('is-invalid');
            $(this).parents('label').removeClass('kt-checkbox--success').addClass('kt-checkbox--default');
         }
     });

      $('form[name=submit_application]').validate({
         rules:{
            status:{required: true},
         }
      });
   }

   function documentRequirement(){
      $('#requirement-table').DataTable({
         ajax:{
            url: '{{ route('admin.company.application.datatable', $company->company_id) }}'
         },
         columns: [
         {data: 'count'},
         {data: 'name'},
         {data: 'issued_date'},
         {data: 'expired_date'}
         ]
      });
   }
</script>
@stop
