<?php session_start(); 
    include 'partials/head.php';
    include 'partials/connection.php';

    $user_query = pg_query($db, "SELECT * FROM users WHERE u_email ='$_GET[email]'");
    $row = pg_fetch_assoc($user_query);
?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="row my-4" style="color:white;">
                    <div class="offset-md-4 col-md-4">
                        <form method="POST">
                            <?php  
                                echo "<h1>Update user</h1>";
                                echo "<label for='email'>Email</label>";
                                echo "<input type='email' id='email' name='email' class='form-control' value='"
                                    .$row["u_email"]."' required autofocus>";
                                echo "<label for='password'>Password</label>";
                                echo "<input type='text' id='password' name='password' class='form-control'
                                    value='".$row["u_password"]."' required>";
                                echo "<label for='username'>Username</label>";
                                echo "<input type='text' id='username' class='form-control' name='username' value='"
                                    .$row["u_name"]."' required>";
                                echo "<div class='form-check'>
                                    <input class='form-check-input' type='checkbox' ";
                                
                                //Check if the user has admin rights already
                                if ($row["isadmin"] == 'TRUE') {
                                    echo "checked";
                                }

                                echo " id='isAdmin' name='isAdmin'>
                                    <label class='form-check-label' for='isAdmin'>
                                        Administrator rights
                                    </label>
                                    </div>";
                                echo "<button class='btn btn-lg btn-primary btn-block my-3' name='update_user' type='submit'>
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
    if (isset($_POST['update_user'])) {
        $admin = 'FALSE';

        if (isset($_POST["isAdmin"])) {
            $admin = 'TRUE';
        }

        $result=pg_query($db, "SELECT edit_admin_user_list('$_GET[email]', '$_POST[email]'"
        .", '$_POST[password]', '$_POST[username]', '$admin')");

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