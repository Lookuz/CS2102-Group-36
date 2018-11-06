<?php session_start(); 
    include 'partials/head.php';
    include 'partials/connection.php';

    $ride_query = pg_query($db, "SELECT * FROM rides WHERE r_id ='$_GET[id]'");
    $row = pg_fetch_assoc($ride_query);
?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="row my-4" style="color:white;">
                <div class="offset-md-4 col-md-4">
                    <form method="POST">
                        <?php  
                            echo "<h1>Update Ride</h1>";
                            echo "<label for='rideID'>Ride ID</label>";
                            echo "<input type='text' id='rideID' name='id' class='form-control' value='"
                                .$row["r_id"]."' required autofocus>";
                            echo "<label for='carplate'>Carplate</label>";
                            echo "<input type='text' id='carplate' name='carplate' class='form-control'
                                value='".$row["c_plate"]."' required>";
                            echo "<label for='date'>Date</label>";
                            echo "<input type='text' id='date' class='form-control' name='date' value='"
                                .$row["r_date"]."' required>";
                            echo "<label for='time'>Time</label>";
                            echo "<input type='text' id='time' class='form-control' name='time' value='"
                                .$row["r_time"]."' placeholder='HH:MM:SS' required>";
                            echo "<label for='origin'>Origin</label>";
                            echo "<input type='text' id='origin' class='form-control' name='origin' value='"
                                    .$row["r_origin"]."' required>";
                            echo "<label for='destination'>Destination</label>";
                            echo "<input type='text' id='destination' class='form-control' name='destination' value='"
                                .$row["r_destination"]."' required>";
                            echo "<button class='btn btn-lg btn-primary btn-block my-3' name='update_bid' type='submit'>
                                Submit
                                </button>";
                        ?>
                    </form>
                </div>
            </div>
        </div>
    <?php include 'partials/script.php'; ?>
</body>

<?php
    if (isset($_POST['update_bid'])) {
        $result=pg_query($db, 
        "SELECT edit_admin_rides_list($_GET[id], $_POST[id], '$_POST[carplate]', '$_POST[date]', "
        ."'$_POST[time]', '$_POST[origin]', $_POST[destination]', 'Available'");

        if (!$result) {
            $err = error_get_last();
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>"
                    .$err["message"].
                "</div>
            </div>";
        } else {
            echo "
            <script>
                window.location = '/demo/admin';
            </script>";
        }
    }
?>