<!DOCTYPE html>
<?php session_start();
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 my-3">
                    <div class="border border-primary rounded p-3">
                        <h3>Advertise Ride</h3>
                        <br />
                        <form action="driver.php" method="GET">
                            <div class="form-group">
                                <h4>Origin: </h4>
                                <input type="text" class="form-control"
                                       name="r_origin" required>
                            </div>
                            <div class="form-group">
                                <h4>Destination: </h4>
                                <input type="text" class="form-control"
                                       name="r_destination" required>
                            </div>
                            <div class="form-group">
                                <h4>Start Time: </h4>
                                <input type="text" class="form-control"
                                       name="r_time" required>
                            </div>
                            <input class="btn btn-primary" type="submit" name="advertised" />
                        </form>
                    </div>
                </div>
            </div>
            <br />
            <?php include 'partials/available_list.php';
            if (isset($_SESSION['username'])) {
                echo"<br />";
                include 'partials/driver_list.php';
            }
            ?>
        </div>
    <?php
    // Connect to the database. Please change the password in the following line accordingly
    $db = pg_connect("host=localhost port=5432 dbname=Project user=postgres password=2012");

    if (isset($_GET['advertised'])) {
        $email = $_SESSION['email'];
        $c_plate = $_SESSION['c_plate'];
        $result = pg_query($db,"INSERT INTO rides
            VALUES('$email', '$c_plate', '$_GET[r_date]', '$_GET[r_time]', 
            '$_GET[r_origin]', '$_GET[r_destination]', 'AVAILABLE')");

        if (!$result) {
            echo "Error advertising ride.\n";
        } else {
            echo "success";
        }
    }
    ?>
    <?php include 'partials/script.php'; ?>
</body>