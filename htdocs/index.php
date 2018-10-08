<!DOCTYPE html>
<?php session_start(); 
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="border border-primary rounded p-3 my-3">
                <form action="index.php" method="GET">
                    <div class="row">
                        <div class="col form-group">
                            <h4>FROM: </h4>
                            <input type="text" class="form-control" 
                                name="from" required>
                        </div>
                        <div class="col form-group">
                            <h4>TO: </h4>
                            <input type="text" class="form-control" 
                                name="to" required>
                        </div>
                    </div>
                    <br />
                    <input class="btn btn-primary" type="Submit" name="Search">
                </form>
            </div>
            <br />
            <?php include 'partials/available_list.php';
                if (isset($_SESSION['username'])) {
                    echo"<br />";
                    include 'partials/user_list.php';
                }
            ?>
        </div>
    <?php include 'partials/script.php'; ?>
</body>