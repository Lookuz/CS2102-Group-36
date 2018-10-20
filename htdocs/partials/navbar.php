<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
    <a class='navbar-brand' href='/demo/index'><h3>Carpool CS2102</h3></a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarNav' aria-controls='navbarNav' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='collapse navbar-collapse' id='navbarNav'>
        <ul class='navbar-nav'>
            <li class='nav-item'>
                <a class='nav-link' href='/demo/index'>
                    Home
                </a>
            </li>;
            <?php if (isset($_SESSION['username'])) {
                echo "<li class='nav-item'>";
                if ($_SESSION['isDriver'] == FALSE) {
                    echo "<a class='nav-link' href='/demo/driver_signup'>";
                } else {
                    echo "<a class='nav-link' href='/demo/driver'>";
                }     
                echo "Offer My Ride</a>
                    </li>";
            }
        echo " </ul>";
        if(!isset($_SESSION['username'])) {
        echo "
        <ul class='navbar-nav ml-auto'>
            <li class='nav-item'>
                <a class='nav-link' href='#'>
                    <button class='btn btn-dark' data-toggle='modal' 
                    data-target='#loginModal'>Login</button>
                </a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='/demo/signup'>
                    <button class='btn btn-dark'>Signup</button>
                </a>
            </li>
        </ul>";
        } else {
            echo "<ul class='navbar-nav ml-auto'>
                <li class='nav-item'>
                    <a class='nav-link active' href='/demo/actions/logout.php'>
                        <button class='btn btn-dark'>Logout</button>
                    </a>
                </li>
            </ul>";
        } ?>
    </div>
</nav>

<!-- Modal -->
<div class='modal fade' id='loginModal' tabindex='-1' role='dialog' 
aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header text-center'>
        <h1 class='modal-title w-100' id='exampleModalLabel'>
            <i class='fas fa-car'></i>
            <p>Carpool CS2102</p>
        </h1>
      </div>
      <form method='POST'>
      <div class='modal-body'>
            <div class='form-group'>
                <h3>Email: </h3>
                <input type='email' class='form-control' name='email' 
                    placeholder='example@email.com' required>
            </div>
            <div class='form-group'>
                <h3>Password: </h3>
                <input type='password' class='form-control' name='password' 
                    placeholder='Password' required>
            </div>
      </div>
      <div class='modal-footer'>
        <a class='small mr-auto' href='/demo/signup' >Don't have an account?</a>
        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='Login'>Login</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
  	    // Connect to the database. Please change the password in the following line accordingly
        include 'partials/connection.php';
        
        if (isset($_POST['Login'])) {
        //Execute query
        //Check that the passengers has the user that I typed in
        $result = pg_query($db,"SELECT u_email, u_password, u_name
        FROM Users
        WHERE u_email = '$_POST[email]'
        AND u_password = '$_POST[password]'");

        if (!$result) {
            echo 'error occured!';
            exit;
        }

        if(pg_num_rows($result) != 0) {
            $row = pg_fetch_assoc($result);
            session_start();
            $_SESSION['username'] = $row['u_name'];
            $_SESSION['email'] = $row['u_email'];

            /* Check if the current user is a driver
                and retain the info in the session */
            $driver_result = pg_query($db, "SELECT *
            FROM drivers d 
            WHERE d.d_email = '$row[u_email]'
            ");

            //The user has a car
            if(pg_num_rows($driver_result) != 0) {
                $_SESSION['isDriver'] = true;
            } else {
                $_SESSION['isDriver'] = false;
            }

            header('Location: /demo/index');
            exit;
            //echo ''$_SESSION[username]' <br />';
        } else {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Email or password invalid.
                </div>
            </div>";
        }
    }
?>  