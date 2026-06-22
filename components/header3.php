<?php include 'notificationCount.php'; ?>
<header id="head">
    <div class="header-container">
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
        <div class="butiocn">
            <a href="notifications.php" title="Notifications">
                <button class="material-symbols-outlined">
                    notifications
                    <?php if ($notifiCount > 0): ?>
                        <span class="notification-badge"><?php echo $notifiCount; ?></span>
                    <?php endif; ?>
                </button>
            </a>
            <a href="logout.php" title="Logout System">
                <button class="material-symbols-outlined">logout</button>
            </a>
            <button class="material-symbols-outlined" id="menu" onclick="show()">menu</button>
        </div>
    </div>
</header>