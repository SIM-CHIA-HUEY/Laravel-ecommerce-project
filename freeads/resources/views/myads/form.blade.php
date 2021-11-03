<div class="p-md-5">
    <h5 class="mb-3">Update ad #{{$ads->id}}</h5>
    @auth
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @isset ($success)
        <div class="alert alert-success">
            <ul>
                Ad updated with success.
            </ul>
        </div>
    @endisset
    <form method="POST" action="{{url('/myads')}}" enctype="multipart/form-data">
        <!-- Security -->
        @csrf
        <!-- User secret input -->
        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
        <input type="hidden" name="location" value="{{ Auth::user()->location_id }}">
        <input type="hidden" name="adid" value="{{ $ads->id }}">
        <!-- Title input -->
        <input type="text" name="title" class="form-control m-1" placeholder="Ad title" value="{{ $ads->title }}">
        <!-- Description input -->
        <textarea rows="10" class="form-control m-1" name="description" aria-label="With textarea" placeholder="Description">{{ $ads->description }}</textarea>
        <!-- Category input -->
        <div class="input-group m-1">
            <label class="input-group-text" for="inputGroupSelectCategory">Categories</label>
            <select name="category" class="form-select" id="inputGroupSelectCategory">
                @foreach($categories as $category)
                @if($category->id == $ads->category_id)
                    <option value="{{$ads->category_id}}" selected>{{$category->name}}</option>
                @endif
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- Price input -->
        <div class="input-group m-1">
            <input type="number" name="price" class="form-control" placeholder="Price" value="{{$ads->price}}">
            <span class="input-group-text">€</span>
        </div>
        <!-- Image upload -->
        <!-- <div class="input-group m-1">
            <input type="file" name="mainImage" class="form-control" id="inputGroupFile1" value="{{old('mainImage')}}">
            <label class="input-group-text" for="inputGroupFile1">Main picture</label>
        </div> -->
        <!-- Image 2 upload -->
        <!-- <div class="input-group m-1">
            <input type="file" name="image2" class="form-control" id="inputGroupFile2">
            <label class="input-group-text" for="inputGroupFile2">2nd picture</label>
        </div> -->
        <!-- Image 3 upload -->
        <!-- <div class="input-group m-1">
            <input type="file" name="image3" class="form-control" id="inputGroupFile3">
            <label class="input-group-text" for="inputGroupFile3">3rd picture</label>
        </div> -->
        <!-- Submit button -->
        <button type="submit" class="mt-2 btn btn-duckblue">Submit</button>
    </form>
    @else
        <div class="alert alert-danger">
            <ul>
                You must be registered to post a new ad.
            </ul>
        </div>
    @endauth
</div>