<?php
use App\Models\Ad;
use App\Models\Category;
use App\Models\User;
?>

@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Ad</h2>
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


    <form action="{{ route('ads.update',$ad->id) }}" method="POST">
        @csrf
        @method('PUT')


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="title" value="{{ $ad->title }}" class="form-control" placeholder="Name">
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
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                    <img src="/image/{{ $ad->image }}" width="300px">
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
                    <input type="text" name="location_id" value="{{ $ad->location_id }}" class="form-control" placeholder="Choose category">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Owner:</strong>
                    <select name="user_id" class="form-select form-select-md" aria-label="" required>
                        <option value="{{ $ad->user_id }}" selected="selected">
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
                                <input type="radio" id="is_active" name="is_active" value="1"
                                       @if ($ad->is_active = 1) checked @endif>
                                <label for="is_active">Yes</label>
                            </div>

                            <div>
                                <input type="radio" id="is_active" name="is_active" value="0"
                                        @if ($ad->is_active = 0) checked @endif>
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
