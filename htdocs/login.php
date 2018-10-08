<!DOCTYPE html>
<?php 
    session_start();
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 my-3">
                <div class="border border-primary rounded p-3">
                    <h2>Login</h2>
                    <br />
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <h3>Email: </h3>
                            <input type="email" class="form-control" name="email" 
                            placeholder="example@email.com" required>
                        </div>
                        <div class="form-group">
                            <h3>Password: </h3>
                            <input type="password" class="form-control" name="password" 
                                placeholder="Password" required>
                        </div>
                        <a class="small" href="/demo/signup">Don't have an account?</a>
                        <input class="btn btn-primary" type="submit" name="Login" />
                    </form>
                </div>
            </div> 
        </div> 
    </div>

    <?php
  	// Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=Project user=postgres password=2012");
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

            header("Location: /demo/index");
            exit;
            //echo "'$_SESSION[username]' <br />";
        } else {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Email or password invalid.
                </div>
            </div>";
        }
    }
    ?>  

    <?php include 'partials/script.php'; ?>
</body>
