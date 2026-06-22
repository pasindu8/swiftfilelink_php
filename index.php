<?php
  include 'config.php';

  include 'components/sessions.php';
   
  include 'notificationsend.php';                       
  
  include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main.css">
</head>
<body>

<canvas id="particles"></canvas>

<!-- NAV -->
  <?php
      include 'components/navBar.php';
  ?>
  
<!-- MOBILE DRAWER -->
 <?php
    include 'components/MobileDrawer.php';
 ?>

<!-- HERO -->
<section class="hero">
  <div class="orb orb1"></div>
  <div class="orb orb2"></div>
  <div class="orb orb3"></div>

  <div class="hero-badge">
    <div class="badge-ring-outer"></div>
    <div class="badge-ring-inner">
      <span class="badge-bird"><img src="logo2.png" width="100" height="100" style="border-radius:50%;" class="logoi"></span>
    </div>
  </div>

  <h1 class="hero-title">SWIFTFILELINK</h1>
  <p class="hero-tagline">Quick. Simple. Secure.</p>

  <div class="cta-stack">
    <a href="upload.php" class="btn-primary" id="sendBtn">
      <svg class="ico" viewBox="0 0 24 24"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
      Send Files Now
    </a>
    <a href="download.php" class="btn-secondary">
      <svg class="ico" viewBox="0 0 24 24"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
      Download with PIN
    </a>
  </div>

  <div class="features">
    <div class="feat">
      <span class="feat-icon feat-i1">⚡</span>
      <span class="feat-label">Ultra Fast</span>
    </div>
    <div class="feat">
      <span class="feat-icon feat-i2">🔒</span>
      <span class="feat-label">Encrypted</span>
    </div>
    <div class="feat">
      <span class="feat-icon feat-i3">🌐</span>
      <span class="feat-label">Anywhere</span>
    </div>
    <div class="feat">
      <span class="feat-icon feat-i4">📌</span>
      <span class="feat-label">PIN Share</span>
    </div>
  </div>

  <div class="stats">
    <div class="stat">
      <span class="stat-num">2M+</span>
      <span class="stat-lbl">FILES SENT</span>
    </div>
    <div class="stat">
      <span class="stat-num">150+</span>
      <span class="stat-lbl">COUNTRIES</span>
    </div>
    <div class="stat">
      <span class="stat-num">99.9%</span>
      <span class="stat-lbl">UPTIME</span>
    </div>
  </div>

  <div class="scroll-cue">
    <span>SCROLL</span>
    <div class="scroll-arrow"></div>
  </div>
</section>
<?php
  include 'components/footer.php';
?>

<div class="toast" id="toast">🚀 Redirecting to file upload...</div>

<!-- ── HAMBURGER ── -->
<script src="scripts/HamburgerMenu.js"></script>
<!-- ── PARTICLE CANVAS ── -->
<script src="scripts/backgroundAnimation.js"></script>
<!-- ── TOAST ── -->
<script src="scripts/buttonToast.js"></script>
</body>
</html>