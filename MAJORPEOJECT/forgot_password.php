<?php
include 'config.php';

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);

   $select = mysqli_query($conn, "SELECT * FROM `faculty` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $token = bin2hex(random_bytes(50));
      $update = mysqli_query($conn, "UPDATE `faculty` SET reset_token = '$token' WHERE email = '$email'") or die('query failed');
      
      // Send reset email
      $reset_link = "http://yourwebsite.com/reset_password.php?token=$token";
      $to = $email;
      $subject = "Password Reset Request";
      $message = "Click on the following link to reset your password: $reset_link";
      $headers = "From: no-reply@yourwebsite.com";
      
      if(mail($to, $subject, $message, $headers)){
         $message[] = 'Password reset link has been sent to your email!';
      } else {
         $message[] = 'Failed to send email!';
      }
   } else {
      $message[] = 'Email not found!';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-container">
   <form action="" method="post">
      <h3>Forgot Password</h3>
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Enter Email" class="box" required>
      <input type="submit" name="submit" value="Send Reset Link" class="btn">
   </form>
</div>
</body>
</html>
