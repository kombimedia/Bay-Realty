<?php
  $title = "Add Listing";
  $metaD = "Admin dashboard page, add listing";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>Add New Listing</h1>

  <form class="add-listing-form">
    <div class="form-row form-inline mt-4">
      <div class="col-12 col-xl-4 mb-3">
        <label for="agents">Sales Agent</label>
        <input type="text" class="form-control wide" id="agents" aria-describedby="agentsHelp" placeholder="Agent ID - comma separated list" required>
      </div>
      <div class="col-12 col-xl-4 mb-3">
        <label for="title">Listing Title</label>
        <textarea class="form-control" id="title" rows="1" placeholder="Inspiring title for your listing" required></textarea>
      </div>
      <div class="col-12 col-xl-4 mb-3">
        <label for="address">Street Address</label>
        <textarea class="form-control" id="address" rows="1" placeholder="number, street, suburb" required></textarea>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
        <label for="city">City</label>
        <select class="form-control" id="city" required>
          <option value="" disabled selected>Select</option>
          <option>Tauranga</option>
          <option>Mt Maunganui</option>
          <option>Papamoa</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3 mb-xl-24">
        <label for="type">Property Type</label>
        <select class="form-control" id="type" required>
          <option value="" disabled selected>Select</option>
          <option>House</option>
          <option>Apartment</option>
          <option>Studio</option>
          <option>Unit</option>
          <option>Section</option>
          <option>Life-style</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="price">Price</label>
        <div class="input-group">
          <span class="input-group-addon" id="price$">$</span>
          <input type="text" class="form-control" id="price" aria-describedby="pricehelp" aria-label="Amount (to the nearest dollar)" placeholder="100,000" required>
          <span class="input-group-addon">.00</span>
        </div>
        <small id="pricehelp" class="form-text text-muted">set sale price, or market value </small>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="sale-method">Sale Method</label>
        <input type="number" class="form-control wide" id="sale-method" aria-describedby="salehelp" placeholder="Negotiation, auction, tender">
        <small id="salehelp" class="form-text text-muted"><b>NOT REQUIRED</b> if you have a set sale price</small>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="bedrooms">Bedrooms</label>
        <select class="form-control" id="bedrooms" required>
          <option value="" disabled selected>Select</option>
          <option>0</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5 +</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="bed-des">Bedroom Description</label>
        <textarea class="form-control" id="bed-des" rows="1" placeholder="Double bedrooms, double wardrobes" required></textarea>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="bathrooms">Bathrooms</label>
        <select class="form-control" id="bathrooms" required>
          <option value="" disabled selected>Select</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5 +</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="bath-des">Bathroom Description</label>
        <textarea class="form-control" id="bath-des" rows="1" placeholder="Main, ensuite, seperate toilet" required></textarea>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="lounges">Lounges</label>
        <select class="form-control" id="lounges" required>
          <option value="" disabled selected>Select</option>
          <option>0</option>
          <option>1</option>
          <option>2</option>
          <option>3 +</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="lou-des">Lounge Description</label>
        <textarea class="form-control" id="lou-des" rows="1" placeholder="TV room, family room, rumpus" required></textarea>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="garages">Garages</label>
        <select class="form-control" id="garages" required>
          <option value="" disabled selected>Select</option>
          <option>0</option>
          <option>1</option>
          <option>2</option>
          <option>3 +</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="gar-des">Garage Description</label>
        <textarea class="form-control" id="gar-des" rows="1" placeholder="Double, single, workshop" required></textarea>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="house-sqm">House Size</label>
        <div class="input-group">
          <input type="number" class="form-control" id="house-sqm" aria-describedby="h-sqm" placeholder="180" required>
          <span class="input-group-addon" id="h-sqm">sqm</span>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="land-sqm">Land Size</label>
        <div class="input-group">
          <input type="number" class="form-control" id="land-sqm" aria-describedby="l-sqm" placeholder="800" required>
          <span class="input-group-addon" id="l-sqm">sqm</span>
        </div>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="map">Map Co-ordinates</label>
        <input type="text" class="form-control wide" id="map" placeholder="41.850, -87.650" required>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="image1">Upload Image 1</label>
        <input type="file" class="form-control-file" id="image1" aria-describedby="fileHelp1" required>
        <small id="fileHelp1" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="image2">Upload Image 2</label>
        <input type="file" class="form-control-file" id="image2" aria-describedby="fileHelp2">
        <small id="fileHelp2" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="image3">Upload Image 3</label>
        <input type="file" class="form-control-file" id="image3" aria-describedby="fileHelp3">
        <small id="fileHelp3" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="image4">Upload Image 4</label>
        <input type="file" class="form-control-file" id="image4" aria-describedby="fileHelp4">
        <small id="fileHelp4" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
      </div>
    </div>

    <div class="form-row">
      <div class="col mb-3">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox" value="">
            Featured Listing
          </label>
        </div>
      </div>
    </div>

    <button type="submit" class="btn">Add Listing</button>
  </form>

<?php
  include 'includes/dashboard-footer.php';
?>
