<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$message = '';

if (isset($_POST['submit'])) {
    $currentPassword = mysqli_real_escape_string($conn, $_POST['currentPassword']);
    $newPassword = mysqli_real_escape_string($conn, $_POST['newPassword']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    $userId = $_SESSION['user_id'];

    // Fetch the current password from the database
    $result = mysqli_query($conn, "SELECT password FROM `faculty` WHERE id = '$userId'");
    $row = mysqli_fetch_assoc($result);
    $hashedCurrentPassword = md5($currentPassword);

    // Validate current password
    if ($row['password'] !== $hashedCurrentPassword) {
        $message = 'Current password is incorrect.';
    } elseif ($newPassword !== $confirmPassword) {
        $message = 'New password and confirm password do not match.';
    } elseif (strlen($newPassword) < 8) {
        $message = 'New password must be at least 8 characters long.';
    } else {
        // Update the password in the database
        $hashedNewPassword = md5($newPassword);
        $update = mysqli_query($conn, "UPDATE `faculty` SET password = '$hashedNewPassword' WHERE id = '$userId'");

        if ($update) {
            $message = 'Password changed successfully!';
        } else {
            $message = 'Failed to update password. Please try again later.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Change Password</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: flex;
        flex-direction: column;
    }

    h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        margin-bottom: 5px;
        display: block;
    }

    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        padding: 10px;
        background-color: #28a745;
        border: none;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }

    #message {
        margin-top: 10px;
        color: red;
        text-align: center;
    }
</style>
</head>
<body>
<div class="container">
    <form method="post" action="">
        <h2>Change Password</h2>
        <div class="form-group">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" required>
        </div>
        <div class="form-group">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit">Change Password</button>
        </div>
        <div id="message"><?php echo $message; ?></div>
    </form>
</div>
</body>
</html>
