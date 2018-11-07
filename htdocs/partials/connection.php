<?php
    $db = pg_connect("host=localhost port=5432 dbname=Project user=postgres password=rachelwje");

    if (!$db) {
        echo 'Error Connecting';
    }
?>
