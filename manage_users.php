<?php include 'components/adminSession.php'; 
include 'components/headerNoLogin.php';
?>

<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/manage.css">

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
                	<h1>User Database Infrastructure</h1>
                     <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Username</th>
                                <th>Email Address</th>
                                <th>Privilege</th>
                                <th>Action Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                             <?php

                        $query = "SELECT user_id, username, email, type, status FROM user ORDER BY user_id DESC";
                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td style='font-family: \"Orbitron\", sans-serif; color: #ff3333; font-weight: bold;'>#" . $row['user_id'] . "</td>";
                                echo "<td style='font-weight: 600; color: #ffffff;'>" . htmlspecialchars($row['username']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                
                                $typeuser = $row['status'];
                                
                                echo "<td><span class='role-badge'>" . htmlspecialchars($row['type']) . "</span></td>";
                                
                                $user_id = $row['user_id'];
                                include 'secretKey.php';
                                $token = hash_hmac('sha256', $user_id, $secret_key);
                                $s1_url = "block_user.php?id=" . $user_id . "&token=" . $token;
                                $s2_url = "manage_privilege.php?id=" . $user_id . "&token=" . $token;
                                $s3_url = "anblock_user.php?id=" . $user_id . "&token=" . $token;
                                
                                echo "<td>";
                                    
                                    if($typeuser === "active")
                                    {
                                        echo"
                                           
                                            <a href='". $s1_url ."' class='btn btn-danger' onclick='return confirm(\"WARNING: Are you sure you want to block this user?\");'>
                                                <span class='material-symbols-outlined' style='font-size: 16px; vertical-align: middle;'>block</span> Block
                                            </a>";
                                     }else{
                                        echo"
                                           
                                            <a href='". $s3_url ."' class='btn btn-danger' onclick='return confirm(\"WARNING: Are you sure you want to unblock this user?\");'>
                                                <span class='material-symbols-outlined' style='font-size: 16px; vertical-align: middle;'>lock_open</span> Unlock
                                            </a>";
                                    } echo"

                                            
                                            <a href='" . $s2_url . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to change privileges for this user?\");'>
                                                <span class='material-symbols-outlined' style='font-size: 16px; vertical-align: middle;'>admin_panel_settings</span> Privilege
                                            </a>
                                          </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td style='font-family: \"Orbitron\", sans-serif; color: #ff3333;'>#01</td>
                                    <td style='font-weight: 600; color: #ffffff;'>Pasindu_Dev</td>
                                    <td>example@domain.com</td>
                                    <td><span class='role-badge'>User</span></td>
                                    <td><a href='#' class='btn btn-danger' onclick='alert(\"System Operations Note: Static framework demo trigger simulation mode active.\");'><span class='material-symbols-outlined' style='font-size: 16px;'>person_remove</span> Delete</a></td>
                                  </tr>";
                        }
                        ?>
                            
                            
                        </tbody>
                	</table>
                </div>
            </main>
            <?php include 'adminbar.php'; ?>
        </div>
       <?php include 'components/footer.php'; ?>
 	</div>
   <!-- ── Sidebar Navigation ── -->
  <script src="scripts/SidebarNavigation.js"></script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
</body>
</html>