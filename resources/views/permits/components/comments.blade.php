@if($staff_comments)

        <div class="kt-portlet__head-label px-4">
            <div class="alert alert-secondary fade show w-100" role="alert">
                <div class="alert-icon">
                    <i class="flaticon-questions-circular-button"></i>
                </div>
                <div class="alert-text kt-scroll pl-2" >
                    <h5 >{{__('List of Corrections required')}}</h5>
                    <p data-scroll="true" style="max-height: 100px">
                        {{$staff_comments->comment}}
                    </p>
                </div>
            </div>
        </div>

@endif
