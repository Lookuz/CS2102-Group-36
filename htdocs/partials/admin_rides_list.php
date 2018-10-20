<!-- Table to show all the rides that are currently available in the database -->
<h3 style="color:white;">Rides in database:</h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Email</th>
            <th scope='col'>Car plate</th>
            <th scope='col'>Date</th>
            <th scope='col'>Time</th>
            <th scope='col'>Origin</th>
            <th scope='col'>Destination</th>
            <th scope='col'>Status</th>
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
        FROM rides");

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
            <td>".$row["r_origin"]."</td>
            <td>".$row["r_destination"]."</td>
            <td>".$row["a_status"]."</td>
            <td><a href='/demo/actions/delete_ride.php?email=".$row["d_email"].
            "&plate=".$row["c_plate"].
            "&date=".$row["r_date"].
            "&time=".$row["r_time"]."'>
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