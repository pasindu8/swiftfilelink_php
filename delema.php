<?php
    include 'components/secretKey.php';
    include 'components/sessionsActive.php';
	require_once 'components/notify.php';

	$mid = filter_input(INPUT_GET, 'nid', FILTER_VALIDATE_INT);
	$url_token = filter_input(INPUT_GET, 'token', FILTER_DEFAULT);

	if (!$mid || !$url_token) {
        setNotify('warning', 'CRITICAL WARNING: Invalid Request parameters!');
        header('Location:notifications.php');
        exit();
	}
	$expected_token = hash_hmac('sha256', $mid, $secret_key);

	if (hash_equals($expected_token, $url_token)){

        $sql = "DELETE FROM notification WHERE notification_id='$mid'"; 

        if ($conn->query($sql) === TRUE) 
        {
            setNotify('success', 'Notifications deleted');
            header('Location:notifications.php');
            exit();
        }	
        else
        {
            setNotify('warning', 'System Error : notifications delete failed. Please try again.');
            header('Location:notifications.php');
            exit();
        }
    }else{
        setNotify('warning', 'Security Error: URL has been tampered with or Token is invalid!');
        header('Location:notifications.php');
        exit();
    }
        
        
    
?>
