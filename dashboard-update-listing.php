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
  <div><?php if (isset($_SESSION['dbSuccess'])) { echo $_SESSION['dbSuccess']; unset($_SESSION['dbSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['dbError'])) { echo $_SESSION['dbError']; unset($_SESSION['dbError']); }; ?></div>

    <form class="add-listing-form" method="post" role="form" action="processes/process-update-listing.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Current Property Details</h3>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-4 mb-3">
            <label for="agents">Sales Agent</label>
            <select class="form-control" name="updateSalesAgent" id="type" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_agents; ?>
            </select>
          </div>

          <div class="col-12 col-xl-4 mb-3">
            <label for="title">Listing Title</label>
            <input class="form-control wide" name="updateListingTitle" id="title" placeholder="Inspiring title for your listing" required value="<?php echo $listing_title ?>">
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="address">Street Address</label>
            <input class="form-control wide" name="updateStreetAddress" id="address" placeholder="number, street, suburb" required value="<?php echo $address ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="city">City</label>
            <select class="form-control" name="updateCity" id="city" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_city; ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="type">Property Type</label>
            <select class="form-control" name="updatePropertyType" id="type" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_type; ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="price">Price</label>
            <div class="input-group">
              <span class="input-group-addon" id="price$">$</span>
              <input type="number" class="form-control" name="updatePrice" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100000" required value="<?php echo $price ?>">
              <span class="input-group-addon">.00</span>
            </div>
            <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="sale-method">Sale Method</label>
            <input type="text" class="form-control wide" name="updateSaleMethod" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender" value="<?php echo $sell_method ?>">
            <small id="salehelp" class="form-text text-muted"><b>NOT REQUIRED</b> if you have a set sale price</small>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bedrooms">Bedrooms</label>
            <select class="form-control" name="updateBedrooms" id="bedrooms" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_beds ?>
            </select>

          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bed-des">Bedroom Description</label>
            <input class="form-control wide" name="updateBedDescription" id="bed-des" placeholder="Double bedrooms, double wardrobes" required value="<?php echo $bed_des ?>">
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bathrooms">Bathrooms</label>
            <select class="form-control" name="updateBathrooms" id="bathrooms" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_bath ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bath-des">Bathroom Description</label>
            <input class="form-control wide" name="updateBathDescription" id="bath-des" placeholder="Main, ensuite, seperate toilet" required value="<?php echo $bath_des ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lounges">Lounges</label>
            <select class="form-control" name="updateLounges" id="lounges" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_lounge ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lou-des">Lounge Description</label>
            <input class="form-control wide" name="updateLoungeDescription" id="lou-des" placeholder="TV room, family room, rumpus" required value="<?php echo $lounge_des ?>">
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="garages">Garages</label>
            <select class="form-control" name="updateGarages" id="garages" required value="">
              <option value="" disabled>Select</option>
              <?php echo $options_garage ?>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="gar-des">Garage Description</label>
            <input class="form-control wide" name="updateGarageDescription" id="gar-des" placeholder="Double, single, workshop" required value="<?php echo $garage_des ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="house-sqm">House Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="updateHouseSize" id="house-sqm" aria-describedby="h-sqm" placeholder="180" required value="<?php echo $house_size ?>">
              <span class="input-group-addon" id="h-sqm">m<sub>2</sub></span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="land-sqm">Land Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="updateLandSize" id="land-sqm" aria-describedby="l-sqm" placeholder="800" required value="<?php echo $land_size ?>">
              <span class="input-group-addon" id="l-sqm">m<sub>2</sub></span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="map">Map Co-ordinates</label>
            <input type="text" class="form-control wide" name="updateMapCoord" id="map" placeholder="41.850, -87.650" required value="<?php echo $map_co_ords ?>">
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
  <!-- Image error/success messages -->
  <div id="return-messages"> <!-- image upload-->
    <div><?php if (isset($_SESSION['imageSuccess'])) { echo $_SESSION['imageSuccess']; unset($_SESSION['imageSuccess']); }; ?></div>
    <div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div>
  </div>

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
      </div>
    </div>
  </div>
  <input type="submit" value="Update Listing" name="submit" id="upload" class="btn"/>
</form>

<?php
include 'includes/dashboard-footer.php';
?>
