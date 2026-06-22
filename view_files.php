<?php
include 'components/sessionsActive.php'; 
require_once 'components/notify.php';

function reCaptcha($recaptcha){
    $secret = "your_recaptcha_secret_key";
    $ip = $_SERVER['REMOTE_ADDR'];

    $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
    $url = "https://www.google.com/recaptcha/api/siteverify";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    $data = curl_exec($ch);
    curl_close($ch);

    return json_decode($data, true);
}


$captcha_success = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['g-recaptcha-response'])) {
    $recaptcha = $_POST['g-recaptcha-response'];
    $res = reCaptcha($recaptcha);
    if($res['success']){
        $captcha_success = true;
    }
}

if (!$captcha_success && $_SERVER["REQUEST_METHOD"] == "POST") {
    
    setNotify('warning', 'Captcha Verification Failed! Please try again.'); 
    header("Location: download.php"); 
    exit();
}
include 'components/headerNoLogin.php';

?>

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Exo+2:wght@400;700&family=Audiowide&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <link rel="stylesheet" href="styles/admin.css">
	<link rel="stylesheet" href="styles/notify.css">
</head>
<body onload="myFunction()"> 
  <div id="loader"></div>
  
  <div style="display:none;" id="myDiv" class="animate-bottom"> 
    <?php include 'components/header3.php'; ?>
          
    <div class="container">
        <main class="content"><?php showNotify(); ?>
            <center>
            <h2 class="mainhed">Files</h2>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pin"])) {
                
              
                $pin = mysqli_real_escape_string($conn, $_POST["pin"]);

                $sql = "SELECT * FROM files WHERE pin = '$pin'";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo "<table border='0' width='100%'>";

                    while ($row = $result->fetch_assoc()) {
                        $downcount = $row["download_count"];
                        $max_count = $row["count"];
                        $finame = $row["filename"];
                        $exete = $row["Extension"];
                        
                       
                        $show = ($downcount >= $max_count) ? false : true;

                        $file_path = 'u/' . $finame;
                        $f = "Unknown Size";

                        if (file_exists($file_path)) {
                            $file_size = filesize($file_path);
                            
                            if($file_size >= 1024 && $file_size < 1048576) {
                                $f = number_format(($file_size / 1024), 2) . " KB"; 
                            } elseif($file_size >= 1048576 && $file_size < 1073741824) {
                                $f = number_format(($file_size / 1048576), 2) . " MB"; 
                            } elseif($file_size >= 1073741824) {
                                $f = number_format(($file_size / 1073741824), 2) . " GB";
                            } else {
                                $f = number_format($file_size, 2) . " B";
                            }
                        }

                       
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($finame) . "." . htmlspecialchars($exete) . "</td>";
                        echo "<td>" . $f . "</td>";
                        echo "<td>";
                        
                        if ($show) {
                            echo "<a class='do' href='condownload.php?e=" . urlencode($finame) . "&n=" . urlencode($pin) . "&i=" . urlencode($finame) . "&c=" . urlencode($max_count) . "' target='_blank'>Download</a>";
                        } else {
                            echo "<a class='do1' href='#' style='color:red; text-decoration:none;'>Expired</a>";
                        }
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    setNotify('error', 'Invalid PIN Code!');  
                    header("Location: download.php"); 
                    exit();
                }
            } else {
                echo "<p>Please submit the form from the download page.</p>";
            }
            $conn->close();
            ?>
            </center>
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
                echo "<h3>Error Panel</h3>";
        }
        ?>
    </div>
    
    <?php include 'components/footer.php'; ?>

  </div>
  
  <script src="scripts/loader.js"></script>
  <script src="scripts/SidebarNavigation.js"></script>
</body>
</html>