<?php
 
  include 'config.php';
  session_start();
  $id = $_SESSION['user_id'];
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $user = $_SESSION['username'];
  $type = $_SESSION['type'];
  $status = $_SESSION['status'];
  $count = $_SESSION['notification_count']; 

  if (!isset($_SESSION['type']) || $_SESSION['type'] != "user" || $_SESSION['status'] != "active")
  {
      header('Location:login.php');
  }

  include 'components/notificationCount.php';
  
?>

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

<style>

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    background-color: #0d1117;
    color: #c9d1d9;
    padding: 20px;
    box-sizing: border-box;
    border-right: 1px solid #21262d;
    display: flex;
    flex-direction: column;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    z-index: 9999;
}

/* Close/Back Button */
.sidebar .back {
    align-self: flex-end;
    color: #6e7681;
    cursor: pointer;
    font-size: 22px;
    margin-bottom: 15px;
    transition: color 0.2s;
}
.sidebar .back:hover {
    color: #f0f6fc;
}


.profile-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 5px;
}

.avatar-container {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: 2px solid #3fb950;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-icon {
    font-size: 28px;
    color: #8b949e;
}

.user-info {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.user-info h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    color: #f0f6fc;
}

.user-type {
    font-size: 12px;
    color: #8b949e;
    text-transform: capitalize;
}

.status-tag {
    align-self: flex-start;
    font-size: 10px;
    padding: 1px 6px;
    border-radius: 10px;
    font-weight: bold;
    background-color: rgba(63, 185, 80, 0.15);
    color: #3fb950;
    margin-top: 3px;
    text-transform: uppercase;
}

.bookmark-icon {
    color: #8b949e;
    font-size: 20px;
}


.section-separator {
    border: 0;
    border-top: 1px solid #21262d;
    margin: 15px 0 10px 0;
}


.section-title {
    display: block;
    font-size: 11px;
    font-weight: 700;
    color: #8b949e;
    margin-bottom: 8px;
    letter-spacing: 0.5px;
}


.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    margin-bottom: 4px;
}

.sidebar ul li a {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 10px;
    border-radius: 6px;
    text-decoration: none;
    color: #c9d1d9;
    font-size: 14px;
    transition: background-color 0.2s, color 0.2s;
}

.sidebar ul li a:hover {
    background-color: #21262d; 
    color: #f0f6fc;
}


.sidebar ul li a.hold {
    background-color: #21262d;
    color: #3fb950; 
    font-weight: 600;
}

.sidebar ul li a .material-symbols-outlined {
    font-size: 18px;
    color: #8b949e;
}

.sidebar ul li a.hold .material-symbols-outlined {
    color: #3fb950; 
}


.notification-container {
    display: flex;
    justify-content: space-between;
    width: 100%;
    align-items: center;
}

.notification-badge {
    background-color: #da3633; 
    color: #ffffff;
    font-size: 11px;
    font-weight: bold;
    padding: 1px 6px;
    border-radius: 10px;
}


.logout-section {
    margin-top: auto;
    padding-top: 10px;
}

.logout-link {
    color: #f85149 !important; 
}

.logout-link .material-symbols-outlined {
    color: #f85149 !important;
}

.logout-link:hover {
    background-color: rgba(248, 81, 73, 0.1) !important;
}
</style>

<?php
    		$current_page = basename($_SERVER['PHP_SELF']);
			
			$a1     = ($current_page == 'user.php') ? 'hold' : '';
            $a2     = ($current_page == 'edit.php') ? 'hold' : '';
            $a3 = ($current_page == 'change.php') ? 'hold' : '';
            $a4  = ($current_page == 'delete.php') ? 'hold' : '';
            $a5      = ($current_page == 'upload.php') ? 'hold' : '';
            $a6    = ($current_page == 'notifications.php') ? 'hold' : '';
    		$a7    = ($current_page == 'index.php') ? 'hold' : '';
			$a8    = ($current_page == 'download.php') ? 'hold' : '';
 
    ?>

<aside class="sidebar" id="Settings">
    <span class="material-symbols-outlined back" onclick="hide()">keyboard_double_arrow_left</span>
    
    <div class="profile-header">
        <div class="avatar-container">
            <span class="material-symbols-outlined avatar-icon">account_circle</span>
        </div>
        <div class="user-info">
            <h3><?php echo htmlspecialchars($name); ?></h3>
            <span class="user-type"><?php echo htmlspecialchars($type); ?></span>
            <span class="status-tag"><?php echo htmlspecialchars($status); ?></span>
        </div>
        <span class="material-symbols-outlined bookmark-icon">bookmark_border</span>
    </div>

    <div class="section-separator"></div>

    <span class="section-title">ACCOUNT</span>
    <ul>
        <li>
            <a href="index.php" class="<?php echo $a7; ?>">
                <span class="material-symbols-outlined">home</span> 
                Home
            </a>
        </li>
        <li>
            <a href="user.php" class="<?php echo $a1; ?>">
                <span class="material-symbols-outlined">account_circle</span> 
                Profile
            </a>
        </li>
        <li>
            <a href="edit.php" class="<?php echo $a2; ?>">
                <span class="material-symbols-outlined">person_edit</span> 
                Edit Profile
            </a>
        </li>
        <li>
            <a href="change.php" class="<?php echo $a3; ?>">
                <span class="material-symbols-outlined">sync_lock</span> 
                Password Change
            </a>
        </li>
        <li>
            <a href="delete.php" class="<?php echo $a4; ?>">
                <span class="material-symbols-outlined">person_remove</span> 
                Delete Account
            </a>
        </li>
    </ul>

    <div class="section-separator"></div>

    <span class="section-title">FILES</span>
    <ul>
        <li>
            <a href="upload.php" class="<?php echo $a5; ?>">
                <span class="material-symbols-outlined">upload_file</span> 
                Upload Files
            </a>
        </li>
        <li>
            <a href="download.php" class="<?php echo $a8; ?>">
                <span class="material-symbols-outlined">download_2</span> 
                Download Files
            </a>
        </li>
    </ul>

    <div class="section-separator"></div>

    <span class="section-title">ALERTS</span>
    <ul>
        <li>
            <a href="notifications.php" class="<?php echo $a6; ?>">
                <div class="notification-container">
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <span class="material-symbols-outlined">notifications</span> 
                        Notifications
                    </div>
                    <?php if ((int)$notifiCount > 0): ?>
                        <span class="notification-badge"><?php echo $notifiCount; ?></span>
                    <?php endif; ?>
                </div>
            </a>
        </li>
    </ul>

    <div class="logout-section">
        <ul>
            <li>
                <a href="logout.php" class="logout-link">
                    <span class="material-symbols-outlined">exit_to_app</span> 
                    Log out
                </a>
            </li>
        </ul>
    </div>
</aside>