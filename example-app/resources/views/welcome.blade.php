<!DOCTYPE html>

    @include('head')

    <!-- TOP SCREEN : FIXED -->
    <div class="sticky-top">

    <!-- HEADER : Logo, buttons of postAds/search/login or logout-->
    @include('header')

    <!-- SEARCHBAR : Looking for... in which location... -->
    @include('searchbar')
    <!-- CATEGORIES : Cars & vehicles, For sale, etc. -->
        @include('categorybar')

    </div>

    <!-- BODY : Results of research (this is a public and private page, no need for protection so it stays here) -->
    <div class="container px-4 bg-lightblue">
        <div class="row p-3">
            @include('adcard')

            @include('layouts.main')

        </div>
        @include('navlink')
    </div>

    <!-- FOOTER -->
    @include('foot')




