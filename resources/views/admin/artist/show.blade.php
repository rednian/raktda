@extends('layouts.admin.admin-app')
@section('content')
<section class="kt-portlet kt-portlet--head-sm">
   <div class="kt-portlet__head kt-portlet__head--sm">
      <div class="kt-portlet__head-label">
         <h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">{{ __('ARTIST PROFILE') }}</span></h3></div>
         <div class="kt-portlet__head-toolbar">
            <button id="clickme" class="btn btn-sm btn-secondary btn-elevate  kt-font-transform-u">
               <i class="la la-arrow-left"></i>{{ __('BACK TO Previous') }}
            </button>
         </div>
      </div>
      <div class="kt-portlet__body" style="padding-bottom: 0 !important;">
         <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
               <div class="kt-widget__media">
                   <img class="img img-thumbnail" src="{{ asset('/storage/'.$artist_permit->thumbnail) }}" alt="">   
               </div>
               <div class="kt-widget__content">
                  <div class="kt-widget__head">
                     <div class="kt-widget__user">
                        <span class="kt-widget__username kt-margin-r-5">{{ ucwords($artist_permit->fullname) }}</span>
                        @if ($artist_permit->artist->artist_status == 'active')
                             <span id="status" class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-success kt-font-transform-u">
                              {{ $artist_permit->artist->artist_status }}
                              </span>
                           @else
                           <span id="status" class="kt-badge kt-badge--bolder kt-badge kt-badge--inline kt-badge--unified-danger kt-font-transform-u">
                            {{ $artist_permit->artist->artist_status }}
                            </span>
                        @endif
                       
                     </div>
                     <div class="kt-widget__action">
                        @if ($artist_permit->artist->artist_status == 'active')
                             <button id="btn-action" class="btn btn-maroon btn-sm kt-font-transform-u">{{__('Block Artist')}}</button>
                          @else
                             <button id="btn-action" class="btn btn-success btn-sm kt-font-transform-u">{{__('Unblock Artist')}}</button>
                        @endif
                      
                     </div>
                  </div>
                  <div class="kt-widget__subhead kt-padding-t-0 kt-hide">
                     @if ($artist_permit->artist->permit()->where('permit_status', 'active')->count() > 0)
                        <span class="kt-font-bold kt-font-dark"> Active Profession :</span>
                       
                        <span class="kt-font-bold tag"> david.s@loop.com</span>
                        @else
                        <span class="kt-font-bold kt-font-dark"> Recent Profession :</span>
                        <span class="kt-font-bold"> david.s@loop.com</span>
                     @endif
                     
                  </div>
                  <div class="kt-widget__info">
                     <div class="kt-widget__desc">
                       
                     </div>
                  </div>
               </div>
            </div>
            <div class="kt-widget__bottom kt-margin-t-5">
               <div class="kt-widget__item kt-padding-t-0">
                  <div class="kt-widget__icon">
                     <i class="flaticon-file-2"></i>
                  </div>
                  <div class="kt-widget__details">
                     <a href="#" class="kt-widget__value">Active Permit</a>
                     <span class="kt-widget__title text-center">{{$artist_permit->artist->permit()->where('permit_status', 'active')->count() }}</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="accordion accordion-solid accordion-toggle-plus kt-margin-b-5 kt-hide" id="accordion-personal">
            <div class="card">
               <div class="card-header" id="heading-personal">
									<div class="card-title collapsed kt-padding-t-15 kt-padding-b-10" data-toggle="collapse" data-target="#collapse-personal" aria-expanded="false" aria-controls="collapse-personal">
										 <h6 class="kt-font-dark kt-font-transform-u">{{ __('PERSONAL INFORMATION') }}</h6>
									</div>
							 </div>  
							 <div id="collapse-personal" class="collapse show" aria-labelledby="heading-personal" data-parent="#accordion-personal" style="">
									<div class="card-body">
										 <div class="kt-widget kt-widget--user-profile-3">
												<div class="kt-widget__top">
													 @if($artist_permit->thumbnail)
														<div class="kt-widget__media"> 
                                                            <img class="img img-thumbnail" src="{{ asset('/storage/'.$artist_permit->thumbnail) }}" alt="">   
														</div>
													 @else
    												  <div class="kt-widget__pic kt-widget__pic--danger kt-font-success kt-font-bold kt-font-light" style="font-size: xx-large">
                                                                 {{ profile($artist_permit->firstname_en, $artist_permit->lastname_en) }}
                                                            </div>
													 @endif
													 	
													
													 <div class="kt-widget__content">
															<div class="kt-widget__head">
																 <div class="kt-widget__user">
																		<span class="kt-widget__username kt-padding-b-10 kt-margin-r-5">{{ ucwords($artist_permit->fullname) }}</span>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input {{ $artist_permit->artist->artist_status == 'active'? 'checked': null }} id="artist-status" type="checkbox"  name="">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
																 </div>
															</div>
                                                            
															<div class="kt-widget__subhead">
																 <span>{{ __('Current Company') }} : 
                                                                    <span class="kt-font-dark kt-font-bolder">
                                                                        {{ $artist_permit->permit()->latest()->first()->owner->company->name_en }}
                                                                    </span>
                                                                </span>
																 {{--										 <a href="#"><i class="flaticon2-calendar-3"></i>PR Manager </a>--}}
																 {{--										 <a href="#"><i class="flaticon2-placeholder"></i>Melbourne</a>--}}
															</div>

													 </div>
												</div>
												{{--						<div class="kt-separator kt-separator--sm kt-separator--dashed kt-margin-t-10 kt-margin-b-10"></div>--}}
								<?php $permit = $artist_permit->artist->permit(); ?>
												{{--						<section class="row">--}}
												{{--							 <div class="col-3">--}}
												{{--									<div class="kt-section kt-section--space-sm">--}}
												{{--										 <div class="kt-widget24 kt-widget24--solid">--}}
												{{--												<div class="kt-widget24__details">--}}
												{{--													 <div class="kt-widget24__info">--}}
												{{--															<span class="kt-widget24__title" title="Click to edit">Active Permit</span>--}}
												{{--													 </div>--}}
												{{--													 <span class="kt-widget24__stats kt-font-default">--}}
												{{--															{{ $permit->where('permit_status', 'active')->whereDate('expired_date', '>=', \Carbon\Carbon::now())->count() }}--}}
												{{--													 </span>--}}
												{{--												</div>--}}
												{{--										 </div>--}}
												{{--									</div>--}}
												{{--							 </div>--}}
												{{--							 <div class="col-3">--}}
												{{--									<div class="kt-section kt-section--space-sm">--}}
												{{--										 <div class="kt-widget24 kt-widget24--solid">--}}
												{{--												<div class="kt-widget24__details">--}}
												{{--													 <div class="kt-widget24__info">--}}
												{{--															<span class="kt-widget24__title" title="Click to edit">Total Permit</span>--}}
												{{--													 </div>--}}
												{{--													 <span class="kt-widget24__stats kt-font-default">--}}
												{{--															{{ $permit->whereIn('permit_status', ['expired', 'active'])->count() }}--}}
												{{--													 </span>--}}
												{{--												</div>--}}
												{{--										 </div>--}}
												{{--									</div>--}}
												{{--							 </div>--}}
												{{--						</section>--}}
										 </div>
									</div>
							 </div>
						</div>
				 </div>
				 
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_1" role="tab" aria-selected="true">{{ __('PERSONAL INFORMATION') }}</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_2" role="tab" aria-selected="true">{{ __('PERMIT HISTORY') }}</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_3" role="tab" aria-selected="false">{{ __('STATUS HISTORY') }}</a>
               </li>
				 </ul>
				 <div class="tab-content">
               <div class="tab-pane active" id="kt_tabs_6_1" role="tabpanel">
                     
                  </div>
						<div class="tab-pane" id="kt_tabs_6_2" role="tabpanel">
							 @if($artist_permit->permit()->count() > 0)
									<table class="table table-striped table-borderless table-hover border" id="artist-permit-history">
										 <thead>
										 <tr>
												<th>{{ __('REFERENCE NO.') }}</th>
												<th>{{ __('ESTABLISHMENT NAME') }}</th>
												<th>{{ __('PERMIT NO.') }}</th>
												<th>{{ __('ISSUED DATE') }}</th>
												<th>{{ __('EXPIRED DATE') }}</th>
												<th>{{ __('PERMIT STATUS') }}</th>
                        <th>{{ __('ACTION') }}</th>
										 </tr>
										 </thead>
									</table>
							 @else
									@empty
										 
									@endempty
							 @endif
						</div>
						<div class="tab-pane" id="kt_tabs_6_3" role="tabpanel">
							 @if($artist_permit->artist->action->count() > 0)
									<table class="table table-striped table-borderless table-hover border table-hover" id="status-history">
										 <thead>
										 <tr>
											<th>{{ __('UNBLOCKED/BLOCKED BY') }}</th>
											<th>{{ __('REMARKS') }}</th>
											<th>{{ __('DATE') }}</th>
											<th>{{ __('ACTION TAKEN') }}</th>
										 </tr>
										 </thead>
									</table>
							 @else
									@empty
										
									@endempty
							 @endif
						</div>
				 </div>

			</div>
	 </section>
     @include('admin.artist.include.artist-block-modal')
      @include('admin.artist_permit.includes.document')
@endsection
@section('script')
<script>
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
               {data: 'employee_name'},
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
            columnDefs: [
               {targets: [0, 5, 6], className: 'no-wrap'}
            ],
            columns: [
               {data: 'reference_number'},
               {data: 'company_name'},
               {data: 'permit_number'},
               {data: 'issued_date'},
               {data: 'expired_date'},
               {data: 'permit_status'},
               {
                render: function(type, row, full, meta){
                    return '<button class="btn btn-secondary btn-sm btn-document">Documents</button>';
                }
               }
            ],
            createdRow: function(row, data, index){
                
                $('.btn-document', row).click(function(e){
                    e.stopPropagation();
                    documents(data);
                    $('#document-modal').modal('show');

                });

                $(row).click(function(){
                    location.href = '{{ url('/artist_permit') }}/'+data.permit_id;
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
