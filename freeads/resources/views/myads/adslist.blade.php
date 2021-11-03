<div class="p-md-5">
    @auth
    <h5 class="mb-3">Edit my Ads</h5>
    <div class="accordion" id="AdsAccordion">
        @foreach($ads as $ad)
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingAd{{ $ad->id}}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAd{{ $ad->id}}" aria-expanded="true" aria-controls="collapseAd{{ $ad->id}}">
                    <b>{{ $ad->title}}</b> : {{ number_format($ad->price, 2) }} €
                </button>
            </h2>
            <div id="collapseAd{{ $ad->id}}" class="accordion-collapse collapse" aria-labelledby="headingAd{{ $ad->id}}" data-bs-parent="#AdsAccordion">
                <div class="accordion-body">
                    <div>
                        <a href="{{url('/myads/'.$ad->id)}}" class="btn"><i class="bi bi-pencil-square"></i></a>
                        @if($ad->active == 1)
                            <a href="{{url('/myads/disable/'.$ad->id)}}" class="btn"><i class="text-danger bi bi-x-square"></i></a>
                        @else
                            <a href="{{url('/myads/enable/'.$ad->id)}}" class="btn"><i class="text-success bi bi-check-square"></i></i></a>
                        @endif
                    </div>
                    <div>
                        {{ $ad->description }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
        <div class="alert alert-danger">
            <ul>
                You must be registered to post a new ad.
            </ul>
        </div>
    @endauth
</div>