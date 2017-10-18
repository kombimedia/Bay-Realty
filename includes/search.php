

<?php
<<<<<<< HEAD
include 'processes/process-populate-search-listing.php'
=======
include 'processes/process-populate-search-form.php';
$search_output = "";
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(isset($_POST['submit_search'])){
$search_bar = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['search_bar']);
$search_bar = "%" . $search_bar . "%";



$stmt = $mysqli->prepare("SELECT address, price, bed_no, bath_no, property_des, featured_image, title, garage_no FROM properties WHERE MATCH(title) AGAINST  (?) AND categories = ? AND type = ?");
$stmt->bind_param("sii", $search_bar, $_POST['city'], $_POST['type']);
$stmt->execute();
$result = $stmt->get_result();


if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $arr[] = $row;
    $search_output = $search_output . "

        <tr>
        <td><img width='350px' height='200px'  src='images/uploads/$row[featured_image]'></td>
        <td><h4 style='color: #42b3f4'>$row[title]</h4><p style='color: grey'>$row[address]</p><hr>
        <p>$row[property_des]</p>
        <h4>$ $row[price]</h4>

        <p><i class='fa fa-bed' aria-hidden='true'></i>  : $row[bed_no] <i class='fa fa-bath' aria-hidden='true'></i> : $row[bath_no] <i class='fa fa-car' aria-hidden='true'></i> : $row[garage_no]</p>


        </tr>";


}
} else{
  echo "no listins to show";
}
$stmt->close();



}
$_SESSION['search_output'] = $search_output;

>>>>>>> dea931bc69dfccc1b68729693e775aa311cfd33b
?>



<div class="container-fluid search-form-outer">
  <div class="container search-form-inner">
      <form action="category.php" method="post" role="form" class="search-form">
        <div class="form-row mb-2 mt-4">
          <div class="col">
            <input name="search_bar" type="text" maxlength="88" class="form-control" id="search-input" placeholder="location, keyword, property ID">
          </div>
        </div>
        <div class="form-row form-inline mb-2">
          <div class="col">
            <select name="city" class="form-control" id="search-area">
              <option value="1,2,3" disabled selected>Area</option>
              <?php echo $option_city ?>
            </select>
          </div>

          <div class="col">
            <select name="type" class="form-control" id="search-type">
              <option value="" disabled selected>Type</option>
              <?php echo $option_type ?>
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
        <button name= "submit_search" type="submit" class="btn">Search for Homes!</button>
      </form>
  </div>
</div>




