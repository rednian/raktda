
        <div class="kt-portlet__body" style="margin-top: -40px">
            <ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-danger" role="tablist" id="artist-permit-nav">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#new-request" data-target="#new-request">{{ __('New Request Permits') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pending-request" data-target="#pending-request">{{ __('Pending Request Permits') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#processing-permit">{{ __('Processing Permits') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#active-permit">{{ __('Active Permits') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#archive-permit">{{ __('Archive Permits') }}</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#active-artist">{{ __('Artist List') }}</a></li>
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
                <div class="tab-pane show fade active" id="new-request" role="tabpanel">
                    @include('admin.report.includes.eventPermitIncludes.new_request')
                    {{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
                     @else
                            @empty()
                                 No New Request Permit
                            @endempty
                     @endif --}}
                </div>
                <div class="tab-pane show fade" id="pending-request" role="tabpanel">
                    {{-- @include('admin.artist_permit.includes.summary') --}}
                    @include('admin.report.includes.eventPermitIncludes.pending-permit')
                    {{--  @if(\App\Permit::whereIn('permit_status', ['new', 'modified', 'unprocessed'])->count() > 0)
                     @else
                        @empty()
                           No New Request Permit
                        @endempty
                     @endif --}}
                </div>
                <div class="tab-pane fade" id="processing-permit" role="tabpanel">
                    {{-- @include('admin.artist_permit.includes.summary') --}}
                    @include('admin.report.includes.eventPermitIncludes.processing')
                    {{--  @if(\App\Permit::whereIn('permit_status', ['approved-unpaid', 'modification request', 'processing', 'need approval'])->count() > 0)
                     @else
                            @empty()
                                 No on Proccess permit
                            @endempty
                     @endif --}}
                </div>
                <div class="tab-pane fade" id="active-permit" role="tabpanel">
                    {{-- @include('admin.artist_permit.includes.summary') --}}
                    @include('admin.report.includes.eventPermitIncludes.approved')
                    {{--  @if(\App\Permit::whereIn('permit_status', ['active'])->count() > 0)
                     @else
                            @empty()
                                 No Active permit
                            @endempty
                     @endif --}}
                </div>
                <div class="tab-pane fade" id="archive-permit" role="tabpanel">

                    @include('admin.report.includes.eventPermitIncludes.archive')
                    {{--  @if(\App\Permit::whereIn('permit_status', ['rejected', 'expired'])->count() > 0)
                     @else
                            @empty()
                                 No Expired or Rejected permit
                            @endempty
                     @endif --}}
                </div>
                <div class="tab-pane fade" id="active-artist" role="tabpanel">
                    @include('admin.report.includes.eventPermitIncludes.active-artist')
                    {{--  @if(\App\Artist::where('artist_status', 'active')->count() > 0)
                     @else
                            @empty()
                                 Active artist is empty
                            @endempty
                     @endif --}}
                </div>
                <div class="tab-pane fade kt-hide" id="blocked-artist" role="tabpanel">
                    @include('admin.artist_permit.includes.summary')
                    @include('admin.artist_permit.includes.block-artist')
                    {{-- @if(\App\Artist::where('artist_status', 'blocked')->count() > 0)
                    @else
                           @empty()
                                Blocked artist is empty
                           @endempty
                    @endif --}}
                </div>
            </div>
        </div>

