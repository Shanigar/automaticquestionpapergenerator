<?php
include 'config.php';

if(isset($_POST['submit'])){
   $token = mysqli_real_escape_string($conn, $_POST['token']);
   $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));

   $select = mysqli_query($conn, "SELECT * FROM `faculty` WHERE reset_token = '$token'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $update = mysqli_query($conn, "UPDATE `faculty` SET password = '$new_password', reset_token = NULL WHERE reset_token = '$token'") or die('query failed');
      $message[] = 'Password has been reset successfully!';
   } else {
      $message[] = 'Invalid token!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reset Password</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
   <form action="" method="post">
      <h3>Reset Password</h3>
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" required>
      <input type="password" name="new_password" placeholder="Enter New Password" class="box" required>
      <input type="submit" name="submit" value="Reset Password" class="btn">
   </form>
</div>
</body>
</html>
