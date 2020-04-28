<div class="kt-portlet__head-label w-100">
    <div class="alert alert-info fade show w-100 kt-padding-t-5 kt-padding-l-10 kt-padding-b-5 kt-padding-r-10"
        role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">
            {{-- {{__('Food Truck Fee is AED ').number_format(getSettings()->food_truck_fee,2). __(' per day for each truck')}}{{__(' and should be registered in Ras Al Khaimah')}}
            --}}
            {{trans_choice('messages.truck_fee', getLangId(), ['amount' => number_format(getSettings()->food_truck_fee,2)])}}<br />
            {{ __('If the event has Food Trucks and you don’t have the details as of now, you can proceed ahead without the food trucks. ') }}
        </div>
        <div class="alert-close">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><i
                    class="la la-close"></i></button>
        </div>
    </div>
</div>