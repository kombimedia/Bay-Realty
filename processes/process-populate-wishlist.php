<?php
//session_start();
// if not logged in then redirect to guest login page
if (!isset($_SESSION['guestUserName'])) {
    header('location: ../guest-login');
    exit;
}

$display_wishlist = "";
// Get user id
$user_id = $_SESSION['user_id'];
// Query wishlist table where wishlist user id = currently logged in user id and pull data from properties table
 $stmt = $mysqli->prepare("SELECT properties.title, properties.property_des, properties.address, properties.price, properties.sell_method, properties.bed_no, properties.bath_no, properties.garage_no, properties.featured_image, wishlist.user_id, wishlist.listing_id FROM properties INNER JOIN wishlist ON properties.listing_id = wishlist.listing_id WHERE wishlist.user_id = ?");
 $stmt->bind_param("i", $user_id);
 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {

// only display 200 charecters
  		  $string = $row['property_des'] . "";
        $string = substr($string, 0, 200);
// currency
        $price = $row['price'];
        $number = $price;
        setlocale(LC_MONETARY,"en_NZ");
        $price = money_format("%.0n", $number);

        $listing_id = $row['listing_id'];
//  sell method will be displayed instead of price if sell method is available  
        if ($row['sell_method'] !== "") {
                  $price = $row['sell_method'];
              }

// Build display wishlist tot be displayed on wishlist page 
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



