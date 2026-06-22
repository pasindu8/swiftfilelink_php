<nav>
  <a class="logo-wrap" href="index.php">
    <div class="logo-ring-wrap">
      <div class="logo-ring"></div>
      <div class="logo-inner"><img src="logo2.png" width="24" height="24" style="border-radius:50%;" class="logoi"></div>
    </div>
    <div>
      <div class="logo-name">SWIFTFILELINK</div>
      <div class="logo-tag">Quick. Simple. Secure.</div>
    </div>
  </a>

  <div class="nav-links">
     <?php
    		$current_page = basename($_SERVER['PHP_SELF']);
			
			$home_active     = ($current_page == 'index.php') ? 'active' : '';
            $send_active     = ($current_page == 'uploadn.php' || $current_page == 'upload.php') ? 'active' : '';
            $download_active = ($current_page == 'downloadn.php' || $current_page == 'download.php') ? 'active' : '';
            $contact_active  = ($current_page == 'contactus.php') ? 'active' : '';
            $faq_active      = ($current_page == 'faq.php') ? 'active' : '';
            $login_active    = ($current_page == 'login.php') ? 'active' : '';
            $register_active = ($current_page == 'register.php') ? 'active' : '';

            if (!isset($_SESSION['type']) || $_SESSION['status'] != "active")
            {
                echo '
                        <a href="index.php" class="'.$home_active.'">Home</a>
                        <a href="uploadn.php" class="'.$send_active.'">File Send</a>
                        <a href="downloadn.php" class="'.$download_active.'">File Download</a>
                        <a href="contactus.php" class="'.$contact_active.'">Contact</a>
                        <a href="faq.php" class="'.$faq_active.'">FAQ</a>
                        <a href="login.php" class="nl '.$login_active.'">Login</a>
                        <a href="register.php" class="ns '.$register_active.'">Sign Up</a>
                    ';
            }
            else
            {
                echo '
                        <a href="index.php" class="'.$home_active.'">Home</a>
                        <a href="upload.php" class="'.$send_active.'">File Send</a>
                        <a href="download.php" class="'.$download_active.'">File Download</a>
                        <a href="contactus.php" class="'.$contact_active.'">Contact</a>
                        <a href="faq.php" class="'.$faq_active.'">FAQ</a>
                        <a href="logout.php" class="nl">Logout</a>
                ';
            }
        ?>
  </div>
  <button class="hamburger" id="ham" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>
