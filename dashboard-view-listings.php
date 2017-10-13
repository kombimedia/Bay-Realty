<?php
session_start();
$title = "View Listings";
$metaD = "Admin dashboard page, view listings";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>

  <div><?php if (isset($_SESSION['updateListingSuccess'])) { echo $_SESSION['updateListingSuccess']; unset($_SESSION['updateListingSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['updateListingError'])) { echo $_SESSION['updateListingError']; unset($_SESSION['updateListingError']); }; ?></div>
  <div><?php if (isset($_SESSION['listDelSuccess'])) { echo $_SESSION['listDelSuccess']; unset($_SESSION['listDelSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['listDelError'])) { echo $_SESSION['listDelError']; unset($_SESSION['listDelError']); }; ?></div>

  <table class='table table-striped table-responsive view-listings'>
    <thead class='view-listings-head'>
      <tr>
        <th>Featured Image</th>
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
          $agents = $row['agents'];
          $title = $row['title'];
          $address = $row['address'];
          $categories = $row['categories'];
          $type = $row['type'];
          $price = $row['price'];
          $sell_method = $row['sell_method'];
          $bed_no = $row['bed_no'];
          $bath_no = $row['bath_no'];
          $lounge_no = $row['lounge_no'];
          $garage_no = $row['garage_no'];
          $house_size = $row['house_size'];
          $land_size = $row['land_size'];
          $featured_image = $row['featured_image'];
          $featured_property = $row['featured_property'];
          // Convert decimal from DB to currency to display on the page
          $number = $price;
          setlocale(LC_MONETARY,"en_NZ");
          $price = money_format("%.0n", $number);
          // Check box returns 0 or 1. We needed to display 0 as No and 1 as Yes using a switch statement
          switch ($featured_property) {
              case "0":
                $featured_property = "No";
                break;
              case "1":
                $featured_property = "Yes";
                break;
          }
// Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed to loop through and compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 00001
          $getData1 = "SELECT *
                       FROM categories";
          $result1 = $mysqli->query($getData1);
              // Loop through data and output each row
              while($row1 = $result1->fetch_array()) {
                  // define output field to compare against
                  $cat_id = $row1['cat_id'];
                  // define field to output to listings table
                  $city = $row1['city'];
                  // compare stored data to categories table and save ID as string value
                  if ($categories == $cat_id) {
                      $categories = $city;
                  }
              }

          $getData2 = "SELECT *
                       FROM property_type";
          $result2 = $mysqli->query($getData2);
              // Loop through data and output each row
              while($row2 = $result2->fetch_array()) {
                   // define output field to compare against
                  $pt_id = $row2['pt_id'];
                  // define field to output to listings table
                  $property_type = $row2['type'];
                  // compare stored data to property_type table and save ID as string value
                  if ($type == $pt_id) {
                      $type = $property_type;
                    }
                }

          $getData3 = "SELECT agent_id, first_name, surname
                       FROM agents";
          $result3 = $mysqli->query($getData3);
              // Loop through data and output each row
              while($row3 = $result3->fetch_array()) {
                  // define output field to compare against
                  $agent_id = $row3['agent_id'];
                  // define field to output to listings table
                  $name = $row3['first_name'] . " " . $row3['surname'];
                  // compare stored data to agents table and save ID as string value
                  if ($agents == $agent_id) {
                      $agents = $name;
                    }
                }
?>
          <tr>
              <td><img width="150" src="images/uploads/<?php echo $featured_image; ?>"></td>
              <td> <?php echo $listing_id; ?><br> <a class="view-listing-edit" href="dashboard-update-listing.php?listing_id=<?php echo $row['listing_id']; ?>">Edit</a> <a class="view-listing-delete" href="#" onClick="deletelisting('<?php echo $row['listing_id']; ?>')">Delete</a> </td>
              <td> <?php echo $agents; ?> </td>
              <td> <?php echo $title; ?> </td>
              <td> <?php echo $address; ?> </td>
              <td> <?php echo $categories; ?> </td>
              <td> <?php echo $type; ?> </td>
              <td> <?php echo $price; ?> </td>
              <td> <?php echo $sell_method; ?> </td>
              <td> <?php echo $bed_no; ?> </td>
              <td> <?php echo $bath_no; ?> </td>
              <td> <?php echo $lounge_no; ?> </td>
              <td> <?php echo $garage_no; ?> </td>
              <td> <?php echo $house_size; ?> m<sub>2</sub></td>
              <td> <?php echo $land_size; ?> m<sub>2</sub></td>
              <td> <?php echo $featured_property; ?></td>
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
     if (confirm("Are you sure you want to delete this listing?")) {
     window.location.href='processes/process-delete-listing.php?del_listing=' +dellisting+'';
     return true;
    }
 }
</script>

<?php
include 'includes/dashboard-footer.php';
?>



