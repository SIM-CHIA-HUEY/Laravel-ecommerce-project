<div class="p-5">
    <h5 class="mb-3">Post a new Ad</h5>
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
                Ad posted with success.
            </ul>
        </div>
    @endisset
    <form method="POST" action="postad" enctype="multipart/form-data">
        <!-- Security -->
        @csrf
        <!-- Title input -->
        <input type="text" name="title" class="form-control m-1" placeholder="Ad title" value="{{old('title')}}">
        <!-- Description input -->
        <textarea class="form-control m-1" name="description" aria-label="With textarea" placeholder="Description">{{ old('description')}}</textarea>
        <!-- Category input -->
        <div class="input-group m-1">
            <label class="input-group-text" for="inputGroupSelectCategory">Categories</label>
            <select name="category" class="form-select" id="inputGroupSelectCategory">
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <!-- Price input -->
        <div class="input-group m-1">
            <input type="number" name="price" class="form-control" placeholder="Price" value="{{old('price')}}">
            <span class="input-group-text">€</span>
        </div>
        <!-- Image upload -->
        <div class="input-group m-1">
            <input type="file" name="mainImage" class="form-control" id="inputGroupFile1" value="{{old('mainImage')}}">
            <label class="input-group-text" for="inputGroupFile1">Main picture</label>
        </div>
        <!-- Image 2 upload -->
        <div class="input-group m-1">
            <input type="file" name="image2" class="form-control" id="inputGroupFile2">
            <label class="input-group-text" for="inputGroupFile2">2nd picture</label>
        </div>
        <!-- Image 3 upload -->
        <div class="input-group m-1">
            <input type="file" name="image3" class="form-control" id="inputGroupFile3">
            <label class="input-group-text" for="inputGroupFile3">3rd picture</label>
        </div>
        <!-- Submit button -->
        <button type="submit" class="mt-2 btn btn-duckblue">Submit</button>
    </form>
</div>