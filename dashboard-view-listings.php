<?php
session_start();
$title = "View Listings";
$metaD = "Admin dashboard page, view listings";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>
  <div><?php if (isset($_SESSION['listDelSuccess'])) { echo $_SESSION['listDelSuccess']; unset($_SESSION['listDelSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['listDelError'])) { echo $_SESSION['listDelError']; unset($_SESSION['listDelError']); }; ?></div>
<?php

echo "<table class='table table-hover table-responsive view-listings'>";
  echo "<thead class='view-listings-head'>";
    echo "<tr>";
      echo "<th></th>";
      echo "<th>Listing No.</th>";
      echo "<th>Agent</th>";
      echo "<th>Listing Title</th>";
      echo "<th>Address</th>";
      echo "<th>City</th>";
      echo "<th>Type</th>";
      echo "<th>Price</th>";
      echo "<th>Sell Method</th>";
      echo "<th>Bedrooms</th>";
      echo "<th>Bathrooms</th>";
      echo "<th>Lounges</th>";
      echo "<th>Garages</th>";
      echo "<th>House Size</th>";
      echo "<th>Land Size</th>";
      echo "<th>Featured Listing</th>";
    echo "</tr>";
  echo "</thead>";
echo "<tbody>";

$getData1 = "SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property
             FROM properties";
        $result1 = $mysqli->query($getData1);
        // Check if there are any records to show
        if ($result1->num_rows > 0) {
            // Loop through data and output each row
            while($row1 = $result1->fetch_assoc()) {

              $_SESSION["listing_id"] = $row1['listing_id'];

              $featured = $row1['featured_property'];
              switch ($featured) {
                  case "0":
                    $featured = "No";
                    break;
                  case "1":
                    $featured = "Yes";
                    break;
              }
              $city = $row1['categories'];
              switch ($city) {
                  case "00002":
                    $city = "Tauranga";
                    break;
                  case "00003":
                    $city = "Mt Maunganui";
                    break;
                  case "00004":
                    $city = "Papamoa";
                    break;
              }
              $type = $row1['type'];
              switch ($type) {
                  case "00001":
                    $type = "House";
                    break;
                  case "00002":
                    $type = "Apartment";
                    break;
                  case "00003":
                    $type = "Studio";
                    break;
                  case "00004":
                    $type = "Unit";
                    break;
                  case "00005":
                    $type = "Section";
                    break;
                  case "00006":
                    $type = "Lifestyle";
                    break;
              }
              $agent = $row1['agents'];
              switch ($agent) {
                  case "00001":
                    $agent = "Cy";
                    break;
                  case "00002":
                    $agent = "Dane";
                    break;
                  case "00003":
                    $agent = "Belinda";
                    break;
                  case "00004":
                    $agent = "Lily";
                    break;
                  case "00005":
                    $agent = "Kobi";
                    break;
                  case "00006":
                    $agent = "Celia";
                    break;
              }

                    echo "<tr>";
                      echo "<td><img width='150' src='images/uploads/" . $row1['featured_image'] . "'></td>";
                      echo "<td>" . $row1['listing_id'] . "<br><a class='view-listing-edit' href='#'>Edit</a> <a class='view-listing-delete' href='processes/process-delete-listing.php'>Delete</a></td>";
                      echo "<td>" . $agent . "</td>";
                      echo "<td>" . $row1['title'] . "</td>";
                      echo "<td>" . $row1['address'] . "</td>";
                      echo "<td>" . $city . "</td>";
                      echo "<td>" . $type . "</td>";
                      echo "<td>" . $row1['price'] . "</td>";
                      echo "<td>" . $row1['sell_method'] . "</td>";
                      echo "<td>" . $row1['bed_no'] . "</td>";
                      echo "<td>" . $row1['bath_no'] . "</td>";
                      echo "<td>" . $row1['lounge_no'] . "</td>";
                      echo "<td>" . $row1['garage_no'] . "</td>";
                      echo "<td>" . $row1['house_size'] . "m<sub>2</sub></td>";
                      echo "<td>" . $row1['land_size'] . "m<sub>2</sub></td>";
                      echo "<td>" . $featured . "</td>";
                    echo "</tr>";
            }
        } else {
            echo "No property listings to show";
        }
  echo "</tbody>";
echo  "</table>";




// $query = "SELECT listing_id, title, address, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property
//            FROM properties;";
// $query.= "SELECT first_name, surname
//           FROM agents
//           INNER JOIN properties
//           WHERE properties.agents = agents.agent_id;";
// $query.= "SELECT city
//           FROM categories
//           INNER JOIN properties
//           WHERE properties.categories = categories.cat_id;";

// $query.= "SELECT type
//           FROM property_type
//           INNER JOIN properties
//           WHERE properties.type = property_type.pt_id;";

//  execute multi query
// if ($mysqli->multi_query($query)) {

//     $result = $mysqli->store_result();
//     $row = $result->fetch_assoc();
//     echo "<pre>";
//     print_r($row);

//     $mysqli->next_result();
//     $result = $mysqli->store_result();
//     $row = $result->fetch_assoc();
//     echo "<pre>";
//     print_r($row);

//     $mysqli->next_result();
//     $result = $mysqli->store_result();
//     $row = $result->fetch_assoc();
//     echo "<pre>";
//     print_r($row);

//     $mysqli->next_result();
//     $result = $mysqli->store_result();
//     $row = $result->fetch_assoc();
//     echo "<pre>";
//     print_r($row);

// }


//        echo "</tbody>";
//        echo  "</table>";



// $getData2 = "SELECT first_name, surname
//              FROM agents
//              INNER JOIN properties WHERE properties.agents = agents.agent_id";
//         $result2 = $mysqli->query($getData2);
//         // Check if there are any records to show
//         if ($result2->num_rows > 0) {
//             // output data of each rowi
//             while($row2 = $result2->fetch_assoc()) {
//                 echo $row2['first_name'] . " " . $row2['surname'];
//             }
//         } else {
//           echo "no results";
//         }





?>

<?php
include 'includes/dashboard-footer.php';
?>



