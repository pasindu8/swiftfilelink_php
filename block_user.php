<?php
   include 'config.php';
    $user_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	$url_token = filter_input(INPUT_GET, 'token', FILTER_DEFAULT);

	if (!$user_id || !$url_token) {
        header("Location: alert.php?status=error&msg=CRITICAL WARNING: Invalid Request parameters!&redirect=manage_users.php");
		exit();
	}
	
	$expected_token = hash_hmac('sha256', $user_id, $secret_key);

	if (hash_equals($expected_token, $url_token)) {
        $BA = "Block";
        $sqlre = "UPDATE user SET status = '$BA' WHERE user_id = '$user_id'";
        if ($conn->query($sqlre) === TRUE)
        {
            header("Location: alert.php?status=success&msg=User Block Successful!.&redirect=manage_users.php");
            exit();
        }
        else{
            header("Location: alert.php?status=error&msg=System Error:User Block Failed!&redirect=manage_users.php");
			exit();
        }
        
	} else {
        header("Location: alert.php?status=error&msg=Security Error: URL has been tampered with or Token is invalid!&redirect=manage_users.php");
		exit();
    }
?>