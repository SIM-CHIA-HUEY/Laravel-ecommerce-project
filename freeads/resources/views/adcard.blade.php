@if(!is_null(session('viewinline')))
<!-- LINE VIEW -->
    <div class="d-flex flex-column">
        @for($i = (($page-1)*8); $i < ($page * 8); $i++)
            @isset($ads[$i])
            <div class="card mb-1 p-lg-1">
                <div class="d-flex row">
                    <!-- Image box -->
                    <div class="col-5 col-sm-4 col-lg-2 position-relative" style="height: 7rem;">
                        <img src="{{asset($ads[$i]->url)}}" class="img-fluid h-100">
                        <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-duckblue">
                            <i class="bi bi-camera me-1"></i> <small>2</small>
                        </span>
                    </div>
                    <!-- Text box -->
                    <div class="d-flex flex-column col-sm-7 col-5 col-lg-9">
                        <div class="fw-bold">{{ Str::limit($ads[$i]->title, $limit=50, $end = '...') }}</div>
                        <!-- TODO : Location to add -->
                        <div></div>
                        <div><small>{{ Str::limit($ads[$i]->description, $limit = 256, $end = '...') }}</small></div>
                        <div class="fw-bold">{{ number_format($ads[$i]->price, 2) }} €</div>
                    </div>
                    <!-- Like box -->
                    <div class="col-2 col-sm-1">
                        <button type="button" class="btn"><i class="text-danger bi bi-heart"></i></button>
                    </div>
                </div>
            </div>
            @endisset
        @endfor
    </div>
@else
<!-- BOX VIEW -->
    @for($i = (($page-1)*8); $i < ($page * 8); $i++)
        @isset($ads[$i])
        <div class="p-2 col-lg-3 col-md-1 cardad">
            <a href="{{url('category/'.$ads[$i]->category_id)}}" class="card p-0 btn" style="height:15rem;">
                <div class="card-head h-70 d-flex">
                    <div class="h-100 w-100"><img class="card-img-top" src="{{asset($ads[$i]->url)}}" alt="..."></div>
                </div>
                <div class="card-body h-30 p-1 rounded-0 rounded-bottom">
                    <h5 class="card-title h-50" style="font-size:2vh;">{{ Str::upper(Str::limit($ads[$i]->title, $limit = 20, $end = '...')) }}</h5>
                    <p class="card-text h-50">{{ number_format($ads[$i]->price, 2) }} €</p>
                </div>
            </a>
        </div>
        @endisset
    @endfor
@endif