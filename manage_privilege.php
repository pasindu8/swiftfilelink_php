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
        
        $sql_check = "SELECT type FROM user WHERE user_id = '$user_id'";
		$result = $conn->query($sql_check);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newtype = $row['type'];
        }
        if ($newtype === "admin"){
            $newtype2 = "User";
        }else{
            $newtype2 = "admin";
        }
        $sqlre = "UPDATE user SET type = '$newtype2' WHERE user_id = '$user_id'";
        if ($conn->query($sqlre) === TRUE)
        {
            header("Location: alert.php?status=success&msg=Privilege manage Successful!.&redirect=manage_users.php");
            exit();
        }
        else{
            header("Location: alert.php?status=error&msg=System Error:Privilege manage Failed!&redirect=manage_users.php");
			exit();
        }
        
	} else {
        header("Location: alert.php?status=error&msg=Security Error: URL has been tampered with or Token is invalid!&redirect=manage_users.php");
		exit();
    }
?>