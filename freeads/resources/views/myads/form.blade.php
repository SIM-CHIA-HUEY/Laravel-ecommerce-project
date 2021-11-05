<div class="p-md-2">
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
            <span class="input-group-text">$</span>
        </div>
        <!-- Image upload -->
        @foreach($pictures as $picture)
            @if($picture->main_picture == 1)
                <div class="input-group m-1">
                    <img src="{{asset($picture->url)}}" class="img-thumbnail" style="height:7rem; width:auto;" alt="Image not found">
                    <input type="file" name="mainImage" class="form-control" id="inputGroupFile1" value="{{old('mainImage')}}">
                    <input type="hidden" name="mainImageId" value="{{$picture->id}}">
                    <label class="input-group-text" for="inputGroupFile1">Main picture</label>
                </div>
            @endif
        @endforeach
        @foreach($pictures as $key => $picture)
            @if($picture->main_picture != 1)
                <div class="input-group m-1">
                    <img src="{{asset($picture->url)}}" class="img-thumbnail" style="height:7rem; width:auto;" alt="Image not found">
                    <input type="file" name="image{{$key+1}}" class="form-control" id="inputGroupFile1" value="{{old('mainImage')}}">
                    <input type="hidden" name="id{{$key+1}}" value="{{$picture->id}}">
                    <label class="input-group-text" for="inputGroupFile1">Picture #{{$key+1}}</label>
                </div>
            @endif
        @endforeach
        @for($newImageForm = count($pictures); $newImageForm < 3; $newImageForm++)
            <div class="input-group m-1">
                <input type="file" name="newImage{{$newImageForm+1}}" class="form-control" id="inputGroupFile1">
            </div>
        @endfor
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