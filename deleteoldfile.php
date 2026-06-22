<?php
include 'config.php';

$newdate = date("Y-m-d");
$datecheck = "SELECT * FROM files WHERE delete_date <= '$newdate'";
$result = $conn->query($datecheck);

function deleteSpecificFile($folderPath, $fileToDelete) {
    $filePath = $folderPath . DIRECTORY_SEPARATOR . $fileToDelete;

    if (is_file($filePath)) {
        if (unlink($filePath)) {
            echo "File deleted from server: " . $fileToDelete . "<br>";
            return true;
        } else {
            echo "Error deleting file from server: " . $fileToDelete . "<br>";
            return false;
        }
    } else {
        
        echo "File not found on server (Already missing): " . $fileToDelete . "<br>";
        return false; 
    }
}


$updatepass = "UPDATE files SET pin = '0000', user_id = '0000', delete_date = '9999-99-99' WHERE filename = ?";
$stmt = $conn->prepare($updatepass);

$notificationsql = "INSERT INTO notification (message, notiread, user_id) VALUES (?, '1', ?)";
$notistmt = $conn->prepare($notificationsql);


if ($result && $result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $folder = __DIR__ . "/u"; 
        $fileToDelete = $row["filename"]; 
        $fileOwnerId = $row["user_id"]; 

       
        $filePath = $folder . DIRECTORY_SEPARATOR . $fileToDelete;
        $is_file_exists = is_file($filePath);
        $fileDeleted = deleteSpecificFile($folder, $fileToDelete);

        
        if ($fileDeleted || !$is_file_exists) {
            
            
            $stmt->bind_param("s", $fileToDelete);

            if ($stmt->execute()) {
                echo "Database updated for: " . $fileToDelete . "<br>";

                $message = "'$fileToDelete' This file has been deleted.";
                
               
                $target_user = (!empty($fileOwnerId) && $fileOwnerId != '0000') ? $fileOwnerId : 43;

                
                $notistmt->bind_param("si", $message, $target_user);

                if ($notistmt->execute()) {
                    echo "Notification sent to User $target_user.<br>";
                } else {
                    echo "Notification send failed.<br>";
                }
            } else {
                echo "Database update failed.<br>";
            }
            
            echo "------------------------------------<br>";
        }
    }
    
  
    $stmt->close();
    $notistmt->close();

} else {
    echo "No files found for deletion.<br>";
}

$conn->close();
?>