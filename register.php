<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

include 'config.php';
require_once 'components/notify.php';

    session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') 
	{
      $name = $_POST['name'];
      $_SESSION['name']=$name;
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $conpassword = $_POST['conpassword'];

    if($password == $conpassword)
    {
        $checkUser = "SELECT * FROM user WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $checkUser);

        if (mysqli_num_rows($result) > 0) 
        {
            setNotify('error', 'Username or email already exists'); 
        }
        else
        {

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $type = "User";

            $status="pending";

            $verificationcode=rand(11111, 99999);

            $token = bin2hex(random_bytes(32));

            $sqlre = "INSERT INTO  user (name, email, username, password, type, status, verificationcode)
            VALUES ('$name', '$email', '$username', '$hashed_password', '$type', '$status', '$verificationcode')";

            if ($conn->query($sqlre) === TRUE) 
            {
                $message="A new user has registered, send OTP CODE to him";
                $notifi = "INSERT INTO  notification (message, notiread, user_id)
                  VALUES ('$message', '1', '1')";
                
                  if ($conn->query($notifi) === TRUE) 
                  {	
                        $checkot = "SELECT * FROM user WHERE verificationcode='$verificationcode'";
                        $result = mysqli_query($conn, $checkot);

                        if (mysqli_num_rows($result) > 0) 
                        {
                            $row = mysqli_fetch_array($result);
                            $user_idv = $row['user_id'];
                            $_SESSION['useridv']=$user_idv;
                            $verid=$user_idv+rand(111111, 999999);
                            date_default_timezone_set("Asia/Colombo");
                            $deletedate = date("Y-m-d H:i:s");
                            
                        }

                      $veri = "INSERT INTO  verification (email, verificationcode, name, token, user_id, deletedate)
                        VALUES ('$email', '$verificationcode', '$name', '$token', '$user_idv', '$deletedate')";

                      if ($conn->query($veri) === TRUE) 
                      {	

                        function sendOTP($emails, $otp, $name, $verid, $token) {
                        $mail = new PHPMailer(true);

                        try {
                        
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; 
                        $mail->SMTPAuth = true;
                        $mail->Username = 'your-email@gmail.com';
                        $mail->Password = 'your-app-password';
                        $mail->Port = 25;  
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                        
                        $mail->setFrom('your-email@gmail.com', 'swiftfilelink');
                        $mail->addAddress($emails);
                        $mail->isHTML(true);
                        $mail->Subject = 'Welcome to swiftfilelink';
                        $mail->Body    = 
                            '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verify Your Email - SwiftFileLink</title>
</head>
<body style="margin:0; padding:0; background-color:#04060d;">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#04060d; padding:40px 0;">
<tr>
<td align="center">

<table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:600px; max-width:600px; background-color:#0a0e1a; margin:2px; border-radius:16px; border:1px solid #3a2c0f; overflow:hidden; font-family: Arial, Helvetica, sans-serif; box-shadow:0 0 40px rgba(247,183,51,0.12);">

 
  <tr>
    <td style="height:5px; line-height:5px; font-size:0; background: linear-gradient(90deg, #ff7a18 0%, #f7b733 35%, #0ffb56 70%, #00d4ff 100%);">&nbsp;</td>
  </tr>

 
  <tr>
    <td align="center" style="position:relative; background-color:#0a0e1a; background-image: radial-gradient(circle at 15% 25%, rgba(247,183,51,0.35) 0%, transparent 2%), radial-gradient(circle at 85% 20%, rgba(15,251,86,0.3) 0%, transparent 2%), radial-gradient(circle at 30% 80%, rgba(0,212,255,0.3) 0%, transparent 2%), radial-gradient(circle at 70% 70%, rgba(255,122,24,0.3) 0%, transparent 2%), radial-gradient(circle at 50% 50%, rgba(247,183,51,0.06) 0%, transparent 60%); padding:40px 20px 24px 20px;">
      <table role="presentation" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td align="center" style="background: radial-gradient(circle, rgba(247,183,51,0.25) 0%, rgba(10,14,26,0) 70%); padding:14px; border-radius:50%;">
            <img src="https://www.swiftfilelink.rf.gd/logo2.png" alt="SwiftFileLink" style="width:88px; height:88px; border-radius:50%; border:3px solid #f7b733; box-shadow:0 0 25px rgba(247,183,51,0.55), 0 0 50px rgba(247,183,51,0.25); display:block;">
          </td>
        </tr>
      </table>
      <h2 style="color:#f7b733; letter-spacing:3px; margin:18px 0 0 0; font-size:26px; font-weight:800; text-shadow:0 0 14px rgba(247,183,51,0.5);">SWIFTFILELINK</h2>
      <p style="color:#0ffb56; letter-spacing:4px; font-size:11px; margin:6px 0 0 0; text-shadow:0 0 8px rgba(15,251,86,0.5);">QUICK &nbsp;&middot;&nbsp; SIMPLE &nbsp;&middot;&nbsp; SECURE</p>
    </td>
  </tr>

 
  <tr>
    <td align="center" style="background: linear-gradient(120deg, #ff7a18 0%, #ff3d54 55%, #ff1f4c 100%); padding:28px 20px; position:relative;">
      <div style="background: rgba(255,255,255,0.15); width:62px; height:62px; border-radius:50%; margin:0 auto 12px auto; line-height:62px; box-shadow:0 0 0 6px rgba(255,255,255,0.08);">
        <i class="fa fa-envelope-o" style="font-size:28px; color:#ffffff; vertical-align:middle;"></i>
      </div>
      <h3 style="color:rgba(255,255,255,0.85); margin:0; font-weight:600; font-size:13px; letter-spacing:2px; text-transform:uppercase;">Thanks For Signing Up!</h3>
      <h1 style="color:#ffffff; margin:8px 0 0 0; font-size:24px; font-weight:800; letter-spacing:0.5px;">Verify Your Email Address</h1>
    </td>
  </tr>

  
  <tr>
    <td style="padding:34px 36px 6px 36px; color:#c7cedb; font-size:15px; line-height:1.7;">
      <p style="margin:0 0 12px 0;">Hello <b style="color:#f7b733;">' . $name . '</b>,</p>
      <p style="margin:0;">Please use the following One-Time Password (OTP) to verify your email address and activate your SwiftFileLink account:</p>
    </td>
  </tr>

 
  <tr>
    <td align="center" style="padding:22px 30px 22px 30px;">
      <table role="presentation" cellpadding="0" cellspacing="0">
        <tr>
          <td style="border-radius:10px; padding:2px; background: linear-gradient(120deg, #0ffb56, #00d4ff, #f7b733, #ff7a18); background-size:300% 300%;">
            <div style="border-radius:9px; padding:20px 36px; background-color:#0a0e1a;">
              <span style="color:#ff3b4e; font-size:34px; letter-spacing:10px; font-weight:800; text-shadow:0 0 18px rgba(255,59,78,0.45);">' . $otp . '</span>
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>

 
  <tr>
    <td align="center" style="padding:0 30px 10px 30px;">
      <p style="color:#8e96a8; font-size:13px; line-height:1.6; margin:0;">
        <i class="fa fa-clock-o" style="color:#f7b733; margin-right:5px;"></i>
        This passcode is valid for the next <b style="color:#f7b733;">3 minutes</b>.
      </p>
      <p style="color:#6f7790; font-size:13px; line-height:1.6; margin:8px 0 0 0;">
        If the passcode does not work, use the verification button below instead:
      </p>
    </td>
  </tr>

 
  <tr>
    <td align="center" style="padding:20px 30px 38px 30px;">
      <a href="https://www.swiftfilelink.rf.gd/verify.php?id=' . $verid . '&code=' . $token . '" target="_blank"
        style="background: linear-gradient(90deg, #ff7a18, #ff1f4c); color:#ffffff; border:2px solid #0ffb56; padding:15px 38px; text-align:center; text-decoration:none; border-radius:50px; font-size:15px; font-weight:bold; letter-spacing:1px; display:inline-block; box-shadow:0 6px 20px rgba(255,31,76,0.35), 0 0 0 4px rgba(15,251,86,0.08);">
        <i class="fa fa-shield" style="margin-right:8px;"></i>VERIFY EMAIL
      </a>
    </td>
  </tr>

  
  <tr>
    <td style="padding:0 36px;">
      <div style="height:1px; background: linear-gradient(90deg, transparent, #1c2333 20%, #1c2333 80%, transparent);"></div>
    </td>
  </tr>

 
  <tr>
    <td align="center" style="padding:20px 36px 30px 36px;">
      <p style="color:#5a6377; font-size:12px; line-height:1.6; margin:0;">
        <i class="fa fa-lock" style="color:#0ffb56; margin-right:5px;"></i>
        Didn&#x2019;t sign up for SwiftFileLink? You can safely ignore this email.
      </p>
    </td>
  </tr>

  
  <tr>
    <td style="border-top:1px solid #1c2333; padding:22px 20px; text-align:center; background-color:#080b14;">
      <p style="color:#4a5168; font-size:12px; margin:0; letter-spacing:0.5px;">
        &copy; <a href="https://www.swiftfilelink.rf.gd" style="color:#f7b733; text-decoration:none;">www.swiftfilelink.rf.gd</a> &nbsp;&mdash;&nbsp; All rights reserved
      </p>
    </td>
  </tr>

  
  <tr>
    <td style="height:5px; line-height:5px; font-size:0; background: linear-gradient(90deg, #00d4ff 0%, #0ffb56 30%, #f7b733 65%, #ff7a18 100%);">&nbsp;</td>
  </tr>

</table>

</td>
</tr>
</table>

</body>
</html>'; 

                        $mail->send();
                        header("Location:verification.php");

                        } catch (Exception $e) {
                            setNotify('error', 'ERROR : email not send');
                        }
                        }

                       
                        $otp = $verificationcode; 
                        $emails = $email; 
                        $name = $name;
                        $verid = $verid;
                        $token = $token;
                       
                        echo sendOTP($emails, $otp, $name, $verid, $token);
                      }
                  }
            }
            else
            {
                setNotify('warning', 'System Error : Please try again.');
            }
        }
    }
    else
    {
        setNotify('error', 'Passwords Do Not Match'); 
    }
    
	}
		$conn->close();

