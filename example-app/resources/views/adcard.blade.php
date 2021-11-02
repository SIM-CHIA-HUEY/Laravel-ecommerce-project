IT WORKS


@foreach($ads as $ad)

    <div class="p-2 col-lg-3 col-md-1 cardad">

        <div class="card p-0 btn" style="height:15rem;">

            <div class="card-head h-70 d-flex">
                <div class="align-self-center"><img class="card-img-top" src="{{asset('./images/car.jpeg')}}" alt="..."></div>
            </div>
            <div class="card-body h-30 p-1 rounded-0 rounded-bottom">
                <h5 class="card-title h-50" style="font-size:2vh;">{{ Str::limit($ad->title, $limit = 25, $end = '...') }}</h5>
                <p class="card-text h-50">{{ number_format($ad->price, 2) }} €</p>
            </div>
        </div>
    </div>
@endforeach
