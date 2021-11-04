<div class="bg-steelblue">
    <div class="container d-flex flex-row align-items-center p-2">
        <div class="me-auto">
            <a href="/" class="btn">
                <h1><span class='text-light'>Free</span>
                <span class="ms-2 text-duckblue"><i class="align-self-center bi bi-badge-ad-fill"></i></span></h1>
            </a>
        </div>
        <div class="d-flex flex-column">
            <a href="/" class="btn btn-md btn-outline-light mx-1 border-0">
                <div class="text-center"><i class="bi bi-house-door"></i></div>
                <div class="text-center">Home</div>
            </a>
        </div>
        @auth
        <div class="dropdown">
            <a class="btn btn-outline-light border-0 dropdown-toggle" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <div class="text-center"><i class="bi bi-hdd-network"></i></div>
                {{Auth::user()->name}}
            </a>

            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="/postad">Post ad</a></li>
                <li><a class="dropdown-item" href="/myads">My ads</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="/profile">My profile</a></li>
                <li><a class="dropdown-item" href="/guser">Admin</a></li>
            </ul>
        </div>
        @endauth
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
