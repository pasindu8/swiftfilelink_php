<?php
    include 'config.php';
    session_start();
    include 'components/headerNoLogin.php';
require_once 'components/notify.php';
?>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/download.css">
<link rel="stylesheet" href="styles/notify.css">
<script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 

    <?php include 'components/navBar.php'; 
          include 'components/MobileDrawer.php';
        ?>
              
        <div class="container">
            <main class="content"><?php showNotify(); ?>
                <form action="view_filesn.php" method="POST" autocomplete="off" id="myform">
                    <div style="text-align: center;">  
                        <h5 class="mainhed">Enter YOUR PIN Number</h5>
                        
                        <input class="input" type="text" name="pin" id="pin" placeholder="00000" autocomplete="off" maxlength="5" required>

                        <button class="buttdo g-recaptcha" 
                                data-sitekey="your_recaptcha_site_key" 
                                data-callback='onSubmit' 
                                data-action='submit'
                                data-badge="bottomleft"
                                name="pindo">View Files</button>
                    </div>
                    <p style="color: rgba(255,255,255,0.3); font-size: 11px; margin-top: 15px; font-family: sans-serif;">
  						This site is protected by reCAPTCHA and the Google 
  						<a href="https://policies.google.com/privacy" target="_blank" style="color: var(--c);">Privacy Policy</a> and 
  						<a href="https://policies.google.com/terms" target="_blank" style="color: var(--c);">Terms of Service</a> apply.
					</p>
                </form>
                
            </main>
        </div>

       <?php include 'components/footer.php'; ?>
    </div>

    <script>
        // reCAPTCHA Token callback
        function onSubmit(token) {
            document.getElementById("myform").submit();
        }
    </script>
  <!-- ── PARTICLE CANVAS ── -->
  <script src="scripts/backgroundAnimation.js"></script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── HAMBURGER ── -->
  <script src="scripts/HamburgerMenu.js"></script>
</body>
</html>