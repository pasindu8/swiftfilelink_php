<?php

include 'config.php';

date_default_timezone_set("Asia/Colombo");
$dele = date("Y-m-d H:i:s");  

$sql = "DELETE FROM verification WHERE deletedate < DATE_SUB('$dele', INTERVAL 30 MINUTE)";

$conn->query($sql);

$conn->close();

?>