?>

<?php
  include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/login.css">
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/register.css">
<link rel="stylesheet" href="styles/notify.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
<head>
<body onload="myFunction()">
  <canvas id="particles"></canvas>
  
  <div id="loader">
    <?php include 'loader.php'; ?>
  </div>

  <div id="myDiv" style="display:none;" class="animate-bottom">
    
    <?php
      include 'components/navBar.php';
      include 'components/MobileDrawer.php';
    ?>
    <div class="main-container">
      <div class="orb orb-register"></div>
      
      <div class="register-card"><?php showNotify(); ?>
        <h1>Register</h1>
        
        <form action="register.php" method="post">
          <div class="form-group">
            <input type="text" class="input" placeholder="Name" name="name" required>
          </div>
          
          <div class="form-group">
            <input type="email" class="input" placeholder="Email" name="email" required>
          </div>
          
          <div class="form-group">
            <input type="text" class="input" placeholder="Username" name="username" required>
          </div>
          
          <div class="form-group">
            <div class="password-wrapper">
              <input type="password" class="input" placeholder="Password" id="password" name="password" required>
               <i class="far fa-eye-slash pass-icon" onclick="pass()" id="pass-icon" style="color: #11111;"></i>
            </div>
          </div>
          
          <div class="form-group">
            <div class="password-wrapper">
              <input type="password" class="input" placeholder="Confirm Password" id="conpassword" name="conpassword" required>
                <i class="far fa-eye-slash pass-icon" onclick="passcon()" id="conpass-icon" style="color: #11111;"></i>
            </div>
          </div>
          
          <button type="submit">Sign Up</button>
          
          <a href="login.php" class="login-link">Already have an account? <b>Login</b></a>
        </form>
      </div>
    </div>
    <?php include 'components/footer.php'; ?>
  </div>

  <!-- ── HAMBURGER ── -->
  <script src="scripts/HamburgerMenu.js"></script>
  <!-- ── PARTICLE CANVAS ── -->
  <script src="scripts/backgroundAnimation.js"></script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── PASSWORD TOGGLE ── -->
  <script src="scripts/passwordShow&Hide.js"></script>
</body>
</html>