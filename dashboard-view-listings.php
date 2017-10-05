<?php
session_start();
$title = "View Listings";
$metaD = "Admin dashboard page, view listings";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>

<?php

$getData1 = "SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_image, featured_property  FROM properties";
        $result1 = $mysqli->query($getData1);
        // Check if there are any records to show
        if ($result1->num_rows > 0) {
            // output data of each rowi
            while($row1 = $result1->fetch_assoc()) {
                    echo  "<table cellpadding='10'>";
                    echo  "<tr>";
                    echo  "<td class='odd'><img width='100' src='images/uploads/" . $row1['featured_image'] . "'></td>";
                    echo  "<td class='odd' width='80'>" . $row1['listing_id'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['agents'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['title'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['address'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['categories'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['type'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['price'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['sell_method'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['bed_no'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['bed_des'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['bath_no'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['bath_des'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['lounge_no'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['lounge_des'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['garage_no'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['garage_des'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['house_size'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['land_size'] . "</td>";
                    echo  "<td class='odd' width='80'>" . $row1['map_co_ords'] . "</td>";
                    echo  "<td class='even' width='80'>" . $row1['featured_property'] . "</td>";
                    echo  "</tr>";
                    echo  "</table>";
                    echo  "<hr>";
            }
        } else {
            echo "No property listings to show";
        }

?>

<?php
include 'includes/dashboard-footer.php';
?>



