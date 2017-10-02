 <?php
  $sql = "SELECT address, price, bed_des, images, title FROM properties WHERE featured_property = 1";
    $result = $mysqli->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
                    echo "<div class='col col-xl-6 featured-property-table'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td> <img src='images/" .$row['images'] . "'></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td><h3>" . $row['title'] . "</h3><br><span>Address: " . $row['address'] . "<br><span>Price: $" . $row['price'] . "</span><br><span>Bedrooms: " . $row['bed_des'] . "</span></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
          }
  } else {
        echo "0 results";
    }
?>