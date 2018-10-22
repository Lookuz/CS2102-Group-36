<!-- Table to show all the rides that the user has bidded  -->
    <h3 style="color:white;">Your bids:</h3>
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
            <th scope='col'>Your bid</th>
            <th scopr='col'>Delete</th>
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
        FROM rides r, bids b
        WHERE r.a_status='AVAILABLE'
        AND b.p_email = '$_SESSION[email]'
        AND r.d_email = b.d_email
        AND r.c_plate = b.c_plate
        AND r.r_date = b.r_date
        AND r.r_time = b.r_time 
        ");


    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        $highest_result = pg_query($db, "SELECT max(b.bid)
            FROM bids b
            WHERE b.d_email = '$row[d_email]'
            AND b.c_plate ='$row[c_plate]'
            AND b.r_date = '$row[r_date]'
            AND b.r_time = '$row[r_time]'
        ");

        $user_highest_result = pg_query($db, "SELECT max(b.bid)
            FROM bids b
            WHERE b.d_email = '$row[d_email]'
            AND b.c_plate ='$row[c_plate]'
            AND b.r_date = '$row[r_date]'
            AND b.r_time = '$row[r_time]'
            AND p_email = '$_SESSION[email]'
        ");
        
        $highest = pg_fetch_row($highest_result);
        $user_highest = pg_fetch_row($user_highest_result);

        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["r_date"]."</td>
            <td>".$row["r_time"]."</td>
            <td>".$row["r_origin"]."</td>
            <td>".$row["r_destination"]."</td>
            <td>".$highest[0]."</td>
            <td>".$user_highest[0]."</td>
            <td><a href='/demo/delete_bid.php?date=".urlencode($row["r_date"]).
            "&time=".urlencode($row["r_time"]).
            "&origin=".urlencode($row["r_origin"]).
            "&destination=".urlencode($row["r_destination"]).
            "&plate=".urlencode($row["c_plate"])."'>
                <button class='btn btn-outline-danger'>
                    Delete
                </button>
            </a></td>
            </tr> 
        ";
        $index++;
    }
?>
    </tbody>
</table>