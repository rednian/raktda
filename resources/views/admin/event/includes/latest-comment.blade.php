@if ($event->approve()->has('user')->count() > 0)
<?php $approve = $event->approve()->has('user')->first(); ?>
<table class="table table-borderless table-striped border">
    <tbody>
        <tr>
            <td colspan="2" class="kt-font-dark kt-font-transform-u kt-font-bold">Recent Remarks...
                <button type="button" class="kt-pull-right btn btn-sm kt-font-transform-u kt-font-dark btn-secondary">Previous Remarks</button>
            </td>
        </tr>
        <tr>
            <td class="no-wrap kt-margin-p-20">
                {!! defaults($approve->user->NameEn ,$approve->role->NameEn) !!}
            </td>
            <td>
                <div>
                    <h6>
                        <span class="kt-badge kt-badge--success kt-badge--inline kt-margin-r-5">{{ ucfirst($approve->status) }}</span>
                         <span class="kt-notes__desc" data-toggle="kt-tooltip" data-skin="dark" data-placement="top" data-original-title="{{ $approve->created_at->format('F d, Y h:m A') }}">
                    <u>{{ $approve->created_at->format('d-M-Y') }}</u>
                </span>
                    </h6>
                <p>{{ ucfirst($approve->comment->comment) }}</p>        
                </div>
            </td>
        </tr>
    </tbody>
</table>

@endif