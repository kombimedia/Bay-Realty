<?php
$populate_our_team = "";
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
    $name = $row['first_name'] . " " . $row['surname'];
    $populate_our_team = $populate_our_team . "
    <tr>
        <td><img width='70' height='70' src='images/uploads/$row[profile_pic]'></td>
        <td>$name<br>$row[phone]<br><a href='mailto:$row[email]'>$row[email]</a><br>$row[area_id]</td>
    </tr>";

  }
}
$stmt->close();
// <td>$row[email]<br>$row[area_id]</td>
