<!-- Table to show all the rides that are currently available in the
    advertise table -->
    <br />
    <h3 style="color:white;">Drivers in database
        <button class='btn btn-success' data-toggle='modal' 
                data-target='#createDriverModal'>
                New Driver
        </button>
    </h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Carplate</th>
            <th scope='col'>Email</th>
            <th scope='col'>Brand</th>
            <th scope='col'>Model</th>
            <th scope='col'>Edit</th>
            <th scope='col'>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_admin_drivers_list()");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["c_plate"]."</td>
            <td>".$row["d_email"]."</td>
            <td>".$row["c_brand"]."</td>
            <td>".$row["c_model"]."</td>
            <td>
                <a href='/demo/admin_update_driver.php?carplate=".urlencode($row["c_plate"])."'>
                    <button class='btn btn-outline-primary'>
                        Edit driver
                    </button>
                </a>
            </td>
            <td>
                <a href='/demo/actions/delete_driver.php?carplate=".urlencode($row["c_plate"])."'>
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

<!-- Modal -->
<div class='modal fade' id='createDriverModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header text-center'>
        <h1 class='modal-title w-100' id='exampleModalLabel'>
            <i class='fas fa-car'></i>
            <p>Create New Driver</p>
        </h1>
      </div>
      <form method='POST'>
      <div class='modal-body'>
            <div class="form-group">
                <h3>Carplate</h3>
                <input type="text" class="form-control" name="carplate"
                placeholder="Carplate" required>
            </div>
            <div class='form-group'>
                <h3>Driver's Email</h3>
                <input type='email' class='form-control' name='email' 
                    placeholder="Email" required>
            </div>
            <div class='form-group'>
                <h3>Car brand</h3>
                <input type='text' class='form-control' name='brand' 
                required>
            </div>
            <div class='form-group'>
                <h3>Model</h3>
                <input type='text' class='form-control' name='model' 
                required>
            </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='create_driver'>Create Driver</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  	// Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
        
    if (isset($_POST['create_driver'])) {
        //Execute query
        //Check that the passengers has the user that I typed in
        $result = pg_query($db,"SELECT create_driver('$_POST[carplate]', '$_POST[email]', '$_POST[brand]', '$_POST[model]')");

        if (!$result) {
            echo "<div class='container p-3'>
            <div class='alert alert-danger'>
                Creating Driver Error
            </div>
        </div>";
        } else {
            echo "
            <script>
                window.location = '/demo/admin';
            </script>";
        }
        
    }
?>  