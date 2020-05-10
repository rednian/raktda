@if (Auth::check() && (Auth::user()->company->trade_license_expired_date < Carbon\Carbon::now()->addDays(10))
                            && in_array(Auth::user()->company->status, ['active'])
                            )
            <div class="alert alert-warning fade show kt-margin-b-5" role="alert">
                <div class="alert-icon"><i class="flaticon-warning"></i></div>
                @php
                $words = (Auth::user()->company->trade_license_expired_date < \Carbon\Carbon::now()) ?
                    __('already expired') : __('will expire') ; @endphp <div class="alert-text">
                    {{__('Your Business Trade License '.$words.' ')}}
                    <span
                        title="{{Auth::user()->company->trade_license_expired_date->format('d-F-Y') }}"
                        class="text-underline kt-font-bold">{{ humanDate(Auth::user()->company->trade_license_expired_date) }}</span>.
                    <br>
                    {{__('Please update your Business Trade License before the expiry date to avoid inconvenient in applying RAKTDA Services.')}}
            </div>
            <div class="alert-close">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="la la-close"></i></span>
                </button>
            </div>
    </div>
@endif
