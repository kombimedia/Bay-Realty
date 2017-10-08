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


  <table class='table table-hover table-responsive view-listings'>
    <thead class='view-listings-head'>
      <tr>
        <th></th>
        <th>Listing No.</th>
        <th>Agent</th>
        <th>Listing Title</th>
        <th>Address</th>
        <th>City</th>
        <th>Type</th>
        <th>Price</th>
        <th>Sell Method</th>
        <th>Bedrooms</th>
        <th>Bathrooms</th>
        <th>Lounges</th>
        <th>Garages</th>
        <th>House Size</th>
        <th>Land Size</th>
        <th>Featured Listing</th>
      </tr>
    </thead>
  <tbody>
<?php

$getData = "SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property
             FROM properties";
    $result = $mysqli->query($getData);
    // Check if there are any records to show
    if ($result->num_rows > 0) {
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {

          $listing_id = $row['listing_id'];
          // Check box returns 0 or 1. We needed to display 0 as No and 1 as Yes using a switch statement
          $featured = $row['featured_property'];
          switch ($featured) {
              case "0":
                $featured = "No";
                break;
              case "1":
                $featured = "Yes";
                break;
          }
// Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed to loop through and compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 00001
          $getData1 = "SELECT *
                       FROM categories";
          $result1 = $mysqli->query($getData1);
              // Loop through data and output each row
              while($row1 = $result1->fetch_array()) {
                  $cat_id = $row1['cat_id'];
                  $city = $row1['city'];
                  if ($row['categories'] == $cat_id) {
                      $row['categories'] = $city;
                  }
              }

        $getData2 = "SELECT *
                     FROM property_type";
        $result2 = $mysqli->query($getData2);
            // Loop through data and output each row
            while($row2 = $result2->fetch_array()) {
                $pt_id = $row2['pt_id'];
                $type = $row2['type'];
                if ($row['type'] == $pt_id) {
                    $row['type'] = $type;
                  }
              }

        $getData3 = "SELECT agent_id, first_name, surname
                     FROM agents";
        $result3 = $mysqli->query($getData3);
            // Loop through data and output each row
            while($row3 = $result3->fetch_array()) {
                $agent_id = $row3['agent_id'];
                $name = $row3['first_name'] . " " . $row3['surname'];
                if ($row['agents'] == $agent_id) {
                    $row['agents'] = $name;
                  }
              }
?>
          <tr>
              <td><img width="150" src="images/uploads/<?php echo $row['featured_image'] ?>"></td>
              <td> <?php echo $row['listing_id'] ?><br> <a class="view-listing-edit" href="dashboard-update-listing.php?listing_id=<?php echo $row['listing_id']; ?>">Edit</a> <a class="view-listing-delete" href="#" onClick="deletelisting('<?php echo $row['listing_id']; ?>')">Delete</a> </td>
              <td> <?php echo $row['agents'] ?> </td>
              <td> <?php echo $row['title']; ?> </td>
              <td> <?php echo $row['address']; ?> </td>
              <td> <?php echo $row['categories'] ?> </td>
              <td> <?php echo $row['type'] ?> </td>
              <td> <?php echo $row['price']; ?> </td>
              <td> <?php echo $row['sell_method']; ?> </td>
              <td> <?php echo $row['bed_no']; ?> </td>
              <td> <?php echo $row['bath_no']; ?> </td>
              <td> <?php echo $row['lounge_no']; ?> </td>
              <td> <?php echo $row['garage_no']; ?> </td>
              <td> <?php echo $row['house_size']; ?> m<sub>2</sub></td>
              <td> <?php echo $row['land_size']; ?> m<sub>2</sub></td>
              <td> <?php echo $featured; ?></td>
          </tr>
<?php
        }
      } else {
          echo "No property listings to show";
      }
?>
    </tbody>
  </table>

<script language="javascript">
 function deletelisting(dellisting) {
     if (confirm("Are you sure you want to remove this listing?")) {
     window.location.href='processes/process-delete-listing.php?del_listing=' +dellisting+'';
     return true;
    }
 }
</script>

<?php


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



