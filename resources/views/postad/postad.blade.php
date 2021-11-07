@include('head')
    <!-- TOP SCREEN : FIXED -->
    <div class="sticky-top">
        <!-- HEADER -->
        @include('header')
        <div class="bg-light border-bottom">
            <div class="container p-2">
                <h4><i class="bi bi-mailbox2"></i> Post a new Ad</h4>
            </div>
        </div>
    </div>
    <div class="container px-4 bg-lightblue h-100">
        @include('postad.form')
    </div>
@include('foot')