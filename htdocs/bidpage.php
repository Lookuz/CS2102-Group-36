<!DOCTYPE html>
<?php
    session_start();
    
    echo "<head>
        <title>
            Carpool
        </title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' 
        integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' 
        crossorigin='anonymous'>
        <link rel='stylesheet' href='bidpage.css'>
        <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' 
        integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' 
        crossorigin='anonymous'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' 
        integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' 
        crossorigin='anonymous'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' 
        integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' 
        crossorigin='anonymous'></script>
    </head>
    <body>";
        include 'partials/navbar.php';
        include 'partials/connection.php';

            echo "
            <div class='container d-flex align-items-center outer-box col-sm-offset-3 col-sm-6'>
                <div class='inner-container justify-content-center self-align-center'>
                    <div class='dest-container col-sm-8 offset-sm-2'>
                        <div class='row'>
                            <div class='col-sm-3'>
                                <div class='w-100'><img src='resources/location.svg'></div>
                            </div>
                            <div class='col-sm-9'>
                                <p class='form-control dest-box'>".$_GET['origin']."</p>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-3'>
                                <div id='dotted-line'></div>
                            </div>
                            <div class='col-sm-9'>
                                <p class='w-100'>To</p>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-3'>
                                <div class='w-100'><img src='resources/location.svg'></div>
                            </div>
                            <div class='col-sm-9'>
                                <p class='form-control dest-box'>".$_GET['destination']."</p>
                            </div>
                        </div>
                    </div>
                    <div class='form-container col-sm-8 offset-sm-2 rounded '>
                        <form method='post'>
                            <div class='row'>
                                <div class='col-sm-6'>
                                    <div class='form-group w-100'>
                                        <label class='w-100'>Date</label>
                                        <p class='form-control'>".$_GET['date']."</p>
                                    </div>
                                    <div class='form-group w-100'>
                                        <label class='w-100'>Your Bid</label>
                                        <p class='form-control'>";
                    
                                        $sql = 'SELECT get_user_bid_func($1, $2, $3, $4, $5)';
                                        $res = pg_prepare($db, 'get_user_bid', $sql);
                                        $res = pg_execute($db, 'get_user_bid', 
                                            array($_SESSION['email'], $_GET['origin'], $_GET['destination'], $_GET['date'], $_GET['time']));
                                        if($bid = pg_fetch_result($res, 0)) {
                                            echo $bid;
                                        } else {
                                            echo '0';
                                        }
                                    echo "
                                        </p>
                                    </div>
                                </div>
                                <div class='col-sm-6'>
                                    <div class='form-group w-100'>
                                        <label class='w-100'>Time</label>
                                        <p class='form-control'>".$_GET['time']."</p>
                                    </div>
                                    <div class='form-group w-100'>
                                        <label class='w-100'>Highest Bid</label>
                                        <p class='form-control'>";
        
                                        $sql = 'SELECT get_max_bid_func($1, $2, $3, $4)';
                                        $res = pg_prepare($db, 'get_max_bid', $sql);
                                        $res = pg_execute($db, 'get_max_bid', 
                                            array($_GET['origin'], $_GET['destination'], $_GET['date'], $_GET['time']));
                                        if($bid = pg_fetch_result($res, 0)) {
                                            echo $bid;
                                        } else {
                                            echo '0';
                                        }
                                    echo "
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class='col-sm-6 offset-sm-3'>
                                <div class='form-group'>
                                    <label class='w-100'>Enter New Bid</label>
                                    <input class='form-control w-100' type='number' min='1' name='new-bid'>
                                </div>
                            </div>
                            <button class='btn btn-rounded btn-primary btn-lg btn-block' type='submit' name='Bid'>
                                Bid For Ride
                            </button>
                        </form>
                    </div>
                </div>
            </div>
    </body> ";
    
    if (isset($_POST['Bid'])) {
        include 'partials/connection.php';

        $sql = 'SELECT user_bid_func($1, $2, $3, $4, $5, $6)';
        $res = pg_prepare($db, 'user_bid', $sql);
        $res = pg_execute($db, 'user_bid', array($_GET['origin'], $_GET['destination'], 
        $_GET['date'], $_GET['time'], $_SESSION['email'], $_POST['new-bid']));
        
        echo "
        <script>
            window.location = '/demo/index';
        </script>";
    }
?>