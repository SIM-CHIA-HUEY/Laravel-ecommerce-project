@for($i = (($page-1)*8); $i < ($page * 8); $i++)
    @isset($ads[$i])
    <div class="p-2 col-lg-3 col-md-1 cardad">
        <a href="{{url('category/'.$ads[$i]->category_id)}}" class="card p-0 btn" style="height:15rem;">
            <div class="card-head h-70 d-flex">
                <div class="h-100 w-100"><img class="card-img-top" src="{{asset($ads[$i]->url)}}" alt="..."></div>
            </div>
            <div class="card-body h-30 p-1 rounded-0 rounded-bottom">
                <h5 class="card-title h-50" style="font-size:2vh;">{{ Str::upper(Str::limit($ads[$i]->title, $limit = 25, $end = '...')) }}</h5>
                <p class="card-text h-50">{{ number_format($ads[$i]->price, 2) }} €</p>
            </div>
        </a>
    </div>
    @endisset
@endfor