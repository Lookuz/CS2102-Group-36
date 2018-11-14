<!-- Table to show all the bidders for this ride -->
<h3 class= 'offset-md-2'style="color:white;">Bidders for this ride:</h3>
<br />
<table class='table table-dark offset-md-2 col-md-8'>
    <thead class='thead'>
    <tr>
        <th scope='col'>#</th>
        <th scope='col'>Passenger</th>
        <th scope='col'>Bid</th>
        <th scope='col'> </th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $ride_id = $_GET["id"];
    $result = pg_query($db, "SELECT *
        FROM bids b
        WHERE b.r_id = $ride_id
        ORDER BY b.bid DESC
        ");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {

        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["p_email"]."</td>
            <td>".$row["bid"]."</td>
            <td>
              <a href='/demo/actions/accept_bid.php?rideid=".urlencode($ride_id)."&passenger=".$row["p_email"]."'>
                <button class='btn btn-outline-primary'/>Select</button>
                </a>
            </td>
            </tr>";
        $index++;
    }
    ?>

    </tbody>
</table>

<!-- <td>
  <a href='/demo/bidpage.php?id=".urlencode($row["r_id"])."'>
    <button class='btn btn-outline-primary'/>Select</button>
    </a>
</td> -->
