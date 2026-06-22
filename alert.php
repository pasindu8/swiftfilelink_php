<?php

$status = isset($_GET['status']) ? $_GET['status'] : 'error';
$message = isset($_GET['msg']) ? htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8') : 'An unknown error occurred.';
$redirect = isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect'], ENT_QUOTES, 'UTF-8') : 'index.php'; // Default return page


if ($status === 'success') {
    $title = 'SUCCESS OPERATION';
    $theme_color = '#22c55e'; 
    $icon = 'check_circle';
} else {
    $title = 'SECURITY ALERT';
    $theme_color = '#da3633'; 
    $icon = 'gpp_bad'; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - SwiftFileLink</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
    <style>
        body {
            background-color: #06090d;
            color: #ffffff;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: space-between;
        }

        /* Top Header Navigation Bar */
        .navbar {
            padding: 20px 50px;
            display: flex;
            align-items: center;
            background: rgba(13, 17, 23, 0.7);
            border-bottom: 1px solid #21262d;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .brand-logo {
            width: 35px;
            height: 35px;
            background: #ffaa00; /* Oyage logo eke pata */
            border-radius: 50%;
        }
        .brand-text h1 {
            font-size: 18px;
            margin: 0;
            color: #ffaa00;
            letter-spacing: 1px;
            font-weight: 800;
        }
        .brand-text span {
            font-size: 11px;
            color: #8b949e;
            display: block;
        }

        /* Main Alert Container */
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }
        .alert-card {
            background-color: #0d1117;
            border: 1px solid #21262d;
            border-radius: 12px;
            width: 100%;
            max-width: 550px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }
        .alert-title {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 25px;
            /* Neon Blue heading style matching your image */
            color: #00d2ff;
            text-shadow: 0 0 10px rgba(0, 210, 255, 0.3);
        }
        .status-icon {
            font-size: 70px;
            margin-bottom: 15px;
        }
        .alert-message {
            color: #c9d1d9;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        /* Return Button */
        .btn-return {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #da3633; /* Oyage theme eke red button pata */
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }
        .btn-return:hover {
            background-color: #bc2825;
            box-shadow: 0 0 15px rgba(218, 54, 51, 0.4);
        }

        /* Footer matching the image exactly */
        footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #8b949e;
            border-top: 1px solid #21262d;
            background: #0d1117;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div class="brand">
            <div class="brand-logo"></div> <div class="brand-text">
                <h1>SWIFTFILELINK</h1>
                <span>Quick. Simple. Secure.</span>
            </div>
        </div>
    </div>

    <div class="main-container">
        <div class="alert-card">
            <div class="alert-title"><?php echo $title; ?></div>
            
            <span class="material-symbols-outlined status-icon" style="color: <?php echo $theme_color; ?>;">
                <?php echo $icon; ?>
            </span>
            
            <div class="alert-message">
                <?php echo $message; ?>
            </div>
            
            <a href="<?php echo $redirect; ?>" class="btn-return">
                <span class="material-symbols-outlined" style="font-size: 18px;">arrow_back</span> Return to Page
            </a>
        </div>
    </div>

    <footer>
        © 2026 SwiftFileLink · All rights reserved · Developed by Pasindu Dulshan.
    </footer>

</body>
</html>