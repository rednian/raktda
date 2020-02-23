@if ($event->permit || $event->firm == 'government' || $event->is_truck || $event->is_liquor || $event->comment()->count() > 0)
<div class="alert alert-outline-danger fade show" role="alert">
   <div class="alert-icon"><i class="flaticon-warning"></i></div>
   <div class="alert-text">
      <ul>
         @if ($event->permit)
            <li><a stytle="" class="kt-font-dark" href="{{ route('admin.artist_permit.show', $event->permit->permit_id) }}">This event has an artist with reference number <span class="kt-font-danger">{{ $event->reference_number }}</span></a></li>
         @endif
         @if ($event->firm == 'government')
            <li>This event is for government ...</li>
         @endif
         @if ($event->is_truck)
            <li>This event added a food truck.</li>
         @endif
         @if ($event->is_liquor)
            <li>This event added a liquor.</li>
         @endif
         @if ($event->comment()->count() > 0)
            @php
               $comment = $event->comment()->latest()->first();
            @endphp
            <li class="kt-margin-t-10">
               <span class="kt-font-bold">  Recent Comment <span style="cursor: pointer; " data-original-title="{{$comment->created_at->format('d-F-Y h:i A')}}"  data-toggle="kt-tooltip" data-skin="brand" data-placement="top">{{  $comment->created_at->diffForHumans() }}</span> by {{ ucwords($comment->user->NameEn) }}</span>
               <ul>
                  <li>Action Taken : {!! permitStatus($comment->action) !!}</li>
                  @if ($comment->comment)<li><p>{{ ucfirst($comment->comment) }}</p></li>@endif
               </ul>
            </li>
         @endif
      </ul>
   </div>
   <div class="alert-close">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true"><i class="la la-close"></i></span>
      </button>
   </div>
</div>
@endif
