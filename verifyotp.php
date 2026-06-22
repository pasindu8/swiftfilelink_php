<?php
include 'config.php';
session_start();
require_once 'components/notify.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    
    $otp = mysqli_real_escape_string($conn, $_POST['otp']);

    
    $checkotp = "SELECT * FROM verification WHERE verificationcode='$otp'";
    $result = mysqli_query($conn, $checkotp);

    if ($result && mysqli_num_rows($result) > 0) 
    {
        $row = mysqli_fetch_array($result);
        $id = $row['user_id'];
        $otp_time = strtotime($row['deletedate']); 
        $current_time = time();

        
        if (($current_time - $otp_time) > 180) 
        {
            setNotify('error', 'OTP code has expired! Please request a new one.'); 
            header("Location: verification.php"); 
            exit();
        }

        $status = "active";
        $verificationcode = 0;

        
        $sql = "UPDATE user SET status = '$status', verificationcode = '$verificationcode', notification_count = '1' WHERE user_id = '$id'"; 

        if ($conn->query($sql) === TRUE) 
        {
            $message = "Congratulations, your account has been verified";
            $notifi = "INSERT INTO notification (message, notiread, user_id) VALUES ('$message', '1', '$id')";
            
            if ($conn->query($notifi) === TRUE) 
            {   
                
                $conn->query("UPDATE verification SET verificationcode = NULL, token = NULL WHERE user_id = '$id'");

                
                header('Location: verified.html');
                exit();
            }
        }
        else
        {
            setNotify('error', 'Database error. Please try again.'); 
            header("Location: verification.php"); 
            exit();
        }
    }
    else
    {
        setNotify('error', 'INVALID OTP CODE. Please check and try again.'); 
        header("Location: verification.php"); 
        exit();
    }
}
else
{
    setNotify('error', 'Invalid Request Method.'); 
    header("Location: verification.php"); 
    exit();
}

$conn->close();
?>