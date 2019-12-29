<div class="modal fade" id="showwarning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Attention')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                {{__('You are trying to apply for event permit which is less than')}}&nbsp;{{$day_count}}
                {{$day_count > 1 ? 'days' : 'day'}}&nbsp;{{__('from today your application will be subject to approval by RAKTDA')}}
            </div>
        </div>
    </div>
</div>