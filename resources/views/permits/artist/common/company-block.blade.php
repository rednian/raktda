<div class="kt-portlet__head-label px-2 w-100">
    <div class="alert alert-outline-danger fade show w-100" role="alert">
        <div class="alert-icon">
            <i class="flaticon-warning"></i>
        </div>
        <div class="alert-text">
            <div class="kt-scroll" data-scroll="true" style="max-height: 100px">
                <ul>
                    {{__('Your Company is blocked ! The Reason is')}}
                    {{getLangId() == 1 ? check_is_blocked()['comments']->comment_en : check_is_blocked()['comments']->comment_ar}}
                    . <br />
                    {{__('You are not allowed to take any action. Only view is allowed')}}<br />
                    {{__('Please Contact RakTDA Administrator')}}
                </ul>
            </div>
        </div>
    </div>
</div>