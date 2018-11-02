<!DOCTYPE html>
<?php session_start(); 
    include 'partials/head.php';   
    include 'partials/connection.php';
     
    if (!$db) {
        echo "Error connecting to database";
        exit;
    }

    //Query to get the details of the bid that we are going to delete
    $bid_query = pg_query($db, "SELECT b.r_id, b.p_email, r.r_id, r.c_plate, r.r_date, r.r_time, r.r_origin, r.r_destination 
        FROM bids b, rides r
        WHERE r.r_id = '$_GET[id]'
        AND r.r_id = b.r_id");
    
    $bid_detail = pg_fetch_assoc($bid_query);
?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <h4 class="display-4 m-2" style="color:white">Are you sure you want to delete this bid?</h4>
            <br />
            <div class="bg-light  p-3">
                <h4>Details: </h4>
                <form action='/demo/delete_bid.php' method='POST'>
                    <?php 
                        echo "Date: ".$bid_detail["r_date"]."<br />";
                        echo "Time: ".$bid_detail["r_time"]."<br />";
                        echo "Origin: ".$bid_detail["r_origin"]."<br />";
                        echo "Destination: ".$bid_detail["r_destination"]."<br />";
                        //Transfer to the post request
                        echo "<input type='hidden' name='id' value='$_GET[id]'>";
                    ?>
                    <br />
                    <button type="submit" class='btn btn-outline-danger' name='delete'>
                        Delete
                    </button>
                    <a href="/demo/home">
                        <button class='btn btn-outline-secondary'>Cancel</button>
                    </a>
                </form>
            </div>
        </div>
    <?php include 'partials/script.php'; ?>
</body>
<?php
    if(isset($_POST["delete"])) {
        $result = pg_query($db, "SELECT delete_bid('$_POST[id]', '$_SESSION[email]')");

        if(!$result) {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Deletion error.
                </div>
            </div>";
        } else {
            echo "
                <script>
                    window.location = '/demo/home';
                </script>";
        }
    }
?>