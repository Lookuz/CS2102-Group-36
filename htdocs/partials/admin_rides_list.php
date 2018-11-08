<!-- Table to show all the rides that are currently available in the database -->
<br />
<h3 style="color:white;">Rides in database
    <button class='btn btn-success' data-toggle='modal' 
            data-target='#createRideModal'>
            Create ride
    </button> 
</h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Ride ID</th>
            <th scope='col'>Car plate</th>
            <th scope='col'>Date</th>
            <th scope='col'>Time</th>
            <th scope='col'>Origin</th>
            <th scope='col'>Destination</th>
            <th scope='col'>Status</th>    
            <th scope='col'>Edit</th>
            <th scope='col'>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_admin_rides_list()");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        echo "<tr>
            <th scope='row'>".$index."</th>
            <td>".$row["r_id"]."</td>
            <td>".$row["c_plate"]."</td>
            <td>".$row["r_date"]."</td>
            <td>".$row["r_time"]."</td>
            <td>".$row["r_origin"]."</td>
            <td>".$row["r_destination"]."</td>
            <td>".$row["a_status"]."</td>
            <td><a href='/demo/admin_update_ride.php?id=".urlencode($row["r_id"])."'>
                    <button class='btn btn-outline-primary'>
                        Edit ride
                    </button>
                </a>
            </td>
            <td><a href='/demo/actions/delete_ride.php?id=".urlencode($row["r_id"])."'>
                    <button class='btn btn-outline-danger'>
                        Delete ride
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
<div class='modal fade' id='createRideModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header text-center'>
        <h1 class='modal-title w-100'>
            <i class='fas fa-car'></i>
            <p>Create New Ride</p>
        </h1>
      </div>
      <form method='POST'>
      <div class='modal-body'>
            <div class="form-group">
                <h3>Carplate</h3>
                <input type="text" class="form-control" name="carplate"
                placeholder="Carplate of car" required>
            </div>
            <div class='form-group'>
                <h3>Date</h3>
                <input type='date' class='form-control' name='date' required>
            </div>
            <div class='form-group'>
                <h3>Time</h3>
                <input type='text' class='form-control' name='time' 
                    placeholder='HH:MM:SS' required>
            </div>
            <div class='form-group'>
                <h3>Origin</h3>
                <input type='text' class='form-control' name='origin' 
                    placeholder='Origin' required>
            </div>
            <div class='form-group'>
                <h3>Destination</h3>
                <input type='text' class='form-control' name='destination' 
                    placeholder='Destination' required>
            </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='create_ride'>New Ride</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  	// Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
        
    if (isset($_POST['create_ride'])) {
        //Execute query
        //Check that the passengers has the user that I typed in
        $result = pg_query($db,"SELECT create_ride('$_POST[carplate]', '$_POST[date]', '$_POST[time]'".
            ", '$_POST[origin]', '$_POST[destination]')");

        if (!$result) {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Ride Creation Error
                </div>
            </div>";
        } else {
            echo "
            <script>
                window.location = '/demo/admin_rides.php';
            </script>";
        }
        
    }
?>  