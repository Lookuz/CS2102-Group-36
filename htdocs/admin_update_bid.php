<?php session_start(); 
    include 'partials/head.php';
?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="row my-4" style="color:white;">
                <div class="offset-md-4 col-md-4">
                    <form method="POST">
                        <?php  
                            echo "<h1>Update Bid</h1>";
                            echo "<label for='rideID'>Ride ID</label>";
                            echo "<input type='text' id='rideID' name='id' class='form-control' value='"
                                .$_GET["id"]."' required autofocus>";
                            echo "<label for='passengerEmail'>Passenger's Email</label>";
                            echo "<input type='email' id='passengerEmail' name='email' class='form-control'
                                value='".$_GET["email"]."' required>";
                            echo "<label for= 'bid'>Bid</label>";
                            echo "<input type='text' id='bid' class='form-control' name='bid' value='"
                                .$_GET["bid"]."' required>";
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
    include 'partials/connection.php';

    if (isset($_POST['update_bid'])) {
        $result=pg_query($db, "SELECT edit_admin_bids_list($_GET[id], '$_GET[email]'".
            ", '$_POST[id]', '$_POST[email]', $_POST[bid])");

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
                window.location = '/demo/admin_bids.php';
            </script>";
        }
    }
?>