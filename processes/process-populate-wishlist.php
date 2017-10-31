<?php
//session_start();
if (!isset($_SESSION['guestUserName'])) {
    header('location: ../guest-login');
    exit;
}

$display_wishlist = "";
//$wish = $_GET['del_wish'];
$user_id = $_SESSION['user_id'];

 $stmt = $mysqli->prepare("SELECT properties.title, properties.property_des, properties.address, properties.price, properties.sell_method, properties.bed_no, properties.bath_no, properties.garage_no, properties.featured_image, wishlist.user_id, wishlist.listing_id FROM properties INNER JOIN wishlist ON properties.listing_id = wishlist.listing_id WHERE wishlist.user_id = ? ORDER BY wishlist.wishlist_id DESC");
 $stmt->bind_param("i", $user_id);
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

         	   $display_wishlist = $display_wishlist . " <div class='row'> <div class='col-lg-4 col-md-6 col-sm-12'> <tr>
          <td> <a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><img width='280' height='200px'  src='images/uploads/$row[featured_image]'></a></td></div>
          <div class='col-lg-12 col-md-7 col-sm-12'><td><a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><h4 >$row[title]</h4></a><a class='view-user-delete' href='#' onClick='deleteWishlist($row[listing_id])'><img src='images/x.png'></a><p style='color: grey'>$row[address] </p><hr>
          <p>$string ...</p>
          <h4>$price</h4>

          <p><i class='fa fa-bed pr-2' aria-hidden='true'></i>$row[bed_no] <i class='fa fa-bath pl-2 pr-2' aria-hidden='true'></i>$row[bath_no] <i class='fa fa-car pl-2 pr-2' aria-hidden='true'></i>$row[garage_no]</p>
          </div>


          </tr></div>";

         }
    //header('location: ../wishlist.php');


     }
$stmt->close();



