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
        @isset($categoryList)
        <div class="d-flex flex-row align-items-center">
            <div><a href='/' class='btn'><i class="bi bi-house-door text-duckblue"></i> Home </a></div>
            <div><i class="bi bi-chevron-right"></i></div>
            @foreach($categoryList as $category)
                <div><a href="/category/{{ $category->id }}" class="btn">{{ $category->name}}</a></div>
                <div><i class="bi bi-chevron-right"></i></div>
            @endforeach
        </div>
        @endisset
        <div class="row p-3">
            @include('adcard')
        </div>
        @include('navlink')
    </div>
@include('foot')