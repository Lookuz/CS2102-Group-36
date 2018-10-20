<!DOCTYPE html>
<?php session_start(); 
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <h4 class="display-4 m-2">Are you sure you want to delete this bid?</h4>
            <br />
            <div class="border border-secondary rounded p-3">
                <h4>Details: </h4>
                <form action='/demo/delete_bid.php' method='POST'>
                    <?php 
                        echo "Date: ".$_GET["date"]."<br />";
                        echo "Time: ".$_GET["time"]."<br />";
                        echo "Origin: ".$_GET["origin"]."<br />";
                        echo "Destination: ".$_GET["destination"]."<br />";
                        //Transfer to the post request
                        echo "<input type='hidden' name='date' value='$_GET[date]'>";
                        echo "<input type='hidden' name='time' value='$_GET[time]'>";
                        echo "<input type='hidden' name='plate' value='$_GET[plate]'>";
                    ?>
                    <br />
                    <button type="submit" class='btn btn-outline-danger' name='delete'>
                        Delete
                    </button>
                    <a href="/demo/index">
                        <button class='btn btn-outline-secondary'>Cancel</button>
                    </a>
                </form>
            </div>
        </div>
    <?php include 'partials/script.php'; ?>
</body>
<?php
    // Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';
    
    if (!$db) {
        echo "Error connecting to database";
        exit;
    }

    if(isset($_POST["delete"])) {
        $result = pg_query($db, "DELETE FROM bids
        WHERE r_date = '$_POST[date]'
        AND r_time = '$_POST[time]'
        AND c_plate = '$_POST[plate]'
        AND p_email = '$_SESSION[email]'");

        if(!$result) {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Deletion error.
                </div>
            </div>";
        } else {
            header("Location: /demo/index");
        }
    }
?>