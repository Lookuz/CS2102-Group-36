<?php
    include '../partials/connection.php';

    $result = pg_query($db, "DELETE FROM users u
        WHERE u.u_email = '$_GET[email]'");

    if (!$result) {
        echo "Failed";
    }

    header('Location: /demo/home.php');
?>