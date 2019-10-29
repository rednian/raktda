@if ($event->approve()->has('user')->count() > 0)
<?php $approve = $event->approve()->has('user')->first(); ?>
{{-- {{ dd($comment) }} --}}
 <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-comment">
    <div class="card">
        <div class="card-header" id="heading-comment">
            <div class="card-title kt-padding-t-10 kt-padding-b-5" data-toggle="collapse" data-target="#collapse-comment" aria-expanded="true" aria-controls="collapse-comment">
                <h6 class="kt-font-bolder kt-font-transform-u kt-font-dark"> Event latest comment</h6>
            </div>
         </div>
         <div id="collapse-comment" class="collapse show" aria-labelledby="heading-comment" data-parent="#accordion-comment">
            <div class="card-body">
                <table class="table table-striped table-borderless border">
                    <thead>
                        <tr>
                            <th>CHECKED BY</th>
                            <th>REMARKS</th>
                            <th>USER GROUP</th>
                            <th>CHECKED DATE</th>
                            <th>ACTION TAKEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ ucwords($approve->user->NameEn) }}</td>
                            <td>{{ ucfirst($approve->comment->comment) }}</td>
                            <td>{{ ucwords($approve->role->NameEn) }}</td>
                            <td>{{ ucwords($approve->created_at->format('d-M-Y h:m A')) }}</td>
                            <td>{{ ucfirst($approve->status)  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endif