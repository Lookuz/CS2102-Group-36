<!-- Table to show all the rides that are currently available in the
    advertise table -->
<h3 style="color:white;">Available rides:</h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Date</th>
            <th scope='col'>Time</th>
            <th scope='col'>Origin</th>
            <th scope='col'>Destination</th>
            <th scope='col'>Highest Bid</th>
            <?php if (isset($_SESSION['email'])) {
                echo "<th scope='col'>Bid</th>";
            } ?>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    if (!$db) {
        echo 'Error Connecting';
    }

    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_available_list('$_SESSION[email]')");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        if (empty($row["max_bid"])) {
            $row["max_bid"] = 0;
        }

        if (!empty($_GET["from"]) && (strpos($row["r_origin_res"], $_GET["from"]) === FALSE)) {
            continue;
        }

        if (!empty($_GET["to"]) && (strpos($row["r_destination_res"], $_GET["to"]) === FALSE)) {
            continue;
        }

        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["r_date_res"]."</td>
            <td>".$row["r_time_res"]."</td>
            <td>".$row["r_origin_res"]."</td>
            <td>".$row["r_destination_res"]."</td>
            <td>".$row["max_bid"]."</td>
            <td><a href='/demo/bidpage.php?id=".urlencode($row["r_id"])."'>
                <button class='btn btn-outline-primary'/>Bid here</button>
            </a></td>
            </tr>";
        $index++;
    }
?>

    </tbody>
</table>
