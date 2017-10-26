<?php
// Populate Latest Listings
$populate_dashboard_listings = "";
$stmt = $mysqli->prepare("SELECT properties.listing_id, properties.agents, properties.title, properties.address, properties.categories, properties.price, properties.sell_method, properties.featured_image, categories.cat_id, categories.city, agents.agent_id, agents.first_name, agents.surname FROM properties INNER JOIN categories ON properties.categories = categories.cat_id  INNER JOIN agents ON properties.agents = agents.agent_id ORDER BY properties.listing_id DESC LIMIT 4");
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

// Category and agent are stored in the properties table as their ID. To convert this id to the string value we needed compare the Id to the corresponding table (categories and agents) then output the matching value string e.g Cy Messenger instead of 1

    // compare stored data to categories table and save ID as string value
    if ($row['categories'] === $row['cat_id']) {
        $row['categories'] = $row['city'];
      }

    // Save first and last names into one variable
    $name = $row['first_name'] . " " . $row['surname'];
    // compare stored data to agents table and save ID as string value
    if ($row['agents'] === $row['agent_id']) {
        $row['agents'] = $name;
      }

    $populate_dashboard_listings = $populate_dashboard_listings . "
    <tr>
        <td><img width='150' src='images/uploads/$row[featured_image]'></td>
        <td> $row[listing_id]</td>
        <td>$row[agents]</td>
        <td>$row[title]</td>
        <td>$row[address]</td>
        <td>$row[categories]</td>
        <td>$row[price]</td>
        <td>$row[sell_method]</td>
    </tr>";
 }
    } else {
        $_SESSION["errorMessage"] = "<div class='error-message'>No listings to show</div>";
        $stmt->close();
        exit;
    }
$stmt->close();

// Populate Newest Agents
$populate_dashboard_agents = "";
$stmt = $mysqli->prepare("SELECT agents.agent_id, agents.first_name, agents.surname, agents.email, agents.phone, agents.area_id, agents.profile_pic, categories.cat_id, categories.city FROM agents INNER JOIN categories ON agents.area_id = categories.cat_id ORDER BY agents.agent_id DESC LIMIT 4");
$stmt->execute();
$result = $stmt->get_result();
// Check if there are any records to show
if($result->num_rows > 0) {
  // Loop through data and save each row array to a variable
  while($row = $result->fetch_assoc()) {

    // compare stored data to categories table and save ID as string value
    if ($row['area_id'] === $row['cat_id']) {
        $row['area_id'] = $row['city'];
      }
    $name = $row['first_name'] . " " . $row['surname'];
    $populate_dashboard_agents = $populate_dashboard_agents . "
    <tr>
        <td><img width='100' height='100' src='images/uploads/$row[profile_pic]'></td>
        <td> $row[agent_id]</td>
        <td>$name</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[area_id]</td>
    </tr>";

  }
}
$stmt->close();

// Populate Latest Users
$populate_dashboard_users = "";
$stmt = $mysqli->prepare("SELECT users.user_id, users.first_name, users.surname, users.email, users.role, user_roles.role_id, user_roles.user_role FROM users INNER JOIN user_roles ON users.role = user_roles.role_id ORDER BY users.user_id DESC LIMIT 4");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['role'] === $row['role_id']) {
            $row['role'] = $row['user_role'];
        }
        $name = $row['first_name'] . " " . $row['surname'];
        $populate_dashboard_users = $populate_dashboard_users . "
            <tr>
                <td>$row[user_id]</td>
                <td>$name</td>
                <td>$row[email]</td>
                <td>$row[role]</td>
            </tr>";
          }
        } else {
            $_SESSION["imageError"] = "<div class='error-message'>No User accounts to show</div>";
        }
$stmt->close();
