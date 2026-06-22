<?php
    include 'components/adminSession.php';
    include 'components/headerNoLogin.php';
?>

<link rel="stylesheet" href="styles/admin.css">
<link rel="stylesheet" href="styles/main2.css">
</head> 
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        
        <?php include 'components/header3.php'; ?>
              
        <div class="container">
            
            <main class="content">
                <div style="text-align: center;">
                    <h1 class="hed">Admin Profile</h1>
                    <img src="user.png" width="160" height="160" class="admin-avatar" alt="Admin Avatar">
                    <h2 class="admin-name"><?php echo htmlspecialchars($name); ?></h2>
                    <span class="welcome-tag">Welcome back to your master control profile station.</span>
                </div>
                
                <h3 class="info-section-title">Personal Information</h3>
                
                <div class="info-group">
                    <span class="info-label">Full Name</span>
                    <span class="info-value"><?php echo htmlspecialchars($name); ?></span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Username</span>
                    <span class="info-value"><?php echo htmlspecialchars($user); ?></span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Email Address</span>
                    <span class="info-value"><?php echo htmlspecialchars($email); ?></span>
                </div>
                
                <div class="info-group">
                    <span class="info-label">Account Status</span>
                    <span class="info-value" style="color: #4BB543;">● Active <?php echo htmlspecialchars($status); ?></span>
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
                    echo "<div class='content'><h3>Access Privilege Error</h3></div>";
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