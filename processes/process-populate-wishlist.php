<?php
//session_start();




$display_wishlist = "";

$user_id = $_SESSION['user_id'];


if (isset($_SESSION['guestUserName'])) {

    $stmt = $mysqli->prepare("SELECT my_wishlist FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
     $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $my_wishlist = $row['my_wishlist'];

       $my_wishlist = explode(',', $my_wishlist);

       // foreach ($my_wishlist as  $wish) {

       // }
  }
}
$stmt->close();

foreach ($my_wishlist as  $wish) {



 $stmt = $mysqli->prepare("SELECT * FROM properties WHERE listing_id = ?");
 $stmt->bind_param("i", $wish);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {


		  $string = $row['property_des'] . "";
      $string = substr($string, 0, 200);

      $price = $row['price'];
      $number = $price;
      setlocale(LC_MONETARY,"en_NZ");
      $price = money_format("%.0n", $number);

      $listing_id = $row['listing_id'];

      if ($row['sell_method'] !== "") {
                $price = $row['sell_method'];
            }

       	   $display_wishlist = $display_wishlist . "   <tr>
        <td> <a class='view-listing' href='product.php?listing_id=$listing_id'><img width='280' height='200px'  src='images/uploads/$row[featured_image]'></a></td>
        <td><a class='view-listing' href='product.php?listing_id=$listing_id'><h4 >$row[title]</h4></a><a id= 'wishlist-icon' href='processes/process-wishlist-button.php?listing_id=$listing_id' action= 'post' ><i class='fa fa-heart' aria-hidden='true'>  Add to Wishlist</i></a><p style='color: grey'>$row[address] </p><hr>
        <p>$string ...</p>
        <h4>$price</h4>

        <p><i class='fa fa-bed pr-2' aria-hidden='true'></i>$row[bed_no] <i class='fa fa-bath pl-2 pr-2' aria-hidden='true'></i>$row[bath_no] <i class='fa fa-car pl-2 pr-2' aria-hidden='true'></i>$row[garage_no]</p>


        </tr>";
       }
  //header('location: ../wishlist.php');


     }
}
$stmt->close();

}
else {
  header('location: ../guest-login');
}
?>
