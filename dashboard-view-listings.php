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
$getData1 = "SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property
             FROM properties";
    $result1 = $mysqli->query($getData1);
    // Check if there are any records to show
    if ($result1->num_rows > 0) {
        // Loop through data and output each row
        while($row1 = $result1->fetch_assoc()) {

          $listing_id = $row1['listing_id'];
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
?>
          <tr>
              <td><img width="150" src="images/uploads/<?php echo $row1['featured_image'] ?>"></td>
              <td> <?php echo $row1['listing_id'] ?><br> <a class="view-listing-edit" href="dashboard-update-listing.php?listing_id=<?php echo $row1['listing_id']; ?>">Edit</a> <a class="view-listing-delete" href="#" onClick="deletelisting('<?php echo $row1['listing_id']; ?>')">Delete</a> </td>
              <td> <?php echo $agent; ?> </td>
              <td> <?php echo $row1['title']; ?> </td>
              <td> <?php echo $row1['address']; ?> </td>
              <td> <?php echo $city; ?> </td>
              <td> <?php echo $type; ?> </td>
              <td> <?php echo $row1['price']; ?> </td>
              <td> <?php echo $row1['sell_method']; ?> </td>
              <td> <?php echo $row1['bed_no']; ?> </td>
              <td> <?php echo $row1['bath_no']; ?> </td>
              <td> <?php echo $row1['lounge_no']; ?> </td>
              <td> <?php echo $row1['garage_no']; ?> </td>
              <td> <?php echo $row1['house_size']; ?> m<sub>2</sub></td>
              <td> <?php echo $row1['land_size']; ?> m<sub>2</sub></td>
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



