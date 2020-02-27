<!--begin::Modal-->
<div class="modal fade" id="back_btn_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Warning')}} !</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                {{__('Changes you made may not be saved')}}
                <input type="submit" value="{{__('Dont Save')}}" onclick="go_back_confirm_function()"
                    class="btn btn--maroon btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->