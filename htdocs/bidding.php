<!DOCTYPE html>
<?php include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <div class="row">
                <div class="border border-primary rounded">
                    <h2>Bidding</h2>
                    <form action="bidding.php" method="GET">
                        <?php 
                            //Connect to the database change according to the system
                            $db = pg_connect("host=localhost port=5432 dbname=Project
                            user=postgres password=2012");

                            if (!$db) {
                                echo 'Error Connecting';
                                exit;
                            }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    <?php include 'partials/script.php'; ?>
</body>