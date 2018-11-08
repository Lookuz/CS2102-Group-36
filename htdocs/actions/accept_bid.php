<?php
    include '../partials/connection.php';

    $result = pg_query($db, "SELECT accept_a_bid($_GET[rideid], '$_GET[passenger]')");

    if (!$result) {
        echo "<div class='container p-3'>
            <div class='alert alert-danger'>
                Selection Error
            </div>
        </div>";
    }



    header('Location: /demo/driver.php');
?>

<!-- $result2 = pg_query($db, "UPDATE rides
  SET a_status = 'TAKEN'
  WHERE r_id = $_GET[rideid]");
$result = pg_query($db, "UPDATE bids
  SET b_status =  CASE
                    WHEN p_email = '$_GET[passenger]' THEN 'ACCEPTED'
                    ELSE 'REJECTED'
                  END
  WHERE r_id = $_GET[rideid];
  "); -->
