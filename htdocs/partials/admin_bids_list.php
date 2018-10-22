<!-- Table to show all the bids that are currently in the database -->
<h3 style="color:white;">Bids in database:</h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Driver's Email</th>
            <th scope='col'>Car plate</th>
            <th scope='col'>Date</th>
            <th scope='col'>Time</th>
            <th scope='col'>Bidder's Email</th>
            <th scope='col'>Bid</th>
            <th scope='col'>Delete</th>
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
    $result = pg_query($db, "SELECT * 
        FROM bids");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        echo "<tr>
            <th scope='row'>".$index."</th>
            <td>".$row["d_email"]."</td>
            <td>".$row["c_plate"]."</td>
            <td>".$row["r_date"]."</td>
            <td>".$row["r_time"]."</td>
            <td>".$row["p_email"]."</td>
            <td>".$row["bid"]."</td>
            <td><a href='/demo/actions/delete_bid.php?d_email=".$row["d_email"].
            "&plate=".$row["c_plate"].
            "&date=".$row["r_date"].
            "&time=".$row["r_time"].
            "&p_email=".$row["p_email"]."'>
                    <button class='btn btn-outline-danger'>
                        Delete user
                    </button>
                </a>
            </td>
            </tr>";
        $index++;
    }
?>

    </tbody>
</table>