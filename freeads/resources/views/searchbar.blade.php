<div  class="bg-lightblue">
    <div class="">
        <div class="container p-0">
        <!-- Error handler -->
        @if ($errors->any())
            <div class="alert alert-danger p-0 m-0">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
        <form method="post" action="{{url('/search')}}" class="container d-flex flex-row align-items-center p-2" enctype="multipart/form-data">
            <!-- Form -->
            @csrf
            <input type="text" class="form-control mx-2" value="{{old('search')}}" name="search" placeholder="I'm looking for ..."> 
            in <input type="text" class="form-control mx-2" value="{{old('location')}}" name="location" placeholder="Postcode or location"/>
            <button type="submit" class="btn btn-danger mx-2">GO</button>
        </form>
    </div>
</div>