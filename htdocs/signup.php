<!DOCTYPE html>
<?php include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container p-3">
            <h1>Sign-up page</h1>
            <br />
            <h3>Please fill up your particulars</h3>
            <div class="boreder success-border py-4 my-2">
                <form action="signup.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" required 
                        placeholder="example@mail.com" name="email">
                    </div>
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" class="form-control" name="username" 
                        placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" name="password" 
                        placeholder="Password" required minlength="6">
                    </div>
                    <input class="btn btn-primary" type="submit" name="signup">
                </form>
            </div>
        </div>
    <?php include 'partials/script.php'; ?>
</body>

<?php
  	// Connect to the database. Please change the password in the following line accordingly
    include 'partials/connection.php';

    if (isset($_POST['signup'])) {
        $result = pg_query($db, "INSERT INTO users(u_email, u_password, u_name) 
        VALUES('$_POST[email]', '$_POST[password]', '$_POST[username]')");
        if (!$result) {
            echo "<div class='container p-3'>
                <div class='alert alert-danger'>
                    Email or password invalid.
                </div>
            </div>";
            //For debugging
            //echo pg_last_error($db);
        } else {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['isDriver'] = false;
            header("Location: /demo/index");
        }
    }    
?>  