<!DOCTYPE html>
<?php
session_start();
include 'partials/head.php'; ?>
<body>
<?php include 'partials/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 my-3">
            <div class="bg-light rounded p-3">
                <h3>Advertise Ride</h3>
                <br />
                <form action="driver.php" method="POST">
                    <div class="form-group">
                        <h4>Origin: </h4>
                        <input type="text" class="form-control" name="r_origin"
                               placeholder="SoC, NUS" required>
                    </div>
                    <div class="form-group">
                        <h4>Destination: </h4>
                        <input type="text" class="form-control" name="r_destination"
                               placeholder="NBS, NTU" required>
                    </div>
                    <div class="form-group">
                        <h4>Date: </h4>
                        <input type="date" class="form-control" name="r_date" required>
                    </div>
                    <div class="form-group">
                        <h4>Time: </h4>
                        <input type="time" class="form-control" name="r_time" required>
                    </div>
                    <input class="btn btn-primary" type="submit" name="driver" />
                </form>
            </div>
        </div>
        <form method="post">
         <input name="unregister" type="submit" class="position-absolute btn btn-danger" style="top:90px; right:20px;" value="Unregister as driver" />
        </form>
    </div>

    <?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
    if(isset($_POST['unregister'])) {
      $email = $_SESSION['email'];
      $result = pg_query($db, "SELECT unregister_as_driver('$email')");
      $_SESSION['isDriver'] = false;
      echo "
      <script>
          window.location = '/demo/driver_signup';
      </script>";
    }

    if(isset($_POST['driver'])) {
        $email = $_SESSION['email'];
        $c_plate = $_SESSION['c_plate'];
        if(!$c_plate) {
            echo 'no car plate';
        }
        $result = pg_query($db, "SELECT offer_a_ride('$c_plate', '$_POST[r_date]', '$_POST[r_time]', '$_POST[r_origin]', '$_POST[r_destination]')");
        
        if (!$result) {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Error Creating Ride
                </div>
            </div>";
        } else {
            echo "
            <script>
                window.location = '/demo/driver.php';
            </script>";
        }
    }
    ?>
    <br />
    <?php if(isset($_SESSION['username'])) {
        echo"<br />";
        include 'partials/driver_list.php';
    }
    ?>
</div>
<?php include 'partials/script.php'; ?>
</body>
