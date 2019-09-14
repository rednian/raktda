<div class="kt-subheader   kt-grid__item" id="kt_subheader">
    <div class="kt-subheader__main">

        <h3 class="kt-subheader__title">
            {{$heading}}</h3>

        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="{{ isset($subheadingLink) ? $subheadingLink : ''}}" class="kt-subheader__breadcrumbs-link">
                {{$subheading}} </a>
            @isset($subSubHeading)
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="" class="kt-subheader__breadcrumbs-link">{{$subSubHeading}}</a>
            @endisset
        </div>
    </div>
</div>
