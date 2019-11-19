<div class="modal fade" id="document-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('ARTIST UPLOADED DOCUMENTS') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-borderless table-striped  table-hover border" id="table-document">
                    <thead>
                    <tr>
                        <th>{{ __('DOCUMENT NAME') }}</th>
                        <th>{{ __('ISSUED DATE') }}</th>
                        <th>{{ __('EXPIRED DATE') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-elevate btn-sm" data-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>