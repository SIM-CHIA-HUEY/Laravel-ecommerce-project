<div class="offcanvas offcanvas-start" tabindex="-1" id="filters" aria-labelledby="filters">
  <div class="offcanvas-header">
      <!-- Title -->
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Filters</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <!-- Some before text -->
    <div>
      <b>{{ count($ads)}} ads</b> currently displayed.
    </div>
    <!-- Start the form -->
    <form method="post" action="/filters" enctype="multipart/form-data">
        <!-- Security -->
        @csrf
        <!-- Min price -->
        <div class="input-group mb-3">
            <span class="input-group-text">Min price :</span>
            <input type="number" class="form-control" placeholder="0" min="0" name="min_price" value="0">
            <span class="input-group-text">€</span>
        </div>
        <!-- Max price -->
        <div class="input-group mb-3">
            <span class="input-group-text">Max price :</span>
            <input type="number" class="form-control" placeholder="999.999" min="0" name="max_price">
            <span class="input-group-text">€</span>
        </div>
        <!-- Submit button -->
        <button type="submit" class="btn btn-duckblue">Submit</button>
        <!-- Close the form -->
    </form>
  </div>
</div>