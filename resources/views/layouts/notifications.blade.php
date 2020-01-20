@if($notifications->count() > 0)
@foreach($notifications as $notification)

    <a href="javascript:void(0)" data-id="{{ $notification->id }}" data-url="{{ $notification->data['url'] }}" class="kt-notification__item notification-item">
        <div class="kt-notification__item-icon"> <i
                class="flaticon2-bell-2"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> {!! $notification->data['title'] !!}
            </div>
            <div class="kt-notification__item-time"> {{ humanDate($notification->created_at) }}</div>
        </div>
    </a>

@endforeach
@else
<p class="text-center kt-padding-15">Relax, you're doing well. Notification is empty.</p>
@endif