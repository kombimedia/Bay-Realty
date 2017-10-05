<?php
  session_start();
  $title = "Add Listing";
  $metaD = "Admin dashboard page, add listing";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>Add New Listing</h1>
  <!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['dbSuccess'])) { echo $_SESSION['dbSuccess']; unset($_SESSION['dbSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['dbError'])) { echo $_SESSION['dbError']; unset($_SESSION['dbError']); }; ?></div>
  <div id="ajax-message"></div>


    <form class="add-listing-form" method="post" role="form" action="processes/process-add-listing-form.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Property Details</h3>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-4 mb-3">
            <label for="agents">Sales Agent</label>
            <select class="form-control" name="salesAgent" id="type" required value="">
              <option value="" disabled selected>Select</option>
              <option value="00001">Cy</option>
              <option value="00002">Dane</option>
              <option value="00003">Belinda</option>
              <option value="00004">Lily</option>
              <option value="00005">Kobi</option>
              <option value="00006">Celia</option>
              <option value="00007">FAIL</option>
            </select>
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="title">Listing Title</label>
            <input class="form-control wide" name="listingTitle" id="title" placeholder="Inspiring title for your listing" required value="<?php if (isset($_SESSION['storeListingTitle'])) { echo $_SESSION['storeListingTitle']; unset($_SESSION['storeListingTitle']); }; ?>">
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="address">Street Address</label>
            <input class="form-control wide" name="streetAddress" id="address" placeholder="number, street, suburb" required value="<?php if (isset($_SESSION['storeStreetAddress'])) { echo $_SESSION['storeStreetAddress']; unset($_SESSION['storeStreetAddress']); }; ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="city">City</label>
            <select class="form-control" name="city" id="city" required value="">
              <option value="" disabled selected>Select</option>
              <option value="00002">Tauranga</option>
              <option value="00003">Mt Maunganui</option>
              <option value="00004">Papamoa</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="type">Property Type</label>
            <select class="form-control" name="propertyType" id="type" required value="">
              <option value="" disabled selected>Select</option>
              <option value="00001">House</option>
              <option value="00002">Apartment</option>
              <option value="00003">Studio</option>
              <option value="00004">Unit</option>
              <option value="00005">Section</option>
              <option value="00006">Life-style</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="price">Price</label>
            <div class="input-group">
              <span class="input-group-addon" id="price$">$</span>
              <input type="number" class="form-control" name="price" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100000" required value="<?php if (isset($_SESSION['storePrice'])) { echo $_SESSION['storePrice']; unset($_SESSION['storePrice']); }; ?>">
              <span class="input-group-addon">.00</span>
            </div>
            <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="sale-method">Sale Method</label>
            <input type="text" class="form-control wide" name="saleMethod" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender" value="<?php if (isset($_SESSION['storeSaleMethod'])) { echo $_SESSION['storeSaleMethod']; unset($_SESSION['storeSaleMethod']); }; ?>">
            <small id="salehelp" class="form-text text-muted"><b>NOT REQUIRED</b> if you have a set sale price</small>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bedrooms">Bedrooms</label>
            <select class="form-control" name="bedrooms" id="bedrooms" required value="">
              <option value="" disabled selected>Select</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option value="5">5 +</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bed-des">Bedroom Description</label>
            <input class="form-control wide" name="bedDescription" id="bed-des" placeholder="Double bedrooms, double wardrobes" required value="<?php if (isset($_SESSION['storeBedDescription'])) { echo $_SESSION['storeBedDescription']; unset($_SESSION['storeBedDescription']); }; ?>">
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bathrooms">Bathrooms</label>
            <select class="form-control" name="bathrooms" id="bathrooms" required value="">
              <option value="" disabled selected>Select</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option value="5">5 +</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bath-des">Bathroom Description</label>
            <input class="form-control wide" name="bathDescription" id="bath-des" placeholder="Main, ensuite, seperate toilet" required value="<?php if (isset($_SESSION['storeBathDescription'])) { echo $_SESSION['storeBathDescription']; unset($_SESSION['storeBathDescription']); }; ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lounges">Lounges</label>
            <select class="form-control" name="lounges" id="lounges" required value="">
              <option value="" disabled selected>Select</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option value="3">3 +</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lou-des">Lounge Description</label>
            <input class="form-control wide" name="loungeDescription" id="lou-des" placeholder="TV room, family room, rumpus" required value="<?php if (isset($_SESSION['storeLoungeDescription'])) { echo $_SESSION['storeLoungeDescription']; unset($_SESSION['storeLoungeDescription']); }; ?>">
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="garages">Garages</label>
            <select class="form-control" name="garages" id="garages" required value="">
              <option value="" disabled selected>Select</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option value="3">3 +</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="gar-des">Garage Description</label>
            <input class="form-control wide" name="garageDescription" id="gar-des" placeholder="Double, single, workshop" required value="<?php if (isset($_SESSION['storeGarageDescription'])) { echo $_SESSION['storeGarageDescription']; unset($_SESSION['storeGarageDescription']); }; ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="house-sqm">House Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="houseSize" id="house-sqm" aria-describedby="h-sqm" placeholder="180" required value="<?php if (isset($_SESSION['storeHouseSize'])) { echo $_SESSION['storeHouseSize']; unset($_SESSION['storeHouseSize']); }; ?>">
              <span class="input-group-addon" id="h-sqm">sqm</span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="land-sqm">Land Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="landSize" id="land-sqm" aria-describedby="l-sqm" placeholder="800" required value="<?php if (isset($_SESSION['storeLandSize'])) { echo $_SESSION['storeLandSize']; unset($_SESSION['storeLandSize']); }; ?>">
              <span class="input-group-addon" id="l-sqm">sqm</span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="map">Map Co-ordinates</label>
            <input type="text" class="form-control wide" name="mapCoord" id="map" placeholder="41.850, -87.650" required value="<?php if (isset($_SESSION['storeMapCoord'])) { echo $_SESSION['storeMapCoord']; unset($_SESSION['storeMapCoord']); }; ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="col mb-3">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="fListing" type="checkbox" value="1">
                <h5 class="ml-1">Featured Listing</h5>
              </label>
            </div>
          </div>
        </div>
    </div> <!-- listing form div -->

  <!-- Image error/success messages -->
  <div id="return-messages">
    <div><?php if (isset($_SESSION['imageSuccess'])) { echo $_SESSION['imageSuccess']; unset($_SESSION['imageSuccess']); }; ?></div>
    <div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div>
  </div>
  <!-- Image upload tool -->
  <div class="form-row form-inline">
    <div class="col col-lg-6">
      <div class="image-form">
        <h3 class="mb-4">Property Images</h3>
        <label for="file">Upload Property Images</label>
        <small id="p-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted, max size 500MB</small><br>
        <div id="filediv">
          <input class="form-control" name="file[]" type="file" id="file" aria-describedby="p-image-help"/>
        </div>
        <input type="button" id="add_more" class="btn" value="Add Another Image"/>
        <small class="form-text text-muted mt-4">The last image uploaded will be used as your featured image</small>
      </div>
    </div>
  </div>
  <input type="submit" value="Create Listing" name="submit" id="upload" class="btn"/>
</form>

<?php
  include 'includes/dashboard-footer.php';
?>
