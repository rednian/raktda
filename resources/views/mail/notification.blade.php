@component('mail::message')
@if(array_key_exists('title', $data))
# {!! $data['title'] !!}
@endif

{{-- <p>Dear Customer,</p> --}}
@if(array_key_exists('content', $data))
{!! $data['content'] !!}
@endif

{{-- {{ dd($data) }} --}}

@if(array_key_exists('button', $data))
@component('mail::button', ['url' => array_key_exists('url', $data) ? $data['url'] : '#' ])
{{ $data['button'] }}
@endcomponent
@endif

@if(array_key_exists('url', $data))
<hr/>
<p style="font-size:12px">If you’re having trouble clicking the "{{ $data['button'] }}" button, copy and paste the URL below into your web browser: {{ $data['url'] }}</p>
@endif

Thank you,<br>
Ras Al Khaimah Tourism Development Authority
@endcomponent
