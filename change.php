<?php
    include 'components/sessionsActive.php';
	require_once 'components/notify.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        $pold = $_POST['old'];
        $pnew = $_POST['new'];
        $pconew = $_POST['connew'];
        $message = "Your Password has been reset Successfully";
        $checklog = "SELECT * FROM user WHERE user_id = '$id'";
      
        $result = mysqli_query($conn, $checklog);
        
        if (mysqli_num_rows($result) > 0) {
            
            $row = mysqli_fetch_array($result);
            $dbpassword = $row['password'];
            
            if (password_verify($pold, $dbpassword)) 
            {
                if($pnew == $pconew)
                {
                    $hashed_password = password_hash($pconew, PASSWORD_BCRYPT);
                    $sqlre = "UPDATE user SET password = '$hashed_password' WHERE user_id = '$id'";
        
                    if ($conn->query($sqlre) === TRUE) 
                    {
                        $notifi = "INSERT INTO  notification (message, notiread, user_id) VALUES ('$message', '1', '$id')";
                  		if ($conn->query($notifi) === TRUE)
                        {
                            header("Location: changedsuccess.php"); 
                        	exit();
                        }
                        else{
                            setNotify('error', 'Server error (500). Please try again.'); 
                        }
                       
                    }
                    else
                    {
                         setNotify('error', 'Server error (500). Please try again.'); 
                    }
                }
                else
                {
                    setNotify('warning', 'Passwords do not match.'); 
                }
            }
            else
            {
                setNotify('error', 'Invalid current password!');
            }
        }
        else
        {
             setNotify('error', 'Server error (500). User not found.'); 
        }
    }
?>

<?php include 'components/headerNoLogin.php'; ?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/change.css">
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
                    <h1>Change Password</h1>
                    
                    <form action="change.php" method="post">
                        <input type="password" class="input" placeholder="Old Password" name="old" required>
                        <input type="password" class="input" placeholder="New Password" name="new" required>
                        <input type="password" class="input" placeholder="Confirm Password" name="connew" required>
                        <button type="submit" class="svbutton">Set Password</button>
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