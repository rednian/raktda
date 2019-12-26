<div class="modal hide" id="notSaveModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Warning')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="sure_remove_close">
                </button>
            </div>
            <div class="modal-body d-flex justify-content-between">
                <h6 class="text--maroon">{{__('Are you sure to remove the added data')}} ?</h6>
                <input type="hidden" id="fromSection">
                <button class="btn btn-sm btn--yellow" onclick="changeData()">{{__('Ok')}}</button>
            </div>
        </div>
    </div>
</div>

<!--begin::Modal-->