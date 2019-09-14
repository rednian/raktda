@if(count($breadcrumbs))
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">
        {{-- <h3 class="kt-subheader__title">{{ $page_title }}</h3> --}}
        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            {{-- <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a> --}}
            {{-- <span class="kt-subheader__breadcrumbs-separator"></span> --}}
            @if(Request::is('admin.dashboard'))
            <a href="{{ route('admin.dashboard') }}" class="kt-subheader__breadcrumbs-link">Dashboard </a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            @endif
            @foreach($breadcrumbs as $breadcrumb)

                @if ($breadcrumb->url && !$loop->last)
                   <a href="{{ $breadcrumb->url }}" class="kt-subheader__breadcrumbs-link">{{ $breadcrumb->title }}</a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                @else
                   <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">{{ $breadcrumb->title }}</span>
             @endif
            @endforeach
        </div>
    </div>
    @if(!Request::is('dashboard'))
    <div class="kt-subheader__toolbar">
        <div class="kt-subheader__wrapper">
            @yield('action')
        </div>
    </div>
    @endif
</div>
@endif
