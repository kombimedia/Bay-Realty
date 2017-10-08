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
$getData = "SELECT agents, title, address, categories, type, price, sell_method, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property
            FROM properties
            WHERE listing_id = $listing_id";
    $result = $mysqli->query($getData);
    // Check if there are any records to show
    if ($result->num_rows > 0) {
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {

          $city = $row['categories'];
          switch ($city) {
              case "00002":
                $city = "Tauranga";
                break;
              case "00003":
                $city = "Mt Maunganui";
                break;
              case "00004":
                $city = "Papamoa";
                break;
          }
          $type = $row['type'];
          switch ($type) {
              case "00001":
                $type = "House";
                break;
              case "00002":
                $type = "Apartment";
                break;
              case "00003":
                $type = "Studio";
                break;
              case "00004":
                $type = "Unit";
                break;
              case "00005":
                $type = "Section";
                break;
              case "00006":
                $type = "Lifestyle";
                break;
          }
          $agent = $row['agents'];
          switch ($agent) {
              case "00001":
                $agent = "Cy";
                break;
              case "00002":
                $agent = "Dane";
                break;
              case "00003":
                $agent = "Belinda";
                break;
              case "00004":
                $agent = "Lily";
                break;
              case "00005":
                $agent = "Kobi";
                break;
              case "00006":
                $agent = "Celia";
                break;
          }

?>


    <form class="add-listing-form" method="post" role="form" action="processes/process-add-listing-form.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Property Details</h3>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-4 mb-3">
            <label for="agents">Sales Agent</label>
            <select class="form-control" name="salesAgent" id="type" required value="">
              <option value="" disabled selected>'<?php echo $agent ?>' - Please confirm or reselect</option>
              <option value="00001">Cy</option>
              <option value="00002">Dane</option>
              <option value="00003">Belinda</option>
              <option value="00004">Lily</option>
              <option value="00005">Kobi</option>
              <option value="00006">Celia</option>
            </select>
          </div>

          <div class="col-12 col-xl-4 mb-3">
            <label for="title">Listing Title</label>
            <input class="form-control wide" name="listingTitle" id="title" placeholder="Inspiring title for your listing" required value="<?php echo $row['title'] ?>">
          </div>
          <div class="col-12 col-xl-4 mb-3">
            <label for="address">Street Address</label>
            <input class="form-control wide" name="streetAddress" id="address" placeholder="number, street, suburb" required value="<?php echo $row['address'] ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="city">City</label>
            <select class="form-control" name="city" id="city" required value="">
              <option value="" disabled selected>'<?php echo $city ?>' - Please confirm or reselect</option>
              <option value="00002">Tauranga</option>
              <option value="00003">Mt Maunganui</option>
              <option value="00004">Papamoa</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
            <label for="type">Property Type</label>
            <select class="form-control" name="propertyType" id="type" required value="">
              <option value="" disabled selected>'<?php echo $type ?>' - Please confirm or reselect</option>
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
              <input type="number" class="form-control" name="price" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100000" required value="<?php echo $row['price'] ?>">
              <span class="input-group-addon">.00</span>
            </div>
            <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="sale-method">Sale Method</label>
            <input type="text" class="form-control wide" name="saleMethod" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender" value="<?php echo $row['sell_method'] ?>">
            <small id="salehelp" class="form-text text-muted"><b>NOT REQUIRED</b> if you have a set sale price</small>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bedrooms">Bedrooms</label>
            <select class="form-control" name="bedrooms" id="bedrooms" required value="">
              <option value="" disabled selected>'<?php echo $row['bed_no'] ?>' - Please confirm or reselect</option>
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
            <input class="form-control wide" name="bedDescription" id="bed-des" placeholder="Double bedrooms, double wardrobes" required value="<?php echo $row['bed_des'] ?>">
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="bathrooms">Bathrooms</label>
            <select class="form-control" name="bathrooms" id="bathrooms" required value="">
              <option value="" disabled selected>'<?php echo $row['bath_no'] ?>' - Please confirm or reselect</option>
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
            <input class="form-control wide" name="bathDescription" id="bath-des" placeholder="Main, ensuite, seperate toilet" required value="<?php echo $row['bath_des'] ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lounges">Lounges</label>
            <select class="form-control" name="lounges" id="lounges" required value="">
              <option value="" disabled selected>'<?php echo $row['lounge_no'] ?>' - Please confirm or reselect</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option value="3">3 +</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="lou-des">Lounge Description</label>
            <input class="form-control wide" name="loungeDescription" id="lou-des" placeholder="TV room, family room, rumpus" required value="<?php echo $row['lounge_des'] ?>">
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="garages">Garages</label>
            <select class="form-control" name="garages" id="garages" required value="">
              <option value="" disabled selected>'<?php echo $row['garage_no'] ?>' - Please confirm or reselect</option>
              <option>0</option>
              <option>1</option>
              <option>2</option>
              <option value="3">3 +</option>
            </select>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="gar-des">Garage Description</label>
            <input class="form-control wide" name="garageDescription" id="gar-des" placeholder="Double, single, workshop" required value="<?php echo $row['garage_des'] ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="house-sqm">House Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="houseSize" id="house-sqm" aria-describedby="h-sqm" placeholder="180" required value="<?php echo $row['house_size'] ?>">
              <span class="input-group-addon" id="h-sqm">m<sub>2</sub></span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="land-sqm">Land Size</label>
            <div class="input-group">
              <input type="number" class="form-control" name="landSize" id="land-sqm" aria-describedby="l-sqm" placeholder="800" required value="<?php echo $row['land_size'] ?>">
              <span class="input-group-addon" id="l-sqm">m<sub>2</sub></span>
            </div>
          </div>
          <div class="col-12 col-md-6 col-xl-3 mb-3">
            <label for="map">Map Co-ordinates</label>
            <input type="text" class="form-control wide" name="mapCoord" id="map" placeholder="41.850, -87.650" required value="<?php echo $row['map_co_ords'] ?>">
          </div>
        </div>

        <div class="form-row">
          <div class="col mb-3">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="fListing" type="checkbox" value="1" <?php if($row['featured_property'] == "1"){echo 'checked="checked"';}?>>
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
  <input type="submit" value="Update Listing" name="submit" id="upload" class="btn"/>
</form>

<?php
  include 'includes/dashboard-footer.php';
?>
