<div class="modal hide" id="removeLiquorModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Remove Liquor')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body d-flex justify-content-between">
                <h6 class="text--maroon">{{__('Are you sure to remove liquor details ?')}} </h6>
                <form action="{{route('event.liquor.remove')}}" method="POST">
                    @csrf
                    <input type="hidden" name="del_liquor_id" id="del-liquro-id">
                    <input type="hidden" name="del_liquor_event_id" value="{{$event->event_id}}">
                    <input type="submit" class="btn btn-sm btn--yellow" value="{{__('Ok')}}">
                </form>
            </div>
        </div>
    </div>
</div>
