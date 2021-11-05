@include('head')
<!-- TOP SCREEN : FIXED -->
    <div class="sticky-top">
        <!-- HEADER : Logo, buttons of postAds/search/login or logout-->
    @include('header')

    <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color: cadetblue">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li><a class="nav-link" href="/guser" style="color: white">Manage Users</a></li>
                    <li><a class="nav-link" href="{{ route('ads.index') }}" style="color: white">Manage Ads</a></li>
                </ul>
            </div>
        </div>
    </nav>

    </div>


    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>



<!-- FOOTER -->
@include('foot')
<!-- Admin Menu burger needs these links to work at mobile size -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
