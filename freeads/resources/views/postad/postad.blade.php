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
        @include('postad.form')
    </div>
@include('foot')