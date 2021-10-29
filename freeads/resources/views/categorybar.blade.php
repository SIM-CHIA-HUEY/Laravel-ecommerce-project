<div class="bg-light border-bottom">
    <div class="accordion" id="accordionExample">
        <div class="container d-flex flex-row flex-wrap categories">
            <div class="flex-fill text-center category">
                <button class="btn btn-duckblue" type="button" data-bs-toggle="offcanvas" data-bs-target="#filters" aria-controls="filters">
                Filters
                </button>
            </div>
            <i class="align-self-center sbi bi-three-dots-vertical"></i>
            @foreach($categories as $rootCategory)
                @if($rootCategory->parent_id == NULL)
                <div class="flex-fill text-center category">
                    <a class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$rootCategory->id}}" aria-expanded="true" aria-controls="collapse{{$rootCategory->id}}">
                        {{ $rootCategory->name }}
                    </a>
                </div>
                <i class="align-self-center sbi bi-three-dots-vertical"></i>
                @endif
            @endforeach
        </div>
        @foreach($categories as $rootCategory)
            @if($rootCategory->parent_id == NULL)
                <div id="collapse{{$rootCategory->id}}" class="accordion-collapse collapse container p-3" aria-labelledby="heading{{$rootCategory->id}}" data-bs-parent="#accordionExample">
                    <div class="row">
                    @foreach($categories as $subCategory)
                        @if($subCategory->parent_id == $rootCategory->id)
                            <div class="col-lg-4">
                                <a href="/category/{{$subCategory->id}}" class="btn">{{$subCategory->name}}</a>
                            </div>
                        @endif
                    @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>