<?php
    session_start();

    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $user = $_SESSION['username'];
    $type = $_SESSION['type'];
    $status = $_SESSION['status'];
    $count = $_SESSION['notification_count']; 

?>