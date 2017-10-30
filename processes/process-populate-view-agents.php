<?php
$populate_view_agents = "";

$stmt = $mysqli->prepare("SELECT agents.agent_id, agents.first_name, agents.surname, agents.email, agents.phone, agents.description, agents.area_id, agents.profile_pic, categories.cat_id, categories.city FROM agents INNER JOIN categories ON agents.area_id = categories.cat_id ORDER BY agents.agent_id ASC");
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
    // Save first and last names to one variable
    $name = $row['first_name'] . " " . $row['surname'];
    // Limit description output to 150 characters
    $row['description'] = substr($row['description'], 0, 150);

    // Build table row to populate page
    $populate_view_agents = $populate_view_agents . "
    <tr>
        <td><img width='100' height='100' src='images/uploads/$row[profile_pic]'></td>
        <td> $row[agent_id]<br> <a class='view-agents-edit' href='dashboard-update-agent.php?agent_id=$row[agent_id]'>Edit</a> <a class='view-agents-delete' href='#' onClick='deleteAgent($row[agent_id])'>Delete</a> </td>
        <td>$name</td>
        <td>$row[email]</td>
        <td>$row[phone]</td>
        <td>$row[description]...</td>
        <td>$row[area_id]</td>
    </tr>";
  }
} else {
        $_SESSION["errorMessage"] = "<div class='error-message'>No listings to show</div>";
    }
$stmt->close();
