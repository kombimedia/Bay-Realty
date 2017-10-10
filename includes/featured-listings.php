 <?php
  $sql = "SELECT address, price, bed_no, bath_no, featured_image, title, garage_no FROM properties WHERE featured_property = 1 ORDER BY RAND() LIMIT 2";
    $result = $mysqli->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
                    echo "<div class='col col-xl-6 featured-property-table'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td> <img src='images/uploads/" .$row['featured_image'] . "'></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><h3>" . $row['title'] . "</h3><span>" . $row['address'] . "<br><span>Price: $" . $row['price'] . "</span><br><span> <i class='fa fa-bed' aria-hidden='true'></i> : " . $row['bed_no'] . " " .  "<i class='fa fa-bath' aria-hidden='true'></i>  :  " . $row['bath_no']  . " " .  "<i class='fa fa-car' aria-hidden='true'></i>  :  " . $row['garage_no'] . "</span></td>";
                    echo "</tr>";
                   
                    echo "</table>";
                    echo "</div>";
          }
  } else {
        echo "0 results";
    }
?>