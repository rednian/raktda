@extends('layouts.admin.admin-app')
@section('content')
<section class="kt-portlet kt-portlet--last kt-portlet--head-sm kt-portlet--responsive-mobile">
   <div class="kt-portlet__head kt-portlet__head--sm">
      <div class="kt-portlet__head-label">
         <h3 class="kt-portlet__head-title kt-font-dark">{{ucfirst(Auth::user()->LanguageId == 1 ? $company->name_en : $company->name_ar )}} - {{ __('Application') }}</h3>
      </div>
      <div class="kt-portlet__head-toolbar">
         <a href="{{ URL::signedRoute('admin.company.index') }}" class="btn btn-sm btn-secondary btn-elevate kt-font-transform-u">
            <i class="la la-arrow-left"></i>
           {{__('BACK')}}
         </a>
      </div>
   </div>
   <div class="kt-portlet__body kt-padding-t-5 kt-margin-b-15">
      @if (!$company->comment()->exists())
        <div class="alert alert-outline-danger fade show kt-margin-b-10 kt-hide" role="alert">
          <div class="alert-icon"><i class="flaticon-warning"></i></div>
          <div class="alert-text">
            <ul>
              <li></li>
            </ul>
          </div>
          <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
          </div>
        </div>
      @endif
   

       <section class="accordion kt-margin-b-10 accordion-solid accordion-toggle-plus border" id="accordion-detail">
         <div class="card">
            <div class="card-header" id="heading-detail">
               <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-detail" aria-expanded="true" aria-controls="collapse-detail">
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('ESTABLISHMENT DETAILS') }}</h6>
               </div>
             </div>
             <div id="collapse-detail" class="collapse show" aria-labelledby="heading-detail" data-parent="#accordion-detail">
               <div class="card-body">
                  {{-- <div class="row form-group form-group-sm">
                    <div class="col-sm-6">
                        <label class="kt-font-dark">{{ __('Establishment Type') }} </label>
                        <div class="input-group input-group-sm">
                         <input value="{{ ucfirst($company->type->name_en) }}" name="name_ar" readonly="readonly" type="text"
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
                  </div> --}}
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Establishment Name') }} <span class="text-danger">*</span></label>
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
                         <label class="kt-font-dark">{{ __('Establishment Name (AR)') }} <span class="text-danger">*</span></label>
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
                              <label class="kt-font-dark">{{ __('Establishment Email') }} </label>
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
                              <label class="kt-font-dark">{{ __('Website') }}</label>
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
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('CONTACT INFORMATION') }}</h6>
               </div>
             </div>
             <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address">
               <div class="card-body">
                  <div class="row form-group form-group-sm">
                     <div class="col-sm-6">
                         <label class="kt-font-dark">{{ __('Name') }} </label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->contact->contact_name_en) }}" name="event_type" readonly="readonly" type="text"
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
                         <label class="kt-font-dark">{{ __('Name (AR)') }} </label>
                          <div class="input-group input-group-sm">
                           <input value="{{ ucfirst($company->contact->contact_name_ar) }}" name="event_type" readonly="readonly" type="text"
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
                  <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> {{ __('UPLOADED DOCUMENTS') }}</h6>
               </div>
             </div>
             <div id="collapse-requirement" class="collapse show" aria-labelledby="heading-requirement" data-parent="#accordion-requirement">
               <div class="card-body">
                  <table class="table table-borderless table-striped table-hover border" id="requirement-table">
                     <thead>
                        <tr>
                           <th>{{__('REQUIREMENT NAME')}}</th>
                           <th>{{__('FILES')}}</th>
                           <th>{{__('ISSUED DATE')}}</th>
                           <th>{{__('EXPIRY DATE')}}</th>
                        </tr>
                     </thead>
                  </table>
               </div>
            </div>
         </div>
      </section>
      <section class="row kt-margin-t-10">
        <div class="col-12">
          <ul class="nav nav-tabs nav-tabs-line nav-tabs-line-danger nav-tabs-line-3x" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#kt_portlet_base_demo_2_3_tab_content" role="tab">
               {{__('SELECT ACTION')}}
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#kt_portlet_base_demo_2_2_tab_content" role="tab">
                {{__('CHECKED HISTORY')}}
                <span class="kt-badge kt-badge--outline kt-badge--warning">{{ $company->comment()->count() }}</span>
              </a>
            </li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="kt_portlet_base_demo_2_3_tab_content" role="tabpanel">
              <form name="submit_application" action="{{ route('admin.company.submit', $company->company_id) }}" class="kt_form border kt-padding-10" method="post" accept-charset="utf-8">
                 @csrf
                 <div class="form-group row">
                  <div class="col-6">
                    <label class="kt-font-dark">{{ __('Remarks') }}</label>
                    <textarea name="comment_en" maxlength="255" class="form-control form-control-sm" rows="5"></textarea>
                  </div>
                  <div class="col-6">
                    <label class="kt-font-dark">{{ __('Remarks (AR)') }}</label>
                    <textarea name="comment_ar" maxlength="255" class="form-control form-control-sm" rows="5"></textarea>
                  </div>
                   
                 </div>
                 <div class="form-group">
                    <div class="kt-radio-inline">
                       <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                          <input value="active" type="radio" name="status"> {{ __('Approve Registration') }}
                          <span></span>
                       </label>
                       <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                          <input value="back" type="radio" name="status"> {{ __('Bounce Back for Amendments') }}
                          <span></span>
                       </label>
                       <label class="kt-radio kt-radion--bold kt-radio--success kt-font-dark">
                          <input value="rejected" type="radio" name="status"> {{ __('Reject Application') }}
                          <span></span>
                       </label>
                    </div>
                 </div>
                 <div class="form-group form-group-sm">
                    <button type="submit" class="btn btn-maroon kt-font-transform-u btn-sm">{{ __('Submit') }}</button>
                 </div>
              </form>
            </div>
            <div class="tab-pane" id="kt_portlet_base_demo_2_2_tab_content" role="tabpanel">
              <table class="table table-borderless table-sm table-hover table-striped border" id="comment-table">
                <thead>
                  <tr>
                    <th>{{__('NAME')}}</th>
                    <th>{{__('REMARKS')}}</th>
                    <th>{{__('ACTION')}}</th>
                    <th>{{__('CHECKED DATE')}}</th>
                  </tr>
                </thead>
              </table>
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
      comment();

   });

   function comment(){
    $('table#comment-table').DataTable({
      ajax: '{{ route('admin.company.comment.datatable', $company->company_id) }}',
      // columnDefs:[{targets:}]
      columns:[
      {data: 'name'},
      {data: 'remark'},
      {data: 'action'},
      {data: 'date'},
      ]
    });
   }


   function validation(){
      

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
      var status = null;
      $('input[name=status][type=radio]').change(function(){
        status = $(this).val();
      });

      $('form[name=submit_application]').submit(function(){ 
        if(status != 'active'){
          $(this).find('textarea').attr('required', true);
        }
        else{
           $(this).find('textarea').removeAttr('required', true);
        }
      });


      $('form[name=submit_application]').validate({
        validClass: "success",
        ignore: '.ignore',
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
         // {data: 'requirement'},
         {data: 'name'},
         {render:function(){return null;}},
         {render:function(){return null;}},
         {render:function(){return null;}},
         // {data: 'expired_date'}
         ],
         "order": [[ 0, 'asc' ]],
           rowGroup: {
             startRender: function ( rows, group ) { 
              var row_data = rows.data()[0];
              return $('<tr/>').append( '<td >'+group+'</td>' )
                         .append( '<td>'+rows.count()+'</td>' )
                         .append( '<td>'+row_data.issued_date+'</td>' )
                         .append( '<td>'+row_data.expired_date+'</td>' )
                         // .append( '<td></td>' )
                         // .append( '<td>'+row_data.action+'</td>' )
                         .append( '<tr/>' );
               },
            dataSrc: 'requirement'
         }
      });
   }
</script>
@stop
