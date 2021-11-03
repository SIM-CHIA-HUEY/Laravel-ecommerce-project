<div class="bg-steelblue">
    <div class="container d-flex flex-row align-items-center p-2">
        <div class="me-auto">
            <a href="/" class="btn">
                <h1><span class='text-light'>Free</span>
                <span class="ms-2 text-duckblue"><i class="align-self-center bi bi-badge-ad-fill"></i></span></h1>
            </a>
        </div>
        @auth
        <div class="d-flex flex-column">
            <a href="/postad" class="btn btn-md btn-outline-light mx-1 border-0">
                <div class="text-center"><i class="bi bi-pin-angle"></i></div>
                <div class="text-center">Post ad</div>
            </a>
        </div>
        @endauth
        <!-- <div class="d-flex flex-column">
            <a href="#" class="btn btn-md btn-outline-light mx-1 border-0">
                <div class="text-center"><i class="bi bi-binoculars"></i></div>
                <div class="text-center">Search</div>
            </a>
        </div> -->
        <div class="d-flex flex-column">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-md btn-outline-light mx-1 border-0" type="submit">
                        <div class="text-center"><i class="bi bi-box-arrow-in-right"></i></div>
                        <div class="text-center">{{ __('Log Out') }}</div>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-md btn-outline-light mx-1 border-0">
                    <div class="text-center"><i class="bi bi-box-arrow-in-right"></i></div>
                    <div class="text-center">Log in/Register</div>
                </a>
            @endauth
        </div>
    </div>
</div>
