@include('head')
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
@include('foot')