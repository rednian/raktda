@component('mail::message')
@if(array_key_exists('title', $data))
# {{ $data['title'] }}
@endif

@if(array_key_exists('content', $data))
{!! $data['content'] !!}
@endif

@if(array_key_exists('button', $data))
@component('mail::button', ['url' => array_key_exists('url', $data) ? $data['url'] : '#' ])
{{ $data['button'] }}
@endcomponent
@endif

@if(array_key_exists('url', $data))
<hr/>
<p>If you’re having trouble clicking the "{{ $data['button'] }}" button, copy and paste the URL below into your web browser: {{ $data['url'] }}</p>
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent