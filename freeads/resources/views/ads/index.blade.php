@extends('layouts.main')

@section('content')
    <div class="row pb-4">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Manage Ads</h2>
                <p>Admin panel where you can create and edit ads of all the users on Free Ads. To be used wisely.</p>
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
            <th>Price</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($ads as $ad)
            <tr>
                <td><a href="{{ route('ads.show',$ad->id) }}">{{ $ad->title }}</a></td>
                <td>${{ $ad->price }}</td>
                <td>
                    <form action="{{ route('ads.destroy',$ad->id) }}" method="POST">

                        @can('ad-edit')
                            <a class="btn btn-primary" href="{{ route('ads.edit',$ad->id) }}">Edit</a>
                        @endcan

                    </form>
                </td>
            </tr>
        @endforeach

    </table>

    <!-- Pagination (bootstrap) with boot function in AppServiceProvider file -->
    <div class="d-flex justify-content-center">
        {!! $ads->links() !!}
    </div>



@endsection
