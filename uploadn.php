<?php
    include 'config.php';
    session_start();
  
    $id = '0000';
    
    $checkUser = "SELECT * FROM files WHERE user_id !='$id'";
    $result = mysqli_query($conn, $checkUser);

    $conpin = [];
    if (mysqli_num_rows($result) > 0) 
    {
        while ($row = $result->fetch_assoc()) 
        {
            $conpin[] = $row['pin'];
        }
    }
?>
<?php include 'components/headerNoLogin.php'; ?>
<link rel="stylesheet" href="styles/main.css">
<link rel="stylesheet" href="styles/upload.css">
</head> 
<body onload="myFunction()"> 

    <div id="loader">
        <?php include 'loader.php'; ?>
    </div>
  
    <div style="display:none;" id="myDiv" class="animate-bottom"> 

        <!-- NAV -->
          <?php
              include 'components/navBar.php';
          ?>
  
        <!-- MOBILE DRAWER -->
         <?php
            include 'components/MobileDrawer.php';
         ?>
              
        <div class="container">
            <main class="content">
                <h2 class="mainhed">File Upload</h2>
            
                <form id="uploadForm" enctype="multipart/form-data">
                   
                    <label for="pin">Enter PIN</label>
                    <input class="input" type="text" id="pin" name="pin" autocomplete="off" oninput="checkpin()" maxlength="5" minlength="5" placeholder="e.g. 12345" required>
                    
                    <label for="cou">Enter Download Count</label>
                    <input class="input" type="number" id="cou" name="cou" autocomplete="off" min="1" placeholder="Maximum allowed downloads" required>
    
                    <label for="de">Files Delete Date</label>
                    <input class="input" type="date" id="de" name="de" autocomplete="off" oninput="checkdate()" required>
    
                    <label for="fileUpload">Select Files</label>
                    <input class="file" type="file" id="fileUpload" name="files[]" multiple required>

                    <div style="text-align: center;">
                        <input class="buinput" type="submit" value="Upload Files">
                    </div>
                </form>
            
                <div id="progressBar">
                    <div id="progressBarFill">0%</div>
                </div>
                <div id="status"></div>
            </main>
        </div>   <br>
        <?php include 'components/footer.php'; ?>
    </div>
 
     
  
    <script>
        // Server Generated Existing Pins
        const existingPins = <?php echo json_encode($conpin); ?>;

        function checkpin() {
            const pinInput = document.getElementById("pin").value;
            if (existingPins.includes(pinInput)) {
                alert("Invalid PIN: This PIN code is already taken.");
                document.getElementById("pin").value = "";
            }
        }

        function checkdate(){
            const dateInput = document.getElementById("de").value;
            const nowdate = new Date().toISOString().split("T")[0];
            if (dateInput <= nowdate) {
                alert("Invalid Date:\nDate cannot be in the past or today.");
                document.getElementById("de").value = "";
            }
        }

        // Form Submit AJAX Execution Block
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            // Show the progress bar upon submit
            document.getElementById('progressBar').style.display = 'block';

            var formData = new FormData();
            var pin = document.getElementById('pin').value;
            var cou = document.getElementById('cou').value;
            var de = document.getElementById('de').value;

            formData.append('pin', pin);
            formData.append('cou', cou);
            formData.append('de', de);

            var files = document.getElementById('fileUpload').files;
            for (var i = 0; i < files.length; i++) {
                formData.append('files[]', files[i]);
            }

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 't1n.php', true);

            // Progress Bar Interface Math calculations logic
            xhr.upload.addEventListener('progress', function(e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    document.getElementById('progressBarFill').style.width = percentComplete + '%';
                    document.getElementById('progressBarFill').textContent = Math.round(percentComplete) + '%';
                }
            });

            xhr.onload = function() {
                if (xhr.status == 200) {
                    document.getElementById('status').innerHTML = "<span style='color: #4BB543;'>✔ Files uploaded successfully!</span>";
                    document.getElementById('uploadForm').style.display = 'none';
                } else {
                    document.getElementById('status').innerHTML = "<span style='color: #ff3333;'>❌ File upload failed!</span>";
                }
            };

            xhr.send(formData);
        });
    </script>
  <!-- ── PARTICLE CANVAS ── -->
  <script src="scripts/backgroundAnimation.js"></script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── HAMBURGER ── -->
  <script src="scripts/HamburgerMenu.js"></script>
</body>
</html>