<table class="table  table-hover  table-borderless table-striped border" id="artist-permit-processing">
    <thead>
    <tr>
        <th colspan="6">
            <section class="form-row">
                <div class="col-8">
                    <form class="form-row">
                        <div class="col-4">
                            <div class="input-group input-group-sm">
                                <div class="kt-input-icon kt-input-icon--right">
                                    <input name="report-   new-applied-date" autocomplete="off" type="text"
                                           class="form-control form-control-sm" aria-label="Text input with checkbox"
                                           placeholder="{{ __('APPLIED DATE') }}" id="new-applied-date">
                                    <span class="kt-input-icon__icon kt-input-icon__icon--right">
				  				<span><i class="la la-calendar"></i></span>
				  			</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <select name="report-new-request-type" id="new-request-type"
                                    class="form-control-sm form-control custom-select custom-select-sm "
                                    onchange="processingPermit.draw()">
                                <option selected disabled>{{ __('REQUEST TYPE') }}</option>
                                <option value="new">{{ __('New Application') }}</option>
                                <option value="amend">{{ __('Amend Application') }}</option>
                                <option value="renew">{{ __('Renew Application') }}</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <select name="report-new-request-status" id="new-request-status"
                                    class=" form-control form-control-sm custom-select-sm custom-select"
                                    onchange="processingPermit.draw()">
                                <option disabled selected>{{ __('PERMIT STATUS') }}</option>
                                <option value="new">{{ __('New') }}</option>
                                <option value="modified">{{ __('Amend') }}</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-sm btn-secondary"
                                    id="processing-btn-reset">{{ __('RESET') }}</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <div class="form-group form-group-sm">
                        <div class="kt-input-icon kt-input-icon--right">
                            <input type="search" class="form-control form-control-sm"
                                   placeholder="{{ __('Search') }}..." id="search-processing-request">
                            <span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="la la-search"></i></span>
				</span>
                        </div>
                    </div>
                </div>
            </section>
        </th>
    </tr>
    <tr>
        <th>{{ __('REFERENCE NO.') }}</th>
        <th>{{ __('ESTABLISHMENT NAME') }}</th>
        <th>{{ __('APPLIED DATE') }}</th>
        <th>{{ __('NO. OF ARTIST') }}
            <span data-content="The number of artist that already checked"
                  data-original-title="" data-container="body" data-toggle="kt-popover"
                  data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning"
                  style="font-size:large">
							</span>
        </th>
        <th>{{ __('REQUEST TYPE') }}</th>
        <th>{{ __('PERMIT STATUS') }}</th>
    </tr>
    </thead>
</table>
<style>
    #artist-permit-processing_length {
        display: none;
    }

    #artist-permit-processing_wrapper .dt-buttons {
        background-color: #edeef4;
    }
</style>
