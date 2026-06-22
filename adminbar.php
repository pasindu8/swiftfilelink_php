<?php
  include 'config.php';
  
  
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  if (!isset($_SESSION['type']) || $_SESSION['type'] != "admin" || $_SESSION['status'] != "active")
  {
      header('Location:login.php');
      exit();
  }

  $id = $_SESSION['user_id'];
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
  $user = $_SESSION['username'];
  $type = $_SESSION['type'];
  $status = $_SESSION['status'];
  $count = isset($_SESSION['notification_count']) ? $_SESSION['notification_count'] : 0; 


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
        background: #0f1117;
        border: 1px solid rgba(255, 51, 51, 0.15); 
        border-radius: 16px;
        padding: 25px 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(255, 51, 51, 0.03);
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

   
    .sb-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 15px;
        position: relative;
    }

    .sb-avatar .material-symbols-outlined {
        font-size: 45px;
        color: #ff3333; /* Master Admin Red Color Theme */
    }

    .sb-name {
        margin: 0;
        font-family: 'Orbitron', sans-serif;
        font-size: 15px;
        color: #ffffff;
        letter-spacing: 0.5px;
        max-width: 140px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sb-role {
        font-size: 11px;
        color: #ff3333;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
    }

    /* Active Green Online Status Badge */
    .sb-badge {
        display: inline-block;
        background: rgba(255, 51, 51, 0.1);
        color: #ff3333;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 12px;
        text-transform: uppercase;
        margin-top: 5px;
        border: 1px solid rgba(255, 51, 51, 0.2);
    }

    /* Interactive Close Control Icon Arrow Button */
    .sb-close {
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: rgba(255, 255, 255, 0.2);
        transition: color 0.2s ease;
    }

    .sb-close:hover {
        color: #ff3333;
    }

    /* Content Hierarchy Section Section Separators */
    .sb-section {
        font-family: 'Orbitron', sans-serif;
        font-size: 11px;
        font-weight: 700;
        color: rgba(255, 51, 51, 0.8);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 15px;
        margin-bottom: 5px;
        padding-left: 10px;
    }

    .sb-divider {
        height: 1px;
        background: rgba(255, 255, 255, 0.04);
        margin: 10px 0;
    }

    /* Structural List Link Navigation Items group */
    .sb-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .sb-nav li a {
        display: flex;
        align-items: center;
        gap: 12px;
        color: rgba(255, 255, 255, 0.5);
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 14px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .sb-nav li a .material-symbols-outlined {
        font-size: 20px;
        color: rgba(255, 255, 255, 0.3);
        transition: color 0.2s ease;
    }

    /* Hover States & Active Class Links logic visual triggers */
    .sb-nav li a:hover {
        background: rgba(255, 51, 51, 0.03);
        color: #ffffff;
    }

    .sb-nav li a:hover .material-symbols-outlined {
        color: #ff3333;
    }

    .sb-nav li a.active {
        background: rgba(255, 51, 51, 0.1);
        color: #ff3333;
        border-left: 3px solid #ff3333;
        border-radius: 0 8px 8px 0;
    }

    .sb-nav li a.active .material-symbols-outlined {
        color: #ff3333;
    }

    /* Notification Alert Glowing Badge numeric count holder */
    .sb-badge-notif {
        background: #ff3333;
        color: #ffffff;
        font-family: 'Orbitron', sans-serif;
        font-size: 10px;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 10px;
        margin-left: auto;
        box-shadow: 0 0 10px rgba(255, 51, 51, 0.4);
    }

    /* Fixed Layout Bottom Sticky Actions Area */
    .sb-footer {
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    .sb-logout {
        display: flex;
        align-items: center;
        gap: 12px;
        color: rgba(255, 51, 51, 0.6) !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 14px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .sb-logout:hover {
        background: rgba(255, 51, 51, 0.05);
        color: #ff3333 !important;
        box-shadow: 0 0 10px rgba(255, 51, 51, 0.1);
    }
</style>

<aside class="sidebar" id="Settings">
    <?php
    		$current_page = basename($_SERVER['PHP_SELF']);
			
			$a1     = ($current_page == 'admin.php') ? 'active' : '';
            $a2     = ($current_page == 'edit.php') ? 'active' : '';
            $a3 = ($current_page == 'change.php') ? 'active' : '';
            $a4  = ($current_page == 'manage_users.php') ? 'active' : '';
            $a5      = ($current_page == 'manage_files.php') ? 'active' : '';
            $a6    = ($current_page == 'notifications.php') ? 'active' : '';
    		$a7    = ($current_page == 'index.php') ? 'active' : '';
 
    ?>
    <div class="sb-header">
        <div class="sb-avatar">
            <span class="material-symbols-outlined">account_circle</span>
        </div>
        <div>
            <h3 class="sb-name"><?php echo htmlspecialchars($name); ?></h3>
            <span class="sb-role"><?php echo htmlspecialchars($type); ?> Node</span><br>
            <span class="sb-badge">● <?php echo htmlspecialchars($status); ?></span>
        </div>
        <div class="sb-close" onclick="hide()" title="Collapse Panel">
            <span class="material-symbols-outlined">keyboard_double_arrow_left</span>
        </div>
    </div>

    <div class="sb-section">Admin Core</div>
    <ul class="sb-nav">
        <li>
            <a href="index.php" class="<?php echo $a7; ?>">
                <span class="material-symbols-outlined">home</span> 
                Home
            </a>
        </li>
        <li>
            <a href="admin.php" class="<?php echo $a1; ?>">
                <span class="material-symbols-outlined">admin_panel_settings</span> 
                Admin Dashboard
            </a>
        </li>
        <li>
            <a href="edit.php" class="<?php echo $a2; ?>">
                <span class="material-symbols-outlined">manage_accounts</span> 
                Modify Profile
            </a>
        </li>
        <li>
            <a href="change.php" class="<?php echo $a3; ?>">
                <span class="material-symbols-outlined">lock_reset</span> 
                Root Password
            </a>
        </li>
    </ul>

    <div class="sb-divider"></div>

    <div class="sb-section">Infrastructure</div>
    <ul class="sb-nav">
        <li>
            <a href="manage_users.php" class="<?php echo $a4; ?>">
                <span class="material-symbols-outlined">group</span> 
                Manage Users
            </a>
        </li>
        <li>
            <a href="manage_files.php" class="<?php echo $a5; ?>">
                <span class="material-symbols-outlined">folder_managed</span> 
                System File Log
            </a>
        </li>
    </ul>

    <div class="sb-divider"></div>

    <div class="sb-section">System Security</div>
    <ul class="sb-nav">
        <li>
            <a href="notifications.php" class="<?php echo $a6; ?>">
                <span class="material-symbols-outlined">terminal</span> 
                Alert Logs
                <?php if ((int)$notifiCount > 0): ?>
                    <span class="sb-badge-notif"><?php echo $notifiCount; ?></span>
                <?php endif; ?>
            </a>
        </li>
    </ul>

    <div class="sb-footer">
        <a href="logout.php" class="sb-logout">
            <span class="material-symbols-outlined">power_settings_new</span> 
            Terminate Session
        </a>
    </div>

</aside>