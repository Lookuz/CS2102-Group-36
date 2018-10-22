<!-- Table to show all the rides that the driver has advertised -->
<h3>Advertised rides:</h3>
<br />
<table class='table'>
    <thead class='thead-dark'>
    <tr>
        <th scope='col'>#</th>
        <th scope='col'>Date</th>
        <th scope='col'>Time</th>
        <th scope='col'>Origin</th>
        <th scope='col'>Destination</th>
        <th scope='col'>Highest Bid</th>
        <th scope='col'>Status</th>

    </tr>
    </thead>
    <tbody>
<?php
// Connect to the database. Please change the password in the following line accordingly
$db = pg_connect("host=localhost port=5432 dbname=Project user=postgres password=2012");

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

    $highest = pg_fetch_row($highest_result);

    echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["r_date"]."</td>
            <td>".$row["r_time"]."</td>
            <td>".$row["r_origin"]."</td>
            <td>".$row["r_destination"]."</td>
            <td>".$highest[0]."</td>";
    if (isset($_SESSION['email'])) {
        echo "<td><a href='/demo/bidding.php?date=".urlencode($row["r_date"]).
            "&time=".urlencode($row["r_time"]).
            "&origin=".urlencode($row["r_origin"]).
            "&destination=".urlencode($row["r_destination"])."'>
                <button class='btn btn-outline-primary'/>Bid here</button>
                </a></td>";
    }
    echo "
            <td>".$row["a_status"]."</td>
            </tr>";
        $index++;
    }
    ?>

    </tbody>
</table>