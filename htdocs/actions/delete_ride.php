<?php
    include '../partials/connection.php';

    $result = pg_query($db, "DELETE FROM rides r
        WHERE r.r_id = '$_GET[id]'");
    
    if (!$result) {
        echo "Failed";
    }

    header('Location: /demo/admin.php');
?>