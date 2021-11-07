@include('head')
    <!-- TOP SCREEN : FIXED -->
    <div class="sticky-top">
        <!-- HEADER -->
        @include('header')
        @isset($ads->id)
        <div  class="bg-lightblue">
            <div class="container">
                <a href="/myads" class="btn"><i class="bi bi-arrow-bar-right"></i> Back to my ads</a>
            </div>
        </div>
        @endisset
        <div class="bg-light border-bottom">
            <div class="container p-2">
                <h4><i class="bi bi-pencil-square"></i> Edit my ads @isset($ads->id)(ad #{{$ads->id}})@endisset</h4>
            </div>
        </div>
    </div>
    <div class="container px-4 bg-lightblue h-100">
        @isset($view)
            @switch($view)
                @case('form')
                    @include('myads.form')
                    @break
                @case('list')
                    @include('myads.adslist')
                    @break
                @default
                    @include('myads.adslist')
                    @break
            @endswitch
        @else
            @include('myads.adslist')
        @endisset
    </div>
@include('foot')