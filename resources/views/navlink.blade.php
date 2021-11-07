<nav aria-label="Page navigation example">
    <ul class="pagination m-0 p-3">
        <li class="page-item">
            <a class="page-link" href="/page/{{ $page - 1}}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i = 0; $i < $number_of_page; $i++)
            @if(($page - 1) == $i)
                <li class="page-item">
                    <a class="page-link active" href="/page/{{$i + 1}}">{{ $i + 1 }}</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="/page/{{$i + 1}}">{{ $i + 1 }}</a>
                </li>
            @endif
        @endfor
        <li class="page-item">
            <a class="page-link" href="/page/{{ $page + 1}}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>