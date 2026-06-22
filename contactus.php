<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    require 'PHPMailer-master/src/Exception.php';

    include 'config.php';
	require_once 'components/notify.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') 
    {
        
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
      
        $sqlre = "INSERT INTO contactus (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($conn->query($sqlre) === TRUE) {  

            
            $mail = new PHPMailer(true);

            try {
                
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; 
                $mail->SMTPAuth   = true;
                $mail->Username   = 'your-email@gmail.com';
                $mail->Password   = 'your-app-password'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587; 

                
                $mail->setFrom('your-email@gmail.com', 'SwiftFileLink Support');
                $mail->addAddress('pasindudulshan08@gmail.com'); 
                
                $mail->isHTML(true);
                $mail->Subject = 'New Contact Us Message - SwiftFileLink';
                $mail->Body    = '
                    <div style="font-family: Arial, sans-serif; padding: 20px; background-color: #f4f4f4;">
                        <div style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h2 style="color: #333;">Contact Us Form Submission</h2>
                            <hr style="border: 0; border-top: 1px solid #eee;">
                            <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
                            <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
                            <p><strong>Message:</strong></p>
                            <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #378ADD; margin-top: 10px;">
                                ' . nl2br(htmlspecialchars($message)) . '
                            </div>
                        </div>
                    </div>
                ';

                $mail->send();
                setNotify('success', 'Message Sent Successfully!');

            } catch (Exception $e) {
               	setNotify('error', 'Message send failed. Please try again.');
            }
     
        } else {
            setNotify('error', 'Database Error: Unable to send message. Please try again.'); 
        }
    }
    $conn->close();
?>
<?php include 'components/headerNoLogin.php'; ?>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/contactus.css">
<link rel="stylesheet" href="styles/notify.css">
</head> 
<body onload="myFunction()"> 

    <div id="loader">
         <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 
        
   
  <?php
      include 'components/navBar.php';
      include 'components/MobileDrawer.php';
  ?>

        <h1 class="page-title">Contact Us</h1>
          
        <div class="container"><?php showNotify(); ?>
            
            <form action="contactus.php" method="post" autocomplete="off">
                <label for="name">Your Name</label>
                <input type="text" id="name" class="inuttxet" name="name" required>
                
                <label for="email">Your Email Address</label>
                <input type="email" id="email" class="inuttxet" name="email" required>
                
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
                
                <button type="submit">Submit Message</button>
            </form>

            <div class="co">
                <p>"We value your feedback and are here to assist you with any inquiries. Whether you have questions 
                about our services, need support, or want to share your thoughts, please don't hesitate to get in touch. 
                Our team is dedicated to providing you with a prompt and helpful response."</p>
            </div>
        </div>

   <?php include 'components/footer.php'; ?>
    </div>
  
    <!-- ── LOADER ── -->
    <script src="scripts/loader.js"></script>
    <!-- ── HAMBURGER ── -->
	<script src="scripts/HamburgerMenu.js"></script>
    
</body>
</html>