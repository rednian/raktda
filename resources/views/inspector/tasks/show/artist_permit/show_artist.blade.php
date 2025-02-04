@extends('layouts.inspector.layout')
@section('content')
	 <section class="kt-portlet kt-portlet--head-sm">
			<div class="kt-portlet__head kt-portlet__head--sm">
				 <div class="kt-portlet__head-label">
						<h3 class="kt-portlet__head-title kt-font-transform-u"><span class="text-dark">Artist profile</span></h3></div>
				 <div class="kt-portlet__head-toolbar">
						<button id="clickme" class="btn btn-sm btn-maroon btn-elevate  kt-font-transform-u">
							 <i class="la la-arrow-left"></i>Back
                        </button>
				 </div>

			</div>
			<div class="kt-portlet__body" style="padding-bottom: 0 !important;">
				 <div class="accordion accordion-solid accordion-toggle-plus kt-margin-b-5" id="accordion-personal">
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
													 @if(!$artist_permit->thumbnail)
														<div class="kt-widget__media">    
														</div>
													 @else
														
													 @endif
													 	<div class="kt-widget__pic kt-widget__pic--danger kt-font-success kt-font-bold kt-font-light" style="font-size: xx-large">
																 {{ profile($artist_permit->firstname_en, $artist_permit->lastname_en) }}
															</div>
													 @include('admin.artist.include.artist-block-modal')
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
																 <a href="#">Current Company: <span
																				class="kt-font-dark kt-font-bolder">{{ $artist_permit->permit()->latest()->first()->company->company_name }}</span></a>
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
				 <section class="row">
						<div class="col-6">
							 <div class="accordion accordion-solid accordion-toggle-plus kt-margin-b-5" id="accordion-contact">
									<div class="card">
										 <div class="card-header" id="heading-personal">
												<div class="card-title collapsed kt-padding-t-15 kt-padding-b-10" data-toggle="collapse" data-target="#collapse-contact" aria-expanded="false"
														 aria-controls="collapse-contact">
													 <h6 class="kt-font-dark kt-font-transform-u">{{ __('CONTACT INFORMATION') }}</h6>
												</div>
										 </div>
										 <div id="collapse-contact" class="collapse show" aria-labelledby="heading-contact" data-parent="#accordion-contact" style="">
												<div class="card-body" style="padding: 1px 1.25rem;">
													 <table class="table table-borderless table-sm">
															<tr>
																 <td width="25%">{{ __('Email') }}</td>
																 <td>: <span class="kt-font-bold">{{ $artist_permit->email }}</span></td>
															</tr>
															<tr>
																 <td>{{ __('Mobile Number') }}</td>
																 <td>: <span class="kt-font-bold">{{ $artist_permit->mobile_number}}</span></td>
															</tr>
															<tr>
																 <td>{{ __('Phone Number') }}</td>
																 <td>: <span class="kt-font-bold">{{ $artist_permit->phone_number}}</span></td>
															</tr>
													 </table>
												</div>
										 </div>
									</div>
							 </div>
						</div>
						<div class="col-6">
							 <div class="accordion accordion-solid accordion-toggle-plus " id="accordion-address">
									<div class="card">
										 <div class="card-header" id="heading-personal">
												<div class="card-title collapsed kt-padding-t-15 kt-padding-b-10" data-toggle="collapse" data-target="#collapse-address" aria-expanded="false"
														 aria-controls="collapse-address">
													 <h6 class="kt-font-dark kt-font-transform-u">{{ __('ADDRESS INFORMATION') }}</h6>
												</div>
										 </div>
										 <div id="collapse-address" class="collapse show" aria-labelledby="heading-address" data-parent="#accordion-address" style="">
												<div class="card-body" style="padding: 1px 1.25rem;">
                                                    <table class="table table-borderless table-sm">
															<tbody>
															<tr>
																 <td width="15%">{{ __('Address') }}</td>
																 <td>: <span class="kt-font-bold ">{{ ucwords($artist_permit->address_en) }}</span></td>
															</tr>
															<tr>
																 <td>{{ __('Area') }}</td>
																 <td>: <span class="kt-font-bold">{{ ucwords($artist_permit->area->area_en) }}</span></td>
															</tr>
															<tr>
																 <td>{{ __('Emirate') }}</td>
																 <td>: <span class="kt-font-bold">{{ ucwords($artist_permit->emirate->name_en)}}</span></td>
															</tr>
															</tbody>
													 </table>
												</div>
										 </div>
									</div>
						 </div>
						</div>
				 </section>
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist">
						<li class="nav-item">
							 <a class="nav-link active kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_1" role="tab" aria-selected="true">{{ __('PERMIT HISTORY') }}</a>
						</li>
						<li class="nav-item">
							 <a class="nav-link kt-font-transform-u" data-toggle="tab" href="#kt_tabs_6_2" role="tab" aria-selected="false">{{ __('STATUS HISTORY') }}</a>
						</li>
				 </ul>
				 <div class="tab-content">
						<div class="tab-pane active" id="kt_tabs_6_1" role="tabpanel">
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
										 </tr>
										 </thead>
									</table>
							 @else
									@empty
										 Artist permit is empty
									@endempty
							 @endif
						</div>
						<div class="tab-pane" id="kt_tabs_6_2" role="tabpanel">
							 @if($artist_permit->artist->action->count() > 0)
									<table class="table table-striped table-borderless table-hover border table-hover" id="status-history">
										 <thead>
										 <tr>
											<th>{{ __('UNBLOCKED/BLOCKED BY') }}</th>
											<th>{{ __('REMARKS') }}</th>
											<th>{{ __('ACTION DATE') }}</th>
											<th>{{ __('ACTION TAKEN') }}</th>
										 </tr>
										 </thead>
									</table>
							 @else
									@empty
										 Artist status is empty
									@endempty
							 @endif
						</div>
				 </div>

			</div>
	 </section>
@endsection
@section('script')
	 <script>
        var is_checked = false;
      $(document).ready(function () {
        $('input#artist-status').change(function(){ $('#kt_modal_1').modal('show'); });
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
               {targets: [0, 5], className: 'no-wrap'}
            ],
            columns: [
               {data: 'reference_number'},
               {data: 'company_name'},
               {data: 'permit_number'},
               {data: 'issued_date'},
               {data: 'expired_date'},
               {data: 'permit_status'},
            ]
         });
      }
	 </script>
@stop
