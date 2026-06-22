<?php include 'components/adminSession.php'; 
include 'components/headerNoLogin.php';
?>
<link rel="stylesheet" href="styles/main2.css">
<link rel="stylesheet" href="styles/filesmanage.css">
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
                    <h2>Secure File Infrastructure</h2>
                    <div class="safety-note">
                		<span class="material-symbols-outlined" style="font-size: 18px;">security</span>
                		Privacy Mode Active: File contents, structural names, and PIN codes are mathematically obfuscated from administrators.
            		</div>
                    <table>
                        <thead>
                            <tr>
                                <th>File ID</th>
                                <th>File Reference (Masked)</th>
                                <th>Security PIN</th>
                                <th>Max Downloads</th>
                                <th>Expiration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                    $query = "SELECT id, filename, download_count, count, delete_date FROM files WHERE delete_date != '9999-99-99' ORDER BY id DESC";
                    $result = mysqli_query($conn, $query);
                    
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            
                            $ext = pathinfo($row['filename'], PATHINFO_EXTENSION);
                            $masked_name = "ENC_" . substr(md5($row['id']), 0, 8) . "." . $ext;
                            $countDownload = $row['count'] - $row['download_count'];
                            $rowClass = ($countDownload <= 0) ? "row-expired" : "";

                            echo "<tr class='$rowClass'>";
                            echo "<td style='font-family: \"Orbitron\", sans-serif; color: #ff3333; font-weight: bold;'>#" . $row['id'] . "</td>";
                            echo "<td style='font-weight: 600; color: #ffffff;'>" . $masked_name . "</td>";
                            echo "<td><span class='secure-badge'>••••••</span></td>"; 
                            echo "<td>" . $countDownload . " Downloads</td>";
                            echo "<td style='font-size: 13px; color: rgba(255,255,255,0.4);'>" . $row['delete_date'] . "</td>";
                            echo "<td>
                                    <a href='delete_file.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to completely wipe this record from storage?\");'>
                                        <span class='material-symbols-outlined' style='font-size: 16px;'>delete_forever</span> Wipe
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>No active files logged in infrastructure.</td></tr>";
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
    <!-- ── LOADER ── -->
  	<script src="scripts/loader.js"></script>
  	<!-- ── Sidebar Navigation ── -->
  	<script src="scripts/SidebarNavigation.js"></script>
</body>
</html>