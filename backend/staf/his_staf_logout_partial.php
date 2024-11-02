<?php
    session_start();
    unset($_SESSION['staf_id']);
    unset($_SESSION['staf_number']);
    session_destroy();

    header("Location: his_staf_logout.php");
    exit;
?>