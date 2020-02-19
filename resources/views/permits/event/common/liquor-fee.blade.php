<div class="kt-portlet__head-label w-100">
    <div class="alert alert-info fade show w-100 kt-padding-t-5 kt-padding-l-10 kt-padding-b-5 kt-padding-r-10"
        role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">
            {{__('If Liquor is not provided by Venue,  Liquor Fee is AED ').number_format(getSettings()->liquor_fee,2). __(' Per day')}}
            {{__(' and should be purchased from Ras Al Khaimah.')}}
        </div>
        <div class="alert-close">
            <button class="close" type="button" data-dismiss="alert" aria-label="Close"><i
                    class="la la-close"></i></button>
        </div>
    </div>
</div>