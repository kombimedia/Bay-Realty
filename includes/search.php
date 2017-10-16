

<?php
session_start();
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
        <td><img width='150' height='100' src='images/uploads/$row[featured_image]'></td>
        <td>$row[title]</td>
        <td>$row[price]</td>
        <td>$row[property_des]</td>


        </tr>";          
                    
               
}
} else{
  echo "no listins to show";
}
$stmt->close();



}
$_SESSION['search_output'] = $search_output;

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
              <option value="" disabled selected>Area</option>
              <option value="2">Tauranga</option>
              <option value="3">Mt Maunganui</option>
              <option value="4">Papamoa</option>
            </select>
          </div>

          <div class="col">
            <select name="type" class="form-control" id="search-type">
              <option value="" disabled selected>Type</option>
              <option value="1">House</option>
              <option value="2">Apartment</option>
              <option value="3">Studio</option>
              <option value="4">Unit</option>
              <option value="5">Section</option>
              <option value="6">Life-style</option>
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




