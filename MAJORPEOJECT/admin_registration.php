<?php

include 'config.php';

if(isset($_POST['submit'])){

   $fname = mysqli_real_escape_string($conn, $_POST['fname']);
   $lname = mysqli_real_escape_string($conn, $_POST['lname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $phno = mysqli_real_escape_string($conn, $_POST['phno']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `user_form`(fname,lname, email,phno, password) VALUES('$fname','$lname', '$email','$phno', '$pass')") or die('query failed');

         if($insert){
            $message[] = 'registered successfully!';
            header('location:admin_login.php');
         }else{
            $message[] = 'registration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="text" name="fname" placeholder="enter firstname" class="box" required>
      <input type="text" name="lname" placeholder="enter lastname" class="box" required>

      <input type="email" name="email" placeholder="enter email" class="box" required>
      <input type="text" name="phno" placeholder="enter phno" class="box" required>

      <input type="password" name="password" placeholder="enter password" class="box" required>
      <input type="password" name="cpassword" placeholder="confirm password" class="box" required>

      <input type="submit" name="submit" value="register now" class="btn">
      <p>already have an account? <a href="admin_login.php">login now</a></p>
   </form>

</div>

</body>
</html>
