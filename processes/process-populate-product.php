<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$product_title = "";
$display_product = "";
$display_product2 = "";
$display_product3 = "";
$display_map = "";
$listing_id = $_GET['listing_id'];




 $stmt = $mysqli->prepare("SELECT listing_id, agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_image, featured_property FROM properties WHERE listing_id = ?");
 $stmt->bind_param("i", $listing_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $agents = $row['agents'];
      $listing_title = $row['title'];
      $property_des = $row['property_des'];
      $address = $row['address'];
      $categories = $row['categories'];
      $type = $row['type'];
      $price = $row['price'];
      $sell_method = $row['sell_method'];
      $prop_des = $row['property_des'];
      $bed_no = $row['bed_no'];
      $bed_des = $row['bed_des'];
      $bath_no = $row['bath_no'];
      $bath_des = $row['bath_des'];
      $lounge_no = $row['lounge_no'];
      $lounge_des = $row['lounge_des'];
      $garage_no = $row['garage_no'];
      $garage_des = $row['garage_des'];
      $house_size = $row['house_size']."m<sup>2</sup>";
      $land_size = $row['land_size']."m<sup>2</sup>";

      // used explode function to break up map co ordinates and stored into variables to be populated in google maps
      $map_co_ords = $row['map_co_ords'];
      list($mapa, $mapb) = explode(',', $map_co_ords);

      $featured_image = $row['featured_image'];
      $featured_property = $row['featured_property'];
      $listing_id = $row['listing_id'];

      // currency

      if ($sell_method !== "") {
          $price = $sell_method;
      }
      $number = $price;
      setlocale(LC_MONETARY,"en_NZ");
      $price = money_format("%.0n", $number);
      $display_product = $display_product . "
      <tr>
      <td><p>listing id: $listing_id </p><h4 style='color: #189ebb'>$listing_title</h4><p style='color: grey'>$address </p><a class= 'wishlist-icon' href='processes/process-wishlist-button.php?listing_id=$listing_id' action= 'post' ><i class='fa fa-heart' aria-hidden='true'> Add to Wishlist</i></a>
      </tr>";


        $display_product2 = $display_product2 . "
        <tr>

        <hr>
        <p>$property_des</p>
        <h4 style='color: #189ebb'>$price</h4>

        <p><i class='fa fa-bed pr-1' aria-hidden='true'></i> $bed_no <i class='fa fa-bath pl-2 pr-1' aria-hidden='true'></i> $bath_no <i class='fa fa-car pl-2 pr-1' aria-hidden='true'></i> $garage_no </p></td>


        </tr>";

        $display_product3 = $display_product3 . "
        <div class='container product2'>
        <tr>
        <td>
        <p>Land size: <span>$land_size</span></p>
        <p>House size: <span>$house_size</span></p>
        <p>Bedrooms: <span>$bed_des </span></p>
        <p>Bathrooms: <span>$bath_des </span></p>
        <p>Garages:  <span>$garage_des </span></p>
        </td>
        </tr>
        </div>";


         $display_map = $display_map . "


         ";

         $display_map = $display_map . "

        <div id='map'>

        </div>


        <script>
      function initMap() {
        var uluru = {lat: $mapa , lng: $mapb};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
     <script async defer
    src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBMqh-VZSDxYkS4Gm8baEjOCnYOItBi4jQ&callback=initMap'>
    </script>";






}

$stmt->close();
} else{
  echo "no listins to show";
}

?>
