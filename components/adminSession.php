<?php
    include 'config.php';
    session_start();

    if (!isset($_SESSION['type']) || $_SESSION['type'] != "admin" || $_SESSION['status'] != "active")
    {
        header('Location:login.php');
        exit(); 
    }

    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $user = $_SESSION['username'];
    $type = $_SESSION['type'];
    $status = $_SESSION['status'];
    $count = isset($_SESSION['notification_count']) ? $_SESSION['notification_count'] : 0; 
?>