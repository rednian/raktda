@if($staff_comments)
<div class="kt-portlet kt-portlet--mobile" style="z-index:1;">
    <div class="kt-portlet__head kt-portlet__head--sm kt-portlet__head--noborder">
        <div class="kt-portlet__head-label mt-4 px-2 w-100">
            <div class="alert alert-outline-danger fade show w-100" role="alert">
                <div class="alert-icon">
                    <i class="flaticon-warning"></i>
                </div>
                <div class="alert-text">
                    <h5 class="alert-text">{{__('List of Corrections required')}}</h5>
                    <div class="kt-scroll" data-scroll="true" style="max-height: 100px">
                        <ol type="a">
                            {{$staff_comments->comment}}
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif