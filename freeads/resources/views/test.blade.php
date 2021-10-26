<!doctype html>
<html lang="en" style='height:100%;'>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('./css/style.css')}}">
    <title>Free ads !</title>
  </head>
  <body class='bg-secondary h-100'>
    @isset($number)
        {{ $number }}
    @endisset
    @isset($users)
        @foreach($users as $utilisateur)
            {{ $utilisateur->name }}
        @endforeach
    @endisset
    @isset($test)
        {{ $test }}
    @endisset
      <!-- TOP SCREEN : FIXED -->
        <div class="sticky-top">
            <!-- HEADER -->
            @include('header')
            <!-- SEARCHBAR -->
            @include('searchbar')
            <!-- CATEGORIES -->
            @include('categorybar')
        </div>
        <!-- RESULTS -->
        <div class="container px-4 bg-lightblue">
            <div class="row p-3">
                @include('adcard')
                @include('adcard')
                @include('adcard')
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination m-0 p-3">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link active" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>