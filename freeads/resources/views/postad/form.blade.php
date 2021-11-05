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
                Ad posted with success.
            </ul>
        </div>
    @endisset
    <form method="POST" action="postad" enctype="multipart/form-data">
        <!-- Security -->
        @csrf
        <!-- User secret input -->
        <input type="hidden" name="userid" value="{{ Auth::user()->id }}">
        <input type="hidden" name="location" value="{{ Auth::user()->location_id }}">
        <!-- Title input -->
        <input type="text" name="title" class="form-control m-1" placeholder="Ad title" value="{{old('title')}}">
        <!-- Description input -->
        <textarea rows="10" class="form-control m-1" name="description" aria-label="With textarea" placeholder="Description">{{ old('description')}}</textarea>
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
            <input type="number" step="any" min="0" name="price" class="form-control" placeholder="Price" value="{{old('price')}}">
            <span class="input-group-text">$</span>
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
        <!-- Adress box -->
        <div class="input-group m-1">
            <label class="input-group-text" for="inputGroupSelectAddress">Address</label>
            <select name="address" class="form-select" id="inputGroupSelectAddress">
                <option value="myaddress" selected>My address [{{$user_address->number}} {{$user_address->street}}, {{$user_address->postcode}} {{$user_address->city}} ({{$user_address->country}})]</option>
                <option value="newaddress">new address [Please fill the form below]</option>
            </select>
        </div>
        <div class="input-group m-1">
            <input type="number" name="number" class="form-control m-1" placeholder="Number" value="{{old('number')}}">
            <input type="text" name="street" class="form-control m-1" placeholder="Street" value="{{old('street')}}">
            <input type="number" name="postcode" class="form-control m-1" placeholder="Postcode" value="{{old('postcode')}}">
            <input type="text" name="city" class="form-control m-1" placeholder="City" value="{{old('street')}}">
            <input type="text" name="country" class="form-control m-1" placeholder="Country" value="{{old('country')}}">
        </div>
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