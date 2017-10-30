

<?php
include 'processes/process-populate-search-listing.php'
?>



<div class="container-fluid search-form-outer">
  <div class="container search-form-inner">
      <form action="category.php" method="post" role="form" class="search-form">
        <div class="form-row mb-2 mt-4">
          <div class="col">
            <input name="search_bar" type="text" maxlength="88" class="form-control" id="search-input" placeholder="Search word or phrase" >
          </div>
        </div>
        <div class="form-row form-inline mb-2">
          <div class="col">
            <select name="city" class="form-control" id="search-area">
              <option value="" disabled selected>Area</option>
              <?php echo $option_city ?>
            </select>
          </div>

          <div class="col">
            <select name="type" class="form-control" id="search-type">
              <option value="" disabled selected>Type</option>
              <?php echo $option_type ?>
            </select>
          </div>
        </div>

        <!-- <div class="form-row form-inline">
          <div class="col-6 col-xl-2">
            <select class="form-control mb-2" id="search-price-from">
              <option value="" disabled selected>Price from</option>
              <option>Any</option>
              <option>$350,000</option>
              <option>$450,000</option>
              <option>$550,000</option>
              <option>$650,000</option>
              <option>$750,000</option>
              <option>$850,000</option>
              <option>$950,000</option>
              <option>$1,500,000</option>
              <option>$2,500,000 +</option>
            </select>
          </div>

          <div class="col-6 col-xl-2">
            <select class="form-control mb-2" id="search-price-to">
              <option value="" disabled selected>Price to</option>
              <option>Any</option>
              <option>$450,000</option>
              <option>$550,000</option>
              <option>$650,000</option>
              <option>$750,000</option>
              <option>$850,000</option>
              <option>$950,000</option>
              <option>$1,500,000</option>
              <option>$2,500,000 +</option>
            </select>
          </div>

          <div class="col-6 col-xl-2">
              <select class="form-control mb-2" id="search-bedrooms-from">
                <option value="" disabled selected>Beds from</option>
                <option>any</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5 +</option>
              </select>
          </div>

          <div class="col-6 col-xl-2">
              <select class="form-control mb-2" id="search-bedrooms-to">
                <option value="" disabled selected>Beds to</option>
                <option>any</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5 +</option>
              </select>
          </div>

          <div class="col-6 col-xl-2">
              <select class="form-control mb-2" id="search-bath-from">
                <option value="" disabled selected>Bath from</option>
                <option>any</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5 +</option>
              </select>
          </div>

          <div class="col-6 col-xl-2">
              <select class="form-control mb-2" id="search-bedrooms-to">
                <option value="" disabled selected>Beds to</option>
                <option>any</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5 +</option>
              </select>
          </div>
        </div> -->
        <button name= "submit_search" type="submit" class="btn">Search for Homes!</button>
      </form>
  </div>
</div>




