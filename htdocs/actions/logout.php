<?php 
    session_start();
    session_start();
    $_SESSION = [];
    session_destroy();
    session_write_close();
    header('Location: /demo/index');
die;
?>