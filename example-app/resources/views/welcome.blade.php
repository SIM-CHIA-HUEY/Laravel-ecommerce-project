<!DOCTYPE html>


@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>This awesome blog has many articles, click the button below to see them</p>
                <br>
                <a href="/blog" class="btn btn-outline-primary">Show Blog</a>
            </div>
        </div>
    </div>
@endsection


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
    </div>
    @include('navlink')
</div>
@include('foot')
