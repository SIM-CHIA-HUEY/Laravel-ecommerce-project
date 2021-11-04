@extends('layouts.main')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Ads</h2>
            </div>
            <div class="pull-right">
                @can('ad-create')
                    <a class="btn btn-success" href="{{ route('ads.create') }}"> Create New ad</a>
                @endcan
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image text</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($ads as $ad)
            <tr>
                <td>{{ $ad->title }}</td>
                <td>{{ $ad->description }}</td>
                <td>${{ $ad->price }}</td>
                <td>{{ $ad->image }}</td>
                <td><img src="/images/{{ $ad->image }}" width="100px"></td>
                <td>
                    <form action="{{ route('ads.destroy',$ad->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('ads.show',$ad->id) }}">Show</a>
                        @can('ad-edit')
                            <a class="btn btn-primary" href="{{ route('ads.edit',$ad->id) }}">Edit</a>
                        @endcan


                        @csrf
                        @method('DELETE')
                        @can('ad-delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endcan
                    </form>
                </td>
            </tr>
        @endforeach
    </table>





@endsection
