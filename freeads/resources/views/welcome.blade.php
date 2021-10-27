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
    <!-- RESULTS -->
    <div class="container px-4 bg-lightblue">
        <div class="row p-3">
            @include('adcard')
            @include('adcard')
            @include('adcard')
        </div>
        @include('navlink');
    </div>
@include('foot')