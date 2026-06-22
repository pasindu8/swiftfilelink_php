<?php
    include 'config.php';
    session_start();
  
    
    $id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    $user = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $type = isset($_SESSION['type']) ? $_SESSION['type'] : '';
    $status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
    $count = isset($_SESSION['notification_count']) ? $_SESSION['notification_count'] : 0; 
    
    $error_msg = ""; 
                        
    if (!isset($_SESSION['type']) || $_SESSION['status'] != "active")
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = $_POST['password'];

            $checklog = "SELECT * FROM user WHERE username='$username'";
            $result = mysqli_query($conn, $checklog);
                
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                $dbpassword = $row['password'];

                if (password_verify($password, $dbpassword)) 
                {
                    if($row['status'] == 'active')
                    {
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['type'] = $row['type'];
                        $_SESSION['status'] = $row['status'];
                        $_SESSION['notification_count'] = $row['notification_count'];
                
                        if ($row['type'] == 'User') {
                            header("Location: user.php"); 
                            exit();
                        } 
                        elseif ($row['type'] == 'admin') {
                            header("Location: admin.php"); 
                            exit();
                        } 
                        elseif ($row['type'] == 'userpro') {
                            header("Location: pro_user.php"); 
                            exit();
                        } 
                        else{
                            $error_msg = "Username or email already exists"; 
                        }
                    }
                    else
                    {
                        header("Location: verification.php"); 
                        exit();
                    }
                } 
                else 
                {
                    $error_msg = "Invalid username or password";
                }    
            } 
            else
            {
                $error_msg = "Invalid username or password";
            }
        }
    }
    else
    {
         header("Location: index.php"); 
         exit();
    }
    $conn->close();
?>
<?php
  include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/login.css">
<link rel="stylesheet" href="styles/main.css">
</head>

<body onload="myFunction()">
  <canvas id="particles"></canvas>
  
  <div id="loader">
    <?php include 'loader.php'; ?>
  </div>

  <div id="myDiv" style="display:none;" class="animate-bottom">
    
    <?php
      include 'components/navBar.php';
      include 'components/MobileDrawer.php';
    ?>


    <div class="main-container">
      <div class="orb orb-login"></div>
      
      <div class="login-card">
        <h1>Login</h1>
        
        <?php if(!empty($error_msg)): ?>
          <div class="error-message show" id="errorMsg"><?php echo $error_msg; ?></div>
        <?php else: ?>
          <div class="error-message" id="errorMsg"></div>
        <?php endif; ?>
        
        <form action="login.php" method="POST" id="loginForm">
          <div class="form-group">
            <label for="username">Username or Email</label>
            <input 
              type="text" 
              id="username"
              name="username"
              class="input" 
              placeholder="Enter your username or email"
              required
            >
          </div>
          
          <div class="form-group">
            <label for="password">Password</label>
            <input 
              type="password" 
              id="password"
              name="password"
              class="input" 
              placeholder="Enter your password"
              required
            >
          </div>
          
          <div class="form-options">
            <label>
              <input type="checkbox" id="rememberMe">
              Remember me
            </label>
            <a class="forgot-link" href="forgotpassword.php">Forgot Password?</a>
          </div>
          
          <button type="submit">Login</button>
          <a href="register.php" class="signup-link">Don't have an account? <b>Register</b></a>
        </form>
      </div>
    </div>

    <?php include 'components/footer.php'; ?>
  
  </div>
  
  <!-- ── HAMBURGER ── -->
  <script src="scripts/HamburgerMenu.js"></script>
  <!-- ── PARTICLE CANVAS ── -->
  <script src="scripts/backgroundAnimation.js"></script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
</body>
</html>