<?php session_start(); 
    include 'partials/head.php'; ?>
<body>
    <?php include 'partials/navbar.php'; ?>
        <div class="container">
            <?php 
                include 'partials/admin_bids_list.php';
            ?>
        </div>
    <?php include 'partials/script.php'; ?>
</body>