

<?php


?>




<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="text" name="searchquery" placeholder="search database">
    <select name="filter1">
     <option value="Whole site">Whole site</option> 
    <option value="properties">properties</option>
  </select>
  <input type="submit" name="myBtn" >

</form>


<div class="container-fluid search-form-outer">
  <div class="container search-form-inner">
      <form class="search-form">
        <div class="form-row mb-2 mt-4">
          <div class="col">
            <input name="search-bar" type="text" class="form-control" id="search-input" placeholder="location, keyword, property ID">
          </div>
        </div>
        <div class="form-row form-inline mb-2">
          <div class="col">
            <select class="form-control" id="search-area">
              <option value="" disabled selected>Area</option>
              <option>Tauranga</option>
              <option>Mt Maunganui</option>
              <option>Papamoa</option>
            </select>
          </div>

          <div class="col">
            <select class="form-control" id="search-type">
              <option value="" disabled selected>Type</option>
              <option>House</option>
              <option>Apartment</option>
              <option>Studio</option>
              <option>Unit</option>
              <option>Section</option>
              <option>Life-style</option>
            </select>
          </div>
        </div>

        <div class="form-row form-inline">
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
        </div>
        <button name= "submit-search" type="submit" class="btn">Search for Homes!</button>
      </form>
  </div>
</div>




