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
    <div class="container px-4 bg-lightblue h-100">
        <div class="d-flex flex-row align-items-center">
            <div><a href='/' class='btn'><i class="bi bi-house-door"></i> Home </a></div>
            <div><i class="bi bi-chevron-double-right"></i></div>
            <div><a href="#" class="btn">Cars</a></div>
        </div>
        <div class="row p-3">
            @include('adcard')
        </div>
        @include('navlink')
    </div>
@include('foot')