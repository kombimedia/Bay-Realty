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
        <input type="text" class="form-control wide" id="agents" aria-describedby="agentsHelp" placeholder="Agent ID - comma separated list">
      </div>
      <div class="col-12 col-xl-4 mb-3">
        <label for="title">Listing Title</label>
        <textarea class="form-control" id="title" rows="1" placeholder="Inspiring title for your listing"></textarea>
      </div>
      <div class="col-12 col-xl-4 mb-3">
        <label for="address">Street Address</label>
        <textarea class="form-control" id="address" rows="1" placeholder="number, street, suburb"></textarea>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="city">City</label>
        <select class="form-control" id="city">
          <option value="" disabled selected>Select</option>
          <option>Tauranga</option>
          <option>Mt Maunganui</option>
          <option>Papamoa</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="type">Property Type</label>
        <select class="form-control" id="type">
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
        <input type="text" class="form-control wide" id="price" placeholder="$100,000, Negotiation, Auction">
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="map">Map Co-ordinates</label>
        <input type="text" class="form-control wide" id="map" placeholder="41.850, -87.650">
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="bedrooms">Bedrooms</label>
        <select class="form-control" id="bedrooms">
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
        <textarea class="form-control" id="bed-des" rows="1" placeholder="Double bedrooms, double wardrobes"></textarea>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="bathrooms">Bathrooms</label>
        <select class="form-control" id="bathrooms">
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
        <textarea class="form-control" id="bath-des" rows="1" placeholder="Main, ensuite, seperate toilet"></textarea>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="lounges">Lounges</label>
        <select class="form-control" id="lounges">
          <option value="" disabled selected>Select</option>
          <option>1</option>
          <option>2</option>
          <option>3 +</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="lou-des">Lounge Description</label>
        <textarea class="form-control" id="lou-des" rows="1" placeholder="TV room, family room, rumpus"></textarea>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="garages">Garages</label>
        <select class="form-control" id="garages">
          <option value="" disabled selected>Select</option>
          <option>0</option>
          <option>1</option>
          <option>2</option>
          <option>3 +</option>
        </select>
      </div>
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <label for="gar-des">Garage Description</label>
        <textarea class="form-control" id="gar-des" rows="1" placeholder="Double, single, workshop"></textarea>
      </div>
    </div>

    <div class="form-row form-inline">
      <div class="col-12 col-md-3 mb-3">
        <label for="house-sqm">House Size</label>
        <div class="input-group">
          <input type="number" class="form-control" id="house-sqm" aria-describedby="h-sqm" placeholder="90, 180, 240">
          <span class="input-group-addon" id="h-sqm">sqm</span>
        </div>
      </div>
      <div class="col-12 col-md-3 mb-3">
        <label for="land-sqm">Land Size</label>
        <div class="input-group">
          <input type="number" class="form-control" id="land-sqm" aria-describedby="l-sqm" placeholder="450, 1150, 5000">
          <span class="input-group-addon" id="l-sqm">sqm</span>
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="col mb-3">
        <label for="images">Upload Images</label>
        <input type="file" class="form-control-file" id="images" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">png, jpg or jpeg file types accepted</small>
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
