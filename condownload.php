<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["e"]) && isset($_GET["n"])) {
        // Sanitize input
        $filename = basename($_GET["e"]);
        $pin = preg_match("/^[a-zA-Z0-9]{4}$/", $_GET["n"]) ? $_GET["n"] : die("Invalid PIN format.");
        $filePath = "u/" . $filename;

        if (!file_exists($filePath) || !is_readable($filePath)) {
            die("<h1>File not found or cannot be opened.</h1>");
        }

        // Verify download permission
        $verifySql = "SELECT * FROM files WHERE pin = ? AND filename = ?";
        $stmt = $conn->prepare($verifySql);
        $stmt->bind_param("ss", $pin, $filename);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update download count
            $updateSql = "UPDATE files SET download_count = download_count + 1 WHERE pin = ? AND filename = ?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("ss", $pin, $filename);
            $stmt->execute();

            // Secure session download tracking
            $downloadKey = hash("sha256", $pin . '_' . $filename);
            $_SESSION[$downloadKey] = true;

            // Send file headers
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=\"" . basename($filePath) . "\"");
            header("Content-Type: " . mime_content_type($filePath));
            header("Content-Length: " . filesize($filePath));
            header("Content-Transfer-Encoding: binary");

            readfile($filePath);
            exit();
        } else {
            die("<h1>Unauthorized access or file not found.</h1>");
        }
    } else {
        die("<h1>Missing parameters.</h1>");
    }
} else {
    die("<h1>Invalid request.</h1>");
}

$conn->close();
?>
