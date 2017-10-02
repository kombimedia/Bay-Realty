<?php
  session_start();
  $title = "Add Listing";
  $metaD = "Admin dashboard page, add listing";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>Add New Listing</h1>
  <div><?php if (isset($_SESSION['dbSuccess'])) { echo $_SESSION['dbSuccess']; unset($_SESSION['dbSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['dbError'])) { echo $_SESSION['dbError']; unset($_SESSION['dbError']); }; ?></div>

  <form class="add-listing-form" method="post" role="form" action="processes/process-add-listing.php" enctype="multipart/form-data">
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

    <div class="form-row form-inline">
      <!-- <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="image3">Upload Featured Image</label>
        <input type="file" class="form-control-file" name="fImage" id="image3" aria-describedby="f-image-help" value="">
        <small id="f-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
      </div> -->
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="p-image">Upload Property Images</label>
        <input id="p-image" name="pImage" type="file" class="file" multiple
    data-show-upload="false" data-show-caption="true" data-msg-placeholder="Select {files} for upload..." aria-describedby="p-image-help" value="">
        <small id="p-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
      </div>
    </div>

    <div class="form-row">
      <div class="col mb-3">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" name="fListing" type="checkbox" value="1">
            Featured Listing
          </label>
        </div>
      </div>
    </div>

    <button type="submit" class="btn" name="submitAddListing">Add Listing</button>
  </form>

<?php
  include 'includes/dashboard-footer.php';
?>
