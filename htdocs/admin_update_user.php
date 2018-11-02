<?php session_start(); 
    include 'partials/head.php';
    include 'partials/connection.php';

    $user_query = pg_query($db, "SELECT * FROM users WHERE u_email ='$_GET[email]'");
    $row = pg_fetch_assoc($ride_query);
?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
        </div>
    <?php include 'partials/script.php'; ?>
</body>

<?php
    if (isset($_POST['update_user'])) {
        $result=pg_query($db, "SELECT edit_admin_user_list('$_GET[email]', '$_POST[email]'"
        .", '$_POST[password]', '$_POST[username]', '$_POST[isadmin]')");

        if (!$result) {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Error updating ride
                </div>
            </div>";
        } else {
            echo "
            <script>
                window.location = '/demo/admin';
            </script>";
        }
    }
?>