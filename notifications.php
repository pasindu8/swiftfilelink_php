<?php include 'components/sessionsActive.php'; 
include 'components/headerNoLogin.php';
require_once 'components/notify.php';
?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/notifications.css">
<link rel="stylesheet" href="styles/notify.css">
</head> 
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        
    <?php include 'components/header3.php'; ?>
            
        <div class="container">
            
            <main class="content"><?php showNotify(); ?>
                <div class="co">
                    <h1>Notifications</h1>

                    <?php
                    $no = "SELECT * FROM notification WHERE user_id='$id'";
                    $result = mysqli_query($conn, $no);
                        
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $message = $row['message'];
                            $nread = $row['notiread'];
                            $nid = $row['notification_id'];
							include 'components/secretKey.php';
                            $token = hash_hmac('sha256', $nid, $secret_key);
                            $s1_url = "massage.php?nid=" . $nid . "&token=" . $token;
                            
                            $statusClass = ($nread == 1) ? 'noti-unread' : 'noti-read';

                            echo "<a class='noti-link' style='text-decoration: none;' href='" . $s1_url . "'>";
                            echo "  <div class='noti-item " . $statusClass . "'>";
                            echo "      <div class='noti-icon'><span class='material-symbols-outlined'>circle_notifications</span></div>";
                            echo "      <div class='noti-text'>" . $message . "</div>";
                            echo "  </div>";
                            echo "</a>";
                        }
                    } else {
                        echo "<div style='text-align:center; color:rgba(255,255,255,0.2); margin-top:30px; font-size:14px;'>No notifications found.</div>";
                    }
                    ?>
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
                    echo "<h3 style='color:red;'>Error: Invalid Role</h3>";
            }
            ?>
        </div>
        
      <?php include 'components/footer.php'; ?>
    </div>
  
    <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── Sidebar Navigation ── -->
  <script src="scripts/SidebarNavigation.js"></script>
</body>
</html>