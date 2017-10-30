<?php
$populate_view_listings = "";
$stmt = $mysqli->prepare("SELECT properties.listing_id, properties.agents, properties.title, properties.address, properties.categories, properties.type, properties.price, properties.sell_method, properties.bed_no, properties.bath_no, properties.lounge_no, properties.garage_no, properties.house_size, properties.land_size, properties.featured_image, properties.featured_property, categories.cat_id, categories.city, property_type.pt_id, property_type.type, agents.agent_id, agents.first_name, agents.surname FROM properties INNER JOIN categories ON properties.categories = categories.cat_id INNER JOIN property_type ON properties.type = property_type.pt_id INNER JOIN agents ON properties.agents = agents.agent_id ORDER BY properties.listing_id ASC");
$stmt->execute();
$result = $stmt->get_result();
// Check if there are any records to show
if($result->num_rows > 0) {
  // Loop through data and save each row array to a variable
  while($row = $result->fetch_assoc()) {

    // Convert decimal from DB to currency to display on the page
    $number = $row['price'];
    setlocale(LC_MONETARY,"en_NZ");
    $row['price'] = money_format("%.0n", $number);

    // Check that check box returns 1 or null. We needed to display null as No and 1 as Yes
    if ($row['featured_property'] === 1) {
        $row['featured_property'] = "Yes";
      } else {
        $row['featured_property'] = "No";
      }

// Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 1

    // compare stored data to categories table and save ID as string value
    if ($row['categories'] === $row['cat_id']) {
        $row['categories'] = $row['city'];
      }

    // compare stored data to property_type table and save ID as string value
    if ($row['type'] === $row['pt_id']) {
        $row['type'] = $row['type'];
      }

    // Save first and last names into one variable
    $name = $row['first_name'] . " " . $row['surname'];
    // compare stored data to agents table and save ID as string value
    if ($row['agents'] === $row['agent_id']) {
        $row['agents'] = $name;
      }

    // Add + to the end of last select option
    if ($row['bed_no'] === "5") {
        $row['bed_no'] = $row['bed_no'] . " +";
      }

    // Add + to the end of last select option
    if ($row['bath_no'] === "5") {
        $row['bath_no'] = $row['bath_no'] . " +";
      }

    // Add + to the end of last select option
    if ($row['lounge_no'] === "3") {
        $row['lounge_no'] = $row['lounge_no'] . " +";
      }

    // Add + to the end of last select option
    if ($row['garage_no'] === "3") {
        $row['garage_no'] = $row['garage_no'] . " +";
      }

    // Build table row to populate page
    $populate_view_listings = $populate_view_listings . "
    <tr>
        <td><img width='150' src='images/uploads/$row[featured_image]'></td>
        <td> $row[listing_id]<br> <a class='view-listing-edit' href='dashboard-update-listing.php?listing_id=$row[listing_id]'>Edit</a> <a class='view-listing-delete' href='#' onClick='deletelisting($row[listing_id])'>Delete</a> </td>
        <td>$row[agents]</td>
        <td>$row[title]</td>
        <td>$row[address]</td>
        <td>$row[categories]</td>
        <td>$row[type]</td>
        <td>$row[price]</td>
        <td>$row[sell_method]</td>
        <td>$row[bed_no]</td>
        <td>$row[bath_no]</td>
        <td>$row[lounge_no]</td>
        <td>$row[garage_no]</td>
        <td>$row[house_size] m<sup>2</sup></td>
        <td>$row[land_size] m<sup>2</sup></td>
        <td>$row[featured_property]</td>
    </tr>";
 }
    } else {
        $_SESSION["errorMessage"] = "<div class='error-message'>No listings to show</div>";
        $stmt->close();
        exit;
    }
$stmt->close();
