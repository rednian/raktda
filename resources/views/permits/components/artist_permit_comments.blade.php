@if($staff_comments)
<div class="kt-scroll border my-3 p-3" data-scroll="true" style="max-height: 100px">
    <h5 class="alert-text px-4 text-danger">{{__('List of Corrections required')}}</h5>
    <ol type="a">
        @foreach ($staff_comments->comments as $sc)
        {{$sc->comment}}
        @endforeach
    </ol>
</div>
@endif