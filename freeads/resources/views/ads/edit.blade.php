<?php
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
use App\Models\Location;
?>

@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb pt-4 pb-4">
            <div class="pull-left" style="color: cadetblue">
                <h4>Edit your Ad</h4>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('ads.update',$ad->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <img src="/images/{{ $picture->url }}" width="200px"><br>
                    <strong>Change image:</strong> <br>
                    <input type="file" id="image" name="image" class="form-control" placeholder="image">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" value="{{ $ad->title }}" class="form-control" placeholder="Title">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $ad->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" value="{{ $ad->price }}" class="form-control" placeholder="Price">
                </div>
            </div>



            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category_id" class="form-select form-select-md mb-1" aria-label="" required>

                        <option value="{{ $ad->category_id }}" selected="selected">
                            Current : {!! Category::find($ad->category_id)->name  !!}
                        </option>

                        <?php
                        $categories = Category::all();
                        foreach ($categories as $category){ ?>
                        <option value=" <?php echo $category->id;?>"> <?php echo $category->name;?> </option>
                        <?php
                        }
                        ?>

                    </select>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Location:</strong>
                    <input type="text" name="number" value="{{ $location->number }}" class="form-control" placeholder="number">
                    <input type="text" name="street" value="{{ $location->street }}" class="form-control" placeholder="street">
                    <input type="text" name="postcode" value="{{ $location->postcode }}" class="form-control" placeholder="postcode">
                    <input type="text" name="city" value="{{ $location->city }}" class="form-control" placeholder="city">
                    <input type="text" name="country" value="{{ $location->country }}" class="form-control" placeholder="country">

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Owner:</strong>
                    <select name="users_id" class="form-select form-select-md" aria-label="" required>
                        <option value="{{ $ad->users_id }}" selected="selected">
                            Current : {{ $author->name }}
                        </option>
                        <?php
                        $users = User::all();
                        foreach ($users as $user){ ?>
                        <option value=" <?php echo $user->id;?>"> <?php echo $user->name;?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Set public:</strong>

                            <div>
                                <input type="radio" id="active" name="active" value="1"
                                       @if ($ad->active == 1) checked @endif>
                                <label for="is_active">Yes</label>
                            </div>

                            <div>
                                <input type="radio" id="active" name="active" value="0"
                                        @if ($ad->active == 0) checked @endif>
                                <label for="is_active">No</label>
                            </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>
@endsection
