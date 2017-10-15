<?php
  session_start();
  $title = "Update Listing";
  $metaD = "Admin dashboard page, update listing";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
  include 'processes/process-populate-update-listing.php';
?>

<h1>Update Listing</h1>
  <!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['propertiesErrorMessage'])) { echo $_SESSION['propertiesErrorMessage']; unset($_SESSION['propertiesErrorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['agentsErrorMessage'])) { echo $_SESSION['agentsErrorMessage']; unset($_SESSION['agentsErrorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['categoriesErrorMessage'])) { echo $_SESSION['categoriesErrorMessage']; unset($_SESSION['categoriesErrorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['typeErrorMessage'])) { echo $_SESSION['typeErrorMessage']; unset($_SESSION['typeErrorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['featuredImErrorMessage'])) { echo $_SESSION['featuredImErrorMessage']; unset($_SESSION['featuredImErrorMessage']); }; ?></div>


    <form class="add-listing-form" method="post" role="form" action="processes/process-update-listing.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Current Property Details</h3>
        <h5>Listing #<?php echo $listing_id ?></h5>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-4 mb-3">
            <label for="agents">Sales Agent</label>
            <select class="form-control" required name="updateSalesAgent" id="type" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_agents; ?>
            </select>
          </div>

          <div class="col-12 col-xl-4 mb-3">
            <label for="title">Listing Title</label>
            <input class="form-control wide" required name="updateListingTitle" id="title" placeholder="Inspiring title for your listing" value="<?php echo $listing_title ?>">
            <div><?php if (isset($_SESSION['titleError'])) { echo $_SESSION['titleError']; unset($_SESSION['titleError']); }; ?></div>
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="address">Street Address</label>
            <input class="form-control wide" required name="updateStreetAddress" id="address" placeholder="number, street, suburb" value="<?php echo $address ?>">
            <div><?php if (isset($_SESSION['addressError'])) { echo $_SESSION['addressError']; unset($_SESSION['addressError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="city">City</label>
            <select class="form-control" required name="updateCity" id="city" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_city; ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="type">Property Type</label>
            <select class="form-control" required name="updatePropertyType" id="type" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_type; ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="price">Price</label>
            <div class="input-group">
              <span class="input-group-addon" id="price$">$</span>
              <input type="number" class="form-control" required name="updatePrice" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100000" value="<?php echo $price ?>">
              <span class="input-group-addon">.00</span>
            </div>
            <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
            <div><?php if (isset($_SESSION['priceError'])) { echo $_SESSION['priceError']; unset($_SESSION['priceError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="sale-method">Sale Method</label>
            <input type="text" class="form-control wide" name="updateSaleMethod" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender" value="<?php echo $sell_method ?>">
            <small id="salehelp" class="form-text text-muted"><b>NOT REQUIRED</b> if you have a set sale price</small>
            <div><?php if (isset($_SESSION['sMethodError'])) { echo $_SESSION['sMethodError']; unset($_SESSION['sMethodError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bedrooms">Bedrooms</label>
            <select class="form-control" required name="updateBedrooms" id="bedrooms" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_beds ?>
            </select>

          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bed-des">Bedroom Description</label>
            <input class="form-control wide" required name="updateBedDescription" id="bed-des" placeholder="Double bedrooms, double wardrobes" value="<?php echo $bed_des ?>">
            <div><?php if (isset($_SESSION['bedDesError'])) { echo $_SESSION['bedDesError']; unset($_SESSION['bedDesError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bathrooms">Bathrooms</label>
            <select class="form-control" required name="updateBathrooms" id="bathrooms" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_bath ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bath-des">Bathroom Description</label>
            <input class="form-control wide" required name="updateBathDescription" id="bath-des" placeholder="Main, ensuite, seperate toilet" value="<?php echo $bath_des ?>">
            <div><?php if (isset($_SESSION['bathDesError'])) { echo $_SESSION['bathDesError']; unset($_SESSION['bathDesError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lounges">Lounges</label>
            <select class="form-control" required name="updateLounges" id="lounges" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_lounge ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lou-des">Lounge Description</label>
            <input class="form-control wide" required name="updateLoungeDescription" id="lou-des" placeholder="TV room, family room, rumpus" value="<?php echo $lounge_des ?>">
            <div><?php if (isset($_SESSION['loungeDesError'])) { echo $_SESSION['loungeDesError']; unset($_SESSION['loungeDesError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="garages">Garages</label>
            <select class="form-control" required name="updateGarages" id="garages" value="">
              <option value="" disabled>Select</option>
              <?php echo $options_garage ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="gar-des">Garage Description</label>
            <input class="form-control wide" required name="updateGarageDescription" id="gar-des" placeholder="Double, single, workshop" value="<?php echo $garage_des ?>">
            <div><?php if (isset($_SESSION['garageDesError'])) { echo $_SESSION['garageDesError']; unset($_SESSION['garageDesError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="house-sqm">House Size</label>
            <div class="input-group">
              <input type="number" class="form-control" required name="updateHouseSize" id="house-sqm" aria-describedby="h-sqm" placeholder="180" value="<?php echo $house_size ?>">
              <span class="input-group-addon" id="h-sqm">m<sub>2</sub></span>
            </div>
            <div><?php if (isset($_SESSION['hSizeError'])) { echo $_SESSION['hSizeError']; unset($_SESSION['hSizeError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="land-sqm">Land Size</label>
            <div class="input-group">
              <input type="number" class="form-control" required name="updateLandSize" id="land-sqm" aria-describedby="l-sqm" placeholder="800" value="<?php echo $land_size ?>">
              <span class="input-group-addon" id="l-sqm">m<sub>2</sub></span>
            </div>
            <div><?php if (isset($_SESSION['lSizeError'])) { echo $_SESSION['lSizeError']; unset($_SESSION['lSizeError']); }; ?></div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="map">Map Co-ordinates</label>
            <input type="text" class="form-control wide" required name="updateMapCoord" id="map" placeholder="41.850, -87.650" value="<?php echo $map_co_ords ?>">
            <div><?php if (isset($_SESSION['mapCoordError'])) { echo $_SESSION['mapCoordError']; unset($_SESSION['mapCoordError']); }; ?></div>
          </div>
        </div>

        <div class="form-row">
          <div class="col-12 col-xl-6 pl-0 mb-3">
            <label for="description">Property Description</label>
            <textarea class="form-control" id="description" required name="updatePropDes" rows="3" placeholder="Write all the good stuff about your listing here..."><?php echo $prop_des ?></textarea>
            <div><?php if (isset($_SESSION['propDesError'])) { echo $_SESSION['propDesError']; unset($_SESSION['propDesError']); }; ?></div>
          </div>
        </div>

        <div class="form-row">
          <div class="col mb-3">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="updateFListing" type="checkbox" value="1" <?php if($featured_property == "1"){echo 'checked="checked"';} ?>>
                <h5 class="ml-1">Featured Listing</h5>
              </label>
            </div>
          </div>
        </div>
    </div> <!-- listing form div -->

<!-- Update Featured Image -->
<div id="featured-image-form">
    <div class="col pl-0 pr-0">
      <div class="featured-image-form">
          <h3 class="mb-4">Change Featured Image</h3>
          <?php echo $radio_featured_image; ?>
          <small id="" class="form-text text-muted">Select an image to replace the existing featured image</small>
      </div>
    </div>
</div>

  <!-- Image upload tool -->
  <div class="form-row form-inline">
    <div class="col col-lg-6">
      <div class="image-form">
        <h3 class="mb-4">Add More Images</h3>
        <label for="file">Upload Property Images</label>
        <small id="p-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted, max size 500KB</small><br>
        <div id="filediv">
          <input class="form-control" name="file[]" type="file" id="file" aria-describedby="p-image-help"/>
        </div>
        <input type="button" id="add_more" class="btn" value="Add Another Image"/>
        <div><?php if (isset($_SESSION['imgUploadError'])) { echo $_SESSION['imgUploadError']; unset($_SESSION['imgUploadError']); }; ?></div>
        <div><?php if (isset($_SESSION['imgFileError'])) { echo $_SESSION['imgFileError']; unset($_SESSION['imgFileError']); }; ?></div>
        <div><?php if (isset($_SESSION['imgError'])) { echo $_SESSION['imgError']; unset($_SESSION['imgError']); }; ?></div>
        <!-- <div id="return-messages"></div> -->  <!-- Image error messages -->
      </div>
    </div>
  </div>
  <input type="submit" value="Update Listing" name="submit" id="upload" class="btn"/>
</form>

<?php
include 'includes/dashboard-footer.php';
?>
