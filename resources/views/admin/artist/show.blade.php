@extends('layouts.admin.admin-app')
@section('content')
<section class="kt-portlet kt-portlet--head-sm">
   <div class="kt-portlet__head kt-portlet__head--sm kt-padding-l-15 kt-padding-r-15">
      <div class="kt-portlet__head-label">
         <h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ __('ARTIST PROFILE') }}</span></h3></div>
         <div class="kt-portlet__head-toolbar">
            <button id="clickme" class="btn btn-sm btn-secondary btn-elevate  kt-font-transform-u">
               <i class="la la-arrow-left"></i>{{ __('BACK TO Previous') }}
            </button>
         </div>
      </div>
      <div class="kt-portlet__body kt-padding-15">
        <section class="row">
          @php
            $artistpermit = $artist->artistpermit()->latest()->first();
            $language = Auth::user()->LanguageId;
          @endphp
          <div class="col-md-4 kt-padding">
            <div class="kt-widget kt-widget--user-profile-4 border">
                <div class="kt-widget__head">
                  <div class="kt-widget__media">
                    <img class="kt-widget__img" src="{{ asset('storage/'.$artistpermit->thumbnail) }}" alt="image">
                  </div>
                  <div class="kt-widget__content">
                    <div class="kt-widget__section">
                      <span class="kt-widget__username">
                        {{ $language == 1 ? ucwords($artistpermit->fullname) : $artistpermit->firstname_ar.' '.$artistpermit->lastname_ar }}
                      </span>
                      <div class="kt-widget__button">
                        @if ($artist->artist_status == 'active')
                        <span class="btn btn-label-success btn-sm">{{ucfirst($artist->artist_status)}}</span>
                        @else
                        <span class="btn btn-label-danger btn-sm">{{ucfirst($artist->artist_status)}}</span>
                        @endif
                      </div>
                      {{-- <div class="kt-widget__action">
                        <a href="#" class="btn btn-icon btn-circle btn-label-facebook">
                          <i class="socicon-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-circle btn-label-twitter">
                          <i class="socicon-twitter"></i>
                        </a>
                        <a href="#" class="btn btn-icon btn-circle btn-label-google">
                          <i class="socicon-google"></i>
                        </a>
                      </div> --}}
                    </div>
                  </div>
                </div>
                <div class="kt-widget__body kt-padding-l-5 kt-padding-r-5">
                  <h6 class="kt-font-dark kt-font-bold ">{{__('Artist Details')}}</h6>
                  <hr class="kt-margin-b-5  kt-margin-t-0">
                 <span>Person Code : {{$artist->person_code }}</span><br> 
                 <span>Age : {{$artistpermit->birthdate->age }}</span><br>
                 <span>Birthdate : {{$artistpermit->birthdate->format('d-F-Y')}}</span><br>
                 <span>Gender : {{$artistpermit->gender->name_en}}</span><br>
                 <span>Religion : {{$artistpermit->religion->name_en}}</span><br>
                 <span>Identification Number : {{$artistpermit->identification_number}}</span><br>
                 <span>UID Number : {{$artistpermit->uid_number ? $artistpermit->uid_number : 'N/A'}}</span><br>
                 <span>UID Number : {{$artistpermit->uid_expire_date ? $artistpermit->uid_expire_date->format('d-F-Y') : '-'}}</span><br>
                 <span>Visa Type : {{$artistpermit->visaType->name_en ? ucfirst($artistpermit->visaType->name_en) : 'N/A'}}</span><br>
                 <span>Visa Number : {{$artistpermit->visa_number ? $artistpermit->visa_number : '-' }}</span><br>
                 <span>Passport Number : {{$artistpermit->passport_number ? $artistpermit->passport_number : '-' }}</span><br>
                 <span>Passport Expired Date : {{$artistpermit->passport_expire_date ? $artistpermit->passport_expire_date->format('d-F-Y') : '-' }}</span><br>
                 
                 <h6 class="kt-font-dark kt-font-bold kt-margin-t-15 ">{{__('Contact Details')}}</h6>
                 <hr class="kt-margin-b-5  kt-margin-t-0">
                 <span>Email : {{$artistpermit->email }}</span><br>
                 <span>Mobile Number : {{$artistpermit->mobile_number }}</span><br>
                 <span>Phone Number : {{$artistpermit->phone_number }}</span><br>
                 <span>Fax Number : {{$artistpermit->fax_number }}</span><br>
                 
                 <h6 class="kt-font-dark kt-font-bold kt-margin-t-15 ">{{__('Address Details')}}</h6>
                 <hr class="kt-margin-b-5  kt-margin-t-0">
                 @php
                   $address = $language == 1 ? ucfirst($artistpermit->address_en) : $artistpermit->address_ar;
                   $area = $language == 1 ? ucfirst($artistpermit->area->area_en) : $artistpermit->area->area_ar;
                   $emirate = $language == 1 ? ucfirst($artistpermit->emirate->name_en) : $artistpermit->emirate->name_ar;
                   $country = $language == 1 ? ucfirst($artistpermit->country->name_en) : $artistpermit->country->name_ar;
                 @endphp
                 <span>{{$address.' '.$area.' '.$emirate.' '.$country}}</span><br>
                  <h6 class="kt-font-dark kt-font-bold kt-margin-t-15 ">{{__('Sponsor Details')}}</h6>
                  <hr class="kt-margin-b-5  kt-margin-t-0">
                  <span>Name : {{ucwords($artistpermit->sponsor_name_en) }}</span><br>
              </div>
          </div>
        </div>
          <div class="col-md-8">
            <div class="accordion accordion-solid  accordion-toggle-plus" id="accordionExample6">
                  <div class="card border">
                    <div class="card-header " id="headingOne6">
                      <div class="card-title kt-padding-b-10 kt-padding-t-10" data-toggle="collapse" data-target="#collapseOne6">
                        @if ($artist->artist_status == 'active')
                        BLOCK ARTIST
                        @else
                        UNBLOCK ARTIST
                        @endif
                        </div>
                    </div>
                    <div id="collapseOne6" class="collapse show" aria-labelledby="headingOne6" data-parent="#accordionExample6" style="">
                      <div class="card-body kt-padding-b-0">
                        <form action="{{ route('admin.artist.update_status',$artist->artist_id) }}" method="post" class="form" id="frm-status">
                          @csrf
                         <div class="form-group row form-group-sm">
                            <div class="col-md-6">
                              <label for="">Remarks <span class="text-danger">*</span></label>
                              <textarea required="" name="remarks" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea> 
                            </div>
                            <div class="col-md-6">
                              <label for="">Remarks (AR)<span class="text-danger">*</span></label>
                              <textarea required="" name="remarks_ar" dir="rtl" maxlength="255" class="form-control form-control-sm" rows="3" autocomplete="off"></textarea> 
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col">
                              @if ($artist->artist_status == 'active')
                              <button class="btn btn-sm btn-maroon kt-transform-u" name="status" value="blocked">SUBMIT</button>
                              @else
                              <button class="btn btn-sm btn-maroon kt-transform-u" name="status" value="active">SUBMIT</button>
                              @endif
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <section class="row">
                  <div class="col-md-12">
                       <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
                        <li class="nav-item ">
                          <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_2" role="tab" aria-selected="true">{{ __('PERMIT HISTORY') }}</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_3" role="tab" aria-selected="false">{{ __('STATUS HISTORY') }}</a>
                        </li>
                       </ul>
                               <div class="tab-content">
                                <div class="tab-pane active" id="kt_tabs_6_2" role="tabpanel">
                                     <table class="table table-striped table-borderless table-hover border" id="artist-permit-history">
                                        <thead>
                                        <tr>
                                           <th></th>
                                           <th>{{ __('ACTION') }}</th>
                                           <th>{{ __('REFERENCE NO.') }}</th>
                                           <th>{{ __('ESTABLISHMENT NAME') }}</th>
                                           <th>{{ __('PERMIT NO.') }}</th>
                                           <th>{{ __('ISSUED DATE') }}</th>
                                           <th>{{ __('EXPIRED DATE') }}</th>
                                           <th>{{ __('PERMIT STATUS') }}</th>
                                        </tr>
                                        </thead>
                                     </table>
                                  </div>
                                  <div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">
                                     <table class="table table-striped table-borderless table-hover border table-hover table-sm" id="status-history">
                                        <thead>
                                        <tr>
                                         <th>{{ __('NAME') }}</th>
                                         <th>{{ __('REMARKS') }}</th>
                                         <th>{{ __('DATE') }}</th>
                                         <th>{{ __('ACTION TAKEN') }}</th>
                                        </tr>
                                        </thead>
                                     </table>
                                  </div>
                               </div>
                  </div>
                </section>
          </div>
        </section>

         
         
				 
				 
				 

			</div>
	 </section>
     {{-- @include('admin.artist.include.artist-block-modal') --}}
      @include('admin.artist_permit.includes.document')
