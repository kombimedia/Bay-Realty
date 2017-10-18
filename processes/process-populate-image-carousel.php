<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$display_image = "";
$listing_id = $_GET['listing_id'];




 $stmt = $mysqli->prepare("SELECT img_name FROM images WHERE listing_id = ?");
 $stmt->bind_param("i", $listing_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $img_name = $row['img_name'];
      $display_image = $display_image . "

        <tr>
       
          <td><div class='carousel-item'>
      <img class='d-block w-100' src='images/uploads/$img_name' alt='Second slide'>
    </div></td>


        </tr>";

}

$stmt->close();
} else{
  echo "no listins to show";
}

?>