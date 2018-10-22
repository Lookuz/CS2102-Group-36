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
                      <h2>Register as a driver</h2>
                      <br />
                      <form action="driver_signup.php" method="POST">
                          <div class="form-group">
                              <h3>Car License Plate: </h3>
                              <input type="text" class="form-control" name="c_plate"
                              placeholder="SKK2102J" required>
                          </div>
                          <div class="form-group">
                              <h3>Car Brand: </h3>
                              <input type="text" class="form-control" name="c_brand"
                                  placeholder="Honda" required>
                          </div>
                          <div class="form-group">
                              <h3>Car Model: </h3>
                              <input type="text" class="form-control" name="c_model"
                                  placeholder="Vezel" required>
                          </div>
                          <input class="btn btn-primary" type="submit" name="driver_signup" />
                      </form>
                  </div>
              </div>
          </div>
        </div>
    <?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
    
    if (isset($_POST['driver_signup'])) {
      $email = $_SESSION['email'];
      $result = pg_query($db,"INSERT INTO drivers(c_plate, d_email, c_brand, c_model)
      VALUES('$_POST[c_plate]', '$email', '$_POST[c_brand]', '$_POST[c_model]')");

      if (!$result) {
        echo "Error registering as driver.\n";
      } else {
        echo "success";
        $_SESSION['isDriver'] = true;
        $_SESSION['c_plate'] = $_POST{'c_plate'};
        // Direct to Advertise Ride page
        header("Refresh:0; url=driver.php");
      }
    }
    ?>
    <?php include 'partials/script.php'; ?>
</body>
