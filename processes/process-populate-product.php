<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$display_product = "";
$display_product2 = "";
$display_product3 = "";
$listing_id = $_GET['listing_id'];




 $stmt = $mysqli->prepare("SELECT listing_id, images, agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_image, featured_property FROM properties WHERE listing_id = ?");
 $stmt->bind_param("i", $listing_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $agents = $row['agents'];
      $listing_title = $row['title'];
      $images = $row['images'];
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
      $house_size = $row['house_size'];
      $land_size = $row['land_size'];
      $map_co_ords = $row['map_co_ords'];
      $featured_image = $row['featured_image'];
      $featured_property = $row['featured_property'];
      $listing_id = $row['listing_id'];

      // currency 
      $number = $price;
      setlocale(LC_MONETARY,"en_NZ");
      $price = money_format("%.0n", $number);
      $display_product = $display_product . "
      <tr>
      <td><p>listing id: $listing_id</p><h4 style='color: #42b3f4'>$listing_title</h4><p style='color: grey'>$address</p>
      </tr>";
        

        $display_product2 = $display_product2 . "
        <tr>
       
        <hr>
        <p>$property_des</p>
        <h4 style='color: #42b3f4'>$price</h4>
      
        <p><i class='fa fa-bed' aria-hidden='true'></i>  : $bed_no <i class='fa fa-bath' aria-hidden='true'></i> : $bath_no <i class='fa fa-car' aria-hidden='true'></i> : $garage_no </p></td>


        </tr>";

        $display_product3 = $display_product3 . "
        <div class='container product2'>
        <tr>
        <td>
        <p>Land size : <span>$land_size </span></p>
        <p>house_size : <span>$house_size </span></p>
        <p>Bedrooms : <span>$bed_des </span></p>
        <p>Bathrooms <span>$bath_des </span></p>
        <p>Garage :  <span>$garage_des </span></p>
        <p>housesize : <span> $house_size </span></p></td>
        </tr>
        </div>";





}

$stmt->close();
} else{
  echo "no listins to show";
}

?>