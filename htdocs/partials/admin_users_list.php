<!-- Table to show all the rides that are currently available in the
    advertise table -->
    <h3 style="color:white;">Users in database
        <button class='btn btn-success' data-toggle='modal' 
                data-target='#createUserModal'>
                New User
        </button>
    </h3>
<br />
<table class='table table-dark'>
    <thead class='thead'>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Email</th>
            <th scope='col'>Username</th>
            <th scope='col'>Password</th>
            <th scope='col'>IsAdmin</th>
            <th scope='col'>Edit</th>
            <th scope='col'>Delete</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    //Initialize result
    $result = pg_query($db, "SELECT * FROM get_admin_user_list()");

    if (!$result) {
        echo 'Query error';
    }

    $index = 1;

    while($row=pg_fetch_assoc($result)) {
        echo "
            <tr>
            <th scope='row'>".$index."</th>
            <td>".$row["u_email"]."</td>
            <td>".$row["u_name"]."</td>
            <td>".$row["u_password"]."</td>
            <td>".$row["isadmin"]."</td>
            <td>
                <a href='/demo/admin_update_user.php?email=".urlencode($row["u_email"])."'>
                    <button class='btn btn-outline-primary'>
                        Edit user
                    </button>
                </a>
            </td>
            <td>
                <a href='/demo/actions/delete_user.php?email=".urlencode($row["u_email"])."'>
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
<div class='modal fade' id='createUserModal' tabindex='-1' role='dialog'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header text-center'>
        <h1 class='modal-title w-100' id='exampleModalLabel'>
            <i class='fas fa-car'></i>
            <p>Create New User</p>
        </h1>
      </div>
      <form method='POST'>
      <div class='modal-body'>
            <div class="form-group">
                <h3>Email: </h3>
                <input type="email" class="form-control" name="email"
                placeholder="Email" required>
            </div>
            <div class='form-group'>
                <h3>Password</h3>
                <input type='password' class='form-control' name='password' 
                    placeholder="Password" required>
            </div>
            <div class='form-group'>
                <h3>Username</h3>
                <input type='text' class='form-control' name='username' 
                required>
            </div>
            <div class='form-check'>
                <input class='form-check-input' type='checkbox' id='isAdmin' name='isAdmin'>
                    <label class='form-check-label' for='isAdmin'>
                        Administrator rights
                    </label>
            </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='create_user'>Create User</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  	// Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
        
    if (isset($_POST['create_user'])) {
        //Execute query
        //Check that the passengers has the user that I typed in
        $result = pg_query($db,"SELECT create_user('$_POST[email]', '$_POST[password]', '$_POST[username]')");

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