<?php
session_start();
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>SWIFTFILELINK - Password Verified</title>
    <link rel="icon" href="http://www.swiftfilelink.rf.gd/logo2.png" sizes="32x32">
    
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Exo+2:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* Global Cyber Background */
        body {
            background: #0b0d13;
            font-family: 'Exo 2', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        /* Neon Dark Glow Card Base Structure */
        #card {
            background: #0f1117;
            width: 100%;
            max-width: 380px;
            text-align: center;
            border-radius: 16px;
            border: 1px solid rgba(0, 230, 118, 0.2); /* Neon Green Border */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6), 0 0 20px rgba(0, 230, 118, 0.03);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        /* Card Upper Header (Neon Green Tech Accent) */
        #upper-side {
            padding: 35px 20px;
            background-color: rgba(0, 230, 118, 0.03);
            border-bottom: 1px solid rgba(0, 230, 118, 0.1);
        }

        /* Animated Glowing Custom SVG Checkmark */
        #checkmark {
            width: 70px;
            height: 70px;
            fill: #00e676; /* Cyber Neon Green */
            filter: drop-shadow(0 0 8px rgba(0, 230, 118, 0.6));
            margin: 0 auto 20px auto;
            display: block;
        }

        /* Security Status Heading Layout */
        #status {
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 19px;
            color: #ffffff;
            margin: 0;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }

        /* Lower Content Section Container */
        #lower-side {
            padding: 35px 30px 45px 30px;
        }

        /* Dynamic Description Text block */
        #message {
            margin: 0 0 35px 0;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            line-height: 1.6;
            letter-spacing: 0.5px;
        }

        /* Cyberpunk Action Trigger Button Link */
        #contBtn {
            display: inline-block;
            text-decoration: none;
            font-family: 'Orbitron', sans-serif;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: rgba(0, 230, 118, 0.1);
            color: #00e676;
            padding: 12px 40px;
            border: 1px solid #00e676;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 230, 118, 0.15);
            transition: all 0.3s ease;
        }

        /* Button Hover Interactive States */
        #contBtn:hover {
            background: #00e676;
            color: #0b0d13;
            box-shadow: 0 0 25px rgba(0, 230, 118, 0.4);
            transform: translateY(-2px);
        }

        /* Core Animation Keyframes */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div id="card">
        
        <div id="upper-side">
            <svg version="1.1" id="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                <path d="M131.583,92.152l-0.026-0.041c-0.713-1.118-2.197-1.447-3.316-0.734l-31.782,20.257l-4.74-12.65
                c-0.483-1.29-1.882-1.958-3.124-1.493l-0.045,0.017c-1.242,0.465-1.857,1.888-1.374,3.178l5.763,15.382
                c0.131,0.351,0.334,0.65,0.579,0.898c0.028,0.029,0.06,0.052,0.089,0.08c0.08,0.073,0.159,0.147,0.246,0.209
                c0.071,0.051,0.147,0.091,0.222,0.133c0.058,0.033,0.115,0.069,0.175,0.097c0.081,0.037,0.165,0.063,0.249,0.091
                c0.065,0.022,0.128,0.047,0.195,0.063c0.079,0.019,0.159,0.026,0.239,0.037c0.074,0.01,0.147,0.024,0.221,0.027
                c0.097,0.004,0.194-0.006,0.292-0.014c0.055-0.005,0.109-0.003,0.163-0.012c0.323-0.048,0.641-0.16,0.933-0.346l34.305-21.865
                C131.967,94.755,132.296,93.271,131.583,92.152z" />
                <circle fill="none" stroke="#00e676" stroke-width="6" stroke-miterlimit="10" cx="109.486" cy="104.353" r="32.53" />
            </svg>
            <h3 id="status">Password Updated</h3>
        </div>
        
        <div id="lower-side">
            <p id="message">
                Your credentials have been re-encrypted and compiled successfully. Please re-authenticate your session using the new password.
            </p>
            <a href="login.php" id="contBtn">Proceed to Login</a>
        </div>
        
    </div>

</body>
</html>