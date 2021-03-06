 <?php
 // Featured listing is displayed on selected pages and is pulled in at random and limited to 2 listings
  $sql = "SELECT listing_id ,address, price, bed_no, bath_no, featured_image, title, garage_no, sell_method FROM properties WHERE featured_property = 1 ORDER BY RAND() LIMIT 2";
    $result = $mysqli->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $price = $row['price'];
            $number = $price;
      setlocale(LC_MONETARY,"en_NZ");
      $price = money_format("%.0n", $number);

      // Display the sell method if populated in listing
      if ($row['sell_method'] !== "") {
                $price = $row['sell_method'];
            }

            $listing_id = $row['listing_id'];

                    echo "<div class='col col-xl-6 featured-property-table'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td><a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><img src='images/uploads/" .$row['featured_image'] . "'></a></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><h3>" . $row['title'] . "</h3></a><span>" . $row['address'] . "<br><span>"  . $price . "</span><br><span> <i class='fa fa-bed pr-2' aria-hidden='true'></i>" . $row['bed_no'] . " " .  "<i class='fa fa-bath pl-2 pr-2' aria-hidden='true'></i>" . $row['bath_no']  . " " .  "<i class='fa fa-car pl-2 pr-2' aria-hidden='true'></i>" . $row['garage_no'] . "<a id= 'wishlist-icon' href='processes/process-wishlist-button.php?listing_id=$listing_id' action= 'post' ><i class='fa fa-heart' aria-hidden='true'> Add to Wishlist</i></a></span></td>";
                    echo "</tr>";

                    echo "</table>";
                    echo "</div>";
          }
  } else {
        echo "0 results";
    }
?>
