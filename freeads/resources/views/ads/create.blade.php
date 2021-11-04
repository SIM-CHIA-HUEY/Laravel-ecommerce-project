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
                <h2>Add New Ad</h2>
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


    <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" class="form-control" placeholder="Price">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control" placeholder="image">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>

                    <select name="category_id" class="form-select form-select-md mb-1" aria-label="" required>
                        <option selected="selected">
                            Select category
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
                    <input type="text" name="location_id" class="form-control" placeholder="Choose category">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Owner:</strong>
                    <select name="users_id" class="form-select form-select-md" aria-label="" required>
                        <option selected="selected">
                            Select user
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
                               checked>
                        <label for="active">Yes</label>
                    </div>

                    <div>
                        <input type="radio" id="active" name="active" value="0">
                        <label for="active">No</label>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>


@endsection
