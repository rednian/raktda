<div class="modal fade" id="singlePermitWarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Warning !')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body text-danger kt-font-bolder text-center">
                {{__('You cannot add this artist! Please contact RakTDA')}}
                <div class="text-center">
                    <button class="btn btn-sm btn--yellow btn-wide kt-margin-t-10"
                        data-dismiss="modal">{{__('OK')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>