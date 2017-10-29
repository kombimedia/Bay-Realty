<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
$display_agent = "";

$listing_id = $_GET['listing_id'];




 $stmt = $mysqli->prepare("SELECT first_name, surname, email, phone, description, profile_pic FROM agents  ORDER BY RAND() LIMIT 1");

 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $first_name = $row['first_name'];
      $surname = $row['surname'];
      $email = $row['email'];
      $phone = $row['phone'];
      $picture = $row['profile_pic'];
      $description = $row['description'];


      $display_agent = $display_agent . "
      <tr>

      <td>

      <img src='images/uploads/$picture' alt='Agent pic' class='rounded-circle'><br>
      <h4 style='text-align: center'>$first_name  $surname </h4>

      <a href='tel:$phone'><i class='fa fa-phone pr-2' aria-hidden='true'></i> $phone</a><br>
      <a class='email' href='mailto:$email' style='color: #42b3f4'><i class='fa fa-envelope pr-2' aria-hidden='true'></i> $email<br></a>
      <button type='button' class='btn btn-info agent-btn' data-toggle='collapse' data-target='#demo'>View Profile...</button>
       <div id='demo' class='collapse'>
      <p class='agent-descr'>$description</p></td></tr>
      </div>";




}

$stmt->close();
} else{
  echo "no listins to show";
}

?>
