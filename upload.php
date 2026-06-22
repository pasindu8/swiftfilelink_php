<?php
  include 'components/sessionsActive.php'; 

    $checkUser = "SELECT * FROM files WHERE user_id !='$id'";
    $result = mysqli_query($conn, $checkUser);

    $conpin = [];
    if (mysqli_num_rows($result) > 0) 
    {
        $count=1;
        while ($row = $result->fetch_assoc()) 
        {
            $conpin[] = $row['pin'];
        }
    }
    include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/upload.css">
</head> 

<body onload="myFunction()"> 

  <div id="loader">
    <?php include 'loader.php'; ?>
  </div>
  
  <div style="display:none;" id="myDiv" class="animate-bottom"> 

    <?php include 'components/header3.php'; ?>
          
    <div class="container">
        <div class="orb"></div>
        
        <main class="content">
            <div class="upload-card">
                <h2 class="mainhed">File Upload</h2>
            
                <form id="uploadForm" enctype="multipart/form-data">
                   
                    <div class="form-group">
                        <label for="pin">Enter PIN</label>
                        <input class="input" type="text" id="pin" name="pin" autocomplete="off" oninput="checkpin()" maxlength="5" placeholder="5-digit pin code" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="cou">Enter Download Count</label>
                        <input class="input" type="text" id="cou" name="cou" autocomplete="off" placeholder="Max downloads allowed" required>
                    </div>
    
                    <div class="form-group">
                        <label for="de">Files Delete Date</label>
                        <input class="input" type="date" id="de" name="de" autocomplete="off" oninput="checkdate()" required>
                    </div>
    
                    <div class="form-group">
                        <label>Select Files</label>
                        <div class="file-wrapper">
                            <input class="file" type="file" id="fileUpload" name="files[]" multiple required>
                        </div>
                    </div>

                    <input class="buinput" type="submit" value="Upload Files">
                </form>
            
                <div id="progressBar">
                    <div id="progressBarFill">0%</div>
                </div>
                <div id="status"></div>
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
                echo "<h3 style='color:var(--o); text-align:center;'>Error loading panel</h3>";
        }
        ?>
    </div>

    <?php include 'components/footer.php'; ?>

  </div>
  
    <script>
    const existingPins = <?php echo json_encode($conpin); ?>;

    function checkpin() {
        const pinInput = document.getElementById("pin").value;
        if (existingPins.includes(pinInput)) {
            alert("Invalid PIN\nThis PIN is already taken by another user.");
            document.getElementById("pin").value = "";
        }
    }

    function checkdate(){
        const dateInput = document.getElementById("de").value;
        const nowdate = new Date().toISOString().split("T")[0];
        if (dateInput <= nowdate) {
            alert("Invalid Date\nDate cannot be today or in the past");
            document.getElementById("de").value = "";
        }
    }


    /* ── AJAX UPLOAD PROGRESS LOGIC ── */
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var formData = new FormData();

        var pinVal = document.getElementById('pin').value;
        var couVal = document.getElementById('cou').value;
        var deVal = document.getElementById('de').value;

        formData.append('pin', pinVal);
        formData.append('cou', couVal);
        formData.append('de', deVal);

        var files = document.getElementById('fileUpload').files;
        for (var i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 't1.php', true);

        document.getElementById('progressBar').style.display = 'block';
        document.getElementById('status').style.color = 'var(--c)';
        document.getElementById('status').textContent = 'Uploading... Please wait.';

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                document.getElementById('progressBarFill').style.width = percentComplete + '%';
                document.getElementById('progressBarFill').textContent = Math.round(percentComplete) + '%';
            }
        });

        xhr.onload = function() {
            if (xhr.status == 200) {
                document.getElementById('status').style.color = 'var(--g)';
                document.getElementById('status').textContent = 'Files uploaded successfully!';
                document.getElementById('uploadForm').style.display = 'none';
            } else {
                document.getElementById('status').style.color = 'var(--o)';
                document.getElementById('status').textContent = 'File upload failed!';
            }
        };

        xhr.send(formData);
    });
    </script>
  <!-- ── LOADER ── -->
  <script src="scripts/loader.js"></script>
  <!-- ── Sidebar Navigation ── -->
  <script src="scripts/SidebarNavigation.js"></script>
</body>
</html>