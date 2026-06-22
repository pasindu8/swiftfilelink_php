<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'deleteoldotp.php';

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

include 'config.php';
require_once 'components/notify.php';

function mysqli_real_escape_with_strips($conn, $data) {
    return mysqli_real_escape_string($conn, stripslashes(strip_tags($data)));
}

function sendOTP($emails, $otp, $name, $verid, $token) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';
        $mail->Password = 'your-app-password';
        
        
        $mail->Port = 587;  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

       
        $mail->setFrom('your-email@gmail.com', 'SwiftFileLink Global');
        $mail->addAddress($emails);
        $mail->isHTML(true);
        $mail->Subject = 'SWIFTFILELINK - Security Access Token';
        $mail->Body    = '
            <div style="background-color: #0b0d13; margin: 0; padding: 30px; font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; color: #c9d1d9;">
                <div style="max-width: 600px; margin: 0 auto; background: #0f1117; border: 1px solid #ff3333; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
                    <div style="background: #161b22; padding: 25px; text-align: center; border-bottom: 2px solid #ff3333;">
                        <h2 style="color: #ff3333; margin: 0; font-size: 24px; letter-spacing: 1px;">CRITICAL SECURITY NOTICE</h2>
                    </div>
                    <div style="padding: 30px;">
                        <p style="font-size: 16px; color: #ffffff;">System Alert: Password reset requested for node authorization.</p>
                        <p style="font-size: 14px; color: rgba(255,255,255,0.6);">Hello <b>' . htmlspecialchars($name) . '</b>, use the following cryptographically generated One-Time Password (OTP) to verify your terminal access:</p>
                        
                        <div style="text-align: center; margin: 30px 0;">
                            <div style="display: inline-block; border: 1px dashed #ff3333; background: rgba(255,51,51,0.05); color: #ff3333; border-radius: 6px; padding: 15px 40px; font-size: 32px; font-family: monospace; letter-spacing: 6px; font-weight: bold;">
                                ' . $otp . '
                            </div>
                        </div>
                        
                        <p style="font-size: 13px; color: #ffcc00; margin-bottom: 25px;">⚠️ This passcode is structurally volatile and will auto-expire in exactly 3 minutes.</p>
                        
                        <p style="font-size: 14px; color: rgba(255,255,255,0.6); margin-bottom: 15px;">Alternative bypass link:</p>
                        <div style="text-align: center; margin-bottom: 20px;">
                            <a href="https://www.swiftfilelink.rf.gd/verify.php?id=' . $verid . '&code=' . $token . '" target="_blank" style="background-color: rgba(255,51,51,0.1); color: #ff3333; border: 1px solid #ff3333; padding: 12px 30px; text-align: center; text-decoration: none; border-radius: 6px; font-weight: bold; display: inline-block; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">Authorize via Link</a>
                        </div>
                        <hr style="border: none; border-top: 1px solid rgba(255,255,255,0.05); margin-top: 30px;">
                        <p style="font-size: 11px; color: rgba(255,255,255,0.3); text-align: center; margin: 0;">&copy; 2026 SwiftFileLink Infrastructure. All rights reserved.</p>
                    </div>
                </div>
            </div>';

        $mail->send();
        setNotify('success', 'Send verification code your email');
        header("Location: verification.php");
        exit();
    } 
    catch (Exception $e) {
        setNotify('warning', 'ERROR: Security token dispatch failed. Check mailer configuration.');
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
   
    $uname = mysqli_real_escape_with_strips($conn, $_POST['uname']); 
    $password = $_POST['password'];
    $conpassword = $_POST['conpassword'];

    if($password == $conpassword)
    {
        $checkuser = "SELECT * FROM user WHERE username='$uname' OR email='$uname'";
        $result = mysqli_query($conn, $checkuser);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            $id = $row['user_id'];
            $name = $row['name'];
            $email = $row['email'];
            $status = "pending";
            $verificationcode = rand(11111, 99999);
            $token = bin2hex(random_bytes(32));
            $verid = $id + rand(111111, 999999);
            
            date_default_timezone_set("Asia/Colombo");
            $deletedate = date("Y-m-d H:i:s");
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $updatepass = "UPDATE user SET password = '$hashed_password', status = '$status', verificationcode = '$verificationcode' WHERE user_id = '$id'"; 

            if ($conn->query($updatepass) === TRUE) 
            {
                $veri = "INSERT INTO verification (email, verificationcode, name, token, user_id, deletedate)
                         VALUES ('$email', '$verificationcode', '$name', '$token', '$id', '$deletedate')";

                if ($conn->query($veri) === TRUE) 
                {   
                    
                    $otp = $verificationcode; 
                    sendOTP($email, $otp, $name, $verid, $token);
                }
                else {
                    setNotify('error', 'ERROR 500: Verification ledger insertion failed.');
                }
            }
            else {
                setNotify('error', 'ERROR: Node memory mutation failed.');
            }
        }
        else {
            setNotify('error', 'Username or email is currently unregistered in system logs');
        }
    }
    else {
        setNotify('error', 'Encryption Mismatch: Passwords Do Not Match.');
    }
}
include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/register.css">
<link rel="stylesheet" href="styles/forgotpassword.css">
<link rel="stylesheet" href="styles/notify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        
    <?php
      include 'components/navBar.php';
      include 'components/MobileDrawer.php';
    ?>
         
        <div class="main-wrapper">
            <div class="co"><?php showNotify(); ?>
                <h1>Reset Password</h1>
                
                <form action="forgotpassword.php" method="post">
                    <div class="input-group">
                        <input type="text" class="input" placeholder="Username / Email Node" name="uname" required>
                    </div>
                    
                    <div class="input-group password-field">
                        <input type="password" class="input" placeholder="New Crypto-Password" id="password" name="password" required>
                        <i class="far fa-eye-slash pass-icon" onclick="pass()" id="pass-icon" style="color: #11111;"></i>
                    </div>
                    
                    <div class="input-group password-field">
                        <input type="password" class="input" placeholder="Confirm Password Node" id="conpassword" name="conpassword" required>
                        <i class="far fa-eye-slash pass-icon" onclick="passcon()" id="conpass-icon" style="color: #11111;"></i>
                    </div>
                    
                    <button type="submit">Change Password Architecture</button>     
                </form>
            </div>
        </div>
       
        <?php include 'components/footer.php'; ?>
    </div>
   
    <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── password toggle ── -->
  <script src="scripts/passwordShow&Hide.js"></script>
  <!-- ── HAMBURGER ── -->
  <script src="scripts/HamburgerMenu.js"></script>
</body>
</html>