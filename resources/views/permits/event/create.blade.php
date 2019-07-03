@extends('layouts.app')

@section('content')
@component('layouts.subheader')
@slot('heading')
Permits
@endslot
@slot('subheading')
New Event Permit Request
@endslot
@endcomponent

<div class="steps">
    <span class="step active"></span>
    <span class="step "></span>
    <span class="step "></span>
    <span class="step "></span>
    <span class="step "></span>
    <span class="step "></span>
</div>

@endsection
