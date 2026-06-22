<?php 
include 'components/sessionsActive.php'; 
require_once 'components/notify.php';
include 'components/secretKey.php';

$mid = filter_input(INPUT_GET, 'nid', FILTER_VALIDATE_INT);
$url_token = filter_input(INPUT_GET, 'token', FILTER_DEFAULT);

if (!$mid || !$url_token){
    setNotify('warning', 'CRITICAL WARNING: Invalid Request parameters!');
    header("Location: notifications.php");
    exit();
}

$expected_token = hash_hmac('sha256', $mid, $secret_key);

if (hash_equals($expected_token, $url_token)){
   
    $no = "SELECT * FROM notification WHERE notification_id='$mid'";
    $result = mysqli_query($conn, $no);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        
        
        $message = nl2br(htmlspecialchars($row['message']));
        $nid = $row['notification_id'];

        
        $updatepass = "UPDATE notification SET notiread = '0' WHERE notification_id='$mid'"; 
        if ($conn->query($updatepass) === TRUE) {
            setNotify('success', 'Message Status Updated.');
        }
        
        
        $token = hash_hmac('sha256', $nid, $secret_key);
        $s1_url = "delema.php?nid=" . $nid . "&token=" . $token;
    } else {
        setNotify('warning', 'Notification not found.');
        header("Location: notifications.php");
        exit();
    }
} else {
    setNotify('warning', 'Security Error: URL has been tampered with or Token is invalid!');
    header("Location: notifications.php");
    exit();
}


include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/massage.css"> 
<link rel="stylesheet" href="styles/notify.css">
</head> 
<body onload="myFunction()"> 
  <div id="loader">
   <?php include 'loader.php'; ?>
  </div>
  
  <div style="display:none;" id="myDiv" class="animate-bottom"> 
    <?php include 'components/header3.php'; ?>
        
    <div class="container">
        <main class="content">
            <?php showNotify(); ?>
            <div class="co" style="text-align: center;">
                <h1>Message</h1><br><br>
                
                <div class="message-body" style="color: #fff; font-size: 16px; margin-bottom: 20px;">
                    <?php echo $message; ?>
                </div>

                <a class='buse' href='<?php echo $s1_url; ?>' style="padding: 8px 16px; background: red; color: white; text-decoration: none; border-radius: 4px;">Delete</a>
            </div>
        </main>
        
        <?php
        switch ($type) {
            case "admin":
                include 'adminbar.php';
                break;
            case "User":
                include 'userbar.php';
                break;
            default:
                echo "<h3>Error</h3>";
        }
        ?>
    </div>
   
    <?php include 'components/footer.php'; ?>
  </div>
  
  <script src="scripts/loader.js"></script>
  <script src="scripts/SidebarNavigation.js"></script>
</body>
</html>