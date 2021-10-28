<div  class="bg-lightblue">
    <div class="">
        <form method="post" action="{{url('/search')}}" class="container d-flex flex-row align-items-center p-2">
            @csrf
            <input type="text" class="form-control mx-2" name="search" placeholder="I'm looking for ..." required> 
            in <input type="text" class="form-control mx-2" name="location" placeholder="Postcode or location"/>
            <button type="submit" class="btn btn-danger mx-2">GO</button>
        </form>
    </div>
</div>