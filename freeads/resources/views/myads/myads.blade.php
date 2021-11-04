@include('head')
    <!-- TOP SCREEN : FIXED -->
    <div class="sticky-top">
        <!-- HEADER -->
        @include('header')
        <!-- SEARCHBAR -->
        @include('searchbar')
        <!-- CATEGORIES -->
        @include('categorybar')
    </div>
    <div class="container px-4 bg-lightblue h-100">
        @isset($view)
            @switch($view)
                @case('form')
                    @include('myads.form')
                    @break
                @case('list')
                    @include('myads.adslist')
                    @break
                @default
                    @include('myads.adslist')
                    @break
            @endswitch
        @else
            @include('myads.adslist')
        @endisset
    </div>
@include('foot')