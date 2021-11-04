@foreach($users as $user)
<form method="post" action="/profile">
    @csrf
    <div class="input-group mb-3">
        <label for="username">Username</label>
        <input id="username" type="text" class="form-control" value="{{$user->name}}" name="username">
    </div>
    <fieldset disabled>
        <div class="input-group mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" value="{{$user->email}}" name="email">
        </div>
    </fieldset>
    <div class="input-group mb-3">
        <label for="phone_number">Phone number</label>
        <input id="phone_number" type="number" class="form-control" value="{{$user->phone_number}}" name="phone_number">
    </div>
    <h5 class="mb-3">Your address</h5>

    <div class="input-group mb-3">
        <label for="number">Number</label>
        <input id="number" type="number" class="form-control me-3" value="{{$user->number}}" name="number">
        <label for="street">Street</label>
        <input id="street" type="text" class="form-control" value="{{$user->street}}" name="street">
    </div>
    <div class="input-group mb-3">
        <label for="postcode">Postcode</label>
        <input id="postcode" type="number" class="form-control me-3" value="{{$user->postcode}}" name="postcode">
        <label for="city">City</label>
        <input id="city" type="text" class="form-control" value="{{$user->city}}" name="city">
    </div>
    <div class="input-group mb-3">
        <label for="country">Country</label>
        <input id="country" type="text" class="form-control" value="{{$user->country}}" name="country">
    </div>

    <div class="input-group mb-3">
        <button type="submit" class="btn btn-duckblue">Submit</button>
    </div>
</form>
@endforeach