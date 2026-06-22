<div class="drawer" id="drawer">
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
                        <a href="index.php" class="'.$home_active.'"><span class="drawer-icon">🏠</span>Home</a>
                        <a href="uploadn.php" class="'.$send_active.'"><span class="drawer-icon">📤</span>File Send</a>
                        <a href="downloadn.php" class="'.$download_active.'"><span class="drawer-icon">📥</span>File Download</a>
                        <a href="contactus.php" class="'.$contact_active.'"><span class="drawer-icon">📞</span>Contact Us</a>
                        <a href="faq.php" class="'.$faq_active.'"><span class="drawer-icon">❓</span>FAQ</a>
                        <a href="login.php" class="'.$login_active.'"><span class="drawer-icon">🔑</span>Login</a>
                        <a href="register.php" class="'.$register_active.'"><span class="drawer-icon">✨</span>Sign Up</a>
                    ';
            }
            else
            {
                echo '
                        <a href="index.php" class="'.$home_active.'"><span class="drawer-icon">🏠</span>Home</a>
                        <a href="upload.php" class="'.$send_active.'"><span class="drawer-icon">📤</span>File Send</a>
                        <a href="download.php" class="'.$download_active.'"><span class="drawer-icon">📥</span>File Download</a>
                        <a href="contactus.php" class="'.$contact_active.'"><span class="drawer-icon">📞</span>Contact Us</a>
                        <a href="faq.php" class="'.$faq_active.'"><span class="drawer-icon">❓</span>FAQ</a>
                        <a href="logout.php"><span class="drawer-icon">🔑</span>Logout</a>
                    ';
            }
        ?>
</div>