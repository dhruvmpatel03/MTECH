<?php
session_start();

if(!isset($_SESSION['login_status']) || $_SESSION['login_status'] !== true){
    echo "<script>alert('Unauthorized access. Please log in first.'); window.location.href = '../shared/login.php';</script>";
    die;
}

if($_SESSION['usertype'] != 'customer'){
    echo "<script>alert('Unauthorized access.'); window.location.href = '../shared/login.php';</script>";
    die;
}
?>