@endsection
@section('script')
<script>
  
  $('form#frm-status').validate();

    var is_checked = false;
      $(document).ready(function () {
         $('button#btn-action').click(function(){
            $('#kt_modal_1').modal('show');
         });

        $('input#artist-status').change(function(){  });

        $('#kt_modal_1').on('hidden.bs.modal', function () {
            $('input#artist-status').attr();
        })

          $('#clickme').click(function(reload) {

             //     window.location.hash = '#kt_tabs_1_5';
                 //  window.location.reload(true);
              window.history.back();
          });
         permitHistory();
         statusHistory();

         $('form#frm-update-status').validate({
            rules: {
               remarks: {
                  required: true,
                  minlength: 3,
                  maxlength: 255
               }
            }
         });
      });
      function statusHistory() {
         $('table#status-history').DataTable({
            ajax: {
               url: '{{ route('admin.artist.status_history', $artist_permit->artist_id) }}',
               data: function (d) {
               }
            },
            columnDefs: [
               {targets: [0, 2, 3], className: 'no-wrap'}
            ],
            columns: [
               {data: 'name'},
               {data: 'remarks'},
               {data: 'created_at'},
               {data: 'action'}
            ]
         });
      }

      function permitHistory() {
         $('table#artist-permit-history').DataTable({
            ajax: {
               url: '{{ route('admin.artist.permit.history', $artist_permit->artist_id) }}',
               data: function (d) {
               }
            },
            responsive:true,
            columnDefs: [
               {targets: '_all', className: 'no-wrap'}
            ],
            columns: [
            {render: function(){ return null; }},
            {
             render: function(type, row, full, meta){
                 return '<button class="btn btn-secondary btn-sm btn-document">Documents</button>';
             }
            },
             {data: 'reference_number'},
             {data: 'company_name'},
             {data: 'permit_number'},
             {data: 'issued_date'},
             {data: 'expired_date'},
             {data: 'permit_status'},
               
            ],
            createdRow: function(row, data, index){
               $('td:not(:first-child)',row).click(function(e){ location.href = '{{ url('/artist_permit') }}/'+data.permit_id; });
                
                $('.btn-document', row).click(function(e){
                    e.stopPropagation();
                    documents(data);
                    $('#document-modal').modal('show');

                });
            }
         });
      }
      
      function documents(data){
        console.log(data)
          $('#document-modal').on('shown.bs.modal', function(){
              $('table#table-document').DataTable({
                  ajax:{ 
                      url: '{{ url('/artist_permit') }}/'+data.permit_id+'/application/'+'{{ $artist_permit->artist_permit_id }}'+'/documentDatatable',
                  },
                  columns:[
                  {data: 'document_name'},
                  {data: 'issued_date'},
                  {data: 'expired_date'},
                  ]
              });
          });
      }

	 </script>
@stop
