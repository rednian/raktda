@if ($event->approve()->has('user')->count() > 0)
<?php $approve = $event->approve()->has('user')->first(); ?>
<section class="kt-notes kt-scroll kt-padding-l-10 kt-padding-t-10 border alert alert-outline-">
    <div class="kt-notes__items">
        <div class="kt-notes__item kt-padding-b-5">
                    <?php $name = $approve->user->NameEn; $name = explode(' ', $name); $fname = substr($name[0], 0, 1);  $lastname = substr($name[1], 0, 1) ?>
            <div class="kt-notes__media" data-toggle="kt-tooltip" data-skin="dark" data-placement="top" data-original-title="{{ ucwords($approve->user->NameEn) }}">
                <h3 class="kt-notes__user kt-font-boldest">
                    {{ strtoupper($fname) }}{{ strtoupper($lastname) }}
                </h3>
            </div>
            <div class="kt-notes__content">
                <div class="kt-notes__section">
                    <div class="kt-notes__info">
                        <span class="kt-notes__title">
                          {{ ucwords($approve->role->NameEn) }}
                        </span>
                        <span class="kt-badge kt-badge--success kt-badge--inline kt-margin-r-5">{{ ucfirst($approve->status) }}</span>
                        <span class="kt-notes__desc" data-toggle="kt-tooltip" data-skin="dark" data-placement="top" data-original-title="{{ $approve->created_at->format('F d, Y h:m A') }}">
                            <u>{{ $approve->created_at->format('d-M-Y') }}</u>
                        </span>
                    </div>
                </div>
                <span class="kt-notes__body">
                   {{ ucfirst($approve->comment->comment) }}
                </span>
            </div>
        </div>
    </div>
</section>
 {{-- <section class="accordion kt-margin-b-5 accordion-solid accordion-toggle-plus" id="accordion-comment">
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
</section> --}}
@endif