    @extends('layouts.admin.admin-app')
@section('style')
<style>
  .widget-toolbar{ cursor: pointer; }

   #transaction-report-tab:hover ul{
       display: block;
   }

</style>

@endsection
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body">
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" id="artist-report-tab" data-toggle="tab" href="#artist-report" data-target="#artist-report">{{ __('Artist Report') }}</a></li>
                        <li class="nav-item"><a class="nav-link" id="event-report-tab" data-toggle="tab" href="#event-report-section" data-target="#event-report-section">{{__('Event Report') }}</a></li>

                          <li class="nav-item artist_transaction_tab">

                              <div class="btn-group">
                                  <a class="nav-link" id="transaction-report-tab" data-toggle="tab" href="#transaction-report-tab" data-target="#transaction-report-section">
                                      {{__('TRANSACTIONS')}}
                                  </a>
                                  <button style="border: none" type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                      <a href="{{route('admin.artist_permit_report.eventTransaction')}}">
                                          <button class="btn btn-dark btn-sm dropdown-menu" style="height: 20px;
    line-height: 2px;
    text-align: center;background-color: #656565; box-shadow: -1px 6px 11px -6px black;">{{__('EVENT TRANSACTIONS')}}</button></a>
                              </div>
                          </li>


{{--
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#artist-permit-report" data-target="#artist-permit-report">{{ __('Artist Permit Report') }}</a></li>
--}}
{{--
						<li class="nav-item "><a class="nav-link" id="inspection" data-toggle="tab" href="#inspection">{{ __('Inspection') }}</a></li>
--}}
						{{-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#blocked-artist">{{ __('Blocked Artists') }}</a></li> --}}
				 </ul>

          <div class="form-row d-none" style="position: absolute; right: -80px; top: 23px; width: 30%">
            <div class="col-12">
                <div class="input-group input-group-sm">
                    <div class="kt-input-icon kt-input-icon--right" id="search-application">
                      <input name="value" autocomplete="off" type="text" class="form-control form-control-sm typeahead" aria-label="Text input with checkbox" placeholder="Search application or artist ...">
                      <span class="kt-input-icon__icon kt-input-icon__icon--right">
                        <span><i class="la la-search"></i></span>
                      </span>
                    </div>
              </div>
            </div>
          </div>

				 <div class="tab-content">
						<div class="tab-pane show fade active" id="artist-report" role="tabpanel">
                                @include('admin.report.includes.block-artist')
							{{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
							 @else
									@empty()
							Art			 No New Request Permit
									@endempty
							 @endif --}}
						 </div>
                     <div class="tab-pane show fade" id="event-report-section" role="tabpanel">
                         @include('admin.report.includes.event-report')
                         {{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
                          @else
                                 @empty()
                         Art			 No New Request Permit
                                 @endempty
                          @endif --}}
                     </div>
            <div class="tab-pane show fade" id="artist-permit-report" role="tabpanel">
                @include('admin.report.includes.artist-permit-report')
               {{-- @include('admin.artist_permit.includes.summary') --}}
              {{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
               @else
                  @empty()
                     No New Request Permit
                  @endempty
               @endif --}}
            </div>
                     <div class="tab-pane show fade" id="transaction-report-section" role="tabpanel">
                         @include('admin.report.includes.transaction-report')
                         {{-- @include('admin.artist_permit.includes.summary') --}}
                         {{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
                          @else
                             @empty()
                                No New Request Permit
                             @endempty
                          @endif --}}
                     </div>


                     <div class="tab-pane fade" id="inspection" role="tabpanel">
							 {{-- @include('admin.artist_permit.includes.summary') --}}
                            <div class="text-success">INSPECTION</div>
							{{--  @if(\App\Permit::whereIn('permit_status', ['approved-unpaid', 'modification request', 'processing', 'need approval'])->count() > 0)
							 @else
									@empty()
										 No on Proccess permit
									@endempty
							 @endif --}}
						</div>
				 </div>
            </div>
	 </section>
@endsection

