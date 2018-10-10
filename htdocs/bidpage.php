<?php
    session_start();
    include 'partials/head.php';
?>

<html>
    <head>
        <title>
            Carpool
        </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bidpage.css">
    </head>
    
    <body>
        <div class="h-100 parent-container">
            <div class='main-bid-box'>
                <form class="container-fluid" method="POST">
                    <div class="row"> 
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm">
                            <div class="row field-item"><?php echo $_GET['origin']; ?></div>
                            <div class="row field-item"><?php echo $_GET['destination']; ?></div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm field-item">
                            <?php echo $_GET['date']; ?>
                        </div>
                        <div class="col-sm field-item"><?php echo $_GET['time']; ?></div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm field-item">
                            <?php
                                $db = pg_connect("host=localhost port=5432 dbname=CarPool user=postgres password=2102");

                                $sql = 'SELECT get_user_bid_func($1, $2, $3, $4, $5)';
                                $res = pg_prepare($db, 'get_user_bid', $sql);
                                $res = pg_execute($db, 'get_user_bid', 
                                    array($_SESSION['email'], $_GET['origin'], $_GET['destination'], $_GET['date'], $_GET['time']));
                                if($bid = pg_fetch_result($res, 0)) {
                                    echo $bid;
                                } else {
                                    echo '0';
                                }
                            ?>
                        </div>
                        <div class="col-sm field-item">
                            <?php
                                $db = pg_connect("host=localhost port=5432 dbname=CarPool user=postgres password=2102");

                                $sql = 'SELECT get_max_bid_func($1, $2, $3, $4)';
                                $res = pg_prepare($db, 'get_max_bid', $sql);
                                $res = pg_execute($db, 'get_max_bid', 
                                    array($_GET['origin'], $_GET['destination'], $_GET['date'], $_GET['time']));
                                if($bid = pg_fetch_result($res, 0)) {
                                    echo $bid;
                                } else {
                                    echo '0';
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center"> 
                        <input class="col-9 field-item" name="new-bid" type="number" min="1">
                    </div>  
                    
                    <div class="row justify-content-center"> 
                        <button class="col-3 field-item btn btn-outline-info btn-rounded btn-block waves-effect" type="submit" name="Bid">GO!</button>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>

<?php
    if (isset($_POST['Bid'])) {
        $db = pg_connect("host=localhost port=5432 dbname=CarPool user=postgres password=2102");

        $sql = 'SELECT user_bid_func($1, $2, $3, $4, $5, $6)';
        $res = pg_prepare($db, 'user_bid', $sql);
        $res = pg_execute($db, 'user_bid', array($_GET['origin'], $_GET['destination'], $_GET['date'], $_GET['time'], 
            $_SESSION['email'], $_POST['new-bid']));
    }
?>