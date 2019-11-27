@if ($event->permit)
<a href="{{ route('admin.artist_permit.show', $event->permit->permit_id) }}">
  <div class="alert alert-outline-danger alert-bold kt-margin-t-10 kt-margin-b-10" role="alert">
    <div class="alert-text">This event has an artist with reference number <span class="kt-font-danger">{{ $event->permit->reference_number }}</span>
    </div>
  </div>
  </a>
@endif