
<table class="table  table-hover  table-borderless table-striped border" id="artist-permit-rejected">
	 <thead>

     <tr><th colspan="6"><section class="form-row">
                 <div class="col-8">
                     <form class="form-row">
                         <div class="col-4">
                             <div class="input-group input-group-sm">
                                 <div class="kt-input-icon kt-input-icon--right">
                                     <input type="text" class="form-control form-control-sm" aria-label="Text input with checkbox" placeholder="{{ __('APPLIED DATE') }}" id="archive-applied-date" >
                                     <span class="kt-input-icon__icon kt-input-icon__icon--right">
				  				<span><i class="la la-calendar"></i></span>
				  			</span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-3">
                             <select name="" id="archive-request-type" class="form-control-sm form-control custom-select custom-select-sm " onchange="archivePermit.draw()" >
                                 <option selected disabled >{{ __('REQUEST TYPE') }}</option>
                                 <option value="new">{{ __('New Application') }}</option>
                                 <option value="amend">{{ __('Amend Application') }}</option>
                                 <option value="renew">{{ __('Renew Application') }}</option>
                             </select>
                         </div>
                         <div class="col-3">
                             <select  name="" id="archive-permit-status" class=" form-control form-control-sm custom-select-sm custom-select" onchange="archivePermit.draw()">
                                 <option disabled selected>{{ __('PERMIT STATUS') }}</option>
                                 <option value="expired">{{ __('Expired') }}</option>
                                 <option value="rejected">{{ __('Rejected') }}</option>
                                 <option value="unprocessed">{{ __('Unprocessed') }}</option>
                             </select>
                         </div>
                         <div class="col-2">
                             <button type="button" class="btn btn-sm btn-secondary" id="archive-btn-reset">{{ __('RESET') }}</button>
                         </div>
                     </form>
                 </div>
                 <div class="col-md-4">
                     <div class="form-group form-group-sm">
                         <div class="kt-input-icon kt-input-icon--right">
                             <input type="search" class="form-control form-control-sm" placeholder="{{ __('Search') }}..." id="search-archive-request">
                             <span class="kt-input-icon__icon kt-input-icon__icon--right">
					<span><i class="la la-search"></i></span>
				</span>
                         </div>
                     </div>
                 </div>
             </section></th></tr>
	 <tr>
			<th>{{ __('REFERENCE NO.') }}</th>
			<th>{{ __('ESTABLISHMENT NAME') }}</th>
			<th>{{ __('APPLIED DATE') }}</th>
			<th>{{ __('NO. OF ARTIST') }}
				 <span data-content="The number of artist that already checked"
							 data-original-title="" data-container="body" data-toggle="kt-popover"
							 data-placement="top" class="la la-question-circle kt-font-bold kt-font-warning" style="font-size:large">
							</span>
			</th>
			<th>{{ __('REQUEST TYPE') }}</th>
			<th>{{ __('PERMIT STATUS') }}</th>
	 </tr>
	 </thead>
</table>
<style>
    #artist-permit-rejected_length{
        display: none;
    }

    #artist-permit-rejected_wrapper .dt-buttons{
        background-color: #edeef4;
    }
</style>
