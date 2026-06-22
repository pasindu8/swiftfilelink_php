<?php
    include 'components/sessionsActive.php'; 
    require_once 'components/notify.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $ename = $_POST['name'];
        $eusername = $_POST['username'];
        $eemail = $_POST['email'];

        $sqlre = "UPDATE user SET name = '$ename', username = '$eusername' WHERE user_id = '$id'";
        
        if ($conn->query($sqlre) === TRUE) 
        {
            $message = $ename . " your has update profile<br>";
            $notifi = "INSERT INTO notification (message, notiread, user_id) VALUES ('$message', '1', '1')";
            
            if ($conn->query($notifi) === TRUE) 
            { 
                setNotify('success', 'Update profile');
                header("Location: edit.php"); 
                exit();
            }
        }
        else
        {
            setNotify('warning', 'System Error : Please try again.'); 
        }
    }
    include 'components/headerNoLogin.php';
?>

<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/input.css">
<link rel="stylesheet" href="styles/notify.css">
</head> 
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        
        <?php include 'components/header3.php'; ?>
            
        <div class="container">
            
            <main class="content"><?php showNotify(); ?>
                <div class="co">
                    <h1>Edit Profile</h1>
                    
                    <form action="edit.php" method="post">
                        <input type="text" class="input" value="<?php echo htmlspecialchars($name); ?>" placeholder="Name" name="name" required>
                        <input type="email" class="input" value="<?php echo htmlspecialchars($email); ?>" placeholder="Email" name="email" readonly>
                        <input type="text" class="input" value="<?php echo htmlspecialchars($user); ?>" placeholder="Username" name="username" required>
                        <button type="submit" class="svbutton">SAVE</button>
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
                    echo "<h3 style='color:red;'>Error: Invalid Role</h3>";
            }
            ?>
        </div>
        
        <?php include 'components/footer.php'; ?>
    </div>
  
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── Sidebar Navigation ── -->
  <script src="scripts/SidebarNavigation.js"></script>
</body>
</html>