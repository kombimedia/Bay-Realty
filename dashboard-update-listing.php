<?php
  session_start();
  $title = "Update Listing";
  $metaD = "Admin dashboard page, update listing";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

<h1>Update Listing</h1>
  <!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['dbSuccess'])) { echo $_SESSION['dbSuccess']; unset($_SESSION['dbSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['dbError'])) { echo $_SESSION['dbError']; unset($_SESSION['dbError']); }; ?></div>

<?php
$listing_id = $_GET['listing_id'];
$_SESSION["update_listing_id"] = $listing_id;
$getData = "SELECT agents, title, address, categories, type, price, sell_method, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property
            FROM properties
            WHERE listing_id = $listing_id";
    $result = $mysqli->query($getData);
    // Check if there are any records to show
    if ($result->num_rows > 0) {
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {
            // Get data for the 'select lists' to dynamically build each list with the saved option preselected
            $options_agents = "";
            $getData1 = "SELECT agent_id, first_name, surname
                         FROM agents";
              $result1 = $mysqli->query($getData1);
                  // Loop through data and output each row
                  while($row1 = $result1->fetch_array()) {
                      $agent_name = $row1['first_name'] . " " . $row1['surname'];
                      // compare the stored value from the properties table to that of the agents table. If there is a match add the 'selected' tag to that option
                      if ($row['agents'] == $row1['agent_id']) {
                          $options_agents = $options_agents . "<option selected value='$row1[agent_id]'>$agent_name</option>";
                            // if the stored value does not match the value in the agents table create an option with no 'selected' tag
                            } else {
                              $options_agents = $options_agents . "<option value='$row1[agent_id]'>$agent_name</option>";
                              }
                        }

            $options_city = "";
            $getData2 = "SELECT *
                         FROM categories";
              $result2 = $mysqli->query($getData2);
                  // Loop through data and output each row
                  while($row2 = $result2->fetch_array()) {
                      // compare the stored value from the properties table to that of the categories table. If there is a match add the 'selected' tag to that option
                      if ($row['categories'] == $row2['cat_id']) {
                          $options_city = $options_city . "<option selected value='$row2[cat_id]'>$row2[city]</option>";
                            // if the stored value does not match the value in the categories table create an option with no 'selected' tag
                            } else {
                              $options_city = $options_city . "<option value='$row2[cat_id]'>$row2[city]</option>";
                              }
                        }

            $options_type = "";
            $getData3 = "SELECT *
                         FROM property_type";
              $result3 = $mysqli->query($getData3);
                  // Loop through data and output each row
                  while($row3 = $result3->fetch_array()) {
                      // compare the stored value from the properties table to that of the type table. If there is a match add the 'selected' tag to that option
                      if ($row['type'] == $row3['pt_id']) {
                          $options_type = $options_type . "<option selected value='$row3[pt_id]'>$row3[type]</option>";
                            // if the stored value does not match the value in the type table create an option with no 'selected' tag
                            } else {
                              $options_type = $options_type . "<option value='$row3[pt_id]'>$row3[type]</option>";
                              }
                        }

            $options_beds = "";
            for($i = 0; $i <= 5; $i++) {
                if ($row['bed_no'] == $i) {
                    $options_beds = $options_beds . "<option selected value='$row[bed_no]'>$row[bed_no]</option>";
                      // if the stored value does not match the value in the type table create an option with no 'selected' tag
                      } elseif ($i == 5) {
                          $options_beds = $options_beds . "<option value='$i'>$i +</option>";
                          } else {
                            $options_beds = $options_beds . "<option value='$i'>$i</option>";
                          }
                    }

            $options_bath = "";
            for($i = 0; $i <= 5; $i++) {
                if ($row['bath_no'] == $i) {
                    $options_bath = $options_bath . "<option selected value='$row[bath_no]'>$row[bath_no]</option>";
                      // if the stored value does not match the value in the type table create an option with no 'selected' tag
                       } elseif ($i == 5) {
                          $options_bath = $options_bath . "<option value='$i'>$i +</option>";
                          }
                           else {
                                $options_bath = $options_bath . "<option value='$i'>$i</option>";
                              }
                    }

           $options_lounge = "";
            for($i = 0; $i <= 3; $i++) {
                if ($row['lounge_no'] == $i) {
                    $options_lounge = $options_lounge . "<option selected value='$row[lounge_no]'>$row[lounge_no]</option>";
                      // if the stored value does not match the value in the type table create an option with no 'selected' tag
                      } elseif ($i == 3) {
                          $options_lounge = $options_lounge . "<option value='$i'>$i +</option>";
                          } else {
                            $options_lounge = $options_lounge . "<option value='$i'>$i</option>";
                          }
                    }

            $options_garage = "";
              for($i = 0; $i <= 3; $i++) {
                  if ($row['garage_no'] == $i) {
                      $options_garage = $options_garage . "<option selected value='$row[garage_no]'>$row[garage_no]</option>";
                        // if the stored value does not match the value in the type table create an option with no 'selected' tag
                      } elseif ($i == 3) {
                          $options_garage = $options_garage . "<option value='$i'>$i +</option>";
                          } else {
                            $options_garage = $options_garage . "<option value='$i'>$i</option>";
                          }
                    }
?>

    <form class="add-listing-form" method="post" role="form" action="processes/process-update-listing.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Property Details</h3>
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
            <input class="form-control wide" name="updateListingTitle" id="title" placeholder="Inspiring title for your listing" required value="<?php echo $row['title'] ?>">
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="address">Street Address</label>
            <input class="form-control wide" name="updateStreetAddress" id="address" placeholder="number, street, suburb" required value="<?php echo $row['address'] ?>">
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
              <input type="number" class="form-control" name="updatePrice" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100000" required value="<?php echo $row['price'] ?>">
              <span class="input-group-addon">.00</span>
            </div>
            <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="sale-method">Sale Method</label>
            <input type="text" class="form-control wide" name="updateSaleMethod" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender" value="<?php echo $row['sell_method'] ?>">
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
            <input class="form-control wide" name="updateBedDescription" id="bed-des" placeholder="Double bedrooms, double wardrobes" required value="<?php echo $row['bed_des'] ?>">
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
            <input class="form-control wide" name="updateBathDescription" id="bath-des" placeholder="Main, ensuite, seperate toilet" required value="<?php echo $row['bath_des'] ?>">
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
            <input class="form-control wide" name="updateLoungeDescription" id="lou-des" placeholder="TV room, family room, rumpus" required value="<?php echo $row['lounge_des'] ?>">
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
            <input class="form-control wide" name="updateGarageDescription" id="gar-des" placeholder="Double, single, workshop" required value="<?php echo $row['garage_des'] ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="house-sqm">House Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="updateHouseSize" id="house-sqm" aria-describedby="h-sqm" placeholder="180" required value="<?php echo $row['house_size'] ?>">
              <span class="input-group-addon" id="h-sqm">m<sub>2</sub></span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="land-sqm">Land Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="updateLandSize" id="land-sqm" aria-describedby="l-sqm" placeholder="800" required value="<?php echo $row['land_size'] ?>">
              <span class="input-group-addon" id="l-sqm">m<sub>2</sub></span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="map">Map Co-ordinates</label>
            <input type="text" class="form-control wide" name="updateMapCoord" id="map" placeholder="41.850, -87.650" required value="<?php echo $row['map_co_ords'] ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="col mb-3">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="updateFListing" type="checkbox" value="1" <?php if($row['featured_property'] == "1"){echo 'checked="checked"';} ?>>
                <h5 class="ml-1">Featured Listing</h5>
              </label>
            </div>
          </div>
        </div>
    </div> <!-- listing form div -->
<?php       }
      } ?>
  <!-- Image error/success messages -->
  <!-- <div id="return-messages"> -->
    <div><?php if (isset($_SESSION['imageSuccess'])) { echo $_SESSION['imageSuccess']; unset($_SESSION['imageSuccess']); }; ?></div>
    <div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div>
  <!-- </div> -->

  <!-- Image upload tool -->
  <!-- <div class="form-row form-inline">
    <div class="col col-lg-6">
      <div class="image-form">
        <h3 class="mb-4">Add New Images</h3>
        <label for="file">Upload Property Images</label>
        <small id="p-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted, max size 500MB</small><br>
        <div id="filediv">
          <input class="form-control" name="file[]" type="file" id="file" aria-describedby="p-image-help"/>
        </div>
        <input type="button" id="add_more" class="btn" value="Add Another Image"/>
        <small class="form-text text-muted mt-4">The last image uploaded will be used as your featured image</small>
      </div>
    </div>
  </div> -->
  <input type="submit" value="Update Listing" name="submit" id="upload" class="btn"/>
</form>

<?php
  include 'includes/dashboard-footer.php';
?>
