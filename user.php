<?php
include 'components/sessionsActive.php'; 
include 'components/headerNoLogin.php';
?>
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
                <span class="hed"><?php echo htmlspecialchars($type); ?> Profile</span>
                
                <div class="profile-avatar-wrap">
                    <img src="user.png" alt="User Avatar">
                </div>
                
                <center>
                    <h1><?php echo htmlspecialchars($name); ?></h1>
                    <samp>Welcome to your profile!</samp>
                </center>
                
                <h3>Personal Information</h3>
                
                <div class="info-row">
                    <span class="info-label">Full Name</span>
                    <span class="info-value">:- <?php echo htmlspecialchars($name); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Username</span>
                    <span class="info-value">:- <?php echo htmlspecialchars($user); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Email Address</span>
                    <span class="info-value">:- <?php echo htmlspecialchars($email); ?></span>
                </div>
            </main>
            
            <?php include 'userbar.php'; ?>
            
        </div>
        
        <?php include 'components/footer.php'; ?>

    </div>
  
   <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── Sidebar Navigation ── -->
  <script src="scripts/SidebarNavigation.js"></script>
</body>
</html>