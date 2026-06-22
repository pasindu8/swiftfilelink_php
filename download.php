<?php 
include 'components/sessionsActive.php'; 
include 'components/headerNoLogin.php';
require_once 'components/notify.php';
?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/download.css"> 
<link rel="stylesheet" href="styles/notify.css">
<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body onload="myFunction()"> 

  <div id="loader">
    <?php include 'loader.php'; ?>
  </div>
  
  <div style="display:none;" id="myDiv"> 

  <?php include 'components/header3.php'; ?>
          
    <div class="container">
        <div class="orb"></div>
        
        <main class="content">
            <div class="download-card"><?php showNotify(); ?>
                <form action="view_files.php" method="POST" autocomplete="off" id="myform">
                    <h5 class="mainhed">Enter YOUR PIN Number</h5>
                    
                    <input class="input" type="text" name="pin" id="pin" placeholder="0000" autocomplete="off" maxlength="5" required>

                    <button class="g-recaptcha" 
                            data-sitekey="6LfC3WwqAAAAAKX4uRPxQfW1JrxuLfdkelC0_iiV" 
                            data-callback='onSubmit' 
                            data-action='submit' 
                            name="pindo">View Files</button>
                    <p style="color: rgba(255,255,255,0.3); font-size: 11px; margin-top: 15px; font-family: sans-serif;">
  						This site is protected by reCAPTCHA and the Google 
  						<a href="https://policies.google.com/privacy" target="_blank" style="color: var(--c);">Privacy Policy</a> and 
  						<a href="https://policies.google.com/terms" target="_blank" style="color: var(--c);">Terms of Service</a> apply.
					</p>
                </form>
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
                echo "<h3 style='color:var(--o); text-align:center;'>Error loading panel</h3>";
        }
        ?>
    </div>

    <?php include 'components/footer.php'; ?>

  </div>

  <script>
    function onSubmit(token) {
        document.getElementById("myform").submit();
    }
  </script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── Sidebar Navigation ── -->
  <script src="scripts/SidebarNavigation.js"></script>
 
</body>
</html>