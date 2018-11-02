<!-- Table to show all the bids that are currently in the database -->
<br />
<h3 style="color:white;">Bids in database  
    <button class='btn btn-success' data-toggle='modal' 
            data-target='#createBidModal'>
            Create Bid
    </button> 
</h3>
       
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Ride ID</th>
            <th scope='col'>Passenger's Email</th>
            <th scope='col'>Bid</th>
            <th scope='col'>Delete</th>
            <th scope='col'>Edit</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_admin_bids_list()");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        echo "<tr>
            <th scope='row'>".$index."</th>
            <td>".$row["r_id"]."</td>
            <td>".$row["p_email"]."</td>
            <td>".$row["bid"]."</td>
            <td><a href='/demo/actions/delete_bid.php?id=".urlencode($row["r_id"])."'>
                    <button class='btn btn-outline-danger'>
                        Delete bid
                    </button>
                </a>
            </td>
            <td><a href='/demo/admin_update_bid.php?id=".urlencode($row["r_id"]).
                "&email=".urlencode($row["p_email"]).
                "&bid=".urlencode($row["bid"])."'>
                    <button class='btn btn-outline-primary'>
                        Edit bid
                    </button>
                </a>
            </td>
            </tr>";
        $index++;
    }
?>

    </tbody>
</table>

<!-- Modal -->
<div class='modal fade' id='createBidModal' tabindex='-1' role='dialog' 
aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header text-center'>
        <h1 class='modal-title w-100' id='exampleModalLabel'>
            <i class='fas fa-car'></i>
            <p>Create New Bid</p>
        </h1>
      </div>
      <form method='POST'>
      <div class='modal-body'>
            <div class="form-group">
                <h3>Ride ID: </h3>
                <input type="number" class="form-control" name="id"
                placeholder="ID of Ride" required>
            </div>
            <div class='form-group'>
                <h3>Passenger email: </h3>
                <input type='email' class='form-control' name='email' 
                    placeholder='example@email.com' required>
            </div>
            <div class='form-group'>
                <h3>Bid: </h3>
                <input type='text' class='form-control' name='bid_amt' 
                required>
            </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='bid'>New bid</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  	// Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
        
    if (isset($_POST['bid'])) {
        //Execute query
        //Check that the passengers has the user that I typed in
        $result = pg_query($db,"SELECT user_bid_func('$_POST[email]', $_POST[id], $_POST[bid_amt])");

        if (!$result) {
            echo 'error occured!';
        } else {
            echo "
            <script>
                window.location = '/demo/admin';
            </script>";
        }
        
    }
?>  
