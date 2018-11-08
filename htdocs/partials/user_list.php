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
            <th scope='col'>Bid Status</th>
            <th scopr='col'>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
    
    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_user_list('$_SESSION[email]')");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        $user_bids_result = pg_query($db, "SELECT get_user_bid_func('$_SESSION[email]', $row[r_id])");
        $user_bid = pg_fetch_result($user_bids_result, 0, 0);

        if (empty($user_bid)) {
            $user_bid = 0;
        }

        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["r_date_res"]."</td>
            <td>".$row["r_time_res"]."</td>
            <td>".$row["r_origin_res"]."</td>
            <td>".$row["r_destination_res"]."</td>
            <td>".$row["max_bid"]."</td>
            <td>".$user_bid."</td>
            <td>".$row["b_status"]."</td>
            <td><a href='/demo/delete_bid.php?id=".$row["r_id"]."'>
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