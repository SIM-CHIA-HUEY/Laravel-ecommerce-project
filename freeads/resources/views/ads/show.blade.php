<?php
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use App\Models\Picture;
?>

@extends('layouts.main')


@section('content')
    <div class="row p-4">
    <div class="col-lg-12 margin-tb p-4" style="border: 1px solid cadetblue">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-4">
                    <h5 style="color: cadetblue"> Show Ad</h5>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 mb-4">
                <div class="form-group">
                    <img src="/images/{{ $picture->url }}" width="200px">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Title:</strong>
                    {{ $ad->title }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Description:</strong>
                    {{ $ad->description }}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Price:</strong>
                    ${{ $ad->price }}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Category:</strong>
                    {{$category->name}}

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Location:</strong>
                    {{ $location->number }}
                    {{ $location->street }},
                    @if(!$location->complement)
                        {{ $location->postcode }}
                        {{ $location->city }} -
                        {{ $location->country }}
                    @else
                        <br>
                        {{ $location->complement }},
                        <br>
                        {{ $location->postcode }}
                        {{ $location->city }} -
                        <br>
                        {{ $location->country }}
                    @endif

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Ad's owner:</strong>
                    {{$author->name}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong style="color: cadetblue">Visibility:</strong>
                    @if($ad->active=1)
                        This ad has been set to public.
                    @else
                        This ad has been set to private.
                    @endif
                </div>
            </div>
        </div>

    </div>
    </div>


@endsection
