<?php
    session_start();
    unset($_SESSION['pat_id']);
    unset($_SESSION['admissionNumber']);
    session_destroy();

    header("Location: logout.php");
    exit;
?>