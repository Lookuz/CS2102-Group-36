<?php
    include '../partials/connection.php';

    $result = pg_query($db, "DELETE FROM users u
        WHERE u.u_email = '$_GET[email]'");

    if (!$result) {
        echo "<div class='container p-3'>
            <div class='alert alert-danger'>
                Deletion Error
            </div>
        </div>";
    }

    header('Location: /demo/admin.php');
?>
