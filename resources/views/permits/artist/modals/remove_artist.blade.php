<!--begin::Modal-->
<div class="modal fade" id="delartistmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Artist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('company.delete_artist')}}" method="POST">
                    @csrf
                    <p id="warning_text"></p>
                    <input type="hidden" id="del_temp_id" name="del_temp_id" />
                    <input type="hidden" name="del_artist_from" value="renew" />
                    <input type="hidden" name="del_permit_id" id="del_permit_id">
                    <input type="submit" value="Remove"
                        class="btn btn--yellow btn-sm btn-wide kt-font-bold kt-font-transform-u float-right">
                </form>
            </div>
        </div>
    </div>
</div>

<!--end::Modal-->
