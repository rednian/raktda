<div class="modal fade" id="artist_in_permit_exists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('Warning')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearPersonCode()">
                </button>
            </div>
            <div class="modal-body text-danger kt-font-bolder">
                {{__('This artist already exists in the permit')}}
            </div>
        </div>
    </div>
</div>