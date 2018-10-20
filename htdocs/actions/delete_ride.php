<?php
    include '../partials/connection.php';

    $result = pg_query($db, "DELETE FROM rides r
        WHERE r.d_email = '$_GET[email]'
        AND r.c_plate = '$_GET[plate]'
        AND r.r_date = '$_GET[date]'
        AND r.r_time = '$_GET[time]'");
    
    if (!$result) {
        echo "Failed";
    }

    header('Location: /demo/home.php');
?>