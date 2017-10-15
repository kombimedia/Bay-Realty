<?php
  session_start();
  $title = "Add Listing";
  $metaD = "Admin dashboard page, add listing";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
  include 'processes/process-populate-add-listing.php';
?>

  <h1>Add New Listing</h1>
  <!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>

    <form class="add-listing-form" method="post" role="form" action="processes/process-validate-add-listing.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Property Details</h3>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-4 mb-3">
            <label for="agents">Sales Agent</label>
            <select class="form-control" name="salesAgent" id="type" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_agents ?>
              <option value="14">Fail</option>
            </select>
            <div><?php if (isset($_SESSION['agentError'])) { echo $_SESSION['agentError']; unset($_SESSION['agentError']); }; ?></div>
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="title">Listing Title</label>
            <input class="form-control wide" name="listingTitle" id="title" placeholder="Inspiring title for your listing" value="<?php if (isset($_SESSION['storeListingTitle'])) { echo $_SESSION['storeListingTitle']; unset($_SESSION['storeListingTitle']); }; ?>">
            <div><?php if (isset($_SESSION['titleError'])) { echo $_SESSION['titleError']; unset($_SESSION['titleError']); }; ?></div>
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="address">Street Address</label>
            <input class="form-control wide" name="streetAddress" id="address" placeholder="number, street, suburb" value="<?php if (isset($_SESSION['storeStreetAddress'])) { echo $_SESSION['storeStreetAddress']; unset($_SESSION['storeStreetAddress']); }; ?>">
            <div><?php if (isset($_SESSION['addressError'])) { echo $_SESSION['addressError']; unset($_SESSION['addressError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="city">City</label>
            <select class="form-control" name="city" id="city" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_city ?>
            </select>
            <div><?php if (isset($_SESSION['cityError'])) { echo $_SESSION['cityError']; unset($_SESSION['cityError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="type">Property Type</label>
            <select class="form-control" name="propertyType" id="type" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_type ?>
            </select>
            <div><?php if (isset($_SESSION['typeError'])) { echo $_SESSION['typeError']; unset($_SESSION['typeError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="price">Price</label>
            <div class="input-group">
              <span class="input-group-addon" id="price$">$</span>
              <input type="number" class="form-control" name="price" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100000" value="<?php if (isset($_SESSION['storePrice'])) { echo $_SESSION['storePrice']; unset($_SESSION['storePrice']); }; ?>">
              <span class="input-group-addon">.00</span>
            </div>
            <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
            <div><?php if (isset($_SESSION['priceError'])) { echo $_SESSION['priceError']; unset($_SESSION['priceError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="sale-method">Sale Method</label>
            <input type="text" class="form-control wide" name="saleMethod" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender" value="<?php if (isset($_SESSION['storeSaleMethod'])) { echo $_SESSION['storeSaleMethod']; unset($_SESSION['storeSaleMethod']); }; ?>">
            <small id="salehelp" class="form-text text-muted"><b>NOT REQUIRED</b> if you have a set sale price</small>
            <div><?php if (isset($_SESSION['sMethodError'])) { echo $_SESSION['sMethodError']; unset($_SESSION['sMethodError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bedrooms">Bedrooms</label>
            <select class="form-control" name="bedrooms" id="bedrooms" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_beds ?>
            </select>
            <div><?php if (isset($_SESSION['bedError'])) { echo $_SESSION['bedError']; unset($_SESSION['bedError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bed-des">Bedroom Description</label>
            <input class="form-control wide" name="bedDescription" id="bed-des" placeholder="Double bedrooms, double wardrobes" value="<?php if (isset($_SESSION['storeBedDescription'])) { echo $_SESSION['storeBedDescription']; unset($_SESSION['storeBedDescription']); }; ?>">
            <div><?php if (isset($_SESSION['bedDesError'])) { echo $_SESSION['bedDesError']; unset($_SESSION['bedDesError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bathrooms">Bathrooms</label>
            <select class="form-control" name="bathrooms" id="bathrooms" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_bath ?>
            </select>
            <div><?php if (isset($_SESSION['bathError'])) { echo $_SESSION['bathError']; unset($_SESSION['bathError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bath-des">Bathroom Description</label>
            <input class="form-control wide" name="bathDescription" id="bath-des" placeholder="Main, ensuite, seperate toilet" value="<?php if (isset($_SESSION['storeBathDescription'])) { echo $_SESSION['storeBathDescription']; unset($_SESSION['storeBathDescription']); }; ?>">
            <div><?php if (isset($_SESSION['bathDesError'])) { echo $_SESSION['bathDesError']; unset($_SESSION['bathDesError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lounges">Lounges</label>
            <select class="form-control" name="lounges" id="lounges" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_lounge ?>
            </select>
            <div><?php if (isset($_SESSION['loungeError'])) { echo $_SESSION['loungeError']; unset($_SESSION['loungeError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lou-des">Lounge Description</label>
            <input class="form-control wide" name="loungeDescription" id="lou-des" placeholder="TV room, family room, rumpus" value="<?php if (isset($_SESSION['storeLoungeDescription'])) { echo $_SESSION['storeLoungeDescription']; unset($_SESSION['storeLoungeDescription']); }; ?>">
            <div><?php if (isset($_SESSION['loungeDesError'])) { echo $_SESSION['loungeDesError']; unset($_SESSION['loungeDesError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="garages">Garages</label>
            <select class="form-control" name="garages" id="garages" value="">
              <option value="" disabled selected>Select</option>
              <?php echo $option_garage ?>
            </select>
            <div><?php if (isset($_SESSION['garageError'])) { echo $_SESSION['garageError']; unset($_SESSION['garageError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="gar-des">Garage Description</label>
            <input class="form-control wide" name="garageDescription" id="gar-des" placeholder="Double, single, workshop" value="<?php if (isset($_SESSION['storeGarageDescription'])) { echo $_SESSION['storeGarageDescription']; unset($_SESSION['storeGarageDescription']); }; ?>">
            <div><?php if (isset($_SESSION['garageDesError'])) { echo $_SESSION['garageDesError']; unset($_SESSION['garageDesError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="house-sqm">House Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="houseSize" id="house-sqm" aria-describedby="h-sqm" placeholder="180" value="<?php if (isset($_SESSION['storeHouseSize'])) { echo $_SESSION['storeHouseSize']; unset($_SESSION['storeHouseSize']); }; ?>">
              <span class="input-group-addon" id="h-sqm">m<sub>2</sub></span>
            </div>
            <div><?php if (isset($_SESSION['hSizeError'])) { echo $_SESSION['hSizeError']; unset($_SESSION['hSizeError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="land-sqm">Land Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="landSize" id="land-sqm" aria-describedby="l-sqm" placeholder="800" value="<?php if (isset($_SESSION['storeLandSize'])) { echo $_SESSION['storeLandSize']; unset($_SESSION['storeLandSize']); }; ?>">
              <span class="input-group-addon" id="l-sqm">m<sub>2</sub></span>
            </div>
            <div><?php if (isset($_SESSION['lSizeError'])) { echo $_SESSION['lSizeError']; unset($_SESSION['lSizeError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="map">Map Co-ordinates</label>
            <input type="text" class="form-control wide" name="mapCoord" id="map" placeholder="41.850, -87.650" value="<?php if (isset($_SESSION['storeMapCoord'])) { echo $_SESSION['storeMapCoord']; unset($_SESSION['storeMapCoord']); }; ?>">
            <div><?php if (isset($_SESSION['mapCoordError'])) { echo $_SESSION['mapCoordError']; unset($_SESSION['mapCoordError']); }; ?></div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-xl-6 pl-0 mb-3">
            <label for="description">Property Description</label>
            <textarea class="form-control" id="description" name="propDes" rows="3" placeholder="Write all the good stuff about your listing here..."><?php if (isset($_SESSION['storeListingDescription'])) { echo $_SESSION['storeListingDescription']; unset($_SESSION['storeListingDescription']); }; ?></textarea>
            <div><?php if (isset($_SESSION['propDesError'])) { echo $_SESSION['propDesError']; unset($_SESSION['propDesError']); }; ?></div>
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

  <!-- Image upload tool -->
  <div class="form-row form-inline">
    <div class="col col-lg-6">
      <div class="image-form">
        <h3 class="mb-4">Property Images</h3>
        <label for="file">Upload Property Images</label>
        <small id="p-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted, max size 500KB</small><br>
        <div id="filediv">
          <input class="form-control" name="file[]" type="file" id="file" aria-describedby="p-image-help"/>
        </div>
        <input type="button" id="add_more" class="btn" value="Add Another Image"/>
        <small class="form-text text-muted mt-4">The last image uploaded will be used as your featured image</small>
        <div><?php if (isset($_SESSION['imgUploadError'])) { echo $_SESSION['imgUploadError']; unset($_SESSION['imgUploadError']); }; ?></div>
        <div><?php if (isset($_SESSION['imgFileError'])) { echo $_SESSION['imgFileError']; unset($_SESSION['imgFileError']); }; ?></div>
        <div><?php if (isset($_SESSION['imgErrorr'])) { echo $_SESSION['imgErrorr']; unset($_SESSION['imgErrorr']); }; ?></div>
        <!-- <div id="return-messages"></div> -->  <!-- Image error messages -->
      </div>
    </div>
  </div>
  <input type="submit" value="Create Listing" name="submit" id="upload" class="btn"/>
</form>

<?php
  include 'includes/dashboard-footer.php';
?>
