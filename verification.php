<?php

session_start();
include 'config.php';
require_once 'components/notify.php';

if (isset($_GET['reset_timer'])) {
    
   
    if (isset($_SESSION['useridv'])) {
        $user_idv = intval($_SESSION['useridv']); 
        $verificationcode = rand(11111, 99999);
        $token = bin2hex(random_bytes(32));
        
        date_default_timezone_set("Asia/Colombo");
        $deletedate = date("Y-m-d H:i:s");
        
        
        $updateotp = "UPDATE verification SET verificationcode = '$verificationcode', token = '$token', deletedate = '$deletedate' WHERE user_id = '$user_idv'"; 

        if ($conn->query($updateotp) === TRUE) {
            
            $_SESSION['start_time'] = time();
            
            setNotify('success', 'Verification email sent. Please check your email');
            header("Location: verificationr.php?id=$token"); 
            exit();
        } else {
            setNotify('warning', 'Database Error: Unable to update OTP'); 
        }
    } else {
        setNotify('error', 'Session expired. Please request a new link.');
    }
}


if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

$elapsed_time = time() - $_SESSION['start_time'];
$wait_time = 2 * 60; 


$link_disabled = $elapsed_time < $wait_time;

$conn->close();
include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/verifi.css">
<link rel="stylesheet" href="styles/notify.css">
</head> 
<body onload="myFunction()">
    <canvas id="particles"></canvas>

  <div id="loader">
    <?php include 'loader.php'; ?>
  </div>
  
  <div style="display:none;" id="myDiv" class="animate-bottom"> 
    <center>
      <?php
      include 'components/navBar.php';
      include 'components/MobileDrawer.php';
  ?>

      
      <br><br><br><br><br>

      <div class="co"><?php showNotify(); ?>
          <h1>Email Verification</h1><br><br>
          <form action="verifyotp.php" method="post">
              <input type="text" class="input" placeholder="Enter OTP Code" name="otp" required autocomplete="off"><br>
              
              <button type="submit">Verify OTP</button><br>
             
              <?php if ($link_disabled): ?>
                  <a href="#" style="pointer-events: none; color: gray; text-decoration: none;">
                      <p><span id="countdown"></span> Resend OTP</p>
                  </a>
              <?php else: ?>
                  <a href="?reset_timer=1" style="color: #ff3333; font-weight: bold;">Resend OTP</a>
              <?php endif; ?>
          </form>
      </div>

      <?php include 'components/footer.php'; ?>
    </center>
  </div>
  
  
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── HAMBURGER ── -->
  <script src="scripts/HamburgerMenu.js"></script>
  <!-- ── PARTICLE CANVAS ── -->
  <script src="scripts/backgroundAnimation.js"></script>
  <script>
    var waitTime = <?php echo $wait_time; ?>; 
    var elapsedTime = <?php echo $elapsed_time; ?>;
    var remainingTime = waitTime - elapsedTime;

    function updateCountdown() {
        if (remainingTime > 0) {
            var minutes = Math.floor(remainingTime / 60);
            var seconds = remainingTime % 60;
            
            if (seconds < 10) seconds = "0" + seconds;
            
            document.getElementById("countdown").innerHTML = "(" + minutes + ":" + seconds + ")";
            remainingTime--;
            setTimeout(updateCountdown, 1000);
        } else {
            location.reload(); 
        }
    }

    if (remainingTime > 0) {
        updateCountdown();
    }
  </script>
</body>
</html>