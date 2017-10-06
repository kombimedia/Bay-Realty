 <?php
  $sql = "SELECT address, price, bed_des, bath_des, featured_image, title FROM properties WHERE featured_property = 1 ORDER BY RAND() LIMIT 2";
    $result = $mysqli->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
                    echo "<div class='col col-xl-6 featured-property-table'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td> <img src='images/uploads/" .$row['featured_image'] . "'></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><h3>" . $row['title'] . "</h3><br><span>" . $row['address'] . "<br><span>Price: $" . $row['price'] . "</span><br><span> <i class='fa fa-bed' aria-hidden='true'></i> Bedrooms: " . $row['bed_des'] . "</span></td><br>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><span> <i class='fa fa-bath' aria-hidden='true'></i>  Bathrooms:  " . $row['bath_des'] . "</span></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
          }
  } else {
        echo "0 results";
    }
?>