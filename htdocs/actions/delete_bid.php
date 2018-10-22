<?php
    include '../partials/connection.php';

    $result = pg_query($db, "DELETE FROM bids b
        WHERE b.d_email = '$_GET[d_email]'
        AND b.c_plate = '$_GET[plate]'
        AND b.r_date = '$_GET[date]'
        AND b.r_time = '$_GET[time]'
        AND b.p_email = '$_GET[p_email]'");
    
    if (!$result) {
        echo "Failed";
    }

    header('Location: /demo/home.php');
?>