<?php session_start(); 
    include 'partials/head.php';
    include 'partials/connection.php';

    $driver_query = pg_query($db, "SELECT * FROM drivers WHERE c_plate ='$_GET[carplate]'");
    $row = pg_fetch_assoc($driver_query);
?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="row my-4" style="color:white;">
                    <div class="offset-md-4 col-md-4">
                        <form method="POST">
                            <?php  
                                echo "<h1>Update Driver</h1>";
                                echo "<label for='carplate'>Carplate</label>";
                                echo "<input type='text' id='carplate' name='carplate' class='form-control' value='"
                                    .$row["c_plate"]."' required autofocus>";
                                echo "<label for='email'>Driver's Email</label>";
                                echo "<input type='text' id='email' name='email' class='form-control'
                                    value='".$row["d_email"]."' required>";
                                echo "<label for='brand'>Car Brand</label>";
                                echo "<input type='text' id='brand' class='form-control' name='brand' value='"
                                    .$row["c_brand"]."' required>";
                                echo "<label for='model'>Car Model</label>";
                                echo "<input type='text' id='model' class='form-control' name='model' value='"
                                        .$row["c_model"]."' required>";

                                echo "<button class='btn btn-lg btn-primary btn-block my-3' name='update_driver' type='submit'>
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
    if (isset($_POST['update_driver'])) {
        $result=pg_query($db, "SELECT edit_admin_drivers_list('$_GET[carplate]', '$_POST[carplate]'"
        .", '$_POST[email]', '$_POST[brand]', '$_POST[model]')");

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
                window.location = '/demo/admin';
            </script>";
        }
    }
?>