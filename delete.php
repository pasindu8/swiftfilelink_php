<?php 
include 'components/sessionsActive.php'; 

$id = $_SESSION['user_id'] ?? null; 
$user = $_SESSION['username'] ?? null; 
$type = $_SESSION['type'] ?? null; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $typed_username = $_POST['usernameveri'];
    
    
    if($typed_username === $user && !empty($user))
    {
         
         $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?");
         $stmt->bind_param("i", $id);
         
         if ($stmt->execute()) 
         {  
          
            session_unset();
            session_destroy();
            header('Location: index.php');
            exit();
         }
    }
    
    
    header('Location: delete.php?error=invalid');
    exit();
}

include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/delete.css">
</head> 
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        
       <?php include 'components/header3.php'; ?>
            
        <div class="container">
            
            <main class="content">
                <div class="co">
                    <h2>Delete Confirmation</h2>
                    
                    <form action="delete.php" method="post">
                        <input type="hidden" value="<?php echo htmlspecialchars($user); ?>" id="de">
                        <input type="hidden" name="usernameveri" id="d">
                        
                        <p class="fist">
                            Once you delete your account, all of your information will be lost forever. 
                            We will not be able to restore your account. Are you sure you want to proceed?
                        </p>

                        <button type="submit" class="svbutton" onclick="return deletemy()" id="bu">Delete Account</button>
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

    <script src="scripts/loader.js"></script>
    <script src="scripts/SidebarNavigation.js"></script>
  
    <script>
        function deletemy() {
            var current_username = document.getElementById("de").value;
            let person = prompt("Confirm by typing username below.", "");
            
            if (person === current_username) {
               
                document.getElementById("d").value = person;
                return true; 
            } else {
                alert("ERROR! : Username invalid. Account deletion canceled.");
                return false; 
            }
        }
    </script>
</body>
</html>
<?php 
$conn->close(); 
?>