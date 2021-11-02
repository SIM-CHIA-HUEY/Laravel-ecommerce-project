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
    <div class="container px-md-4 bg-lightblue">
        @isset($categoryList)
        <div class="d-flex flex-row align-items-center">
            <div><a href='/' class='btn'><i class="bi bi-house-door text-duckblue"></i> Dashboard </a></div>
            <div><i class="bi bi-chevron-right"></i></div>
            @foreach($categoryList as $category)
                <div><a href="/category/{{ $category->id }}" class="btn">{{ $category->name}}</a></div>
                <div><i class="bi bi-chevron-right"></i></div>
            @endforeach
        </div>
        @endisset
        <div class="row p-md-3">
            @include('filters')
            @include('adcard')
        </div>
        @include('navlink')
    </div>
@include('foot')