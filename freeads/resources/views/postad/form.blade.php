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
    <form method="POST" action="postad">
        <!-- Security -->
        @csrf
        <!-- Title input -->
        <input type="text" name="title" class="form-control m-1" placeholder="Ad title">
        <!-- Description input -->
        <textarea class="form-control m-1" name="description" aria-label="With textarea" placeholder="Description"></textarea>
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
            <input type="number" name="price" class="form-control" placeholder="Price">
            <span class="input-group-text">€</span>
        </div>
        <button type="submit" class="btn btn-duckblue">Submit</button>
    </form>
</div>