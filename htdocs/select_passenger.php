<!DOCTYPE html>
<?php
session_start();
include 'partials/head.php'; ?>
<body>
<?php include 'partials/navbar.php'; ?>
<div class="container">

</div>
    <?php if(isset($_SESSION['username'])) {
        echo"<br />";
        include 'partials/bidders_list.php';
    }
    ?>
</div>
<?php include 'partials/script.php'; ?>
</body>
