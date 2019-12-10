    @extends('layouts.admin.admin-app')
@section('style')
<style>
  .widget-toolbar{ cursor: pointer; }
</style>
{{-- <style>
  .twitter-typeahead {
    display: inline !important;
}

.typeahead-content {
    box-shadow: 0 1px 2px rgba(0,0,0,.26);
    background-color: #fff;
    cursor: pointer;
    margin-top: -15px;
    min-width: 100px;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    position: absolute;
    white-space: nowrap;
    z-index: 1001;
    will-change: width,height;
}

.typeahead-highlight {
    font-weight: 900;
}

.typeahead-suggestion {
    padding: 5px 0px 10px 10px;
}

.typeahead-suggestion:hover {
    background-color: #42A5F5;
    color: #FFF;
}

.typeahead-notfound {
    cursor:not-allowed;
    padding: 5px 0px 10px 10px;
}
</style> --}}
@endsection
@section('content')
	 <section class="kt-portlet kt-portlet--last kt-portlet--responsive-mobile" id="kt_page_portlet">
			<div class="kt-portlet__body">
				 <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist" id="artist-permit-nav">
						<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#artist-report" data-target="#artist-report">{{ __('Artist Report') }}</a></li>
                        <li class="nav-item"><a class="nav-link" id="event-report-tab" data-toggle="tab" href="#event-report-section" data-target="#event-report-section">{{ __('Event Report') }}</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#artist-permit-report" data-target="#artist-permit-report">{{ __('Artist Permit Report') }}</a></li>
						<li class="nav-item "><a class="nav-link" id="inspection" data-toggle="tab" href="#inspection">{{ __('Inspection') }}</a></li>
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
                <div class="text-primary">ARTIST PERMIT REPORT</div>
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
    @section('script')


      @endsection
