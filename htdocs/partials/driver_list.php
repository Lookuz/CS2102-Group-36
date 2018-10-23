<!-- Table to show all the rides that the driver has advertised -->
<h3 style="color:white;">Your rides:</h3>
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
        <th scope='col'>Status</th>

    </tr>
    </thead>
    <tbody>
    <?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $result = pg_query($db, "SELECT * 
        FROM rides r
        WHERE r.c_plate = '$_SESSION[c_plate]'
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
            <td>".$highest[0]."</td>
            <td>".$row["a_status"]."</td>
            </tr>";
        $index++;
    }
    ?>

    </tbody>
</table>