<?php
    include '../partials/connection.php';

    $result = pg_query($db, "DELETE FROM drivers d
        WHERE d.c_plate = '$_GET[carplate]'");

    if (!$result) {
        echo "<div class='container p-3'>
            <div class='alert alert-danger'>
                Deletion Error
            </div>
        </div>";
    }

    header('Location: /demo/admin.php');
?>