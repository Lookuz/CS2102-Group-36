<?php 
    $db = pg_connect("host=localhost port=5432 dbname=Project user=postgres password=2012");

    if (!$db) {
        echo 'Error Connecting';
    }
?>