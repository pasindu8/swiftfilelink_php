<?php
    $query = "SELECT notification_id FROM notification WHERE user_id='$id'";
  	$result = mysqli_query($conn, $query);

      $notifiCount = 0; 
      if ($result) {
          $notifiCount = mysqli_num_rows($result); 
      }
?>