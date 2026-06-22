<?php
include 'config.php';
require_once 'components/notify.php'; 

if (isset($_GET['id']) && isset($_GET['code']))
{
   
    $token = $conn->real_escape_string($_GET['code']); 

    
    $stmt = $conn->prepare("SELECT user_id, deletedate FROM verification WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) 
    {
        $row = $result->fetch_assoc();
        $id = $row['user_id'];
        
        date_default_timezone_set("Asia/Colombo"); 
        $otp_time = strtotime($row['deletedate']);
        $current_time = time();
        
       
        if (($current_time - $otp_time) <= 180)
        {
            $status = "active";
            $verificationcode = 0;

           
            $update_user = $conn->prepare("UPDATE user SET status = ?, verificationcode = ?, notification_count = '1' WHERE user_id = ?");
            $update_user->bind_param("sii", $status, $verificationcode, $id);

            if ($update_user->execute()) 
            {
                
                $message = "Congratulations, your account has been verified";
                $insert_noti = $conn->prepare("INSERT INTO notification (message, notiread, user_id) VALUES (?, '1', ?)");
                $insert_noti->bind_param("si", $message, $id);
                
                if ($insert_noti->execute()) 
                {   
                    
                    $conn->query("UPDATE verification SET token = NULL WHERE user_id = '$id'");

                    header('Location: verified.html');
                    exit();
                }
                $insert_noti->close();
            } 
            else 
            {
                setNotify('error', 'Server error Database Update Failed. Please try again.'); 
                header('Location:   verification.php');
                exit();
            }
            $update_user->close();
        }
        else
        {
            setNotify('error', 'LINK EXPIRED: The verification link is no longer valid.'); 
            header('Location:   verification.php');
            exit();
        }
    }
    else
    {
        setNotify('error', 'INVALID LINK: This link has already been used or is invalid.'); 
        header('Location:   verification.php');
        exit();
    }
    $stmt->close();
}
else
{
    setNotify('error', 'ERROR: Invalid request parameters.'); 
    header('Location:   verification.php');
    exit();
}

$conn->close();
?>